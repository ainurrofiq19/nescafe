<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class View_of extends CI_Model{


 public function viewall($table)
 {
	$query = $this->db->get($table);
	return $query;
 }

  public function viewall($table)
 {
	$this->db->where('NIP', $username);
	$this->db->where('PASSWORD', md5($password));
	return $this->db->get($this->table);
 }


}
