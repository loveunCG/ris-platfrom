<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Flc\Dysms\Client;
use Flc\Dysms\Request\SendSms;

class Login extends CI_Controller
{
    public $loggedin = '';
    public $login_status = '';
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->lang->load('cn', 'chinese');
        $this->load->model('login_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $loggedin = $this->session->userdata('loggedin');
        $data['login_status'] = $this->login_status;
        if ($loggedin) {
            redirect(site_url($this->session->userdata('url')));
        } else {
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

    public function time_elapsed_B($secs)
    {
        $bit = array(
            ' 年' => $secs / 31556926 % 12,
            ' 周' => $secs / 604800 % 52,
            ' 日' => $secs / 86400 % 7,
            ' 点' => $secs / 3600 % 24,
            ' 分' => $secs / 60 % 60,
            ' 秒' => $secs % 60,
        );

        foreach ($bit as $k => $v) {
            if ($v > 1) {
                $ret[] = $v . $k;
            }

            if ($v == 1) {
                $ret[] = $v . $k;
            }
        }
        array_splice($ret, count($ret) - 1, 0, ' ');
        $ret[] = ' ';

        return join(' ', $ret);
    }

    public function loginAlert()
    {
        $loginCheckData = $this->login_model->getLoginCheckusrId(array('lg_usr_id' => $this->session->userdata('usr_id')))[0];
        echo json_encode($loginCheckData);
        $update_data = array('lg_status' => 'read');
        $where = array('lg_usr_id' => $this->session->userdata('usr_id'));
        $this->login_model->set_action($where, $update_data, 'tbl_login_check');
    }

    public function sessionCheck()
    {
        if ($this->session->userdata('usr_id')) {
            echo json_encode(array('status' => 'true'));
        } else {
            echo json_encode(array('status' => 'false'));
        }
    }

    public function validate($usr_info)
    {
        if ($usr_info['usr_status'] == 1) {
            $saveData = array(
                'lg_usr_id' => $this->session->userdata('usr_id') == null ? $this->session->userdata('pat_id') : $this->session->userdata('usr_id'),
                'lg_time' => date('Y-m-d h:i:s'),
                'lg_ip' => $this->session->userdata('ip'),
            );
            $this->login_model->_table_name = "tbl_log"; //table name
            $this->login_model->_primary_key = "log_id";
            $this->login_model->save($saveData);
            redirect($this->session->userdata('url'));
        } elseif ($usr_info == 'logined') {
            $data['login_status'] = 'error';
            $data['error_content'] = '该账户已登入了';
            $this->login_model->logout();
            $this->load->view('login/login', $data);
        } elseif ($usr_info['usr_status'] == 0) {
            $data['login_status'] = 'error';
            $data['error_content'] = '您的账户未活动';
            $this->login_model->logout();
            $this->load->view('login/login', $data);
        } else {
            $data['login_status'] = 'error';
            $data['error_content'] = '您的账户已注销';
            $this->login_model->logout();
            $this->load->view('login/login', $data);
        }
    }

    public function send_sms($phone_num = null)
    {
        $config = [
            'accessKeyId' => 'LTAIoO7UGsvrqzqr',
            'accessKeySecret' => '9Jj32kZIENet0IOMgcoFVf2mz69hIq',
        ];
        $sms_code = $this->sms_content();
        $client = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($phone_num);
        $sendSms->setSignName('杭州健培');
        $sendSms->setTemplateCode('SMS_126565268');
        $sendSms->setTemplateParam(['code' => $sms_code]);
        try {
            $result = $client->execute($sendSms);
            $save_data = ['phonenum' => $phone_num, 'verify_code' => $sms_code];
            if ($result->Code === 'OK') {
                $query = $this->db->get_where('tbl_phone_verify', array('phonenum' => $phone_num))->result();
                print_r($query);
                if (count($query) > 0) {
                    $this->db->set($save_data);
                    $this->db->where('id', $query[0]->id);
                    $this->db->update('tbl_phone_verify');
                } else {
                    $this->db->insert('tbl_phone_verify', $save_data);
                }
                return $this->output->set_content_type('application/json')
                    ->set_output(json_encode(['message' => '送法短信验证码已成功了!', 'data' => [], 'response_code' => 1]));
            } else {
                return $this->output->set_content_type('application/json')
                    ->set_output(json_encode(['message' => '送法短信验证码失败了!', 'data' => $result->Message, 'response_code' => 0]));
            }
        } catch (Exception $e) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['message' => '送法短信验证码失败了!', 'data' => $e, 'response_code' => 0]));
        }
    }

    public function sms_content()
    {
        $length = 6;
        $chars = '0123456789';
        $chars_length = (strlen($chars) - 1);
        $string = $chars{rand(0, $chars_length)};
        for ($i = 1; $i < $length; $i = strlen($string)) {
            $r = $chars{rand(0, $chars_length)};
            if ($r != $string{$i - 1}) {
                $string .= $r;
            }
        }
        return $string;
    }

    public function registerPatient()
    {
        $config = array(
            array(
                'field' => 'phoneNum',
                'label' => '手机号',
                'rules' => 'required|min_length[5]|max_length[12]|is_unique[tbl_patient.pat_id]',
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'fullname',
                'label' => 'Password Confirmation',
                'rules' => 'required',
            ),
            array(
                'field' => 'IDCardNum',
                'label' => 'Email',
                'rules' => 'required',
            ),
            array(
                'field' => 'VerificationNum',
                'label' => 'Email',
                'rules' => 'required',
            ),
        );
        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['message' => '提交错误!', 'data' => $this->form_validation->error_array(), 'response_code' => 0]));
        } else {
            $registerData = array(
                'pat_name' => $this->input->post('fullname'),
                'pat_IdNum' => $this->input->post('IDCardNum'),
                'pat_phone_num' => $this->input->post('phoneNum'),
                'pat_id' => $this->input->post('phoneNum'),
                'pat_create_time' => date('Y-m-d h:i:s'),
                'pat_status' => 1,
                'pat_passwd' => md5($this->input->post('password')),
            );
            $check_verifity = array(
                'phonenum' => $this->input->post('phoneNum'),
                'verify_code' => $this->input->post('VerificationNum'),
            );
            $query = $this->db->get_where('tbl_phone_verify', $check_verifity)->result();
            if (count($query) > 0) {
                $this->login_model->_table_name = "tbl_patient"; //table name
                $this->login_model->_primary_key = "id";
                if ($this->login_model->save($registerData)) {
                    return $this->output->set_content_type('application/json')
                        ->set_output(json_encode(['message' => '登记已成功了!', 'data' => [], 'response_code' => 1]));
                } else {
                    return $this->output->set_content_type('application/json')
                        ->set_output(json_encode(['message' => '登记已成功了!', 'data' => [], 'response_code' => 1]));
                }
            } else {
                return $this->output->set_content_type('application/json')
                    ->set_output(json_encode(['message' => '验证码错了!', 'data' => [], 'response_code' => 0]));
            }
        }
    }

    public function checkDuplicationUser($id = null)
    {
        $check_dupliaction_id = $this->login_model->check_by(array('pat_id' => $id), 'tbl_patient');
        if (empty($check_dupliaction_id)) {
            $result = ['result' => [], 'response_code' => 1];
        } else {
            $result = ['result' => '<small style="padding-left:10px;color:red;font-size:14px">账户重复！</small>', 'response_code' => 0];
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function checkDuplicationIDCard($id = null)
    {
        $check_dupliaction_id = $this->login_model->check_by(array('pat_IdNum' => $id), 'tbl_patient');
        if (empty($check_dupliaction_id)) {
            $result = ['result' => [], 'response_code' => 1];
        } else {
            $result = ['result' => '<small style="padding-left:10px;color:red;font-size:14px">身份证号重复！</small>', 'response_code' => 0];
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($result));
    }

    public function forgetPassword()
    {
        $config = array(
            array(
                'field' => 'username',
                'label' => '手机号',
                'rules' => 'required|min_length[5]|max_length[12]',
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'rfpassword',
                'label' => 'Password Confirmation',
                'rules' => 'required|matches[password]',
            ),
            array(
                'field' => 'VerificationNum',
                'label' => 'Verify code',
                'rules' => 'required',
            ),
        );
        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == false) {
            return $this->output->set_content_type('application/json')
                ->set_output(json_encode(['message' => '提交错误!', 'data' => $this->form_validation->error_array(), 'response_code' => 0]));
        } else {
            $user_name = $this->input->post('username');
            $verify_code = $this->input->post('VerificationNum');
            $password = md5($this->input->post('password'));
            $check_verifity = array(
                'phonenum' => $user_name,
                'verify_code' => $verify_code,
            );
            if ($this->check_verify_code()) {
                $save_data = array(
                    'pat_id' => $user_name,
                    'pat_passwd' => $verify_code,
                );
                $this->db->set($save_data);
                $this->db->where('pat_id', $save_data->pat_id);
                $this->db->update('tbl_phone_verify');
                return $this->output->set_content_type('application/json')
                    ->set_output(json_encode(['message' => '改修密码成功了!', 'data' => [], 'response_code' => 1]));
            } else {
                return $this->output->set_content_type('application/json')
                    ->set_output(json_encode(['message' => '验证码错了!', 'data' => [], 'response_code' => 0]));
            }
        }
    }

    public function check_verify_code($check_verifity)
    {
        return count($query = $this->db->get_where('tbl_phone_verify', $check_verifity)->result());
    }

    public function test()
    {
        $this->load->model('pbooking_model');
        $booking = $this->pbooking_model->get_all();
        print_r($booking);
    }
}
