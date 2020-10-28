<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Calendar extends CI_Controller {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('calendar_model');
		
	}
	
	
	public function index()
	{
		$data['calendar'] = $this->calendar_model->get_calenderData();
		//$data['section'] = $this->caldndar_model->get_section();

		// user login ok
		$this->load->view('templates/header', $data);
		$this->load->view('calendar/index', $data);
		$this->load->view('templates/footer');
	}

	public dashboard() {
		
	}
}