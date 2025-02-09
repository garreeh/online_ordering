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

 Date: 09/02/2025 15:51:06
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
  `cart_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`cart_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 143 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cart
-- ----------------------------
INSERT INTO `cart` VALUES (142, 40, 26, 1, 'Out For Delivery', NULL, 1.00, 'Cash On Delivery', NULL, '5145A7', '2025-02-09 15:41:57', '2025-02-09 15:47:57', 39, 'Booking');

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
INSERT INTO `category` VALUES (1, 'Pork', '2024-05-14 17:48:46', '2024-11-08 21:57:25');
INSERT INTO `category` VALUES (2, 'Chicken', '2024-05-14 17:48:30', '2024-11-08 21:57:32');
INSERT INTO `category` VALUES (5, 'Pasta', '2024-09-04 17:23:29', '2024-11-08 21:57:36');
INSERT INTO `category` VALUES (6, 'Noodles Series', '2024-09-06 21:20:13', '2024-11-08 21:57:45');

-- ----------------------------
-- Table structure for ingredients_category
-- ----------------------------
DROP TABLE IF EXISTS `ingredients_category`;
CREATE TABLE `ingredients_category`  (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ingredients_category
-- ----------------------------
INSERT INTO `ingredients_category` VALUES (1, 'Porkqq', '2024-05-14 17:48:46', '2025-02-06 12:06:06');
INSERT INTO `ingredients_category` VALUES (2, 'Chicken', '2024-05-14 17:48:30', '2024-11-08 21:57:32');
INSERT INTO `ingredients_category` VALUES (5, 'Pasta', '2024-09-04 17:23:29', '2024-11-08 21:57:36');
INSERT INTO `ingredients_category` VALUES (6, 'Noodles Series', '2024-09-06 21:20:13', '2024-11-08 21:57:45');
INSERT INTO `ingredients_category` VALUES (10, 'qq', '2025-02-06 12:05:06', '2025-02-06 12:05:06');

-- ----------------------------
-- Table structure for ingredients_product
-- ----------------------------
DROP TABLE IF EXISTS `ingredients_product`;
CREATE TABLE `ingredients_product`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ingredients_product
-- ----------------------------
INSERT INTO `ingredients_product` VALUES (17, 26, 1, 'Dinuguan', 'Dinuguan', '../../uploads/Dinuguan.jpg', 'Dinuguan', 0, 100.00, 109.00, '2024-09-05 14:39:33', '2025-02-06 13:56:13');
INSERT INTO `ingredients_product` VALUES (18, 27, 2, 'Tapa with Rice', 'Tapa with Rice', '../../uploads/Idontknow.jpg', 'Tapa with Rice', 111, 99.00, 109.00, '2024-09-05 14:40:14', '2025-02-06 13:44:49');
INSERT INTO `ingredients_product` VALUES (22, 26, 5, 'Palabok BILAO', 'Palabok BILAO', '../../uploads/main6.jpg', 'Palabok BILAO', 0, 177.00, 188.00, '2024-11-08 22:11:48', '2024-11-08 22:11:48');
INSERT INTO `ingredients_product` VALUES (26, 26, 2, 'qqqq', NULL, NULL, 'q', 0, NULL, NULL, '2025-02-06 12:20:33', '2025-02-06 12:20:33');

-- ----------------------------
-- Table structure for ingredients_supplier
-- ----------------------------
DROP TABLE IF EXISTS `ingredients_supplier`;
CREATE TABLE `ingredients_supplier`  (
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
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of ingredients_supplier
-- ----------------------------
INSERT INTO `ingredients_supplier` VALUES (26, 'Pendragonqq', '1', 1, 123, 'test1@gmail.com', '123', '2024-09-04 14:22:47', '2025-02-06 11:59:48');
INSERT INTO `ingredients_supplier` VALUES (27, 'Razzon', '2', 2, 2323, 'test1@gmail.com', '23', '2024-09-04 14:22:53', '2024-11-08 22:44:34');
INSERT INTO `ingredients_supplier` VALUES (28, 'Puregold', '123', 123, 1, 'test1@gmail.com', '123', '2024-09-06 21:19:57', '2024-11-08 22:44:37');
INSERT INTO `ingredients_supplier` VALUES (29, 'SM SUPERMARKET', 'Supplier2', 0, 123123, 'gajultos.garry123@gmail.com', '123', '2024-09-06 22:19:56', '2024-11-08 21:57:10');

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
  `product_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (17, 28, 2, 'Dinuguan', 'Q', '../../uploads/Dinuguan.jpg', 'Dinuguan', 9, 0.00, 0.00, '2024-09-05 14:39:33', '2025-02-09 13:22:58', NULL);
INSERT INTO `product` VALUES (18, 27, 2, 'Tapa with Rice', 'Tapa with Rice', '../../uploads/Idontknow.jpg', 'Tapa with Rice', 111, 99.00, 109.00, '2024-09-05 14:40:14', '2025-02-06 13:44:42', NULL);
INSERT INTO `product` VALUES (22, 26, 2, 'Palabok BILAO', 'Palabok BILAO', '../../uploads/main6.jpg', 'Palabok BILAO', 0, 177.00, 188.00, '2024-11-08 22:11:48', '2025-02-09 13:23:07', NULL);
INSERT INTO `product` VALUES (24, NULL, NULL, '123', '1', '', 'qwe', NULL, 11.00, 11.00, '2025-02-06 12:10:16', '2025-02-09 13:45:49', 'Booking');
INSERT INTO `product` VALUES (26, NULL, NULL, 'TestBooking', '1', '../../uploads/z.jpg', 'TestBooking', 11, NULL, 1.00, '2025-02-09 13:39:54', '2025-02-09 15:41:05', 'Booking');

-- ----------------------------
-- Table structure for product_image
-- ----------------------------
DROP TABLE IF EXISTS `product_image`;
CREATE TABLE `product_image`  (
  `product_image_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NULL DEFAULT NULL,
  `product_image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_image_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of product_image
-- ----------------------------
INSERT INTO `product_image` VALUES (29, 27, '../../uploads/b.jpg', '2025-02-09 13:54:10', '2025-02-09 13:54:10');
INSERT INTO `product_image` VALUES (30, 27, '../../uploads/v.jpg', '2025-02-09 13:54:10', '2025-02-09 13:54:10');
INSERT INTO `product_image` VALUES (31, 24, '../../uploads/c.jpg', '2025-02-09 13:54:19', '2025-02-09 13:54:19');
INSERT INTO `product_image` VALUES (32, 26, '../../uploads/x.jpg', '2025-02-09 13:54:25', '2025-02-09 13:54:25');

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
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `purchase_order` VALUES (17, 123123, 26, 17, 20, '2024-11-08 22:43:23', '2024-11-08 22:43:23');
INSERT INTO `purchase_order` VALUES (18, 1212, 28, 17, 0, '2025-02-06 13:50:02', '2025-02-06 13:52:21');

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
INSERT INTO `supplier` VALUES (26, 'Pendragon', '1', 1, 123, 'test1@gmail.com', '123', '2024-09-04 14:22:47', '2024-11-08 22:44:29');
INSERT INTO `supplier` VALUES (27, 'Razzon', '2', 2, 2323, 'test1@gmail.com', '23', '2024-09-04 14:22:53', '2024-11-08 22:44:34');
INSERT INTO `supplier` VALUES (28, 'Puregold', '123', 123, 1, 'test1@gmail.com', '123', '2024-09-06 21:19:57', '2024-11-08 22:44:37');
INSERT INTO `supplier` VALUES (29, 'SM SUPERMARKET', 'Supplier2', 0, 123123, 'gajultos.garry123@gmail.com', '123', '2024-09-06 22:19:56', '2024-11-08 21:57:10');

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
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Garry Gajultos', 'garry', '123123@gmail.com', 123123123, '$2y$10$WGi/uM4qKM.wH5BmtrqVHu23pmWYbfIIsRH0SDYSq42hYJWIhTyXS', '123123', '', '2024-04-07 16:08:00', '2024-11-01 11:10:14', 1, '1', 'Active', '1');
INSERT INTO `users` VALUES (2, 'Test Account', 'Ron', '123123@gmail.comm', NULL, '$2y$10$Wtj4pYEWKXHYe4DUwLPTveZdPJUNrXwfkfeZRWXO4bnmbNd9NOA9y', 'test1005', NULL, '2024-05-13 18:18:17', '2024-11-08 22:57:38', 1, '1', 'Active', 'qweqwe');
INSERT INTO `users` VALUES (39, 'Garrrrrr', 'test', 'gajultos.garrydev@gmail.com', 1, '$2y$10$XX19Ar6P.ig1stK9lZ0N2eP89FY5FughUlK0xhgDfLj1P60tMMPva', '1', NULL, '2024-09-13 23:58:14', '2025-02-09 15:47:49', 4, '1', 'Active', '123123123');
INSERT INTO `users` VALUES (40, 'LCC WQE', 'testacc', 'Test@gmail.com', 123123, '$2y$10$9KeTSQ5PmtdiiqdqmsiUSuQs7OujRChozbhCai948a1DGo8Xq.mSe', 'test1005', NULL, '2024-09-13 23:58:14', '2024-11-08 22:55:25', 0, '0', 'Active', '123123123');

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
  `transaction_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `orders_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deliveries_module` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`user_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usertype
-- ----------------------------
INSERT INTO `usertype` VALUES (1, 'Admin', '2024-09-04 10:46:35', '2024-11-08 22:59:31', '1', '1', '1', '1', '1', '1', '1');
INSERT INTO `usertype` VALUES (3, 'Staff', '2024-09-04 10:46:46', '2024-11-08 22:57:55', '1', '1', '1', '1', '0', '1', '1');
INSERT INTO `usertype` VALUES (4, 'Delivery Rider', '2024-10-12 11:21:06', '2024-11-01 10:50:10', '1', '1', '1', '1', '1', '1', '1');

SET FOREIGN_KEY_CHECKS = 1;
