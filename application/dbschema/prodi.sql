-- Schema: program_studi (Study Programs)
-- Location: dbschema/prodi.sql
-- MySQL / MariaDB (InnoDB, utf8mb4)

CREATE TABLE IF NOT EXISTS `program_studi` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode` VARCHAR(20) NOT NULL,
  `nama_prodi` VARCHAR(150) NOT NULL,
  `fakultas` VARCHAR(150) DEFAULT NULL,
  `ketua_prodi` VARCHAR(100) DEFAULT NULL,
  `sekretaris_prodi` VARCHAR(100) DEFAULT NULL,
  `akreditasi` ENUM('A','B','C','Unggul','Baik Sekali','Baik','Belum Terakreditasi') NOT NULL DEFAULT 'Belum Terakreditasi',
  `tgl_berlaku_akreditasi` DATE DEFAULT NULL,
  `tgl_berakhir_akreditasi` DATE DEFAULT NULL,
  `no_sk` VARCHAR(100) DEFAULT NULL,
  `keterangan` TEXT DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_prodi_kode` (`kode`),
  KEY `idx_prodi_fakultas` (`fakultas`),
  KEY `idx_prodi_akreditasi` (`akreditasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
