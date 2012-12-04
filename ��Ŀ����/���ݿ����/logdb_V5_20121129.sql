/*
Navicat MySQL Data Transfer

Source Server         : My9finance[127.0.0.1]
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : logdb

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-11-29 19:36:29
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `log`
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `ID` smallint(4) NOT NULL AUTO_INCREMENT,
  `U_id` smallint(4) DEFAULT NULL,
  `F_id` smallint(4) DEFAULT NULL,
  `log` text,
  `info` text,
  `G_logid` int(8) DEFAULT NULL,
  `C_date` char(12) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log
-- ----------------------------

-- ----------------------------
-- Table structure for `log_sql`
-- ----------------------------
DROP TABLE IF EXISTS `log_sql`;
CREATE TABLE `log_sql` (
  `ID` smallint(4) NOT NULL AUTO_INCREMENT,
  `U_id` smallint(4) NOT NULL,
  `F_id` smallint(4) NOT NULL,
  `log` text NOT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_sql
-- ----------------------------
