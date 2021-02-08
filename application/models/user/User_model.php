<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    //get the admin profile
    function get_user_profile($email)
    {
        $query = $this->db->select('*')
            ->from('user')
                ->where('user_email',$email)
            ->get();
        $result = $query->result_array();
        return $result;
    }

} 