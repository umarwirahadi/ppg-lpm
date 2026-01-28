-- Schema: kegiatan (activities)
-- Location: dbschema/kegiatan.sql
-- MySQL / MariaDB (InnoDB, utf8mb4)

CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `category` VARCHAR(100) DEFAULT NULL,
  `organizer` VARCHAR(150) DEFAULT NULL,
  `location` VARCHAR(255) DEFAULT NULL,
  `start_date` DATETIME DEFAULT NULL,
  `end_date` DATETIME DEFAULT NULL,
  `timezone` VARCHAR(50) DEFAULT NULL,
  `participants` INT UNSIGNED NOT NULL DEFAULT 0,
  `contact_person` VARCHAR(150) DEFAULT NULL,
  `contact_phone` VARCHAR(50) DEFAULT NULL,
  `document_url` VARCHAR(512) DEFAULT NULL,
  `image_url` VARCHAR(512) DEFAULT NULL,
  `status` ENUM('draft','published','cancelled','completed') NOT NULL DEFAULT 'draft',
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `created_by` INT UNSIGNED DEFAULT NULL,
  `updated_by` INT UNSIGNED DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_kegiatan_slug` (`slug`),
  KEY `idx_kegiatan_start_date` (`start_date`),
  KEY `idx_kegiatan_end_date` (`end_date`),
  KEY `idx_kegiatan_status` (`status`),
  KEY `idx_kegiatan_created_by` (`created_by`),
  KEY `idx_kegiatan_organizer` (`organizer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional: add fulltext index for searching title/description (MySQL 5.6+/InnoDB)
-- ALTER TABLE `kegiatan` ADD FULLTEXT KEY `ft_kegiatan_title_desc` (`title`, `description`);

-- Notes:
-- - `created_by` / `updated_by` can reference your users table if present.
-- - `document_url` and `image_url` store paths or full URLs to related files.
-- - Adjust lengths / types as needed for your application.
