<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SettingModel extends CI_Model {
	protected $table = 'site_settings';
	protected $fields = array('setting_key',
								'setting_value',
								'setting_group',
								'description',
								'updated_at'
								);

	public function insert($data) {
		return $this->db->insert($this->table, $data);
	}

	public function get_all_settings() {
		$query = $this->db->get($this->table);
		$settings = array();
		foreach ($query->result_array() as $row) {
			$settings[$row['setting_key']] = $row;
		}
		return $settings;
	}

	public function update_setting($key, $value) {
		$this->db->where('setting_key', $key);
		return $this->db->update($this->table, array(
			'setting_value' => $value,
			'updated_at' => date('Y-m-d H:i:s')
		));
	}

	public function get_setting($key) {
		$query = $this->db->get_where($this->table, array('setting_key' => $key));
		return $query->row_array();
	}
	public function get_setting_group($group_name) {
		$query = $this->db->get_where($this->table, array('setting_group' => $group_name));
		return $query->row_array();
	}

	public function delete_setting($id) {
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	public function get_setting_by_id($id) {
		$query = $this->db->get_where($this->table, array('id' => $id));
		return $query->row_array();
	}
}
