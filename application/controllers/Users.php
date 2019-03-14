<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->model('Common_model');
        $this->load->library('form_validation');
     	$this->load->helper('form');
     	$this->load->library('session');
     	//$this->load->library('ion_auth');
        
    }

	public function index(){
		$this->data['subview'] = 'users/index';
        $this->load->view('layout/admin', $this->data);
	}

	public function login(){
		if ($this->ion_auth->logged_in()){
			redirect('dashboard');
		}
		//validate form input
		$this->form_validation->set_rules('username', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() == true){
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('username'), $this->input->post('password'), $remember)){
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('dashboard');
			}else{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('login'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}else{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['username'] = array('name' => 'username',
				'type'  => 'text',
				'id'    => 'username',
				'class' => 'form-control',
				'placeholder' => 'Registered email or username or scout ID',
				'value' => $this->form_validation->set_value('username'),
			);			
			$this->data['password'] = array('name' => 'password',
				'type' => 'password',
				'id'   => 'password-field',
				'class' => 'form-control',
				'placeholder' => 'Password',
			);
			
			$this->data['meta_title'] = 'Login';
			$this->data['subview'] = 'index';
	    	$this->load->view('login/_layout_main', $this->data);
		}

		$this->data['subview'] = 'users/login';
        $this->load->view('layout/login', $this->data);
	}

	public function registration(){
		/*echo "<pre>";
		print_r($this->input->post());
		die();*/
        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
        $this->form_validation->set_rules('email', 'First Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Users Name', 'required|trim'); 
        $this->form_validation->set_rules('password', '	Password', 'required|trim');
        if ($this->form_validation->run() == true){
            $form_data = array(
                'first_name'             => $this->input->post('first_name'),
                'email'             => $this->input->post('email'),
                'username'               => $this->input->post('username'),
                'password'               => md5($this->input->post('password')),
                'created_date'              => date('Y-m-d')
            );
  			
            if($this->Common_model->save('users', $form_data)){
                $this->session->set_flashdata('success', 'Users create successfully...!');
                redirect('users/login');
            }
        }
		$this->data['subview'] = 'users/registration';
        $this->load->view('layout/admin', $this->data);
	}

	public function username_valid($str){
        // alpha_dash_space
        // return (!preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
        if (! preg_match('/^\S*$/', $str)) {
            $this->form_validation->set_message('username_valid', 'The %s field may only contain alpha characters & no white spaces.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function TokenCheck(){
	    echo $this->token(1,500);
    }

    /* =============================================
    @token: create a 'token key' with specifi lenght
    @Param[$token]: string
    @Param[$token_lenght]: integer
    */

    function token ($token_id = NULL, $token_lenght = NULL) {
        if (is_null($token_id)){
            $token = "abcdefghijkmnopqrstuvwxyz023456789";
        } else {
            $token = $token_id;
        }

        $token .= trim(substr(sha1($token_id + rand(5,255)), 0 ,$token_lenght));
        return $token;
    }
    /* ========================================== */


}
