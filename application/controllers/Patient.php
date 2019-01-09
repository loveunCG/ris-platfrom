<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patient extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->lang->load('cn', 'chinese');
		$this->load->model('patient_model');
		$this->load->model('booking_model');
		$this->load->model('report_model');
		$loggedined = $this->session->userdata('usr_status');
		if ($loggedined != '1') {
			redirect('login');
		}
	}

	public function index() {
		$data['title'] = 'jp';
		$data['menutitle'] = 'jp';
		$data['info'] = $this->patient_model->get_self_info();
		$data['subview'] = $this->load->view('patient/index', $data, true);
		$this->load->view('patient/layout', $data);
	}

	public function patient_table($sdata = null) {
		$sdata['license_num'] = $this->session->userdata('pat_IdNum');

		$result_data = $this->patient_model->search_report($sdata);

		$i = 1;

		$data['data'] = [];
		if ($result_data) {
			foreach ($result_data as $value) {
				if (!$value->del_status) {
					if ($value->patient_gender == '1') {
						$gender = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
					} else {
						$gender = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
					}
					if ($value->remote_status == '1') {
						$remote_status = '<button type="button" class="btn red">是</button>';

					} else {
						$remote_status = '<button type="button" class="btn blue">否</button>';
					}
					if ($value->patient_source == '0') {
						$patient_source = '<span type="button" class="btn red">门诊</span>';
					} elseif ($value->patient_source == '1') {
						$patient_source = '<button type="button" class="btn blue">住院</button>';
					} else {
						$patient_source = '<button type="button" class="btn dark">体检</button>';
					}

					$checkup_status = '';
					$action = '';
					if ($value->checkup_status == 0 || $value->checkup_status == 1 || $value->checkup_status == 3 || $value->checkup_status == 7) {
						continue;
					}
					if ($value->checkup_status == '2') {
						$checkup_status = '<span class="col-md-12 badge badge-info text-white">未提交</span>';
						$action = '<a onclick="dicom_view(' . $value->chc_id . ')" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">account_balance_wallet</i></a>';
					} elseif ($value->checkup_status == '4') {
						$checkup_status = '<span  class="col-md-12 badge badge-warning text-white"> 已提交 </span>';
						$action = '<a onclick="dicom_view(' . $value->chc_id . ')" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">account_balance_wallet</i></a>';
					} elseif ($value->checkup_status == '5') {
						$checkup_status = '<span  class="col-md-12 badge badge-success text-white"> 已审核 </span>';
						$action = '<a onclick="dicom_view(' . $value->chc_id . ')" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">account_balance_wallet</i></a>';
						$action .= '<a onclick="reportView(' . $value->report_id . ')" class="btn-floating btn-small blue waves-effect waves-light red"><i class="material-icons">content_paste</i></a>';
					}
					try {
						$user_name = $this->report_model->get_user_info(array('usr_id' => $value->report_doc_name));
						$user_name = isset($user_name[0]) ? $user_name[0]->usr_name : '';
					} catch (Exception $e) {
						$user_name = '没有';
					}
					$data['data'][] = [
						$action,
						$i++,
						$value->patient_code,
						$value->booking_time,
						$value->checkup_time,
						$value->checkup_type,
						$value->checkup_item,
						$checkup_status,
						$user_name,
						$value->doctor_name == null ? ' ' : $value->doctor_name,
						$value->hospital_name,
					];

				}
			}
		}

		echo json_encode($data);
	}

	public function getPatientBookingInfo($id = null) {
		$sdata = array('tbl_patient_booking.booking_id' => $id);
		$result_data = $this->patient_model->get_patient_info($sdata)[0];
		echo json_encode($result_data);
	}

	public function viewDicom($booking_id = null) {
		$data['dicom_url'] = $this->patient_model->past_get_dicom_url($booking_id);
		$data['menutitle'] = $this->lang->line('report');
		$data['subview'] = $this->load->view('dicom/dicom_test', $data, true);
		$this->load->view('dicom/patientLayout', $data);
	}

	public function viewReport($booking_id = null) {
		$data['module'] = $this->report_model->get_module();
		$data['device_class'] = $this->report_model->get_device_class();
		$data['module_class'] = $this->report_model->get_module_class();
		$data['template'] = $this->report_model->get_template_data();
		$data['past_report_data'] = $this->report_model->past_get_data($booking_id);
		$data['report_data'] = $this->report_model->get_data($booking_id);
		$data['menutitle'] = $this->lang->line('report');
		$sdata = array('tbl_patient_booking.booking_id' => $booking_id);
		$data['report_data'] = $this->report_model->get_report_data($sdata);
		$data['subview'] = $this->load->view('report/report_detail_view', $data, true);
		$this->load->view('patient/layout', $data);
	}

	public function getPatientsession() {
		echo json_encode(array('status' => 'success'));
	}

	public function dicomProc($chc_id = null) {
		$data['booking_data'] = $this->report_model->get_checkup_data_by_id($chc_id);
		$data['menutitle'] = $this->lang->line('report');
		$this->load->view('dicom/dicomView', $data);
	}

	public function ajax_report_detail_view($chc_id = null) {
		$data['report_table'] = $this->report_model->report_data_for_reporting($chc_id);
		$this->load->view('report/ajax_report_detail_view', $data);
	}

	public function reporting_view($report_id = null) {
		$data['menutitle'] = $this->lang->line('report');
		$search_data = ['tbl_report.report_id' => $report_id];
		try {
			$data['report_data'] = $this->report_model->get_report_data($search_data)[0];
		} catch (Exception $e) {
		}

		$data['subview'] = $this->load->view('report/report_detail', $data, true);
		$this->load->view('patient/layout', $data);
	}
}
