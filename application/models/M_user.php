<?php
class M_user extends CI_model
{
    private $_table = "user";


    public function get_user()
    {
        $data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        return $data;
    }

    public function insert_user($data)
    {

        $this->db->insert($this->_table, $data);
    }

    public function fetch_list_user(
        $like_value = null,
        $column_order = null,
        $column_dir = null,
        $limit_start = null,
        $limit_length = null,
        $tanggal_awal = null,
        $tanggal_akhir = null
    ) {
        $sql = "
    SELECT
        (@row:=@row+1) AS nomor,
        id,
        name,
        email,
        divisi,
        role_id
    FROM
    " . $this->_table . "
    ,(SELECT @row := 0) r 
    ";

        $data['totalData'] = $this->db->query($sql)->num_rows();

        if (!empty($like_value)) {
            $sql .= " WHERE ( ";
            $sql .= " name LIKE '%" . $this->db->escape_like_str($like_value) . "%'";
            $sql .= " email LIKE '%" . $this->db->escape_like_str($like_value) . "%'";
            $sql .= " ) ";
        }

        $data['totalFiltered'] = $this->db->query($sql)->num_rows();

        $columns_order_by = array(
            0 => 'nomor',
            1 => 'nama',
            2 => 'email',
            3 => 'divisi',
            4 => 'role_id',

        );

        $sql .= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . ", nomor ";
        $sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

        $data['query'] = $this->db->query($sql);
        return $data;
    }
}
