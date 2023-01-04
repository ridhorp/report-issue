<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model(array('M_user'));
    }


    public function index()
    {
        $data['title']  = 'My Profile';
        $data['user']   = $this->M_user->get_user();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function add_user()
    {
        $data['title']  = 'User Management';
        $data['user']   = $this->M_user->get_user();

        // $data['add user'] = $this->db->get('add_user')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('divisi', 'Divisi', 'required');
        $this->form_validation->set_rules('password1', 'Pasword', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/add_user', $data);
            $this->load->view('templates/footer');
        } else {
            $data_form = array(
                'name'      => ($this->input->post('name', true)),
                'email'     => ($this->input->post('email', true)),
                'divisi'    => ($this->input->post('divisi', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                // 'role_id' => 2, ($this->input->post('role', true)),
                'is_active' => 1,
                'date_created' => time()
            );

            $this->M_user->insert_user($data_form);
            $this->session->set_Flashdata('message', '<div class= "alert alert-success" role="alert">New User Added!</div>');
            redirect('user/add_user');
        }
    }

    public function list_user()
    {
        $requestData    = $_REQUEST;
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');

        $fetch          = $this->M_user->fetch_list_user(
            $requestData['search']['value'],
            $requestData['order'][0]['column'],
            $requestData['order'][0]['dir'],
            $requestData['start'],
            $requestData['length'],
            $tanggal_awal,
            $tanggal_akhir
        );

        $totalData      = $fetch['totalData'];
        $totalFiltered  = $fetch['totalFiltered'];
        $query          = $fetch['query'];

        $data   = array();
        foreach ($query->result_array() as $row) {
            $nestedData = array();
            $nestedData[]   = $row['nomor'];
            $nestedData[]   = $row['name'];
            $nestedData[]   = $row['email'];
            $nestedData[]   = $row['divisi'];
            $nestedData[]   = $row['role_id'];
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"              => intval($requestData['draw']),
            "recordsTotal"      => intval($totalData),
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $data
        );

        echo json_encode($json_data);
    }
}
