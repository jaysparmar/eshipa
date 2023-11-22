<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(['ion_auth', 'form_validation', 'upload']);
        $this->load->helper(['url', 'language', 'file']);
        $this->load->model(['product_model', 'category_model', 'rating_model']);
        $this->data['settings'] = get_settings('system_settings', true);
    }
    public function index()
    {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_partner() && ($this->ion_auth->partner_status() == 1 || $this->ion_auth->partner_status() == 0)) {
            $this->data['main_page'] = VIEW . 'manage-cart';
            $this->data['title'] = 'Manage Cart | ' . $this->data['settings']['app_name'];
            $this->data['meta_description'] = 'Manage Cart |' . $this->data['settings']['app_name'];
            $this->data['cart'] = get_cart_total($this->session->userdata('user_id'));
            $this->data['save_for_later'] = get_cart_total($this->session->userdata('user_id'), false, '1');
            $this->load->view('partner/template', $this->data);
        } else {
            redirect('partner/login', 'refresh');
        }
    }
}
