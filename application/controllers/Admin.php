<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model(array('View_of','M_item','M_item_request','M_delivery_order','M_item_delivery'));
	}

	public function index()
	{
		$data['content'] = 'admin/dasboard';
		$this->load->view('template', $data);
	}

	public function view_item()
	{
		$data['cetak1'] = $this->M_item->view_item();
		$data['content'] = 'Admin/view_item';
		$this->load->view('template', $data);
	}

	public function add_item()
	{
		$this->load->view('template');
	}

	public function view_item_request()
	{
		$data['cetak1'] = $this->M_item_request->view_item_request();
		$data['content'] = 'Admin/view_item_request';
		$this->load->view('template', $data);
	}

	public function accepting_item_request()
	{
		$this->load->view('template');
	}

	public function view_delivery_order()
	{
		$data['cetak1'] = $this->M_delivery_order->view_delivery_order();
		$data['content'] = 'Admin/view_delivery_order';
		$this->load->view('template', $data);
	}
	
	public function add_delivery_order()
	{
		$this->load->view('template');
	}
	
	public function view_item_delivery()
	{
		$data['cetak1'] = $this->M_item_delivery->view_item_delivery();
		$data['content'] = 'Admin/view_item_delivery';
		$this->load->view('template', $data);
	}

	public function add_item_delivery()
	{
		$data['cetak1'] = $this->M_item_delivery->view_item_delivery();
		$data['content'] = 'Admin/view_item_delivery';
		$this->load->view('template', $data);
	}

	public function view_mothly_report()
	{
		$this->load->view('template');
	}
						
}

