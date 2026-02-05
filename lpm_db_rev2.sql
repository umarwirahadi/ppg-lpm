/*
 Navicat Premium Dump SQL

 Source Server         : mariaDB
 Source Server Type    : MySQL
 Source Server Version : 110502 (11.5.2-MariaDB)
 Source Host           : localhost:3307
 Source Schema         : lpm_db_rev2

 Target Server Type    : MySQL
 Target Server Version : 110502 (11.5.2-MariaDB)
 File Encoding         : 65001

 Date: 05/02/2026 07:18:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Organization/Contact name',
  `alamat_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Primary address',
  `alamat_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'Secondary address',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Email address',
  `hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Mobile phone number',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Landline phone number',
  `website` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Website URL',
  `fax` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Fax number',
  `logo_url` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Logo image path',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'Organization description',
  `is_active` tinyint(1) NULL DEFAULT 1 COMMENT 'Active status (1=active, 0=inactive)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email` ASC) USING BTREE,
  INDEX `is_active`(`is_active` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'Contact information table' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of contacts
-- ----------------------------
INSERT INTO `contacts` VALUES (1, 'Lembaga Penjaminan Mutu (LPM)', 'Jl. Contoh No. 123, Kota Contoh', NULL, 'lpm@university.ac.id', '08123456789', '0211234567', NULL, NULL, NULL, 'Lembaga Penjaminan Mutu bertanggung jawab untuk memastikan kualitas pendidikan dan layanan di universitas.', 1, '2026-01-31 10:31:02', '2026-01-31 10:31:02');

-- ----------------------------
-- Table structure for dokumen_spmi
-- ----------------------------
DROP TABLE IF EXISTS `dokumen_spmi`;
CREATE TABLE `dokumen_spmi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `category` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `file_url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `is_active` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 50 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

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
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `organizer` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `start_date` datetime NULL DEFAULT NULL,
  `end_date` datetime NULL DEFAULT NULL,
  `timezone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `participants` int UNSIGNED NOT NULL DEFAULT 0,
  `contact_person` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `contact_phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `document_url` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image_url` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('draft','published','cancelled','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int UNSIGNED NULL DEFAULT NULL,
  `updated_by` int UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_kegiatan_slug`(`slug` ASC) USING BTREE,
  INDEX `idx_kegiatan_start_date`(`start_date` ASC) USING BTREE,
  INDEX `idx_kegiatan_end_date`(`end_date` ASC) USING BTREE,
  INDEX `idx_kegiatan_status`(`status` ASC) USING BTREE,
  INDEX `idx_kegiatan_created_by`(`created_by` ASC) USING BTREE,
  INDEX `idx_kegiatan_organizer`(`organizer` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kegiatan
-- ----------------------------
INSERT INTO `kegiatan` VALUES (1, 'Sosialisasi Penerapan Standard Operasional Prosedur Perkuliahan', 'sosialisasi-penerapan-standard-operasional-prosedur-perkuliahan', 'kegiatan sosialisasi penerapan SPM di lingkungan kampus Politeknik Piksi Ganesha yang diselenggarakan oleh', 'Sosialisasi', 'LPM Politeknik Piksi Ganesha', 'Kampus A Gedung C.lt3', '2026-02-01 09:00:00', '2026-02-01 17:00:00', NULL, 100, 'Indri', '081726712612', 'documents/kegiatan/71cc5ab25a1f5cd94bb8cad157e07694.pdf', 'assets/img/kegiatan/5393aa5bf024afa705d4e89f7f26332e.jpg', 'published', 1, NULL, NULL, '2026-01-31 23:57:10', '2026-02-03 21:52:31');
INSERT INTO `kegiatan` VALUES (2, 'Workshop Peningkatan Kompetensi Pedagogik', 'workshop-kompetensi-pedagogik-2026', 'Workshop intensif untuk meningkatkan kompetensi pedagogik dosen dan guru.', 'Workshop', 'PPG LPM', 'Aula Kampus', '2026-02-10 09:00:00', '2026-02-10 16:00:00', 'Asia/Jakarta', 80, 'Admin PPG', '0812-3456-7890', 'documents/workshop-kompetensi-pedagogik-2026.pdf', 'img/kegiatan/workshop-kompetensi-pedagogik-2026.jpg', 'published', 1, 1, NULL, '2026-01-25 08:00:00', NULL);
INSERT INTO `kegiatan` VALUES (3, 'Seminar Kurikulum Merdeka Belajar', 'seminar-kurikulum-merdeka-2026', 'Seminar membahas implementasi Kurikulum Merdeka Belajar di perguruan tinggi.', 'Seminar', 'Fakultas Ilmu Pendidikan', 'Ruang 301', '2026-02-15 13:00:00', '2026-02-15 16:00:00', 'Asia/Jakarta', 120, 'Dr. Sinta', '0813-9876-5432', 'documents/seminar-kurikulum-merdeka-2026.pdf', 'img/kegiatan/seminar-kurikulum-merdeka-2026.jpg', 'published', 1, 2, NULL, '2026-01-26 10:00:00', NULL);
INSERT INTO `kegiatan` VALUES (4, 'Pelatihan Penggunaan LMS untuk Dosen', 'pelatihan-lms-dosen-2026', 'Pelatihan penggunaan Learning Management System untuk mendukung pembelajaran daring.', 'Pelatihan', 'PPG LPM', 'Online (Zoom)', '2026-02-18 09:00:00', '2026-02-18 12:00:00', 'Asia/Jakarta', 60, 'Admin LMS', '0812-0000-1111', 'documents/pelatihan-lms-dosen-2026.pdf', 'img/kegiatan/pelatihan-lms-dosen-2026.jpg', 'published', 1, 1, NULL, '2026-01-27 09:30:00', NULL);
INSERT INTO `kegiatan` VALUES (5, 'Sosialisasi Prosedur PPG Dalam Jabatan', 'sosialisasi-ppg-dalam-jabatan-2026', 'Sosialisasi mengenai prosedur dan persyaratan PPG Dalam Jabatan.', 'Sosialisasi', 'PPG LPM', 'Aula Kampus', '2026-02-20 08:00:00', '2026-02-20 11:00:00', 'Asia/Jakarta', 200, 'Admin PPG', '0812-2222-3333', 'documents/sosialisasi-ppg-dalam-jabatan-2026.pdf', 'img/kegiatan/sosialisasi-ppg-dalam-jabatan-2026.jpg', 'published', 1, 1, NULL, '2026-01-28 08:15:00', NULL);
INSERT INTO `kegiatan` VALUES (6, 'Rapat Koordinasi Tim Kurikulum', 'rapat-koordinasi-kurikulum-2026', 'Rapat koordinasi rutin tim kurikulum untuk penyelarasan materi.', 'Rapat', 'PPG LPM', 'Ruang Rapat 2', '2026-02-05 14:00:00', '2026-02-05 16:00:00', 'Asia/Jakarta', 25, 'Koordinator Kurikulum', '0814-5555-6666', 'documents/rapat-koordinasi-kurikulum-2026.pdf', 'img/kegiatan/rapat-koordinasi-kurikulum-2026.jpg', 'completed', 1, 1, 1, '2026-01-20 14:30:00', '2026-02-05 16:30:00');
INSERT INTO `kegiatan` VALUES (7, 'Workshop Penilaian Autentik', 'workshop-penilaian-autentik-2026', 'Workshop praktik penilaian autentik untuk meningkatkan asesmen pembelajaran.', 'Workshop', 'FIP', 'Laboratorium Microteaching', '2026-03-01 09:00:00', '2026-03-01 15:00:00', 'Asia/Jakarta', 70, 'Dr. Rina', '0812-7777-8888', 'documents/workshop-penilaian-autentik-2026.pdf', 'img/kegiatan/workshop-penilaian-autentik-2026.jpg', 'draft', 1, 2, NULL, '2026-02-01 09:00:00', NULL);
INSERT INTO `kegiatan` VALUES (8, 'Pelatihan Penyusunan RPS', 'pelatihan-penyusunan-rps-2026', 'Pelatihan penyusunan Rencana Pembelajaran Semester (RPS) untuk mata kuliah.', 'Pelatihan', 'PPG LPM', 'Ruang 105', '2026-03-10 08:00:00', '2026-03-10 12:00:00', 'Asia/Jakarta', 50, 'Admin Akademik', '0813-3333-4444', 'documents/pelatihan-penyusunan-rps-2026.pdf', 'img/kegiatan/pelatihan-penyusunan-rps-2026.jpg', 'draft', 1, 1, NULL, '2026-02-03 10:00:00', NULL);
INSERT INTO `kegiatan` VALUES (9, 'Seminar Penelitian Tindakan Kelas', 'seminar-ptk-2026', 'Seminar berbagi hasil penelitian tindakan kelas terbaru.', 'Seminar', 'FIP', 'Auditorium', '2026-03-15 13:00:00', '2026-03-15 17:00:00', 'Asia/Jakarta', 150, 'Panitia PTK', '0812-1212-3434', 'documents/seminar-ptk-2026.pdf', 'img/kegiatan/seminar-ptk-2026.jpg', 'published', 1, 2, NULL, '2026-02-02 11:00:00', NULL);
INSERT INTO `kegiatan` VALUES (10, 'Konferensi Pendidikan Nasional', 'konferensi-pendidikan-nasional-2026', 'Konferensi tahunan pendidikan nasional dengan berbagai narasumber.', 'Konferensi', 'Kemendikbud', 'Jakarta Convention Center', '2026-04-20 09:00:00', '2026-04-22 17:00:00', 'Asia/Jakarta', 500, 'Sekretariat Konferensi', '0815-9090-8080', 'documents/konferensi-pendidikan-nasional-2026.pdf', 'img/kegiatan/konferensi-pendidikan-nasional-2026.jpg', 'cancelled', 0, 3, 3, '2026-02-05 09:00:00', '2026-03-01 10:00:00');
INSERT INTO `kegiatan` VALUES (11, 'Bimbingan Teknis Asesor PPG', 'bimtek-asesor-ppg-2026', 'Bimtek untuk asesor PPG dalam peningkatan kualitas asesmen.', 'Bimtek', 'PPG LPM', 'Ruang 202', '2026-03-25 09:00:00', '2026-03-25 16:00:00', 'Asia/Jakarta', 40, 'Admin PPG', '0812-6666-7777', 'documents/bimtek-asesor-ppg-2026.pdf', 'img/kegiatan/bimtek-asesor-ppg-2026.jpg', 'published', 1, 1, NULL, '2026-02-04 09:30:00', NULL);

-- ----------------------------
-- Table structure for laporan
-- ----------------------------
DROP TABLE IF EXISTS `laporan`;
CREATE TABLE `laporan`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `file_path` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_laporan_title`(`title` ASC) USING BTREE,
  INDEX `idx_laporan_status`(`status` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of laporan
-- ----------------------------
INSERT INTO `laporan` VALUES (1, 'Laporan AMI Politeknik Piksi Ganesha Tahun 2021', '', 'assets/documents/93a10314b739f4dfbbf43d215b36041f.pdf', 'published', '2026-02-04 15:10:47', '2026-02-04 15:10:47');
INSERT INTO `laporan` VALUES (2, 'Laporan AMI Politeknik Piksi Ganesha Tahun 2022', '', 'assets/documents/5ad097bb4d89b5ef0ba9661db93941ae.pdf', 'published', '2026-02-04 15:11:03', '2026-02-04 15:11:03');
INSERT INTO `laporan` VALUES (3, 'Laporan AMI Politeknik Piksi Ganesha Tahun 2023', '', 'assets/documents/e21f8970cd546f8036604859b5cb5e48.pdf', 'published', '2026-02-04 15:11:12', '2026-02-04 15:11:12');
INSERT INTO `laporan` VALUES (4, 'Laporan AMI Politeknik Piksi Ganesha Tahun 2024', '', 'assets/documents/9a624545f4e2c1601a4b45a48ef248c3.pdf', 'published', '2026-02-04 15:11:22', '2026-02-04 15:11:22');

-- ----------------------------
-- Table structure for lpm_profile
-- ----------------------------
DROP TABLE IF EXISTS `lpm_profile`;
CREATE TABLE `lpm_profile`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `profile_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Unique identifier: tentang, visi, misi, tugas',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Display title for the section',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Main content (supports HTML)',
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Icon class or emoji for display',
  `display_order` int NULL DEFAULT 0 COMMENT 'Order for display sorting',
  `is_active` tinyint(1) NULL DEFAULT 1 COMMENT '1 = Active, 0 = Inactive',
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `profile_key`(`profile_key` ASC) USING BTREE,
  INDEX `idx_profile_key`(`profile_key` ASC) USING BTREE,
  INDEX `idx_display_order`(`display_order` ASC) USING BTREE,
  INDEX `idx_is_active`(`is_active` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lpm_profile
-- ----------------------------
INSERT INTO `lpm_profile` VALUES (1, 'tentang', 'Tentang LPM', '<p><strong>Lembaga Penjaminan Mutu (LPM)</strong> Politeknik Piksi Ganesha merupakan unit kerja yang bertanggung jawab dalam pelaksanaan sistem penjaminan mutu internal (SPMI) untuk menjamin dan meningkatkan mutu penyelenggaraan pendidikan tinggi secara berkelanjutan.</p>\r\n<p>LPM berperan sebagai koordinator dalam penetapan, pelaksanaan, evaluasi, pengendalian, dan peningkatan standar mutu pendidikan di lingkungan Politeknik Piksi Ganesha. Kami berkomitmen untuk memastikan bahwa seluruh proses akademik dan non-akademik memenuhi standar mutu nasional dan internasional.</p>\r\n<p>Dengan sistem penjaminan mutu yang terintegrasi, LPM berupaya mendukung tercapainya visi Politeknik Piksi Ganesha sebagai institusi pendidikan tinggi yang unggul dan berkualitas dalam menghasilkan lulusan yang kompeten dan berdaya saing global.</p>', '????', 1, 1, '2026-02-04 21:57:09', '2026-02-04 15:08:56');
INSERT INTO `lpm_profile` VALUES (2, 'visi', 'Visi', '<p>\"Menjadi lembaga penjaminan mutu yang profesional dan terpercaya dalam mewujudkan budaya mutu berkelanjutan di Politeknik Piksi Ganesha untuk menghasilkan lulusan yang kompeten, berkarakter, dan berdaya saing di tingkat nasional maupun internasional.\"</p>', '👁️', 2, 1, '2026-02-04 21:57:09', '2026-02-04 21:57:09');
INSERT INTO `lpm_profile` VALUES (3, 'misi', 'Misi', '<ul>\r\n<li>Mengembangkan dan mengimplementasikan Sistem Penjaminan Mutu Internal (SPMI) yang efektif dan efisien.</li>\r\n<li>Melaksanakan monitoring, evaluasi, dan audit mutu secara berkala dan berkelanjutan.</li>\r\n<li>Memfasilitasi peningkatan kompetensi sumber daya manusia dalam bidang penjaminan mutu.</li>\r\n<li>Mendorong terciptanya budaya mutu di seluruh unit kerja institusi.</li>\r\n<li>Mendukung pencapaian akreditasi institusi dan program studi.</li>\r\n</ul>', '?', 3, 1, '2026-02-04 21:57:09', '2026-02-04 15:24:14');
INSERT INTO `lpm_profile` VALUES (4, 'tugas', 'Tugas dan Tanggung Jawab', '[\r\n    {\"number\": \"01\", \"title\": \"Penetapan Standar Mutu\", \"description\": \"Menyusun dan menetapkan standar mutu pendidikan, penelitian, dan pengabdian kepada masyarakat sesuai dengan visi dan misi institusi.\"},\r\n    {\"number\": \"02\", \"title\": \"Pelaksanaan SPMI\", \"description\": \"Mengkoordinasikan pelaksanaan Sistem Penjaminan Mutu Internal di seluruh unit kerja dan program studi.\"},\r\n    {\"number\": \"03\", \"title\": \"Monitoring & Evaluasi\", \"description\": \"Melakukan monitoring dan evaluasi pelaksanaan standar mutu secara berkala untuk memastikan ketercapaian target mutu.\"},\r\n    {\"number\": \"04\", \"title\": \"Audit Mutu Internal\", \"description\": \"Menyelenggarakan audit mutu internal (AMI) untuk menilai kesesuaian pelaksanaan dengan standar yang telah ditetapkan.\"},\r\n    {\"number\": \"05\", \"title\": \"Pendampingan Akreditasi\", \"description\": \"Memfasilitasi dan mendampingi proses akreditasi institusi dan program studi baik nasional maupun internasional.\"},\r\n    {\"number\": \"06\", \"title\": \"Peningkatan Berkelanjutan\", \"description\": \"Merumuskan rekomendasi perbaikan dan peningkatan mutu berdasarkan hasil evaluasi dan audit yang dilakukan.\"}\r\n]', '📋', 4, 1, '2026-02-04 21:57:09', '2026-02-04 21:57:09');

-- ----------------------------
-- Table structure for program_studi
-- ----------------------------
DROP TABLE IF EXISTS `program_studi`;
CREATE TABLE `program_studi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_prodi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `fakultas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ketua_prodi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `sekretaris_prodi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `akreditasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_berlaku_akreditasi` date NULL DEFAULT NULL,
  `tgl_berakhir_akreditasi` date NULL DEFAULT NULL,
  `no_sk` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of program_studi
-- ----------------------------
INSERT INTO `program_studi` VALUES (1, '63413', 'D3-Administrasi Keuangan', 'Fakultas Ekonomi dan Bisnis', 'Dr. Hendra Wijaya, S.E., M.Ak.', 'Rina Kartika, S.E., M.M.', 'Unggul', '2023-08-15', '2028-08-14', '1234/SK/BAN-PT/Ak-PPJ/Dipl-III/VIII/2023', 'Program studi administrasi keuangan dengan fokus pada pengelolaan keuangan perusahaan dan lembaga.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (2, '13461', 'D3-Administrasi Rumah Sakit', 'Fakultas Ilmu Kesehatan', 'Dr. Siti Aminah, S.K.M., M.Kes.', 'Andi Pratama, S.K.M., M.M.', 'Baik', NULL, NULL, NULL, 'Program studi administrasi rumah sakit yang mempersiapkan tenaga ahli manajemen kesehatan.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (3, '13453', 'D3-Analis Kesehatan', 'Fakultas Ilmu Kesehatan', 'Dr. Dewi Susanti, S.Si., M.Biomed.', 'Budi Hartono, S.Si., M.Si.', 'Baik Sekali', '2022-05-20', '2027-05-19', '2345/SK/BAN-PT/Ak-PPJ/Dipl-III/V/2022', 'Program studi analis kesehatan dengan keahlian laboratorium klinik dan diagnostik.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (4, '61316', 'D4-Bisnis Digital', 'Fakultas Ekonomi dan Bisnis', 'Dr. Anita Rahman, S.E., M.M.', 'Bambang Sutrisno, S.E., M.M.', 'Baik', '2024-02-10', '2029-02-09', '3456/SK/BAN-PT/Ak-PPJ/Dipl-IV/II/2024', 'Program studi sarjana terapan bisnis digital dengan fokus startup dan e-commerce.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (5, '48401', 'D3-Farmasi', 'Fakultas Ilmu Kesehatan', 'apt. Dr. Maya Puspita, S.Farm., M.Farm.', 'apt. Rizki Andini, S.Farm., M.Farm.', 'Baik', '2021-09-15', '2026-09-14', '4567/SK/BAN-PT/Ak-PPJ/Dipl-III/IX/2021', 'Program studi farmasi yang menghasilkan tenaga asisten apoteker profesional.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (6, '11401', 'D3-Fisioterapi', 'Fakultas Ilmu Kesehatan', 'Dr. Ahmad Fauzan, S.Ft., M.Fis.', 'Indah Permata, S.Ft., M.Kes.', 'Baik', '2021-11-01', '2026-10-31', '5678/SK/BAN-PT/Ak-PPJ/Dipl-III/XI/2021', 'Program studi fisioterapi dengan keahlian rehabilitasi medik dan terapi fisik.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (7, '57302', 'D4-Komputerisasi Akuntansi', 'Fakultas Teknik dan Ilmu Komputer', 'Dr. Hadi Santoso, S.E., S.Kom., M.Kom.', 'Lina Marlina, S.Kom., M.Ak.', 'Baik Sekali', '2023-06-25', '2028-06-24', '6789/SK/BAN-PT/Ak-PPJ/Dipl-IV/VI/2023', 'Program studi sarjana terapan yang menggabungkan akuntansi dan teknologi informasi.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (8, '13363', 'D4-Manajemen Informasi Kesehatan', 'Fakultas Ilmu Kesehatan', 'Dr. Ratna Wijayanti, S.K.M., M.K.M.', 'Dian Purnama, S.K.M., M.Kes.', 'Baik', '2024-01-20', '2029-01-19', '7890/SK/BAN-PT/Ak-PPJ/Dipl-IV/I/2024', 'Program studi manajemen informasi kesehatan dengan fokus rekam medis elektronik.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (9, '57301', 'D4-Manajemen Informatika', 'Fakultas Teknik dan Ilmu Komputer', 'Dr. Ir. Budi Santoso, S.Kom., M.Kom.', 'Dewi Anggraini, S.Kom., M.T.', 'Baik Sekali', '2023-09-10', '2028-09-09', '8901/SK/BAN-PT/Ak-PPJ/Dipl-IV/IX/2023', 'Program studi sarjana terapan manajemen informatika dengan keunggulan sistem enterprise.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (10, '57401', 'D3-Manajemen Informatika', 'Fakultas Teknik dan Ilmu Komputer', 'Ir. Farhan Abdullah, S.Kom., M.T.', 'Nurul Hidayah, S.Kom., M.Kom.', 'Baik Sekali', '2023-07-01', '2028-06-30', '9012/SK/BAN-PT/Ak-PPJ/Dipl-III/VII/2023', 'Program studi manajemen informatika dengan keahlian pengembangan aplikasi dan database.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (11, '13461-MPRS', 'D3-Manajemen Pelayanan Rumah Sakit', 'Fakultas Ilmu Kesehatan', 'Dr. Kartini Wulandari, S.K.M., M.M.', 'Agus Setiawan, S.K.M., M.Kes.', 'Baik Sekali', '2023-03-15', '2028-03-14', '0123/SK/BAN-PT/Ak-PPJ/Dipl-III/III/2023', 'Program studi manajemen pelayanan rumah sakit dengan fokus mutu layanan kesehatan.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (12, '90347', 'D4-Produksi Media', 'Fakultas Teknik dan Ilmu Komputer', 'Dr. Rizky Pratama, S.Sn., M.Ds.', 'Eka Putri, S.Ds., M.Sn.', 'Baik', '2025-01-10', '2026-01-09', '1122/SK/BAN-PT/Akred-S/Dipl-IV/I/2025', 'Program studi sarjana terapan produksi media dengan keahlian multimedia dan broadcasting.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (13, '13462', 'D3-Rekam Medik Dan Informasi Kesehatan', 'Fakultas Ilmu Kesehatan', 'Dr. Sri Wahyuni, S.K.M., M.Kes.', 'Joko Susilo, A.Md.RMIK., S.K.M.', 'Unggul', '2022-04-20', '2027-04-19', '2233/SK/BAN-PT/Ak-PPJ/Dipl-III/IV/2022', 'Program studi rekam medik dan informasi kesehatan dengan standar kompetensi nasional.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (14, '56401', 'D3-Teknik Komputer', 'Fakultas Teknik dan Ilmu Komputer', 'Dr. Eng. Wahyu Hidayat, S.T., M.T.', 'Linda Permata, S.T., M.Kom.', 'Baik Sekali', '2022-08-15', '2027-08-14', '3344/SK/BAN-PT/Ak-PPJ/Dipl-III/VIII/2022', 'Program studi teknik komputer dengan keahlian jaringan komputer dan IoT.', '2026-02-03 21:53:11');
INSERT INTO `program_studi` VALUES (15, '13450', 'D3-Teknologi Laboratorium Medis', 'Fakultas Ilmu Kesehatan', 'Dr. Endang Susilowati, S.Si., M.Biomed.', 'Ari Wibowo, S.Si., M.Si.', 'Baik', NULL, NULL, NULL, 'Program studi teknologi laboratorium medis dengan fokus diagnostik dan penelitian klinis.', '2026-02-03 21:53:11');

-- ----------------------------
-- Table structure for site_settings
-- ----------------------------
DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `setting_value` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `setting_group` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'general',
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `setting_key`(`setting_key`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of site_settings
-- ----------------------------
INSERT INTO `site_settings` VALUES (1, 'telp', '022-87340030', 'general', '', '2026-02-04 14:47:05');
INSERT INTO `site_settings` VALUES (2, 'alamat', 'Jl. Jend. Gatot Subroto 301 Bandung Jawa Barat 40274', 'general', '', '2026-02-04 14:47:39');
INSERT INTO `site_settings` VALUES (3, 'email', 'lpm@piksi.ac.id', 'general', '', '2026-02-04 14:47:52');

-- ----------------------------
-- Table structure for struktur_organisasi
-- ----------------------------
DROP TABLE IF EXISTS `struktur_organisasi`;
CREATE TABLE `struktur_organisasi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Nama lengkap staff',
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Posisi/Jabatan dalam organisasi',
  `level_jabatan` enum('direktur','manajer','staff','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff' COMMENT 'Level hierarki jabatan',
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Path foto profile staff',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Email resmi staff',
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Nomor telepon staff',
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'Deskripsi tugas dan tanggung jawab',
  `pendidikan_terakhir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Pendidikan terakhir staff',
  `pengalaman` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'Pengalaman kerja dan keahlian',
  `urutan` int NOT NULL DEFAULT 0 COMMENT 'Urutan tampilan dalam struktur',
  `status` enum('aktif','tidak_aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif' COMMENT 'Status keaktifan staff',
  `tanggal_bergabung` date NULL DEFAULT NULL COMMENT 'Tanggal bergabung dengan LPM',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_level_jabatan`(`level_jabatan` ASC) USING BTREE,
  INDEX `idx_urutan`(`urutan` ASC) USING BTREE,
  INDEX `idx_status`(`status` ASC) USING BTREE,
  INDEX `idx_nama`(`nama` ASC) USING BTREE,
  INDEX `idx_jabatan`(`jabatan` ASC) USING BTREE,
  INDEX `idx_created_at`(`created_at` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of struktur_organisasi
-- ----------------------------
INSERT INTO `struktur_organisasi` VALUES (1, 'Dra. Widwi Handari Adji, M.M.', 'Ketua LPM', 'direktur', 'struktur_1769831426.png', 'widwi@piksi.ac.id', '6287825386672', 'Memimpin dan mengkoordinasikan seluruh kegiatan Lembaga Penjaminan Mutu dalam upaya peningkatan kualitas pendidikan di Politeknik Piksi Ganesha.', 'S2 Management', '', 1, 'aktif', '2025-01-15', '2026-01-31 10:31:32', '2026-01-31 03:52:43');
INSERT INTO `struktur_organisasi` VALUES (2, 'Edi Suharto, S.Si., M. Kom', 'Wakil Ketua LPM', 'direktur', 'struktur_1769831509.png', 'edi.suharto@piksi.ac.id', '021-87654322', 'Membantu Ketua dalam menjalankan fungsi penjaminan mutu dan mengkoordinasikan program-program peningkatan kualitas akademik.', 'S3 Pendidikan', '', 2, 'aktif', '2020-02-01', '2026-01-31 10:31:32', '2026-01-31 03:52:51');
INSERT INTO `struktur_organisasi` VALUES (3, 'Siti Insani, S.E.., M.AB', 'Bid. Pengendalian Dokumen', 'manajer', 'struktur_1769831705.png', 'siti.insani@piksi.ac.id', '021-87654323', 'Mengelola proses Dokumen program studi dan institusi, memastikan pemenuhan standar akreditasi nasional dan internasional.', 'S2 Administrasi Bisnis', '', 3, 'aktif', '2025-03-01', '2026-01-31 10:31:32', '2026-01-31 03:55:05');
INSERT INTO `struktur_organisasi` VALUES (4, 'Tiris Sudrartono, S.E., M.M.', 'Bid. Audit Mutu Internal', 'manajer', 'struktur_1769831784.png', 'tiris.sudartono@piksi.ac.id', '021-87654324', 'Mengkoordinasikan kegiatan evaluasi pembelajaran, evaluasi kurikulum, dan pengembangan sistem penilaian kualitas pendidikan.', 'S2 Pendidikan', '', 4, 'aktif', '2025-04-01', '2026-01-31 10:31:32', '2026-01-31 03:56:24');
INSERT INTO `struktur_organisasi` VALUES (5, 'Muhamad Prakarsa AQS, S.Kom, M. Kom.', 'Bid Riset dan Pengembangan', 'manajer', 'struktur_1769831878.jpeg', 'm.prakarsa@piksi.ac.id', '021-87654325', 'Mengelola sistem informasi akademik, pengembangan aplikasi pendukung penjaminan mutu, dan maintenance infrastruktur IT.', 'S2 Sistem Informasi', '', 5, 'aktif', '2025-05-01', '2026-01-31 10:31:32', '2026-01-31 03:57:58');
INSERT INTO `struktur_organisasi` VALUES (6, 'Umar Wirahadi', 'Programmer', 'staff', NULL, 'umar@piksi.ac.id', '021-87654326', 'Mengelola administrasi umum LPM, dokumentasi, surat menyurat, dan koordinasi kegiatan administratif.', 'S2 Akuntansi', '', 6, 'aktif', '2020-06-01', '2026-01-31 10:31:32', '2026-01-31 04:04:27');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Hashed password using password_hash()',
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','editor','viewer') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'viewer' COMMENT 'User role for access control',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Path to avatar image',
  `is_active` tinyint(1) NULL DEFAULT 1 COMMENT '1 = Active, 0 = Inactive',
  `last_login` datetime NULL DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Token for remember me functionality',
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username` ASC) USING BTREE,
  UNIQUE INDEX `email`(`email` ASC) USING BTREE,
  INDEX `idx_username`(`username` ASC) USING BTREE,
  INDEX `idx_email`(`email` ASC) USING BTREE,
  INDEX `idx_role`(`role` ASC) USING BTREE,
  INDEX `idx_is_active`(`is_active` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', 'admin@lpm.ac.id', '$2y$10$quOipemIByCa7nab2EVVMO1u.nbcsjC69OFTPzHBCOL4L2q2tMhcu', 'Administrator', 'admin', '081234567890', 'assets/img/avatars/avatar_1770219772_8181.png', 1, '2026-02-05 00:15:52', NULL, '2026-02-04 22:32:37', '2026-02-05 07:15:52');
INSERT INTO `users` VALUES (6, 'widwi', 'widwi@piksi.ac.id', '$2y$10$eDPKhAVB0YI/XFs1BV0tQu/sxSh.109hGkk/AwfjsnLe.pfCaMEF.', 'Widwi Handari Adji', 'admin', '08120121214', NULL, 1, '2026-02-05 00:06:23', NULL, '2026-02-05 00:06:11', '2026-02-05 07:06:23');

SET FOREIGN_KEY_CHECKS = 1;
