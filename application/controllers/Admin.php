<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(array('View_of','M_item','M_item_request','M_employee','M_item_delivery','M_stock'));
	}

	public function index()
	{
		$data['content'] = 'admin/dasboard';
		$this->load->view('template', $data);
	}

	public function view_item()
	{
		$data['cetak1'] = $this->M_item->view_item();
		$data['content'] = 'Admin/view_item';
		$this->load->view('template', $data);
	}

	public function add_item()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$file = $this->input->post('code');
			$config['file_name'] = $file;

			$data = array (
				'ID_ITEM'			=> $this->input->post('code'),
				'NAMA_ITEM'			=> $this->input->post('item'),
				'HARGA_ITEM'		=> $this->input->post('harga'),
				'FOTO_ITEM'			=> $file.'.jpg',
				'AI_PRODUK'			=> $this->input->post('kategori'),
				'AKTIF'				=> 'y'
			);

			$config['upload_path']          = './asset/item/';
			$config['allowed_types']        = 'jpg';
			$config['max_size']             = 10000;
			$this->load->library('upload', $config);
			$this->upload->do_upload('gambar');

			$this->db->insert('tbl_item', $data);
			redirect('admin/view_item');
		}

		$data['kat'] = $this->db->query("SELECT * FROM tbl_kategori");
		$data['content'] = 'Admin/add_item';
		$this->load->view('template', $data);
	}

	public function edit_item($kode_item)
	{
		$files = glob('asset/temp/*');
		foreach ($files as $file)
		{
			if (is_file($file)) {
				unlink($file);
			}
		}

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$file = $this->input->post('code');
			$config['file_name'] = $file;
			$kode_gambar = $this->input->post('gambarasli');

			$config['upload_path']          = './asset/temp/';
			$config['allowed_types']        = 'jpg';
			$config['max_size']             = 10000;
			$config['max_width']            = 10240;
			$config['max_height']           = 7680;
			$this->load->library('upload', $config);
			$this->upload->do_upload('gambar');
			$size = filesize("asset/item/$kode_gambar");
			$size2 = filesize("asset/temp/$kode_gambar");
			sleep(1);

			if ($size == $size2) {
				$data = array (
					'ID_ITEM'			=> $this->input->post('code'),
					'NAMA_ITEM'			=> $this->input->post('item'),
					'HARGA_ITEM'		=> $this->input->post('harga'),
					'AI_PRODUK'			=> $this->input->post('kategori')
				);
				$this->db->update('tbl_item', $data, "ID_ITEM = '$kode_item'");
			}else {
				rename('asset/temp/'.$file.'.jpg', 'asset/item/'.$kode_gambar);
				rename('asset/item/'.$kode_gambar, 'asset/item/'.$file.'.jpg');
				$data = array (
					'ID_ITEM'			=> $this->input->post('code'),
					'NAMA_ITEM'			=> $this->input->post('item'),
					'HARGA_ITEM'		=> $this->input->post('harga'),
					'FOTO_ITEM'			=> $file.'.jpg',
					'AI_PRODUK'			=> $this->input->post('kategori')
				);
				$this->db->update('tbl_item', $data, "ID_ITEM = '$kode_item'");
				redirect('admin/view_item/'.$file);
			}
			redirect('admin/view_item');
		}
		$data['kat'] = $this->db->query("SELECT * FROM tbl_kategori");
		$data['content'] = 'Admin/edit_item';
		$data['item'] = $this->db->query("SELECT * FROM tbl_item WHERE ID_ITEM = '$kode_item'");
		$this->load->view('template', $data);
	}

  function hapus_item()
	{
     $id = $this->uri->segment(3);
     $this->M_item->hapus_item($id) ;
        {
       		 redirect('admin/view_item');
        }
  }


	public function view_item_request()
	{
		$data['cetak1'] = $this->M_item_request->view_item_request();
		$data['content'] = 'Admin/view_item_request';
		$this->load->view('template', $data);
	}

	public function accepting_item_request()
	{
		
		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		$data['lastcode'] = $this->db->query("SELECT * FROM tbl_permintaan ORDER BY KODE_PERMINTAAN DESC LIMIT 1");
		$data['kat'] = $this->db->query("SELECT * FROM tbl_toko");
		$data['bpkat'] = $this->db->query("SELECT * FROM tbl_pegawai WHERE LEVEL = 2 ");
		$data['cetak1'] = $this->M_item_request->view_item_request();
		$data['content'] = 'Admin/accepting_request';
		$this->load->view('template', $data);
	

	}


	public function accept_to_delive ($KODE_PERMINTAAN)
	{

		$set = $this->db->query("SELECT * FROM tbl_permintaan WHERE KODE_PERMINTAAN = '$KODE_PERMINTAAN' AND NAMA_PERMINTAAN IS NOT NULL ");
		// var_dump($set);
		
		date_default_timezone_set('Asia/Karachi'); # add your city to set local time zone
		$now = date('Y-m-d');


		$ambil_kode = $this->M_item_request->lastcode();

		$lastcode = $ambil_kode->KODE_PENGIRIMAN; 
		
	 
	    $a = 'MSD-SBY-DO-';
	    $b = date('Y-');
	    $c = '00';
	    $x = substr($lastcode,18);
	 
	    $kode = $a.$b.$c.($x+1);
		 
		 foreach ($set->result_array() as $data1) {


		$data  = array(
			'KODE_PENGIRIMAN'		=> $kode,
			'NAMA_PENGIRIMAN'		=> $data1['NAMA_PERMINTAAN'],
			'JUMLAH_PENGIRIMAN'		=> $data1['JUMLAH_PERMINTAAN'],
			'TGL_PENGIRIMAN'		=> $now,
			'TOKO_PENGIRIMAN'		=> $data1['TOKO_PERMINTAAN'],
			'BP_PENGIRIMAN'			=> $data1['BP_PERMINTAAN'],
			'STATUS_PENGIRIMAN'		=> '3'

		);
		$this->db->insert('tbl_pengiriman', $data);
	}

		$sql = "UPDATE tbl_permintaan
				SET STATUS_PERMINTAAN= 2
				WHERE KODE_PERMINTAAN ='".$KODE_PERMINTAAN."'
				";

		$result = $this->db->query($sql);
	redirect("Admin/accepting_item_request");
	}

	public function detail_item_request($KODE_PERMINTAAN) {
		$data['deliv'] = $this->M_item_request->find($KODE_PERMINTAAN);
		$data['cetak1'] = $this->M_item_request->view_item_request2($KODE_PERMINTAAN);
		$data['content'] = 'Admin/detail_item_request';
		$this->load->view('template', $data);
	}


	public function view_employee()
	{
		$data['cetak1'] = $this->M_employee->view_employee();
		$data['content'] = 'Admin/view_employee';
		$this->load->view('template', $data);
	}

	public function add_employee()
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
				'LEVEL'				=> $this->input->post('level'),
				'ALAMAT_PEG'		=> $this->input->post('alamatpeg'),
				'EMAIL_PEG'			=> $this->input->post('emailpeg'),
				'TLP_PEG'			=> $this->input->post('tlppeg'),
				'JENIS_KELAMIN'		=> $this->input->post('kelaminpeg'),
				'TGL_LAHIR'			=> $now,
				'FOTO_PEG'			=> $file.'.jpg',
				'LEVEL'				=> $this->input->post('jabatan'),
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
			redirect('admin/view_employee');
		}

		$data['kat'] = $this->db->query("SELECT * FROM tbl_toko");
		$data['content'] = 'Admin/add_employee';
		$this->load->view('template', $data);
	}

	public function edit_employee($kode_bp)
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
				'LEVEL'				=> $this->input->post('level'),
				'ALAMAT_PEG'		=> $this->input->post('alamatpeg'),
				'EMAIL_PEG'			=> $this->input->post('emailpeg'),
				'TLP_PEG'			=> $this->input->post('tlppeg'),
				'JENIS_KELAMIN'		=> $this->input->post('kelaminpeg'),
				'TGL_LAHIR'			=> $this->input->post('tgllahirpeg'),
				'TGL_MASUK'			=> $this->input->post('tglmasuk'),
				'LEVEL'				=> $this->input->post('jabatan'),
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
				'LEVEL'				=> $this->input->post('level'),
				'ALAMAT_PEG'		=> $this->input->post('alamatpeg'),
				'EMAIL_PEG'			=> $this->input->post('emailpeg'),
				'TLP_PEG'			=> $this->input->post('tlppeg'),
				'JENIS_KELAMIN'		=> $this->input->post('kelaminpeg'),
				'TGL_LAHIR'			=>$this->input->post('tgllahirpeg'),
				'TGL_MASUK'			=> $this->input->post('tglmasuk'),
				'FOTO_PEG'			=> $file.'.jpg',
				'LEVEL'				=> $this->input->post('jabatan'),
				'AKTIF'				=> 'y'
			);


			$this->db->update('tbl_pegawai', $data, "NIP = '$kode_bp'");
			redirect('admin/view_employee/'.$file);
		}

		redirect('admin/view_employee');
	}
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
        and tbl_pegawai.AKTIF='y'");
	$data['kat'] = $this->db->query("SELECT * FROM tbl_pegawai GROUP BY LEVEL" );
	$data['content'] = 'Admin/edit_employee';
	$data['bp'] = $this->db->query("SELECT * FROM tbl_pegawai WHERE NIP = '$kode_bp'");
	$this->load->view('template', $data);
}
function hapus_employee($NIP){
     $id = $this->uri->segment(3);
     $this->M_employee->hapus_employee($id) ;
        {
       		 redirect('admin/view_employee');
        }
    }

	public function detail_employee($NIP) {
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
        and tbl_pegawai.AKTIF='y'");

		$data['bp'] = $this->M_employee->find($NIP);
		// $data['cetak1'] = $this->M_brand_presenter->detail_brand_presenter();
		$data['content'] = 'Admin/detail_employee';
		$this->load->view('template', $data);
	}

	public function add_code_delivery()
	{
			$data = array (
				'KODE_PENGIRIMAN'		=> $this->input->post('code'),
				'TGL_PENGIRIMAN'		=> $this->input->post('tgl'),
				'TOKO_PENGIRIMAN'		=> $this->input->post('toko'),
				'BP_PENGIRIMAN'			=> $this->input->post('bp'),
				'STATUS_PENGIRIMAN'		=> "1"
			);

			$this->db->insert('tbl_pengiriman', $data);
			redirect('admin/add_item_delivery/'.$this->input->post('code'));

	}
	public function view_item_delivery()
	{
		$data['lastcode'] = $this->db->query("SELECT * FROM tbl_pengiriman ORDER BY KODE_PENGIRIMAN DESC LIMIT 1");
		$data['kat'] = $this->db->query("SELECT * FROM tbl_toko");
		$data['bpkat'] = $this->db->query("SELECT * FROM tbl_pegawai WHERE LEVEL = 2 ");
		$data['cetak1'] = $this->M_item_delivery->view_item_delivery();
		$data['content'] = 'Admin/view_item_delivery';
		$this->load->view('template', $data);
	}

	public function add_item_delivery($kode_kirim)
	{
		$data['tanda'] = 0;
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$tanggal = date("Y-m-d");
			$checkitem = $this->input->post('item');
			$data = array (
				'KODE_PENGIRIMAN'		=> $kode_kirim,
				'NAMA_PENGIRIMAN'		=> $this->input->post('item'),
				'JUMLAH_PENGIRIMAN'		=> $this->input->post('jumlah'),
				'TGL_PENGIRIMAN'		=> $tanggal,
				'TOKO_PENGIRIMAN'		=> $this->input->post('toko'),
				'BP_PENGIRIMAN'			=> $this->input->post('bp'),
				'STATUS_PENGIRIMAN'		=> "1"
			);

			$check = $this->db->query("SELECT * FROM tbl_pengiriman WHERE KODE_PENGIRIMAN = '$kode_kirim' AND NAMA_PENGIRIMAN = '$checkitem'");
			if ($check->num_rows() == 0) {
				$this->db->insert('tbl_pengiriman', $data);
			}else {
				$x = $this->input->post('id');
				$y = $this->input->post('jumlah');
				$this->db->query("UPDATE tbl_pengiriman SET JUMLAH_PENGIRIMAN = JUMLAH_PENGIRIMAN + $y WHERE ID_PENGIRIMAN = '$x'");
			}
			redirect('admin/add_item_delivery/'.$kode_kirim);
		}
		$data['code'] = $kode_kirim;
		$set = $this->db->query("SELECT * FROM tbl_pengiriman WHERE KODE_PENGIRIMAN = '$kode_kirim'");
		foreach ($set->result() as $print) {
			$data['bp'] = $print->BP_PENGIRIMAN;
			$data['toko'] = $print->TOKO_PENGIRIMAN;
		}
		$data['itkat'] = $this->db->query("SELECT * FROM tbl_item");
		$data['cetak1'] = $this->M_item_delivery->view_item_delivery2($kode_kirim);
		$data['content'] = 'Admin/add_item_delivery';

		$this->load->view('template', $data);
	}

	public function hapus_item_delivery($id,$kode_id)
{
	$this->db->delete('tbl_pengiriman', array('ID_PENGIRIMAN' => $id));
	redirect('Admin/add_item_delivery/'.$kode_id);
}


