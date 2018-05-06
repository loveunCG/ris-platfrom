<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->lang->load('cn', 'chinese');
        $this->load->model('report_model');
        $this->load->model('admin_model');
    }
    public function index($booking_id = null)
    {
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['subview'] = $this->load->view('contact/contact_select', $data, true);
        $this->load->view('layout', $data);
    }

    public function select($booking_id = null)
    {
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['booking_id'] = $booking_id;
        $data['subview'] = $this->load->view('contact/contact_select', $data, true);
        $this->load->view('layout', $data);
    }

    public function editContactInfo($id = null){
        $data['hospital_info'] = $this->admin_model->get_hospitalinfo();
        $sdata = array('contact_id' => $id);
        $data['contact_info'] = $this->report_model->get_contact_info($sdata);
        $data['contact_type'] = '1';
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['subview'] = $this->load->view('contact/contact_start', $data, true);
        $this->load->view('layout', $data);
    }
    
    public function contact_start($booking_id = null)
    {
        $data['hospital_info'] = $this->admin_model->get_hospitalinfo();
        $data['booking_id'] = $booking_id;
        $data['contact_type'] = '1';
        
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['subview'] = $this->load->view('contact/contact_start', $data, true);
        $this->load->view('layout', $data);
    }

    public function my_contact()
    {
        $data['menutitle'] = $this->lang->line('remote_contact');
        $this->report_model->_table_name = "tbl_contact_info"; //table name
        $this->report_model->_order_by = "contact_id";
        $data['contact_list'] = $this->report_model->get();
        $data['subview'] = $this->load->view('contact/my_contact', $data, true);
        $this->load->view('layout', $data);
    }

    public function save_contact()
    {
        $data = $this->admin_model->array_from_post(array('req_doctor_name',
            'req_hospital',
            'disease_summary',
            'medical_history',
            'contact_problem',
            'set_hospital',
            'contact_type',
            'set_class'));

        $data['checkup_image_upload'] = $this->input->post('upload_doc_file_path');
        $data['check_result_doc'] = $this->input->post('upload_dicom_file_path');
        $data['contact_status'] = '1';
        $data['set_check_time'] = $this->input->post('set_date', true) . " " . $this->input->post('set_time', true);
        $data['patient_id'] = $this->input->post('booking_id');
        $data['submit_time'] = date('Y-m-d h:i:s');

        if (!$this->input->post('contact_id')) {
            $this->report_model->_table_name = "tbl_contact_info"; //table name
            $this->report_model->_primary_key = "contact_id";
            if ($this->report_model->save($data)) {
                $result = array('status' => 'succes');
                echo json_encode($result);
            
            } else {
                echo "error";
            }
        } else{
            $where = array('contact_id' => $this->input->post('contact_id'));
            $res = $this->admin_model->set_action($where, $data, 'tbl_contact_info');
            $result = array('status' => 'succes');
            echo json_encode($result);                        
        }
    }

    function upload_file()
    {
        //upload file
        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = true;
        $config['max_size'] = '1024000'; //1 MB
        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : uploads/' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        $result = array('status' => $this->upload->display_errors(), 'real_path' => 'uploads/');
                        echo json_encode($result);
                    } else {
                        $result = array('status' => "<center>文件已成功上传</center> ", 'real_path' => 'uploads/' . $this->upload->data()['file_name']);
                        echo json_encode($result);
                    }
                }
            }
        } else {
            echo '请选择文件';
        }
    }

    

    function search_patient_info($booking_code = null)
    {
        $this->report_model->_table_name = "tbl_patient_booking"; //table name
        $this->report_model->_order_by = "booking_id";
        $data = $this->report_model->get_by(array('patient_code' => $booking_code), true);
        echo json_encode($data);
    }

    public function search_my_contact()
    {
        if ($this->input->get('patient_name')) {
            $sdata['patient_name'] = $this->input->get('patient_name');
        }
        if ($this->input->get('patient_age')) {
            $sdata['patient_age'] = $this->input->get('patient_age');
        }
        if ($this->input->get('patient_gender') != '') {
            $sdata['patient_gender'] = $this->input->get('patient_gender');
        }

        if (($this->input->get('contact_status') != '')) {
            $sdata['contact_status'] = $this->input->get('contact_status');
        }
        if ($this->input->get('contact_type') != '') {
            $sdata['contact_type'] = $this->input->get('contact_type');
        }
        if (($this->input->get('start_time') != '') || ($this->input->get('start_time'))) {
            $sdata['submit_time >='] = $this->input->get('start_time');
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $sdata['submit_time <='] = $this->input->get('end_time');
        }
        $result_data = $this->report_model->get_contact_info($sdata);
        $i = 1;
        if ($result_data) {
            foreach ($result_data as $var_report) {
                if ($var_report->doctor_name == $this->session->userdata('usr_id')) {
                    if ($var_report->contact_status == '1') {
                        $contact_status = '<span class="label label-info">已提交 </span>';
                    } elseif ($var_report->contact_status == '2') {
                        $contact_status = '<span class="label label-danger">草稿 </span>';
                    } elseif ($var_report->contact_status == '3') {
                        $contact_status = '<span class="label label-info">已接受 </span>';
                    } elseif ($var_report->contact_status == '4') {
                        $contact_status = '<span class="label label-Success">已拒绝 </span>';
                    } elseif ($var_report->contact_status == '5') {
                        $contact_status = '<span class="label label-Warning">已结束 </span>';
                    }
                    if ($var_report->patient_gender == '1') {
                        $gender = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                    } else {
                        $gender = '<button type="button" class="btn btn-circle btn-icon-only yellow"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                    }
                    if ($var_report->contact_type == '1') {
                        $contact_type = '<span class="label label-warning"> 远程会诊 </span>';
                        # code...
                    } elseif ($var_report->contact_type == '2') {
                        $contact_type = '<span class="label label-info"> 远程门诊 </span>';
                        # code...
                    }
                    $contact_id = '<input type="hidden" value="' . $var_report->contact_id . '" class = "contact_id"/>';
                    $data['data'][] = array(
                        $i++ . $contact_id,
                        $var_report->contact_id,
                        $contact_status,
                        $var_report->patient_name,
                        $gender,
                        $var_report->patient_age,
                        $var_report->set_hospital . ' ' . $var_report->set_class,
                        $var_report->set_check_time,
                        $var_report->contact_end_time,
                        $var_report->submit_time,
                        $contact_type,
                    );
                }
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

    public function deleteContact($id = null){
        $this->admin_model->_table_name = "tbl_contact_info"; // table name
        $this->admin_model->_primary_key = "contact_id";
        $res = $this->admin_model->delete($id);
        echo json_encode(array('status'=>'success'));

    }

    public function outpatient($booking_id = null)
    {
        $data['hospital_info'] = $this->admin_model->get_hospitalinfo();
        $data['booking_id'] = $booking_id;
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['contact_type'] = '2';
        $data['subview'] = $this->load->view('contact/outpatient_start', $data, true);
        $this->load->view('layout', $data);
    }


    public function contactDetail($contact_id = null)
    {
        $sdata = array('contact_id' => $contact_id);
        $result_data = $this->report_model->get_contact_info($sdata);
        $data['device_class'] = $this->report_model->get_device_class();
        foreach ($result_data as $value) {
            $res = $value;
        }
        $data['contact_info'] = $res;
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['subview'] = $this->load->view('contact/contact_detail', $data, true);
        $this->load->view('layout', $data);
    }

     public function contactDeliPro($contact_id = null)
    {
        $sdata = array('contact_id' => $contact_id);
        $result_data = $this->report_model->get_contact_info($sdata);
        $data['device_class'] = $this->report_model->get_device_class();
        foreach ($result_data as $value) {
            $res = $value;
        }
        $data['contact_info'] = $res;
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['subview'] = $this->load->view('contact/contactDeliPro', $data, true);
        $this->load->view('layout', $data);
    }




    public function contactRoom($contact_id = null){
        $sdata = array('contact_id' => $contact_id);
        $result_data = $this->report_model->get_contact_info($sdata);
        $data['device_class'] = $this->report_model->get_device_class();
        foreach ($result_data as $value) {
            $res = $value;
        }
        $data['contact_info'] = $res;
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['subview'] = $this->load->view('contact/contactRoom', $data, true);
        $this->load->view('layout', $data);
    }
    public function get_contact_info($contact_id = null)
    {

        $sdata = array('contact_id' => $contact_id);
        $data = $this->report_model->get_contact_info($sdata);
        foreach ($data as $value) {
            $res = $value;
        }

        echo json_encode($res);
    }

    public function set_contact_status($contact_id = null)
    {

        $where = array('contact_id' => $contact_id);
        $update = array('contact_status' => '4');
        $res = $this->admin_model->set_action($where, $update, 'tbl_contact_info');
        if ($res) {
            echo json_encode("ok");
        }
    }

    function test(){
        $data['subview'] = $this->load->view('test', $data, true);
        $this->load->view('layout', $data);


    }

    public function RejrctHuiZhen($id = null){
        $update['reject_reason'] = $this->input->get('reject_reason');
        $update['contact_status'] = '4';
        $where = array('contact_id' => $id);
        $res = $this->admin_model->set_action($where, $update, 'tbl_contact_info');
         if ($res) {
            echo json_encode("ok");
        }
    }

    public function contactAnpaiInfo(){

        $update = $this->admin_model->array_from_post(array('nick_name',
            'password',
            'set_check_time',
            'control_dataTime',
            'iscontrol_time',
            'search_doctorName'
           ));
        $update['contact_status'] = 3;
        $where = array('contact_id' => $this->input->post('contact_id'));
        $this->admin_model->set_action($where, $update, 'tbl_contact_info');
        echo json_encode("ok");
    }

    public function contactDeli(){
        $data['menutitle'] = $this->lang->line('remote_contact');
        $this->report_model->_table_name = "tbl_contact_info"; //table name
        $this->report_model->_order_by = "contact_id";
        $data['contact_list'] = $this->report_model->get();
        $data['subview'] = $this->load->view('contact/contactDeli', $data, true);
        $this->load->view('layout', $data);


    }



}
