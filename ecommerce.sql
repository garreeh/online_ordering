/*
 Navicat Premium Data Transfer

 Source Server         : PendragonDB
 Source Server Type    : MySQL
 Source Server Version : 100432
 Source Host           : localhost:3306
 Source Schema         : ecommerce

 Target Server Type    : MySQL
 Target Server Version : 100432
 File Encoding         : 65001

 Date: 03/09/2024 18:31:10
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for billing
-- ----------------------------
DROP TABLE IF EXISTS `billing`;
CREATE TABLE `billing`  (
  `billing_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_total` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL,
  `total_less_discount` int(11) NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Unpaid',
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bill_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bill_balance` decimal(10, 2) NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`billing_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of billing
-- ----------------------------
INSERT INTO `billing` VALUES (20, 0, 0, 0, 'Unpaid', '', '', 0.00, 1, '2024-05-13 18:15:13', '2024-05-13 18:15:13');
INSERT INTO `billing` VALUES (21, 0, 0, 0, 'Unpaid', '', '', 0.00, 2, '2024-05-13 18:18:35', '2024-05-13 18:18:35');
INSERT INTO `billing` VALUES (22, 0, 0, 0, 'Unpaid', '', '', 0.00, 1, '2024-05-14 10:28:00', '2024-05-14 10:28:00');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'testttttqweqwe', '2024-05-14 17:48:46', '2024-05-14 17:49:08');
INSERT INTO `category` VALUES (2, 'Dog Food', '2024-05-14 17:48:30', '2024-05-16 10:58:50');

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment`  (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `payment_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `payment_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`payment_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of payment
-- ----------------------------

-- ----------------------------
-- Table structure for payment_category
-- ----------------------------
DROP TABLE IF EXISTS `payment_category`;
CREATE TABLE `payment_category`  (
  `payment_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` datetime(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`payment_category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of payment_category
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NULL DEFAULT NULL,
  `category_id` int(255) NULL DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_stocks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_unitprice` decimal(10, 2) NULL DEFAULT NULL,
  `product_sellingprice` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product
-- ----------------------------

-- ----------------------------
-- Table structure for purchase_order
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order`;
CREATE TABLE `purchase_order`  (
  `purchse_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_number` int(11) NULL DEFAULT NULL,
  `supplier_id` int(11) NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `voucher_id` int(11) NULL DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `unit_price` decimal(10, 2) NULL DEFAULT NULL,
  `quantity` int(11) NULL DEFAULT NULL,
  `discount` int(11) NULL DEFAULT NULL,
  `total_amount` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`purchse_order_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of purchase_order
-- ----------------------------

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `landline` int(11) NULL DEFAULT NULL,
  `mobile_number` int(11) NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `contact_person` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `type_of_company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `terms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `payment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `mode_of_delivery` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `vatable` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`supplier_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (18, 'garssseh', '123456', 123123, 0, 'gajultos.garry123@gmail.com', '123', '123', '123', '123', '123', 'test', 'Yes', '2024-04-13 15:55:11', '2024-05-13 16:08:14');
INSERT INTO `supplier` VALUES (20, 'garreeh', 'test', 0, 123, 'gajultos.garry123@gmail.com', '1', '1', '1', '1', '1', 'test', 'Yes', '2024-05-08 16:32:56', '2024-05-08 17:51:28');
INSERT INTO `supplier` VALUES (22, 'test', '123', 123, 123, 'gajultos.garrydev@gmail.com', '111', '123', '123', '123', '123', '123', 'Yes', '2024-05-16 10:57:32', '2024-07-30 10:28:35');
INSERT INTO `supplier` VALUES (23, '123', '123', 3123, 3213, 'gajultos.garry123@gmail.com', '1231', '123123', '123132', '123123', '123', '123', 'Yes', '2024-05-20 15:38:40', '2024-05-20 15:38:40');
INSERT INTO `supplier` VALUES (24, 'qwe', 'qwe', 0, 0, 'gajultos.garrydev@gmail.com', 'qew', 'qwe', '123', '213', '123444', '123', 'Yes', '2024-07-30 10:28:25', '2024-07-30 10:28:25');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_contact` int(11) NULL DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_confirm_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `remember_me` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `user_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `is_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `account_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Garry Gajultos', 'garry', 'gajultos.garrydev@gmail.com', 123123123, '$2y$10$qLpIqQapwBy.Z5akQkYgkuT/8JFBv460vuqIFKUGyvp2l58YTeRvW', '123123', '', '2024-04-07 16:08:00', '2024-09-03 18:28:27', NULL, '1', NULL, '1');
INSERT INTO `users` VALUES (2, 'Test Account', 'Ron', 'gajultos.garry123@gmail.com', NULL, '$2y$10$Wtj4pYEWKXHYe4DUwLPTveZdPJUNrXwfkfeZRWXO4bnmbNd9NOA9y', 'test1005', NULL, '2024-05-13 18:18:17', '2024-09-03 10:53:31', NULL, '0', NULL, NULL);
INSERT INTO `users` VALUES (8, '1', 'not admin', 'pajamaribel17@gmail.com', 1, '$2y$10$IS1QJYBN1EP0ATfdxDN49O8/P9EA/2rBD4GyXyt3A7o7OOhx94zN6', '1', NULL, '2024-09-03 13:16:08', '2024-09-03 13:16:08', NULL, '0', NULL, NULL);
INSERT INTO `users` VALUES (10, 'Garry Gajultos', '1', '123123@gmail.c', 123, '$2y$10$mo8rpOmdnJJCvP/hpQU3kubL9iVLW8X/cZVEIXvA4J4t/TXKsGPFG', '123', NULL, '2024-09-03 15:31:48', '2024-09-03 15:31:48', NULL, '0', NULL, NULL);
INSERT INTO `users` VALUES (13, '123', '123', '11amethyst.cerbitojelojean@gmail.com', 1, '$2y$10$d.5kLM.9RzSWiVzZSE7b5uxp3nCx1hlqn0Al55xkcvFeKjOZW3jte', '1', NULL, '2024-09-03 17:00:42', '2024-09-03 17:00:42', NULL, '1', 'Inactive', '123');
INSERT INTO `users` VALUES (14, 'qwe', 'qwe', '123123@gmail.com', 1, '$2y$10$LblabnZoC0VN9mUeApeJ5uF957Ok1Q841SGDl4VIPT7T97ElXyMgi', '1', NULL, '2024-09-03 18:17:28', '2024-09-03 18:17:28', NULL, '1', 'Inactive', '1');

-- ----------------------------
-- Table structure for usertype
-- ----------------------------
DROP TABLE IF EXISTS `usertype`;
CREATE TABLE `usertype`  (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`user_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usertype
-- ----------------------------

-- ----------------------------
-- Table structure for withdraw
-- ----------------------------
DROP TABLE IF EXISTS `withdraw`;
CREATE TABLE `withdraw`  (
  `withdraw_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_id` int(11) NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`withdraw_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of withdraw
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
