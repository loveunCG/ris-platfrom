<?php
class Admin_model extends MY_Model {
    public $_table_name;
    public $_order_by;
    public $_primary_key;
    function __construct()
      {
        parent::__construct();
        //$this->load->database();
      }

    public function get_userinfo($data = null) {
        $this->db->select('tbl_doctor.*', FALSE);
        $this->db->select('tbl_department.*', FALSE);
        $this->db->from('tbl_doctor');
        $this->db->join('tbl_department', 'tbl_doctor.usr_department = tbl_department.department_id', 'left');
        if ($data) {
          $this->db->where($data);
        }
        $this->db->order_by('usr_create_time');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_hospitalinfo($data = null) {
        $this->db->select('tbl_hospital.*', FALSE);
        $this->db->from('tbl_hospital');
        if ($data) {
          $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_deviceinfo($data = null) {
        $this->db->select('tbl_device.*', FALSE);
        //$this->db->select('tbl_department.*', FALSE);
        $this->db->from('tbl_device');
      //  $this->db->join('tbl_department', 'tbl_doctor.usr_department = tbl_department.department_id', 'left');
        if ($data) {
          $this->db->where($data);
        }
        $this->db->order_by('add_time');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_check_iteminfo($data = null) {
        $this->db->select('tbl_checkup_item.*', FALSE);
        $this->db->select('tbl_module_class.*', FALSE);
        $this->db->from('tbl_checkup_item');
        $this->db->join('tbl_module_class', 'tbl_module_class.class_id = tbl_checkup_item.checkup_class', 'left');
        if ($data) {
          $this->db->where($data);
        }
        $this->db->order_by('add_time');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }


    public function get_equipment_room(){
      $this->db->select('tbl_device.equioment_room', FALSE);
      $this->db->from('tbl_device');
      $this->db->group_by('equioment_room');
      $query_result = $this->db->get();
      $result = $query_result->result();
      return $result;
    }

    public function get_device_type(){
      $this->db->select('tbl_device.equipment_type', FALSE);
      $this->db->from('tbl_device');
      $this->db->group_by('equipment_type');
      $query_result = $this->db->get();
      $result = $query_result->result();
      return $result;
    }

    public function get_equipment_department(){
      $this->db->select('tbl_device.equipment_deaprtment', FALSE);
      $this->db->from('tbl_device');
      $this->db->group_by('equipment_deaprtment');
      $query_result = $this->db->get();
      $result = $query_result->result();
      return $result;
    }



    public function get_checkinfo($data = null) {
        $this->db->select('tbl_device.*', FALSE);
        //$this->db->select('tbl_department.*', FALSE);
        $this->db->from('tbl_device');
      //  $this->db->join('tbl_department', 'tbl_doctor.usr_department = tbl_department.department_id', 'left');
        if ($data) {
          $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }


    public function get_departmentinfo() {
        $this->db->select('tbl_department.*', FALSE);
        $this->db->from('tbl_department');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function loggedin() {
       return (bool) $this->session->userdata('loggedin');
   }

}
