<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profilelpm extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['template', 'auth']);
        $this->load->model('ProfileModel');
        
        // Check authentication
        $this->auth->require_login();
    }

    public function index() {
        $this->template->set_title('Profile LPM - Admin')
            ->set_meta_description('Kelola profil LPM - Tentang, Visi, Misi, Tugas');

        $data = [
            'active_menu' => 'profile-lpm',
            'profiles' => $this->ProfileModel->get_all(true) // include inactive
        ];

        $this->template->backend('backend/profilelpm/index', $data);
    }

    public function edit($id) {
        $profile = $this->ProfileModel->get_by_id($id);
        
        if (!$profile) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('admin/profile-lpm');
        }

        $this->template->set_title('Edit Profile - Admin');

        $data = [
            'active_menu' => 'profile-lpm',
            'profile' => $profile
        ];

        $this->template->backend('backend/profilelpm/edit', $data);
    }

    public function update($id) {
        $profile = $this->ProfileModel->get_by_id($id);
        
        if (!$profile) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('admin/profile-lpm');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
            return;
        }

        $update_data = [
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'icon' => $this->input->post('icon'),
            'display_order' => (int) $this->input->post('display_order'),
            'is_active' => $this->input->post('is_active') ? 1 : 0
        ];

        if ($this->ProfileModel->update($id, $update_data)) {
            $this->session->set_flashdata('success', 'Profile berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui profile.');
        }

        redirect('admin/profile-lpm');
    }

    public function toggle_status($id) {
        $profile = $this->ProfileModel->get_by_id($id);
        
        if (!$profile) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('admin/profile-lpm');
        }

        if ($this->ProfileModel->toggle_status($id)) {
            $this->session->set_flashdata('success', 'Status berhasil diubah.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengubah status.');
        }

        redirect('admin/profile-lpm');
    }

    public function create() {
        $this->template->set_title('Tambah Profile - Admin');

        $data = [
            'active_menu' => 'profile-lpm'
        ];

        $this->template->backend('backend/profilelpm/create', $data);
    }

    public function store() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('profile_key', 'Profile Key', 'required|trim|is_unique[lpm_profile.profile_key]');
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('content', 'Content', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->create();
            return;
        }

        $insert_data = [
            'profile_key' => $this->input->post('profile_key'),
            'title' => $this->input->post('title'),
            'content' => $this->input->post('content'),
            'icon' => $this->input->post('icon'),
            'display_order' => (int) $this->input->post('display_order'),
            'is_active' => $this->input->post('is_active') ? 1 : 0
        ];

        if ($this->ProfileModel->insert($insert_data)) {
            $this->session->set_flashdata('success', 'Profile berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan profile.');
        }

        redirect('admin/profile-lpm');
    }

    public function delete($id) {
        $profile = $this->ProfileModel->get_by_id($id);
        
        if (!$profile) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('admin/profile-lpm');
        }

        if ($this->ProfileModel->delete($id)) {
            $this->session->set_flashdata('success', 'Profile berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus profile.');
        }

        redirect('admin/profile-lpm');
    }
}
