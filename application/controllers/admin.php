<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model(array('M_log_error', 'M_user', 'M_dashboard_error', 'M_role_user', 'M_divisi'));
    }

    public function index()
    {
        $data['title']          = 'Input Error';
        $data['user']           = $this->M_user->get_user();
        $data['admin']          = $this->M_dashboard_error->get_error();
        $data['divisi']         = $this->session->userdata('divisi');
        $data['list_divisi']    = $this->M_divisi->get_divisi()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');

        if ($this->form_validation->run() == true) {
            $data['admin']  = $this->M_dashboard_error->insert_error();
            $this->session->set_Flashdata('message', '<div class= "alert alert-success" role="alert">Error Added</div>');
        }
    }

    public function input_error()
    {
        $data['title']          = 'Form Error ';
        $data['user']           = $this->M_user->get_user();
        $data['admin']          = $this->M_dashboard_error->get_error();
        $data['divisi']         = $this->session->userdata('divisi');
        $data['list_divisi']    = $this->M_divisi->get_divisi()->result();


        $this->form_validation->set_rules('entry_date', 'Entry Date', 'required');

        $this->form_validation->set_rules('customer', 'Customer name', 'required');
        $this->form_validation->set_rules('product', 'Code product', 'required');
        $this->form_validation->set_rules('material_quantity', 'Material Quantity', 'required');
        $this->form_validation->set_rules('material_loss', 'Material_Loss', 'required');
        $this->form_validation->set_rules('service_loss', 'Service_Loss', 'required');
        $this->form_validation->set_rules('error_category', 'Error category', 'required');
        $this->form_validation->set_rules('error_type', 'Error type', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('reason', 'Reason', 'required');
        $this->form_validation->set_rules('solution', 'Solution', 'required');
        $this->form_validation->set_rules('pic', 'PIC', 'required');
        $this->form_validation->set_rules('problem_solve', 'Problem solve', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/input_error', $data);
            $this->load->view('templates/footer');
            $this->session->set_Flashdata('message', '<div class= "alert alert-danger" role="alert">Error is required</div>');
        } else {
            $data_form = array(
                'entry_date'        => $this->input->post('entry_date'),
                'divisi'            => $this->session->userdata('divisi'),
                'customer'          => $this->input->post('customer'),
                'product'           => $this->input->post('product'),
                'material_quantity' => $this->input->post('material_quantity'),
                'material_loss'     => $this->input->post('material_loss'),
                'service_loss'      => $this->input->post('service_loss'),
                'error_category'    => $this->input->post('error_category'),
                'error_type'        => $this->input->post('error_type'),
                'description'       => $this->input->post('description'),
                'reason'            => $this->input->post('reason'),
                'solution'          => $this->input->post('solution'),
                'pic'               => $this->input->post('pic'),
                'problem_solve'     => $this->input->post('problem_solve')
            );
            $this->M_log_error->save_error($data_form);
            $this->session->set_Flashdata('message', '<div class= "alert alert-success" role="alert">Error Added</div>');
            redirect('admin');
        }
    }

    public function list_error()
    {
        $requestData    = $_REQUEST;
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');
        $divisi         = $this->input->post('divisi');

        $fetch          = $this->M_log_error->fetch_list_error(
            $requestData['search']['value'],
            $requestData['order'][0]['column'],
            $requestData['order'][0]['dir'],
            $requestData['start'],
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
            $nestedData[]   = $row['customer'];
            $nestedData[]   = $row['product'];
            $nestedData[]   = $row['error_category'];
            $nestedData[]   = $row['error_type'];
            $nestedData[]   = "<a href='Admin/detailerror/" . $row['id'] . "' class='badge badge-warning'>Detail</a>";
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

    public function detailerror($id)
    {
        $data['title']          = 'DETAIL ERROR ';
        $data['user']           = $this->M_user->get_user();
        $data['admin']          = $this->M_dashboard_error->get_error();
        $data['divisi']         = $this->session->userdata('divisi');
        $data['list_divisi']    = $this->M_divisi->get_divisi()->result();

        $data['detailid']       = $this->M_dashboard_error->get_id_error($id);
        $data['detail']         = $this->M_dashboard_error->detail_error($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detail', $data);
        $this->load->view('templates/footer');
        $this->session->set_Flashdata('message', '<div class= "alert alert-danger" role="alert"></div>');
    }

    public function editerror($id)
    {
        $data['title']  = 'Edit Error';
        $data['user']   = $this->M_user->get_user();


        $data['admin']          = $this->M_dashboard_error->get_error();
        $data['divisi']         = $this->session->userdata('divisi');
        $data['list_divisi']    = $this->M_divisi->get_divisi()->result();
        $data['detailid']       = $this->M_dashboard_error->get_id_error($id);
        $data['detail']         = $this->M_dashboard_error->detail_error($id);
        // $detailid = json_decode($data,true); 

        $this->form_validation->set_rules('entry_date', 'Entry Date', 'required');
        $this->form_validation->set_rules('customer', 'Customer name', 'required');
        $this->form_validation->set_rules('product', 'Code product', 'required');
        $this->form_validation->set_rules('material_quantity', 'Material Quantity', 'required');
        $this->form_validation->set_rules('material_loss', 'Material_Loss', 'required');
        $this->form_validation->set_rules('service_loss', 'Service_Loss', 'required');
        $this->form_validation->set_rules('error_category', 'Error category', 'required');
        $this->form_validation->set_rules('error_type', 'Error type', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        $this->form_validation->set_rules('reason', 'Reason', 'required');
        $this->form_validation->set_rules('solution', 'Solution', 'required');
        $this->form_validation->set_rules('pic', 'PIC', 'required');
        $this->form_validation->set_rules('problem_solve', 'Problem solve', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_error', $data);
            $this->load->view('templates/footer');
        } else {
            $data['admin']  = $this->M_dashboard_error->insert_error();
            $this->session->set_Flashdata('message', '<div class= "alert alert-success" role="alert">Error Edited</div>');
            redirect('admin');
        }
    }

    public function editing_error()
    {
        $this->M_log_error->editing_data_error($id);
        redirect('admin/index');
    }

    public function list_error_admin()
    {
        $requestData    = $_REQUEST;
        $tanggal_awal   = $this->input->post('tanggal_awal');
        $tanggal_akhir  = $this->input->post('tanggal_akhir');
        $divisi         = $this->input->post('divisi');

        $fetch          = $this->M_log_error->fetch_list_error(
            $requestData['search']['value'],
            $requestData['order'][0]['column'],
            $requestData['order'][0]['dir'],
            $requestData['start'],
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
            $nestedData[]   = $row['customer'];
            $nestedData[]   = $row['product'];
            $nestedData[]   = $row['error_category'];
            $nestedData[]   = $row['error_type'];
            $nestedData[]   = " <a href='". site_url('Admin/editerror/' . $row['id']) ."' class='badge badge-info'>Edit</a>
                                <a href='". site_url('Admin/detailerror/' . $row['id']) ."' class='badge badge-warning'>Detail</a>
                                <a href='". site_url('Admin/deleteerror/' . $row['id']) ."' class='badge badge-danger' data-id='".$row['id']."' id='delete-error' data-toggle='modal' data-target='#deleteModal'onclick='return confirm('ingin menghapus data ini?');' '>Delete</button>";
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

    public function deleteerror(){
        $error_id = $this->input->post('id');
        echo json_encode($error_id);
        $this->M_dashboard_error->deletedError($error_id) > 0;
        redirect('admin/index');
    }
}
