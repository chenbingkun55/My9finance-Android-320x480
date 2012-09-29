/*
Navicat MySQL Data Transfer

Source Server         : My9finance[127.0.0.1]
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : my9finance

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-09-29 16:41:10
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`family_num`  smallint(4) NOT NULL ,
`store`  smallint(4) NULL DEFAULT NULL ,
`is_display`  smallint(1) NULL DEFAULT 1 ,
`name`  char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`create_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=354

;

-- ----------------------------
-- Table structure for `bank_card`
-- ----------------------------
DROP TABLE IF EXISTS `bank_card`;
CREATE TABLE `bank_card` (
`id`  tinyint(2) NOT NULL AUTO_INCREMENT ,
`user_id`  smallint(4) NULL DEFAULT NULL ,
`family_num`  int(4) NULL DEFAULT NULL ,
`card_name`  char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`card_num`  char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`card_type`  char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`card_addr`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`money`  double(16,2) NOT NULL DEFAULT 0.00 ,
`year_out`  float(4,2) NULL DEFAULT 0.00 ,
`year_in`  float(4,2) NULL DEFAULT 0.00 ,
`store`  tinyint(2) NOT NULL DEFAULT 0 ,
`is_disable`  tinyint(1) NOT NULL DEFAULT 0 ,
`notes`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`create_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=7

;

-- ----------------------------
-- Table structure for `bug_corde`
-- ----------------------------
DROP TABLE IF EXISTS `bug_corde`;
CREATE TABLE `bug_corde` (
`id`  int(4) NOT NULL AUTO_INCREMENT ,
`user_id`  int(4) NULL DEFAULT 0 ,
`family_num`  int(4) NULL DEFAULT 0 ,
`bug_type`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`bug_level`  tinyint(2) NOT NULL ,
`bug_title`  varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`bug_centent`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`create_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`status`  tinyint(2) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=10

;

-- ----------------------------
-- Table structure for `current_money`
-- ----------------------------
DROP TABLE IF EXISTS `current_money`;
CREATE TABLE `current_money` (
`id`  int(4) NOT NULL AUTO_INCREMENT ,
`user_id`  smallint(4) NOT NULL ,
`family_num`  int(4) NOT NULL ,
`money`  float(8,2) NULL DEFAULT NULL ,
`create_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`last_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=8

;

-- ----------------------------
-- Table structure for `in_corde`
-- ----------------------------
DROP TABLE IF EXISTS `in_corde`;
CREATE TABLE `in_corde` (
`id`  int(6) NOT NULL AUTO_INCREMENT ,
`money`  float(6,2) NOT NULL ,
`user_id`  smallint(4) NOT NULL ,
`family_num`  smallint(4) NOT NULL ,
`mantype_id`  smallint(4) NOT NULL ,
`subtype_id`  smallint(4) NOT NULL ,
`addr_id`  smallint(4) NOT NULL ,
`notes`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`create_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=96

;

-- ----------------------------
-- Table structure for `in_mantype`
-- ----------------------------
DROP TABLE IF EXISTS `in_mantype`;
CREATE TABLE `in_mantype` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`family_num`  smallint(4) NOT NULL ,
`store`  smallint(4) NULL DEFAULT NULL ,
`is_display`  smallint(4) NULL DEFAULT NULL ,
`name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`create_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=163

;

-- ----------------------------
-- Table structure for `in_out_gather`
-- ----------------------------
DROP TABLE IF EXISTS `in_out_gather`;
CREATE TABLE `in_out_gather` (
`id`  int(6) NOT NULL AUTO_INCREMENT ,
`in_all`  double(8,2) NULL DEFAULT NULL ,
`out_all`  double(8,2) NULL DEFAULT NULL ,
`inout_all`  double(8,2) NULL DEFAULT NULL ,
`month_in`  double(8,2) NULL DEFAULT NULL ,
`month_out`  double(8,2) NULL DEFAULT NULL ,
`month_all`  double(8,2) NULL DEFAULT NULL ,
`year_in`  double(8,2) NULL DEFAULT NULL ,
`year_out`  double(8,2) NULL DEFAULT NULL ,
`year_all`  double(8,2) NULL DEFAULT NULL ,
`year`  smallint(4) NOT NULL DEFAULT 0 ,
`month`  smallint(4) NOT NULL DEFAULT 0 ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Table structure for `in_subtype`
-- ----------------------------
DROP TABLE IF EXISTS `in_subtype`;
CREATE TABLE `in_subtype` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`family_num`  smallint(4) NOT NULL ,
`man_id`  smallint(4) NOT NULL ,
`store`  smallint(4) NULL DEFAULT NULL ,
`is_display`  smallint(1) NULL DEFAULT 1 ,
`name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`create_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=240

;

-- ----------------------------
-- Table structure for `log_resolve`
-- ----------------------------
DROP TABLE IF EXISTS `log_resolve`;
CREATE TABLE `log_resolve` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`log_id`  smallint(4) NOT NULL ,
`content`  char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=102

;

-- ----------------------------
-- Table structure for `out_corde`
-- ----------------------------
DROP TABLE IF EXISTS `out_corde`;
CREATE TABLE `out_corde` (
`id`  int(6) NOT NULL AUTO_INCREMENT ,
`money`  float(6,2) NOT NULL ,
`user_id`  smallint(4) NOT NULL ,
`family_num`  smallint(4) NOT NULL ,
`mantype_id`  smallint(4) NOT NULL ,
`subtype_id`  smallint(4) NOT NULL ,
`addr_id`  smallint(4) NOT NULL ,
`notes`  varchar(104) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`create_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=2172

;

-- ----------------------------
-- Table structure for `out_mantype`
-- ----------------------------
DROP TABLE IF EXISTS `out_mantype`;
CREATE TABLE `out_mantype` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`family_num`  smallint(4) NOT NULL ,
`store`  smallint(4) NULL DEFAULT NULL ,
`is_display`  smallint(4) NULL DEFAULT NULL ,
`name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`create_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=432

;

-- ----------------------------
-- Table structure for `out_subtype`
-- ----------------------------
DROP TABLE IF EXISTS `out_subtype`;
CREATE TABLE `out_subtype` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`family_num`  smallint(4) NOT NULL ,
`man_id`  smallint(4) NOT NULL ,
`store`  smallint(4) NULL DEFAULT NULL ,
`is_display`  smallint(1) NULL DEFAULT 1 ,
`name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`create_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1669

;

-- ----------------------------
-- Table structure for `user_limit`
-- ----------------------------
DROP TABLE IF EXISTS `user_limit`;
CREATE TABLE `user_limit` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`user_id`  smallint(4) NOT NULL ,
`user_disable`  smallint(4) NOT NULL DEFAULT 0 ,
`group_disable`  smallint(4) NOT NULL DEFAULT 0 ,
`create_group_num`  smallint(4) NOT NULL DEFAULT 1 ,
`create_mantype_num`  smallint(4) NOT NULL DEFAULT 10 ,
`create_subtype_num`  smallint(4) NOT NULL DEFAULT 10 ,
`create_addr_num`  smallint(4) NOT NULL DEFAULT 10 ,
`attr_group_num`  smallint(4) NOT NULL DEFAULT 1 ,
`pass_size`  smallint(4) NOT NULL DEFAULT 0 ,
`pass_difficulty`  smallint(4) NOT NULL DEFAULT 0 ,
`pass_overdue`  datetime NULL DEFAULT NULL ,
`overdue_time`  datetime NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Table structure for `user_power`
-- ----------------------------
DROP TABLE IF EXISTS `user_power`;
CREATE TABLE `user_power` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`user_id`  smallint(4) NOT NULL ,
`add_mantype`  smallint(4) NOT NULL DEFAULT 0 ,
`alter_mantype`  smallint(4) NOT NULL DEFAULT 0 ,
`add_subtype`  smallint(4) NOT NULL DEFAULT 0 ,
`add_address`  smallint(4) NOT NULL DEFAULT 0 ,
`alter_address`  smallint(4) NOT NULL DEFAULT 0 ,
`add_in_corde`  smallint(4) NOT NULL DEFAULT 0 ,
`alter_in_corde`  smallint(4) NOT NULL DEFAULT 0 ,
`add_out_corde`  smallint(4) NOT NULL DEFAULT 0 ,
`alter_out_corde`  smallint(4) NOT NULL DEFAULT 0 ,
`report_all`  smallint(4) NOT NULL DEFAULT 0 ,
`create_group`  smallint(4) NOT NULL DEFAULT 0 ,
`search_disable`  smallint(4) NOT NULL DEFAULT 0 ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`is_disable`  smallint(2) NULL DEFAULT 0 ,
`username`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`user_alias`  char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`family_num`  int(4) NOT NULL ,
`family_adm`  tinyint(2) NOT NULL DEFAULT 0 ,
`password`  char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`clean_pass`  char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`notes`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`create_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`last_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`skin`  smallint(2) NULL DEFAULT 1 ,
`login_sum`  int(8) NULL DEFAULT 0 ,
`email`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`qq`  varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`session`  char(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=120

;

-- ----------------------------
-- Indexes structure for table `address`
-- ----------------------------
CREATE INDEX `user_id` ON `address`(`family_num`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `address`
-- ----------------------------
ALTER TABLE `address` AUTO_INCREMENT=354;

-- ----------------------------
-- Auto increment value for `bank_card`
-- ----------------------------
ALTER TABLE `bank_card` AUTO_INCREMENT=7;

-- ----------------------------
-- Auto increment value for `bug_corde`
-- ----------------------------
ALTER TABLE `bug_corde` AUTO_INCREMENT=10;

-- ----------------------------
-- Auto increment value for `current_money`
-- ----------------------------
ALTER TABLE `current_money` AUTO_INCREMENT=8;

-- ----------------------------
-- Indexes structure for table `in_corde`
-- ----------------------------
CREATE INDEX `user_id` ON `in_corde`(`user_id`) USING BTREE ;
CREATE INDEX `group_id` ON `in_corde`(`family_num`) USING BTREE ;
CREATE INDEX `in_mantype_id` ON `in_corde`(`mantype_id`) USING BTREE ;
CREATE INDEX `in_subtype_id` ON `in_corde`(`subtype_id`) USING BTREE ;
CREATE INDEX `addr_id` ON `in_corde`(`addr_id`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `in_corde`
-- ----------------------------
ALTER TABLE `in_corde` AUTO_INCREMENT=96;

-- ----------------------------
-- Indexes structure for table `in_mantype`
-- ----------------------------
CREATE INDEX `user_id` ON `in_mantype`(`family_num`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `in_mantype`
-- ----------------------------
ALTER TABLE `in_mantype` AUTO_INCREMENT=163;

-- ----------------------------
-- Auto increment value for `in_out_gather`
-- ----------------------------
ALTER TABLE `in_out_gather` AUTO_INCREMENT=1;

-- ----------------------------
-- Indexes structure for table `in_subtype`
-- ----------------------------
CREATE INDEX `man_id` ON `in_subtype`(`man_id`) USING BTREE ;
CREATE INDEX `user_id` ON `in_subtype`(`family_num`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `in_subtype`
-- ----------------------------
ALTER TABLE `in_subtype` AUTO_INCREMENT=240;

-- ----------------------------
-- Auto increment value for `log_resolve`
-- ----------------------------
ALTER TABLE `log_resolve` AUTO_INCREMENT=102;

-- ----------------------------
-- Indexes structure for table `out_corde`
-- ----------------------------
CREATE INDEX `user_id` ON `out_corde`(`user_id`) USING BTREE ;
CREATE INDEX `group_id` ON `out_corde`(`family_num`) USING BTREE ;
CREATE INDEX `out_mantype_id` ON `out_corde`(`mantype_id`) USING BTREE ;
CREATE INDEX `out_subtype_id` ON `out_corde`(`subtype_id`) USING BTREE ;
CREATE INDEX `addr_id` ON `out_corde`(`addr_id`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `out_corde`
-- ----------------------------
ALTER TABLE `out_corde` AUTO_INCREMENT=2172;

-- ----------------------------
-- Indexes structure for table `out_mantype`
-- ----------------------------
CREATE INDEX `user_id` ON `out_mantype`(`family_num`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `out_mantype`
-- ----------------------------
ALTER TABLE `out_mantype` AUTO_INCREMENT=432;

-- ----------------------------
-- Indexes structure for table `out_subtype`
-- ----------------------------
CREATE INDEX `man_id` ON `out_subtype`(`man_id`) USING BTREE ;
CREATE INDEX `user_id` ON `out_subtype`(`family_num`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `out_subtype`
-- ----------------------------
ALTER TABLE `out_subtype` AUTO_INCREMENT=1669;

-- ----------------------------
-- Indexes structure for table `user_limit`
-- ----------------------------
CREATE INDEX `user_id` ON `user_limit`(`user_id`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `user_limit`
-- ----------------------------
ALTER TABLE `user_limit` AUTO_INCREMENT=1;

-- ----------------------------
-- Indexes structure for table `user_power`
-- ----------------------------
CREATE INDEX `user_id` ON `user_power`(`user_id`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `user_power`
-- ----------------------------
ALTER TABLE `user_power` AUTO_INCREMENT=1;

-- ----------------------------
-- Indexes structure for table `users`
-- ----------------------------
CREATE UNIQUE INDEX `username` ON `users`(`username`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `users`
-- ----------------------------
ALTER TABLE `users` AUTO_INCREMENT=120;
