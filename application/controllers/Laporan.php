<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Laporan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('template');
		$this->load->model('LaporanModel');
	}

	public function index() {
		$this->template->set_title('Laporan - LPM Politeknik Piksi Ganesha')
			->set_meta_description('Kumpulan laporan terkait penjaminan mutu pendidikan di Politeknik Piksi Ganesha yang disusun oleh Lembaga Penjaminan Mutu (LPM).');

		$data = [
			'active_menu' => 'laporan',
			'laporans' => $this->LaporanModel->get_all_laporan()
		];

		$this->template->backend('backend/laporan/index', $data);
	}
}