public function edit_item_delivery()
{
	if ($this->input->server('REQUEST_METHOD') == 'POST') {
		$a = $this->input->post('id_item');
		$b = $this->input->post('kode_item');

		$data = array (
			'JUMLAH_PENGIRIMAN'	=> $this->input->post('jumlah'),
		);

		$this->db->update('tbl_pengiriman', $data, "ID_PENGIRIMAN = '$a'");
		var_dump($a);

	redirect('Admin/add_item_delivery/'.$b);
	}
}

	public function add_item_delivery2($kode_kirim,$kode_item)
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$tanggal = date("Y-m-d");
			$data = array (
				'KODE_PENGIRIMAN'			=> $kode_kirim,
				'NAMA_PENGIRIMAN'		=> $this->input->post('item'),
				'JUMLAH_PENGIRIMAN'		=> $this->input->post('jumlah'),
				'TGL_PENGIRIMAN'		=> $tanggal,
				'TOKO_PENGIRIMAN'		=> $this->input->post('toko'),
				'BP_PENGIRIMAN'			=> $this->input->post('bp'),
				'STATUS_PENGIRIMAN'		=> $this->input->post('status')
			);


			$this->db->insert('tbl_pengiriman', $data);
			redirect('admin/add_item_delivery/'.$kode_kirim);
		}
		$data['code'] = $kode_kirim;
		$set = $this->db->query("SELECT * FROM tbl_pengiriman WHERE KODE_PENGIRIMAN = '$kode_kirim'");
		$data['tanda'] = $kode_item;
		foreach ($set->result() as $print) {
			$data['bp'] = $print->BP_PENGIRIMAN;
			$data['toko'] = $print->TOKO_PENGIRIMAN;
		}
		$data['itkat'] = $this->db->query("SELECT * FROM tbl_item");
		$data['cetak1'] = $this->M_item_delivery->view_item_delivery2($kode_kirim);
		$data['content'] = 'Admin/add_item_delivery';

		$this->load->view('template', $data);
	}

	public function update_item_delivery($kode_kirim)
	{
		$data['tanda'] = 0;
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$tanggal = date("Y-m-d");
			$checkitem = $this->input->post('item');
			$data = array (
				'KODE_PENGIRIMAN'		=> $kode_kirim,
				'NAMA_PENGIRIMAN'		=> $this->input->post('item'),
				'JUMLAH_PENGIRIMAN'		=> $this->input->post('jumlah'),
				'TGL_PENGIRIMAN'		=> $tanggal,
				'TOKO_PENGIRIMAN'		=> $this->input->post('toko'),
				'BP_PENGIRIMAN'			=> $this->input->post('bp'),
				'STATUS_PENGIRIMAN'		=> "1"
			);

			$check = $this->db->query("SELECT * FROM tbl_pengiriman WHERE KODE_PENGIRIMAN = '$kode_kirim' AND NAMA_PENGIRIMAN = '$checkitem'");
			if ($check->num_rows() == 0) {
				$this->db->insert('tbl_pengiriman', $data);
			}else {
				$x = $this->input->post('id');
				$y = $this->input->post('jumlah');
				$this->db->query("UPDATE tbl_pengiriman SET JUMLAH_PENGIRIMAN = JUMLAH_PENGIRIMAN + $y WHERE ID_PENGIRIMAN = '$x'");
			}
			redirect('admin/update_item_delivery/'.$kode_kirim);
		}
		$data['code'] = $kode_kirim;
		$set = $this->db->query("SELECT * FROM tbl_pengiriman WHERE KODE_PENGIRIMAN = '$kode_kirim'");
		foreach ($set->result() as $print) {
			$data['bp'] = $print->BP_PENGIRIMAN;
			$data['toko'] = $print->TOKO_PENGIRIMAN;
		}
		$data['itkat'] = $this->db->query("SELECT * FROM tbl_item");
		$data['cetak1'] = $this->M_item_delivery->view_item_delivery2($kode_kirim);
		$data['content'] = 'Admin/update_item_delivery';

		$this->load->view('template', $data);
	}

	public function update_item_delivery2($kode_kirim,$kode_item)
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$tanggal = date("Y-m-d");
			$data = array (
				'KODE_PENGIRIMAN'			=> $kode_kirim,
				'NAMA_PENGIRIMAN'		=> $this->input->post('item'),
				'JUMLAH_PENGIRIMAN'		=> $this->input->post('jumlah'),
				'TGL_PENGIRIMAN'		=> $tanggal,
				'TOKO_PENGIRIMAN'		=> $this->input->post('toko'),
				'BP_PENGIRIMAN'			=> $this->input->post('bp'),
				'STATUS_PENGIRIMAN'		=> $this->input->post('status')
			);


			$this->db->insert('tbl_pengiriman', $data);
			redirect('admin/update_item_delivery/'.$kode_kirim);
		}
		$data['code'] = $kode_kirim;
		$set = $this->db->query("SELECT * FROM tbl_pengiriman WHERE KODE_PENGIRIMAN = '$kode_kirim'");
		$data['tanda'] = $kode_item;
		foreach ($set->result() as $print) {
			$data['bp'] = $print->BP_PENGIRIMAN;
			$data['toko'] = $print->TOKO_PENGIRIMAN;
		}
		$data['itkat'] = $this->db->query("SELECT * FROM tbl_item");
		$data['cetak1'] = $this->M_item_delivery->view_item_delivery2($kode_kirim);
		$data['content'] = 'Admin/update_item_delivery';

		$this->load->view('template', $data);
	}

