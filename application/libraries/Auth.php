<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Library
 * 
 * Handles user authentication, authorization and session management
 */
class Auth {

    protected $CI;
    protected $user_model;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->model('UserModel');
        $this->user_model = $this->CI->UserModel;
    }

    /**
     * Check if user is logged in
     */
    public function is_logged_in() {
        return $this->CI->session->userdata('logged_in') === true;
    }

    /**
     * Get current logged in user data
     */
    public function user() {
        if (!$this->is_logged_in()) {
            return null;
        }
        return [
            'id' => $this->CI->session->userdata('user_id'),
            'username' => $this->CI->session->userdata('username'),
            'email' => $this->CI->session->userdata('email'),
            'full_name' => $this->CI->session->userdata('full_name'),
            'role' => $this->CI->session->userdata('role'),
            'avatar' => $this->CI->session->userdata('avatar')
        ];
    }

    /**
     * Get user ID
     */
    public function user_id() {
        return $this->CI->session->userdata('user_id');
    }

    /**
     * Get user role
     */
    public function role() {
        return $this->CI->session->userdata('role');
    }

    /**
     * Attempt to login user
     */
    public function login($username_or_email, $password, $remember = false) {
        $user = $this->user_model->authenticate($username_or_email, $password);

        if (!$user) {
            return ['success' => false, 'message' => 'Username atau password salah.'];
        }

        if (isset($user['error'])) {
            return ['success' => false, 'message' => $user['error']];
        }

        // Set session data
        $this->CI->session->set_userdata([
            'logged_in' => true,
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'full_name' => $user['full_name'],
            'role' => $user['role'],
            'avatar' => $user['avatar']
        ]);

        // Handle remember me
        if ($remember) {
            $token = bin2hex(random_bytes(32));
            $this->user_model->set_remember_token($user['id'], $token);
            
            // Set cookie for 30 days
            $this->CI->input->set_cookie([
                'name' => 'remember_token',
                'value' => $token,
                'expire' => 86400 * 30,
                'httponly' => true
            ]);
        }

        return ['success' => true, 'user' => $user];
    }

    /**
     * Logout user
     */
    public function logout() {
        $user_id = $this->CI->session->userdata('user_id');
        
        // Clear remember token
        if ($user_id) {
            $this->user_model->clear_remember_token($user_id);
        }

        // Delete remember cookie
        $this->CI->input->set_cookie([
            'name' => 'remember_token',
            'value' => '',
            'expire' => -1
        ]);

        // Destroy session
        $this->CI->session->unset_userdata([
            'logged_in', 'user_id', 'username', 'email', 'full_name', 'role', 'avatar'
        ]);
        $this->CI->session->sess_destroy();

        return true;
    }

    /**
     * Check remember me cookie and auto-login
     */
    public function check_remember_me() {
        if ($this->is_logged_in()) {
            return true;
        }

        $token = $this->CI->input->cookie('remember_token');
        if (!$token) {
            return false;
        }

        $user = $this->user_model->get_by_remember_token($token);
        if (!$user) {
            // Invalid token, clear cookie
            $this->CI->input->set_cookie([
                'name' => 'remember_token',
                'value' => '',
                'expire' => -1
            ]);
            return false;
        }

        // Auto-login
        $this->CI->session->set_userdata([
            'logged_in' => true,
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'full_name' => $user['full_name'],
            'role' => $user['role'],
            'avatar' => $user['avatar']
        ]);

        // Update last login
        $this->user_model->update_last_login($user['id']);

        return true;
    }

    /**
     * Require authentication - redirect if not logged in
     */
    public function require_login($redirect_url = 'admin/login') {
        // Check remember me first
        $this->check_remember_me();

        if (!$this->is_logged_in()) {
            // Store intended URL
            $this->CI->session->set_userdata('redirect_url', current_url());
            redirect($redirect_url);
            exit;
        }
    }

    /**
     * Check if user has specific role
     */
    public function has_role($role) {
        $user_role = $this->role();
        
        if (is_array($role)) {
            return in_array($user_role, $role);
        }
        
        return $user_role === $role;
    }

    /**
     * Check if user is admin
     */
    public function is_admin() {
        return $this->has_role('admin');
    }

    /**
     * Check if user is editor or admin
     */
    public function is_editor() {
        return $this->has_role(['admin', 'editor']);
    }

    /**
     * Require specific role - redirect if not authorized
     */
    public function require_role($role, $redirect_url = 'admin') {
        $this->require_login();

        if (!$this->has_role($role)) {
            $this->CI->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            redirect($redirect_url);
            exit;
        }
    }

    /**
     * Require admin role
     */
    public function require_admin() {
        $this->require_role('admin');
    }

    /**
     * Require editor or admin role
     */
    public function require_editor() {
        $this->require_role(['admin', 'editor']);
    }

    /**
     * Get redirect URL after login
     */
    public function get_redirect_url($default = 'admin') {
        $url = $this->CI->session->userdata('redirect_url');
        $this->CI->session->unset_userdata('redirect_url');
        return $url ?: $default;
    }

    /**
     * Update user session data (after profile update)
     */
    public function refresh_user() {
        $user_id = $this->user_id();
        if (!$user_id) {
            return false;
        }

        $user = $this->user_model->get_by_id($user_id);
        if (!$user) {
            return false;
        }

        $this->CI->session->set_userdata([
            'username' => $user['username'],
            'email' => $user['email'],
            'full_name' => $user['full_name'],
            'role' => $user['role'],
            'avatar' => $user['avatar']
        ]);

        return true;
    }
}
