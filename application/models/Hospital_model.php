<?php
class Hospital_model extends ORM_Model
{
    public function __construct()
    {
        $this->table = 'tbl_hospital';
        $this->primary_key = 'id';
        $this->soft_deletes = true;
        $this->has_one['details'] = array('local_key'=>'id', 'foreign_key'=>'user_id', 'foreign_model'=>'User_details_model');
        $this->has_many['posts'] = 'Post_model';
        parent::__construct();
    }
}
