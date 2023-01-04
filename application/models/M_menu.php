<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_menu extends CI_model
{

    public function get_menu()
    {
        $data = $this->db->get('user_menu')->result_array();
        return $data;
    }

    public function getSubMenu()
    {
        $query =    "SELECT `user_sub_menu` .*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                    ";
        return $this->db->query($query)->result_array();
    }

    public function insert_menu()
    {
        $data = $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
        return $data;
    }



    public function deleteMenu($id)
    {
        $query = "DELETE FROM user_menu WHERE id = $id";
        $this->db->query($query);
        redirect('menu/index');
    }
}
