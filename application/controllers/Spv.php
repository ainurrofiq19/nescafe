<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spv extends CI_Controller {

	public function index()
	{
		$data['content'] = 'spv/dasboard';
		$this->load->view('template', $data);
	}

	public function view_item_reture()
	{
		$this->load->view('template');
	}

	public function accepting_item_reture()
	{
		$this->load->view('template');
	}

	public function view_news()
	{
		$this->load->view('template');
	}

	public function add_news()
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
