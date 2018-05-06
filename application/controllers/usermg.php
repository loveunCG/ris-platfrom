<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usermg extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->lang->load('cn', 'chinese');
        $this->load->model('admin_model');
        $this->load->model('report_model');
        if ($this->session->userdata('admin_status')) {
        } else {
            redirect('booking');
        }
    }
    public function index()
    {
        $data['menutitle'] = $this->lang->line('usermg');
        $data['all_userinfo'] = $this->admin_model->get_userinfo();
        $data['department_info'] = $this->admin_model->get_departmentinfo();
        $data['subview'] = $this->load->view('user/user_table', $data, true);
        $this->load->view('layout', $data);
    }

    function set_access()
    {
        $update_data = $this->admin_model->array_from_post(array('m_booking',
            'm_report',
            'm_deliberation',
            'm_remote',
            'm_mydata',
            'm_learn',
            'm_contact',
            'm_share',
        ));
        $val_id = $this->input->post('usr_data_id');
        $where = array('id' => $val_id);
        $res = $this->admin_model->set_action($where, $update_data, 'tbl_doctor');
        if ($res) {
            echo "ok";
        }
    }

    public function equipment()
    {
        $data['get_device_type'] = $this->admin_model->get_device_type();
        $data['menutitle'] = $this->lang->line('usermg');
        $data['all_userinfo'] = $this->admin_model->get_deviceinfo();
        $data['equioment_room'] = $this->admin_model->get_equipment_room();
        $data['department_info'] = $this->admin_model->get_departmentinfo();
        $data['equipment_deaprtment'] = $this->admin_model->get_equipment_department();
        $data['subview'] = $this->load->view('user/equipment', $data, true);
        $this->load->view('layout', $data);
    }

    public function checkmg()
    {
        $data['deviceinfo'] = $this->admin_model->get_deviceinfo();
        $data['menutitle'] = $this->lang->line('usermg');
        $data['equioment_room'] = $this->admin_model->get_equipment_room();
        $data['get_module_class'] = $this->report_model->get_module_class();
        $data['get_device_type'] = $this->admin_model->get_device_type();
        $data['all_userinfo'] = $this->admin_model->get_check_iteminfo();
        $data['subview'] = $this->load->view('user/checkmg', $data, true);
        $this->load->view('layout', $data);
    }

    public function add_checkIteminfo()
    {
        $data = $this->admin_model->array_from_post(array('check_item',
            'device_type',
            'checkup_class',
            'checkup_cost',
            'checkup_count',
        ));
        $data['add_time'] = date("Y-m-d H:i:s");
        $this->admin_model->_table_name = "tbl_checkup_item";
        $this->admin_model->_primary_key = "id";
        if ($this->admin_model->save($data)) {
            echo "ok";
        } else {
        }
    }

    public function add_equipment()
    {
        $data = $this->admin_model->array_from_post(array('equipment_type',
            'equipment_num',
            'equipment_deaprtment',
            'equioment_room',
            'ip_address',
            'dicom_port',
            'AETitle',
        ));
        $data['equipment_status'] = '0';
        $data['add_time'] = date("Y-m-d H:i:s");
        $data['doctor_id'] = $this->session->userdata('usr_id');
        $this->admin_model->_table_name = "tbl_device";
        $this->admin_model->_primary_key = "id";
        if ($this->admin_model->save($data)) {
            echo "   ";
        } else {
        }
    }

    public function update_checkIteminfo()
    {
        $update_data = $this->admin_model->array_from_post(array('check_item',
            'device_type',
            'checkup_class',
            'checkup_cost',
            'checkup_count',
        ));
        $val_id = $this->input->post('id');
        $where = array('id' => $val_id);
        $res = $this->admin_model->set_action($where, $update_data, 'tbl_checkup_item');
        if ($res) {
            echo "   ";
        }
    }

    public function update_device()
    {
        $update_data = $this->admin_model->array_from_post(array('equipment_type',
            'equipment_num',
            'equipment_deaprtment',
            'equioment_room',
            'ip_address',
            'dicom_port',
            'AETitle',
        ));
        $val_id = $this->input->post('id');
        $data['last_update_time'] = date("Y-m-d H:i:s");
        $data['doctor_id'] = $this->session->userdata('usr_id');
        $where = array('id' => $val_id);
        $res = $this->admin_model->set_action($where, $update_data, 'tbl_device');
        if ($res) {
            echo "   ";
        }
    }

    public function search_checkup_item()
    {

        if ($this->input->get('device_type')) {
            $data['device_type'] = $this->input->get('device_type');
        }
        if ($this->input->get('checkup_class')) {
            $data['checkup_class'] = $this->input->get('checkup_class');
        }
        if ($this->input->get('checkup_cost')) {
            $data['checkup_cost'] = $this->input->get('checkup_cost');
        }
        if ($this->input->get('check_item')) {
            $data['check_item'] = $this->input->get('check_item');
        }
        // print_r($data);
        $result_data = $this->admin_model->get_check_iteminfo($data);
        $i = 1;
        if ($result_data) {
            foreach ($result_data as $var_report) {
                if ($var_report->equipment_status == '0') {
                    $device_status = '<button type="button" class="btn btn-circle btn-warning "> 未开启  </button>';
                } elseif ($var_report->equipment_status == '1') {
                    $device_status = '<button type="button" class="btn btn-circle btn-primary "> 已开启 </button>';
                } elseif ($var_report->equipment_status == '2') {
                    $device_status = '<button type="button" class="btn btn-circle btn-danger "> 已禁用 </button>';
                }
                $checkup_id = '<input type="hidden" class="device_id" value="' . $var_report->id . '">';
                $res['data'][] = array(
                    $i++ . $checkup_id,
                    $var_report->check_item,
                    $var_report->device_type,
                    $var_report->class_name,
                    $var_report->checkup_count,
                    $var_report->checkup_cost,
                );
            }
        } else {
            $res['data'][0] = array(' ',
                ' ',
                " ",
                " ",
                " ",
                " ",

            );
        }

        echo json_encode($res);
    }

    public function search_device()
    {
        if ($this->input->get('equipment_deaprtment')) {
            $data['equipment_deaprtment'] = $this->input->get('equipment_deaprtment');
        }
        if ($this->input->get('equioment_room')) {
            $data['equioment_room'] = $this->input->get('equioment_room');
        }
        if ($this->input->get('equipment_type')) {
            $data['equipment_type'] = $this->input->get('equipment_type');
        }
        if (($this->input->get('start_time') != "") || ($this->input->get('start_time'))) {
            $data['add_time >='] = $this->input->get('start_time');
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $data['add_time <='] = $this->input->get('end_time');
        }
        $result_data = $this->admin_model->get_deviceinfo($data);
        $i = 1;
        if ($result_data) {
            foreach ($result_data as $var_report) {
                if ($var_report->equipment_status == '0') {
                    $device_status = '<button type="button" class="btn btn-sm btn-circle btn-warning "> 未开启  </button>';
                } elseif ($var_report->equipment_status == '1') {
                    $device_status = '<button type="button" class="btn btn-sm btn-circle btn-primary "> 已开启 </button>';
                } elseif ($var_report->equipment_status == '2') {
                    $device_status = '<button type="button" class="btn btn-sm btn-circle btn-danger "> 已禁用 </button>';
                }
                $device_id = '<input type="hidden" class="device_id" value="' . $var_report->id . '">';
                $data['data'][] = array(
                    $i++ . $device_id,
                    $device_status,
                    $var_report->equipment_type,
                    $var_report->equipment_num,
                    $var_report->equipment_deaprtment,
                    $var_report->equioment_room,
                    $var_report->AETitle,
                    $var_report->ip_address,
                    $var_report->dicom_port,
                    $var_report->add_time,
                    $var_report->suspending_time,
                );
            }
        } else {
            $data['data'][0] = array(' ',
                ' ',
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

    public function search_user()
    {
        if ($this->input->get('usr_name')) {
            $data['usr_name'] = $this->input->get('usr_name');
        }
        if ($this->input->get('usr_age')) {
            $data['usr_age'] = $this->input->get('usr_age');
        }
        if ($this->input->get('usr_gender') != '') {
            $data['usr_gender'] = $this->input->get('usr_gender');
        }

        if (($this->input->get('usr_status') != "") || ($this->input->get('usr_status'))) {
            $data['usr_status'] = $this->input->get('usr_status');
        }
        if ($this->input->get('usr_department') != "") {
            $data['usr_department'] = $this->input->get('usr_department');
        }
        if (($this->input->get('start_time') != "") || ($this->input->get('start_time'))) {
            $data['usr_create_time >='] = $this->input->get('start_time');
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $data['usr_create_time <='] = $this->input->get('end_time');
        }
        $result_data = $this->admin_model->get_userinfo($data);
        $i = 1;
        if ($result_data) {
            foreach ($result_data as $var_report) {
                if ($var_report->usr_status == '0') {
                    $user_status = '<span class="col-md-12 badge badge-warning"> 未激活 </span>';
                } elseif ($var_report->usr_status == '1') {
                    $user_status = '<span class="col-md-12 badge badge-success"> 已激活 </span>';
                } elseif ($var_report->usr_status == '2') {
                    $user_status = '<center><span class="col-md12 badge badge-danger"> 已注销 </span></center>';
                }
                if ($var_report->usr_gender == '0') {
                    $user_info = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                } else {
                    $user_info = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                }
                $data['data'][] = array(
                    $i++,
                    $user_status,
                    $var_report->usr_id,
                    $var_report->usr_name,
                    $user_info,
                    $var_report->usr_age,
                    $var_report->usr_department,
                    $var_report->usr_hospital,
                    $var_report->usr_phone_num,
                    $var_report->usr_create_time,
                    $var_report->usr_start_time,
                );
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
            );
        }

        echo json_encode($data);
    }

    public function add_user()
    {
        $data = $this->admin_model->array_from_post(array('usr_id',
            'usr_name',
            'usr_age',
            'usr_gender',
            'usr_department',
            'usr_hospital',
            'usr_phone_num',
        ));
        $data['usr_passwd'] = md5($this->input->post('usr_passwd'));
        $data['usr_status'] = 0;
        $data['usr_create_time'] = date("Y-m-d H:i:s");
        $this->admin_model->_table_name = "tbl_doctor"; //table name
        $this->admin_model->_primary_key = "id";
        if ($this->admin_model->save($data)) {
            echo "   ";
        }
    }

    public function update_user()
    {
        $data = $this->admin_model->array_from_post(array(
            'usr_name',
            'usr_age',
            'usr_gender',
            'usr_department',
            'usr_hospital',
            'usr_phone_num',
        ));
        $id = $data['id'] = $this->input->post('usr_update_id');
        $data['update_usr'] = $this->session->userdata('usr_id');
        $data['usr_update_time'] = date('Y-m-d H:i:s');
        $this->admin_model->_table_name = "tbl_doctor"; //table name
        $this->admin_model->_primary_key = "id";
        if ($this->admin_model->save($data, $id)) {
            echo "   ";
        } else {
        }
    }

    public function update_passwd()
    {
        $new_passwd = md5($this->input->post('new_passwd'));
        $val_id = $this->input->post('usr_id');
        $update_data = array('usr_passwd' => $new_passwd);
        $where = array('usr_id' => $val_id);
        $res = $this->admin_model->set_action($where, $update_data, 'tbl_doctor');
        if ($res) {
            echo '<small style="padding-left:10px;color:red;font-size:14px">密码错了！</small>';
        }
    }

    public function start_device()
    {
        $val_id = $this->input->post('device_dat_id');
        $update_data = array('equipment_status' => '1');
        $where = array('id' => $val_id);
        $res = $this->admin_model->set_action($where, $update_data, 'tbl_device');
        if ($res) {
            echo "   ";
        }
    }

    function get_user_info($user_id = null)
    {
        $this->admin_model->_table_name = "tbl_doctor"; //table name
        $this->admin_model->_order_by = "id";
        $data = $this->admin_model->get_by(array('usr_id' => $user_id), true);
        echo json_encode($data);
    }

    public function stop_device()
    {
        $val_id = $this->input->post('device_dat_id');
        $update_data = array('equipment_status' => '2', 'suspending_time' => date("Y-m-d h:i:s"));
        print_r($update_data);
        $where = array('id' => $val_id);
        print_r($where);
        $res = $this->admin_model->set_action($where, $update_data, 'tbl_device');
        if ($res) {
            echo "   ";
        }
    }

    public function delect_device()
    {
        $val_id = $this->input->post('device_dat_id');
        $this->admin_model->_table_name = "tbl_device"; // table name
        $this->admin_model->_primary_key = "id";
        $id = array('id' => $val_id);
        $res = $this->admin_model->delete($val_id);
        if ($res) {
            echo "   ";
        }
    }

    public function delect_checkup_item()
    {
        $val_id = $this->input->post('device_dat_id');
        $this->admin_model->_table_name = "tbl_checkup_item"; // table name
        $this->admin_model->_primary_key = "id";
        $id = array('id' => $val_id);
        $res = $this->admin_model->delete($val_id);
        if ($res) {
            echo "   ";
        }
    }

    public function update_activity()
    {
        $val_id = $this->input->post('user_data_id');

        $update_data = array('usr_status' => '1', 'usr_start_time' => date("Y-m-d h:i:s"));
        $where = array('id' => $val_id);
        $res = $this->admin_model->set_action($where, $update_data, 'tbl_doctor');
        if ($res) {
            echo "   ";
        }
    }

    public function set_access_denite()
    {
        $val_id = $this->input->post('user_data_id');

        $update_data = array('usr_status' => '2', 'usr_start_time' => date("Y-m-d h:i:s"));
        $where = array('id' => $val_id);
        $res = $this->admin_model->set_action($where, $update_data, 'tbl_doctor');
        if ($res) {
            echo "   ";
        }
    }

    public function check_passwd()
    {
        $val = $this->input->post('passwd');
        $val_id = $this->input->post('usr_id');
        $val_passwd = md5($val);
        $check_dupliaction_id = $this->admin_model->check_by(array('usr_id' => $val_id, 'usr_passwd' => $val_passwd), 'tbl_doctor');
        if (!empty($check_dupliaction_id)) {
            $result = null;
        } else {
            $result = '<small style="padding-left:10px;color:red;font-size:14px">密码错了！</small>';
        }
        echo $result;
    }

    public function check_id()
    {
        $val = $this->input->post('usr_id');
        $check_dupliaction_id = $this->admin_model->check_by(array('usr_id' => $val), 'tbl_doctor');
        if (!empty($check_dupliaction_id)) {
            $result = '<small style="padding-left:10px;color:red;font-size:14px">账户重复</small>';
        } else {
            $result = null;
        }
        echo $result;
    }

    public function hospitalmg()
    {
        $data['deviceinfo'] = $this->admin_model->get_deviceinfo();
        $data['menutitle'] = $this->lang->line('usermg');
        $data['hospital_info'] = $this->admin_model->get_hospitalinfo();
        $data['get_module_class'] = $this->report_model->get_module_class();
        $data['get_device_type'] = $this->admin_model->get_device_type();
        $data['all_userinfo'] = $this->admin_model->get_check_iteminfo();
        $data['subview'] = $this->load->view('user/hospitalmg', $data, true);
        $this->load->view('layout', $data);
    }

    public function add_hospital()
    {
        $data = $this->admin_model->array_from_post(array('hospital_name',
            'location_sheng',
            'location_city',
            'location_detail',
        ));
        $data['hospital_code'] = date("YmdHis") . "" . rand(10000000, 99999999);
        $data['hospital_status'] = 1;
        $data['add_time'] = date("Y-m-d H:i:s");
        $this->admin_model->_table_name = "tbl_hospital"; //table name
        $this->admin_model->_primary_key = "hospital_id";
        if ($this->admin_model->save($data)) {
            echo "   ";
        }
    }

    public function update_hospital()
    {
        $update_data = $this->admin_model->array_from_post(array('hospital_name',
            'location_sheng',
            'location_city',
            'location_detail',
        ));
        $val_id = $this->input->post('hospital_id');
        $data['last_update_time'] = date("Y-m-d H:i:s");
        $where = array('hospital_id' => $val_id);
        $res = $this->admin_model->set_action($where, $update_data, 'tbl_hospital');
        if ($res) {
            echo "   ";
        }
    }

    public function search_hospital()
    {

        if ($this->input->get('hospital_name')) {
            $data['hospital_name'] = $this->input->get('hospital_name');
        }
        if ($this->input->get('location_sheng')) {
            $data['location_sheng'] = $this->input->get('location_sheng');
        }
        if ($this->input->get('location_city')) {
            $data['location_city'] = $this->input->get('location_city');
        }
        if ($this->input->get('hospital_code')) {
            $data['hospital_code'] = $this->input->get('hospital_code');
        }
        if ($this->input->get('hospital_status')) {
            $data['hospital_status'] = $this->input->get('hospital_status');
        }
        if (($this->input->get('start_time') != "") || ($this->input->get('start_time'))) {
            $data['add_time >='] = $this->input->get('start_time');
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $data['add_time <='] = $this->input->get('end_time');
        }
        $result_data = $this->admin_model->get_hospitalinfo($data);
        $i = 1;
        if ($result_data) {
            foreach ($result_data as $var_report) {
                if ($var_report->hospital_status == '1') {
                    $status = '<button type="button" class="btn btn-circle btn-default"> 未审核 </button>';
                } elseif ($var_report->hospital_status == '2') {
                    $status = '<button type="button" class="btn btn-circle grey-soft "> 未通过 </button>';
                } else {
                    $status = '<button type="button" class="btn btn-circle green-soft "> 审核通过 </button>';
                }
                $hospital_id = '<input type="hidden" class="device_id" value="' . $var_report->hospital_id . '">';

                $data['data'][] = array(
                    $i++ . $hospital_id,
                    $var_report->hospital_code,
                    $var_report->hospital_name,
                    $var_report->location_sheng,
                    $var_report->location_city,
                    $var_report->location_detail,
                    $status,
                    $var_report->add_time,
                );
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
            );
        }

        echo json_encode($data);
    }

    public function hosdelmg()
    {
        $data['deviceinfo'] = $this->admin_model->get_deviceinfo();
        $data['menutitle'] = $this->lang->line('usermg');
        $data['equioment_room'] = $this->admin_model->get_equipment_room();
        $data['get_module_class'] = $this->report_model->get_module_class();
        $data['get_device_type'] = $this->admin_model->get_device_type();
        $data['all_userinfo'] = $this->admin_model->get_check_iteminfo();
        $data['subview'] = $this->load->view('user/hosdelmg', $data, true);
        $this->load->view('layout', $data);
    }

    public function hospital_req($sdata = null)
    {
        if ($this->input->get('hospital_name')) {
            $sdata['hospital_name'] = $this->input->get('hospital_name');
        }
        if ($this->input->get('location_sheng')) {
            $sdata['location_sheng'] = $this->input->get('location_sheng');
        }
        if ($this->input->get('location_city')) {
            $sdata['location_city'] = $this->input->get('location_city');
        }
        if ($this->input->get('hospital_code')) {
            $sdata['hospital_code'] = $this->input->get('hospital_code');
        }
        if ($this->input->get('hospital_status')) {
            $sdata['hospital_status'] = $this->input->get('hospital_status');
        }
        if (($this->input->get('start_time') != "") || ($this->input->get('start_time'))) {
            $sdata['add_time >='] = $this->input->get('start_time');
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $sdata['add_time <='] = $this->input->get('end_time');
        }

        $result_data = $this->admin_model->get_hospitalinfo($sdata);
        $i = 1;
        if ($result_data) {
            foreach ($result_data as $value) {
                if ($value->hospital_status == '1') {
                    $status = '<button type="button" class="btn btn-circle btn-default"> 未审核 </button>';
                } elseif ($value->hospital_status == '2') {
                    $status = '<button type="button" class="btn btn-circle grey-soft "> 未通过 </button>';
                } else {
                    $status = '<button type="button" class="btn btn-circle green-soft "> 审核通过 </button>';
                }
                $hospital_id = '<input type="hidden" class="device_id" value="' . $value->hospital_id . '">';

                $data['data'][] = array(
                    $i++ . $hospital_id,
                    $value->hospital_code,
                    $value->hospital_name,
                    $value->location_sheng,
                    $value->location_city,
                    $value->location_detail,
                    $status,
                    $value->add_time,
                );
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
            );
        }

        echo json_encode($data);
    }
    public function hospital_deli()
    {
        $update_data = $this->admin_model->array_from_post(array('hospital_name',
            'location_sheng',
            'location_city',
            'deli_remark',
            'deli_recommend',
            'location_detail',
        ));
        $val_id = $this->input->post('hospital_id');
        $update_data['deli_time'] = date("Y-m-d H:i:s");
        $update_data['hospital_status'] = '0';
        $where = array('hospital_id' => $val_id);
        $res = $this->admin_model->set_action($where, $update_data, 'tbl_hospital');
        if ($res) {
            echo "   ";
        }
    }

    function get_device_info($device_id = null)
    {
        $this->admin_model->_table_name = "tbl_device"; //table name
        $this->admin_model->_order_by = "id";
        $data = $this->admin_model->get_by(array('id' => $device_id), true);
        echo json_encode($data);
    }

    function get_checkup_item_info($checkup_item_id = null)
    {
        $this->admin_model->_table_name = "tbl_checkup_item"; //table name
        $this->admin_model->_order_by = "id";
        $data = $this->admin_model->get_by(array('id' => $checkup_item_id), true);
        echo json_encode($data);
    }

    function get_hospital_info($checkup_item_id = null)
    {
        $this->admin_model->_table_name = "tbl_hospital"; //table name
        $this->admin_model->_order_by = "hospital_id";
        $data = $this->admin_model->get_by(array('hospital_id' => $checkup_item_id), true);
        echo json_encode($data);
    }
    function duplication_num()
    {
        $num = $this->input->post('num_id');
        $check_dupliaction_id = $this->admin_model->check_by(array('equipment_num' => $num), 'tbl_device');
        if (!empty($check_dupliaction_id)) {
            $result = '<small style="padding-left:10px;color:red;font-size:14px">账户重复</small>';
        } else {
            $result = null;
        }
        echo $result;
    }
}
