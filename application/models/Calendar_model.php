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
     }


     public function get_CalenderById ($id) {
      $query = $this->db->query("SELECT * FROM calendar WHERE id = '".$id."'");
      return $query->result_array();
     }


     public function update_CalendarById($event, $description, $newDate, $section, $newStartTime, $newEndTime, $id) 
     {
      $this->db->where('id', $id);
      $this->db->update('calendar', array('event'=>$event, 'description'=>$description, 'datetime'=>$newDate, 'section'=>$section, 'starttime'=>$newStartTime, 'endtime'=>$newEndTime));
     }

  }
?>