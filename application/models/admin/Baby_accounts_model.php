<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Baby_accounts_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function check_account_id_exists($account_no, $tableName)
    {
        $query = $this->db->select('*')
            ->from($tableName)
            ->where('accountNo', $account_no)
            ->get();
        $num = $query->num_rows();
        //  var_dump($num);
        if ($num == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_baby_accounts_settings_process($insertdata, $tableName)
    {

        $result = $this->db->insert($tableName, $insertdata);
        return $result;
    }

    public function baby_id_account_table($baby_accounts_info_table)
    {

        $this->load->dbforge();

        $fields = array(
            'Id' => array(
                'type' => 'INT',
                'constraint' => '5',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'entryDate' => array(
                'type' => 'date',
            ),
            'deposit' => array(
                'type' => 'double',
                'unsigned' => TRUE,
                'default' => '0',
            ),
            'withDraw' => array(
                'type' => 'double',
                'unsigned' => TRUE,
                'default' => '0',
            ),
            'balance' => array(
                'type' => 'varchar',
                'constraint' => '20',
            ),
            'comments' => array(
                'type' => 'varchar',
                'constraint' => '500',
            ));

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('Id', TRUE);
        $result = $this->dbforge->create_table($baby_accounts_info_table);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all_accounts(){
        $query = $this->db->select('*')
            ->from('baby_account_info')
            ->get();
        $result = $query->result_array();
        return $result;
    }

    public function get_account_id()
    {

        $query = $this->db->select('*')
            ->from('baby_account_info')
            ->get();
        $result = $query->result_array();
        return $result;
    }

    public function update_accounts_settings_process($updateData, $id){

        $result = $this->db->where('Id', $id)->update('baby_account_info', $updateData);
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

    public function add_new_baby_account_process($insertData, $tableName)
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

}
