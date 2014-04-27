<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lieta extends CI_Controller {
    
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

            $data['lieta'] = $this->main->getAll('lieta', array('by' => 'name', 'order' => 'desc'));
            
            $data['page']['title'] = 'Lieta';
            
            $this->load->view('header.php', $data);
            $this->load->view('lieta/lieta.php', $data);
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

            $this->form_validation->set_rules('name', 'Name', 'xss_clean|required');
            $this->form_validation->set_rules('comment', 'Comment', 'xss_clean');

            if ($this->form_validation->run() == true){
                $lieta_data = array('name' => $this->input->post('name'),
                                    'info'=> $this->input->post('comment')
                                    );
                if($this->main->update('lieta', $id, $lieta_data)){
                    $this->main->update('lieta_dump', $id, $lieta_data);
                    $data['success'] = "Saglabats";
                }
            }else{
                if(!empty($_POST)){
                    $data['error'] = "Aizpildet visus obligatus laukus!";
                }
            }    

            $data['user'] = $this->ion_auth->user()->row();

            $data['page']['title'] = 'Lieta mmainišana';

            $data['lieta'] = $this->main->getDataById('lieta', $id);
            
            $this->load->view('header.php', $data);
            $this->load->view('lieta/lieta_change.php', $data);
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

            $this->form_validation->set_rules('name', 'Name', 'xss_clean|required');
            $this->form_validation->set_rules('comment', 'Comment', 'xss_clean');

            if ($this->form_validation->run() == true){
                    $lieta_data = array('name' => $this->input->post('name'),
                                    'info'=> $this->input->post('comment')
                                    );
                    $lieta_data_dump = array(
                                    'id' => $this->main->insert('lieta', $lieta_data),
                                    'name' => $this->input->post('name'),
                                    'info'=> $this->input->post('comment')
                                    );
                    $this->main->insert('lieta_dump', $lieta_data_dump);
                    redirect('lieta');
            }else{
                if(!empty($_POST)){
                    $data['error'] = "Aizpildet visus obligatus laukus!";
                }
            }    
            
            $data['user'] = $this->ion_auth->user()->row();

            $data['page']['title'] = 'Lieta pievinošana';
            
            $this->load->view('header.php', $data);
            $this->load->view('lieta/lieta_add.php', $data);
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

            $this->main->delete('lieta', $id);
            redirect('lieta');

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