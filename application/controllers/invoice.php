<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('main');
        $this->load->model('atskaite_model');
        $this->load->model('invoice_model');
    }
    
    public function index()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{
        
            $data['user'] = $this->ion_auth->user()->row();
            $data['filter'] = $this->invoice_model->getFilter();
            $data['filter_data'] = $this->session->userdata('invoice');
            $data['invoice'] = $this->invoice_model->getAll();
            $data['page']['title'] = 'Visi Reķiņi';
            
            $this->load->view('header.php', $data);
            $this->load->view('document/invoice.php', $data);
            $this->load->view('footer.php', $data);

        }    
        
    }   
    
    public function createPDFsmall($type = false)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{
        
            if($this->input->post()){
                $data_id = $this->invoice_model->add($this->input->post());
                redirect('invoice/updateSmall/'.$data_id);
            }
            
            $data['user'] = $this->ion_auth->user()->row();
            
            $data['page']['title'] = 'Isais reķins';
            $data['klients'] = $this->main->getAll('clients');
            
            if($type == 'klientam'){
                $data['filter_data'] = $this->session->userdata('klientiem');
                $data['atskaite'] = $this->atskaite_model->getAtskaitesKlientiem();
                $data['total_time'] = 0;
                if($data['atskaite']){
                    foreach($data['atskaite'] as $row){
                        $data['total_time'] += $row->total_time;
                    }
                }
            }elseif($type == 'all'){
                $data['filter_data'] = $this->session->userdata('a_filter');
                $data['atskaite'] = $this->atskaite_model->getAtskaites();
                $data['total_time'] = 0;
                if($data['atskaite']){
                    foreach($data['atskaite'] as $row){
                        $data['total_time'] += $row->total_time;
                    }
                }
            }
            
            $this->load->view('header.php', $data);
            $this->load->view('create_pdf_small.php', $data);
            $this->load->view('footer.php', $data);

        }    
    }
    
    public function createPDFbig($type = false)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{
        
            if($this->input->post()){
                $data_id = $this->invoice_model->add($this->input->post());
                redirect('invoice/updateBig/'.$data_id);
            }
            
            $data['user'] = $this->ion_auth->user()->row();
            
            $data['page']['title'] = 'Garais reķins';
            $data['klients'] = $this->main->getAll('clients', array('by' => 'name', 'order' => 'desc'));
            
            if($type == 'all'){
                $data['filter_data'] = $this->session->userdata('a_filter');
                $data['atskaite'] = $this->atskaite_model->getAtskaites();
            }
                       
            $this->load->view('header.php', $data);
            $this->load->view('pdf_create.php', $data);
            $this->load->view('footer.php', $data);

        }    
    }
    
    public function updateBig($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{
        
            if($this->input->post()){
                $this->invoice_model->update($this->input->post(), $id);
            }
            
            $data['user'] = $this->ion_auth->user()->row();
            
            $data['page']['title'] = 'Garais reķins';
            $data['klients'] = $this->main->getAll('clients', array('by' => 'id', 'order' => 'desc'));
            
            $data['data'] = $this->main->getDataById('invoice',  $id);
            $data['data_list'] = $this->invoice_model->listData($id);
            
            $this->load->view('header.php', $data);
            $this->load->view('document/invoice_update.php', $data);
            $this->load->view('footer.php', $data);

        }    
    }
    
    public function updateSmall($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{
        
            if($this->input->post()){
                $this->invoice_model->update($this->input->post(), $id);
            }
            
            $data['user'] = $this->ion_auth->user()->row();
            
            $data['page']['title'] = 'Isais reķins';
            $data['klients'] = $this->main->getAll('clients', array('by' => 'name', 'order' => 'desc'));
            
            $data['data'] = $this->main->getDataById('invoice',  $id);
            $data['data_list'] = $this->invoice_model->listData($id);
            
            $this->load->view('header.php', $data);
            $this->load->view('document/invoice_update_small.php', $data);
            $this->load->view('footer.php', $data);

        }    
    }
    
    public function pdfSave($type)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            if($type == 'small'){
                redirect('invoice/pdf/'.$this->invoice->addSmall($this->input->post()));
            }elseif($type == 'big'){
                redirect('invoice/pdf/'.$this->invoice->addBig($this->input->post()));
            }

        }
    }
    
    public function pdfBig($id){
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{
        
            $data['data'] = $this->main->getDataById('invoice',  $id);
            $data['klients'] = $this->main->getDataById('clients', $data['data']->klients);
            $data['sum_text'] = $this->invoice_model->num2words($data['data']->sum_kopa);
            $data['data_list'] = $this->invoice_model->listData($id);
            
            $this->load->view('pdf.php', $data);

        }    
    }
    
    public function pdfSmall($id)
    {        
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $data['data'] = $this->main->getDataById('invoice',  $id);
            $data['klients'] = $this->main->getDataById('clients', $data['data']->klients);
            $data['sum_text'] = $this->invoice_model->num2words($data['data']->sum_kopa);
            $data['data_list'] = $this->invoice_model->listData($id);
            
            $this->load->view('pdf_small.php', $data);

        }    
    }
    
    public function ajax_clients($id)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $data['klients'] = $this->main->getDataById('clients', $id);
            $this->load->view('document/ajax_klients.php', $data);

        }    
    } 
    
    public function delete($id){
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{
        
            $this->invoice_model->deleteInvoice($id);
            redirect('invoice');

        }    
    }

    public function filter($which)
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{
        
            if($this->session->userdata($which)){
                $this->session->unset_userdata($which);
            }
            
            $this->session->set_userdata($which, $this->input->post());
            redirect($this->input->post('redirect'));

        }    
    }

    public function reset_filter($which)
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->session->unset_userdata($which);
            redirect($_GET['r']);

        }    
    }

    public function error()
    {
        $data['page']['title'] = 'Jums nav piejas';
        $data['user'] = $this->ion_auth->user()->row();
        $this->load->view('header.php', $data);
        $this->load->view('error.php');
    }        
  
}