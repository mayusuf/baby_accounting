<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Account_settings extends Admin_Base_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('admin/account_settings_model');
    }


    // Create new account
    function create_new_account()
    {
        $this->data['page_title'] = 'Create new account';
        $this->data['breadcrumbs'] = 'new_account';
        $the_view = 'admin/pages/account_settings/create_new_account';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }

    // Create new account process
    public function create_new_account_process()
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
                $this->form_validation->set_rules("account_no", "Account Number", "trim|required|callback_account_number_check");
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

                    $exists = $this->account_settings_model->check_account_id_exists($account_no, $tableName);

                    if (!$exists) {
                        $response_array['type'] = 'danger';
                        $response_array['message'] = '<div class="alert alert-danger alert-dismissable"><strong>Sorry!</strong> Account Number <b>' . $account_no . '</b> already Exists </div>';
                        echo json_encode($response_array);
                    } else {


                        $insertData = array(
                            'accountNo' => trim($account_no),
                            'accountName' => trim($account_name),
                            'accountAddress' => trim($account_address),
                            'contactNo' => trim("88".$contact_no)
                        );


                    //    print_r($insertData);

                        $insertData = $this->security->xss_clean($insertData);

                        $results = $this->account_settings_model->create_new_account_process($insertData, $tableName);

                        if ($results) {

                            $baby_accounts_info_table = "baby_ld_account_" . $account_no;

                            $info_table = $this->account_settings_model->baby_id_account_table($baby_accounts_info_table);

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
	
	 public function account_number_check($str)
    {
        if (preg_match('/^[a-zA-Z0-9]+$/', $str)) {
            return TRUE;
        }else{
            $this->form_validation->set_message('account_number_check', 'The Account Number contains only characters and numbers. Not any special characters allowed');
            return FALSE;

        }

    }

    // Manage all accounts
    public function manage_accounts_settings()
    {
        $this->data['page_title'] = 'Manage all accounts';
        $this->data['breadcrumbs'] = 'manage_accounts';
        $this->data['all_accounts'] = $this->account_settings_model->get_all_accounts();
        $the_view = 'admin/pages/account_settings/manage_all_accounts';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }

    public function update_accounts_settings($id)
    {
        $this->data['page_title'] = 'Update Accounts Settings';
        $this->data['breadcrumbs'] = 'update_account';
        $this->data['account_no'] = $this->account_settings_model->get_single_account($id);
        $the_view = 'admin/pages/account_settings/edit_accounts_settings';
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

                    $results = $this->account_settings_model->update_accounts_settings_process($updateData, $id);

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


    // Sign out from admin panel
    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('', 'refresh');
    }
}

?>