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
				'FOTO_PEG'			=> $file.'.jpg',
				'LEVEL'				=> '2'
			);
			
			$config['upload_path']          = './asset/item/';
			$config['allowed_types']        = 'jpg';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
	 
			$this->load->library('upload', $config);

			$this->upload->do_upload('gambar');

			$this->db->insert('tbl_pegawai', $data);
			redirect('tl/view_brand_presenter');
		}

		$data['kat'] = $this->db->query("SELECT * FROM tbl_penjaga");
		$data['content'] = 'Tl/add_brand_presenter';
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
				'STATUS_TOKO'		=> '1'
			);
			

			$this->db->insert('tbl_toko', $data);
			redirect('Tl/view_store');
		}

		$data['kat'] = $this->db->query("SELECT * FROM tbl_kategori");
		$data['content'] = 'Tl/add_store';
		$this->load->view('template', $data);
	}
	
	   public function hapus_toko() {
        if ($this->uri->segment(3) != null) {
            $ID_TOKO = $this->uri->segment(3);
            $kondisi = array('ID_TOKO' => $ID_TOKO);

            if ($this->M_store->hapus_toko($kondisi)) {
            	redirect('tl/view_store');
                echo "berhasil Menghapus data";
            } else {
                echo "gagal menghapus data";
            }
        }
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
