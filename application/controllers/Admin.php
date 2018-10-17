<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(array('View_of','M_item','M_item_request','M_delivery_order','M_item_delivery'));
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
				'AI_PRODUK'			=> $this->input->post('kategori')
			);
			
			$config['upload_path']          = './asset/item/';
			$config['allowed_types']        = 'jpg';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
	 
			$this->load->library('upload', $config);

			$this->upload->do_upload('gambar');

			$this->db->insert('tbl_item', $data);
			redirect('admin/view_item');
		}

		$data['kat'] = $this->db->query("SELECT * FROM tbl_kategori");
		$data['content'] = 'Admin/add_item';
		$this->load->view('template', $data);
	}
	
    public function hapus_item() {
        if ($this->uri->segment(3) != null) {
            $ID_ITEM = $this->uri->segment(3);
            $kondisi = array('ID_ITEM' => $ID_ITEM);

            if ($this->M_item->hapus_item($kondisi)) {
            	redirect('admin/view_item');
                echo "berhasil Menghapus data";
            } else {
                echo "gagal menghapus data";
            }
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
		$this->load->view('template');
	}

	public function view_delivery_order()
	{
		$data['cetak1'] = $this->M_delivery_order->view_delivery_order();
		$data['content'] = 'Admin/view_delivery_order';
		$this->load->view('template', $data);
	}
	
	public function add_delivery_order()
	{
		$this->load->view('template');
	}
	
	public function view_item_delivery()
	{
		$data['cetak1'] = $this->M_item_delivery->view_item_delivery();
		$data['content'] = 'Admin/view_item_delivery';
		$this->load->view('template', $data);
	}

	public function add_item_delivery()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {


			$data = array (
				'ID_PENGIRIMAN'			=> $this->input->post('code'),
				'NAMA_PENGIRIMAN'		=> $this->input->post('item'),
				'JUMLAH_PENGIRIMAN'		=> $this->input->post('jumlah'),
				'TGL_PENGIRIMAN'		=> $this->input->post('tgl'),
				'TOKO_PENGIRIMAN'		=> $this->input->post('toko'),
				'BP_PENGIRIMAN'			=> $this->input->post('bp'),
				'STATUS_PENGIRIMAN'		=> $this->input->post('status')
			);


			$this->db->insert('tbl_pengiriman', $data);
			redirect('admin/view_item_delivery');
		}

		$data['itkat'] = $this->db->query("SELECT * FROM tbl_item");
		$data['kat'] = $this->db->query("SELECT * FROM tbl_toko");
		$data['bpkat'] = $this->db->query("SELECT * FROM tbl_pegawai");
		$data['content'] = 'Admin/add_item_delivery';
		$this->load->view('template', $data);
	}

	public function view_mothly_report()
	{
		$this->load->view('template');
	}
						
}

