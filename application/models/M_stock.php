<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_stock extends CI_Model{

public function view_all_stock($kode_toko)
 {
 	$sql = "SELECT tbl_stok.ID_BARANG AS ID_BARANG,
   	    tbl_item.NAMA_ITEM AS NAMA,
 		tbl_stok.JUMLAH AS JUMLAH,
        tbl_toko.NAMA_TOKO AS NAMA_TOKO
 		FROM tbl_stok, tbl_item, tbl_toko
        WHERE tbl_stok.ID_BARANG = tbl_item.ID_ITEM AND tbl_stok.ID_STORE = tbl_toko.ID_TOKO AND tbl_stok.ID_STORE= $kode_toko" ;

    $result = $this->db->query($sql);
    return $result->result();
 }
 public function view_all_stock2($kode_toko)
 {
 	$sql = "SELECT * FROM tbl_toko WHERE ID_TOKO = $kode_toko" ;

    $result = $this->db->query($sql);
    return $result->result();
 }

}
