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


public function edit_news($kode_news)
{
		$files = glob('asset/temp/*');
	foreach ($files as $file) 
	{
		if (is_file($file)) {
			unlink($file);
		}
	}
	if ($this->input->server('REQUEST_METHOD') == 'POST') {
		$kode_news = $this->input->post('ID_BERITA');
		$file = $this->input->post('judul');
		$config['file_name'] = $file;
		$kode_gambar = $this->input->post('gambarasli');

		$config['upload_path']          = './asset/temp/';
		$config['allowed_types']        = 'jpg';
		$config['max_size']             = 10000;
		$config['max_width']            = 10240;
		$config['max_height']           = 7680;

		$this->load->library('upload', $config);

		$this->upload->do_upload('gambar');

		$size = filesize("asset/berita/$kode_gambar");
		$size2 = filesize("asset/temp/$kode_gambar");
		sleep(1);

		echo $size."-";
		echo $size2;

		if ($size == $size2) {
			
			$data = array (
				'ID_BERITA'			=> '',
				'JUDUL_BERITA'		=> $this->input->post('judul'),
				'ISI_BERITA'		=> $this->input->post('isi')
				
			);
			$this->db->update('tbl_berita', $data, "ID_BERITA = '$kode_news'");
		}else {
			rename('asset/temp/'.$file.'.jpg', 'asset/berita/'.$kode_gambar);
			rename('asset/berita/'.$kode_gambar, 'asset/berita/'.$file.'.jpg');
			
			$data = array (
				'ID_BERITA'			=> '',
				'JUDUL_BERITA'		=> $this->input->post('judul'),
				'ISI_BERITA'		=> $this->input->post('isi'),
				'FOTO_BERITA'		=> $file.'.jpg'
			);


			$this->db->update('tbl_berita', $data, "ID_BERITA = '$kode_news'");
			redirect('spv/view_news/'.$file);
		}

		redirect('spv/view_news');
	}

	// $data['kat'] = $this->db->query("SELECT * FROM tbl_pegawai GROUP BY LEVEL" );
	$data['content'] = 'Spv/edit_news';
	$data['br'] = $this->db->query("SELECT * FROM tbl_berita WHERE ID_BERITA = '$kode_news'");
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
