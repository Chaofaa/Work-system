<?php
class Invoice_model extends CI_Model  {

    function __construct()
    {
        parent::__construct();
    }

    public function getInvoiceFilter()
    {

    }
    
    public function getAll()
    {
        if($this->session->userdata('invoice')){
            $filter = $this->session->userdata('invoice');
            $filter_data = array();
            
            if($filter['klients'] != 0){
                $filter_data['i.klients'] = $filter['klients'];
            }

            if($filter['tips'] != 0){
                $filter_data['i.tips'] = $filter['tips'];
            }

            if($filter['status'] != 0){
                $filter_data['i.status'] = $filter['status'];
            }
                 
            if($filter['no-datums']){
                $this->db->where('i.rek_datums >=', $filter['no-datums']);
            }
            
            if($filter['lidz-datums']){
                $this->db->where('i.rek_datums <=', $filter['lidz-datums']);
            }
            
            $this->db->where($filter_data);
        }

        $this->db->order_by('rek_datums', 'DESC');
        $this->db->select('i.*, c.name AS client_name');
        $this->db->from('invoice AS i');
        $this->db->join('clients_dump AS c', 'c.id = i.klients', 'left');
        $result = $this->db->get();
        return $result->result();
    }
 
    public function add($data){
        $main = array(
                     'rek_nr' => $data['f_nr'],
                     'rek_datums' => $data['f_datums'],
                     'piegadatajs' => $data['me'],
                     'klients' => $data['klients'],
                     'kopa' => $data['kopa'],
                     'pvn' => $data['pvn'],
                     'sum_kopa' => $data['sum_kopa'],
                     'no' => $data['no'],
                     'lidz' => $data['lidz'],
                     'pamats' => $data['pamats'],
                     'apmaksas_type' => $data['apmaksas_type'],
                     'apmaksas_termins' => $data['apmaksas_termins'],
                     'valde' => $data['valde'],
                     'tips' => $data['tips'],
                     'status' => $data['status']
                     );
        $this->db->insert('invoice', $main);
        
        $id = $this->db->insert_id();
        
        $number = $this->input->post('number');
        $lieta = $this->input->post('lieta');
        $datums = $this->input->post('datums');
        $datums_lidz = $this->input->post('datums-lidz');
        $apraksts = $this->input->post('apraksts');
        $type = $this->input->post('type');
        $time = $this->input->post('time');
        $cena = $this->input->post('cena');
        $sum = $this->input->post('sum');
        
        foreach($number as $i){
            if(!empty($lieta[$i])){
                $second = array(
                    'id_invoice' => $id,
                    'nr' => $number[$i],
                    'lieta' => $lieta[$i],
                    'datums' => $datums[$i],
                    'datums_lidz' => $datums_lidz[$i],
                    'apraksts' => $apraksts[$i],
                    'type' => $type[$i],
                    'time' => $time[$i],
                    'cena' => $cena[$i],
                    'sum' => $sum[$i],
                    'date' => date('Y-m-d H:i:s')
                                );
                //$result[] = $second;
                $this->db->insert('invoice_data', $second);
            }
            
        }
        
        
        return $id;
    }
    
    public function update($data, $id)
    {
        $main = array(
                     'rek_nr' => $data['f_nr'],
                     'rek_datums' => $data['f_datums'],
                     'piegadatajs' => $data['me'],
                     'klients' => $data['klients'],
                     'kopa' => $data['kopa'],
                     'pvn' => $data['pvn'],
                     'sum_kopa' => $data['sum_kopa'],
                     'no' => $data['no'],
                     'lidz' => $data['lidz'],
                     'pamats' => $data['pamats'],
                     'apmaksas_type' => $data['apmaksas_type'],
                     'apmaksas_termins' => $data['apmaksas_termins'],
                     'valde' => $data['valde'],
                     'tips' => $data['tips'],
                     'status' => $data['status']
                     );
        $this->db->where('id', $id);
        $this->db->update('invoice', $main);
        
        $this->db->where('id_invoice', $id);
        $this->db->delete('invoice_data');
        
        $number = $this->input->post('number');
        $lieta = $this->input->post('lieta');
        $datums = $this->input->post('datums');
        $datums_lidz = $this->input->post('datums-lidz');
        $apraksts = $this->input->post('apraksts');
        $type = $this->input->post('type');
        $time = $this->input->post('time');
        $cena = $this->input->post('cena');
        $sum = $this->input->post('sum');
        
        foreach($number as $i){
            if(!empty($lieta[$i])){
                $second = array(
                    'id_invoice' => $id,
                    'nr' => $number[$i],
                    'lieta' => $lieta[$i],
                    'datums' => $datums[$i],
                    'datums_lidz' => $datums_lidz[$i],
                    'apraksts' => $apraksts[$i],
                    'type' => $type[$i],
                    'time' => $time[$i],
                    'cena' => $cena[$i],
                    'sum' => $sum[$i],
                    'date' => date('Y-m-d H:i:s')
                                );
                //$result[] = $second;
                $this->db->insert('invoice_data', $second);
            }
            
        }
    }

