<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_item extends CI_Model{

public function view_item()
 {
 	$sql = "SELECT tbl_item.ID_ITEM AS ID_ITEM, 
 		tbl_item.NAMA_ITEM AS NAMA_ITEM, 
 		tbl_item.HARGA_ITEM AS HARGA,
 		tbl_item.FOTO_ITEM AS GAMBAR,
 		tbl_kategori.NAMA_KATEGORI AS KATEGORI 
 		FROM tbl_item , tbl_kategori
        WHERE tbl_item.AI_PRODUK=tbl_kategori.ID_KATEGORI;";

    $result = $this->db->query($sql);
    return $result->result();
 }
 function hapus_item($kondisi) {
 	 $this->db->where ($kondisi);
 	 return $this->db->delete ('tbl_item');
 }

}
