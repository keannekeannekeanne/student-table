/*
 Navicat Premium Dump SQL

 Source Server         : ditabass
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : clinicrecorddb

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 19/08/2026 11:44:11
*/

use clinicrecorddb;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;



-- ----------------------------
-- Table structure for clinic_visit
-- ----------------------------
DROP TABLE IF EXISTS `clinic_visit`;
CREATE TABLE `clinic_visit`  (
  `visit_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lrn` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `personel_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `visir_date` date NULL DEFAULT NULL,
  `symptoms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `diagnosis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `chief_reasons` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `vital_signals` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`visit_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of clinic_visit
-- ----------------------------

-- ----------------------------
-- Table structure for medical_personel
-- ----------------------------
DROP TABLE IF EXISTS `medical_personel`;
CREATE TABLE `medical_personel`  (
  `personel_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `contact_no` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `license_no` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`personel_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of medical_personel
-- ----------------------------

-- ----------------------------
-- Table structure for medication
-- ----------------------------
DROP TABLE IF EXISTS `medication`;
CREATE TABLE `medication`  (
  `medication` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `medication_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `expiry_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`medication`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of medication
-- ----------------------------

-- ----------------------------
-- Table structure for prescription_detail
-- ----------------------------
DROP TABLE IF EXISTS `prescription_detail`;
CREATE TABLE `prescription_detail`  (
  `prescrioption_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `visit_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `medication_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dosage` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `instructions` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`prescrioption_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of prescription_detail
-- ----------------------------

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
  `pin_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`LRN`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('112452103268', 'mama', 'mo', 'papako', 'Male', 'sitio barangay council', 10, 'yes', '2026-07-30', '09452365987', '09241587419', '696969');
INSERT INTO `student` VALUES ('112470140031', 'John Christian', 'Moralde', 'Bacani', 'Female', 'Kataid Kang Kapitbahay', 11, 'Prog-1', '1990-08-21', '09070145674', '09145862170', '082109');
INSERT INTO `student` VALUES ('112762140004', 'Angelo Thomas', 'Tayas', 'Bajar', 'Male', 'Secret hihi', 12, 'Prog-1', '2009-05-18', '09124571236', '09362547125', '051809');
INSERT INTO `student` VALUES ('114500140504', 'Karsten Keanne', 'Anselmo', 'Varua', 'Male', 'Lumang Baranggay City', 12, 'secret', '2009-02-17', '09245157851', '09123456789', '021709');
INSERT INTO `student` VALUES ('114526352014', 'Yuri Andrei', 'Olandez', 'Rili', 'Male', 'San Felipe, Naga City', 12, 'Prog-2', '2009-01-09', '09141236258', '09253652147', '010909');
INSERT INTO `student` VALUES ('114592834192', 'Mhike Lorenz', 'Ricafrente', 'Maleniza', 'Male', 'Sta Lucia, Magarao, Camarines Sur', 11, 'Prog-2', '2009-10-22', '09124851236', '09147523698', '102209');
INSERT INTO `student` VALUES ('114758596325', 'Shane Vitto Rogelio', 'Agna', 'Masagca Jr.', 'Male', 'Camaligan', 12, 'Prog-2', '2009-05-05', '09142563258', '09478526369', '050509');
INSERT INTO `student` VALUES ('115478596324', 'Mark Denver', '', 'Medrano', 'Male', 'asasdadasd', 12, 'repeater', '2026-08-12', '13123123123', '123131212', '081209');
INSERT INTO `student` VALUES ('123456789101', 'mama brenda', 'aranez', 'nebrea', 'Female', 'balatas', 12, 'prog 2', '1982-07-28', '5555566666', '23131312313', '072882');
INSERT INTO `student` VALUES ('141466598741', 'John Selwyn ', 'Saguion', 'Oroy', 'Female', 'Jan lang sa gilid', 8, 'secret', '2026-08-13', '096969696969', '09123581274', '081309');
INSERT INTO `student` VALUES ('198741236959', 'Mikko', 'Estefani', 'Eduarte', 'Male', 'Sta Lucia, Magarao, Camarines Sur', 12, 'Prog-1', '2009-08-04', '09123654785', '09351478412', '080409');

-- ----------------------------
-- Table structure for student_medical_profile
-- ----------------------------
DROP TABLE IF EXISTS `student_medical_profile`;
CREATE TABLE `student_medical_profile`  (
  `LRN` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Allergies` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Medical_history` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Blood_Type` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `Medical_remarks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`LRN`) USING BTREE,
  CONSTRAINT `student_medical_profile_ibfk_1` FOREIGN KEY (`LRN`) REFERENCES `student` (`LRN`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of student_medical_profile
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
