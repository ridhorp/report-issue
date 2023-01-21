<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataMaster extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model(array( 'M_user', 'M_divisi', 'M_Category', 'M_type'));
    }

    public function category()
    {
        $data['title']          = 'Error Category';
        $data['user']           = $this->M_user->get_user();
        $data['divisi']         = $this->session->userdata('divisi');
        $data['list_divisi']    = $this->M_divisi->get_divisi()->result();
        $data['list_category']  = $this->M_Category->get_category()->result_array();

        $this->form_validation->set_rules('category', 'Category', 'required');
        
        if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('datamaster/error_category', $data);
        $this->load->view('templates/footer');
        } else {
            $this->M_Category->insert_category();
            $this->session->set_Flashdata('message', '<div class= "alert alert-success" role="alert">New Category Added!</div>');
            redirect('DataMaster/category');
        }
    }

    public function deleteCategory($id)
    {
        ($this->M_Category->deleteCategory($id) > 0 );
        redirect('DataMaster/error_category');
    }

    public function type()
    {
        $data['title']          = 'Error Type';
        $data['user']           = $this->M_user->get_user();
        $data['divisi']         = $this->session->userdata('divisi');
        $data['list_divisi']    = $this->M_divisi->get_divisi()->result();
        $data['list_type']      = $this->M_type->get_type()->result_array();

        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('definition', 'definition', 'required');
        
        if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('datamaster/error_type', $data);
        $this->load->view('templates/footer');
        } else {
            $this->M_type->insert_type();
            $this->session->set_Flashdata('message', '<div class= "alert alert-success" role="alert">New Type Added!</div>');
            redirect('DataMaster/type');
        }
    }

    public function deleteType($id)
    {
        ($this->M_type->deleteType($id) > 0 );
        redirect('DataMaster/error_type');
    }

}