<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(['template', 'session', 'auth']);
		
		// Check authentication for all methods except login
		if ($this->router->method !== 'login') {
			$this->auth->require_login();
		}
	}

	public function index() {
		$data = [
			'page_title' => 'Dashboard - Admin LPM Politeknik Piksi Ganesha',
			'breadcrumb' => [
				['title' => 'Dashboard', 'url' => 'admin', 'active' => true]
			],
			'active_menu' => 'dashboard',
			// Dashboard statistics
			'stats' => [
				'total_kegiatan' => 15,
				'kegiatan_berlangsung' => 3,
				'total_dokumen' => 28,
				'total_prodi' => 6
			],
			'recent_activities' => $this->get_recent_activities(),
			'upcoming_events' => $this->get_upcoming_events()
		];

		$this->template->set_title($data['page_title'])
			->set_meta_description('Dashboard admin untuk mengelola sistem LPM Politeknik Piksi Ganesha');

		$this->template->backend('backend/home/dashboard', $data);
	}

	public function login() {
		if ($this->session->userdata('admin_logged_in')) {
			redirect('admin');
		}

		if ($this->input->post()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			// Simple authentication (in production, use proper password hashing)
			if ($username === 'admin' && $password === 'admin123') {
				$this->session->set_userdata([
					'admin_logged_in' => true,
					'admin_username' => $username,
					'admin_name' => 'Administrator LPM'
				]);
				redirect('admin');
			} else {
				$data['error'] = 'Username atau password salah!';
			}
		}

		$this->load->view('admin/login', isset($data) ? $data : []);
	}

	public function logout() {
		$this->session->unset_userdata(['admin_logged_in', 'admin_username', 'admin_name']);
		redirect('admin/login');
	}

	private function get_recent_activities() {
		return [
			[
				'title' => 'Audit Mutu Internal dimulai',
				'description' => 'AMI Semester Genap 2025/2026 telah dimulai',
				'time' => '2 jam yang lalu',
				'type' => 'info',
				'icon' => 'fas fa-clipboard-list'
			],
			[
				'title' => 'Dokumen SPMI diperbarui',
				'description' => 'Manual SPMI telah direvisi',
				'time' => '1 hari yang lalu',
				'type' => 'success',
				'icon' => 'fas fa-file-alt'
			],
			[
				'title' => 'Workshop SPMI terjadwal',
				'description' => 'Workshop akan dilaksanakan 25 Januari 2026',
				'time' => '3 hari yang lalu',
				'type' => 'warning',
				'icon' => 'fas fa-calendar-plus'
			],
			[
				'title' => 'Evaluasi Prodi selesai',
				'description' => 'Evaluasi diri program studi telah diselesaikan',
				'time' => '5 hari yang lalu',
				'type' => 'success',
				'icon' => 'fas fa-check-circle'
			]
		];
	}

	private function get_upcoming_events() {
		return [
			[
				'title' => 'Workshop SPMI',
				'date' => '25 Januari 2026',
				'time' => '09:00 WIB',
				'location' => 'Auditorium Utama',
				'status' => 'scheduled'
			],
			[
				'title' => 'Rapat Tinjauan Manajemen',
				'date' => '5 Februari 2026',
				'time' => '10:00 WIB',
				'location' => 'Ruang Rapat Rektorat',
				'status' => 'scheduled'
			],
			[
				'title' => 'Pelatihan Auditor Internal',
				'date' => '15 Februari 2026',
				'time' => '08:30 WIB',
				'location' => 'Lab Komputer 1',
				'status' => 'preparation'
			]
		];
	}
}
