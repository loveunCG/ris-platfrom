<?php
class Report_model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_device_class($data = null)
    {
        $this->db->select('tbl_device.equipment_type', false);
        $this->db->from('tbl_device');
        if ($data) {
            $this->db->where($data);
        }
        $this->db->group_by('equipment_type');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_user_info($data = null)
    {
        $this->db->select('tbl_doctor.*', false);
        $this->db->from('tbl_doctor');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function reportNotification($data = null)
    {
        $this->db->select('tbl_patient_booking.*', false);
        $this->db->select('tbl_hospital.hospital_class', false);
        $this->db->select('tbl_check_list.*', false);
        $this->db->from('tbl_check_list');
        $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        $this->db->join('tbl_hospital', 'tbl_hospital.hospital_name = tbl_patient_booking.hospital_name', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getContactRoomMemberInfo($data = null)
    {
        $this->db->select('tbl_doctor.*', false);
        $this->db->select('tbl_contact_member.*', false);
        $this->db->from('tbl_contact_member');
        $this->db->join('tbl_doctor', 'tbl_contact_member.mem_doc_id = tbl_doctor.id', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();

        $this->db->from('tbl_contact_info');
        $this->db->join('tbl_doctor', 'tbl_contact_info.req_doctor_name = tbl_doctor.id', 'left');
        $this->db->where('contact_id', $data['mem_contact_id']);
        $query_result = $this->db->get();
        $result1 = $query_result->result();
        return array_merge($result1, $result);
    }

    public function get_booking_amount($data = null)
    {
        $this->db->select('tbl_check_list.*', false);
        $this->db->from('tbl_check_list');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_booking_data($data = null)
    {
        $this->db->select('tbl_patient_booking.*', false);
        $this->db->from('tbl_patient_booking');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function get_checkup_data_by_id($chc_id = null)
    {
        $this->db->select('tbl_patient_booking.*', false);
        $this->db->select('tbl_check_list.*', false);
        $this->db->from('tbl_check_list');
        $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        if ($chc_id) {
            $this->db->where('tbl_check_list.chc_id', $chc_id);
        }
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_data($booking_id = null)
    {
        $this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as bking_id', false);
        $this->db->select('tbl_report.*', false);
        $this->db->from('tbl_patient_booking');
        $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
        if ($booking_id) {
            $this->db->where('tbl_patient_booking.booking_id', $booking_id);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_template_data($data = null)
    {
        $this->db->select('tbl_report_module.*', false);
        $this->db->select('tbl_module_class.*', false);
        $this->db->select('tbl_template.*', false);
        $this->db->from('tbl_template');
        $this->db->join('tbl_report_module', 'tbl_template.report_module_id = tbl_report_module.module_id', 'left');
        $this->db->join('tbl_module_class', 'tbl_module_class.class_id = tbl_report_module.module_class', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_contact_info($data = null)
    {
        $this->db->select('tbl_patient_booking.*', false);
        $this->db->select('tbl_contact_info.*, tbl_contact_info.req_doctor_name as doctor_name ', false);
        $this->db->select('tbl_hospital.hospital_class', false);
        $this->db->select('tbl_doctor.*', false);
        $this->db->from('tbl_contact_info');
        $this->db->join('tbl_patient_booking', 'tbl_contact_info.patient_id = tbl_patient_booking.booking_id', 'left');
        $this->db->join('tbl_doctor', 'tbl_contact_info.req_doctor_name = tbl_doctor.id', 'left');
        $this->db->join('tbl_hospital', 'tbl_hospital.hospital_name = tbl_contact_info.req_hospital', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_module_class($data = null)
    {
        $this->db->select('tbl_module_class.*', false);
        $this->db->from('tbl_module_class');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_module($data = null)
    {
        $this->db->select('tbl_report_module.*', false);
        $this->db->select('tbl_module_class.*', false);
        $this->db->from('tbl_report_module');
        $this->db->join('tbl_module_class', 'tbl_module_class.class_id = tbl_report_module.module_class', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_report_data($data = null)
    {
        $this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as delivery_name', false);
        $this->db->select('tbl_report.*', false);
        $this->db->select('tbl_check_list.*', false);
        $this->db->select('tbl_deliberation.deliberation_id, tbl_deliberation.deliberation_time, tbl_deliberation.deliberation_content', false);
        $this->db->from('tbl_check_list');
        $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id', 'left');
        $this->db->join('tbl_deliberation', 'tbl_deliberation.deli_rpt_id = tbl_report.report_id', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $this->db->order_by('booking_time');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_deliberation_data($data = null)
    {
        $this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as delivery_name', false);
        $this->db->select('tbl_report.*, tbl_report.report_id as report_CC_id', false);
        $this->db->select('tbl_deliberation.*', false);
        $this->db->select('tbl_check_list.chc_id', false);
        $this->db->select('tbl_hospital.hospital_class', false);
        $this->db->from('tbl_report');
        $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
        $this->db->join('tbl_deliberation', 'tbl_deliberation.deli_rpt_id = tbl_report.report_id', 'left');
        $this->db->join('tbl_check_list', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        $this->db->join('tbl_hospital', 'tbl_hospital.hospital_name = tbl_patient_booking.hospital_name', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $this->db->order_by('report_time', 'DESC');
        $this->db->group_by('tbl_patient_booking.booking_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_past_reportinfo($data = null)
    {
        $this->db->select('tbl_report.*', false);
        $this->db->from('tbl_report');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function search_data($data = null)
    {
        $this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as delivery_name', false);
        $this->db->select('tbl_report.*', false);
        $this->db->select('tbl_check_list.chc_id', false);
        $this->db->select('tbl_hospital.hospital_class', false);
        $this->db->from('tbl_patient_booking');
        $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
        $this->db->join('tbl_check_list', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $this->db->order_by('booking_time');
        $this->db->group_by('tbl_patient_booking.booking_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function past_get_data($booking_id = null)
    {
        $this->_table_name = 'tbl_patient_booking';
        $this->_order_by = 'booking_id';
        $booking_info = $this->get_by(array('booking_id' => $booking_id), true);
        $patient_id = $booking_info->license_num;
        $this->db->select('tbl_patient_booking.*', false);
        $this->db->select('tbl_report.*', false);
        $this->db->from('tbl_report');
        $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
        $this->db->where('tbl_patient_booking.license_num', $patient_id);
        $this->db->where('tbl_patient_booking.booking_id != ', $booking_id);
        $this->db->group_by('tbl_patient_booking.booking_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function past_checkup_data($chc_id = null)
    {
        if (!$chc_id) {
            return null;
        }
        $this->_table_name = 'tbl_check_list';
        $this->_order_by = 'chc_booking_id';
        $booking_id = $this->get_by(array('chc_id' => $chc_id), true)->chc_booking_id;
        $this->_table_name = 'tbl_patient_booking';
        $this->_order_by = 'booking_id';
        $patient_id = $this->get_by(array('booking_id' => $booking_id), true)->license_num;
        $this->db->select('tbl_check_list.*', false);
        $this->db->select('tbl_report.*', false);
        $this->db->select('tbl_patient_booking.*', false);
        $this->db->from('tbl_report');
        $this->db->join('tbl_check_list', 'tbl_check_list.chc_id = tbl_report.checkup_id', 'left');
        $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        $this->db->where('tbl_patient_booking.license_num', $patient_id);
        $this->db->where('tbl_patient_booking.booking_id != ', $booking_id);
        $this->db->group_by('tbl_check_list.chc_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function report_data_for_reporting($chc_id = null)
    {
        $this->db->select('tbl_check_list.*', false);
        $this->db->select('tbl_report.*', false);
        $this->db->select('tbl_patient_booking.*', false);
        $this->db->from('tbl_check_list');
        $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id', 'left');
        $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        $this->db->where('tbl_check_list.chc_id', $chc_id);
        $this->db->group_by('tbl_check_list.chc_id');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function past_get_dicom_url($booking_id = null)
    {
        $this->db->select('*', false);
        $this->db->from('tbl_patient_booking');
        $this->db->where('booking_id', $booking_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_all_post_to_me($user_id = null)
    {
        $this->db->select('tbl_blog.*', false);
        $this->db->from('tbl_doctor');
        $this->db->join('tbl_lession_info', 'tbl_lession_info.lession_doctor = tbl_doctor.id', 'left');
        $this->db->join('tbl_blog', 'tbl_blog.lession_id = tbl_lession_info.lession_id', 'left');
        $this->db->where('tbl_blog.read_check', 0);
        $this->db->where('tbl_doctor.id', $user_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_alramContact($data = null)
    {
        $this->db->select('tbl_contact_member.*', false);
        $this->db->select('tbl_contact_info.*', false);
        $this->db->from('tbl_contact_member');
        $this->db->join('tbl_contact_info', 'tbl_contact_member.mem_contact_id = tbl_contact_info.contact_id', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function set_contact_start_time($data = null)
    {
        $tmp = array(
			'contact_start_time' => $data['start_time'],
			'contact_status' => 6,
        );
        $this->db->where('contact_id', $data['contact_id']);
        $this->db->update('tbl_contact_info', $tmp);
    }

    public function set_contact_end_time($data = null)
    {
        $tmp = array(
            'contact_end_time' => $data['end_time'],
            'contact_status' => 5,
        );
        $this->db->where('contact_id', $data['contact_id']);
        $this->db->update('tbl_contact_info', $tmp);
        $tmp = array(
            'remote_status' => 1,
        );
        $this->db->where('booking_id', $data['booking_id']);
        $this->db->update('tbl_patient_booking', $tmp);
        $tmp = array(
            'mem_status' => 2,
        );
        $this->db->where('mem_contact_id', $data['contact_id']);
        $this->db->update('tbl_contact_member', $tmp);
	}
	
	public function change_contact_status($data = null)
    {
        $tmp = array(
            'contact_status' => 3,
        );
        $this->db->where('contact_id', $data['contact_id']);
        $this->db->update('tbl_contact_info', $tmp);
    }

    public function start_contact_enable($data = null)
    {
        $this->db->from('tbl_contact_info');
        $this->db->where($data);
        $query_result = $this->db->count_all_results();
        if ($query_result) {
            return array('open' => 1);
        } else {
            return array('open' => 0);
        }
    }

    public function set_mem_status($data = null)
    {
        $tmp = array(
            'mem_status' => 1,
        );
        $this->db->where('mem_contact_id', $data['contact_id']);
        $this->db->update('tbl_contact_member', $tmp);
    }

    public function getReportDetailData($data)
    {
        $this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as delivery_name', false);
        $this->db->select('tbl_report.*', false);
        $this->db->select('tbl_check_list.chc_id', false);
        $this->db->select('tbl_hospital.hospital_class', false);
        $this->db->from('tbl_patient_booking');
        $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
        $this->db->join('tbl_check_list', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $this->db->order_by('booking_time');
        $this->db->group_by('tbl_patient_booking.booking_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_bk_status()
    {
        $this->db->select('tbl_booking_status.*', false);
        $this->db->from('tbl_booking_status');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function search_report($data = null)
    {
        $this->db->select('tbl_check_list.*, tbl_check_list.checkup_time as check_time', false);
        $this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as delivery_name', false);
        $this->db->select('tbl_report.*', false);
        $this->db->select('tbl_deliberation.doctor_name, deliberation_time', false);
        $this->db->select('tbl_hospital.hospital_class', false);
        $this->db->from('tbl_check_list');
        $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id', 'left');
        $this->db->join('tbl_deliberation', 'tbl_deliberation.deli_rpt_id = tbl_report.report_id', 'left');
        $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $this->db->order_by('checkup_time', 'desc');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_reportdata_by_id($report_id = null)
    {
        $this->db->select('tbl_check_list.*, tbl_check_list.checkup_time as check_time', false);
        $this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as delivery_name', false);
        $this->db->select('tbl_report.*', false);
        $this->db->select('tbl_deliberation.doctor_name, deliberation_id', false);
        $this->db->select('tbl_hospital.hospital_class', false);
        $this->db->from('tbl_check_list');
        $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id', 'left');
        $this->db->join('tbl_deliberation', 'tbl_deliberation.deli_rpt_id = tbl_report.report_id', 'left');
        $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
        $this->db->where('tbl_report.report_id', $report_id);
        $this->db->order_by('checkup_time', 'desc');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_patient_by_booking_id($booking_id = null)
    {
        $this->db->select('tbl_patient_booking.*', false);
        $this->db->select('tbl_check_list.*', false);
        $this->db->from('tbl_check_list');
        $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        if ($booking_id) {
            $this->db->where('tbl_patient_booking.booking_id', $booking_id);
        }
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function save_report_log($report_id = null)
    {
        if (!$report_id) {
            return false;
        }
        $data = array(
          'rpt_id' => $report_id,
          'created_at'  => date('Y-m-d h:i:s')
        );
        $this->_table_name = "tbl_report_log";
        $this->_primary_key = "id";
        $this->save($data);
        return true;
    }
}
