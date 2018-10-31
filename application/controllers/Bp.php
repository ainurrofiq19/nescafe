<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bp extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(array('View_of','M_item_request','M_item_delivery','M_item_reture'));
	}

	public function index()
	{
		$data['content'] = 'bp/dasboard';
		$this->load->view('template', $data);
	}


	public function view_item_request()
	{
		$data['cetak1'] = $this->M_item_request->view_item_request();
		$data['content'] = 'bp/view_item_request';
		$this->load->view('template', $data);
	}

	public function add_item_request()
	{
		$this->load->view('template');
	}
	
	public function view_item_delivery()
	{
		$data['cetak1'] = $this->M_item_delivery->view_item_delivery();
		$data['content'] = 'bp/view_item_delivery';
		$this->load->view('template', $data);
	}

	public function accepting_item_delivery()
	{
		$this->load->view('template');
	}

	public function view_item_reture()
	{
		$data['cetak1'] = $this->M_item_reture->view_item_reture();
		$data['content'] = 'bp/view_item_reture';
		$this->load->view('template', $data);
	}

	public function add_item_reture()
	{
		$this->load->view('template');
	}

	public function view_report()
	{
		$this->load->view('template');
	}

		public function add_report()
	{
		$this->load->view('template');
	}
}

