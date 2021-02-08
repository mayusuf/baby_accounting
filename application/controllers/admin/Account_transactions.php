<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Account_transactions extends Admin_Base_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/account_transactions_model');
    }


    // Create new transactions
    function create_new_transactions()
    {
        $this->data['page_title'] = 'Create new transactions';
        $this->data['breadcrumbs'] = 'new_transaction';
        $this->data['account_no'] = $this->account_transactions_model->get_account_id();
        $the_view = 'admin/pages/transactions/create_new_transaction';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }

    // Get the old balance
    function get_last_balance()
    {
        $table = $this->input->post('table_name');
        $table_name = 'baby_ld_account_' . $table;
        $last_balance = $this->account_transactions_model->get_old_balance($table_name);
        // var_dump($last_balance);
        if ($last_balance) {
            echo $last_balance[0]['balance'];
        } else {
            echo 0;
        }
    }

    // create new transactions process
    public function create_new_transaction_process()
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
                //   $this->form_validation->set_rules("comments", "Comments", "trim|required");


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
                    $datetime = new DateTime($transaction_date);
                    $entryDate = $datetime->format('Y-m-d');

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

                    $results = $this->account_transactions_model->create_new_transaction_process($insertData, $tableName);

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
                redirect('admin/admin_dashboard');
            }

        } else {
            redirect('admin/admin_dashboard');
        }
    }


    //Manage all transactions
    public function manage_all_transaction()
    {
        $this->data['page_title'] = 'Manage All Transaction';
        $this->data['breadcrumbs'] = 'manage_transaction';
        $this->data['account_no'] = $this->account_transactions_model->get_account_id();
        $the_view = 'admin/pages/transactions/manage_all_transaction';
        $template = 'admin_master_view';
        parent::render($the_view, $template);

    }

    public function get_table_transaction_information()
    {

        if ($this->input->is_ajax_request()) {

            $account_no = $this->input->post('account_no');

            $this->form_validation->set_rules("account_no", "Account Number", "trim|required");


            if ($this->form_validation->run() == FALSE) {

                echo '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i><strong> Please! </strong>  Choose an Account Number .</div>';

            } else {
                $serial = 1;
                $table_name = 'baby_ld_account_' . $account_no;
                $all_transaction = $this->account_transactions_model->get_all_transaction_single_table($table_name);
                if ($all_transaction) {
                    echo "<table id = 'all_accounts_transactions' class = 'table table-bordered table-hover'>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> Accounts No</th>
                            <th> Entry Date</th>
                            <th> Deposit</th>
                            <th> Withdraw</th>
                            <th> Balance</th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        ";

                    echo "</tbody>";

                    foreach ($all_transaction as $key => $value) {

                        $id = $value['Id'];
                        $entryDate = $value['entryDate'];
                        $deposit = $value['deposit'];
                        $withDraw = $value['withDraw'];
                        $balance = $value['balance'];
                        $edit_url = base_url('admin/account_transactions/update_transaction/' . $id . '/' . $account_no);


                        echo "<tr>";
                        echo "<td>" . $serial++ . "</td>";
                        echo "<td>" . $account_no . "</td>";
                        echo "<td>" . $entryDate . "</td>";
                        echo "<td>" . $deposit . "</td>";
                        echo "<td>" . $withDraw . "</td>";
                        echo "<td class=''>" . $balance . "</td>";
                        echo "<td style='text-align:center;'><a data-toggle='tooltip' class='btn btn-primary'  href='" . $edit_url . "' title='Edit'> <i class='fa fa-pencil-square-o'></i> </a>";
                        echo " <a data-toggle='tooltip' class='btn btn-danger deleteinformation'  id='" . $id . "' acc_no ='" . $account_no . "'  title='Delete'> <i class='fa fa-trash-o'></i> </a></td>";
                        echo "</tr>";
                    }

                    echo "</tbody>";
                    echo "<tfoot>
                            <th>#</th>
                            <th> Accounts No</th>
                            <th> Entry Date</th>
                            <th> Deposit</th>
                            <th> Withdraw</th>
                            <th> Balance</th>
                            <th> Action</th>
                         </tfoot>";
                    echo "</table>";


                } else {
                    echo '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i><strong> Sorry ! </strong>  No records have found .</div>';
                }
            }
        } else {
            redirect('admin/admin_dashboard');
        }

    }

    // Update the transactions
    public function update_transaction($id, $accounts_no)
    {
        $tableName = "baby_ld_account_" . $accounts_no;
        $this->data['page_title'] = 'Update transaction';
        $this->data['breadcrumbs'] = 'update_transaction';
        $this->data['account_no'] = $accounts_no;
        $this->data['old_balance'] = $this->account_transactions_model->get_old_balance($tableName);
        $this->data['present_id_data'] = $this->account_transactions_model->get_present_id_data($id, $tableName);
        $this->data['last_id_balance'] = $this->account_transactions_model->get_previous_id_data($id, $tableName);
        $the_view = 'admin/pages/transactions/edit_last_transactions';
        $template = 'admin_master_view';
        parent::render($the_view, $template);

    }

    // Update transactions process
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
                //      $this->form_validation->set_rules("comments", "Comments", "trim|required");


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
                    $datetime = new DateTime($transaction_date);
                    $entryDate = $datetime->format('Y-m-d');

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

                    $results = $this->account_transactions_model->update_transaction_process($updateData, $tableName, $updateId);

                    if ($results) {


                        $total_records = $this->account_transactions_model->get_last_total_records($tableName, $updateId);
                        //  $last_balance = $this->admin_model->get_last_balance($tableName, $id);

                        $total = count($total_records);
                        //  print_r($total);

                        if ($total > 0) {

                            foreach ($total_records as $records) {

                                $present_id = $records['Id'];
                                $present_deposit = $records['deposit'];
                                $present_withdraw = $records['withDraw'];
                                $last_records = $this->account_transactions_model->get_previous_id_data($present_id, $tableName);

                                if ($last_records) {
                                    $last_balance = $last_records[0]['balance'];
                                } else {
                                    $last_balance = 0;
                                }

                                if ($present_deposit == '0') {
                                    $new_balance = $last_balance - $present_withdraw;

                                } else {
                                    $new_balance = $last_balance + $present_deposit;
                                }

                                $updateData = array(
                                    'balance' => trim($new_balance)
                                );

                                $updateData = $this->security->xss_clean($updateData);

                                $tableName = 'baby_ld_account_' . $account_no;

                                $results = $this->account_transactions_model->update_transaction_process($updateData, $tableName, $present_id);

                            }

                        }

                        $response_array['type'] = 'success';
                        $response_array['message'] = '<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><strong> Congratulations! </strong>  Successfully Updated. </div>';
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

    // Delete a transactions process using ajax
    public function delete_accounts_transaction()
    {

        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $account_no = $this->input->post('account_no');
            $tableName = 'baby_ld_account_' . $account_no;
            $result = $this->account_transactions_model->delete_accounts_transaction($id, $tableName);
            if ($result) {

                $total_records = $this->account_transactions_model->get_last_total_records($tableName, $id);

                $total = count($total_records);

                if ($total > 0) {

                    foreach ($total_records as $records) {

                        $present_id = $records['Id'];
                        $present_deposit = $records['deposit'];
                        $present_withdraw = $records['withDraw'];
                        $last_records = $this->account_transactions_model->get_previous_id_data($present_id, $tableName);

                        if ($last_records) {
                            $last_balance = $last_records[0]['balance'];
                        } else {
                            $last_balance = 0;
                        }

                        if ($present_deposit == '0') {
                            $new_balance = $last_balance - $present_withdraw;

                        } else {
                            $new_balance = $last_balance + $present_deposit;
                        }

                        // print_r($new_balance);
                        $updateData = array(
                            'balance' => trim($new_balance)
                        );

                        $updateData = $this->security->xss_clean($updateData);

                        $tableName = 'baby_ld_account_' . $account_no;

                        $results = $this->account_transactions_model->update_transaction_process($updateData, $tableName, $present_id);

                    }

                }
                $response_array['type'] = 'success';
                $response_array['message'] = '<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><strong> Congratulations! </strong>  Successfully Deleted. </div>';
                echo json_encode($response_array);
            } else {
                $response_array['type'] = 'danger';
                $response_array['message'] = '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i><strong> Sorry! </strong>  Failed.</div>';
                echo json_encode($response_array);
            }

        } else {
            redirect('admin/admin_dashboard');
        }
    }

    // Reports
    public function account_transactions_reports()
    {
        $this->data['page_title'] = 'Baby Account Reports';
        $this->data['breadcrumbs'] = 'reports';
        $this->data['account_no'] = $this->account_transactions_model->get_account_id();
        $the_view = 'admin/pages/baby_accounts_reports';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }

    // Reports Process
    
    public function get_accounts_information()
    {

        if ($this->input->is_ajax_request()) {


            $account_no = $this->input->post('account_no');
            $start_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');

            $this->form_validation->set_rules("account_no", "Account Number", "trim|required");


            if ($this->form_validation->run() == FALSE) {

                echo '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i><strong> Please! </strong>  Choose an Account Number .</div>';


            } else {

                $details_inf = $this->account_transactions_model->get_account_details_inf($account_no);

                foreach ($details_inf as $key => $baby_details) {

                    $baby_name = $baby_details['accountName'];
                    $baby_account_no = $baby_details['accountNo'];
                    $accountAddress = $baby_details['accountAddress'];
                    $contactNo = $baby_details['contactNo'];
                }

                $table_name = 'baby_ld_account_' . $account_no;

                $amount_inf = $this->account_transactions_model->get_transaction_reports($table_name, $start_date, $end_date);
                // var_dump($amount_inf);


                if ($amount_inf) {
//
// echo "<input type='button' class='btn btn-default btn-icon icon-left hidden-print pull-right' onClick='PrintElem();' value='Print Invoice'/>
                    echo "<input type='button' id='btn' class='btn btn-success pull-right' value='Print The Invoice' style='margin-top: 20px;' onClick='PrintElem();'>
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
            redirect('admin/admin_dashboard');
        }
    }

    // Sign out from admin panel
    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('', 'refresh');
    }


}
