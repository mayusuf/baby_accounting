<?php

class Hybrid_user_model extends CI_Model {

    private $tablename = 'user';
    
            function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
   public function get_user_information($email) {

        $query = $this->db->select('*')
                ->from($this->tablename)
                ->where('user_email', $email)
                ->get();
   //     var_dump($email);
        $result = $query->result_array();
        return $result;
    }
    
    public function create_user($insert_data) {
        $result = $this->db->insert($this->tablename, $insert_data);
        return $result;        
    }
}