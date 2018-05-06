<?php
class MY_Controller extends CI_Controller{

    private static $instance;
        function __construct()
        {
            parent::__construct();
            $this->load->library('session');
            $this->lang->load('cn', 'chinese');
            $loggedin = $this->session->userdata('loggedin');
            if($loggedin!=TRUE) {
              redirect('login');
            }
        }

  }
