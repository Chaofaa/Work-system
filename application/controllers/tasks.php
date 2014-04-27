<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks extends CI_Controller {
    
    function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
        $this->load->model('main');
        $this->load->model('tasks_model');
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

            $data['tasks'] = $this->tasks_model->getTasks();
            $data['filter'] = $this->tasks_model->getTaskFilter();
            $data['filter_data'] = $this->session->userdata('t_filter');
            
            $data['page']['title'] = 'Uzdevumi';
            
            $this->load->view('header.php', $data);
            $this->load->view('tasks/tasks.php', $data);
            $this->load->view('footer.php', $data);

        }
       
    }

    public function add(){
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->form_validation->set_rules('name', 'Nosaukums', 'xss_clean|required');
            $this->form_validation->set_rules('main_user', 'Galvenais Darbinieks', 'xss_clean|required');
            $this->form_validation->set_rules('users', 'Users', 'xss_clean|required');
            $this->form_validation->set_rules('sadala', 'Sadaļa', 'xss_clean|required');
            $this->form_validation->set_rules('klients', 'Klients', 'xss_clean');
            $this->form_validation->set_rules('lieta', 'Lieta', 'xss_clean');
            $this->form_validation->set_rules('uzdevums', 'Uzdevums', 'xss_clean');
            $this->form_validation->set_rules('status', 'status', 'xss_clean');
            $this->form_validation->set_rules('prioritate', 'Prioritate', 'xss_clean');
            $this->form_validation->set_rules('privats', 'Privats', 'xss_clean');
            $this->form_validation->set_rules('termins', 'Termiņš', 'xss_clean');

            if($this->form_validation->run() == true){

                $task_data = array(
                                   'name' => $this->input->post('name'),
                                   'sadala' => $this->input->post('sadala'),
                                   'klients' => $this->input->post('klients'),
                                   'lieta' => $this->input->post('lieta'),
                                   'uzdevums' => $this->input->post('uzdevums'),
                                   'status' => $this->input->post('status'), 
                                   'prioritate' => $this->input->post('prioritate'),
                                   'privats' => $this->input->post('privats'),
                                   'termins' => $this->input->post('termins')
                                   );
                $users = $this->input->post('users');
                $main_user = $this->input->post('main_user');

                if($this->tasks_model->insert_task($task_data, $main_user, $users)){
                    redirect('tasks');
                }
            }else{
                if(!empty($_POST)){
                    $data['error'] = "Aizpildet visus obligatus laukus!";
                }
            }

            $data['user'] = $this->ion_auth->user()->row();

            $data['users'] = $this->main->getAll('users', array('by' => 'first_name', 'order' => 'desc'));
            $data['status'] = $this->main->getAll('status', array('by' => 'name', 'order' => 'desc'));
            $data['prioritate'] = $this->main->getAll('prioritate', array('by' => 'name', 'order' => 'desc'));
            $data['sadala'] = $this->main->getAll('sadala', array('by' => 'name', 'order' => 'desc'));
            $data['clients'] = $this->main->getAll('clients', array('by' => 'id', 'order' => 'desc'));
            $data['lieta'] = $this->main->getAll('lieta', array('by' => 'name', 'order' => 'desc'));

            $data['page']['title'] = 'Jaunu uzdevumu pievinošana';

            $this->load->view('header.php', $data);
            $this->load->view('tasks/tasks_add.php', $data);
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

            $this->form_validation->set_rules('name', 'Nosaukums', 'xss_clean|required');
            $this->form_validation->set_rules('main_user', 'Galvenais Darbinieks', 'xss_clean|required');
            $this->form_validation->set_rules('users', 'Users', 'xss_clean|required');
            $this->form_validation->set_rules('sadala', 'Sadaļa', 'xss_clean|required');
            $this->form_validation->set_rules('klients', 'Klients', 'xss_clean');
            $this->form_validation->set_rules('lieta', 'Lieta', 'xss_clean');
            $this->form_validation->set_rules('uzdevums', 'Uzdevums', 'xss_clean');
            $this->form_validation->set_rules('status', 'status', 'xss_clean');
            $this->form_validation->set_rules('prioritate', 'Prioritate', 'xss_clean');
            $this->form_validation->set_rules('privats', 'Privats', 'xss_clean');
            $this->form_validation->set_rules('termins', 'Termiņš', 'xss_clean');

            if($this->form_validation->run() == true){

                $task_data = array(
                                   'name' => $this->input->post('name'),
                                   'sadala' => $this->input->post('sadala'),
                                   'klients' => $this->input->post('klients'),
                                   'lieta' => $this->input->post('lieta'),
                                   'uzdevums' => $this->input->post('uzdevums'),
                                   'status' => $this->input->post('status'), 
                                   'prioritate' => $this->input->post('prioritate'),
                                   'privats' => $this->input->post('privats'),
                                   'termins' => $this->input->post('termins')
                                   );
                $users = $this->input->post('users');
                $main_user = $this->input->post('main_user');

                if($this->tasks_model->change_task($id ,$task_data, $main_user, $users)){
                    $data['success'] = "Saglabats!";
                }
            }else{
                if(!empty($_POST)){
                    $data['error'] = "Aizpildet visus obligatus laukus!";
                }
            }    

            $data['user'] = $this->ion_auth->user()->row();

            $data['task'] = $this->main->getDataById('tasks', $id);
            $data['main_user'] = $this->tasks_model->task_users($id, 2);
            $task_users = $this->tasks_model->task_users($id);
            foreach($task_users as $k => $v){
                $data['task_users'][] = $v['user_id']; 
            }
            $data['users'] = $this->main->getAll('users', array('by' => 'first_name', 'order' => 'desc'));
            $data['status'] = $this->main->getAll('status', array('by' => 'name', 'order' => 'desc'));
            $data['prioritate'] = $this->main->getAll('prioritate', array('by' => 'name', 'order' => 'desc'));
            $data['sadala'] = $this->main->getAll('sadala', array('by' => 'name', 'order' => 'desc'));
            $data['clients'] = $this->main->getAll('clients', array('by' => 'id', 'order' => 'desc'));
            $data['lieta'] = $this->main->getAll('lieta', array('by' => 'name', 'order' => 'desc'));
        
            $data['page']['title'] = 'Uzdevumu rediģešana';

            $this->load->view('header.php', $data);
            $this->load->view('tasks/tasks_update.php', $data);
            $this->load->view('footer.php', $data);  

        }      
    }

    public function view($id)
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }

        $data['user'] = $this->ion_auth->user()->row();

        $data['task'] = $this->tasks_model->getTasks($id);
        $data['main_user'] = $this->tasks_model->task_users($id, 2);
        $task_users = $this->tasks_model->task_users($id);
        if(!empty($task_users)){
            foreach($task_users as $k => $v){
                $data['task_users'][] = $v['user_id']; 
            }
        }else{
            $data['task_users'] = false;
        }    
        $data['users_number'] = count($data['task_users']);
        $data['users'] = $this->main->getAll('users', array('by' => 'first_name', 'order' => 'desc'));
        $data['status'] = $this->main->getAll('status', array('by' => 'name', 'order' => 'desc'));
        $data['prioritate'] = $this->main->getAll('prioritate', array('by' => 'name', 'order' => 'desc'));
        $data['sadala'] = $this->main->getAll('sadala', array('by' => 'name', 'order' => 'desc'));
        $data['clients'] = $this->main->getAll('clients', array('by' => 'id', 'order' => 'desc'));
        $data['lieta'] = $this->main->getAll('lieta', array('by' => 'name', 'order' => 'desc'));

        $data['page']['title'] = 'Uzdevumu dati';

        $this->load->view('header.php', $data);
        $this->load->view('tasks/task_view.php', $data);
        $this->load->view('footer.php', $data); 
    }

    public function delete($id)
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->tasks_model->deleteTask($id);
            redirect('tasks');

        }    
    }
    
    public function filter()
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        $this->session->set_userdata('t_filter', $this->input->post());
        redirect('tasks');
    }
    
    public function filter_reset()
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        $this->session->unset_userdata('t_filter');
        redirect('tasks');
    }
    
    public function u_filter()
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        $this->session->set_userdata('u_filter', $this->input->post());
        redirect('tasks/all');
    }

    public function all()
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        $data['filter'] = $this->session->userdata('u_filter');
        
        $data['user'] = $this->ion_auth->user()->row();
        
        $data['tasks'] = $this->tasks_model->getUserTasks($data['user']->id); 
        
        $data['status'] = $this->main->getAll('status');
        $data['page']['title'] = 'Mani uzdevumi';

        $this->load->view('header.php', $data);
        $this->load->view('tasks/user_tasks.php', $data);
        $this->load->view('footer.php', $data);
    }

    public function open($id)
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        $this->form_validation->set_rules('status', 'Status', 'xss_clean');
        $this->form_validation->set_rules('izpildes_gaita', 'Izpildes gaita', 'xss_clean');
        
        if($this->form_validation->run() == true){

            $task_data = array(
                               'status' => $this->input->post('status'), 
                               'izpildes_gaita' => $this->input->post('izpildes_gaita')
                               );

            if($this->tasks_model->change_task($id ,$task_data)){
                $data['success'] = "Saglabats!";
            }
        }else{
            if(!empty($_POST)){
                $data['error'] = "Aizpildet visus obligatus laukus!";
            }
        } 

        $data['user'] = $this->ion_auth->user()->row();

        $data['task'] = $this->tasks_model->getTasks($id);
        
        //$data['task'] = $this->main->getDataById('tasks', $id);
        $data['main_user'] = $this->tasks_model->task_users($id, 2);
        $task_users = $this->tasks_model->task_users($id);
        foreach($task_users as $k => $v){
            $data['task_users'][] = $v['user_id']; 
        }
        $data['users_number'] = count($data['task_users']);
        $data['users'] = $this->main->getAll('users', array('by' => 'first_name', 'order' => 'desc'));
        $data['status'] = $this->main->getAll('status', array('by' => 'name', 'order' => 'desc'));

        $data['page']['title'] = $data['task']->name;

        $this->load->view('header.php', $data);
        $this->load->view('tasks/task_users.php', $data);
        $this->load->view('footer.php', $data);
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