    public function getFilter()
    {
        $invoice = $this->db->get('invoice');
        $invoice = $invoice->result();
        
        if($invoice){
            $array = array();
            foreach($invoice as $row){
                array_push($array, $row->klients);
            }

            $this->db->where_in('id', $array);
            $this->db->order_by('name', 'DESC');
            $result = $this->db->get('clients');
            //return $result->result();
            return $result->result();
        }else{
            return false;
        }    
    }


    public function listData($id)
    {
        $this->db->where('id_invoice',$id);
        $this->db->order_by('nr', 'DESC');
        $result = $this->db->get('invoice_data');
        
        return $result->result();
    }
    
    public function deleteInvoice($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('invoice');
        
        $this->db->where('id_invoice', $id);
        $this->db->delete('invoice_data');
    }
    
    function num2words($num) {
        $ZERO = "nulle";
        $MINUS = "mīnus";
        $lowName = array(
            /* zero is shown as "" since it is never used in combined forms */
            /* 0 .. 19 */
            "", "viens", "divi", "trīs", "četri", "pieci",
            "seši", "septiņi", "astoņi", "deviņi", "desmit",
            "vienpadsmit", "divpadsmit", "trīspadsmit", "četrpadsmit", "piecpadsmit",
            "sešpadsmit", "septiņpadsmit", "astoņpadsmit", "deviņpadsmit");

        $tys = array(
            /* 0, 10, 20, 30 ... 90 */
            "", "", "divdesmit", "trīsdesmit", "četrdesmit", "piecdesmit",
            "sešdesmit", "septiņdesmit", "astoņdesmit", "deviņdesmit");

        $groupName = array(
            /* We only need up to a quintillion, since a long is about 9 * 10 ^ 18 */
            /* American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion */
            "", "simti", "tūkstoši", "miljoni", "miljardi",
            "triljoni", "kvadtriljoni", "kvantiljoni");

        $divisor = array(
            /* How many of this group is needed to form one of the succeeding group. */
            /* American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion */
            100, 100, 1000, 1000, 1000, 1000, 1000, 1000);

        $num = str_replace(",", "", $num);
        $num = number_format($num, 2, '.', '');
        $cents = substr($num, strlen($num) - 2, strlen($num) - 1);
        $num = (int) $num;

        $s = "";

        if ($num == 0)
            $s = $ZERO;
        $negative = ($num < 0 );
        if ($negative)
            $num = -$num;

        // Work least significant digit to most, right to left.
        // until high order part is all 0s.
        for ($i = 0; $num > 0; $i++) {
            $remdr = (int) ($num % $divisor[$i]);
            $num = $num / $divisor[$i];
            // check for 1100 .. 1999, 2100..2999, ... 5200..5999
            // but not 1000..1099,  2000..2099, ...
            // Special case written as fifty-nine hundred.
            // e.g. thousands digit is 1..5 and hundreds digit is 1..9
            // Only when no further higher order.
            if ($i == 1 /* doing hundreds */ && 1 <= $num && $num <= 5) {
                if ($remdr > 0) {
                    $remdr += $num * 10;
                    $num = 0;
                } // end if
            } // end if
            if ($remdr == 0) {
                continue;
            }
            $t = "";
            if ($remdr < 20) {
                $t = $lowName[$remdr];
            } else if ($remdr < 100) {
                $units = (int) $remdr % 10;
                $tens = (int) $remdr / 10;
                $t = $tys [$tens];
                if ($units != 0) {
                    $t .= " " . $lowName[$units];
                }
            } else {
                $t = $inWords($remdr);
            }
            $s = $t . " " . $groupName[$i] . " " . $s;
            $num = (int) $num;
        } // end for
        $s = trim($s);
        if ($negative) {
            $s = $MINUS . " " . $s;
        }

        $s .= " eiro un $cents centi";

        return $s;
    }
    
}
        
