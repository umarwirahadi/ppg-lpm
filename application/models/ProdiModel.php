<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProdiModel extends CI_Model {

	protected $table = 'program_studi';
	protected $fields = array('kode',
'nama_prodi',
'fakultas',
'ketua_prodi',
'sekretaris_prodi',
'akreditasi',
'tgl_berlaku_akreditasi',
'tgl_berakhir_akreditasi',
'no_sk',
'keterangan',
'created_at'
);

	public function __construct() {
		parent::__construct();
	}

	public function get_all_prodi() {
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_prodi_by_id($id) {
		$query = $this->db->get_where($this->table, array('id' => $id));
		return $query->row_array();
	}

	public function insert_prodi($data) {
		return $this->db->insert($this->table, $data);
	}

	public function update_prodi($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function delete_prodi($id) {
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}
}
