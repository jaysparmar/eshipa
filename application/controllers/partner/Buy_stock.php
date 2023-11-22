<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buy_stock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation', 'upload']);
        $this->load->helper(['url', 'language', 'file']);
        $this->load->model(['product_model', 'category_model', 'rating_model']);
    }
    public function index()
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_partner() && ($this->ion_auth->partner_status() == 1 || $this->ion_auth->partner_status() == 0)) {
            $this->data['main_page'] = TABLES . 'buy-stock';
            $settings = get_settings('system_settings', true);
            $this->data['title'] = 'Buy Stock | ' . $settings['app_name'];
            $this->data['meta_description'] = 'Buy Stock |' . $settings['app_name'];
            $this->data['categories'] = $this->category_model->get_categories();
            $this->load->view('partner/template', $this->data);
        } else {
            redirect('partner/login', 'refresh');
        }
    }
}