<?php
class PBooking_model extends ORM_Model
{
    public function __construct()
    {
        $this->table = 'tbl_patient_booking';
        $this->primary_key = 'booking_id';
        $this->soft_deletes = true;
        $this->has_many['checkup'] =  array('foreign_model'=>'CheckUp_model','foreign_key'=>'chc_booking_id','another_local_key'=>'booking_id');
        parent::__construct();
    }
}
