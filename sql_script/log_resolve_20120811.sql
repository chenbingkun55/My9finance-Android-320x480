/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 60004
Source Host           : localhost:3306
Source Database       : my9finance

Target Server Type    : MYSQL
Target Server Version : 60004
File Encoding         : 65001

Date: 2012-08-11 16:19:32
*/

SET FOREIGN_KEY_CHECKS=0;
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
