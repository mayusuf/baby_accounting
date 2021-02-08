<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Account_transactions_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Get all account records from main table
    public function get_all_accounts(){
        $query = $this->db->select('*')
            ->from('baby_account_info')
            ->get();
        $result = $query->result_array();
        return $result;
    }

    // Get all account number from main table
    public function get_account_id()
    {
        $query = $this->db->select('*')
            ->from('baby_account_info')
            ->get();
        $result = $query->result_array();
        return $result;
    }


    public function get_single_account($id){
        $query = $this->db->select('*')
            ->from('baby_account_info')
            ->where('Id', $id)
            ->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_old_balance($table_name)
    {

        $query = $this->db->select('Id')->order_by('Id', "desc")->limit(1)->get($table_name);
        $last_id = $query->result_array();
        //   var_dump($last_id[0]["Id"]);

        if ($last_id) {
            $Id = $last_id[0]["Id"];

            $query = $this->db->select('*')
                ->from($table_name)
                ->where('Id', $Id)
                ->get();
            $result = $query->result_array();
            return $result;
        } else {

            return false;
        }
    }

    public function create_new_transaction_process($insertData, $tableName)
    {

        $result = $this->db->insert($tableName, $insertData);
        return $result;
    }

    //      var_dump($last_id);


    public function get_account_details_inf($account_no)
    {

        $query = $this->db->select('*')
            ->from('baby_account_info')
            ->where('accountNo', $account_no)
            ->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_table_last_records($id,$tableName){
        $query = $this->db->select('*')
            ->from($tableName)
            ->where('Id', $id)
            ->get();
        $result = $query->result_array();
        return $result;
    }

    public function update_transaction_process($updateData, $tableName,$updateId){
        $result = $this->db->where('Id', $updateId)->update($tableName, $updateData);
        return $result;
    }

    public function get_transaction_reports($table_name, $start_date, $end_date)
    {


        if ($start_date != '' && $end_date != '') {

            $start_date = $start_date; //. ' 00:00:00';
            $end_date = $end_date; //. ' 23:59:59';


            $query = $this->db->select('*')
                ->from($table_name)
                ->where('entryDate >=', $start_date)
                ->where('entryDate <=', $end_date)
                ->order_by('Id', 'desc')
                ->limit(30)
                ->get();

            //   var_dump($query);

            $result = $query->result_array();
            return $result;
        } else {

            $query = $this->db->select('*')
                ->from($table_name)
                ->order_by('Id', 'desc')
                ->limit(30)
                ->get();
            $result = $query->result_array();
            return $result;
        }


    }

    public function get_all_transaction_single_table($table_name){

        $query = $this->db->select('*')
            ->from($table_name)
            ->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_last_total_records($tableName, $id){
        $query = $this->db->select('*')
            ->from($tableName)
            ->where('Id >', $id)
            ->order_by('Id', "asc")
            ->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_last_balance($tableName, $id)
    {

        $query = $this->db->select('balance')
            ->from($tableName)
            ->where('Id', $id)
            ->get();
        $result = $query->result_array();
        return $result;

    }

    public function get_present_id_data($id, $tableName){
        $query = $this->db->select('*')
            ->from($tableName)
            ->where('Id', $id)
            ->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_next_id_data($id,$tableName){
        $query = $this->db->select('*')->where('Id >', $id)->order_by('Id', "asc")->limit(1)->get($tableName);
        $result = $query->result_array();
        return $result;
    }
    public function get_previous_id_data($id,$tableName){
        $query = $this->db->select('balance')->where('Id <', $id)->order_by('Id', "desc")->limit(1)->get($tableName);
        $result = $query->result_array();
        return $result;
    }

    public function delete_accounts_transaction($id,$tableName){
        $result = $this->db->delete($tableName, array('Id' => $id));
        return $result;
    }

}
