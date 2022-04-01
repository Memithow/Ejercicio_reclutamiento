/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50734
 Source Host           : localhost:3306
 Source Schema         : php_login_database

 Target Server Type    : MySQL
 Target Server Version : 50734
 File Encoding         : 65001

 Date: 01/04/2022 12:07:36
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `color` varchar(100) NOT NULL,
  UNIQUE KEY `NewTable_id_IDX` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'memorlach2@gmail.com', '$2y$10$scj0gv6xd1dmU/UpC1is4ug.Tr/hLpAv9RvxHDnP4DN25wI8o1Mjm', 'Verde');
INSERT INTO `users` VALUES (2, 'memo@cyma.mx', '$2y$10$vV07IWaXe5c2I3D6/bmXaef48mY2LclBhR0O9R2HyLsCpR3E4WPSm', 'Rojo');
INSERT INTO `users` VALUES (3, 'compras@cyma.mx', '$2y$10$oXlsczAXC8ulibAVos/zruqk.vYBwqrx0oKl44xTJopIZ4ynJL3D6', 'Azul');
INSERT INTO `users` VALUES (4, 'compras@cyma.mx', '$2y$10$AAatcoijVkKL6KD7vJaf4ekj9O1MeAUJkfo5aHhyMnbGZQQmeOfyC', 'Azul');
INSERT INTO `users` VALUES (5, 'enegence@blog.com', '$2y$10$PDCjvoAVqgXKqgEHOpm0i.Mq1OXxJHmJwdQED3o2mjJUkMPw1sbRi', 'Verde');
INSERT INTO `users` VALUES (6, 'principalUser1@gmail.com', '$2y$10$BhTnFsVJcywZR8dlbA.0Y.m.j9C8qEBImqpOc/s7Rg/UdmYRBKs.S', 'Verde');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
