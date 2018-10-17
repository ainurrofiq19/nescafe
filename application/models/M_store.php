<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_store extends CI_Model{

public function view_store()
 {
 	$sql = "SELECT tbl_toko.ID_TOKO AS ID_TOKO, 
 		tbl_toko.NAMA_TOKO AS NAMA_TOKO, 
 		tbl_toko.ALAMAT_TOKO AS ALAMAT_TOKO,
 		tbl_toko.TLP_TOKO AS TELEPHONE_TOKO
 		FROM tbl_toko
        ";

    $result = $this->db->query($sql);
    return $result->result();
}

 function hapus_toko($kondisi) {
 	 $this->db->where ($kondisi);
 	 return $this->db->delete ('tbl_toko');
 }

 

}
