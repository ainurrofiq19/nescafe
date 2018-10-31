<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_item_delivery extends CI_Model{


  public function view_item_delivery()
   {
   	$sql = "SELECT KODE_PENGIRIMAN,
      tbl_pengiriman.TGL_PENGIRIMAN AS TANGGAL,
      tbl_toko.NAMA_TOKO AS TOKO,
      tbl_pegawai.NAMA_PEG AS BP,
      tbl_pengiriman.STATUS_PENGIRIMAN AS STATUS
   		FROM tbl_pengiriman , tbl_toko , tbl_pegawai
      WHERE tbl_pengiriman.TOKO_PENGIRIMAN=tbl_toko.ID_TOKO AND tbl_pengiriman.BP_PENGIRIMAN=tbl_pegawai.NIP
      GROUP BY KODE_PENGIRIMAN";

      $result = $this->db->query($sql);
      return $result->result();
   }

public function view_item_delivery2($where)
 {
 	$sql = "SELECT tbl_pengiriman.ID_PENGIRIMAN AS KODE_PENGIRIMAN, ID_PENGIRIMAN,
    tbl_pengiriman.NAMA_PENGIRIMAN AS NAMA_PENGIRIMAN,
    tbl_pengiriman.JUMLAH_PENGIRIMAN AS QTY,
 		tbl_pengiriman.TGL_PENGIRIMAN AS TANGGAL,
		tbl_pengiriman.STATUS_PENGIRIMAN AS STATUS,
    tbl_item.NAMA_ITEM AS ITEM,
    tbl_item.HARGA_ITEM AS HARGA
 		FROM tbl_pengiriman , tbl_item
        WHERE tbl_pengiriman.KODE_PENGIRIMAN='$where' AND tbl_pengiriman.NAMA_PENGIRIMAN=tbl_item.ID_ITEM";

    $result = $this->db->query($sql);
    return $result->result();
 }

}
