<?php
	$this->load->view('App/head');
	$this->load->view('App/navbar');
	$this->load->view('App/sidebar');
	$this->load->view($content);
	$this->load->view('App/footer');
?>