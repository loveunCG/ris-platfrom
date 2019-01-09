<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usermg extends MY_Controller
{
    public $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('report_model');
        if ($this->session->userdata('usr_role')) {
        } else {
            redirect('statistics');
        }
    }

    public function index()
    {
        $data['menutitle'] = $this->lang->line('usermg');
        $data['all_userinfo'] = $this->admin_model->get_userinfo();
        $data['hospital_info'] = $this->admin_model->get_hospitalinfo();
        $data['hospitalClass'] = $this->admin_model->getHospitalClass();
        $data['department_info'] = $this->admin_model->get_departmentinfo();
        $data['subview'] = $this->load->view('user/user_table', $data, true);
        $this->load->view('layout', $data);
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

    public function add_checkIteminfo()
    {
        $config = array(
            array(
                'field' => 'checkup_cost',
                'label' => 'checkup_cost',
                'rules' => 'required',
            ),
            array(
                'field' => 'check_item',
                'label' => 'check_item',
                'rules' => 'required',
            ),
            array(
                'field' => 'device_type',
                'label' => 'device_type',
                'rules' => 'required',
            ),
            array(
                'field' => 'checkup_class',
                'label' => 'checkup_class',
                'rules' => 'required',
            ),
            array(
                'field' => 'checkup_device',
                'label' => 'checkup_device',
                'rules' => 'required',
            ),
        );
        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['message' => '提交错误!',
                    'data' => $this->form_validation->error_array(),
                    'response_code' => 0]));
        }
        $data = $this->admin_model->array_from_post(array(
            'check_item',
            'device_type',
            'checkup_class',
            'checkup_cost',
            'checkup_device',
        ));
        $data['checkup_count'] = 1;
        $data['chc_hos_name'] = $this->session->userdata('hospital_name');
        $data['add_time'] = date("Y-m-d H:i:s");
        $this->admin_model->_table_name = "tbl_checkup_item";
        $this->admin_model->_primary_key = "id";
        if ($this->admin_model->save($data)) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '添加成功了!',
                    'data' => [],
                    'response_code' => 1]));
        } else {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '添加失败了!',
                    'data' => [],
                    'response_code' => 0]));
        }
    }

    public function add_equipment()
    {
        $config = array(
            array(
                'field' => 'equipment_type',
                'label' => 'equipment_type',
                'rules' => 'required',
            ),
            array(
                'field' => 'equipment_num',
                'label' => 'equipment_num',
                'rules' => 'required',
            ),
            array(
                'field' => 'equipment_deaprtment',
                'label' => 'equipment_deaprtment',
                'rules' => 'required',
            ),
            array(
                'field' => 'equioment_room',
                'label' => 'equioment_room',
                'rules' => 'required',
            ),
            array(
                'field' => 'ip_address',
                'label' => 'ip_address',
                'rules' => 'required',
            ),
            array(
                'field' => 'dicom_port',
                'label' => 'dicom_port',
                'rules' => 'required',
            ),
            array(
                'field' => 'AETitle',
                'label' => 'AETitle',
                'rules' => 'required',
            ),
            array(
                'field' => 'check_interval',
                'label' => 'check_interval',
                'rules' => 'required',
            ),
            array(
                'field' => 'limitpatient',
                'label' => 'limitpatient',
                'rules' => 'required',
            ),
        );

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == false) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '提交错误!',
                    'data' => $this->form_validation->error_array(),
                    'response_code' => 0]));
        }
        if (strtotime($this->input->post('mornstart')) > strtotime($this->input->post('mornend'))
            || strtotime($this->input->post('noonstart')) > strtotime($this->input->post('noonend'))) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '工作时间提交错误!',
                    'data' => null, 'response_code' => 0]));
        }

        $data = $this->admin_model->array_from_post(array('equipment_type',
            'equipment_num',
            'equipment_deaprtment',
            'equioment_room',
            'ip_address',
            'dicom_port',
            'AETitle',
            'mornend',
            'noonstart',
            'noonend',
            'check_interval',
            'limitpatient',
            'mornstart',
            'ismpps',
        ));

        $data['equipment_status'] = '0';
        $data['dev_hos_name'] = $this->session->userdata('hospital_name');
        $data['add_time'] = date("Y-m-d H:i:s");
        $data['doctor_id'] = $this->session->userdata('usr_id');
        $this->admin_model->_table_name = "tbl_device";
        $this->admin_model->_primary_key = "id";
        if ($device_id = $this->admin_model->save($data)) {
            $workingInterval = $this->input->post('workingInterval');
            for ($i = 0; $i < count($workingInterval); $i++) {
                if ($workingInterval[$i] == 'Mon') {
                    $saveData['is_monday'] = $workingInterval[$i];
                }

                if ($workingInterval[$i] == 'Tue') {
                    $saveData['is_tuesday'] = $workingInterval[$i];
                }

                if ($workingInterval[$i] == 'Wed') {
                    $saveData['is_wendnesday'] = $workingInterval[$i];
                }

                if ($workingInterval[$i] == 'Thu') {
                    $saveData['is_thursday'] = $workingInterval[$i];
                }

                if ($workingInterval[$i] == 'Fri') {
                    $saveData['is_friday'] = $workingInterval[$i];
                }

                if ($workingInterval[$i] == 'Sat') {
                    $saveData['is_saturday'] = $workingInterval[$i];
                }

                if ($workingInterval[$i] == 'Sun') {
                    $saveData['is_sunday'] = $workingInterval[$i];
                }
            }
            $saveData['wi_device_id'] = $device_id;
            $this->admin_model->_table_name = "tbl_working_interval";
            $this->admin_model->_primary_key = "wi_id";
            $this->admin_model->save($saveData);
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '添加成功了!',
                    'data' => $this->form_validation->error_array(),
                    'response_code' => 0]));
            echo 'success';
        } else {
        }
    }

    public function delect_patient()
    {
        $val_id = $this->input->post('pat_id');
        $this->admin_model->_table_name = "tbl_patient"; // table name
        $this->admin_model->_primary_key = "id";
        $res = $this->admin_model->delete($val_id);
        if ($res) {
            echo "ok";
        }
    }

    public function set_access()
    {
        $config = array(
            array(
                'field' => 'user_data_id',
                'label' => 'user_id',
                'rules' => 'required',
            ),
        );
        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '提交错误!',
                    'data' => $this->form_validation->error_array(),
                    'response_code' => 0]));
        }
        $permissions = $this->input->post('permissionList');

        $usr_id = $this->input->post('user_data_id');
        $this->admin_model->_table_name = "tbl_role"; // table name
        $this->admin_model->_primary_key = "rle_id";
        $this->admin_model->delete_multiple(array('rle_doctor_id' => $usr_id));
        $permissions = json_decode($permissions);
        foreach ($permissions as $permission) {
            $this->admin_model->_table_name = "tbl_role";
            $this->admin_model->_primary_key = "rle_id";
            $data = array('rle_name' => $permission, 'rle_doctor_id' => $usr_id);
            $this->admin_model->save($data);
            $data = null;
        }
        // for ($i = 0; $i < count($permissions); $i++) {
        //  $this->admin_model->_table_name = "tbl_role";
        //  $this->admin_model->_primary_key = "rle_id";
        //  $data = array('rle_name' => $permissions[$i], 'rle_doctor_id' => $usr_id);
        //  $this->admin_model->save($data);
        //  $data = null;
        // }
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode([
                'message' => '设置成功了!',
                'data' => $permissions,
                'response_code' => 1]));
    }

    public function update_checkIteminfo()
    {
        $update_data = $this->admin_model->array_from_post(array('check_item',
            'device_type',
            'checkup_class',
            'checkup_cost',
            'checkup_count',
            'checkup_device',
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
            'mornend',
            'noonstart',
            'noonend',
            'check_interval',
            'limitpatient',
            'ismpps',
            'mornstart',
        ));
        $val_id = $this->input->post('device_dat_id');
        $data['last_update_time'] = date("Y-m-d H:i:s");
        $data['doctor_id'] = $this->session->userdata('usr_id');
        $where = array('id' => $val_id);
        if (strtotime($this->input->post('mornstart')) > strtotime($this->input->post('mornend'))
            || strtotime($this->input->post('noonstart')) > strtotime($this->input->post('noonend'))) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '工作时间提交错误!',
                    'data' => null,
                    'response_code' => 0]));
        }
        $this->admin_model->set_action($where, $update_data, 'tbl_device');
        $workingInterval = $this->input->post('workingInterval');
        $saveData['is_monday'] = null;
        $saveData['is_tuesday'] = null;
        $saveData['is_wendnesday'] = null;
        $saveData['is_thursday'] = null;
        $saveData['is_friday'] = null;
        $saveData['is_saturday'] = null;
        $saveData['is_sunday'] = null;
        for ($i = 0; $i < count($workingInterval); $i++) {
            if ($workingInterval[$i] == 'Mon') {
                $saveData['is_monday'] = $workingInterval[$i];
            }
            if ($workingInterval[$i] == 'Tue') {
                $saveData['is_tuesday'] = $workingInterval[$i];
            }
            if ($workingInterval[$i] == 'Wed') {
                $saveData['is_wendnesday'] = $workingInterval[$i];
            }
            if ($workingInterval[$i] == 'Thu') {
                $saveData['is_thursday'] = $workingInterval[$i];
            }
            if ($workingInterval[$i] == 'Fri') {
                $saveData['is_friday'] = $workingInterval[$i];
            }
            if ($workingInterval[$i] == 'Sat') {
                $saveData['is_saturday'] = $workingInterval[$i];
            }
            if ($workingInterval[$i] == 'Sun') {
                $saveData['is_sunday'] = $workingInterval[$i];
            }
        }
        $whereis = array('wi_device_id' => $this->input->post('device_dat_id'));
        $this->admin_model->_table_name = "tbl_working_interval"; //table name
        $this->admin_model->_order_by = "wi_id";
        $userData = $this->admin_model->get_by($whereis, false);
        if (empty($userData)) {
            $saveData['wi_device_id'] = $this->input->post('device_dat_id');
            $this->admin_model->_table_name = "tbl_working_interval";
            $this->admin_model->_primary_key = "wi_id";
            $this->admin_model->save($saveData);
        } else {
            $this->admin_model->set_action($whereis, $saveData, 'tbl_working_interval');
        }
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode([
                'message' => '更新成功了!',
                'data' => null,
                'response_code' => 1]));
    }

    public function search_checkup_item()
    {
        $data = [];
        $res['data'] = [];

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
        if ($this->session->userdata('usr_role') == 1) {
            $data['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } else {
            $data['hospital_name'] = $this->session->userdata('hospital_name');
        }

        $result_data = $this->admin_model->get_check_iteminfo($data);
        $i = 1;
        if ($result_data) {
            foreach ($result_data as $var_report) {
                $checkup_id = '<input type="hidden" class="device_id" value="' . $var_report->id . '">';
                $res['data'][] = array(
                    $i++ . $checkup_id,
                    $var_report->check_item,
                    $var_report->device_type,
                    $var_report->checkup_device,
                    $var_report->class_name,
                    $var_report->checkup_count,
                    $var_report->checkup_cost . ' ￥',
                );
            }
        }

        echo json_encode($res);
    }

    public function search_device()
    {
        $data = [];
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
            $data['add_time >='] = date("Y-m-d", strtotime($this->input->get('start_time')));
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $data['add_time <='] = date("Y-m-d", strtotime($this->input->get('end_time')));
        }

        if ($this->session->userdata('usr_role') == 1) {
            $data['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } else {
            $data['hospital_name'] = $this->session->userdata('hospital_name');
        }
        $result_data = $this->admin_model->get_deviceinfo($data);
        $i = 1;
        $data['data'] = [];
        if ($result_data) {
            foreach ($result_data as $var_report) {
                if ($var_report->equipment_status == '0') {
                    $device_status = '<span  class="col-md-12 badge badge-priwarningmary "> 未开启  </span>';
                } elseif ($var_report->equipment_status == '1') {
                    $device_status = '<span class="col-md-12 badge badge-primary "> 已开启 </span>';
                } elseif ($var_report->equipment_status == '2') {
                    $device_status = '<span class="col-md-12 badge badge-danger   "> 已禁用 </span>';
                }
                if ($var_report->ismpps == 1) {
                    $mpps = '<span type="button" class="col-md-12 badge badge-primary">是</span>';
                } else {
                    $mpps = '<span type="button" class="col-md-12 badge badge-danger" disabled>否</span>';
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
                    $mpps,
                    $var_report->add_time,
                    $var_report->suspending_time,
                );
            }
        }
        echo json_encode($data);
    }

    public function search_user()
    {
        $data = [];
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
            $data['usr_create_time >='] = date("Y-m-d", strtotime($this->input->get('start_time')));
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $data['usr_create_time <='] = date("Y-m-d", strtotime($this->input->get('end_time')));
        }
        if ($this->session->userdata('usr_role') == 100 || $this->session->userdata('usr_role') == 1000) {
            $data['usr_create_admin'] = $this->session->userdata('id');
        } elseif ($this->session->userdata('usr_role') == 1) {
            $data['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } else {
            $data['hospital_name'] = $this->session->userdata('hospital_name');
        }
        $result_data = $this->admin_model->get_userinfo($data);
        $i = 1;
        $data['data'] = [];
        if ($result_data) {
            foreach ($result_data as $var_report) {
                $my_role = $this->session->userdata('usr_role');
                if ($my_role == 1024) {
                    if ($var_report->usr_role == 1024) {
                        continue;
                    }
                } else {
                    if ($var_report->usr_role == 1 || $my_role == $var_report->usr_role || $var_report->id == $this->session->userdata('id')) {
                        continue;
                    }
                }

                if ($var_report->usr_status == '0') {
                    $user_status = '<span class="col-md-12 badge badge-warning"> 未激活 </span>';
                } elseif ($var_report->usr_status == '1') {
                    $user_status = '<span class="col-md-12 badge badge-success"> 已激活 </span>';
                } elseif ($var_report->usr_status == '2') {
                    $user_status = '<span class="col-md-12 badge badge-danger"> 已注销 </span>';
                }

                if ($var_report->usr_role == 1) {
                    $user_role = '<span class="col-md-12 badge badge-warning"> 医院管理员 </span>';
                } elseif ($var_report->usr_role == 10) {
                    $user_role = '<span class="col-md-12 badge badge-success"> 子医院管理员 </span>';
                } elseif ($var_report->usr_role == 100) {
                    $user_role = '<span class="col-md-12 badge badge-danger"> 主任 </span>';
                } elseif ($var_report->usr_role == 1000) {
                    $user_role = '<span class="col-md-12 badge badge-primary"> 医生 </span>';
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
                    $user_role,
                    $var_report->usr_department,
                    $var_report->usr_hospital,
                    $var_report->usr_phone_num,
                    $var_report->usr_create_time,
                    $var_report->usr_start_time,
                );
            }
        }

        echo json_encode($data);
    }

    public function add_user()
    {
        $config = array(
            array(
                'field' => 'usr_id',
                'label' => 'usr_id',
                'rules' => 'required|min_length[5]|max_length[12]|is_unique[tbl_doctor.usr_id]',
            ),
            array(
                'field' => 'usr_name',
                'label' => 'usr_name',
                'rules' => 'required',
            ),
            array(
                'field' => 'usr_age',
                'label' => 'usr_age',
                'rules' => 'required',
            ),
            array(
                'field' => 'usr_gender',
                'label' => 'usr_gender',
                'rules' => 'required',
            ),
            array(
                'field' => 'usr_department',
                'label' => 'usr_department',
                'rules' => 'required',
            ),
            array(
                'field' => 'usr_hospital',
                'label' => 'usr_hospital',
                'rules' => 'required',
            ),
            array(
                'field' => 'usr_phone_num',
                'label' => 'usr_phone_num',
                'rules' => 'required',
            ),
            array(
                'field' => 'usr_role',
                'label' => 'usr_role',
                'rules' => 'required',
            ),
        );
        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '提交错误!',
                    'data' => $this->form_validation->error_array(),
                    'response_code' => 0]));
        }

        $data = $this->admin_model->array_from_post(array('usr_id',
            'usr_name',
            'usr_age',
            'usr_gender',
            'usr_department',
            'usr_hospital',
            'usr_phone_num',
            'usr_role',
        ));
        $data['usr_passwd'] = md5($this->input->post('usr_passwd'));
        $data['usr_status'] = 0;
        $data['usr_create_admin'] = $this->session->userdata('id');
        $data['usr_create_time'] = date("Y-m-d H:i:s");
        $this->admin_model->_table_name = "tbl_doctor"; //table name
        $this->admin_model->_primary_key = "id";
        if ($this->admin_model->save($data)) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '添加成功了!',
                    'data' => null,
                    'response_code' => 1]));
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
            'usr_role',
        ));
        $id = $data['id'] = $this->input->post('usr_update_id');
        $data['update_usr'] = $this->session->userdata('usr_id');
        $data['usr_update_time'] = date('Y-m-d H:i:s');
        $this->admin_model->_table_name = "tbl_doctor"; //table name
        $this->admin_model->_primary_key = "id";
        if ($this->admin_model->save($data, $id)) {
            echo " ";
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
            echo "ok";
        }
    }

    public function get_user_info($user_id = null)
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

    public function patientMg()
    {
        $data['deviceinfo'] = $this->admin_model->get_deviceinfo();
        $data['menutitle'] = $this->lang->line('usermg');
        $data['hospital_info'] = $this->admin_model->get_hospitalinfo();
        $data['get_module_class'] = $this->report_model->get_module_class();
        $data['get_device_type'] = $this->admin_model->get_device_type();
        $data['all_userinfo'] = $this->admin_model->get_check_iteminfo();
        $data['subview'] = $this->load->view('user/patientMg', $data, true);
        $this->load->view('layout', $data);
    }

    public function add_hospital()
    {
        $config = array(
            array(
                'field' => 'location_sheng',
                'label' => 'location_sheng',
                'rules' => 'required',
            ),
            array(
                'field' => 'hospital_name',
                'label' => 'hospital_name',
                'rules' => 'required',
            ),
            array(
                'field' => 'location_city',
                'label' => 'location_city',
                'rules' => 'required',
            ),
            array(
                'field' => 'hospitalServerAddr',
                'label' => 'hospitalServerAddr',
                'rules' => 'required',
            ),
            array(
                'field' => 'pacsAddr',
                'label' => 'pacsAddr',
                'rules' => 'required',
            ),
            array(
                'field' => 'dicomServer',
                'label' => 'dicomServer',
                'rules' => 'required',
            ),
            array(
                'field' => 'location_detail',
                'label' => 'location_detail',
                'rules' => 'required',
            ),
        );
        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '提交错误!',
                    'data' => $this->form_validation->error_array(),
                    'response_code' => 0]));
        }
        $data = $this->admin_model->array_from_post(array('hospital_name',
            'location_sheng',
            'location_city',
            'hospitalServerAddr',
            'pacsAddr',
            'dicomServer',
            'location_detail',
        ));
        $data['hospital_code'] = date("YmdHis") . "" . rand(10000000, 99999999);
        if ($this->session->userdata('usr_role') == 1024) {
            $data['hospital_class'] = $data['hospital_name'];
        } else {
            $data['hospital_class'] = $this->session->userdata('hospital_name');
        }

        $data['hospital_status'] = 1;

        $data['add_time'] = date("Y-m-d H:i:s");
        $this->admin_model->_table_name = "tbl_hospital"; //table name
        $this->admin_model->_primary_key = "hospital_id";
        if ($this->admin_model->save($data)) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '添加成功了!',
                    'data' => null,
                    'response_code' => 1]));
        }
    }

    public function update_hospital()
    {
        $update_data = $this->admin_model->array_from_post(array('hospital_name',
            'location_sheng',
            'location_city',
            'hospitalServerAddr',
            'pacsAddr',
            'dicomServer',
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
        $data = [];
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
        if ($this->input->get('hospital_status') != '') {
            $data['hospital_status'] = $this->input->get('hospital_status');
        }
        if (($this->input->get('start_time') != "") || ($this->input->get('start_time'))) {
            $data['add_time >='] = date("Y-m-d", strtotime($this->input->get('start_time')));
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $data['add_time <='] = date("Y-m-d", strtotime($this->input->get('end_time')));
        }
        if ($this->session->userdata('usr_role') == 1) {
            $data['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } else {
            $data['hospital_name'] = $this->session->userdata('hospital_name');
        }
        $result_data = $this->admin_model->get_hospitalinfo($data);
        $i = 1;
        $data['data'] = [];
        if ($result_data) {
            foreach ($result_data as $var_report) {
                if ($var_report->hospital_status == '1') {
                    $status = '<span  class="col-md-12 badge badge-warning"> 未审核 </span>';
                } elseif ($var_report->hospital_status == '2') {
                    $status = '<span  class="col-md-12 badge badge-danger "> 未通过 </span>';
                } elseif ($var_report->hospital_status == '3') {
                    $status = '<span  class="col-md-12 badge badge-success "> 审核通过 </span>';
                }
                $hospital_id = '<input type="hidden" class="device_id" value="' . $var_report->hospital_id . '">';

                $data['data'][] = array(
                    $i++ . $hospital_id,
                    $var_report->hospital_code,
                    $var_report->hospital_name,
                    $var_report->location_sheng,
                    $var_report->location_city,
                    $var_report->location_detail,
                    $var_report->hospitalServerAddr,
                    $var_report->pacsAddr,
                    $var_report->dicomServer,
                    $status,
                    $var_report->add_time,
                );
            }
        }
        echo json_encode($data);
    }

    public function hospital_req($sdata = null)
    {
        $sdata = [];
        $data['data'] = [];
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
        if ($this->input->get('hospital_status') != '') {
            $sdata['hospital_status'] = $this->input->get('hospital_status');
        }
        if (($this->input->get('start_time') != "") || ($this->input->get('start_time'))) {
            $sdata['add_time >='] = date("Y-m-d", strtotime($this->input->get('start_time')));
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $sdata['add_time <='] = date("Y-m-d", strtotime($this->input->get('end_time')));
        }

        if ($this->session->userdata('usr_role') == 1) {
            $sdata['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } else {
            $sdata['hospital_name'] = $this->session->userdata('hospital_name');
        }

        $result_data = $this->admin_model->get_hospitalinfo($sdata);
        $i = 1;
        if ($result_data) {
            foreach ($result_data as $value) {
                if ($value->hospital_status == '1') {
                    $status = '<span  class="col-md-12 badge badge-warning"> 未审核 </span>';
                } elseif ($value->hospital_status == '2') {
                    $status = '<span  class="col-md-12 badge badge-danger "> 未通过 </span>';
                } elseif ($value->hospital_status == '3') {
                    $status = '<span  class="col-md-12 badge badge-success "> 审核通过 </span>';
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
        }

        echo json_encode($data);
    }

    public function hospital_deli()
    {
        $config = array(
            array(
                'field' => 'hospital_name',
                'label' => 'location_sheng',
                'rules' => 'required',
            ),
            array(
                'field' => 'location_sheng',
                'label' => 'check_item',
                'rules' => 'required',
            ),
            array(
                'field' => 'location_city',
                'label' => 'device_type',
                'rules' => 'required',
            ),
            array(
                'field' => 'deli_recommend',
                'label' => 'checkup_device',
                'rules' => 'required',
            ),
        );
        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '提交错误!',
                    'data' => $this->form_validation->error_array(),
                    'response_code' => 0]));
        }
        $update_data = $this->admin_model->array_from_post(array('hospital_name',
            'location_sheng',
            'location_city',
            'deli_remark',
            'deli_recommend',
            'location_detail',
        ));
        $val_id = $this->input->post('hospital_id');
        $update_data['deli_time'] = date("Y-m-d H:i:s");
        $update_data['hospital_status'] = $this->input->post('deli_recommend');
        $where = array('hospital_id' => $val_id);
        $res = $this->admin_model->set_action($where, $update_data, 'tbl_hospital');
        if ($res) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '医院已审核!',
                    'data' => [],
                    'response_code' => 1]));
        }
    }

    public function get_device_info($device_id = null)
    {
        $data = $this->admin_model->get_device_info(array('tbl_device.id' => $device_id))[0];
        echo json_encode($data);
    }

    public function get_checkup_item_info($checkup_item_id = null)
    {
        $this->admin_model->_table_name = "tbl_checkup_item"; //table name
        $this->admin_model->_order_by = "id";
        $data = $this->admin_model->get_by(array('id' => $checkup_item_id), true);
        echo json_encode($data);
    }

    public function get_hospital_info($checkup_item_id = null)
    {
        $this->admin_model->_table_name = "tbl_hospital"; //table name
        $this->admin_model->_order_by = "hospital_id";
        $data = $this->admin_model->get_by(array('hospital_id' => $checkup_item_id), true);
        echo json_encode($data);
    }

    public function duplication_num()
    {
        $num = $this->input->post('num_id');
        $check_dupliaction_id = $this->admin_model->check_by(array('equipment_num' => $num), 'tbl_device');
        if (!empty($check_dupliaction_id)) {
            $result = '<small style="padding-left:10px;color:#ff5e54;font-size:14px">该型号已存在</small>';
        } else {
            $result = null;
        }
        echo $result;
    }

    public function changePasswd()
    {
        $passwd = $this->input->post('new_passwd');
        $usr_id = $this->input->post('usr_id');
        $updataData = array('usr_passwd' => md5($passwd));
        $where = array('usr_id' => $usr_id);
        if ($this->admin_model->set_action($where, $updataData, 'tbl_doctor')) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function get_roleList_info($id = null)
    {
        $this->admin_model->_table_name = "tbl_role"; //table name
        $this->admin_model->_order_by = "rle_id";
        $data = $this->admin_model->get_by(array('rle_doctor_id' => $id), false);
        echo json_encode($data);
    }

    public function getPatientInfo()
    {
        $sdata = [];
        if ($this->input->get('pat_name')) {
            $sdata['pat_name'] = $this->input->get('pat_name');
        }
        if ($this->input->get('patient_age')) {
            $sdata['patient_age'] = $this->input->get('patient_age');
        }
        if ($this->input->get('patient_gender') != '') {
            $sdata['patient_gender'] = $this->input->get('patient_gender');
        }
        if ($this->input->get('pat_status')) {
            $sdata['pat_status'] = $this->input->get('pat_status');
        }
        if ($this->input->get('hospital_num') != '') {
            $sdata['hospital_name'] = $this->input->get('hospital_num');
        }
        if (($this->input->get('start_time') != "") || ($this->input->get('start_time'))) {
            $sdata['pat_create_time >='] = date("Y-m-d", strtotime($this->input->get('start_time')));
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $sdata['pat_create_time <='] = date("Y-m-d", strtotime($this->input->get('end_time')));
        }

        if ($this->session->userdata('usr_role') == 1) {
            $sdata['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } else {
            $sdata['tbl_patient_booking.hospital_name'] = $this->session->userdata('hospital_name');
        }

        $PatientDatas = $this->admin_model->GetPatientInfo($sdata);
        $data['data'] = [];
        if (count($PatientDatas) != 0) {
            $i = 1;
            foreach ($PatientDatas as $patientData) {
                if ($patientData->pat_status == '1') {
                    $user_status = '<span class="col-md-12 badge badge-success"> 已激活 </span>';
                } elseif ($patientData->pat_status == '2') {
                    $user_status = '<span class="col-md-12 badge badge-danger"> 已注销 </span>';
                }
                if ($patientData->patient_gender == '0') {
                    $user_info = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                } else {
                    $user_info = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                }
                $pat_id = '<input type="hidden" class="pat_id" value="' . $patientData->pat_id . '">';

                $data['data'][] = array(
                    $i++ . $pat_id,
                    $user_status,
                    $patientData->pat_id,
                    $patientData->patient_name,
                    $user_info,
                    $patientData->patient_age,
                    $patientData->license_num,
                    $patientData->hospital_name,
                    $patientData->pat_phone_num,
                    $patientData->pat_create_time,
                    $patientData->pat_active_time,
                );
            }
        }
        echo json_encode($data);
    }

    public function getPatientInfoalone($id = null)
    {
        $PatientData = $this->admin_model->GetPatientInfo(array('pat_id' => $id))[0];
        echo json_encode($PatientData);
    }

    public function setPatientAllow($id = null)
    {
        $this->admin_model->_table_name = "tbl_patient"; //table name
        $this->admin_model->_order_by = "id";
        $patientData = $this->admin_model->get_by(array('id' => $id), true);
        $update_data = array('pat_status' => $patientData->pat_status == '1' ? '2' : '1', 'pat_active_time' => date('Y-m-d h:i:s'));
        $where = array('id' => $id);
        $this->admin_model->set_action($where, $update_data, 'tbl_patient');
        echo json_encode(array('status' => 'success'));
    }

    public function selectCheckupDeviceType()
    {
        $searchData = array('equipment_type' => $this->input->post('device_dat_id'));

        if ($this->session->userdata('usr_role') == 1) {
            $searchData['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } else {
            $searchData['hospital_name'] = $this->session->userdata('hospital_name');
        }
        $eqInfo = $this->admin_model->selectCheckupDeviceType($searchData);
        foreach ($eqInfo as $value) {
            $data[] = array('eq_num' => $value->equipment_num);
        }
        echo json_encode($data);
    }

    public function deleteHospital($id = null)
    {
        $this->admin_model->_table_name = "tbl_hospital";
        $this->admin_model->_primary_key = "hospital_id";
        $res = $this->admin_model->delete($id);
        if ($res) {
            echo "   ";
        }
    }

    public function deleteUser()
    {
        $usr_id = $this->input->post('usr_id');
        $this->admin_model->_table_name = "tbl_doctor"; // table name
        $this->admin_model->_primary_key = "id";
        $res = $this->admin_model->delete($usr_id);
        if ($res) {
            echo "   ";
        }
    }

    public function duplicationHospital()
    {
        $searchData = array('hospital_name' => $this->input->post('hos_name'));
        $isCheck = $this->admin_model->check_by($searchData, 'tbl_hospital');
        if (!empty($isCheck)) {
            $result = array('status' => true);
        } else {
            $result = array('status' => false);
        }
        echo json_encode($result);
    }

    public function get_permission_tree($id = null)
    {
        $this->admin_model->_table_name = "tbl_role"; //table name
        $this->admin_model->_order_by = "rle_id";
        $where = ['rle_doctor_id' => $id];
        $user_roles = $this->admin_model->get_by($where, false);
        $roles = [
            'isAvailableUser' => [
                'isNewUser' => '新增用户',
                'isAvailableRole' => '用户权限管理',
                'isActivation' => '用户激活管理',
                'isEditableUser' => '用户编辑',
                'isResetPasswordUser' => '重置用户密码',
                'isDeleteUser' => '用户删除',
            ],
            'isAvailablePatient' => [
                'isAvailablePatient' => '病人用户管理',
                'isActivationPatient' => '病人用户激活管理',
                'isDeletePatient' => '病人用户删除',
            ],
            'isAvailableDevice' => [
                'isNewDevice' => '添加设备',
                'isActivationDevice' => '激活管理',
                'isEditableDevice' => '编辑设备',
                'isAvailableDevice' => '设备管理',
                'isDeleteDevice' => '删除设备',
            ],
            'isAvailableItemList' => [
                'isNewItem' => '新增检查项目',
                'isAvailableItemList' => '检查项目管理',
                'isEditableItem' => '编辑检查项目',
                'isDeleteItem' => '检查项目删除',
            ],
            'isAvailableHospital' => [
                'isNewHospital' => '新增子医院',
                'isAvailableHospital' => '医院管理管理',
                'isEditableHospital' => '编辑医院信息',
                'isDeleteHospital' => '子医院删除',
                'isAvailableReview' => '子医院审核',
            ],
            'isBooking' => [
                'Booking' => '检查登记',
                'BookingTable' => '登记列表',
                'Arrangement' => '诊室排号',
            ],
            'ReportTable' => [
                'DicomView' => '调图',
                'MakeReport' => '诊室报告',
                'upload_dicom' => '上传影像',
                'report_table' => '报告列表',
                'share_dicom' => '分享影像',
                'detail_report_view' => '报告详细',
                'edit_report' => '报告修改',
                'DiagnoseReport' => '诊断报告',
                'IntelligentDiagnosis' => '智能诊断',
                'RemoteDiagnosis' => '远程诊断',
                'MyReport' => '我的报告',
                'AuditReport' => '审核我的报告',
            ],
            'InitiateConsultation' => [
                'RemoteOutpatient' => '远程门诊',
                'remote_table' => '远程协作',
                'InitiateConsultation' => '发起咨询',
                'RemoteConsultation' => '远程会诊',
                'MyAdvice' => '我的咨询',
                'ContactStart' => '咨询开始',
                'RemoteConsultationReview' => '远程咨询审核',
                'DeliContact' => '咨询审核',
            ],
            'sharing' => [
                'OnlineVideoTeaching' => '在线视频教学',
                'NewOnlineVideoTeaching' => '新增课程',
                'EditOnlineVideoTeaching' => '编辑课程',
                'DeleteOnlineVideoTeaching' => '删除课程',
                'ExchangeDiscussionArea' => '交流讨论区',
                'DataSharing' => '资料共享',
            ],
            'statistics' => [
                'bookingStatistics' => '登记情况统计',
                'diagnosisStatistics' => '诊断报告统计',
                'remoteStatistics' => '远程咨询统计',
            ],
        ];
        $role_name = [
            'isAvailableUser' => '用户管理',
            'isAvailablePatient' => '病人用户管理',
            'isAvailableDevice' => '设备管理',
            'isAvailableHospital' => '子医院管理',
            'isAvailableItemList' => '检查项目管理',
            'isBooking' => '病人信息管理',
            'ReportTable' => '报告管理',
            'InitiateConsultation' => '远程诊断咨询',
            'sharing' => '学习交流',
            'statistics' => '数据统计与分析',
        ];
        $data = [];
        $user_id = get_user_role_by_id($id);
        foreach ($roles as $key => $role) {
            if ($key == 'isAvailableHospital' && $user_id == 10) {
                continue;
            }
            if (($user_id == 1000 || $user_id == 100) && ($key == 'isAvailableUser' || $key == 'isAvailablePatient' || $key == 'isAvailableDevice' || $key == 'isAvailableHospital' || $key == 'isAvailableItemList')) {
                continue;
            }
            foreach ($role as $index => $value) {
                $selected = false;
                $opened = false;
                foreach ($user_roles as $user_role) {
                    if ($index != $user_role->rle_name) {
                        continue;
                    } else {
                        $selected = true;
                        $opened = true;
                    }
                }
                $children[] = [
                    'text' => $value,
                    'id' => $index,
                    'state' => [
                        'selected' => $selected,
                    ],
                ];
            }
            $disabled = false;
            if ($this->session->userdata('usr_role') != 1 && $this->session->userdata('usr_role') != 1024) {
                if ($key == 'isAvailableUser' || $key == 'isAvailablePatient' || $key == 'isAvailableDevice' || $key == 'isAvailableItemList' || $key == 'isAvailableHospital') {
                    $disabled = true;
                }
            }

            $data[] = [
                'state' => [
                    'disabled' => $disabled,
                ],
                'text' => $role_name[$key],
                'children' => $children,
            ];
            $children = [];
        }
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode($data));
    }
}
