/*
 Navicat Premium Data Transfer

 Source Server         : PersonalProjectDB
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : ecommerce

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 12/10/2024 15:04:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for billing
-- ----------------------------
DROP TABLE IF EXISTS `billing`;
CREATE TABLE `billing`  (
  `billing_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NULL DEFAULT NULL,
  `sub_total` int NOT NULL DEFAULT 0,
  `discount` int NOT NULL,
  `total_less_discount` int NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Unpaid',
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`billing_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of billing
-- ----------------------------
INSERT INTO `billing` VALUES (20, NULL, 0, 0, 0, 'Unpaid', '', 1, '2024-05-13 18:15:13', '2024-05-13 18:15:13');
INSERT INTO `billing` VALUES (21, NULL, 0, 0, 0, 'Unpaid', '', 2, '2024-05-13 18:18:35', '2024-05-13 18:18:35');
INSERT INTO `billing` VALUES (22, NULL, 0, 0, 0, 'Unpaid', '', 1, '2024-05-14 10:28:00', '2024-05-14 10:28:00');

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart`  (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  `cart_quantity` int NULL DEFAULT NULL,
  `cart_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `proof_of_payment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total_price` decimal(11, 2) NULL DEFAULT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `reference_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `delivery_rider_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`cart_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 115 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES (111, 1, 19, 3, 'Delivered', NULL, 3.00, 'Cash On Delivery', 'Paid', '3ECC02', '2024-10-12 11:02:34', '2024-10-12 13:09:08', 1);
INSERT INTO `cart` VALUES (112, 2, 19, 2, 'Delivered', NULL, 2.00, 'Cash On Delivery', 'Paid', '26AF44', '2024-10-12 11:18:08', '2024-10-12 13:56:12', 3);
INSERT INTO `cart` VALUES (113, 2, 19, 2, 'Out For Delivery', NULL, 2.00, 'Cash On Delivery', NULL, 'C77468', '2024-10-12 11:18:27', '2024-10-12 14:22:40', 1);

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'Dog Food Ni Bert1', '2024-05-14 17:48:46', '2024-09-23 10:36:16');
INSERT INTO `category` VALUES (2, 'Dog Food Ni Patrick', '2024-05-14 17:48:30', '2024-09-04 17:25:39');
INSERT INTO `category` VALUES (5, 'Test lang', '2024-09-04 17:23:29', '2024-09-04 17:25:44');
INSERT INTO `category` VALUES (6, 'Test Category', '2024-09-06 21:20:13', '2024-09-06 21:20:13');
INSERT INTO `category` VALUES (7, 'Spaghetti', '2024-09-06 22:20:07', '2024-09-06 22:20:07');
INSERT INTO `category` VALUES (8, 'Categ', '2024-09-23 10:36:51', '2024-09-23 10:36:51');
INSERT INTO `category` VALUES (9, '', '2024-10-12 12:10:56', '2024-10-12 12:10:56');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NULL DEFAULT NULL,
  `product_id` int NOT NULL,
  `payment_category_id` int NULL DEFAULT NULL,
  `order_quantity` int NULL DEFAULT NULL,
  `order_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `total_cost` int NULL DEFAULT NULL,
  `proof_of_payment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for payment
-- ----------------------------
DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment`  (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `payment_category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `payment_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
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
  `payment_category_id` int NOT NULL AUTO_INCREMENT,
  `payment_category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`payment_category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of payment_category
-- ----------------------------
INSERT INTO `payment_category` VALUES (1, 'Cash on Delivery', '2024-09-18 09:42:45', '2024-09-18 09:42:56');
INSERT INTO `payment_category` VALUES (2, 'Gcash', '2024-09-18 09:43:01', '2024-09-18 09:43:01');

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int NULL DEFAULT NULL,
  `category_id` int NULL DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `product_stocks` int NULL DEFAULT NULL,
  `product_unitprice` decimal(10, 2) NULL DEFAULT NULL,
  `product_sellingprice` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (17, 26, 1, '11', 'DESCRIPTION PRODUCT 1', '../../uploads/1.png', '11', 1, 11.00, 11.00, '2024-09-05 14:39:33', '2024-10-12 11:11:32');
INSERT INTO `product` VALUES (18, 27, 2, '22', 'DESCRIPTION PRODUCT 2', '../../uploads/2.png', '22', -9, 22.00, 22.00, '2024-09-05 14:40:14', '2024-10-11 21:00:23');
INSERT INTO `product` VALUES (19, 26, 1, 'dogfood ni bert', 'DESCRIPTION PRODUCT 3', '../../uploads/3.png', 'dogfood ni bert', 32, 1.00, 1.00, '2024-09-05 14:40:51', '2024-10-12 14:24:04');
INSERT INTO `product` VALUES (20, 26, 7, 'Test', 'DESCRIPTION PRODUCT 4', '../../uploads/test.jpg', '123', 97, 200.00, 300.00, '2024-09-06 22:20:40', '2024-09-26 16:16:30');
INSERT INTO `product` VALUES (21, 28, 1, 'VSS', 'VSS', '../../uploads/VSS APPLICATION.png', '123123123', 0, 1000.00, 1100.00, '2024-09-18 17:45:50', '2024-09-18 17:45:50');

-- ----------------------------
-- Table structure for purchase_order
-- ----------------------------
DROP TABLE IF EXISTS `purchase_order`;
CREATE TABLE `purchase_order`  (
  `purchase_order_id` int NOT NULL AUTO_INCREMENT,
  `purchase_number` int NULL DEFAULT NULL,
  `supplier_id` int NULL DEFAULT NULL,
  `product_id` int NULL DEFAULT NULL,
  `quantity` int NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`purchase_order_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of purchase_order
-- ----------------------------
INSERT INTO `purchase_order` VALUES (8, 4, 27, 18, 6, '2024-09-05 16:05:41', '2024-09-06 11:45:40');
INSERT INTO `purchase_order` VALUES (9, 2, 26, 17, 12, '2024-09-05 16:38:36', '2024-10-12 11:11:32');
INSERT INTO `purchase_order` VALUES (10, 1, 26, 19, 10, '2024-09-05 16:55:57', '2024-09-05 16:55:57');
INSERT INTO `purchase_order` VALUES (11, 1, 27, 18, 1, '2024-09-06 11:45:19', '2024-09-06 11:45:19');
INSERT INTO `purchase_order` VALUES (12, 123, 26, 17, 10, '2024-09-06 11:51:02', '2024-09-06 11:51:02');
INSERT INTO `purchase_order` VALUES (13, 123123, 26, 19, 10, '2024-09-06 21:21:51', '2024-09-06 21:21:51');
INSERT INTO `purchase_order` VALUES (14, 123123, 26, 20, 100, '2024-09-06 22:21:19', '2024-09-06 22:21:19');
INSERT INTO `purchase_order` VALUES (15, 12314, 26, 17, 10, '2024-09-18 17:41:02', '2024-09-18 17:41:02');
INSERT INTO `purchase_order` VALUES (16, 23, 26, 19, 23, '2024-10-12 11:10:32', '2024-10-12 11:10:32');

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `supplier_id` int NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `landline` int NULL DEFAULT NULL,
  `mobile_number` int NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`supplier_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (26, 'test', '1', 1, 123, 'gajultos.garrydev@gmail.com', '123', '2024-09-04 14:22:47', '2024-09-04 15:01:43');
INSERT INTO `supplier` VALUES (27, '2', '2', 2, 2323, 'tanginathis213012@gmail.com', '23', '2024-09-04 14:22:53', '2024-09-04 15:01:53');
INSERT INTO `supplier` VALUES (28, 'Supplier1', '123', 123, 1, 'gajultos.garrydev@gmail.com', '123', '2024-09-06 21:19:57', '2024-09-06 21:19:57');
INSERT INTO `supplier` VALUES (29, 'Supplier2', 'Supplier2', 0, 123123, 'gajultos.garry123@gmail.com', '123', '2024-09-06 22:19:56', '2024-09-06 22:19:56');
INSERT INTO `supplier` VALUES (30, 'Pendragon', 'Test', 123, 123, 'pendragonitteam@gmail.com', '23', '2024-10-12 11:05:22', '2024-10-12 11:05:22');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_contact` int NULL DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_confirm_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `remember_me` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `user_type_id` int NULL DEFAULT NULL,
  `is_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `account_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Garry Gajultos', 'garry', '123123@gmail.com', 123123123, '$2y$10$vtj3lvgROA.ecVm2oI2YnOrlhFzn1jNE/sMk72HTTH.ymfaBol9jW', '123123', '', '2024-04-07 16:08:00', '2024-09-04 15:57:51', NULL, '1', 'Active', '1');
INSERT INTO `users` VALUES (2, 'Test Account', 'Ron', '123123@gmail.comm', NULL, '$2y$10$Wtj4pYEWKXHYe4DUwLPTveZdPJUNrXwfkfeZRWXO4bnmbNd9NOA9y', 'test1005', NULL, '2024-05-13 18:18:17', '2024-10-12 14:19:57', 4, '0', 'Active', NULL);
INSERT INTO `users` VALUES (39, '1', 'test', 'gajultos.garrydev@gmail.com', 1, '$2y$10$XX19Ar6P.ig1stK9lZ0N2eP89FY5FughUlK0xhgDfLj1P60tMMPva', '1', NULL, '2024-09-13 23:58:14', '2024-10-12 11:57:29', 4, '1', 'Active', '1');

-- ----------------------------
-- Table structure for usertype
-- ----------------------------
DROP TABLE IF EXISTS `usertype`;
CREATE TABLE `usertype`  (
  `user_type_id` int NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `inventory_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `user_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `reports_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  `po_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '1',
  PRIMARY KEY (`user_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usertype
-- ----------------------------
INSERT INTO `usertype` VALUES (2, 'Admin', '2024-09-04 10:46:35', '2024-09-04 17:09:22', '0', '1', '1', '1');
INSERT INTO `usertype` VALUES (3, 'Encoder', '2024-09-04 10:46:46', '2024-09-04 10:46:46', '1', '1', '1', '1');
INSERT INTO `usertype` VALUES (4, 'Delivery Rider', '2024-10-12 11:21:06', '2024-10-12 11:21:06', '1', '1', '1', '1');

SET FOREIGN_KEY_CHECKS = 1;
