<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

require APPPATH . 'libraries/Format.php';
require APPPATH . '/libraries/ImplementJwt.php';

class Example_api extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();


        $this->load->model('Api_model');
        $this->load->model('Common_model');
        $this->load->library(['ion_auth', 'form_validation']);
        $this->load->helper(['url', 'language']);
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');


        $this->objOfJwt = new ImplementJwt();
        header('Content-Type: application/json');


    }

    public function api_login_post(){

        // validate form input
        $this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
        $this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

        if ($this->form_validation->run() === TRUE)
        {
            // check to see if the user is logging in
            // check for "remember me"
            $remember = (bool)$this->input->post('remember');
            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
            {
                $tokenData['id'] = '1';
                $tokenData['username'] = $this->input->post('identity');
                $tokenData['timeStamp'] = Date('Y-m-d h:i:s');

                $jwtToken = $this->objOfJwt->GenerateToken($tokenData);

                //$jwtTokenTest = static::encode_token($jwtToken);
                echo json_encode(array('Token'=> $jwtToken));

            }
            else
            {
                // if the login was un-successful
                $this->response(['status' => 'false', 'result' => 'Username or password incorrect'], REST_Controller::HTTP_OK);

            }
        }

    }

    //Use to jwt token and ci rest api
    public function products_list_get(){
        $received_Token = $this->input->request_headers('Authorization'); //Postman token check and valid token
        //pr($received_Token);
        try
        {
            $results = $this->Common_model->get_info('products');
            $jwtData = $this->objOfJwt->DecodeToken($received_Token['Token']);
            $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK);


        } catch (Exception $e)
        {
            http_response_code('401');
            //echo json_encode(array( "status" => false, "message" => $e->getMessage()));exit;
            $this->response(['status' => 'false', 'result' => 'Token incorrect'], REST_Controller::HTTP_OK);
        }

        /*if($results){
            $this->response(array('status'=> 'success', 'result'  => $results), REST_Controller::HTTP_OK);
        }else{
            $this->response(['status' => 'false', 'result' => 'No data found'], REST_Controller::HTTP_OK);
        }*/
    }

    public function products_add_post(){

        $this->form_validation->set_rules('name', 'Product name', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'trim');
        $this->form_validation->set_rules('sale_price', 'sale price', 'trim');
        $this->form_validation->set_rules('sales_count', 'sales count', 'trim');
        $this->form_validation->set_rules('sale_date', 'sale date', 'required|trim');

       // pr($this->input->post('name'));
        if ($this->form_validation->run() == true){
            $form_data = array(
                'name'        => $this->input->post('name'),
                'price'        => $this->input->post('price'),
                'sale_price'    => $this->input->post('sale_price'),
                'sales_count'  => $this->input->post('sales_count'),
                'sale_date'   => $this->input->post('sale_date'),
            );

            // print_r($form_data); exit;

            if($this->Common_model->save('products', $form_data)){
                $this->response(array('status'=> 'true', 'result'  => 'products saved has been successfully.'), REST_Controller::HTTP_OK);
            }else{
                $this->response(['status' => 'false', 'result' => 'Something is wrong,Please try again'], REST_Controller::HTTP_OK);
            }
        }else{
            $message = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->response(['status' => 'false', 'result' => $message], REST_Controller::HTTP_OK);
        }
    }

    public function products_edit_post($id){
        //$id = (int) $this->get('id');
        $this->form_validation->set_rules('name', 'Product name', 'required|trim');
        $this->form_validation->set_rules('price', 'Price', 'trim');
        $this->form_validation->set_rules('sale_price', 'sale price', 'trim');
        $this->form_validation->set_rules('sales_count', 'sales count', 'trim');
        $this->form_validation->set_rules('sale_date', 'sale date', 'required|trim');

        //$this->data['info'] = $this->Common_model->get_info_id('products',$id);
        //pr($this->data['info']);
         //pr($this->input->post('name'));
        if ($this->form_validation->run() == true){
            $form_data = array(
                'name'        => $this->input->post('name'),
                'price'        => $this->input->post('price'),
                'sale_price'    => $this->input->post('sale_price'),
                'sales_count'  => $this->input->post('sales_count'),
                'sale_date'   => $this->input->post('sale_date'),
            );



            if($this->Common_model->edit('products', $id, 'id', $form_data)){
                $this->response(array('status'=> 'true', 'result'  => 'products update has been successfully.'), REST_Controller::HTTP_OK);
            }else{
                $this->response(['status' => 'false', 'result' => 'Something is wrong,Please try again'], REST_Controller::HTTP_OK);
            }
        }else{
            $message = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $this->response(['status' => 'false', 'result' => $message], REST_Controller::HTTP_OK);
        }
    }

    public function products_list_name_get(){

        /*$data = $this->Common_model->get_dropdown('products','name','id');
        if($data)
        {
            $this->response(['status' => 'true', 'data' => $data],REST_Controller::HTTP_OK);
        } else
        {
            $this->response(['status' =>'false','data' => 'someting worng'],REST_Controller::HTTP_OK);
        }*/

        $data = $this->Common_model->get_join_query();
        pr($data);
    }


}

