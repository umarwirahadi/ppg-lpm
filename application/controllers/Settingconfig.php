<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Settingconfig Controller
 * 
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property Template $template
 * @property SettingModel $SettingModel
 */
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
		if(!$this->input->is_ajax_request()) {
			show_404();
			return;
		}
		$data['title'] = 'Tambah Setting Baru';
		$html = $this->load->view('backend/settingconfig/create', $data, true);
		echo json_encode(['html' => $html]);		
	}

	public function store() {
		// Get form data
		$setting_key = $this->input->post('setting_key');
		$setting_value = $this->input->post('setting_value');
		$setting_group = $this->input->post('setting_group');
		$description = $this->input->post('description');

		// Validate required fields
		if (empty($setting_key)) {
			$this->session->set_flashdata('error', 'Setting key is required.');
			redirect('admin/settingconfig/create');
			return;
		}

		// Check if key already exists
		$existing = $this->SettingModel->get_setting($setting_key);
		if ($existing) {
			$this->session->set_flashdata('error', 'Setting key already exists.');
			redirect('admin/settingconfig');
			return;
		}

		// Prepare data
		$data = array(
			'setting_key' => $setting_key,
			'setting_value' => $setting_value,
			'setting_group' => $setting_group ? $setting_group : 'general',
			'description' => $description,
			'updated_at' => date('Y-m-d H:i:s')
		);

		// Insert into database
		$inserted = $this->SettingModel->insert($data);

		if ($inserted) {
			$this->session->set_flashdata('success', 'Setting created successfully.');
		} else {
			$this->session->set_flashdata('error', 'Failed to create setting.');
		}

		redirect('admin/settingconfig');
	}

	public function edit($id) {
		if(!$this->input->is_ajax_request()) {
			show_404();
			return;
		}
		$data['title'] = 'Tambah Setting Baru';
		$data['setting'] = $this->SettingModel->get_setting_by_id($id);
		$html = $this->load->view('backend/settingconfig/edit', $data, true);
		echo json_encode(['html' => $html]);		
	}

	public function update($id) {
		// Get form data
		$setting_key = $this->input->post('setting_key');
		$setting_value = $this->input->post('setting_value');
		$setting_group = $this->input->post('setting_group');
		$description = $this->input->post('description');

		// Validate required fields
		if (empty($setting_key)) {
			$this->session->set_flashdata('error', 'Setting key is required.');
			redirect('admin/settingconfig');
			return;
		}

		// Check if setting exists
		$existing = $this->SettingModel->get_setting_by_id($id);
		if (!$existing) {
			$this->session->set_flashdata('error', 'Setting not found.');
			redirect('admin/settingconfig');
			return;
		}

		// Prepare update data
		$data = array(
			'setting_value' => $setting_value,
			'setting_group' => $setting_group ? $setting_group : 'general',
			'description' => $description,
			'updated_at' => date('Y-m-d H:i:s')
		);

		// Update in database
		$this->db->where('id', $id);
		$updated = $this->db->update('site_settings', $data);

		if ($updated) {
			$this->session->set_flashdata('success', 'Setting updated successfully.');
		} else {
			$this->session->set_flashdata('error', 'Failed to update setting.');
		}

		redirect('admin/settingconfig');
	}

	public function delete($id) {
		// Get setting by id
		if (empty($id) || !is_numeric($id)) {
			$this->session->set_flashdata('error', 'Invalid setting ID.');
			redirect('admin/settingconfig');
			return;
		}

		// Check if setting exists
		$existing = $this->SettingModel->get_setting_by_id($id);
		if (!$existing) {
			$this->session->set_flashdata('error', 'Setting not found.');
			redirect('admin/settingconfig');
			return;
		}
		$deleted = $this->SettingModel->delete_setting($id);
		if($deleted) {
			echo json_encode(['success' => true, 'message' => 'Setting deleted successfully.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to delete setting.']);
		}

		

	}
}
