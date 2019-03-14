<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/ImplementJwt.php';
require APPPATH . '/libraries/ExpiredException.php';
require APPPATH . '/libraries/SignatureInvalidException.php';
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Api extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();


        $this->load->model('Api_model');
        $this->load->model('Common_model');
        $this->load->helper(['common']);
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
                $user = $this->session->userdata();

                $issuedAt = time();
                $expirationTime = $issuedAt + 60;
                $tokenData['code'] = '200';
                $tokenData['status'] = 'success';
                $tokenData['data']['id'] = $user['user_id'];
                $tokenData['data']['username'] =$user['identity'];
                $tokenData['data']['timeStamp'] = Date('Y-m-d h:i:s');
                $tokenData['jwt_payload']['user_id'] = $user['user_id'];
                $tokenData['exp'] = $expirationTime;

                $jwtToken = $this->objOfJwt->GenerateToken($tokenData);

                //custom token create for helper using function name encode_token
                $jwtTokenTest = encode_token($jwtToken);

                echo json_encode(array('Token'=> $jwtTokenTest));

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
        $custom_received_Token = $this->input->request_headers('Authorization');
        //custom token create for helper using function name decode_token
        $received_Token = decode_token($custom_received_Token['Token']);

        try
        {
            //Data fetch call to common model and function call get_info and parameter (table name)
            $results = $this->Common_model->get_info('products');
            if ($results){
                    //Jwt Token check for try catch
                    $jwtData = $this->objOfJwt->DecodeToken($received_Token);
                    $this->response(['status' => 'true', 'data' => $results], REST_Controller::HTTP_OK);
            } else {
                $this->response(['status' => 'false', 'data' => 'Data not found'], REST_Controller::HTTP_OK);
            }

        }
        catch (Exception $e)
        {
            http_response_code('401');
            echo json_encode(array( "status" => false, "message" => $e->getMessage()));exit;
        }

    }

    public function products_add_post(){
        $custom_received_Token = $this->input->request_headers('Authorization');
        //custom token create for helper using function name decode_token
        $received_Token = decode_token($custom_received_Token['Token']);
        try{
            $jwtData = $this->objOfJwt->DecodeToken($received_Token);

            $this->form_validation->set_rules('name', 'Product name', 'required|trim');
            $this->form_validation->set_rules('price', 'Price', 'trim');
            $this->form_validation->set_rules('sale_price', 'sale price', 'trim');
            $this->form_validation->set_rules('sales_count', 'sales count', 'trim');
            $this->form_validation->set_rules('sale_date', 'sale date', 'required|trim');

            if ($this->form_validation->run() == true){
                $form_data = array(
                    'name'        => $this->input->post('name'),
                    'price'        => $this->input->post('price'),
                    'sale_price'    => $this->input->post('sale_price'),
                    'sales_count'  => $this->input->post('sales_count'),
                    'sale_date'   => $this->input->post('sale_date'),
                );

                // print_r($form_data); exit;
                if($this->Common_model->saved('products', $form_data)){
                    $this->response(array('status'=> 'true', 'result'  => 'products saved has been successfully.'), REST_Controller::HTTP_OK);
                }else{
                    $this->response(['status' => 'false', 'result' => 'Something is wrong,Please try again'], REST_Controller::HTTP_OK);
                }
            }else{
                $message = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
                $this->response(['status' => 'false', 'result' => $message], REST_Controller::HTTP_OK);
            }
        } catch (Exception $e)
        {
            http_response_code('401');
            echo json_encode(array( "status" => false, "message" => $e->getMessage()));exit;
        }
    }

    public function products_edit_post($id){

        $custom_received_Token = $this->input->request_headers('Authorization');
        //custom token create for helper using function name decode_token
        $received_Token = decode_token($custom_received_Token['Token']);
        try{
            $jwtData = $this->objOfJwt->DecodeToken($received_Token);

            $this->form_validation->set_rules('name', 'Product name', 'required|trim');
            $this->form_validation->set_rules('price', 'Price', 'trim');
            $this->form_validation->set_rules('sale_price', 'sale price', 'trim');
            $this->form_validation->set_rules('sales_count', 'sales count', 'trim');
            $this->form_validation->set_rules('sale_date', 'sale date', 'required|trim');

            if ($this->form_validation->run() == true){
                $form_data = array(
                    'name'        => $this->input->post('name'),
                    'price'        => $this->input->post('price'),
                    'sale_price'    => $this->input->post('sale_price'),
                    'sales_count'  => $this->input->post('sales_count'),
                    'sale_date'   => $this->input->post('sale_date'),
                );

                // print_r($form_data); exit;
                if($this->Common_model->edit('products', $id, 'id' ,$form_data)){
                    $this->response(array('status'=> 'true', 'result'  => 'products Updated has been successfully.'), REST_Controller::HTTP_OK);
                }else{
                    $this->response(['status' => 'false', 'result' => 'Something is wrong,Please try again'], REST_Controller::HTTP_OK);
                }
            }else{
                $message = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
                $this->response(['status' => 'false', 'result' => $message], REST_Controller::HTTP_OK);
            }
        } catch (Exception $e)
        {
            http_response_code('401');
            echo json_encode(array( "status" => false, "message" => $e->getMessage()));exit;
        }
    }

    function delete_products_delete($id) {
        $custom_received_Token = $this->input->request_headers('Authorization');
        //custom token create for helper using function name decode_token
        $received_Token = decode_token($custom_received_Token['Token']);
        try{
            $jwtData = $this->objOfJwt->DecodeToken($received_Token);

            // print_r($form_data); exit;
            if($this->Common_model->delete('products', 'id', $id)){
                $this->response(array('status'=> 'true', 'result'  => 'products delete has been successfully.'), REST_Controller::HTTP_OK);
            }else{
                $this->response(['status' => 'false', 'result' => 'Something is wrong,Please try again'], REST_Controller::HTTP_OK);
            }

        } catch (Exception $e)
        {
            http_response_code('401');
            echo json_encode(array( "status" => false, "message" => $e->getMessage()));exit;
        }

    }


}

