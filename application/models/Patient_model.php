<?php
class Patient_model extends MY_Model {
	public $_table_name;
	public $_order_by;
	public $_primary_key;

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}
	public function get_patient_info($data = null) {
		$this->db->select('tbl_patient_booking.*, tbl_patient_booking.booking_id as bk_id', false);
		$this->db->select('tbl_report.*', false);
		$this->db->select('tbl_check_list.*', false);
		$this->db->select('tbl_checkup_item.*', false);
		$this->db->from('tbl_check_list');
		$this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
		$this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.report_id', 'left');
		$this->db->join('tbl_checkup_item', 'tbl_checkup_item.check_item = tbl_check_list.checkup_item', 'left');
		if ($data) {
			$this->db->where($data);
		}
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	function get_self_info() {
		$patient_id = $this->session->userdata('id');
		$this->db->select('tbl_patient.*', false);
		$this->db->select('tbl_patient_booking.*', false);
		$this->db->from('tbl_patient');
		$this->db->join('tbl_patient_booking', 'tbl_patient_booking.license_num = tbl_patient.pat_IdNum', 'left');
		$this->db->join('tbl_hospital', 'tbl_hospital.hospital_name = tbl_patient_booking.hospital_name', 'left');
		$this->db->where(['tbl_patient.id' => $patient_id]);
		$query_result = $this->db->get();
		$result = $query_result->row();
		return $result;
	}

	public function past_get_dicom_url($booking_id = null) {
		$this->db->select('*', false);
		$this->db->from('tbl_patient_booking');
		$this->db->where('booking_id', $booking_id);
		$query_result = $this->db->get();
		$result = $query_result->row();
		return $result;
	}

	public function get_check_iteminfo($data = null) {
		$this->db->select('tbl_checkup_item.*', false);
		$this->db->from('tbl_checkup_item');
		if ($data) {
			$this->db->where($data);
		}
		$query_result = $this->db->get();
		$result = $query_result->result();
		return $result;
	}

	public function logout() {
		$this->session->sess_destroy();
	}

	public function search_report($data = null) {
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
}
