/*
Navicat MySQL Data Transfer

Source Server         : My9finance[127.0.0.1]
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : my9finance

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-09-28 17:43:56
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `family_num` smallint(4) NOT NULL,
  `store` smallint(4) DEFAULT NULL,
  `is_display` smallint(1) DEFAULT '1',
  `name` char(20) NOT NULL,
  `create_date` char(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`family_num`)
) ENGINE=MyISAM AUTO_INCREMENT=349 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------

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
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bug_corde
-- ----------------------------
INSERT INTO bug_corde VALUES ('9', '100', '570', 'bug', '2', '不能修改主题3', '测试,测试.3', '1348815020', '0');
INSERT INTO bug_corde VALUES ('8', '96', '555', 'bug', '1', '测试BUG', '提交一个BUG。', '1348802775', '0');

-- ----------------------------
-- Table structure for `in_corde`
-- ----------------------------
DROP TABLE IF EXISTS `in_corde`;
CREATE TABLE `in_corde` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `money` float(6,2) NOT NULL,
  `user_id` smallint(4) NOT NULL,
  `family_num` smallint(4) NOT NULL,
  `mantype_id` smallint(4) NOT NULL,
  `subtype_id` smallint(4) NOT NULL,
  `addr_id` smallint(4) NOT NULL,
  `notes` varchar(50) DEFAULT NULL,
  `create_date` char(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`family_num`),
  KEY `in_mantype_id` (`mantype_id`),
  KEY `in_subtype_id` (`subtype_id`),
  KEY `addr_id` (`addr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_corde
-- ----------------------------

-- ----------------------------
-- Table structure for `in_mantype`
-- ----------------------------
DROP TABLE IF EXISTS `in_mantype`;
CREATE TABLE `in_mantype` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `family_num` smallint(4) NOT NULL,
  `store` smallint(4) DEFAULT NULL,
  `is_display` smallint(4) DEFAULT NULL,
  `name` char(16) NOT NULL,
  `create_date` char(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`family_num`)
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_mantype
-- ----------------------------

-- ----------------------------
-- Table structure for `in_out_gather`
-- ----------------------------
DROP TABLE IF EXISTS `in_out_gather`;
CREATE TABLE `in_out_gather` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `in_all` double(8,2) DEFAULT NULL,
  `out_all` double(8,2) DEFAULT NULL,
  `inout_all` double(8,2) DEFAULT NULL,
  `month_in` double(8,2) DEFAULT NULL,
  `month_out` double(8,2) DEFAULT NULL,
  `month_all` double(8,2) DEFAULT NULL,
  `year_in` double(8,2) DEFAULT NULL,
  `year_out` double(8,2) DEFAULT NULL,
  `year_all` double(8,2) DEFAULT NULL,
  `year` smallint(4) NOT NULL DEFAULT '0',
  `month` smallint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_out_gather
-- ----------------------------

-- ----------------------------
-- Table structure for `in_subtype`
-- ----------------------------
DROP TABLE IF EXISTS `in_subtype`;
CREATE TABLE `in_subtype` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `family_num` smallint(4) NOT NULL,
  `man_id` smallint(4) NOT NULL,
  `store` smallint(4) DEFAULT NULL,
  `is_display` smallint(1) DEFAULT '1',
  `name` char(16) NOT NULL,
  `create_date` char(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `man_id` (`man_id`),
  KEY `user_id` (`family_num`)
) ENGINE=MyISAM AUTO_INCREMENT=235 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_subtype
-- ----------------------------

-- ----------------------------
-- Table structure for `log_resolve`
-- ----------------------------
DROP TABLE IF EXISTS `log_resolve`;
CREATE TABLE `log_resolve` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `log_id` smallint(4) NOT NULL,
  `content` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

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

-- ----------------------------
-- Table structure for `out_corde`
-- ----------------------------
DROP TABLE IF EXISTS `out_corde`;
CREATE TABLE `out_corde` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `money` float(6,2) NOT NULL,
  `user_id` smallint(4) NOT NULL,
  `family_num` smallint(4) NOT NULL,
  `mantype_id` smallint(4) NOT NULL,
  `subtype_id` smallint(4) NOT NULL,
  `addr_id` smallint(4) NOT NULL,
  `notes` varchar(104) DEFAULT NULL,
  `create_date` char(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`family_num`),
  KEY `out_mantype_id` (`mantype_id`),
  KEY `out_subtype_id` (`subtype_id`),
  KEY `addr_id` (`addr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2167 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_corde
-- ----------------------------

-- ----------------------------
-- Table structure for `out_mantype`
-- ----------------------------
DROP TABLE IF EXISTS `out_mantype`;
CREATE TABLE `out_mantype` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `family_num` smallint(4) NOT NULL,
  `store` smallint(4) DEFAULT NULL,
  `is_display` smallint(4) DEFAULT NULL,
  `name` char(16) NOT NULL,
  `create_date` char(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`family_num`)
) ENGINE=MyISAM AUTO_INCREMENT=426 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_mantype
-- ----------------------------

-- ----------------------------
-- Table structure for `out_subtype`
-- ----------------------------
DROP TABLE IF EXISTS `out_subtype`;
CREATE TABLE `out_subtype` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `family_num` smallint(4) NOT NULL,
  `man_id` smallint(4) NOT NULL,
  `store` smallint(4) DEFAULT NULL,
  `is_display` smallint(1) DEFAULT '1',
  `name` char(16) NOT NULL,
  `create_date` char(12) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `man_id` (`man_id`),
  KEY `user_id` (`family_num`)
) ENGINE=MyISAM AUTO_INCREMENT=1640 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_subtype
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `is_disable` smallint(2) DEFAULT '0',
  `username` char(16) NOT NULL,
  `user_alias` char(20) DEFAULT NULL,
  `family_num` int(4) NOT NULL,
  `family_adm` tinyint(2) NOT NULL DEFAULT '0',
  `password` char(64) NOT NULL,
  `clean_pass` char(64) DEFAULT NULL,
  `notes` varchar(50) DEFAULT NULL,
  `create_date` char(12) NOT NULL,
  `last_date` char(12) DEFAULT NULL,
  `skin` smallint(2) DEFAULT '1',
  `login_sum` int(8) DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `qq` varchar(12) NOT NULL,
  `session` char(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for `user_limit`
-- ----------------------------
DROP TABLE IF EXISTS `user_limit`;
CREATE TABLE `user_limit` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(4) NOT NULL,
  `user_disable` smallint(4) NOT NULL DEFAULT '0',
  `group_disable` smallint(4) NOT NULL DEFAULT '0',
  `create_group_num` smallint(4) NOT NULL DEFAULT '1',
  `create_mantype_num` smallint(4) NOT NULL DEFAULT '10',
  `create_subtype_num` smallint(4) NOT NULL DEFAULT '10',
  `create_addr_num` smallint(4) NOT NULL DEFAULT '10',
  `attr_group_num` smallint(4) NOT NULL DEFAULT '1',
  `pass_size` smallint(4) NOT NULL DEFAULT '0',
  `pass_difficulty` smallint(4) NOT NULL DEFAULT '0',
  `pass_overdue` datetime DEFAULT NULL,
  `overdue_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_limit
-- ----------------------------

-- ----------------------------
-- Table structure for `user_power`
-- ----------------------------
DROP TABLE IF EXISTS `user_power`;
CREATE TABLE `user_power` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(4) NOT NULL,
  `add_mantype` smallint(4) NOT NULL DEFAULT '0',
  `alter_mantype` smallint(4) NOT NULL DEFAULT '0',
  `add_subtype` smallint(4) NOT NULL DEFAULT '0',
  `add_address` smallint(4) NOT NULL DEFAULT '0',
  `alter_address` smallint(4) NOT NULL DEFAULT '0',
  `add_in_corde` smallint(4) NOT NULL DEFAULT '0',
  `alter_in_corde` smallint(4) NOT NULL DEFAULT '0',
  `add_out_corde` smallint(4) NOT NULL DEFAULT '0',
  `alter_out_corde` smallint(4) NOT NULL DEFAULT '0',
  `report_all` smallint(4) NOT NULL DEFAULT '0',
  `create_group` smallint(4) NOT NULL DEFAULT '0',
  `search_disable` smallint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_power
-- ----------------------------
