<?php
class Main extends CI_Model  {

	function __construct()
    {
        parent::__construct();
    }

    public function getAll($table ,$ord = array('by' => 'id', 'order' => 'desc'), $limit = false)
    {
    	$query = $this->db->order_by($ord['by'], $ord['order']);
    	$query = $this->db->get($table);
    	if($limit){
    		$query = $this->db->limit($limit);
    	}
    	return $query->result();
    }

    public function getDataById($table, $id)
    {
    	$query = $this->db->where('id', $id);
    	$query = $this->db->get($table);
    	return $query->row();
    }

    public function update($table, $id, $array)
    {
    	$query = $this->db->where('id', $id);
    	$query = $this->db->update($table, $array);
    	return $query;
    }

    public function insert($table, $array)
    {
    	$query = $this->db->insert($table, $array);
    	return $query;
    }

    public function delete($table, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete($table); 
    }
    
    public function getDatums()
    {
        $result = $this->db->query("SELECT CURDATE() as date");
        //$result = $this->db->get();
        return $result->row();
    }
    
    public function ConvertDate($value)
    {
         $dati = array(
            '01' => 'janvāris',
            '02' => 'februāris',
            '03' => 'marts',
            '04' => 'aprīlis',
            '05' => 'maijs',
            '06' => 'jūnijs',
            '07' => 'jūlijs',
            '08' => 'augusts',
            '09' => 'septembris',
            '10' => 'oktobris',
            '11' => 'novembris',
            '12' => 'decembris'
                );
         
         //0 - gads
         //1 - menes
         //2 - diena
         
         $work = explode("-", $value);

        //return $work.' '.$value ;
         return $work[0].'.gada '.$work[2].'.'.$dati[$work[1]];
    }
    
    public function ConvertDateEng($value)
    {
        $dati = array(
            '01' => 'january.',
            '02' => 'february',
            '03' => 'march',
            '04' => 'april',
            '05' => 'may',
            '06' => 'june',
            '07' => 'july',
            '08' => 'august',
            '09' => 'september',
            '10' => 'october',
            '11' => 'november',
            '12' => 'december'
                );
         
         //0 - gads
         //1 - menes
         //2 - diena
         
         $work = explode("-", $value);

        //return $work.' '.$value ;
         return $work[0].'.gada '.$work[2].'.'.$dati[$work[1]];
    }
    
    public function Date($date)
    {
        $work = date_create($date);
        return date_format($work, 'd.m.Y.');
    }

}    