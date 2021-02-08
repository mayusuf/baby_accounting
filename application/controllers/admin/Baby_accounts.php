<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Baby_accounts extends Admin_Base_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/baby_accounts_model');
    }


    // New accounts settings
    function baby_accounts_settings()
    {

        $data = array();
        $this->data['page_title'] = 'Baby Accounts Settings';
        $this->data['breadcrumbs'] = 'new_account';
        $the_view = 'admin/pages/accounts_settings';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }

    // insert baby accounts settings
    public function insert_baby_accounts_settings_process()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {

            if ($this->input->post('submit') == "Save") {

                $account_no = $this->input->post('account_no');
                $account_name = $this->input->post('account_name');
                $account_address = $this->input->post('account_address');
                $contact_no = $this->input->post('contact_no');
                $tableName = 'baby_account_info';


                //set validations
                $this->form_validation->set_rules("account_no", "Account Number", "trim|required");
                $this->form_validation->set_rules("account_name", "Account Name", "trim|required");
                $this->form_validation->set_rules("account_address", "Address", "trim|required");
                $this->form_validation->set_rules("contact_no", "Contact Number", "trim|required");


                if ($this->form_validation->run() == FALSE) {
                    $errors = array();
                    foreach ($this->input->post() as $key => $value) {
                        $errors[$key] = form_error($key);
                    }
                    $response_array['errors'] = array_filter($errors);

                    $response_array['type'] = 'danger';
                    $response_array['message'] = '<i class="icon fa fa-times"></i> <strong class="alert  alert-dismissable"> Sorry!  Validation errors occurs. </strong>';
                    echo json_encode($response_array);


                } else {


                    $exists = $this->baby_accounts_model->check_account_id_exists($account_no, $tableName);

                    if (!$exists) {
                        $response_array['type'] = 'danger';
                        $response_array['message'] = '<div class="alert alert-danger alert-dismissable"><strong>Sorry!</strong> Account Number <b>' . $account_no . '</b> already Exists </div>';
                        echo json_encode($response_array);
                    } else {


                        $insertData = array(
                            'accountNo' => trim($account_no),
                            'accountName' => trim($account_name),
                            'accountAddress' => trim($account_address),
                            'contactNo' => trim($contact_no)
                        );

                        $insertData = $this->security->xss_clean($insertData);

                        $results = $this->baby_accounts_model->insert_baby_accounts_settings_process($insertData, $tableName);

                        if ($results) {

                            $baby_accounts_info_table = "baby_ld_account_" . $account_no;

                            $info_table = $this->baby_accounts_model->baby_id_account_table($baby_accounts_info_table);

                            if ($info_table) {
                                $response_array['type'] = 'success';
                                $response_array['message'] = '<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><strong>  Congratulations! </strong> Account Created  Successfully. </div>';
                                echo json_encode($response_array);
                            } else {

                                $response_array['type'] = 'danger';
                                $response_array['message'] = '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i><strong> Sorry! </strong>  Failed.</div>';
                                echo json_encode($response_array);
                            }
                        } else {
                            $response_array['type'] = 'danger';
                            $response_array['message'] = '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i><strong> Sorry! </strong>  Failed.</div>';
                            echo json_encode($response_array);
                        }
                    }
                }
            } else {
                redirect('admin/admin_dashboard');
            }
        } else {
            redirect('admin/admin_dashboard');
        }
    }

    public function manage_accounts_settings()
    {

        $data = array();
        $this->data['page_title'] = 'Manage Accounts';
        $this->data['breadcrumbs'] = 'manage_accounts';
        $this->data['all_accounts'] = $this->baby_accounts_model->get_all_accounts();
        $the_view = 'admin/pages/manage_all_accounts';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }

    public function update_accounts_settings($id)
    {

        $data = array();
        $this->data['page_title'] = 'Update Accounts Settings';
        $this->data['breadcrumbs'] = 'update_account';
        $this->data['account_no'] = $this->baby_accounts_model->get_single_account($id);
        $the_view = 'admin/pages/edit_accounts_settings';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }

    public function update_accounts_settings_process()
    {

        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {

            if ($this->input->post('submit') == "Update") {


                $id = $this->input->post('updateId');
                $account_name = $this->input->post('account_name');
                $account_address = $this->input->post('account_address');
                $contact_no = $this->input->post('contact_no');


                //set validations
                $this->form_validation->set_rules("account_name", "Account Name", "trim|required");
                $this->form_validation->set_rules("account_address", "Address", "trim|required");
                $this->form_validation->set_rules("contact_no", "Contact Number", "trim|required");


                if ($this->form_validation->run() == FALSE) {
                    $errors = array();
                    foreach ($this->input->post() as $key => $value) {
                        $errors[$key] = form_error($key);
                    }
                    $response_array['errors'] = array_filter($errors);

                    $response_array['type'] = 'danger';
                    $response_array['message'] = '<i class="icon fa fa-times"></i> <strong class="alert  alert-dismissable"> Sorry!  Validation errors occurs. </strong>';
                    echo json_encode($response_array);


                } else {
                    $updateData = array(
                        'accountName' => trim($account_name),
                        'accountAddress' => trim($account_address),
                        'contactNo' => trim($contact_no)
                    );

                    $updateData = $this->security->xss_clean($updateData);

                    $results = $this->baby_accounts_model->update_accounts_settings_process($updateData, $id);

                    if ($results) {
                        $response_array['type'] = 'success';
                        $response_array['message'] = '<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><strong>  Congratulations! </strong> Account Created  Successfully. </div>';
                        echo json_encode($response_array);
                    } else {

                        $response_array['type'] = 'danger';
                        $response_array['message'] = '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i><strong> Sorry! </strong>  Failed.</div>';
                        echo json_encode($response_array);
                    }

                }
            } else {
                redirect('admin/admin_dashboard');
            }
        } else {
            redirect('admin/admin_dashboard');
        }

    }

    // add New account
    function add_new_baby_account()
    {

        $data = array();
        $this->data['page_title'] = 'Add New Baby Account';
        $this->data['breadcrumbs'] = 'new_transaction';
        $this->data['account_no'] = $this->baby_accounts_model->get_account_id();
        $the_view = 'admin/pages/add_new_accounts';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }

    function get_last_balance()
    {

        $table = $this->input->post('table_name');
        $table_name = 'baby_ld_account_' . $table;
        $last_balance = $this->baby_accounts_model->get_old_balance($table_name);
        // var_dump($last_balance);
        if ($last_balance) {
            echo $last_balance[0]['balance'];
        } else {
            echo 0;
        }
    }

    // insert baby accounts settings
    public function add_new_baby_account_process()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {

            if ($this->input->post('submit') == "Save") {

                $account_no = $this->input->post('account_no');
                $account_action = $this->input->post('account_action');
                $amount = $this->input->post('amount');
                $balance = $this->input->post('new_balance');
                $transaction_date = $this->input->post('transaction_date');
                $comments = $this->input->post('comments');

                //set validations
                $this->form_validation->set_rules("account_no", "Account Number", "trim|required");
                $this->form_validation->set_rules("account_action", "Account Action", "trim|required");
                $this->form_validation->set_rules("amount", "Amount", "trim|required");
                $this->form_validation->set_rules("comments", "Comments", "trim|required");


                if ($this->form_validation->run() == FALSE) {
                    $errors = array();
                    foreach ($this->input->post() as $key => $value) {
                        $errors[$key] = form_error($key);
                    }
                    $response_array['errors'] = array_filter($errors);

                    $response_array['type'] = 'danger';
                    $response_array['message'] = '<i class="icon fa fa-times"></i> <strong class="alert  alert-dismissable"> Sorry!  Validation errors occurs. </strong>';
                    echo json_encode($response_array);


                } else {

                    date_default_timezone_set("Asia/Dhaka");
                    $entryDate = $transaction_date; //. ''. date('h:i:s');

                    if ($account_action == 'deposit') {

                        $deposit = $amount;
                        $withdraw = 0;
                    } else {
                        $withdraw = $amount;
                        $deposit = 0;
                    }


                    $insertData = array(
                        'deposit' => trim($deposit),
                        'withDraw' => trim($withdraw),
                        'balance' => trim($balance),
                        'comments' => trim($comments),
                        'entryDate' => trim($entryDate)
                    );

                    $insertData = $this->security->xss_clean($insertData);

                    $tableName = 'baby_ld_account_' . $account_no;

                    $results = $this->baby_accounts_model->add_new_baby_account_process($insertData, $tableName);

                    if ($results) {

                        $response_array['type'] = 'success';
                        $response_array['message'] = '<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><strong> Congratulations! </strong> Added  Successfully. </div>';
                        echo json_encode($response_array);
                    } else {

                        $response_array['type'] = 'danger';
                        $response_array['message'] = '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i><strong> Sorry! </strong>  Failed.</div>';
                        echo json_encode($response_array);
                    }
                }
            } else {
                redirect('admin_dashboard');
            }

        } else {
            redirect('admin_dashboard');
        }
    }


    public function manage_all_transaction(){
        $data = array();
        $this->data['page_title'] = 'Manage All Transaction';
        $this->data['breadcrumbs'] = 'manage_transaction';
        $all_table_id = $this->baby_accounts_model->get_all_accounts();
        foreach ($all_table_id as $table_id)
        {

            $tableName = "baby_ld_account_" . $table_id['accountNo'];
            // $tableName = $table['TABLE_NAME'];
            //  print_r($tableName);
            $last_records = $this->baby_accounts_model->get_old_balance($tableName);
            // $this->data['last_balance'] = $last_balances;
             // print_r($last_records);
            if($last_records){
                foreach ($last_records as $key => $value)
                {
                    $last_data_records[] = $value;
                    $all_table[] = $table_id['accountNo'];

                }
            }


        }
        $this->data['last_data_records'] = $last_data_records;
        $this->data['accounts_table'] = $all_table;
        $the_view = 'admin/pages/manage_all_transaction';
        $template = 'admin_master_view';
        parent::render($the_view, $template);

    }

    public function update_transaction($id,$accounts_no){
        $data = array();
        $tableName = "baby_ld_account_" .$accounts_no;
        $this->data['page_title'] = 'Update Last Transaction';
        $this->data['breadcrumbs'] = 'update_transaction';
        $this->data['account_no'] = $accounts_no;
        $this->data['last_records'] = $this->baby_accounts_model->get_table_last_records($id,$tableName);
        $the_view = 'admin/pages/edit_last_transactions';
        $template = 'admin_master_view';
        parent::render($the_view, $template);

    }

    public function update_transaction_process()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {

            if ($this->input->post('submit') == "Update") {

                $updateId = $this->input->post('updateId');
                $account_no = $this->input->post('account_no');
                $account_action = $this->input->post('account_action');
                $amount = $this->input->post('amount');
                $balance = $this->input->post('new_balance');
                $transaction_date = $this->input->post('transaction_date');
                $comments = $this->input->post('comments');

                //set validations
                $this->form_validation->set_rules("account_no", "Account Number", "trim|required");
                $this->form_validation->set_rules("account_action", "Account Action", "trim|required");
                $this->form_validation->set_rules("amount", "Amount", "trim|required");
                $this->form_validation->set_rules("comments", "Comments", "trim|required");


                if ($this->form_validation->run() == FALSE) {
                    $errors = array();
                    foreach ($this->input->post() as $key => $value) {
                        $errors[$key] = form_error($key);
                    }
                    $response_array['errors'] = array_filter($errors);

                    $response_array['type'] = 'danger';
                    $response_array['message'] = '<i class="icon fa fa-times"></i> <strong class="alert  alert-dismissable"> Sorry!  Validation errors occurs. </strong>';
                    echo json_encode($response_array);


                } else {

                    date_default_timezone_set("Asia/Dhaka");
                    $entryDate = $transaction_date; //. ''. date('h:i:s');

                    if ($account_action == 'deposit') {

                        $deposit = $amount;
                        $withdraw = 0;
                    } else {
                        $withdraw = $amount;
                        $deposit = 0;
                    }


                    $updateData = array(
                        'deposit' => trim($deposit),
                        'withDraw' => trim($withdraw),
                        'balance' => trim($balance),
                        'comments' => trim($comments),
                        'entryDate' => trim($entryDate)
                    );

                    $updateData = $this->security->xss_clean($updateData);

                    $tableName = 'baby_ld_account_' . $account_no;

                    $results = $this->baby_accounts_model->update_transaction_process($updateData, $tableName,$updateId);

                    if ($results) {

                        $response_array['type'] = 'success';
                        $response_array['message'] = '<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><strong> Congratulations! </strong> Added  Successfully. </div>';
                        echo json_encode($response_array);
                    } else {

                        $response_array['type'] = 'danger';
                        $response_array['message'] = '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i><strong> Sorry! </strong>  Failed.</div>';
                        echo json_encode($response_array);
                    }
                }
            } else {
                redirect('admin_dashboard');
            }

        } else {
            redirect('admin_dashboard');
        }
    }
    //Reports
    public function baby_accounts_reports()
    {
        $data = array();
        $this->data['page_title'] = 'Baby Account Reports';
        $this->data['breadcrumbs'] = 'reports';
        $this->data['account_no'] = $this->baby_accounts_model->get_account_id();
        $the_view = 'admin/pages/baby_accounts_reports';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }

    //Reports
    public function baby_accounts_reports_process()
    {

        if ($this->input->post('submit') == "Submit") {

            $account_no = $this->input->post('account_no');
            $table_name = 'baby_ld_account_' . $account_no;

            $data = array();
            $this->data['page_title'] = 'Baby Account Reports';
            $this->data['breadcrumbs'] = 'Baby Account Reports';
            $this->data['account_no'] = $this->baby_accounts_model->get_account_id();
            $this->data['details_inf'] = $this->baby_accounts_model->get_account_details_inf($account_no);
            $this->data['amount_inf'] = $this->baby_accounts_model->get_old_balance($table_name);
            $the_view = 'admin/pages/baby_accounts_reports_view';
            $template = 'admin_master_view';
            parent::render($the_view, $template);
        } else {
            redirect('admin_dashboard');
        }
    }

    function pdf()
    {
        $this->load->helper('pdf_helper');
        $data = array();
        $data['title'] = 'Baby Account Reports';
        $data['widget'] = $this->widget();
        $this->load->view('pdfreport', $data);
    }

    public function create_reports()
    {
        $data = array();
        $data['title'] = 'Baby Account Reports';
        $data['widget'] = $this->widget();
        $data['account_no'] = $this->baby_accounts_model->get_account_id();
        $this->load->view('baby_accounts/accounts_reports', $data);
    }

    public function get_accounts_information()
    {

        if ($this->input->is_ajax_request()) {


            $account_no = $this->input->post('account_no');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');


            //  var_dump($account_no);
            //set validations
            $this->form_validation->set_rules("account_no", "Account Number", "trim|required");


            if ($this->form_validation->run() == FALSE) {

                echo '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i><strong> Please! </strong>  Choose an Account Number .</div>';


            } else {

                $details_inf = $this->baby_accounts_model->get_account_details_inf($account_no);

                foreach ($details_inf as $key => $baby_details) {

                    $baby_name = $baby_details['accountName'];
                    $baby_account_no = $baby_details['accountNo'];
                    $accountAddress = $baby_details['accountAddress'];
                    $contactNo = $baby_details['contactNo'];
                }

                $table_name = 'baby_ld_account_' . $account_no;

                $amount_inf = $this->baby_accounts_model->get_transaction_reports($table_name, $start_date, $end_date);
                // var_dump($amount_inf);


                if ($amount_inf) {
//
// echo "<input type='button' class='btn btn-default btn-icon icon-left hidden-print pull-right' onClick='PrintElem();' value='Print Invoice'/>
                    echo "<input type='button' id='btn' class='btn btn-success pull-right' value='Print The Invoice' style='margin-top: 20px;' onClick='printContent();'>
      <div class='col-md-12 table-responsive panel-body' id='invoice_print'>
      <h3 style='text-align: center;'> Account Name : $baby_name </h3>
      <h4 style='text-align: center;'>Account Number : $baby_account_no </h4>
      <p style='text-align: center;'>$accountAddress </p>
      <p style='text-align: center;'>Contact Number : $contactNo </p>
         <table id='Accounts_invoice' class='ui celled table table-bordered table-hover'>
                        <thead>
                               <tr>
                                    <th> Entry Date </th>
                                    <th> Deposit </th>
                                    <th> Withdraw </th>
                                    <th> Balance</th>
                               </tr>
                        </thead>
                        ";

                    echo "</tbody>";
                    foreach ($amount_inf as $key => $transaction) {

                        $entryDate = $transaction['entryDate'];
                        $deposit = $transaction['deposit'];
                        $withDraw = $transaction['withDraw'];
                        $balance = $transaction['balance'];


                        echo "<tr>";
                        echo "<td class=''>" . $entryDate . "</td>";
                        echo "<td class=''>" . $deposit . "</td>";
                        echo "<td class=''>" . $withDraw . "</td>";
                        echo "<td class=''>" . $balance . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "<tfoot>
                               <tr>
                                    <th> Entry Date </th>
                                    <th> Deposit </th>
                                    <th> Withdraw </th>
                                    <th> Balance</th>
                               </tr>
                 </tfoot>";
                    echo "</table></div>";

                } else {
                    echo '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i><strong> Sorry ! </strong>  No records have found .</div>';
                }


            }
        } else {
            redirect('admin_dashboard');
        }
    }

    // Signout from admin pannel
    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('', 'refresh');
    }

    // pagination function

    function get_pagination($tablename, $cntrlFunctioname, $perPage)
    {

        // pagination code start
        $this->load->library('pagination'); //load pagination library
        $config['base_url'] = base_url('admin_dashboard/' . $cntrlFunctioname);
        $config['total_rows'] = $this->db->get($tablename)->num_rows();
        $config['enable_query_strings'] = TRUE;
        $config['use_page_numbers'] = TRUE;
        $config['query_string_segment'] = 'page';
        $config['page_query_string'] = TRUE;
        $config['per_page'] = $perPage;
        $config['num_links'] = 2;
        $config['full_tag_open'] = '<ul class="pagination no-margin">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['next_link'] = 'Next >';
        $config['prev_link'] = '< Previous';
        $config['last_link'] = 'Last >';
        $config['first_link'] = '< First';

        return $config;
    }

}

?>