<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class ApiUrl extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

    }

    public function index(){
        $this->data['results'] = 'http://localhost/codeigniter/api/api/api_login/';
        $this->data['results'] = 'http://localhost/codeigniter/api/api/products_list/';
        $this->data['subview'] = 'apiurl/index';
        $this->load->view('layout/admin',$this->data);
    }
}