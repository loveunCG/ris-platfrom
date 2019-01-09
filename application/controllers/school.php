<?php
defined('BASEPATH') or exit('No direct script access allowed');

class School extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('school_model');
		$this->load->model('admin_model');
		$this->load->model('report_model');
	}

	public function index() {
		$data['device_class'] = $this->report_model->get_device_class();
		$data['module_class'] = $this->report_model->get_module_class();
		$data['menutitle'] = $this->lang->line('school');
		$data['study_info'] = $this->school_model->get_study_info();
		$data['is_my_school'] = true;
		$data['subview'] = $this->load->view('school/index', $data, true);
		$this->load->view('layout', $data);
	}

	public function my_school() {
		$data['device_class'] = $this->report_model->get_device_class();
		$data['module_class'] = $this->report_model->get_module_class();
		$data['menutitle'] = $this->lang->line('school');
		$data['study_info'] = $this->school_model->get_study_info();
		$data['subview'] = $this->load->view('school/index', $data, true);
		$this->load->view('layout', $data);
	}

	public function ajax_school_manage() {
		$this->load->view('school/ajax_school_manage', null);
	}
	public function ajax_create_school($lession_id = null) {
		$data = [];
		if ($lession_id) {
			$this->school_model->_table_name = "tbl_lession_info"; //table name
			$this->school_model->_order_by = "lession_id";
			$data['lession'] = $this->school_model->get_by(array('lession_id' => $lession_id), true);
		}
		$this->load->view('school/ajax_create_school', $data);
	}

	public function ajax_own_school_manage() {
		$this->load->view('school/ajax_own_school_manage', null);
	}

	public function selectView() {
		$data = null;
		if ($this->input->get('lession_class')) {
			$data['lession_class'] = $this->input->get('lession_class');
		}
		if ($this->input->get('lession_title')) {
			$data['lession_title'] = $this->input->get('lession_title');
		}
		if ($this->input->get('lession_type')) {
			$data['lession_type'] = $this->input->get('lession_type');
		}
		if ($this->input->get('lession_doctor')) {
			$data['lession_doctor'] = $this->input->get('lession_doctor');
		}
		$data['study_info'] = $this->school_model->search_lession($data);
		$data['menutitle'] = $this->lang->line('school');
		$this->load->view('school/selectView', $data);
	}

	public function elfinder_init() {
		$this->load->helper('general_helper');
		$opts = initialize_elfinder();
		$this->load->library('elfinder_lib', $opts);
	}

	public function schoolMg() {
		$data['menutitle'] = $this->lang->line('school');
		$data['user_info'] = $this->admin_model->get_userinfo();
		$data['subview'] = $this->load->view('school/schoolMg', $data, true);
		$this->load->view('layout', $data);
	}

	public function DataShareMg() {
		$data['menutitle'] = $this->lang->line('school');
		$data['subview'] = $this->load->view('school/DataShareMg', $data, true);
		$this->load->view('layout', $data);
	}

	public function my_post_view() {
		$data['menutitle'] = $this->lang->line('school');
		$sdata['tbl_post.pst_doctor'] = $this->session->userdata('id');
		$data['my_post_Info'] = $this->school_model->getPostData($sdata);
		$data['all_post_Info'] = $this->school_model->getPostData();
		$data['my_comment_Info'] = $this->school_model->GetPostCommentData($sdata);
		$data['subview'] = $this->load->view('school/post_view', $data, true);
		$this->load->view('layout', $data);
	}

	public function lesson_post_view($lesson_id = null) {
		$data['menutitle'] = $this->lang->line('school');
		$sdata['tbl_post.pst_doctor'] = $this->session->userdata('id');
		$data['my_post_Info'] = $this->school_model->getPostData($sdata);
		$data['all_post_Info'] = $this->school_model->getPostData();
		$data['my_comment_Info'] = $this->school_model->GetPostCommentData($sdata);
		$data['subview'] = $this->load->view('school/lesson_post_view', $data, true);
		$this->load->view('layout', $data);
	}

	public function time_elapsed_B($secs) {
		$bit = array(
			' 年' => $secs / 31556926 % 12,
			' 周' => $secs / 604800 % 52,
			' 日' => $secs / 86400 % 7,
			' 点' => $secs / 3600 % 24,
			' 分' => $secs / 60 % 60,
			' 秒' => $secs % 60,
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

	public function getSchoolInfo($lession_id = null) {
		$this->report_model->_table_name = "tbl_lession_info"; //table name
		$this->report_model->_order_by = "lession_id";
		$lession_info = $this->report_model->get_by(array('lession_id' => $lession_id), false);
		echo json_encode($lession_info[0]);
	}

	public function get_PostList($sdata = null) {
		$post = $this->school_model->getPostData();
		$i = 1;
		$tmp_usr_id = '';
		if (count($post) != 0) {
			foreach ($post as $value) {
				if ($tmp_usr_id == $value->id) {
					$i = rand(1, 10);
				}
				$commentfunc = $value->pst_doctor == $this->session->userdata('id') ? 'disabled' : 'onclick ="commentProc(' . $value->post_id . ')"';
				$tmp_usr_id = $value->id;
				$img_src = $value->pst_doctor == $this->session->userdata('id') ? 'assets/layouts/layout2/img/avatar3.jpg' : 'assets/pages/media/users/avatar' . $i . '.jpg';
				$usr_field = '<img class = "user-pic" src="' . base_url() . $img_src . '">' . $value->usr_name . '</td>';
				$checkdata = array('cmt_pst_id' => $value->post_id);
				$agodate = $this->time_elapsed_B(time() - strtotime($value->pst_time));
				if (count($rescomment = $this->school_model->getonlyComment($checkdata))) {
					$count = count($rescomment);
				} else {
					$count = 0;
				}
				$postcount = '<button ' . $commentfunc . ' class="btn btn-circle btn-icon-only blue"><i class="fa fa-commenting"></i></button><span class="badge badge-success"> ' . $count . '</span>';
				$data['data'][] = array(
					$postcount,
					$usr_field,
					$value->pst_title,
					$agodate,
					$count,
					" ",
				);
			}
		} else {
			$data['data'][0] = array(' ',
				" ",
				" ",
				" ",
				" ",
				1,
				1,

			);
		}
		echo json_encode($data);
	}

	public function movie($id = null) {
		$data['menutitle'] = $this->lang->line('school');
		$data['movie_info'] = $this->school_model->get_movie_info($id);
		if ($data['movie_info']->lession_doctor == $this->session->userdata('id')) {
			$update = ['lession_status' => 1];
			$where = array('lession_id' => $id);
			$res = $this->school_model->set_action($where, $update, 'tbl_lession_info');
		}
		$data['post_info'] = $this->school_model->get_post_info($id);
		$data['subview'] = $this->load->view('school/movie', $data, true);
		$this->load->view('layout', $data);
	}

	public function discussion() {
		$data['menutitle'] = $this->lang->line('school');
		$data['subview'] = $this->load->view('school/discussion', $data, true);
		$this->load->view('layout', $data);
	}

	public function get_school_info($lession_id = null) {
		$data = $this->school_model->get_school_info(array('lession_id' => $lession_id))[0];
		echo json_encode($data);
	}

	public function save_lession() {
		$data = $this->school_model->array_from_post(array(
			'lession_class',
			'lession_title',
			'lession_content',
			'lession_doctor_name',
			'start_time',
			'lession_password',
		));
		$config = array(
			array(
				'field' => 'lession_class',
				'label' => 'lession_class',
				'rules' => 'required',
			),
			array(
				'field' => 'lession_title',
				'label' => 'lession_title',
				'rules' => 'required',
			),
			array(
				'field' => 'lession_content',
				'label' => 'lession_content',
				'rules' => 'required',
			),
			array(
				'field' => 'lession_doctor_name',
				'label' => 'lession_doctor_name',
				'rules' => 'required',
			),
			array(
				'field' => 'start_time',
				'label' => 'start_time',
				'rules' => 'required',
			),
			array(
				'field' => 'lession_password',
				'label' => 'lession_password',
				'rules' => 'required',
			),
		);
		$this->form_validation->set_data($this->input->post());
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == false) {
			return $this->output->set_content_type('application/json')
				->set_output(json_encode(['message' => '提交错误!', 'data' => $this->form_validation->error_array(), 'response_code' => 0]));
		}
		$data['add_time'] = date("Y-m-d H:i:s");
		$data['lession_status'] = 0;
		$data['lession_doctor'] = $this->session->userdata('id');
		if ($this->input->post('lession_id')) {
			$update = $data;
			$where = array('lession_id' => $this->input->post('lession_id'));
			$res = $this->school_model->set_action($where, $update, 'tbl_lession_info');
		} else {
			$this->school_model->_table_name = "tbl_lession_info"; //table name
			$this->school_model->_primary_key = "lession_id";
			$this->school_model->save($data);
		}
		return $this->output->set_content_type('application/json')
			->set_output(json_encode([
				'message' => '添加成功!',
				'data' => [],
				'response_code' => 1,
			]));
	}

	public function send_message() {
		$data = $this->school_model->array_from_post(array('lession_id', 'post_content'));
		$data['post_time'] = date("Y-m-d H:i:s");
		$data['post_doc_id'] = $this->session->userdata('id');
		$this->school_model->_table_name = "tbl_blog"; //table name
		$this->school_model->_primary_key = "post_id";
		$this->school_model->save($data);
		echo "success";
	}

	public function update_lession() {
		$update_data = $this->school_model->array_from_post(array(
			'lession_class',
			'lession_title',
			'lession_doctor',
			'lession_type',
			'start_time',
			'lession_during',
		));
		$where = array('lession_id' => $this->input->post('lession_id'));
		$res = $this->school_model->set_action($where, $update_data, 'tbl_lession_info');
		if ($res) {
			echo json_encode(array('status' => 'succes'));
		} else {
			echo json_encode(array('status' => 'error'));
		}
	}

	public function delete_lession($lession_id = null) {
		$this->school_model->_table_name = "tbl_lession_info"; // table name
		$this->school_model->_primary_key = "lession_id";
		$res = $this->school_model->delete($lession_id);
		if ($res) {
			echo json_encode("success");
		} else {
			echo json_encode("erro");
		}
	}

	public function search_lession() {
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
			$data['add_time >='] = date_format(date_create($this->input->get('start_time')), 'Y-m-d');
		}
		if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
			$data['add_time <='] = date_format(date_create($this->input->get('end_time')), 'Y-m-d');
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
					$this->admin_model->get_userinfo(array('id' => $var_report->lession_doctor))[0]->usr_name,
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

	public function addPost() {
		$addData = $this->school_model->array_from_post(array('pst_title',
			'pst_name',
			'pst_doctor',
			'pst_content',
		));
		$addData['pst_time'] = date('Y-m-d h:i:s');
		$this->school_model->_table_name = "tbl_post"; //table name
		$this->school_model->_primary_key = "post_id";
		if ($this->school_model->save($addData)) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'error'));
		}
	}

	public function submitComment() {
		$addData = $this->school_model->array_from_post(array('cmt_pst_id',
			'cmt_content',
			'cmt_doctor',
		));
		$addData['cmt_time'] = date('Y-m-d h:i:s');
		$this->school_model->_table_name = "tbl_comment"; //table name
		$this->school_model->_primary_key = "comment_id";
		if ($this->school_model->save($addData)) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'error'));
		}
	}

	public function deletePost($id = null) {
		$this->school_model->_table_name = "tbl_post"; // table name
		$this->school_model->_primary_key = "post_id";
		$res = $this->school_model->delete($id);
		echo json_encode(array('status' => 'success'));
	}

	public function commentView($post_id = null) {
		if ($post_id) {
			$sdata['tbl_comment.cmt_pst_id'] = $post_id;
		}
		$data['post_id'] = $post_id;
		$data['commentInfo'] = $this->school_model->GetPostCommentData($sdata);
		$this->load->view('school/commentView', $data);
	}

	public function check_lession_passwd() {
		try {
			$this->school_model->_table_name = "tbl_lession_info"; //table name
			$this->school_model->_order_by = "lession_id";
			$lession_info = $this->school_model->get_by(array(
				'lession_id' => $this->input->post('lession_id'),
				'lession_password' => $this->input->post('lession_password')), false);
			if (count($lession_info) > 0) {
				return $this->output->set_content_type('application/json')
					->set_output(json_encode([
						'message' => '添加成功!',
						'data' => [],
						'response_code' => 1,
					]));
			} else {
				return $this->output->set_content_type('application/json')
					->set_output(json_encode([
						'message' => '密码错误!',
						'data' => [],
						'response_code' => 0,
					]));
			}
		} catch (Exception $e) {
			echo $e;
		}
	}

	public function search_lession_table($ismy = null) {
		$data = [];
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
			$data['add_time >='] = date_format(date_create($this->input->get('start_time')), 'Y-m-d');
		}
		if (($this->input->get('end_time') != "") || ($this->input->get('end_time'))) {
			$data['add_time <='] = date_format(date_create($this->input->get('end_time')), 'Y-m-d');
		}
		$time_type = 'start_time';
		if ($this->input->get('datestep')) {
			switch ($this->input->get('datestep')) {
			case 1:
				$data[$time_type . ' >='] = date("Y-m-d");
				break;
			case 2:
				$data[$time_type . ' >='] = date('y-m-d', strtotime("-1 days"));
				break;
			case 3:
				$data[$time_type . ' >='] = date('y-m-d', strtotime("-3 days"));
				break;
			case 4:
				$data[$time_type . ' >='] = date('y-m-d', strtotime("-7 days"));
				break;
			default:
				break;
			}
		}

		if ($this->input->get('status') != '') {
			switch ($this->input->get('status')) {
			case 0:
				$data['lession_status'] = 0;
				break;
			case 1:
				$data['lession_status'] = 1;
				break;
			case 2:
				$data['lession_status'] = 2;
				break;
			case 3:
				break;
			default:
				break;
			}
		}

		$result_data = $this->school_model->search_lession($data);
		$i = 1;
		$j = 1;
		$mydata['data'] = [];
		$data = [];
		$data['data'] = [];
		foreach ($result_data as $var_report) {
			$action = '';
			$staus = '';
			if ($var_report->lession_doctor == $this->session->userdata('id')) {
				if ($var_report->lession_status == 1) {
					$action = '<button type="button" class="btn btn-info" onclick="end_lession(' . $var_report->lession_id . ')">结束教学</button>';
					$action .= '<button type="button" class="btn btn-success" onclick="goto_movie(' . $var_report->lession_id . ')">继续教学</button>';
					$status = '<span  class="col-md-12 badge badge-default "> 已开始 </span>';
				} elseif ($var_report->lession_status == 2) {
					$action = '<button type="button" class="btn btn dark" >结束教学</button>';
					$status = '<span  class="col-md-12 badge badge-danger "> 已结束 </span>';
				} else {
					$action = '<button type="button" class="btn blue" onclick="createSchoolModal(' . $var_report->lession_id . ')">编辑教学</button>';
					$action .= '<button type="button" onclick="goto_movie(' . $var_report->lession_id . ')" class="btn green">开始教学</button>';
					$status = '<span  class="col-md-12 badge badge-info "> 未开始 </span>';
				}
				$mydata['data'][] = array(
					$j++,
					$var_report->lession_title,
					$var_report->lession_content,
					$var_report->lession_doctor_name,
					$var_report->start_time,
					$var_report->end_time,
					$status,
					$action,
				);
			} else {
				if ($var_report->lession_status == 1) {
					$status = '<span  class="col-md-12 badge badge-default "> 已开始 </span>';
					if ($var_report->lession_class == 1) {
						$action = '<button type="button" class="btn btn btn-info" onclick="goto_movie(' . $var_report->lession_id . ')">观看教学</button>';
					} else {
						$action = '<button type="button" class="btn btn btn-info" onclick="goto_movie_secret(' . $var_report->lession_id . ')">观看教学</button>';
					}
				} elseif ($var_report->lession_status == 2) {
					$action = '<button type="button" class="btn btn dark">教学结束</button>';
					$status = '<span  class="col-md-12 badge badge-danger "> 已结束 </span>';
				} else {
					if ($var_report->lession_class == 1) {
						$action = '<button type="button" class="btn btn btn-info" onclick="goto_movie(' . $var_report->lession_id . ')">观看教学</button>';
					} else {
						$action = '<button type="button" class="btn btn btn-info" onclick="goto_movie_secret(' . $var_report->lession_id . ')">观看教学</button>';
					}
					$status = '<span  class="col-md-12 badge badge-info "> 未开始 </span>';
				}
				$data['data'][] = array(
					$i++,
					$var_report->lession_title,
					$var_report->lession_content,
					$var_report->lession_doctor_name,
					$var_report->start_time,
					$var_report->end_time,
					$status,
					$action,
				);
			}
		}
		if ($ismy) {
			echo json_encode($mydata);
			return;
		} else {
			echo json_encode($data);
			return;
		}
	}

	public function end_lession($lession_id) {
		$update = ['lession_status' => 2];
		$where = array('lession_id' => $lession_id);
		$this->school_model->set_action($where, $update, 'tbl_lession_info');
		return $this->output->set_content_type('application/json')
			->set_output(json_encode([
				'message' => '教学已结束!',
				'data' => [],
				'response_code' => 1,
			]));
	}
}