public function edit_item_delivery2()
{
	if ($this->input->server('REQUEST_METHOD') == 'POST') {
		$a = $this->input->post('id_item');
		$b = $this->input->post('kode_item');

		$data = array (
			'JUMLAH_PENGIRIMAN'	=> $this->input->post('jumlah'),
		);

		$this->db->update('tbl_pengiriman', $data, "ID_PENGIRIMAN = '$a'");
		var_dump($a);

	redirect('Admin/update_item_delivery/'.$b);
	}
}

public function hapus_item_delivery2($id,$kode_id)
{
	$this->db->delete('tbl_pengiriman', array('ID_PENGIRIMAN' => $id));
	redirect('Admin/update_item_delivery/'.$kode_id);
}
 function cencel_item_delivery($id)
	{
     $kode_kirim = $this->uri->segment(3);

     $this->M_item_delivery->cencel_item_delivery($kode_kirim) ;
        {
       		 redirect('admin/view_item_delivery');
        }
  }


	public function detail_item_delivery($KODE_PENGIRIMAN) {
		$data['deliv'] = $this->M_item_delivery->find($KODE_PENGIRIMAN);
		$data['cetak1'] = $this->M_item_delivery->view_item_delivery2($KODE_PENGIRIMAN);
		$data['content'] = 'Admin/detail_item_delivery';
		$this->load->view('template', $data);
	}

	public function view_stock()
	{
		$data['cetak1'] = $this->View_of->viewall("tbl_toko");
		$data['a'] = 2;
		$data['content'] = 'Admin/view_stock';
		$this->load->view('template', $data);
	}

	public function view_stock_toko()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$data['cetak1'] = $this->View_of->viewall("tbl_toko");
			$data['kode_toko'] = $this->input->post('toko');
			$data['a'] = 0;
			$data['cetak2'] = $this->M_stock->view_all_stock($data['kode_toko']);
			$data['cetak3'] = $this->M_stock->view_all_stock2($data['kode_toko']);
			$data['content'] = 'Admin/view_stock';
			$this->load->view('template', $data);
		}

	}

	public function view_mothly_report()
	{
		$this->load->view('template');
	}

}
