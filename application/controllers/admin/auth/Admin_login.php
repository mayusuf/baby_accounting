<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_login extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('auth/admin_login_model');
    }


    public function login()
    {

        if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/admin_dashboard', 'refresh');
        }

        //get the posted values
        $username = $this->input->post("username");
        $password = $this->input->post("password");

        //set validations
        $this->form_validation->set_rules("username", "Email", "trim|required");
        $this->form_validation->set_rules("password", "Password", "trim|required");

        if ($this->form_validation->run() == FALSE) {
            //validation fails
            //  $this->load->view('admin/auth/admin_login_view');
            $this->load->view('index');

        } else {
            //validation succeeds
            if ($this->input->post('submit') == "login") {
                //check if username and password is correct
                $usr_result = $this->admin_login_model->get_admin($username, $password);
                foreach ($usr_result as $key => $value) {

                    $username = $value['username'];
                    $user_email = $value['user_email'];
                    $site_lang = $value['language'];
                }

                $is_admin = count($usr_result);
                if ($is_admin > 0) { //active user record is present

                    $session_array = array(
                        'user_name' => $username,
                        'user_email' => $user_email,
                        'site_lang' => $site_lang,
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata('site_lang',$site_lang);
                    $this->session->set_userdata('admin_logged_in', $session_array);

                    redirect('admin/admin_dashboard', 'refresh');

                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Invalid username or password! </div>');
                    $this->load->view('index');
                }
            } else {
                $this->load->view('index');
            }
        }
    }


    public function logout()
    {

        $this->session->unset_userdata('admin_logged_in');
        session_destroy();
        session_unset();
        redirect('', 'refresh');
    }
} 