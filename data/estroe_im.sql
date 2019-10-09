/*
 Navicat Premium Data Transfer

 Source Server         : 106.13.184.147
 Source Server Type    : MySQL
 Source Server Version : 50727
 Source Host           : 106.13.184.147:3306
 Source Schema         : estroe_im

 Target Server Type    : MySQL
 Target Server Version : 50727
 File Encoding         : 65001

 Date: 10/10/2019 07:11:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for adderss
-- ----------------------------
DROP TABLE IF EXISTS `adderss`;
CREATE TABLE `adderss` (
  `add_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '收货人编号',
  `add_name` varchar(50) DEFAULT NULL COMMENT '收货人姓名',
  `add_derss` varchar(100) DEFAULT NULL COMMENT '收货地址',
  `add_tel` varchar(15) DEFAULT NULL COMMENT '收货电话',
  `add_email` varchar(80) DEFAULT NULL COMMENT '收货邮箱',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '用户编号',
  `add_time` datetime DEFAULT NULL COMMENT '填写时间',
  PRIMARY KEY (`add_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of adderss
-- ----------------------------
BEGIN;
INSERT INTO `adderss` VALUES (9, '乔帅', '河南省郑州市', '13223809798', '1145938682@qq.com', 1, '2016-09-19 15:38:27');
INSERT INTO `adderss` VALUES (16, 'qiaoshuai', '北京市朝阳区', '13295158684', '13295158684@163.com', 12, '2019-10-05 23:24:30');
INSERT INTO `adderss` VALUES (19, 'test2', '测试地址', '13295158684', '13295158684@163.com', 23, '2019-10-08 17:40:13');
INSERT INTO `adderss` VALUES (20, 'yonghu4', '北京', '11111111111', '', 19, '2019-10-08 20:54:03');
INSERT INTO `adderss` VALUES (21, '111', '111', '1111', '', 26, '2019-10-08 21:12:19');
INSERT INTO `adderss` VALUES (22, '111', '111', '11111111111', '', 26, '2019-10-08 21:12:28');
INSERT INTO `adderss` VALUES (23, 'test2', '1213123132', '11111111111', '1145938682@qq.com', 23, '2019-10-08 21:16:35');
INSERT INTO `adderss` VALUES (24, '434', '324', '324', '324', 27, '2019-10-08 23:20:01');
INSERT INTO `adderss` VALUES (25, 'kd', '2432', '11111111111', '', 27, '2019-10-08 23:20:17');
INSERT INTO `adderss` VALUES (26, '111', '111', '11111111111', '', 28, '2019-10-09 13:31:44');
COMMIT;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员编号',
  `admim_name` varchar(50) NOT NULL COMMENT '管理员姓名',
  `admin_pwd` varchar(80) NOT NULL COMMENT '管理员密码',
  `admin_face` varchar(80) DEFAULT NULL COMMENT '管理员头像',
  `admin_time` datetime DEFAULT NULL COMMENT '注册时间',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admim_name` (`admim_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for bigtype
-- ----------------------------
DROP TABLE IF EXISTS `bigtype`;
CREATE TABLE `bigtype` (
  `big_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'big分类编号',
  `big_name` varchar(50) NOT NULL COMMENT 'big分类名称',
  PRIMARY KEY (`big_id`),
  UNIQUE KEY `big_name` (`big_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bigtype
-- ----------------------------
BEGIN;
INSERT INTO `bigtype` VALUES (3, '帽子2');
INSERT INTO `bigtype` VALUES (1, '服装');
INSERT INTO `bigtype` VALUES (2, '箱包');
INSERT INTO `bigtype` VALUES (4, '鞋子2');
COMMIT;

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `order_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单编号',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '用户编号',
  `list_id` int(10) unsigned DEFAULT NULL COMMENT '商品编号',
  `buy_num` int(10) unsigned DEFAULT NULL COMMENT '购买量',
  `add_id` int(10) unsigned DEFAULT NULL COMMENT '收货编号',
  `status` int(10) DEFAULT '0' COMMENT '购物车状态',
  `buy_price` varchar(255) DEFAULT NULL COMMENT '购买价格',
  `is_lease` int(1) DEFAULT '0' COMMENT '是否租赁',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `add_id` (`add_id`),
  KEY `list_id` (`list_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cart
-- ----------------------------
BEGIN;
INSERT INTO `cart` VALUES (19, 12, 14, 1, 16, 0, '11', 0);
INSERT INTO `cart` VALUES (20, 1, 2, 1, 9, 0, '120', 0);
INSERT INTO `cart` VALUES (21, 1, 4, 1, 9, 0, '40', 0);
INSERT INTO `cart` VALUES (76, 26, 2, 1, 22, 0, '10', 1);
INSERT INTO `cart` VALUES (77, 28, 2, 1, 26, 0, '10', 1);
COMMIT;

-- ----------------------------
-- Table structure for evaluate
-- ----------------------------
DROP TABLE IF EXISTS `evaluate`;
CREATE TABLE `evaluate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL COMMENT '评价内容',
  `userid` int(11) DEFAULT NULL COMMENT '用户编号',
  `list_id` int(11) DEFAULT NULL COMMENT '商品编号',
  `create_t` int(11) DEFAULT NULL COMMENT '评价时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of evaluate
-- ----------------------------
BEGIN;
INSERT INTO `evaluate` VALUES (1, '测试评价', 12, 14, 1570456842);
INSERT INTO `evaluate` VALUES (2, '测试评价2', 12, 14, 1570456842);
INSERT INTO `evaluate` VALUES (3, 'asdfasafasfa', 12, 14, 1570456842);
INSERT INTO `evaluate` VALUES (4, '啦啦啦啦啦', 1, 14, 1570456913);
INSERT INTO `evaluate` VALUES (5, 'taihaol', 19, 15, 1570518676);
INSERT INTO `evaluate` VALUES (6, 'aa', 19, 4, 1570518862);
INSERT INTO `evaluate` VALUES (7, '11', 19, 14, 1570539189);
INSERT INTO `evaluate` VALUES (8, '啦啦啦啦啦', 23, 16, 1570539627);
INSERT INTO `evaluate` VALUES (9, '啦啦啦啦啦', 23, 12, 1570539762);
INSERT INTO `evaluate` VALUES (10, '士大夫', 26, 16, 1570540238);
COMMIT;

-- ----------------------------
-- Table structure for lease
-- ----------------------------
DROP TABLE IF EXISTS `lease`;
CREATE TABLE `lease` (
  `list_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品编号',
  `list_name` varchar(100) NOT NULL COMMENT '商品名字',
  `list_face` varchar(80) NOT NULL COMMENT '商品图片',
  `list_myprice` float(8,2) NOT NULL COMMENT '商品价格',
  `list_onprice` float(8,2) NOT NULL COMMENT '商品市场价',
  `list_nums` int(5) DEFAULT NULL COMMENT '商品库存量',
  `list_detail` text COMMENT '商品简介',
  `list_time` datetime DEFAULT NULL COMMENT '上架时间',
  `list_seetimes` int(11) DEFAULT NULL COMMENT '商品点击量',
  `lease_time` int(11) DEFAULT '1' COMMENT '租赁天数',
  `deposit` int(11) DEFAULT '10' COMMENT '租赁押金',
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lease
-- ----------------------------
BEGIN;
INSERT INTO `lease` VALUES (2, '男士衬衫租赁', 'upload/1570542905.png', 20.00, 120.00, 50, '这是一个上衣衬衫', '2016-09-14 14:53:04', 49, 2, 10);
INSERT INTO `lease` VALUES (3, '男士短袖', 'upload/1473836235.jpg', 100.00, 150.00, 100, '这是一个短袖衬衫', '2016-09-14 14:57:15', 6, 1, 10);
INSERT INTO `lease` VALUES (4, '男士长袖', 'upload/1473836398.jpg', 50.00, 80.00, 150, '这是一个长袖', '2016-09-14 14:59:58', 9, 1, 10);
INSERT INTO `lease` VALUES (5, '男士裤子', 'upload/1473844874.jpg', 100.00, 130.00, 500, '这是一个裤子', '2016-09-14 17:21:14', 5, 5, 10);
INSERT INTO `lease` VALUES (6, '男士外套', 'upload/1473909003.jpg', 120.00, 150.00, 200, '这是一个外套', '2016-09-15 11:10:03', 15, 1, 10);
INSERT INTO `lease` VALUES (7, '精品女士包', 'upload/1473947069.jpg', 103.00, 115.00, 240, '这是一个做工精致，质量过关，价格合适的一款女士包包', '2016-09-15 21:44:29', 11, 1, 10);
INSERT INTO `lease` VALUES (8, '女士单肩包', 'upload/1473947146.jpg', 87.00, 88.00, 50, '无', '2016-09-15 21:45:46', 15, 10, 10);
INSERT INTO `lease` VALUES (9, '男士板鞋', 'upload/1473947193.jpg', 48.00, 50.00, 60, '无', '2016-09-15 21:46:33', 33, 1, 10);
INSERT INTO `lease` VALUES (10, '男士外套', 'upload/1473947235.jpg', 120.00, 110.00, 90, '无', '2016-09-15 21:47:15', 23, 1, 10);
INSERT INTO `lease` VALUES (11, '箱包', 'upload/1473947656.jpg', 100.00, 105.00, 20, '无', '2016-09-15 21:54:16', 30, 1, 10);
INSERT INTO `lease` VALUES (12, '时尚运动鞋', 'upload/1474168264.jpg', 40.00, 45.00, 80, '这是一个透气运动鞋', '2016-09-18 11:11:04', 114, 1, 10);
COMMIT;

-- ----------------------------
-- Table structure for leases_orders
-- ----------------------------
DROP TABLE IF EXISTS `leases_orders`;
CREATE TABLE `leases_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` varchar(255) DEFAULT NULL COMMENT '租赁订单号',
  `beforetotalprice` varchar(255) DEFAULT NULL COMMENT '租赁总价格',
  `buycount` varchar(255) DEFAULT NULL COMMENT '购买数量',
  `leasetime` varchar(255) DEFAULT NULL COMMENT '租赁时间',
  `starttime` datetime DEFAULT NULL COMMENT '开始时间',
  `endtime` datetime DEFAULT NULL COMMENT '结束时间',
  `status` int(11) DEFAULT NULL COMMENT '订单状态',
  `aftertotalprice` varchar(255) DEFAULT NULL COMMENT '租赁价格',
  `createtime` datetime DEFAULT NULL COMMENT '创建时间',
  `backtime` datetime DEFAULT NULL COMMENT '归还时间',
  `goodsid` varchar(255) DEFAULT NULL COMMENT '商品编号',
  `add_id` int(11) DEFAULT NULL COMMENT '收货编号',
  `userid` int(11) DEFAULT NULL COMMENT '用户编号',
  `lease_days` int(11) DEFAULT '1' COMMENT '租赁天数',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of leases_orders
-- ----------------------------
BEGIN;
INSERT INTO `leases_orders` VALUES (1, 'ZL201910062214498094', '45.00', '1', '2019-10-06 22:18:07', '2019-10-06 22:18:07', '2019-10-07 22:18:07', 2, '10', '2019-10-06 22:14:49', '2019-10-06 23:33:36', '12', 16, 12, 1);
INSERT INTO `leases_orders` VALUES (4, 'ZL201910082159472247', '120.00', '2', '2019-10-08 21:59:59', '2019-10-08 21:59:59', '2019-10-11 21:59:59', 2, '10', '2019-10-08 21:59:47', NULL, '2', 22, 26, 1);
INSERT INTO `leases_orders` VALUES (5, 'ZL201910082202163546', '50.00', '1', '2019-10-08 22:02:20', '2019-10-08 22:02:20', '2019-10-18 22:02:20', 2, '10', '2019-10-08 22:02:16', NULL, '9', 23, 23, 1);
INSERT INTO `leases_orders` VALUES (6, 'ZL201910082203112581', '150.00', '1', '2019-10-08 22:03:16', '2019-10-08 22:03:16', '2019-10-18 22:03:16', 2, '10', '2019-10-08 22:03:11', '2019-10-08 22:06:38', '6', 22, 26, 1);
INSERT INTO `leases_orders` VALUES (7, 'ZL201910082203254357', '130.00', '1', '2019-10-08 22:03:29', '2019-10-08 22:03:29', '2019-10-13 22:03:29', 2, '10', '2019-10-08 22:03:25', '2019-10-08 22:05:12', '5', 22, 26, 1);
INSERT INTO `leases_orders` VALUES (10, 'ZL201910082221415809', '120.00', '2', '2019-10-08 22:21:45', '2019-10-08 22:21:45', '2019-10-10 22:21:45', 2, '10', '2019-10-08 22:21:41', '2019-10-08 22:22:20', '2', 22, 26, 1);
INSERT INTO `leases_orders` VALUES (13, 'ZL201910082235096437', '120.00', '1', '2019-10-08 22:35:12', '2019-10-08 22:35:12', '2019-10-10 22:35:12', 2, '10', '2019-10-08 22:35:09', NULL, '2', 22, 26, 1);
INSERT INTO `leases_orders` VALUES (14, 'ZL201910082243356794', '120.00', '2', '2019-10-08 22:43:43', '2019-10-08 22:43:43', '2019-10-11 22:43:43', 2, '10', '2019-10-08 22:43:35', '2019-10-08 22:44:04', '2', 22, 26, 1);
INSERT INTO `leases_orders` VALUES (15, 'ZL201910082247504139', '45.00', '1', '2019-10-08 22:49:08', '2019-10-08 22:49:08', '2019-10-18 22:49:08', 2, '10', '2019-10-08 22:47:50', NULL, '12', 23, 23, 10);
INSERT INTO `leases_orders` VALUES (16, 'ZL201910082247504139', '45.00', '1', '2019-10-08 22:50:15', '2019-10-08 22:50:15', '2019-10-18 22:50:15', 2, '10', '2019-10-08 22:47:50', NULL, '12', 23, 23, 10);
INSERT INTO `leases_orders` VALUES (17, 'ZL201910082302294216', '120.00', '1', '2019-10-08 23:02:31', '2019-10-08 23:02:31', '2019-10-10 23:02:31', 2, '10', '2019-10-08 23:02:29', NULL, '2', 22, 26, 2);
INSERT INTO `leases_orders` VALUES (18, 'ZL201910082302509328', '120.00', '1', '2019-10-08 23:02:54', '2019-10-08 23:02:54', '2019-10-10 23:02:54', 2, '10', '2019-10-08 23:02:50', NULL, '2', 22, 26, 2);
INSERT INTO `leases_orders` VALUES (19, 'ZL201910082303296762', '120.00', '1', '2019-10-08 23:03:33', '2019-10-08 23:03:33', '2019-10-10 23:03:33', 2, '10', '2019-10-08 23:03:29', NULL, '2', 22, 26, 2);
INSERT INTO `leases_orders` VALUES (20, 'ZL201910082320244675', '120.00', '1', '2019-10-08 23:20:38', '2019-10-08 23:20:38', '2019-10-10 23:20:38', 2, '10', '2019-10-08 23:20:24', '2019-10-08 23:21:47', '2', 25, 27, 2);
INSERT INTO `leases_orders` VALUES (21, 'ZL201910091033311174', '120.00', '1', '2019-10-09 10:34:12', '2019-10-09 10:34:12', '2019-10-11 10:34:12', 2, '10', '2019-10-09 10:33:31', NULL, '2', 22, 26, 2);
INSERT INTO `leases_orders` VALUES (24, 'ZL201910091041441020', '120.00', '1', '2019-10-09 10:41:45', '2019-10-09 10:41:45', '2019-10-11 10:41:45', 2, '10', '2019-10-09 10:41:44', NULL, '2', 22, 26, 2);
INSERT INTO `leases_orders` VALUES (25, 'ZL201910091315469138', '120.00', '1', '2019-10-09 13:15:48', '2019-10-09 13:15:48', '2019-10-11 13:15:48', 2, '10', '2019-10-09 13:15:46', NULL, '2', 22, 26, 2);
INSERT INTO `leases_orders` VALUES (26, 'ZL201910100704086926', '45.00', '1', '2019-10-10 07:04:27', '2019-10-10 07:04:27', '2019-10-11 07:04:27', 2, '48', '2019-10-10 07:04:08', NULL, '12', 23, 23, 1);
COMMIT;

-- ----------------------------
-- Table structure for list
-- ----------------------------
DROP TABLE IF EXISTS `list`;
CREATE TABLE `list` (
  `list_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品编号',
  `list_name` varchar(100) NOT NULL COMMENT '商品名字',
  `list_face` varchar(80) DEFAULT NULL COMMENT '商品图片',
  `list_myprice` float(8,2) NOT NULL COMMENT '商品价格',
  `list_onprice` float(8,2) NOT NULL COMMENT '商品市场价',
  `list_nums` int(5) DEFAULT NULL COMMENT '商品库存量',
  `list_detail` text COMMENT '商品简介',
  `list_time` datetime DEFAULT NULL COMMENT '上架时间',
  `list_seetimes` int(11) DEFAULT NULL COMMENT '商品点击量',
  `small_id` int(10) unsigned DEFAULT NULL COMMENT '小分类编号',
  PRIMARY KEY (`list_id`),
  KEY `small_id` (`small_id`),
  CONSTRAINT `list_ibfk_1` FOREIGN KEY (`small_id`) REFERENCES `smalltype` (`small_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of list
-- ----------------------------
BEGIN;
INSERT INTO `list` VALUES (2, '男士衬衫', 'upload/1570539989.png', 150.00, 140.00, 50, '这是一个上衣衬风格还是衫', '2016-09-14 14:53:04', 56, 4);
INSERT INTO `list` VALUES (3, '男士短袖', 'upload/1473836235.jpg', 100.00, 150.00, 100, '这是一个短袖衬衫', '2016-09-14 14:57:15', 7, 3);
INSERT INTO `list` VALUES (4, '男士长袖', 'upload/1473836398.jpg', 50.00, 80.00, 150, '这是一个长袖', '2016-09-14 14:59:58', 12, 1);
INSERT INTO `list` VALUES (5, '男士裤子', 'upload/1473844874.jpg', 102.00, 130.00, 500, '这是一个裤子', '2016-09-14 17:21:14', 5, 4);
INSERT INTO `list` VALUES (6, '男士外套', 'upload/1473909003.jpg', 120.00, 150.00, 200, '这是一个外套', '2016-09-15 11:10:03', 5, 2);
INSERT INTO `list` VALUES (7, '精品女士包', 'upload/1473947069.jpg', 103.00, 115.00, 240, '这是一个做工精致，质量过关，价格合适的一款女士包包', '2016-09-15 21:44:29', 11, 5);
INSERT INTO `list` VALUES (8, '女士单肩包', 'upload/1473947146.jpg', 87.00, 88.00, 50, '无', '2016-09-15 21:45:46', 15, 5);
INSERT INTO `list` VALUES (9, '男士板鞋', 'upload/1473947193.jpg', 48.00, 50.00, 60, '无', '2016-09-15 21:46:33', 33, 7);
INSERT INTO `list` VALUES (10, '男士外套', 'upload/1473947235.jpg', 120.00, 110.00, 90, '无', '2016-09-15 21:47:15', 25, 2);
INSERT INTO `list` VALUES (12, '时尚运动鞋', 'upload/1474168264.jpg', 40.00, 45.00, 80, '这是一个透气运动鞋', '2016-09-18 11:11:04', 69, 8);
INSERT INTO `list` VALUES (14, '测试商品1', 'upload/1570030259.jpg', 11.00, 111.00, 11, '11', '2019-10-02 23:30:59', 92, 1);
INSERT INTO `list` VALUES (15, '测试商品', 'upload/1570256535.jpg', 11.00, 11111.00, 0, '测试', '2019-10-05 14:22:15', 20, 5);
INSERT INTO `list` VALUES (16, '测试商品12', NULL, 220.00, 2200.00, 0, '测试商品12', '2019-10-08 20:38:22', 6, 1);
COMMIT;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderid` varchar(255) DEFAULT NULL COMMENT '订单号',
  `beforetotalprice` varchar(255) DEFAULT NULL COMMENT '市场总金额',
  `aftertotalprice` varchar(255) DEFAULT NULL COMMENT '实付总金额',
  `buycount` varchar(255) DEFAULT NULL COMMENT '购买数量',
  `createtime` datetime DEFAULT NULL COMMENT '创建时间',
  `userid` int(11) DEFAULT NULL COMMENT '用户id',
  `goodsid` varchar(255) DEFAULT NULL COMMENT '商品编号',
  `add_id` varchar(255) DEFAULT NULL COMMENT '收货信息编号',
  `status` int(11) DEFAULT NULL COMMENT '订单状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
BEGIN;
INSERT INTO `orders` VALUES (3, 'IN201910050045408938', '245.00', '166.4', '3', '2019-10-05 00:45:40', 1, '12,9,6', '9', 1);
INSERT INTO `orders` VALUES (4, 'IN201910051428157902', '11111.00', '11', '1', '2019-10-05 14:28:15', 12, '15', '', 2);
INSERT INTO `orders` VALUES (5, 'IN201910062123401909', '45.00', '10', '1', '2019-10-06 21:23:40', 12, '12', '16', NULL);
INSERT INTO `orders` VALUES (7, 'IN201910081740204106', '110.00', '114', '1', '2019-10-08 17:40:20', 23, '10', '19', NULL);
INSERT INTO `orders` VALUES (8, 'IN201910082056433209', '11111.00', '10.45', '1', '2019-10-08 20:56:43', 19, '15', '20', NULL);
INSERT INTO `orders` VALUES (10, 'IN201910082302044166', '280.00', '105', '2', '2019-10-08 23:02:04', 26, '5,3', '22', NULL);
INSERT INTO `orders` VALUES (12, 'IN201910091032473476', '140.00', '10', '1', '2019-10-09 10:32:47', 26, '2', '22', NULL);
COMMIT;

-- ----------------------------
-- Table structure for region
-- ----------------------------
DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `reg_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '供应商编号',
  `reg_name` varchar(50) NOT NULL COMMENT '供应商姓名',
  `reg_add` varchar(100) DEFAULT NULL COMMENT '供应商地址',
  `reg_tel` int(11) DEFAULT NULL COMMENT '供应商电话',
  `reg_qq` int(11) DEFAULT NULL COMMENT '供应商QQ',
  `reg_email` varchar(50) DEFAULT NULL COMMENT '供应商邮箱',
  PRIMARY KEY (`reg_id`),
  UNIQUE KEY `reg_name` (`reg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for smalltype
-- ----------------------------
DROP TABLE IF EXISTS `smalltype`;
CREATE TABLE `smalltype` (
  `small_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '小分类编号',
  `small_name` varchar(50) DEFAULT NULL COMMENT '小分类名称',
  `big_id` int(10) unsigned DEFAULT NULL COMMENT 'big分类编号',
  PRIMARY KEY (`small_id`),
  KEY `big_id` (`big_id`),
  CONSTRAINT `smalltype_ibfk_1` FOREIGN KEY (`big_id`) REFERENCES `bigtype` (`big_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of smalltype
-- ----------------------------
BEGIN;
INSERT INTO `smalltype` VALUES (1, '上衣', 1);
INSERT INTO `smalltype` VALUES (2, '外套', 1);
INSERT INTO `smalltype` VALUES (3, '短袖', 1);
INSERT INTO `smalltype` VALUES (4, '裤子', 1);
INSERT INTO `smalltype` VALUES (5, '女士包', 2);
INSERT INTO `smalltype` VALUES (6, '男士包', 2);
INSERT INTO `smalltype` VALUES (7, '休闲鞋', 4);
INSERT INTO `smalltype` VALUES (8, '运动鞋', 4);
INSERT INTO `smalltype` VALUES (9, '帆布鞋', 4);
INSERT INTO `smalltype` VALUES (10, '皮鞋', 4);
INSERT INTO `smalltype` VALUES (11, '太阳帽', 3);
INSERT INTO `smalltype` VALUES (12, '斗笠', 3);
INSERT INTO `smalltype` VALUES (13, '测试二二恶', 2);
INSERT INTO `smalltype` VALUES (14, '测试asfaeads', 2);
COMMIT;

-- ----------------------------
-- Table structure for type
-- ----------------------------
DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of type
-- ----------------------------
BEGIN;
INSERT INTO `type` VALUES (1, 0, '服装');
INSERT INTO `type` VALUES (2, 0, '帽子');
INSERT INTO `type` VALUES (3, 0, '箱包');
INSERT INTO `type` VALUES (4, 0, '鞋子');
INSERT INTO `type` VALUES (5, 1, '上衣');
INSERT INTO `type` VALUES (6, 1, '短袖');
INSERT INTO `type` VALUES (7, 1, '裤子');
INSERT INTO `type` VALUES (8, 1, '外套');
INSERT INTO `type` VALUES (9, 2, '草帽');
INSERT INTO `type` VALUES (10, 2, '牛仔帽');
INSERT INTO `type` VALUES (11, 3, '女士箱包');
INSERT INTO `type` VALUES (12, 3, '单肩包');
INSERT INTO `type` VALUES (13, 4, '休闲鞋');
INSERT INTO `type` VALUES (14, 4, '运动鞋');
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户编号',
  `user_name` varchar(80) NOT NULL COMMENT '用户名',
  `user_pwd` varchar(80) NOT NULL COMMENT '密码',
  `user_sex` enum('0','1') DEFAULT '0' COMMENT '性别',
  `user_face` varchar(100) DEFAULT NULL COMMENT '头像',
  `user_email` varchar(50) DEFAULT NULL COMMENT '邮箱',
  `user_card` varchar(20) DEFAULT NULL COMMENT '身份证',
  `user_time` datetime DEFAULT NULL COMMENT '注册时间',
  `user_roleid` int(11) DEFAULT NULL COMMENT '账号类型：1管理员，2普通用户，3会员',
  `user_rank_id` int(11) DEFAULT NULL COMMENT '会员等级id',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES (1, 'qiaoshuai', 'c4767d72fa6a26af19706e706a08000c', '0', 't8', '1145938682@qq.com', '', '2019-10-08 20:29:12', 3, 1);
INSERT INTO `user` VALUES (2, 'admin', 'c4767d72fa6a26af19706e706a08000c', '1', 't5', '1679022346@qq.com', '', '2016-09-12 18:59:56', 3, 0);
INSERT INTO `user` VALUES (12, 'test1', 'e10adc3949ba59abbe56e057f20f883e', '1', 't11', 'test@qq.om', NULL, '2019-10-03 18:09:35', 1, 1);
INSERT INTO `user` VALUES (14, 'yonghu1', '96e79218965eb72c92a549dd5a330112', '1', 't1', NULL, NULL, '2019-10-07 22:47:52', 1, 1);
INSERT INTO `user` VALUES (15, 'yonghu', '96e79218965eb72c92a549dd5a330112', '1', 't1', '', NULL, '2019-10-07 23:13:07', 1, 2);
INSERT INTO `user` VALUES (19, 'yonghu4', '96e79218965eb72c92a549dd5a330112', '1', 't1', NULL, NULL, '2019-10-08 15:10:12', 2, 2);
INSERT INTO `user` VALUES (23, 'test2', 'e10adc3949ba59abbe56e057f20f883e', '0', 't1', NULL, NULL, '2019-10-08 17:38:58', 2, 2);
INSERT INTO `user` VALUES (24, 'text3', '96e79218965eb72c92a549dd5a330112', '0', 't1', NULL, NULL, '2019-10-08 18:22:05', 1, 2);
INSERT INTO `user` VALUES (26, '用户10082', '96e79218965eb72c92a549dd5a330112', '0', 't1', NULL, NULL, '2019-10-09 13:18:57', 3, 1);
INSERT INTO `user` VALUES (27, '12345', '827ccb0eea8a706c4c34a16891f84e7b', '0', 't1', NULL, NULL, '2019-10-09 13:18:30', 3, 1);
INSERT INTO `user` VALUES (28, '用户1009', '96e79218965eb72c92a549dd5a330112', '0', 't1', NULL, NULL, '2019-10-09 13:30:52', 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for user_rank
-- ----------------------------
DROP TABLE IF EXISTS `user_rank`;
CREATE TABLE `user_rank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '会员等级名',
  `integral` int(11) DEFAULT NULL COMMENT '会员等级积分',
  `rebate` varchar(255) DEFAULT NULL COMMENT '折扣',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_rank
-- ----------------------------
BEGIN;
INSERT INTO `user_rank` VALUES (1, '普通卡', 0, '1');
INSERT INTO `user_rank` VALUES (2, '白银卡', 1000, '0.95');
INSERT INTO `user_rank` VALUES (3, '黄金卡', 5000, '0.80');
COMMIT;

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_role
-- ----------------------------
BEGIN;
INSERT INTO `user_role` VALUES (1, '普通用户');
INSERT INTO `user_role` VALUES (2, '会员');
INSERT INTO `user_role` VALUES (3, '管理员');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
