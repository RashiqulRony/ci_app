<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');
        
    }

	public function index(){
		$this->data['subview'] = 'dashboard/index';
        $this->load->view('layout/admin', $this->data);
	}

    public function fpdf() {   
        $this->load->library('fpdf_master');
        
        $this->fpdf->SetFont('Arial','B',18);
        $result = $this->Common_model->get_info('products');
        $header = array('Name','Price','sale_price','sales_count','sale_date');
        $this->fpdf->Cell(50,10,'Hello World!',1,'C');
        foreach ($result as $key => $row) {
            
            $this->fpdf->Cell(50,10,'Hello World!',1,'C');
        }

        
        
        
        echo $this->fpdf->Output('hello_world.pdf','D');// Name of PDF file
        //Can change the type from D=Download the file      
    }


    function BasicTable()
    {
        $this->load->library('fpdf_master');
        $data = $this->Common_model->get_info('products');
        $header = array('Name','Price','sale_price','sales_count','sale_date');

        // Header
        foreach($header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();
        // Data
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(40,6,$col,1);
            $this->Ln();
        }
    }

    public function excelCreate(){
        $this->data['results'] = $this->Common_model->get_info('products');
      
        //$this->data['subview'] = 'dashboard/excel_create';
        $this->load->view('dashboard/excel_create', $this->data, true);
        
    }

    public function timeTest(){
        $this->load->model('Common_model');
        //$result = $this->Common_model->token(1,64);
        //echo $result;
        //pr($this->session->userdata());

        $this->load->view('dashboard/time_test', $this->data);
    }


}
