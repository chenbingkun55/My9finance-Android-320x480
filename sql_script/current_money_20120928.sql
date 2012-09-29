/*
Navicat MySQL Data Transfer

Source Server         : My9finance[127.0.0.1]
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : my9finance

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-09-29 16:31:39
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `current_money`
-- ----------------------------
DROP TABLE IF EXISTS `current_money`;
CREATE TABLE `current_money` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(4) NOT NULL,
  `family_num` int(4) NOT NULL,
  `money` float(8,2) DEFAULT NULL,
  `create_date` char(12) NOT NULL,
  `last_date` char(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of current_money
-- ----------------------------
