<?php
	class Calendar extends CI_Controller {

		public function __construct()
		{
			parent::__construct();
			$this->load->model('calendar_model');
			$this->load->helper('url_helper');
			$this->load->library(array('session'));
			$this->load->helper(array('url'));
		}

		public function calendarHome()
		{
			$data['calendar'] = $this->calendar_model->get_calenderData();
			$data['section'] = $this->calendar_model->get_section();

			// user login ok
			$this->load->view('header');
			$this->load->view('calendar/calendarHome', $data);
			$this->load->view('footer');
		}


		public function addCalendarEvent()
		{
			// create the data object
			$data = new stdClass();

			// load form helper and validation library
			$this->load->helper('form');

			// set variables from the AddNewEvent form
			$event = $this->input->post('eventdata');
			$description    = $this->input->post('eventdesc');
			$section = $this->input->post('section');
			$datetime = $this->input->post('date');
			$newDate = date("Y-m-d", strtotime($datetime));
			$starttime    = $this->input->post('starttime');
			$newStartTime = $newDate." ".$starttime;
			$endtime = $this->input->post('endtime');
			$newEndTime = $newDate." ".$endtime;

			if ($this->calendar_model->saveNewEvent($event, $description, $section, $newDate, $newStartTime, $newEndTime)) {

				
				//$this->load->view('calendar/calendarHome', $data);
				//return("Hello world");
				return 1;
				
			} else {
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new event. Please try again.';
				
				redirect('/calendar');
			}

		}


		public function editCalendarEvent()
		{
			//echo "I am in update Controller";
      		//exit(); 

			$id = $this->input->post('dataid');
			//$id= $this->calendar_model->get_CalenderById($id);

			$event = $this->input->post('eventdata');
			$description    = $this->input->post('eventdesc');
			$section = $this->input->post('section');
			$datetime = $this->input->post('date');
			$newDate = date("Y-m-d", strtotime($datetime));
			$starttime    = $this->input->post('starttime');
			$newStartTime = $newDate." ".$starttime;
			$endtime = $this->input->post('endtime');
			$newEndTime = $newDate." ".$endtime;
			//$status =  $this->input->post('status');

			$this->calendar_model->update_CalendarById($event, $description, $section, $newDate, $newStartTime, $newEndTime, $id);
			//echo "Data updated successfully !";
			//$this->load->view('calendar/calendarHome', $data);
			//redirect('/calendar');

		}

	}
?>