<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_model extends CI_Model{
	private $table = "tbl_pegawai";
 private $pk = "NIP";

 public function __construct() {
		 parent::__construct();
 }

 // ambil data dari database yang usernamenya $username dan passwordnya p$assword
 public function login($username, $password)
 {
		 $this->db->where('NIP', $username);
		 $this->db->where('PASSWORD', md5($password));
		 return $this->db->get($this->table);
 }

 // update user
 public function update($data, $id_user)
 {
		 $this->db->where($this->pk, $id_user);
		 $this->db->update($this->table, $data);
 }

 // ambil data berdasarkan cookie
 public function get_by_cookie($cookie)
 {
		 $this->db->where('COOKIE', $cookie);
		 return $this->db->get($this->table);
 }

}
