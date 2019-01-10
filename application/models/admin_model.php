<?php
class Admin_model extends MY_Model {
	public $_table_name;
	public $_order_by;
	public $_primary_key;

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_userinfo($data = null) {
		$this->db->select('tbl_doctor.*', false);
		$this->db->select('tbl_department.*', false);
		$this->db->select('tbl_hospital.*', false);
		$this->db->from('tbl_doctor');
		$this->db->join('tbl_department', 'tbl_doctor.usr_department = tbl_department.department_name', 'left');
		$this->db->join('tbl_hospital', 'tbl_doctor.usr_hospital = tbl_hospital.hospital_name', 'left');
		if ($data) {
			$this->db->where($data);
		}
		$this->db->group_by('tbl_doctor.id');
		$this->db->order_by('usr_create_time', 'desc');
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function getHospitalClass($data = null) {
		$this->db->select('tbl_hospital.*', false);
		$this->db->from('tbl_hospital');
		if ($data) {
			$this->db->where($data);
		}
		$this->db->group_by('tbl_hospital.hospital_class');
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function get_hospitalinfo($data = null) {
		$this->db->select('tbl_hospital.*', false);
		$this->db->from('tbl_hospital');
		if ($data) {
			$this->db->where($data);
		}
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function get_deviceinfo($data = null) {
		$this->db->select('tbl_device.*', false);
		$this->db->select('tbl_hospital.hospital_class', false);
		$this->db->from('tbl_device');
		$this->db->join('tbl_hospital', 'tbl_device.dev_hos_name = tbl_hospital.hospital_name', 'left');
		if ($data) {
			$this->db->where($data);
		}
		$this->db->order_by('add_time', 'desc');
		$this->db->group_by('tbl_device.id');
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function get_check_iteminfo($data = null) {
		$this->db->select('tbl_checkup_item.*', false);
		$this->db->select('tbl_module_class.*', false);
		$this->db->select('tbl_hospital.hospital_class', false);
		$this->db->from('tbl_checkup_item');
		$this->db->join('tbl_module_class', 'tbl_module_class.class_id = tbl_checkup_item.checkup_class', 'left');
		$this->db->join('tbl_hospital', 'tbl_hospital.hospital_name = tbl_checkup_item.chc_hos_name', 'left');
		if ($data) {
			$this->db->where($data);
		}
		$this->db->order_by('add_time', 'desc');
		$this->db->group_by('tbl_checkup_item.id');
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function get_equipment_room() {
		$this->db->select('tbl_device.equioment_room', false);
		$this->db->from('tbl_device');
		$this->db->group_by('equioment_room');
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function get_device_type() {
		$this->db->select('tbl_device.equipment_type', false);
		$this->db->from('tbl_device');
		$this->db->group_by('equipment_type');
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function get_equipment_department() {
		$this->db->select('tbl_device.equipment_deaprtment', false);
		$this->db->from('tbl_device');
		$this->db->group_by('equipment_deaprtment');
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function get_checkinfo($data = null) {
		$this->db->select('tbl_device.*', false);
		$this->db->from('tbl_device');
		if ($data) {
			$this->db->where($data);
		}
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function get_departmentinfo() {
		$this->db->select('tbl_department.*', false);
		$this->db->from('tbl_department');
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function loggedin() {
		return (bool) $this->session->userdata('loggedin');
	}

	public function get_device_info($data = null) {
		$this->db->select('tbl_device.*', false);
		$this->db->select('tbl_working_interval.*', false);
		$this->db->from('tbl_device');
		$this->db->join('tbl_working_interval', 'tbl_working_interval.wi_device_id = tbl_device.id', 'left');
		if ($data) {
			$this->db->where($data);
		}
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function GetPatientInfo($data = null) {
		$this->db->select('tbl_patient.*', false);
		$this->db->select('tbl_patient_booking.*', false);
		$this->db->from('tbl_patient');
		$this->db->join('tbl_patient_booking', 'tbl_patient_booking.license_num = tbl_patient.pat_IdNum', 'left');
		$this->db->join('tbl_hospital', 'tbl_hospital.hospital_name = tbl_patient_booking.hospital_name', 'left');
		if ($data) {
			$this->db->where($data);
		}
		$this->db->group_by('tbl_patient.id');
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function selectCheckupDeviceType($data = null) {
		$this->db->select('tbl_device.*', false);
		$this->db->select('tbl_hospital.hospital_class', false);
		$this->db->from('tbl_device');
		$this->db->join('tbl_hospital', 'tbl_hospital.hospital_name = tbl_device.dev_hos_name', 'left');
		if ($data) {
			$this->db->where($data);
		}
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}
}
