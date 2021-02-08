<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = array();

    function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Codeigniter';
        $this->data['before_head'] = '';
        $this->data['before_body'] = '';
    }

    protected function admin_render($the_view = NULL, $template = 'admin_master_view')
    {
        if ($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        } else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            //  var_dump($this->data['the_view_content']);
            $this->load->view('admin/layout/' . $template, $this->data);
        }
    }

    protected function user_render($the_view = NULL, $template = 'admin_master_view')
    {
        if ($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        } else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            //  var_dump($this->data['the_view_content']);
            $this->load->view('admin/layout/' . $template, $this->data);
        }
    }
}

class Admin_Base_Controller extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/auth/admin_login/login');
        }
        $this->data['page_title'] = 'Admin Account Login';
    }

    protected function render($the_view = NULL, $template = 'admin_master_view')
    {
        if ($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        } else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);
            //  var_dump($this->data['the_view_content']);
            $this->load->view('admin/layout/' . $template, $this->data);
        }
    }
}
