<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_store extends CI_Model{

public function view_store()
 {
 	$sql = "SELECT tbl_toko.ID_TOKO AS ID_TOKO, 
 		tbl_toko.NAMA_TOKO AS NAMA_TOKO, 
 		tbl_toko.ALAMAT_TOKO AS ALAMAT_TOKO,
 		tbl_toko.TLP_TOKO AS TELEPHONE_TOKO,
 		tbl_toko.KOTA_TOKO AS KOTA_TOKO,
 		tbl_toko.EMAIL_TOKO AS EMAIL_TOKO,
 		tbl_toko.STATUS_TOKO as STATUS_TOKO
 		FROM tbl_toko
 		WHERE tbl_toko.STATUS_TOKO='1'"
        ;

    $result = $this->db->query($sql);
    return $result->result();
}
public function edit($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
}


public function find($ID_TOKO)//للبحث عن رقم المنتج وتحقق من وجوده 
			//this is for find record id->product
		{ 
			$code = $this->db->where('ID_TOKO',$ID_TOKO)
							->limit(1)
							->get('tbl_toko');
			if ($code->num_rows() > 0 )
				{
					return $code->row();
				}else {
					return array();
				}//end if code->num_rows > 0 
				
		}//end function find
public function hapus_store($id){
	$sql= "UPDATE tbl_toko SET STATUS_TOKO ='2' WHERE ID_TOKO = '$id'";

	$result = $this->db->query($sql);
 }

}
