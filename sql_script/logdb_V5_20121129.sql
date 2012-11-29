/*
Navicat MySQL Data Transfer

Source Server         : My9finance[127.0.0.1]
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : logdb

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-11-29 19:25:47
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `log`
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
`ID`  smallint(4) NOT NULL AUTO_INCREMENT ,
`U_id`  smallint(4) NULL DEFAULT NULL ,
`F_id`  smallint(4) NULL DEFAULT NULL ,
`log`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`info`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`G_logid`  int(8) NULL DEFAULT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=100000

;

-- ----------------------------
-- Table structure for `log_sql`
-- ----------------------------
DROP TABLE IF EXISTS `log_sql`;
CREATE TABLE `log_sql` (
`ID`  smallint(4) NOT NULL AUTO_INCREMENT ,
`U_id`  smallint(4) NOT NULL ,
`F_id`  smallint(4) NOT NULL ,
`log`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`C_date`  char(12) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`ID`)
)
ENGINE=MyISAM
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=100000

;

-- ----------------------------
-- Auto increment value for `log`
-- ----------------------------
ALTER TABLE `log` AUTO_INCREMENT=100000;

-- ----------------------------
-- Auto increment value for `log_sql`
-- ----------------------------
ALTER TABLE `log_sql` AUTO_INCREMENT=100000;
