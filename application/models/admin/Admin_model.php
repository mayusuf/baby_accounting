<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    //get the admin profile
    function get_admin_profile()
    {
        $query = $this->db->select('*')
            ->from('admin')
            ->get();
        $result = $query->result_array();
        return $result;
    }
    public function admin_password_change_process($change_password, $user_email){
        $result = $this->db->where('user_email', $user_email)->update('admin', $change_password);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all_table(){
        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.tables WHERE table_schema = 'baby_account' AND TABLE_NAME LIKE 'baby_ld_account_%'";
        $query = $this->db->query($sql);
        $result = $query->result_array($query);
        return $result;
    }

    public function get_all_id(){
        $query = $this->db->select('accountNo')
            ->from('baby_account_info')
            ->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_last_balance_each_table($tableName){

        $query = $this->db->select('Id')->order_by('Id', "desc")->limit(1)->get($tableName);
        $last_id = $query->result_array();
        //   var_dump($last_id[0]["Id"]);

        if ($last_id) {
            $Id = $last_id[0]["Id"];

            $query = $this->db->select('*')
                ->from($tableName)
                ->where('Id', $Id)
                ->get();
            $result = $query->result_array();
            return $result;
        } else {

            return false;
        }
    }

    // YEAR(CURDATE()) $current_year
    public function get_monthly_data_each_table($tableName){
        $sql = "SELECT DATE_FORMAT(`entryDate`,'%M') as Month, SUM(`deposit`) AS `Deposit`, SUM(`withDraw`) AS `Withdraw` FROM $tableName WHERE YEAR(`entryDate`) = YEAR(CURDATE())  GROUP BY DATE_FORMAT(`entryDate`,'%M') ORDER BY DATE_FORMAT(`entryDate`,'%m')";
        $query = $this->db->query($sql);
        $result = $query->result_array($query);
        return $result;
    }

} 