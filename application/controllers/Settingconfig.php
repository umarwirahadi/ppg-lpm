<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settingconfig extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('template');
		$this->load->model('SettingModel');
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('admin/login');
			return;
		}
	}
	public function index() {
		$data['title'] = 'Pengaturan Konfigurasi';
		$data['settings'] = $this->SettingModel->get_all_settings();
		$this->template->backend('backend/settingconfig/index', $data);
	}

	public function create() {
		
	}

	public function store() {
		
	}

	public function edit($key) {
		
	}

	public function update() {
		
	}
}
