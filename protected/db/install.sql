-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------

-- -------------------------------------------

-- START BACKUP

-- -------------------------------------------

-- TABLE `tbl_email_queue`

-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_email_queue`;
CREATE TABLE IF NOT EXISTS `tbl_email_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_email` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_published` datetime DEFAULT NULL,
  `last_attempt` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `attempts` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `model_type` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_account_id` int(11) DEFAULT NULL,
  `message_id` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX(`from_email`),
  INDEX(`to_email`),
  INDEX(`state_id`),
  INDEX(`model_id`),
  INDEX(`model_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------

-- TABLE `tbl_feed`

-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_feed`;
CREATE TABLE IF NOT EXISTS `tbl_feed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci,
  `model_type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  INDEX(`model_type`),
  INDEX(`model_id`),
  INDEX(`state_id`),
  INDEX(`created_on`),
  KEY `fk_feed_created_by_id` (`created_by_id`),
  CONSTRAINT `fk_feed_created_by_id` FOREIGN KEY (`created_by_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_file`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_file`;
CREATE TABLE IF NOT EXISTS `tbl_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `model_type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `created_by_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX(`name`),
  INDEX(`model_type`),
  INDEX(`model_id`),
  INDEX(`create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `tbl_notice`
-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_notice`;
CREATE TABLE IF NOT EXISTS `tbl_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `model_type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX(`title`),
  INDEX(`model_type`),
  INDEX(`model_id`),
  INDEX(`created_on`),
  KEY `fk_notice_created_by` (`created_by_id`),
  CONSTRAINT `fk_notice_created_by` FOREIGN KEY (`created_by_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- TABLE `tbl_login_history`

-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_login_history`;
CREATE TABLE IF NOT EXISTS `tbl_login_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `failer_reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  INDEX(`user_id`),
  INDEX(`user_ip`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------

-- TABLE `tbl_notice`

-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_notice`;
CREATE TABLE IF NOT EXISTS `tbl_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `model_type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `state_id` int(11) DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `created_by_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notice_created_by` (`created_by_id`),
  CONSTRAINT `fk_notice_created_by` FOREIGN KEY (`created_by_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------

-- TABLE `tbl_setting`

-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_setting`;
CREATE TABLE IF NOT EXISTS `tbl_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `type_id` varchar(255) NOT NULL DEFAULT '0',
  `state_id` int(11) DEFAULT '0',
  `created_by_id` int(11) DEFAULT NULL,
   PRIMARY KEY (`id`),
   INDEX(`key`),
   INDEX(`title`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- -------------------------------------------

-- TABLE `tbl_user`

-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` int(11) DEFAULT '0',
  `about_me` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT '0',
  `profile_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tos` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT '0',
  `last_visit_time` datetime DEFAULT NULL,
  `last_action_time` datetime DEFAULT NULL,
  `last_password_change` datetime DEFAULT NULL,
  `login_error_count` int(11) DEFAULT NULL,
  `activation_key` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_token` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX(`full_name`),
  INDEX(`email`),
  INDEX(`role_id`),
  INDEX(`state_id`),
  INDEX(`created_on`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------

-- TABLE `tbl_category`

-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) COLLATE utf8_unicode_ci,
  `description` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `image_file` varchar(255) DEFAULT NULL,
  `state_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  INDEX(`created_on`),
  KEY `fk_category_created_by_id` (`created_by_id`),
  CONSTRAINT `fk_category_created_by_id` FOREIGN KEY (`created_by_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------

-- TABLE `tbl_product`

-- -------------------------------------------
DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `state_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  INDEX(`state_id`),
  INDEX(`created_on`),
  KEY `fk_product_category_id` (`category_id`),
  CONSTRAINT `fk_product_created_by_id` FOREIGN KEY (`created_by_id`) REFERENCES `tbl_category` (`id`),
  KEY `fk_product_created_by_id` (`created_by_id`),
  CONSTRAINT `fk_product_id_created_by_id` FOREIGN KEY (`created_by_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- -------------------------------------------

				    
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP

-- -------------------------------------------
