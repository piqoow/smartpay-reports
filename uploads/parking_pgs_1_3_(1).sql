-- Adminer 4.8.1 MySQL 5.5.5-10.4.24-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `parking_pgs_1_3`;
CREATE DATABASE `parking_pgs_1_3` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `parking_pgs_1_3`;

DROP TABLE IF EXISTS `display_group`;
CREATE TABLE `display_group` (
  `display_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `display_group_code` varchar(10) NOT NULL,
  `display_group_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `display_group_style` smallint(6) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` smallint(6) NOT NULL DEFAULT 0,
  PRIMARY KEY (`display_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `display_group` (`display_group_id`, `display_group_code`, `display_group_name`, `description`, `display_group_style`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted`) VALUES
(1,	'DSPLG01',	'Display LG',	'',	1,	1,	'2022-03-22 07:35:33',	1,	'2022-03-22 07:35:33',	0),
(2,	'DSPP101',	'Display P1',	'',	1,	1,	'2022-03-22 07:35:33',	1,	'2022-03-22 07:35:33',	0),
(3,	'DSPP201',	'Display P2',	'',	1,	1,	'2022-03-22 07:35:33',	1,	'2022-03-22 07:35:33',	0),
(4,	'DSPP301',	'Display P3',	'',	1,	1,	'2022-03-22 07:35:33',	1,	'2022-03-22 07:35:33',	0),
(5,	'DSPP401',	'Display P4',	'',	1,	1,	'2022-03-22 07:35:33',	1,	'2022-03-22 07:35:33',	0),
(6,	'DSPP501',	'Display P5',	'',	1,	1,	'2022-03-22 07:35:33',	1,	'2022-03-22 07:35:33',	0),
(7,	'DSPP601',	'Display P6',	'',	1,	1,	'2022-03-22 07:35:33',	1,	'2022-03-22 07:35:33',	0),
(8,	'DSPP701',	'Display P7',	'',	1,	1,	'2022-03-22 07:35:33',	1,	'2022-03-22 07:35:33',	0);

DROP TABLE IF EXISTS `display_group_detail`;
CREATE TABLE `display_group_detail` (
  `display_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `display_group_code` varchar(10) NOT NULL,
  `floor_id` int(11) NOT NULL,
  PRIMARY KEY (`display_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `display_group_detail` (`display_group_id`, `display_group_code`, `floor_id`) VALUES
(1,	'DSPLG01',	8),
(2,	'DSPP101',	2),
(3,	'DSPP201',	3),
(4,	'DSPP301',	4),
(5,	'DSPP401',	5),
(6,	'DSPP501',	6),
(7,	'DSPP601',	7),
(8,	'DSPP701',	8);

DROP TABLE IF EXISTS `log_sensor`;
CREATE TABLE `log_sensor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(20) DEFAULT NULL,
  `sensor_type` varchar(15) DEFAULT NULL,
  `value` smallint(6) DEFAULT 1,
  `sensor_number` smallint(2) NOT NULL,
  `createdAt` timestamp NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `mst_building`;
CREATE TABLE `mst_building` (
  `building_id` int(11) NOT NULL AUTO_INCREMENT,
  `building_name` varchar(100) NOT NULL,
  PRIMARY KEY (`building_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mst_building` (`building_id`, `building_name`) VALUES
(1,	'Parking Area EAST'),
(2,	'Parking Area WEST');

DROP TABLE IF EXISTS `mst_display`;
CREATE TABLE `mst_display` (
  `display_id` int(11) NOT NULL AUTO_INCREMENT,
  `display_code` varchar(10) NOT NULL,
  `display_name` varchar(30) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `display_group_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`display_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mst_display` (`display_id`, `display_code`, `display_name`, `ip_address`, `display_group_id`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted`) VALUES
(2,	'P1M01',	'Display P1',	'111.18.17.101',	2,	1,	'2022-03-22 07:40:22',	1,	'2022-03-22 07:40:22',	0),
(3,	'P2M01',	'Display P2',	'111.18.17.102',	3,	1,	'2022-03-22 07:40:22',	1,	'2022-03-22 07:40:22',	0),
(4,	'P3M01',	'Display P3',	'111.18.17.103',	4,	1,	'2022-03-22 07:40:22',	1,	'2022-03-22 07:40:22',	0),
(5,	'P4M01',	'Display P4',	'111.18.17.104',	5,	1,	'2022-03-22 07:40:22',	1,	'2022-03-22 07:40:22',	0),
(6,	'P5M01',	'Display P5',	'111.18.17.105',	6,	1,	'2022-03-22 07:40:22',	1,	'2022-03-22 07:40:22',	0),
(7,	'P6M01',	'Display P6',	'111.18.17.106',	7,	1,	'2022-03-22 07:40:22',	1,	'2022-03-22 07:40:22',	0),
(8,	'P7M01',	'Display P7',	'111.18.17.107',	8,	1,	'2022-03-22 07:40:22',	1,	'2022-03-22 07:40:22',	0),
(20,	'LGM01',	'Display LG',	'111.18.17.111',	1,	1,	'2022-03-22 07:40:22',	1,	'2022-03-22 07:40:22',	0);

DROP TABLE IF EXISTS `mst_floor`;
CREATE TABLE `mst_floor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `floor_code` char(3) NOT NULL,
  `room_group` varchar(50) NOT NULL,
  `floor_name` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  `balancing` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedBy` int(11) NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mst_floor` (`id`, `floor_code`, `room_group`, `floor_name`, `capacity`, `used`, `balancing`, `building_id`, `createdBy`, `createdAt`, `updatedBy`, `updatedAt`) VALUES
(2,	'P1',	'NM',	'Lantai 1',	135,	128,	0,	1,	1,	'2022-03-22 07:33:17',	1,	'2022-08-25 22:46:28'),
(3,	'P2',	'NM',	'Lantai 2',	139,	13,	0,	1,	1,	'2022-03-22 07:33:17',	1,	'2022-08-25 22:46:28'),
(4,	'P3',	'NM',	'Lantai 3',	140,	0,	0,	1,	1,	'2022-03-22 07:33:17',	1,	'2022-08-25 22:46:28'),
(5,	'P4',	'NM',	'Lantai 4',	140,	1,	0,	1,	1,	'2022-03-22 07:33:17',	1,	'2022-08-25 22:46:28'),
(6,	'P5',	'NM',	'Lantai 5',	27,	1,	0,	1,	1,	'2022-03-22 07:33:17',	1,	'2022-08-25 22:46:28'),
(7,	'P6',	'NM',	'Lantai 6',	25,	0,	0,	1,	1,	'2022-03-22 07:33:17',	1,	'2022-08-30 16:35:56'),
(8,	'LG',	'NM',	'Lantai LG',	47,	46,	0,	1,	1,	'2022-03-22 07:33:17',	1,	'2022-08-30 16:35:56'),
(9,	'P8',	'NM',	'Lantai 8',	200,	0,	0,	1,	1,	'2022-03-22 07:33:17',	1,	'2022-09-06 17:28:05');

DROP TABLE IF EXISTS `mst_level`;
CREATE TABLE `mst_level` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_code` char(3) NOT NULL,
  `level_name` varchar(25) NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mst_level` (`level_id`, `level_code`, `level_name`) VALUES
(1,	'SUP',	'Super Admin');

DROP TABLE IF EXISTS `mst_sensor`;
CREATE TABLE `mst_sensor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sensor_code` varchar(10) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `sensor_number` smallint(6) NOT NULL,
  `description` text NOT NULL,
  `sensor_type` varchar(10) NOT NULL,
  `floor_id` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedBy` int(11) NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mst_sensor` (`id`, `sensor_code`, `ip_address`, `sensor_number`, `description`, `sensor_type`, `floor_id`, `createdBy`, `createdAt`, `updatedBy`, `updatedAt`) VALUES
(1,	'PGS LG',	'111.18.17.26',	2,	'',	'OUT',	8,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(2,	'PGS P1',	'111.18.17.25',	3,	'',	'IN',	2,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(3,	'PGS P2',	'111.18.17.21',	4,	'',	'IN',	3,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(4,	'PGS P3',	'111.18.17.22',	3,	'',	'IN',	4,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(5,	'PGS P4',	'111.18.17.23',	3,	'',	'OUT',	5,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(6,	'PGS P5',	'111.18.17.24',	3,	'',	'OUT',	6,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(7,	'PGS P6',	'111.18.17.34',	3,	'',	'OUT',	7,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(8,	'PGS P7',	'111.18.17.26',	3,	'',	'OUT',	8,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(13,	'PGS LG',	'111.18.17.26',	3,	'',	'IN',	8,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(14,	'PGS P2',	'111.18.17.21',	5,	'',	'OUT',	3,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(15,	'PGS P1',	'111.18.17.25',	5,	'',	'OUT',	2,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(16,	'PGS P3',	'111.18.17.22',	2,	'',	'OUT',	4,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(17,	'PGS P4',	'111.18.17.23',	2,	'',	'IN',	5,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(18,	'PGS P5',	'111.18.17.24',	2,	'',	'IN',	6,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(19,	'PGS P6',	'111.18.17.34',	2,	'',	'IN',	7,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00'),
(20,	'PGS P7',	'111.18.17.99',	2,	'',	'IN',	8,	1,	'2022-03-22 08:14:00',	1,	'2022-03-22 08:14:00');

DROP TABLE IF EXISTS `mst_user`;
CREATE TABLE `mst_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_full_name` varchar(255) NOT NULL,
  `level_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mst_user` (`user_id`, `username`, `password`, `user_full_name`, `level_id`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted`) VALUES
(1,	'it.nipah@centrepark.co.id',	'00452a019cdb096d20145b491474b037',	'Teknisi IT',	1,	1,	'2022-03-22 08:15:26',	1,	'2022-03-22 08:15:26',	0);

-- 2025-02-21 07:42:39
