-- =====================================================
-- Table: users
-- Description: Stores user accounts for LPM system
-- =====================================================

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL COMMENT 'Hashed password using password_hash()',
    full_name VARCHAR(100) NOT NULL,
    role ENUM('admin', 'editor', 'viewer') DEFAULT 'viewer' COMMENT 'User role for access control',
    phone VARCHAR(20) DEFAULT NULL,
    avatar VARCHAR(255) DEFAULT NULL COMMENT 'Path to avatar image',
    is_active TINYINT(1) DEFAULT 1 COMMENT '1 = Active, 0 = Inactive',
    last_login DATETIME DEFAULT NULL,
    remember_token VARCHAR(255) DEFAULT NULL COMMENT 'Token for remember me functionality',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Indexes for better query performance
-- =====================================================
CREATE INDEX idx_username ON users(username);
CREATE INDEX idx_email ON users(email);
CREATE INDEX idx_role ON users(role);
CREATE INDEX idx_is_active ON users(is_active);

-- =====================================================
-- Insert 5 default users
-- Password: password123 (hashed with password_hash)
-- Note: In production, generate new hashes using:
-- echo password_hash('your_password', PASSWORD_DEFAULT);
-- =====================================================

INSERT INTO users (username, email, password, full_name, role, phone, is_active) VALUES
('admin', 'admin@lpm.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin', '081234567890', 1),
('ketua_lpm', 'ketua@lpm.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dr. Ahmad Suryadi, M.Pd.', 'admin', '081234567891', 1),
('sekretaris', 'sekretaris@lpm.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dra. Siti Rahayu, M.M.', 'editor', '081234567892', 1),
('staff_ami', 'ami@lpm.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Budi Santoso, S.Kom.', 'editor', '081234567893', 1),
('staff_dokumen', 'dokumen@lpm.ac.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dewi Anggraini, S.E.', 'viewer', '081234567894', 1);

-- =====================================================
-- Example: How to verify password in PHP
-- =====================================================
-- if (password_verify($input_password, $user['password'])) {
--     // Password is correct
-- }
