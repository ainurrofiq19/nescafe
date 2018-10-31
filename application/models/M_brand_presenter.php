<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_brand_presenter extends CI_Model{

public function view_brand_presenter()
 {
 	$sql = "SELECT 
 		NIP,NAMA_PEG,ALAMAT_PEG,TLP_PEG,EMAIL_PEG,JENIS_KELAMIN,FOTO_PEG,TGL_LAHIR,LEVEL
 	-- 	tbl_pegawai.NIP AS NIP, 
 	-- 	tbl_pegawai.NAMA_PEG AS NAMA, 
 	-- 	tbl_pegawai.ALAMAT_PEG AS ALAMAT,
  --       tbl_toko.NAMA_TOKO AS TOKO,
 	-- 	tbl_pegawai.TLP_PEG AS TELEPHONE,
 	-- 	tbl_pegawai.EMAIL_PEG AS EMAIL,
		-- tbl_pegawai.JENIS_KELAMIN AS JENIS_KELAMIN,
		-- tbl_pegawai.TGL_LAHIR AS TGL_LAHIR,
		-- tbl_pegawai.FOTO_PEG AS FOTO_PEG,
		-- tbl_pegawai.LEVEL AS LEVEL
 		FROM tbl_pegawai 
        WHERE LEVEL = 2 and tbl_pegawai.AKTIF='y'";

    $result = $this->db->query($sql);
    return $result->result();

 }

 public function hapus_brand_presenter($id){
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
				}//end if code->num_rows > 0 
				
		}//end function find


}
