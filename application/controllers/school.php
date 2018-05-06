<?php
defined('BASEPATH') or exit('No direct script access allowed');

class School extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->lang->load('cn', 'chinese');
        $this->load->model('school_model');
    }

    public function index()
    {
        $data['menutitle'] = $this->lang->line('school');
        // $data['lession_info'] = $this->school_model->search_lession();
        // $data['subview'] = $this->load->view('school/index', $data, true);
        $data['study_info'] = $this->school_model->get_study_info(); //강의목록을 얻기
        $data['subview'] = $this->load->view('school/select', $data, TRUE);
        $this->load->view('layout', $data);
    }

    function elfinder_init(){
		$this->load->helper('general_helper');
		$opts = initialize_elfinder();
	  	$this->load->library('elfinder_lib', $opts);
	}



    public function schoolMg()
    {
        $data['menutitle'] = $this->lang->line('school');
        $data['subview'] = $this->load->view('school/schoolMg', $data, true);
        $this->load->view('layout', $data);
    }

     public function DataShareMg()
    {
        $data['menutitle'] = $this->lang->line('school');
        $data['subview'] = $this->load->view('school/DataShareMg', $data, true);
        $this->load->view('layout', $data);
    }

    public function my_post_view(){
        $data['menutitle'] = $this->lang->line('school');

        $data['my_post_info'] = $this->school_model->get_my_post_info(); 
        $data['subview'] = $this->load->view('school/post_view', $data, TRUE);
        $this->load->view('layout', $data);        
    }

    public function lesson_post_view($lesson_id = null){
        $data['menutitle'] = $this->lang->line('school');

        $data['lesson_post_info'] = $this->school_model->get_lesson_post_info($lesson_id); 
        $data['subview'] = $this->load->view('school/lesson_post_view', $data, TRUE);
        $this->load->view('layout', $data); 
    }

    public function lesson_table_info($sdata = null)
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

        $result_data = $this->school_model->get_lesson_all_info($sdata);
        $post_count = $this->school_model->get_post_count();
        $i = 1;
        if ($result_data) {
            foreach ($result_data as $value) {                
                foreach ($post_count as $pos) {
                    if ($value->lession_id==$pos->lession_id) {                  
                        $checkup_id = '<input type="hidden" class="device_id" value="' . $value->lession_id . '">';
                        $data['data'][] = array(
                            '<img class="user-pic" style="border-radius:50%!important;" src="../assets/pages/media/users/avatar4.jpg">'.$value->usr_name,
                            '<i class="fa fa-comments"></i> <span class="badge badge-info">'.$pos->total.'</span>',                                                        
                            $value->lession_title.$checkup_id,
                            $value->add_time,

                            
                        );
                    }
                }
            }
        } else {
            $data['data'][0] = array(' ',
                " bfb",
                "bf ",
                " ",
                " "

            );
        }

        echo json_encode($data);
    }    

    public function movie($id){
        $data['menutitle'] = $this->lang->line('school');
        $data['movie_info'] = $this->school_model->get_movie_info($id); //강의목록을 얻기
        $data['post_info'] = $this->school_model->get_post_info($id); //포스트목록을 얻기

        $data['subview'] = $this->load->view('school/movie', $data, TRUE);
        $this->load->view('school/layout', $data);     
    }    

    public function discussion(){
        $data['menutitle'] = $this->lang->line('school');
        // $data['discuss_info'] = $this->school_model->get_discuss_info();        
        $data['subview'] = $this->load->view('school/discussion', $data, TRUE);
        $this->load->view('layout', $data);         
    }
    
    public function get_school_info($lession_id = null)
    {
        $this->school_model->_table_name = "tbl_lession_info"; //table name
        $this->school_model->_order_by = "lession_id";
        $data = $this->school_model->get_by(array('lession_id' => $lession_id), true);
        echo json_encode($data);
    }

    public function save_lession()
    {

        $data = $this->school_model->array_from_post(array('lession_class',
            'lession_title',
            'lession_doctor',
            'lession_content'
        ));
        $data['add_time'] = date("Y-m-d H:i:s");
        $data['lession_doc_url'] = $this->input->post('upload_doc_file_path');
        $data['lession_video_url'] = $this->input->post('upload_dicom_file_path');
        $this->school_model->_table_name = "tbl_lession_info"; //table name
        $this->school_model->_primary_key = "lession_id";
        if ($this->school_model->save($data)) {
            echo json_encode(array('status' => 'succes'));
        }
    }

    public function send_message()
    {
        $data = $this->school_model->array_from_post(array('lession_id','post_content'));
        $data['post_time'] = date("Y-m-d H:i:s");
        $data['post_doc_id'] = $this->session->userdata('id');

        $this->school_model->_table_name = "tbl_blog"; //table name
        $this->school_model->_primary_key = "post_id";
        $this->school_model->save($data);

        echo "success";

    }    

    public function update_lession()
    {

        $update_data = $this->school_model->array_from_post(array('lession_class',
            'lession_title',
            'lession_doctor',
            'lession_content'
        ));
        $update_data['lession_doc_url'] = $this->input->post('upload_doc_file_path');
        $update_data['lession_video_url'] = $this->input->post('upload_dicom_file_path');
        $where = array('lession_id' => $this->input->post('lession_id'));
        $res = $this->school_model->set_action($where, $update_data, 'tbl_lession_info');
        if ($res) {
            echo json_encode(array('status' => 'succes'));
        }else{
            echo json_encode(array('status' => 'error'));
        }
    }

    function delete_lession($lession_id = null){
      $this->school_model->_table_name = "tbl_lession_info"; // table name
      $this->school_model->_primary_key = "lession_id";
      $res = $this->school_model->delete($lession_id);
      if ($res) {
          echo json_encode("succes");
      }else{
        echo json_encode("succes");
      }

    }

    public function search_lession()
    {

        if ($this->input->get('lession_class')) {
            $data['lession_class'] = $this->input->get('lession_class');
        }
        if ($this->input->get('lession_title')) {
            $data['lession_title'] = $this->input->get('lession_title');
        }
        if ($this->input->get('location_city')) {
            $data['location_city'] = $this->input->get('location_city');
        }
        if (($this->input->get('start_time') != "") || ($this->input->get('start_time'))) {
            $data['add_time >='] = $this->input->get('start_time');
        }
        if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
            $data['add_time <='] = $this->input->get('end_time');
        }
        $result_data = $this->school_model->search_lession($data);
        $i = 1;
        if ($result_data) {
            foreach ($result_data as $var_report) {
                $lession_id = '<input type="hidden" class="device_id" value="' . $var_report->lession_id . '">';

                $data['data'][] = array(
                    $i++ . $lession_id,
                    $var_report->lession_title,
                    $var_report->lession_class,
                    $var_report->lession_doctor,
                    $var_report->add_time,
                );
            }
        } else {
            $data['data'][0] = array(' ',
                " ",
                " ",
                " ",
                " ",
            );
        }

        echo json_encode($data);
    }
}
