-- =====================================================
-- Table: lpm_profile
-- Description: Stores LPM profile information including
--              tentang (about), visi/misi, tugas dan tanggung jawab
-- =====================================================

CREATE TABLE lpm_profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    profile_key VARCHAR(50) NOT NULL UNIQUE COMMENT 'Unique identifier: tentang, visi, misi, tugas',
    title VARCHAR(255) NOT NULL COMMENT 'Display title for the section',
    content TEXT NOT NULL COMMENT 'Main content (supports HTML)',
    icon VARCHAR(100) DEFAULT NULL COMMENT 'Icon class or emoji for display',
    display_order INT DEFAULT 0 COMMENT 'Order for display sorting',
    is_active TINYINT(1) DEFAULT 1 COMMENT '1 = Active, 0 = Inactive',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- Insert default data
-- =====================================================

-- Tentang LPM
INSERT INTO lpm_profile (profile_key, title, content, icon, display_order) VALUES
('tentang', 'Tentang LPM', '<p><strong>Lembaga Penjaminan Mutu (LPM)</strong> Politeknik Piksi Ganesha merupakan unit kerja yang bertanggung jawab dalam pelaksanaan sistem penjaminan mutu internal (SPMI) untuk menjamin dan meningkatkan mutu penyelenggaraan pendidikan tinggi secara berkelanjutan.</p>
<p>LPM berperan sebagai koordinator dalam penetapan, pelaksanaan, evaluasi, pengendalian, dan peningkatan standar mutu pendidikan di lingkungan Politeknik Piksi Ganesha. Kami berkomitmen untuk memastikan bahwa seluruh proses akademik dan non-akademik memenuhi standar mutu nasional dan internasional.</p>
<p>Dengan sistem penjaminan mutu yang terintegrasi, LPM berupaya mendukung tercapainya visi Politeknik Piksi Ganesha sebagai institusi pendidikan tinggi yang unggul dan berkualitas dalam menghasilkan lulusan yang kompeten dan berdaya saing global.</p>', '🎓', 1);

-- Visi
INSERT INTO lpm_profile (profile_key, title, content, icon, display_order) VALUES
('visi', 'Visi', '<p>"Menjadi lembaga penjaminan mutu yang profesional dan terpercaya dalam mewujudkan budaya mutu berkelanjutan di Politeknik Piksi Ganesha untuk menghasilkan lulusan yang kompeten, berkarakter, dan berdaya saing di tingkat nasional maupun internasional."</p>', '👁️', 2);

-- Misi
INSERT INTO lpm_profile (profile_key, title, content, icon, display_order) VALUES
('misi', 'Misi', '<ul>
<li>Mengembangkan dan mengimplementasikan Sistem Penjaminan Mutu Internal (SPMI) yang efektif dan efisien.</li>
<li>Melaksanakan monitoring, evaluasi, dan audit mutu secara berkala dan berkelanjutan.</li>
<li>Memfasilitasi peningkatan kompetensi sumber daya manusia dalam bidang penjaminan mutu.</li>
<li>Mendorong terciptanya budaya mutu di seluruh unit kerja institusi.</li>
<li>Mendukung pencapaian akreditasi institusi dan program studi.</li>
</ul>', '🎯', 3);

-- Tugas dan Tanggung Jawab (stored as JSON array for flexibility)
INSERT INTO lpm_profile (profile_key, title, content, icon, display_order) VALUES
('tugas', 'Tugas dan Tanggung Jawab', '[
    {"number": "01", "title": "Penetapan Standar Mutu", "description": "Menyusun dan menetapkan standar mutu pendidikan, penelitian, dan pengabdian kepada masyarakat sesuai dengan visi dan misi institusi."},
    {"number": "02", "title": "Pelaksanaan SPMI", "description": "Mengkoordinasikan pelaksanaan Sistem Penjaminan Mutu Internal di seluruh unit kerja dan program studi."},
    {"number": "03", "title": "Monitoring & Evaluasi", "description": "Melakukan monitoring dan evaluasi pelaksanaan standar mutu secara berkala untuk memastikan ketercapaian target mutu."},
    {"number": "04", "title": "Audit Mutu Internal", "description": "Menyelenggarakan audit mutu internal (AMI) untuk menilai kesesuaian pelaksanaan dengan standar yang telah ditetapkan."},
    {"number": "05", "title": "Pendampingan Akreditasi", "description": "Memfasilitasi dan mendampingi proses akreditasi institusi dan program studi baik nasional maupun internasional."},
    {"number": "06", "title": "Peningkatan Berkelanjutan", "description": "Merumuskan rekomendasi perbaikan dan peningkatan mutu berdasarkan hasil evaluasi dan audit yang dilakukan."}
]', '📋', 4);

-- =====================================================
-- Index for better query performance
-- =====================================================
CREATE INDEX idx_profile_key ON lpm_profile(profile_key);
CREATE INDEX idx_display_order ON lpm_profile(display_order);
CREATE INDEX idx_is_active ON lpm_profile(is_active);
