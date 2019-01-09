<?php

class Report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report_model');
    }
    public function index()
    {
        $data['menutitle'] = $this->lang->line('report');
        $data['subview'] = $this->load->view('report/index', $data, true);
        $this->load->view('layout', $data);
    }

    public function home()
    {
        $data['menutitle'] = $this->lang->line('report');
        $data['report_data'] = $this->report_model->get_report_data();
        $data['device_class'] = $this->report_model->get_device_class();
        $data['page_title'] = $this->lang->line('report_table');
        $data['subview'] = $this->load->view('report/report_table', $data, true);
        $this->load->view('layout', $data);
    }
    public function reporting($booking_id = null)
    {
        $class_id = array('module_class' => 1);
        $data['module_view'] = $this->report_model->get_module($class_id);
        $data['module'] = $this->report_model->get_module();
        $data['module_class'] = $this->report_model->get_module_class();
        $data['template'] = $this->report_model->get_template_data();
        $data['report_table'] = $this->report_model->report_data_for_reporting($booking_id);
        $data['menutitle'] = $this->lang->line('report');
        $data['device_class'] = $this->report_model->get_device_class();
        $data['subview'] = $this->load->view('report/reporting', $data, true);
        $this->load->view('layout', $data);
    }

    public function reporting_view($report_id = null)
    {
        $data['menutitle'] = $this->lang->line('report');
        $search_data = ['tbl_report.report_id' => $report_id];
        $data['isreview'] = null;
        try {
            $data['isreview'] = $this->isreview($report_id);
            $this->report_model->_table_name = "tbl_report_log"; //table name
            $this->report_model->_order_by = "id";
            $data['report_log'] = $this->report_model->get_by(array('rpt_id' => $report_id), false);
            $data['report_data'] = $this->report_model->get_report_data($search_data)[0];
        } catch (Exception $e) {
        }

        $data['subview'] = $this->load->view('report/report_detail', $data, true);
        $this->load->view('layout', $data);
    }

    public function individual()
    {
        $data['menutitle'] = $this->lang->line('report');
        $data['page_title'] = $this->lang->line('report_table');
        $data['subview'] = $this->load->view('report/individual', $data, true);
        $this->load->view('layout', $data);
    }

    public function individual_report()
    {
        $data['report_data'] = $this->report_model->get_report_data();
        $data['device_class'] = $this->report_model->get_device_class();
        $data['bk_status'] = $this->report_model->get_bk_status();
        $this->load->view('report/ajax_individual_report', $data);
    }

    public function get_template_info($template_id = null)
    {
        $sdata = array('template_id' => $template_id);
        $res = $this->report_model->get_template_data($sdata);
        foreach ($res as $value) {
            $temp = $value;
        }
        echo json_encode($temp);
    }

    public function get_module_Info($template_id = null)
    {
        $sdata = array('module_id' => $template_id);
        $res = $this->report_model->get_module($sdata);
        foreach ($res as $value) {
            $temp = $value;
        }
        echo json_encode($temp);
    }

    public function get_template_data($module_id = null, $device_type = null)
    {
        $sdata = null;
        if ($module_id) {
            $sdata = array('report_module_id' => $module_id);
        }
        if ($device_type) {
            $sdata['device_type'] = $device_type;
        }

        $data = $this->report_model->get_template_data($sdata);
        if (count($data) == 0) {
            $rdata['data'][0] = array(
                '',
                '',
            );
        } else {
            foreach ($data as $value) {
                $rdata['data'][] = array(
                    $value->template_id,
                    $value->template_name,
                );
            }
        }
        echo json_encode($rdata);
    }

    public function delete_module()
    {
        $module_id = $this->input->post('module_id');
        $this->report_model->_table_name = "tbl_report_module"; // table name
        $this->report_model->_primary_key = "module_id";
        $res = $this->report_model->delete($module_id);
        if ($res) {
            echo "   ";
        } else {
            echo " ";
        }
    }

    public function delete_template()
    {
        $template_id = $this->input->post('template_id');
        $this->report_model->_table_name = "tbl_template"; // table name
        $this->report_model->_primary_key = "template_id";
        $id = array('template_id' => $template_id);
        $res = $this->report_model->delete($template_id);
        if ($res) {
            echo "   ";
        } else {
            echo " ";
        }
    }

    public function select_class()
    {
        $class_id = array('module_class' => $this->input->post('select_class_id')
            , 'report_class' => $this->input->post('selectDevice'));
        //$class_id = array('module_class'=>$id);
        $data['module'] = $this->report_model->get_module($class_id);
        echo json_encode($data);
    }

    public function report_detail_view($booking_id = null)
    {
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
        $this->load->view('layout', $data);
    }

    public function deliberating($booking_id = null)
    {
        $data['menutitle'] = $this->lang->line('report');
        $data['page_title'] = $this->lang->line('report_table');
        $data['subview'] = $this->load->view('report/individual', $data, true);
        $this->load->view('layout', $data);

        // $data['module'] = $this->report_model->get_module();
        // $data['device_class'] = $this->report_model->get_device_class();
        // $data['module_class'] = $this->report_model->get_module_class();
        // $data['template'] = $this->report_model->get_template_data();
        // $data['past_report_data'] = $this->report_model->past_get_data($booking_id);
        // $data['report_data'] = $this->report_model->get_data($booking_id);
        // $data['menutitle'] = $this->lang->line('report');
        // $sdata['tbl_patient_booking.booking_id'] = $booking_id;
        // $data['report_data'] = $this->report_model->get_deliberation_data($sdata);
        // $data['subview'] = $this->load->view('report/delberation', $data, true);
        // $this->load->view('layout', $data);
    }

    public function redeliberation($booking_id = null)
    {
        $data['module'] = $this->report_model->get_module();
        $data['device_class'] = $this->report_model->get_device_class();
        $data['module_class'] = $this->report_model->get_module_class();
        $data['template'] = $this->report_model->get_template_data();
        $data['past_report_data'] = $this->report_model->past_get_data($booking_id);
        $data['report_data'] = $this->report_model->get_data($booking_id);
        $data['menutitle'] = $this->lang->line('report');
        $data['report_data'] = $this->report_model->get_report_data($booking_id);
        $data['subview'] = $this->load->view('report/redeliberation', $data, true);
        $this->load->view('layout', $data);
    }

    public function edit_report($booking_id = null)
    {
        $data['module'] = $this->report_model->get_module();
        $data['module_class'] = $this->report_model->get_module_class();
        $data['device_class'] = $this->report_model->get_device_class();
        $data['template'] = $this->report_model->get_template_data();
        $data['past_report_data'] = $this->report_model->past_get_data($booking_id);
        $data['menutitle'] = $this->lang->line('report');
        $sdata = array('tbl_patient_booking.booking_id' => $booking_id);
        $data['report_data'] = $this->report_model->get_report_data($sdata);
        $data['subview'] = $this->load->view('report/editing', $data, true);
        $this->load->view('layout', $data);
    }

    public function nopass_report($booking_id = null)
    {
        $update_data = array('booking_status' => '5');
        $where = array('booking_id' => $booking_id);
        $res = $this->report_model->set_action($where, $update_data, 'tbl_patient_booking');
        if ($res) {
            redirect('report');
            # code...
        }
    }

    public function getModuleLeftView($device_type = null)
    {
        $module_class = $this->report_model->get_module_class();
        $template = $this->report_model->get_template_data();
        $result_view = '<ul>';
        foreach ($module_class as $class_module) {
            $result_view .= '<li>' . $class_module->class_name . '<ul>';
            foreach ($template as $template_value) {
                if (($template_value->device_type == $device_type) && ($template_value->module_class == $module_id)) {
                    $result_view .= '<li ondblclick="select_template(' . $template_value->template_id . ')">' . $template_value->template_name . '</li>';
                }
            }
            $result_view .= "</ul></li>";
        }
        $result_view .= "</ul>";
        echo $result_view;
    }

    public function add_template()
    {
        $data = $this->report_model->array_from_post(array('template_name',
            'checkup_name',
            'report_module_id',
            'image_expression',
            'recommended_report',
            'device_type',
        ));
        $data['create_time'] = date('Y-m-d h:i:s');
        $template_id = $this->input->post('template_id');
        if ($template_id) {
            $where = array('template_id' => $template_id);
            $res = $this->report_model->set_action($where, $data, 'tbl_template');
            if ($res) {
                echo json_encode(array('status' => "success"));
            }
        } else {
            $this->report_model->_table_name = "tbl_template"; //table name
            $this->report_model->_primary_key = "template_id";
            if ($this->report_model->save($data)) {
                echo json_encode(array('status' => "success"));
            }
        }
    }

    public function update_template()
    {
        $update_data = $this->login_model->array_from_post(array('template_name',
            'checkup_name',
            'report_module_id',
            'image_expression',
            'recommended_report',
        ));
        $template_id = $this->input->post('template_id');
        $where = array('template_id' => $template_id);
        $res = $this->report_model->set_action($where, $update_data, 'tbl_template');
        if ($res) {
            echo "   ";
        }
    }

    public function dicom_view1($booking_id = null)
    {
        $sdata['booking_id'] = $booking_id;
        $data['booking_data'] = $this->report_model->get_booking_data($sdata)[0];
        $data['menutitle'] = $this->lang->line('report');
        $this->load->view('dicom/2dviewer', $data);
    }

    public function dicom_view($booking_id = null)
    {
        $sdata['booking_id'] = $booking_id;
        $data['booking_data'] = $this->report_model->get_booking_data($sdata)[0];
        $data['menutitle'] = $this->lang->line('report');
        $data['subview'] = $this->load->view('dicom/dicomFind', $data, true);
        $this->load->view('dicom/layout', $data);
    }

    public function get_report_data($booking_id = null)
    {
        $sdata = array('tbl_patient_booking.booking_id' => $booking_id);
        $data = $this->report_model->get_report_data($sdata);
        foreach ($data as $value) {
            $real_data = $value;
        }
        echo json_encode($real_data);
    }

    public function search_data($ismyreport = null)
    {
        $search_data = [];
        if ($this->input->get('image_num') != "") {
            $search_data['image_num'] = $this->input->get('image_num');
        }
        if ($this->input->get('patient_name') != "") {
            $search_data['patient_name'] = $this->input->get('patient_name');
        }
        if ($this->input->get('patient_age') != "") {
            $search_data['patient_age'] = $this->input->get('patient_age');
        }
        if ($this->input->get('patient_gender') != "") {
            $search_data['patient_gender'] = $this->input->get('patient_gender');
        }
        if ($this->input->get('checkup_type') != "") {
            $search_data['checkup_type'] = $this->input->get('checkup_type');
        }
        if ($this->input->get('booking_status') != "") {
            $search_data['booking_status'] = $this->input->get('booking_status');
        }
        if ($this->input->get('remote_status') != "") {
            $search_data['remote_status'] = $this->input->get('remote_status');
        }

        if ($this->input->get('patient_source') != "") {
            $search_data['patient_source'] = $this->input->get('patient_source');
        }

        if ($this->session->userdata('usr_role') == 1) {
            $search_data['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } else {
            $search_data['tbl_patient_booking.hospital_name'] = $this->session->userdata('hospital_name');
        }
        if ($ismyreport == 'my') {
            $search_data['report_doc_name'] = $this->session->userdata('usr_id');
            $result_data = $this->report_model->search_data($search_data);
        } elseif ($ismyreport == 'deli') {
            $result_data = $this->report_model->get_deliberation_data($search_data);
        } else {
            $result_data = $this->report_model->search_data($search_data);
        }
        $i = 1;
        $data = [];
        if ($result_data) {
            foreach ($result_data as $value) {
                if (!$value->del_status && $value->booking_status != '1') {
                    if ((!$ismyreport || $ismyreport == 'deli') && $value->report_doc_name == $this->session->userdata('usr_id')) {
                        continue;
                    }
                    if ($ismyreport == 'deli') {
                        if ($value->booking_status == '2' || $value->booking_status == '7' || $value->booking_status == '6') {
                            continue;
                        }
                    }
                    if ($value->patient_gender == '1') {
                        $gender = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                    } else {
                        $gender = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                    }

                    if ($value->remote_status == '1') {
                        $remote_status = '<button type="button" class="btn btn-sm btn-circle red">是</button>';
                    } else {
                        $remote_status = '<button type="button" class="btn btn-sm btn-circle blue">否</button>';
                    }

                    if ($value->patient_source == '0') {
                        $patient_source = '<span type="button" class="btn btn red">门诊</span>';
                    } elseif ($value->patient_source == '1') {
                        $patient_source = '<button type="button" class="btn btn blue">住院</button>';
                    } else {
                        $patient_source = '<button type="button" class="btn btn dark">体检</button>';
                    }

                    if ($value->booking_status == '1') {
                        $booking_status = '<span  class="col-md-12 badge badge-warning"> 已登记 </span>';
                    } elseif ($value->booking_status == '2') {
                        $booking_status = '<span class="col-md-12 badge badge-primary "> 待诊断 </span>';
                    } elseif ($value->booking_status == '3') {
                        $booking_status = '<span  class="col-md-12 badge badge-info "> 待审核 </span>';
                    } elseif ($value->booking_status == '4') {
                        $booking_status = '<span  class="col-md-12 badge badge-success "> 报告完成 </span>';
                    } elseif ($value->booking_status == '5') {
                        $booking_status = '<span  class="col-md-12 badge badge-danger "> 回退审核 </span>';
                    } elseif ($value->booking_status == '6') {
                        $booking_status = '<span  class="col-md-12 badge badge-danger "> 检查中 </span>';
                    } elseif ($value->booking_status == '7') {
                        $booking_status = '<span  class="col-md-12 badge badge-danger "> 检查草稿 </span>';
                    }
                    $booking_id = '<input type="hidden" class="device_id" value="' . $value->delivery_name . '">';

                    $this->report_model->_table_name = "tbl_check_list"; //table name
                    $this->report_model->_order_by = "chc_id";
                    $check_data = $this->report_model->get_by(array('chc_booking_id' => $value->delivery_name), false);
                    $checkup_item = '';
                    $checkup_time = '';
                    foreach ($check_data as $check_info) {
                        $checkup_item .= $check_info->checkup_item . '</br>';
                        $checkup_time .= $check_info->checkup_time . '<br>';
                    }
                    try {
                        $user_name = $this->report_model->get_user_info(array('usr_id' => $value->report_doc_name));
                        $user_name = isset($user_name[0]) ? $user_name[0]->usr_name : '';
                    } catch (Exception $e) {
                        $user_name = '';
                    }

                    $data['data'][] = array(
                        $i++ . $booking_id,
                        $value->patient_code,
                        $value->patient_name,
                        $gender,
                        $value->patient_age,
                        $checkup_item,
                        $remote_status,
                        $value->hospital_name,
                        $patient_source,
                        $value->license_num,
                        $checkup_time,
                        $value->req_doctor_name,
                        $booking_status,
                        $user_name,
                    );
                }
            }
        } else {
            $data['data'] = [];
        }
        echo json_encode($data);
    }
    public function save_report($isSave = null)
    {
        $data = $this->report_model->array_from_post(array('checkup_id',
            'Imaging_performance',
            'positive_status',
            'urgency_status',
            'image_degree',
            'impression',
            'clinical_diagnosis',
            'recommend_report',
            'report_module',
        ));
        $data['report_doc_name'] = $this->session->userdata('usr_id');
        $data['diagnosis_source'] = 1;
        try {
            $checkup_id = $data['checkup_id'];
            if ($this->input->post('report_id')) {
                $report_id = $this->input->post('report_id');
                $data['last_update_time'] = date("Y-m-d H:i:s");
                $where = array('report_id' => $report_id);
                $this->report_model->set_action($where, $data, 'tbl_report');
                if ($isSave) {
                    $udata = array('checkup_status' => '7');
                } else {
                    $udata = array('checkup_status' => '4');
                    $this->report_model->save_report_log($report_id);
                }
                $bwhere = array('chc_id' => $checkup_id);
                $this->report_model->set_action($bwhere, $udata, 'tbl_check_list');
                return $this->output->set_content_type('application/json')
                    ->set_output(json_encode(['message' => '操作成功!', 'data' => [], 'response_code' => 1]));
            } else {
                $postdata = $this->input->post();
                $this->form_validation->set_data($postdata);
                $this->form_validation->set_rules('checkup_id', 'checkup_id', 'required|is_unique[tbl_report.checkup_id]');
                if ($this->form_validation->run() == false) {
                    return $this->output->set_content_type('application/json')
                        ->set_output(json_encode(['message' => '每个检查只有一个报告!', 'data' => $this->form_validation->error_array(), 'response_code' => 0]));
                }
                $data['report_time'] = date("Y-m-d H:i:s");
                if ($isSave) {
                    $udata = array('checkup_status' => '7');
                } else {
                    $udata = array('checkup_status' => '4');
                }
                $where = array('chc_id' => $checkup_id);
                $this->report_model->set_action($where, $udata, 'tbl_check_list');
                $this->report_model->_table_name = "tbl_report";
                $this->report_model->_primary_key = "report_id";
                $report_id = $this->report_model->save($data);
                $this->report_model->save_report_log($report_id);
                return $this->output->set_content_type('application/json')
                    ->set_output(json_encode([
                        'message' => '操作成功!',
                        'data' => [],
                        'response_code' => 1]));
            }
        } catch (Exception $e) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode([
                    'message' => '500 错误!',
                    'data' => $e,
                    'response_code' => 1]));
        }
    }

    public function save_delberation()
    {
        $data['deliberation_content'] = $this->input->post('deliberation_content');
        $data['doctor_name'] = $this->session->userdata('usr_name');
        $report_id = $data['report_id'] = $this->input->post('report_id');
        $data['deliberation_time'] = date("Y-m-d H:i:s");
        $booking_id = $this->input->post('booking_id');
        $update_data = array('booking_status' => '4');
        $where = array('booking_id' => $booking_id);
        $this->report_model->set_action($where, $update_data, 'tbl_patient_booking');
        $this->report_model->_table_name = "tbl_deliberation"; //table name
        $this->report_model->_primary_key = "deliberation_id";

        if ($this->report_model->save($data, null)) {
            redirect('report');
        } else {
            $data['success_status'] = "失败了审核！ 检查您的提交资料。";

            redirect('report');
        }
    }

    public function get_past_reportinfo($report_id = null)
    {
        $data['report_id'] = $report_id;
        $tdata['tdata'] = $this->report_model->get_past_reportinfo($data);
        echo json_encode($tdata);
    }

    public function past_get_report($booking_id = null)
    {
        $past_report_data['tdata'] = $this->report_model->past_get_data($booking_id);
        echo json_encode($past_report_data);
    }

    public function delberation()
    {
        $data['menutitle'] = $this->lang->line('report');
        $data['page_title'] = $this->lang->line('report_table');
        $data['subview'] = $this->load->view('report/review', $data, true);
        $this->load->view('layout', $data);
        // $data['menutitle'] = $this->lang->line('report');
        // $data['report_data'] = $this->report_model->get_deliberation_data();
        // $data['device_class'] = $this->report_model->get_device_class();
        // $data['page_title'] = $this->lang->line('report_table');
        // $data['subview'] = $this->load->view('report/delberation_table', $data, true);
        // $this->load->view('layout', $data);
    }

    public function dicomProc($chc_id = null)
    {
        $data['booking_data'] = $this->report_model->get_checkup_data_by_id($chc_id);
        $data['menutitle'] = $this->lang->line('report');
        $this->load->view('dicom/dicomView', $data);
    }

    public function my_report()
    {
        $data['menutitle'] = $this->lang->line('report');
        $sdata = array('req_doctor_name' => $this->session->userdata('usr_id'));
        $data['report_data'] = $this->report_model->get_report_data($sdata);
        $data['device_class'] = $this->report_model->get_device_class();
        $data['page_title'] = $this->lang->line('report_table');
        $data['subview'] = $this->load->view('report/my_report', $data, true);
        $this->load->view('layout', $data);
    }

    public function get_post_unread_info()
    {
        $user_id = $this->session->userdata('id');
        $all_post_to_me = $this->report_model->get_all_post_to_me($user_id); //get all post to me
        echo "ddd";
    }

    public function time_elapsed_B($secs)
    {
        $bit = array(
            ' 日' => $secs / 86400 % 7,
            ' 点' => $secs / 3600 % 24,
            ' 分' => $secs / 60 % 60,
        );

        foreach ($bit as $k => $v) {
            if ($v > 1) {
                $ret[] = $v . $k;
            }

            if ($v == 1) {
                $ret[] = $v . $k;
            }
        }
        array_splice($ret, count($ret) - 1, 0, ' ');
        $ret[] = ' ';

        return join(' ', $ret);
    }

    public function notification()
    {
        if ($this->session->userdata('usr_role') == 1) {
            $search_data['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } elseif ($this->session->userdata('usr_role') == 1000) {
            if ($this->session->userdata('MakeReport')) {
                $search_data['tbl_patient_booking.hospital_name'] = $this->session->userdata('hospital_name');
            } else {
                echo 'error';
                return;
            }
        } else {
            $search_data['tbl_patient_booking.hospital_name'] = $this->session->userdata('hospital_name');
        }
        $search_data['checkup_status'] = 2;
        $res = $this->report_model->reportNotification($search_data);
        $action = '';
        $now = time();
        foreach ($res as $value) {
            $agodate = $this->time_elapsed_B($now - strtotime($value->checked_time));
            $linkUri = base_url() . 'report/reporting/' . $value->chc_id;
            $action .= '<li><a href="' . $linkUri . '"><span class="time">' . $agodate . '前</span>';
            $action .= '<span class="details"><span class="label label-sm label-icon label-warning">  <i class="fa fa-bell-o"></i>';
            $action .= '</span>' . $value->checkup_item . ' &nbsp;&nbsp;' . $value->patient_name . '  </span> </a></li>';
        }
        echo json_encode(array('content' => $action, 'count' => count($res)));
    }

    public function get_module_tree($report_class = null)
    {
        $sdata = [];
        if ($report_class) {
            $sdata = array('report_class' => $report_class);
        }

        $classInfo = $this->report_model->get_module_class();
        $all_module_info = $this->report_model->get_module($sdata);
        foreach ($classInfo as $class) {
            $data[] = array('id' => 'class_' . $class->class_id, 'icon' => 'fa fa-folder icon-lg icon-state-success', 'parent' => '#', 'text' => $class->class_name);
            foreach ($all_module_info as $value) {
                if ($value->module_class == $class->class_id) {
                    $data[] = array('id' => 'module_' . $value->module_id, 'parent' => 'class_' . $class->class_id, 'text' => $value->module_name, 'icon' => 'fa fa-folder icon-lg icon-state-success');
                }
            }
        }
        echo json_encode($data);
    }

    public function save_reportmodule_class($id = null)
    {
        $id = $this->input->post('module_id');
        $save_data = array(
            'module_class' => $this->input->post('module_class'),
            'module_name' => $this->input->post('module_name'),
            'report_class' => $this->input->post('report_class'));
        if (!$id) {
            $this->report_model->_table_name = "tbl_report_module";
            $this->report_model->_primary_key = "module_id";
            $this->report_model->save($save_data);
        } else {
            $where = array('module_id' => $this->input->post('module_id'));
            $this->report_model->set_action($where, $save_data, 'tbl_report_module');
        }
        echo json_encode(array('status' => 'success'));
    }

    public function adb_rest($method, $uri, $querry = null, $json = null, $options = null)
    {
        $adb_url = "http://www..com:5005";
        $adb_option_defaults = array(
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 2,
        );
        // Connect
        if (!isset($adb_handle)) {
            $adb_handle = curl_init();
        }
        // Compose querry
        $options = array(
            CURLOPT_URL => $adb_url . $uri . "?" . $querry,
            CURLOPT_CUSTOMREQUEST => $method, // GET POST PUT PATCH DELETE HEAD OPTIONS
            CURLOPT_POSTFIELDS => $json,
        );
        curl_setopt_array($adb_handle, ($options + $adb_option_defaults));
        $response = json_decode(curl_exec($adb_handle), true);
        return ($response);
    }

    public function pastcheckup($patient_code = null)
    {
        $data['data'] = [];
        if ($patient_code) {
            $report_data = $this->report_model->search_report(['patient_code' => $patient_code, 'booking_status !=' => 2]);
            if (count($report_data) > 0) {
                $i = 1;
                foreach ($report_data as $value) {
                    $report_id = '<input type="hidden" class="report_id" value="' . $value->report_id . '">';
                    $data['data'][] = array(
                        $i++ . $report_id,
                        $value->patient_code,
                        $value->checked_time,
                        $value->checkup_type,
                        $value->patient_age,
                        $value->checkup_item,
                        $value->image_num,
                    );
                }
            }
        }
        echo json_encode($data);
    }

    public function getPastReport($report_id = null)
    {
        try {
            $report_data = $this->report_model->search_data(['report_id' => $report_id])[0];
        } catch (\Exception $e) {
            $report_data = [];
        }
        echo json_encode($report_data);
    }
    public function local_report()
    {
        $data['report_data'] = $this->report_model->get_report_data();
        $data['device_class'] = $this->report_model->get_device_class();
        $data['bk_status'] = $this->report_model->get_bk_status();
        $this->load->view('report/ajax_local_report', $data);
    }

    public function remote_report()
    {
        $data['report_data'] = $this->report_model->get_report_data();
        $data['device_class'] = $this->report_model->get_device_class();
        $data['bk_status'] = $this->report_model->get_bk_status();
        $this->load->view('report/ajax_remote_report', $data);
    }

    public function review_report()
    {
        $data['report_data'] = $this->report_model->get_report_data();
        $data['device_class'] = $this->report_model->get_device_class();
        $data['bk_status'] = $this->report_model->get_bk_status();
        $this->load->view('report/ajax_review_report', $data);
    }

    public function search_report($ismyreport = null)
    {
        $search_data = [];
        if ($this->input->get('image_num') != "") {
            $search_data['image_num'] = $this->input->get('image_num');
        }
        if ($this->input->get('diagnosis_source') != "") {
            $search_data['diagnosis_source'] = $this->input->get('diagnosis_source');
        }

        if ($this->input->get('patient_name') != "") {
            $search_data['patient_name'] = $this->input->get('patient_name');
        }
        if ($this->input->get('patient_age') != "") {
            $search_data['patient_age'] = $this->input->get('patient_age');
        }
        if ($this->input->get('patient_gender') != "") {
            $search_data['patient_gender'] = $this->input->get('patient_gender');
        }
        if ($this->input->get('booking_status') != "") {
            $search_data['booking_status'] = $this->input->get('booking_status');
        }
        if ($this->input->get('remote_status') != "") {
            $search_data['remote_status'] = $this->input->get('remote_status');
        }

        if ($this->input->get('patient_source') != "") {
            $search_data['patient_source'] = $this->input->get('patient_source');
        }

        if ($this->input->get('checkup_type') != "") {
            $search_data['checkup_type'] = $this->input->get('checkup_type');
        }

        if ($this->input->get('checkup_status') != "") {
            $search_data['checkup_status'] = $this->input->get('checkup_status');
        }

        if ($this->session->userdata('usr_role') == 1) {
            $search_data['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } else {
            $search_data['tbl_patient_booking.hospital_name'] = $this->session->userdata('hospital_name');
        }
        $time_type = '';
        switch ($this->input->get('time_type')) {
            case 1:
                # code...
                $time_type = 'booking_time';
                break;
            case 2:
                $time_type = 'checkuped_time';
                break;
            case 3:
                # code...
                $time_type = 'checkup_time';
                break;
            default:
                # code...
                break;
        }
        if (($this->input->get('start_time') != "")) {
            $search_data[$time_type . ' >='] = date("Y-m-d", strtotime($this->input->get('start_time')));
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $search_data[$time_type . ' <='] = date("Y-m-d", strtotime($this->input->get('end_time')));
        }

        if ($this->input->get('searchdate')) {
            switch ($this->input->get('searchdate')) {
                case 1:
                    # code...
                    $search_data[$time_type . ' >='] = date("Y-m-d");
                    break;
                case 2:
                    $search_data[$time_type . ' >='] = date('Y-m-d', strtotime("-1 days"));
                    break;
                case 3:
                    # code...
                    $search_data[$time_type . ' >='] = date('Y-m-d', strtotime("-3 days"));

                    break;
                case 4:
                    # code...
                    $search_data[$time_type . ' >='] = date('Y-m-d', strtotime("-7 days"));
                    break;
                default:
                    # code...
                    break;
            }
        }

        if ($ismyreport == 'my') {
            $search_data['report_doc_name'] = $this->session->userdata('usr_id');
            $result_data = $this->report_model->search_report($search_data);
        } else {
            $result_data = $this->report_model->search_report($search_data);
        }
        $i = 1;
        $data['data'] = [];
        if ($result_data) {
            foreach ($result_data as $value) {
                if (!$value->del_status) {
                    if ($value->checkup_status == 0 || $value->checkup_status == 1 || $value->checkup_status == 3) {
                        continue;
                    }

                    // if ($value->report_doc_name == $this->session->userdata('usr_id')) {
                    //     continue;
                    // }
                    if ($value->patient_gender == '1') {
                        $gender = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                    } else {
                        $gender = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                    }

                    if ($value->remote_status == '1') {
                        $remote_status = '<button type="button" class="btn btn-sm btn-circle red">是</button>';
                    } else {
                        $remote_status = '<button type="button" class="btn btn-sm btn-circle blue">否</button>';
                    }

                    if ($value->patient_source == '0') {
                        $patient_source = '<span type="button" class="btn btn red">门诊</span>';
                    } elseif ($value->patient_source == '1') {
                        $patient_source = '<button type="button" class="btn btn blue">住院</button>';
                    } else {
                        $patient_source = '<button type="button" class="btn btn dark">体检</button>';
                    }

                    if ($value->diagnosis_source == '1') {
                        $diagnosis_source = '<span type="button" class="btn btn red">本地</span>';
                    } else {
                        $diagnosis_source = '<button type="button" class="btn btn dark">远程</button>';
                    }
                    $checkup_status = '';
                    $action = '';
                    $report_action = '';
                    $edit_action = '';
                    $upload_action = '';
                    $share_action = '';
                    $detail_view_action = '';
                    if ($this->check_role('DiagnoseReport')) {
                        $report_action = '<button onclick="make_report(' . $value->chc_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-desktop"></i></button>';
                    }
                    if ($this->check_role('MakeReport')) {
                        $report_action = '<button onclick="make_report(' . $value->chc_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-desktop"></i></button>';
                        if ($value->report_doc_name == $this->session->userdata('usr_id')) {
                            $edit_action = '<a href="javascript:;" class="btn btn-circle btn-icon-only  blue-madison " onclick="edit_report(' . $value->chc_id . ')"> <i class="fa fa-edit"></i></a>';
                        }
                    }
                    if ($this->check_role('upload_dicom')) {
                        $upload_action = '<a href="javascript:;" class="btn btn-circle btn-icon-only  blue-madison " onclick="uploadDicom(' . $value->chc_id . ')"><i class="fa fa-cloud-upload"></i> </a>';
                    }
                    if ($this->check_role('share_dicom')) {
                        $share_action = '<a href="javascript:;" class="btn btn-circle btn-icon-only  blue-madison " onclick = sharedicom(' . $value->chc_id . ') ><i class="fa fa-share-alt"></i> </a>';
                    }
                    if ($this->check_role('detail_report_view')) {
                        $detail_view_action = '<a href="javascript:;" class="btn btn-circle btn-icon-only  blue-madison " onclick="reporting_detail_view(' . $value->chc_id . ')"><i class="fa fa-file-text"></i></a>';
                    }
                    if ($value->checkup_status == 0) {
                        $checkup_status = '<span  class="col-md-12 badge badge-warning"> 已登记 </span>';
                    } elseif ($value->checkup_status == '1') {
                        $checkup_status = '<span  class="col-md-12 badge badge-warning"> 检查中 </span>';
                    } elseif ($value->checkup_status == '2') {
                        $checkup_status = '<span class="col-md-12 badge badge-primary ">待诊断</span>';
                        $action = $report_action;
                        $action .= $upload_action . $detail_view_action . $share_action;
                    } elseif ($value->checkup_status == '3') {
                        $checkup_status = '<span  class="col-md-12 badge badge-info "> 安排中 </span>';
                    } elseif ($value->checkup_status == '4') {
                        $checkup_status = '<span  class="col-md-12 badge badge-success "> 待审核 </span>';
                        $action = '<button onclick="reportView(' . $value->report_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-eye"></i></button>';
                        $action .= $detail_view_action . $upload_action . $share_action;
                    } elseif ($value->checkup_status == '5') {
                        $checkup_status = '<span  class="col-md-12 badge badge-danger "> 报告完成 </span>';
                        $action = '<button onclick="reportView(' . $value->report_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-eye"></i></button>';
                        $action .= $detail_view_action . $upload_action . $share_action;
                    } elseif ($value->checkup_status == '6') {
                        $checkup_status = '<span  class="col-md-12 badge badge-danger "> 回退审核 </span>';
                        $action = '<button onclick="reportView(' . $value->report_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-eye"></i></button>';
                        $action .= $detail_view_action . $upload_action . $share_action . $edit_action;
                    } elseif ($value->checkup_status == '7') {
                        $checkup_status = '<span  class="col-md-12 badge badge-danger "> 检查草稿 </span>';
                        $action = '<button onclick="reportView(' . $value->report_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-eye"></i></button>';
                        $action .= $detail_view_action . $upload_action . $share_action . $edit_action;
                    }
                    $checkup_item = $value->checkup_item;
                    $checkup_time = $value->check_time;
                    $data['data'][] = array(
                        $action,
                        $i++,
                        $checkup_status,
                        $value->patient_code,
                        $value->patient_name,
                        $value->patient_age,
                        $gender,
                        $value->checkup_type,
                        $checkup_item,
                        $value->checkup_time,
                        $value->hospital_name,
                        get_user_name($value->report_doc_name),
                        get_user_name($value->doctor_name),
                    );
                }
            }
        } else {
            $data['data'] = [];
        }
        echo json_encode($data);
    }

    public function search_individual_report()
    {
        $search_data = [];
        if ($this->input->get('image_num') != "") {
            $search_data['image_num'] = $this->input->get('image_num');
        }

        if ($this->input->get('patient_age') != "") {
            $search_data['patient_age'] = $this->input->get('patient_age');
        }
        if ($this->input->get('patient_gender') != "") {
            $search_data['patient_gender'] = $this->input->get('patient_gender');
        }
        if ($this->input->get('booking_status') != "") {
            $search_data['booking_status'] = $this->input->get('booking_status');
        }
        if ($this->input->get('remote_status') != "") {
            $search_data['remote_status'] = $this->input->get('remote_status');
        }

        if ($this->input->get('patient_source') != "") {
            $search_data['patient_source'] = $this->input->get('patient_source');
        }

        if ($this->input->get('checkup_type') != "") {
            $search_data['checkup_type'] = $this->input->get('checkup_type');
        }

        if ($this->input->get('checkup_status') != "") {
            $search_data['checkup_status'] = $this->input->get('checkup_status');
        }

        if ($this->session->userdata('usr_role') == 1) {
            $search_data['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } else {
            $search_data['tbl_patient_booking.hospital_name'] = $this->session->userdata('hospital_name');
        }
        $time_type = '';
        switch ($this->input->get('time_type')) {
            case 1:
                $time_type = 'booking_time';
                break;
            case 2:
                $time_type = 'checkuped_time';
                break;
            case 3:
                $time_type = 'checkup_time';
                break;
            default:
                break;
        }
        if (($this->input->get('start_time') != "")) {
            $search_data[$time_type . ' >='] = date("Y-m-d", strtotime($this->input->get('start_time')));
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $search_data[$time_type . ' <='] = date("Y-m-d", strtotime($this->input->get('end_time')));
        }

        if ($this->input->get('searchdate')) {
            switch ($this->input->get('searchdate')) {
                case 1:
                    $search_data[$time_type . ' >='] = date("Y-m-d");
                    break;
                case 2:
                    $search_data[$time_type . ' >='] = date('Y-m-d', strtotime("-1 days"));
                    break;
                case 3:
                    $search_data[$time_type . ' >='] = date('Y-m-d', strtotime("-3 days"));
                    break;
                case 4:
                    $search_data[$time_type . ' >='] = date('Y-m-d', strtotime("-7 days"));
                    break;
                default:
                    break;
            }
        }
        $search_data['report_doc_name'] = $this->session->userdata('usr_id');
        $result_data = $this->report_model->search_report($search_data);
        $i = 1;
        $data['data'] = [];
        if ($result_data) {
            foreach ($result_data as $value) {
                if (!$value->del_status) {
                    if ($value->checkup_status == 0 || $value->checkup_status == 1 || $value->checkup_status == 3) {
                        continue;
                    }
                    if ($value->patient_gender == '1') {
                        $gender = '<button type="button" class="btn btn-circle btn-icon-only  blue-madison "><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                    } else {
                        $gender = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                    }

                    if ($value->remote_status == '1') {
                        $remote_status = '<button type="button" class="btn btn-sm btn-circle red">是</button>';
                    } else {
                        $remote_status = '<button type="button" class="btn btn-sm btn-circle  blue-madison ">否</button>';
                    }

                    if ($value->patient_source == '0') {
                        $patient_source = '<span type="button" class="btn btn red">门诊</span>';
                    } elseif ($value->patient_source == '1') {
                        $patient_source = '<button type="button" class="btn btn blue">住院</button>';
                    } else {
                        $patient_source = '<button type="button" class="btn btn dark">体检</button>';
                    }
                    $checkup_status = '';
                    $action = '';
                    $report_action = '';
                    $edit_action = '';
                    $upload_action = '';
                    $share_action = '';
                    $detail_view_action = '';
                    if ($this->check_role('DiagnoseReport')) {
                        $report_action = '<button onclick="make_report(' . $value->chc_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-desktop"></i></button>';
                    }
                    if ($this->check_role('MakeReport')) {
                        $report_action = '<button onclick="make_report(' . $value->chc_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-desktop"></i></button>';
                        $edit_action = '<button onclick="edit_report(' . $value->chc_id . ')" class="btn btn-circle btn-icon-only  blue-madison "> <i class="fa fa-edit"></i></button>';
                    }
                    if ($this->check_role('upload_dicom')) {
                        $upload_action = '<button onclick="uploadDicom(' . $value->chc_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-cloud-upload"></i> </button>';
                    }
                    if ($this->check_role('share_dicom')) {
                        $share_action = '<button onclick="uploadDicom(' . $value->chc_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-share-alt"></i></button>';
                    }
                    if ($this->check_role('detail_report_view')) {
                        $detail_view_action = '<a class="btn btn-circle btn-icon-only red" onclick="reporting_detail_view(' . $value->chc_id . ')"><i class="fa fa-file-text"></i></a>';
                    }
                    if ($value->checkup_status == 0) {
                        $checkup_status = '<span  class="col-md-12 badge badge-warning"> 已登记 </span>';
                    } elseif ($value->checkup_status == '1') {
                        $checkup_status = '<span  class="col-md-12 badge badge-warning"> 检查中 </span>';
                    } elseif ($value->checkup_status == '2') {
                        $checkup_status = '<span class="col-md-12 badge badge-primary ">待诊断</span>';
                        $action = $report_action;
                    } elseif ($value->checkup_status == '3') {
                        $checkup_status = '<span  class="col-md-12 badge badge-info "> 安排中 </span>';
                    } elseif ($value->checkup_status == '4') {
                        $checkup_status = '<span  class="col-md-12 badge badge-success "> 待审核 </span>';
                        $action = '<button onclick="reportView(' . $value->report_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-eye"></i></button>';
                        $action .= $edit_action;
                    } elseif ($value->checkup_status == '5') {
                        $checkup_status = '<span  class="col-md-12 badge badge-danger "> 报告完成 </span>';
                        $action = '<button onclick="reportView(' . $value->report_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-eye"></i></button>';
                        $action .= $detail_view_action;
                    } elseif ($value->checkup_status == '6') {
                        $checkup_status = '<span  class="col-md-12 badge badge-danger "> 回退审核 </span>';
                        $action = '<button onclick="reportView(' . $value->report_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-eye"></i></button>';
                    } elseif ($value->checkup_status == '7') {
                        $checkup_status = '<span  class="col-md-12 badge badge-danger "> 检查草稿 </span>';
                        $action = '<button onclick="reportView(' . $value->report_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-eye"></i></button>';
                        $action .= $edit_action;
                    }

                    if ($value->diagnosis_source == '1') {
                        $diagnosis_source = '<span type="button" class="btn btn blue-madison">本地</span>';
                    } else {
                        $diagnosis_source = '<button type="button" class="btn btn blue-madison">远程</button>';
                    }

                    $checkup_item_id = '<input type="hidden" class="checkup_id" value="' . $value->chc_id . '">';
                    $checkup_item = $value->checkup_item;
                    $checkup_time = $value->check_time;
                    $data['data'][] = array(
                        $action . $checkup_item_id,
                        $i++,
                        $checkup_status,
                        $value->patient_name,
                        $gender,
                        $value->patient_age,
                        $value->checkup_type,
                        $checkup_item,
                        get_user_name($value->report_doc_name),
                        get_user_name($value->req_doctor_name),
                        $diagnosis_source,
                        $value->hospital_name,
                        $value->report_time,
                        $value->deliberation_time,
                    );
                }
            }
        } else {
            $data['data'] = [];
        }
        echo json_encode($data);
    }

    public function ajax_report_detail_view($chc_id = null)
    {
        $data['report_table'] = $this->report_model->report_data_for_reporting($chc_id);
        $this->load->view('report/ajax_report_detail_view', $data);
    }
    public function ajax_report_upload_dicom($chc_id = null)
    {
        $data['report_table'] = $this->report_model->report_data_for_reporting($chc_id);
        $this->load->view('report/ajax_report_upload_form', $data);
    }
    public function ajax_dicom_share_view($chc_id = null)
    {
        $data['report_table'] = $this->report_model->report_data_for_reporting($chc_id);
        $this->load->view('report/ajax_dicom_share_view', $data);
    }

    public function ajax_review($report_id = null)
    {
        $data['report_data'] = $this->report_model->get_reportdata_by_id($report_id);
        $this->load->view('report/ajax_review.php', $data);
    }

    public function review_proc($isreject = null)
    {
        $save_data = array(
            'deli_rpt_id' => $this->input->post('report_id'),
            'deliberation_content' => $this->input->post('content'),
            'deliberation_time' => date('Y-m-d h:i:s'),
            'doctor_name' => $this->session->userdata('usr_id'),
        );
        $deli_id = $this->input->post('deliberation_id');
        if ($deli_id) {
        } else {
            $postdata = $this->input->post();
            $this->form_validation->set_data($postdata);
            $this->form_validation->set_rules('report_id', 'report_id', 'required|is_unique[tbl_deliberation.deli_rpt_id]');
            if ($this->form_validation->run() == false) {
                return $this->output->set_content_type('application/json')
                    ->set_output(json_encode([
                        'message' => '每个检查只有一个报告!',
                        'data' => $this->form_validation->error_array(),
                        'response_code' => 0]));
            }
        }
        $this->report_model->_table_name = "tbl_deliberation";
        $this->report_model->_primary_key = "deliberation_id";
        $this->report_model->save($save_data);
        $where = ['chc_id' => $this->input->post('chc_id')];
        if ($isreject) {
            $this->report_model->set_action($where, ['checkup_status' => 6], 'tbl_check_list');
        } else {
            $this->report_model->set_action($where, ['checkup_status' => 5], 'tbl_check_list');
        }
        return $this->output->set_content_type('application/json')
            ->set_output(json_encode([
                'message' => '提交成功!',
                'data' => [],
                'response_code' => 1]));
    }

    public function search_review_report()
    {
        $search_data = [];
        if ($this->input->get('image_num') != "") {
            $search_data['image_num'] = $this->input->get('image_num');
        }
        if ($this->input->get('patient_name') != "") {
            $search_data['patient_name'] = $this->input->get('patient_name');
        }

        if ($this->input->get('diagnosis_source') != "") {
            $search_data['diagnosis_source'] = $this->input->get('diagnosis_source');
        }

        if ($this->input->get('patient_age') != "") {
            $search_data['patient_age'] = $this->input->get('patient_age');
        }
        if ($this->input->get('patient_gender') != "") {
            $search_data['patient_gender'] = $this->input->get('patient_gender');
        }
        if ($this->input->get('booking_status') != "") {
            $search_data['booking_status'] = $this->input->get('booking_status');
        }
        if ($this->input->get('remote_status') != "") {
            $search_data['remote_status'] = $this->input->get('remote_status');
        }

        if ($this->input->get('patient_source') != "") {
            $search_data['patient_source'] = $this->input->get('patient_source');
        }

        if ($this->input->get('checkup_type') != "") {
            $search_data['checkup_type'] = $this->input->get('checkup_type');
        }

        if ($this->input->get('checkup_status') != "") {
            $search_data['checkup_status'] = $this->input->get('checkup_status');
        }

        if ($this->session->userdata('usr_role') == 1) {
            $search_data['hospital_class'] = $this->session->userdata('hospital_name');
        } elseif ($this->session->userdata('usr_role') == 1024) {
        } else {
            $search_data['tbl_patient_booking.hospital_name'] = $this->session->userdata('hospital_name');
        }
        $time_type = '';
        switch ($this->input->get('time_type')) {
            case 1:
                $time_type = 'booking_time';
                break;
            case 2:
                $time_type = 'checkuped_time';
                break;
            case 3:
                $time_type = 'checkup_time';
                break;
            default:
                break;
        }
        if (($this->input->get('start_time') != "")) {
            $search_data[$time_type . ' >='] = date("Y-m-d", strtotime($this->input->get('start_time')));
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $search_data[$time_type . ' <='] = date("Y-m-d", strtotime($this->input->get('end_time')));
        }

        if ($this->input->get('searchdate')) {
            switch ($this->input->get('searchdate')) {
                case 1:
                    $search_data[$time_type . ' >='] = date("Y-m-d");
                    break;
                case 2:
                    $search_data[$time_type . ' >='] = date('Y-m-d', strtotime("-1 days"));
                    break;
                case 3:
                    $search_data[$time_type . ' >='] = date('Y-m-d', strtotime("-3 days"));
                    break;
                case 4:
                    $search_data[$time_type . ' >='] = date('Y-m-d', strtotime("-7 days"));
                    break;
                default:
                    break;
            }
        }
        // var_dump($search_data);
        // $search_data['report_doc_name !='] = $this->session->userdata('usr_id');
        $result_data = $this->report_model->search_report($search_data);
        $i = 1;
        $data['data'] = [];
        if ($result_data) {
            foreach ($result_data as $value) {
                if (!$value->del_status) {
                    if ($value->checkup_status == 0 || $value->checkup_status == 1 || $value->checkup_status == 3 || $value->checkup_status == 2 || $value->checkup_status == 7) {
                        continue;
                    }
                    if ($value->patient_gender == '1') {
                        $gender = '<button type="button" class="btn btn-circle btn-icon-only red"><span aria-hidden="true" class="icon-symbol-female"></span></button>';
                    } else {
                        $gender = '<button type="button" class="btn btn-circle btn-icon-only blue"><span aria-hidden="true" class="icon-symbol-male"></span></button>';
                    }

                    if ($value->remote_status == '1') {
                        $remote_status = '<button type="button" class="btn btn-sm btn-circle red">是</button>';
                    } else {
                        $remote_status = '<button type="button" class="btn btn-sm btn-circle blue">否</button>';
                    }

                    if ($value->patient_source == '0') {
                        $patient_source = '<span type="button" class="btn btn red">门诊</span>';
                    } elseif ($value->patient_source == '1') {
                        $patient_source = '<button type="button" class="btn btn blue">住院</button>';
                    } else {
                        $patient_source = '<button type="button" class="btn btn dark">体检</button>';
                    }
                    $checkup_status = '';
                    $action = '';
                    $report_action = '';
                    $edit_action = '';
                    $upload_action = '';
                    $share_action = '';
                    $detail_view_action = '';
                    if ($this->check_role('DiagnoseReport')) {
                        $report_action = '<button onclick="make_report(' . $value->chc_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-desktop"></i></button>';
                    }
                    if ($this->check_role('MakeReport')) {
                        $report_action = '<button onclick="make_report(' . $value->chc_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-desktop"></i></button>';
                        $edit_action = '<button onclick="edit_report(' . $value->chc_id . ')" class="btn btn-circle btn-icon-only blue"> <i class="fa fa-edit"></i></button>';
                    }
                    if ($this->check_role('upload_dicom')) {
                        $upload_action = '<button onclick="uploadDicom(' . $value->chc_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-cloud-upload"></i> </button>';
                    }
                    if ($this->check_role('share_dicom')) {
                        $share_action = '<button onclick="uploadDicom(' . $value->chc_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-share-alt"></i></button>';
                    }
                    if ($this->check_role('detail_report_view')) {
                        $detail_view_action = '<a class="btn btn-circle btn-icon-only blue-madison" onclick="reporting_detail_view(' . $value->chc_id . ')"><i class="fa fa-file-text"></i></a>';
                    }
                    if ($value->checkup_status == 0) {
                        $checkup_status = '<span  class="col-md-12 badge badge-warning"> 已登记 </span>';
                    } elseif ($value->checkup_status == '1') {
                        $checkup_status = '<span  class="col-md-12 badge badge-warning"> 检查中 </span>';
                    } elseif ($value->checkup_status == '2') {
                        $checkup_status = '<span class="col-md-12 badge badge-primary ">待诊断</span>';
                        $action = $report_action;
                    } elseif ($value->checkup_status == '3') {
                        $checkup_status = '<span  class="col-md-12 badge badge-info "> 安排中 </span>';
                    } elseif ($value->checkup_status == '4') {
                        $checkup_status = '<span  class="col-md-12 badge badge-success "> 待审核 </span>';
                        $action = '<button onclick="reportView(' . $value->report_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-eye"></i></button>';
                    } elseif ($value->checkup_status == '5') {
                        $checkup_status = '<span  class="col-md-12 badge badge-danger "> 报告完成 </span>';
                        $action = '<button onclick="reportView(' . $value->report_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-eye"></i></button>';
                    } elseif ($value->checkup_status == '6') {
                        $checkup_status = '<span  class="col-md-12 badge badge-danger "> 回退审核 </span>';
                        $action = '<button onclick="reportView(' . $value->report_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-eye"></i></button>';
                    } elseif ($value->checkup_status == '7') {
                        $checkup_status = '<span  class="col-md-12 badge badge-danger "> 检查草稿 </span>';
                        $action = '<button onclick="reportView(' . $value->report_id . ')" class="btn btn-circle btn-icon-only  blue-madison "><i class="fa fa-eye"></i></button>';
                        $action .= $edit_action;
                    }
                    $checkup_item_id = '<input type="hidden" class="checkup_id" value="' . $value->chc_id . '">';
                    $checkup_item = $value->checkup_item;
                    $checkup_time = $value->check_time;

                    if ($value->diagnosis_source == '1') {
                        $diagnosis_source = '<span type="button" class="btn btn blue-madison">本地</span>';
                    } else {
                        $diagnosis_source = '<button type="button" class="btn btn blue-madison">远程</button>';
                    }

                    $data['data'][] = array(
                        $action . $checkup_item_id,
                        $i++,
                        $checkup_status,
                        $value->patient_name,
                        $gender,
                        $value->patient_age,
                        $value->checkup_type,
                        $checkup_item,
                        get_user_name($value->report_doc_name),
                        get_user_name($value->req_doctor_name),
                        $diagnosis_source,
                        $value->hospital_name,
                        $value->report_time,
                        $value->deliberation_time,
                    );
                }
            }
        } else {
            $data['data'] = [];
        }
        echo json_encode($data);
    }

    public function isreview($report_id = null)
    {
        if ($report_id) {
            if ($this->check_role('Audit')) {
                $this->report_model->_table_name = "tbl_report"; //table name
                $this->report_model->_order_by = "report_id";
                $report = $this->report_model->get_by(array('report_id' => $report_id), true);
                if ($report->report_doc_name == $this->session->userdata('usr_id')) {
                    return true;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
