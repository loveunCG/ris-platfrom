<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Statistics extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->userdata('lang') == '1') {
            $this->lang->load('en', 'chinese');
        } else {
            $this->lang->load('cn', 'chinese');
        }
        $this->load->model('report_model');
    }
    public function index()
    {
        $data['report_data'] = $this->report_model->get_past_reportinfo();
        $sdata['report_time >='] = date('Y-m-d') . ' 00:00:00';
        $data['jintian_report_data'] = $this->report_model->get_past_reportinfo($sdata);
        $data['booking_data'] = $this->report_model->get_booking_data();
        $data['user_info'] = $this->report_model->get_user_info();
        $amount = $this->report_model->get_booking_amount();
        foreach ($amount as $value) {
            $total_amount = $value->cost_amount;
        }
        $data['Tamount'] = $total_amount;
        $bdata['booking_time >='] = date('Y-m-d') . ' 00:00:00';
        $data['jitian_booking_data'] = $this->report_model->get_booking_data($bdata);
        $data['menutitle'] = $this->lang->line('statistics');
        $data['subview'] = $this->load->view('statistics/dashboard', $data, true);
        $this->load->view('layout', $data);
    }

    public function contact_start()
    {
        $data['menutitle'] = $this->lang->line('remote_contact');
        $data['subview'] = $this->load->view('contact/contact_start', $data, true);
        $this->load->view('layout', $data);
    }

    public function my_contact()
    {
        $data['menutitle'] = $this->lang->line('remote_contact');
        $this->product_model->_table_name = "tbl_contact_info"; //table name
        $this->product_model->_order_by = "contact_id";
        $data['contact_list'] = $this->product_model->get();
        $data['subview'] = $this->load->view('contact/my_contact', $data, true);
        $this->load->view('layout', $data);
    }

    public function save_contact()
    {
        $saveinfo = $this->db->list_fields('tbl_contact_info');
        foreach ($saveinfo as $value) {
            if (!empty($this->input->post($value, true))) {
                $data[$value] = $this->input->post($value, true);
            }
        }
        $this->product_model->_table_name = "tbl_contact_info"; //table name
        $this->product_model->_primary_key = "contact_id";
        $this->product_model->save($data);

        redirect('contact'); //redirect page
    }
}
