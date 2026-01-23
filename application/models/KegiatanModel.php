<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class KegiatanModel extends CI_Model {

	protected $table = 'kegiatan';
	protected $fields = [
		'id',
		'nama_kegiatan',
		'deskripsi',
		'tanggal_mulai',
		'tanggal_selesai',
		'lokasi',
		'is_active',
		'created_at',
		'updated_at'
	];

	public function get_all_kegiatan() {
		return $this->db->get($this->table)->result_array();
	}

	public function get_kegiatan_by_id($id) {
		return $this->db->get_where($this->table, ['id' => $id])->row_array();
	}
}
