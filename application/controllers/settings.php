<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('main');
    }

    public function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $data['user'] = $this->ion_auth->user()->row();

            $data['status'] = $this->main->getAll('status', array('by' => 'name', 'order' => 'desc'));
            $data['prioritate'] = $this->main->getAll('prioritate', array('by' => 'name', 'order' => 'desc'));
            $data['sadala'] = $this->main->getAll('sadala', array('by' => 'name', 'order' => 'desc'));

            $data['page']['title'] = 'Iestatijumi';

            $this->load->view('header.php', $data);
            $this->load->view('document/settings.php', $data);
            $this->load->view('footer.php', $data);

        }    
    }

    public function add_piegadatajs() {

        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{
        
            $data['user'] = $this->ion_auth->user()->row();

            $data['page']['title'] = 'Pievienot jaunu Piegādātāju';
            
            $this->load->view('header.php', $data);
            $this->load->view('document/settings_piegadatajs.php', $data);
            $this->load->view('footer.php', $data);

        }    
    }

    public function add_status() {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->form_validation->set_rules('name', 'Name', 'xss_clean|required');

            if ($this->form_validation->run() == true) {
                $status = array('name' => $this->input->post('name'));
                if ($this->main->insert('status', $status)) {
                    redirect('settings');
                }
            }

        }    
    }

    public function add_prioritate() {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->form_validation->set_rules('name', 'Name', 'xss_clean|required');

            if ($this->form_validation->run() == true) {
                $prioritate = array('name' => $this->input->post('name'));
                if ($this->main->insert('prioritate', $prioritate)) {
                    redirect('settings');
                }
            }

        }    
    }

    public function add_sadala() {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->form_validation->set_rules('name', 'Name', 'xss_clean|required');

            if ($this->form_validation->run() == true) {
                $sadala = array('name' => $this->input->post('name'));
                if ($this->main->insert('sadala', $sadala)) {
                    redirect('settings');
                }
            }

        }    
    }

    public function delete_status($id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->main->delete('status', $id);
            redirect('settings');

        }    
    }

    public function delete_prioritate($id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->main->delete('prioritate', $id);
            redirect('settings');

        }    
    }

    public function delete_sadala($id) {
        if (!$this->ion_auth->logged_in()) {
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->main->delete('sadala', $id);
            redirect('settings');

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
