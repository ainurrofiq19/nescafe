<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_employee extends CI_Model{

public function view_employee()
 {
 	$sql = "SELECT NIP,NAMA_PEG,LEVEL,ALAMAT_PEG,TLP_PEG,EMAIL_PEG,JENIS_KELAMIN,FOTO_PEG,TGL_LAHIR,AKTIF, 
 	CASE 
 	WHEN LEVEL = '1' THEN 'Admin' 
 	WHEN LEVEL = '2' THEN 'Brand presenter' 
 	WHEN LEVEL = '3' THEN 'Team Leader' ELSE 'Supervisor' 
 	END 
 	FROM tbl_pegawai WHERE AKTIF='y'";

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
