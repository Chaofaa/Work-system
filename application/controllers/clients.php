<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clients extends CI_Controller {
    
    function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->model('main');
	}
        
    public function index()
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{
        
            $data['user'] = $this->ion_auth->user()->row();

            $data['clients'] = $this->main->getAll('clients', array('by' => 'name', 'order' => 'desc'));
            
            $data['page']['title'] = 'Clienti';
            
            $this->load->view('header.php', $data);
            $this->load->view('clients/clients.php', $data);
            $this->load->view('footer.php', $data);
        }    
       
    }

    public function change($id)
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->form_validation->set_rules('client', 'Client', 'xss_clean|required');
            $this->form_validation->set_rules('reg_nr', 'Reģ. Nr.', 'xss_clean');
            $this->form_validation->set_rules('adress', 'Adress', 'xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
            $this->form_validation->set_rules('persona', 'Persona', 'xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'xss_clean');

            if ($this->form_validation->run() == true){
                $client_data = array('name' => $this->input->post('client'),
                                     'reg_nr' => $this->input->post('reg_nr'),
                                     'adress' => $this->input->post('adress'),
                                     'phone' => $this->input->post('phone'),
                                     'email' => $this->input->post('email'),
                                     'person' => $this->input->post('persona')
                                    );
                if($this->main->update('clients', $id, $client_data)){
                    $data['success'] = "Saglabats!";
                }

            }else{
                if(!empty($_POST)){
                    $data['error'] = "Aizpildet visus obligatus laukus!";
                }
            }    

            $data['user'] = $this->ion_auth->user()->row();

            $data['client_data'] = $this->main->getDataById('clients', $id);

            $data['page']['title'] = 'Clientu mainišana';
            
            $this->load->view('header.php', $data);
            $this->load->view('clients/client_change.php', $data);
            $this->load->view('footer.php', $data);
        }    
    }

    public function add()
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->form_validation->set_rules('client', 'Client', 'xss_clean|required');
            $this->form_validation->set_rules('reg_nr', 'Reģ. Nr.', 'xss_clean');
            $this->form_validation->set_rules('adress', 'Adress', 'xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
            $this->form_validation->set_rules('persona', 'Persona', 'xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'xss_clean');

            if ($this->form_validation->run() == true){
                $client_data = array('name' => $this->input->post('client'),
                                     'reg_nr' => $this->input->post('reg_nr'),
                                     'adress' => $this->input->post('adress'),
                                     'phone' => $this->input->post('phone'),
                                     'email' => $this->input->post('email'),
                                     'person' => $this->input->post('persona')
                                    );
                if($this->main->insert('clients', $client_data)){
                    redirect('clients');
                }

            }else{
                if(!empty($_POST)){
                    $data['error'] = "Aizpildet visus obligatus laukus!";
                }
            }    

            $data['user'] = $this->ion_auth->user()->row();

            $data['page']['title'] = 'Jaunu clientu pievienošana';
            
            $this->load->view('header.php', $data);
            $this->load->view('clients/client_add.php', $data);
            $this->load->view('footer.php', $data);
        }    
    }

    public function delete($id)
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->main->delete('clients', $id);
            redirect('clients');
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */