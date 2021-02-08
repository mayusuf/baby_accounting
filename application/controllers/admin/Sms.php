<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Sms extends Admin_Base_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('admin/m_sms');
    }

    // show a from for filtering
    function index() {
        $this->data['page_title'] = 'SMS';
        $this->data['breadcrumbs'] = 'sms';
        $the_view = 'admin/v_sms';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }

    // send sms based on selected option

    function send_sms() {

        if ($this->input->post('submit') == "Submit") {

            $all_table_data = $this->m_sms->get_all_accounts();

//            echo "<pre>";
//            
//                 print_r($all_table_data);
//                 
//                 echo "<pre>";

                       
            foreach ($all_table_data as $record) {

                $tableName = "baby_ld_account_" . strtolower($record['accountNo']);

                $single_table_balance = $this->m_sms->get_last_balance($tableName);
                
                               
                if ($this->input->post('sms_payment_type') == 'get_money') {

                    if ($single_table_balance < 0) {

                        $this->sms_api($record['accountName'], $single_table_balance, $record['contactNo']);
                    }
                    
                } elseif ($this->input->post('sms_payment_type') == 'pay_money') {

                    if ($single_table_balance > 0) {

                        $this->sms_api($record['accountName'], $single_table_balance, $record['contactNo']);
                    }
                } else {

                    $this->sms_api($record['accountName'], $single_table_balance, $record['contactNo']);
                    
                }
            }
        }
    }

    function sms_api($name, $balance, $mobile_no) {

        
        $msg = '';
        
        // conver the message
        if ($balance < 0){
            
            $msg = str_replace ('#name#',$name,SMS1);
            $msg = str_replace ('#balance#',$balance,$msg);
            
        }elseif ($balance > 0){
            
            $msg = str_replace ('#name#',$name,SMS2);
            $msg = str_replace ('#balance#',$balance,$msg);
            
        }
        
       // echo $msg;
        
        $str = urlencode($msg);
        
        
        $url = "http://app.itsolutionbd.net/api/v3/sendsms//plain?user=YafiTech&password=12332112&sender=YafiTech&SMSText=" . $str . "&GSM=".$mobile_no;
        
        //exit();
        
        $ch = curl_init();
        
        //initialize curl handle
        curl_setopt($ch, CURLOPT_URL, $url);

        //set the url
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        //run the whole process and return the response
        $response = curl_exec($ch);

        //close the curl handle
        curl_close($ch);
        return;
    }

}

?>