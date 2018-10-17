<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spv extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(array('View_of','M_item_reture','M_news'));
	}

	public function index()
	{
		$data['content'] = 'spv/dasboard';
		$this->load->view('template', $data);
	}

	public function view_item_reture()
	{
		$data['cetak1'] = $this->M_item_reture->view_item_reture();
		$data['content'] = 'spv/view_item_reture';
		$this->load->view('template', $data);
	}

	public function accepting_item_reture()
	{
		$this->load->view('template');
	}

	public function view_news()
	{
		$data['cetak1'] = $this->M_news->view_news();
		$data['content'] = 'spv/view_news';
		$this->load->view('template', $data);
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
