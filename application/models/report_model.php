<?php
class Report_model extends MY_Model {

  public $_table_name;
  public $_order_by;
  public $_primary_key;
  function __construct(){
      parent::__construct();
      $this->load->database();
  }

  public function get_device_class($data = null){
        $this->db->select('tbl_device.equipment_type', FALSE);
        $this->db->from('tbl_device');
        if ($data) {
          $this->db->where($data);
        }
        $this->db->group_by('equipment_type');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
  }

  public function get_user_info($data = null){
        $this->db->select('tbl_doctor.*', FALSE);
        $this->db->from('tbl_doctor');
        if ($data) {
          $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
  }

  public function get_booking_amount($data = null){
      $this->db->select('tbl_patient_booking.*', FALSE);
      $this->db->from('tbl_patient_booking');
      if ($data) {
        $this->db->where($data);
      }
      $query_result = $this->db->get();
      $result = $query_result->result();
      return $result;
  }

  public function get_booking_data($data = null){
        $this->db->select('tbl_patient_booking.*', FALSE);
        $this->db->from('tbl_patient_booking');
        if ($data) {
          $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
  }

  public function get_data($booking_id = null){
        $this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as bking_id', FALSE);
        $this->db->select('tbl_report.*', FALSE);
        $this->db->from('tbl_patient_booking');
        $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
        if ($booking_id) {
          $this->db->where('tbl_patient_booking.booking_id', $booking_id);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
  }


  public function get_template_data($data = null){
      $this->db->select('tbl_report_module.*', FALSE);
      // $this->db->select('tbl_module_class.*', FALSE);
      $this->db->select('tbl_template.*', FALSE);
      $this->db->from('tbl_template');
      // $this->db->join('tbl_module_class', 'tbl_module_class.class_id = tbl_report_module.module_class', 'left');
      $this->db->join('tbl_report_module', 'tbl_template.report_module_id = tbl_report_module.module_id', 'left');
      if ($data) {
        $this->db->where($data);
      }
      $query_result = $this->db->get();
      $result = $query_result->result();
      return $result;

  }

  public function get_contact_info($data = null){
      $this->db->select('tbl_patient_booking.*', FALSE);
      $this->db->select('tbl_contact_info.*, tbl_contact_info.req_doctor_name as doctor_name ', FALSE);
      $this->db->from('tbl_contact_info');
      $this->db->join('tbl_patient_booking', 'tbl_contact_info.patient_id = tbl_patient_booking.booking_id', 'left');
      if ($data) {
        $this->db->where($data);
      }
      $query_result = $this->db->get();
      $result = $query_result->result();
      return $result;

  }


  public function get_module_class($data = null){
    $this->db->select('tbl_module_class.*', FALSE);
    $this->db->from('tbl_module_class');
    $query_result = $this->db->get();
    $result = $query_result->result();
    return $result;
  }

  public function get_module($data = null){
    $this->db->select('tbl_report_module.*', FALSE);
    $this->db->select('tbl_module_class.*', FALSE);
    $this->db->from('tbl_report_module');
    $this->db->join('tbl_module_class', 'tbl_module_class.class_id = tbl_report_module.module_class', 'left');
    if ($data) {
      $this->db->where($data);
    }
    $query_result = $this->db->get();
    $result = $query_result->result();
    return $result;
  }

  public function get_report_data($data = null){
        $this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as delivery_name', FALSE);
        $this->db->select('tbl_report.*', FALSE);
        $this->db->select('tbl_deliberation.*', FALSE);
        $this->db->from('tbl_patient_booking');
        $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
        $this->db->join('tbl_deliberation', 'tbl_deliberation.report_id = tbl_report.report_id', 'left');
        if ($data) {
          $this->db->where($data);
        }
        $this->db->order_by('booking_time');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }


    public function get_deliberation_data($data = null){
          $this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as delivery_name', FALSE);
          $this->db->select('tbl_report.*, tbl_report.report_id as report_CC_id', FALSE);
          $this->db->select('tbl_deliberation.*', FALSE);
          $this->db->from('tbl_report');
          $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
          $this->db->join('tbl_deliberation', 'tbl_deliberation.report_id = tbl_report.report_id', 'left');
          if ($data) {
            $this->db->where($data);
          }
          $this->db->order_by('report_time','DESC');
          $query_result = $this->db->get();
          $result = $query_result->result();
          return $result;
      }

    public function get_past_reportinfo($data = null){
        $this->db->select('tbl_report.*', FALSE);
        $this->db->from('tbl_report');
        if ($data) {
          $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }


    public function search_data($data = null){
      $this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as delivery_name', FALSE);
      $this->db->select('tbl_report.*', FALSE);
      $this->db->from('tbl_patient_booking');
      $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
      if ($data) {
        $this->db->where($data);
      }
      $this->db->order_by('booking_time');
      $query_result = $this->db->get();
      $result = $query_result->result();
      return $result;
   }

    public function past_get_data($booking_id = null){
        $this->_table_name = 'tbl_patient_booking';
        $this->_order_by = 'booking_id';
        $booking_info = $this->get_by(array('booking_id' => $booking_id), TRUE);
        $patient_id = $booking_info->patient_code;
        $this->db->select('tbl_patient_booking.*', FALSE);
        $this->db->select('tbl_report.*', FALSE);
        $this->db->from('tbl_report');
        $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
        $this->db->where('tbl_patient_booking.patient_code', $patient_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function past_get_dicom_url($booking_id = null){

        $this->db->select('*', FALSE);
        $this->db->from('tbl_patient_booking');
        $this->db->where('booking_id', $booking_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_all_post_to_me($user_id=null){
        $this->db->select('tbl_blog.*', FALSE);
        $this->db->from('tbl_doctor');
        $this->db->join('tbl_lession_info', 'tbl_lession_info.lession_doctor = tbl_doctor.id', 'left');
        $this->db->join('tbl_blog', 'tbl_blog.lession_id = tbl_lession_info.lession_id', 'left');
        $this->db->where('tbl_blog.read_check', 0);
        $this->db->where('tbl_doctor.id', $user_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

}
