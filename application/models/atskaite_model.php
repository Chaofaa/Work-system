<?php
class Atskaite_model extends CI_Model  {

    function __construct()
    {
        parent::__construct();
    }
    
    public function getAtskaites($limit = false){
        if(!$this->ion_auth->is_admin()){
            $this->db->where('u.darbinieks', $this->ion_auth->user()->row()->id);
        }
        
        if($this->session->userdata('a_filter')){
            $filter = $this->session->userdata('a_filter');
            $filter_data = array();
            
            if($filter['darbinieks'] != 0){
                $filter_data['u.darbinieks'] = $filter['darbinieks'];
            }
            
            if($filter['sadala'] != 0){
                $filter_data['u.sadala'] = $filter['sadala'];
            }
            
            if($filter['klients'] != 0){
                $filter_data['u.klients'] = $filter['klients'];
            }
            
            if($filter['lieta'] != 0){
                $filter_data['u.lieta'] = $filter['lieta'];
            }
            
            if($filter['no-datums']){
                $this->db->where('datums >=', $filter['no-datums']);
            }
            
            if($filter['lidz-datums']){
                $this->db->where('datums <=', $filter['lidz-datums']);
            }
            
            $this->db->where($filter_data);
        }

        if($limit){
            $this->db->limit($limit);
        }
        $this->db->order_by('datums', 'DESC');
        $this->db->distinct();
        $this->db->select('u.datums, u.apraksts, u.time, u.piezimes');
        $this->db->select('u.id, u.papildus_izmaksas, us.first_name, us.last_name');
        $this->db->select('sa.name AS sadala_name, cl.name AS clients_name');
        $this->db->select('li.name AS lieta_name');
        $this->db->select('SUM(u.time) AS total_time');
        $this->db->from('uzskaite AS u');
        $this->db->group_by('u.id');
        $this->db->join('users_dump AS us', 'us.id = u.darbinieks', 'left');
        $this->db->join('sadala_dump AS sa', 'sa.id = u.sadala', 'left');
        $this->db->join('clients_dump AS cl', 'cl.id = u.klients', 'left');
        $this->db->join('lieta_dump AS li', 'li.id = u.lieta', 'left');
        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return false;
        }
    }
    
    public function getAtskaitesKlientiem()
    {
        if($this->session->userdata('klientiem')){
            $filter = $this->session->userdata('klientiem');
            $filter_data = array();
            
            if($filter['klients'] != 0){
                $filter_data['u.klients'] = $filter['klients'];
            }
            
            if($filter['no-datums']){
                $this->db->where('datums >=', $filter['no-datums']);
            }
            
            if($filter['lidz-datums']){
                $this->db->where('datums <=', $filter['lidz-datums']);
            }
            
            $this->db->where($filter_data);
        }
        
        $this->db->order_by('datums', 'DESC');
        $this->db->distinct();
        $this->db->select('u.datums, u.apraksts, u.time, u.piezimes');
        $this->db->select('u.id, u.papildus_izmaksas, us.first_name, us.last_name');
        $this->db->select('sa.name AS sadala_name, cl.name AS clients_name');
        $this->db->select('li.name AS lieta_name');
        $this->db->select('SUM(u.time) AS total_time');
        $this->db->group_by('u.klients');
        $this->db->from('uzskaite AS u');
        $this->db->join('users_dump AS us', 'us.id = u.darbinieks', 'left');
        $this->db->join('sadala_dump AS sa', 'sa.id = u.sadala', 'left');
        $this->db->join('clients_dump AS cl', 'cl.id = u.klients', 'left');
        $this->db->join('lieta_dump AS li', 'li.id = u.lieta', 'left');
        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return false;
        }
    }
     
    public function getAtskaitesDarbiniekiem()
    {
        if($this->session->userdata('darbiniekiem')){
            $filter = $this->session->userdata('darbiniekiem');
            $filter_data = array();
            
            if($filter['darbinieks'] != 0){
                $filter_data['u.darbinieks'] = $filter['darbinieks'];
            }
            
            if($filter['no-datums']){
                $this->db->where('datums >=', $filter['no-datums']);
            }
            
            if($filter['lidz-datums']){
                $this->db->where('datums <=', $filter['lidz-datums']);
            }
            
            $this->db->where($filter_data);
        }
        
        $this->db->order_by('datums', 'DESC');
        $this->db->distinct();
        $this->db->select('u.datums, u.apraksts, u.time, u.piezimes');
        $this->db->select('u.id, u.papildus_izmaksas, us.first_name, us.last_name');
        $this->db->select('sa.name AS sadala_name, cl.name AS clients_name');
        $this->db->select('li.name AS lieta_name');
        $this->db->select('SUM(u.time) AS total_time');
        $this->db->select('COUNT(DISTINCT u.datums) AS total_days');
        $this->db->group_by('u.darbinieks');
        $this->db->from('uzskaite AS u');
        $this->db->join('users_dump AS us', 'us.id = u.darbinieks', 'left');
        $this->db->join('sadala_dump AS sa', 'sa.id = u.sadala', 'left');
        $this->db->join('clients_dump AS cl', 'cl.id = u.klients', 'left');
        $this->db->join('lieta_dump AS li', 'li.id = u.lieta', 'left');
        $result = $this->db->get();

        if($result->num_rows() > 0){
            return $result->result();
        }else{
            return false;
        }
    }
    
    public function getFilter($name)
    {
        if(!$this->ion_auth->is_admin()){
            $this->db->where('darbinieks', $this->ion_auth->user()->row()->id);
        }
        
        $atskaite = $this->db->get('uzskaite');
        $atskaite = $atskaite->result();
        
        if($atskaite){

            if($name == 'klients'){
                $array = array();
                foreach($atskaite as $row){
                    array_push($array, $row->$name);
                }

                $this->db->where_in('id', $array);
                $this->db->order_by('id', 'DESC');
                $result = $this->db->get('clients');
                return $result->result();
            }elseif($name == 'darbinieks'){
                $array = array();
                foreach($atskaite as $row){
                    array_push($array, $row->$name);
                }

                $this->db->where_in('id', $array);
                $this->db->order_by('first_name', 'DESC');
                $result = $this->db->get('users');
                return $result->result();
            }else{
                $array = array();
                foreach($atskaite as $row){
                    array_push($array, $row->$name);
                }

                $this->db->where_in('id', $array);
                $this->db->order_by('name', 'DESC');
                $result = $this->db->get($name);
                //return $result->result();
                return $result->result();
            }
        }else{
            return false;
        }    
    }
    
    public function getAtskaitesFilter()
    {
       
            $result = array(
                            'darbinieks' => $this->getFilter('darbinieks'),
                            'sadala' => $this->getFilter('sadala'),
                            'klients' => $this->getFilter('klients'),
                            'lieta' => $this->getFilter('lieta')
                            );

            return $result;
        
    }
    
    
}