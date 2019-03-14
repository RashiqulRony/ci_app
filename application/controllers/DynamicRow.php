<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DynamicRow extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');

    }

    public function index(){

        $this->data['subview'] = 'dynamicrow/index';
        $this->load->view('layout/admin', $this->data);
    }

    public function add(){

        $this->data['subview'] = 'dynamicrow/add';
        $this->load->view('layout/admin', $this->data);
    }

    public function getDynamiceRow($sub_registry_form_inc,$registryNo){
        $this->data['registryNo'] = $registryNo;
        $this->data['sub_registry_form_inc'] = $sub_registry_form_inc +1;
        $data=$this->load->view('dynamicrow/create_row',$this->data, TRUE);
        echo $data;
    }

}