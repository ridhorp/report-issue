<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login Page';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		} else {
			$this->login();
		}
	}

	private function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			//email is active//
			if ($user['is_active'] == 1) {
				//check password//
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' 	=> $user['email'],
						'role_id' 	=> $user['role_id'],
						'divisi'	=> $user['divisi']
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('dashboard');
					} else {
						redirect('dashboard');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Your password is wrong.</div>');
					redirect('auth');
				}
			}
			//email is non-active//
			else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Oops! your email is not activated.</div>');
				redirect('auth');
			}
		}
		//email is not regist//
		else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Oops! your email is not registered.</div>');
			redirect('auth');
		}
	}

	public function registration()
	{

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|valid_email|is_unique[user. email]', [
			'is_unique' => 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2], [
            "matches" => "password dont matches!", 
            "min_length" => "password too shorts"
            ] ');
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Register';
			$this->load->view('templates/auth_header');
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'date_created' => time()
			];

			$this->db->insert('user', $data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Yeay! your account has been created. Please log in now.</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-secondary" role="alert">
            You have been Logged out..</div>');
		redirect('auth');
	}

	public function blocked()
	{
		echo 'access blocked';
	}
}
