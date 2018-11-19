<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_item_reture extends CI_Model{

  public function view_item_reture()
  {
   $sql = "SELECT KODE_RETURE,
       tbl_reture.ID_RETURE AS ID_RETURE,
       tbl_reture.NAMA_RETURE AS NAMA_RETURE,
       tbl_reture.JUMLAH_RETURE AS QTY,
       tbl_reture.TGL_RETURE AS TANGGAL,
       tbl_toko.NAMA_TOKO AS TOKO,
       tbl_pegawai.NAMA_PEG AS BP,
       tbl_reture.STATUS_RETURE AS STATUS
     FROM tbl_reture , tbl_item , tbl_pegawai , tbl_toko
      WHERE tbl_reture.TOKO_RETURE=tbl_toko.ID_TOKO
        AND tbl_reture.BP_RETURE=tbl_pegawai.NIP
      GROUP BY KODE_RETURE
      ORDER BY tbl_reture.TGL_RETURE  desc";

    $result = $this->db->query($sql);
    return $result->result();
  }

  public function view_item_reture2($where)
   {
    $sql = "SELECT tbl_reture.ID_RETURE AS KODE_RETURE, ID_RETURE,
      tbl_reture.NAMA_RETURE AS NAMA_RETURE,
      tbl_reture.JUMLAH_RETURE AS QTY,
      tbl_reture.TGL_RETURE AS TANGGAL,
      tbl_reture.STATUS_RETURE AS STATUS,
      tbl_item.NAMA_ITEM AS ITEM,
      tbl_item.HARGA_ITEM AS HARGA
      FROM tbl_reture , tbl_item
          WHERE tbl_reture.KODE_RETURE='$where'
          AND tbl_reture.NAMA_RETURE=tbl_item.ID_ITEM";

      $result = $this->db->query($sql);
      return $result->result();
   }

  public function cancel_item_reture($kode_minta){
   $sql= "DELETE FROM tbl_reture WHERE KODE_RETURE ='$kode_minta'";
   $result = $this->db->query($sql);
  }

}
