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
        // is_logged_in();
        $this->load->model(array('M_log_error', 'M_user', 'M_dashboard_error', 'M_role_user', 'M_divisi'));
    }

    public function index()
    {
        $data['title']          = 'Input Error';
        $data['user']           = $this->M_user->get_user();
        $data['admin']          = $this->M_dashboard_error->get_error();
        $data['divisi']         = $this->session->userdata('divisi');
        $data['list_divisi']    = $this->M_divisi->get_divisi()->result();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
            $this->session->set_Flashdata('message', '<div class= "alert alert-danger" role="alert"></div>');
        } else {
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
            // $nestedData[]   = $row['name_divisi'];
            $nestedData[]   = $row['customer'];
            $nestedData[]   = $row['product'];
            // $nestedData[]   = $row['material_quantity'];
            // $nestedData[]   = $row['material_loss'];
            // $nestedData[]   = $row['service_loss'];
            $nestedData[]   = $row['error_category'];
            $nestedData[]   = $row['error_type'];
            // $nestedData[]   = $row['description'];
            // $nestedData[]   = $row['reason'];
            // $nestedData[]   = $row['PIC'];
            // $nestedData[]   = $row['solution'];
            // $nestedData[]   = $row['problem_solve'];
            $nestedData[]   = "<a href='Admin/detailerror/".$row['id']."' class='badge badge-warning'>Detail</a>";
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
        // $data['detail']         = $detail;


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
            $this->session->set_Flashdata('message', '<div class= "alert alert-danger" role="alert">Error is required</div>');
        } else {
            $data['admin']  = $this->M_dashboard_error->insert_error();
            $this->session->set_Flashdata('message', '<div class= "alert alert-success" role="alert">Error Edited</div>');
        }
    }

    public function editing_error()
    {
        $this->M_log_error->editing_data($id);
        redirect('admin');
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
            // $nestedData[]   = $row['name_divisi'];
            $nestedData[]   = $row['customer'];
            $nestedData[]   = $row['product'];
            // $nestedData[]   = $row['material_quantity'];
            // $nestedData[]   = $row['material_loss'];
            // $nestedData[]   = $row['service_loss'];
            $nestedData[]   = $row['error_category'];
            $nestedData[]   = $row['error_type'];
            // $nestedData[]   = $row['description'];
            // $nestedData[]   = $row['reason'];
            // $nestedData[]   = $row['PIC'];
            // $nestedData[]   = $row['solution'];
            // $nestedData[]   = $row['problem_solve'];
            $nestedData[]   = "<a href='Admin/editerror/".$row['id']."' class='badge badge-info'>Edit</a> <a href='Admin/detailerror/".$row['id']."' class='badge badge-warning'>Detail</a>";
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

    public function role()
    {
        $data['title']  = 'Role';
        // $data['user']   = $this->M_user->get_user();
        $data['user']   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['role']   = $this->M_role_user->get_role();
        $data['role']   = $this->db->get('user_role')->result_array();;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        // $data['user'] = $this->M_user->get_user();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['role'] = $this->M_role_user->get_idrole();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);

        // $data['menu'] = $this->M_menu->get_menu();
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
        $role_id = $this->input->post('roleId');

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

    
    public function user()
    {
        $data['title']          = 'User Management';
        $data['user']           = $this->M_user->get_user();
        $data['divisi']         = $this->session->userdata('divisi');
        $data['list_divisi']    = $this->M_divisi->get_divisi()->result();

        // $data['add user'] = $this->db->get('add_user')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('divisi', 'Divisi', 'required');
        $this->form_validation->set_rules('password1', 'Pasword', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/user', $data);
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
            redirect('admin/user');
        }
    }

    public function add_user()
    {
        $data['title']          = 'User Management';
        $data['user']           = $this->M_user->get_user();
        $data['divisi']     = $this->session->userdata('divisi');
        $data['list_divisi']    = $this->M_divisi->get_divisi()->result();

        // $data['add user'] = $this->db->get('add_user')->result_array();

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('divisi', 'Divisi', 'required');
        $this->form_validation->set_rules('password1', 'Pasword', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/add_user', $data);
            $this->load->view('templates/footer');
            $this->session->set_Flashdata('message', '<div class= "alert alert-danger" role="alert">Data is required</div>');
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
            redirect('admin/user');
        }
    }

    // public function excel(){
    //     $data['error'] = $this->M_dashboard_error->get_error('dashboard_error')->result(); //kalau ada error berarti hapus result array() yg di get_error//
    //     require(APPPATH.'PHPExcel-1.8/Classes/PHPExcel.php');
    //     require(APPPATH.'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

    //     $object = new PHPExcel();

    //     $object->getProperties()->setCreator("Admin");
    //     $object->getProperties()->setLastModifiedBy("Admin");
    //     $object->getProperties()->setTitle("Log Error");

    //     $object->setActiveSheetIndex(0);

    //     $object->getActiveSheet()->setCellValue('A1', 'No');
    //     $object->getActiveSheet()->setCellValue('B1', 'Customer');
    //     $object->getActiveSheet()->setCellValue('C1', 'Entry Date');
    //     $object->getActiveSheet()->setCellValue('D1', 'Divisi');
    //     $object->getActiveSheet()->setCellValue('E1', 'Code Product');
    //     $object->getActiveSheet()->setCellValue('F1', 'Error Category');
    //     $object->getActiveSheet()->setCellValue('G1', 'Error Type');
    //     $object->getActiveSheet()->setCellValue('H1', 'Material Quantity');
    //     $object->getActiveSheet()->setCellValue('I1', 'Material Loss');
    //     $object->getActiveSheet()->setCellValue('J1', 'Service Loss');
    //     $object->getActiveSheet()->setCellValue('K1', 'Description');
    //     $object->getActiveSheet()->setCellValue('L1', 'Reason');
    //     $object->getActiveSheet()->setCellValue('M1', 'PIC');
    //     $object->getActiveSheet()->setCellValue('N1', 'Solution');
    //     $object->getActiveSheet()->setCellValue('O1', 'Problem Solve');

    //     $baris = 2;
    //     $no = 1;

    //     foreach($data['error'] as $e);
    //     {
    //         $object->getActiveSheet()->setCellValue('A'.$baris. $no++);
    //         $object->getActiveSheet()->setCellValue('B'.$baris. $e->customer);
    //         $object->getActiveSheet()->setCellValue('C'.$baris. $e->entry_date);
    //         $object->getActiveSheet()->setCellValue('D'.$baris. $e->divisi);
    //         $object->getActiveSheet()->setCellValue('E'.$baris. $e->product);
    //         $object->getActiveSheet()->setCellValue('F'.$baris. $e->error_category);
    //         $object->getActiveSheet()->setCellValue('G'.$baris. $e->error_type);
    //         $object->getActiveSheet()->setCellValue('H'.$baris. $e->material_quantity);
    //         $object->getActiveSheet()->setCellValue('I'.$baris. $e->material_loss);
    //         $object->getActiveSheet()->setCellValue('J'.$baris. $e->service_loss);
    //         $object->getActiveSheet()->setCellValue('K'.$baris. $e->description);
    //         $object->getActiveSheet()->setCellValue('L'.$baris. $e->reason);
    //         $object->getActiveSheet()->setCellValue('M'.$baris. $e->pic);
    //         $object->getActiveSheet()->setCellValue('N'.$baris. $e->solution);
    //         $object->getActiveSheet()->setCellValue('O'.$baris. $e->problem_solve);

    //         $baris++;
    //     }

    //     $filename = "LOG_ERROR".'.xlsx';

    //     $object->getActiveSheet()->setTitle("LOG ERROR");

    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename"'.$filename. '"');
    //     header('Cache-Control: max-age=0');

    //     $writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
    //     $writer->save('php://output');

    //     exit;
    // }

    
}