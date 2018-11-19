<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bp extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(array('View_of','M_item_request','M_item_delivery','M_stock','M_item_reture'));
	}

	public function index()
	{
		$data['content'] = 'bp/dasboard';
		$this->load->view('template', $data);
	}


	public function view_item_request()
	{
		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query("SELECT * 
										FROM tbl_penjaga , tbl_pegawai , tbl_toko 
     									 WHERE tbl_penjaga.NIP_JAGA=tbl_pegawai.NIP
									        AND tbl_penjaga.ID_TOKO_JAGA =tbl_toko.ID_TOKO
											AND NIP_JAGA = '$usr' 
											LIMIT 1");

		$data['lastcode'] = $this->db->query("SELECT * FROM tbl_permintaan ORDER BY KODE_PERMINTAAN DESC LIMIT 1");
		$data['kat'] = $this->db->query("SELECT * FROM tbl_toko");
		$data['bpkat'] = $this->db->query("SELECT * FROM tbl_pegawai WHERE LEVEL = 2 ");
		$data['cetak1'] = $this->M_item_request->view_item_request();
		$data['content'] = 'Bp/view_item_request';
		$this->load->view('template', $data);
	}
	public function add_code_request()
	{
			$data = array (
				'KODE_PERMINTAAN'		=> $this->input->post('code'),
				'TGL_PERMINTAAN'		=> $this->input->post('tgl'),
				'TOKO_PERMINTAAN'		=> $this->input->post('toko'),
				'BP_PERMINTAAN'			=> $this->input->post('bp'),
				'STATUS_PERMINTAAN'		=> "1"
			);

			$this->db->insert('tbl_permintaan', $data);
			redirect('Bp/add_item_request/'.$this->input->post('code'));
	}

	public function add_item_request($kode_kirim)
	{
		$data['tanda'] = 0;
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$tanggal = date("Y-m-d");
			$checkitem = $this->input->post('item');
			$data = array (
				'KODE_PERMINTAAN'		=> $kode_kirim,
				'NAMA_PERMINTAAN'		=> $this->input->post('item'),
				'JUMLAH_PERMINTAAN'		=> $this->input->post('jumlah'),
				'TGL_PERMINTAAN'		=> $tanggal,
				'TOKO_PERMINTAAN'		=> $this->input->post('toko'),
				'BP_PERMINTAAN'			=> $this->input->post('bp'),
				'STATUS_PERMINTAAN'		=> "1"
			);

			$check = $this->db->query("SELECT * FROM tbl_permintaan WHERE KODE_PERMINTAAN = '$kode_kirim' AND NAMA_PERMINTAAN = '$checkitem'");
			if ($check->num_rows() == 0) {
				$this->db->insert('tbl_permintaan', $data);
			}else {
				$x = $this->input->post('id');
				$y = $this->input->post('jumlah');
				$this->db->query("UPDATE tbl_permintaan SET JUMLAH_PERMINTAAN = JUMLAH_PERMINTAAN + $y WHERE ID_PERMINTAAN = '$x'");
			}
			redirect('Bp/add_item_request/'.$kode_kirim);
		}
		$data['code'] = $kode_kirim;
		$set = $this->db->query("SELECT * FROM tbl_permintaan WHERE KODE_PERMINTAAN = '$kode_kirim'");
		foreach ($set->result() as $print) {
			$data['bp'] = $print->BP_PERMINTAAN;
			$data['toko'] = $print->TOKO_PERMINTAAN;
		}
		$data['itkat'] = $this->db->query("SELECT * FROM tbl_item");
		$data['cetak1'] = $this->M_item_request->view_item_request2($kode_kirim);
		$data['content'] = 'Bp/add_item_request';

		$this->load->view('template', $data);
	}

	function cancel_item_request($id)
	 {
			$kode_kirim = $this->uri->segment(3);

			$this->M_item_request->cancel_item_request($kode_kirim) ;
				 {
						redirect('Bp/view_item_request');
				 }
	 }

	public function update_item_request($kode_minta)
	{

		$data['tanda'] = 0;
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			echo "string";
			$tanggal = date("Y-m-d");
			$checkitem = $this->input->post('item');
			$data = array (
				'KODE_PERMINTAAN'		=> $kode_minta,
				'NAMA_PERMINTAAN'		=> $this->input->post('item'),
				'JUMLAH_PERMINTAAN'	=> $this->input->post('jumlah'),
				'TGL_PERMINTAAN'		=> $tanggal,
				'TOKO_PERMINTAAN'		=> $this->input->post('toko'),
				'BP_PERMINTAAN'			=> $this->input->post('bp'),
				'STATUS_PERMINTAAN'		=> "1"
			);

			$check = $this->db->query("SELECT * FROM tbl_permintaan WHERE KODE_PERMINTAAN = '$kode_minta' AND NAMA_PERMINTAAN= '$checkitem'");
			if ($check->num_rows() == 0) {
				$this->db->insert('tbl_permintaan', $data);
			}else {
				$x = $this->input->post('id');
				$y = $this->input->post('jumlah');
				$this->db->query("UPDATE tbl_permintaan SET JUMLAH_PERMINTAAN = JUMLAH_PERMINTAAN + $y WHERE ID_PERMINTAAN = '$x'");
			}
			redirect('Bp/update_item_request/'.$kode_minta);

		}

		$data['code'] = $kode_minta;
		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		$data['itkat'] = $this->db->query("SELECT * FROM tbl_item");
		$data['cetak1'] = $this->M_item_request->view_item_request2($kode_minta);
		$data['content'] = 'Bp/update_item_request';

		$this->load->view('template', $data);
	}

	public function update_item_request2($kode_kirim,$kode_item)
	{
		$data['tanda'] = 0;
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$tanggal = date("Y-m-d");
			$data = array (
				'KODE_PERMINTAAN'			=> $kode_kirim,
				'NAMA_PERMINTAAN'		=> $this->input->post('item'),
				'JUMLAH_PERMINTAAN'		=> $this->input->post('jumlah'),
				'TGL_PERMINTAAN'		=> $tanggal,
				'TOKO_PERMINTAAN'		=> $this->input->post('toko'),
				'BP_PERMINTAAN'			=> $this->input->post('bp'),
				'STATUS_PERMINTAAN'		=> $this->input->post('status')
			);


			$this->db->insert('tbl_permintaan', $data);
			redirect('Bp/update_item_request/'.$kode_kirim);
		}
		$data['code'] = $kode_kirim;
		$set = $this->db->query("SELECT * FROM tbl_permintaan WHERE KODE_PERMINTAAN = '$kode_kirim'");
		$data['tanda'] = $kode_item;
		echo $kode_item;
		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		$data['itkat'] = $this->db->query("SELECT * FROM tbl_item");
		$data['cetak1'] = $this->M_item_request->view_item_request2($kode_kirim);
		$data['content'] = 'Bp/update_item_request';

		$this->load->view('template', $data);
	}

	public function edit_item_request2()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$a = $this->input->post('id_item');
			$b = $this->input->post('kode_item');

			$data = array (
				'JUMLAH_PERMINTAAN'	=> $this->input->post('jumlah'),
			);

			$this->db->update('tbl_permintaan', $data, "ID_PERMINTAAN = '$a'");
			var_dump($a);

		redirect('Bp/update_item_request/'.$b);
		}
	}

	public function hapus_item_request2($id,$kode_id)
	{
		$this->db->delete('tbl_permintaan', array('ID_PERMINTAAN' => $id));
		redirect('Bp/update_item_request/'.$kode_id);
	}

	public function detail_item_request($KODE_PERMINTAAN) {
		$data['deliv'] = $this->M_item_request->find($KODE_PERMINTAAN);
		$data['cetak1'] = $this->M_item_request->view_item_request2($KODE_PERMINTAAN);
		$data['content'] = 'Bp/detail_item_request';
		$this->load->view('template', $data);
	}



	public function view_item_delivery()
	{
		$data['cetak1'] = $this->M_item_delivery->view_item_delivery();
		$data['content'] = 'bp/view_item_delivery';
		$this->load->view('template', $data);
	}

	public function accepting_item_delivery()
	{
		$usr = $this->session->userdata('nip');
		$test = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		foreach ($test->result_array() as $data) {
			$data['toko'] = $data['ID_TOKO_JAGA'];
		}
		$data['cetak1'] = $this->M_item_delivery->view_accepting_delivery($data['toko']);
		$data['content'] = 'bp/view_accepting_delivery';
		$this->load->view('template', $data);
	}

	public function accepting_item_delivery2($kode_delivery)
	{
		$usr = $this->session->userdata('nip');
		$test = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		
		foreach ($test->result_array() as $data) {
			$data1 = $data['ID_TOKO_JAGA'];

		}
	
			$kode = $kode_delivery;
			$set = $this->db->query("SELECT * FROM tbl_pengiriman WHERE KODE_PENGIRIMAN = '$kode_delivery' AND NAMA_PENGIRIMAN IS NOT NULL ");
		
					foreach ($set->result_array() as $cetak1) {
					
							$ID_BARANG	= $cetak1['NAMA_PENGIRIMAN'];
							$ID_STORE   = $cetak1['TOKO_PENGIRIMAN'];
							echo 'id barang'.$ID_BARANG;

							 $test = $this->db->query("SELECT * FROM tbl_stok WHERE ID_BARANG = '$ID_BARANG' AND ID_STORE = '$ID_STORE'");


							 if ($test ->num_rows() > 0) {
						
										$data = array (
											'ID_BARANG'		=> $cetak1['NAMA_PENGIRIMAN'],
											'JUMLAH'		=> $cetak1['JUMLAH_PENGIRIMAN'],
											'ID_STORE'		=> $cetak1['TOKO_PENGIRIMAN'],
										);
									
										$y = $data['JUMLAH'];
										$x = $data['ID_BARANG'];
										$z = $data['ID_STORE'];


										if ($x <> NULL AND $x <> '') {
											$sql= "UPDATE tbl_stok SET JUMLAH = JUMLAH + $y WHERE ID_BARANG = '$x' AND ID_STORE = '$z'";
											echo $sql;
											$result = $this->db->query($sql);
										}
							  		
							  }else{
									
										$data = array (
											'JUMLAH'		=> $cetak1['JUMLAH_PENGIRIMAN'],
											'ID_BARANG'		=> $cetak1['NAMA_PENGIRIMAN'],
											'ID_STORE'		=> $cetak1['TOKO_PENGIRIMAN'],
										);
										$x = $data['ID_BARANG'];
										
										if ($x <> NULL AND $x <> '') {
											$this->db->insert('tbl_stok', $data);
										}							
							  }
							 
				}
				
							$sql = "UPDATE tbl_pengiriman
									SET STATUS_PENGIRIMAN=2
									WHERE KODE_PENGIRIMAN ='".$kode."'
									";

							$result = $this->db->query($sql);
			redirect("Bp/accepting_item_delivery");

	}

	public function detail_item_delivery($KODE_PENGIRIMAN) {
		$data['deliv'] = $this->M_item_delivery->find($KODE_PENGIRIMAN);
		$data['cetak1'] = $this->M_item_delivery->view_item_delivery2($KODE_PENGIRIMAN);
		$data['content'] = 'Bp/detail_item_delivery';
		$this->load->view('template', $data);
	}

