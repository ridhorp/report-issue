<?php
class M_Category extends CI_model
{
    private $_table = "error_category";

    function get_category(){
        $query = $this->db->get('error_category');
        return $query;  
    }

    public function get_id_category($id)
    {
        return $this->db->get_where('error_category', ['id' => $id])->row_array();
    }

    public function insert_category()
    {
        $data = $this->db->insert('error_category', ['name' => $this->input->post('category')]);
        return $data; 
    }

    public function deleteCategory($id)
    {
        $query = "DELETE FROM error_category WHERE id = $id";
        $this->db->query($query);
        redirect('datamaster/category');
    }
}