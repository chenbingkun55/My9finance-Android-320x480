/*
Navicat MySQL Data Transfer

Source Server         : My9finance[127.0.0.1]
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : my9finance

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-11-29 19:36:06
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `ID` smallint(4) NOT NULL AUTO_INCREMENT,
  `F_ID` smallint(4) NOT NULL,
  `Store` smallint(4) DEFAULT NULL,
  `Is_display` smallint(1) DEFAULT '1',
  `A_name` char(20) NOT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`F_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------

-- ----------------------------
-- Table structure for `bank_card`
-- ----------------------------
DROP TABLE IF EXISTS `bank_card`;
CREATE TABLE `bank_card` (
  `ID` tinyint(2) NOT NULL AUTO_INCREMENT,
  `U_id` smallint(4) DEFAULT NULL,
  `F_id` int(4) DEFAULT NULL,
  `C_name` char(20) NOT NULL,
  `C_num` char(30) DEFAULT NULL,
  `C_type` char(20) NOT NULL,
  `C_addr` varchar(100) DEFAULT NULL,
  `Money` double(16,2) NOT NULL DEFAULT '0.00',
  `Store` tinyint(2) NOT NULL DEFAULT '0',
  `Is_disable` tinyint(1) NOT NULL DEFAULT '0',
  `Notes` varchar(50) DEFAULT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bank_card
-- ----------------------------

-- ----------------------------
-- Table structure for `bug`
-- ----------------------------
DROP TABLE IF EXISTS `bug`;
CREATE TABLE `bug` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `U_id` int(4) DEFAULT '0',
  `F_id` int(4) DEFAULT '0',
  `B_type` char(12) NOT NULL,
  `B_level` tinyint(2) NOT NULL,
  `B_title` varchar(80) DEFAULT NULL,
  `B_centent` text,
  `C_date` char(12) DEFAULT NULL,
  `Status` tinyint(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bug
-- ----------------------------

-- ----------------------------
-- Table structure for `family`
-- ----------------------------
DROP TABLE IF EXISTS `family`;
CREATE TABLE `family` (
  `Id` smallint(4) NOT NULL AUTO_INCREMENT,
  `Is_d` smallint(2) DEFAULT NULL,
  `F_name` char(16) DEFAULT NULL,
  `F_alias` char(20) NOT NULL,
  `L_Pass` char(64) DEFAULT NULL,
  `C_pass` char(64) DEFAULT NULL,
  `A_pass` char(64) DEFAULT NULL,
  `Notes` varchar(50) DEFAULT NULL,
  `C_date` char(12) DEFAULT NULL,
  `L_date` char(12) DEFAULT NULL,
  `L_sum` int(8) DEFAULT NULL,
  `Session` char(128) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of family
-- ----------------------------

-- ----------------------------
-- Table structure for `family_munber`
-- ----------------------------
DROP TABLE IF EXISTS `family_munber`;
CREATE TABLE `family_munber` (
  `Id` smallint(4) NOT NULL AUTO_INCREMENT,
  `Is_d` smallint(2) DEFAULT '0',
  `U_name` char(16) NOT NULL,
  `U_alias` char(20) DEFAULT NULL,
  `F_id` int(4) NOT NULL,
  `Notes` varchar(50) DEFAULT NULL,
  `C_date` char(12) NOT NULL,
  `L_date` char(12) DEFAULT NULL,
  `Skin` smallint(2) DEFAULT '1',
  `L_sum` int(8) DEFAULT '0',
  `Email` varchar(50) NOT NULL,
  `QQ` varchar(12) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `username` (`U_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of family_munber
-- ----------------------------

-- ----------------------------
-- Table structure for `in_corde`
-- ----------------------------
DROP TABLE IF EXISTS `in_corde`;
CREATE TABLE `in_corde` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `Money` float(6,2) NOT NULL,
  `U_id` smallint(4) NOT NULL,
  `F_id` smallint(4) NOT NULL,
  `B_id` smallint(4) NOT NULL,
  `M_id` smallint(4) NOT NULL,
  `S_id` smallint(4) NOT NULL,
  `A_id` smallint(4) NOT NULL,
  `Notes` varchar(104) DEFAULT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`U_id`) USING BTREE,
  KEY `group_id` (`F_id`) USING BTREE,
  KEY `out_mantype_id` (`M_id`) USING BTREE,
  KEY `out_subtype_id` (`S_id`) USING BTREE,
  KEY `addr_id` (`A_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_corde
-- ----------------------------

-- ----------------------------
-- Table structure for `in_mantype`
-- ----------------------------
DROP TABLE IF EXISTS `in_mantype`;
CREATE TABLE `in_mantype` (
  `ID` smallint(4) NOT NULL AUTO_INCREMENT,
  `F_id` smallint(4) NOT NULL,
  `Store` smallint(4) DEFAULT NULL,
  `Is_d` smallint(4) DEFAULT NULL,
  `Name` char(16) NOT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`F_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_mantype
-- ----------------------------

-- ----------------------------
-- Table structure for `in_subtype`
-- ----------------------------
DROP TABLE IF EXISTS `in_subtype`;
CREATE TABLE `in_subtype` (
  `ID` smallint(4) NOT NULL AUTO_INCREMENT,
  `F_id` smallint(4) NOT NULL,
  `M_id` smallint(4) NOT NULL,
  `Store` smallint(4) DEFAULT NULL,
  `Is_d` smallint(1) DEFAULT '1',
  `Name` char(16) NOT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `man_id` (`M_id`) USING BTREE,
  KEY `user_id` (`F_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_subtype
-- ----------------------------

-- ----------------------------
-- Table structure for `log_resolve`
-- ----------------------------
DROP TABLE IF EXISTS `log_resolve`;
CREATE TABLE `log_resolve` (
  `ID` smallint(4) NOT NULL AUTO_INCREMENT,
  `G_logid` smallint(4) NOT NULL,
  `content` char(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_resolve
-- ----------------------------

-- ----------------------------
-- Table structure for `out_corde`
-- ----------------------------
DROP TABLE IF EXISTS `out_corde`;
CREATE TABLE `out_corde` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `Money` float(6,2) NOT NULL,
  `U_id` smallint(4) NOT NULL,
  `F_id` smallint(4) NOT NULL,
  `B_id` smallint(4) NOT NULL,
  `M_id` smallint(4) NOT NULL,
  `S_id` smallint(4) NOT NULL,
  `A_id` smallint(4) NOT NULL,
  `Notes` varchar(104) DEFAULT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`U_id`) USING BTREE,
  KEY `group_id` (`F_id`) USING BTREE,
  KEY `out_mantype_id` (`M_id`) USING BTREE,
  KEY `out_subtype_id` (`S_id`) USING BTREE,
  KEY `addr_id` (`A_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_corde
-- ----------------------------

-- ----------------------------
-- Table structure for `out_mantype`
-- ----------------------------
DROP TABLE IF EXISTS `out_mantype`;
CREATE TABLE `out_mantype` (
  `ID` smallint(4) NOT NULL AUTO_INCREMENT,
  `F_id` smallint(4) NOT NULL,
  `Store` smallint(4) DEFAULT NULL,
  `Is_d` smallint(4) DEFAULT NULL,
  `Name` char(16) NOT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`F_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_mantype
-- ----------------------------

-- ----------------------------
-- Table structure for `out_subtype`
-- ----------------------------
DROP TABLE IF EXISTS `out_subtype`;
CREATE TABLE `out_subtype` (
  `ID` smallint(4) NOT NULL AUTO_INCREMENT,
  `F_id` smallint(4) NOT NULL,
  `M_id` smallint(4) NOT NULL,
  `Store` smallint(4) DEFAULT NULL,
  `Is_d` smallint(1) DEFAULT '1',
  `Name` char(16) NOT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `man_id` (`M_id`) USING BTREE,
  KEY `user_id` (`F_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_subtype
-- ----------------------------
