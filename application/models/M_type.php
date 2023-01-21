<?php
class M_type extends CI_model
{
    private $_table = "error_type";

    function get_type(){
        $query = $this->db->get('error_type');
        return $query;  
    }

    public function get_id_type($id)
    {
        return $this->db->get_where('error_type', ['id' => $id])->row_array();
    }

    public function insert_type()
    {

        $data = [
            'name'     => $this->input->post('type'),
            'definition'   => $this->input->post('definition'),
        ];
        $this->db->insert('error_type', $data);
        return $data;
    }

    public function deleteType($id)
    {
        $query = "DELETE FROM error_type WHERE id = $id";
        $this->db->query($query);
        redirect('datamaster/type');
    }
}