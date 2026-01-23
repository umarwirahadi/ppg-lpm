<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactModel extends CI_Model {
	
	private $table = 'contacts';
	private $fields = [
		'id',
		'nama',
		'alamat_1',
		'alamat_2',
		'email',
		'hp',
		'phone',
		'website',
		'fax',
		'logo_url',
		'description',
		'is_active',
		'created_at',
		'updated_at'
	];

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Get all contacts
	 * @param bool $active_only - if true, only return active contacts
	 * @return array
	 */
	public function get_all($active_only = false) {
		$this->db->select(implode(',', $this->fields));
		$this->db->from($this->table);
		
		if ($active_only) {
			$this->db->where('is_active', 1);
		}
		
		$this->db->order_by('created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	/**
	 * Get contact by ID
	 * @param int $id
	 * @return array|null
	 */
	public function get_by_id($id) {
		$this->db->select(implode(',', $this->fields));
		$this->db->from($this->table);
		$this->db->where('id', $id);
		$result = $this->db->get()->row_array();
		return $result ? $result : null;
	}

	/**
	 * Search contacts by name or email
	 * @param string $keyword
	 * @return array
	 */
	public function search($keyword) {
		$this->db->select(implode(',', $this->fields));
		$this->db->from($this->table);
		$this->db->group_start();
		$this->db->like('nama', $keyword);
		$this->db->or_like('email', $keyword);
		$this->db->or_like('description', $keyword);
		$this->db->group_end();
		$this->db->order_by('created_at', 'DESC');
		return $this->db->get()->result_array();
	}

	/**
	 * Insert new contact
	 * @param array $data
	 * @return int|bool - contact ID if success, false if failed
	 */
	public function insert($data) {
		// Validate required fields
		if (empty($data['nama']) || empty($data['email'])) {
			return false;
		}

		// Check if email already exists
		if ($this->email_exists($data['email'])) {
			return false;
		}

		// Filter only allowed fields
		$insert_data = [];
		foreach ($this->fields as $field) {
			if (isset($data[$field]) && $field !== 'id' && $field !== 'created_at' && $field !== 'updated_at') {
				$insert_data[$field] = $data[$field];
			}
		}

		$this->db->insert($this->table, $insert_data);
		return $this->db->insert_id();
	}

	/**
	 * Update contact
	 * @param int $id
	 * @param array $data
	 * @return bool
	 */
	public function update($id, $data) {
		// Validate ID
		if (!$this->get_by_id($id)) {
			return false;
		}

		// Check if email already exists for other records
		if (isset($data['email']) && $this->email_exists($data['email'], $id)) {
			return false;
		}

		// Filter only allowed fields
		$update_data = [];
		foreach ($this->fields as $field) {
			if (isset($data[$field]) && $field !== 'id' && $field !== 'created_at' && $field !== 'updated_at') {
				$update_data[$field] = $data[$field];
			}
		}

		if (empty($update_data)) {
			return false;
		}

		$this->db->where('id', $id);
		return $this->db->update($this->table, $update_data);
	}

	/**
	 * Delete contact (soft delete by setting is_active to 0)
	 * @param int $id
	 * @return bool
	 */
	public function delete($id) {
		$this->db->where('id', $id);
		return $this->db->update($this->table, ['is_active' => 0]);
	}

	/**
	 * Permanently delete contact
	 * @param int $id
	 * @return bool
	 */
	public function permanent_delete($id) {
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	/**
	 * Restore deleted contact
	 * @param int $id
	 * @return bool
	 */
	public function restore($id) {
		$this->db->where('id', $id);
		return $this->db->update($this->table, ['is_active' => 1]);
	}

	/**
	 * Count all contacts
	 * @param bool $active_only
	 * @return int
	 */
	public function count_all($active_only = false) {
		$this->db->from($this->table);
		if ($active_only) {
			$this->db->where('is_active', 1);
		}
		return $this->db->count_all_results();
	}

	/**
	 * Check if email exists
	 * @param string $email
	 * @param int $exclude_id - ID to exclude from check (for update operations)
	 * @return bool
	 */
	private function email_exists($email, $exclude_id = null) {
		$this->db->from($this->table);
		$this->db->where('email', $email);
		if ($exclude_id) {
			$this->db->where('id !=', $exclude_id);
		}
		return $this->db->count_all_results() > 0;
	}

	/**
	 * Get primary/main contact
	 * @return array|null
	 */
	public function get_main_contact() {
		$this->db->select(implode(',', $this->fields));
		$this->db->from($this->table);
		$this->db->where('is_active', 1);
		$this->db->order_by('id', 'ASC');
		$this->db->limit(1);
		$result = $this->db->get()->row_array();
		return $result ? $result : null;
	}

	/**
	 * Upload logo file
	 * @param string $field_name
	 * @return array
	 */
	public function upload_logo($field_name) {
		$config['upload_path'] = FCPATH . 'assets/img/contact/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|svg';
		$config['max_size'] = 2048; // 2MB
		$config['max_width'] = 2000;
		$config['max_height'] = 2000;
		$config['file_name'] = 'logo_' . time() . '_' . uniqid();
		$config['encrypt_name'] = FALSE;
		$config['remove_spaces'] = TRUE;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload($field_name)) {
			$upload_data = $this->upload->data();
			
			// Resize image if needed
			$this->load->library('image_lib');
			$resize_config['image_library'] = 'gd2';
			$resize_config['source_image'] = $upload_data['full_path'];
			$resize_config['maintain_ratio'] = TRUE;
			$resize_config['width'] = 400;
			$resize_config['height'] = 400;
			
			$this->image_lib->initialize($resize_config);
			$this->image_lib->resize();
			$this->image_lib->clear();
			
			return [
				'success' => TRUE,
				'file_name' => $upload_data['file_name'],
				'file_path' => $upload_data['full_path']
			];
		} else {
			return [
				'success' => FALSE,
				'error' => $this->upload->display_errors('', '')
			];
		}
	}

	/**
	 * Delete logo file
	 * @param string $file_name
	 * @return bool
	 */
	public function delete_logo($file_name) {
		if (empty($file_name)) {
			return TRUE;
		}
		
		$file_path = FCPATH . 'assets/img/contact/' . $file_name;
		if (file_exists($file_path)) {
			return unlink($file_path);
		}
		
		return TRUE;
	}

	/**
	 * Validate contact data
	 * @param array $data
	 * @param int $exclude_id
	 * @return array
	 */
	public function validate($data, $exclude_id = null) {
		$errors = [];
		
		// Required fields validation
		if (empty($data['nama'])) {
			$errors[] = 'Nama tidak boleh kosong';
		} elseif (strlen($data['nama']) < 3) {
			$errors[] = 'Nama minimal 3 karakter';
		} elseif (strlen($data['nama']) > 255) {
			$errors[] = 'Nama maksimal 255 karakter';
		}
		
		if (empty($data['alamat_1'])) {
			$errors[] = 'Alamat utama tidak boleh kosong';
		} elseif (strlen($data['alamat_1']) < 5) {
			$errors[] = 'Alamat utama minimal 5 karakter';
		}
		
		if (empty($data['email'])) {
			$errors[] = 'Email tidak boleh kosong';
		} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			$errors[] = 'Format email tidak valid';
		} elseif ($this->email_exists($data['email'], $exclude_id)) {
			$errors[] = 'Email sudah digunakan';
		}
		
		// Optional fields validation
		if (!empty($data['website']) && !filter_var($data['website'], FILTER_VALIDATE_URL)) {
			$errors[] = 'Format website tidak valid';
		}
		
		if (!empty($data['hp']) && strlen($data['hp']) > 20) {
			$errors[] = 'Nomor HP maksimal 20 karakter';
		}
		
		if (!empty($data['phone']) && strlen($data['phone']) > 20) {
			$errors[] = 'Nomor telepon maksimal 20 karakter';
		}
		
		if (!empty($data['fax']) && strlen($data['fax']) > 20) {
			$errors[] = 'Nomor fax maksimal 20 karakter';
		}
		
		return [
			'valid' => empty($errors),
			'errors' => $errors
		];
	}
}
