/*
Navicat MySQL Data Transfer

Source Server         : My9finance[127.0.0.1]
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : my9finance

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-11-30 18:16:32
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `ID` smallint(4) NOT NULL AUTO_INCREMENT,
  `F_ID` smallint(4) NOT NULL,
  `Is_d` smallint(1) DEFAULT '1',
  `Store` smallint(4) DEFAULT NULL,
  `Name` char(20) NOT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`F_ID`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1170 DEFAULT CHARSET=utf8;

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
  `Is_d` tinyint(1) NOT NULL DEFAULT '0',
  `Name` char(20) NOT NULL,
  `C_num` char(30) DEFAULT NULL,
  `C_type` char(20) NOT NULL,
  `C_addr` varchar(100) DEFAULT NULL,
  `Money` double(16,2) NOT NULL DEFAULT '0.00',
  `Store` tinyint(2) NOT NULL DEFAULT '0',
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
  `Status` tinyint(2) NOT NULL,
  `B_title` varchar(80) DEFAULT NULL,
  `B_centent` text,
  `C_date` char(12) DEFAULT NULL,
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
  `ID` smallint(4) NOT NULL AUTO_INCREMENT,
  `Is_d` smallint(2) DEFAULT NULL,
  `F_name` char(16) NOT NULL,
  `F_alias` char(20) DEFAULT NULL,
  `L_Pass` char(64) DEFAULT NULL,
  `C_pass` char(64) DEFAULT NULL,
  `A_pass` char(64) DEFAULT NULL,
  `Member` smallint(2) NOT NULL DEFAULT '0',
  `Email` char(50) NOT NULL,
  `Notes` varchar(50) DEFAULT NULL,
  `C_date` char(12) DEFAULT NULL,
  `L_date` char(12) DEFAULT NULL,
  `Sum` int(8) DEFAULT NULL,
  `Session` char(128) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1037 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of family
-- ----------------------------

-- ----------------------------
-- Table structure for `family_member`
-- ----------------------------
DROP TABLE IF EXISTS `family_member`;
CREATE TABLE `family_member` (
  `ID` smallint(4) NOT NULL AUTO_INCREMENT,
  `F_id` int(4) NOT NULL,
  `Is_d` smallint(2) DEFAULT '0',
  `U_name` char(16) NOT NULL,
  `U_alias` char(20) DEFAULT NULL,
  `Notes` varchar(50) DEFAULT NULL,
  `Skin` smallint(2) DEFAULT '1',
  `Email` varchar(50) NOT NULL,
  `Sum` int(8) DEFAULT '0',
  `QQ` varchar(12) NOT NULL,
  `C_date` char(12) NOT NULL,
  `L_date` char(12) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username` (`U_name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of family_member
-- ----------------------------

-- ----------------------------
-- Table structure for `in_corde`
-- ----------------------------
DROP TABLE IF EXISTS `in_corde`;
CREATE TABLE `in_corde` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `U_id` smallint(4) NOT NULL,
  `F_id` smallint(4) NOT NULL,
  `B_id` smallint(4) NOT NULL,
  `M_id` smallint(4) NOT NULL,
  `S_id` smallint(4) NOT NULL,
  `A_id` smallint(4) NOT NULL,
  `Money` float(6,2) NOT NULL,
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
  `Is_d` smallint(4) DEFAULT NULL,
  `Store` smallint(4) DEFAULT NULL,
  `Name` char(16) NOT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`F_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1068 DEFAULT CHARSET=utf8;

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
  `Is_d` smallint(1) DEFAULT '1',
  `Store` smallint(4) DEFAULT NULL,
  `Name` char(16) NOT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `man_id` (`M_id`) USING BTREE,
  KEY `user_id` (`F_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1170 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_subtype
-- ----------------------------

-- ----------------------------
-- Table structure for `log_resolve`
-- ----------------------------
DROP TABLE IF EXISTS `log_resolve`;
CREATE TABLE `log_resolve` (
  `ID` smallint(4) NOT NULL AUTO_INCREMENT,
  `log_id` smallint(4) NOT NULL,
  `content` char(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log_resolve
-- ----------------------------
INSERT INTO log_resolve VALUES ('3', '5002', '添加成功!');
INSERT INTO log_resolve VALUES ('14', '1', '登录失败，请重新登录。');
INSERT INTO log_resolve VALUES ('20', '2', '登录失败，密码错误，请重新登录。');
INSERT INTO log_resolve VALUES ('22', '5000', '登录成功，欢迎您使用！');
INSERT INTO log_resolve VALUES ('24', '5001', '登录成功，您还没设置个性名称，欢迎您使用！');
INSERT INTO log_resolve VALUES ('25', '3', '你的账号己在其它地方登录，请重新登录。');
INSERT INTO log_resolve VALUES ('26', '5010', '添加支出成功！');
INSERT INTO log_resolve VALUES ('27', '5011', '添加收入成功！');
INSERT INTO log_resolve VALUES ('28', '1010', '添加支出失败。');
INSERT INTO log_resolve VALUES ('29', '1011', '添加收入失败。');
INSERT INTO log_resolve VALUES ('30', '5012', '修改支出成功！');
INSERT INTO log_resolve VALUES ('31', '5013', '修改收入成功!');
INSERT INTO log_resolve VALUES ('32', '1012', '修改支出失败。');
INSERT INTO log_resolve VALUES ('33', '1013', '修改收入失败。');
INSERT INTO log_resolve VALUES ('34', '5014', '删除支出成功!');
INSERT INTO log_resolve VALUES ('35', '5015', '删除收入成功!');
INSERT INTO log_resolve VALUES ('36', '1014', '删除支出失败。');
INSERT INTO log_resolve VALUES ('37', '1015', '删除收入失败。');
INSERT INTO log_resolve VALUES ('39', '1016', '添加支出主类失败。');
INSERT INTO log_resolve VALUES ('40', '1017', '修改支出主类失败。');
INSERT INTO log_resolve VALUES ('41', '1018', '删除支出主类失败。');
INSERT INTO log_resolve VALUES ('42', '5016', '添加支出主类成功!');
INSERT INTO log_resolve VALUES ('43', '5017', '修改支出主类成功。');
INSERT INTO log_resolve VALUES ('44', '5018', '删除支出主类成功。');
INSERT INTO log_resolve VALUES ('45', '5019', '添加支出子类成功。');
INSERT INTO log_resolve VALUES ('46', '5020', '修改支出子类成功。');
INSERT INTO log_resolve VALUES ('47', '1019', '添加支出子类失败。');
INSERT INTO log_resolve VALUES ('57', '5005', '登录成功，欢迎您使用！<BR>您在公共组,可以到\"功能管理\"里添加自己的家庭.');
INSERT INTO log_resolve VALUES ('55', '5801', '注册成功,可以用新账号登录了!^o^');
INSERT INTO log_resolve VALUES ('50', '6000', '正在注销用户，请稍候。。。');
INSERT INTO log_resolve VALUES ('51', '32767', 'sdf在在');
INSERT INTO log_resolve VALUES ('52', '32767', 'TEST777');
INSERT INTO log_resolve VALUES ('56', '5004', '注册失败,可能用户名己注册,请重新注册!~o~');
INSERT INTO log_resolve VALUES ('53', '1020', '修改支出子类失败。');
INSERT INTO log_resolve VALUES ('58', '5021', '删除支出子类成功。');
INSERT INTO log_resolve VALUES ('59', '1021', '删除支出子类失败。');
INSERT INTO log_resolve VALUES ('60', '5022', '添加收入主类成功。');
INSERT INTO log_resolve VALUES ('61', '1022', '添加收入主类失败。');
INSERT INTO log_resolve VALUES ('62', '5023', '修改收入主类成功。');
INSERT INTO log_resolve VALUES ('63', '1023', '修改收入主类失败。');
INSERT INTO log_resolve VALUES ('64', '5024', '删除收入主类成功。');
INSERT INTO log_resolve VALUES ('65', '1024', '删除收入主类失败。');
INSERT INTO log_resolve VALUES ('66', '5025', '添加收入子类成功。');
INSERT INTO log_resolve VALUES ('67', '1025', '添加支出子类失败。');
INSERT INTO log_resolve VALUES ('68', '5026', '修改收入子类成功。');
INSERT INTO log_resolve VALUES ('69', '1026', '修改收入子类失败。');
INSERT INTO log_resolve VALUES ('70', '5027', '删除收入子类成功。');
INSERT INTO log_resolve VALUES ('71', '1027', '删除收入子类失败。');
INSERT INTO log_resolve VALUES ('72', '5028', '添加地址成功。');
INSERT INTO log_resolve VALUES ('73', '1028', '添加地址失败。');
INSERT INTO log_resolve VALUES ('74', '5029', '修改地址成功。');
INSERT INTO log_resolve VALUES ('75', '1029', '修改地址失败。');
INSERT INTO log_resolve VALUES ('76', '5033', '删除地址成功。');
INSERT INTO log_resolve VALUES ('77', '1033', '删除地址失败。');
INSERT INTO log_resolve VALUES ('78', '5030', '添加家庭用户成功。');
INSERT INTO log_resolve VALUES ('79', '1030', '添加家庭用户失败。');
INSERT INTO log_resolve VALUES ('80', '5031', '修改家庭用户成功。');
INSERT INTO log_resolve VALUES ('81', '1031', '修改家庭用户失败。');
INSERT INTO log_resolve VALUES ('82', '5032', '删除家庭用户成功。');
INSERT INTO log_resolve VALUES ('83', '1032', '删除家庭用户失败。');
INSERT INTO log_resolve VALUES ('15', '4', '账号己禁用,联系家庭管理员开启.');
INSERT INTO log_resolve VALUES ('84', '5034', '添加BUG成功,我们会尽快修改,谢谢!');
INSERT INTO log_resolve VALUES ('85', '1034', '添加BUG失败,请重新提交,辛苦啦!');
INSERT INTO log_resolve VALUES ('86', '5035', '修改BUG成功.');
INSERT INTO log_resolve VALUES ('87', '1035', '修改BUG失败.');
INSERT INTO log_resolve VALUES ('88', '5036', '删除BUG成功.');
INSERT INTO log_resolve VALUES ('89', '1036', '删除BUG失败.');
INSERT INTO log_resolve VALUES ('90', '5037', '添加银行卡成功.');
INSERT INTO log_resolve VALUES ('91', '1037', '添加银行卡失败.');
INSERT INTO log_resolve VALUES ('92', '5038', '修改银行卡成功.');
INSERT INTO log_resolve VALUES ('93', '1038', '修改银行卡失败.');
INSERT INTO log_resolve VALUES ('94', '5039', '删除银行卡成功.');
INSERT INTO log_resolve VALUES ('95', '1039', '删除银行卡失败.');
INSERT INTO log_resolve VALUES ('96', '5040', '添加现金成功.');
INSERT INTO log_resolve VALUES ('97', '1040', '添加现金失败.');
INSERT INTO log_resolve VALUES ('98', '5041', '修改现金失败.');
INSERT INTO log_resolve VALUES ('99', '1041', '修改现金失败.');
INSERT INTO log_resolve VALUES ('100', '5042', '删除现金成功.');
INSERT INTO log_resolve VALUES ('101', '1042', '删除现金失败.');

-- ----------------------------
-- Table structure for `out_corde`
-- ----------------------------
DROP TABLE IF EXISTS `out_corde`;
CREATE TABLE `out_corde` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `U_id` smallint(4) NOT NULL,
  `F_id` smallint(4) NOT NULL,
  `B_id` smallint(4) NOT NULL,
  `M_id` smallint(4) NOT NULL,
  `S_id` smallint(4) NOT NULL,
  `A_id` smallint(4) NOT NULL,
  `Money` float(6,2) NOT NULL,
  `Notes` varchar(104) DEFAULT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`U_id`) USING BTREE,
  KEY `group_id` (`F_id`) USING BTREE,
  KEY `out_mantype_id` (`M_id`) USING BTREE,
  KEY `out_subtype_id` (`S_id`) USING BTREE,
  KEY `addr_id` (`A_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8;

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
  `Is_d` smallint(4) DEFAULT NULL,
  `Store` smallint(4) DEFAULT NULL,
  `Name` char(16) NOT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`F_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1204 DEFAULT CHARSET=utf8;

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
  `Is_d` smallint(1) DEFAULT '1',
  `Store` smallint(4) DEFAULT NULL,
  `Name` char(16) NOT NULL,
  `C_date` char(12) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `man_id` (`M_id`) USING BTREE,
  KEY `user_id` (`F_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1986 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_subtype
-- ----------------------------
