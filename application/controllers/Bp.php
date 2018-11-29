<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bp extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(array('View_of','M_item_request','M_item_delivery','M_stock','M_item_reture','M_sellout'));
	}

	public function index()
	{
		$data['content'] = 'bp/dasboard';
		$this->load->view('template', $data);
	}


	public function view_item_request()
	{
		$usr = $this->session->userdata('nip');
		$test = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		foreach ($test->result_array() as $data) {
			$data['toko'] = $data['ID_TOKO_JAGA'];
		}
		$data['jaga'] = $this->db->query("SELECT * 
										FROM tbl_penjaga , tbl_pegawai , tbl_toko 
     									 WHERE tbl_penjaga.NIP_JAGA=tbl_pegawai.NIP
									        AND tbl_penjaga.ID_TOKO_JAGA =tbl_toko.ID_TOKO
											AND NIP_JAGA = '$usr' 
											LIMIT 1");

		$data['lastcode'] = $this->db->query("SELECT * FROM tbl_permintaan ORDER BY KODE_PERMINTAAN DESC LIMIT 1");
		$data['kat'] = $this->db->query("SELECT * FROM tbl_toko");
		$data['bpkat'] = $this->db->query("SELECT * FROM tbl_pegawai WHERE LEVEL = 2 ");
		$data['cetak1'] = $this->M_item_request->view_item_request1($data['toko']);
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

	public function view_item_sellout()
	{
		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query(
			"SELECT * FROM tbl_penjaga
			WHERE NIP_JAGA = '$usr'
			LIMIT 1");
			$jaga = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
			foreach ($jaga->result() as $key) {
				$tok = $key->ID_TOKO_JAGA;
			}

		$data['cetak1'] = $this->M_sellout->view_item_sellout($tok);
		$data['content'] = 'Bp/view_item_sellout';
		$this->load->view('template', $data);
	}

	public function add_sellout_date()
	{
		 $tgl = $this->input->post('tgl');
		 $toko = $this->input->post('toko');

		$check = $this->db->query("SELECT * FROM tbl_laporan WHERE LAPORAN_DATE = '$tgl' AND TOKO_JUAL = '$toko' LIMIT 1")->num_rows();
		if ($check == 1) {
			echo "Tanggal Sudah pernah ditambahkan";
			redirect('Bp/view_item_sellout');
		}else {
			$data = array (
				'LAPORAN_DATE'		=> $this->input->post('tgl'),
				'TOKO_JUAL'		=> $this->input->post('toko'),
			);

			$this->db->insert('tbl_laporan', $data);
			redirect('Bp/add_sellout_item/'."$tgl");
		}

	}

	public function add_sellout_item($kode_lapor)
	{

		$data['code'] = $kode_lapor;

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$tanggal = date("Y-m-d");
			$checkitem = $this->input->post('item');
			$data = array (

				'ID_LAPORAN'		=> $this->input->post('ai_lapor'),
				'ITEM_JUAL' 	=> $this->input->post('item'),
				'HARGA_JUAL' 	=> $this->input->post('harga'),
				'JUMLAH_JUAL' 	=> $this->input->post('jumlah'),
			);
			$set_ai_lapor = $this->input->post('ai_lapor');
			$brg = $this->input->post('item');
			$tok = $this->input->post('toko');
			$checkjumlah = $this->input->post('jumlah');
			$check = $this->db->query("SELECT * FROM tbl_isi_laporan WHERE ID_LAPORAN = '$set_ai_lapor' AND ITEM_JUAL = '$checkitem'");
			if ($check->num_rows() == 0) {

				$stock = $this->db->query("SELECT * FROM tbl_stok WHERE ID_BARANG = '$brg' AND ID_STORE = '$tok' LIMIT 1");

				foreach ($stock->result() as $key1) {
					$jstok = $key1->JUMLAH;
				}

					if ($checkjumlah > $jstok) {
						echo "string";
					}else{
						$this->db->insert('tbl_isi_laporan', $data);
					}

			}else {
				$x = $this->input->post('id');
				$y = $this->input->post('jumlah');
				$this->db->query("UPDATE tbl_isi_laporan SET JUMLAH_JUAL = JUMLAH_JUAL + $y WHERE AI_ISI_LAPORAN = '$x'");
			}
			redirect('Bp/add_sellout_item/'.$kode_lapor);
		}

		$set = $this->db->query("SELECT * FROM tbl_laporan WHERE LAPORAN_DATE = '$kode_lapor'");
		foreach ($set->result() as $print) {
			$data['toko'] = $print->TOKO_JUAL;
			$data['ai_lapor'] = $print->AI_LAPORAN;
			$data['tgl_lapor'] = $print->LAPORAN_DATE;
		}

		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		$jaga = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		foreach ($jaga->result() as $key) {
			$tok = $key->ID_TOKO_JAGA;
		}
		$data['itkat'] = $this->db->query("SELECT * FROM tbl_stok WHERE ID_STORE = '$tok' ");

		$data['cetak1'] = $this->M_sellout->view_item_sellout2($kode_lapor);

		$data['content'] = 'Bp/add_item_sellout';
		$this->load->view('template', $data);

	}

	public function update_item_sellout($tgl_lapor,$kode_lapor)
	{
		$data['tanda'] = 0;
		$data['code'] = $kode_lapor;

		$set = $this->db->query("SELECT * FROM tbl_laporan WHERE LAPORAN_DATE = '$kode_lapor'");
		foreach ($set->result() as $print) {
			$data['toko'] = $print->TOKO_JUAL;
			$data['ai_lapor'] = $print->AI_LAPORAN;
			$data['tgl_lapor'] = $print->LAPORAN_DATE;
		}

		$usr = $this->session->userdata('nip');
		$data['jaga'] = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		$jaga = $this->db->query("SELECT * FROM tbl_penjaga WHERE NIP_JAGA = '$usr' LIMIT 1");
		foreach ($jaga->result() as $key) {
			$tok = $key->ID_TOKO_JAGA;
		}
		$data['itkat'] = $this->db->query("SELECT * FROM tbl_stok WHERE ID_STORE = '$tok' ");
		$data['tanda'] = $kode_lapor;
		$data['cetak1'] = $this->M_sellout->view_item_sellout2($kode_lapor);
		$data['content'] = 'Bp/update_item_sellout';
		$this->load->view('template', $data);
	}

	function cancel_sellout($id,$toko)
	{
		$kode_kirim = $this->uri->segment(3);
		$this->M_sellout->cancel_sellout($id,$toko) ;
		redirect('Bp/view_item_sellout');
	}

	public function hapus_item_sellout2($id,$kode_id)
	{
		$this->db->delete('tbl_isi_laporan', array('AI_ISI_LAPORAN' => $id));
		redirect('Bp/add_sellout_item/'.$kode_id);
	}

	public function export($tgl)
{

$cetak = $this->M_sellout->view_item_sellout2($tgl);
// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator('Andoyo - Java Web Media')
->setLastModifiedBy('Andoyo - Java Web Medi')
->setTitle('Office 2007 XLSX Test Document')
->setSubject('Office 2007 XLSX Test Document')
->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
->setKeywords('office 2007 openxml php')
->setCategory('Test result file');

// Add some data
$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A1', 'LAPORAN PENJUALAN')
->setCellValue('A2', 'TANGGAL :'.$tgl)
->setCellValue('A4', 'NAMA ITEM')
->setCellValue('B4', 'TERJUAL')
->setCellValue('C4', 'QTY')
->setCellValue('D4', 'TOTAL')
;

// Miscellaneous glyphs, UTF-8
$hargatotal = 0 ; $jumlahtotal = 0 ;$total = 0 ;
$i=5; foreach($cetak as $cetak_detail) {
	$hargatotal += $cetak_detail->HARGA_JUAL;
	$jumlahtotal += $cetak_detail->JUMLAH_JUAL;
	$total += $cetak_detail->JUMLAH_JUAL*$cetak_detail->HARGA_JUAL;
	$tot = $cetak_detail->JUMLAH_JUAL*$cetak_detail->HARGA_JUAL;

$spreadsheet->setActiveSheetIndex(0)
->setCellValue('A'.$i, $cetak_detail->ITEM_JUAL)
->setCellValue('B'.$i, $cetak_detail->HARGA_JUAL)
->setCellValue('C'.$i, $cetak_detail->JUMLAH_JUAL)
->setCellValue('D'.$i, $tot);

$i++;
}

// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Report Excel.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
	}

}
