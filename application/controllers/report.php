<?php

class Report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report_model');
        $this->lang->load('cn', 'chinese');
    }

    public function index()
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
        $data['past_report_data'] = $this->report_model->past_get_data($booking_id);
        $data['report_data'] = $this->report_model->get_data($booking_id);
        $data['menutitle'] = $this->lang->line('report');
        $data['device_class'] = $this->report_model->get_device_class();
        $data['subview'] = $this->load->view('report/reporting', $data, true);
        $this->load->view('layout', $data);
    }

    function get_template_info($template_id = null){
      $sdata = array('template_id' => $template_id);
      $res = $this->report_model->get_template_data($sdata);
      foreach ($res as $value) {
        $temp = $value;
        # code...
      }
      echo json_encode($temp);
    }



    public function get_template_data()
    {
        $report_module_id = array('report_module_id' => $this->input->post('report_module_id'));
        $data['tdata'] = $this->report_model->get_template_data($report_module_id);
        echo json_encode($data);
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
        }else{
          echo " ";
        }
    }

    public function select_class()
    {
        $class_id = array('module_class' => $this->input->post('select_class_id'));
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
        $data['module'] = $this->report_model->get_module();
        $data['device_class'] = $this->report_model->get_device_class();
        $data['module_class'] = $this->report_model->get_module_class();
        $data['template'] = $this->report_model->get_template_data();
        $data['past_report_data'] = $this->report_model->past_get_data($booking_id);
        $data['report_data'] = $this->report_model->get_data($booking_id);
        $data['menutitle'] = $this->lang->line('report');
        $sdata['tbl_patient_booking.booking_id'] = $booking_id;
        $data['report_data'] = $this->report_model->get_deliberation_data($sdata);
        $data['subview'] = $this->load->view('report/delberation', $data, true);
        $this->load->view('layout', $data);
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

    function nopass_report($booking_id = null)
    {

        $update_data = array('booking_status' => '5');
        $where = array('booking_id' => $booking_id);
        $res = $this->report_model->set_action($where, $update_data, 'tbl_patient_booking');
        if ($res) {
            redirect('report');
            # code...
        }
    }


    function getModuleLeftView($device_type = null)
    {
      $module_class =  $this->report_model->get_module_class();
      $template = $this->report_model->get_template_data();
      $result_view = '<ul>';
      foreach ($module_class as $class_module){
         $result_view.='<li>'.$class_module->class_name.'<ul>';
         foreach ($template as $template_value){
             if (($template_value->device_type == $device_type)&&($template_value->module_class == $module_id)){
               $result_view.='<li ondblclick="select_template('.$template_value->template_id.')">'.$template_value->template_name.'</li>';
             }
         }
         $result_view.="</ul></li>";
       }
       $result_view.="</ul>";
       echo $result_view;
    }

    public function add_template()
    {
        $data = $this->report_model->array_from_post(array('template_name',
            'checkup_name',
            'report_module_id',
            'image_expression',
            'recommended_report',
            'device_type'
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

    public function dicom_view($booking_id)
    {
        $data['dicom_url'] = $this->report_model->past_get_dicom_url($booking_id);
        $data['menutitle'] = $this->lang->line('report');
        // $this->load->view('dicom/dicom_view', $data);

        $data['subview'] = $this->load->view('dicom/dicom_test', $data, true);
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
        if ($ismyreport == 'my') {
            $search_data['req_doctor_name'] = $this->session->userdata('usr_id');
            $result_data = $this->report_model->search_data($search_data);
        } elseif ($ismyreport == 'deli') {
            $result_data = $this->report_model->get_deliberation_data($search_data);
        } else {
            $result_data = $this->report_model->search_data($search_data);
        }
        $i = 1;
        if ($result_data) {
            foreach ($result_data as $value) {
                if (!$value->del_status&&$value->booking_status!='1') {
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

                    if ($value->booking_status == '1') {
                        $booking_status = '<button type="button" class="btn btn-circle btn-warning "> 已登记 </button>';
                    } elseif ($value->booking_status == '2') {
                        $booking_status = '<button type="button" class="btn btn-circle btn-primary "> 未提交 </button>';
                    } elseif ($value->booking_status == '3') {
                        $booking_status = '<button type="button" class="btn btn-circle btn-info "> 已提交 </button>';
                    } elseif ($value->booking_status == '4') {
                        $booking_status = '<button type="button" class="btn btn-circle btn-success "> 已审核 </button>';
                    } elseif ($value->booking_status == '5') {
                        $booking_status = '<button type="button" class="btn btn-circle btn-danger "> 回退审核 </button>';
                    } elseif ($value->booking_status == '6') {
                        $booking_status = '<button type="button" class="btn btn-circle btn-danger "> 检查中 </button>';
                    }
                    $booking_id = '<input type="hidden" class="device_id" value="' . $value->delivery_name . '">';

                    $this->report_model->_table_name = "tbl_check_list"; //table name
					$this->report_model->_order_by = "chc_id";
					$check_data = $this->report_model->get_by(array('chc_booking_id' => $value->delivery_name), false);
					$checkup_item = '';
					$checkup_time = '';
					foreach($check_data as $check_info){
						$checkup_item.=$check_info->checkup_item.'</br>';
						$checkup_time.=$check_info->checkup_time.'<br>';
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
                        $value->license_num,
                        $checkup_time,
                        $value->req_doctor_name,
                        $booking_status,
                        $value->report_doc_name,
                    );
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
            );
        }
        echo json_encode($data);
    }

    public function save_report()
    {
        $data = $this->report_model->array_from_post(array('booking_id',
            'Imaging_performance',
            'positive_status',
            'urgency_status',
            'image_degree',
            'impression',
            'recommend_report',
            'report_module',
        ));
        $data['report_doc_name'] = $this->session->userdata('usr_name');
        $booking_id = $data['booking_id'];
        if ($this->input->post('report_id')) {
            $report_id = $data['report_id'] = $this->input->post('report_id');
            $data['last_update_time'] = date("Y-m-d H:i:s");
            $where = array('report_id' => $report_id);
            $this->report_model->set_action($where, $data, 'tbl_report');
            echo json_encode(array('status' => 'succes'));
            return true;

        } else {
            $data['report_time'] = date("Y-m-d H:i:s");
            $update_data = array('booking_status' => '3');
            $where = array('booking_id' => $booking_id);
            $this->report_model->set_action($where, $update_data, 'tbl_patient_booking');
            $this->report_model->_table_name = "tbl_report";
            $this->report_model->_primary_key = "report_id";
            if ($this->report_model->save($data, $report_id)) {
                echo json_encode(array('status' => 'succes'));
            } else {
                echo json_encode(array('status' => 'error'));
            }
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
        $data['tbl_patient_booking.report_id'] = (int) $report_id;
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
        $data['report_data'] = $this->report_model->get_deliberation_data($sdata);
        $data['device_class'] = $this->report_model->get_device_class();
        $data['page_title'] = $this->lang->line('report_table');
        $data['subview'] = $this->load->view('report/delberation_table', $data, true);
        $this->load->view('layout', $data);
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

    public function get_post_unread_info(){
        $user_id = $this->session->userdata('id');
        $all_post_to_me = $this->report_model->get_all_post_to_me($user_id); //get all post to me
        echo "ddd";
    }
}
