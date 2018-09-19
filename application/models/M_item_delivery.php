<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_item_delivery extends CI_Model{

public function view_item_delivery()
 {
 	$sql = "SELECT tbl_pengiriman.ID_PENGIRIMAN AS ID_PENGIRIMAN, 
 		tbl_item.NAMA_ITEM AS NAMA_PENGIRIMAN, 
 		tbl_pengiriman.JUMLAH_PENGIRIMAN AS QTY,
 		tbl_pengiriman.TGL_PENGIRIMAN AS TANGGAL,
 		tbl_toko.NAMA_TOKO AS TOKO,
		tbl_pegawai.NAMA_PEG AS BP,
		tbl_pengiriman.STATUS_PENGIRIMAN AS STATUS
 		FROM tbl_pengiriman , tbl_item , tbl_pegawai , tbl_toko
        WHERE tbl_pengiriman.NAMA_PENGIRIMAN=tbl_item.ID_ITEM AND tbl_pengiriman.TOKO_PENGIRIMAN=tbl_toko.ID_TOKO AND tbl_pengiriman.BP_PENGIRIMAN=tbl_pegawai.NIP";

    $result = $this->db->query($sql);
    return $result->result();



 }

}
