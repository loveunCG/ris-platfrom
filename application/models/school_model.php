<?php
class School_model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_study_info()
    {
        $this->db->select('tbl_lession_info.*', false);
        $this->db->select('tbl_doctor.*', false);
        $this->db->from('tbl_lession_info');
        $this->db->join('tbl_doctor', 'tbl_doctor.id = tbl_lession_info.lession_doctor', 'left');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_my_post_info()
    {
        $doc_id = $this->session->userdata('id');
        $this->db->select('tbl_blog.*', false);
        $this->db->from('tbl_blog');
        $this->db->where('post_doc_id', $doc_id);

        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function search_lession($sdata = null)
    {
        $this->db->select('tbl_doctor.*', false);
        $this->db->select('tbl_lession_info.*', false);
        $this->db->from('tbl_lession_info');
        $this->db->join('tbl_doctor', 'tbl_doctor.id = tbl_lession_info.lession_doctor', 'left');
        if ($sdata) {
            $this->db->where($sdata);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_lesson_post_info($lession_id = null)
    {
        $this->db->select('*', false);
        $this->db->from('tbl_blog');
        $this->db->where('lession_id', $lession_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_movie_info($id)
    {
        $this->db->select('tbl_lession_info.*', false);
        $this->db->from('tbl_lession_info');
        $this->db->where('lession_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_post_info($id)
    {
        $this->db->select('tbl_blog.*', false);
        $this->db->select('tbl_doctor.*', false);
        $this->db->from('tbl_blog');
        $this->db->join('tbl_doctor', 'tbl_doctor.id = tbl_blog.post_doc_id', 'left');
        $this->db->where('lession_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_school_info($data = null)
    {
        $this->db->select('tbl_lession_info.*', false);
        $this->db->select('tbl_doctor.*', false);
        $this->db->from('tbl_lession_info');
        $this->db->join('tbl_doctor', 'tbl_doctor.id = tbl_lession_info.lession_doctor', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getPostData($data = null)
    {
        $this->db->select('tbl_post.*', false);
        $this->db->select('tbl_doctor.*', false);
        $this->db->from('tbl_post');
        $this->db->join('tbl_doctor', 'tbl_doctor.id = tbl_post.pst_doctor', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function GetPostCommentData($data = null)
    {
        $this->db->select('tbl_comment.*', false);
        $this->db->select('tbl_post.*', false);
        $this->db->select('tbl_doctor.*', false);
        $this->db->from('tbl_comment');
        $this->db->join('tbl_post', 'tbl_comment.cmt_pst_id = tbl_post.post_id', 'left');
        $this->db->join('tbl_doctor', 'tbl_doctor.id = tbl_comment.cmt_doctor', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getOnlyPostData($data = null)
    {
        $this->db->select('tbl_post.*', false);
        $this->db->from('tbl_post');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function getonlyComment($data = null)
    {
        $this->db->select('tbl_comment.*', false);
        $this->db->from('tbl_comment');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
}
