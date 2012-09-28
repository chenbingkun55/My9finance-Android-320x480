/*
Navicat MySQL Data Transfer

Source Server         : My9finance[127.0.0.1]
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : logdb

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-09-28 18:00:03
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `log_201209`
-- ----------------------------
DROP TABLE IF EXISTS `log_201209`;
CREATE TABLE `log_201209` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(4) DEFAULT NULL,
  `family_num` smallint(4) DEFAULT NULL,
  `log` text,
  `info` text,
  `global_logid` int(8) DEFAULT NULL,
  `create_date` char(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=653 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_201209
-- ----------------------------

-- ----------------------------
-- Table structure for `log_sql_201209`
-- ----------------------------
DROP TABLE IF EXISTS `log_sql_201209`;
CREATE TABLE `log_sql_201209` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(4) NOT NULL,
  `family_num` smallint(4) NOT NULL,
  `log` text NOT NULL,
  `create_date` char(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1298 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_sql_201209
-- ----------------------------
