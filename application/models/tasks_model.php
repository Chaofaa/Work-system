<?php
class Tasks_model extends CI_Model  {

	function __construct()
    {
        parent::__construct();
    }

    
    public function getTaskFilter($id_person = false, $name = false)
    {
        if($id_person){
            $this->db->select('task_id');
            $this->db->where('user_id', $id_person);
            $task = $this->db->get('task_users');

            if($task->num_rows() > 0){
                $array = array();
                foreach($task->result() as $row){
                    $array[] = $row->task_id;
                }
                $this->db->where_in('t.id', $array);

            }
        }    

        $tasks = $this->db->get('tasks');
        $number = count($tasks->result_array());
        $tasks = $tasks->result();
        
        if($tasks){
            switch ($name) {
                case 'status':
                    $array = array();
                    foreach($tasks as $row){
                        array_push($array, $row->status);
                    }
                    
                    $this->db->where_in('id', $array);
                    $this->db->order_by('name', 'DESC');
                    $status = $this->db->get('status');
                    return $status->result();
                    
                    break;
                case 'prioritate':
                    $array = array();
                    foreach($tasks as $row){
                        array_push($array, $row->prioritate);
                    }
                    
                    $this->db->where_in('id', $array);
                    $this->db->order_by('name', 'DESC');
                    $prioritate = $this->db->get('prioritate');
                    return $prioritate->result();
                    
                    break;
                case 'lieta':
                    $array = array();
                    foreach($tasks as $row){
                        array_push($array, $row->lieta);
                    }
                    
                    $this->db->where_in('id', $array);
                    $this->db->order_by('name', 'DESC');
                    $lieta = $this->db->get('lieta');
                    return $lieta->result();
                    
                    break;
                case 'clients':
                    $array = array();
                    foreach($tasks as $row){
                        array_push($array, $row->klients);
                    }
                    
                    $this->db->where_in('id', $array);
                    $this->db->order_by('name', 'DESC');
                    $klients = $this->db->get('clients');
                    return $klients->result();
                    
                    break;
                case 'sadala':
                    $array = array();
                    foreach($tasks as $row){
                        array_push($array, $row->sadala);
                    }
                    
                    $this->db->where_in('id', $array);
                    $this->db->order_by('name', 'DESC');
                    $sadala = $this->db->get('sadala');
                    return $sadala->result();
                    
                    break;
                default:
                    $result = array(
                                    'status' => $this->getTaskFilter($id_person, 'status'),
                                    'prioritate' => $this->getTaskFilter($id_person, 'prioritate'),
                                    'lieta' => $this->getTaskFilter($id_person, 'lieta'),
                                    'clients' => $this->getTaskFilter($id_person, 'clients'),
                                    'sadala' => $this->getTaskFilter($id_person, 'sadala')
                                    );
                    
                    return $result;
                    break;
            } 
        }else{
            return false;
        }    
    }

    public function insert_task($data, $main_user, $users)
    {
        $this->db->set('add_date', 'NOW()', FALSE);
        $query = $this->db->insert('tasks', $data);
        if($query){ 
            $insert_id = $this->db->insert_id();

            if(isset($main_user) && !empty($main_user)){
                $this->db->set('task_id', $insert_id);
                $this->db->set('user_id', $main_user);
                $this->db->set('type', '2');
                $this->db->insert('task_users');
            }

            if(isset($users) && !empty($users)){
                foreach($users as $k => $v){
                    $this->db->set('task_id', $insert_id);
                    $this->db->set('user_id', $v);
                    $this->db->insert('task_users');
                }
            }
            return true;
        }else{
            return false;
        }
    }

    public function change_task($id, $data, $main_user = false, $users = false)
    {
        $this->db->where('id', $id);
        $this->db->update('tasks', $data);

        if(isset($main_user) && !empty($main_user)){
            $this->db->where('task_id', $id);
            $this->db->where('type', '2');
            $this->db->delete('task_users');
            $this->db->set('task_id', $id);
            $this->db->set('user_id', $main_user);
            $this->db->set('type', '2');
            $this->db->insert('task_users');
        }

        if(isset($users) && !empty($users)){
            $this->db->where('task_id', $id);
            $this->db->where('type', '1');
            $this->db->delete('task_users');
            foreach($users as $k => $v){
                $this->db->set('task_id', $id);
                $this->db->set('user_id', $v);
                $this->db->insert('task_users');
            }
        }
    }      

