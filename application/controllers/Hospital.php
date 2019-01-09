<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hospital extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('usr_role') == 1024) {
        } else {
            redirect('school');
        }
        $this->load->helper('url');
        $this->load->library('session');
        $this->lang->load('cn', 'chinese');
        $this->load->model('hospital_model');
    }

    public function index()
    {
        $data['menutitle'] = $this->lang->line('hospital');
        $data['subview'] = $this->load->view('hospital/index', $data, true);
        $this->load->view('layout', $data);
    }
}
