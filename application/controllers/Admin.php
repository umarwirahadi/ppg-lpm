<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('template');
		$this->load->library('session');
	}

	public function index() {
		// Check if user is logged in
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('admin/login');
			return;
		}

		// Dashboard data
		$data['title'] = 'Dashboard Admin LPM';
		$data['total_kegiatan'] = 12; // This would come from database
		$data['kegiatan_aktif'] = 8;
		$data['total_peserta'] = 145;
		$data['kegiatan_bulan_ini'] = 3;

		// Recent activities (this would come from database)
		$data['recent_activities'] = array(
			array(
				'title' => 'Workshop Akreditasi Prodi',
				'date' => '2024-01-05',
				'status' => 'Aktif'
			),
			array(
				'title' => 'Pelatihan Kurikulum MBKM',
				'date' => '2024-01-03',
				'status' => 'Selesai'
			),
			array(
				'title' => 'Seminar Penjaminan Mutu',
				'date' => '2023-12-28',
				'status' => 'Selesai'
			)
		);

		$this->template->backend('backend/home/dashboard', $data);
	}

	public function login() {
		// If already logged in, redirect to dashboard
		if ($this->session->userdata('admin_logged_in')) {
			redirect('admin');
			return;
		}

		// Handle login form submission
		if ($this->input->post()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			// Simple authentication (in production, use proper hash and database)
			if ($username === 'admin' && $password === 'admin123') {
				$this->session->set_userdata('admin_logged_in', true);
				$this->session->set_userdata('admin_username', $username);
				redirect('admin');
				return;
			} else {
				$data['error'] = 'Username atau password salah';
			}
		}

		$data['title'] = 'Login Admin LPM';
		$this->load->view('admin/login', $data);
	}

	public function logout() {
		$this->session->unset_userdata('admin_logged_in');
		$this->session->unset_userdata('admin_username');
		redirect('admin/login');
	}

	// Method to handle kegiatan management
	public function kegiatan() {
		// Check if user is logged in
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('admin/login');
			return;
		}

		$data['title'] = 'Kelola Kegiatan';
		$this->template->backend('backend/kegiatan/index', $data, 'admin');
	}

	// Method to handle struktur organisasi management
	public function struktur() {
		// Check if user is logged in
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('admin/login');
			return;
		}

		$this->load->model('StrukturModel');
		$data['title'] = 'Kelola Struktur Organisasi';
		
		// Check if database table exists
		if (!$this->db->table_exists('struktur_organisasi')) {
			$data['error'] = 'Tabel struktur_organisasi belum dibuat. Silakan import file SQL dari application/dbschema/struktur_organisasi.sql terlebih dahulu.';
			$data['struktur_list'] = [];
			$data['search_keyword'] = '';
			$data['total_records'] = 0;
			$this->template->backend('backend/struktur/index', $data, 'admin');
			return;
		}
		
		// Handle search
		$search = $this->input->get('search');
		if ($search) {
			try {
				$data['struktur_list'] = $this->StrukturModel->search($search);
			} catch (Exception $e) {
				$data['struktur_list'] = [];
				$data['error'] = 'Database error: ' . $e->getMessage();
			}
			$data['search_keyword'] = $search;
		} else {
			try {
				$data['struktur_list'] = $this->StrukturModel->get_all();
			} catch (Exception $e) {
				$data['struktur_list'] = [];
				$data['error'] = 'Database error: ' . $e->getMessage();
			}
			$data['search_keyword'] = '';
		}
		
		// Get total count for pagination info
		try {
			$data['total_records'] = $this->StrukturModel->count_all();
		} catch (Exception $e) {
			$data['total_records'] = 0;
		}
		
		$this->template->backend('backend/struktur/index', $data, 'admin');
	}
}
