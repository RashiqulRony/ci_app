<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileUpload extends CI_Controller
{
    var $img_path;
    function __construct()
    {
        parent::__construct();
        $this->img_path = realpath(APPPATH . '../uploads');
        $this->load->model('Common_model');

    }

    public function index(){
        $this->data['results'] = $this->Common_model->get_info('file_uploads');
        //pr($this->data['results']);
        $this->data['subview'] = 'fileupload/index';
        $this->load->view('layout/admin', $this->data);
    }

    public function add(){

        $this->form_validation->set_rules('userfile', 'profile image required', '');


        if(@$_FILES['userfile']['size'] > 0){
            $this->form_validation->set_rules('userfile', '', 'callback_file_check');

        }
        // Run after validation
        if ($this->form_validation->run() == true){

            $form_data = array(
                'created' => date("Y-m-d H:i:s")
            );

            // Image Upload
            if($_FILES['userfile']['size'] > 0){
                $new_file_name = time().'-'.$_FILES["userfile"]['name'];
                $config['allowed_types']= 'jpg|png|jpeg';
                //pr($this->img_path);
                $config['upload_path']  = $this->img_path;
                $config['file_name']    = $new_file_name;
                $config['max_size']     = 600;

                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload()){
                    $uploadData = $this->upload->data();
                    $config = array(
                        'source_image' => $uploadData['full_path'],
                        'new_image' => $this->img_path,
                        'maintain_ratio' => TRUE,
                        'width' => 300,
                        'height' => 300
                    );
                    $this->load->library('image_lib',$config);
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();

                    $uploadedFile = $uploadData['file_name'];
                    // print_r($uploadedFile);
                }else{
                    $this->data['message'] = $this->upload->display_errors();
                }
            }

            if($_FILES['userfile']['size'] > 0){
                $form_data['userfile'] = $uploadedFile;
            }


            if($this->Common_model->saved('file_uploads', $form_data)){
                $this->session->set_flashdata('success', 'Thank You! Your file uplaod successfully.');
                redirect('FileUpload/index');
            }
        }

        $this->data['subview'] = 'FileUpload/add';
        $this->load->view('layout/admin', $this->data);
    }

    public function file_check($str){
        $this->load->helper('file');
        $allowed_mime_type_arr = array('image/jpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['userfile']['name']);
        $file_size = 524288;
        $size_kb = '512 KB';

        if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name']!="")
        {
            if(!in_array($mime, $allowed_mime_type_arr)){
                $this->form_validation->set_message('file_check', 'Please select only jpg, jpeg, png file.');
                return false;
            }elseif($_FILES["userfile"]["size"] > $file_size){
                $this->form_validation->set_message('file_check', 'Maximum file size '.$size_kb);
                return false;
            }else{
                return true;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a image file to upload.');
            return false;
        }
    }

}