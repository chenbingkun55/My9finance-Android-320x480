/*
Navicat MySQL Data Transfer

Source Server         : My9finance[127.0.0.1]
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : my9finance

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-11-29 19:32:05
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
`ID`  smallint(4) NOT NULL AUTO_INCREMENT ,
`F_ID`  smallint(4) NOT NULL ,
`Store`  smallint(4) NULL DEFAULT NULL ,
`Is_display`  smallint(1) NULL DEFAULT 1 ,
`A_name`  char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1000

;

-- ----------------------------
-- Table structure for `bank_card`
-- ----------------------------
DROP TABLE IF EXISTS `bank_card`;
CREATE TABLE `bank_card` (
`ID`  tinyint(2) NOT NULL AUTO_INCREMENT ,
`U_id`  smallint(4) NULL DEFAULT NULL ,
`F_id`  int(4) NULL DEFAULT NULL ,
`C_name`  char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`C_num`  char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`C_type`  char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`C_addr`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`Money`  double(16,2) NOT NULL DEFAULT 0.00 ,
`Store`  tinyint(2) NOT NULL DEFAULT 0 ,
`Is_disable`  tinyint(1) NOT NULL DEFAULT 0 ,
`Notes`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1000

;

-- ----------------------------
-- Table structure for `bug`
-- ----------------------------
DROP TABLE IF EXISTS `bug`;
CREATE TABLE `bug` (
`ID`  int(4) NOT NULL AUTO_INCREMENT ,
`U_id`  int(4) NULL DEFAULT 0 ,
`F_id`  int(4) NULL DEFAULT 0 ,
`B_type`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`B_level`  tinyint(2) NOT NULL ,
`B_title`  varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`B_centent`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`Status`  tinyint(2) NOT NULL ,
PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1000

;

-- ----------------------------
-- Table structure for `family`
-- ----------------------------
DROP TABLE IF EXISTS `family`;
CREATE TABLE `family` (
`Id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`Is_d`  smallint(2) NULL DEFAULT NULL ,
`F_name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`F_alias`  char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`L_Pass`  char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`C_pass`  char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`A_pass`  char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`Notes`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`L_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`L_sum`  int(8) NULL DEFAULT NULL ,
`Session`  char(128) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`Id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1000

;

-- ----------------------------
-- Table structure for `family_munber`
-- ----------------------------
DROP TABLE IF EXISTS `family_munber`;
CREATE TABLE `family_munber` (
`Id`  smallint(4) NOT NULL AUTO_INCREMENT ,
`Is_d`  smallint(2) NULL DEFAULT 0 ,
`U_name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`U_alias`  char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`F_id`  int(4) NOT NULL ,
`Notes`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`L_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`Skin`  smallint(2) NULL DEFAULT 1 ,
`L_sum`  int(8) NULL DEFAULT 0 ,
`Email`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`QQ`  varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`Id`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1000

;

-- ----------------------------
-- Table structure for `in_corde`
-- ----------------------------
DROP TABLE IF EXISTS `in_corde`;
CREATE TABLE `in_corde` (
`ID`  int(6) NOT NULL AUTO_INCREMENT ,
`Money`  float(6,2) NOT NULL ,
`U_id`  smallint(4) NOT NULL ,
`F_id`  smallint(4) NOT NULL ,
`B_id`  smallint(4) NOT NULL ,
`M_id`  smallint(4) NOT NULL ,
`S_id`  smallint(4) NOT NULL ,
`A_id`  smallint(4) NOT NULL ,
`Notes`  varchar(104) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1000

;

-- ----------------------------
-- Table structure for `in_mantype`
-- ----------------------------
DROP TABLE IF EXISTS `in_mantype`;
CREATE TABLE `in_mantype` (
`ID`  smallint(4) NOT NULL AUTO_INCREMENT ,
`F_id`  smallint(4) NOT NULL ,
`Store`  smallint(4) NULL DEFAULT NULL ,
`Is_d`  smallint(4) NULL DEFAULT NULL ,
`Name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1000

;

-- ----------------------------
-- Table structure for `in_subtype`
-- ----------------------------
DROP TABLE IF EXISTS `in_subtype`;
CREATE TABLE `in_subtype` (
`ID`  smallint(4) NOT NULL AUTO_INCREMENT ,
`F_id`  smallint(4) NOT NULL ,
`M_id`  smallint(4) NOT NULL ,
`Store`  smallint(4) NULL DEFAULT NULL ,
`Is_d`  smallint(1) NULL DEFAULT 1 ,
`Name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1000

;

-- ----------------------------
-- Table structure for `log_resolve`
-- ----------------------------
DROP TABLE IF EXISTS `log_resolve`;
CREATE TABLE `log_resolve` (
`ID`  smallint(4) NOT NULL AUTO_INCREMENT ,
`G_logid`  smallint(4) NOT NULL ,
`content`  char(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1000

;

-- ----------------------------
-- Table structure for `out_corde`
-- ----------------------------
DROP TABLE IF EXISTS `out_corde`;
CREATE TABLE `out_corde` (
`ID`  int(6) NOT NULL AUTO_INCREMENT ,
`Money`  float(6,2) NOT NULL ,
`U_id`  smallint(4) NOT NULL ,
`F_id`  smallint(4) NOT NULL ,
`B_id`  smallint(4) NOT NULL ,
`M_id`  smallint(4) NOT NULL ,
`S_id`  smallint(4) NOT NULL ,
`A_id`  smallint(4) NOT NULL ,
`Notes`  varchar(104) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1000

;

-- ----------------------------
-- Table structure for `out_mantype`
-- ----------------------------
DROP TABLE IF EXISTS `out_mantype`;
CREATE TABLE `out_mantype` (
`ID`  smallint(4) NOT NULL AUTO_INCREMENT ,
`F_id`  smallint(4) NOT NULL ,
`Store`  smallint(4) NULL DEFAULT NULL ,
`Is_d`  smallint(4) NULL DEFAULT NULL ,
`Name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1000

;

-- ----------------------------
-- Table structure for `out_subtype`
-- ----------------------------
DROP TABLE IF EXISTS `out_subtype`;
CREATE TABLE `out_subtype` (
`ID`  smallint(4) NOT NULL AUTO_INCREMENT ,
`F_id`  smallint(4) NOT NULL ,
`M_id`  smallint(4) NOT NULL ,
`Store`  smallint(4) NULL DEFAULT NULL ,
`Is_d`  smallint(1) NULL DEFAULT 1 ,
`Name`  char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1000

;

-- ----------------------------
-- Indexes structure for table `address`
-- ----------------------------
CREATE INDEX `user_id` ON `address`(`F_ID`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `address`
-- ----------------------------
ALTER TABLE `address` AUTO_INCREMENT=1000;

-- ----------------------------
-- Auto increment value for `bank_card`
-- ----------------------------
ALTER TABLE `bank_card` AUTO_INCREMENT=1000;

-- ----------------------------
-- Auto increment value for `bug`
-- ----------------------------
ALTER TABLE `bug` AUTO_INCREMENT=1000;

-- ----------------------------
-- Auto increment value for `family`
-- ----------------------------
ALTER TABLE `family` AUTO_INCREMENT=1000;

-- ----------------------------
-- Indexes structure for table `family_munber`
-- ----------------------------
CREATE UNIQUE INDEX `username` ON `family_munber`(`U_name`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `family_munber`
-- ----------------------------
ALTER TABLE `family_munber` AUTO_INCREMENT=1000;

-- ----------------------------
-- Indexes structure for table `in_corde`
-- ----------------------------
CREATE INDEX `user_id` ON `in_corde`(`U_id`) USING BTREE ;
CREATE INDEX `group_id` ON `in_corde`(`F_id`) USING BTREE ;
CREATE INDEX `out_mantype_id` ON `in_corde`(`M_id`) USING BTREE ;
CREATE INDEX `out_subtype_id` ON `in_corde`(`S_id`) USING BTREE ;
CREATE INDEX `addr_id` ON `in_corde`(`A_id`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `in_corde`
-- ----------------------------
ALTER TABLE `in_corde` AUTO_INCREMENT=1000;

-- ----------------------------
-- Indexes structure for table `in_mantype`
-- ----------------------------
CREATE INDEX `user_id` ON `in_mantype`(`F_id`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `in_mantype`
-- ----------------------------
ALTER TABLE `in_mantype` AUTO_INCREMENT=1000;

-- ----------------------------
-- Indexes structure for table `in_subtype`
-- ----------------------------
CREATE INDEX `man_id` ON `in_subtype`(`M_id`) USING BTREE ;
CREATE INDEX `user_id` ON `in_subtype`(`F_id`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `in_subtype`
-- ----------------------------
ALTER TABLE `in_subtype` AUTO_INCREMENT=1000;

-- ----------------------------
-- Auto increment value for `log_resolve`
-- ----------------------------
ALTER TABLE `log_resolve` AUTO_INCREMENT=1000;

-- ----------------------------
-- Indexes structure for table `out_corde`
-- ----------------------------
CREATE INDEX `user_id` ON `out_corde`(`U_id`) USING BTREE ;
CREATE INDEX `group_id` ON `out_corde`(`F_id`) USING BTREE ;
CREATE INDEX `out_mantype_id` ON `out_corde`(`M_id`) USING BTREE ;
CREATE INDEX `out_subtype_id` ON `out_corde`(`S_id`) USING BTREE ;
CREATE INDEX `addr_id` ON `out_corde`(`A_id`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `out_corde`
-- ----------------------------
ALTER TABLE `out_corde` AUTO_INCREMENT=1000;

-- ----------------------------
-- Indexes structure for table `out_mantype`
-- ----------------------------
CREATE INDEX `user_id` ON `out_mantype`(`F_id`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `out_mantype`
-- ----------------------------
ALTER TABLE `out_mantype` AUTO_INCREMENT=1000;

-- ----------------------------
-- Indexes structure for table `out_subtype`
-- ----------------------------
CREATE INDEX `man_id` ON `out_subtype`(`M_id`) USING BTREE ;
CREATE INDEX `user_id` ON `out_subtype`(`F_id`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `out_subtype`
-- ----------------------------
ALTER TABLE `out_subtype` AUTO_INCREMENT=1000;
