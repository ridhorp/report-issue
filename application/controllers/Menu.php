<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        //     is_logged_in();
        $this->load->model(array('M_menu', 'M_user', 'M_sub_menu'));
    }


    public function index()
    {
        $data['title']  = 'Menu Management';
        $data['user']   = $this->M_user->get_user();
        $data['menu']   = $this->M_menu->get_menu();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->M_menu->insert_menu();
            $this->session->set_Flashdata('message', '<div class= "alert alert-success" role="alert">New Menu Added!</div>');
            redirect('menu');
        }
    }

    public function deleteMenu($id)
    {
        ($this->M_menu->deleteMenu($id) > 0 );
        redirect('menu/index');
    }


    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->M_user->get_user();


        $data['subMenu'] = $this->M_sub_menu->get_submenu();
        $data['menu'] = $this->M_menu->get_menu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');



        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->M_sub_menu->insert_submenu();
            $this->session->set_Flashdata('message', '<div class= "alert alert-success" role="alert">New Menu Added!</div>');
            redirect('menu/submenu');
        }
    }

    public function deleteSubMenu($id)
    {
        ($this->M_sub_menu->deleteSubmenu($id) > 0 );
        redirect('menu/submenu');
    }


    public function getEdit($id)
    {
        echo json_encode ($this->model('M_sub_menu')->getDataEdit($_POST['id']));
    }

    // public function Edit()
    // {
    //     if ( $this->model('M_sub_menu')->editDataSubmenu($_POST) > 0 ) {
    //         Flasher::setFlash('berhasil', 'edited', 'success');
    //         header('Location: ' . BASEURL . '/Menu');
    //         exit;
    //     } else{
    //         Flasher::setFlash('gagal', 'edited', 'danger');
    //         header('Location: ' . BASEURL . '/Menu');
    //         exit;
    //     }
    // }

}

