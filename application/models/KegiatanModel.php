<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class KegiatanModel extends CI_Model {

	protected $table = 'kegiatan';
	protected $fields = [
'id',
'title',
'slug',
'description',
'category',
'organizer',
'location',
'start_date',
'end_date',
'timezone',
'participants',
'contact_person',
'contact_phone',
'document_url',
'image_url',
'status',
'is_active',
'created_by',
'updated_by',
'created_at',
'updated_at'
	];

	public function get_all_kegiatan() {
		return $this->db->get($this->table)->result_array();
	}

	public function get_all_published_kegiatan() {
		$this->db->where('status', 'published');
		$this->db->where('is_active', 1);
		return $this->db->get($this->table)->result_array();
	}

	public function get_kegiatan_by_id($id) {
		return $this->db->get_where($this->table, ['id' => $id])->row_array();
	}

	public function insert_kegiatan($data) {
		return $this->db->insert($this->table, $data);
	}

	public function update_kegiatan($id, $data) {
		$this->db->where('id', $id);
		return $this->db->update($this->table, $data);
	}

	public function delete_kegiatan($id) {
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}
}
