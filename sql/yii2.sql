# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.21)
# Database: pack
# Generation Time: 2017-04-27 02:43:56 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table auth_assignment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_assignment`;

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`)
VALUES
	('最高权限(谨慎分配)','8',1481357307),
	('管理员','7',1481356474),
	('管理员','8',1481357304),
	('管理员','9',1492854184);

/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table auth_item
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_item`;

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`)
VALUES
	('/*',2,NULL,NULL,NULL,1481270331,1481270331),
	('/base/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/debug/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/debug/default/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/debug/default/db-explain',2,NULL,NULL,NULL,1492861408,1492861408),
	('/debug/default/download-mail',2,NULL,NULL,NULL,1492861408,1492861408),
	('/debug/default/index',2,NULL,NULL,NULL,1492861408,1492861408),
	('/debug/default/toolbar',2,NULL,NULL,NULL,1492861408,1492861408),
	('/debug/default/view',2,NULL,NULL,NULL,1492861408,1492861408),
	('/error/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/error/error',2,NULL,NULL,NULL,1492861408,1492861408),
	('/gii/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/gii/default/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/gii/default/action',2,NULL,NULL,NULL,1492861408,1492861408),
	('/gii/default/diff',2,NULL,NULL,NULL,1492861408,1492861408),
	('/gii/default/index',2,NULL,NULL,NULL,1492861408,1492861408),
	('/gii/default/preview',2,NULL,NULL,NULL,1492861408,1492861408),
	('/gii/default/view',2,NULL,NULL,NULL,1492861408,1492861408),
	('/gridview/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/gridview/export/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/gridview/export/download',2,NULL,NULL,NULL,1492861408,1492861408),
	('/main/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/main/captcha',2,NULL,NULL,NULL,1492861408,1492861408),
	('/main/index',2,NULL,NULL,NULL,1492861408,1492861408),
	('/main/login',2,NULL,NULL,NULL,1492861408,1492861408),
	('/main/logout',2,NULL,NULL,NULL,1492861408,1492861408),
	('/main/switch-language',2,NULL,NULL,NULL,1492861408,1492861408),
	('/password/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/password/change-password',2,NULL,NULL,NULL,1492861408,1492861408),
	('/password/request-password-reset',2,NULL,NULL,NULL,1492861408,1492861408),
	('/password/reset-password',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/assignment/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/assignment/assign',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/assignment/index',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/assignment/revoke',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/assignment/view',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/default/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/default/index',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/menu/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/menu/create',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/menu/delete',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/menu/index',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/menu/update',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/menu/view',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/permission/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/permission/assign',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/permission/create',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/permission/delete',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/permission/index',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/permission/remove',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/permission/update',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/permission/view',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/role/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/role/assign',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/role/create',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/role/delete',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/role/index',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/role/remove',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/role/update',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/role/view',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/route/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/route/assign',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/route/create',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/route/index',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/route/refresh',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/route/remove',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/rule/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/rule/create',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/rule/delete',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/rule/index',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/rule/update',2,NULL,NULL,NULL,1492861408,1492861408),
	('/rbac/rule/view',2,NULL,NULL,NULL,1492861408,1492861408),
	('/user/*',2,NULL,NULL,NULL,1492861408,1492861408),
	('/user/activate',2,NULL,NULL,NULL,1492861408,1492861408),
	('/user/create',2,NULL,NULL,NULL,1492861408,1492861408),
	('/user/delete',2,NULL,NULL,NULL,1492861408,1492861408),
	('/user/index',2,NULL,NULL,NULL,1492861408,1492861408),
	('/user/update',2,NULL,NULL,NULL,1492861408,1492861408),
	('/user/view',2,NULL,NULL,NULL,1492861408,1492861408),
	('最高权限(谨慎分配)',2,NULL,NULL,NULL,1481273112,1486285918),
	('管理员',1,'管理员',NULL,NULL,1481352032,1481352032);

/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table auth_item_child
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_item_child`;

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;

INSERT INTO `auth_item_child` (`parent`, `child`)
VALUES
	('最高权限(谨慎分配)','/*'),
	('管理员','最高权限(谨慎分配)');

/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table auth_rule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `auth_rule`;

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  `icon` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`, `icon`)
VALUES
	(1,'设置',NULL,NULL,1,NULL,'fa-dashboard'),
	(2,'菜单列表',1,'/rbac/menu/index',1,NULL,NULL),
	(3,'创建菜单',1,'/rbac/menu/create',2,NULL,NULL),
	(4,'权限列表',1,'/rbac/permission/index',5,NULL,NULL),
	(5,'创建权限',1,'/rbac/permission/create',6,NULL,NULL),
	(6,'角色列表',1,'/rbac/role/index',3,NULL,NULL),
	(7,'创建角色',1,'/rbac/role/create',4,NULL,NULL),
	(8,'路由配置',1,'/rbac/route/index',7,NULL,NULL),
	(9,'用户',NULL,NULL,2,NULL,'fa-user'),
	(10,'用户列表',9,'/user/index',1,NULL,NULL),
	(11,'创建用户',9,'/user/create',2,NULL,NULL),
	(12,'修改密码',1,'/password/change-password',8,NULL,NULL);

/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`)
VALUES
	(7,'admin','70zfm1wNWIgDMxSjl1LAvadv6p8YSdwp','$2y$13$rq6JhVHSBBcqVZ7xwI6zduzcG.Gb/L./oUXOEg5pFlZj0cLpes7Km','VB14eyWpi8uW-4RA9MQRAo0my8e6D0wH_1492828078','yuzhwe@163.com',10,1433496391,1493260852);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
