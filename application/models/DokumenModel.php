<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class DokumenModel extends CI_Model {
	
	private $table = 'dokumen_spmi';
	private $fields = [
		'id',
		'title',
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

	
}