public function view_stock()
	{
		$usr = $this->session->userdata('nip');
		$test = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		foreach ($test->result_array() as $data) {
			$data['toko'] = $data['ID_TOKO_JAGA'];
		}

		$data['cetak2'] = $this->M_stock->view_all_stock($data['toko']);
		$data['content'] = 'Bp/view_stock';
		$this->load->view('template', $data);
	}

	public function view_item_reture()
	{
		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query(
			"SELECT * FROM tbl_penjaga
			WHERE NIP_JAGA = '$usr'
			LIMIT 1");
		$data['lastcode'] = $this->db->query("SELECT * FROM tbl_reture ORDER BY KODE_RETURE DESC LIMIT 1");

		$data['cetak1'] = $this->M_item_reture->view_item_reture();
		$data['content'] = 'Bp/view_item_reture';
		$this->load->view('template', $data);
	}

	public function add_code_reture()
	{
			$data = array (
				'KODE_RETURE'		=> $this->input->post('code'),
				'TGL_RETURE'		=> $this->input->post('tgl'),
				'TOKO_RETURE'		=> $this->input->post('toko'),
				'BP_RETURE'			=> $this->input->post('bp'),
				'STATUS_RETURE'		=> "1"
			);

			$this->db->insert('tbl_reture', $data);
			redirect('Bp/add_item_reture/'.$this->input->post('code'));
	}

	public function add_item_reture($kode_reture)
	{
		$data['tanda'] = 0;
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$tanggal = date("Y-m-d");
			$checkitem = $this->input->post('item');
			$data = array (
				'KODE_RETURE'		=> $kode_reture,
				'NAMA_RETURE'		=> $this->input->post('item'),
				'JUMLAH_RETURE' 	=> $this->input->post('jumlah'),
				'TGL_RETURE'		=> $tanggal,
				'TOKO_RETURE'		=> $this->input->post('toko'),
				'BP_RETURE'			=> $this->input->post('bp'),
				'STATUS_RETURE'		=> "1"
			);

			$brg = $this->input->post('item');
			$tok = $this->input->post('toko');
			$checkjumlah = $this->input->post('jumlah');
			$check = $this->db->query("SELECT * FROM tbl_reture WHERE KODE_RETURE = '$kode_reture' AND NAMA_RETURE = '$checkitem'");
			if ($check->num_rows() == 0) {

				$stock = $this->db->query("SELECT * FROM tbl_stok WHERE ID_BARANG = '$brg' AND ID_STORE = '$tok' LIMIT 1");
				
				foreach ($stock->result() as $key1) {
					$jstok = $key1->JUMLAH;
				}

					if ($checkjumlah > $jstok) {
						echo "string";
					}else{
						$this->db->insert('tbl_reture', $data);
					}

			}else {
				$x = $this->input->post('id');
				$y = $this->input->post('jumlah');
				$this->db->query("UPDATE tbl_reture SET JUMLAH_RETURE = JUMLAH_RETURE + $y WHERE ID_RETURE = '$x'");
			}
			redirect('Bp/add_item_reture/'.$kode_reture);
		}
		$data['code'] = $kode_reture;
		$set = $this->db->query("SELECT * FROM tbl_reture WHERE KODE_RETURE = '$kode_reture'");
		foreach ($set->result() as $print) {
			$data['bp'] = $print->BP_RETURE;
			$data['toko'] = $print->TOKO_RETURE;
		}

		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		$jaga = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		foreach ($jaga->result() as $key) {
			$tok = $key->ID_TOKO_JAGA;
		}
		$data['itkat'] = $this->db->query("SELECT * FROM tbl_stok WHERE ID_STORE = '$tok' ");

		$data['cetak1'] = $this->M_item_reture->view_item_reture2($kode_reture);
		$data['content'] = 'Bp/add_item_reture';

		$this->load->view('template', $data);
	}

	function cancel_item_reture($id)
	{
		$kode_kirim = $this->uri->segment(3);
		$this->M_item_reture->cancel_item_reture($kode_kirim) ;
		redirect('Bp/view_item_reture');
	}

	public function update_item_reture($kode_minta)
	{
		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		$jaga = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		foreach ($jaga->result() as $key) {
			$tok = $key->ID_TOKO_JAGA;
		}

		$data['tanda'] = 0;
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$brg = $this->input->post('item');
			$checkjumlah = $this->input->post('jumlah');
			$stock = $this->db->query("SELECT * FROM tbl_stok WHERE ID_BARANG = '$brg' AND ID_STORE = '$tok' LIMIT 1");
			foreach ($stock->result() as $key1) {
				$jstok = $key1->JUMLAH;
			}
			if ($checkjumlah > $jstok) {
				echo "stok kurang";
			}else {
				$tanggal = date("Y-m-d");
				$checkitem = $this->input->post('item');
				$data = array (
					'KODE_RETURE'		=> $kode_minta,
					'NAMA_RETURE'		=> $this->input->post('item'),
					'JUMLAH_RETURE'	=> $this->input->post('jumlah'),
					'TGL_RETURE'		=> $tanggal,
					'TOKO_RETURE'		=> $this->input->post('toko'),
					'BP_RETURE'			=> $this->input->post('bp'),
					'STATUS_RETURE'		=> "1"
				);

				$check = $this->db->query("SELECT * FROM tbl_reture WHERE KODE_RETURE = '$kode_minta' AND NAMA_RETURE= '$checkitem'");
				if ($check->num_rows() == 0) {
					$this->db->insert('tbl_reture', $data);
				}else {
					$x = $this->input->post('id');
					$y = $this->input->post('jumlah');
					$this->db->query("UPDATE tbl_reture SET JUMLAH_RETURE = JUMLAH_RETURE + $y WHERE ID_RETURE = '$x'");
				}
				redirect('Bp/update_item_reture/'.$kode_minta);
			}


		}
		$data['tanda'] = 0;
		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		$jaga = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		foreach ($jaga->result() as $key) {
			$tok = $key->ID_TOKO_JAGA;
		}

		$data['code'] = $kode_minta;

		$data['itkat'] = $this->db->query("SELECT * FROM tbl_stok WHERE ID_STORE = '$tok' ");
		$data['cetak1'] = $this->M_item_reture->view_item_reture2($kode_minta);
		$data['content'] = 'Bp/update_item_reture';

		$this->load->view('template', $data);
	}

	public function update_item_reture2($kode_kirim,$kode_item)
	{
		$usr = $this->session->userdata('nip');
		$data['tanda'] = 0;
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$brg = $this->input->post('item');
			$checkjumlah = $this->input->post('jumlah');
			$jaga = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
			foreach ($jaga->result() as $key) {
				$tok = $key->ID_TOKO_JAGA;
			}
			$stock = $this->db->query("SELECT * FROM tbl_stok WHERE ID_BARANG = '$brg' AND ID_STORE = '$tok' LIMIT 1");
			foreach ($stock->result() as $key1) {
				$jstok = $key1->JUMLAH;
			}
			if ($checkjumlah > $jstok) {
				echo "stok kurang";
			}else {
				$tanggal = date("Y-m-d");
				$data = array (
					'KODE_RETURE'			=> $kode_kirim,
					'NAMA_RETURE'		=> $this->input->post('item'),
					'JUMLAH_RETURE'		=> $this->input->post('jumlah'),
					'TGL_RETURE'		=> $tanggal,
					'TOKO_RETURE'		=> $this->input->post('toko'),
					'BP_RETURE'			=> $this->input->post('bp'),
					'STATUS_RETURE'		=> $this->input->post('status')
				);


				$this->db->insert('tbl_reture', $data);
				redirect('Bp/update_item_reture/'.$kode_kirim);
			}
		}
		$data['code'] = $kode_kirim;
		$set = $this->db->query("SELECT * FROM tbl_permintaan WHERE KODE_PERMINTAAN = '$kode_kirim'");
		$data['tanda'] = $kode_item;
		echo $kode_item;
		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		$data['itkat'] = $this->db->query("SELECT * FROM tbl_item");
		$data['cetak1'] = $this->M_item_reture->view_item_reture2($kode_kirim);
		$data['content'] = 'Bp/update_item_reture';

		$this->load->view('template', $data);
	}

	public function edit_item_reture2()
	{
		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		$jaga = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		foreach ($jaga->result() as $key) {
			$tok = $key->ID_TOKO_JAGA;
		}
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$brg = $this->input->post('brg');
			$checkjumlah = $this->input->post('jumlah');
			$stock = $this->db->query("SELECT * FROM tbl_stok WHERE ID_BARANG = '$brg' AND ID_STORE = '$tok' LIMIT 1");
			foreach ($stock->result() as $key1) {
				$jstok = $key1->JUMLAH;
			}
			if ($checkjumlah > $jstok) {
				echo "stok kurang";
				$b = $this->input->post('kode_item');
				redirect('Bp/update_item_reture/'.$b);
			}else {
				$a = $this->input->post('id_item');
				$b = $this->input->post('kode_item');

				$data = array (
					'JUMLAH_RETURE'	=> $this->input->post('jumlah'),
				);

				$this->db->update('tbl_reture', $data, "ID_RETURE = '$a'");
				var_dump($a);

				redirect('Bp/update_item_reture/'.$b);
			}
		}
	}

	public function hapus_item_reture2($id,$kode_id)
	{
		$this->db->delete('tbl_reture', array('ID_RETURE' => $id));
		redirect('Bp/update_item_reture/'.$kode_id);
	}
	public function detail_item_reture($KODE_RETURE) {
		$data['deliv'] = $this->M_item_reture->find($KODE_RETURE);
		$data['cetak1'] = $this->M_item_reture->view_item_reture2($KODE_RETURE);
		$data['content'] = 'Bp/detail_item_reture';
		$this->load->view('template', $data);
	}

	public function view_report()
	{
		$this->load->view('template');
	}

		public function add_report()
	{
		$this->load->view('template');
	}
}
