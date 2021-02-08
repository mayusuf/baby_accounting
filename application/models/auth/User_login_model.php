<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_login_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    //get the username & password from tbl_usrs  md5($pwd)
    function get_user($useremail, $userpass)
    {
        $sql = "select * from user where user_email = '" . $useremail . "' and user_password = '" . md5($userpass) . "'";
        $query = $this->db->query($sql);
        $result = $query->num_rows();
        //   var_dump($result);
        return $result;
    }

}