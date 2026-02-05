<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
    
    protected $table = 'users';

    public function __construct() {
        parent::__construct();
    }

    // ==========================================
    // CRUD Operations
    // ==========================================

    /**
     * Get all users
     */
    public function get_all($include_inactive = false) {
        if (!$include_inactive) {
            $this->db->where('is_active', 1);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result_array();
    }

    /**
     * Get user by ID
     */
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    /**
     * Get user by username
     */
    public function get_by_username($username) {
        return $this->db->get_where($this->table, ['username' => $username])->row_array();
    }

    /**
     * Get user by email
     */
    public function get_by_email($email) {
        return $this->db->get_where($this->table, ['email' => $email])->row_array();
    }

    /**
     * Get users by role
     */
    public function get_by_role($role) {
        $this->db->where('role', $role);
        $this->db->where('is_active', 1);
        $this->db->order_by('full_name', 'ASC');
        return $this->db->get($this->table)->result_array();
    }

    /**
     * Insert new user
     */
    public function insert($data) {
        // Hash password if provided
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        if ($this->db->insert($this->table, $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    /**
     * Update user by ID
     */
    public function update($id, $data) {
        // Hash password if provided and not empty
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']); // Don't update if empty
        }
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete user by ID
     */
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    /**
     * Soft delete - set is_active to 0
     */
    public function soft_delete($id) {
        return $this->update($id, ['is_active' => 0]);
    }

    /**
     * Restore soft deleted user
     */
    public function restore($id) {
        return $this->update($id, ['is_active' => 1]);
    }

    // ==========================================
    // Authentication Methods
    // ==========================================

    /**
     * Authenticate user by username/email and password
     */
    public function authenticate($username_or_email, $password) {
        // Try to find by username first, then by email
        $user = $this->get_by_username($username_or_email);
		if (!$user) {
            $user = $this->get_by_email($username_or_email);
        }
		// echo 'password ' . password_hash($password, PASSWORD_DEFAULT);
		// echo 'user password ' . $user['password'];
		// die();

        if ($user && password_verify($password, $user['password'])) {
            // Check if user is active
            if ($user['is_active'] != 1) {
                return ['error' => 'Account is inactive'];
            }
            
            // Update last login
			
            $this->update_last_login($user['id']);
        
            
            // Remove password from return data
            unset($user['password']);
            return $user;
        }

        return false;
    }

    /**
     * Update last login timestamp
     */
    public function update_last_login($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, [
            'last_login' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Set remember token
     */
    public function set_remember_token($id, $token) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, [
            'remember_token' => $token
        ]);
    }

    /**
     * Get user by remember token
     */
    public function get_by_remember_token($token) {
        $this->db->where('remember_token', $token);
        $this->db->where('is_active', 1);
        return $this->db->get($this->table)->row_array();
    }

    /**
     * Clear remember token
     */
    public function clear_remember_token($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, [
            'remember_token' => null
        ]);
    }

    /**
     * Change password
     */
    public function change_password($id, $new_password) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, [
            'password' => password_hash($new_password, PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Verify current password
     */
    public function verify_password($id, $password) {
        $user = $this->get_by_id($id);
        if ($user) {
            return password_verify($password, $user['password']);
        }
        return false;
    }

    // ==========================================
    // Validation Methods
    // ==========================================

    /**
     * Check if username exists
     */
    public function username_exists($username, $exclude_id = null) {
        $this->db->where('username', $username);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->count_all_results($this->table) > 0;
    }

    /**
     * Check if email exists
     */
    public function email_exists($email, $exclude_id = null) {
        $this->db->where('email', $email);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        return $this->db->count_all_results($this->table) > 0;
    }

    // ==========================================
    // Statistics & Reporting
    // ==========================================

    /**
     * Count users by role
     */
    public function count_by_role($role = null) {
        if ($role) {
            $this->db->where('role', $role);
        }
        $this->db->where('is_active', 1);
        return $this->db->count_all_results($this->table);
    }

    /**
     * Count all users
     */
    public function count_all($include_inactive = false) {
        if (!$include_inactive) {
            $this->db->where('is_active', 1);
        }
        return $this->db->count_all_results($this->table);
    }

    /**
     * Get recently logged in users
     */
    public function get_recent_logins($limit = 10) {
        $this->db->where('last_login IS NOT NULL');
        $this->db->where('is_active', 1);
        $this->db->order_by('last_login', 'DESC');
        $this->db->limit($limit);
        return $this->db->get($this->table)->result_array();
    }

    /**
     * Search users
     */
    public function search($keyword, $limit = 20) {
        $this->db->group_start();
        $this->db->like('username', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('full_name', $keyword);
        $this->db->group_end();
        $this->db->where('is_active', 1);
        $this->db->limit($limit);
        $this->db->order_by('full_name', 'ASC');
        return $this->db->get($this->table)->result_array();
    }

    // ==========================================
    // Avatar Methods
    // ==========================================

    /**
     * Update avatar
     */
    public function update_avatar($id, $avatar_path) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, [
            'avatar' => $avatar_path,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Remove avatar
     */
    public function remove_avatar($id) {
        $user = $this->get_by_id($id);
        if ($user && $user['avatar']) {
            // Delete file if exists
            $avatar_path = FCPATH . $user['avatar'];
            if (file_exists($avatar_path)) {
                unlink($avatar_path);
            }
        }
        return $this->update_avatar($id, null);
    }

    // ==========================================
    // Role & Permission Methods
    // ==========================================

    /**
     * Update user role
     */
    public function update_role($id, $role) {
        $allowed_roles = ['admin', 'editor', 'viewer'];
        if (!in_array($role, $allowed_roles)) {
            return false;
        }
        $this->db->where('id', $id);
        return $this->db->update($this->table, [
            'role' => $role,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Check if user has role
     */
    public function has_role($id, $role) {
        $user = $this->get_by_id($id);
        if ($user) {
            return $user['role'] === $role;
        }
        return false;
    }

    /**
     * Check if user is admin
     */
    public function is_admin($id) {
        return $this->has_role($id, 'admin');
    }

    /**
     * Toggle user status
     */
    public function toggle_status($id) {
        $user = $this->get_by_id($id);
        if ($user) {
            $new_status = $user['is_active'] == 1 ? 0 : 1;
            return $this->update($id, ['is_active' => $new_status]);
        }
        return false;
    }
}
