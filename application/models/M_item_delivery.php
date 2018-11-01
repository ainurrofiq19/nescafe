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
public function detail_item_delivery2($where)
 {
      
  }

public function find($KODE_PENGIRIMAN){

         $sql = "SELECT 
    tbl_pengiriman.ID_PENGIRIMAN,
    tbl_pengiriman.KODE_PENGIRIMAN,
    tbl_pengiriman.NAMA_PENGIRIMAN AS NAMA_PENGIRIMAN,
    tbl_pengiriman.JUMLAH_PENGIRIMAN AS QTY,
    tbl_pengiriman.TGL_PENGIRIMAN AS TANGGAL,
    tbl_pengiriman.STATUS_PENGIRIMAN AS STATUS,
    tbl_pengiriman.TOKO_PENGIRIMAN,
    tbl_pegawai.NAMA_PEG,
    tbl_item.NAMA_ITEM AS ITEM,
    tbl_item.HARGA_ITEM AS HARGA,
    tbl_toko.NAMA_TOKO,
    tbl_toko.ALAMAT_TOKO,
    tbl_toko.TLP_TOKO,
    tbl_toko.EMAIL_TOKO
    FROM tbl_pengiriman , tbl_item ,tbl_toko, tbl_pegawai
        WHERE tbl_pengiriman.KODE_PENGIRIMAN='$KODE_PENGIRIMAN' 
        AND tbl_pengiriman.NAMA_PENGIRIMAN=tbl_item.ID_ITEM
        AND tbl_pengiriman.TOKO_PENGIRIMAN=tbl_toko.ID_TOKO
        AND tbl_pengiriman.BP_PENGIRIMAN=tbl_pegawai.NIP
        ";

         $result = $this->db->query($sql);

        if ($result->num_rows() > 0 )
        {
          return $result->row();
        } else {
          return array();
        }
  }
    function select_where($select, $table, $where)
   {
      $this->db->select($select);
      $this->db->from($table);
      $this->db->where($where);

      $query = $this->db->get();
      
   }


   public function cencel_item_delivery($kode_kirim){

  $sql= "DELETE FROM tbl_pengiriman WHERE KODE_PENGIRIMAN ='$kode_kirim'";

  $result = $this->db->query($sql);
   
   }
}
