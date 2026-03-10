<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class DokumenModel extends CI_Model {
	
	private $table = 'dokumen_spmi';
	private $fields = [
		'id',
		'title',
		'category',
		'description',
		'file_url',
		'is_active',
		'created_at',
		'updated_at'
	];

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Get all dokumen
	 * @param bool $active_only - if true, only return active dokumen
	 * @return array
	 */
	public function get_all_dokumen($is_active = false, $limit = null, $offset = null, $search = null) {
		if ($is_active) {
			$this->db->where('is_active', 1);
		}
		$search = is_string($search) ? trim($search) : '';
		if ($search !== '') {
			$this->db->group_start();
			$this->db->like('title', $search);
			$this->db->or_like('description', $search);
			$this->db->or_like('category', $search);
			$this->db->group_end();
		}
		if ($limit !== null && $offset !== null) {
			$this->db->limit($limit, $offset);
		}
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function count_all_dokumen($is_active = false, $search = null) {
		if ($is_active) {
			$this->db->where('is_active', 1);
		}
		$search = is_string($search) ? trim($search) : '';
		if ($search !== '') {
			$this->db->group_start();
			$this->db->like('title', $search);
			$this->db->or_like('description', $search);
			$this->db->or_like('category', $search);
			$this->db->group_end();
		}
		return $this->db->count_all_results($this->table);
	}

	public function get_dokumen_by_id($id, $is_active = false) {
		$this->db->select(implode(',', $this->fields));
		$this->db->from($this->table);
		$this->db->where('id', $id);
		if ($is_active) {
			$this->db->where('is_active', 1);
		}
		return $this->db->get()->row_array();
	}

	public function update_dokumen($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function delete_dokumen($id) {
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	
}
