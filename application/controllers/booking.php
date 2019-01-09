<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Booking extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('booking_model');
        $this->load->model('admin_model');
        $this->load->library('form_validation');
    }

    public function index($id = null)
    {
        $data['menutitle'] = $this->lang->line('booking');
        $data['module_class'] = $this->booking_model->get_module_class();
        $booking_info = $this->booking_model->getBookinglist();
        $data['booking_list'] = $booking_info;
        $data['image_num'] = date('YmdHis').''.rand(10000000, 99999999);
        $data['equip_type'] = $this->booking_model->getEquip_type();
        $today = date('Y-m-d');
        $this->booking_model->_table_name = 'tbl_module_class'; //table name
        $this->booking_model->_order_by = 'class_id';
        $data['check_menu'] = $this->booking_model->get();
        if ($id) {
            $this->booking_model->_table_name = 'tbl_patient_booking'; //table name
            $this->booking_model->_order_by = 'booking_id';
            $data['booking_edit_info'] = $this->booking_model->get_by(array('booking_id' => $id), true);
            $this->booking_model->_table_name = 'tbl_check_list'; //table name
            $this->booking_model->_order_by = 'chc_id';
            $data['booking_check_info'] = $this->booking_model->get_by(array('chc_booking_id' => $id), false);
        }
        $this->booking_model->_table_name = 'tbl_checkup_item'; //table name
        $this->booking_model->_order_by = 'id';
        $data['check_sub_menu'] = $this->booking_model->get();
        $data['equipment_type'] = $this->booking_model->get_device_type();
        $sdata = [];
        if (1 == $this->session->userdata('usr_role')) {
            $sdata['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif (1024 == $this->session->userdata('usr_role')) {
        } else {
            $sdata['hospital_name'] = $this->session->userdata('hospital_name');
        }
        $data['all_device_info'] = $this->booking_model->get_device($sdata);
        $data['module_data'] = $this->booking_model->get_module($sdata);
        $data['list_type_num'] = $this->booking_model->getMaxDeviceList();
        $data['subview'] = $this->load->view('booking/booking_checkup', $data, true);
        $this->load->view('layout', $data);
    }

    public function booking_checkup($id = null)
    {
        $data['menutitle'] = $this->lang->line('booking');
        $data['module_class'] = $this->booking_model->get_module_class();
        $booking_info = $this->booking_model->getBookinglist();
        $data['booking_list'] = $booking_info;
        $data['image_num'] = date('YmdHis').''.rand(10000000, 99999999);
        $data['equip_type'] = $this->booking_model->getEquip_type();
        $today = date('Y-m-d');
        $this->booking_model->_table_name = 'tbl_module_class'; //table name
        $this->booking_model->_order_by = 'class_id';
        $data['check_menu'] = $this->booking_model->get();
        if ($id) {
            $this->booking_model->_table_name = 'tbl_patient_booking'; //table name
            $this->booking_model->_order_by = 'booking_id';
            $data['booking_edit_info'] = $this->booking_model->get_by(array('booking_id' => $id), true);
            $this->booking_model->_table_name = 'tbl_check_list'; //table name
            $this->booking_model->_order_by = 'chc_id';
            $data['booking_check_info'] = $this->booking_model->get_by(array('chc_booking_id' => $id), false);
        }
        $this->booking_model->_table_name = 'tbl_checkup_item'; //table name
        $this->booking_model->_order_by = 'id';
        $data['check_sub_menu'] = $this->booking_model->get();
        $data['equipment_type'] = $this->booking_model->get_device_type();
        $sdata = [];
        if (1 == $this->session->userdata('usr_role')) {
            $sdata['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif (1024 == $this->session->userdata('usr_role')) {
        } else {
            $sdata['hospital_name'] = $this->session->userdata('hospital_name');
        }
        $data['all_device_info'] = $this->booking_model->get_device($sdata);
        $data['module_data'] = $this->booking_model->get_module($sdata);
        $data['list_type_num'] = $this->booking_model->getMaxDeviceList();
        $data['subview'] = $this->load->view('booking/booking_checkup', $data, true);
        $this->load->view('layout', $data);
    }

    public function delete_patient($booking_id = null)
    {
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

    public function booking_listview()
    {
        $data['menutitle'] = $this->lang->line('booking');
        $data['all_device_info'] = $this->booking_model->get_device_type();
        $data['booking_list'] = $this->booking_model->get_patient_info();
        $data['subview'] = $this->load->view('booking/booking_table', $data, true);
        $this->load->view('layout', $data);
    }

    public function save_patient()
    {
        $config = array(
            array(
                'field' => 'patient_name',
                'label' => 'patient_name',
                'rules' => 'required',
            ),
            array(
                'field' => 'patient_gender',
                'label' => 'patient_gender',
                'rules' => 'required',
            ),
            array(
                'field' => 'patient_type',
                'label' => 'patient_type',
                'rules' => 'required',
            ),
            array(
                'field' => 'patient_age',
                'label' => 'patient_age',
                'rules' => 'required',
            ),
            array(
                'field' => 'patient_phone_num',
                'label' => 'patient_phone_num',
                'rules' => 'required',
            ),
            array(
                'field' => 'patient_code',
                'label' => 'patient_code',
                'rules' => 'required',
            ),
            array(
                'field' => 'patient_pinyin',
                'label' => 'patient_pinyin',
                'rules' => 'required',
            ),
            array(
                'field' => 'req_doctor_name',
                'label' => 'req_doctor_name',
                'rules' => 'required',
            ),
            array(
                'field' => 'hospital_num',
                'label' => 'hospital_num',
                'rules' => 'required',
            ),
            array(
                'field' => 'room_num',
                'label' => 'room_num',
                'rules' => 'required',
            ),
            array(
                'field' => 'patient_birthday',
                'label' => 'patient_birthday',
                'rules' => 'required',
            ),
            array(
                'field' => 'bed_num',
                'label' => 'bed_num',
                'rules' => 'required',
            ),
            array(
                'field' => 'cost_type',
                'label' => 'cost_type',
                'rules' => 'required',
            ),
            array(
                'field' => 'cost_amount',
                'label' => 'cost_amount',
                'rules' => 'required',
            ),
            array(
                'field' => 'hospital_name',
                'label' => 'hospital_name',
                'rules' => 'required',
            ),
        );
        $data = $this->input->get();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);
        if (empty($this->input->get('checkup_cost'))) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['message' => '提交错误! 输入检查项目', 'data' => $this->form_validation->error_array(), 'response_code' => 0]));
        }
        if (!$this->input->get('booking_id')) {
            $this->form_validation->set_rules('image_num', 'image_num', 'required|is_unique[tbl_patient_booking.image_num]');
        }

        if (false == $this->form_validation->run()) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['message' => '提交错误! 请输入正确的数据', 'data' => $this->form_validation->error_array(), 'response_code' => 0]));
        }
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
            'cost_amount',
        ));
        $booking_id = $this->input->get('booking_id');
        $data['patient_birthday'] = date('Y-m-d', strtotime($this->input->get('patient_birthday')));
        $data['booking_time'] = date('Y-m-d h:i:s');
        $data['booking_status'] = '1';
        $data['remote_status'] = '0';
        $data['patient_age'] = $this->input->get('patient_age', true);
        try {
            if ($booking_id) {
                $where = array('booking_id' => $booking_id);
                $this->booking_model->set_action($where, $data, 'tbl_patient_booking');
                $this->db->delete('tbl_check_list', array('chc_booking_id' => $booking_id));
                $checkup_type = $this->input->get('checkup_type');
                $checkup_equipment = $this->input->get('checkup_equipment');
                $checkup_time = $this->input->get('checkup_time');
                $checkup_cost = $this->input->get('checkup_cost');
                $checkup_item = $this->input->get('checkup_item');
                if (count($checkup_item) > 0) {
                    for ($i = 0; $i < count($checkup_item); ++$i) {
                        $checkup = array('checkup_type' => $checkup_type[$i], 'checkup_equipment' => $checkup_equipment[$i], 'checkup_time' => $checkup_time[$i], 'checkup_cost' => $checkup_cost[$i], 'checkup_item' => $checkup_item[$i], 'checkup_status' => '0', 'chc_booking_id' => $booking_id,
                        );
                        if (!$checkup['checkup_type'] || !$checkup['checkup_equipment'] || !$checkup['checkup_time']
                            || !$checkup['checkup_item'] || !$checkup['checkup_cost']) {
                            continue;
                        }
                        $this->booking_model->_table_name = 'tbl_check_list'; //table name
                        $this->booking_model->_primary_key = 'chc_id';
                        $this->booking_model->save($checkup);
                    }
                }
            } else {
                $this->booking_model->_table_name = 'tbl_patient_booking'; //table name
                $this->booking_model->_primary_key = 'booking_id';
                $booking_id = $this->booking_model->save($data);
                $checkup_type = $this->input->get('checkup_type');
                $checkup_equipment = $this->input->get('checkup_equipment');
                $checkup_time = $this->input->get('checkup_time');
                $checkup_cost = $this->input->get('checkup_cost');
                $checkup_item = $this->input->get('checkup_item');
                for ($i = 0; $i < count($checkup_item); ++$i) {
                    $checkup = array('checkup_type' => $checkup_type[$i], 'checkup_equipment' => $checkup_equipment[$i], 'checkup_time' => $checkup_time[$i], 'checkup_cost' => $checkup_cost[$i], 'checkup_item' => $checkup_item[$i], 'checkup_status' => '0', 'chc_booking_id' => $booking_id,
                    );
                    $this->booking_model->_table_name = 'tbl_check_list'; //table name
                    $this->booking_model->_primary_key = 'chc_id';
                    $this->booking_model->save($checkup);
                }
            }
            $this->load->library('ciqrcode');
            $params['data'] = base_url().'dicomCtrl/dicom_view/'.md5($booking_id).'?bk='.($booking_id).'&img='.md5($this->input->get('image_num'));
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH.'assets/qrcode/'.md5($booking_id).'.png';
            $this->ciqrcode->generate($params);
            $params['url'] = 'assets/qrcode/'.md5($booking_id).'.png';
            $whereup = array('booking_id' => $booking_id);
            $updateData = array('qr_code' => $params['url']);
            $this->booking_model->set_action($whereup, $updateData, 'tbl_patient_booking');
        } catch (Exception $e) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['message' => '操作失败了!', 'data' => [], 'response_code' => 0]));
        }

        return $this->output->set_content_type('application/json')
            ->set_output(json_encode(['message' => '操作成功了!', 'data' => [], 'response_code' => 1]));
    }

    public function check_info()
    {
        $equipment = $_REQUEST['equipment'];
        $times = $_REQUEST['times'];
        $this->booking_model->_table_name = 'tbl_patient_booking'; //table name
        $this->booking_model->_order_by = 'booking_id';
        $info = $this->booking_model->get_by(array('checkup_equipment' => $equipment, 'checkup_time' => $times), true);
        echo $info;
    }

    public function get_module($module_class = null)
    {
        $data['class_id'] = $module_class;
        $sdata['tdata'] = $this->booking_model->get_module($data);
        echo json_encode($sdata);
    }

    public function get_checkinfo($id = null)
    {
        $data['tbl_checkup_item.id'] = $id;
        $sdata = $this->booking_model->get_module($data)[0];
        echo json_encode($sdata);
    }

    public function check_checkup_time($id = null)
    {
        $checkup_equipment = $this->input->post('checkup_equipment');
        $checkup_date = $this->input->post('checkup_date');
        $timestamp = strtotime($checkup_date);
        $day = date('D', $timestamp);
        $checkRes = $this->admin_model->get_device_info(array('id' => $checkup_equipment))[0];
        $checkWorkingInterval = true;
        if ($checkRes->is_monday == $day) {
            $checkWorkingInterval = false;
        }

        if ($checkRes->is_tuesday == $day) {
            $checkWorkingInterval = false;
        }

        if ($checkRes->is_wendnesday == $day) {
            $checkWorkingInterval = false;
        }

        if ($checkRes->is_thursday == $day) {
            $checkWorkingInterval = false;
        }

        if ($checkRes->is_friday == $day) {
            $checkWorkingInterval = false;
        }

        if ($checkRes->is_saturday == $day) {
            $checkWorkingInterval = false;
        }

        if ($checkRes->is_sunday == $day) {
            $checkWorkingInterval = false;
        }

        if ($checkWorkingInterval) {
            echo 'error';

            return false;
        }
        $this->booking_model->_table_name = 'tbl_device'; //table name
        $this->booking_model->_order_by = 'id';
        $sinfo = $this->booking_model->get_by(array('id' => $checkup_equipment), true);
        $check_item = $sinfo->equipment_num;
        $checkup_count = null == $sinfo->limitpatient ? 30 : $sinfo->limitpatient;
        $checkup_interval = null == $sinfo->check_interval ? 30 : $sinfo->check_interval;
        $start_time = null == $sinfo->mornstart ? '8:00' : $sinfo->mornstart;
        $mornend = null == $sinfo->mornend ? '11:30' : $sinfo->mornend;
        $noonend = null == $sinfo->noonend ? '18:00' : $sinfo->noonend;
        $noonstart = null == $sinfo->noonstart ? '14:00' : $sinfo->noonstart;
        for ($i = 0; $i < $checkup_count + 6; ++$i) {
            $crrentVal = strtotime($start_time.' + '.$checkup_interval * $i.'minutes');
            if ((strtotime($mornend) >= $crrentVal && strtotime($start_time) <= $crrentVal) || (strtotime($noonend) >= $crrentVal && $crrentVal >= strtotime($noonstart))) {
                $time_division = date(' H:i:s', strtotime($start_time.' + '.$checkup_interval * $i.'minutes'));
                $this->booking_model->_table_name = 'tbl_check_list'; //table name
                $this->booking_model->_order_by = 'chc_id';
                $date_check = $checkup_date.' '.$time_division;
                $info = $this->booking_model->get_by(array('checkup_equipment' => $check_item, 'checkup_time' => $date_check), true);
                if ($info) {
                    $checkup_interval_status = 'off';
                } else {
                    $checkup_interval_status = 'on';
                }
                $real_data[] = array('checkup_equipment' => $check_item,
                    'checkup_interval' => $time_division,
                    'checkup_interval_status' => $checkup_interval_status,
                    'check_type' => $check_item,
                );
            }
        }
        if (0 == count($real_data)) {
            echo 'error';

            return true;
        }

        $data['tdata'] = $real_data;
        echo json_encode($data);
    }

    public function check_device_timelist($id = null)
    {
        $checkup_date = $this->input->post('checkup_date');
        $this->booking_model->_table_name = 'tbl_device'; //table name
        $this->booking_model->_order_by = 'id';
        $sinfos = $this->booking_model->get();
        foreach ($sinfos as $sinfo) {
            $check_item = $sinfo->equipment_num;
            $checkup_count = null == $sinfo->limitpatient ? 30 : $sinfo->limitpatient;
            $checkup_interval = null == $sinfo->check_interval ? 30 : $sinfo->check_interval;
            $start_time = null == $sinfo->mornstart ? '8:00' : $sinfo->mornstart;
            $mornend = null == $sinfo->mornend ? '11:30' : $sinfo->mornend;
            $noonend = null == $sinfo->noonend ? '18:00' : $sinfo->noonend;
            $noonstart = null == $sinfo->noonstart ? '14:00' : $sinfo->noonstart;
            $check_count = 0;
            $device_id = $sinfo->id;
            $check_totalcount = 0;
            for ($i = 0; $i < $checkup_count + 6; ++$i) {
                $crrentVal = strtotime($start_time.' + '.$checkup_interval * $i.'minutes');
                if ((strtotime($mornend) >= $crrentVal && strtotime($start_time) <= $crrentVal) || (strtotime($noonend) >= $crrentVal && $crrentVal >= strtotime($noonstart))) {
                    $time_division = date(' H:i:s', strtotime($start_time.' + '.$checkup_interval * $i.'minutes'));
                    $this->booking_model->_table_name = 'tbl_check_list'; //table name
                    $this->booking_model->_order_by = 'chc_id';
                    $date_check = $checkup_date.' '.$time_division;
                    $info = $this->booking_model->get_by(array('checkup_equipment' => $check_item, 'checkup_time' => $date_check), true);
                    if (!empty($info)) {
                        ++$check_count;
                    } else {
                    }
                    ++$check_totalcount;
                    $real_data[] = array('device_id' => $device_id, 'check_count' => $check_count, 'check_totalcount' => $check_totalcount);
                }
            }
        }
        $timestamp = strtotime($checkup_date);
        $day = date('D', $timestamp);
        $devices = $this->admin_model->get_device_info();
        foreach ($devices as $device) {
            $checkWorkingInterval = true;
            if ($device->is_monday == $day) {
                $checkWorkingInterval = false;
            }
            if ($device->is_tuesday == $day) {
                $checkWorkingInterval = false;
            }
            if ($device->is_wendnesday == $day) {
                $checkWorkingInterval = false;
            }
            if ($device->is_thursday == $day) {
                $checkWorkingInterval = false;
            }
            if ($device->is_friday == $day) {
                $checkWorkingInterval = false;
            }
            if ($device->is_saturday == $day) {
                $checkWorkingInterval = false;
            }
            if ($device->is_sunday == $day) {
                $checkWorkingInterval = false;
            }
            $deviceWorkInt[] = array('device_id' => $device->id, 'status' => $checkWorkingInterval);
        }
        $data['workInt'] = $deviceWorkInt;
        $data['tdata'] = $real_data;
        echo json_encode($data);
    }

    public function consultation($booking_id = null)
    {
        $sdata = [];
        $checkup_count = 2;
        $checkup_interval = 60 / $checkup_count;
        if (1 == $this->session->userdata('usr_role')) {
            $sdata['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif (1024 == $this->session->userdata('usr_role')) {
        } else {
            $sdata['hospital_name'] = $this->session->userdata('hospital_name');
        }
        $sinfo = $this->booking_model->get_device($sdata);
        foreach ($sinfo as $value) {
            $device_id = $value->id;
            $equipment_num = $value->equipment_num;
            $check_count = 0;
            for ($i = 0; $i < $checkup_count * 8; ++$i) {
                $time_division = date(' H:i:s', strtotime('9:00'.' + '.$checkup_interval * $i.'minutes'));
                $this->booking_model->_table_name = 'tbl_check_list'; //table name
                $this->booking_model->_order_by = 'chc_id';
                $date_check = date('Y-m-d').' '.$time_division;
                $info = $this->booking_model->get_by(array('checkup_equipment' => $equipment_num, 'checkup_time' => $date_check), true);
                if (empty($info)) {
                } else {
                    ++$check_count;
                }
                $info = false;
            }
            $real_data[] = array('device_id' => $device_id,
                'device_name' => $value->equipment_num,
                'check_count' => $check_count,
                'room_status' => $value->room_status,
                'device_sataus' => $value->equipment_status,
                'check_totalcount' => $checkup_count * 8,
                'room_stauts' => $value->room_status,
                'device_doc_name' => $value->device_doc_name,
            );
        }
        $data['menutitle'] = $this->lang->line('booking');
        $data['device_type'] = $this->admin_model->get_device_type();
        $data['department_type'] = $this->admin_model->get_equipment_department();
        $data['subview'] = $this->load->view('booking/consultation', $data, true);
        $this->load->view('layout', $data);
    }

    public function detail_roominfo($room_id = null)
    {
        $data['menutitle'] = $this->lang->line('booking');

        $sdata = array('id' => $room_id);
        $data['room_only_info'] = $this->booking_model->get_device($sdata)[0];
        $sdata['checkup_time >='] = date('Y-m-d').' 00:00:00';
        $sdata['checkup_time <='] = date('Y-m-d').' 23:59:59';
        $data['room_id'] = $room_id;
        $data['room_info'] = $this->booking_model->get_roominfo($sdata);
        $data['subview'] = $this->load->view('booking/detail_roominfo', $data, true);
        $this->load->view('layout', $data);
    }

    public function update_booking()
    {
        $is_mpps = $this->input->post('ismpps');
        $where = array('chc_id' => $this->input->post('c_id'));
        $actionStatus = $this->input->post('booking_status');
        $device_id = $this->input->post('room_id');
        $checkupListData = $this->booking_model->getBookingInfo($where)[0];
        $setStatus = 'true' == $is_mpps ? 3 : 1;
        if (1 == $actionStatus) {
            if ($this->createMWL($checkupListData)) {
                $this->booking_model->set_action($where, array('checkup_status' => $setStatus), 'tbl_check_list');
                echo 'success';
            }
        } elseif (3 == $actionStatus) {
            $getNextChecklist = $this->booking_model->getBookingInfo(array('checkup_equipment' => $device_id, 'checkup_status' => 0))[0];
            $nextWhere = array('chc_id' => $getNextChecklist->chc_id);
            if ($this->createMWL($getNextChecklist)) {
                $this->booking_model->set_action($nextWhere, array('checkup_status' => $setStatus), 'tbl_check_list');
                echo 'success';
            }
        } elseif (0 == $actionStatus) {
            $file_path = './assets/upsxml/'.$this->input->post('c_id').'.xml';
            if (!unlink($file_path)) {
                $this->deleteMWL($this->input->post('c_id'));
                $this->booking_model->set_action($where, array('checkup_status' => 0), 'tbl_check_list');
                echo 'error';
            } else {
                $this->deleteMWL($this->input->post('c_id'));
                $this->booking_model->set_action($where, array('checkup_status' => 0), 'tbl_check_list');
                echo 'success';
            }
        }
    }

    public function search_room()
    {
        $data = [];
        if ($this->input->post('equipment_type')) {
            $data['equipment_type'] = $this->input->post('equipment_type');
        }
        if ('' != $this->input->post('equipment_deaprtment')) {
            $data['equipment_deaprtment'] = $this->input->post('equipment_deaprtment');
        }
        if ($this->input->post('equioment_room')) {
            $data['equioment_room'] = $this->input->post('equioment_room');
        }
        if ('' != $this->input->post('equipment_status')) {
            $data['room_status'] = $this->input->post('equipment_status');
        }
        if (('' != $this->input->post('start_time')) || ($this->input->post('start_time'))) {
            $data['add_time >='] = date('Y-m-d', strtotime($this->input->post('start_time')));
        }
        if (('' != $this->input->post('end_time')) || ($this->input->post('end_time'))) {
            $data['add_time <='] = date('Y-m-d', strtotime($this->input->post('end_time')));
        }
        if (1 == $this->session->userdata('usr_role')) {
            $sdata['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif (1024 == $this->session->userdata('usr_role')) {
        } else {
            $sdata['hospital_name'] = $this->session->userdata('hospital_name');
        }
        $sinfo = $this->booking_model->get_device($sdata);

        //      $this->booking_model->_table_name = "tbl_device"; //table name
        //      $this->booking_model->_order_by = "id";
        $checkup_count = 2;
        $checkup_interval = 60 / $checkup_count;
        //      if ($data) {
        //          $sinfo = $this->booking_model->get_by($data, false);
        //      } else {
        //          $sinfo = $this->booking_model->get();
        //      }
        foreach ($sinfo as $value) {
            $device_id = $value->id;
            $equipment_num = $value->equipment_num;
            $check_count = 0;
            for ($i = 0; $i < $checkup_count * 8; ++$i) {
                $time_division = date(' H:i:s', strtotime('9:00'.' + '.$checkup_interval * $i.'minutes'));
                $this->booking_model->_table_name = 'tbl_check_list'; //table name
                $this->booking_model->_order_by = 'chc_id';
                $date_check = date('Y-m-d').' '.$time_division;
                $info = $this->booking_model->get_by(array('checkup_equipment' => $equipment_num, 'checkup_time' => $date_check), true);
                if ($info) {
                } else {
                    ++$check_count;
                }
                $info = false;
            }
            $real_data[] = array('device_id' => $device_id,
                'device_name' => $value->equipment_num,
                'check_count' => $check_count,
                'room_status' => $value->room_status,
                'device_sataus' => $value->equipment_status,
                'check_totalcount' => $checkup_count * 8,
                'room_stauts' => $value->room_status,
                'device_doc_name' => $value->device_doc_name,
            );
        }
        $data['start_time'] = $this->input->post('start_time');
        $data['end_time'] = $this->input->post('end_time');
        $data['equipment_status'] = $data['room_status'];

        $data['device_type'] = $this->admin_model->get_device_type();
        $data['department_type'] = $this->admin_model->get_equipment_department();

        $data['all_device_room_info'] = $real_data;
        $data['subview'] = $this->load->view('booking/consultation', $data, true);
        $this->load->view('layout', $data);
    }

    public function change_order()
    {
        $this->booking_model->_table_name = 'tbl_check_list'; //table name
        $this->booking_model->_order_by = 'chc_id';
        $prv_info = $this->booking_model->get_by(array('chc_id' => $this->input->post('chn_chc_id')), true);
        $prv_id = $prv_info->chc_id;
        $prv_checkup_time = $prv_info->checkup_time;
        $this->booking_model->_order_by = 'chc_id';
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
                echo 'sucess';
            }
        }
    }

    public function booking_table($sdata = null)
    {
        if ($this->input->get('image_num')) {
            $sdata['image_num'] = $this->input->get('image_num');
        }
        if ($this->input->get('patient_name')) {
            $sdata['patient_name'] = $this->input->get('patient_name');
        }
        if ($this->input->get('patient_age')) {
            $sdata['patient_age'] = $this->input->get('patient_age');
        }
        if ('' != $this->input->get('patient_gender')) {
            $sdata['patient_gender'] = $this->input->get('patient_gender');
        }
        if ($this->input->get('device_type')) {
            $sdata['checkup_type'] = $this->input->get('device_type');
        }
        if ('' != $this->input->get('patient_source')) {
            $sdata['patient_source'] = $this->input->get('patient_source');
        }
        if ($this->input->get('remote_status')) {
            $sdata['remote_status'] = $this->input->get('remote_status');
        }
        if (('' != $this->input->get('start_time')) || ($this->input->get('start_time'))) {
            $sdata['booking_time >='] = date('Y-m-d', strtotime($this->input->get('start_time')));
        }
        if (('' != $this->input->get('end_time')) || ($this->input->get('end_time'))) {
            $sdata['booking_time <='] = date('Y-m-d', strtotime($this->input->get('end_time')));
        }
        if (1 == $this->session->userdata('usr_role')) {
            $sdata['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif (1024 == $this->session->userdata('usr_role')) {
        } else {
            $sdata['tbl_patient_booking.hospital_name'] = $this->session->userdata('hospital_name');
        }
        $result_data = $this->booking_model->get_patient_info($sdata);
        $i = 1;
        $data['data'] = [];
        if ($result_data) {
            foreach ($result_data as $value) {
                if (!$value->del_status) {
                    if ('1' == $value->patient_gender) {
                        $gender = '<button type="button" class="btn btn-sm btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                    } else {
                        $gender = '<button type="button" class="btn btn-circle btn-sm btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                    }

                    if ('1' == $value->remote_status) {
                        $remote_status = '<button type="button" class="btn btn-sm btn-circle red">是</button>';
                    } else {
                        $remote_status = '<button type="button" class="btn btn-sm btn-circle blue">否</button>';
                    }

                    if ('0' == $value->patient_source) {
                        $patient_source = '<span type="button" class="btn btn-sm red">门诊</span>';
                    } elseif ('1' == $value->patient_source) {
                        $patient_source = '<button type="button" class="btn btn-sm blue">住院</button>';
                    } else {
                        $patient_source = '<button type="button" class="btn-sm btn dark">体检</button>';
                    }
                    $this->booking_model->_table_name = 'tbl_check_list'; //table name
                    $this->booking_model->_order_by = 'chc_id';
                    $check_data = $this->booking_model->get_by(array('chc_booking_id' => $value->bk_id), false);
                    $checkup_item = '';
                    $checkup_time = '';
                    foreach ($check_data as $check_info) {
                        $checkup_item .= $check_info->checkup_item.'</br>';
                        $checkup_time .= $check_info->checkup_time.'<br>';
                    }

                    if ('1' == $value->booking_status) {
                        $action = '<a href = "'.base_url().'booking/booking_checkup/'.$value->bk_id;
                        $action .= '" class = "btn btn-circle btn-icon-only blue-madison" > <i class = "fa fa-edit" > </i> </a>';
                        $action .= '<button type="button" onclick ="delete_patient('.$value->bk_id;
                        $action .= ')" class = "Delete btn btn-circle btn-icon-only blue-madison"> <i class="fa fa-trash"></i> </a>';
                    } else {
                        $action = '<button type="button" onclick= "delete_patient('.$value->bk_id.')"';
                        $action .= 'class = "Delete btn btn-circle btn-icon-only blue-madison" > <i class="fa fa-trash"></i> </button>';
                    }
                    $data['data'][] = array(
                        $i++,
                        $value->patient_code,
                        $value->patient_name,
                        $value->patient_age,
                        $gender,
                        $remote_status,
                        $value->license_num,
                        $checkup_time,
                        $patient_source,
                        $value->hospital_name,
                        get_user_name($value->req_doctor_name),
                        get_user_name($value->report_doc_name),
                        $action,
                    );
                    $action = '';
                }
            }
        }
        echo json_encode($data);
    }

    public function room_detail($room_id = null)
    {
        $sdata = array('id' => $room_id);
        $this->booking_model->_table_name = 'tbl_device'; //table name
        $this->booking_model->_order_by = 'id';
        $data['room_only_info'] = $this->booking_model->get_by($sdata, true);
        $sdata['checkup_time >='] = date('Y-m-d').' 00:00:00';
        $sdata['checkup_time <='] = date('Y-m-d').' 23:59:59';
        $room_info = $this->booking_model->get_roominfo($sdata);
        $i = 1;
        $data['data'] = [];
        if (count($room_info) > 0) {
            foreach ($room_info as $value) {
                if ('1' == $value->checkup_status) {
                    $trclass = 'bg-yellow-lemon';
                } elseif ('2' == $value->checkup_status) {
                    $trclass = 'bg-grey';
                } else {
                    $trclass = 'bg-white';
                }
                if ('1' == $value->patient_gender) {
                    $gender = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                } else {
                    $gender = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                }
                if ('0' == $value->checkup_status) {
                    $checkup_status = '<button type="button"  class="btn btn-circle btn-warning "> 待检查 </button>';
                } elseif ('1' == $value->checkup_status) {
                    $checkup_status = '<button  type="button" class="btn btn-circle blue-chambray"> 检查中 </button>';
                } elseif ('2' == $value->checkup_status) {
                    $checkup_status = '<button type="button"  class="btn btn-circle green-sharp"> 已检查 </button>';
                } elseif ('3' == $value->checkup_status) {
                    $checkup_status = '<button type="button"  class="btn btn-circle red-haze"> 安排中 </button>';
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
        }

        echo json_encode($data);
    }

    public function room_details($room_id = null)
    {
        $sdata = array('id' => $room_id);
        $this->booking_model->_table_name = 'tbl_device'; //table name
        $this->booking_model->_order_by = 'id';
        $data['room_only_info'] = $this->booking_model->get_by($sdata, true);
        $sdata['checkup_time >='] = date('Y-m-d').' 00:00:00';
        $sdata['checkup_time <='] = date('Y-m-d').' 23:59:59';
        $room_info = $this->booking_model->get_roominfo($sdata);
        echo json_encode($room_info);
    }

    public function get_checklist_info($chc_id)
    {
        $this->booking_model->_table_name = 'tbl_check_list'; //table name
        $this->booking_model->_order_by = 'chc_id';
        $info = $this->booking_model->get_by(array('chc_id' => $chc_id), true);
        echo json_encode($info);
    }

    public function patient_info_table()
    {
        if (1 == $this->session->userdata('usr_role')) {
            $sdata['hospital_class'] = $this->session->userdata('hospital_name');
        } else {
            $sdata['tbl_patient_booking.hospital_name'] = $this->session->userdata('hospital_name');
        }
        $result_data = $this->booking_model->get_patient_info($sdata);
        $i = 1;
        $data['data'] = [];
        if ($result_data) {
            foreach ($result_data as $value) {
                if (!$value->del_status) {
                    if ('1' == $value->patient_gender) {
                        $gender = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                    } else {
                        $gender = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                    }
                    $data['data'][] = array(
                        $i++,
                        $value->patient_name,
                        $gender,
                        $value->patient_age,
                        $value->patient_birthday,
                    );
                }
            }
        }

        echo json_encode($data);
    }

    public function viewConsulation()
    {
        $data = [];
        if ($this->input->get('equipment_type')) {
            $data['equipment_type'] = $this->input->get('equipment_type');
        }
        if ('' != $this->input->get('equipment_deaprtment')) {
            $data['equipment_deaprtment'] = $this->input->get('equipment_deaprtment');
        }
        if ($this->input->get('equioment_room')) {
            $data['equioment_room'] = $this->input->get('equioment_room');
        }
        if ('' != $this->input->get('equipment_status')) {
            $data['room_status'] = $this->input->get('equipment_status');
        }
        if (('' != $this->input->get('start_time'))) {
            $data['tbl_device.add_time >='] = date('Y-m-d', strtotime($this->input->get('start_time')));
        }
        if (('' != $this->input->get('end_time')) || ($this->input->get('end_time'))) {
            $data['tbl_device.add_time <='] = date('Y-m-d', strtotime($this->input->get('end_time')));
        }

        if (1 == $this->session->userdata('usr_role')) {
            $data['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif (1024 == $this->session->userdata('usr_role')) {
        } else {
            $data['hospital_name'] = $this->session->userdata('hospital_name');
        }
        $sinfos = $this->booking_model->get_device($data);
        $real_data = [];
        foreach ($sinfos as $sinfo) {
            $device_id = $sinfo->id;
            $equipment_num = $sinfo->equipment_num;
            $checkup_count = null == $sinfo->limitpatient ? 30 : $sinfo->limitpatient;
            $checkup_interval = null == $sinfo->check_interval ? 30 : $sinfo->check_interval;
            $start_time = null == $sinfo->mornstart ? '8:00' : $sinfo->mornstart;
            $mornend = null == $sinfo->mornend ? '11:30' : $sinfo->mornend;
            $noonend = null == $sinfo->noonend ? '18:00' : $sinfo->noonend;
            $noonstart = null == $sinfo->noonstart ? '14:00' : $sinfo->noonstart;
            $currentCount = 0;
            $check_totalcount = 0;
            $room_status = false;
            for ($i = 0; $i < $checkup_count; ++$i) {
                $crrentVal = strtotime($start_time.' + '.$checkup_interval * $i.'minutes');
                if ((strtotime($mornend) >= $crrentVal && strtotime($start_time) <= $crrentVal) || (strtotime($noonend) >= $crrentVal && $crrentVal >= strtotime($noonstart))) {
                    $time_division = date(' H:i:s', strtotime($start_time.' + '.$checkup_interval * $i.'minutes'));
                    $this->booking_model->_table_name = 'tbl_check_list'; //table name
                    $this->booking_model->_order_by = 'chc_id';
                    $date_check = date('Y-m-d').' '.$time_division;
                    $info = $this->booking_model->get_by(array('checkup_equipment' => $equipment_num, 'checkup_time' => $date_check), true);
                    ++$check_totalcount;
                    if (!empty($info)) {
                    } else {
                        ++$currentCount;
                    }
                }
            }
            $this->booking_model->_table_name = 'tbl_check_list'; //table name
            $this->booking_model->_order_by = 'chc_id';
            $userData = $this->booking_model->get_by(array('checkup_equipment' => $equipment_num, 'checkup_time >= ' => date('Y-m-d')), false);
            foreach ($userData as $val) {
                if (2 == $val->checkup_status) {
                    $room_status = true;
                } else {
                    $room_status = false;
                }
            }
            $real_data[] = array('device_id' => $device_id,
                'device_name' => $equipment_num,
                'check_count' => $currentCount,
                'device_sataus' => $sinfo->equipment_status,
                'check_totalcount' => $check_totalcount,
                'room_stauts' => true == $room_status ? '2' : $sinfo->room_status,
                'device_doc_name' => $sinfo->device_doc_name,
            );
        }
        $data['device_type'] = $this->admin_model->get_device_type();
        $data['department_type'] = $this->admin_model->get_equipment_department();
        $data['all_device_room_info'] = $real_data;
        $this->load->view('booking/ViewConsulation', $data);
    }

    public function nCreateXML($data = null)
    {
        $gender = 1 == $data->patient_gender ? 'M' : 'F';
        $startingDate = date('Ymdhm', strtotime($data->checkup_time));

        $xmlDoc = '<?xml version="1.0" encoding="UTF-8"?>
        <dicom>
          <!-- Transaction UID-->
          <attr tag="00081195" vr="UI"/>
          <!-- Scheduled Procedure Step Start DateTime -->
          <attr tag="00404005" vr="DT">'.$startingDate.'</attr>
          <!-- Scheduled Procedure Step Priority -->
          <attr tag="00741200" vr="CS">MEDIUM</attr>
          <!-- Procedure Step Label -->
          <attr tag="00741204" vr="LO">Sample Procedure Step Label</attr>
          <!-- Worklist Label -->
          <attr tag="00741202" vr="LO">Sample Worklist Label</attr>
          <!-- Scheduled Processing Parameters Sequence -->
          <attr tag="00741210" vr="SQ"/>
          <!-- Scheduled Processing Applications Code Sequence -->
          <attr tag="00404004" vr="SQ" />
          <!-- Scheduled Station Name Code Sequence -->
          <attr tag="00404025" vr="SQ" />
          <!-- Scheduled Station Class Code Sequence -->
          <attr tag="00404026" vr="SQ" />
          <!-- Scheduled Station Geographic Location Code Sequence -->
          <attr tag="00404027" vr="SQ" />
          <!-- Scheduled Human Performers Sequence -->
          <attr tag="00404034" vr="SQ">
            <item>
              <!-- Human Performer Code Sequence -->
              <attr tag="00404009" vr="SQ">
                <item>
                  <!-- Code Value -->
                  <attr tag="00080100" vr="SH">'.$this->session->userdata('usr_name').'</attr>
                  <!-- Coding Scheme Designator -->
                  <attr tag="00080102" vr="SH">99Agfa</attr>
                  <!-- Code Meaning -->
                  <attr tag="00080104" vr="LO">Gunter Zeilinger</attr>
                </item>
              </attr>
              <!-- Human Performer’s Name -->
              <attr tag="00404037" vr="PN">Zeilinger^Gunter</attr>
              <!-- Human Performer’s Organization -->
              <attr tag="00404036" vr="LO">Agfa Healthcare</attr>
            </item>
          </attr>
          <!-- Scheduled Procedure Step Start Date and Time -->
          <attr tag="00404005" vr="DT">'.$startingDate.'</attr>
          <!-- Scheduled Workitem Code Sequence -->
          <attr tag="00404018" vr="SQ">
            <item>
              <!-- Code Value -->
              <attr tag="00080100" vr="SH">110005</attr>
              <!-- Coding Scheme Designator -->
              <attr tag="00080102" vr="SH">DCM</attr>
              <!-- Code Meaning -->
              <attr tag="00080104" vr="LO">Interpretation</attr>
            </item>
          </attr>
          <!-- Comments on the Scheduled Procedure Step -->
          <attr tag="00400400" vr="LT" />
          <!-- Input Availability Flag -->
          <attr tag="00404020" vr="CS">INCOMPLETE</attr>
          <!-- Input Information Sequence -->
          <attr tag="00404021" vr="SQ" />
          <!-- NonDICOM Input Information Sequence
          <attr tag="004040XX" vr="SQ" />-->
          <!-- Study Instance UID -->
          <attr tag="0020000D" vr="UI">1.2.3.4'.$data->chc_id.'</attr>
          <!-- Patient\'s Name -->
          <attr tag="00100010" vr="PN">'.$data->patient_pinyin.'</attr>
          <!-- Patient ID -->
          <attr tag="00100020" vr="LO">'.$data->image_num.'</attr>
          <!-- Issuer Of Patient ID -->
          <attr tag="00100021" vr="LO">99DCM4CHE</attr>
          <!-- Type Of Patient ID -->
          <attr tag="00100022" vr="CS" />
          <!-- Other Patient IDs Sequence -->
          <attr tag="00101002" vr="SQ" />
          <!-- Patient\'s Birth Date -->
          <attr tag="00100030" vr="DA">'.strtotime($data->patient_birthday).'</attr>
          <!-- Patient\'s Sex -->
          <attr tag="00100040" vr="CS">'.$gender.'</attr>
          <!-- Admission ID -->
          <attr tag="00380010" vr="LO" />
          <!-- Issuer of Admission ID Sequence -->
          <attr tag="00380014" vr="SQ" />
          <!-- Admitting Diagnoses Description -->
          <attr tag="00081080" vr="LO" />
          <!-- Referenced Request Sequence -->
          <attr tag="0040A370" vr="SQ">
            <item>
              <!-- Study Instance UID -->
              <attr tag="0020000D" vr="UI">1.2.3.4'.$data->chc_id.'</attr>
              <!-- Accession Number -->
              <attr tag="00080050" vr="SH">'.$data->chc_id.'</attr>
              <!-- Requested Procedure ID -->
              <attr tag="00401001" vr="SH">'.$data->checkup_equipment.'</attr>
              <!-- Requested Procedure Description -->
              <attr tag="00321060" vr="LO" />
              <!-- Requested Procedure Code Sequence -->
              <attr tag="00321064" vr="SQ" />
            </item>
          </attr>
          <!-- Related Procedure Step Sequence -->
          <attr tag="00741220" vr="SQ" />
          <!-- Unified Procedure Step State -->
          <attr tag="00741000" vr="CS">SCHEDULED</attr>
          <!-- Unified Procedure Step Progress Information Sequence  -->
          <attr tag="00741002" vr="SQ" />
          <!-- UPS Performed Procedure Sequence -->
          <attr tag="00741216" vr="SQ" />
        </dicom>';
        $file_path = './assets/upsxml/'.$data->chc_id.'.xml';
        if (file_put_contents($file_path, $xmlDoc)) {
            $filePath = $data->chc_id;
            $host = $data->checkup_equipment.'@'.$data->ip_address.':'.$data->dicom_port;
            $result = $this->createUpsXML($host, $filePath);

            return $result;
        } else {
            return false;
        }
    }

    public function workListItem($data = null)
    {
        $gender = 1 == $data->patient_gender ? 'M' : 'F';
        $startingDate = date('Ymd', strtotime($data->checkup_time));
        $startingTime = date('his', strtotime($data->checkup_time));
        $birthDay = strtotime($data->patient_birthday);
        $workListXml = '<?xml version="1.0" encoding="UTF-8"?>
        <dicom>
          <!--Specific Character Set-->
          <attr tag="00080005" vr="CS">ISO_IR 100</attr>
          <!--Accession Number-->
          <attr tag="00080050" vr="SH">'.$data->chc_id.'</attr>
          <!--Referring Physician\'s Name-->
          <attr tag="00080090" vr="PN">Physician^Referring</attr>
          <!--Referenced Study Sequence-->
          <attr tag="00081110" vr="SQ"/>
          <!--Referenced Patient Sequence-->
          <attr tag="00081120" vr="SQ"/>
          <!--Patient\'s Name-->
          <attr tag="00100010" vr="PN">'.$data->patient_pinyin.'</attr>
          <!--Patient ID-->
          <attr tag="00100020" vr="LO">'.$data->image_num.'</attr>
          <!--Patient\'s Birth Date-->
          <attr tag="00100030" vr="DA">'.$birthDay.'</attr>
          <!--Patient\'s Sex-->
          <attr tag="00100040" vr="CS">'.$gender.'</attr>
          <!--Patient\'s Weight-->
          <attr tag="00101030" vr="DS"/>
          <!--Medical Alerts-->
          <attr tag="00102000" vr="LO"/>
          <!--Contrast Allergies-->
          <attr tag="00102110" vr="LO"/>
          <!--Pregnancy Status-->
          <attr tag="001021C0" vr="US"/>
          <!--Study Instance UID-->
          <attr tag="0020000D" vr="UI">'.$data->chc_id.$data->image_num.'</attr>
          <!--Requesting Physician\'s Name-->
          <attr tag="00321032" vr="PN">'.$data->req_doctor_name.'</attr>
          <!--Requested Procedure Description-->
          <attr tag="00321060" vr="LO">'.$data->patient_remark.'</attr>
          <!--Requested Procedure Code Sequence-->
          <attr tag="00321064" vr="SQ">
            <item>
              <!--Code Value-->
              <attr tag="00080100" vr="SH">'.$data->chc_id.'</attr>
              <!--Coding Scheme Designator-->
              <attr tag="00080102" vr="SH">IHEDEMO</attr>
              <!--Code Meaning-->
              <attr tag="00080104" vr="LO">Magnetic Resonance Imaging: Ankle</attr>
            </item>
          </attr>
          <!--Admission ID-->
          <attr tag="00380010" vr="LO"/>
          <!--Special Needs-->
          <attr tag="00380050" vr="LO"/>
          <!--Current Patient Location-->
          <attr tag="00380300" vr="LO"/>
          <!--Patient State-->
          <attr tag="00380500" vr="LO"/>
          <!--Scheduled Procedure Step Sequence-->
          <attr tag="00400100" vr="SQ">
            <item>
              <!--Modality-->
              <attr tag="00080060" vr="CS">'.$data->checkup_type.'</attr>
              <!--Requested Contrast Agent-->
              <attr tag="00321070" vr="LO"/>
              <!--Scheduled Station AE Title-->
              <attr tag="00400001" vr="AE">'.$data->checkup_equipment.'</attr>
              <!--Scheduled Procedure Step Start Date-->
              <attr tag="00400002" vr="DA">'.$startingDate.'</attr>
              <!--Scheduled Procedure Step Start Time-->
              <attr tag="00400003" vr="TM">'.$startingTime.'</attr>
              <!--Scheduled Performing Physician\'s Name-->
              <attr tag="00400006" vr="PN">'.$data->req_doctor_name.'</attr>
              <!--Scheduled Procedure Step Description-->
              <attr tag="00400007" vr="LO">MR: Ankle</attr>
              <!--Scheduled Protocol Code Sequence-->
              <attr tag="00400008" vr="SQ">
                <item>
                  <!--Code Value-->
                  <attr tag="00080100" vr="SH">916210</attr>
                  <!--Coding Scheme Designator-->
                  <attr tag="00080102" vr="SH">IHEDEMO</attr>
                  <!--Code Meaning-->
                  <attr tag="00080104" vr="LO">MR: Ankle</attr>
                </item>
              </attr>
              <!--Scheduled Procedure Step ID-->
              <attr tag="00400009" vr="SH">'.$data->chc_id.$data->image_num.rand(9999999, 10000000).'</attr>
              <!--Scheduled Station Name-->
              <attr tag="00400010" vr="SH"/>
              <!--Scheduled Procedure Step Location -->
              <attr tag="00400011" vr="SH"/>
              <!--Pre-Medication-->
              <attr tag="00400012" vr="LO"/>
              <!--Scheduled Procedure Step Status-->
              <attr tag="00400020" vr="CS"/>
            </item>
          </attr>
          <!--Requested Procedure ID-->
          <attr tag="00401001" vr="SH">'.$data->checkup_equipment.$data->image_num.'</attr>
          <!--Requested Procedure Priority-->
          <attr tag="00401003" vr="SH"/>
          <!--Patient Transport Arrangements-->
          <attr tag="00401004" vr="LO"/>
          <!--Confidentiality constraint on patient data-->
          <attr tag="00403001" vr="LO"/>
        </dicom>';
        $file_path = './assets/upsxml/'.$data->chc_id.'.xml';
        if (file_put_contents($file_path, $workListXml)) {
            return true;
        }
    }

    public function createUpsXML($host = null, $filePath = null)
    {
        $host = 'worklist@www.:107';
        $query = 'fileName='.$filePath.'&hostName='.$host;
        $url = 'https://www.healthviewcn.com:5005/executeCreateUps';
        $commandResult = ($this->restFullApi('POST', $url, $query));
        if (!$commandResult) {
            return false;
        }
        $result = false;
        $pattern = '/iuid=/';
        foreach ($commandResult as $numLine => $strLine) {
            $matches = array();
            $numMatches = preg_match($pattern, $strLine, $matches);
            if (1 == $numMatches) {
                $tmpres = str_replace('iuid=', '', $strLine);
                $result = str_replace(']', '', $tmpres);
            }
        }

        return $result;
    }

    public function claimUPS($host = null, $iuid = null, $state = 'IN PROGRESS')
    {
        if (!$iuid) {
            return false;
        } else {
            $host = 'worklist@www.healthviewcn.com:107';
            $query = 'iuid='.$iuid.'&hostName='.$host.'&state='.$state;
            $url = 'https://www.healthviewcn.com:5005/claimUPS';
            $commandResult = ($this->restFullApi('POST', $url, $query));
            $pattern = '/'.$iuid.'/';
            if (count($commandResult) > 0) {
                foreach ($commandResult as $numLine => $strLine) {
                    $matches = array();
                    $numMatches = preg_match($pattern, $strLine, $matches);
                    if (1 == $numMatches) {
                        return true;
                    }
                }
            } else {
                return false;
            }
        }
    }

    public function restFullApi($method, $uri, $query = null, $json = null)
    {
        $adb_option_defaults = array(
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 2,
        );
        // Connect
        if (!isset($adb_handle)) {
            $adb_handle = curl_init();
        }

        $options = array(
            CURLOPT_URL => $uri.'?'.$query,
            CURLOPT_CUSTOMREQUEST => $method, // GET POST PUT PATCH DELETE HEAD OPTIONS
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        );
        curl_setopt_array($adb_handle, ($options + $adb_option_defaults));
        $response = json_decode(curl_exec($adb_handle), true);

        return $response;
    }

    public function completeCheckup()
    {
        $where = array('chc_id' => $this->input->post('c_id'));
        $checkList = $this->db->get_where('tbl_check_list', $where)->row();
        $file_path = './assets/upsxml/'.$this->input->post('c_id').'.xml';
        if (!unlink($file_path)) {
            $this->booking_model->set_action($where, array('checkup_status' => 2), 'tbl_check_list');
            $this->updateBookingStatus(array('chc_booking_id' => $checkList->chc_booking_id));
            echo 'error';
        } else {
            $this->booking_model->set_action($where, array('checkup_status' => 2), 'tbl_check_list');
            $this->updateBookingStatus(array('chc_booking_id' => $checkList->chc_booking_id));
            echo 'success';
        }
    }

    public function updateBookingStatus($where)
    {
        $checkLists = $this->db->get_where('tbl_check_list', $where)->result();
        $totalCount = count($checkLists);
        $countChecked = 0;
        foreach ($checkLists as $checkList) {
            if (2 == $checkList->checkup_status) {
                ++$countChecked;
            }
        }
        if ($totalCount == $countChecked) {
            echo json_encode(array('booking_id' => $where['chc_booking_id']));
            $this->booking_model->set_action(
                array('booking_id' => $where['chc_booking_id']),
                array('booking_status' => 2),
                'tbl_patient_booking'
            );

            return true;
        } else {
            return false;
        }
    }

    public function createMWL($data)
    {
        $gender = 1 == $data->patient_gender ? 'M' : 'F';
        $startingDate = date('Ymd', strtotime($data->checkup_time));
        $startingTime = date('his', strtotime($data->checkup_time));
        $birthDay = strtotime($data->patient_birthday);
        $sps_id = 'SPS-'.rand(9999, 10000000);
        $rp_id = 'RP-'.rand(99, 100000);
        $xmlDoc = '<?xml version="1.0" encoding="UTF-8"?>
    		<!DOCTYPE dataset [
    		<!ELEMENT dataset (attr*)>
    		<!ELEMENT attr (#PCDATA | item)*>
    		<!ELEMENT item (#PCDATA | attr)*>
    		<!ATTLIST attr tag CDATA #REQUIRED>
    		]>
    		<dataset>
    			<!-- Specific Character Set -->
    			<attr tag="00080005">ISO_IR 100</attr>
    			<!-- Scheduled Procedure Step Sequence -->
    			<attr tag="00400100">
    				<item>
    					<!-- Scheduled Station AE Title -->
    					<attr tag="00400001">'.$data->checkup_equipment.'</attr>
    					<!-- Scheduled Procedure Step Start Date -->
    					<attr tag="00400002">'.$startingDate.'</attr>
    					<!-- Scheduled Procedure Step Start Time -->
    					<attr tag="00400003">'.$startingTime.'</attr>
    					<!-- Modality -->
    					<attr tag="00080060">'.$data->checkup_type.'</attr>
    					<!-- Scheduled Performing Physician\'s Name -->
    					<attr tag="00400006">'.$data->req_doctor_name.'</attr>
    					<!-- Scheduled Procedure Step Description -->
    					<attr tag="00400007">Scheduled Procedure Step Description</attr>
    					<!-- Scheduled Procedure Step Location -->
    					<attr tag="00400011">'.$data->patient_code.'</attr>
    					<!-- Scheduled Protocol Code Sequence -->
    					<attr tag="00400008">
    						<item>
    							<!-- Code Value -->
    							<attr tag="00080100">PROT-1231</attr>
    							<!-- Coding Scheme Designator -->
    							<attr tag="00080102">99DCM4CHE</attr>
    							<!-- Code Meaning -->
    							<attr tag="00080104">Code Meaning of PROT-1234</attr>
    						</item>
    					</attr>
    					<!-- Pre-Medication -->
    					<attr tag="00400012">Pre-Medication</attr>
    					<!-- Scheduled Procedure Step ID -->
    					<attr tag="00400009">'.$sps_id.'</attr>
                        <!-- Requested Contrast Agent -->
                        <attr tag="00321070">Requested Contrast Agent</attr>
                        <!-- Scheduled Procedure Step Status -->
                        <attr tag="00400020">SCHEDULED</attr>
                    </item>
                </attr>
                <!-- Requested Procedure ID -->
                <attr tag="00401001">'.$rp_id.'</attr>
                <!-- Requested Procedure Description -->
                <attr tag="00321060">Requested Procedure Description</attr>
                <!-- Requested Procedure Code Sequence -->
                <attr tag="00321064">
                    <item>
                        <!-- Code Value -->
                        <attr tag="00080100">PROC-1234567</attr>
                        <!-- Coding Scheme Designator -->
                        <attr tag="00080102">99DCM4CHE</attr>
                        <!-- Code Meaning -->
                        <attr tag="00080104">Code Meaning of PROC-1234</attr>
                    </item>
                </attr>
                <!-- Study Instance UID -->
                <attr tag="0020000D">'.$data->chc_id.$data->image_num.rand(1, 100).'</attr>
                <!-- Requested Procedure Priority -->
                <attr tag="00401003">MEDIUM</attr>
                <!-- Accession Number -->
                <attr tag="00080050">'.$data->chc_id.'</attr>
                <!-- Requesting Physician -->
                <attr tag="00321032">Requesting^Physician</attr>
                <!-- Requesting Service -->
                <attr tag="00321033">Requesting Service</attr>
                <!-- Referring Physician\'s Name -->
    			<attr tag="00080090">'.$startingDate.'</attr>
    			<!-- Admission ID -->
    			<attr tag="00380010">'.$data->chc_id.'</attr>
    			<!-- Current Patient Location -->
    			<attr tag="00380300">Current Patient Location</attr>
    			<!-- Patient\'s Name -->
    			<attr tag="00100010">'.$data->patient_pinyin.'</attr>
    			<!-- Patient ID -->
    			<attr tag="00100020">'.$data->image_num.'</attr>
    			<!-- Patients Birth Date -->
    			<attr tag="00100030">'.$birthDay.'</attr>
    			<!-- Patient\'s Sex -->
    			<attr tag="00100040">'.$gender.'</attr>
    			<!-- Patient\'s Weight -->
    			<attr tag="00101030">'.rand(50, 200).'</attr>
    			<!-- Confidentiality constraint on patient data -->
    			<attr tag="00403001">V</attr>
    			<!-- Patient State -->
    			<attr tag="00380500">Patient State</attr>
    			<!-- Pregnancy Status -->
    			<attr tag="001021C0">0001</attr>
    			<!-- Medical Alerts -->
    			<attr tag="00102000">Medical Alerts</attr>
    			<!-- Contrast Allergies -->
    			<attr tag="00102110">Contrast Allergies</attr>
    			<!-- Special Needs -->
    			<attr tag="00380050">Special Needs</attr>
    		</dataset>';
        $file_path = './assets/upsxml/'.$data->chc_id.'.xml';
        $save_data = [
            'check_item_id' => $data->chc_id,
            'rp_id' => $rp_id,
            'sps_id' => $sps_id,
        ];
        $this->update_wml_list($save_data);

        if (file_put_contents($file_path, $xmlDoc)) {
            $command = 'Java -jar H:\work_data\PACS\DCM\dcm4chee\bin\editmwl.jar  -a  -f '.$file_path;
            try {
                exec($command);
            } catch (Exception $e) {
                return false;
            }

            return true;
        }

        return false;
    }

    public function deleteMWL($chc_id)
    {
        $this->booking_model->_table_name = 'tbl_wml_list';
        $this->booking_model->_order_by = 'id';
        $exist_list = $this->booking_model->get_by(array('check_item_id' => $chc_id), true);
        $info = $exist_list->rp_id.'/'.$exist_list->sps_id;
        $command = 'Java -jar H:\work_data\PACS\DCM\dcm4chee\bin\editmwl.jar  -r  '.$info;
        file_put_contents('./assets/upsxml/test.txt', $command);
        $this->db->delete('tbl_wml_list', array('check_item_id' => $chc_id));
        try {
            exec($command);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    public function update_wml_list($data)
    {
        $this->booking_model->_table_name = 'tbl_wml_list';
        $this->booking_model->_primary_key = 'id';
        $this->db->delete('tbl_wml_list', array('check_item_id' => $data['check_item_id']));
        $this->booking_model->save($data);
    }
}
