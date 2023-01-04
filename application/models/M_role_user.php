<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_role_user extends CI_model
{

    public function get_role()
    {
        $data = $this->db->get('user_role')->result_array();
        return $data;
    }

    public function get_access()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('menuId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $data = $this->db->get_where('user_access_menu', $data);
        return $data;
    }

    public function get_idrole()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('menuId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $data = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        return $data;
    }

    public function insert_access()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('menuId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $data = $this->db->insert('user_access_menu', $data);
    }

    public function delete_access()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('menuId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $data = $this->db->delete('user_access_menu', $data);
    }
}
