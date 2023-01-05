<?php
class M_log_error extends CI_model
{
    private $_table = "dashboard_error";

    public function save_error($data)
    {

        $this->db->insert('dashboard_error', $data);
    }

    public function fetch_list_error(
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
        a.entry_date,
        a.divisi,
        a.customer,
        a.product,
        a.material_quantity,
        a.material_loss,
        a.service_loss,
        a.error_category,
        a.error_type,
        a.description,
        a.reason,
        a. PIC,
        a.solution,
        a.problem_solve,
        b.name as name_divisi
    FROM
    " . $this->_table . " as a
    JOIN divisi as b ON a.divisi = b.id
    ,(SELECT @row := 0) r where 1 = 1
    ";

    if (!empty($divisi)) {
        $sql .= " AND  (";
        $sql .= " divisi = '". $divisi. "' ";
        $sql .= " ) ";
    }

        $data['totalData'] = $this->db->query($sql)->num_rows();

        if (!empty($like_value)) {
            $sql .= " AND ( ";
            $sql .= " customer LIKE '%" . $this->db->escape_like_str($like_value) . "%'";
            $sql .= " product LIKE '%" . $this->db->escape_like_str($like_value) . "%'";
            $sql .= " ) ";
        }

        $data['totalFiltered'] = $this->db->query($sql)->num_rows();

        $columns_order_by = array(
            0 => 'nomor',
            1 => 'entry_date',
            2 => 'divisi',
            3 => 'customer',
            4 => 'product',
            5 => 'material_quantitiy',
            6 => 'material_loss',
            7 => 'service_loss',
            8 => 'error_type',
            9 => 'description',
            10 => 'PIC',
            11 => 'solution',
            12 => 'problem_solve'
        );

        $sql .= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . ", nomor ";
        $sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

        $data['query'] = $this->db->query($sql);
        return $data;
    }
}
