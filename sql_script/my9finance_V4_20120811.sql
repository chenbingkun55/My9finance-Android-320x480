/*
Navicat MySQL Data Transfer

Source Server         : My9finance_MyPC
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : my9finance

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-08-11 19:49:53
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(4) NOT NULL,
  `store` smallint(4) DEFAULT NULL,
  `is_display` smallint(1) DEFAULT '1',
  `name` char(20) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=160 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO address VALUES ('10', '2', '8', '0', '公司食堂', '2010-07-25 10:39:00');
INSERT INTO address VALUES ('12', '2', '14', '0', '航华租房处', '2010-07-25 18:23:05');
INSERT INTO address VALUES ('13', '2', '7', '0', '公司茶水间', '2010-07-25 21:46:52');
INSERT INTO address VALUES ('14', '2', '15', '0', '乐购超市', '2010-07-25 21:47:27');
INSERT INTO address VALUES ('15', '2', '19', '1', '其它', '2010-07-25 21:47:43');
INSERT INTO address VALUES ('16', '2', '9', '0', '公司附近', '2010-07-25 21:49:10');
INSERT INTO address VALUES ('17', '2', '16', '0', '天添鲜水果店', '2010-07-28 22:21:40');
INSERT INTO address VALUES ('157', '63', '1', '1', '我家44', '2012-08-11 14:57:30');
INSERT INTO address VALUES ('155', '34', '1', '1', 'aa', '2012-07-31 18:01:51');
INSERT INTO address VALUES ('20', '2', '10', '0', '易初莲花', '2010-08-05 19:48:10');
INSERT INTO address VALUES ('21', '2', '12', '1', '网购', '2010-08-16 23:05:44');
INSERT INTO address VALUES ('153', '30', '6', '1', '电脑城', '2012-04-21 14:31:45');
INSERT INTO address VALUES ('23', '13', '5', '1', '上海', '2010-09-06 09:23:45');
INSERT INTO address VALUES ('82', '18', '2', '1', '公司', '2011-06-11 21:10:40');
INSERT INTO address VALUES ('26', '3', '5', '1', '公司', '2010-09-26 14:47:35');
INSERT INTO address VALUES ('27', '3', '8', '1', '公司附近', '2010-09-26 14:47:35');
INSERT INTO address VALUES ('28', '3', '6', '1', '家里', '2010-09-26 14:47:35');
INSERT INTO address VALUES ('29', '3', '9', '1', '综合大卖场', '2010-09-26 14:47:35');
INSERT INTO address VALUES ('30', '3', '10', '1', '超市菜市场', '2010-09-26 14:47:35');
INSERT INTO address VALUES ('31', '3', '11', '1', '电脑城', '2010-09-26 14:47:35');
INSERT INTO address VALUES ('32', '5', '5', '1', '公司', '2010-09-26 15:11:46');
INSERT INTO address VALUES ('33', '5', '8', '1', '公司附近', '2010-09-26 15:11:46');
INSERT INTO address VALUES ('34', '5', '6', '1', '家里', '2010-09-26 15:11:46');
INSERT INTO address VALUES ('35', '5', '9', '1', '综合大卖场', '2010-09-26 15:11:46');
INSERT INTO address VALUES ('36', '5', '10', '1', '超市菜市场', '2010-09-26 15:11:46');
INSERT INTO address VALUES ('37', '5', '11', '1', '电脑城', '2010-09-26 15:11:46');
INSERT INTO address VALUES ('38', '13', '5', '1', '公司', '2010-09-26 15:53:29');
INSERT INTO address VALUES ('39', '13', '8', '1', '公司附近', '2010-09-26 15:53:29');
INSERT INTO address VALUES ('40', '13', '6', '1', '家里', '2010-09-26 15:53:29');
INSERT INTO address VALUES ('41', '13', '9', '1', '综合大卖场', '2010-09-26 15:53:29');
INSERT INTO address VALUES ('42', '13', '10', '1', '超市菜市场', '2010-09-26 15:53:29');
INSERT INTO address VALUES ('43', '13', '11', '1', '电脑城', '2010-09-26 15:53:29');
INSERT INTO address VALUES ('123', '0', '6', '1', '电脑城', '2012-04-18 15:31:15');
INSERT INTO address VALUES ('122', '0', '5', '1', '超市菜市场', '2012-04-18 15:31:15');
INSERT INTO address VALUES ('121', '0', '4', '1', '综合大卖场', '2012-04-18 15:31:15');
INSERT INTO address VALUES ('120', '0', '3', '1', '家里', '2012-04-18 15:31:15');
INSERT INTO address VALUES ('119', '0', '2', '1', '公司附近', '2012-04-18 15:31:15');
INSERT INTO address VALUES ('118', '0', '1', '1', '公司', '2012-04-18 15:31:15');
INSERT INTO address VALUES ('152', '30', '5', '1', '超市菜市场', '2012-04-21 14:31:45');
INSERT INTO address VALUES ('87', '18', '7', '1', '电脑城', '2011-06-11 21:10:40');
INSERT INTO address VALUES ('86', '18', '6', '1', '超市菜市场', '2011-06-11 21:10:40');
INSERT INTO address VALUES ('85', '18', '5', '1', '综合大卖场', '2011-06-11 21:10:40');
INSERT INTO address VALUES ('84', '18', '4', '1', '家里', '2011-06-11 21:10:40');
INSERT INTO address VALUES ('83', '18', '3', '1', '公司附近', '2011-06-11 21:10:40');
INSERT INTO address VALUES ('93', '19', '7', '1', '电脑城', '2011-06-11 21:16:35');
INSERT INTO address VALUES ('92', '19', '6', '1', '超市菜市场', '2011-06-11 21:16:35');
INSERT INTO address VALUES ('91', '19', '5', '1', '综合大卖场', '2011-06-11 21:16:35');
INSERT INTO address VALUES ('90', '19', '4', '1', '家里', '2011-06-11 21:16:35');
INSERT INTO address VALUES ('89', '19', '3', '1', '公司附近', '2011-06-11 21:16:35');
INSERT INTO address VALUES ('88', '19', '2', '1', '公司', '2011-06-11 21:16:35');
INSERT INTO address VALUES ('62', '1', '5', '1', '公司', '2010-10-16 13:32:20');
INSERT INTO address VALUES ('63', '1', '6', '1', '公司附近', '2010-10-16 13:32:20');
INSERT INTO address VALUES ('64', '1', '9', '1', '家里', '2010-10-16 13:32:20');
INSERT INTO address VALUES ('65', '1', '8', '1', '综合大卖场', '2010-10-16 13:32:20');
INSERT INTO address VALUES ('66', '1', '10', '1', '超市菜市场', '2010-10-16 13:32:20');
INSERT INTO address VALUES ('67', '1', '11', '1', '电脑城', '2010-10-16 13:32:20');
INSERT INTO address VALUES ('68', '2', '20', '0', '南安市医院', '2010-10-28 17:19:05');
INSERT INTO address VALUES ('69', '2', '21', '1', '家里', '2010-11-07 19:00:10');
INSERT INTO address VALUES ('70', '2', '3', '1', '新公司附近', '2011-03-29 12:35:33');
INSERT INTO address VALUES ('71', '2', '2', '0', '钦州北路租房处', '2011-03-29 12:36:23');
INSERT INTO address VALUES ('72', '5', '7', '1', '医院', '2011-04-29 17:27:35');
INSERT INTO address VALUES ('158', '63', '2', '1', '我家2', '2012-08-11 15:02:03');
INSERT INTO address VALUES ('74', '2', '22', '0', '四黄加油站', '2011-06-09 22:14:02');
INSERT INTO address VALUES ('75', '2', '23', '0', '山美加油站', '2011-06-09 22:14:14');
INSERT INTO address VALUES ('151', '30', '4', '1', '综合大卖场', '2012-04-21 14:31:45');
INSERT INTO address VALUES ('150', '30', '3', '1', '家里', '2012-04-21 14:31:45');
INSERT INTO address VALUES ('149', '30', '2', '1', '公司附近', '2012-04-21 14:31:45');
INSERT INTO address VALUES ('148', '30', '1', '1', '公司', '2012-04-21 14:31:45');
INSERT INTO address VALUES ('100', '2', '25', '1', '超市', '2011-06-14 20:32:12');
INSERT INTO address VALUES ('101', '2', '4', '1', '霞郊菜市场', '2011-09-14 21:57:47');
INSERT INTO address VALUES ('102', '2', '1', '1', '福州', '2011-09-26 21:43:03');
INSERT INTO address VALUES ('147', '29', '6', '1', '电脑城', '2012-04-21 14:31:02');
INSERT INTO address VALUES ('109', '5', '12', '1', '网购', '2011-12-21 22:41:30');
INSERT INTO address VALUES ('110', '3', '12', '1', '福州', '2012-03-19 12:39:19');
INSERT INTO address VALUES ('111', '5', '13', '1', '福州', '2012-03-24 13:45:22');
INSERT INTO address VALUES ('146', '29', '5', '1', '超市菜市场', '2012-04-21 14:31:02');
INSERT INTO address VALUES ('145', '29', '4', '1', '综合大卖场', '2012-04-21 14:31:02');
INSERT INTO address VALUES ('144', '29', '3', '1', '家里', '2012-04-21 14:31:02');
INSERT INTO address VALUES ('143', '29', '2', '1', '公司附近', '2012-04-21 14:31:02');
INSERT INTO address VALUES ('142', '29', '1', '1', '公司', '2012-04-21 14:31:02');
INSERT INTO address VALUES ('159', '63', '3', '1', 'YyY', '2012-08-11 16:20:40');

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `groupname` char(16) NOT NULL,
  `group_alias` char(20) DEFAULT NULL,
  `groupadmin_id` smallint(4) NOT NULL,
  `password` char(64) NOT NULL,
  `notes` varchar(50) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `last_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groupname` (`groupname`),
  KEY `groupadmin_id` (`groupadmin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO groups VALUES ('27', 'public', '公共组', '1', '888', '用户默所属的组。', '2010-09-01 09:02:52', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('26', '我爱家', '我爱家', '2', 'chenbk55', '我爱家', '2012-06-28 18:04:47', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('3', 'admin', '管理员组', '1', 'chenbk55', '管理员组', '2010-08-08 17:36:11', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('14', 'dajiating', '大家庭', '19', '888', '大家庭', '2011-06-11 21:18:40', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('15', '测试之家', '测试之家', '23', '123456', '测试之家', '2012-04-18 15:26:01', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('28', 'abc', 'abc', '0', '*0D3CED9BEC10A777AEC23CCC353A8C08A633045E', 'abc', '2012-08-06 16:26:32', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('29', 'abcd', 'abcd', '50', '*A154C52565E9E7F94BFC08A1FE702624ED8EFFDA', 'abcd', '2012-08-06 16:28:45', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('30', 'abcde', 'abcde', '51', '*8DC54F2E15823C98AEA063E339A5D4C53D1A471A', 'abcde', '2012-08-06 16:30:54', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('31', 'ccc', 'ccc', '52', '*106317C687A95D8C2703D21A14A09F03C7F25F4B', 'ccc', '2012-08-06 16:32:17', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('32', 'ddd', 'ddd', '53', '*A96141DC1E8E55BD1FC2EA76E401E2A1E6F7BD90', 'ddd', '2012-08-06 16:39:49', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('33', 'ttt', 'ttt', '54', '*A0C1B1AEC5E4FC2670F87F7F6A46ACF06DC15605', 'ttt', '2012-08-06 16:49:29', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('34', 'rrr', 'rrr', '55', '*734BB57BE5AE629BD42B31136E5D96821B02275C', 'rrr', '2012-08-06 16:52:14', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('35', 'eee', 'eee', '56', '*A94008217C2DF00A75EF5950AA2A145CE7C6B1E1', 'eee', '2012-08-06 16:53:05', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('36', '333', '333', '57', '*44019FB6C583EFACD2FB2F1A1960B97F86E36A74', '333', '2012-08-06 16:56:12', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('37', '我家', '我家', '58', '*4D5AEA9FD02036000DEF417BE8A23AC2630E37F5', '我家', '2012-08-06 17:44:04', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('38', 'you', 'you', '61', '*1A11AE440F0BFE14CF065EA776CEFA20B3BCF946', 'you', '2012-08-11 14:11:55', '0000-00-00 00:00:00');
INSERT INTO groups VALUES ('39', '123之家', '123之家', '62', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '123之家', '2012-08-11 14:18:19', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `in_corde`
-- ----------------------------
DROP TABLE IF EXISTS `in_corde`;
CREATE TABLE `in_corde` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `money` float(6,2) NOT NULL,
  `user_id` smallint(4) NOT NULL,
  `group_id` smallint(4) NOT NULL,
  `mantype_id` smallint(4) NOT NULL,
  `subtype_id` smallint(4) NOT NULL,
  `addr_id` smallint(4) NOT NULL,
  `notes` varchar(50) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`),
  KEY `in_mantype_id` (`mantype_id`),
  KEY `in_subtype_id` (`subtype_id`),
  KEY `addr_id` (`addr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_corde
-- ----------------------------

-- ----------------------------
-- Table structure for `in_mantype`
-- ----------------------------
DROP TABLE IF EXISTS `in_mantype`;
CREATE TABLE `in_mantype` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(4) NOT NULL,
  `store` smallint(4) DEFAULT NULL,
  `is_display` smallint(4) DEFAULT NULL,
  `name` char(16) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_mantype
-- ----------------------------
INSERT INTO in_mantype VALUES ('21', '2', '3', '1', '工资以外', '2010-07-20 00:53:01');
INSERT INTO in_mantype VALUES ('22', '2', '2', '1', '利息', '2010-07-20 09:50:59');
INSERT INTO in_mantype VALUES ('23', '2', '1', '1', '还款', '2010-07-27 19:16:24');
INSERT INTO in_mantype VALUES ('79', '63', '1', '1', 'sdf', '2012-08-11 15:56:45');
INSERT INTO in_mantype VALUES ('28', '3', '1', '1', '固定收入', '2010-09-26 14:47:34');
INSERT INTO in_mantype VALUES ('29', '3', '2', '1', '其它收入', '2010-09-26 14:47:34');
INSERT INTO in_mantype VALUES ('30', '5', '1', '1', '固定收入', '2010-09-26 15:11:46');
INSERT INTO in_mantype VALUES ('31', '5', '2', '1', '其它收入', '2010-09-26 15:11:46');
INSERT INTO in_mantype VALUES ('32', '13', '1', '1', '固定收入', '2010-09-26 15:53:29');
INSERT INTO in_mantype VALUES ('33', '13', '2', '1', '其它收入', '2010-09-26 15:53:29');
INSERT INTO in_mantype VALUES ('64', '0', '2', '1', '其它收入', '2012-04-18 15:31:15');
INSERT INTO in_mantype VALUES ('63', '0', '1', '1', '固定收入', '2012-04-18 15:31:15');
INSERT INTO in_mantype VALUES ('45', '18', '2', '1', '其它收入', '2011-06-11 21:10:40');
INSERT INTO in_mantype VALUES ('44', '18', '1', '1', '固定收入', '2011-06-11 21:10:40');
INSERT INTO in_mantype VALUES ('47', '19', '2', '1', '其它收入', '2011-06-11 21:16:35');
INSERT INTO in_mantype VALUES ('46', '19', '1', '1', '固定收入', '2011-06-11 21:16:35');
INSERT INTO in_mantype VALUES ('40', '1', '1', '1', '固定收入', '2010-10-16 13:32:20');
INSERT INTO in_mantype VALUES ('41', '1', '2', '1', '其它收入', '2010-10-16 13:32:20');
INSERT INTO in_mantype VALUES ('74', '30', '2', '1', '其它收入', '2012-04-21 14:31:45');
INSERT INTO in_mantype VALUES ('73', '30', '1', '1', '固定收入', '2012-04-21 14:31:45');
INSERT INTO in_mantype VALUES ('59', '1', '3', '1', 'TEST4567', '2012-04-17 15:26:47');
INSERT INTO in_mantype VALUES ('72', '29', '2', '1', '其它收入', '2012-04-21 14:31:02');
INSERT INTO in_mantype VALUES ('71', '29', '1', '1', '固定收入', '2012-04-21 14:31:02');

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
  `user_id` smallint(4) NOT NULL,
  `man_id` smallint(4) NOT NULL,
  `store` smallint(4) DEFAULT NULL,
  `is_display` smallint(1) DEFAULT '1',
  `name` char(16) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `man_id` (`man_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_subtype
-- ----------------------------
INSERT INTO in_subtype VALUES ('11', '2', '4', '1', '1', '工资', '2010-07-20 00:24:45');
INSERT INTO in_subtype VALUES ('12', '2', '21', '1', '1', '夜间值班', '2010-07-20 00:53:43');
INSERT INTO in_subtype VALUES ('13', '2', '22', '1', '1', '定期存款2', '2010-07-20 09:54:02');
INSERT INTO in_subtype VALUES ('16', '2', '4', '2', '1', '地产', '2010-07-26 08:54:19');
INSERT INTO in_subtype VALUES ('17', '2', '23', '1', '1', '房租压金2', '2010-08-27 23:05:17');
INSERT INTO in_subtype VALUES ('19', '2', '23', '2', '1', '还款', '2010-09-01 13:46:47');
INSERT INTO in_subtype VALUES ('20', '3', '28', '1', '1', '工资2', '2010-09-26 14:47:35');
INSERT INTO in_subtype VALUES ('21', '3', '29', '1', '1', '未知', '2010-09-26 14:47:35');
INSERT INTO in_subtype VALUES ('22', '5', '30', '1', '1', '工资', '2010-09-26 15:11:46');
INSERT INTO in_subtype VALUES ('23', '5', '31', '1', '1', '未知', '2010-09-26 15:11:46');
INSERT INTO in_subtype VALUES ('24', '13', '32', '1', '1', '工资', '2010-09-26 15:53:29');
INSERT INTO in_subtype VALUES ('25', '13', '33', '1', '1', '未知', '2010-09-26 15:53:29');
INSERT INTO in_subtype VALUES ('55', '0', '64', '1', '1', '未知', '2012-04-18 15:31:15');
INSERT INTO in_subtype VALUES ('54', '0', '63', '1', '1', '工资', '2012-04-18 15:31:15');
INSERT INTO in_subtype VALUES ('43', '18', '45', '1', '1', '未知', '2011-06-11 21:10:40');
INSERT INTO in_subtype VALUES ('42', '18', '44', '1', '1', '工资', '2011-06-11 21:10:40');
INSERT INTO in_subtype VALUES ('45', '19', '47', '1', '1', '未知', '2011-06-11 21:16:35');
INSERT INTO in_subtype VALUES ('44', '19', '46', '1', '1', '工资', '2011-06-11 21:16:35');
INSERT INTO in_subtype VALUES ('32', '1', '40', '1', '1', '工资', '2010-10-16 13:32:20');
INSERT INTO in_subtype VALUES ('33', '1', '41', '1', '1', '未知', '2010-10-16 13:32:20');
INSERT INTO in_subtype VALUES ('34', '2', '21', '5', '1', '过节费', '2011-01-28 14:29:06');
INSERT INTO in_subtype VALUES ('35', '2', '21', '2', '1', '综合保险', '2011-01-29 15:30:50');
INSERT INTO in_subtype VALUES ('36', '2', '21', '4', '1', '信用卡取现', '2011-03-24 11:36:51');
INSERT INTO in_subtype VALUES ('37', '2', '21', '6', '1', '押金2', '2011-05-08 15:22:36');
INSERT INTO in_subtype VALUES ('69', '63', '79', '1', '1', 'e3', '2012-08-11 15:56:48');
INSERT INTO in_subtype VALUES ('39', '5', '31', '2', '1', '人情世事', '2011-06-09 22:16:50');
INSERT INTO in_subtype VALUES ('65', '30', '74', '1', '1', '未知', '2012-04-21 14:31:45');
INSERT INTO in_subtype VALUES ('64', '30', '73', '1', '1', '工资', '2012-04-21 14:31:45');
INSERT INTO in_subtype VALUES ('48', '2', '21', '3', '1', '奖金', '2011-09-24 22:43:59');
INSERT INTO in_subtype VALUES ('63', '29', '72', '1', '1', '未知', '2012-04-21 14:31:02');
INSERT INTO in_subtype VALUES ('62', '29', '71', '1', '1', '工资', '2012-04-21 14:31:02');

-- ----------------------------
-- Table structure for `log_resolve`
-- ----------------------------
DROP TABLE IF EXISTS `log_resolve`;
CREATE TABLE `log_resolve` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `log_id` smallint(4) NOT NULL,
  `content` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;

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
INSERT INTO log_resolve VALUES ('76', '5029', '删除地址成功。');
INSERT INTO log_resolve VALUES ('77', '1029', '删除地址失败。');
INSERT INTO log_resolve VALUES ('78', '5030', '添加家庭用户成功。');
INSERT INTO log_resolve VALUES ('79', '1030', '添加家庭用户失败。');
INSERT INTO log_resolve VALUES ('80', '5031', '修改家庭用户成功。');
INSERT INTO log_resolve VALUES ('81', '1031', '修改家庭用户失败。');
INSERT INTO log_resolve VALUES ('82', '5032', '删除家庭用户成功。');
INSERT INTO log_resolve VALUES ('83', '1032', '删除家庭用户失败。');

-- ----------------------------
-- Table structure for `out_corde`
-- ----------------------------
DROP TABLE IF EXISTS `out_corde`;
CREATE TABLE `out_corde` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `money` float(6,2) NOT NULL,
  `user_id` smallint(4) NOT NULL,
  `group_id` smallint(4) NOT NULL,
  `mantype_id` smallint(4) NOT NULL,
  `subtype_id` smallint(4) NOT NULL,
  `addr_id` smallint(4) NOT NULL,
  `notes` varchar(104) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`),
  KEY `out_mantype_id` (`mantype_id`),
  KEY `out_subtype_id` (`subtype_id`),
  KEY `addr_id` (`addr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2104 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_corde
-- ----------------------------
INSERT INTO out_corde VALUES ('2100', '3.00', '63', '39', '181', '675', '157', 'd', '2012-08-11 15:56:29');
INSERT INTO out_corde VALUES ('2101', '3.00', '63', '39', '181', '674', '157', 'd', '2012-08-11 16:19:49');
INSERT INTO out_corde VALUES ('2102', '333.00', '2', '26', '179', '672', '102', '33', '2012-08-11 16:48:55');
INSERT INTO out_corde VALUES ('2103', '777.00', '2', '26', '179', '0', '102', '7779', '2012-08-11 16:52:11');

-- ----------------------------
-- Table structure for `out_mantype`
-- ----------------------------
DROP TABLE IF EXISTS `out_mantype`;
CREATE TABLE `out_mantype` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(4) NOT NULL,
  `store` smallint(4) DEFAULT NULL,
  `is_display` smallint(4) DEFAULT NULL,
  `name` char(16) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=184 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_mantype
-- ----------------------------
INSERT INTO out_mantype VALUES ('176', '34', '1', '1', 'aa', '2012-07-31 18:01:39');
INSERT INTO out_mantype VALUES ('178', '2', '1', '1', 'bb', '2012-08-01 17:19:24');
INSERT INTO out_mantype VALUES ('179', '2', '2', '1', 'ccc', '2012-08-01 17:19:39');
INSERT INTO out_mantype VALUES ('183', '63', '2', '1', 'ddd5', '2012-08-11 16:23:41');
INSERT INTO out_mantype VALUES ('180', '2', '4', '1', 'yyy', '2012-08-01 17:41:17');
INSERT INTO out_mantype VALUES ('182', '63', '3', '1', '555', '2012-08-11 15:21:39');
INSERT INTO out_mantype VALUES ('181', '63', '1', '1', 'TEST', '2012-08-11 14:44:59');
INSERT INTO out_mantype VALUES ('175', '2', '3', '1', 'a', '2012-07-31 15:39:16');
INSERT INTO out_mantype VALUES ('161', '30', '6', '1', '信息费', '2012-04-21 14:31:45');
INSERT INTO out_mantype VALUES ('39', '13', '19', '1', '合川路', '2010-09-06 09:23:04');
INSERT INTO out_mantype VALUES ('93', '18', '1', '1', '衣', '2011-06-11 21:10:40');
INSERT INTO out_mantype VALUES ('43', '3', '1', '1', '衣', '2010-09-26 14:47:34');
INSERT INTO out_mantype VALUES ('44', '3', '2', '1', '食', '2010-09-26 14:47:34');
INSERT INTO out_mantype VALUES ('45', '3', '2', '1', '住', '2010-09-26 14:47:34');
INSERT INTO out_mantype VALUES ('46', '3', '3', '1', '行', '2010-09-26 14:47:34');
INSERT INTO out_mantype VALUES ('47', '3', '4', '1', '我', '2010-09-26 14:47:34');
INSERT INTO out_mantype VALUES ('48', '3', '6', '1', '信息费4', '2010-09-26 14:47:34');
INSERT INTO out_mantype VALUES ('49', '5', '2', '1', '衣', '2010-09-26 15:11:46');
INSERT INTO out_mantype VALUES ('50', '5', '3', '1', '食', '2010-09-26 15:11:46');
INSERT INTO out_mantype VALUES ('51', '5', '1', '1', '住', '2010-09-26 15:11:46');
INSERT INTO out_mantype VALUES ('52', '5', '4', '1', '行', '2010-09-26 15:11:46');
INSERT INTO out_mantype VALUES ('53', '5', '5', '1', '我', '2010-09-26 15:11:46');
INSERT INTO out_mantype VALUES ('54', '5', '6', '1', '信息费', '2010-09-26 15:11:46');
INSERT INTO out_mantype VALUES ('55', '13', '1', '1', '衣', '2010-09-26 15:53:29');
INSERT INTO out_mantype VALUES ('56', '13', '3', '1', '食', '2010-09-26 15:53:29');
INSERT INTO out_mantype VALUES ('57', '13', '2', '1', '住', '2010-09-26 15:53:29');
INSERT INTO out_mantype VALUES ('58', '13', '6', '1', '行', '2010-09-26 15:53:29');
INSERT INTO out_mantype VALUES ('59', '13', '7', '1', '我', '2010-09-26 15:53:29');
INSERT INTO out_mantype VALUES ('60', '13', '8', '1', '信息费', '2010-09-26 15:53:29');
INSERT INTO out_mantype VALUES ('131', '0', '6', '1', '信息费', '2012-04-18 15:31:15');
INSERT INTO out_mantype VALUES ('130', '0', '5', '1', '我', '2012-04-18 15:31:15');
INSERT INTO out_mantype VALUES ('129', '0', '4', '1', '行', '2012-04-18 15:31:15');
INSERT INTO out_mantype VALUES ('128', '0', '3', '1', '住', '2012-04-18 15:31:15');
INSERT INTO out_mantype VALUES ('127', '0', '2', '1', '食', '2012-04-18 15:31:15');
INSERT INTO out_mantype VALUES ('126', '0', '1', '1', '衣', '2012-04-18 15:31:15');
INSERT INTO out_mantype VALUES ('160', '30', '5', '1', '我', '2012-04-21 14:31:45');
INSERT INTO out_mantype VALUES ('98', '18', '6', '1', '信息费', '2011-06-11 21:10:40');
INSERT INTO out_mantype VALUES ('97', '18', '5', '1', '我', '2011-06-11 21:10:40');
INSERT INTO out_mantype VALUES ('96', '18', '4', '1', '行', '2011-06-11 21:10:40');
INSERT INTO out_mantype VALUES ('95', '18', '3', '1', '住', '2011-06-11 21:10:40');
INSERT INTO out_mantype VALUES ('94', '18', '2', '1', '食', '2011-06-11 21:10:40');
INSERT INTO out_mantype VALUES ('104', '19', '6', '1', '信息费', '2011-06-11 21:16:35');
INSERT INTO out_mantype VALUES ('103', '19', '5', '1', '我', '2011-06-11 21:16:35');
INSERT INTO out_mantype VALUES ('102', '19', '4', '1', '行', '2011-06-11 21:16:35');
INSERT INTO out_mantype VALUES ('101', '19', '3', '1', '住', '2011-06-11 21:16:35');
INSERT INTO out_mantype VALUES ('100', '19', '2', '1', '食', '2011-06-11 21:16:35');
INSERT INTO out_mantype VALUES ('99', '19', '1', '1', '衣', '2011-06-11 21:16:35');
INSERT INTO out_mantype VALUES ('79', '1', '2', '1', '衣', '2010-10-16 13:32:20');
INSERT INTO out_mantype VALUES ('80', '1', '3', '1', '食', '2010-10-16 13:32:20');
INSERT INTO out_mantype VALUES ('81', '1', '2', '1', '住', '2010-10-16 13:32:20');
INSERT INTO out_mantype VALUES ('83', '1', '4', '1', '我', '2010-10-16 13:32:20');
INSERT INTO out_mantype VALUES ('84', '1', '5', '1', '信息费', '2010-10-16 13:32:20');
INSERT INTO out_mantype VALUES ('85', '3', '5', '1', '礼', '2010-12-22 13:07:18');
INSERT INTO out_mantype VALUES ('159', '30', '4', '1', '行', '2012-04-21 14:31:45');
INSERT INTO out_mantype VALUES ('158', '30', '3', '1', '住', '2012-04-21 14:31:45');
INSERT INTO out_mantype VALUES ('157', '30', '2', '1', '食', '2012-04-21 14:31:45');
INSERT INTO out_mantype VALUES ('156', '30', '1', '1', '衣', '2012-04-21 14:31:45');
INSERT INTO out_mantype VALUES ('155', '29', '6', '1', '信息费', '2012-04-21 14:31:02');
INSERT INTO out_mantype VALUES ('154', '29', '5', '1', '我', '2012-04-21 14:31:02');
INSERT INTO out_mantype VALUES ('153', '29', '4', '1', '行', '2012-04-21 14:31:02');
INSERT INTO out_mantype VALUES ('152', '29', '3', '1', '住', '2012-04-21 14:31:02');
INSERT INTO out_mantype VALUES ('151', '29', '2', '1', '食', '2012-04-21 14:31:02');
INSERT INTO out_mantype VALUES ('150', '29', '1', '1', '衣', '2012-04-21 14:31:02');

-- ----------------------------
-- Table structure for `out_subtype`
-- ----------------------------
DROP TABLE IF EXISTS `out_subtype`;
CREATE TABLE `out_subtype` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(4) NOT NULL,
  `man_id` smallint(4) NOT NULL,
  `store` smallint(4) DEFAULT NULL,
  `is_display` smallint(1) DEFAULT '1',
  `name` char(16) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `man_id` (`man_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=677 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_subtype
-- ----------------------------
INSERT INTO out_subtype VALUES ('673', '2', '179', '6', '1', 'f', '2012-08-01 17:55:18');
INSERT INTO out_subtype VALUES ('672', '2', '179', '1', '1', 'e', '2012-08-01 17:55:17');
INSERT INTO out_subtype VALUES ('657', '2', '23', '2', '1', 'abc', '2012-07-31 12:42:33');
INSERT INTO out_subtype VALUES ('656', '2', '23', '1', '1', 'TEST', '2012-07-31 12:38:05');
INSERT INTO out_subtype VALUES ('670', '2', '179', '4', '1', 'c', '2012-08-01 17:55:14');
INSERT INTO out_subtype VALUES ('669', '2', '179', '3', '1', 'b', '2012-08-01 17:55:12');
INSERT INTO out_subtype VALUES ('661', '2', '22', '3', '1', '', '2012-07-31 12:43:50');
INSERT INTO out_subtype VALUES ('668', '2', '179', '2', '1', 'a', '2012-08-01 17:55:11');
INSERT INTO out_subtype VALUES ('675', '63', '181', '3', '1', 'b', '2012-08-11 15:02:19');
INSERT INTO out_subtype VALUES ('649', '30', '161', '5', '1', '通信软件', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('125', '13', '39', '1', '1', '万源路', '2010-09-06 09:23:21');
INSERT INTO out_subtype VALUES ('648', '30', '161', '4', '1', '通信硬件', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('361', '18', '93', '1', '1', '服装', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('133', '3', '43', '1', '1', '服装', '2010-09-26 14:47:34');
INSERT INTO out_subtype VALUES ('134', '3', '43', '2', '1', '鞋帽', '2010-09-26 14:47:34');
INSERT INTO out_subtype VALUES ('135', '3', '44', '1', '1', '早餐', '2010-09-26 14:47:34');
INSERT INTO out_subtype VALUES ('136', '3', '44', '2', '1', '午餐', '2010-09-26 14:47:34');
INSERT INTO out_subtype VALUES ('137', '3', '44', '3', '1', '晚餐', '2010-09-26 14:47:34');
INSERT INTO out_subtype VALUES ('138', '3', '44', '4', '1', '夜宵', '2010-09-26 14:47:34');
INSERT INTO out_subtype VALUES ('139', '3', '45', '1', '1', '日常用品', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('140', '3', '45', '3', '1', '家用电器', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('141', '3', '45', '4', '1', '房租', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('142', '3', '46', '1', '1', '公交车', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('143', '3', '46', '2', '1', '的士', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('144', '3', '46', '3', '1', '地铁', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('145', '3', '46', '4', '1', '火车', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('146', '3', '46', '5', '1', '摩的', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('147', '3', '46', '6', '1', '飞机', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('148', '3', '46', '7', '1', '轮船', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('149', '3', '47', '1', '1', '零食', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('150', '3', '47', '2', '1', '饮料', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('151', '3', '47', '3', '1', '理发', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('152', '3', '48', '1', '1', '网络费', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('153', '3', '48', '2', '1', '手机费', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('154', '3', '48', '3', '1', '电话费', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('155', '3', '48', '4', '1', '通信硬件', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('156', '3', '48', '5', '1', '通信软件', '2010-09-26 14:47:35');
INSERT INTO out_subtype VALUES ('157', '5', '49', '1', '1', '服装', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('158', '5', '49', '2', '1', '鞋帽', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('159', '5', '50', '1', '1', '早餐', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('160', '5', '50', '2', '1', '午餐', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('161', '5', '50', '3', '1', '晚餐', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('162', '5', '50', '4', '1', '夜宵', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('163', '5', '51', '1', '1', '日常用品', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('164', '5', '51', '2', '1', '家用电器', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('165', '5', '51', '3', '1', '房租', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('166', '5', '52', '1', '1', '公交车', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('167', '5', '52', '2', '1', '的士', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('168', '5', '52', '3', '1', '地铁', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('169', '5', '52', '4', '1', '火车', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('170', '5', '52', '5', '1', '摩的', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('171', '5', '52', '6', '1', '飞机', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('172', '5', '52', '7', '1', '轮船', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('173', '5', '53', '1', '1', '零食', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('174', '5', '53', '2', '1', '饮料', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('175', '5', '53', '4', '1', '理发', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('176', '5', '54', '1', '1', '网络费', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('177', '5', '54', '2', '1', '手机费', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('178', '5', '54', '3', '1', '电话费', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('179', '5', '54', '4', '1', '通信硬件', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('180', '5', '54', '5', '1', '通信软件', '2010-09-26 15:11:46');
INSERT INTO out_subtype VALUES ('181', '13', '55', '1', '1', '服装', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('182', '13', '55', '2', '1', '鞋帽', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('183', '13', '56', '1', '1', '早餐', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('184', '13', '56', '2', '1', '午餐', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('185', '13', '56', '3', '1', '晚餐', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('186', '13', '56', '4', '1', '夜宵', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('187', '13', '57', '1', '1', '日常用品', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('188', '13', '57', '2', '1', '家用电器', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('189', '13', '57', '3', '1', '房租', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('190', '13', '58', '1', '1', '公交车', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('191', '13', '58', '2', '1', '的士', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('192', '13', '58', '3', '1', '地铁', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('193', '13', '58', '4', '1', '火车', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('194', '13', '58', '5', '1', '摩的', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('195', '13', '58', '6', '1', '飞机', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('196', '13', '58', '7', '1', '轮船', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('197', '13', '59', '1', '1', '零食', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('198', '13', '59', '2', '1', '饮料', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('199', '13', '59', '3', '1', '理发', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('200', '13', '60', '1', '1', '网络费', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('201', '13', '60', '2', '1', '手机费', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('202', '13', '60', '3', '1', '电话费', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('203', '13', '60', '4', '1', '通信硬件', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('204', '13', '60', '5', '1', '通信软件', '2010-09-26 15:53:29');
INSERT INTO out_subtype VALUES ('529', '0', '131', '5', '1', '通信软件', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('528', '0', '131', '4', '1', '通信硬件', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('527', '0', '131', '3', '1', '电话费', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('526', '0', '131', '2', '1', '手机费', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('525', '0', '131', '1', '1', '网络费', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('524', '0', '130', '3', '1', '理发', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('523', '0', '130', '2', '1', '饮料', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('522', '0', '130', '1', '1', '零食', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('521', '0', '129', '7', '1', '轮船', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('520', '0', '129', '6', '1', '飞机', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('519', '0', '129', '5', '1', '摩的', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('518', '0', '129', '4', '1', '火车', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('517', '0', '129', '3', '1', '地铁', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('516', '0', '129', '2', '1', '的士', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('515', '0', '129', '1', '1', '公交车', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('514', '0', '128', '3', '1', '房租', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('513', '0', '128', '2', '1', '家用电器', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('512', '0', '128', '1', '1', '日常用品', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('511', '0', '127', '4', '1', '夜宵', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('510', '0', '127', '3', '1', '晚餐', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('509', '0', '127', '2', '1', '午餐', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('508', '0', '127', '1', '1', '早餐', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('507', '0', '126', '2', '1', '鞋帽', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('506', '0', '126', '1', '1', '服装', '2012-04-18 15:31:15');
INSERT INTO out_subtype VALUES ('647', '30', '161', '3', '1', '电话费', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('384', '18', '98', '5', '1', '通信软件', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('383', '18', '98', '4', '1', '通信硬件', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('382', '18', '98', '3', '1', '电话费', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('381', '18', '98', '2', '1', '手机费', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('380', '18', '98', '1', '1', '网络费', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('379', '18', '97', '3', '1', '理发', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('378', '18', '97', '2', '1', '饮料', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('377', '18', '97', '1', '1', '零食', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('376', '18', '96', '7', '1', '轮船', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('375', '18', '96', '6', '1', '飞机', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('374', '18', '96', '5', '1', '摩的', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('373', '18', '96', '4', '1', '火车', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('372', '18', '96', '3', '1', '地铁', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('371', '18', '96', '2', '1', '的士', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('370', '18', '96', '1', '1', '公交车', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('369', '18', '95', '3', '1', '房租', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('368', '18', '95', '2', '1', '家用电器', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('367', '18', '95', '1', '1', '日常用品', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('366', '18', '94', '4', '1', '夜宵', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('365', '18', '94', '3', '1', '晚餐', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('364', '18', '94', '2', '1', '午餐', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('363', '18', '94', '1', '1', '早餐', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('362', '18', '93', '2', '1', '鞋帽', '2011-06-11 21:10:40');
INSERT INTO out_subtype VALUES ('408', '19', '104', '5', '1', '通信软件', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('407', '19', '104', '4', '1', '通信硬件', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('406', '19', '104', '3', '1', '电话费', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('405', '19', '104', '2', '1', '手机费', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('404', '19', '104', '1', '1', '网络费', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('403', '19', '103', '3', '1', '理发', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('402', '19', '103', '2', '1', '饮料', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('401', '19', '103', '1', '1', '零食', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('400', '19', '102', '7', '1', '轮船', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('399', '19', '102', '6', '1', '飞机', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('398', '19', '102', '5', '1', '摩的', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('397', '19', '102', '4', '1', '火车', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('396', '19', '102', '3', '1', '地铁', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('395', '19', '102', '2', '1', '的士', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('394', '19', '102', '1', '1', '公交车', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('393', '19', '101', '3', '1', '房租', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('392', '19', '101', '2', '1', '家用电器', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('391', '19', '101', '1', '1', '日常用品', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('390', '19', '100', '4', '1', '夜宵', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('389', '19', '100', '3', '1', '晚餐', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('388', '19', '100', '2', '1', '午餐', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('387', '19', '100', '1', '1', '早餐', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('386', '19', '99', '2', '1', '鞋帽', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('385', '19', '99', '1', '1', '服装', '2011-06-11 21:16:35');
INSERT INTO out_subtype VALUES ('667', '2', '175', '3', '1', 'eee', '2012-08-01 17:40:52');
INSERT INTO out_subtype VALUES ('280', '1', '79', '1', '1', '服装', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('282', '1', '80', '1', '1', '早餐', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('283', '1', '80', '2', '1', '午餐', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('284', '1', '80', '3', '1', '晚餐', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('285', '1', '80', '4', '1', '夜宵', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('286', '1', '81', '1', '1', '日常用品', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('287', '1', '81', '2', '1', '家用电器', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('288', '1', '81', '3', '1', '房租', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('289', '1', '82', '1', '1', '公交车', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('290', '1', '82', '2', '1', '的士', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('291', '1', '82', '3', '1', '地铁', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('292', '1', '82', '4', '1', '火车', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('293', '1', '82', '5', '1', '摩的', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('294', '1', '82', '6', '1', '飞机', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('295', '1', '82', '7', '1', '轮船', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('296', '1', '83', '1', '1', '零食', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('297', '1', '83', '2', '1', '饮料', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('298', '1', '83', '3', '1', '理发', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('299', '1', '84', '1', '1', '网络费', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('300', '1', '84', '2', '1', '手机费', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('301', '1', '84', '3', '1', '电话费', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('302', '1', '84', '5', '1', '通信222硬件', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('303', '1', '84', '4', '1', '通信软件', '2010-10-16 13:32:20');
INSERT INTO out_subtype VALUES ('660', '2', '22', '2', '1', '活期', '2012-07-31 12:43:47');
INSERT INTO out_subtype VALUES ('313', '3', '85', '1', '1', '贺礼', '2010-12-22 13:28:11');
INSERT INTO out_subtype VALUES ('315', '5', '53', '5', '1', '玩具', '2011-01-29 15:11:20');
INSERT INTO out_subtype VALUES ('659', '2', '22', '1', '1', 'abc', '2012-07-31 12:43:13');
INSERT INTO out_subtype VALUES ('671', '2', '179', '5', '1', 'd', '2012-08-01 17:55:15');
INSERT INTO out_subtype VALUES ('666', '2', '175', '5', '1', 'rrr', '2012-08-01 17:40:49');
INSERT INTO out_subtype VALUES ('324', '3', '44', '5', '1', '买菜', '2011-04-03 22:25:37');
INSERT INTO out_subtype VALUES ('325', '3', '44', '6', '1', '糕点+面点', '2011-04-03 22:34:23');
INSERT INTO out_subtype VALUES ('326', '3', '47', '4', '1', '个人用品', '2011-04-03 22:40:18');
INSERT INTO out_subtype VALUES ('327', '3', '85', '2', '1', '佛缘', '2011-04-03 22:47:17');
INSERT INTO out_subtype VALUES ('654', '2', '75', '2', '0', 'aaaccc', '2012-07-31 11:45:26');
INSERT INTO out_subtype VALUES ('330', '5', '53', '3', '1', '健康', '2011-04-29 17:26:45');
INSERT INTO out_subtype VALUES ('331', '3', '45', '2', '1', '日常开销', '2011-05-03 13:15:07');
INSERT INTO out_subtype VALUES ('334', '3', '45', '5', '1', '健康', '2011-05-29 22:33:16');
INSERT INTO out_subtype VALUES ('664', '34', '176', '1', '1', 'aaa', '2012-07-31 18:01:42');
INSERT INTO out_subtype VALUES ('646', '30', '161', '2', '1', '手机费', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('645', '30', '161', '1', '1', '网络费', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('644', '30', '160', '3', '1', '理发', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('643', '30', '160', '2', '1', '饮料', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('642', '30', '160', '1', '1', '零食', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('641', '30', '159', '7', '1', '轮船', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('640', '30', '159', '6', '1', '飞机', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('639', '30', '159', '5', '1', '摩的', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('638', '30', '159', '4', '1', '火车', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('637', '30', '159', '3', '1', '地铁', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('636', '30', '159', '2', '1', '的士', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('635', '30', '159', '1', '1', '公交车', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('634', '30', '158', '3', '1', '房租', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('633', '30', '158', '2', '1', '家用电器', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('632', '30', '158', '1', '1', '日常用品', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('631', '30', '157', '4', '1', '夜宵', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('630', '30', '157', '3', '1', '晚餐', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('629', '30', '157', '2', '1', '午餐', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('628', '30', '157', '1', '1', '早餐', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('627', '30', '156', '2', '1', '鞋帽', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('626', '30', '156', '1', '1', '服装', '2012-04-21 14:31:45');
INSERT INTO out_subtype VALUES ('674', '63', '181', '1', '1', 'a', '2012-08-11 15:02:14');
INSERT INTO out_subtype VALUES ('435', '3', '44', '7', '1', '水果', '2011-07-02 23:02:44');
INSERT INTO out_subtype VALUES ('436', '3', '44', '8', '1', '零食', '2011-07-02 23:02:59');
INSERT INTO out_subtype VALUES ('438', '3', '46', '8', '1', '汽油费', '2011-07-02 23:25:58');
INSERT INTO out_subtype VALUES ('444', '3', '44', '9', '1', '补品', '2011-08-31 22:28:50');
INSERT INTO out_subtype VALUES ('663', '2', '175', '4', '1', 'ddd', '2012-07-31 15:39:38');
INSERT INTO out_subtype VALUES ('662', '2', '175', '1', '0', 'cc', '2012-07-31 15:39:20');
INSERT INTO out_subtype VALUES ('625', '29', '155', '5', '1', '通信软件', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('478', '5', '53', '6', '1', '教育', '2011-12-21 22:39:44');
INSERT INTO out_subtype VALUES ('652', '2', '75', '1', '1', 'aaa', '2012-07-31 11:44:32');
INSERT INTO out_subtype VALUES ('624', '29', '155', '4', '1', '通信硬件', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('623', '29', '155', '3', '1', '电话费', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('622', '29', '155', '2', '1', '手机费', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('621', '29', '155', '1', '1', '网络费', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('620', '29', '154', '3', '1', '理发', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('619', '29', '154', '2', '1', '饮料', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('618', '29', '154', '1', '1', '零食', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('617', '29', '153', '7', '1', '轮船', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('616', '29', '153', '6', '1', '飞机', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('615', '29', '153', '5', '1', '摩的', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('614', '29', '153', '4', '1', '火车', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('613', '29', '153', '3', '1', '地铁', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('612', '29', '153', '2', '1', '的士', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('611', '29', '153', '1', '1', '公交车', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('610', '29', '152', '3', '1', '房租', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('609', '29', '152', '2', '1', '家用电器', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('608', '29', '152', '1', '1', '日常用品', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('607', '29', '151', '4', '1', '夜宵', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('606', '29', '151', '3', '1', '晚餐', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('605', '29', '151', '2', '1', '午餐', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('604', '29', '151', '1', '1', '早餐', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('603', '29', '150', '2', '1', '鞋帽', '2012-04-21 14:31:02');
INSERT INTO out_subtype VALUES ('602', '29', '150', '1', '1', '服装', '2012-04-21 14:31:02');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `is_disable` smallint(2) DEFAULT '0',
  `username` char(16) NOT NULL,
  `user_alias` char(20) DEFAULT NULL,
  `password` char(64) NOT NULL,
  `notes` varchar(50) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `last_date` datetime NOT NULL,
  `skin` smallint(2) DEFAULT '0',
  `session` char(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO users VALUES ('0', '1', 'admin', '管理员', '*E12D48AE5735D8CA0F88145868AF87C5D45F6C53', '管理个人收支系统账号', '2010-07-25 00:00:00', '2012-06-28 18:03:44', '0', 'c4e013278d554b325f280ef5837be248');
INSERT INTO users VALUES ('2', '0', 'chenbk', '蓝色阳光2', '*E12D48AE5735D8CA0F88145868AF87C5D45F6C53', '陈炳坤', '2010-07-25 23:31:10', '2012-08-11 18:04:39', '0', '4852fa1c87d34de5b553a62af8debd75');
INSERT INTO users VALUES ('63', '0', '123', '123', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '123', '2012-08-11 14:20:52', '2012-08-11 16:41:42', '0', '4852fa1c87d34de5b553a62af8debd75');
INSERT INTO users VALUES ('58', '0', 'zdr123', '朱道荣4', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '朱道荣4', '2012-08-06 17:44:04', '2012-08-06 17:56:15', '0', 'c5f8cb854315570dc1b077addbf91309');

-- ----------------------------
-- Table structure for `user_group`
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `user_id` smallint(4) NOT NULL,
  `group_id` smallint(4) NOT NULL,
  `granddad` smallint(4) NOT NULL DEFAULT '0',
  `paternity` smallint(4) NOT NULL DEFAULT '0',
  `brother` smallint(4) NOT NULL DEFAULT '0',
  `consort` smallint(4) NOT NULL DEFAULT '0',
  `friend` smallint(4) NOT NULL DEFAULT '0',
  `colleague` smallint(4) NOT NULL DEFAULT '0',
  `notes` varchar(50) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `disable` smallint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`user_id`) USING BTREE,
  UNIQUE KEY `user_id` (`user_id`) USING BTREE,
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_group
-- ----------------------------
INSERT INTO user_group VALUES ('43', '3', '15', '0', '0', '0', '0', '0', '0', null, '2012-04-18 15:46:42', '0');
INSERT INTO user_group VALUES ('2', '1', '3', '0', '0', '0', '0', '0', '0', 'TEST', '2010-08-08 00:00:00', '0');
INSERT INTO user_group VALUES ('56', '30', '0', '0', '0', '0', '0', '0', '0', null, '2012-04-21 14:31:45', '1');
INSERT INTO user_group VALUES ('55', '29', '0', '0', '0', '0', '0', '0', '0', null, '2012-04-21 14:31:02', '1');
INSERT INTO user_group VALUES ('23', '13', '8', '0', '0', '0', '0', '0', '0', null, '2011-06-11 20:45:55', '0');
INSERT INTO user_group VALUES ('33', '18', '14', '0', '0', '0', '0', '0', '0', null, '2011-06-11 21:19:27', '0');
INSERT INTO user_group VALUES ('32', '19', '14', '0', '0', '0', '0', '0', '0', null, '2011-06-11 21:18:40', '0');
INSERT INTO user_group VALUES ('58', '2', '26', '0', '0', '0', '0', '0', '0', null, '2012-06-28 18:04:47', '0');
INSERT INTO user_group VALUES ('59', '34', '26', '0', '0', '0', '0', '0', '0', null, '2012-07-31 17:39:57', '0');
INSERT INTO user_group VALUES ('60', '35', '26', '0', '0', '0', '0', '0', '0', null, '2012-07-31 18:00:18', '0');
INSERT INTO user_group VALUES ('61', '36', '26', '0', '0', '0', '0', '0', '0', null, '2012-08-01 10:08:56', '0');
INSERT INTO user_group VALUES ('62', '37', '26', '0', '0', '0', '0', '0', '0', null, '2012-08-01 10:15:12', '0');
INSERT INTO user_group VALUES ('63', '38', '26', '0', '0', '0', '0', '0', '0', null, '2012-08-01 10:48:11', '0');
INSERT INTO user_group VALUES ('64', '39', '26', '0', '0', '0', '0', '0', '0', null, '2012-08-01 10:58:04', '0');
INSERT INTO user_group VALUES ('65', '40', '26', '0', '0', '0', '0', '0', '0', null, '2012-08-01 11:08:28', '0');
INSERT INTO user_group VALUES ('66', '41', '26', '0', '0', '0', '0', '0', '0', null, '2012-08-01 11:11:15', '0');
INSERT INTO user_group VALUES ('67', '42', '26', '0', '0', '0', '0', '0', '0', null, '2012-08-01 11:22:52', '0');
INSERT INTO user_group VALUES ('68', '43', '26', '0', '0', '0', '0', '0', '0', null, '2012-08-01 11:42:19', '0');
INSERT INTO user_group VALUES ('69', '44', '26', '0', '0', '0', '0', '0', '0', null, '2012-08-01 11:43:54', '0');
INSERT INTO user_group VALUES ('70', '45', '26', '0', '0', '0', '0', '0', '0', null, '2012-08-01 11:50:09', '0');
INSERT INTO user_group VALUES ('71', '46', '26', '0', '0', '0', '0', '0', '0', null, '2012-08-01 11:51:07', '0');
INSERT INTO user_group VALUES ('72', '47', '26', '0', '0', '0', '0', '0', '0', null, '2012-08-01 11:53:38', '0');
INSERT INTO user_group VALUES ('73', '48', '15', '0', '0', '0', '0', '0', '0', null, '2012-08-01 16:46:10', '0');
INSERT INTO user_group VALUES ('74', '0', '0', '0', '0', '0', '0', '0', '0', null, '2012-08-06 16:26:32', '0');
INSERT INTO user_group VALUES ('75', '50', '29', '0', '0', '0', '0', '0', '0', null, '2012-08-06 16:28:45', '0');
INSERT INTO user_group VALUES ('76', '51', '30', '0', '0', '0', '0', '0', '0', null, '2012-08-06 16:30:54', '0');
INSERT INTO user_group VALUES ('77', '52', '31', '0', '0', '0', '0', '0', '0', null, '2012-08-06 16:32:17', '0');
INSERT INTO user_group VALUES ('78', '53', '32', '0', '0', '0', '0', '0', '0', null, '2012-08-06 16:39:49', '0');
INSERT INTO user_group VALUES ('79', '54', '33', '0', '0', '0', '0', '0', '0', null, '2012-08-06 16:49:29', '0');
INSERT INTO user_group VALUES ('80', '55', '34', '0', '0', '0', '0', '0', '0', null, '2012-08-06 16:52:14', '0');
INSERT INTO user_group VALUES ('81', '56', '35', '0', '0', '0', '0', '0', '0', null, '2012-08-06 16:53:05', '0');
INSERT INTO user_group VALUES ('82', '57', '36', '0', '0', '0', '0', '0', '0', null, '2012-08-06 16:56:12', '0');
INSERT INTO user_group VALUES ('83', '58', '37', '0', '0', '0', '0', '0', '0', null, '2012-08-06 17:44:04', '0');
INSERT INTO user_group VALUES ('84', '5', '37', '0', '0', '0', '0', '0', '0', null, '2012-08-06 17:46:36', '0');
INSERT INTO user_group VALUES ('85', '60', '37', '0', '0', '0', '0', '0', '0', null, '2012-08-06 17:57:30', '0');
INSERT INTO user_group VALUES ('86', '61', '38', '0', '0', '0', '0', '0', '0', null, '2012-08-11 14:11:55', '0');
INSERT INTO user_group VALUES ('88', '63', '39', '0', '0', '0', '0', '0', '0', null, '2012-08-11 14:20:52', '0');
INSERT INTO user_group VALUES ('89', '64', '39', '0', '0', '0', '0', '0', '0', null, '2012-08-11 14:57:12', '0');
INSERT INTO user_group VALUES ('90', '65', '39', '0', '0', '0', '0', '0', '0', null, '2012-08-11 16:20:00', '0');

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
