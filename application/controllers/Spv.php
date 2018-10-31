<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spv extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(array('View_of','M_item_reture','M_news'));
	}

	public function index()
	{
		$data['content'] = 'spv/dasboard';
		$this->load->view('template', $data);
	}

	public function view_item_reture()
	{
		$data['cetak1'] = $this->M_item_reture->view_item_reture();
		$data['content'] = 'spv/view_item_reture';
		$this->load->view('template', $data);
	}

	public function accepting_item_reture()
	{
		$this->load->view('template');
	}

	public function view_news()
	{
		$data['cetak1'] = $this->M_news->view_news();
		$data['content'] = 'spv/view_news';
		$this->load->view('template', $data);
	}

	public function add_news()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			
			$file = $this->input->post('judul');
			$config['file_name'] = $file;

			$data = array (
				'ID_BERITA'			=> '',
				'JUDUL_BERITA'		=> $this->input->post('judul'),
				'ISI_BERITA'		=> $this->input->post('isi'),
				'FOTO_BERITA'		=> $file.'.jpg'
			);
			
			$config['upload_path']          = './asset/berita/';
			$config['allowed_types']        = 'jpg';
			$config['max_size']             = 10000;

	 
			$this->load->library('upload', $config);

			$this->upload->do_upload('gambar');

			$this->db->insert('tbl_berita', $data);
			redirect('spv/view_news');
		}

		$data['kat'] = $this->db->query("SELECT * FROM tbl_berita");
		$data['content'] = 'spv/add_news';
		$this->load->view('template', $data);
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
