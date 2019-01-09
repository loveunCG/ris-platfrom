<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Outputs an array in a user-readable JSON format
 *
 * @param array $array
 */
if (!function_exists('display_json')) {
    function display_json($array)
    {
        $data = json_indent($array);

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        echo $data;
    }
}

if (!function_exists('check_role')) {
    function check_role($role = null)
    {
        $ci = &get_instance();
        $ci->load->model('report_model');
        $ci->load->library('session');
        $user_role = $ci->session->userdata('usr_role');
        if ($user_role == 1 || $user_role == 1024) {
            return true;
        } elseif ($role) {
            if ($ci->session->userdata($role)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}

if (!function_exists('get_user_name')) {
    function get_user_name($id = null)
    {
        $ci = &get_instance();
        $ci->load->model('admin_model');
        $usr_data = $ci->admin_model->get_userinfo(['usr_id' => $id]);
        if (isset($usr_data[0])) {
            return $usr_data[0]->usr_name;
        } else {
            return ' ';
        }
    }
}

if (!function_exists('is_check_join_contact')) {
    function is_check_join_contact($id = null)
    {
        $ci = &get_instance();
        $ci->load->model('contact_model');
        $ci->load->library('session');
        $user_id = $ci->session->userdata('id');
        $ci->report_model->_table_name = "tbl_contact_member"; //table name
        $ci->report_model->_order_by = "mem_id";
        $data = $ci->report_model->get_by(array('mem_doc_id' => $user_id, 'mem_contact_id' => $id), false);
        if (count($data) > 0) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('get_user_name_by_id')) {
    function get_user_name_by_id($id = null)
    {
        $ci = &get_instance();
        $ci->load->model('admin_model');
        $usr_data = $ci->admin_model->get_userinfo(['id' => $id]);
        if (isset($usr_data[0])) {
            return $usr_data[0]->usr_name;
        } else {
            return ' ';
        }
    }
}

if (!function_exists('get_user_role_by_id')) {
    function get_user_role_by_id($id = null)
    {
        $ci = &get_instance();
        $ci->load->model('admin_model');
        $usr_data = $ci->admin_model->get_userinfo(['id' => $id]);
        if (isset($usr_data[0])) {
            return $usr_data[0]->usr_role;
        } else {
            return false;
        }
    }
}

if (!function_exists('get_gender')) {
    function get_gender($id = null)
    {
        if ($id == 1) {
            return '男';
        } else {
            return '女';
        }
    }
}

if (!function_exists('get_socket_url')) {
    function get_socket_url()
    {
        $protocol = is_https() ? "https://" : "http://";
        $port = is_https() ? ":5004" : ":5007";
        return $protocol . $_SERVER['HTTP_HOST'] . $port;
    }
}

if (!function_exists('get_dicom_get_url')) {
    function get_dicom_get_url()
    {
        $protocol = is_https() ? "https://" : "http://";
        $port = is_https() ? ":5002" : ":5006";
        return $protocol . $_SERVER['HTTP_HOST'] . $port.'/getDicom';
    }
}

if (!function_exists('get_video_url')) {
    function get_video_url()
    {
        $protocol = is_https() ? "https://" : "https://";
        $port = is_https() ? ":5003" : ":5003";
        return $protocol . $_SERVER['HTTP_HOST'] . $port.'/';
    }
}

if (!function_exists('get_redirect_url')) {
    function get_redirect_url($roles, $isadmin)
    {
        $urls = [
            'isNewUser' => 'usermg',
            'isAvailableRole' => 'usermg',
            'isActivation' => 'usermg',
            'isEditableUser' => 'usermg',
            'isResetPasswordUser' => 'usermg',
            'isDeleteUser' => 'usermg',
            'isAvailablePatient' => 'usermg/patientMg',
            'isActivationPatient' => 'usermg/patientMg',
            'isDeletePatient' => 'usermg/patientMg',
            'isNewDevice' => 'usermg/equipment',
            'isActivationDevice' => 'usermg/equipment',
            'isEditableDevice' => 'usermg/equipment',
            'isAvailableDevice' => 'usermg/equipment',
            'isDeleteDevice' => 'usermg/equipment',
            'isNewItem' => 'usermg/checkmg',
            'isAvailableItemList' => 'usermg/checkmg',
            'isEditableItem' => 'usermg/checkmg',
            'isDeleteItem' => 'usermg/checkmg',
            'isNewHospital' => 'usermg/hospitalmg',
            'isAvailableHospital' => 'usermg/hospitalmg',
            'isEditableHospital' => 'usermg/hospitalmg',
            'isDeleteHospital' => 'usermg/hospitalmg',
            'isAvailableReview' => 'usermg/hosdelmg',
            'Booking' => 'booking/booking_checkup',
            'BookingTable' => 'booking/booking_listview',
            'Arrangement' => 'booking/consultation',
            'DicomView' => 'report',
            'MakeReport' => 'report',
            'upload_dicom' => 'report',
            'report_table' => 'report',
            'share_dicom' => 'report',
            'detail_report_view' => 'report',
            'edit_report' => 'report',
            'DiagnoseReport' => 'report',
            'IntelligentDiagnosis' => 'report',
            'RemoteDiagnosis' => 'report',
            'MyReport' => 'report/individual',
            'AuditReport' => 'report/delberation',
            'RemoteOutpatient' => 'contact/remote_contact',
            'remote_table' => 'contact/remote_contact',
            'InitiateConsultation' => 'contact/remote_contact',
            'RemoteConsultation' => 'contact/remote_contact',
            'MyAdvice' => '>contact/my_contact',
            'ContactStart' => 'contact/remote_contact',
            'RemoteConsultationReview' => 'contact/review',
            'DeliContact' => 'contact/review',
            'OnlineVideoTeaching' => 'school',
            'NewOnlineVideoTeaching' => 'school/my_school',
            'EditOnlineVideoTeaching' => 'school',
            'DeleteOnlineVideoTeaching' => 'school',
            'ExchangeDiscussionArea' => 'post',
            'DataSharing' => 'school/DataShareMg',
            'bookingStatistics' => 'statistics/bookingStatistics',
            'diagnosisStatistics' => 'statistics/diagnosisStatistics',
            'remoteStatistics' => 'statistics/remoteStatistics',
        ];
        if ($isadmin == 1 || $isadmin == 1024) {
            return 'usermg';
        } else {
            foreach ($urls as $key => $url) {
                foreach ($roles as $role) {
                    if ($key == $role->rle_name) {
                        return $url;
                    }
                }
            }
            return 'blank';
        }
    }
}
