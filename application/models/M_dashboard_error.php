<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard_error extends CI_model
{

    public function get_error()
    {
        $data = $this->db->get('dashboard_error')->result_array();
        return $data;
    }

    public function insert_error()
    {
        $data = $this->db->insert('dashboard_error', ['admin' => $this->input->post('admin')]);
        return $data;
    }
}
