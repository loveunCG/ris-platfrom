<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DicomCtrl extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->lang->load('cn', 'chinese');
		$this->load->model('report_model');
	}

	public function index() {
	}

	public function dicom_view($md_bk = null) {
		$booking_id = $this->input->get('bk');
		$md_img = $this->input->get('img');
		$data['booking_data'] = $booking_data = $this->report_model->get_patient_by_booking_id($booking_id);
		if (md5($booking_data->image_num) == $md_img && $md_bk == md5($booking_id)) {
			$data['menutitle'] = $this->lang->line('report');
			$this->load->view('dicom/dicomView_mobile', $data);
		} else {
			$this->load->view('errors/html/error_404');
			log_message('error', 'Some variable did not contain a value.');
		}
	}
}
