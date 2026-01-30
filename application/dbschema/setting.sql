CREATE TABLE site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Atau SERIAL di PostgreSQL
    setting_key VARCHAR(50) NOT NULL UNIQUE, -- Nama pengaturn (mis: 'app_name')
    setting_value TEXT, -- Nilai (mis: 'Toko Maju Jaya')
    setting_group VARCHAR(50) DEFAULT 'general', -- Untuk pengelompokan (mis: 'assets', 'contact')
    description VARCHAR(255), -- Penjelasan singkat (opsional)
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
