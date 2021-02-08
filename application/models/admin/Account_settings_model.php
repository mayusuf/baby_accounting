<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Account_settings_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Check account number either exists
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

    // Create new account process
    public function create_new_account_process($insertData, $tableName)
    {
        $result = $this->db->insert($tableName, $insertData);
        return $result;
    }

    // Creating account id table
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

    // Get all accounts information
    public function get_all_accounts()
    {
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

    // Update account settings process
    public function update_accounts_settings_process($updateData, $id)
    {
        $result = $this->db->where('Id', $id)->update('baby_account_info', $updateData);
        return $result;
    }

    // Get single records from a table
    public function get_single_account($id)
    {
        $query = $this->db->select('*')
            ->from('baby_account_info')
            ->where('Id', $id)
            ->get();
        $result = $query->result_array();
        return $result;
    }

}