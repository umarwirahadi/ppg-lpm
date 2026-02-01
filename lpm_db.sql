/*
 Navicat Premium Dump SQL

 Source Server         : MariaDB_local
 Source Server Type    : MariaDB
 Source Server Version : 110502 (11.5.2-MariaDB)
 Source Host           : localhost:3307
 Source Schema         : lpm_db

 Target Server Type    : MariaDB
 Target Server Version : 110502 (11.5.2-MariaDB)
 File Encoding         : 65001

 Date: 01/02/2026 22:14:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Organization/Contact name',
  `alamat_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Primary address',
  `alamat_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Secondary address',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email address',
  `hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Mobile phone number',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Landline phone number',
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Website URL',
  `fax` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Fax number',
  `logo_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Logo image path',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Organization description',
  `is_active` tinyint(1) NULL DEFAULT 1 COMMENT 'Active status (1=active, 0=inactive)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email` ASC) USING BTREE,
  INDEX `is_active`(`is_active` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Contact information table' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contacts
-- ----------------------------
INSERT INTO `contacts` VALUES (1, 'Lembaga Penjaminan Mutu (LPM)', 'Jl. Contoh No. 123, Kota Contoh', NULL, 'lpm@university.ac.id', '08123456789', '0211234567', NULL, NULL, NULL, 'Lembaga Penjaminan Mutu bertanggung jawab untuk memastikan kualitas pendidikan dan layanan di universitas.', 1, '2026-01-31 10:31:02', '2026-01-31 10:31:02');

-- ----------------------------
-- Table structure for dokumen_spmi
-- ----------------------------
DROP TABLE IF EXISTS `dokumen_spmi`;
CREATE TABLE `dokumen_spmi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `category` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file_url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_active` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 50 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dokumen_spmi
-- ----------------------------
INSERT INTO `dokumen_spmi` VALUES (1, 'Dokumen Kebijakan Mutu', NULL, '', 'assets/documents/BUKU_KEBIJAKAN.pdf', '1', '2026-01-31 04:07:01', '2026-01-31 04:07:01');
INSERT INTO `dokumen_spmi` VALUES (2, 'SK Penetapan Dokumen Mutu', NULL, '', 'assets/documents/SK_Penetapan_Kebijakan_ok_(1).pdf', '1', '2026-01-31 04:11:00', '2026-01-31 04:36:56');
INSERT INTO `dokumen_spmi` VALUES (3, 'Buku Manual Mutu SPMI', NULL, '', 'assets/documents/BUKU-MANUAL_MUTU_SPMI_PPG.pdf', '1', '2026-01-31 04:35:57', '2026-01-31 04:35:57');
INSERT INTO `dokumen_spmi` VALUES (4, 'SK Penetapan Manual Mutu 2022', NULL, 'SK Penetapan Manual Mutu 2022', 'assets/documents/SK_Penetapan_Manual_Mutu_2022.pdf', '1', '2026-01-31 04:36:34', '2026-01-31 04:36:34');
INSERT INTO `dokumen_spmi` VALUES (5, 'B.1. Standar Hasil Penelitian (1)', NULL, '', 'assets/documents/B_1__Standar_Hasil_Penelitian_(1).pdf', '1', '2026-01-31 04:38:25', '2026-01-31 04:38:25');
INSERT INTO `dokumen_spmi` VALUES (6, 'B.2. Standar Isi Penelitian(1)', NULL, '', 'assets/documents/B_2__Standar_Isi_Penelitian(1).pdf', '1', '2026-01-31 04:38:40', '2026-01-31 04:38:40');
INSERT INTO `dokumen_spmi` VALUES (7, 'B.3. Standar Proses Penelitian', NULL, '', 'assets/documents/B_3__Standar_Proses_Penelitian_(1).pdf', '1', '2026-01-31 04:39:06', '2026-01-31 04:39:06');
INSERT INTO `dokumen_spmi` VALUES (8, 'B.4 Standar Penilaian Penelitian', NULL, '', 'assets/documents/B_4_Standar_Penilaian_Penelitian_(1).pdf', '1', '2026-01-31 04:39:23', '2026-01-31 04:39:23');
INSERT INTO `dokumen_spmi` VALUES (9, 'B.5. Standar Peneliti (1)', NULL, '', 'assets/documents/B_5__Standar_Peneliti_(1).pdf', '1', '2026-01-31 04:39:38', '2026-01-31 04:39:38');
INSERT INTO `dokumen_spmi` VALUES (10, 'B0. SK Penetapan Standar Mutu', NULL, '', 'assets/documents/B0__SK_Penetapan_Standar_Mutu_ok.pdf', '1', '2026-01-31 04:39:57', '2026-01-31 04:39:57');
INSERT INTO `dokumen_spmi` VALUES (11, 'B6. Standar Sarana dan Prasarana', NULL, '', 'assets/documents/B6__Standar_Sarana_dan_Prasarana_(1).pdf', '1', '2026-01-31 04:40:13', '2026-01-31 04:40:13');
INSERT INTO `dokumen_spmi` VALUES (12, 'B7. Standar Pengelolaan Penelitian', NULL, '', 'assets/documents/B7__Standar_Pengelolaan_Penelitian_(Edit).pdf', '1', '2026-01-31 04:40:28', '2026-01-31 04:40:28');
INSERT INTO `dokumen_spmi` VALUES (13, 'B8. Standar Pendanaan', NULL, '', 'assets/documents/B8__Standar_Pendanaan.pdf', '1', '2026-01-31 04:40:42', '2026-01-31 04:40:42');
INSERT INTO `dokumen_spmi` VALUES (14, 'C0. SK Penetapan Standar Mutu', NULL, '', 'assets/documents/C0__SK_Penetapan_Standar_Mutu_ok.pdf', '1', '2026-01-31 04:42:06', '2026-01-31 04:42:06');
INSERT INTO `dokumen_spmi` VALUES (15, 'C1. Standar Hasil PKM 2022', NULL, '', 'assets/documents/C1__Standar_Hasil_PKM_2022.pdf', '1', '2026-01-31 04:42:26', '2026-01-31 04:42:26');
INSERT INTO `dokumen_spmi` VALUES (16, 'C2. Standar Isi PKM 2022', NULL, '', 'assets/documents/C2__Standar_Isi_PKM_2022.pdf', '1', '2026-01-31 04:42:48', '2026-01-31 04:42:48');
INSERT INTO `dokumen_spmi` VALUES (17, 'C3. standar proses PKM 2022', NULL, '', 'assets/documents/C3__standar_proses_PKM_2022.pdf', '1', '2026-01-31 04:43:08', '2026-01-31 04:43:08');
INSERT INTO `dokumen_spmi` VALUES (18, 'C4. Standar Penilaian PKM 2022', NULL, '', 'assets/documents/C4__Standar_Penilaian_PKM_2022.pdf', '1', '2026-01-31 04:43:24', '2026-01-31 04:43:24');
INSERT INTO `dokumen_spmi` VALUES (19, 'C5. Standar Pelaksana PKM 2022', NULL, '', 'assets/documents/C5__Standar_Pelaksana_PKM_2022.pdf', '1', '2026-01-31 04:43:40', '2026-01-31 04:43:40');
INSERT INTO `dokumen_spmi` VALUES (20, 'C6. standar sarpras PKM 2022', NULL, '', 'assets/documents/C6__standar_sarpras_pkm_2022.pdf', '1', '2026-01-31 04:44:09', '2026-01-31 04:44:09');
INSERT INTO `dokumen_spmi` VALUES (21, 'C7. standar pengelolaan PKM 2022', NULL, '', 'assets/documents/C7__standar_pengelolaan_PKM_2022_(1).pdf', '1', '2026-01-31 04:44:30', '2026-01-31 04:44:30');
INSERT INTO `dokumen_spmi` VALUES (22, 'C8. standar pendanaan PKM 2022', NULL, '', 'assets/documents/C8__standar_pendanaan_PKM_2022_(1).pdf', '1', '2026-01-31 04:44:47', '2026-01-31 04:44:47');
INSERT INTO `dokumen_spmi` VALUES (23, 'D1. STANDAR VISI MISI', NULL, '', 'assets/documents/D1__STANDAR_VISI_MISI.pdf', '1', '2026-01-31 04:45:10', '2026-01-31 04:45:10');
INSERT INTO `dokumen_spmi` VALUES (24, 'D2. STANDAR PENERIMAAN MAHASISWA BARU', NULL, '', 'assets/documents/D2__STANDAR_PENERIMAAN_MAHASISWA_BARU.pdf', '1', '2026-01-31 04:45:25', '2026-01-31 04:45:25');
INSERT INTO `dokumen_spmi` VALUES (25, 'D3. STANDAR KERJA SAMA', NULL, '', 'assets/documents/D3__STANDAR_KERJA_SAMA.pdf', '1', '2026-01-31 04:46:08', '2026-01-31 04:46:08');
INSERT INTO `dokumen_spmi` VALUES (26, 'D4. STANDAR PENGENALAN KEHIDUPAN KAMPUS BAGI MAHASISWA BARU', NULL, '', 'assets/documents/D4__STANDAR_PENGENALAN_KEHIDUPAN_KAMPUS_BAGI_MAHASISWA_BARU.pdf', '1', '2026-01-31 04:46:24', '2026-01-31 04:46:24');
INSERT INTO `dokumen_spmi` VALUES (27, 'D6. STANDAR SELEKSI DAN PENERIMAAN SDM', NULL, '', 'assets/documents/D6__STANDAR_SELEKSI_DAN_PENERIMAAN_SDM.pdf', '1', '2026-01-31 04:46:46', '2026-01-31 04:46:46');
INSERT INTO `dokumen_spmi` VALUES (28, 'D0. SK Penetapan Standar Mutu', NULL, '', 'assets/documents/D0__SK_Penetapan_Standar_Mutu_ok.pdf', '1', '2026-01-31 04:47:03', '2026-01-31 04:47:03');
INSERT INTO `dokumen_spmi` VALUES (29, 'D5. STANDAR PELAKSANAAN WISUDA', NULL, '', 'assets/documents/D5__STANDAR_PELAKSANAAN_WISUDA.pdf', '1', '2026-01-31 04:47:19', '2026-01-31 04:47:19');
INSERT INTO `dokumen_spmi` VALUES (30, 'D7. STANDAR PENGEMBANGAN SDM', NULL, '', 'assets/documents/D7__STANDAR_PENGEMBANGAN_SDM_(1).pdf', '1', '2026-01-31 04:47:35', '2026-01-31 04:47:35');
INSERT INTO `dokumen_spmi` VALUES (31, 'D8. STANDAR PURNA BAKTI SDM', NULL, '', 'assets/documents/D8__STANDAR_PURNA_BAKTI_SDM.pdf', '1', '2026-01-31 04:47:48', '2026-01-31 04:47:48');
INSERT INTO `dokumen_spmi` VALUES (32, 'D9. STANDAR PERENCANAAN DAN PENGELOLAAN SIM', NULL, '', 'assets/documents/D9__STANDAR_PERENCANAAN_DAN_PENGELOLAAN_SIM.pdf', '1', '2026-01-31 04:48:08', '2026-01-31 04:48:08');
INSERT INTO `dokumen_spmi` VALUES (33, 'D10. STANDAR Klinik Spesialisasi Kompetensi (KSK)', NULL, '', 'assets/documents/D10__STANDAR_KSK.pdf', '1', '2026-01-31 04:48:40', '2026-01-31 04:48:40');
INSERT INTO `dokumen_spmi` VALUES (34, 'D11. STANDAR MAGANG DAN PKL', NULL, '', 'assets/documents/D11__STANDAR_MAGANG_DAN_PKL.pdf', '1', '2026-01-31 04:48:56', '2026-01-31 04:48:56');
INSERT INTO `dokumen_spmi` VALUES (35, 'D12. STANDAR MUTU PENYUSUNAN RENCANA KEGIATAN DAN ANGGARAN', NULL, '', 'assets/documents/D12__STANDAR_MUTU_PENYUSUNAN_RENCANA_KEGIATAN_DAN_ANGGARAN.pdf', '1', '2026-01-31 04:49:13', '2026-01-31 04:49:13');
INSERT INTO `dokumen_spmi` VALUES (36, 'D13.  STANDAR SUASANA AKADEMIK', NULL, '', 'assets/documents/D13__STANDAR_SUASANA_AKADEMIK.pdf', '1', '2026-01-31 04:49:29', '2026-01-31 04:49:29');
INSERT INTO `dokumen_spmi` VALUES (37, 'D14. STANDAR TEACHING INDUSTRI', NULL, '', 'assets/documents/D14__STANDAR_TEACHING_INDUSTRI.pdf', '1', '2026-01-31 04:50:12', '2026-01-31 04:50:12');
INSERT INTO `dokumen_spmi` VALUES (38, 'D15. STANDAR MUTU KESEJAHTERAAN DOSEN DAN TENAGA KEPENDIDIKAN', NULL, '', 'assets/documents/D15__STANDAR_MUTU_KESEJAHTERAAN_DOSEN_DAN_TENAGA_KEPENDIDIKAN.pdf', '1', '2026-01-31 04:50:26', '2026-01-31 04:50:26');
INSERT INTO `dokumen_spmi` VALUES (39, 'D16. STANDAR TATA PAMONG', NULL, '', 'assets/documents/D16__STANDAR_TATA_PAMONG.pdf', '1', '2026-01-31 04:50:41', '2026-01-31 04:50:41');
INSERT INTO `dokumen_spmi` VALUES (40, 'D17. STANDAR MINAT DAN BAKAT', NULL, '', 'assets/documents/D17__STANDAR_MINAT_DAN_BAKAT.pdf', '1', '2026-01-31 04:50:56', '2026-01-31 04:50:56');
INSERT INTO `dokumen_spmi` VALUES (41, '0. SK Penetapan Standar Mutu', NULL, '', 'assets/documents/0__SK_Penetapan_Standar_Mutu_ok.pdf', '1', '2026-01-31 04:51:26', '2026-01-31 04:51:26');
INSERT INTO `dokumen_spmi` VALUES (42, '1. Standar Kompetensi Lulusan 2022', NULL, '', 'assets/documents/1__Standar_Kompetensi_Lulusan__2022_ok.pdf', '1', '2026-01-31 04:51:54', '2026-01-31 04:51:54');
INSERT INTO `dokumen_spmi` VALUES (43, '2. Standar Isi Pembelajaran 2022', NULL, '', 'assets/documents/2__Standar_Isi_Pembelajaran_ok_2022.pdf', '1', '2026-01-31 04:52:12', '2026-01-31 04:52:12');
INSERT INTO `dokumen_spmi` VALUES (44, '3. Standar Proses Pembelajaran', NULL, '', 'assets/documents/3__Standar_Proses_Pembelajaran_(1).pdf', '1', '2026-01-31 04:52:30', '2026-01-31 04:52:30');
INSERT INTO `dokumen_spmi` VALUES (45, '4. Standar Penilaian Pembelajaran', NULL, '', 'assets/documents/4__Standar_Penilaian_Pembelajaran_ok.pdf', '1', '2026-01-31 04:52:44', '2026-01-31 04:52:44');
INSERT INTO `dokumen_spmi` VALUES (46, '5. Standar Dosen dan Tendik 2022', NULL, '', 'assets/documents/5__Standar_Dosen_dan_Tendik_ok_2022.pdf', '1', '2026-01-31 04:53:07', '2026-01-31 04:53:07');
INSERT INTO `dokumen_spmi` VALUES (47, '6. Standar Sarpras Pembelajaran', NULL, '', 'assets/documents/6__Standar_Sarpras_Pembelajaran_ok.pdf', '1', '2026-01-31 04:53:22', '2026-01-31 04:53:22');
INSERT INTO `dokumen_spmi` VALUES (48, '7. Standar Pengelolaan Pembelajaran', NULL, '', 'assets/documents/7__Standar_Pengelolaan_Pembelajaran_ok.pdf', '1', '2026-01-31 04:53:37', '2026-01-31 04:53:37');
INSERT INTO `dokumen_spmi` VALUES (49, '8. Standar Pembiayaan Pembelajaran', NULL, '', 'assets/documents/8__Standar_Pembiayaan_Pembelajaran.pdf', '1', '2026-01-31 04:53:54', '2026-01-31 04:53:54');

-- ----------------------------
-- Table structure for kegiatan
-- ----------------------------
DROP TABLE IF EXISTS `kegiatan`;
CREATE TABLE `kegiatan`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `organizer` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `start_date` datetime NULL DEFAULT NULL,
  `end_date` datetime NULL DEFAULT NULL,
  `timezone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `participants` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `contact_person` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `contact_phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `document_url` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image_url` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('draft','published','cancelled','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `updated_by` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_kegiatan_slug`(`slug` ASC) USING BTREE,
  INDEX `idx_kegiatan_start_date`(`start_date` ASC) USING BTREE,
  INDEX `idx_kegiatan_end_date`(`end_date` ASC) USING BTREE,
  INDEX `idx_kegiatan_status`(`status` ASC) USING BTREE,
  INDEX `idx_kegiatan_created_by`(`created_by` ASC) USING BTREE,
  INDEX `idx_kegiatan_organizer`(`organizer` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kegiatan
-- ----------------------------
INSERT INTO `kegiatan` VALUES (1, 'Sosialisasi Penerapan Standard Operasional Prosedur Perkuliahan', 'sosialisasi-penerapan-standard-operasional-prosedur-perkuliahan', 'kegiatan sosialisasi penerapan SPM di lingkungan kampus Politeknik Piksi Ganesha yang diselenggarakan oleh', 'Sosialisasi', 'LPM Politeknik Piksi Ganesha', 'Kampus A Gedung C.lt3', '2026-02-01 09:00:00', '2026-02-01 17:00:00', NULL, 100, 'Indri', '081726712612', NULL, 'assets/img/kegiatan/5393aa5bf024afa705d4e89f7f26332e.jpg', 'published', 1, NULL, NULL, '2026-01-31 23:57:10', NULL);

-- ----------------------------
-- Table structure for program_studi
-- ----------------------------
DROP TABLE IF EXISTS `program_studi`;
CREATE TABLE `program_studi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_prodi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fakultas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ketua_prodi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekretaris_prodi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `akreditasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_berlaku_akreditasi` date NULL DEFAULT NULL,
  `tgl_berakhir_akreditasi` date NULL DEFAULT NULL,
  `no_sk` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of program_studi
-- ----------------------------

-- ----------------------------
-- Table structure for site_settings
-- ----------------------------
DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `setting_value` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `setting_group` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'general',
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `setting_key`(`setting_key`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of site_settings
-- ----------------------------

-- ----------------------------
-- Table structure for struktur_organisasi
-- ----------------------------
DROP TABLE IF EXISTS `struktur_organisasi`;
CREATE TABLE `struktur_organisasi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama lengkap staff',
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Posisi/Jabatan dalam organisasi',
  `level_jabatan` enum('direktur','manajer','staff','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff' COMMENT 'Level hierarki jabatan',
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Path foto profile staff',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Email resmi staff',
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Nomor telepon staff',
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Deskripsi tugas dan tanggung jawab',
  `pendidikan_terakhir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Pendidikan terakhir staff',
  `pengalaman` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Pengalaman kerja dan keahlian',
  `urutan` int(11) NOT NULL DEFAULT 0 COMMENT 'Urutan tampilan dalam struktur',
  `status` enum('aktif','tidak_aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif' COMMENT 'Status keaktifan staff',
  `tanggal_bergabung` date NULL DEFAULT NULL COMMENT 'Tanggal bergabung dengan LPM',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_level_jabatan`(`level_jabatan` ASC) USING BTREE,
  INDEX `idx_urutan`(`urutan` ASC) USING BTREE,
  INDEX `idx_status`(`status` ASC) USING BTREE,
  INDEX `idx_nama`(`nama` ASC) USING BTREE,
  INDEX `idx_jabatan`(`jabatan` ASC) USING BTREE,
  INDEX `idx_created_at`(`created_at` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of struktur_organisasi
-- ----------------------------
INSERT INTO `struktur_organisasi` VALUES (1, 'Dra. Widwi Handari Adji, M.M.', 'Ketua LPM', 'direktur', 'struktur_1769831426.png', 'widwi@piksi.ac.id', '6287825386672', 'Memimpin dan mengkoordinasikan seluruh kegiatan Lembaga Penjaminan Mutu dalam upaya peningkatan kualitas pendidikan di Politeknik Piksi Ganesha.', 'S2 Management', '', 1, 'aktif', '2025-01-15', '2026-01-31 10:31:32', '2026-01-31 03:52:43');
INSERT INTO `struktur_organisasi` VALUES (2, 'Edi Suharto, S.Si., M. Kom', 'Wakil Ketua LPM', 'direktur', 'struktur_1769831509.png', 'edi.suharto@piksi.ac.id', '021-87654322', 'Membantu Ketua dalam menjalankan fungsi penjaminan mutu dan mengkoordinasikan program-program peningkatan kualitas akademik.', 'S3 Pendidikan', '', 2, 'aktif', '2020-02-01', '2026-01-31 10:31:32', '2026-01-31 03:52:51');
INSERT INTO `struktur_organisasi` VALUES (3, 'Siti Insani, S.E.., M.AB', 'Bid. Pengendalian Dokumen', 'manajer', 'struktur_1769831705.png', 'siti.insani@piksi.ac.id', '021-87654323', 'Mengelola proses Dokumen program studi dan institusi, memastikan pemenuhan standar akreditasi nasional dan internasional.', 'S2 Administrasi Bisnis', '', 3, 'aktif', '2025-03-01', '2026-01-31 10:31:32', '2026-01-31 03:55:05');
INSERT INTO `struktur_organisasi` VALUES (4, 'Tiris Sudrartono, S.E., M.M.', 'Bid. Audit Mutu Internal', 'manajer', 'struktur_1769831784.png', 'tiris.sudartono@piksi.ac.id', '021-87654324', 'Mengkoordinasikan kegiatan evaluasi pembelajaran, evaluasi kurikulum, dan pengembangan sistem penilaian kualitas pendidikan.', 'S2 Pendidikan', '', 4, 'aktif', '2025-04-01', '2026-01-31 10:31:32', '2026-01-31 03:56:24');
INSERT INTO `struktur_organisasi` VALUES (5, 'Muhamad Prakarsa AQS, S.Kom, M. Kom.', 'Bid Riset dan Pengembangan', 'manajer', 'struktur_1769831878.jpeg', 'm.prakarsa@piksi.ac.id', '021-87654325', 'Mengelola sistem informasi akademik, pengembangan aplikasi pendukung penjaminan mutu, dan maintenance infrastruktur IT.', 'S2 Sistem Informasi', '', 5, 'aktif', '2025-05-01', '2026-01-31 10:31:32', '2026-01-31 03:57:58');
INSERT INTO `struktur_organisasi` VALUES (6, 'Umar Wirahadi', 'Programmer', 'staff', NULL, 'umar@piksi.ac.id', '021-87654326', 'Mengelola administrasi umum LPM, dokumentasi, surat menyurat, dan koordinasi kegiatan administratif.', 'S2 Akuntansi', '', 6, 'aktif', '2020-06-01', '2026-01-31 10:31:32', '2026-01-31 04:04:27');

SET FOREIGN_KEY_CHECKS = 1;
