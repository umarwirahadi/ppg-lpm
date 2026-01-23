<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dokumen extends CI_Controller {	

	public function __construct() {
		parent::__construct();
		$this->load->library('template');
		$this->load->model('DokumenModel');
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

		$this->template->backend('backend/dokumen/index', $data);
	}

	
}
