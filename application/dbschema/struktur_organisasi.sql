-- Database structure for LPM (Lembaga Penjaminan Mutu)
-- Table: struktur_organisasi
-- Purpose: Manage organizational structure data for LPM staff and positions

CREATE TABLE IF NOT EXISTS `struktur_organisasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL COMMENT 'Nama lengkap staff',
  `jabatan` varchar(255) NOT NULL COMMENT 'Posisi/Jabatan dalam organisasi',
  `level_jabatan` enum('direktur','manajer','staff','admin') NOT NULL DEFAULT 'staff' COMMENT 'Level hierarki jabatan',
  `foto` varchar(255) DEFAULT NULL COMMENT 'Path foto profile staff',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email resmi staff',
  `telepon` varchar(20) DEFAULT NULL COMMENT 'Nomor telepon staff',
  `deskripsi` text DEFAULT NULL COMMENT 'Deskripsi tugas dan tanggung jawab',
  `pendidikan_terakhir` varchar(255) DEFAULT NULL COMMENT 'Pendidikan terakhir staff',
  `pengalaman` text DEFAULT NULL COMMENT 'Pengalaman kerja dan keahlian',
  `urutan` int(11) NOT NULL DEFAULT 0 COMMENT 'Urutan tampilan dalam struktur',
  `status` enum('aktif','tidak_aktif') NOT NULL DEFAULT 'aktif' COMMENT 'Status keaktifan staff',
  `tanggal_bergabung` date DEFAULT NULL COMMENT 'Tanggal bergabung dengan LPM',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_level_jabatan` (`level_jabatan`),
  KEY `idx_urutan` (`urutan`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data for LPM organizational structure
INSERT INTO `struktur_organisasi` (`nama`, `jabatan`, `level_jabatan`, `email`, `telepon`, `deskripsi`, `pendidikan_terakhir`, `urutan`, `status`, `tanggal_bergabung`) VALUES
('Dr. Ahmad Fauzi, M.T.', 'Direktur LPM', 'direktur', 'direktur@lpm.piksi.ac.id', '021-87654321', 'Memimpin dan mengkoordinasikan seluruh kegiatan Lembaga Penjaminan Mutu dalam upaya peningkatan kualitas pendidikan di Politeknik Piksi Ganesha.', 'S3 Teknik Industri', 1, 'aktif', '2020-01-15'),
('Dr. Siti Nurhaliza, S.S., M.Pd.', 'Wakil Direktur LPM', 'direktur', 'wakildirektur@lpm.piksi.ac.id', '021-87654322', 'Membantu Direktur dalam menjalankan fungsi penjaminan mutu dan mengkoordinasikan program-program peningkatan kualitas akademik.', 'S3 Pendidikan', 2, 'aktif', '2020-02-01'),
('Budi Santoso, S.T., M.M.', 'Manajer Bidang Akreditasi', 'manajer', 'akreditasi@lpm.piksi.ac.id', '021-87654323', 'Mengelola proses akreditasi program studi dan institusi, memastikan pemenuhan standar akreditasi nasional dan internasional.', 'S2 Manajemen', 3, 'aktif', '2020-03-01'),
('Rina Kartika, S.Pd., M.Pd.', 'Manajer Bidang Evaluasi', 'manajer', 'evaluasi@lpm.piksi.ac.id', '021-87654324', 'Mengkoordinasikan kegiatan evaluasi pembelajaran, evaluasi kurikulum, dan pengembangan sistem penilaian kualitas pendidikan.', 'S2 Pendidikan', 4, 'aktif', '2020-04-01'),
('Dedi Kurniawan, S.Kom., M.T.', 'Staff Teknologi Informasi', 'staff', 'ti@lpm.piksi.ac.id', '021-87654325', 'Mengelola sistem informasi akademik, pengembangan aplikasi pendukung penjaminan mutu, dan maintenance infrastruktur IT.', 'S2 Teknik Informatika', 5, 'aktif', '2020-05-01'),
('Lisa Permata, S.E., M.Ak.', 'Staff Administrasi', 'staff', 'admin@lpm.piksi.ac.id', '021-87654326', 'Mengelola administrasi umum LPM, dokumentasi, surat menyurat, dan koordinasi kegiatan administratif.', 'S2 Akuntansi', 6, 'aktif', '2020-06-01');

-- Create indexes for better performance
CREATE INDEX `idx_nama` ON `struktur_organisasi` (`nama`);
CREATE INDEX `idx_jabatan` ON `struktur_organisasi` (`jabatan`);
CREATE INDEX `idx_created_at` ON `struktur_organisasi` (`created_at`);
