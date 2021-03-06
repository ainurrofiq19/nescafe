<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tl extends CI_Controller {
		function __construct(){
		parent::__construct();
		$this->load->model(array('View_of','M_brand_presenter','M_store','M_item_delivery','M_item_reture'));
	}

	public function index()
	{
		$data['content'] = 'tl/dasboard';
		$this->load->view('template', $data);
	}

	public function view_brand_presenter()
	{
		$data['cetak1'] = $this->M_brand_presenter->view_brand_presenter();
		$data['content'] = 'tl/view_brand_presenter';
		$this->load->view('template',$data);
	}
	public function add_brand_presenter()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			$file = $this->input->post('nip');
			$config['file_name'] = $file;
			date_default_timezone_set('Asia/Karachi'); # add your city to set local time zone
			$now = date('Y-m-d');

			$data = array (
				'NIP'				=> $this->input->post('nip'),
				'NAMA_PEG'			=> $this->input->post('namapeg'),
				'PASSWORD'		  	=> $this->input->post('pass'),
				'ALAMAT_PEG'		=> $this->input->post('alamatpeg'),
				'EMAIL_PEG'			=> $this->input->post('emailpeg'),
				'TLP_PEG'			=> $this->input->post('tlppeg'),
				'JENIS_KELAMIN'		=> $this->input->post('kelaminpeg'),
				'TGL_LAHIR'			=> $now,
				'TGL_MASUK'			=> $this->input->post('tglmasuk'),
				'FOTO_PEG'			=> $file.'.jpg',
				'LEVEL'				=> '2',
				'AKTIF'				=> 'y'
			);
			$data2 = array (
				'NIP_JAGA'				=> $this->input->post('nip'),
				'ID_TOKO_jaga'			=> $this->input->post('toko')
				
			);
			
			
			$config['upload_path']          = './asset/user/';
			$config['allowed_types']        = 'jpg';
			$config['max_size']             = 10000;

	 
			$this->load->library('upload', $config);

			$this->upload->do_upload('gambar');

			$this->db->insert('tbl_pegawai', $data);
			$this->db->insert('tbl_penjaga', $data2);
			redirect('tl/view_brand_presenter');
		}

		$data['kat'] = $this->db->query("SELECT * FROM tbl_toko");
		$data['content'] = 'Tl/add_brand_presenter';
		$this->load->view('template', $data);
	}
	public function edit_brand_presenter($kode_bp)
{
		$files = glob('asset/temp/*');
	foreach ($files as $file) {
		if (is_file($file)) {
			unlink($file);
		}
	}
	if ($this->input->server('REQUEST_METHOD') == 'POST') {
		$kode_bp = $this->input->post('nip'); 
		$file = $this->input->post('nip');
		$config['file_name'] = $file;
		$kode_gambar = $this->input->post('gambarasli');

		$config['upload_path']          = './asset/temp/';
		$config['allowed_types']        = 'jpg';
		$config['max_size']             = 10000;
		$config['max_width']            = 10240;
		$config['max_height']           = 7680;

		$this->load->library('upload', $config);

		$this->upload->do_upload('gambar');

		$size = filesize("asset/user/$kode_gambar");
		$size2 = filesize("asset/temp/$kode_gambar");
		sleep(1);

		echo $size."-";
		echo $size2;

		if ($size == $size2) {
			$data = array (
				'NIP'				=> $this->input->post('nip'),
				'NAMA_PEG'			=> $this->input->post('namapeg'),
				'PASSWORD'		  	=> $this->input->post('pass'),
				'ALAMAT_PEG'		=> $this->input->post('alamatpeg'),
				'EMAIL_PEG'			=> $this->input->post('emailpeg'),
				'TLP_PEG'			=> $this->input->post('tlppeg'),
				'JENIS_KELAMIN'		=> $this->input->post('kelaminpeg'),
				'TGL_LAHIR'			=> $this->input->post('tgllahirpeg'),
				'TGL_MASUK'			=> $this->input->post('tglmasuk'),
				'LEVEL'				=> '2',
				'AKTIF'				=> 'y'
			);
			
			$this->db->update('tbl_pegawai', $data, "NIP = '$kode_bp'");
		}else {
			rename('asset/temp/'.$file.'.jpg', 'asset/user/'.$kode_gambar);
			rename('asset/user/'.$kode_gambar, 'asset/user/'.$file.'.jpg');
			$data = array (
				'NIP'				=> $this->input->post('nip'),
				'NAMA_PEG'			=> $this->input->post('namapeg'),
				'PASSWORD'		  	=> $this->input->post('pass'),
				'ALAMAT_PEG'		=> $this->input->post('alamatpeg'),
				'EMAIL_PEG'			=> $this->input->post('emailpeg'),
				'TLP_PEG'			=> $this->input->post('tlppeg'),
				'JENIS_KELAMIN'		=> $this->input->post('kelaminpeg'),
				'TGL_LAHIR'			=>$this->input->post('tgllahirpeg'),
				'TGL_MASUK'			=> $this->input->post('tglmasuk'),
				'FOTO_PEG'			=> $file.'.jpg',
				'LEVEL'				=> '2',
				'AKTIF'				=> 'y'
			);
			$this->db->update('tbl_pegawai', $data, "NIP = '$kode_bp'");
			redirect('tl/view_brand_presenter/'.$file);
		}

		redirect('tl/view_brand_presenter');
	}


	$data['content'] = 'Tl/edit_brand_presenter';
	$data['bp'] = $this->db->query("SELECT * FROM tbl_pegawai WHERE NIP = '$kode_bp'");
	$data['tok'] = $this->db->query("SELECT tbl_pegawai.NIP AS NIP, 
 		tbl_pegawai.NAMA_PEG AS NAMA_PEG, 
 		tbl_pegawai.ALAMAT_PEG AS ALAMAT_PEG,
 		tbl_pegawai.TLP_PEG AS TLP_PEG,
 		tbl_pegawai.EMAIL_PEG AS EMAIL_PEG,
		tbl_pegawai.JENIS_KELAMIN AS JENIS_KELAMIN,
		tbl_pegawai.TGL_LAHIR AS TGL_LAHIR,
		tbl_toko.NAMA_TOKO AS NAMA_TOKO,
		tbl_pegawai.TGL_MASUK AS TGL_MASUK,
		tbl_pegawai.FOTO_PEG AS FOTO_PEG,
		tbl_pegawai.LEVEL AS LEVEL

 		FROM tbl_pegawai,tbl_penjaga,tbl_toko
        WHERE NIP = '$kode_bp'
        AND tbl_pegawai.NIP=tbl_penjaga.NIP_JAGA
        AND tbl_penjaga.ID_TOKO_JAGA=tbl_toko.ID_TOKO
        AND  LEVEL = 2 and tbl_pegawai.AKTIF='y'");
	$this->load->view('template', $data);
}

	function hapus_brand_presenter($NIP){
     $id = $this->uri->segment(3);       
     $this->M_brand_presenter->hapus_brand_presenter($id) ;
        {
       		 redirect('tl/view_brand_presenter');
        }
    }

	public function detail_brand_presenter($NIP) {
		$data['tok'] = $this->db->query("SELECT tbl_pegawai.NIP AS NIP, 
 		tbl_pegawai.NAMA_PEG AS NAMA_PEG, 
 		tbl_pegawai.ALAMAT_PEG AS ALAMAT_PEG,
 		tbl_pegawai.TLP_PEG AS TLP_PEG,
 		tbl_pegawai.EMAIL_PEG AS EMAIL_PEG,
		tbl_pegawai.JENIS_KELAMIN AS JENIS_KELAMIN,
		tbl_pegawai.TGL_LAHIR AS TGL_LAHIR,
		tbl_toko.NAMA_TOKO AS NAMA_TOKO,
		tbl_pegawai.TGL_MASUK AS TGL_MASUK,
		tbl_pegawai.FOTO_PEG AS FOTO_PEG,
		tbl_pegawai.LEVEL AS LEVEL

 		FROM tbl_pegawai,tbl_penjaga,tbl_toko
        WHERE NIP = '$NIP'
        AND tbl_pegawai.NIP=tbl_penjaga.NIP_JAGA
        AND tbl_penjaga.ID_TOKO_JAGA=tbl_toko.ID_TOKO
        AND  LEVEL = 2 and tbl_pegawai.AKTIF='y'");

		$data['bp'] = $this->M_brand_presenter->find($NIP);
		$data['content'] = 'Tl/detail_brand_presenter';
		$this->load->view('template', $data);
	}
	public function view_store()
	{
		$data['cetak1'] = $this->M_store->view_store();
		$data['content'] = 'tl/view_store';
		$this->load->view('template',$data);
	}
	
	
	public function add_store()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			$data = array (
				'ID_TOKO'			=> '',
				'NAMA_TOKO'			=> $this->input->post('namatoko'),
				'ALAMAT_TOKO'		=> $this->input->post('alamattoko'),
				'TLP_TOKO'			=> $this->input->post('tlptoko'),
				'KOTA_TOKO'			=> $this->input->post('kotatoko'),
				'EMAIL_TOKO'		=> $this->input->post('emailtoko'),
				'STATUS_TOKO'		=> '1'
			);
			

			$this->db->insert('tbl_toko', $data);
			redirect('Tl/view_store');
		}

		$data['kat'] = $this->db->query("SELECT * FROM tbl_kategori");
		$data['content'] = 'Tl/add_store';
		$this->load->view('template', $data);
	}

	public function form_edit_toko($ID_TOKO) {

		$data['toko'] = $this->M_store->find($ID_TOKO);
		$data['kat'] = $this->db->query("SELECT * FROM tbl_toko");
		$data['content'] = 'tl/edit_store';
		$this->load->view('template', $data);
	}

	public function edit_store(){

		$toko_id=$this->input->post('idtoko');
		$data = array (
				
				'NAMA_TOKO'			=> $this->input->post('namatoko'),
				'ALAMAT_TOKO'		=> $this->input->post('alamattoko'),
				'TLP_TOKO'			=> $this->input->post('tlptoko'),
				'KOTA_TOKO'			=> $this->input->post('kotatoko'),
				'EMAIL_TOKO'		=> $this->input->post('emailtoko')
			);

			$where = array (
			'ID_TOKO'	=> $toko_id
			);
			$this->M_store->edit($where,$data,'tbl_toko');
			redirect('tl/view_store');
	}
	
   function hapus_store(){
     $id = $this->uri->segment(3);       
     $this->M_store->hapus_store($id) ;
        {
       		 redirect('tl/view_store');
        }
    }

public function view_bp_store()
	{
		$data['cetak1'] = $this->M_store->view_store_jaga();
		$data['content'] = 'tl/view_bp_store';
		$this->load->view('template',$data);
	}

	public function form_edit_jaga($kode_jaga){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$kode_jaga			= $this->input->post('kode_jaga');
			$data = array (

					'NIP_JAGA'			=> $this->input->post('nip'),
					'ID_TOKO_JAGA'		=> $this->input->post('toko')
			);
			$this->db->update('tbl_penjaga', $data, "AI_JAGA = '$kode_jaga'");
			redirect('tl/view_bp_store');
		}
		$data['cetak1'] = $this->db->query("SELECT * FROM tbl_toko");
		$data['cetak2'] = $this->db->query("SELECT * FROM tbl_pegawai WHERE LEVEL=2");
		$data['cetak3'] = $this->M_store->view_store_jaga_detail($kode_jaga);
		$data['content'] = 'tl/edit_bp_store';
		$this->load->view('template',$data);
	}

	public function view_report()
	{
		$this->load->view('template');
	}

	public function view_monthly_report()
	{
		$this->load->view('template');
	}					
}