    public function getTasks($id = false)
    {
        
        if($id){
            $this->db->where('t.id', $id);
        }elseif($this->session->userdata('t_filter')){
            $filter = $this->session->userdata('t_filter');
            $filter_data = array();
            
            if($filter['status'] != 0){
                $filter_data['t.status'] = $filter['status'];
            }
            
            if($filter['prioritate'] != 0){
                $filter_data['t.prioritate'] = $filter['prioritate'];
            }
            
            if($filter['lieta'] != 0){
                $filter_data['t.lieta'] = $filter['lieta'];
            }
            
            if($filter['klients'] != 0){
                $filter_data['t.klients'] = $filter['klients'];
            }
            
            if($filter['sadala'] != 0){
                $filter_data['t.sadala'] = $filter['sadala'];
            }
            
            if($filter['no-datums']){
                $this->db->where('t.add_date >=', $filter['no-datums']);
            }
            
            if($filter['lidz-datums']){
                $this->db->where('t.add_date <=', $filter['lidz-datums']);
            }
            
            $this->db->where($filter_data);
        }

        $this->db->order_by('id', 'DESC');
        $this->db->distinct();
        $this->db->select('t.name, t.uzdevums, t.izpildes_gaita, t.add_date');
        $this->db->select('t.id, t.privats, t.termins, st.name AS status_name, st.id AS status_id');
        $this->db->select('sa.name AS sadala_name, sa.id AS sadala_id, cl.name AS clients_name, cl.id AS clients_id');
        $this->db->select('li.name AS lieta_name, li.id AS lieta_id, pr.name AS pr_name, pr.id AS pr_id');
        $this->db->from('tasks AS t');
        $this->db->join('status_dump AS st', 'st.id = t.status', 'left');
        $this->db->join('sadala_dump AS sa', 'sa.id = t.sadala', 'left');
        $this->db->join('clients_dump AS cl', 'cl.id = t.klients', 'left');
        $this->db->join('lieta_dump AS li', 'li.id = t.lieta', 'left');
        $this->db->join('prioritate_dump AS pr', 'pr.id = t.prioritate', 'left');
        $result = $this->db->get();
        //return $result->result();

        
        
        if($id){
            return $result->row();
        }else{
            return $result->result();
        } 
    }

    public function getUserTasks($id, $limit = false)
    {
        $this->db->select('task_id');
        $this->db->where('user_id', $id);
        $task = $this->db->get('task_users');

        if($task->num_rows() > 0){
            $array = array();
            foreach($task->result() as $row){
                $array[] = $row->task_id;
            }
            $this->db->where_in('t.id', $array);

            if($this->session->userdata('u_filter')){
                $session = $this->session->userdata('u_filter');
                $filter = array();
                if($session['status']){
                    $this->db->where('st.id', $session['status']);
                }
                if($session['clients']){
                    $this->db->where('cl.id', $session['clients']);
                }
                if($session['sadala']){
                    $this->db->where('sa.id', $session['sadala']);
                }
            }

            if($limit){
                $this->db->limit($limit);
            }

            $this->db->order_by('id', 'DESC');
            $this->db->distinct();
            $this->db->select('t.name, t.uzdevums, t.izpildes_gaita, t.add_date');
            $this->db->select('t.id, t.privats, t.termins, st.name AS status_name');
            $this->db->select('sa.name AS sadala_name, cl.name AS clients_name');
            $this->db->select('li.name AS lieta_name, pr.name AS pr_name');
            $this->db->from('tasks AS t');
            $this->db->join('status_dump AS st', 'st.id = t.status', 'left');
            $this->db->join('sadala_dump AS sa', 'sa.id = t.sadala', 'left');
            $this->db->join('clients_dump AS cl', 'cl.id = t.klients', 'left');
            $this->db->join('lieta_dump AS li', 'li.id = t.lieta', 'left');
            $this->db->join('prioritate_dump AS pr', 'pr.id = t.prioritate', 'left');
            $result = $this->db->get();

            return $result->result();
        }else{
            return false;
        }
    }


    public function task_users($id, $type = 1)
    {
        if($type == 1){
            $this->db->where('task_users.type', '1');
        }elseif($type == 2){
            $this->db->where('task_users.type', '2');
        }

        $this->db->where('task_users.task_id', $id);
        //$this->db->select('users.first_name', 'users.last_name');
        $this->db->from('task_users');
        $this->db->join('users_dump', 'task_users.user_id = users_dump.id', 'left');
        $query = $this->db->get();

        if($type == 1){
            return $query->result_array();
        }elseif($type == 2){
            return $query->row();
        }    
    }

    public function getTaskUsersId($task_id)
    {
        $this->db->select('user_id');
        $this->db->where('task_id', $task_id);
        $query = $this->db->get('task_users');
        return $query->result_array();
    }

    public function deleteTask($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tasks');

        $this->db->where('task_id', $id);
        $this->db->delete('task_users');
    }

}
