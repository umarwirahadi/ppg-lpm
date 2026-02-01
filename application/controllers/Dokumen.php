<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dokumen extends CI_Controller {	

	public function __construct() {
		parent::__construct();
		$this->load->library('template');
		$this->load->model('DokumenModel');
		if (!$this->session->userdata('admin_logged_in')) {
			redirect('admin/login');
			return;
		}
	}

	public function index() {
				// Dashboard data
		   $data['title'] = 'Daftar Dokumen SPMI';
		   $data['dokumen_list'] = $this->DokumenModel->get_all_dokumen();
		   $this->template->backend('backend/dokumen/index', $data);
	}

	public function create() {
	

		$data['title'] = 'Tambah Dokumen SPMI';
		$this->template->backend('backend/dokumen/create', $data);
	}

	public function store() {
		// Handle form submission to store new document
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$is_active = $this->input->post('is_active') ? 1 : 0;

		// File upload handling
		$config['upload_path'] = FCPATH . 'assets/documents/';
		$config['allowed_types'] = 'pdf|doc|docx';
		$config['max_size'] = 2048; // 2MB

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('file')) {
			$error = $this->upload->display_errors();
			$this->session->set_flashdata('error', $error);
			redirect('admin/dokumen/create');
			return;
		} else {
			$file_data = $this->upload->data();
			$file_url = 'assets/documents/' . $file_data['file_name'];
		}

		// Save to database
		$data = array(
			'title' => $title,
			'description' => $description,
			'file_url' => isset($file_url) ? $file_url : null,
			'is_active' => $is_active,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		);

		$this->DokumenModel->insert_dokumen($data);
		redirect('dokumen');
	}

	public function edit($id){
		$dokumen = $this->DokumenModel->get_dokumen_by_id($id);
		if(!$dokumen){
			show_404();
		}
		$data['title'] = 'Edit Dokumen SPMI';
		$data['dokumen'] = $dokumen;
		$this->template->backend('backend/dokumen/edit', $data);
	}

	public function update($id){
		$dokumen = $this->DokumenModel->get_dokumen_by_id($id);
		if(!$dokumen){
			show_404();
		}

		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$category = $this->input->post('category');
		$is_active = $this->input->post('is_active') ? 1 : 0;

		// Prepare data to update
		$update_data = array(
			'title' => $title,
			'category' => $category,
			'description' => $description,
			'is_active' => $is_active,
			'updated_at' => date('Y-m-d H:i:s')
		);

		// Handle optional file upload (replace existing file if provided)
		if (!empty($_FILES) && isset($_FILES['file']) && $_FILES['file']['name'] !== '') {
			$config['upload_path'] = FCPATH . 'assets/documents/';
			$config['allowed_types'] = 'pdf|doc|docx';
			$config['max_size'] = 2048; // 2MB

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('file')) {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('error', $error);
				redirect('admin/dokumen/edit/' . $id);
				return;
			} else {
				$file_data = $this->upload->data();
				$file_url = 'assets/documents/' . $file_data['file_name'];
				$update_data['file_url'] = $file_url;

				// remove old file if exists and is different
				if (!empty($dokumen->file_url)) {
					$old_path = FCPATH . $dokumen->file_url;
					if (file_exists($old_path)) {
						@unlink($old_path);
					}
				}
			}
		}

		$updated = $this->DokumenModel->update_dokumen($id, $update_data);
		if ($updated) {
			$this->session->set_flashdata('success', 'Dokumen berhasil diperbarui.');
		} else {
			$this->session->set_flashdata('error', 'Gagal memperbarui dokumen.');
		}

		redirect('dokumen');
	}

	
}
