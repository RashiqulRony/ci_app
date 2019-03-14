<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        // Load paypal library & product model
        $this->load->library('Paypal_lib');
        $this->load->model('Product_model');
        $this->load->model('Common_model');

    }


    public function index(){

        $data = array();

        // Get products data from the database
        $this->data['products'] = $this->Product_model->getRows();

        $this->data['subview'] = 'products/index';
        $this->load->view('layout/admin', $this->data);

    }

    public function buy($id){
        // Set variables for paypal form
        $returnURL = base_url().'paypal/success';
        $cancelURL = base_url().'paypal/cancel';
        $notifyURL = base_url().'paypal/ipn';

        // Get product data from the database
        $product = $this->Product_model->getRows($id);

        // Get current user ID from the session
        //$userID = $_SESSION['userID'];
        $user = $this->session->userdata();
        $userID = $user['user_id'];

        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product['name']);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  $product['id']);
        $this->paypal_lib->add_field('amount',  $product['price']);

        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
    }
}