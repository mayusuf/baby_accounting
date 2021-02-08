<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    //get the username & password from tbl_usrs  md5($pwd)
    function get_admin($useremail, $userpass)
    {
        $sql = "select * from admin where user_email = '" . $useremail . "' and user_password = '" . md5($userpass) . "'";
        $query = $this->db->query($sql);

        $result = $query->result_array($query);
        // $result = $query->num_rows();
        //   var_dump($result);
        return $result;
    }



    function update_language($language){
        $Data = array('language' => trim($language));

        $result = $this->db->where('id', 2)->update('admin', $Data);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}