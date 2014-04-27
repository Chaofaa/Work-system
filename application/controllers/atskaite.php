<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Atskaite extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->model('main');
        $this->load->model('atskaite_model');
        $this->nav = $this->uri->segment(2);
    }
        
    public function index()
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        $data['user'] = $this->ion_auth->user()->row();
        if($this->atskaite_model->getAtskaitesFilter()){
            $data['filter'] = $this->atskaite_model->getAtskaitesFilter();
        }    
        $data['filter_data'] = $this->session->userdata('a_filter');
        $data['atskaite'] = $this->atskaite_model->getAtskaites();
 
        $data['time'] = 0;
        $data['izmaksas'] = 0;
        if($data['atskaite']){
            foreach($data['atskaite'] as $row){
                $data['time'] += $row->time;
                $data['izmaksas'] += $row->papildus_izmaksas;
            }
        }
        
        $data['page']['title'] = 'Darba laika uzskaite';
        
        $this->load->view('header.php', $data);
        $this->load->view('atskaite/user_atskaite.php', $data);
        $this->load->view('footer.php', $data);
    }
    
    public function add()
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        $data['user'] = $this->ion_auth->user()->row();
        
        $this->form_validation->set_rules('datums', 'Datums', 'xss_clean|required');
        $this->form_validation->set_rules('sadala', 'Sadala', 'xss_clean|required');
        $this->form_validation->set_rules('klients', 'Klients', 'xss_clean|required');
        $this->form_validation->set_rules('lieta', 'Lieta', 'xss_clean|required');
        $this->form_validation->set_rules('apraksts', 'Apraksts', 'xss_clean');
        $this->form_validation->set_rules('time', 'Izpildes laiks', 'xss_clean|required');
        $this->form_validation->set_rules('piezimes', 'Piezumes', 'xss_clean');
        $this->form_validation->set_rules('izmaksas', 'Izmaksas', 'xss_clean');
        
        if($this->ion_auth->is_admin()){
            $data['users'] = $this->main->getAll('users', array('by' => 'first_name', 'order' => 'desc'));
            $this->form_validation->set_rules('darbinieks', 'Darbinieks', 'xss_clean|required');
        }    
        
        if($this->form_validation->run() == true){

            if($this->ion_auth->is_admin()){
                $user_id = $this->input->post('darbinieks');
            }else{
                $user_id = $data['user']->id;
            }
            
            $task_data = array(
                               'datums' => $this->input->post('datums'),
                               'sadala' => $this->input->post('sadala'),
                               'klients' => $this->input->post('klients'),
                               'lieta' => $this->input->post('lieta'),
                               'apraksts' => $this->input->post('apraksts'),
                               'time' => $this->input->post('time'), 
                               'piezimes' => $this->input->post('piezimes'),
                               'papildus_izmaksas' => $this->input->post('izmaksas'),
                               'darbinieks' => $user_id
                               );

            if($this->main->insert('uzskaite', $task_data)){
                redirect('atskaite');
            }
        }else{
            if(!empty($_POST)){
                $data['error'] = "Aizpildet visus obligatus laukus!";
            }
        }
        
        $data['sadala'] = $this->main->getAll('sadala', array('by' => 'name', 'order' => 'desc'));
        $data['klients'] = $this->main->getAll('clients', array('by' => 'name', 'order' => 'desc'));
        $data['lieta'] = $this->main->getAll('lieta', array('by' => 'name', 'order' => 'desc'));
        $data['datums'] = $this->main->getDatums();
        
        $data['page']['title'] = 'Jaunu atskaite pievienošana';
        
        $this->load->view('header.php', $data);
        $this->load->view('atskaite/atskaite_add.php', $data);
        $this->load->view('footer.php', $data);
    }    
    
    public function update($id)
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        $data['user'] = $this->ion_auth->user()->row();
        
        $this->form_validation->set_rules('datums', 'Datums', 'xss_clean|required');
        $this->form_validation->set_rules('sadala', 'Sadala', 'xss_clean|required');
        $this->form_validation->set_rules('klients', 'Klients', 'xss_clean|required');
        $this->form_validation->set_rules('lieta', 'Lieta', 'xss_clean|required');
        $this->form_validation->set_rules('apraksts', 'Apraksts', 'xss_clean');
        $this->form_validation->set_rules('time', 'Izpildes laiks', 'xss_clean|required');
        $this->form_validation->set_rules('piezimes', 'Piezumes', 'xss_clean');
        $this->form_validation->set_rules('izmaksas', 'Izmaksas', 'xss_clean');
        
        if($this->ion_auth->is_admin()){
            $data['users'] = $this->main->getAll('users', array('by' => 'first_name', 'order' => 'desc'));
            $this->form_validation->set_rules('darbinieks', 'Darbinieks', 'xss_clean|required');
        }else{
            $data['users'] = $this->main->getDataById('users', $data['user']->id);
        }  
        
        if($this->form_validation->run() == true){
            
            if($this->ion_auth->is_admin()){
                $user_id = $this->input->post('darbinieks');
            }else{
                $user_id = $data['user']->id;
            }
            
            $task_data = array(
                               'datums' => $this->input->post('datums'),
                               'sadala' => $this->input->post('sadala'),
                               'klients' => $this->input->post('klients'),
                               'lieta' => $this->input->post('lieta'),
                               'apraksts' => $this->input->post('apraksts'),
                               'time' => $this->input->post('time'), 
                               'piezimes' => $this->input->post('piezimes'),
                               'papildus_izmaksas' => $this->input->post('izmaksas'),
                               'darbinieks' => $user_id
                               );

            if($this->main->update('uzskaite', $id ,$task_data)){
                $data['success'] = 'Saglabats!';
            }
        }else{
            if(!empty($_POST)){
                $data['error'] = "Aizpildet visus obligatus laukus!";
            }
        }
        
        $data['atskaite'] = $this->main->getDataById('uzskaite', $id);
        $data['sadala'] = $this->main->getAll('sadala', array('by' => 'name', 'order' => 'desc'));
        $data['klients'] = $this->main->getAll('clients', array('by' => 'id', 'order' => 'desc'));
        $data['lieta'] = $this->main->getAll('lieta', array('by' => 'name', 'order' => 'desc'));
        
        $data['page']['title'] = 'Atskaite rediģešana';
        
        $this->load->view('header.php', $data);
        $this->load->view('atskaite/atskaite_update.php', $data);
        $this->load->view('footer.php', $data);
    }
    
    public function delete($id)
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        $this->main->delete('uzskaite', $id);
        redirect('atskaite');
    }
    
    public function filter($which)
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        if($this->session->userdata($which)){
            $this->session->unset_userdata($which);
        }
        
        $this->session->set_userdata($which, $this->input->post());
        redirect($this->input->post('redirect'));
    }
    
    public function reset_filter($which)
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        $this->session->unset_userdata($which);
        redirect($_GET['r']);
    }        

    public function klientiem()
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{
        
            $data['user'] = $this->ion_auth->user()->row();
            
            $data['filter'] = $this->atskaite_model->getAtskaitesFilter();
            $data['filter_data'] = $this->session->userdata('klientiem');
            $data['atskaite'] = $this->atskaite_model->getAtskaitesKlientiem();
     
            $data['total_time'] = 0;
            if($data['atskaite']){
                foreach($data['atskaite'] as $row){
                    $data['total_time'] += $row->total_time;
                }
            }
            
            $data['page']['title'] = 'Darba laika uzskaite';
            
            $this->load->view('header.php', $data);
            $this->load->view('atskaite/atskaite_klientam.php', $data);
            $this->load->view('footer.php', $data);
        }
    }
    
    public function darbiniekiem()
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $data['user'] = $this->ion_auth->user()->row();
            
            $data['filter'] = $this->atskaite_model->getAtskaitesFilter();
            $data['filter_data'] = $this->session->userdata('darbiniekiem');
            $data['atskaite'] = $this->atskaite_model->getAtskaitesDarbiniekiem();
     
            $data['total_time'] = 0;
            $data['total_days'] = 0;
            if($data['atskaite']){
                foreach($data['atskaite'] as $row){
                    $data['total_time'] += $row->total_time;
                    $data['total_days'] += $row->total_days;
                }
            }
            $data['total_sum'] = $data['total_time']/$data['total_days'];
            
            $data['page']['title'] = 'Darba laika uzskaite';
            
            $this->load->view('header.php', $data);
            $this->load->view('atskaite/atskaite_darbiniekiem.php', $data);
            $this->load->view('footer.php', $data);
        }    
    }
    
    public function excel($which)
    {
        if($which == 'main'){
            $data['atskaite'] = $this->atskaite_model->getAtskaites();
            $this->load->view('excel/atskaite.php', $data);
        }elseif($which == 'klientam'){
            $data['atskaite'] = $this->atskaite_model->getAtskaitesKlientiem();
 
            $data['total_time'] = 0;
            if($data['atskaite']){
                foreach($data['atskaite'] as $row){
                    $data['total_time'] += $row->total_time;
                }
            }
            $this->load->view('excel/klientiem.php', $data);
        }elseif($which == 'darbiniekiem'){
            $data['atskaite'] = $this->atskaite_model->getAtskaitesDarbiniekiem();
            $data['total_time'] = 0;
            $data['total_days'] = 0;
            if($data['atskaite']){
                foreach($data['atskaite'] as $row){
                    $data['total_time'] += $row->total_time;
                    $data['total_days'] += $row->total_days;
                }
            }
            $data['total_sum'] = $data['total_time']/$data['total_days'];
            $this->load->view('excel/darbiniekiem', $data);
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

