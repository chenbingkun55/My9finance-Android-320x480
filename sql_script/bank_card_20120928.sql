/*
Navicat MySQL Data Transfer

Source Server         : My9finance[127.0.0.1]
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : my9finance

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-09-29 11:47:46
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `bank_card`
-- ----------------------------
DROP TABLE IF EXISTS `bank_card`;
CREATE TABLE `bank_card` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(4) DEFAULT NULL,
  `family_num` int(4) DEFAULT NULL,
  `card_name` char(20) NOT NULL,
  `card_num` char(30) DEFAULT NULL,
  `card_type` char(20) NOT NULL,
  `card_addr` varchar(100) DEFAULT NULL,
  `money` double(8,2) NOT NULL DEFAULT '0.00',
  `year_out` float(4,2) DEFAULT '0.00',
  `year_in` float(4,2) DEFAULT '0.00',
  `store` tinyint(2) NOT NULL DEFAULT '0',
  `is_disable` tinyint(1) NOT NULL DEFAULT '0',
  `notes` varchar(50) DEFAULT NULL,
  `create_date` char(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bank_card
-- ----------------------------
INSERT INTO bank_card VALUES ('1', '118', '570', '建行', '1232312312321', '储蓄卡', '福建南安', '999999.99', '12.00', '6.00', '1', '0', '我在用', '1348825503');
