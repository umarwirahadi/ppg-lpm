<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('template');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('ContactModel');
        $this->load->helper(['url', 'form', 'file']);
        
        // Check if user is logged in
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('admin/login');
        }
    }

    /**
     * List all contacts
     */
    public function index() {
        $data['title'] = 'Kelola Kontak';
        
        // Check if database table exists
        if (!$this->db->table_exists('contacts')) {
            $data['error'] = 'Tabel contacts belum dibuat. Silakan import file SQL dari application/dbschema/contact.sql terlebih dahulu.';
            $data['contact_list'] = [];
            $data['search_keyword'] = '';
            $data['total_records'] = 0;
            $this->template->backend('backend/contact/index', $data, 'admin');
            return;
        }
        
        // Handle search
        $search = $this->input->get('search');
        if ($search) {
            try {
                $data['contact_list'] = $this->ContactModel->search($search);
            } catch (Exception $e) {
                $data['contact_list'] = [];
                $data['error'] = 'Database error: ' . $e->getMessage();
            }
            $data['search_keyword'] = $search;
        } else {
            try {
                $data['contact_list'] = $this->ContactModel->get_all();
            } catch (Exception $e) {
                $data['contact_list'] = [];
                $data['error'] = 'Database error: ' . $e->getMessage();
            }
            $data['search_keyword'] = '';
        }
        
        // Get total count for pagination info
        try {
            $data['total_records'] = $this->ContactModel->count_all();
        } catch (Exception $e) {
            $data['total_records'] = 0;
        }
        
        $this->template->backend('backend/contact/index', $data, 'admin');
    }

    /**
     * Show form to create new contact
     */
    public function create() {
        $data['title'] = 'Tambah Kontak';
        $data['action'] = 'create';
        $data['contact'] = [
            'nama' => '',
            'alamat_1' => '',
            'alamat_2' => '',
            'email' => '',
            'hp' => '',
            'phone' => '',
            'website' => '',
            'fax' => '',
            'description' => '',
            'is_active' => 1
        ];
        $data['contact_id'] = null; // Set for form consistency
        $data['errors'] = ''; // Initialize errors
        
        // Ensure upload directory exists
        $upload_dir = FCPATH . 'assets/img/contact/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $this->template->backend('backend/contact/form', $data, 'admin');
    }

    /**
     * Store new contact
     */
    public function store() {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('alamat_1', 'Alamat Utama', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|max_length[255]|is_unique[contacts.email]');
        $this->form_validation->set_rules('hp', 'HP', 'trim|max_length[20]');
        $this->form_validation->set_rules('phone', 'Telepon', 'trim|max_length[20]');
        $this->form_validation->set_rules('website', 'Website', 'trim|valid_url|max_length[255]');
        $this->form_validation->set_rules('fax', 'Fax', 'trim|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Kontak';
            $data['action'] = 'create';
            $data['contact'] = $this->input->post();
            $data['errors'] = validation_errors();
            
            $this->template->backend('backend/contact/form', $data, 'admin');
            return;
        }

        // Prepare data for insertion
        $insert_data = [
            'nama' => $this->input->post('nama'),
            'alamat_1' => $this->input->post('alamat_1'),
            'alamat_2' => $this->input->post('alamat_2'),
            'email' => $this->input->post('email'),
            'hp' => $this->input->post('hp'),
            'phone' => $this->input->post('phone'),
            'website' => $this->input->post('website'),
            'fax' => $this->input->post('fax'),
            'description' => $this->input->post('description'),
            'is_active' => 1
        ];

        // Handle logo upload
        if (!empty($_FILES['logo']['name'])) {
            $upload_result = $this->ContactModel->upload_logo('logo');
            if ($upload_result['success']) {
                $insert_data['logo_url'] = $upload_result['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload logo: ' . $upload_result['error']);
                redirect('backend/contact/create');
                return;
            }
        }

        // Insert data
        $insert_id = $this->ContactModel->insert($insert_data);
        
        if ($insert_id) {
            $this->session->set_flashdata('success', 'Data kontak berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data kontak. Email mungkin sudah digunakan.');
        }
        
        redirect('backend/contact');
    }

    /**
     * Show form to edit contact
     */
    public function edit($id) {
        $data['contact'] = $this->ContactModel->get_by_id($id);
        
        if (!$data['contact']) {
            $this->session->set_flashdata('error', 'Data kontak tidak ditemukan');
            redirect('backend/contact');
            return;
        }
        
        $data['title'] = 'Edit Kontak';
        $data['action'] = 'edit';
        $data['contact_id'] = $id;
        $data['errors'] = ''; // Initialize errors
        
        // Ensure upload directory exists
        $upload_dir = FCPATH . 'assets/img/contact/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $this->template->backend('backend/contact/form', $data, 'admin');
    }

    /**
     * Update contact
     */
    public function update($id) {
        // Check if contact exists
        $existing = $this->ContactModel->get_by_id($id);
        if (!$existing) {
            $this->session->set_flashdata('error', 'Data kontak tidak ditemukan');
            redirect('backend/contact');
            return;
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('alamat_1', 'Alamat Utama', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|max_length[255]|callback_check_email_unique[' . $id . ']');
        $this->form_validation->set_rules('hp', 'HP', 'trim|max_length[20]');
        $this->form_validation->set_rules('phone', 'Telepon', 'trim|max_length[20]');
        $this->form_validation->set_rules('website', 'Website', 'trim|valid_url|max_length[255]');
        $this->form_validation->set_rules('fax', 'Fax', 'trim|max_length[20]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Kontak';
            $data['action'] = 'edit';
            $data['contact'] = $this->input->post();
            $data['contact']['id'] = $id;
            $data['contact_id'] = $id;
            $data['errors'] = validation_errors();
            
            $this->template->backend('backend/contact/form', $data, 'admin');
            return;
        }

        // Prepare data for update
        $update_data = [
            'nama' => $this->input->post('nama'),
            'alamat_1' => $this->input->post('alamat_1'),
            'alamat_2' => $this->input->post('alamat_2'),
            'email' => $this->input->post('email'),
            'hp' => $this->input->post('hp'),
            'phone' => $this->input->post('phone'),
            'website' => $this->input->post('website'),
            'fax' => $this->input->post('fax'),
            'description' => $this->input->post('description'),
            'is_active' => $this->input->post('is_active') ?: 1
        ];

        // Handle logo upload
        if (!empty($_FILES['logo']['name'])) {
            // Delete old logo if exists
            if (!empty($existing['logo_url'])) {
                $old_logo_path = FCPATH . 'assets/img/contact/' . $existing['logo_url'];
                if (file_exists($old_logo_path)) {
                    unlink($old_logo_path);
                }
            }
            
            $upload_result = $this->ContactModel->upload_logo('logo');
            if ($upload_result['success']) {
                $update_data['logo_url'] = $upload_result['file_name'];
            } else {
                $this->session->set_flashdata('error', 'Gagal upload logo: ' . $upload_result['error']);
                redirect('backend/contact/edit/' . $id);
                return;
            }
        }

        // Update data
        $success = $this->ContactModel->update($id, $update_data);
        
        if ($success) {
            $this->session->set_flashdata('success', 'Data kontak berhasil diupdate');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate data kontak. Email mungkin sudah digunakan.');
        }
        
        redirect('backend/contact');
    }

    /**
     * Delete contact
     */
    public function delete($id) {
        $contact = $this->ContactModel->get_by_id($id);
        
        if (!$contact) {
            $this->session->set_flashdata('error', 'Data kontak tidak ditemukan');
        } else {
            $success = $this->ContactModel->delete($id);
            
            if ($success) {
                $this->session->set_flashdata('success', 'Data kontak berhasil dihapus');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data kontak');
            }
        }
        
        redirect('backend/contact');
    }

    /**
     * Restore deleted contact
     */
    public function restore($id) {
        $contact = $this->ContactModel->get_by_id($id);
        
        if (!$contact) {
            $this->session->set_flashdata('error', 'Data kontak tidak ditemukan');
        } else {
            $success = $this->ContactModel->restore($id);
            
            if ($success) {
                $this->session->set_flashdata('success', 'Data kontak berhasil dipulihkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal memulihkan data kontak');
            }
        }
        
        redirect('backend/contact');
    }

    /**
     * View detail contact
     */
    public function detail($id) {
        $data['contact'] = $this->ContactModel->get_by_id($id);
        
        if (!$data['contact']) {
            $this->session->set_flashdata('error', 'Data kontak tidak ditemukan');
            redirect('backend/contact');
            return;
        }
        
        $data['title'] = 'Detail Kontak';
        
        $this->template->backend('backend/contact/detail', $data, 'admin');
    }

    /**
     * Export contacts to CSV
     */
    public function export_csv() {
        $contact_list = $this->ContactModel->get_all();
        
        $filename = 'contacts_' . date('Y-m-d_H-i-s') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Header CSV
        fputcsv($output, ['ID', 'Nama', 'Alamat 1', 'Alamat 2', 'Email', 'HP', 'Telepon', 'Website', 'Fax', 'Deskripsi', 'Status', 'Dibuat']);
        
        // Data CSV
        foreach ($contact_list as $row) {
            fputcsv($output, [
                $row['id'],
                $row['nama'],
                $row['alamat_1'],
                $row['alamat_2'],
                $row['email'],
                $row['hp'],
                $row['phone'],
                $row['website'],
                $row['fax'],
                $row['description'],
                $row['is_active'] ? 'Aktif' : 'Tidak Aktif',
                $row['created_at']
            ]);
        }
        
        fclose($output);
    }

    /**
     * Custom validation callback to check email uniqueness for update
     */
    public function check_email_unique($email, $id) {
        $existing = $this->db->where('email', $email)->where('id !=', $id)->get('contacts')->row();
        
        if ($existing) {
            $this->form_validation->set_message('check_email_unique', 'Email sudah digunakan oleh kontak lain.');
            return FALSE;
        }
        
        return TRUE;
    }
}
