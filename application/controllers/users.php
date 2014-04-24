<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    
    function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
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

            $data['users'] = $this->ion_auth->users()->result();
            
            $data['page']['title'] = 'Lietotaji';
            
            $this->load->view('header.php', $data);
            $this->load->view('document/user.php', $data);
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

            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
            $this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
            $this->form_validation->set_rules('rep_password', 'Rep. Password', 'required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
            $this->form_validation->set_rules('first_name', 'First Name', 'xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'xss_clean');

            if ($this->form_validation->run() == true){
                if($this->input->post('password') == $this->input->post('rep_password')){
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $email = $this->input->post('email');
                    $additional_data = array('first_name' => $this->input->post('first_name'),
                                             'last_name' => $this->input->post('last_name'),
                                             'phone' => $this->input->post('phone'),
                                             'active' => $this->input->post('active'));
                    $group = array($this->input->post('group'));

                    if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)){
                        redirect('users');
                    }
                }else{
                    $data['error'] = "Parole nesakrit!";
                }
            }else{
                if(!empty($_POST)){
                    $data['error'] = "Aizpildet visus obligatus laukus!";
                }
            }

            
            $data['user'] = $this->ion_auth->user()->row();
            $data['groups'] = $this->ion_auth->get_users_groups()->result();

            $data['page']['title'] = 'Pievienot lietotaju';
            
            $this->load->view('header.php', $data);
            $this->load->view('document/add_user.php', $data);
            $this->load->view('footer.php', $data);

        }    
    }

    public function change($id){
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
            $this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
            $this->form_validation->set_rules('first_name', 'First Name', 'xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'xss_clean');

            if ($this->form_validation->run() == true){
                $user_data = array('first_name' => $this->input->post('first_name'),
                                   'last_name' => $this->input->post('last_name'),
                                   'phone' => $this->input->post('phone'),
                                   'username' => $this->input->post('username'),
                                   'email' => $this->input->post('email'),
                                   'active' => $this->input->post('active')
                                   );

                $user_group = $this->input->post('group');
                if(isset($user_group) &&  !empty($user_group)){
                    $this->ion_auth->remove_from_group('', $id);
                    $this->ion_auth->add_to_group($user_group, $id);
                }

                if($this->ion_auth->update($id, $user_data)){
                    $data['success'] = 'Saglabats!';
                }
            }else{
                if(!empty($_POST)){
                    $data['error'] = "Aizpildet visus obligatus laukus!";
                }
            }

            $data['user'] = $this->ion_auth->user()->row();
            $data['groups'] = $this->ion_auth->get_users_groups()->result();

            $data['user_group'] = $this->ion_auth->get_users_groups($id)->row();
            $data['user_data'] = $this->ion_auth->user($id)->row();

            $data['page']['title'] = 'Izmainit lietotaju';

            $this->load->view('header.php', $data);
            $this->load->view('document/change_user.php', $data);
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

            $this->ion_auth->delete_user($id);
            redirect('users');

        }    
    }

    public function password($id)
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }

        if(!$this->ion_auth->is_admin()){
            $this->error();
        }else{

            $this->form_validation->set_rules('rep_password', 'Rep. Password', 'required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');

            if ($this->form_validation->run() == true){
                if($this->input->post('password') == $this->input->post('rep_password')){
                    if($this->ion_auth->update($id, array('password' => $this->input->post('password')))){
                        $data['success'] = 'Saglabats!';
                    }
                }else{
                    $data['error'] = "Parole nesakrit!"; 
                }
            }else{
                if(!empty($_POST)){
                    $data['error'] = "Aizpildet visus obligatus laukus!";
                }
            }    

            $data['user'] = $this->ion_auth->user()->row();
            $data['page']['title'] = 'Parole mainišana';

            $this->load->view('header.php', $data);
            $this->load->view('document/new_password.php', $data);
            $this->load->view('footer.php', $data);

        }    
    }
    
    public function personal()
    {
        if (!$this->ion_auth->logged_in()){
            redirect('login');
        }
        
        $this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
        $this->form_validation->set_rules('first_name', 'Vards', 'xss_clean');
        $this->form_validation->set_rules('last_name', 'Uzvards', 'xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'xss_clean');
        $this->form_validation->set_rules('rep_password', 'Rep. Password', 'xss_clean');
        
        if ($this->form_validation->run() == true){
            $id = $this->ion_auth->user()->row()->id;
            $user_data = array('first_name' => $this->input->post('first_name'),
                               'last_name' => $this->input->post('last_name'),
                               'phone' => $this->input->post('phone'),
                               'username' => $this->input->post('username'),
                               'email' => $this->input->post('email')
                               );

            if($this->ion_auth->update($id, $user_data)){
                $data['success'] = 'Saglabats!';
            }
            
            
            $password = $this->input->post('password');
            if(!empty($password)){
                if($this->input->post('password') == $this->input->post('rep_password')){
                    if($this->input->post('password') == $this->input->post('rep_password')){
                        if($this->ion_auth->update($id, array('password' => $this->input->post('password')))){
                            $data['success'] .= 'Jauns parole saglabats!';
                        }
                    }else{
                        $data['error'] = "Parole nesakrit!"; 
                    }
                }
            }   
        }else{
            if(!empty($_POST)){
                $data['error'] = "Aizpildet visus obligatus laukus!";
            }
        }
        
        $data['user'] = $this->ion_auth->user()->row();
        $data['page']['title'] = 'Savus datus mainišana';

        $this->load->view('header.php', $data);
        $this->load->view('document/personal_data.php', $data);
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