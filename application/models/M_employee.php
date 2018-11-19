<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_employee extends CI_Model{

public function view_employee()
 {
 	$sql = "SELECT tbl_pegawai.NIP AS NIP, 
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
        WHERE tbl_pegawai.NIP=tbl_penjaga.NIP_JAGA
        AND tbl_penjaga.ID_TOKO_JAGA=tbl_toko.ID_TOKO
        AND tbl_pegawai.AKTIF='y'";

    $result = $this->db->query($sql);
    return $result->result();

 }
  public function hapus_employee($id){
	$sql= "UPDATE tbl_pegawai SET AKTIF ='n' WHERE NIP = '$id'";
		// var_dump($sql);
	$result = $this->db->query($sql);
}

public function find($NIP)//للبحث عن رقم المنتج وتحقق من وجوده 
			//this is for find record id->product
		{ 
			$code = $this->db->where('NIP',$NIP)
							->limit(1)
							->get('tbl_pegawai');
			if ($code->num_rows() > 0 )
				{
					return $code->row();
				}else {
					return array();
				}//end if code->num_rows >

		}
}
