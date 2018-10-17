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
        WHERE LEVEL = 2";

    $result = $this->db->query($sql);
    return $result->result();



 }

}
