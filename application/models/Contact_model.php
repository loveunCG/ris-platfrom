<?php

class Contact_model extends MY_Model {
	public $_table_name;
	public $_order_by;
	public $_primary_key;

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	public function get_patient_info_by_id($data = null) {
		$this->db->select('tbl_patient_booking.*', false);
		$this->db->from('tbl_patient_booking');
		if ($data) {
			$this->db->where($data);
		}
		$query_result = $this->db->get();
		$result = $query_result->row();
		return $result;
	}

}
