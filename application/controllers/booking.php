<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends CI_Controller {

	public function __construct() {
		parent::__construct();
		parent::__construct();
		$this->load->library('session');
		$this->lang->load('cn', 'chinese');

		$this->load->model('booking_model');
		$this->load->model('admin_model');
	}

	public function index() {
		$data['menutitle'] = $this->lang->line('booking');
		// $this->booking_model->_table_name = "tbl_patient_booking"; //table name
		// $this->booking_model->_order_by = "booking_id";
		$data['module_class'] = $this->booking_model->get_module_class();
		$booking_info = $this->booking_model->getBookinglist();
		$data['booking_list'] = $booking_info;
		if ($booking_info[0] == "") {
			$data['image_num'] = 10000000000;
		} else {
			$data['image_num'] = $booking_info[0]->image_num + 1;
		}
		$data['equip_type'] = $this->booking_model->getEquip_type(); //장비류형선택
		$today = date("Y-m-d");
		$this->booking_model->_table_name = "tbl_module_class"; //table name
		$this->booking_model->_order_by = "class_id";
		$data['check_menu'] = $this->booking_model->get();
		if ($id) {
			$this->booking_model->_table_name = "tbl_patient_booking"; //table name
			$this->booking_model->_order_by = "booking_id";
			$data['booking_edit_info'] = $this->booking_model->get_by(array('booking_id' => $id), true);
		}
		$this->booking_model->_table_name = "tbl_checkup_item"; //table name
		$this->booking_model->_order_by = "id";
		$data['check_sub_menu'] = $this->booking_model->get();
		$data['equipment_type'] = $this->booking_model->get_device_type();
		$data['all_device_info'] = $this->booking_model->all_get_device();

		$data['subview'] = $this->load->view('booking/booking_checkup', $data, true);
		$this->load->view('layout', $data);
	}

	public function booking_checkup($id = null) {
		$data['menutitle'] = $this->lang->line('booking');
		// $this->booking_model->_table_name = "tbl_patient_booking"; //table name
		// $this->booking_model->_order_by = "booking_id";
		$data['module_class'] = $this->booking_model->get_module_class();
		$booking_info = $this->booking_model->getBookinglist();
		$data['booking_list'] = $booking_info;
		if ($booking_info[0] == "") {
			$data['image_num'] = 10000000000;
		} else {
			$data['image_num'] = $booking_info[0]->image_num + 1;
		}
		$data['equip_type'] = $this->booking_model->getEquip_type(); //장비류형선택
		$today = date("Y-m-d");
		$this->booking_model->_table_name = "tbl_module_class"; //table name
		$this->booking_model->_order_by = "class_id";
		$data['check_menu'] = $this->booking_model->get();
		if ($id) {
			$this->booking_model->_table_name = "tbl_patient_booking"; //table name
			$this->booking_model->_order_by = "booking_id";
			$data['booking_edit_info'] = $this->booking_model->get_by(array('booking_id' => $id), true);
			$this->booking_model->_table_name = "tbl_check_list"; //table name
			$this->booking_model->_order_by = "chc_id";
			$data['booking_check_info'] = $this->booking_model->get_by(array('chc_booking_id' => $id), false);
		}
		$this->booking_model->_table_name = "tbl_checkup_item"; //table name
		$this->booking_model->_order_by = "id";
		$data['check_sub_menu'] = $this->booking_model->get();
		$data['check_sub_menu'] = $this->booking_model->get();
		$data['equipment_type'] = $this->booking_model->get_device_type();
		$data['all_device_info'] = $this->booking_model->all_get_device();
		$data['module_data'] = $this->booking_model->get_module();



		$data['subview'] = $this->load->view('booking/booking_checkup', $data, true);
		$this->load->view('layout', $data);
	}

	public function delete_patient($booking_id = null) {
		$update = array('del_status' => $this->session->userdata('usr_id'));
		$where = array('booking_id' => $booking_id);
		$res = $this->booking_model->set_action($where, $update, 'tbl_patient_booking');
		$this->db->delete('tbl_check_list', array('chc_booking_id' => $booking_id));
		if ($res) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'error'));
		}
	}

	public function search_patient() {
		if ($this->input->post('image_num')) {
			$data['image_num'] = $this->input->post('image_num');
		}
		if ($this->input->post('patient_name')) {
			$data['patient_name'] = $this->input->post('patient_name');
		}
		if ($this->input->post('patient_age')) {
			$data['patient_age'] = $this->input->post('patient_age');
		}
		if ($this->input->post('patient_gender') != "") {
			$data['patient_gender'] = $this->input->post('patient_gender');
		}
		if ($this->input->post('device_type')) {
			$data['checkup_type'] = $this->input->post('device_type');
		}
		if (!$this->input->post('patient_source') || $this->input->post('patient_source') == "0") {
			$data['patient_source'] = $this->input->post('patient_source');
		}
		if ($this->input->post('remote_status') != "") {
			$data['remote_status'] = $this->input->post('remote_status');
		}
		if (($this->input->post('start_time') != "") || ($this->input->post('start_time'))) {
			$data['booking_time >='] = $this->input->post('start_time');
		}
		if (($this->input->post('end_time') != "") || ($this->input->post('end_time'))) {
			$data['booking_time <='] = $this->input->post('end_time');
		}
		$data['booking_list'] = $this->booking_model->get_patient_info($data);
		$data['start_time'] = $this->input->post('start_time');
		$data['end_time'] = $this->input->post('end_time');
		$data['device_type'] = $this->input->post('device_type');
		$data['all_device_info'] = $this->booking_model->all_get_device();
		$data['subview'] = $this->load->view('booking/booking_table', $data, true);
		$this->load->view('layout', $data);
	}

	public function booking_listview() {

		$data['all_device_info'] = $this->booking_model->get_device_type();
		$data['booking_list'] = $this->booking_model->get_patient_info();
		$data['subview'] = $this->load->view('booking/booking_table', $data, true);
		$this->load->view('layout', $data);
	}

	public function save_patient() {
		$data = $this->booking_model->array_from_get(array(
			'image_num',
			'patient_name',
			'patient_gender',
			'patient_type',
			'patient_age',
			'patient_phone_num',
			'license_num',
			'patient_code',
			'patient_pinyin',
			'req_doctor_name',
			'req_branch',
			'hospital_num',
			'room_num',
			'patient_birthday',
			'bed_num',
			'cost_type',
			'clinical_diagnosis',
			'health_insurance_num',
			'clinic_num',
			'social_security_num',
			'patient_address',
			'patient_remark',
			'hospital_name',
			'patient_source',
		));
		$booking_id = $this->input->get('booking_id');
		$data['booking_time'] = date('Y-m-d h:i:s');
		$data['booking_status'] = '1';
		$data['remote_status'] = '0';
		$data['patient_age'] = $this->input->get('patient_age', true);
		if ($booking_id) {
			$where = array('booking_id' => $booking_id);
			$this->booking_model->set_action($where, $data, 'tbl_patient_booking');		
			$this->db->delete('tbl_check_list', array('chc_booking_id' => $booking_id));				
			$checkup_type = $this->input->get('checkup_type');
			$checkup_equipment = $this->input->get('checkup_equipment');
			$checkup_time = $this->input->get('checkup_time');
			$checkup_cost = $this->input->get('checkup_cost');
			$checkup_item = $this->input->get('checkup_item');
			for ($i = 0; $i < count($checkup_item); $i++) {
				$checkup = array('checkup_type' => $checkup_type[$i]
					, 'checkup_equipment' => $checkup_equipment[$i]
					, 'checkup_time' => $checkup_time[$i]
					, 'checkup_cost' => $checkup_cost[$i]
					, 'checkup_item' => $checkup_item[$i]
					, 'checkup_status' => '0'
					, 'chc_booking_id' => $booking_id,
				);
				$this->booking_model->_table_name = "tbl_check_list"; //table name
				$this->booking_model->_primary_key = "chc_id";
				$this->booking_model->save($checkup);
			}
		} else {
			$this->booking_model->_table_name = "tbl_patient_booking"; //table name
			$this->booking_model->_primary_key = "booking_id";
			$booking_id = $this->booking_model->save($data);
			$checkup_type = $this->input->get('checkup_type');
			$checkup_equipment = $this->input->get('checkup_equipment');
			$checkup_time = $this->input->get('checkup_time');
			$checkup_cost = $this->input->get('checkup_cost');
			$checkup_item = $this->input->get('checkup_item');
			for ($i = 0; $i < count($checkup_item); $i++) {
				$checkup = array('checkup_type' => $checkup_type[$i]
					, 'checkup_equipment' => $checkup_equipment[$i]
					, 'checkup_time' => $checkup_time[$i]
					, 'checkup_cost' => $checkup_cost[$i]
					, 'checkup_item' => $checkup_item[$i]
					, 'checkup_status' => '0'				
					, 'chc_booking_id' => $booking_id,
				);
			$this->booking_model->_table_name = "tbl_check_list"; //table name
			$this->booking_model->_primary_key = "chc_id";
			$this->booking_model->save($checkup);
			}
		
		}
		echo json_encode(array('status'=>'success'));
	}

	public function check_info() {
		$equipment = $_REQUEST['equipment'];
		$times = $_REQUEST['times'];

		$this->booking_model->_table_name = "tbl_patient_booking"; //table name
		$this->booking_model->_order_by = "booking_id";
		$info = $this->booking_model->get_by(array('checkup_equipment' => $equipment, 'checkup_time' => $times), true);
		echo $info;
	}

	public function listview() {
		$patient_name = $_REQUEST['patient_name'];

		$booking_list = $this->booking_model->getlistview();

		foreach ($booking_list as $booking) {
			$str_html .= '<tr>
                        <td>' . $booking->image_num . '</td>
                        <td>' . $booking->booking_status . '</td>
                        <td>' . $booking->patient_name . '</td>
                        <td>' . $booking->patient_gender . '</td>
                        <td>' . $booking->patient_age . '</td>
                        <td>' . $booking->patient_type . '</td>
                        <td>' . $booking->patient_type . '</td>
                        <td>' . $booking->patient_type . '</td>
                        <td>' . $booking->patient_type . '</td>
                        <td>' . $booking->patient_type . '</td>
                        <td>' . $booking->patient_type . '</td>
                        <td>' . $booking->patient_type . '</td>
                        <td>' . $booking->patient_type . '</td>
                        <td>' . $booking->patient_type . '</td>
                    </tr>';
		}

		echo $str_html;
	}

	public function get_module($module_class = null) {
		$data['class_id'] = $module_class;
		$sdata['tdata'] = $this->booking_model->get_module($data);
		echo json_encode($sdata);
	}

	public function get_checkinfo($id = null) {
		$data['id'] = $id;
		$sdata['tdata'] = $this->booking_model->get_module($data);
		echo json_encode($sdata);
	}
	public function check_checkup_time($id = null) {
		$checkup_equipment = $this->input->post('checkup_equipment');
		$checkup_date = $this->input->post('checkup_date');
		$this->booking_model->_table_name = "tbl_device"; //table name
		$this->booking_model->_order_by = "id";
		$sinfo = $this->booking_model->get_by(array('id' => $checkup_equipment), true);
		$check_item = $sinfo->equipment_num;
		$checkup_count = 2;
		$checkup_interval = 60 / $checkup_count;
		$start_time;
		for ($i = 0; $i < $checkup_count * 8; $i++) {
			$time_division = date(' H:i:s', strtotime('9:00' . ' + ' . $checkup_interval * $i . 'minutes'));
			$this->booking_model->_table_name = "tbl_check_list"; //table name
			$this->booking_model->_order_by = "chc_id";
			$date_check = $checkup_date . ' ' . $time_division;
			$info = $this->booking_model->get_by(array('checkup_equipment' => $check_item, 'checkup_time' => $date_check), true);
			if ($info) {
				$checkup_interval_status = 'off';
			} else {
				$checkup_interval_status = 'on';
			}
			$real_data[] = array('checkup_equipment' => $check_item, 'checkup_interval' => $time_division, 'checkup_interval_status' => $checkup_interval_status);
		}
		$data['tdata'] = $real_data;
		echo json_encode($data);
	}
	public function check_device_timelist($id = null) {
		$checkup_date = $this->input->post('checkup_date');
		$this->booking_model->_table_name = "tbl_device"; //table name
		$this->booking_model->_order_by = "id";
		$checkup_count = 2;
		$checkup_interval = 60 / $checkup_count;
		$sinfo = $this->booking_model->get();
		foreach ($sinfo as $value) {
			$device_id = $value->id;
			$equipment_num = $value->equipment_num;
			$check_count = 0;
			for ($i = 0; $i < $checkup_count * 8; $i++) {
				$time_division = date(' H:i:s', strtotime('9:00' . ' + ' . $checkup_interval * $i . 'minutes'));
				$this->booking_model->_table_name = "tbl_check_list"; //table name
				$this->booking_model->_order_by = "chc_id";
				$date_check = $checkup_date . ' ' . $time_division;
				$info = $this->booking_model->get_by(array('checkup_equipment' => $equipment_num, 'checkup_time' => $date_check), true);
				if (!empty($info)) {
				} else {
					$check_count++;
				}
				$info = false;
			}
			$real_data[] = array('device_id' => $device_id, 'check_count' => $check_count, 'check_totalcount' => $checkup_count * 8);
		}
		$data['tdata'] = $real_data;
		echo json_encode($data);
	}

	public function consultation($booking_id = null) {
		$this->booking_model->_table_name = "tbl_device"; //table name
		$this->booking_model->_order_by = "id";
		$checkup_count = 2;
		$checkup_interval = 60 / $checkup_count;
		$sinfo = $this->booking_model->get();
		foreach ($sinfo as $value) {
			$device_id = $value->id;
			$equipment_num = $value->equipment_num;
			$check_count = 0;
			for ($i = 0; $i < $checkup_count * 8; $i++) {
				$time_division = date(' H:i:s', strtotime('9:00' . ' + ' . $checkup_interval * $i . 'minutes'));
				$this->booking_model->_table_name = "tbl_check_list"; //table name
				$this->booking_model->_order_by = "chc_id";
				$date_check = date('Y-m-d') . ' ' . $time_division;
				$info = $this->booking_model->get_by(array('checkup_equipment' => $equipment_num, 'checkup_time' => $date_check), true);
				if ($info) {
				} else {
					$check_count++;
				}
				$info = false;
			}
			$real_data[] = array('device_id' => $device_id, 'device_name' => $value->equipment_num, 'check_count' => $check_count, 'device_sataus' => $value->equipment_status, 'check_totalcount' => $checkup_count * 8);
		}

		$data['device_type'] = $this->admin_model->get_device_type();
		$data['department_type'] = $this->admin_model->get_equipment_department();
		$data['all_device_room_info'] = $real_data;
		$data['subview'] = $this->load->view('booking/consultation', $data, true);
		$this->load->view('layout', $data);
	}

	function detail_roominfo($room_id = null) {
		$sdata = array('id' => $room_id);
		$this->booking_model->_table_name = "tbl_device"; //table name
		$this->booking_model->_order_by = "id";
		$data['room_only_info'] = $this->booking_model->get_by($sdata, true);
		$sdata['checkup_time >='] = date('Y-m-d') . ' 00:00:00';
		$sdata['checkup_time <='] = date('Y-m-d') . ' 23:59:59';
		$data['room_id'] = $room_id;
		$data['room_info'] = $this->booking_model->get_roominfo($sdata);
		$data['subview'] = $this->load->view('booking/detail_roominfo', $data, true);
		$this->load->view('layout', $data);
	}

	function update_booking() {
		$where = array('chc_id' => $this->input->post('c_id'));
		$update = array('checkup_status' => $this->input->post('booking_status'));
		$res = $this->booking_model->set_action($where, $update, 'tbl_check_list');
		$this->booking_model->_table_name = "tbl_check_list"; //table name
		$this->booking_model->_order_by = "chc_id";
		$info = $this->booking_model->get_by(array('chc_id' => $this->input->post('c_id')), true);
		$booking_id = $info->chc_booking_id;
		$check_list = $this->booking_model->get_by(array('chc_booking_id' => $booking_id), false);
		
		if($this->input->post('booking_status') == '2'){
			$status = '';
			foreach($check_list as $value){
				if($value->check_status != 2){
					$status = 'success';				

				}
			}

			if(status == 'success'){
				$where = array('booking_id' => $booking_id );
				$update = array('booking_status' => '2');
				$res = $this->booking_model->set_action($where, $update, 'tbl_patient_booking');
			}else {
				$where = array('booking_id' => $booking_id );
				$update = array('booking_status' => '6');
				$res = $this->booking_model->set_action($where, $update, 'tbl_patient_booking');
			}


		}
		if ($res) {
			echo "succes";
		}
	}

	function search_room() {

		if ($this->input->post('equipment_type')) {
			$data['equipment_type'] = $this->input->post('equipment_type');
		}
		if ($this->input->post('equipment_deaprtment') != "") {
			$data['equipment_deaprtment'] = $this->input->post('equipment_deaprtment');
		}
		if ($this->input->post('equioment_room')) {
			$data['equioment_room'] = $this->input->post('equioment_room');
		}
		if ($this->input->post('equipment_status') != "") {
			$data['equipment_status'] = $this->input->post('equipment_status');
		}
		if (($this->input->post('start_time') != "") || ($this->input->post('start_time'))) {
			$data['add_time >='] = $this->input->post('start_time');
		}
		if (($this->input->post('end_time') != "") || ($this->input->post('end_time'))) {
			$data['add_time <='] = $this->input->post('end_time');
		}

		$this->booking_model->_table_name = "tbl_device"; //table name
		$this->booking_model->_order_by = "id";
		$checkup_count = 2;
		$checkup_interval = 60 / $checkup_count;
		if ($data) {
			$sinfo = $this->booking_model->get_by($data, false);
		} else {
			$sinfo = $this->booking_model->get();
		}
		foreach ($sinfo as $value) {
			$device_id = $value->id;
			$check_count = 0;
			for ($i = 0; $i < $checkup_count * 8; $i++) {
				$time_division = date(' H:i:s', strtotime('9:00' . ' + ' . $checkup_interval * $i . 'minutes'));
				$this->booking_model->_table_name = "tbl_patient_booking"; //table name
				$this->booking_model->_order_by = "booking_id";
				$date_check = date('Y-m-d') . ' ' . $time_division;
				$info = $this->booking_model->get_by(array('checkup_equipment' => $device_id, 'checkup_time' => $date_check), true);
				if ($info) {
				} else {
					$check_count++;
				}
				$info = false;
			}
			$real_data[] = array('device_id' => $device_id, 'device_name' => $value->equipment_num, 'check_count' => $check_count, 'device_sataus' => $value->equipment_status, 'check_totalcount' => $checkup_count * 8);
		}
		$data['start_time'] = $this->input->post('start_time');
		$data['end_time'] = $this->input->post('end_time');

		$data['device_type'] = $this->admin_model->get_device_type();
		$data['department_type'] = $this->admin_model->get_equipment_department();

		$data['all_device_room_info'] = $real_data;
		$data['subview'] = $this->load->view('booking/consultation', $data, true);
		$this->load->view('layout', $data);
	}

	function change_order() {
		$this->booking_model->_table_name = "tbl_check_list"; //table name
		$this->booking_model->_order_by = "chc_id";
		$prv_info = $this->booking_model->get_by(array('chc_id' => $this->input->post('chn_chc_id')), true);
		$prv_id = $prv_info->chc_id;
		$prv_checkup_time = $prv_info->checkup_time;
		$this->booking_model->_order_by = "chc_id";
		$nxt_info = $this->booking_model->get_by(array('chc_id' => $this->input->post('crut_chc_id')), true);
		$nxt_id = $nxt_info->chc_id;
		$nxt_checkup_time = $nxt_info->checkup_time;
		$prv_update = array('checkup_time' => $nxt_checkup_time);
		$prv_where = array('chc_id' => $prv_id);
		$prv_res = $this->booking_model->set_action($prv_where, $prv_update, 'tbl_check_list');
		if ($prv_res) {
			$nxt_update = array('checkup_time' => $prv_checkup_time);
			$nxt_where = array('chc_id' => $nxt_id);
			$nxt_res = $this->booking_model->set_action($nxt_where, $nxt_update, 'tbl_check_list');
			if ($nxt_res) {
				echo "sucess";
			}
		}
	}

	public function booking_table($sdata = null) {
		if ($this->input->get('image_num')) {
			$sdata['image_num'] = $this->input->get('image_num');
		}
		if ($this->input->get('patient_name')) {
			$sdata['patient_name'] = $this->input->get('patient_name');
		}
		if ($this->input->get('patient_age')) {
			$sdata['patient_age'] = $this->input->get('patient_age');
		}
		if ($this->input->get('patient_gender') != '') {
			$sdata['patient_gender'] = $this->input->get('patient_gender');
		}
		if ($this->input->get('device_type')) {
			$sdata['checkup_type'] = $this->input->get('device_type');
		}
		if ($this->input->get('patient_source') != '') {
			$sdata['patient_source'] = $this->input->get('patient_source');
		}
		if ($this->input->get('remote_status')) {
			$sdata['remote_status'] = $this->input->get('remote_status');
		}
		if (($this->input->get('start_time') != "") || ($this->input->get('start_time'))) {
			$sdata['booking_time >='] = $this->input->get('start_time');
		}
		if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
			$sdata['booking_time <='] = $this->input->get('end_time');
		}
		$result_data = $this->booking_model->get_patient_info($sdata);
		$i = 1;
		if ($result_data) {
			foreach ($result_data as $value) {
				if (!$value->del_status) {
					if ($value->patient_gender == '1') {
						$gender = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
					} else {
						$gender = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
					}

					if ($value->remote_status == '1') {
						$remote_status = '<button type="button" class="btn btn-circle red">是</button>';
					} else {
						$remote_status = '<button type="button" class="btn btn-circle blue">否</button>';
					}

					if ($value->patient_source == '0') {
						$patient_source = '<span type="button" class="btn btn red">门诊</span>';
					} elseif ($value->patient_source == '1') {
						$patient_source = '<button type="button" class="btn btn blue">住院</button>';
					} else {
						$patient_source = '<button type="button" class="btn btn dark">体检</button>';
					}
					$this->booking_model->_table_name = "tbl_check_list"; //table name
					$this->booking_model->_order_by = "chc_id";
					$check_data = $this->booking_model->get_by(array('chc_booking_id' => $value->bk_id), false);
					$checkup_item = '';
					$checkup_time = '';
					foreach($check_data as $check_info){
						$checkup_item.=$check_info->checkup_item.'</br>';
						$checkup_time.=$check_info->checkup_time.'<br>';
					}

					if ($value->booking_status == '1') {
						$action = '<a href = "' . base_url() . 'booking/booking_checkup/' . $value->bk_id;
						$action .= '" class = "btn btn-circle btn-icon-only blue" > <i class = "fa fa-edit" > </i> </a>';
						$action .= '<button type="button" onclick ="delete_patient(' . $value->bk_id;
						$action .= ')" class = "Delete btn btn-circle btn-icon-only red"> <i class="fa fa-trash"></i> </a>';
					} else {
						$action .= '<button type="button" onclick= "delete_patient(' . $value->bk_id . ')"';
						$action .= 'class = "Delete btn btn-circle btn-icon-only yellow" > <i class="fa fa-trash"></i> </button>';
					}
					$data['data'][] = array(
						$i++,
						$value->patient_code,
						$value->patient_name,
						$value->patient_age,
						$gender,
						$checkup_item,
						$remote_status,
						$value->license_num,
						$checkup_time,
						$patient_source,
						$value->hospital_name,
						$value->req_doctor_name,
						$value->report_doc_name,
						$action,
					);
					$action = '';
				}
			}
		} else {
			$data['data'][0] = array(' ',
				" ",
				" ",
				" ",
				" ",
				" ",
				" ",
				" ",
				" ",
				" ",
				" ",
				" ",
				" ",
				" ",
			);
		}
		echo json_encode($data);
	}


	function room_detail($room_id = null){
		$sdata = array('id' => $room_id);
		$this->booking_model->_table_name = "tbl_device"; //table name
		$this->booking_model->_order_by = "id";
		$data['room_only_info'] = $this->booking_model->get_by($sdata, true);
		$sdata['checkup_time >='] = date('Y-m-d') . ' 00:00:00';
		$sdata['checkup_time <='] = date('Y-m-d') . ' 23:59:59';
		$room_info = $this->booking_model->get_roominfo($sdata);
		$i = 1;
		foreach($room_info as $value){
			if ($value->checkup_status == '1') {
				 $trclass = 'bg-yellow-lemon';
			}else if ($value->checkup_status == '2') {
				$trclass = 'bg-grey-cararra';
			}else {
				$trclass = "bg-white";
			}

			if ($value->patient_gender=='1') {
                $gender = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
            }else {
				$gender = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
			}

			if ($value->checkup_status=='0') {
        		$checkup_status = '<button type="button"  class="btn btn-circle btn-warning "> 待检查 </button>';
            } elseif ($value->checkup_status=='1') {
                $checkup_status = '<button  type="button" class="btn btn-circle btn-blue "> 检查中 </button>';
            } else {
                $checkup_status = '<button type="button"  class="btn btn-circle green-sharp "> 已检查 </button>';
			}
			$check_id = '<input type="hidden" id = "checkupinfo'.$i.'" class = "check_id" value = "'.$value->chc_id.'_'.$value->checkup_status.'" >';
			
			$data['data'][] = array(
						$i++,
						$value->patient_code.$check_id,
						$value->patient_name,						
						$gender,
						$value->patient_age,
						$value->checkup_equipment,					
						$value->checkup_item,
						$value->checkup_time,
						$checkup_status,						
			);			
		}
		echo json_encode($data);

	}

	function get_checklist_info($chc_id){
		$this->booking_model->_table_name = "tbl_check_list"; //table name
		$this->booking_model->_order_by = "chc_id";
		$info = $this->booking_model->get_by(array('chc_id' => $chc_id), true);
		echo json_encode($info);
	}
}
