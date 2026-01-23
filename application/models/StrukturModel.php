<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StrukturModel extends CI_Model {

    private $table = 'struktur_organisasi';
    private $primary_key = 'id';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all struktur organisasi records
     * @param array $conditions
     * @param string $order_by
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function get_all($conditions = [], $order_by = 'urutan ASC, created_at DESC', $limit = null, $offset = 0) {
        if (!empty($conditions)) {
            $this->db->where($conditions);
        }
        
        if ($order_by) {
            $this->db->order_by($order_by);
        }
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * Get struktur organisasi by ID
     * @param int $id
     * @return array|null
     */
    public function get_by_id($id) {
        $this->db->where($this->primary_key, $id);
        $query = $this->db->get($this->table);
        return $query->row_array();
    }

    /**
     * Get struktur organisasi by level jabatan
     * @param string $level
     * @return array
     */
    public function get_by_level($level) {
        $this->db->where('level_jabatan', $level);
        $this->db->where('status', 'aktif');
        $this->db->order_by('urutan', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * Insert new struktur organisasi record
     * @param array $data
     * @return int|bool
     */
    public function insert($data) {
        // Validate required fields
        $required_fields = ['nama', 'jabatan', 'level_jabatan'];
        foreach ($required_fields as $field) {
            if (empty($data[$field])) {
                return false;
            }
        }

        // Set default values
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        // Set urutan if not provided
        if (empty($data['urutan'])) {
            $data['urutan'] = $this->get_next_urutan();
        }

        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update struktur organisasi record
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data) {
        // Remove created_at from update data
        unset($data['created_at']);
        $data['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where($this->primary_key, $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete struktur organisasi record
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        // Get the record first to check if foto exists
        $record = $this->get_by_id($id);
        if ($record && !empty($record['foto'])) {
            $foto_path = FCPATH . 'assets/img/struktur/' . $record['foto'];
            if (file_exists($foto_path)) {
                unlink($foto_path);
            }
        }

        $this->db->where($this->primary_key, $id);
        return $this->db->delete($this->table);
    }

    /**
     * Get total count of records
     * @param array $conditions
     * @return int
     */
    public function count_all($conditions = []) {
        if (!empty($conditions)) {
            $this->db->where($conditions);
        }
        return $this->db->count_all_results($this->table);
    }

    /**
     * Search struktur organisasi
     * @param string $keyword
     * @return array
     */
    public function search($keyword) {
        $this->db->group_start();
        $this->db->like('nama', $keyword);
        $this->db->or_like('jabatan', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('deskripsi', $keyword);
        $this->db->group_end();
        
        $this->db->order_by('urutan', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * Update urutan (order) of struktur organisasi
     * @param array $urutan_data - array of ['id' => urutan_value]
     * @return bool
     */
    public function update_urutan($urutan_data) {
        $this->db->trans_start();
        
        foreach ($urutan_data as $id => $urutan) {
            $this->db->where($this->primary_key, $id);
            $this->db->update($this->table, ['urutan' => $urutan, 'updated_at' => date('Y-m-d H:i:s')]);
        }
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * Get next urutan number
     * @return int
     */
    private function get_next_urutan() {
        $this->db->select_max('urutan');
        $query = $this->db->get($this->table);
        $result = $query->row_array();
        return (int)$result['urutan'] + 1;
    }

    /**
     * Upload and process foto
     * @param string $field_name
     * @return array ['success' => bool, 'file_name' => string, 'error' => string]
     */
    public function upload_foto($field_name = 'foto') {
        $config['upload_path']      = FCPATH . 'assets/img/struktur/';
        $config['allowed_types']    = 'gif|jpg|png|jpeg';
        $config['max_size']         = 2048; // 2MB
        $config['max_width']        = 2000;
        $config['max_height']       = 2000;
        $config['file_name']        = 'struktur_' . time();

        // Create directory if not exists
        if (!file_exists($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload($field_name)) {
            $upload_data = $this->upload->data();
            
            // Resize image if needed
            $this->load->library('image_lib');
            $resize_config['image_library'] = 'gd2';
            $resize_config['source_image'] = $upload_data['full_path'];
            $resize_config['maintain_ratio'] = TRUE;
            $resize_config['width'] = 300;
            $resize_config['height'] = 400;
            
            $this->image_lib->initialize($resize_config);
            $this->image_lib->resize();

            return [
                'success' => true,
                'file_name' => $upload_data['file_name'],
                'error' => ''
            ];
        } else {
            return [
                'success' => false,
                'file_name' => '',
                'error' => $this->upload->display_errors('', '')
            ];
        }
    }

    /**
     * Get struktur organisasi for frontend display
     * @return array
     */
    public function get_for_frontend() {
        $this->db->where('status', 'aktif');
        $this->db->order_by('urutan', 'ASC');
        $query = $this->db->get($this->table);
        $result = $query->result_array();

        // Group by level for better frontend display
        $grouped = [];
        foreach ($result as $item) {
            $grouped[$item['level_jabatan']][] = $item;
        }

        return $grouped;
    }

    /**
     * Validate struktur organisasi data
     * @param array $data
     * @param int $id - for update validation
     * @return array ['valid' => bool, 'errors' => array]
     */
    public function validate($data, $id = null) {
        $errors = [];

        // Required field validation
        if (empty($data['nama'])) {
            $errors[] = 'Nama harus diisi';
        }

        if (empty($data['jabatan'])) {
            $errors[] = 'Jabatan harus diisi';
        }

        if (empty($data['level_jabatan'])) {
            $errors[] = 'Level jabatan harus dipilih';
        }

        // Email validation
        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Format email tidak valid';
        }

        // Check email uniqueness
        if (!empty($data['email'])) {
            $this->db->where('email', $data['email']);
            if ($id) {
                $this->db->where('id !=', $id);
            }
            $existing = $this->db->get($this->table)->num_rows();
            if ($existing > 0) {
                $errors[] = 'Email sudah digunakan';
            }
        }

        // Phone validation
        if (!empty($data['telepon']) && !preg_match('/^[0-9\-\+\(\)\s]+$/', $data['telepon'])) {
            $errors[] = 'Format telepon tidak valid';
        }

        return [
            'valid' => empty($errors),
            'errors' => $errors
        ];
    }

    // Legacy method for backward compatibility
    public function get_all_struktur() {
        return $this->get_all();
    }
}
