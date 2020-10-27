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
		$sqlcategory = "select * from calendar order by datetime";
		//$calendarcategory = $conn->query($sqlcategory);
		$variable = '';
		//$increment = 501 ;
		$section = 1;

		$query = $db->query($sqlcategory);

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
		$sqlsection = "select * from section order by id";
		//$calendarcategory = $conn->query($sqlcategory);
		$sectionvariable = '';
		$totalsection=0;
		/*
		foreach($calendarcategory as $rowcategory)
		{
		$id = $rowcategory['id'] ;
		$section = $rowcategory['section'] ;

		$sectionvariable .= "{     id: ".$id.",    name: '".$section."' },";
		$totalsection++ ;
		}
		*/

		$query = $db->query($sqlsection);

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