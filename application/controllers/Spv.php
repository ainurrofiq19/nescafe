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



public function accepting_item_reture()
	{
		
		$data['cetak1'] = $this->M_item_reture->view_accepting_reture();
		$data['content'] = 'spv/view_accepting_item_reture';
		$this->load->view('template', $data);
	}

	public function accepting_item_reture2($kode_reture)
	{
		$usr = $this->session->userdata('nip');
		$test = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		
		foreach ($test->result_array() as $data) {
			$data1 = $data['ID_TOKO_JAGA'];

		}

		
	
			$kode = $kode_reture;

			$set = $this->db->query("SELECT * FROM tbl_reture WHERE KODE_RETURE = '$kode_reture' AND NAMA_RETURE IS NOT NULL ");
		
					foreach ($set->result_array() as $cetak1) {
					
							$ID_BARANG	= $cetak1['NAMA_RETURE'];
							$ID_STORE   = $cetak1['TOKO_RETURE'];
							echo 'id barang'.$ID_BARANG;

							 $test = $this->db->query("SELECT * FROM tbl_stok WHERE ID_BARANG = '$ID_BARANG' AND ID_STORE = '$ID_STORE'");
			

							 if ($test ->num_rows() > 0) {
						
										$data = array (
											'ID_BARANG'		=> $cetak1['NAMA_RETURE'],
											'JUMLAH'		=> $cetak1['JUMLAH_RETURE'],
											'ID_STORE'		=> $cetak1['TOKO_RETURE'],
										);
									
										$y = $data['JUMLAH'];
										$x = $data['ID_BARANG'];
										$z = $data['ID_STORE'];


										if ($x <> NULL AND $x <> '') {
											$sql= "UPDATE tbl_stok SET JUMLAH = JUMLAH - $y WHERE ID_BARANG = '$x' AND ID_STORE = '$z'";
											echo $sql;
											$result = $this->db->query($sql);
										}
							  		
							  }
							  var_dump($data);
							  // else{
									
									// 	$data = array (
									// 		'JUMLAH'		=> $cetak1['JUMLAH_PENGIRIMAN'],
									// 		'ID_BARANG'		=> $cetak1['NAMA_PENGIRIMAN'],
									// 		'ID_STORE'		=> $cetak1['TOKO_PENGIRIMAN'],
									// 	);
									// 	$x = $data['ID_BARANG'];
										
									// 	if ($x <> NULL AND $x <> '') {
									// 		$this->db->insert('tbl_stok', $data);
									// 	}							
							  // }
							 
				}
				
							$sql = "UPDATE tbl_reture
									SET STATUS_RETURE=2
									WHERE KODE_RETURE ='".$kode."'
									";

							$result = $this->db->query($sql);
			redirect("Spv/accepting_item_reture");

	}

public function detail_item_reture($KODE_RETURE) {
		$data['deliv'] = $this->M_item_reture->find($KODE_RETURE);
		$data['cetak1'] = $this->M_item_reture->view_item_reture2($KODE_RETURE);
		$data['content'] = 'Spv/detail_item_reture';
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
