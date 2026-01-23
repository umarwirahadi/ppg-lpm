<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Struktur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('template');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('StrukturModel');
        $this->load->helper(['url', 'form', 'file']);
        
        // Check if user is logged in
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
    }

    /**
     * List all struktur organisasi
     */
    /**
     * List all struktur organisasi
     */
    public function index() {
        $data['title'] = 'Kelola Struktur Organisasi';
        
        // Check if database table exists
        if (!$this->db->table_exists('struktur_organisasi')) {
            $data['error'] = 'Tabel struktur_organisasi belum dibuat. Silakan import file SQL dari application/dbschema/struktur_organisasi.sql terlebih dahulu.';
            $data['struktur_list'] = [];
            $data['search_keyword'] = '';
            $data['total_records'] = 0;
            $this->template->backend('backend/struktur/index', $data);
            return;
        }
        
        // Handle search
        $search = $this->input->get('search');
        if ($search) {
            try {
                $data['struktur_list'] = $this->StrukturModel->search($search);
            } catch (Exception $e) {
                $data['struktur_list'] = [];
                $data['error'] = 'Database error: ' . $e->getMessage();
            }
            $data['search_keyword'] = $search;
        } else {
            try {
                $data['struktur_list'] = $this->StrukturModel->get_all();
            } catch (Exception $e) {
                $data['struktur_list'] = [];
                $data['error'] = 'Database error: ' . $e->getMessage();
            }
            $data['search_keyword'] = '';
        }
        
        // Get total count for pagination info
        try {
            $data['total_records'] = $this->StrukturModel->count_all();
        } catch (Exception $e) {
            $data['total_records'] = 0;
        }
        
        $this->template->backend('backend/struktur/index', $data);
    }

    /**
     * Show form to create new struktur organisasi
     */
    public function create() {
        $data['title'] = 'Tambah Struktur Organisasi';
        $data['action'] = 'create';
        $data['struktur'] = [
            'nama' => '',
            'jabatan' => '',
            'level_jabatan' => '',
            'email' => '',
            'telepon' => '',
            'deskripsi' => '',
            'pendidikan_terakhir' => '',
            'pengalaman' => '',
            'urutan' => '',
            'status' => 'aktif',
            'tanggal_bergabung' => ''
        ];
        $data['struktur_id'] = null; // Set for form consistency
        $data['errors'] = ''; // Initialize errors
        
        // Ensure upload directory exists
        $upload_dir = FCPATH . 'assets/img/struktur/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $this->template->backend('backend/struktur/form', $data, 'admin');
    }

    /**
     * Store new struktur organisasi
     */
    public function store() {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_rules('level_jabatan', 'Level Jabatan', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|trim');
        $this->form_validation->set_rules('telepon', 'Telepon', 'trim');
        $this->form_validation->set_rules('urutan', 'Urutan', 'integer');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Struktur Organisasi';
            $data['action'] = 'create';
            $data['struktur'] = $this->input->post();
            $data['errors'] = validation_errors();
            
            $this->template->backend('backend/struktur/form', $data, 'admin');
            return;
        }

        // Prepare data for insertion
        $insert_data = [
            'nama' => $this->input->post('nama'),
            'jabatan' => $this->input->post('jabatan'),
            'level_jabatan' => $this->input->post('level_jabatan'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'deskripsi' => $this->input->post('deskripsi'),
            'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
            'pengalaman' => $this->input->post('pengalaman'),
            'urutan' => $this->input->post('urutan') ?: 0,
            'status' => $this->input->post('status') ?: 'aktif',
            'tanggal_bergabung' => $this->input->post('tanggal_bergabung')
        ];

        // Handle foto upload
        if (!empty($_FILES['foto']['name'])) {
            $upload_result = $this->StrukturModel->upload_foto('foto');
            if ($upload_result['success']) {
                $insert_data['foto'] = $upload_result['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload foto: ' . $upload_result['error']);
                redirect('admin/struktur/create');
                return;
            }
        }

        // Validate data
        $validation = $this->StrukturModel->validate($insert_data);
        if (!$validation['valid']) {
            $data['title'] = 'Tambah Struktur Organisasi';
            $data['action'] = 'create';
            $data['struktur'] = $insert_data;
            $data['errors'] = implode('<br>', $validation['errors']);
            
            $this->template->backend('backend/struktur/form', $data, 'admin');
            return;
        }

        // Insert data
        $insert_id = $this->StrukturModel->insert($insert_data);
        
        if ($insert_id) {
            $this->session->set_flashdata('success', 'Data struktur organisasi berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data struktur organisasi');
        }
        
        redirect('admin/struktur');
    }

    /**
     * Show form to edit struktur organisasi
     */
    public function edit($id) {
        $data['struktur'] = $this->StrukturModel->get_by_id($id);
        
        if (!$data['struktur']) {
            $this->session->set_flashdata('error', 'Data struktur organisasi tidak ditemukan');
            redirect('admin/struktur');
            return;
        }
        
        $data['title'] = 'Edit Struktur Organisasi';
        $data['action'] = 'edit';
        $data['struktur_id'] = $id;
        $data['errors'] = ''; // Initialize errors
        
        // Ensure upload directory exists
        $upload_dir = FCPATH . 'assets/img/struktur/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $this->template->backend('backend/struktur/form', $data, 'admin');
    }

    /**
     * Show form to edit struktur organisasi
     */
    public function update($id) {
        // Check if struktur exists
        $existing = $this->StrukturModel->get_by_id($id);
        if (!$existing) {
            $this->session->set_flashdata('error', 'Data struktur organisasi tidak ditemukan');
            redirect('admin/struktur');
            return;
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_rules('level_jabatan', 'Level Jabatan', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|trim');
        $this->form_validation->set_rules('telepon', 'Telepon', 'trim');
        $this->form_validation->set_rules('urutan', 'Urutan', 'integer');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Struktur Organisasi';
            $data['action'] = 'edit';
            $data['struktur'] = $this->input->post();
            $data['struktur']['id'] = $id;
            $data['struktur_id'] = $id;
            $data['errors'] = validation_errors();
            
            $this->template->backend('backend/struktur/form', $data, 'admin');
            return;
        }

        // Prepare data for update
        $update_data = [
            'nama' => $this->input->post('nama'),
            'jabatan' => $this->input->post('jabatan'),
            'level_jabatan' => $this->input->post('level_jabatan'),
            'email' => $this->input->post('email'),
            'telepon' => $this->input->post('telepon'),
            'deskripsi' => $this->input->post('deskripsi'),
            'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir'),
            'pengalaman' => $this->input->post('pengalaman'),
            'urutan' => $this->input->post('urutan') ?: 0,
            'status' => $this->input->post('status') ?: 'aktif',
            'tanggal_bergabung' => $this->input->post('tanggal_bergabung')
        ];

        // Handle foto upload
        if (!empty($_FILES['foto']['name'])) {
            // Delete old foto if exists
            if (!empty($existing['foto'])) {
                $old_foto_path = FCPATH . 'assets/img/struktur/' . $existing['foto'];
                if (file_exists($old_foto_path)) {
                    unlink($old_foto_path);
                }
            }
            
            $upload_result = $this->StrukturModel->upload_foto('foto');
            if ($upload_result['success']) {
                $update_data['foto'] = $upload_result['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload foto: ' . $upload_result['error']);
                redirect('admin/struktur/edit/' . $id);
                return;
            }
        }

        // Validate data
        $validation = $this->StrukturModel->validate($update_data, $id);
        if (!$validation['valid']) {
            $data['title'] = 'Edit Struktur Organisasi';
            $data['action'] = 'edit';
            $data['struktur'] = array_merge($existing, $update_data);
            $data['struktur_id'] = $id;
            $data['errors'] = implode('<br>', $validation['errors']);
            
            $this->template->backend('backend/struktur/form', $data, 'admin');
            return;
        }

        // Update data
        $success = $this->StrukturModel->update($id, $update_data);
        
        if ($success) {
            $this->session->set_flashdata('success', 'Data struktur organisasi berhasil diupdate');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate data struktur organisasi');
        }
        
        redirect('admin/struktur');
    }

    /**
     * Delete struktur organisasi
     */
    public function delete($id) {
        $struktur = $this->StrukturModel->get_by_id($id);
        
        if (!$struktur) {
            $this->session->set_flashdata('error', 'Data struktur organisasi tidak ditemukan');
        } else {
            $success = $this->StrukturModel->delete($id);
            
            if ($success) {
                $this->session->set_flashdata('success', 'Data struktur organisasi berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data struktur organisasi');
            }
        }
        
        redirect('admin/struktur');
    }

    /**
     * View detail struktur organisasi
     */
    public function detail($id) {
        $data['struktur'] = $this->StrukturModel->get_by_id($id);
        
        if (!$data['struktur']) {
            $this->session->set_flashdata('error', 'Data struktur organisasi tidak ditemukan');
            redirect('admin/struktur');
            return;
        }
        
        $data['title'] = 'Detail Struktur Organisasi';
        
        $this->template->backend('backend/struktur/detail', $data, 'admin');
    }

    /**
     * Update urutan (order) via AJAX
     */
    public function update_urutan() {
        if ($this->input->is_ajax_request()) {
            $urutan_data = $this->input->post('urutan');
            
            if ($urutan_data) {
                $success = $this->StrukturModel->update_urutan($urutan_data);
                
                if ($success) {
                    echo json_encode(['status' => 'success', 'message' => 'Urutan berhasil diupdate']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate urutan']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data urutan tidak valid']);
            }
        } else {
            show_404();
        }
    }

    /**
     * Export struktur organisasi to CSV
     */
    public function export_csv() {
        $struktur_list = $this->StrukturModel->get_all();
        
        $filename = 'struktur_organisasi_' . date('Y-m-d_H-i-s') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Header CSV
        fputcsv($output, ['ID', 'Nama', 'Jabatan', 'Level Jabatan', 'Email', 'Telepon', 'Pendidikan Terakhir', 'Urutan', 'Status', 'Tanggal Bergabung']);
        
        // Data CSV
        foreach ($struktur_list as $row) {
            fputcsv($output, [
                $row['id'],
                $row['nama'],
                $row['jabatan'],
                $row['level_jabatan'],
                $row['email'],
                $row['telepon'],
                $row['pendidikan_terakhir'],
                $row['urutan'],
                $row['status'],
                $row['tanggal_bergabung']
            ]);
        }
        
        fclose($output);
    }
}
