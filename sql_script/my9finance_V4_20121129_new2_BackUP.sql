/*
Navicat MySQL Data Transfer

Source Server         : My9finance[127.0.0.1]
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : my9finance

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-11-29 19:29:18
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
  KEY `user_id` (`F_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=354 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO address VALUES ('349', '570', '1', '1', '住房处', '1348825503');
INSERT INTO address VALUES ('350', '570', '2', '1', '公司', '1348825503');
INSERT INTO address VALUES ('351', '570', '4', '1', '超市菜市场', '1348825503');
INSERT INTO address VALUES ('352', '570', '5', '1', '商场', '1348825503');
INSERT INTO address VALUES ('353', '570', '3', '1', '其他', '1348825503');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bank_card
-- ----------------------------
INSERT INTO bank_card VALUES ('4', '119', '570', '中国建行', '2342343234234', '储蓄卡', '福建泉州', '0.00', '0', '0', '朝秦暮楚', '1348898496');
INSERT INTO bank_card VALUES ('5', '118', '570', '中国建行2', '324234324324', '信用卡', '福建泉州', '324324.00', '0', '0', '', '1348898718');
INSERT INTO bank_card VALUES ('6', '118', '570', '中国很行', '23432432443', '支付宝卡', '中国泉州', '234234.00', '0', '0', 'TEST', '1348899762');

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bug
-- ----------------------------
INSERT INTO bug VALUES ('9', '100', '570', 'bug', '2', '不能修改主题3', '测试,测试.3', '1348815020', '0');
INSERT INTO bug VALUES ('8', '96', '555', 'bug', '1', '测试BUG', '提交一个BUG。', '1348802775', '0');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  UNIQUE KEY `username` (`U_name`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of family_munber
-- ----------------------------
INSERT INTO family_munber VALUES ('118', '0', 'chenbk', '陈炳坤', '570', '', '1348825503', '1354172340', '5', '21', 'chenbingkun55@163.com', '234324');
INSERT INTO family_munber VALUES ('119', '0', 'abc', 'ABC', '570', '', '1348884653', '1349752341', '1', '15', 'abc@163.com', '12312312312');

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
  KEY `user_id` (`U_id`),
  KEY `group_id` (`F_id`),
  KEY `out_mantype_id` (`M_id`),
  KEY `out_subtype_id` (`S_id`),
  KEY `addr_id` (`A_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2180 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_corde
-- ----------------------------
INSERT INTO in_corde VALUES ('2167', '3434.00', '118', '570', '0', '426', '1642', '350', 'sdfa', '1348826313');
INSERT INTO in_corde VALUES ('2168', '102.00', '118', '570', '0', '429', '1655', '349', '回家', '1348826679');
INSERT INTO in_corde VALUES ('2171', '9999.99', '118', '570', '0', '426', '1640', '349', 'dsf', '1348884817');
INSERT INTO in_corde VALUES ('2172', '30.00', '118', '570', '0', '426', '1640', '349', 'dfa', '1348912072');
INSERT INTO in_corde VALUES ('2173', '30.00', '118', '570', '0', '426', '1640', '350', 'TEST', '1348912479');
INSERT INTO in_corde VALUES ('2174', '20.00', '118', '570', '0', '426', '1642', '349', 'TEST', '1348912495');
INSERT INTO in_corde VALUES ('2175', '40.00', '118', '570', '0', '427', '1645', '353', 'sdaf', '1348912516');
INSERT INTO in_corde VALUES ('2176', '23.00', '118', '570', '0', '427', '1644', '350', 'sdaf', '1348912766');
INSERT INTO in_corde VALUES ('2177', '40.00', '118', '570', '0', '427', '1645', '349', '在', '1348913225');
INSERT INTO in_corde VALUES ('2178', '120.00', '119', '570', '0', '426', '1642', '352', '鞋子', '1349752369');
INSERT INTO in_corde VALUES ('2179', '10.00', '118', '570', '0', '429', '1652', '350', '去图书馆', '1349922982');

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
  KEY `user_id` (`F_id`)
) ENGINE=MyISAM AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_mantype
-- ----------------------------
INSERT INTO in_mantype VALUES ('161', '570', '1', '1', '固定收入', '1348825503');
INSERT INTO in_mantype VALUES ('162', '570', '2', '1', '第三方收入', '1348825503');

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
  KEY `man_id` (`M_id`),
  KEY `user_id` (`F_id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of in_subtype
-- ----------------------------
INSERT INTO in_subtype VALUES ('235', '570', '161', '1', '1', '工资', '1348825503');
INSERT INTO in_subtype VALUES ('236', '570', '161', '2', '1', '奖金', '1348825503');
INSERT INTO in_subtype VALUES ('237', '570', '162', '1', '1', '中奖', '1348825503');
INSERT INTO in_subtype VALUES ('238', '570', '162', '2', '1', '兼职', '1348825503');
INSERT INTO in_subtype VALUES ('239', '570', '162', '3', '1', '其他', '1348825503');

-- ----------------------------
-- Table structure for `log_resolve`
-- ----------------------------
DROP TABLE IF EXISTS `log_resolve`;
CREATE TABLE `log_resolve` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT,
  `log_id` smallint(4) NOT NULL,
  `content` char(100) NOT NULL,
  PRIMARY KEY (`id`)
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
INSERT INTO log_resolve VALUES ('98', '5041', '修改现金成功.');
INSERT INTO log_resolve VALUES ('99', '1041', '修改现金失败.');
INSERT INTO log_resolve VALUES ('100', '5042', '删除现金成功.');
INSERT INTO log_resolve VALUES ('101', '1042', '删除现金失败.');

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
  KEY `user_id` (`U_id`),
  KEY `group_id` (`F_id`),
  KEY `out_mantype_id` (`M_id`),
  KEY `out_subtype_id` (`S_id`),
  KEY `addr_id` (`A_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2180 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_corde
-- ----------------------------
INSERT INTO out_corde VALUES ('2167', '3434.00', '118', '570', '0', '426', '1642', '350', 'sdfa', '1348826313');
INSERT INTO out_corde VALUES ('2168', '102.00', '118', '570', '0', '429', '1655', '349', '回家', '1348826679');
INSERT INTO out_corde VALUES ('2171', '9999.99', '118', '570', '0', '426', '1640', '349', 'dsf', '1348884817');
INSERT INTO out_corde VALUES ('2172', '30.00', '118', '570', '0', '426', '1640', '349', 'dfa', '1348912072');
INSERT INTO out_corde VALUES ('2173', '30.00', '118', '570', '0', '426', '1640', '350', 'TEST', '1348912479');
INSERT INTO out_corde VALUES ('2174', '20.00', '118', '570', '0', '426', '1642', '349', 'TEST', '1348912495');
INSERT INTO out_corde VALUES ('2175', '40.00', '118', '570', '0', '427', '1645', '353', 'sdaf', '1348912516');
INSERT INTO out_corde VALUES ('2176', '23.00', '118', '570', '0', '427', '1644', '350', 'sdaf', '1348912766');
INSERT INTO out_corde VALUES ('2177', '40.00', '118', '570', '0', '427', '1645', '349', '在', '1348913225');
INSERT INTO out_corde VALUES ('2178', '120.00', '119', '570', '0', '426', '1642', '352', '鞋子', '1349752369');
INSERT INTO out_corde VALUES ('2179', '10.00', '118', '570', '0', '429', '1652', '350', '去图书馆', '1349922982');

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
  KEY `user_id` (`F_id`)
) ENGINE=MyISAM AUTO_INCREMENT=432 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_mantype
-- ----------------------------
INSERT INTO out_mantype VALUES ('426', '570', '1', '1', '衣服类', '1348825503');
INSERT INTO out_mantype VALUES ('427', '570', '2', '1', '饮食类', '1348825503');
INSERT INTO out_mantype VALUES ('428', '570', '3', '1', '住房类', '1348825503');
INSERT INTO out_mantype VALUES ('429', '570', '4', '1', '交通类', '1348825503');
INSERT INTO out_mantype VALUES ('430', '570', '5', '1', '个人消费类', '1348825503');
INSERT INTO out_mantype VALUES ('431', '570', '6', '1', '网络类', '1348825503');

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
  KEY `man_id` (`M_id`),
  KEY `user_id` (`F_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1669 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of out_subtype
-- ----------------------------
INSERT INTO out_subtype VALUES ('1640', '570', '426', '1', '1', '服装', '1348825503');
INSERT INTO out_subtype VALUES ('1641', '570', '426', '3', '1', '其他', '1348825503');
INSERT INTO out_subtype VALUES ('1642', '570', '426', '2', '1', '鞋帽', '1348825503');
INSERT INTO out_subtype VALUES ('1643', '570', '427', '1', '1', '早餐', '1348825503');
INSERT INTO out_subtype VALUES ('1644', '570', '427', '2', '1', '午餐', '1348825503');
INSERT INTO out_subtype VALUES ('1645', '570', '427', '3', '1', '晚餐', '1348825503');
INSERT INTO out_subtype VALUES ('1646', '570', '427', '4', '1', '夜宵', '1348825503');
INSERT INTO out_subtype VALUES ('1647', '570', '427', '5', '1', '其他', '1348825503');
INSERT INTO out_subtype VALUES ('1648', '570', '428', '1', '1', '日常用品', '1348825503');
INSERT INTO out_subtype VALUES ('1649', '570', '428', '2', '1', '家用电器', '1348825503');
INSERT INTO out_subtype VALUES ('1650', '570', '428', '3', '1', '房租', '1348825503');
INSERT INTO out_subtype VALUES ('1651', '570', '428', '4', '1', '其他', '1348825503');
INSERT INTO out_subtype VALUES ('1652', '570', '429', '1', '1', '公交车', '1348825503');
INSERT INTO out_subtype VALUES ('1653', '570', '429', '2', '1', '的士', '1348825503');
INSERT INTO out_subtype VALUES ('1654', '570', '429', '3', '1', '地铁', '1348825503');
INSERT INTO out_subtype VALUES ('1655', '570', '429', '4', '1', '火车', '1348825503');
INSERT INTO out_subtype VALUES ('1656', '570', '429', '5', '1', '摩的', '1348825503');
INSERT INTO out_subtype VALUES ('1657', '570', '429', '6', '1', '飞机', '1348825503');
INSERT INTO out_subtype VALUES ('1658', '570', '429', '7', '1', '轮船', '1348825503');
INSERT INTO out_subtype VALUES ('1659', '570', '429', '8', '1', '其他', '1348825503');
INSERT INTO out_subtype VALUES ('1660', '570', '430', '1', '1', '零食', '1348825503');
INSERT INTO out_subtype VALUES ('1661', '570', '430', '2', '1', '饮料', '1348825503');
INSERT INTO out_subtype VALUES ('1662', '570', '430', '3', '1', '理发', '1348825503');
INSERT INTO out_subtype VALUES ('1663', '570', '430', '4', '1', '其他', '1348825503');
INSERT INTO out_subtype VALUES ('1664', '570', '431', '1', '1', '网络费', '1348825503');
INSERT INTO out_subtype VALUES ('1665', '570', '431', '2', '1', '手机费', '1348825503');
INSERT INTO out_subtype VALUES ('1666', '570', '431', '3', '1', '电话费', '1348825503');
INSERT INTO out_subtype VALUES ('1667', '570', '431', '4', '1', '通信软硬件', '1348825503');
INSERT INTO out_subtype VALUES ('1668', '570', '431', '5', '1', '其他', '1348825503');
