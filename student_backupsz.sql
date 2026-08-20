/*
 Navicat Premium Data Transfer

 Source Server         : ClinicSystem
 Source Server Type    : MySQL
 Source Server Version : 100432
 Source Host           : localhost:3306
 Source Schema         : clinicrecorddb

 Target Server Type    : MySQL
 Target Server Version : 100432
 File Encoding         : 65001

 Date: 18/08/2026 17:21:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student`  (
  `LRN` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `middle_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `address` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `grade_level` int NULL DEFAULT NULL,
  `section` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `birthday` date NULL DEFAULT NULL,
  `student_contact_no` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `parent_contact_no` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`LRN`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('112452103268', 'mama', 'mo', 'papako', 'Male', 'sitio barangay council', 10, 'yes', '2026-07-30', '09452365987', '09241587419');
INSERT INTO `student` VALUES ('112470140031', 'John Christian', 'Moralde', 'Bacani', 'Female', 'Kataid Kang Kapitbahay', 11, 'Prog-1', '1990-08-21', '09070145674', '09145862170');
INSERT INTO `student` VALUES ('112762140004', 'Angelo Thomas', 'Tayas', 'Bajar', 'Male', 'Secret hihi', 12, 'Prog-1', '2009-05-18', '09124571236', '09362547125');
INSERT INTO `student` VALUES ('114500140504', 'Karsten Keanne', 'Anselmo', 'Varua', 'Male', 'Secret', 12, 'secret', '2009-02-17', '09245157851', '09123456789');
INSERT INTO `student` VALUES ('114526352014', 'Yuri Andrei', 'Olandez', 'Rili', 'Male', 'San Felipe, Naga City', 12, 'Prog-2', '2009-01-09', '09141236258', '09253652147');
INSERT INTO `student` VALUES ('114592834192', 'Mhike Lorenz', 'Ricafrente', 'Maleniza', 'Male', 'Sta Lucia, Magarao, Camarines Sur', 11, 'Prog-2', '2009-10-22', '09124851236', '09147523698');
INSERT INTO `student` VALUES ('114758596325', 'Shane Vitto Rogelio', 'Agna', 'Masagca Jr.', 'Male', 'Camaligan', 12, 'Prog-2', '2009-05-05', '09142563258', '09478526369');
INSERT INTO `student` VALUES ('115478596324', 'Mark Denver', '', 'Medrano', 'Male', 'asasdadasd', 12, 'repeater', '2026-08-12', '13123123123', '123131212');
INSERT INTO `student` VALUES ('123456789101', 'mama brenda', 'aranez', 'nebrea', 'Female', 'balatas', 12, 'prog 2', '1982-07-28', '5555566666', '23131312313');
INSERT INTO `student` VALUES ('141466598741', 'John Selwyn ', 'Saguion', 'Oroy', 'Female', 'Jan lang sa gilid', 8, 'secret', '2026-08-13', '096969696969', '09123581274');
INSERT INTO `student` VALUES ('198741236959', 'Mikko', 'Estefani', 'Eduarte', 'Male', 'Sta Lucia, Magarao, Camarines Sur', 12, 'Prog-1', '2009-08-04', '09123654785', '09351478412');

SET FOREIGN_KEY_CHECKS = 1;
