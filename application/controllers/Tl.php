<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tl extends CI_Controller {
		function __construct(){
		parent::__construct();
		$this->load->model(array('View_of','M_delivery_order','M_item_delivery','M_item_reture'));
	}

	public function index()
	{
		$data['content'] = 'tl/dasboard';
		$this->load->view('template', $data);
	}

	public function view_brand_presenter()
	{
		$this->load->view('template');
	}
	
	public function add_brand_presenter()
	{
		$this->load->view('template');
	}
	
	public function view_store()
	{
		$this->load->view('template');
	}
	
	public function add_store()
	{
		$this->load->view('template');
	}
	
	public function view_report()
	{
		$this->load->view('template');
	}

	public function view_monthly_report()
	{
		$this->load->view('template');
	}					
}
