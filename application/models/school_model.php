<?php
class School_model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;

	function __construct()
        {
          parent::__construct(); 
          $this->load->database();
        }

    public function get_study_info(){
        
        $this->db->select('tbl_lession_info.*', FALSE);
        $this->db->select('tbl_doctor.usr_name', FALSE);        
        $this->db->from('tbl_lession_info');
        $this->db->join('tbl_doctor', 'tbl_doctor.id = tbl_lession_info.lession_doctor', 'left');        

        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;    	
    }    

    public function get_my_post_info(){
        $doc_id = $this->session->userdata('id');
        $this->db->select('tbl_blog.*', FALSE);     
        $this->db->from('tbl_blog');       
        $this->db->where('post_doc_id', $doc_id);

        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;         
    }

    public function search_lession($sdata = null)
    {

        $this->db->select('tbl_lession_info.*', false);
        $this->db->from('tbl_lession_info');
        if ($sdata) {
            $this->db->where($sdata);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }   

    public function get_post_count(){

        $sql  = "SELECT lession_id, COUNT(lession_id) as total FROM tbl_blog GROUP BY lession_id;";
        $query_result = $this->db->query($sql);      

        $result = $query_result->result();
        return $result; 
    }    

    public function get_lesson_all_info($data = null) {

        $sql  = "SELECT tbl_lession_info.lession_id,tbl_lession_info.add_time,tbl_lession_info.lession_title, tbl_doctor.usr_name FROM tbl_blog  ";
        $sql .=" left join tbl_lession_info on tbl_blog.lession_id = tbl_lession_info.lession_id";        
        $sql .=" left join tbl_doctor on tbl_doctor.id = tbl_lession_info.lession_doctor";

        $sql .=" GROUP BY tbl_blog.lession_id;";
        $query_result = $this->db->query($sql); 



        $result = $query_result->result();
        return $result;
    }    

    public function get_lesson_post_info($lession_id = null){
        $this->db->select('*', false);
        $this->db->from('tbl_blog');        
        $this->db->where('lession_id', $lession_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_movie_info($id){
        $this->db->select('lession_video_url as url, lession_id', false);
        $this->db->from('tbl_lession_info');        
        $this->db->where('lession_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    } 

    public function get_post_info($id){
        $this->db->select('tbl_blog.*', false);
        $this->db->select('tbl_doctor.*', false);
        $this->db->from('tbl_blog');     
        $this->db->join('tbl_doctor', 'tbl_doctor.id = tbl_blog.post_doc_id', 'left');           
        $this->db->where('lession_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;        
    }
    
} 