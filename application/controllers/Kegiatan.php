<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Kegiatan Controller
 * 
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Upload $upload
 * @property CI_Form_validation $form_validation
 * @property Template $template
 * @property KegiatanModel $KegiatanModel
 */
class Kegiatan extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(['template', 'auth']);
		$this->load->model('KegiatanModel');
		
		// Check authentication
		$this->auth->require_login();
	}

	public function index() {
		$this->template->set_title('Kegiatan - LPM Web Solutions')
			->set_meta_description('Daftar kegiatan yang diselenggarakan oleh LPM Web Solutions.');

		$data = [
			'active_menu' => 'kegiatan',
			'kegiatan_list' => $this->KegiatanModel->get_all_kegiatan()
		];

		$this->template->backend('backend/kegiatan/index', $data);
	}

	public function create() {
		$this->template->set_title('Buat Kegiatan Baru - LPM Web Solutions')
			->set_meta_description('Form untuk membuat kegiatan baru di LPM Web Solutions.');

		$data = [
			'active_menu' => 'kegiatan'
		];

		$this->template->backend('backend/kegiatan/create', $data);
	}

	public function store() {
		// Load helpers and libraries
		$this->load->library('form_validation');
		$this->load->helper(['url', 'text']);

		// Validation rules
		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Tanggal Mulai', 'trim|required');
		$this->form_validation->set_rules('end_date', 'Tanggal Selesai', 'trim');
		$this->form_validation->set_rules('participants', 'Peserta', 'integer');
		$this->form_validation->set_rules('status', 'Status', 'trim|in_list[draft,published,cancelled,completed]');

		if ($this->form_validation->run() === FALSE) {
			// validation failed — redisplay form with errors
			$data = ['active_menu' => 'kegiatan'];
			$this->template->backend('backend/kegiatan/create', $data);
			return;
		}

		// Collect input
		$title = $this->input->post('title', true);
		$slug = $this->input->post('slug', true) ?: url_title($title, '-', true);
		$description = $this->input->post('description');
		$category = $this->input->post('category', true);
		$organizer = $this->input->post('organizer', true);
		$location = $this->input->post('location', true);
		$start_date_raw = $this->input->post('start_date');
		$end_date_raw = $this->input->post('end_date');
		$start_date = $start_date_raw ? date('Y-m-d H:i:s', strtotime($start_date_raw)) : null;
		$end_date = $end_date_raw ? date('Y-m-d H:i:s', strtotime($end_date_raw)) : null;
		$participants = (int) $this->input->post('participants');
		$contact_person = $this->input->post('contact_person', true);
		$contact_phone = $this->input->post('contact_phone', true);
		$status = $this->input->post('status', true) ?: 'draft';
		$is_active = $this->input->post('is_active') ? 1 : 0;

		// Prepare data array
		$save = [
			'title' => $title,
			'slug' => $slug,
			'description' => $description,
			'category' => $category,
			'organizer' => $organizer,
			'location' => $location,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'participants' => $participants,
			'contact_person' => $contact_person,
			'contact_phone' => $contact_phone,
			'status' => $status,
			'is_active' => $is_active,
			'created_by' => $this->session->userdata('admin_id') ?: null,
		];

		// Handle uploads: document and image
		$uploadErrors = [];
		// ensure directories exist
		$docPath = FCPATH . 'assets/documents/kegiatan/';
		$imgPath = FCPATH . 'assets/img/kegiatan/';
		if (!is_dir($docPath)) @mkdir($docPath, 0755, true);
		if (!is_dir($imgPath)) @mkdir($imgPath, 0755, true);

		$this->load->library('upload');

		if (!empty($_FILES['document_file']) && $_FILES['document_file']['size'] > 0) {
			$config = ['upload_path' => $docPath, 'allowed_types' => 'pdf|doc|docx|zip|ppt|pptx', 'max_size' => 8192, 'encrypt_name' => true];
			$this->upload->initialize($config);
			if ($this->upload->do_upload('document_file')) {
				$f = $this->upload->data();
				$save['document_url'] = 'assets/documents/kegiatan/' . $f['file_name'];
			} else {
				$uploadErrors[] = $this->upload->display_errors('', '');
			}
		}

		if (!empty($_FILES['image_file']) && $_FILES['image_file']['size'] > 0) {
			$config = ['upload_path' => $imgPath, 'allowed_types' => 'jpg|jpeg|png|gif', 'max_size' => 4096, 'encrypt_name' => true];
			$this->upload->initialize($config);
			if ($this->upload->do_upload('image_file')) {
				$f = $this->upload->data();
				$save['image_url'] = 'assets/img/kegiatan/' . $f['file_name'];
			} else {
				$uploadErrors[] = $this->upload->display_errors('', '');
			}
		}

		if (!empty($uploadErrors)) {
			// show upload errors along with form
			$data = ['active_menu' => 'kegiatan', 'upload_errors' => $uploadErrors];
			$this->template->backend('backend/kegiatan/create', $data);
			return;
		}

		// Insert
		$ok = $this->KegiatanModel->insert_kegiatan($save);
		if ($ok) {
			$this->session->set_flashdata('success', 'Kegiatan berhasil dibuat.');
			redirect('admin/kegiatan');
		} else {
			$this->session->set_flashdata('error', 'Gagal menyimpan kegiatan. Silakan coba lagi.');
			$data = ['active_menu' => 'kegiatan'];
			$this->template->backend('backend/kegiatan/create', $data);
		}
	}

	public function edit($id) {
		$kegiatan = $this->KegiatanModel->get_kegiatan_by_id($id);
		if (!$kegiatan) {
			show_404();
		}

		$this->template->set_title('Edit Kegiatan - LPM Web Solutions')
			->set_meta_description('Form untuk mengedit kegiatan di LPM Web Solutions.');

		$data = [
			'active_menu' => 'kegiatan',
			'kegiatan' => $kegiatan
		];

		$this->template->backend('backend/kegiatan/edit', $data);
	}

	public function update($id) {
		$kegiatan = $this->KegiatanModel->get_kegiatan_by_id($id);
		if (!$kegiatan) show_404();

		// Load helpers and libraries
		$this->load->library('form_validation');
		$this->load->helper(['url', 'text']);

		// Validation rules (same as store)
		$this->form_validation->set_rules('title', 'Judul', 'trim|required');
		$this->form_validation->set_rules('start_date', 'Tanggal Mulai', 'trim|required');
		$this->form_validation->set_rules('end_date', 'Tanggal Selesai', 'trim');
		$this->form_validation->set_rules('participants', 'Peserta', 'integer');
		$this->form_validation->set_rules('status', 'Status', 'trim|in_list[draft,published,cancelled,completed]');

		if ($this->form_validation->run() === FALSE) {
			$data = ['active_menu' => 'kegiatan', 'kegiatan' => $kegiatan];
			$this->template->backend('backend/kegiatan/edit', $data);
			return;
		}

		// Collect input
		$title = $this->input->post('title', true);
		$slug = $this->input->post('slug', true) ?: url_title($title, '-', true);
		$description = $this->input->post('description');
		$category = $this->input->post('category', true);
		$organizer = $this->input->post('organizer', true);
		$location = $this->input->post('location', true);
		$start_date_raw = $this->input->post('start_date');
		$end_date_raw = $this->input->post('end_date');
		$start_date = $start_date_raw ? date('Y-m-d H:i:s', strtotime($start_date_raw)) : null;
		$end_date = $end_date_raw ? date('Y-m-d H:i:s', strtotime($end_date_raw)) : null;
		$participants = (int) $this->input->post('participants');
		$contact_person = $this->input->post('contact_person', true);
		$contact_phone = $this->input->post('contact_phone', true);
		$status = $this->input->post('status', true) ?: 'draft';
		$is_active = $this->input->post('is_active') ? 1 : 0;

		// Prepare update array
		$save = [
			'title' => $title,
			'slug' => $slug,
			'description' => $description,
			'category' => $category,
			'organizer' => $organizer,
			'location' => $location,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'participants' => $participants,
			'contact_person' => $contact_person,
			'contact_phone' => $contact_phone,
			'status' => $status,
			'is_active' => $is_active,
			'updated_by' => $this->session->userdata('admin_id') ?: null,
		];

		// Handle uploads (replace and remove old files)
		$uploadErrors = [];
		$docPath = FCPATH . 'assets/documents/kegiatan/';
		$imgPath = FCPATH . 'assets/img/kegiatan/';
		if (!is_dir($docPath)) @mkdir($docPath, 0755, true);
		if (!is_dir($imgPath)) @mkdir($imgPath, 0755, true);

		$this->load->library('upload');

		if (!empty($_FILES['document_file']) && $_FILES['document_file']['size'] > 0) {
			$config = ['upload_path' => $docPath, 'allowed_types' => 'pdf|doc|docx|zip|ppt|pptx', 'max_size' => 8192, 'encrypt_name' => true];
			$this->upload->initialize($config);
			if ($this->upload->do_upload('document_file')) {
				$f = $this->upload->data();
				$save['document_url'] = 'assets/documents/kegiatan/' . $f['file_name'];
				// delete old
				if (!empty($kegiatan['document_url'])) {
					$old = FCPATH . $kegiatan['document_url'];
					if (is_file($old)) @unlink($old);
				}
			} else {
				$uploadErrors[] = $this->upload->display_errors('', '');
			}
		}

		if (!empty($_FILES['image_file']) && $_FILES['image_file']['size'] > 0) {
			$config = ['upload_path' => $imgPath, 'allowed_types' => 'jpg|jpeg|png|gif', 'max_size' => 4096, 'encrypt_name' => true];
			$this->upload->initialize($config);
			if ($this->upload->do_upload('image_file')) {
				$f = $this->upload->data();
				$save['image_url'] = 'assets/img/kegiatan/' . $f['file_name'];
				// delete old image
				if (!empty($kegiatan['image_url'])) {
					$old = FCPATH . $kegiatan['image_url'];
					if (is_file($old)) @unlink($old);
				}
			} else {
				$uploadErrors[] = $this->upload->display_errors('', '');
			}
		}

		if (!empty($uploadErrors)) {
			$data = ['active_menu' => 'kegiatan', 'kegiatan' => $kegiatan, 'upload_errors' => $uploadErrors];
			$this->template->backend('backend/kegiatan/edit', $data);
			return;
		}

		$ok = $this->KegiatanModel->update_kegiatan($id, $save);
		if ($ok) {
			$this->session->set_flashdata('success', 'Kegiatan berhasil diperbarui.');
			redirect('admin/kegiatan');
		} else {
			$this->session->set_flashdata('error', 'Gagal memperbarui kegiatan.');
			$data = ['active_menu' => 'kegiatan', 'kegiatan' => $kegiatan];
			$this->template->backend('backend/kegiatan/edit', $data);
		}
	}

	public function delete($id) {
		$kegiatan = $this->KegiatanModel->get_kegiatan_by_id($id);
		if (!$kegiatan) show_404();

		// remove files if exist
		if (!empty($kegiatan['document_url'])) {
			$doc = FCPATH . $kegiatan['document_url'];
			if (is_file($doc)) @unlink($doc);
		}
		if (!empty($kegiatan['image_url'])) {
			$img = FCPATH . $kegiatan['image_url'];
			if (is_file($img)) @unlink($img);
		}

		$ok = $this->KegiatanModel->delete_kegiatan($id);
		if ($ok) {
			$this->session->set_flashdata('success', 'Kegiatan berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus kegiatan.');
		}
		redirect('admin/kegiatan');
	}

	public function detail($id) {
		$kegiatan = $this->KegiatanModel->get_kegiatan_by_id($id);
		if (!$kegiatan) {
			show_404();
		}

		$this->template->set_title($kegiatan['title'] . ' - Kegiatan LPM Web Solutions')
			->set_meta_description(substr($kegiatan['description'], 0, 160));

		$data = [
			'active_menu' => 'kegiatan',
			'kegiatan' => $kegiatan
		];

		$this->template->render('backend/kegiatan/detail', $data);
	}
}
