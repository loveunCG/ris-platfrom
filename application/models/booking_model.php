<?php
class Booking_model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
    }
    public function get_login()
    {
        $where = array('username' => $this->input->post('username'), 'password' => md5($this->input->post('password')));
        $this->db->select('admin_user.*', false);
        $this->db->from('admin_user');
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getMaxDeviceList()
    {
        $data = [];
        if ($this->session->userdata('usr_role') == 1) {
            $data['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } else {
            $data['hospital_name'] = $this->session->userdata('hospital_name');
        }
        $this->db->select('tbl_device.equipment_type', false);
        $this->db->select('tbl_hospital.hospital_name', false);
        $this->db->from('tbl_device');
        $this->db->join('tbl_hospital', 'tbl_hospital.hospital_name = tbl_device.dev_hos_name', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $this->db->group_by('equipment_type');
        $query_result = $this->db->get();
        $typeIfo = $query_result->result();
        $tmp = 0;
        foreach ($typeIfo as $value) {
            $this->db->select('*', false);
            $this->db->from('tbl_device');
            $this->db->select('tbl_hospital.hospital_name', false);
            $this->db->join('tbl_hospital', 'tbl_hospital.hospital_name = tbl_device.dev_hos_name', 'left');
            if ($data) {
                $this->db->where($data);
            }
            $this->db->where(array('equipment_type' => $value->equipment_type));
            $query_result = $this->db->get();
            $result = $query_result->result();
            $count = count($result);
            if ($count >= $tmp) {
                $tmp = $count;
            }
        }
        return $tmp;
    }

    public function getEquip_type()
    {
        $this->db->select('*', false);
        $this->db->from('tbl_device');
        // $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function patient_listinfo()
    {
        $image_num = $this->input->post('image_num');
        $pat_name = $this->input->post('patient_name');
        $pat_sex = $this->input->post('gender');
        $pat_type = $this->input->post('pat_type');
        $pat_position = $this->input->post('pat_position');
        $pat_state = $this->input->post('pat_state');
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $this->db->select('*', false);
        $this->db->from('tbl_patient_booking');
        // $this->db->where($where);
        if ($image_num != '') {
            $this->db->where('image_num', $image_num);
        }
        if ($pat_name != '') {
            $this->db->where('patient_name', $pat_name);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function checked_equip($equip_id)
    {
        $this->db->select('*', false);
        $this->db->from('check_preview');
        $this->db->where('check_date', date("Y-m-d"));
        $this->db->where('check_equip', $equip_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
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

    public function getslistview()
    {
        $patient_name = $_REQUEST['patient_name'];
        $image_num = $_REQUEST['image_num'];
        $patient_name = $_REQUEST['patient_name'];
        $patient_name = $_REQUEST['patient_name'];
        $patient_name = $_REQUEST['patient_name'];

        $this->db->select('*', false);
        $this->db->from('tbl_patient_booking');
        if ($patient_name != '') {
            $this->db->where('patient_name', $patient_name);
        }
        if ($image_num != '') {
            $this->db->where('image_num', $image_num);
        }

        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getBookinglist()
    {
        $this->db->select('*', false);
        $this->db->from('tbl_patient_booking');
        $this->db->order_by('booking_time', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_module($data = null)
    {
        $this->db->select('tbl_checkup_item.*', false);
        $this->db->select('tbl_module_class.*', false);
        $this->db->select('tbl_device.id as device_id', false);
        $this->db->select('tbl_hospital.hospital_name', false);
        $this->db->from('tbl_checkup_item');
        $this->db->join('tbl_module_class', 'tbl_module_class.class_id = tbl_checkup_item.checkup_class', 'left');
        $this->db->join('tbl_device', 'tbl_device.equipment_num = tbl_checkup_item.checkup_device', 'left');
        $this->db->join('tbl_hospital', 'tbl_checkup_item.chc_hos_name = tbl_hospital.hospital_name', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_device_type()
    {
        $this->db->select('tbl_device.equipment_type', false);
        $this->db->from('tbl_device');
        $this->db->group_by('equipment_type');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function all_get_device()
    {
        $this->db->select('tbl_device.*', false);
        $this->db->select('tbl_hospital.hospital_name', false);
        $this->db->from('tbl_device');
        $this->db->join('tbl_hospital', 'tbl_device.dev_hos_name = tbl_hospital.hospital_name', 'left');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_device($data = null)
    {
        $this->db->select('tbl_device.*', false);
        $this->db->select('tbl_hospital.hospital_name', false);
        $this->db->from('tbl_device');
        $this->db->join('tbl_hospital', 'tbl_device.dev_hos_name = tbl_hospital.hospital_name', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $this->db->group_by('tbl_device.id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_checkinfo($data = null)
    {
        $this->db->select('tbl_checkup_item.*', false);
        $this->db->from('tbl_checkup_item');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getBookingInfo($data = null)
    {
        $this->db->select('tbl_check_list.*', false);
        $this->db->select('tbl_patient_booking.*', false);
        $this->db->select('tbl_device.*', false);
        $this->db->from('tbl_check_list');
        $this->db->join('tbl_patient_booking', 'tbl_check_list.chc_booking_id = tbl_patient_booking.booking_id', 'left');
        $this->db->join('tbl_device', 'tbl_device.equipment_num = tbl_check_list.checkup_equipment', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $this->db->order_by('tbl_check_list.checkup_time');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_consultation_info($data = null)
    {
        $this->db->select('tbl_checkup_item.*', false);
        $this->db->select('tbl_device.*', false);
        $this->db->from('tbl_device');
        $this->db->join('tbl_checkup_item', 'tbl_checkup_item.device_type = tbl_device.equipment_type', 'left');
        if ($data) {
            $this->db->where($data);
        }

        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_patient_info($data = null)
    {
        $this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as bk_id', false);
        $this->db->select('tbl_report.*', false);
        $this->db->select('tbl_check_list.chc_id', false);
        $this->db->select('tbl_hospital.hospital_class, ', false);
        $this->db->from('tbl_patient_booking');
        $this->db->join('tbl_check_list', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id', 'left');
        $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $this->db->group_by('tbl_patient_booking.booking_id');
        $this->db->order_by('checkup_time', 'desc');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_roominfo($data = null)
    {
        $this->db->select('tbl_patient_booking.*', false);
        $this->db->select('tbl_check_list.*', false);
        $this->db->select('tbl_device.*', false);
        $this->db->from('tbl_check_list');
        $this->db->order_by('tbl_check_list.checkup_time');
        $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
        $this->db->join('tbl_device', 'tbl_check_list.checkup_equipment = tbl_device.equipment_num', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
}
