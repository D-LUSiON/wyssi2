/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for wyssi2
DROP DATABASE IF EXISTS `wyssi2`;
CREATE DATABASE IF NOT EXISTS `wyssi2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `wyssi2`;


-- Dumping structure for table wyssi2.system_interfaces
DROP TABLE IF EXISTS `system_interfaces`;
CREATE TABLE IF NOT EXISTS `system_interfaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Title of the interface',
  `sys_path` varchar(50) CHARACTER SET utf8 DEFAULT '' COMMENT 'System name used for accessing the interface',
  `type` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_system_interfaces_system_interface_types` (`type`),
  CONSTRAINT `FK_system_interfaces_system_interface_types` FOREIGN KEY (`type`) REFERENCES `system_interface_types` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping structure for table wyssi2.system_interface_types
DROP TABLE IF EXISTS `system_interface_types`;
CREATE TABLE IF NOT EXISTS `system_interface_types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `interface_type_title` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'Title of the interface type',
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping structure for table wyssi2.themes
DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme_name` varchar(50) NOT NULL,
  `theme_path` varchar(50) NOT NULL,
  `theme_type` varchar(50) NOT NULL DEFAULT 'public',
  `current` int(1) NOT NULL DEFAULT '0',
  `preview_image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
