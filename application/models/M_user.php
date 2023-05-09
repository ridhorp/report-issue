<?php
class M_user extends CI_model
{
    private $_table = "user";


    public function get_user()
    {
        $data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        return $data;
    }

    public function get_id_user($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
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
        $tanggal_akhir = null,
        $divisi = null
    ) {
        $sql = "
    SELECT
        (@row:=@row+1) AS nomor,
        a.id, 
        a.name,
        a.email,
        a.divisi,
        a.role_id,
        b.name as name_divisi
    FROM
    " . $this->_table . " as a
    JOIN divisi as b ON a.divisi = b.id
    ,(SELECT @row := 0) r where 1 = 1
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

    public function deleteUser($id)
    {
        $query = "DELETE FROM user WHERE id = $id";
        $this->db->query($query);
        redirect('User/user');
    }

    public function insert_useredit()
    {
        $data = [
            'name'      => $this->input->post('name'),
            'email'     => $this->input->post('email'),
            'divisi'    => $this->input->post('divisi'),
            'password'  => $this->input->post('password'),
        ];
        $data = $this->db->insert('user', $data);
        return $data;
    }

    public function editing_data()
    {
        $data = [
            'name'     => $this->input->post('name'),
            'email'   => $this->input->post('email'),
            'divisi'       => $this->input->post('divisi'),
            'password'      => $this->input->post('password'),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user', $data);
    }
}
