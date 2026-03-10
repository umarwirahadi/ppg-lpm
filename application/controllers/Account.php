<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Account Controller (Frontend)
 *
 * Handles guest/user authentication (login/register/logout).
 * Uses existing Auth library + UserModel.
 */
class Account extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(['template', 'session', 'auth', 'form_validation']);
		$this->load->helper(['url', 'form']);
		$this->load->model('UserModel');
	}

	public function login() {
		if ($this->auth->is_logged_in()) {
			redirect(base_url());
			return;
		}

		if ($this->input->post()) {
			$username = (string) $this->input->post('username');
			$password = (string) $this->input->post('password');
			$remember = $this->input->post('remember') ? true : false;

			$result = $this->auth->login($username, $password, $remember);
			if ($result['success']) {
				$redirectUrl = $this->auth->get_redirect_url(site_url('dashboard'));
				redirect($redirectUrl);
				return;
			}

			$this->session->set_flashdata('error', $result['message']);
		}

		$this->template->set_title('Login - LPM Politeknik Piksi Ganesha');
		$data = [
			'active_menu' => null,
			'error' => $this->session->flashdata('error'),
			'success' => $this->session->flashdata('success')
		];
		$this->template->render('frontend/auth/login', $data);
	}

	public function register() {
		if ($this->auth->is_logged_in()) {
			redirect(base_url());
			return;
		}

		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim|max_length[100]');
		$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[50]|alpha_dash|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|matches[password]');

		if ($this->input->post() && $this->form_validation->run() !== FALSE) {
			$insertData = [
				'full_name' => $this->input->post('full_name', true),
				'username' => $this->input->post('username', true),
				'email' => $this->input->post('email', true),
				'password' => $this->input->post('password'),
				'role' => 'viewer',
				'is_active' => 1
			];

			$userId = $this->UserModel->insert($insertData);
			if ($userId) {
				$this->session->set_flashdata('success', 'Pendaftaran berhasil. Silakan login.');
				redirect('login');
				return;
			}

			$this->session->set_flashdata('error', 'Pendaftaran gagal. Silakan coba lagi.');
		}

		$this->template->set_title('Register - LPM Politeknik Piksi Ganesha');
		$data = [
			'active_menu' => null,
			'error' => $this->session->flashdata('error'),
			'success' => $this->session->flashdata('success')
		];
		$this->template->render('frontend/auth/register', $data);
	}

	public function logout() {
		$this->auth->logout();
		$this->session->set_flashdata('success', 'Anda berhasil logout.');
		redirect(base_url());
	}

	public function dashboard() {
		$this->auth->require_login('login');

		$userId = (int) $this->auth->user_id();
		$user = $this->UserModel->get_by_id($userId);
		if (!$user) {
			$this->auth->logout();
			redirect('login');
			return;
		}

		// Profile update
		if ($this->input->post('action') === 'profile') {
			$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim|max_length[100]');
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
			$this->form_validation->set_rules('phone', 'No. HP', 'trim|max_length[20]');

			if ($this->form_validation->run() !== FALSE) {
				$updateData = [
					'full_name' => $this->input->post('full_name', true),
					'email' => $this->input->post('email', true),
					'phone' => $this->input->post('phone', true),
				];

				// Prevent duplicate email
				if ($this->UserModel->email_exists($updateData['email'], $userId)) {
					$this->session->set_flashdata('error', 'Email sudah digunakan oleh user lain.');
					redirect('dashboard');
					return;
				}

				if ($this->UserModel->update($userId, $updateData)) {
					$this->auth->refresh_user();
					$this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
				} else {
					$this->session->set_flashdata('error', 'Gagal memperbarui profil.');
				}
				redirect('dashboard');
				return;
			}
		}

		// Password change
		if ($this->input->post('action') === 'password') {
			$this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]');
			$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[new_password]');

			if ($this->form_validation->run() !== FALSE) {
				$newPassword = (string) $this->input->post('new_password');
				if ($this->UserModel->change_password($userId, $newPassword)) {
					$this->session->set_flashdata('success', 'Password berhasil diubah.');
				} else {
					$this->session->set_flashdata('error', 'Gagal mengubah password.');
				}
				redirect('dashboard');
				return;
			}
		}

		$this->template->set_title('Dashboard - LPM Politeknik Piksi Ganesha');
		$data = [
			'active_menu' => null,
			'user' => $this->auth->user(),
			'form_user' => $user,
			'error' => $this->session->flashdata('error'),
			'success' => $this->session->flashdata('success'),
		];
		$this->template->render('frontend/auth/dashboard', $data);
	}
}
