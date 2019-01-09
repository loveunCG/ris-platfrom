<?php

use SebastianBergmann\Environment\Console;
class Post_model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_post_data($limit, $id, $data=null)
    {
        $this->db->select('tbl_post.*', false);
        $this->db->select('COUNT(tbl_comment.cmt_pst_id) as cmt_num', false);
        $this->db->from('tbl_post');
        $this->db->join('tbl_comment', 'tbl_comment.cmt_pst_id = tbl_post.post_id', 'left');
        $this->db->limit($limit, $id);
        if($data){
            $this->db->where('tbl_post.pst_doctor', $data);
        }
        $this->db->group_by('tbl_post.post_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_post_total($data=null)
    {
        $this->db->select('COUNT(pst_doctor) as num', false);
        $this->db->from('tbl_post');
        if ($data) {
            $this->db->where('tbl_post.pst_doctor', $data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_post_row($data=null)
    {
        $this->db->select('tbl_post.*', false);
        $this->db->from('tbl_post');
        if ($data) {
            $this->db->where('post_id', $data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_comment_total( $data)
    {
        
        $query = $this->db->query("SELECT * FROM tbl_comment where $data");
        return  $query->num_rows();
        
    }

    public function get_comment_List($startid, $data=null)
    {
        $this->db->select('tbl_comment.*', false);
        $this->db->select('tbl_doctor.usr_name', false);
        $this->db->from('tbl_comment');
        $this->db->join('tbl_doctor', 'tbl_comment.cmt_doctor = tbl_doctor.id');
        $this->db->limit(5, $startid);
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_my_comment_List($data=null)
    {
        $this->db->select('tbl_comment.*', false);
        $this->db->select('tbl_doctor.usr_name', false);
        $this->db->from('tbl_comment');
        $this->db->join('tbl_doctor', 'tbl_comment.cmt_doctor = tbl_doctor.id');
        if ($data) {
            $this->db->where('cmt_doctor', $data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_search_list($limit, $id, $data=null)
    {
        $sdata['pst_title'] = $data;
        $this->db->select('tbl_post.*', false);
        $this->db->select('COUNT(tbl_comment.cmt_pst_id) as cmt_num', false);
        $this->db->from('tbl_post');
        $this->db->join('tbl_comment', 'tbl_comment.cmt_pst_id = tbl_post.post_id', 'left');
        $this->db->limit($limit, $id);
        if($data){
            $this->db->like('tbl_post.pst_title', $data);
            $this->db->or_like('tbl_post.pst_content', $data);
            $this->db->or_like('tbl_post.pst_name', $data);
        }
        $this->db->group_by('tbl_post.post_id');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_search_total($data=null)
    {
        $this->db->select('COUNT(pst_doctor) as num', false);
        $this->db->from('tbl_post');
        if($data){
            $this->db->like('tbl_post.pst_title', $data);
            $this->db->or_like('tbl_post.pst_content', $data);
            $this->db->or_like('tbl_post.pst_name', $data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
}
