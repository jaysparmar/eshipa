<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Epoints extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation', 'upload']);
        $this->load->helper(['url', 'language', 'file']);
        $this->load->model('Customer_model');

    }

    public function index()
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            $this->data['main_page'] = TABLES . 'manage-epoints';
            $settings = get_settings('system_settings', true);
            $this->data['title'] = 'View ePoints | ' . $settings['app_name'];
            $this->data['meta_description'] = ' View ePoints  | ' . $settings['app_name'];
            $this->load->view('admin/template', $this->data);
        } else {
            redirect('admin/login', 'refresh');
        }
    }

    public function view_epoints()
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {

            return $this->Customer_model->get_epoints_list();
        } else {
            redirect('admin/login', 'refresh');
        }
    }
}
