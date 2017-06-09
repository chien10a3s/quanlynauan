-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.18-0ubuntu0.16.04.1 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table anuong.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.categories: ~2 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `parent_id`, `order`, `name`, `slug`, `created_at`, `updated_at`, `image`, `description`, `status`, `created_by`, `updated_by`) VALUES
	(1, NULL, 1, 'Gia Vị', 'gia-vi', '2017-05-29 05:46:48', '2017-05-29 08:05:46', NULL, NULL, 1, 0, 0),
	(2, NULL, 1, 'Thịt lợn', 'thit-lon', '2017-05-29 05:46:48', '2017-05-29 08:06:05', NULL, NULL, 1, 0, 0);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table anuong.data_rows
CREATE TABLE IF NOT EXISTS `data_rows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) unsigned NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.data_rows: ~52 rows (approximately)
DELETE FROM `data_rows`;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
	(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, '', 1),
	(2, 1, 'author_id', 'text', 'Author', 1, 0, 1, 1, 0, 1, '', 2),
	(3, 1, 'category_id', 'text', 'Category', 1, 0, 1, 1, 1, 0, '', 3),
	(4, 1, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, '', 4),
	(5, 1, 'excerpt', 'text_area', 'excerpt', 1, 0, 1, 1, 1, 1, '', 5),
	(6, 1, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, '', 6),
	(7, 1, 'image', 'image', 'Post Image', 0, 1, 1, 1, 1, 1, '\n{\n    "resize": {\n        "width": "1000",\n        "height": "null"\n    },\n    "quality": "70%",\n    "upsize": true,\n    "thumbnails": [\n        {\n            "name": "medium",\n            "scale": "50%"\n        },\n        {\n            "name": "small",\n            "scale": "25%"\n        },\n        {\n            "name": "cropped",\n            "crop": {\n                "width": "300",\n                "height": "250"\n            }\n        }\n    ]\n}', 7),
	(8, 1, 'slug', 'text', 'slug', 1, 0, 1, 1, 1, 1, '\n{\n    "slugify": {\n        "origin": "title",\n        "forceUpdate": true\n    }\n}', 8),
	(9, 1, 'meta_description', 'text_area', 'meta_description', 1, 0, 1, 1, 1, 1, '', 9),
	(10, 1, 'meta_keywords', 'text_area', 'meta_keywords', 1, 0, 1, 1, 1, 1, '', 10),
	(11, 1, 'status', 'select_dropdown', 'status', 1, 1, 1, 1, 1, 1, '\n{\n    "default": "DRAFT",\n    "options": {\n        "PUBLISHED": "published",\n        "DRAFT": "draft",\n        "PENDING": "pending"\n    }\n}', 11),
	(12, 1, 'created_at', 'timestamp', 'created_at', 0, 1, 1, 0, 0, 0, '', 12),
	(13, 1, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '', 13),
	(14, 2, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '', 1),
	(15, 2, 'author_id', 'text', 'author_id', 1, 0, 0, 0, 0, 0, '', 2),
	(16, 2, 'title', 'text', 'title', 1, 1, 1, 1, 1, 1, '', 3),
	(17, 2, 'excerpt', 'text_area', 'excerpt', 1, 0, 1, 1, 1, 1, '', 4),
	(18, 2, 'body', 'rich_text_box', 'body', 1, 0, 1, 1, 1, 1, '', 5),
	(19, 2, 'slug', 'text', 'slug', 1, 0, 1, 1, 1, 1, '{"slugify":{"origin":"title"}}', 6),
	(20, 2, 'meta_description', 'text', 'meta_description', 1, 0, 1, 1, 1, 1, '', 7),
	(21, 2, 'meta_keywords', 'text', 'meta_keywords', 1, 0, 1, 1, 1, 1, '', 8),
	(22, 2, 'status', 'select_dropdown', 'status', 1, 1, 1, 1, 1, 1, '{"default":"INACTIVE","options":{"INACTIVE":"INACTIVE","ACTIVE":"ACTIVE"}}', 9),
	(23, 2, 'created_at', 'timestamp', 'created_at', 1, 1, 1, 0, 0, 0, '', 10),
	(24, 2, 'updated_at', 'timestamp', 'updated_at', 1, 0, 0, 0, 0, 0, '', 11),
	(25, 2, 'image', 'image', 'image', 0, 1, 1, 1, 1, 1, '', 12),
	(26, 3, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '', 1),
	(27, 3, 'name', 'text', 'name', 1, 1, 1, 1, 1, 1, '', 2),
	(28, 3, 'email', 'text', 'email', 1, 1, 1, 1, 1, 1, '', 3),
	(29, 3, 'password', 'password', 'password', 1, 0, 0, 1, 1, 0, '', 4),
	(30, 3, 'remember_token', 'text', 'remember_token', 0, 0, 0, 0, 0, 0, '', 5),
	(31, 3, 'created_at', 'timestamp', 'created_at', 0, 1, 1, 0, 0, 0, '', 6),
	(32, 3, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '', 7),
	(33, 3, 'avatar', 'image', 'avatar', 0, 1, 1, 1, 1, 1, '', 8),
	(34, 5, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '', 1),
	(35, 5, 'name', 'text', 'name', 1, 1, 1, 1, 1, 1, '', 2),
	(36, 5, 'created_at', 'timestamp', 'created_at', 0, 0, 0, 0, 0, 0, '', 3),
	(37, 5, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '', 4),
	(38, 4, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '', 1),
	(39, 4, 'parent_id', 'select_dropdown', 'parent_id', 0, 0, 1, 1, 1, 1, '{"default":"","null":"","options":{"":"-- None --"},"relationship":{"key":"id","label":"name"}}', 2),
	(40, 4, 'order', 'text', 'order', 1, 1, 1, 1, 1, 1, '{"default":1}', 3),
	(41, 4, 'name', 'text', 'name', 1, 1, 1, 1, 1, 1, '', 4),
	(42, 4, 'slug', 'text', 'slug', 1, 1, 1, 1, 1, 1, '', 5),
	(43, 4, 'created_at', 'timestamp', 'created_at', 0, 0, 1, 0, 0, 0, '', 6),
	(44, 4, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '', 7),
	(45, 6, 'id', 'number', 'id', 1, 0, 0, 0, 0, 0, '', 1),
	(46, 6, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, '', 2),
	(47, 6, 'created_at', 'timestamp', 'created_at', 0, 0, 0, 0, 0, 0, '', 3),
	(48, 6, 'updated_at', 'timestamp', 'updated_at', 0, 0, 0, 0, 0, 0, '', 4),
	(49, 6, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, '', 5),
	(50, 1, 'seo_title', 'text', 'seo_title', 0, 1, 1, 1, 1, 1, '', 14),
	(51, 1, 'featured', 'checkbox', 'featured', 1, 1, 1, 1, 1, 1, '', 15),
	(52, 3, 'role_id', 'text', 'role_id', 1, 1, 1, 1, 1, 1, '', 9);
/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;

-- Dumping structure for table anuong.data_types
CREATE TABLE IF NOT EXISTS `data_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.data_types: ~6 rows (approximately)
DELETE FROM `data_types`;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `controller`, `description`, `generate_permissions`, `server_side`, `created_at`, `updated_at`) VALUES
	(1, 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'TCG\\Voyager\\Models\\Post', '', '', 1, 0, '2017-05-29 05:46:45', '2017-05-29 05:46:45'),
	(2, 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'TCG\\Voyager\\Models\\Page', '', '', 1, 0, '2017-05-29 05:46:45', '2017-05-29 05:46:45'),
	(3, 'users', 'users', 'User', 'Users', 'voyager-person', 'TCG\\Voyager\\Models\\User', '', '', 1, 0, '2017-05-29 05:46:45', '2017-05-29 05:46:45'),
	(4, 'categories', 'categories', 'Category', 'Categories', 'voyager-categories', 'TCG\\Voyager\\Models\\Category', '', '', 1, 0, '2017-05-29 05:46:45', '2017-05-29 05:46:45'),
	(5, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'TCG\\Voyager\\Models\\Menu', '', '', 1, 0, '2017-05-29 05:46:45', '2017-05-29 05:46:45'),
	(6, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'TCG\\Voyager\\Models\\Role', '', '', 1, 0, '2017-05-29 05:46:45', '2017-05-29 05:46:45');
