<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * UserManagement Controller
 * 
 * @property CI_Loader $load
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property CI_Upload $upload
 * @property Template $template
 * @property UserModel $UserModel
 */
class UserManagement extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(['template', 'form_validation', 'session', 'auth']);
        $this->load->helper(['url', 'form']);
        $this->load->model('UserModel');
        
        // Check authentication - Admin only
        $this->auth->require_admin();
    }

    /**
     * List all users
     */
    public function index() {
        $this->template->set_title('User Management - Admin')
            ->set_meta_description('Kelola pengguna sistem LPM.');

        $data = [
            'active_menu' => 'user-management',
            'users' => $this->UserModel->get_all(true), // Include inactive users
            'stats' => [
                'total' => $this->UserModel->count_all(true),
                'active' => $this->UserModel->count_all(false),
                'admin' => $this->UserModel->count_by_role('admin'),
                'editor' => $this->UserModel->count_by_role('editor'),
                'viewer' => $this->UserModel->count_by_role('viewer')
            ]
        ];

        $this->template->backend('backend/user_management/index', $data);
    }

    /**
     * Show create user form
     */
    public function create() {
        $this->template->set_title('Tambah User Baru - Admin');

        $data = [
            'active_menu' => 'user-management'
        ];

        $this->template->backend('backend/user_management/create', $data);
    }

    /**
     * Store new user
     */
    public function store() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[50]|alpha_dash|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|matches[password]');
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,editor,viewer]');

        if ($this->form_validation->run() === FALSE) {
            $this->create();
            return;
        }

        $insert_data = [
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'full_name' => $this->input->post('full_name'),
            'role' => $this->input->post('role'),
            'phone' => $this->input->post('phone'),
            'is_active' => $this->input->post('is_active') ? 1 : 0
        ];

        // Handle avatar upload
        if (!empty($_FILES['avatar']['name'])) {
            $avatar = $this->_upload_avatar();
            if ($avatar) {
                $insert_data['avatar'] = $avatar;
            }
        }

        if ($this->UserModel->insert($insert_data)) {
            $this->session->set_flashdata('success', 'User berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan user.');
        }

        redirect('admin/user-management');
    }

    /**
     * Show user detail
     */
    public function detail($id) {
        $user = $this->UserModel->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user-management');
        }

        $this->template->set_title('Detail User - Admin');

        $data = [
            'active_menu' => 'user-management',
            'user' => $user
        ];

        $this->template->backend('backend/user_management/detail', $data);
    }

    /**
     * Show edit user form
     */
    public function edit($id) {
        $user = $this->UserModel->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user-management');
        }

        $this->template->set_title('Edit User - Admin');

        $data = [
            'active_menu' => 'user-management',
            'user' => $user
        ];

        $this->template->backend('backend/user_management/edit', $data);
    }

    /**
     * Update user
     */
    public function update($id) {
        $user = $this->UserModel->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user-management');
        }

        // Validation rules - username and email unique except current user
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[50]|alpha_dash|callback_username_check[' . $id . ']');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_email_check[' . $id . ']');
        $this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('role', 'Role', 'required|in_list[admin,editor,viewer]');
        
        // Password only required if filled
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
            $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'matches[password]');
        }

        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
            return;
        }

        $update_data = [
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'full_name' => $this->input->post('full_name'),
            'role' => $this->input->post('role'),
            'phone' => $this->input->post('phone'),
            'is_active' => $this->input->post('is_active') ? 1 : 0
        ];

        // Update password if provided
        if ($this->input->post('password')) {
            $update_data['password'] = $this->input->post('password');
        }

        // Handle avatar upload
        if (!empty($_FILES['avatar']['name'])) {
            $avatar = $this->_upload_avatar();
            if ($avatar) {
                // Delete old avatar
                if ($user['avatar'] && file_exists(FCPATH . $user['avatar'])) {
                    unlink(FCPATH . $user['avatar']);
                }
                $update_data['avatar'] = $avatar;
            }
        }

        if ($this->UserModel->update($id, $update_data)) {
            $this->session->set_flashdata('success', 'User berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui user.');
        }

        redirect('admin/user-management');
    }

    /**
     * Delete user
     */
    public function delete($id) {
        $user = $this->UserModel->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user-management');
        }

        // Prevent deleting self
        if ($this->session->userdata('user_id') == $id) {
            $this->session->set_flashdata('error', 'Tidak dapat menghapus akun sendiri.');
            redirect('admin/user-management');
        }

        // Delete avatar file if exists
        if ($user['avatar'] && file_exists(FCPATH . $user['avatar'])) {
            unlink(FCPATH . $user['avatar']);
        }

        if ($this->UserModel->delete($id)) {
            $this->session->set_flashdata('success', 'User berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus user.');
        }

        redirect('admin/user-management');
    }

    /**
     * Toggle user status (active/inactive)
     */
    public function toggle_status($id) {
        $user = $this->UserModel->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user-management');
        }

        // Prevent deactivating self
        if ($this->session->userdata('user_id') == $id) {
            $this->session->set_flashdata('error', 'Tidak dapat menonaktifkan akun sendiri.');
            redirect('admin/user-management');
        }

        if ($this->UserModel->toggle_status($id)) {
            $status = $user['is_active'] ? 'dinonaktifkan' : 'diaktifkan';
            $this->session->set_flashdata('success', 'User berhasil ' . $status . '.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengubah status user.');
        }

        redirect('admin/user-management');
    }

    /**
     * Change user role
     */
    public function change_role($id) {
        $user = $this->UserModel->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user-management');
        }

        $new_role = $this->input->post('role');
        
        if ($this->UserModel->update_role($id, $new_role)) {
            $this->session->set_flashdata('success', 'Role user berhasil diubah.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengubah role user.');
        }

        redirect('admin/user-management');
    }

    /**
     * Reset user password
     */
    public function reset_password($id) {
        $user = $this->UserModel->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user-management');
        }

        $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[new_password]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/user-management/edit/' . $id);
            return;
        }

        $new_password = $this->input->post('new_password');

        if ($this->UserModel->change_password($id, $new_password)) {
            $this->session->set_flashdata('success', 'Password berhasil direset.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mereset password.');
        }

        redirect('admin/user-management');
    }

    /**
     * Remove user avatar
     */
    public function remove_avatar($id) {
        $user = $this->UserModel->get_by_id($id);
        
        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('admin/user-management');
        }

        if ($this->UserModel->remove_avatar($id)) {
            $this->session->set_flashdata('success', 'Avatar berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus avatar.');
        }

        redirect('admin/user-management/edit/' . $id);
    }

    /**
     * Search users (AJAX)
     */
    public function search() {
        $keyword = $this->input->get('q');
        $users = $this->UserModel->search($keyword);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => 'success',
                'data' => $users
            ]));
    }

    /**
     * Export users to CSV
     */
    public function export() {
        $users = $this->UserModel->get_all(true);
        
        $filename = 'users_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Header row
        fputcsv($output, ['ID', 'Username', 'Email', 'Nama Lengkap', 'Role', 'Phone', 'Status', 'Last Login', 'Created At']);
        
        // Data rows
        foreach ($users as $user) {
            fputcsv($output, [
                $user['id'],
                $user['username'],
                $user['email'],
                $user['full_name'],
                $user['role'],
                $user['phone'],
                $user['is_active'] ? 'Active' : 'Inactive',
                $user['last_login'],
                $user['created_at']
            ]);
        }
        
        fclose($output);
        exit;
    }

    // ==========================================
    // Callback Functions for Validation
    // ==========================================

    /**
     * Check if username is unique (excluding current user)
     */
    public function username_check($username, $exclude_id) {
        if ($this->UserModel->username_exists($username, $exclude_id)) {
            $this->form_validation->set_message('username_check', 'Username sudah digunakan.');
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Check if email is unique (excluding current user)
     */
    public function email_check($email, $exclude_id) {
        if ($this->UserModel->email_exists($email, $exclude_id)) {
            $this->form_validation->set_message('email_check', 'Email sudah digunakan.');
            return FALSE;
        }
        return TRUE;
    }

    // ==========================================
    // Private Helper Methods
    // ==========================================

    /**
     * Upload avatar image
     */
    private function _upload_avatar() {
        $config = [
            'upload_path' => './assets/img/avatars/',
            'allowed_types' => 'gif|jpg|jpeg|png|webp',
            'max_size' => 2048, // 2MB
            'max_width' => 1024,
            'max_height' => 1024,
            'file_name' => 'avatar_' . time() . '_' . rand(1000, 9999)
        ];

        // Create directory if not exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('avatar')) {
            $upload_data = $this->upload->data();
            return 'assets/img/avatars/' . $upload_data['file_name'];
        } else {
            $this->session->set_flashdata('upload_error', $this->upload->display_errors('', ''));
            return false;
        }
    }
}
