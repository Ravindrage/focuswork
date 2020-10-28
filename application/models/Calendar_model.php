<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Calendar_model extends CI_Model {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}

	public function get_data() {

		$this->db->select('*');
      	$this->db->from('calendar');
      	$this->db->order_by('datetime');
      	$query = $this->db->get();

      	return $query->result_array();

		$variable = '';
		//$increment = 501 ;
		$section = 1;

		foreach ($query->getResult() as $rowcategory)
		{
			$increment = $rowcategory->id ;
			$datetime = $rowcategory->datetime ;
			$event = $rowcategory->event ;
			$description = $rowcategory->description ;
			$section = $rowcategory->section ;
			$starttime = $rowcategory->starttime ;
			$endtime = $rowcategory->endtime ;

			$newDate = date("m-d-Y", strtotime($datetime));
			//$originalDate = $datetime ;

			$variable .= "{ id: ".$increment.", name: '<div>".$event."</div><div>".$description."</div>',
                start: moment('".$newDate."','MM-DD-YYYY').add('hours', '".$starttime."'),
                end: moment('".$newDate."','MM-DD-YYYY').add('hours', '".$endtime."'), sectionID: ".$section.",classes: 'item-status-none'
              },";

		}
		return $variable;
	}

	public function get_section () {

		$this->db->select('*');
      	$this->db->from('section');
      	$this->db->order_by('id');
      	$query = $this->db->get();

      	return $query->result_array();

		$sectionvariable = '';
		$totalsection=0;

		foreach ($query->getResult() as $rowcategory)
		{
			$id = $rowcategory->id ;
			$section = $rowcategory->section ;
			$increment = $rowcategory->id ;

			$sectionvariable .= "{     id: ".$id.",    name: '".$section."' },";
			$totalsection++ ;

		}
		return $sectionvariable;
	}