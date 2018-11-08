<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_item_request extends CI_Model{

public function view_item_request()
  {
  	$sql = "SELECT KODE_PERMINTAAN,
      tbl_permintaan.ID_PERMINTAAN AS ID_PERMINTAAN,
      tbl_permintaan.NAMA_PERMINTAAN AS NAMA_PERMINTAAN,
  		tbl_permintaan.JUMLAH_PERMINTAAN AS QTY,
  		tbl_permintaan.TGL_PERMINTAAN AS TANGGAL,
  		tbl_toko.NAMA_TOKO AS TOKO,
   		tbl_pegawai.NAMA_PEG AS BP,
   		tbl_permintaan.STATUS_PERMINTAAN AS STATUS
  		FROM tbl_permintaan , tbl_item , tbl_pegawai , tbl_toko
      WHERE tbl_permintaan.TOKO_PERMINTAAN=tbl_toko.ID_TOKO
        AND tbl_permintaan.BP_PERMINTAAN=tbl_pegawai.NIP
      GROUP BY KODE_PERMINTAAN
      ORDER BY tbl_permintaan.TGL_PERMINTAAN  desc";

    $result = $this->db->query($sql);
    return $result->result();
  }

  public function view_item_request2($where)
   {
   	$sql = "SELECT tbl_permintaan.ID_PERMINTAAN AS KODE_PERMINTAAN, ID_PERMINTAAN,
      tbl_permintaan.NAMA_PERMINTAAN AS NAMA_PERMINTAAN,
      tbl_permintaan.JUMLAH_PERMINTAAN AS QTY,
   		tbl_permintaan.TGL_PERMINTAAN AS TANGGAL,
  		tbl_permintaan.STATUS_PERMINTAAN AS STATUS,
      tbl_item.NAMA_ITEM AS ITEM,
      tbl_item.HARGA_ITEM AS HARGA
   		FROM tbl_permintaan , tbl_item
          WHERE tbl_permintaan.KODE_PERMINTAAN='$where'
          AND tbl_permintaan.NAMA_PERMINTAAN=tbl_item.ID_ITEM";

      $result = $this->db->query($sql);
      return $result->result();
   }

   public function find($KODE_PERMINTAAN){
     $sql = "SELECT
       tbl_permintaan.ID_PERMINTAAN,
       tbl_permintaan.KODE_PERMINTAAN AS KODE_PERMINTAAN,
       tbl_permintaan.NAMA_PERMINTAAN AS NAMA_PERMINTAAN,
       tbl_permintaan.JUMLAH_PERMINTAAN AS QTY,
       tbl_permintaan.TGL_PERMINTAAN AS TANGGAL,
       tbl_permintaan.STATUS_PERMINTAAN AS STATUS,
       tbl_permintaan.TOKO_PERMINTAAN,
       tbl_pegawai.NAMA_PEG,
       tbl_item.NAMA_ITEM AS ITEM,
       tbl_item.HARGA_ITEM AS HARGA,
       tbl_toko.NAMA_TOKO,
       tbl_toko.ALAMAT_TOKO,
       tbl_toko.TLP_TOKO,
       tbl_toko.EMAIL_TOKO
       FROM tbl_permintaan , tbl_item ,tbl_toko, tbl_pegawai
           WHERE tbl_permintaan.KODE_PERMINTAAN='$KODE_PERMINTAAN'
           AND tbl_permintaan.NAMA_PERMINTAAN=tbl_item.ID_ITEM
           AND tbl_permintaan.TOKO_PERMINTAAN=tbl_toko.ID_TOKO
           AND tbl_permintaan.BP_PERMINTAAN=tbl_pegawai.NIP
           ";

      $result = $this->db->query($sql);
      if ($result->num_rows() > 0 )
      {
        return $result->row();
      } else {
        return array();
      }

     }
    public function cancel_item_request($kode_minta){
     $sql= "DELETE FROM tbl_permintaan WHERE KODE_PERMINTAAN ='$kode_minta'";
     $result = $this->db->query($sql);
    }

}
