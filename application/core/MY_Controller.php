<?php
class MY_Controller extends CI_Controller
{
    protected $loggedin;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->lang->load('cn', 'chinese');
        $this->load->library('form_validation');
        $this->load->helper('basic_helper');
        $loggedin = $this->session->userdata('loggedin');
        $usr_id = $this->session->userdata('usr_id');
        if ($loggedin != true || $usr_id == null) {
            redirect('login');
        }
    }

    public function check_role($role = null)
    {
        $user_role = $this->session->userdata('usr_role');
        if ($user_role == 1||$user_role == 1024) {
            return true;
        } elseif ($role) {
            if ($this->session->userdata($role)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}
