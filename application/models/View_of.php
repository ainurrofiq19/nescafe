<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class View_of extends CI_Model{


 public function viewall($table)
 {
	$query = $this->db->get($table);
	return $query->result();
 }

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




}
