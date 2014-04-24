<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    
        function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}

	public function index()
	{
            if($this->ion_auth->is_admin()){
                redirect('document');
            }
            
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if ($this->form_validation->run() == true){
                
                $remember = (bool) $this->input->post('remember');
                
                if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), $remember)){
                    redirect('document');
		        }else{
                    $data['error'] = 'Nepareiz email vai parole';
                }   
            }
                
            if (!$this->ion_auth->logged_in()){
                $data['page']['title'] = 'Legal&Tax';
                $this->load->view('login.php', $data);
            }
	}
        
        function logout()
	{
            $logout = $this->ion_auth->logout();
            redirect('login');
        }
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */