<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Document extends CI_Controller {
    
    function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->model('main');
        $this->load->model('tasks_model');
        $this->load->model('atskaite_model');
	}
        
    public function index()
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        $data['user'] = $this->ion_auth->user()->row();

        $data['task_for_me'] = $this->tasks_model->getUserTasks($data['user']->id, 6);
        $data['atskaite_for_me'] = $this->atskaite_model->getAtskaites(6);
        
        if($this->ion_auth->is_admin()){
            $data['page']['title'] = 'Uzdevumi';
            $this->load->view('header.php', $data);
            $this->load->view('document/index.php', $data);
            $this->load->view('footer.php', $data);
        }else{
            $data['page']['title'] = 'Galvena';
            $this->load->view('header.php', $data);
            $this->load->view('document/index_user.php', $data);
            $this->load->view('footer.php', $data);
        }
    }   
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */