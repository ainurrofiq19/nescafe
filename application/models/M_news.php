<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_news extends CI_Model{

public function view_news()
 {
 	$sql = "SELECT tbl_berita.ID_BERITA AS ID_BERITA, 
 		tbl_berita.JUDUL_BERITA AS JUDUL, 
 		tbl_berita.ISI_BERITA AS ISI,
 		tbl_berita.FOTO_BERITA AS FOTO
 		FROM tbl_berita
        ";

    $result = $this->db->query($sql);
    return $result->result();



 }

}
