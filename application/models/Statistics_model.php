<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 2017-12-23
 * Time: 오후 8:35
 */

class Statistics_model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_booking_amount()
    {
        $usr_info = $this->session->get_userdata();
        $day = 7;
        switch ($usr_info['usr_role']) {
        case 1:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->select('tbl_patient_booking.*', true);
                    $this->db->from('tbl_patient_booking');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->where('hospital_class', $usr_info['hospital_name']);
                    $this->db->where('booking_time >= ', $start_date);
                    $this->db->where('booking_time <= ', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 10:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->where('tbl_patient_booking.hospital_name', $usr_info['hospital_name']);
                    $this->db->where('booking_time >= ', $start_date);
                    $this->db->where('booking_time <=', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results('tbl_patient_booking');
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 100:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->select('tbl_patient_booking.*');
                    $this->db->from('tbl_patient_booking');
                    $this->db->join('tbl_doctor', 'tbl_patient_booking.req_doctor_name = tbl_doctor.id', 'left');
                    $this->db->where('usr_create_admin', $usr_info['id']);
                    $this->db->where('booking_time >= ', $start_date);
                    $this->db->where('booking_time <=', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 1000:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->where('req_doctor_name', $usr_info['usr_id']);
                    $this->db->where('booking_time >= ', $start_date);
                    $this->db->where('booking_time <=', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results('tbl_patient_booking');
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 1024:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->where('booking_time >= ', $start_date);
                    $this->db->where('booking_time <= ', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results('tbl_patient_booking');
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        }
    }

    public function get_booking_data()
    {
        $usr_info = $this->session->get_userdata();
        $day = 7;
        $time = time() - 3600 * 24 * $day;
        $date = date('Y-m-d', $time);
        switch ($usr_info['usr_role']) {
        case 1:{
                $this->db->select('tbl_patient_booking.*');
                $this->db->from('tbl_patient_booking');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->where('hospital_class', $usr_info['hospital_name']);
                $this->db->where('booking_time >=', $date);
                $this->db->order_by('booking_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        case 10:{
                $this->db->where('tbl_patient_booking.hospital_name', $usr_info['hospital_name']);
                $this->db->where('booking_time >=', $date);
                $this->db->order_by('booking_time', 'ASC');
                $query_result = $this->db->get('tbl_patient_booking');
                $result = $query_result->result();
                return $result;
                break;
            }
        case 100:{
                $this->db->select('tbl_patient_booking.*');
                $this->db->from('tbl_patient_booking');
                $this->db->join('tbl_doctor', 'tbl_patient_booking.req_doctor_name = tbl_doctor.id', 'left');
                $this->db->where('usr_create_admin', $usr_info['id']);
                $this->db->where('booking_time >=', $date);
                $this->db->order_by('booking_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        case 1000:{
                $this->db->where('req_doctor_name', $usr_info['usr_id']);
                $this->db->where('booking_time >=', $date);
                $this->db->order_by('booking_time', 'ASC');
                $query_result = $this->db->get('tbl_patient_booking');
                $result = $query_result->result();
                return $result;
                break;
            }
        case 1024:{
                $this->db->where('booking_time >=', $date);
                $this->db->order_by('booking_time', 'ASC');
                $query_result = $this->db->get('tbl_patient_booking');
                $result = $query_result->result();
                return $result;
                break;
            }
        }
    }

    public function search_booking_data($data)
    {
        $usr_info = $this->session->get_userdata();

        switch ($usr_info['usr_role']) {
        case 1:{
                $this->db->select('tbl_patient_booking.*');
                $this->db->from('tbl_patient_booking');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->where('hospital_class', $usr_info['hospital_name']);
                $this->db->where($data);
                $this->db->order_by('booking_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        case 10:{
                $this->db->where('tbl_patient_booking.hospital_name', $usr_info['hospital_name']);
                $this->db->where($data);
                $this->db->order_by('booking_time', 'ASC');
                $query_result = $this->db->get('tbl_patient_booking');
                $result = $query_result->result();
                return $result;
                break;
            }
        case 100:{
                $this->db->select('tbl_patient_booking.*');
                $this->db->from('tbl_patient_booking');
                $this->db->join('tbl_doctor', 'tbl_patient_booking.req_doctor_name = tbl_doctor.id', 'left');
                $this->db->where('usr_create_admin', $usr_info['id']);
                $this->db->where($data);
                $this->db->order_by('booking_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        case 1000:{
                $this->db->where('req_doctor_name', $usr_info['usr_id']);
                $this->db->where($data);
                $this->db->order_by('booking_time', 'ASC');
                $query_result = $this->db->get('tbl_patient_booking');
                $result = $query_result->result();
                return $result;
                break;
            }
        case 1024:{
                $this->db->where($data);
                $this->db->order_by('booking_time', 'ASC');
                $query_result = $this->db->get('tbl_patient_booking');
                $result = $query_result->result();
                return $result;
                break;
            }
        }
    }

    public function search_booking_amount($data)
    {
        $usr_info = $this->session->get_userdata();
        if (isset($data['end_time']) && isset($data['start_time'])) {
            $day = ceil((strtotime($data['end_time']) - strtotime($data['start_time'])) / 86400);
            $time = strtotime($data['end_time']);
        } else {
            $day = 7;
            $time = time();
        }
        $search = array();
        if (isset($data['hospital_name'])) {
            $search['tbl_patient_booking.hospital_name'] = $data['hospital_name'];
        }
        if (isset($data['patient_source'])) {
            $search['patient_source'] = $data['patient_source'];
        }

        switch ($usr_info['usr_role']) {
        case 1:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->select('tbl_patient_booking.*', true);
                    $this->db->from('tbl_patient_booking');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->where('hospital_class', $usr_info['hospital_name']);
                    $this->db->where($search);
                    $this->db->where('booking_time >= ', $start_date);
                    $this->db->where('booking_time <= ', $end_date);
                    $date = date('m-d', $time - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 10:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->where('tbl_patient_booking.hospital_name', $usr_info['hospital_name']);
                    $this->db->where($search);
                    $this->db->where('booking_time >= ', $start_date);
                    $this->db->where('booking_time <= ', $end_date);
                    $date = date('m-d', $time - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results('tbl_patient_booking');
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 100:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->select('tbl_patient_booking.*');
                    $this->db->from('tbl_patient_booking');
                    $this->db->join('tbl_doctor', 'tbl_patient_booking.req_doctor_name = tbl_doctor.id', 'left');
                    $this->db->where('usr_create_admin', $usr_info['id']);
                    $this->db->where($search);
                    $this->db->where('booking_time >= ', $start_date);
                    $this->db->where('booking_time <= ', $end_date);
                    $date = date('m-d', $time - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 1000:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->where('req_doctor_name', $usr_info['usr_id']);
                    $this->db->where($search);
                    $this->db->where('booking_time >= ', $start_date);
                    $this->db->where('booking_time <= ', $end_date);
                    $date = date('m-d', $time - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results('tbl_patient_booking');
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 1024:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->where($search);
                    $this->db->where('booking_time >= ', $start_date);
                    $this->db->where('booking_time <= ', $end_date);
                    $date = date('m-d', $time - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results('tbl_patient_booking');
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        }
    }

    public function get_diagnosis_data()
    {
        $usr_info = $this->session->get_userdata();
        $day = 7;
        $time = time() - 3600 * 24 * $day;
        $date = date('Y-m-d', $time);
        $fields = 'tbl_patient_booking.booking_id,tbl_patient_booking.patient_gender,tbl_patient_booking.patient_code,
                    tbl_patient_booking.patient_name,tbl_patient_booking.patient_age,tbl_patient_booking.checked_time,
                    tbl_patient_booking.hospital_name,tbl_patient_booking.req_doctor_name,tbl_deliberation.doctor_name,
                    tbl_check_list.checkup_type, tbl_patient_booking.del_status, tbl_check_list.chc_id, tbl_report.report_id';
        switch ($usr_info['usr_role']) {
        case 1:{

                $this->db->select($fields);
                $this->db->from('tbl_check_list');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('hospital_class', $usr_info['hospital_name']);
                $this->db->where('checked_time >=', $date);
                $this->db->order_by('checked_time', 'ASC');
                $query_result = $this->db->get();
                $data = $query_result->result();
                return $data;
                break;
            }
        case 10:{

                $this->db->select($fields);
                $this->db->from('tbl_check_list');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('tbl_patient_booking.hospital_name', $usr_info['hospital_name']);
                $this->db->where('checked_time >=', $date);
                $this->db->order_by('checked_time', 'ASC');
                $query_result = $this->db->get();
                $data = $query_result->result();
                return $data;
                break;
            }
        case 100:{

                $this->db->select($fields);
                $this->db->from('tbl_check_list');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('usr_create_admin', $usr_info['id']);
                $this->db->where('checked_time >=', $date);
                $this->db->order_by('checked_time', 'ASC');
                $query_result = $this->db->get();
                $data = $query_result->result();
                return $data;
                break;
            }
        case 1000:{

                $this->db->select($fields);
                $this->db->from('tbl_check_list');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('req_doctor_name', $usr_info['usr_id']);
                $this->db->where('checked_time >=', $date);
                $this->db->order_by('checked_time', 'ASC');
                $query_result = $this->db->get();
                $data = $query_result->result();
                return $data;
                break;
            }
        case 1024:{

                $this->db->select($fields);
                $this->db->from('tbl_check_list');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('checked_time >=', $date);
                $this->db->order_by('checked_time', 'ASC');
                $query_result = $this->db->get();
                $data = $query_result->result();
                // echo var_dump($data);
                return $data;
                break;
            }
        }
    }

    public function get_diagnosis_amount()
    {
        $usr_info = $this->session->get_userdata();
        $day = 7;
        switch ($usr_info['usr_role']) {
        case 1:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_check_list');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('hospital_class', $usr_info['hospital_name']);
                    $this->db->where('checked_time >= ', $start_date);
                    $this->db->where('checked_time <= ', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 10:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_check_list');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('tbl_patient_booking.hospital_name', $usr_info['hospital_name']);
                    $this->db->where('checked_time >= ', $start_date);
                    $this->db->where('checked_time <= ', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 100:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_check_list');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('usr_create_admin', $usr_info['id']);
                    $this->db->where('checked_time >= ', $start_date);
                    $this->db->where('checked_time <=', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 1000:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_check_list');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('req_doctor_name', $usr_info['usr_id']);
                    $this->db->where('checked_time >= ', $start_date);
                    $this->db->where('checked_time <= ', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 1024:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_check_list');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('checked_time >= ', $start_date);
                    $this->db->where('checked_time <= ', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        }
    }

    public function search_diagnosis_data($data)
    {
        $usr_info = $this->session->get_userdata();
        $search = array();
        if (isset($data['start_time'])) {
            $search['checked_time >='] = $data['start_time'];
        }
        if (isset($data['end_time'])) {
            $search['checked_time <'] = $data['end_time'];
        }
        if (isset($data['hospital_name'])) {
            $search['tbl_patient_booking.hospital_name'] = $data['hospital_name'];
        }
        $fields = 'tbl_patient_booking.booking_id,tbl_patient_booking.patient_gender,tbl_patient_booking.patient_code,
                    tbl_patient_booking.patient_name,tbl_patient_booking.patient_age,tbl_patient_booking.checked_time,
                    tbl_patient_booking.hospital_name,tbl_patient_booking.req_doctor_name,tbl_deliberation.doctor_name,
                    tbl_check_list.checkup_type, tbl_check_list.chc_id, tbl_patient_booking.del_status, tbl_report.report_id';
        switch ($usr_info['usr_role']) {
        case 1:{
                $this->db->select($fields);
                $this->db->from('tbl_check_list');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('hospital_class', $usr_info['hospital_name']);
                $this->db->where($search);
                $this->db->order_by('checked_time', 'ASC');
                $query_result = $this->db->get();
                $data = $query_result->result();
                return $data;
                break;
            }
        case 10:{
                $this->db->select($fields);
                $this->db->from('tbl_check_list');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('tbl_patient_booking.hospital_name', $usr_info['hospital_name']);
                $this->db->where($search);
                $this->db->order_by('checked_time', 'ASC');
                $query_result = $this->db->get();
                $data = $query_result->result();
                return $data;
                break;
            }
        case 100:{
                $this->db->select($fields);
                $this->db->from('tbl_check_list');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('usr_create_admin', $usr_info['id']);
                $this->db->where($search);
                $this->db->order_by('checked_time', 'ASC');
                $query_result = $this->db->get();
                $data = $query_result->result();

                return $data;
                break;
            }
        case 1000:{
                $this->db->select($fields);
                $this->db->from('tbl_check_list');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('req_doctor_name', $usr_info['usr_id']);
                $this->db->where($search);
                $this->db->order_by('checked_time', 'ASC');
                $query_result = $this->db->get();
                $data = $query_result->result();
                return $data;
                break;
            }
        case 1024:{
                $this->db->select($fields);
                $this->db->from('tbl_check_list');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where($search);
                $this->db->order_by('checked_time', 'ASC');
                $query_result = $this->db->get();
                $data = $query_result->result();
                return $data;
                break;
            }
        }
    }

    public function search_diagnosis_amount($data)
    {
        $usr_info = $this->session->get_userdata();
        if (isset($data['end_time']) && isset($data['start_time'])) {
            $day = ceil((strtotime($data['end_time']) - strtotime($data['start_time'])) / 86400);
            $time = strtotime($data['end_time']);
        } else {
            $day = 7;
            $time = time();
        }
        $search = array();
        if (isset($data['hospital_name'])) {
            $search['tbl_patient_booking.hospital_name'] = $data['hospital_name'];
        }
        switch ($usr_info['usr_role']) {
        case 1:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_check_list');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('hospital_class', $usr_info['hospital_name']);
                    $this->db->where('booking_status >=', '3');
                    $this->db->where($search);
                    $this->db->where('checked_time >= ', $start_date);
                    $this->db->where('checked_time <= ', $end_date);

                    if (isset($data['checkup_type'])) {
                        $query_result = $this->db->get();
                        $c = $query_result->result();
                        $amount = 0;
                        if ($c) {
                            foreach ($c as $value) {
                                $this->db->where('chc_booking_id', $value->booking_id);
                                $this->db->where('checkup_type', $data['checkup_type']);
                                $a = $this->db->get('tbl_check_list')->result();
                                if ($a) {
                                    $amount++;
                                }
                            }
                        }
                        $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                        $result[$i]['date'] = $date;
                        $result[$i]['people_num_1'] = $amount;
                        $result[$i]['people_num_2'] = $amount;
                    } else {
                        $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                        $result[$i]['date'] = $date;
                        $amount = $this->db->count_all_results();
                        $result[$i]['people_num_1'] = $amount;
                        $result[$i]['people_num_2'] = $amount;
                    }
                }
                return $result;
                break;
            }
        case 10:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_check_list');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('tbl_patient_booking.hospital_name', $usr_info['hospital_name']);
                    $this->db->where('booking_status >=', '3');
                    $this->db->where($search);
                    $this->db->where('checked_time >= ', $start_date);
                    $this->db->where('checked_time > ', $end_date);
                    if (isset($data['checkup_type'])) {
                        $query_result = $this->db->get();
                        $c = $query_result->result();
                        $amount = 0;
                        if ($c) {
                            foreach ($c as $value) {
                                $this->db->where('chc_booking_id', $value->booking_id);
                                $this->db->where('checkup_type', $data['checkup_type']);
                                $a = $this->db->get('tbl_check_list')->result();
                                if ($a) {
                                    $amount++;
                                }
                            }
                        }
                        $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                        $result[$i]['date'] = $date;
                        $result[$i]['people_num_1'] = $amount;
                        $result[$i]['people_num_2'] = $amount;
                    } else {
                        $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                        $result[$i]['date'] = $date;
                        $amount = $this->db->count_all_results();
                        $result[$i]['people_num_1'] = $amount;
                        $result[$i]['people_num_2'] = $amount;
                    }
                }
                return $result;
                break;
            }
        case 100:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_check_list');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('usr_create_admin', $usr_info['id']);
                    $this->db->where('booking_status >=', '3');
                    $this->db->where($search);
                    $this->db->where('checked_time >= ', $start_date);
                    $this->db->where('checked_time <= ', $end_date);

                    if (isset($data['checkup_type'])) {
                        $query_result = $this->db->get();
                        $c = $query_result->result();
                        $amount = 0;
                        if ($c) {
                            foreach ($c as $value) {
                                $this->db->where('chc_booking_id', $value->booking_id);
                                $this->db->where('checkup_type', $data['checkup_type']);
                                $a = $this->db->get('tbl_check_list')->result();
                                if ($a) {
                                    $amount++;
                                }
                            }
                        }
                        $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                        $result[$i]['date'] = $date;
                        $result[$i]['people_num_1'] = $amount;
                        $result[$i]['people_num_2'] = $amount;
                    } else {
                        $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                        $result[$i]['date'] = $date;
                        $amount = $this->db->count_all_results();
                        $result[$i]['people_num_1'] = $amount;
                        $result[$i]['people_num_2'] = $amount;
                    }
                }
                return $result;
                break;
            }
        case 1000:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_check_list');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('req_doctor_name', $usr_info['usr_id']);
                    $this->db->where('booking_status >=', '3');
                    $this->db->where($search);
                    $this->db->where('checked_time >= ', $start_date);
                    $this->db->where('checked_time <= ', $end_date);

                    if (isset($data['checkup_type'])) {
                        $query_result = $this->db->get();
                        $c = $query_result->result();
                        $amount = 0;
                        if ($c) {
                            foreach ($c as $value) {
                                $this->db->where('chc_booking_id', $value->booking_id);
                                $this->db->where('checkup_type', $data['checkup_type']);
                                $a = $this->db->get('tbl_check_list')->result();
                                if ($a) {
                                    $amount++;
                                }
                            }
                        }
                        $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                        $result[$i]['date'] = $date;
                        $result[$i]['people_num_1'] = $amount;
                        $result[$i]['people_num_2'] = $amount;
                    } else {
                        $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                        $result[$i]['date'] = $date;
                        $amount = $this->db->count_all_results();
                        $result[$i]['people_num_1'] = $amount;
                        $result[$i]['people_num_2'] = $amount;
                    }
                }
                return $result;
                break;
            }
        case 1024:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_check_list');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_check_list.chc_booking_id', 'left');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->join('tbl_report', 'tbl_check_list.chc_id = tbl_report.checkup_id');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('booking_status >=', '3');
                    $this->db->where($search);
                    $this->db->where('checked_time >= ', $start_date);
                    $this->db->where('checked_time <= ', $end_date);

                    if (isset($data['checkup_type'])) {
                        $query_result = $this->db->get();
                        $c = $query_result->result();
                        $amount = 0;
                        if ($c) {
                            foreach ($c as $value) {
                                $this->db->where('chc_booking_id', $value->booking_id);
                                $this->db->where('checkup_type', $data['checkup_type']);
                                $a = $this->db->get('tbl_check_list')->result();
                                if ($a) {
                                    $amount++;
                                }
                            }
                        }
                        $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                        $result[$i]['date'] = $date;
                        $result[$i]['people_num_1'] = $amount;
                        $result[$i]['people_num_2'] = $amount;
                    } else {
                        $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                        $result[$i]['date'] = $date;
                        $amount = $this->db->count_all_results();
                        $result[$i]['people_num_1'] = $amount;
                        $result[$i]['people_num_2'] = $amount;
                    }
                }
                return $result;
                break;
            }
        }
    }

    public function get_remote_data()
    {
        $usr_info = $this->session->get_userdata();
        $day = 7;
        $time = time() - 3600 * 24 * $day;
        $date = date('Y-m-d', $time);
        switch ($usr_info['usr_role']) {
        case 1:{
                $this->db->from('tbl_contact_info');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->where('hospital_class', $usr_info['hospital_name']);
                $this->db->where('submit_time >=', $date);
                $this->db->order_by('submit_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        case 10:{
                $this->db->from('tbl_contact_info');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('tbl_patient_booking.hospital_name', $usr_info['hospital_name']);
                $this->db->where('submit_time >=', $date);
                $this->db->order_by('submit_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        case 100:{
                $this->db->from('tbl_contact_info');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->join('tbl_doctor', 'tbl_patient_booking.req_doctor_name = tbl_doctor.id', 'left');
                $this->db->where('usr_create_admin', $usr_info['id']);
                $this->db->where('submit_time >=', $date);
                $this->db->order_by('submit_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        case 1000:{
                $this->db->from('tbl_contact_info');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('tbl_contact_info.req_doctor_name', $usr_info['usr_id']);
                $this->db->where('submit_time >=', $date);
                $this->db->order_by('submit_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        case 1024:{
                $this->db->from('tbl_contact_info');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('submit_time >=', $date);
                $this->db->order_by('submit_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                // echo var_dump($result);
                // echo var_dump($date);
                return $result;
                break;
            }
        }
    }

    public function get_remote_amount()
    {
        $usr_info = $this->session->get_userdata();
        $day = 7;
        switch ($usr_info['usr_role']) {
        case 1:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_contact_info');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                    $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->where('hospital_class', $usr_info['hospital_name']);
                    $this->db->where('submit_time >= ', $start_date);
                    $this->db->where('submit_time <= ', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 10:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_contact_info');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                    $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('tbl_patient_booking.hospital_name', $usr_info['hospital_name']);
                    $this->db->where('submit_time >= ', $start_date);
                    $this->db->where('submit_time <= ', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 100:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_contact_info');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                    $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->join('tbl_doctor', 'tbl_patient_booking.req_doctor_name = tbl_doctor.id', 'left');
                    $this->db->where('usr_create_admin', $usr_info['id']);
                    $this->db->where('submit_time >= ', $start_date);
                    $this->db->where('submit_time <= ', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 1000:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_contact_info');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                    $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('tbl_contact_info.req_doctor_name', $usr_info['usr_id']);
                    $this->db->where('submit_time >= ', $start_date);
                    $this->db->where('submit_time <= ', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 1024:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', time() - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_contact_info');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                    $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('submit_time >= ', $start_date);
                    $this->db->where('submit_time <= ', $end_date);
                    $date = date('m-d', time() - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        }
    }

    public function search_remote_data($data)
    {
        $usr_info = $this->session->get_userdata();

        switch ($usr_info['usr_role']) {
        case 1:{
                $this->db->from('tbl_contact_info');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                $this->db->where('hospital_class', $usr_info['hospital_name']);
                $this->db->where($data);
                $this->db->order_by('submit_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        case 10:{
                $this->db->from('tbl_contact_info');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('tbl_patient_booking.hospital_name', $usr_info['hospital_name']);
                $this->db->where($data);
                $this->db->order_by('submit_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        case 100:{
                $this->db->from('tbl_contact_info');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->join('tbl_doctor', 'tbl_patient_booking.req_doctor_name = tbl_doctor.id', 'left');
                $this->db->where('usr_create_admin', $usr_info['id']);
                $this->db->where($data);
                $this->db->order_by('submit_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        case 1000:{
                $this->db->from('tbl_contact_info');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where('tbl_contact_info.req_doctor_name', $usr_info['usr_id']);
                $this->db->where($data);
                $this->db->order_by('submit_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        case 1024:{
                $this->db->from('tbl_contact_info');
                $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                $this->db->where($data);
                $this->db->order_by('submit_time', 'ASC');
                $query_result = $this->db->get();
                $result = $query_result->result();
                return $result;
                break;
            }
        }
    }

    public function search_remote_amount($data)
    {
        $usr_info = $this->session->get_userdata();
        if (isset($data['end_time']) && isset($data['start_time'])) {
            $day = ceil((strtotime($data['end_time']) - strtotime($data['start_time'])) / 86400);
            $time = strtotime($data['end_time']);
        } else {
            $day = 7;
            $time = time();
        }
        $search = array();
        if (isset($data['hospital_name'])) {
            $search['req_hospital'] = $data['hospital_name'];
        }
        if (isset($data['contact_type'])) {
            $search['contact_type'] = $data['contact_type'];
        }

        switch ($usr_info['usr_role']) {
        case 1:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_contact_info');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                    $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->join('tbl_hospital', 'tbl_patient_booking.hospital_name = tbl_hospital.hospital_name', 'left');
                    $this->db->where('hospital_class', $usr_info['hospital_name']);
                    $this->db->where($search);
                    $this->db->where('submit_time >= ', $start_date);
                    $this->db->where('submit_time <= ', $end_date);
                    $date = date('m-d', $time - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 10:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_contact_info');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                    $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('tbl_patient_booking.hospital_name', $usr_info['hospital_name']);
                    $this->db->where($search);
                    $this->db->where('submit_time >= ', $start_date);
                    $this->db->where('submit_time <= ', $end_date);
                    $date = date('m-d', $time - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 100:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_contact_info');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                    $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->join('tbl_doctor', 'tbl_patient_booking.req_doctor_name = tbl_doctor.id', 'left');
                    $this->db->where('usr_create_admin', $usr_info['id']);
                    $this->db->where($search);
                    $this->db->where('submit_time >= ', $start_date);
                    $this->db->where('submit_time <= ', $end_date);
                    $date = date('m-d', $time - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 1000:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_contact_info');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                    $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('tbl_contact_info.req_doctor_name', $usr_info['usr_id']);
                    $this->db->where($search);
                    $this->db->where('submit_time >= ', $start_date);
                    $this->db->where('submit_time <= ', $end_date);
                    $date = date('m-d', $time - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        case 1024:{
                for ($i = 0; $i <= $day; $i++) {
                    $start_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i));
                    $end_date = date('Y-m-d', $time - 3600 * 24 * ($day - $i - 1));
                    $this->db->from('tbl_contact_info');
                    $this->db->join('tbl_patient_booking', 'tbl_patient_booking.booking_id = tbl_contact_info.patient_id', 'left');
                    $this->db->join('tbl_report', 'tbl_patient_booking.booking_id = tbl_report.booking_id', 'left');
                    $this->db->join('tbl_deliberation', 'tbl_report.report_id = tbl_deliberation.deli_rpt_id', 'left');
                    $this->db->where('booking_status >=', '3');
                    $this->db->where($search);
                    $this->db->where('submit_time >= ', $start_date);
                    $this->db->where('submit_time <= ', $end_date);
                    $date = date('m-d', $time - 3600 * 24 * ($day - $i));
                    $result[$i]['date'] = $date;
                    $amount = $this->db->count_all_results();
                    $result[$i]['people_num_1'] = $amount;
                    $result[$i]['people_num_2'] = $amount;
                }
                return $result;
                break;
            }
        }
    }
}
