<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->lang->load('cn', 'chinese');
        $this->load->model('login_model');
        $loggedin = $this->session->userdata('loggedin');

    }

    public function index()
    {
      if ($loggedin) {
        redirect(site_url('statistics'));
      }else {
        $data['title'] = 'LSDSOFT';
        $this->load->view('login/login', $data);
      }
    }

    public function check_user()
    {
        $login_data = $this->login_model->login();
        if ($login_data) {
            $this->validate($login_data);
        } else {
            $data['login_status'] = 'error';
            $data['error_content'] = '您的账户和密码错误！';
            $this->load->view('login/login', $data);
        }
    }

    public function logout()
    {
        $this->login_model->logout();
        redirect('login');
    }
    
    public function validate($usr_info)
    {

        if ($usr_info['usr_status'] == 1) {
            redirect('statistics');
        } elseif ($usr_info['usr_status'] == 0) {
            $data['login_status'] = 'error';
            $data['error_content'] = '您的账户未活动';
            $this->load->view('login/login', $data);
        } else {
            $data['login_status'] = 'error';
            $data['error_content'] = '您的账户已注销';
            $this->load->view('login/login', $data);
        }
    }
}
