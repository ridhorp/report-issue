<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_divisi extends CI_Model{

    function get_divisi(){
        $query = $this->db->get('divisi');

        return $query;  
    }

}