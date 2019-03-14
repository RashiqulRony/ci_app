<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');

    }

    public function index(){

        $this->data['results'] = $this->Common_model->get_info('products');
        $this->data['subview'] = 'common/index';
        $this->load->view('layout/admin', $this->data);
    }


    public function excelCreate(){
        $this->data['results'] = $this->Common_model->get_info('products');

        //$this->data['subview'] = 'dashboard/excel_create';
        $this->load->view('common/excel_create', $this->data, true);

    }

    public function generate_pdf() {
        //load pdf library
        $this->load->library('Pdf');

        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        //$pdf->SetAuthor('https://www.roytuts.com');
        //$pdf->SetTitle('Sales Information for Products');
        //$pdf->SetSubject('Report generated using Codeigniter and TCPDF');
        //$pdf->SetKeywords('TCPDF, PDF, MySQL, Codeigniter');

        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set font
        $pdf->SetFont('times', 'BI', 12);

        // ---------------------------------------------------------


       /* //Generate HTML table data from MySQL - start
        $template = array(
            'table_open' => '<table border="1" cellpadding="2" cellspacing="1">'
        );

        $this->table->set_template($template);

        $this->table->set_heading('Product Id', 'Price', 'Sale Price', 'Sales Count', 'Sale Date');

        $salesinfo = $this->product_model->get_salesinfo();

        foreach ($salesinfo as $sf):
            $this->table->add_row($sf->id, $sf->price, $sf->sale_price, $sf->sales_count, $sf->sale_date);
        endforeach;

        $html = $this->table->generate();*/
        //Generate HTML table data from MySQL - end
        $this->data['results'] = $this->Common_model->get_info('products');
        // add a page
        $html = $this->load->view('common/generate_pdf', $this->data, true);
        $pdf->AddPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // reset pointer to the last page
        $pdf->lastPage();

        //Close and output PDF document
        //$pdf->Output(md5(time()).'.pdf', 'D');
        $pdf->Output('generate_product_info.pdf', 'D');
    }

    public function fpdf() {

        //$this->load->library('Fpdfg');
        $this->load->library('Fpdfg');


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

    public function dompdf_report(){
        $this->load->library('pdfgenerator');

        $this->data['results'] = $this->Common_model->get_info('products');
        $html = $this->load->view('common/dompdf_report', $this->data, true);

        $filename = 'report_'.time();
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
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

    public function cacheing(){
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file','key_prefix' => 'my_foo'));

        if ( ! $foo = $this->cache->get('foo'))
        {
            echo 'Saving to the cache!<br />';
            $foo = 'foobarbaz!';

            // Save into the cache for 5 minutes
            $this->cache->save('foo', $foo, 60);
        }
        $this->cache->get('foo');
        //echo $foo;

        $name = $this->session->userdata('newdata');
        pr($name);
        exit();
    }

    public function session(){
        $this->load->library('session');

        $newdata = array(
            'username'  => 'almgir hoseen',
            'email'     => 'mdalamgir@technobd.com',
            'logged_in' => TRUE
        );

        $this->session->set_userdata('newdata',$newdata);



        //unset($this->session->unset_userdata('newdata'));
        //$this->session->unset_userdata('newdata');
        //pr($name);
    }
}
