/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50739 (5.7.39)
 Source Host           : localhost:8889
 Source Schema         : hris

 Target Server Type    : MySQL
 Target Server Version : 50739 (5.7.39)
 File Encoding         : 65001

 Date: 23/05/2026 18:36:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `status` enum('active','inactive','resigned') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of employees
-- ----------------------------
BEGIN;
INSERT INTO `employees` (`id`, `employee_id`, `full_name`, `email`, `phone`, `position`, `department`, `photo`, `hire_date`, `status`, `created_at`, `updated_at`) VALUES (1, '303930', 'Susanti', 'susan@gmail.com', '08217657858', 'Staff', 'HRD', '1779524212_191bdc2eaf6bc08168b4.jpeg', '2026-05-23', 'active', '2026-05-23 08:16:52', '2026-05-23 08:19:09');
INSERT INTO `employees` (`id`, `employee_id`, `full_name`, `email`, `phone`, `position`, `department`, `photo`, `hire_date`, `status`, `created_at`, `updated_at`) VALUES (2, '8979898', 'Eman', 'Eman@gmail.com', '080987998', 'Manager', 'IT', '1779534613_3f9e76dec9a9794fe212.jpeg', '2026-05-22', 'active', '2026-05-23 11:10:13', '2026-05-23 11:10:13');
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (1, '2026-05-23-074543', 'App\\Database\\Migrations\\Users', 'default', 'App', 1779522361, 1);
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES (2, '2026-05-23-080248', 'App\\Database\\Migrations\\Employees', 'default', 'App', 1779523387, 2);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('admin','manager','staff') NOT NULL DEFAULT 'staff',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `username`, `email`, `password`, `full_name`, `phone`, `role`, `status`, `created_at`, `updated_at`) VALUES (1, 'admin', 'admin@hris.com', '$2y$10$ZIbltSWK3egZ3TcLFwhXkuwhgEypnlZBpvkUQnf24ZOgAd/ki3pKC', 'Administrator', '081234567890', 'admin', 'active', '2026-05-23 07:46:01', '2026-05-23 07:46:01');
INSERT INTO `users` (`id`, `username`, `email`, `password`, `full_name`, `phone`, `role`, `status`, `created_at`, `updated_at`) VALUES (2, 'Budi', 'budi@gmail.com', '$2y$10$Za7FXUrH8MoBq3B8iwt7.uvkOi5zM1y5hiqxKTYDkOsZIjddxc3FS', 'Budi Sutiono', '08217657858', 'staff', 'active', '2026-05-23 07:54:49', '2026-05-23 07:54:49');
INSERT INTO `users` (`id`, `username`, `email`, `password`, `full_name`, `phone`, `role`, `status`, `created_at`, `updated_at`) VALUES (3, 'Lala', 'Lala@gmail.com', '$2y$10$VDzp4dCjJhlXyATtfwFiD.wP3b4o4v60OSy3J7mJCZAp.jAzFcYPe', 'Lala', '4444', 'staff', 'active', '2026-05-23 11:13:32', '2026-05-23 11:13:32');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
