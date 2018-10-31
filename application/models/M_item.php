<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_item extends CI_Model{

public function view_item()
 {
 	$sql = "SELECT tbl_item.ID_ITEM AS ID_ITEM, 
 		tbl_item.NAMA_ITEM AS NAMA_ITEM, 
 		tbl_item.HARGA_ITEM AS HARGA,
 		tbl_item.FOTO_ITEM AS GAMBAR,
 		tbl_kategori.NAMA_KATEGORI AS KATEGORI, 
 		tbl_item.AKTIF as AKTIF
 		FROM tbl_item , tbl_kategori
        WHERE tbl_item.AI_PRODUK=tbl_kategori.ID_KATEGORI
        and tbl_item.AKTIF='y'";

    $result = $this->db->query($sql);
    return $result->result();

 }

// public function edit($where,$data,$table){
// 		$this->db->where($where);
// 		$this->db->update($table,$data);
// }


// public function find($ID_ITEM)//للبحث عن رقم المنتج وتحقق من وجوده 
// 			//this is for find record id->product
// 		{ 
// 			$code = $this->db->where('ID_ITEM',$ID_ITEM)
// 							->limit(1)
// 							->get('tbl_item');
// 			if ($code->num_rows() > 0 )
// 				{
// 					return $code->row();
// 				}else {
// 					return array();
// 				}//end if code->num_rows > 0 
				
// 		}//end function find

//  // function hapus_item($kondisi) {
//  // 	 $this->db->where ($kondisi);
//  // 	 return $this->db->delete ('tbl_item');
//  // }

public function hapus_item($id){
	$sql= "UPDATE tbl_item SET AKTIF ='n' WHERE ID_ITEM = '$id'";

	$result = $this->db->query($sql);
	// var_dump($sql);
	// return $result->();
		// $this->db->where($id);
		// $this->db->update('tbl_item',$data);
}

}
