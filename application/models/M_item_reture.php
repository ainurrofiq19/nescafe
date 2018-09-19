<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_item_reture extends CI_Model{

public function view_item_reture()
 {
 	$sql = "SELECT tbl_reture.ID_reture AS ID_RETURE, 
 		tbl_item.NAMA_ITEM AS NAMA_RETURE, 
 		tbl_reture.JUMLAH_RETURE AS QTY,
 		tbl_reture.TGL_RETURE AS TANGGAL,
 		tbl_toko.NAMA_TOKO AS TOKO,
		tbl_pegawai.NAMA_PEG AS BP,
		tbl_reture.STATUS_RETURE AS STATUS
 		FROM tbl_reture , tbl_item , tbl_pegawai , tbl_toko
        WHERE tbl_reture.NAMA_RETURE=tbl_item.ID_ITEM AND tbl_reture.TOKO_RETURE=tbl_toko.ID_TOKO AND tbl_reture.BP_RETURE=tbl_pegawai.NIP";

    $result = $this->db->query($sql);
    return $result->result();


 }

}
