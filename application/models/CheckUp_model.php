<?php
class CheckUp_model extends MY_ORM_Model
{
    public function __construct()
    {
        $this->table = 'tbl_check_list';
        $this->primary_key = 'chc_id';
        $this->soft_deletes = true;
        $this->has_one['booking'] = array('local_key'=>'chc_booking_id', 'foreign_key'=>'booking_id', 'foreign_model'=>'PBooking_model');
        parent::__construct();
    }
}
