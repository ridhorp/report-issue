<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard_error extends CI_model
{

    public function get_error()
    {
        $data = $this->db->get('dashboard_error');
        return $data;
    }

    public function get_id_error($id)
    {
        return $this->db->get_where('dashboard_error', ['id' => $id])->row_array();
    }

    public function detail_error($id)
    {
        $query = $this->db->get_where('dashboard_error', array('id' => $id))->row();
        return $query;
    }

    public function insert_error()
    {
        $data = [
            'entry_date'        => $this->input->post('entry_date'),
            'divisi'            => $this->session->userdata('divisi'),
            'customer'          => $this->input->post('customer'),
            'product'           => $this->input->post('product'),
            'material_quantity' => $this->input->post('material_quantity'),
            'material_loss'     => $this->input->post('material_loss'),
            'service_loss'      => $this->input->post('service_loss'),
            'error_category'    => $this->input->post('error_category'),
            'error_type'        => $this->input->post('error_type'),
            'description'       => $this->input->post('description'),
            'reason'            => $this->input->post('reason'),
            'solution'          => $this->input->post('solution'),
            'pic'               => $this->input->post('pic'),
            'problem_solve'     => $this->input->post('problem_solve')
        ];
        $data = $this->db->insert('dashboard', $data);
        return $data;
    }

    public function deleteError($id)
    {
        $query = "DELETE FROM dashboard_error WHERE id = $id";
        $this->db->query($query);
        redirect('dashboard');
    }
}
