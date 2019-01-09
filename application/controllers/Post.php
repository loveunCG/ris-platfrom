<?php
defined('BASEPATH') or exit('No direct script access allowed');
define("LIMITVAL", 5);

class Post extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('post_model');
	}

	public function index() {
		$data['menutitle'] = $this->lang->line('school');
		$data['subview'] = $this->load->view('post/index', $data, true);
		$this->load->view('layout', $data);
	}
	public function post_list($startid = '', $userid = '') {
		$add = intval($startid) / LIMITVAL + 1;
		if (!empty($userid)) {
			$val = $this->post_model->get_post_total($userid);
			$data['post_Info'] = $this->post_model->get_post_data(LIMITVAL, $startid, $userid);
			$data['post_Count'] = $val[0]->num;
			$data['post_allpage'] = ceil((float) $data['post_Count'] / LIMITVAL);
		} else {
			$val = $this->post_model->get_post_total();
			$data['post_Info'] = $this->post_model->get_post_data(LIMITVAL, $startid);
			$data['post_Count'] = $val[0]->num;
			$data['post_allpage'] = ceil((float) $data['post_Count'] / LIMITVAL);

		}
		$data['post_page'] = $add;
		$this->load->view('post/ajax_post_list', $data);
	}

	public function post_comment_list($startid = '', $pst_id = '') {
		$condition = 'cmt_pst_id=' . +$pst_id;
		$data['post_Info'] = $this->post_model->get_post_row($pst_id);
		$data['post_list_count'] = $this->post_model->get_comment_total($condition);
		$data['comment_Info'] = $this->post_model->get_comment_List($startid, $condition);
		$data['post_page'] = intval($startid) / 5 + 1;
		$data['post_allpage'] = ceil((float) $data['post_list_count'] / LIMITVAL);
		$this->load->view('post/ajax_comment_list', $data);
	}

	public function my_comment_list($startid = '', $doctorid = '') {
		$condition = 'cmt_doctor=' . +$doctorid;
		$data['post_Info'] = 0;
		$data['post_list_count'] = $this->post_model->get_comment_total($condition);
		$data['comment_Info'] = $this->post_model->get_comment_List($startid, $condition);
		$data['post_page'] = intval($startid) / LIMITVAL + 1;
		$data['post_allpage'] = ceil((float) $data['post_list_count'] / LIMITVAL);
		$this->load->view('post/ajax_comment_list', $data);
	}

	public function submitComment() {
		$addData = $this->post_model->array_from_post(array('cmt_pst_id',
			'cmt_content',
			'cmt_doctor',
		));
		$addData['cmt_time'] = date('Y-m-d h:i:s');
		$this->post_model->_table_name = "tbl_comment"; //table name
		$this->post_model->_primary_key = "comment_id";
		if ($this->post_model->save($addData)) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'error'));
		}
	}

	public function add_right($id) {
		$addData = $this->post_model->array_from_post(array('pst_right'));
		$this->post_model->_table_name = "tbl_post"; //table name
		$this->post_model->_primary_key = "post_id";
		if ($this->post_model->save($addData, $id)) {
			echo json_encode(array('status' => 'success'));
		} else {
			echo json_encode(array('status' => 'error'));
		}
	}

	public function add_post_content() {
		$pst_name_check = $this->input->post('pst_name_check');
		if ($pst_name_check) {
			$addData = $this->post_model->array_from_post(array(
				'pst_title',
				'pst_doctor',
				'pst_content',
			));
			$addData['pst_name'] = 'doctor';
			$addData['pst_time'] = date('Y-m-d h:i:s');
			$this->post_model->_table_name = "tbl_post"; //table name
			$this->post_model->_primary_key = "post_id";
			if ($this->post_model->save($addData)) {
				echo json_encode(array('status' => 'success'));
			} else {
				echo json_encode(array('status' => 'error'));
			}
		} else {
			$addData = $this->post_model->array_from_post(array(
				'pst_title',
				'pst_doctor',
				'pst_name',
				'pst_content',
			));
			$addData['pst_time'] = date('Y-m-d h:i:s');
			$this->post_model->_table_name = "tbl_post"; //table name
			$this->post_model->_primary_key = "post_id";
			if ($this->post_model->save($addData)) {
				echo json_encode(array('status' => 'success'));
			} else {
				echo json_encode(array('status' => 'error'));
			}
		}

	}

	public function search_list($startid) {
		$searchval = $this->input->get('search_val');
		$add = intval($startid) / LIMITVAL + 1;
		$val = $this->post_model->get_search_total($searchval);
		$data['post_Info'] = $this->post_model->get_search_list(LIMITVAL, $startid, $searchval);
		$data['post_Count'] = $val[0]->num;
		$data['post_allpage'] = ceil((float) $data['post_Count'] / LIMITVAL);
		$data['post_page'] = $add;
		$this->load->view('post/ajax_post_list', $data);
	}

}
