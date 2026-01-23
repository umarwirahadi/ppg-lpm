-- Contact table schema for LPM application
-- This table stores contact information for the organization

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL COMMENT 'Organization/Contact name',
  `alamat_1` text NOT NULL COMMENT 'Primary address',
  `alamat_2` text DEFAULT NULL COMMENT 'Secondary address',
  `email` varchar(255) NOT NULL COMMENT 'Email address',
  `hp` varchar(20) DEFAULT NULL COMMENT 'Mobile phone number',
  `phone` varchar(20) DEFAULT NULL COMMENT 'Landline phone number',
  `website` varchar(255) DEFAULT NULL COMMENT 'Website URL',
  `fax` varchar(20) DEFAULT NULL COMMENT 'Fax number',
  `logo_url` varchar(500) DEFAULT NULL COMMENT 'Logo image path',
  `description` text DEFAULT NULL COMMENT 'Organization description',
  `is_active` tinyint(1) DEFAULT 1 COMMENT 'Active status (1=active, 0=inactive)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Contact information table';

-- Insert default contact data
INSERT INTO `contacts` (`nama`, `alamat_1`, `email`, `hp`, `phone`, `description`, `is_active`) VALUES
('Lembaga Penjaminan Mutu (LPM)', 'Jl. Contoh No. 123, Kota Contoh', 'lpm@university.ac.id', '08123456789', '0211234567', 'Lembaga Penjaminan Mutu bertanggung jawab untuk memastikan kualitas pendidikan dan layanan di universitas.', 1);
