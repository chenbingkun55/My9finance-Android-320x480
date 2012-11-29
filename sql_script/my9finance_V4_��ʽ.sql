/*
Navicat MySQL Data Transfer

Source Server         : chenbk.gicp.net
Source Server Version : 50156
Source Host           : chenbk.gicp.net:3306
Source Database       : my9finance

Target Server Type    : MYSQL
Target Server Version : 50156
File Encoding         : 65001

Date: 2012-09-12 15:56:47
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`user_id`  smallint(4) NOT NULL ,
`store`  smallint(4) NULL DEFAULT NULL ,
`is_display`  smallint(1) NULL DEFAULT 1 ,
`name`  char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`create_date`  datetime NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=122

;

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`groupname`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`group_alias`  char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`groupadmin_id`  smallint(4) NOT NULL ,
`password`  char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`notes`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`create_date`  datetime NOT NULL ,
`last_date`  datetime NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=18

;

-- ----------------------------
-- Table structure for `in_corde`
-- ----------------------------
DROP TABLE IF EXISTS `in_corde`;
CREATE TABLE `in_corde` (
`id`  int(6) NOT NULL AUTO_INCREMENT ,
`money`  float(6,2) NOT NULL ,
`user_id`  smallint(4) NOT NULL ,
`group_id`  smallint(4) NOT NULL ,
`mantype_id`  smallint(4) NOT NULL ,
`subtype_id`  smallint(4) NOT NULL ,
`addr_id`  smallint(4) NOT NULL ,
`notes`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`create_date`  datetime NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=81

;

-- ----------------------------
-- Table structure for `in_mantype`
-- ----------------------------
DROP TABLE IF EXISTS `in_mantype`;
CREATE TABLE `in_mantype` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`user_id`  smallint(4) NOT NULL ,
`store`  smallint(4) NULL DEFAULT NULL ,
`is_display`  smallint(4) NULL DEFAULT NULL ,
`name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`create_date`  datetime NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=56

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
`user_id`  smallint(4) NOT NULL ,
`man_id`  smallint(4) NOT NULL ,
`store`  smallint(4) NULL DEFAULT NULL ,
`is_display`  smallint(1) NULL DEFAULT 1 ,
`name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`create_date`  datetime NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=62

;

-- ----------------------------
-- Table structure for `log_201209`
-- ----------------------------
DROP TABLE IF EXISTS `log_201209`;
CREATE TABLE `log_201209` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`user_id`  smallint(4) NULL DEFAULT NULL ,
`group_id`  smallint(4) NULL DEFAULT NULL ,
`log`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`info`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`global_logid`  int(8) NULL DEFAULT NULL ,
`create_date`  datetime NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=4

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
AUTO_INCREMENT=84

;

-- ----------------------------
-- Table structure for `log_sql_201209`
-- ----------------------------
DROP TABLE IF EXISTS `log_sql_201209`;
CREATE TABLE `log_sql_201209` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`user_id`  smallint(4) NOT NULL ,
`group_id`  smallint(4) NOT NULL ,
`log`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`create_date`  datetime NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=12

;

-- ----------------------------
-- Table structure for `out_corde`
-- ----------------------------
DROP TABLE IF EXISTS `out_corde`;
CREATE TABLE `out_corde` (
`id`  int(6) NOT NULL AUTO_INCREMENT ,
`money`  float(6,2) NOT NULL ,
`user_id`  smallint(4) NOT NULL ,
`group_id`  smallint(4) NOT NULL ,
`mantype_id`  smallint(4) NOT NULL ,
`subtype_id`  smallint(4) NOT NULL ,
`addr_id`  smallint(4) NOT NULL ,
`notes`  varchar(104) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`create_date`  datetime NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=2644

;

-- ----------------------------
-- Table structure for `out_mantype`
-- ----------------------------
DROP TABLE IF EXISTS `out_mantype`;
CREATE TABLE `out_mantype` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`user_id`  smallint(4) NOT NULL ,
`store`  smallint(4) NULL DEFAULT NULL ,
`is_display`  smallint(4) NULL DEFAULT NULL ,
`name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`create_date`  datetime NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=130

;

-- ----------------------------
-- Table structure for `out_subtype`
-- ----------------------------
DROP TABLE IF EXISTS `out_subtype`;
CREATE TABLE `out_subtype` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`user_id`  smallint(4) NOT NULL ,
`man_id`  smallint(4) NOT NULL ,
`store`  smallint(4) NULL DEFAULT NULL ,
`is_display`  smallint(1) NULL DEFAULT 1 ,
`name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`create_date`  datetime NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=549

;

-- ----------------------------
-- Table structure for `user_group`
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
`id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`user_id`  smallint(4) NOT NULL ,
`group_id`  smallint(4) NOT NULL ,
`granddad`  smallint(4) NOT NULL DEFAULT 0 ,
`paternity`  smallint(4) NOT NULL DEFAULT 0 ,
`brother`  smallint(4) NOT NULL DEFAULT 0 ,
`consort`  smallint(4) NOT NULL DEFAULT 0 ,
`friend`  smallint(4) NOT NULL DEFAULT 0 ,
`colleague`  smallint(4) NOT NULL DEFAULT 0 ,
`notes`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`create_date`  datetime NOT NULL ,
`disable`  smallint(1) NOT NULL DEFAULT 1 ,
PRIMARY KEY (`id`, `user_id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=39

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
`is_disable`  smallint(2) NULL DEFAULT NULL ,
`username`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`user_alias`  char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`password`  char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`notes`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`create_date`  datetime NOT NULL ,
`last_date`  datetime NOT NULL ,
`skin`  smallint(2) NULL DEFAULT 0 ,
`session`  char(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=24

;

-- ----------------------------
-- Indexes structure for table `address`
-- ----------------------------
CREATE INDEX `user_id` USING BTREE ON `address`(`user_id`) ;

-- ----------------------------
-- Auto increment value for `address`
-- ----------------------------
ALTER TABLE `address` AUTO_INCREMENT=122;

-- ----------------------------
-- Indexes structure for table `groups`
-- ----------------------------
CREATE UNIQUE INDEX `groupname` USING BTREE ON `groups`(`groupname`) ;
CREATE INDEX `groupadmin_id` USING BTREE ON `groups`(`groupadmin_id`) ;

-- ----------------------------
-- Auto increment value for `groups`
-- ----------------------------
ALTER TABLE `groups` AUTO_INCREMENT=18;

-- ----------------------------
-- Indexes structure for table `in_corde`
-- ----------------------------
CREATE INDEX `user_id` USING BTREE ON `in_corde`(`user_id`) ;
CREATE INDEX `group_id` USING BTREE ON `in_corde`(`group_id`) ;
CREATE INDEX `in_mantype_id` USING BTREE ON `in_corde`(`mantype_id`) ;
CREATE INDEX `in_subtype_id` USING BTREE ON `in_corde`(`subtype_id`) ;
CREATE INDEX `addr_id` USING BTREE ON `in_corde`(`addr_id`) ;

-- ----------------------------
-- Auto increment value for `in_corde`
-- ----------------------------
ALTER TABLE `in_corde` AUTO_INCREMENT=81;

-- ----------------------------
-- Indexes structure for table `in_mantype`
-- ----------------------------
CREATE INDEX `user_id` USING BTREE ON `in_mantype`(`user_id`) ;

-- ----------------------------
-- Auto increment value for `in_mantype`
-- ----------------------------
ALTER TABLE `in_mantype` AUTO_INCREMENT=56;

-- ----------------------------
-- Auto increment value for `in_out_gather`
-- ----------------------------
ALTER TABLE `in_out_gather` AUTO_INCREMENT=1;

-- ----------------------------
-- Indexes structure for table `in_subtype`
-- ----------------------------
CREATE INDEX `man_id` USING BTREE ON `in_subtype`(`man_id`) ;
CREATE INDEX `user_id` USING BTREE ON `in_subtype`(`user_id`) ;

-- ----------------------------
-- Auto increment value for `in_subtype`
-- ----------------------------
ALTER TABLE `in_subtype` AUTO_INCREMENT=62;

-- ----------------------------
-- Auto increment value for `log_201209`
-- ----------------------------
ALTER TABLE `log_201209` AUTO_INCREMENT=4;

-- ----------------------------
-- Auto increment value for `log_resolve`
-- ----------------------------
ALTER TABLE `log_resolve` AUTO_INCREMENT=84;

-- ----------------------------
-- Auto increment value for `log_sql_201209`
-- ----------------------------
ALTER TABLE `log_sql_201209` AUTO_INCREMENT=12;

-- ----------------------------
-- Indexes structure for table `out_corde`
-- ----------------------------
CREATE INDEX `user_id` USING BTREE ON `out_corde`(`user_id`) ;
CREATE INDEX `group_id` USING BTREE ON `out_corde`(`group_id`) ;
CREATE INDEX `out_mantype_id` USING BTREE ON `out_corde`(`mantype_id`) ;
CREATE INDEX `out_subtype_id` USING BTREE ON `out_corde`(`subtype_id`) ;
CREATE INDEX `addr_id` USING BTREE ON `out_corde`(`addr_id`) ;

-- ----------------------------
-- Auto increment value for `out_corde`
-- ----------------------------
ALTER TABLE `out_corde` AUTO_INCREMENT=2644;

-- ----------------------------
-- Indexes structure for table `out_mantype`
-- ----------------------------
CREATE INDEX `user_id` USING BTREE ON `out_mantype`(`user_id`) ;

-- ----------------------------
-- Auto increment value for `out_mantype`
-- ----------------------------
ALTER TABLE `out_mantype` AUTO_INCREMENT=130;

-- ----------------------------
-- Indexes structure for table `out_subtype`
-- ----------------------------
CREATE INDEX `man_id` USING BTREE ON `out_subtype`(`man_id`) ;
CREATE INDEX `user_id` USING BTREE ON `out_subtype`(`user_id`) ;

-- ----------------------------
-- Auto increment value for `out_subtype`
-- ----------------------------
ALTER TABLE `out_subtype` AUTO_INCREMENT=549;

-- ----------------------------
-- Indexes structure for table `user_group`
-- ----------------------------
CREATE UNIQUE INDEX `user_id` USING BTREE ON `user_group`(`user_id`) ;
CREATE INDEX `group_id` USING BTREE ON `user_group`(`group_id`) ;

-- ----------------------------
-- Auto increment value for `user_group`
-- ----------------------------
ALTER TABLE `user_group` AUTO_INCREMENT=39;

-- ----------------------------
-- Indexes structure for table `user_limit`
-- ----------------------------
CREATE INDEX `user_id` USING BTREE ON `user_limit`(`user_id`) ;

-- ----------------------------
-- Auto increment value for `user_limit`
-- ----------------------------
ALTER TABLE `user_limit` AUTO_INCREMENT=1;

-- ----------------------------
-- Indexes structure for table `user_power`
-- ----------------------------
CREATE INDEX `user_id` USING BTREE ON `user_power`(`user_id`) ;

-- ----------------------------
-- Auto increment value for `user_power`
-- ----------------------------
ALTER TABLE `user_power` AUTO_INCREMENT=1;

-- ----------------------------
-- Indexes structure for table `users`
-- ----------------------------
CREATE UNIQUE INDEX `username` USING BTREE ON `users`(`username`) ;

-- ----------------------------
-- Auto increment value for `users`
-- ----------------------------
ALTER TABLE `users` AUTO_INCREMENT=24;
