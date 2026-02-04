<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LaporanModel extends CI_Model {

	protected $table = 'laporan';
	protected $fields = ['id', 'title', 'description', 'file_path','status', 'created_at', 'updated_at'];

	public function __construct() {
		parent::__construct();
	}

	// Fetch all laporan records
	public function get_all_laporan() {
		$query = $this->db->get('laporan');
		return $query->result();
	}

	public function get_laporan_by_id($id) {
		$query = $this->db->get_where('laporan', ['id' => $id]);
		return $query->row();
	}

	public function insert_laporan($data) {
		return $this->db->insert('laporan', $data);
	}

	public function update_laporan($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update('laporan', $data);
	}

	public function delete_laporan($id) {
		$this->db->where('id', $id);
		return $this->db->delete('laporan');
	}
}
