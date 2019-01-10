<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('report_model');
        $this->load->model('admin_model');
        $this->load->model('contact_model', 'contact');
    }

    public function index($booking_id = null)
    {
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['booking_id'] = $booking_id;
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

    public function editContactInfo($id = null)
    {
        $data['hospital_info'] = $this->admin_model->get_hospitalinfo();
        $sdata = array('contact_id' => $id);
        $data['contact_info'] = $this->report_model->get_contact_info($sdata);
        $data['contact_type'] = '1';
        $data['department_info'] = $this->admin_model->get_departmentinfo();
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['subview'] = $this->load->view('contact/contact_start', $data, true);
        $this->load->view('layout', $data);
    }

    public function ajax_contact_remote_table()
    {
        $this->load->view('contact/ajax_contact_remote_table', null);
    }

    public function contact_start($contact_id = null)
    {
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['hospital_info'] = $this->admin_model->get_hospitalinfo();
        $data['contact_type'] = '1';
        $data['contact_info'] = $this->contact->get_patient_info_by_id(['booking_id' => $contact_id]);
        $data['department_info'] = $this->admin_model->get_departmentinfo();
        $data['subview'] = $this->load->view('contact/contact_start', $data, true);
        $this->load->view('layout', $data);
    }

    public function my_contact()
    {
        $key = 'my';
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['contact'] = $key;
        $data['subview'] = $this->load->view('contact/index', $data, true);
        $this->load->view('layout', $data);
    }

    public function review()
    {
        $key = 'review';
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['contact'] = $key;
        $data['subview'] = $this->load->view('contact/index', $data, true);
        $this->load->view('layout', $data);
    }

    public function remote_contact()
    {
        $key = 'remote';
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['contact'] = $key;
        $data['subview'] = $this->load->view('contact/index', $data, true);
        $this->load->view('layout', $data);
    }

    public function ajax_review_contact_table()
    {
        $data['menutitle'] = $this->lang->line('remote_contact');
        $this->report_model->_table_name = 'tbl_contact_info'; //table name
        $this->report_model->_order_by = 'contact_id';
        $data['contact_list'] = $this->report_model->get();
        $this->load->view('contact/ajax_review_contact_table', $data);
    }

    public function ajax_contact_my_table()
    {
        $data['menutitle'] = $this->lang->line('remote_contact');
        $this->report_model->_table_name = 'tbl_contact_info'; //table name
        $this->report_model->_order_by = 'contact_id';
        $data['contact_list'] = $this->report_model->get();
        $this->load->view('contact/ajax_contact_my_table', $data);
    }

    public function save_contact($id = null)
    {
        $data = $this->admin_model->array_from_post(array(
            'req_doctor_name',
            'req_hospital',
            'disease_summary',
            'medical_history',
            'contact_problem',
            'set_hospital',
            'contact_type',
            'set_check_time',
            'set_class',
        ));

        $data['checkup_image_upload'] = $this->input->post('upload_doc_file_path');
        $data['set_check_time'] = $this->input->post('set_check_time');
        $data['check_result_doc'] = $this->input->post('upload_dicom_file_path');
        $data['patient_id'] = $this->input->post('booking_id');
        $data['submit_time'] = date('Y-m-d h:i:s');
        if ($id) {
            $data['contact_status'] = '2';
            if (!$this->input->post('contact_id')) {
                $this->report_model->_table_name = 'tbl_contact_info'; //table name
                $this->report_model->_primary_key = 'contact_id';
                if ($this->report_model->save($data)) {
                    $result = array('status' => 'success');
                    echo json_encode($result);

                    return true;
                } else {
                    echo 'error';

                    return true;
                }
            } else {
                $where = array('contact_id' => $this->input->post('contact_id'));
                $this->admin_model->set_action($where, $data, 'tbl_contact_info');
                $result = array('status' => 'success');
                echo json_encode($result);

                return true;
            }
        } else {
            $data['contact_status'] = '1';
            if (!$this->input->post('contact_id')) {
                $this->report_model->_table_name = 'tbl_contact_info'; //table name
                $this->report_model->_primary_key = 'contact_id';
                if ($this->report_model->save($data)) {
                    $result = array('status' => 'succes');
                    echo json_encode($result);
                } else {
                    echo 'error';
                }
            } else {
                $where = array('contact_id' => $this->input->post('contact_id'));
                $this->admin_model->set_action($where, $data, 'tbl_contact_info');
                $result = array('status' => 'succes');
                echo json_encode($result);
            }
        }
    }

    public function upload_file()
    {
        //upload file
        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = true;
        $config['max_size'] = '12048000'; //1 MB
        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload'.$_FILES['file']['error'];
            } else {
                if (file_exists('uploads/'.$_FILES['file']['name'])) {
                    echo 'File already exists : uploads/'.$_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        $result = array('status' => $this->upload->display_errors(), 'real_path' => 'uploads/');
                        echo json_encode($result);
                    } else {
                        $result = array('status' => '<center>文件已成功上传</center> ', 'real_path' => 'uploads/'.$this->upload->data()['file_name']);
                        echo json_encode($result);
                    }
                }
            }
        } else {
            echo '请选择文件';
        }
    }

    public function search_patient_info($booking_code = null)
    {
        $this->report_model->_table_name = 'tbl_patient_booking'; //table name
        $this->report_model->_order_by = 'booking_id';
        $data = $this->report_model->get_by(array('patient_code' => $booking_code), true);
        echo json_encode($data);
    }

    public function search_my_contact($status = null)
    {
        $sdata = [];
        if ($this->input->get('patient_code')) {
            $sdata['patient_code'] = $this->input->get('patient_code');
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
        if (('' != $this->input->get('contact_status'))) {
            $sdata['contact_status'] = $this->input->get('contact_status');
        }
        if ('' != $this->input->get('contact_type')) {
            $sdata['contact_type'] = $this->input->get('contact_type');
        }
        if ('' == $this->input->get('time_type')) {
        }
        switch ($this->input->get('time_type')) {
        case 1:
            // code...
            $time_type = 'submit_time';
            break;
        case 2:
            $time_type = 'contact_start_time';
            break;
        default:
            // code...
            break;
        }
        if (('' != $this->input->get('start_time'))) {
            $sdata[$time_type.' >='] = date('Y-m-d', strtotime($this->input->get('start_time')));
        }
        if (('' != $this->input->get('end_time')) || ($this->input->get('end_time'))) {
            $sdata[$time_type.' <='] = date('Y-m-d', strtotime($this->input->get('end_time')));
        }

        if ($this->input->get('searchdate')) {
            switch ($this->input->get('searchdate')) {
            case 1:
                // code...
                $sdata[$time_type.' >='] = date('Y-m-d');
                break;
            case 2:
                $sdata[$time_type.' >='] = date('Y-m-d', strtotime('-1 days'));
                break;
            case 3:
                // code...
                $sdata[$time_type.' >='] = date('Y-m-d', strtotime('-3 days'));

                break;
            case 4:
                // code...
                $sdata[$time_type.' >='] = date('Y-m-d', strtotime('-7 days'));
                break;
            default:
                // code...
                break;
            }
        }
        if (1 == $this->session->userdata('usr_role')) {
            $sdata['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif (1024 == $this->session->userdata('usr_role')) {
        } else {
            if ($status) {
                $sdata['tbl_contact_info.req_doctor_name'] = $this->session->userdata('id');
            } else {
                $sdata['tbl_hospital.hospital_name'] = $this->session->userdata('hospital_name');
            }
        }

        $result_data = $this->report_model->get_contact_info($sdata);
        $i = 1;
        $data['data'] = [];
        if (count($result_data) > 0) {
            foreach ($result_data as $var_report) {
                if ($status) {
                    if ('2' != $var_report->contact_status && $var_report->req_doctor_name != $this->session->userdata('id')) {
                        $action = '';
                        $action = '';
                        $contact_review = '';
                        $contact_join = '';
                        if (check_role('DeliContact')) {
                            $contact_review = '<button type="button" onclick="DeliContact('.$var_report->contact_id.')" class="btn contact-button">审核</button>';
                        }
                        $contact_detail_view = '<button type="button" onclick="contactDetailView('.$var_report->contact_id.')" class="btn contact-button">查看</button>';
                        if ('1' == $var_report->contact_status) {
                            $contact_status = '<span class="badge  badge-info">未审核 </span>';
                            $action = $contact_detail_view.$contact_review;
                        } elseif ('2' == $var_report->contact_status) {
                            $contact_status = '<span class="badge  badge-danger">草稿 </span>';
                        } elseif ('3' == $var_report->contact_status) {
                            $contact_status = '<span class="badge  bg-green-dark">已安排 </span>';
                            $action = $contact_detail_view;
                        } elseif ('4' == $var_report->contact_status) {
                            $contact_status = '<span class="badge  badge-success">已拒绝 </span>';
                            $action = $contact_detail_view;
                        } elseif ('5' == $var_report->contact_status) {
                            $contact_status = '<span class="badge  badge-warning">已结束 </span>';
                            $action = $finish_button;
                        }
                        if ('1' == $var_report->patient_gender) {
                            $gender = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                        } else {
                            $gender = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                        }
                        if ('1' == $var_report->contact_type) {
                            if (5 == $var_report->contact_status) {
                                $contact_type = '<span class="label label-warning"> 远程会诊 </span>';
                            } else {
                                $contact_type = '<span class="label label-warning"> 远程会诊 </span>';
                            }
                        } elseif ('2' == $var_report->contact_type) {
                            $contact_type = '<span class="label label-info"> 远程门诊 </span>';
                        } else {
                            $contact_status = '<span class="badge  badge -warning">会议中 </span>';
                            $action = $contact_join.$contact_detail_view;
                        }
                        $data['data'][] = array(
                            $action,
                            $i++,
                            $contact_status,
                            $var_report->patient_code,
                            $var_report->patient_name,
                            $gender,
                            $var_report->patient_age,
                            $contact_type,
                            $var_report->contact_title,
                            $var_report->contact_start_time,
                            $var_report->req_hospital,
                            get_user_name_by_id($var_report->req_doctor_name),
                            $var_report->submit_time,
                        );
                    }
                } else {
                    if ($var_report->req_doctor_name == $this->session->userdata('id')) {
                        $action = '';
                        $action = '';
                        $contact_review = '';
                        $contact_join = '';
                        if (check_role('DeliContact')) {
                            $contact_review = '<button type="button" onclick="DeliContact('.$var_report->contact_id.')" class="btn btn-sm dark"><span class="fa fa-video-camera"> </span></button>';
                        }
                        if (is_check_join_contact($var_report->contact_id)) {
                            $contact_join = '<a href="'.base_url().'contact/contactRoom/'.$var_report->contact_id.'/'.$var_report->password.'" class="btn contact-button btn-sm green">加入会诊</span></a>';
                        }
                        $contact_detail_view = '<button type="button" onclick="contactDetailView('.$var_report->contact_id.')" class="btn contact-button btn-sm">查看</button>';
                        $finish_button = '<button type="button" class="btn btn-sm contact-button">会议结束</button>';
                        $delete_contact = '<button type="button" onclick="deleteContact('.$var_report->contact_id.')" class="btn btn-sm contact-button">删除</button>';
                        $edit_contact = '<button type="button" onclick="EditContact('.$var_report->contact_id.')" class="btn btn-sm contact-button">编辑</button>';
                        $start_contact = '<button type="button" onclick="startContact('.$var_report->contact_id.')" class="btn btn-sm contact-button">开始会议</button>';
                        if ('1' == $var_report->contact_status) {
                            $contact_status = '<span class="badge  badge-info">已提交 </span>';
                            $action = $contact_detail_view.$delete_contact;
                        } elseif ('2' == $var_report->contact_status) {
                            $contact_status = '<span class="badge  badge-danger">草稿 </span>';
                            $action = $edit_contact.$delete_contact;
                        } elseif ('3' == $var_report->contact_status) {
                            $contact_status = '<span class="badge  bg-green-dark">已安排 </span>';
                            $action = $start_contact.$delete_contact;
                        } elseif ('4' == $var_report->contact_status) {
                            $contact_status = '<span class="badge  badge-success">已拒绝 </span>';
                            $action = $edit_contact.$delete_contact;
                        } elseif ('5' == $var_report->contact_status) {
                            $contact_status = '<span class="badge  badge-warning">已结束 </span>';
                            $action = $finish_button;
                        } else {
                            $contact_status = '<span class="badge  badge -warning">会议中 </span>';
                            $action = $contact_join.$contact_detail_view;
                        }
                        if ('1' == $var_report->patient_gender) {
                            $gender = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                        } else {
                            $gender = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                        }
                        if ('1' == $var_report->contact_type) {
                            $contact_type = '<span class="label label-warning"> 远程会诊 </span>';
                        } elseif ('2' == $var_report->contact_type) {
                            $contact_type = '<span class="label label-info"> 远程门诊 </span>';
                        }

                        $data['data'][] = array(
                            $action,
                            $i++,
                            $contact_status,
                            $var_report->patient_code,
                            $var_report->patient_name,
                            $gender,
                            $var_report->patient_age,
                            $contact_type,
                            $var_report->contact_title,
                            $var_report->contact_start_time,
                            get_user_name_by_id($var_report->req_doctor_name),
                            $var_report->submit_time,
                        );
                    }
                }
            }
        }
        echo json_encode($data);
    }

    public function deleteContact($id = null)
    {
        $this->admin_model->_table_name = 'tbl_contact_info'; // table name
        $this->admin_model->_primary_key = 'contact_id';
        $this->admin_model->delete($id);
        echo json_encode(array('status' => 'success'));
    }

    public function outpatient($booking_id = null)
    {
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['hospital_info'] = $this->admin_model->get_hospitalinfo();
        $data['contact_type'] = '2';
        $data['contact_info'] = $this->contact->get_patient_info_by_id(['booking_id' => $booking_id]);
        $data['department_info'] = $this->admin_model->get_departmentinfo();
        $data['subview'] = $this->load->view('contact/contact_start', $data, true);
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

    public function ajax_contact_detail($contact_id = null)
    {
        $sdata = array('contact_id' => $contact_id);
        try {
            $data['contact_info'] = $this->report_model->get_contact_info($sdata)[0];
        } catch (Exception $e) {
            $data['contact_info'] = null;
        }
        $this->load->view('contact/ajax_contact_detail', $data);
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

    public function ajax_contact_review_proc($contact_id = null)
    {
        $sdata = array('contact_id' => $contact_id);
        $data['device_class'] = $this->report_model->get_device_class();
        $data['contact_info'] = $this->report_model->get_contact_info($sdata)[0];
        $this->load->view('contact/ajax_contact_review_proc', $data);
    }

    public function contactRoom($contact_id = null, $room_id = null)
    {
        // $updateData = array('mem_status' => 2);
        // $where = array('mem_doc_id' => $this->session->userdata('id'), 'mem_contact_id' => $contact_id);
        // $this->report_model->set_action($where, $updateData, 'tbl_contact_member');
        $sdata = array('contact_id' => $contact_id);
        $data['room_id'] = $room_id;
        $data['contact_info'] = $this->report_model->get_contact_info($sdata)[0];
        $data['device_class'] = $this->report_model->get_device_class();
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['memberInfo'] = $this->report_model->getContactRoomMemberInfo(array('mem_contact_id' => $contact_id));
        //echo var_dump($data['memberInfo']);
        $data['subview'] = $this->load->view('videoChat/videoChat', $data, true);
        $this->load->view('videoChat/layout', $data);
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
            echo json_encode('ok');
        }
    }

    public function RejrctHuiZhen($id = null)
    {
        $update['reject_reason'] = $this->input->post('reject_reason');
        $update['contact_status'] = '4';
        $where = array('contact_id' => $id);
        $res = $this->admin_model->set_action($where, $update, 'tbl_contact_info');
        if ($res) {
            echo json_encode('ok');
        }
    }

    public function contactAnpaiInfo()
    {
        $update = $this->admin_model->array_from_post(array(
            'contact_title',
            'password',
            'set_check_time',
            'control_dataTime',
            'iscontrol_time',
        ));
        $update['contact_status'] = 3;
        $where = array('contact_id' => $this->input->post('contact_id'));
        $contact_id = $this->input->post('contact_id');
        $this->admin_model->set_action($where, $update, 'tbl_contact_info');
        $doctorid = $this->input->post('doctor_id');
        foreach ($doctorid as $doctor) {
            $insertData = array('mem_contact_id' => $contact_id, 'mem_doc_id' => $doctor, 'mem_status' => 1, 'mem_time' => date('Y-m-d h:i:s'));
            $this->report_model->_table_name = 'tbl_contact_member'; //table name
            $this->report_model->_primary_key = 'mem_id';
            if ($this->report_model->save($insertData)) {
            } else {
                echo json_encode(array('status' => 'error'));
            }
        }
        echo json_encode(array('status' => 'success'));
    }

    public function contactDeli()
    {
        $data['menutitle'] = $this->lang->line('remote_contact');
        $this->report_model->_table_name = 'tbl_contact_info'; //table name
        $this->report_model->_order_by = 'contact_id';
        $data['contact_list'] = $this->report_model->get();
        $data['subview'] = $this->load->view('contact/contactDeli', $data, true);
        $this->load->view('layout', $data);
    }

    public function getContactAddrInfo()
    {
        $res = $this->admin_model->get_userinfo();
        echo json_encode($res);
    }

    public function videoChat($booking_id = null)
    {
        $data['dicom_url'] = $this->report_model->past_get_dicom_url($booking_id);
        $data['menutitle'] = $this->lang->line('report');
        $data['subview'] = $this->load->view('dicom/videoChat', $data, true);
        $this->load->view('dicom/layout', $data);
    }

    public function get_hostipal_tree()
    {
        $hosInfo = $this->admin_model->get_hospitalinfo();
        $doctorInfo = $this->admin_model->get_userinfo();
        $department = $this->admin_model->get_departmentinfo();
        foreach ($hosInfo as $value) {
            $data[] = array('id' => 'hospital_'.$value->hospital_id, 'icon' => 'fa fa fa-bank icon-lg icon-state-success', 'parent' => '#', 'text' => $value->hospital_name);
            foreach ($department as $tmpdetarment) {
                $data[] = array('id' => 'department_'.$value->hospital_id.'_'.$tmpdetarment->department_id, 'parent' => 'hospital_'.$value->hospital_id, 'text' => $tmpdetarment->department_name, 'icon' => 'fa fa-briefcase icon-lg icon-state-success');
                foreach ($doctorInfo as $doctor) {
                    if ($doctor->id == $this->session->userdata('id')) {
                        continue;
                    }
                    if ($doctor->usr_department === $tmpdetarment->department_name && $doctor->usr_hospital === $value->hospital_name) {
                        $data[] = array('id' => 'doctor_'.$doctor->id, 'parent' => 'department_'.$value->hospital_id.'_'.$tmpdetarment->department_id, 'text' => $doctor->usr_id, 'icon' => 'fa fa-user icon-lg icon-state-success');
                    }
                }
            }
        }
        echo json_encode($data);
    }

    public function get_DoctorInfo($id = null)
    {
        $sdata = array('tbl_doctor.usr_id' => $id);
        $doctorInfo = $this->admin_model->get_userinfo($sdata);
        if ($doctorInfo) {
            echo json_encode($doctorInfo[0]);
        } else {
            echo '';
        }
    }

    public function get_alramInfo($usr_id = null)
    {
        $sdata = array('mem_doc_id' => $usr_id, 'mem_status' => 1);
        $alram = $this->report_model->get_alramContact($sdata);
        echo json_encode($alram);
    }

    public function start_contact()
    {
        $data = array();
        $data['start_time'] = date('Y-m-d h:i:s');
        $data['contact_id'] = $this->input->get('contact_id');
        $this->report_model->set_contact_start_time($data);
        echo json_encode($data);
    }

    public function end_contact()
    {
        $updateData = array('mem_status' => 2);
        $where = array('mem_doc_id' => $this->session->userdata('id'), 'mem_contact_id' => $contact_id);
        $this->report_model->set_action($where, $updateData, 'tbl_contact_member');
        $data = array();
        $data['end_time'] = date('Y-m-d h:i:s');
        $data['contact_id'] = $this->input->get('contact_id');
        $data['booking_id'] = $this->input->get('booking_id');
        $this->report_model->set_contact_end_time($data);
        echo json_encode($data);
    }

    public function start_contact_enable()
    {
        $data = array();
        $data['contact_id'] = $this->input->get('contact_id');
        $data['set_check_time <='] = date('Y-m-d h:i:s');
        $result = $this->report_model->start_contact_enable($data);
        echo json_encode($result);
    }

    public function set_mem_status()
    {
        $data = array();
        $data['contact_id'] = $this->input->get('contact_id');
        $this->report_model->set_mem_status($data);
        echo json_encode($data);
    }

    public function serach_remote_contact($status = null)
    {
        $sdata = [];
        if ($this->input->get('patient_code')) {
            $sdata['patient_code'] = $this->input->get('patient_code');
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
        if (('' != $this->input->get('contact_status'))) {
            $sdata['contact_status'] = $this->input->get('contact_status');
        }
        if ('' != $this->input->get('contact_type')) {
            $sdata['contact_type'] = $this->input->get('contact_type');
        }

        switch ($this->input->get('time_type')) {
        case 1:
            // code...
            $time_type = 'submit_time';
            break;
        case 2:
            $time_type = 'contact_start_time';
            break;
        default:
            // code...
            break;
        }
        if (('' != $this->input->get('start_time'))) {
            $sdata[$time_type.' >='] = date('Y-m-d', strtotime($this->input->get('start_time')));
        }
        if (('' != $this->input->get('end_time')) || ($this->input->get('end_time'))) {
            $sdata[$time_type.' <='] = date('Y-m-d', strtotime($this->input->get('end_time')));
        }

        if ($this->input->get('searchdate')) {
            switch ($this->input->get('searchdate')) {
            case 1:
                // code...
                $sdata[$time_type.' >='] = date('Y-m-d');
                break;
            case 2:
                $sdata[$time_type.' >='] = date('Y-m-d', strtotime('-1 days'));
                break;
            case 3:
                // code...
                $sdata[$time_type.' >='] = date('Y-m-d', strtotime('-3 days'));

                break;
            case 4:
                // code...
                $sdata[$time_type.' >='] = date('Y-m-d', strtotime('-7 days'));
                break;
            default:
                // code...
                break;
            }
        }

        if (1 == $this->session->userdata('usr_role')) {
            $sdata['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif (1024 == $this->session->userdata('usr_role')) {
        } else {
            if ($status) {
                $sdata['tbl_contact_info.req_doctor_name'] = $this->session->userdata('id');
            } else {
                $sdata['tbl_hospital.hospital_name'] = $this->session->userdata('hospital_name');
            }
        }

        $result_data = $this->report_model->get_contact_info($sdata);
        $i = 1;
        $data['data'] = [];
        if (count($result_data) > 0) {
            foreach ($result_data as $var_report) {
                if ('3' == $var_report->contact_status || '5' == $var_report->contact_status || '6' == $var_report->contact_status) {
                    //&& $var_report->req_doctor_name != $this->session->userdata('id')) {
                    $action = '';
                    $contact_review = '';
                    $contact_join = '';
                    $is_own_contact = $var_report->req_doctor_name == $this->session->userdata('id');
                    if (check_role('DeliContact')) {
                        // $contact_review = '<button type="button" onclick="DeliContact(' . $var_report->contact_id . ')" class="btn contact-button"><span class="fa fa-video-camera"> </span></button>';
                    }
                    if (is_check_join_contact($var_report->contact_id)) {
                        $contact_join = '<a href="'.base_url().'contact/contactRoom/'.$var_report->contact_id.'/'.$var_report->password.'" class="btn contact-button">加入会诊</span></a>';
                    } elseif ($is_own_contact) {
                        $contact_join = '<a href="'.base_url().'contact/contactRoom/'.$var_report->contact_id.'/'.$var_report->password.'" class="btn contact-button">开始会诊</span></a>';
                    }
                    $contact_detail_view = '<button type="button" onclick="contactDetailView('.$var_report->contact_id.')" class="btn contact-button">查看</button>';
                    $finish_button = '<button type="button" class="btn contact-button">会议结束</button>';
                    if ('1' == $var_report->contact_status) {
                        $contact_status = '<span class="badge  badge -info">已提交 </span>';
                        $action = $contact_review.$contact_detail_view;
                    } elseif ('2' == $var_report->contact_status) {
                        $contact_status = '<span class="badge  badge -danger">草稿 </span>';
                        $action = $contact_detail_view;
                    } elseif ('3' == $var_report->contact_status) {
                        $contact_status = '<span class="badge  bg-green-dark">已安排 </span>';
                        $action = $is_own_contact ? $contact_detail_view.$contact_join : $contact_detail_view;
                    } elseif ('4' == $var_report->contact_status) {
                        $contact_status = '<span class="badge  badge -success">已拒绝 </span>';
                        $action = $contact_detail_view;
                    } elseif ('5' == $var_report->contact_status) {
                        $contact_status = '<span class="badge  badge -warning">已结束 </span>';
                        $action = $contact_detail_view.$finish_button;
                    } else {
                        $contact_status = '<span class="badge  badge -warning">会议中 </span>';
                        $action = $contact_join.$contact_detail_view;
                    }
                    if ('1' == $var_report->patient_gender) {
                        $gender = '<button type="button" class="btn btn-sm btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                    } else {
                        $gender = '<button type="button" class="btn btn-sm btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                    }
                    if ('1' == $var_report->contact_type) {
                        if (5 == $var_report->contact_status) {
                            $contact_type = '<span class="label label-warning"> 远程会诊 </span>';
                        } else {
                            $contact_type = '<span class="label label-warning"> 远程会诊 </span>';
                        }
                    } elseif ('2' == $var_report->contact_type) {
                        $contact_type = '<span class="label label-info"> 远程门诊 </span>';
                    }
                    $data['data'][] = array(
                        $action,
                        $i++,
                        $contact_status,
                        $var_report->patient_code,
                        $var_report->patient_name,
                        $gender,
                        $var_report->patient_age,
                        $contact_type,
                        $var_report->contact_title,
                        $var_report->contact_end_time,
                        get_user_name_by_id($var_report->req_doctor_name),
                        $var_report->submit_time,
                    );
                }
            }
        }
        echo json_encode($data);
    }
}
