/*
Navicat MySQL Data Transfer

Source Server         : My9finance[127.0.0.1]
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : my9finance

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-09-27 15:20:13
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `bug_corde`
-- ----------------------------
DROP TABLE IF EXISTS `bug_corde`;
CREATE TABLE `bug_corde` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) DEFAULT '0',
  `family_num` int(4) DEFAULT '0',
  `bug_type` char(12) NOT NULL,
  `bug_level` tinyint(2) NOT NULL,
  `bug_title` varchar(80) DEFAULT NULL,
  `bug_centent` text,
  `create_date` char(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bug_corde
-- ----------------------------
