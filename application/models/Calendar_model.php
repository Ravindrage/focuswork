<?php
  class calendar_model extends CI_Model {

    public function __construct()
    {
      $this->load->database();
    }

    public function get_calenderData()
    {
      //order_by(column_name, sort_type);
      //$query = $this->db->get('calendar');
      $this->db->select('*');
      $this->db->from('calendar');
      $this->db->order_by('datetime');
      $query = $this->db->get();

      return $query->result_array();
      
    }


    public function get_section()
     {

      $this->db->select('*');
      $this->db->from('section');
      $this->db->order_by('id');
      $query = $this->db->get();

      return $query->result_array();

     }

     public function saveNewEvent($event, $description , $datetime, $section, $starttime, $endtime)
     {

      $data = array(
        'event'   => $event,
        'description'      => $description,
        'datetime'   => $section,
        'section' => $datetime,
        'starttime'   => $starttime,
        'endtime' => $endtime
      );
    
      $this->db->insert('calendar', $data);

      $str = $this->db->last_query();
      echo $str;
     }

  }
?>