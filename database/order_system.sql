/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100420
 Source Host           : localhost:3306
 Source Schema         : order_system

 Target Server Type    : MySQL
 Target Server Version : 100420
 File Encoding         : 65001

 Date: 15/03/2022 18:16:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_product
-- ----------------------------
DROP TABLE IF EXISTS `data_product`;
CREATE TABLE `data_product`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_price` double NULL DEFAULT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_deleted` tinyint(4) NULL DEFAULT 0,
  `created_at` datetime(0) NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`, `product_code`) USING BTREE,
  UNIQUE INDEX `id`(`id`, `product_code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 78 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_product
-- ----------------------------
INSERT INTO `data_product` VALUES (60, '', 'Milk Tea', 0.72, 'uploads/Lychee-Tea.jpg', 0, '2022-02-28 18:57:31');
INSERT INTO `data_product` VALUES (61, '', 'Honey Lemon Tea', 0.72, 'uploads/Passion-Fruit.jpg', 0, '2022-02-28 18:57:31');
INSERT INTO `data_product` VALUES (62, '', 'Strawberry Tea', 0.72, 'uploads/Apple-Tea.jpg', 0, '2022-02-28 18:57:31');
INSERT INTO `data_product` VALUES (63, '', 'Jasmine Tea', 0.72, 'uploads/Kiwi-Tea.jpg', 0, '2022-02-28 19:03:42');
INSERT INTO `data_product` VALUES (64, '', 'Lychee Tea', 0.72, 'uploads/Grape-Tea.jpg', 0, '2022-02-28 19:03:56');
INSERT INTO `data_product` VALUES (65, '', 'Passion Fruit', 0.72, 'uploads/Cantaloup-Tea.jpg', 0, '2022-02-28 19:04:10');
INSERT INTO `data_product` VALUES (66, '', 'Apple Tea', 0.72, 'uploads/Lemon-Tea.jpg', 0, '2022-02-28 19:04:25');
INSERT INTO `data_product` VALUES (67, '', 'Kiwi Tea', 0.72, 'uploads/Passion-Tea.jpg', 0, '2022-02-28 19:04:40');
INSERT INTO `data_product` VALUES (68, '', 'Grape Tea', 0.72, 'uploads/Blueberry-Tea.jpg', 0, '2022-02-28 19:05:08');
INSERT INTO `data_product` VALUES (69, '', 'Cantaloup Tea', 0.72, 'uploads/Blue-Hawaii-Tea.jpg', 0, '2022-02-28 19:05:22');
INSERT INTO `data_product` VALUES (70, '', 'Lemon Tea', 0.72, 'uploads/Pineapple-Tea.jpg', 0, '2022-02-28 19:05:36');
INSERT INTO `data_product` VALUES (71, '', 'Passion Tea', 0.72, 'uploads/Cappucino.jpeg', 0, '2022-02-28 19:05:46');
INSERT INTO `data_product` VALUES (72, '', 'Blueberry Tea', 0.72, 'uploads/Green-Milk-Tea.jpg', 0, '2022-02-28 19:05:57');
INSERT INTO `data_product` VALUES (73, '', 'Blue Hawaii Tea', 0.72, 'uploads/Cacao.jpg', 0, '2022-02-28 19:06:08');
INSERT INTO `data_product` VALUES (74, '', 'Pineapple Tea', 0.72, 'uploads/Pineapple-Tea.jpg', 0, '2022-02-28 19:06:21');
INSERT INTO `data_product` VALUES (75, '', 'Cappucino', 0.85, 'uploads/Cappucino.jpeg', 0, '2022-02-28 19:06:44');
INSERT INTO `data_product` VALUES (76, '', 'Green Milk Tea', 0.85, 'uploads/Green-Milk-Tea.jpg', 0, '2022-02-28 19:06:57');
INSERT INTO `data_product` VALUES (77, '', 'Cacao', 0.85, 'uploads/Cacao.jpg', 0, '2022-02-28 19:07:09');

-- ----------------------------
-- Table structure for data_sale
-- ----------------------------
DROP TABLE IF EXISTS `data_sale`;
CREATE TABLE `data_sale`  (
  `id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sale_number` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `grand_total` double NULL DEFAULT NULL,
  `quantity` double NULL DEFAULT NULL,
  `is_deleted` tinyint(4) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  CONSTRAINT `data_sale_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `data_user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_sale
-- ----------------------------

-- ----------------------------
-- Table structure for data_sale_product
-- ----------------------------
DROP TABLE IF EXISTS `data_sale_product`;
CREATE TABLE `data_sale_product`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sale_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_price` double NULL DEFAULT NULL,
  `product_quantity` double NULL DEFAULT NULL,
  `product_amount` double NULL DEFAULT NULL,
  `product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sale_id`(`sale_id`) USING BTREE,
  CONSTRAINT `data_sale_product_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `data_sale` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_sale_product
-- ----------------------------

-- ----------------------------
-- Table structure for data_setting
-- ----------------------------
DROP TABLE IF EXISTS `data_setting`;
CREATE TABLE `data_setting`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `data_value` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_setting
-- ----------------------------
INSERT INTO `data_setting` VALUES (1, 'sale_number', '1');

-- ----------------------------
-- Table structure for data_user
-- ----------------------------
DROP TABLE IF EXISTS `data_user`;
CREATE TABLE `data_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_user
-- ----------------------------
INSERT INTO `data_user` VALUES (1, 'Chhay Low', 'chhaylow', '123456', NULL);

SET FOREIGN_KEY_CHECKS = 1;
