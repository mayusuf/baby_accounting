<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends Admin_Base_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/admin_model');
    }


    // Dashboard Page
    public function index()
    {
        $last_balance = array();
        $this->data['page_title'] = 'Admin Dashboard';
        $all_table_id = $this->admin_model->get_all_id();

        foreach ($all_table_id as $table_id) {
            $tableName = "baby_ld_account_" . $table_id['accountNo'];
            $last = $this->admin_model->get_last_balance_each_table($tableName);
            if ($last) {
                foreach ($last as $key => $value) {
                    $last_balance[] = $value['balance'];

                }
            }
        }

        foreach ($all_table_id as $table_id) {

            $tableName = "baby_ld_account_" . $table_id['accountNo'];

            $single_table_monthly_data = $this->admin_model->get_monthly_data_each_table($tableName);
            $all_table_monthly_data[] = $single_table_monthly_data;
        }

        //  print_r($last_balance);
        $this->data['all_table_monthly_data'] = $all_table_monthly_data;
        $this->data['last_balances'] = $last_balance;
        $this->data['breadcrumbs'] = 'dashboard';
        $this->data['message'] = 'hello how are you';
        $the_view = 'admin/admin_dashboard';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }


    // Bar Chart ajax call from dashboard
    public function yearly_bar_chart()
    {
        $all_table_id = $this->admin_model->get_all_id();

        //  print_r($current_year);

        foreach ($all_table_id as $table_id) {
            $tableName = "baby_ld_account_" . $table_id['accountNo'];
            $single_table_monthly_data = $this->admin_model->get_monthly_data_each_table($tableName);
            $all_table_monthly_data[] = $single_table_monthly_data;
        }

        $all_table_monthly_data_result = array_reduce(
            array_reduce($all_table_monthly_data, 'array_merge', []), // Flattern array.
            function ($result, $item) {
                $Month = "";
                $Deposit = "";
                $Withdraw = "";
                extract($item);

// If there's no entry for current month - create emtpy entry.
                if (!isset($result[$Month])) {

                    $result[$Month] = [
                        'Month' => $Month,
                        'Deposit' => 0,
                        'Withdraw' => 0];
                }

          // Add current amounts.
                $result[$Month]['Deposit'] += $Deposit;
                $result[$Month]['Withdraw'] += $Withdraw;

                return $result;

            },
            []
        );

        usort($all_table_monthly_data_result, function ($a, $b) {
            return date_parse($a['Month'])["month"] - date_parse($b['Month'])["month"];
        });

         foreach ($all_table_monthly_data_result as $key => $value) {
            $data[] = $value;
        }

        echo json_encode($data);

    }


    // Administrator Profile page
    public function profile()
    {
        $this->data['page_title'] = 'Admin Profile';
        $this->data['breadcrumbs'] = 'admin_profile';
        $this->data['admin_information'] = $this->admin_model->get_admin_profile();
        $the_view = 'admin/admin_profile';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }


    // Admin Profile & Password change Page
    public function admin_password_change()
    {
        $this->data['page_title'] = 'Change Password';
        $this->data['breadcrumbs'] = 'change_password';
        $this->data['admin_information'] = $this->admin_model->get_admin_profile();
        $the_view = 'admin/admin_password_change';
        $template = 'admin_master_view';
        parent::render($the_view, $template);
    }


    // Admin Profile & Password change Page ajax Process
    public function admin_profile_update_process()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {
            if ($this->input->post('submit') == "Update") {

                $id = $this->input->post('updateId');
                $user_email = $this->input->post('user_email');
                $password = $this->input->post('password');
                $file_path = $this->input->post('SelectedFileName');
                $uploadOk = 1;

                // var_dump($_FILES);

                if (!empty($_FILES)) {

                    $new_file = $_FILES["blog_image"]["name"];
                } else {
                    $new_file = "";
                }

                if (!empty($new_file)) {
                    $config['upload_path'] = './assets/images/credit/';    // APPPATH . 'assets/uploads/';   //'./assets/uploads/';
                    $config['allowed_types'] = 'jpg|jpeg|png';
                    $config['max_size'] = 5000;
                    $config['max_width'] = 1200;
                    $config['max_height'] = 700;
                    $time = time();
                    $config['file_name'] = $time;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('blog_image')) {

                        $uploadOk = 0;
                        $errors = $this->upload->display_errors('', '');
                        $response_array['type'] = 'danger';
                        $response_array['message'] = '<i class="icon fa fa-warning"></i> <strong class="alert  alert-dismissable">' . $errors . '</strong>';

                    } else {

                        $data = $this->upload->data();
                        $file_path = 'assets/images/credit/' . $time . $data['file_ext'];
                        $uploadOk = 1;
                    }
                }


                if ($uploadOk == 0) {
                    $response_array['type'] = 'danger';
                    $response_array['message'] = $response_array['message']; //'<i class="icon fa fa-times"></i> <strong class="alert  alert-dismissable">' . $response_array['message']. '</strong>';
                    echo json_encode($response_array);
                    // if everything is ok, try to upload file
                } else {

                    $updateData = array(
                        'file_path' => trim($file_path),
                        'user_password' => md5($password)
                    );


                    $updateData = $this->security->xss_clean($updateData);

                    $results = $this->admin_model->admin_password_change_process($updateData, $user_email);

                    if ($results) {

                        $response_array['type'] = 'success';
                        $response_array['message'] = '<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><strong>  Congratulations! </strong> Profile Updated Successfully. </div>';
                        echo json_encode($response_array);

                    } else {
                        $response_array['type'] = 'danger';
                        $response_array['message'] = '<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-times"></i><strong> Sorry! </strong>  Failed.</div>';
                        echo json_encode($response_array);
                    }
                }
            } else {
                redirect('admin/admin_dashboard', 'refresh');
            }

        } else {
            redirect('admin/admin_dashboard', 'refresh');
        }
    }


} 