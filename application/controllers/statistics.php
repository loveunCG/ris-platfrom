<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Statistics extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->lang->load('cn', 'chinese');
		$this->load->model('statistics_model');
		$this->load->model('admin_model');
		$this->load->model('report_model');
	}

	public function index() {
		$data = array();
		$data['menutitle'] = '';
		$data['subview'] = $this->load->view('statistics/bookingStatistics', $data, true);
		$this->load->view('layout', $data);
	}

	public function bookingStatistics() {
		$data = array();
		$data['menutitle'] = '';
		$data['subview'] = $this->load->view('statistics/bookingStatistics', $data, true);
		$this->load->view('layout', $data);
	}

	public function diagnosisStatistics() {
		$data = array();
		$data['menutitle'] = '';
		$data['subview'] = $this->load->view('statistics/diagnosisStatistics', $data, true);
		$this->load->view('layout', $data);
	}

	public function remoteStatistics() {
		$data = array();
		$data['menutitle'] = '';
		$data['subview'] = $this->load->view('statistics/remoteStatistics', $data, true);
		$this->load->view('layout', $data);
	}

	public function get_booking_data() {
		$result = $this->statistics_model->get_booking_data();
		$i = 1;
		$data['data'] = [];
		if ($result) {
			foreach ($result as $value) {
				if (!$value->del_status) {
					if ($value->patient_gender == '1') {
						$gender = '女';
					} else {
						$gender = '男';
					}
					switch ($value->patient_source) {
					case '0':{
							$patient_source = '门诊';
							break;
						}
					case '1':{
							$patient_source = '住院';
							break;
						}
					case '2':{
							$patient_source = '体检';
							break;
						}
					}
					$data['data'][] = array(
						$i++,
						$value->patient_code,
						$value->patient_name,
						$gender,
						$value->patient_age,
						$value->booking_time,
						$value->hospital_name,
						$patient_source,
						$value->req_doctor_name,
						"<a style=\"color:#32c5d2\" href='" . base_url() . "booking/booking_checkup/" . $value->booking_id . "'>查看详细</a>",
					);
				}
			}
		}
		echo json_encode($data);
	}

	public function get_booking_amount() {
		$result = $this->statistics_model->get_booking_amount();
		echo json_encode($result);
	}

	public function search_booking_amount() {
		$search_data = array();
		if ($this->input->get('start_time') != "") {
			$search_data['start_time'] = $this->input->get('start_time');
		}
		if ($this->input->get('end_time') != "") {
			$search_data['end_time'] = $this->input->get('end_time');
		}
		if ($this->input->get('hospital_name') != "") {
			$search_data['tbl_patient_booking.hospital_name'] = $this->input->get('hospital_name');
		}
		if ($this->input->get('patient_source') != "") {
			$search_data['patient_source'] = $this->input->get('patient_source');
		}
		$result = $this->statistics_model->search_booking_amount($search_data);
		echo json_encode($result);
	}

	public function search_booking_data() {
		$search_data = array();
		if ($this->input->get('start_time') != "") {
			$search_data['booking_time >='] = $this->input->get('start_time');
		}
		if ($this->input->get('end_time') != "") {
			$search_data['booking_time <'] = $this->input->get('end_time');
		}
		if ($this->input->get('hospital_name') != "") {
			$search_data['tbl_patient_booking.hospital_name'] = $this->input->get('hospital_name');
		}
		if ($this->input->get('patient_source') != "") {
			$search_data['patient_source'] = $this->input->get('patient_source');
		}
		$result = $this->statistics_model->search_booking_data($search_data);
		$i = 1;
		$data['data'] = [];
		if ($result) {
			foreach ($result as $value) {
				if (!$value->del_status) {
					if ($value->patient_gender == '1') {
						$gender = '女';
					} else {
						$gender = '男';
					}
					switch ($value->patient_source) {
					case '0':{
							$patient_source = '门诊';
							break;
						}
					case '1':{
							$patient_source = '住院';
							break;
						}
					case '2':{
							$patient_source = '体检';
							break;
						}
					}
					$data['data'][] = array(
						$i++,
						$value->patient_code,
						$value->patient_name,
						$gender,
						$value->patient_age,
						$value->booking_time,
						$value->hospital_name,
						$patient_source,
						$value->req_doctor_name,
						"<a style=\"color:#32c5d2\" href='" . base_url() . "booking/booking_checkup/" . $value->booking_id . "'>查看详细</a>",
					);
				}
			}
		}

		echo json_encode($data);
	}

	public function get_diagnosis_data() {
		$result = $this->statistics_model->get_diagnosis_data();
		$data['data'] = [];
		//echo var_dump($result);
		$i = 1;
		if ($result) {
			foreach ($result as $value) {
				if (!$value->del_status) {
					if ($value->patient_gender == '1') {
						$gender = '女';
					} else {
						$gender = '男';
					}

					$data['data'][] = array(
						$i++,
						$value->patient_code,
						$value->patient_name,
						$gender,
						$value->patient_age,
						$value->checked_time,
						$value->hospital_name,
						$value->checkup_type,
						$value->req_doctor_name,
						$value->doctor_name,
						"<a style=\"color:#32c5d2\" href='" . base_url() . "report/reporting_view/" . $value->report_id . "'>查看详细</a>",
					);
				}
			}
		}
		echo json_encode($data);
	}

	public function get_diagnosis_amount() {
		$result = $this->statistics_model->get_diagnosis_amount();
		echo json_encode($result);
	}

	public function search_diagnosis_data() {
		$search_data = array();
		if ($this->input->get('start_time') != "") {
			$search_data['start_time'] = $this->input->get('start_time');
		}
		if ($this->input->get('end_time') != "") {
			$search_data['end_time'] = $this->input->get('end_time');
		}
		if ($this->input->get('hospital_name') != "") {
			$search_data['tbl_patient_booking.hospital_name'] = $this->input->get('hospital_name');
		}
		if ($this->input->get('checkup_type') != "") {
			$search_data['checkup_type'] = $this->input->get('checkup_type');
		}
		$result = $this->statistics_model->search_diagnosis_data($search_data);
		$i = 1;
		$data['data'] = [];
		if ($result) {
			foreach ($result as $value) {
				if (isset($search_data['checkup_type'])) {
					if (strpos($value->checkup_type, $search_data['checkup_type']) < 1) {
						continue;
					}
				}
				if (!$value->del_status) {
					if ($value->patient_gender == '1') {
						$gender = '女';
					} else {
						$gender = '男';
					}

					$data['data'][] = array(
						$i++,
						$value->patient_code,
						$value->patient_name,
						$gender,
						$value->patient_age,
						$value->checked_time,
						$value->hospital_name,
						$value->checkup_type,
						$value->req_doctor_name,
						$value->doctor_name,
						"<a style=\"color:#32c5d2\" href='" . base_url() . "report/reporting_view/" . $value->report_id . "'>查看详细</a>",
					);
				}
			}
		}
		echo json_encode($data);
	}

	public function search_diagnosis_amount() {
		$search_data = array();
		if ($this->input->get('start_time') != "") {
			$search_data['start_time'] = $this->input->get('start_time');
		}
		if ($this->input->get('end_time') != "") {
			$search_data['end_time'] = $this->input->get('end_time');
		}
		if ($this->input->get('hospital_name') != "") {
			$search_data['tbl_patient_booking.hospital_name'] = $this->input->get('hospital_name');
		}
		if ($this->input->get('checkup_type') != "") {
			$search_data['checkup_type'] = $this->input->get('checkup_type');
		}
		$result = $this->statistics_model->search_diagnosis_amount($search_data);
		echo json_encode($result);
	}

	public function get_remote_data() {
		$result = $this->statistics_model->get_remote_data();
		//echo var_dump($result);
		$data['data'] = [];
		$i = 1;
		if ($result) {
			foreach ($result as $value) {
				if (!$value->del_status) {
					if ($value->patient_gender == '1') {
						$gender = '女';
					} else {
						$gender = '男';
					}
					switch ($value->contact_type) {
					case '0':{
							$contact_type = '远程会诊';
							break;
						}
					case '1':{
							$contact_type = '远程门诊';
							break;
						}
					}
					$data['data'][] = array(
						$i++,
						$value->patient_code,
						$value->patient_name,
						$gender,
						$value->patient_age,
						$value->submit_time,
						$value->req_hospital,
						$contact_type,
						$value->req_doctor_name,
						$value->doctor_name,
						"<a style=\"color:#32c5d2\" href='" . base_url() . "report/contactDetail/" . $value->contact_id . "'>查看详细</a>",
					);
				}
			}

		}

		echo json_encode($data);
	}

	public function get_remote_amount() {
		$result = $this->statistics_model->get_remote_amount();
		echo json_encode($result);
	}

	public function search_remote_data() {
		$search_data = array();
		if ($this->input->get('start_time') != "") {
			$search_data['submit_time >='] = $this->input->get('start_time');
		}
		if ($this->input->get('end_time') != "") {
			$search_data['submit_time <'] = $this->input->get('end_time');
		}
		if ($this->input->get('hospital_name') != "") {
			$search_data['req_hospital'] = $this->input->get('hospital_name');
		}
		if ($this->input->get('contact_type') != "") {
			$search_data['contact_type'] = $this->input->get('contact_type');
		}
		$result = $this->statistics_model->search_remote_data($search_data);
		$i = 1;
		$data['data'] = [];
		if ($result) {
			foreach ($result as $value) {
				if (!$value->del_status) {
					if ($value->patient_gender == '1') {
						$gender = '女';
					} else {
						$gender = '男';
					}
					switch ($value->contact_type) {
					case '0':{
							$contact_type = '远程会诊';
							break;
						}
					case '1':{
							$contact_type = '远程门诊';
							break;
						}
					}
					$data['data'][] = array(
						$i++,
						$value->patient_code,
						$value->patient_name,
						$gender,
						$value->patient_age,
						$value->submit_time,
						$value->req_hospital,
						$contact_type,
						$value->req_doctor_name,
						$value->doctor_name,
						"<a style=\"color:#32c5d2\" href='" . base_url() . "report/contactDetail/" . $value->contact_id . "'>查看详细</a>",
					);
				}
			}
		}
		echo json_encode($data);
	}

	public function search_remote_amount() {
		$search_data = array();
		if ($this->input->get('start_time') != "") {
			$search_data['start_time'] = $this->input->get('start_time');
		}
		if ($this->input->get('end_time') != "") {
			$search_data['end_time'] = $this->input->get('end_time');
		}
		if ($this->input->get('hospital_name') != "") {
			$search_data['req_hospital'] = $this->input->get('hospital_name');
		}
		if ($this->input->get('contact_type') != "") {
			$search_data['contact_type'] = $this->input->get('contact_type');
		}
		$result = $this->statistics_model->search_remote_amount($search_data);
		echo json_encode($result);
	}
}
