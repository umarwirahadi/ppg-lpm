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
	public function get_all_dokumen($active_only = false) {
		$this->db->select(implode(',', $this->fields));
		$this->db->from($this->table);
		if ($active_only) {
			$this->db->where('is_active', 1);
		}
		$this->db->order_by('created_at', 'DESC');
		return $this->db->get()->result();
	
	}

	public function insert_dokumen($data) {
		return $this->db->insert($this->table, $data);
	}

	public function get_dokumen_by_id($id) {
		$this->db->select(implode(',', $this->fields));
		$this->db->from($this->table);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}

	public function update_dokumen($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	
}
