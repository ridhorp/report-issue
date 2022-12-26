<?php
class M_log_error extends CI_model
{
    private $_table = "dashboard_error";

    public function fetch_list_error($like_value = null, $column_order = null, $column_dir = null, 
    $limit_start = null, $limit_length = null, $tanggal_awal = null, $tanggal_akhir = null, $divisi = null)
{
    $sql = "
    SELECT
        (@row: =@row+1) AS nomor,
        id,
        entry_date,
        date,
        divisi,
        customer,
        product,
        material_quantitiy,
        material_loss,
        service_loss,
        error_category,
        error_type,
        description,
        reason,
        PIC,
        solution,
        problem_solve
    FROM
    " . $this->_table."
    ,(SELECT @row := 0) r
    ";

    $data['totalData'] = $this->db->query($sql)->num_rows();

    if (!empty($like_value)) {
        $sql .= " WHERE ( ";
        $sql .= " customer LIKE '%" . $this->db->escape_like_str($like_value) . "%'";
        $sql .= " product LIKE '%" . $this->db->escape_like_str($like_value) . "%'";
        $sql .= " ) ";
    }

    $data['totalFiltered'] = $this->db->query($sql)->num_rows();

    $columns_order_by = array(
        0 => 'nomor',
        1 => 'entry_date'
        2 => 'date'
        3 => 'divisi'
        4 => 'customer'
        5 => 'product'
        6 => 'material_quantitiy'
        7 => 'material_loss'
        8 => 'service_loss'
        9 => 'error_category'
        10 => 'error_type'
        11 => 'description'
        12 => 'reason'
        13 => 'PIC'
        14 => 'solution'
        15 => 'problem_solve'
    );

    $sql .= " ORDER BY " . $columns_order_by[$column_order] . " " . $column_dir . ", nomor ";
    $sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";
    
    $data['query'] = $this->db->querry($sql);
    return $data;
}

}