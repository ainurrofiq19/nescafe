<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_item_request extends CI_Model{

public function view_item_request()
 {
 	$sql = "SELECT tbl_permintaan.ID_PERMINTAAN AS ID_PERMINTAAN, 
 		tbl_item.NAMA_ITEM AS NAMA_PERMINTAAN, 
 		tbl_permintaan.JUMLAH_PERMINTAAN AS QTY,
 		tbl_permintaan.TGL_PERMINTAAN AS TANGGAL,
 		tbl_toko.NAMA_TOKO AS TOKO,
		tbl_pegawai.NAMA_PEG AS BP,
		tbl_permintaan.STATUS AS STATUS
 		FROM tbl_permintaan , tbl_item , tbl_pegawai , tbl_toko
        WHERE tbl_permintaan.NAMA_PERMINTAAN=tbl_item.ID_ITEM AND tbl_permintaan.TOKO_PERMINTAAN=tbl_toko.ID_TOKO AND tbl_permintaan.BP_PERMINTAAN=tbl_pegawai.NIP";

    $result = $this->db->query($sql);
    return $result->result();


 }

}
