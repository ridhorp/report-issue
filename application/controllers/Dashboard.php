<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        // is_logged_in();
        $this->load->model(array('M_log_error', 'M_dashboard_error', 'M_user', 'M_divisi'));
    }

    public function index()
    {
        $data['title']          = 'Dashboard ';
        $data['user']           = $this->M_user->get_user();
        $data['admin']          = $this->M_dashboard_error->get_error();
        $data['divisi']         = $this->session->userdata('divisi');
        $data['list_divisi']    = $this->M_divisi->get_divisi()->result();




        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('templates/footer');
        $this->session->set_Flashdata('message', '<div class= "alert alert-danger" role="alert"></div>');
    }
}
