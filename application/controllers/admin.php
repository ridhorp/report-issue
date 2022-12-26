<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_in();
    // }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['error'] = $this->db->get('dashboard_error')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function list_error()
    {
        $requestData    = $_REQUEST;
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');
        $divisi         = $this->input->post('divisi');

        $fetch          = $this->m_log_error->fetch_list_error(
            $requestData['search']['value'],
            $requestData['order'][0]['column'],
            $requestData['order'][0]['dir'],
            $requestData['length'],
            $tanggal_awal,
            $tanggal_akhir,
            $divisi
        );

        $totalData      = $fetch['totalData'];
        $totalFiltered  = $fetch['totalFiltered'];
        $query          = $fetch['query'];

        $data   = array();
        foreach ($query->result_array() as $row) {
            $nestedData = array();
            $nestedData[]   = $row['nomor'];
            $nestedData[]   = $row['entry_date'];
            $nestedData[]   = $row['date'];
            $nestedData[]   = $row['divisi'];
            $nestedData[]   = $row['customer'];
            $nestedData[]   = $row['product'];
            $nestedData[]   = $row['material_quantity'];
            $nestedData[]   = $row['material_loss'];
            $nestedData[]   = $row['service_loss'];
            $nestedData[]   = $row['error_category'];
            $nestedData[]   = $row['error_type'];
            $nestedData[]   = $row['description'];
            $nestedData[]   = $row['reason'];
            $nestedData[]   = $row['PIC'];
            $nestedData[]   = $row['solution'];
            $nestedData[]   = $row['problem_solve'];
            $data[] = $nestedData;
        }
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }



    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('menuId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Changed!</div>');
    }
}