/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;

-- Dumping structure for table anuong.food
CREATE TABLE IF NOT EXISTS `food` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `decription` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table anuong.food: ~0 rows (approximately)
DELETE FROM `food`;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
/*!40000 ALTER TABLE `food` ENABLE KEYS */;

-- Dumping structure for table anuong.kitchens
CREATE TABLE IF NOT EXISTS `kitchens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0: Locked; 1: Active',
  `money` decimal(10,2) NOT NULL COMMENT 'money of Kitchen',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'address of Kitchen',
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'avatar of Kitchen',
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kitchens_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.kitchens: ~1 rows (approximately)
DELETE FROM `kitchens`;
/*!40000 ALTER TABLE `kitchens` DISABLE KEYS */;
INSERT INTO `kitchens` (`id`, `code`, `name`, `status`, `money`, `address`, `avatar`, `note`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'B01', 'Bếp Số 1', 1, 10000000.00, 'Số 2 ngõ 59 Láng Hạ', NULL, 'Công ty OMT', 1, 1, NULL, '2017-06-02 03:07:28');
/*!40000 ALTER TABLE `kitchens` ENABLE KEYS */;

-- Dumping structure for table anuong.menus
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.menus: ~1 rows (approximately)
DELETE FROM `menus`;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2017-05-29 05:46:46', '2017-05-29 05:46:46');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;

-- Dumping structure for table anuong.menu_items
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.menu_items: ~13 rows (approximately)
DELETE FROM `menu_items`;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
	(1, 1, 'Dashboard', '/admin', '_self', 'voyager-boat', NULL, NULL, 1, '2017-05-29 05:46:46', '2017-05-29 05:46:46', NULL, NULL),
	(2, 1, 'Media', '/admin/media', '_self', 'voyager-images', NULL, 8, 3, '2017-05-29 05:46:46', '2017-06-02 02:58:54', NULL, NULL),
	(3, 1, 'Posts', '/admin/posts', '_self', 'voyager-news', NULL, 8, 4, '2017-05-29 05:46:46', '2017-06-02 02:58:55', NULL, NULL),
	(4, 1, 'Users', '/admin/users', '_self', 'voyager-person', NULL, NULL, 3, '2017-05-29 05:46:46', '2017-05-29 05:46:46', NULL, NULL),
	(5, 1, 'Categories', '/admin/categories', '_self', 'voyager-categories', NULL, NULL, 5, '2017-05-29 05:46:46', '2017-05-29 05:57:17', NULL, NULL),
	(6, 1, 'Pages', '/admin/pages', '_self', 'voyager-file-text', NULL, NULL, 4, '2017-05-29 05:46:46', '2017-05-29 05:57:17', NULL, NULL),
	(7, 1, 'Roles', '/admin/roles', '_self', 'voyager-lock', NULL, NULL, 2, '2017-05-29 05:46:46', '2017-05-29 05:46:46', NULL, NULL),
	(8, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 6, '2017-05-29 05:46:46', '2017-05-29 05:57:17', NULL, NULL),
	(9, 1, 'Menu Builder', '/admin/menus', '_self', 'voyager-list', NULL, 8, 1, '2017-05-29 05:46:46', '2017-05-29 05:57:15', NULL, NULL),
	(10, 1, 'Database', '/admin/database', '_self', 'voyager-data', NULL, 8, 2, '2017-05-29 05:46:46', '2017-06-02 02:58:54', NULL, NULL),
	(11, 1, 'Settings', '/admin/settings', '_self', 'voyager-settings', NULL, NULL, 7, '2017-05-29 05:46:46', '2017-05-29 05:57:17', NULL, NULL),
	(12, 1, 'Foods', '/admin/foods', '_self', NULL, '#000000', NULL, 8, '2017-05-29 08:53:03', '2017-05-29 08:53:03', NULL, ''),
	(13, 1, 'Kitchen', '/admin/kitchen', '_self', 'voyager-shop', '#000000', NULL, 9, '2017-06-02 03:06:28', '2017-06-02 03:06:28', NULL, '');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;

-- Dumping structure for table anuong.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.migrations: ~20 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2016_01_01_000000_add_voyager_user_fields', 1),
	(4, '2016_01_01_000000_create_data_types_table', 1),
	(5, '2016_01_01_000000_create_pages_table', 1),
	(6, '2016_01_01_000000_create_posts_table', 1),
	(7, '2016_02_15_204651_create_categories_table', 1),
	(8, '2016_05_19_173453_create_menu_table', 1),
	(9, '2016_10_21_190000_create_roles_table', 1),
	(10, '2016_10_21_190000_create_settings_table', 1),
	(11, '2016_11_30_135954_create_permission_table', 1),
	(12, '2016_11_30_141208_create_permission_role_table', 1),
	(13, '2016_12_26_201236_data_types__add__server_side', 1),
	(14, '2017_01_13_000000_add_route_to_menu_items_table', 1),
	(15, '2017_01_14_005015_create_translations_table', 1),
	(16, '2017_01_15_000000_add_permission_group_id_to_permissions_table', 1),
	(17, '2017_01_15_000000_create_permission_groups_table', 1),
	(18, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
	(19, '2017_03_06_000000_add_controller_to_data_types_table', 1),
	(20, '2017_04_21_000000_add_order_to_data_rows_table', 1),
	(21, '2017_06_02_021428_create_kitchens', 2),
	(22, '2017_06_02_021535_create_user_kitchens', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table anuong.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.pages: ~0 rows (approximately)
DELETE FROM `pages`;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
	(1, 0, 'Hello World', 'Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.', '<p>Hello World. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', 'pages/AAgCCnqHfLlRub9syUdw.jpg', 'hello-world', 'Yar Meta Description', 'Keyword1, Keyword2', 'ACTIVE', '2017-05-29 05:46:49', '2017-05-29 05:46:49');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Dumping structure for table anuong.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table anuong.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.permissions: ~34 rows (approximately)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`, `permission_group_id`) VALUES
	(1, 'browse_admin', NULL, '2017-05-29 05:46:46', '2017-05-29 05:46:46', NULL),
	(2, 'browse_database', NULL, '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(3, 'browse_media', NULL, '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(4, 'browse_settings', NULL, '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(5, 'browse_menus', 'menus', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(6, 'read_menus', 'menus', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(7, 'edit_menus', 'menus', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(8, 'add_menus', 'menus', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(9, 'delete_menus', 'menus', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(10, 'browse_pages', 'pages', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(11, 'read_pages', 'pages', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(12, 'edit_pages', 'pages', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(13, 'add_pages', 'pages', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(14, 'delete_pages', 'pages', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(15, 'browse_roles', 'roles', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(16, 'read_roles', 'roles', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(17, 'edit_roles', 'roles', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(18, 'add_roles', 'roles', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(19, 'delete_roles', 'roles', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(20, 'browse_users', 'users', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(21, 'read_users', 'users', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(22, 'edit_users', 'users', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(23, 'add_users', 'users', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(24, 'delete_users', 'users', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(25, 'browse_posts', 'posts', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(26, 'read_posts', 'posts', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(27, 'edit_posts', 'posts', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(28, 'add_posts', 'posts', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(29, 'delete_posts', 'posts', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(30, 'browse_categories', 'categories', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(31, 'read_categories', 'categories', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(32, 'edit_categories', 'categories', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(33, 'add_categories', 'categories', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL),
	(34, 'delete_categories', 'categories', '2017-05-29 05:46:47', '2017-05-29 05:46:47', NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table anuong.permission_groups
CREATE TABLE IF NOT EXISTS `permission_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.permission_groups: ~0 rows (approximately)
DELETE FROM `permission_groups`;
/*!40000 ALTER TABLE `permission_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_groups` ENABLE KEYS */;

-- Dumping structure for table anuong.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.permission_role: ~68 rows (approximately)
DELETE FROM `permission_role`;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(1, 3),
	(2, 1),
	(2, 3),
	(3, 1),
	(3, 3),
	(4, 1),
	(4, 3),
	(5, 1),
	(5, 3),
	(6, 1),
	(6, 3),
	(7, 1),
	(7, 3),
	(8, 1),
	(8, 3),
	(9, 1),
	(9, 3),
	(10, 1),
	(10, 3),
	(11, 1),
	(11, 3),
	(12, 1),
	(12, 3),
	(13, 1),
	(13, 3),
	(14, 1),
	(14, 3),
	(15, 1),
	(15, 3),
	(16, 1),
	(16, 3),
	(17, 1),
	(17, 3),
	(18, 1),
	(18, 3),
	(19, 1),
	(19, 3),
	(20, 1),
	(20, 3),
	(21, 1),
	(21, 3),
	(22, 1),
	(22, 3),
	(23, 1),
	(23, 3),
	(24, 1),
	(24, 3),
	(25, 1),
	(25, 3),
	(26, 1),
	(26, 3),
	(27, 1),
	(27, 3),
	(28, 1),
	(28, 3),
	(29, 1),
	(29, 3),
	(30, 1),
	(30, 3),
	(31, 1),
	(31, 3),
	(32, 1),
	(32, 3),
	(33, 1),
	(33, 3),
	(34, 1),
	(34, 3);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;

-- Dumping structure for table anuong.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('PUBLISHED','DRAFT','PENDING') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.posts: ~4 rows (approximately)
DELETE FROM `posts`;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `author_id`, `category_id`, `title`, `seo_title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `featured`, `created_at`, `updated_at`) VALUES
	(1, 0, NULL, 'Lorem Ipsum Post', NULL, 'This is the excerpt for the Lorem Ipsum Post', '<p>This is the body of the lorem ipsum post</p>', 'posts/nlje9NZQ7bTMYOUG4lF1.jpg', 'lorem-ipsum-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2017-05-29 05:46:49', '2017-05-29 05:46:49'),
	(2, 0, NULL, 'My Sample Post', NULL, 'This is the excerpt for the sample Post', '<p>This is the body for the sample post, which includes the body.</p>\n                <h2>We can use all kinds of format!</h2>\n                <p>And include a bunch of other stuff.</p>', 'posts/7uelXHi85YOfZKsoS6Tq.jpg', 'my-sample-post', 'Meta Description for sample post', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2017-05-29 05:46:49', '2017-05-29 05:46:49'),
	(3, 0, NULL, 'Latest Post', NULL, 'This is the excerpt for the latest post', '<p>This is the body for the latest post</p>', 'posts/9txUSY6wb7LTBSbDPrD9.jpg', 'latest-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2017-05-29 05:46:49', '2017-05-29 05:46:49'),
	(4, 0, NULL, 'Yarr Post', NULL, 'Reef sails nipperkin bring a spring upon her cable coffer jury mast spike marooned Pieces of Eight poop deck pillage. Clipper driver coxswain galleon hempen halter come about pressgang gangplank boatswain swing the lead. Nipperkin yard skysail swab lanyard Blimey bilge water ho quarter Buccaneer.', '<p>Swab deadlights Buccaneer fire ship square-rigged dance the hempen jig weigh anchor cackle fruit grog furl. Crack Jennys tea cup chase guns pressgang hearties spirits hogshead Gold Road six pounders fathom measured fer yer chains. Main sheet provost come about trysail barkadeer crimp scuttle mizzenmast brig plunder.</p>\n<p>Mizzen league keelhaul galleon tender cog chase Barbary Coast doubloon crack Jennys tea cup. Blow the man down lugsail fire ship pinnace cackle fruit line warp Admiral of the Black strike colors doubloon. Tackle Jack Ketch come about crimp rum draft scuppers run a shot across the bow haul wind maroon.</p>\n<p>Interloper heave down list driver pressgang holystone scuppers tackle scallywag bilged on her anchor. Jack Tar interloper draught grapple mizzenmast hulk knave cable transom hogshead. Gaff pillage to go on account grog aft chase guns piracy yardarm knave clap of thunder.</p>', 'posts/yuk1fBwmKKZdY2qR1ZKM.jpg', 'yarr-post', 'this be a meta descript', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2017-05-29 05:46:49', '2017-05-29 05:46:49');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table anuong.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.roles: ~3 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'Administrator', '2017-05-29 05:46:46', '2017-05-29 05:46:46'),
	(2, 'user', 'Khách hàng', '2017-05-29 05:46:46', '2017-05-29 05:52:46'),
	(3, 'chef', 'Đầu bếp', '2017-05-29 05:52:20', '2017-05-29 05:52:20');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table anuong.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.settings: ~9 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`) VALUES
	(1, 'title', 'Site Title', 'Site Title', '', 'text', 1),
	(2, 'description', 'Site Description', 'Site Description', '', 'text', 2),
	(3, 'logo', 'Site Logo', '', '', 'image', 3),
	(4, 'admin_bg_image', 'Admin Background Image', '', '', 'image', 9),
	(5, 'admin_title', 'Admin Title', 'Quản lý nấu ăn', '', 'text', 4),
	(6, 'admin_description', 'Admin Description', 'Chào mừng bạn đến với hệ thống quản lý nấu ăn', '', 'text', 5),
	(7, 'admin_loader', 'Admin Loader', '', '', 'image', 6),
	(8, 'admin_icon_image', 'Admin Icon Image', '', '', 'image', 7),
	(9, 'google_analytics_client_id', 'Google Analytics Client ID', '', '', 'text', 9);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table anuong.translations
CREATE TABLE IF NOT EXISTS `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) unsigned NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.translations: ~26 rows (approximately)
DELETE FROM `translations`;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` (`id`, `table_name`, `column_name`, `foreign_key`, `locale`, `value`, `created_at`, `updated_at`) VALUES
	(1, 'data_types', 'display_name_singular', 1, 'pt', 'Post', '2017-05-29 05:46:49', '2017-05-29 05:46:49'),
	(2, 'data_types', 'display_name_singular', 2, 'pt', 'Página', '2017-05-29 05:46:49', '2017-05-29 05:46:49'),
	(3, 'data_types', 'display_name_singular', 3, 'pt', 'Utilizador', '2017-05-29 05:46:49', '2017-05-29 05:46:49'),
	(4, 'data_types', 'display_name_singular', 4, 'pt', 'Categoria', '2017-05-29 05:46:49', '2017-05-29 05:46:49'),
	(5, 'data_types', 'display_name_singular', 5, 'pt', 'Menu', '2017-05-29 05:46:49', '2017-05-29 05:46:49'),
	(6, 'data_types', 'display_name_singular', 6, 'pt', 'Função', '2017-05-29 05:46:49', '2017-05-29 05:46:49'),
	(7, 'data_types', 'display_name_plural', 1, 'pt', 'Posts', '2017-05-29 05:46:49', '2017-05-29 05:46:49'),
	(8, 'data_types', 'display_name_plural', 2, 'pt', 'Páginas', '2017-05-29 05:46:49', '2017-05-29 05:46:49'),
	(9, 'data_types', 'display_name_plural', 3, 'pt', 'Utilizadores', '2017-05-29 05:46:49', '2017-05-29 05:46:49'),
	(10, 'data_types', 'display_name_plural', 4, 'pt', 'Categorias', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(11, 'data_types', 'display_name_plural', 5, 'pt', 'Menus', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(12, 'data_types', 'display_name_plural', 6, 'pt', 'Funções', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(13, 'pages', 'title', 1, 'pt', 'Olá Mundo', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(14, 'pages', 'slug', 1, 'pt', 'ola-mundo', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(15, 'pages', 'body', 1, 'pt', '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(16, 'menu_items', 'title', 1, 'pt', 'Painel de Controle', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(17, 'menu_items', 'title', 2, 'pt', 'Media', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(18, 'menu_items', 'title', 3, 'pt', 'Publicações', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(19, 'menu_items', 'title', 4, 'pt', 'Utilizadores', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(20, 'menu_items', 'title', 5, 'pt', 'Categorias', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(21, 'menu_items', 'title', 6, 'pt', 'Páginas', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(22, 'menu_items', 'title', 7, 'pt', 'Funções', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(23, 'menu_items', 'title', 8, 'pt', 'Ferramentas', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(24, 'menu_items', 'title', 9, 'pt', 'Menus', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(25, 'menu_items', 'title', 10, 'pt', 'Base de dados', '2017-05-29 05:46:50', '2017-05-29 05:46:50'),
	(26, 'menu_items', 'title', 11, 'pt', 'Configurações', '2017-05-29 05:46:50', '2017-05-29 05:46:50');
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;

-- Dumping structure for table anuong.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.users: ~5 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `avatar`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Admin', 'admin@admin.com', 'users/June2017/ldJhcLvrjY1tTq8KuusR.jpg', '$2y$10$TeM2cZMR7K7GB93urRgFVuV0Z2QCQE3Uw1/sjbm.hZivZfIry2FRi', 'lGH0WKgI9m11wasV78PblyH4R1MlUuFnlLyMKdcu0uEI0vLsnlQdIeALdifP', '2017-05-29 05:46:48', '2017-06-02 08:12:20'),
	(2, 1, 'Bùi Minh Chiến', 'chien10a3s@gmail.com', 'users/June2017/FNCuqnYqn6lDXK0M8NCz.jpg', '$2y$10$IfGeYqIE9wgIEtVerK9ohudhhoVPm3DFiGKbM1GeZH9jmzhrcl9Em', NULL, '2017-06-02 03:00:31', '2017-06-02 03:00:31'),
	(3, 2, 'Tiến', 'tien@admin.com', 'users/default.png', '$2y$10$H.rFDcuY/veALGAZmXi3MejRm/kkLVZ36b9f.SCJwQR5pKVOf2.pW', NULL, '2017-06-02 04:23:58', '2017-06-02 04:23:58'),
	(4, 3, 'Hợp', 'hop@admin.com', 'users/default.png', '$2y$10$PpOT0YczCqYCaO31HraU2urpxGJFu3OpFVO1V5/GU/oL7N0xBAfyC', NULL, '2017-06-02 04:24:21', '2017-06-02 04:24:21'),
	(5, 2, 'a Hoài', 'hoai@admin.com', 'users/default.png', '$2y$10$bSXnFWZJLdF4ZIlkj95ZiO1cjl9bbnxoneLgtphUFLyAsjn1s77dS', NULL, '2017-06-02 04:24:42', '2017-06-02 04:24:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table anuong.user_kitchens
CREATE TABLE IF NOT EXISTS `user_kitchens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_kitchen` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table anuong.user_kitchens: ~0 rows (approximately)
DELETE FROM `user_kitchens`;
/*!40000 ALTER TABLE `user_kitchens` DISABLE KEYS */;
INSERT INTO `user_kitchens` (`id`, `id_kitchen`, `id_user`, `role`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(3, 1, 4, 3, 1, 1, NULL, NULL),
	(4, 1, 5, 2, 1, 1, NULL, NULL);
/*!40000 ALTER TABLE `user_kitchens` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
