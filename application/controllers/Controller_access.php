<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_access extends CI_Controller {
   public function __construct() {
      parent::__construct();
      if (! $this->session->userdata('logged')) {
        $url=base_url('');
        redirect($url);
      }
  }

  public function index()
  {
    if($this->session->userdata('level')=='1'){
      redirect('Admin');
    }elseif($this->session->userdata('level')=='2'){
      redirect('Bp');
    }elseif($this->session->userdata('level')=='3'){
      redirect('Tl');
    }elseif($this->session->userdata('level')=='4'){
      redirect('Spv');
    }


  }



}
