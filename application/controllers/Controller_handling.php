<?php
class Controller_handling extends CI_Controller{
  function __construct(){
    parent::__construct();
    if (! $this->session->userdata('logged')) {
      $url=base_url('');
      redirect($url);
    }
  }

  function NoAccesPage(){
    $this->load->view('erros/page/head_dashboard');


  }
}
