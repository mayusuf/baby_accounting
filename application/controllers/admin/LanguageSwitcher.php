<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LanguageSwitcher extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('auth/admin_login_model');
    }

    function switchLang($language = "") {

        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        $this->update_language($language);

        redirect($_SERVER['HTTP_REFERER']);

    }

    function update_language($language){
        $Update_language = $this->admin_login_model->update_language($language);
    }
}