<?php
class Login_model extends MY_Model {
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    
    public function login(){
        $this->_table_name = 'tbl_doctor';
        $this->_order_by = 'usr_id';
        $login_usr_info = $this->get_by(array(
              'usr_id' => $this->input->post('username'),
              'usr_passwd' => md5($this->input->post('password'))), TRUE);
        if($login_usr_info){
            $data = array(
                'usr_id' => $login_usr_info->usr_id,
                'id' => $login_usr_info->id,
                'usr_name' => $login_usr_info->usr_name,
                'usr_status' => $login_usr_info->usr_status,
                'usr_degree' => $login_usr_info->usr_degree,
                'loggedin' => TRUE,
                'admin_status' => $login_usr_info->admin_status,
                'm_booking' => $login_usr_info->m_booking,
                'm_report' => $login_usr_info->m_report,
                'm_deliberation' => $login_usr_info->m_deliberation,
                'm_remote' => $login_usr_info->m_remote,
                'm_mydata' => $login_usr_info->m_mydata,
                'm_learn' => $login_usr_info->m_learn,
                'm_contact' => $login_usr_info->m_contact,
                'm_share' => $login_usr_info->m_share,
                'hospital_name'=>$login_usr_info->usr_hospital,
                'url' => 'admin/dashboard',
            );
            $this->session->set_userdata($data);
            return $data;
        }else{
            return false;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
    }



    public function get_userinfo($data = null) {

        $this->db->select('tbl_doctor.*', FALSE);
        $this->db->select('tbl_department.*', FALSE);
        $this->db->from('tbl_doctor');
        $this->db->join('tbl_department', 'tbl_doctor.usr_department = tbl_department.department_id', 'left');
        if ($data) {
          $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_deviceinfo($data = null) {
        $this->db->select('tbl_device.*', FALSE);
        //$this->db->select('tbl_department.*', FALSE);
        $this->db->from('tbl_device');
      //  $this->db->join('tbl_department', 'tbl_doctor.usr_department = tbl_department.department_id', 'left');
        if ($data) {
          $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_check_iteminfo($data = null) {
        $this->db->select('tbl_checkup_item.*', FALSE);
        $this->db->from('tbl_checkup_item');
        if ($data) {
          $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_checkinfo($data = null) {
        $this->db->select('tbl_device.*', FALSE);
        //$this->db->select('tbl_department.*', FALSE);
        $this->db->from('tbl_device');
      //  $this->db->join('tbl_department', 'tbl_doctor.usr_department = tbl_department.department_id', 'left');
        if ($data) {
          $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }


    public function get_departmentinfo() {
        $this->db->select('tbl_department.*', FALSE);
        $this->db->from('tbl_department');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function loggedin() {
       return (bool) $this->session->userdata('loggedin');
   }

}
