<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Laporan Controller
 * 
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Upload $upload
 * @property Template $template
 * @property LaporanModel $LaporanModel
 */
class Laporan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(['template', 'auth']);
		$this->load->model('LaporanModel');
		
		// Check authentication
		$this->auth->require_login();
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

	public function create() {
		$data = [
			'title' => 'Tambah Laporan',
			'active_menu' => 'laporan'
		];
		$this->template->backend('backend/laporan/create', $data);
	}

	public function store() {
		// Handle form submission to store new laporan
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$status = $this->input->post('status');

		// Prepare data to insert
		$data = array(
			'title' => $title,
			'description' => $description,
			'status' => $status,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		);

		// Handle optional file upload
		if (!empty($_FILES) && isset($_FILES['file']) && $_FILES['file']['name'] !== '') {
			$config['upload_path'] = FCPATH . 'assets/documents/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['max_size'] = 5120; // 5MB
			$config['encrypt_name'] = TRUE; // Generate unique filename

			// Create directory if not exists
			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0755, true);
			}

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('file')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect('admin/laporan/create');
				return;
			} else {
				$file_data = $this->upload->data();
				$file_path = 'assets/documents/' . $file_data['file_name'];
				$data['file_path'] = $file_path;
			}
		}

		// Save to database
		$inserted = $this->LaporanModel->insert_laporan($data);
		
		if ($inserted) {
			$this->session->set_flashdata('success', 'Laporan berhasil ditambahkan.');
		} else {
			$this->session->set_flashdata('error', 'Gagal menambahkan laporan.');
		}

		redirect('admin/laporan');
	}

	public function edit($id) {
		$laporan = $this->LaporanModel->get_laporan_by_id($id);
		if (!$laporan) {
			show_404();
			return;
		}

		$data = [
			'title' => 'Edit Laporan',
			'active_menu' => 'laporan',
			'laporan' => $laporan
		];
		$this->template->backend('backend/laporan/edit', $data);
	}

	public function update($id) {
		$laporan = $this->LaporanModel->get_laporan_by_id($id);
		if (!$laporan) {
			show_404();
			return;
		}

		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$status = $this->input->post('status');

		// Prepare data to update
		$update_data = array(
			'title' => $title,
			'description' => $description,
			'status' => $status,
			'updated_at' => date('Y-m-d H:i:s')
		);

		// Handle optional file upload (replace existing file if provided)
		if (!empty($_FILES) && isset($_FILES['file']) && $_FILES['file']['name'] !== '') {
			$config['upload_path'] = FCPATH . 'assets/documents/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['max_size'] = 5120; // 5MB
			$config['encrypt_name'] = TRUE; // Generate unique filename

			// Create directory if not exists
			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 0755, true);
			}

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('file')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect('admin/laporan/edit/' . $id);
				return;
			} else {
				$file_data = $this->upload->data();
				$file_path = 'assets/documents/' . $file_data['file_name'];
				$update_data['file_path'] = $file_path;

				// Remove old file if exists and is different
				if (!empty($laporan->file_path)) {
					$old_path = FCPATH . $laporan->file_path;
					if (file_exists($old_path)) {
						@unlink($old_path);
					}
				}
			}
		}

		$updated = $this->LaporanModel->update_laporan($id, $update_data);
		
		if ($updated) {
			$this->session->set_flashdata('success', 'Laporan berhasil diperbarui.');
		} else {
			$this->session->set_flashdata('error', 'Gagal memperbarui laporan.');
		}

		redirect('admin/laporan');
	}

	public function delete($id) {
		$laporan = $this->LaporanModel->get_laporan_by_id($id);
		if (!$laporan) {
			show_404();
			return;
		}

		// Delete file if exists
		if (!empty($laporan->file_path)) {
			$file_path = FCPATH . $laporan->file_path;
			if (file_exists($file_path)) {
				@unlink($file_path);
			}
		}

		// Delete from database
		$deleted = $this->LaporanModel->delete_laporan($id);
		
		if ($deleted) {
			$this->session->set_flashdata('success', 'Laporan berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus laporan.');
		}

		redirect('admin/laporan');
	}
}
