<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sub_menu extends CI_model
{

    public function get_submenu()
    {
        $data = $this->db->get('user_sub_menu')->result_array();
        return $data;
    }

    public function insert_submenu()
    {
        $data = [
            'title'     => $this->input->post('title'),
            'menu_id'   => $this->input->post('menu_id'),
            'url'       => $this->input->post('url'),
            'icon'      => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active'),
        ];
        $data = $this->db->insert('user_sub_menu', $data);
        return $data;
    }

    public function deleteSubmenu($id)
    {
        $query = "DELETE FROM user_sub_menu WHERE id = $id";
        $this->db->query($query);
        redirect('menu/submenu');
    }
}
