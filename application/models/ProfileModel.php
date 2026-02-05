<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileModel extends CI_Model {
    
    protected $table = 'lpm_profile';
    
    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all active profile data ordered by display_order
     */
    public function get_all($include_inactive = false) {
        if (!$include_inactive) {
            $this->db->where('is_active', 1);
        }
        $this->db->order_by('display_order', 'ASC');
        return $this->db->get($this->table)->result_array();
    }

    /**
     * Get profile by key (tentang, visi, misi, tugas)
     */
    public function get_by_key($key) {
        $this->db->where('profile_key', $key);
        $this->db->where('is_active', 1);
        return $this->db->get($this->table)->row_array();
    }

    /**
     * Get multiple profiles by keys
     */
    public function get_by_keys($keys = []) {
        if (empty($keys)) {
            return [];
        }
        $this->db->where_in('profile_key', $keys);
        $this->db->where('is_active', 1);
        $this->db->order_by('display_order', 'ASC');
        return $this->db->get($this->table)->result_array();
    }

    /**
     * Get profile data formatted as key => data array
     */
    public function get_all_keyed() {
        $profiles = $this->get_all();
        $keyed = [];
        foreach ($profiles as $profile) {
            $keyed[$profile['profile_key']] = $profile;
        }
        return $keyed;
    }

    /**
     * Get tentang data
     */
    public function get_tentang() {
        return $this->get_by_key('tentang');
    }

    /**
     * Get visi data
     */
    public function get_visi() {
        return $this->get_by_key('visi');
    }

    /**
     * Get misi data
     */
    public function get_misi() {
        return $this->get_by_key('misi');
    }

    /**
     * Get tugas dan tanggung jawab data
     */
    public function get_tugas() {
        $tugas = $this->get_by_key('tugas');
        if ($tugas && !empty($tugas['content'])) {
            // Decode JSON content for tugas
            $tugas['items'] = json_decode($tugas['content'], true);
        }
        return $tugas;
    }

    /**
     * Get visi and misi together
     */
    public function get_visi_misi() {
        return $this->get_by_keys(['visi', 'misi']);
    }

    /**
     * Insert new profile
     */
    public function insert($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update profile by ID
     */
    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Update profile by key
     */
    public function update_by_key($key, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('profile_key', $key);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete profile by ID
     */
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    /**
     * Get profile by ID
     */
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    /**
     * Toggle active status
     */
    public function toggle_status($id) {
        $profile = $this->get_by_id($id);
        if ($profile) {
            $new_status = $profile['is_active'] == 1 ? 0 : 1;
            return $this->update($id, ['is_active' => $new_status]);
        }
        return false;
    }
}
