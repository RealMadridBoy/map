/*
Navicat MySQL Data Transfer

Source Server         : innerHost
Source Server Version : 50626
Source Host           : localhost:3306
Source Database       : map

Target Server Type    : MYSQL
Target Server Version : 50626
File Encoding         : 65001

Date: 2016-05-06 18:21:19
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `drone`
-- ----------------------------
DROP TABLE IF EXISTS `drone`;
CREATE TABLE `drone` (
  `id_drone` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) DEFAULT NULL,
  `lat` float(20,8) DEFAULT NULL,
  `lng` float(20,8) DEFAULT NULL,
  `mph` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_drone`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of drone
-- ----------------------------
INSERT INTO `drone` VALUES ('1', 'drone in NY', '40.71916199', '-74.33212280', '20');
INSERT INTO `drone` VALUES ('2', 'brooklyn drone', '40.67751312', '-73.93524170', '10');
INSERT INTO `drone` VALUES ('3', 'vegas drone', '36.12012863', '-115.21362305', '50');
INSERT INTO `drone` VALUES ('4', 'border drone', '32.60235977', '-116.08154297', '100');
INSERT INTO `drone` VALUES ('5', 'LA drone', '34.06175995', '-118.10302734', '20');
INSERT INTO `drone` VALUES ('6', 'LA2 drone', '34.37064362', '-118.66333008', '10');
INSERT INTO `drone` VALUES ('7', 'SF drone', '37.84015656', '-122.36572266', '35');
INSERT INTO `drone` VALUES ('8', 'Houston drone', '29.70713997', '-95.33935547', '5');
