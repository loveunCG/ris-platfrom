<?php
class Login_model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('basic_helper');
        $this->load->database();
    }

    public function login()
    {
        $this->_table_name = 'tbl_doctor';
        $this->_order_by = 'usr_id';
        $login_usr_info = $this->get_by(array(
            'binary(usr_id)' => $this->input->post('username'),
            'usr_passwd' => md5($this->input->post('password'))), true);
        if ($login_usr_info) {
            if ($this->CheckDuplication()) {
                return 'logined';
            }

            $role = $this->get_roleList(array('rle_doctor_id' => $login_usr_info->id));
            $data = array(
                'usr_id' => $login_usr_info->usr_id,
                'id' => $login_usr_info->id,
                'usr_name' => $login_usr_info->usr_name,
                'usr_status' => $login_usr_info->usr_status,
                'usr_degree' => $login_usr_info->usr_degree,
                'usr_gender' => $login_usr_info->usr_gender,
                'loggedin' => true,
                'ip' => $this->getip(),
                'usr_role' => $login_usr_info->usr_role,
                'hospital_name' => $login_usr_info->usr_hospital,
                'url' => get_redirect_url($role, $login_usr_info->usr_role),
            );
            foreach ($role as $roles) {
                $data[$roles->rle_name] = true; //$roles->rle_name;
            }
            $this->session->set_userdata($data);
            session_write_close();
            return $data;
        } else {
            $this->_table_name = 'tbl_patient';
            $this->_order_by = 'id';
            $login_pat_info = $this->get_by(array(
                'pat_id' => $this->input->post('username'),
                'pat_passwd' => md5($this->input->post('password'))), true);
            if (!empty($login_pat_info)) {
                $data = array(
                    'pat_id' => $login_pat_info->pat_id,
                    'id' => $login_pat_info->id,
                    'usr_status' => $login_pat_info->pat_status,
                    'pat_name' => $login_pat_info->pat_name,
                    'pat_IdNum' => $login_pat_info->pat_IdNum,
                    'pat_phone_num' => $login_pat_info->pat_phone_num,
                    'loggedin' => true,
                    'ip' => $this->getip(),
                    'url' => 'patient',
                );
                $this->session->set_userdata($data);
                session_write_close();
                var_dump($this->session->userdata());
                return $data;
            } else {
                return false;
            }
        }
    }

    public function CheckDuplication()
    {
        $usr_id = $this->input->post('username');
        $sessionDatas = $this->getSessionData();
        $duplId = '';
        foreach ($sessionDatas as $value) {
            $splitDatas = explode(';', $value->data);
            $tmp_str = explode(':', $splitDatas[1]);
            if (count($tmp_str) < 2) {
                continue;
            }
            $tmp_usr = explode('"', $tmp_str[2]);
            if (count($tmp_str) < 1) {
                continue;
            }
            if ($tmp_usr[1] == $usr_id) {
                $duplId = $value->id;
                $usrLoginCheckData = $this->getLoginCheckusrId(array('lg_usr_id' => $usr_id));
                $saveData = array(
                    'lg_usr_id' => $usr_id,
                    'lg_ip' => $this->getip(),
                    'lg_time' => date('Y-m-s h:i:s'),
                    'lg_status' => 'check',
                );
                $this->_table_name = "tbl_login_check";
                $this->_primary_key = "lg_ck_id";
                $this->save($saveData, $usrLoginCheckData[0]->lg_ck_id);
                $this->_table_name = "ci_sessions";
                $this->_primary_key = "id";
                return $this->delete_multiple(array('id' => $duplId));
            }
        }
        return false;
    }

    public function logout()
    {
        $this->session->sess_destroy();
    }

    public function get_roleList($data = null)
    {
        $this->db->select('tbl_role.*', false);
        $this->db->from('tbl_role');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_userinfo($data = null)
    {
        $this->db->select('tbl_doctor.*', false);
        $this->db->select('tbl_department.*', false);
        $this->db->from('tbl_doctor');
        $this->db->join('tbl_department', 'tbl_doctor.usr_department = tbl_department.department_id', 'left');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getLoginCheckusrId($data = null)
    {
        $this->db->select('tbl_login_check.*', false);
        $this->db->from('tbl_login_check');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_deviceinfo($data = null)
    {
        $this->db->select('tbl_device.*', false);
        $this->db->from('tbl_device');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getSessionData($data = null)
    {
        $this->db->select('ci_sessions.*', false);
        $this->db->from('ci_sessions');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_check_iteminfo($data = null)
    {
        $this->db->select('tbl_checkup_item.*', false);
        $this->db->from('tbl_checkup_item');
        if ($data) {
            $this->db->where($data);
        }
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_checkinfo($data = null)
    {
        $this->db->select('tbl_device.*', false);
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

    public function get_departmentinfo()
    {
        $this->db->select('tbl_department.*', false);
        $this->db->from('tbl_department');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function getip()
    {
        static $ip = '';
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_CDN_SRC_IP'])) {
            $ip = $_SERVER['HTTP_CDN_SRC_IP'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) and preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] as $xip) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                    $ip = $xip;
                    break;
                }
            }
        }
        return $ip;
    }

    public function loggedin()
    {
        return (bool) $this->session->userdata('loggedin');
    }
}
