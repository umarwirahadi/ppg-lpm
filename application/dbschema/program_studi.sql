/*
 Navicat Premium Data Transfer

 Source Server         : Localhot_Mariadb
 Source Server Type    : MariaDB
 Source Server Version : 110202 (11.2.2-MariaDB)
 Source Host           : localhost:3307
 Source Schema         : lpm_db_rev2

 Target Server Type    : MariaDB
 Target Server Version : 110202 (11.2.2-MariaDB)
 File Encoding         : 65001

 Date: 04/02/2026 15:41:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = MyISAM AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of program_studi
-- ----------------------------
INSERT INTO `program_studi` VALUES (1, '63413', 'D3-Administrasi Keuangan', 'Fakultas Ekonomi dan Bisnis', 'Dr. Hendra Wijaya, S.E., M.Ak.', 'Rina Kartika, S.E., M.M.', 'Unggul', '2023-08-15', '2028-08-14', '1234/SK/BAN-PT/Ak-PPJ/Dipl-III/VIII/2023', 'Program studi administrasi keuangan dengan fokus pada pengelolaan keuangan perusahaan dan lembaga.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (2, '13461', 'D3-Administrasi Rumah Sakit', 'Fakultas Ilmu Kesehatan', 'Dr. Siti Aminah, S.K.M., M.Kes.', 'Andi Pratama, S.K.M., M.M.', 'Baik', NULL, NULL, NULL, 'Program studi administrasi rumah sakit yang mempersiapkan tenaga ahli manajemen kesehatan.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (3, '13453', 'D3-Analis Kesehatan', 'Fakultas Ilmu Kesehatan', 'Dr. Dewi Susanti, S.Si., M.Biomed.', 'Budi Hartono, S.Si., M.Si.', 'Baik Sekali', '2022-05-20', '2027-05-19', '2345/SK/BAN-PT/Ak-PPJ/Dipl-III/V/2022', 'Program studi analis kesehatan dengan keahlian laboratorium klinik dan diagnostik.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (4, '61316', 'D4-Bisnis Digital', 'Fakultas Ekonomi dan Bisnis', 'Dr. Anita Rahman, S.E., M.M.', 'Bambang Sutrisno, S.E., M.M.', 'Baik', '2024-02-10', '2029-02-09', '3456/SK/BAN-PT/Ak-PPJ/Dipl-IV/II/2024', 'Program studi sarjana terapan bisnis digital dengan fokus startup dan e-commerce.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (5, '48401', 'D3-Farmasi', 'Fakultas Ilmu Kesehatan', 'apt. Dr. Maya Puspita, S.Farm., M.Farm.', 'apt. Rizki Andini, S.Farm., M.Farm.', 'Baik', '2021-09-15', '2026-09-14', '4567/SK/BAN-PT/Ak-PPJ/Dipl-III/IX/2021', 'Program studi farmasi yang menghasilkan tenaga asisten apoteker profesional.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (6, '11401', 'D3-Fisioterapi', 'Fakultas Ilmu Kesehatan', 'Dr. Ahmad Fauzan, S.Ft., M.Fis.', 'Indah Permata, S.Ft., M.Kes.', 'Baik', '2021-11-01', '2026-10-31', '5678/SK/BAN-PT/Ak-PPJ/Dipl-III/XI/2021', 'Program studi fisioterapi dengan keahlian rehabilitasi medik dan terapi fisik.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (7, '57302', 'D4-Komputerisasi Akuntansi', 'Fakultas Teknik dan Ilmu Komputer', 'Dr. Hadi Santoso, S.E., S.Kom., M.Kom.', 'Lina Marlina, S.Kom., M.Ak.', 'Baik Sekali', '2023-06-25', '2028-06-24', '6789/SK/BAN-PT/Ak-PPJ/Dipl-IV/VI/2023', 'Program studi sarjana terapan yang menggabungkan akuntansi dan teknologi informasi.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (8, '13363', 'D4-Manajemen Informasi Kesehatan', 'Fakultas Ilmu Kesehatan', 'Dr. Ratna Wijayanti, S.K.M., M.K.M.', 'Dian Purnama, S.K.M., M.Kes.', 'Baik', '2024-01-20', '2029-01-19', '7890/SK/BAN-PT/Ak-PPJ/Dipl-IV/I/2024', 'Program studi manajemen informasi kesehatan dengan fokus rekam medis elektronik.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (9, '57301', 'D4-Manajemen Informatika', 'Fakultas Teknik dan Ilmu Komputer', 'Dr. Ir. Budi Santoso, S.Kom., M.Kom.', 'Dewi Anggraini, S.Kom., M.T.', 'Baik Sekali', '2023-09-10', '2028-09-09', '8901/SK/BAN-PT/Ak-PPJ/Dipl-IV/IX/2023', 'Program studi sarjana terapan manajemen informatika dengan keunggulan sistem enterprise.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (10, '57401', 'D3-Manajemen Informatika', 'Fakultas Teknik dan Ilmu Komputer', 'Ir. Farhan Abdullah, S.Kom., M.T.', 'Nurul Hidayah, S.Kom., M.Kom.', 'Baik Sekali', '2023-07-01', '2028-06-30', '9012/SK/BAN-PT/Ak-PPJ/Dipl-III/VII/2023', 'Program studi manajemen informatika dengan keahlian pengembangan aplikasi dan database.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (11, '13461-MPRS', 'D3-Manajemen Pelayanan Rumah Sakit', 'Fakultas Ilmu Kesehatan', 'Dr. Kartini Wulandari, S.K.M., M.M.', 'Agus Setiawan, S.K.M., M.Kes.', 'Baik Sekali', '2023-03-15', '2028-03-14', '0123/SK/BAN-PT/Ak-PPJ/Dipl-III/III/2023', 'Program studi manajemen pelayanan rumah sakit dengan fokus mutu layanan kesehatan.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (12, '90347', 'D4-Produksi Media', 'Fakultas Teknik dan Ilmu Komputer', 'Dr. Rizky Pratama, S.Sn., M.Ds.', 'Eka Putri, S.Ds., M.Sn.', 'Baik', '2025-01-10', '2026-01-09', '1122/SK/BAN-PT/Akred-S/Dipl-IV/I/2025', 'Program studi sarjana terapan produksi media dengan keahlian multimedia dan broadcasting.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (13, '13462', 'D3-Rekam Medik Dan Informasi Kesehatan', 'Fakultas Ilmu Kesehatan', 'Dr. Sri Wahyuni, S.K.M., M.Kes.', 'Joko Susilo, A.Md.RMIK., S.K.M.', 'Unggul', '2022-04-20', '2027-04-19', '2233/SK/BAN-PT/Ak-PPJ/Dipl-III/IV/2022', 'Program studi rekam medik dan informasi kesehatan dengan standar kompetensi nasional.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (14, '56401', 'D3-Teknik Komputer', 'Fakultas Teknik dan Ilmu Komputer', 'Dr. Eng. Wahyu Hidayat, S.T., M.T.', 'Linda Permata, S.T., M.Kom.', 'Baik Sekali', '2022-08-15', '2027-08-14', '3344/SK/BAN-PT/Ak-PPJ/Dipl-III/VIII/2022', 'Program studi teknik komputer dengan keahlian jaringan komputer dan IoT.', '2026-02-04 15:40:13');
INSERT INTO `program_studi` VALUES (15, '13450', 'D3-Teknologi Laboratorium Medis', 'Fakultas Ilmu Kesehatan', 'Dr. Endang Susilowati, S.Si., M.Biomed.', 'Ari Wibowo, S.Si., M.Si.', 'Baik', NULL, NULL, NULL, 'Program studi teknologi laboratorium medis dengan fokus diagnostik dan penelitian klinis.', '2026-02-04 15:40:13');

SET FOREIGN_KEY_CHECKS = 1;
