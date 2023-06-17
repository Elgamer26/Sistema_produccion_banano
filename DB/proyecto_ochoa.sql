/*
 Navicat Premium Data Transfer

 Source Server         : Mysql
 Source Server Type    : MySQL
 Source Server Version : 80028
 Source Host           : localhost:3306
 Source Schema         : proyecto_ochoa

 Target Server Type    : MySQL
 Target Server Version : 80028
 File Encoding         : 65001

 Date: 01/05/2022 13:07:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for asignacion_actividad
-- ----------------------------
DROP TABLE IF EXISTS `asignacion_actividad`;
CREATE TABLE `asignacion_actividad`  (
  `id_asignacion_actividad` int NOT NULL AUTO_INCREMENT,
  `id_empleado` int NULL DEFAULT NULL,
  `id_tipo_actividad` int NULL DEFAULT NULL,
  `costo_actividad` decimal(10, 2) NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `actividad` int NULL DEFAULT 1,
  PRIMARY KEY (`id_asignacion_actividad`) USING BTREE,
  INDEX `id_empleado`(`id_empleado`) USING BTREE,
  INDEX `id_tipo_actividad`(`id_tipo_actividad`) USING BTREE,
  CONSTRAINT `asignacion_actividad_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `asignacion_actividad_ibfk_2` FOREIGN KEY (`id_tipo_actividad`) REFERENCES `tipo_actividad` (`id_tipo_actividad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of asignacion_actividad
-- ----------------------------
INSERT INTO `asignacion_actividad` VALUES (1, 1, 2, 15.00, '2022-03-01', 1, 0);
INSERT INTO `asignacion_actividad` VALUES (2, 3, 6, 25.00, '2022-03-01', 1, 1);
INSERT INTO `asignacion_actividad` VALUES (3, 2, 2, 20.00, '2022-03-03', 1, 1);
INSERT INTO `asignacion_actividad` VALUES (4, 4, 4, 20.00, '2022-04-26', 1, 1);

-- ----------------------------
-- Table structure for asistencia
-- ----------------------------
DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE `asistencia`  (
  `id_asistencia` int NOT NULL AUTO_INCREMENT,
  `id_empleado` int NULL DEFAULT NULL,
  `fecha_hora_ingreso` datetime(0) NULL DEFAULT NULL,
  `fecha_hora_salida` datetime(0) NULL DEFAULT NULL,
  `estado_asistencia` int NULL DEFAULT 1,
  `asitencia_pagado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_asistencia`) USING BTREE,
  INDEX `id_empleado`(`id_empleado`) USING BTREE,
  CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of asistencia
-- ----------------------------
INSERT INTO `asistencia` VALUES (1, 1, '2022-03-01 09:52:00', '2022-03-01 10:20:00', 0, 1);
INSERT INTO `asistencia` VALUES (2, 2, '2022-03-01 10:35:00', '2022-03-01 19:36:00', 0, 0);
INSERT INTO `asistencia` VALUES (3, 1, '2022-03-01 10:54:00', '2022-03-01 14:53:00', 0, 1);
INSERT INTO `asistencia` VALUES (4, 2, '2022-03-01 13:55:00', '2022-03-01 16:55:00', 0, 0);
INSERT INTO `asistencia` VALUES (5, 1, '2022-03-02 20:23:00', '2022-03-02 05:26:00', 0, 1);
INSERT INTO `asistencia` VALUES (6, 4, '2022-04-26 09:00:00', '2022-04-26 15:00:00', 0, 0);
INSERT INTO `asistencia` VALUES (7, 4, '2022-04-27 09:00:00', '2022-04-27 15:00:00', 0, 0);
INSERT INTO `asistencia` VALUES (8, 4, '2022-04-26 07:00:00', '2022-04-26 15:00:00', 0, 0);
INSERT INTO `asistencia` VALUES (9, 4, '2022-04-27 07:00:00', '2022-04-27 15:00:00', 0, 0);
INSERT INTO `asistencia` VALUES (10, 4, '2022-04-28 07:00:00', '2022-04-28 15:00:00', 0, 0);
INSERT INTO `asistencia` VALUES (11, 4, '2022-04-26 07:00:00', '2022-04-26 15:00:00', 0, 0);
INSERT INTO `asistencia` VALUES (12, 4, '2022-04-27 07:00:00', '2022-05-01 11:28:00', 0, 1);
INSERT INTO `asistencia` VALUES (13, 1, '2022-05-01 11:27:00', '2022-05-01 18:00:00', 0, 1);
INSERT INTO `asistencia` VALUES (14, 2, '2022-05-01 09:00:00', '2022-05-01 16:00:00', 0, 0);

-- ----------------------------
-- Table structure for beneficios_rol
-- ----------------------------
DROP TABLE IF EXISTS `beneficios_rol`;
CREATE TABLE `beneficios_rol`  (
  `id_beneficios` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `valor` decimal(10, 2) NULL DEFAULT NULL,
  `tipo` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_beneficios`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of beneficios_rol
-- ----------------------------
INSERT INTO `beneficios_rol` VALUES (1, 'valor del IESS', 9.45, 'Egreso', 1);
INSERT INTO `beneficios_rol` VALUES (2, 'Horas extras', 12.00, 'Ingreso', 1);
INSERT INTO `beneficios_rol` VALUES (3, 'comisiones', 14.00, 'Ingreso', 1);
INSERT INTO `beneficios_rol` VALUES (4, 'transporte', 12.00, 'Egreso', 1);
INSERT INTO `beneficios_rol` VALUES (5, 'Prestamo Quirogra IESS', 5.00, 'Egreso', 1);
INSERT INTO `beneficios_rol` VALUES (6, 'No tiene beneficios', 0.00, 'Egreso', 1);

-- ----------------------------
-- Table structure for cintas
-- ----------------------------
DROP TABLE IF EXISTS `cintas`;
CREATE TABLE `cintas`  (
  `id_cintas` int NOT NULL AUTO_INCREMENT,
  `id_produccion` int NULL DEFAULT NULL,
  `id_tipo_cinta` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `detalle` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_cintas`) USING BTREE,
  INDEX `id_produccion`(`id_produccion`) USING BTREE,
  INDEX `id_tipo_cinta`(`id_tipo_cinta`) USING BTREE,
  CONSTRAINT `cintas_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cintas_ibfk_2` FOREIGN KEY (`id_tipo_cinta`) REFERENCES `tipo_cinta` (`id_tipo_cinta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cintas
-- ----------------------------
INSERT INTO `cintas` VALUES (5, 44, 1, '2022-05-01', 'aaaaaaaaa', 1);
INSERT INTO `cintas` VALUES (6, 44, 2, '2022-05-01', 'aaaaaaaaa', 1);
INSERT INTO `cintas` VALUES (7, 44, 3, '2022-05-01', '123', 1);
INSERT INTO `cintas` VALUES (8, 44, 4, '2022-05-01', '123', 1);
INSERT INTO `cintas` VALUES (9, 44, 5, '2022-05-01', '111', 1);
INSERT INTO `cintas` VALUES (10, 44, 6, '2022-05-01', '111', 1);
INSERT INTO `cintas` VALUES (11, 44, 7, '2022-05-01', '111', 1);
INSERT INTO `cintas` VALUES (12, 44, 8, '2022-05-01', '111', 1);
INSERT INTO `cintas` VALUES (13, 44, 9, '2022-05-01', '111', 1);
INSERT INTO `cintas` VALUES (17, 45, 1, '2022-05-01', 'aaaaaaa', 1);
INSERT INTO `cintas` VALUES (21, 44, 10, '2022-05-01', '12', 1);
INSERT INTO `cintas` VALUES (22, 45, 2, '2022-05-01', 'cosehca', 1);
INSERT INTO `cintas` VALUES (23, 45, 3, '2022-05-01', 'limpieza', 1);
INSERT INTO `cintas` VALUES (24, 45, 4, '2022-05-01', 'deshoje', 1);
INSERT INTO `cintas` VALUES (25, 45, 5, '2022-05-01', 'plamado', 1);
INSERT INTO `cintas` VALUES (26, 45, 6, '2022-05-01', 'funado', 1);
INSERT INTO `cintas` VALUES (27, 45, 7, '2022-05-01', 'sembrado', 1);
INSERT INTO `cintas` VALUES (28, 45, 8, '2022-05-01', 'lebanto', 1);
INSERT INTO `cintas` VALUES (29, 45, 9, '2022-05-01', 'fumigado', 1);
INSERT INTO `cintas` VALUES (30, 45, 10, '2022-05-01', 'tratado', 1);
INSERT INTO `cintas` VALUES (31, 46, 1, '2022-05-01', 'SEMBRADO', 1);
INSERT INTO `cintas` VALUES (33, 46, 2, '2022-05-01', 'FUMIGADO', 1);
INSERT INTO `cintas` VALUES (34, 46, 3, '2022-05-01', 'LOCHETA', 1);
INSERT INTO `cintas` VALUES (35, 46, 4, '2022-05-01', 'PAGADO', 1);
INSERT INTO `cintas` VALUES (36, 46, 5, '2022-05-01', 'RICO', 1);

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `apellidos` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cedula` char(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `telefono` char(13) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(120) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `sexo` char(11) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_cliente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cliente
-- ----------------------------
INSERT INTO `cliente` VALUES (1, 'jorge', 'ramirez', '0940321854', '1233', 'elgamer-26@hotmail.com', 'casita', 'Masculino', 1);
INSERT INTO `cliente` VALUES (2, 'El ochoa', 'Humas', '1111111111', '1234444555', 'miltonochoa2811@gmail.com', 'asas', 'Femenino', 1);

-- ----------------------------
-- Table structure for compra_insumo
-- ----------------------------
DROP TABLE IF EXISTS `compra_insumo`;
CREATE TABLE `compra_insumo`  (
  `id_compra_insumo` int NOT NULL AUTO_INCREMENT,
  `proveedor_id` int NULL DEFAULT NULL,
  `numero_compra` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `tipo_comprobante` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `impuesto` decimal(10, 2) NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `sub_total` decimal(10, 2) NULL DEFAULT NULL,
  `sub_iva` decimal(10, 2) NULL DEFAULT NULL,
  `gran_total` decimal(10, 2) NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_compra_insumo`) USING BTREE,
  INDEX `proveedor_id`(`proveedor_id`) USING BTREE,
  CONSTRAINT `compra_insumo_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of compra_insumo
-- ----------------------------
INSERT INTO `compra_insumo` VALUES (3, 1, '12', 'Boleta', 0.00, '2022-02-28', 102.00, 0.00, 0.00, 2, 1);
INSERT INTO `compra_insumo` VALUES (4, 1, '11', 'Factura', 0.12, '2022-02-28', 390.00, 46.80, 436.80, 2, 1);
INSERT INTO `compra_insumo` VALUES (5, 1, '100', 'Factura', 0.12, '2022-02-28', 12.00, 1.44, 13.44, 1, 1);
INSERT INTO `compra_insumo` VALUES (6, 1, '01', 'Boleta', 0.00, '2022-04-14', 460.00, 0.00, 0.00, 1, 1);
INSERT INTO `compra_insumo` VALUES (7, 1, '20220418180442', 'Factura', 0.12, '2022-04-24', 48.00, 5.76, 53.76, 2, 1);

-- ----------------------------
-- Table structure for compra_material
-- ----------------------------
DROP TABLE IF EXISTS `compra_material`;
CREATE TABLE `compra_material`  (
  `id_compra_material` int NOT NULL AUTO_INCREMENT,
  `proveedor_id` int NULL DEFAULT NULL,
  `numero_compra` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `tipo_comprobante` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `impuesto` decimal(10, 2) NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `sub_total` decimal(10, 2) NULL DEFAULT NULL,
  `sub_iva` decimal(10, 2) NULL DEFAULT NULL,
  `gran_total` decimal(10, 2) NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_compra_material`) USING BTREE,
  INDEX `proveedor_id`(`proveedor_id`) USING BTREE,
  CONSTRAINT `compra_material_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of compra_material
-- ----------------------------
INSERT INTO `compra_material` VALUES (12, 1, '123', 'Factura', 0.12, '2022-02-28', 6710.00, 805.20, 7515.20, 2, 1);
INSERT INTO `compra_material` VALUES (13, 2, '12345', 'Factura', 0.12, '2022-02-28', 121.00, 14.52, 135.52, 1, 1);
INSERT INTO `compra_material` VALUES (14, 1, '12311', 'Boleta', 0.00, '2022-03-04', 1477.44, 0.00, 0.00, 1, 1);
INSERT INTO `compra_material` VALUES (15, 1, '12345678', 'Boleta', 0.00, '2022-03-05', 12100.00, 0.00, 0.00, 1, 1);
INSERT INTO `compra_material` VALUES (16, 1, '20220418180408', 'Factura', 0.12, '2022-04-24', 123.12, 14.77, 137.89, 1, 1);
INSERT INTO `compra_material` VALUES (17, 1, '20220418180442', 'Factura', 0.12, '2022-04-24', 1344.12, 161.29, 1505.41, 3, 1);

-- ----------------------------
-- Table structure for control_plagas
-- ----------------------------
DROP TABLE IF EXISTS `control_plagas`;
CREATE TABLE `control_plagas`  (
  `id_control_plagas` int NOT NULL AUTO_INCREMENT,
  `id_produccion` int NULL DEFAULT NULL,
  `id_tipo_plaga` int NULL DEFAULT NULL,
  `id_usuario` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `foto` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `control_plaga` int NULL DEFAULT 0,
  PRIMARY KEY (`id_control_plagas`) USING BTREE,
  INDEX `id_produccion`(`id_produccion`) USING BTREE,
  INDEX `id_tipo_plaga`(`id_tipo_plaga`) USING BTREE,
  INDEX `id_usuario`(`id_usuario`) USING BTREE,
  CONSTRAINT `control_plagas_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `control_plagas_ibfk_2` FOREIGN KEY (`id_tipo_plaga`) REFERENCES `tipo_plaga` (`id_tipo_plaga`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `control_plagas_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of control_plagas
-- ----------------------------
INSERT INTO `control_plagas` VALUES (10, 44, 2, 1, '2022-04-29', 'aaaaaaaaaa', 'img/plaga/IMG2842022184137.png', 1, 1);
INSERT INTO `control_plagas` VALUES (11, 45, 2, 1, '2022-05-19', 'esta bien plaga', 'img/plaga/IMG152022113323.png', 1, 1);

-- ----------------------------
-- Table structure for detall_venta_desechos
-- ----------------------------
DROP TABLE IF EXISTS `detall_venta_desechos`;
CREATE TABLE `detall_venta_desechos`  (
  `id_detalle_venta_desechos` int NOT NULL AUTO_INCREMENT,
  `id_venta_desechos` int NULL DEFAULT NULL,
  `id_detalle_desechos` int NULL DEFAULT NULL,
  `tipo` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descuento` decimal(10, 2) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_detalle_venta_desechos`) USING BTREE,
  INDEX `id_venta_desechos`(`id_venta_desechos`) USING BTREE,
  INDEX `id_detalle_desechos`(`id_detalle_desechos`) USING BTREE,
  CONSTRAINT `detall_venta_desechos_ibfk_1` FOREIGN KEY (`id_venta_desechos`) REFERENCES `venta_desechos` (`id_venta_desechos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detall_venta_desechos_ibfk_2` FOREIGN KEY (`id_detalle_desechos`) REFERENCES `rechasos_produccion` (`id_detalle_produccion_rechasos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detall_venta_desechos
-- ----------------------------

-- ----------------------------
-- Table structure for detall_venta_racimos
-- ----------------------------
DROP TABLE IF EXISTS `detall_venta_racimos`;
CREATE TABLE `detall_venta_racimos`  (
  `id_detalle_venta_racimos` int NOT NULL AUTO_INCREMENT,
  `id_venta_racimos` int NULL DEFAULT NULL,
  `id_detalle_racimos` int NULL DEFAULT NULL,
  `tipo` char(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descuento` decimal(10, 2) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `peso` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle_venta_racimos`) USING BTREE,
  INDEX `id_venta_racimos`(`id_venta_racimos`) USING BTREE,
  INDEX `id_detalle_racimos`(`id_detalle_racimos`) USING BTREE,
  CONSTRAINT `detall_venta_racimos_ibfk_1` FOREIGN KEY (`id_venta_racimos`) REFERENCES `venta_racimos` (`id_venta_racimos`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detall_venta_racimos_ibfk_2` FOREIGN KEY (`id_detalle_racimos`) REFERENCES `rasimos_produccion` (`id_detalle_produccion_racimos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detall_venta_racimos
-- ----------------------------

-- ----------------------------
-- Table structure for detalle_actividad_porduccion
-- ----------------------------
DROP TABLE IF EXISTS `detalle_actividad_porduccion`;
CREATE TABLE `detalle_actividad_porduccion`  (
  `id_detalle_actividad` int NOT NULL AUTO_INCREMENT,
  `id_produccion` int NULL DEFAULT NULL,
  `id_actividad` int NULL DEFAULT NULL,
  `actividad` char(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `costo` decimal(10, 2) NULL DEFAULT NULL,
  `estado_ac` int NULL DEFAULT 1,
  `pago_ac` int NULL DEFAULT 0,
  `hora_trabajo` int NULL DEFAULT NULL,
  `costo_hora` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle_actividad`) USING BTREE,
  INDEX `id_produccion`(`id_produccion`) USING BTREE,
  INDEX `id_actividad`(`id_actividad`) USING BTREE,
  CONSTRAINT `detalle_actividad_porduccion_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_actividad_porduccion_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `asignacion_actividad` (`id_asignacion_actividad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalle_actividad_porduccion
-- ----------------------------
INSERT INTO `detalle_actividad_porduccion` VALUES (44, 38, 3, 'Apuntalamiento', 20.00, 1, 0, 8, 2.50);
INSERT INTO `detalle_actividad_porduccion` VALUES (45, 39, 2, 'Drenajes', 25.00, 0, 0, 8, 3.13);
INSERT INTO `detalle_actividad_porduccion` VALUES (46, 40, 3, 'Apuntalamiento', 20.00, 1, 0, 8, 2.50);
INSERT INTO `detalle_actividad_porduccion` VALUES (47, 41, 1, 'Apuntalamiento', 15.00, 1, 0, 8, 1.88);
INSERT INTO `detalle_actividad_porduccion` VALUES (48, 42, 1, 'Apuntalamiento', 15.00, 1, 0, 8, 1.88);
INSERT INTO `detalle_actividad_porduccion` VALUES (49, 43, 1, 'Apuntalamiento', 15.00, 1, 0, 8, 1.88);
INSERT INTO `detalle_actividad_porduccion` VALUES (50, 44, 1, 'Apuntalamiento', 15.00, 1, 0, 8, 1.88);
INSERT INTO `detalle_actividad_porduccion` VALUES (51, 45, 3, 'Apuntalamiento', 20.00, 1, 1, 8, 2.50);
INSERT INTO `detalle_actividad_porduccion` VALUES (52, 46, 1, 'Apuntalamiento', 15.00, 1, 0, 8, 1.88);

-- ----------------------------
-- Table structure for detalle_compra_insumo
-- ----------------------------
DROP TABLE IF EXISTS `detalle_compra_insumo`;
CREATE TABLE `detalle_compra_insumo`  (
  `id_detalle_compra_insumo` int NOT NULL AUTO_INCREMENT,
  `id_compra_insumo` int NULL DEFAULT NULL,
  `id_insumo` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `medida` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descuento` decimal(10, 2) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_detalle_compra_insumo`) USING BTREE,
  INDEX `id_compra_insumo`(`id_compra_insumo`) USING BTREE,
  INDEX `id_insumo`(`id_insumo`) USING BTREE,
  CONSTRAINT `detalle_compra_insumo_ibfk_1` FOREIGN KEY (`id_compra_insumo`) REFERENCES `compra_insumo` (`id_compra_insumo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_compra_insumo_ibfk_2` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id_insumo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalle_compra_insumo
-- ----------------------------
INSERT INTO `detalle_compra_insumo` VALUES (1, 3, 1, 1, '123 kg', 12.00, 0.00, 12.00, 1);
INSERT INTO `detalle_compra_insumo` VALUES (2, 3, 2, 1, '12 LT e', 90.00, 0.00, 90.00, 1);
INSERT INTO `detalle_compra_insumo` VALUES (3, 4, 1, 10, '123 kg', 12.00, 0.00, 120.00, 1);
INSERT INTO `detalle_compra_insumo` VALUES (4, 4, 2, 3, '12 LT e', 90.00, 0.00, 270.00, 1);
INSERT INTO `detalle_compra_insumo` VALUES (5, 5, 1, 1, '123 kg', 12.00, 0.00, 12.00, 1);
INSERT INTO `detalle_compra_insumo` VALUES (6, 6, 3, 20, '20 LT e', 23.00, 0.00, 460.00, 1);
INSERT INTO `detalle_compra_insumo` VALUES (7, 7, 4, 1, 'litros e', 25.00, 0.00, 25.00, 1);
INSERT INTO `detalle_compra_insumo` VALUES (8, 7, 3, 1, 'litros e', 23.00, 0.00, 23.00, 1);

-- ----------------------------
-- Table structure for detalle_compra_material
-- ----------------------------
DROP TABLE IF EXISTS `detalle_compra_material`;
CREATE TABLE `detalle_compra_material`  (
  `id_detalle_compra_material` int NOT NULL AUTO_INCREMENT,
  `id_compra_material` int NULL DEFAULT NULL,
  `id_material` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `descuento` decimal(10, 2) NULL DEFAULT NULL,
  `subtotal` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_detalle_compra_material`) USING BTREE,
  INDEX `id_compra_material`(`id_compra_material`) USING BTREE,
  INDEX `id_material`(`id_material`) USING BTREE,
  CONSTRAINT `detalle_compra_material_ibfk_1` FOREIGN KEY (`id_compra_material`) REFERENCES `compra_material` (`id_compra_material`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_compra_material_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalle_compra_material
-- ----------------------------
INSERT INTO `detalle_compra_material` VALUES (16, 15, 2, 100, 121.00, 0.00, 12100.00, 1);
INSERT INTO `detalle_compra_material` VALUES (17, 16, 1, 1, 123.12, 0.00, 123.12, 1);
INSERT INTO `detalle_compra_material` VALUES (18, 17, 3, 1, 1100.00, 0.00, 1100.00, 1);
INSERT INTO `detalle_compra_material` VALUES (19, 17, 2, 1, 121.00, 0.00, 121.00, 1);
INSERT INTO `detalle_compra_material` VALUES (20, 17, 1, 1, 123.12, 0.00, 123.12, 1);

-- ----------------------------
-- Table structure for detalle_insumos_produccion
-- ----------------------------
DROP TABLE IF EXISTS `detalle_insumos_produccion`;
CREATE TABLE `detalle_insumos_produccion`  (
  `id_detalle_insumos` int NOT NULL AUTO_INCREMENT,
  `id_produccion` int NULL DEFAULT NULL,
  `id_insumos` int NULL DEFAULT NULL,
  `costo` decimal(10, 2) NULL DEFAULT NULL,
  `medida_cantida` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `medida` char(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_detalle_insumos`) USING BTREE,
  INDEX `id_produccion`(`id_produccion`) USING BTREE,
  INDEX `id_insumos`(`id_insumos`) USING BTREE,
  CONSTRAINT `detalle_insumos_produccion_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_insumos_produccion_ibfk_2` FOREIGN KEY (`id_insumos`) REFERENCES `insumos` (`id_insumo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalle_insumos_produccion
-- ----------------------------
INSERT INTO `detalle_insumos_produccion` VALUES (35, 38, 1, 12.00, '123', 'Kilogramos - kg', 1, 0);
INSERT INTO `detalle_insumos_produccion` VALUES (36, 39, 1, 12.00, '123', 'Kilogramos - kg', 1, 0);
INSERT INTO `detalle_insumos_produccion` VALUES (37, 40, 1, 12.00, '123', 'Kilogramos - kg', 1, 0);
INSERT INTO `detalle_insumos_produccion` VALUES (38, 41, 1, 12.00, '123', 'Kilogramos - kg', 1, 1);
INSERT INTO `detalle_insumos_produccion` VALUES (39, 42, 1, 12.00, '123', 'Kilogramos - kg', 1, 1);
INSERT INTO `detalle_insumos_produccion` VALUES (40, 43, 1, 12.00, '123', 'Kilogramos - kg', 1, 1);
INSERT INTO `detalle_insumos_produccion` VALUES (41, 44, 1, 12.00, '123', 'Kilogramos - kg', 1, 1);
INSERT INTO `detalle_insumos_produccion` VALUES (42, 45, 1, 12.00, '123', 'Kilogramos - kg', 1, 1);
INSERT INTO `detalle_insumos_produccion` VALUES (43, 46, 2, 90.00, '12', 'litros e - LT e', 1, 1);

-- ----------------------------
-- Table structure for detalle_lote
-- ----------------------------
DROP TABLE IF EXISTS `detalle_lote`;
CREATE TABLE `detalle_lote`  (
  `id_detalle_lote` int NOT NULL AUTO_INCREMENT,
  `id_lote` int NULL DEFAULT NULL,
  `hectarea` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `ocupado` int NULL DEFAULT 1,
  `id_produccion` int NULL DEFAULT 0,
  PRIMARY KEY (`id_detalle_lote`) USING BTREE,
  INDEX `id_lote`(`id_lote`) USING BTREE,
  CONSTRAINT `detalle_lote_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detalle_lote
-- ----------------------------
INSERT INTO `detalle_lote` VALUES (5, 6, 'H1', 1, 0, 46);
INSERT INTO `detalle_lote` VALUES (6, 6, 'H2', 1, 1, 0);
INSERT INTO `detalle_lote` VALUES (7, 7, 'H1', 1, 1, 0);
INSERT INTO `detalle_lote` VALUES (8, 7, 'H2', 1, 1, 0);
INSERT INTO `detalle_lote` VALUES (9, 7, 'H3', 1, 1, 0);
INSERT INTO `detalle_lote` VALUES (10, 7, 'H4', 1, 1, 0);
INSERT INTO `detalle_lote` VALUES (11, 8, 'H1', 1, 1, 0);
INSERT INTO `detalle_lote` VALUES (12, 8, 'H2', 1, 1, 0);

-- ----------------------------
-- Table structure for detalle_material_produccion
-- ----------------------------
DROP TABLE IF EXISTS `detalle_material_produccion`;
CREATE TABLE `detalle_material_produccion`  (
  `id_detalle_material` int NOT NULL AUTO_INCREMENT,
  `id_produccion` int NULL DEFAULT NULL,
  `id_material` int NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `costo` decimal(10, 2) NULL DEFAULT NULL,
  `estado_ma` int NULL DEFAULT 1,
  PRIMARY KEY (`id_detalle_material`) USING BTREE,
  INDEX `id_produccion`(`id_produccion`) USING BTREE,
  INDEX `id_material`(`id_material`) USING BTREE,
  CONSTRAINT `detalle_material_produccion_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detalle_material_produccion_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 48 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalle_material_produccion
-- ----------------------------
INSERT INTO `detalle_material_produccion` VALUES (41, 38, 1, 1, 123.12, 0);
INSERT INTO `detalle_material_produccion` VALUES (42, 39, 1, 1, 123.12, 0);
INSERT INTO `detalle_material_produccion` VALUES (43, 40, 1, 1, 123.12, 0);
INSERT INTO `detalle_material_produccion` VALUES (44, 41, 1, 1, 123.12, 1);
INSERT INTO `detalle_material_produccion` VALUES (45, 42, 1, 1, 123.12, 1);
INSERT INTO `detalle_material_produccion` VALUES (46, 43, 1, 1, 123.12, 1);
INSERT INTO `detalle_material_produccion` VALUES (47, 44, 1, 1, 123.12, 1);
INSERT INTO `detalle_material_produccion` VALUES (48, 45, 1, 1, 123.12, 1);
INSERT INTO `detalle_material_produccion` VALUES (49, 46, 1, 1, 123.12, 1);

-- ----------------------------
-- Table structure for detalle_rol_pago_egreso
-- ----------------------------
DROP TABLE IF EXISTS `detalle_rol_pago_egreso`;
CREATE TABLE `detalle_rol_pago_egreso`  (
  `id_detalle_rol_pago_egreso` int NOT NULL AUTO_INCREMENT,
  `id_rol_pagos` int NULL DEFAULT NULL,
  `nombre` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cantidad` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle_rol_pago_egreso`) USING BTREE,
  INDEX `id_rol_pagos`(`id_rol_pagos`) USING BTREE,
  CONSTRAINT `detalle_rol_pago_egreso_ibfk_1` FOREIGN KEY (`id_rol_pagos`) REFERENCES `rol_pagos` (`id_rol_pagos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalle_rol_pago_egreso
-- ----------------------------
INSERT INTO `detalle_rol_pago_egreso` VALUES (9, 10, 'valor del IESS', 292.95);
INSERT INTO `detalle_rol_pago_egreso` VALUES (10, 10, 'transporte', 372.00);
INSERT INTO `detalle_rol_pago_egreso` VALUES (11, 11, 'Valor de las multas/sanciones', 74.00);
INSERT INTO `detalle_rol_pago_egreso` VALUES (12, 11, 'valor del IESS', 360.68);
INSERT INTO `detalle_rol_pago_egreso` VALUES (13, 11, 'transporte', 458.01);
INSERT INTO `detalle_rol_pago_egreso` VALUES (14, 11, 'Prestamo Quirogra IESS', 190.84);
INSERT INTO `detalle_rol_pago_egreso` VALUES (15, 12, 'Valor de las multas/sanciones', 20.00);
INSERT INTO `detalle_rol_pago_egreso` VALUES (16, 13, 'No tiene beneficios', 0.00);
INSERT INTO `detalle_rol_pago_egreso` VALUES (17, 14, 'No tiene beneficios', 0.00);
INSERT INTO `detalle_rol_pago_egreso` VALUES (18, 15, 'No tiene beneficios', 0.00);
INSERT INTO `detalle_rol_pago_egreso` VALUES (19, 16, 'No tiene beneficios', 0.00);
INSERT INTO `detalle_rol_pago_egreso` VALUES (20, 17, 'No tiene beneficios', 0.00);
INSERT INTO `detalle_rol_pago_egreso` VALUES (21, 18, 'No tiene beneficios', 0.00);
INSERT INTO `detalle_rol_pago_egreso` VALUES (22, 19, 'No tiene beneficios', 0.00);
INSERT INTO `detalle_rol_pago_egreso` VALUES (23, 20, 'No tiene beneficios', 0.00);

-- ----------------------------
-- Table structure for detalle_rol_pago_ingreso
-- ----------------------------
DROP TABLE IF EXISTS `detalle_rol_pago_ingreso`;
CREATE TABLE `detalle_rol_pago_ingreso`  (
  `id_detalle_ingreso` int NOT NULL AUTO_INCREMENT,
  `id_rol_pagos` int NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cantidad` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle_ingreso`) USING BTREE,
  INDEX `id_rol_pagos`(`id_rol_pagos`) USING BTREE,
  CONSTRAINT `detalle_rol_pago_ingreso_ibfk_1` FOREIGN KEY (`id_rol_pagos`) REFERENCES `rol_pagos` (`id_rol_pagos`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detalle_rol_pago_ingreso
-- ----------------------------
INSERT INTO `detalle_rol_pago_ingreso` VALUES (12, 10, 'Sueldo', 3100.00);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (13, 10, 'Horas extras', 372.00);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (14, 11, 'Sueldo', 3816.72);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (15, 11, 'Horas extras', 458.01);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (16, 11, 'comisiones', 534.34);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (17, 12, 'Sueldo', 3816.72);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (18, 13, 'Sueldo', 1800.00);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (19, 14, 'Sueldo', 320.00);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (20, 15, 'Sueldo', 1700.00);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (21, 16, 'Sueldo', 1500.00);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (22, 17, 'Sueldo', 30.00);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (23, 18, 'Sueldo', 30.00);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (24, 19, 'Sueldo', 80.00);
INSERT INTO `detalle_rol_pago_ingreso` VALUES (25, 20, 'Sueldo', 17.50);

-- ----------------------------
-- Table structure for empleado
-- ----------------------------
DROP TABLE IF EXISTS `empleado`;
CREATE TABLE `empleado`  (
  `id_empleado` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `cedula` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `telefono` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `sexo` char(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `hoja_vida` int NULL DEFAULT 0,
  `actividad` int NULL DEFAULT 0,
  PRIMARY KEY (`id_empleado`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of empleado
-- ----------------------------
INSERT INTO `empleado` VALUES (1, 'PEDRO JOSE', 'TENE BARRETO', '2002-01-30', '0940321854', 'NARANJAL', '0987867898', 'egamer@hotmail.com', 'Masculino', 'img/empleado/IMG262202218255.jpg', 1, 1, 1);
INSERT INTO `empleado` VALUES (2, 'ANDRES DAVID', 'RAMIREZ ZAVALA', '1997-04-16', '0942268855', 'MILAGRO', '0987678767', 'elgamer-26@hotmil.com', 'Masculino', 'img/empleado/IMG2622022182520.jpg', 1, 1, 1);
INSERT INTO `empleado` VALUES (3, 'JOSE ANTONIO', 'PEREZ MIÑO', '1995-03-02', '0942053067', 'NARANJAL', '0987898789', 'elgamer-26@hotmail.com', 'Masculino', 'img/empleado/empleado.jpg', 1, 1, 1);
INSERT INTO `empleado` VALUES (4, 'ANDRES JORGE', 'PADILLA CABRERA', '1994-12-23', '0941129603', 'NARANJAL', '0987678767', 'jorge23@gmail.com', 'Masculino', 'img/empleado/empleado.jpg', 1, 1, 1);

-- ----------------------------
-- Table structure for empresa
-- ----------------------------
DROP TABLE IF EXISTS `empresa`;
CREATE TABLE `empresa`  (
  `id_empresa` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ruc` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `telefono` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `correo` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `propietario` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `descripion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_empresa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of empresa
-- ----------------------------
INSERT INTO `empresa` VALUES (1, 'nombre banano s.sa', '12345', 'direccion', '121', 'correo@hotmail.com', 'jorge ramirez', 'babano babanobabanobabanobabanobabano', 'img/empresa/IMG2942022131223.jpg');

-- ----------------------------
-- Table structure for hoja_vida
-- ----------------------------
DROP TABLE IF EXISTS `hoja_vida`;
CREATE TABLE `hoja_vida`  (
  `id_hoja_vida` int NOT NULL AUTO_INCREMENT,
  `id_empleado` int NULL DEFAULT NULL,
  `primaria` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `secundaria` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `superior` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cursos` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `licencia` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `tipo` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ultimo_trabajo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `experiencia` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `contrato` int NULL DEFAULT 0,
  PRIMARY KEY (`id_hoja_vida`) USING BTREE,
  INDEX `id_empleado`(`id_empleado`) USING BTREE,
  CONSTRAINT `hoja_vida_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of hoja_vida
-- ----------------------------
INSERT INTO `hoja_vida` VALUES (1, 1, 'asa', 'asa', 'asas', 'asasa', 'Si', 'assa', 'maddonal', 'asa', 0);
INSERT INTO `hoja_vida` VALUES (2, 2, 'Primaria aaa', 'Secundaria b', 'Superior c', 'Cursos d', 'Si', 'A', 'Ultimo DESDE', 'Experiencia EEEE', 0);
INSERT INTO `hoja_vida` VALUES (9, 2, 'Primaria a', 'Secundaria', 'Superior', 'Cursos ', 'No', 'abc', 'Ultimo ', 'Experiencia', 0);
INSERT INTO `hoja_vida` VALUES (10, 3, 'Primaria', 'Secundaria', 'Superior', 'noooo', 'No', 'no', 'no se hacer nada', 'Experiencia ', 0);
INSERT INTO `hoja_vida` VALUES (11, 4, 'ESCUELA ELOY ALFARO', 'COLEGIO TECNICO NARANJAL', 'NO TIENE', 'NO', 'No', '', 'BANANERA', 'CAMPO', 0);

-- ----------------------------
-- Table structure for insumos
-- ----------------------------
DROP TABLE IF EXISTS `insumos`;
CREATE TABLE `insumos`  (
  `id_insumo` int NOT NULL AUTO_INCREMENT,
  `codigo_i` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `nombre_i` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `marca_i` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `id_tipo_insumo` int NULL DEFAULT NULL,
  `id_medida` int NULL DEFAULT NULL,
  `cantidad` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `precio_c` decimal(10, 2) NULL DEFAULT NULL,
  `observacion_i` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `descrpcion_i` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` enum('ACTIVO','AGOTADO','NO STOCK') CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `eliminado` int NULL DEFAULT 1,
  `stock_m` int NULL DEFAULT 0,
  PRIMARY KEY (`id_insumo`) USING BTREE,
  INDEX `id_tipo_insumo`(`id_tipo_insumo`) USING BTREE,
  INDEX `id_medida`(`id_medida`) USING BTREE,
  CONSTRAINT `insumos_ibfk_1` FOREIGN KEY (`id_tipo_insumo`) REFERENCES `tipo_insumo` (`id_tipo_insumo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `insumos_ibfk_2` FOREIGN KEY (`id_medida`) REFERENCES `medida` (`id_medida`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of insumos
-- ----------------------------
INSERT INTO `insumos` VALUES (1, '1234', 'asa', 'asas', 1, 2, '123', 12.00, 'as', 'asa', 'img/insumo/IMG272202212312.JPG', 'ACTIVO', 1, 21);
INSERT INTO `insumos` VALUES (2, '123456', 'Nombre edit', 'Marca edit', 1, 1, '12', 90.00, 'Observacion edit', 'Descripcion edit', 'img/insumo/IMG272202212246.png', 'ACTIVO', 1, 94);
INSERT INTO `insumos` VALUES (3, '01', 'Fungicidas', 'BANAMAT', 1, 1, '20', 23.00, '..', 'Son plaguicidas utilizados en protección de cultivos', 'img/insumo/insumo.jpg', 'ACTIVO', 1, 15);
INSERT INTO `insumos` VALUES (4, '02', 'UREA', 'BANAMAT', 1, 1, '30', 25.00, 'Abono', 'Es el fertilizante nitrogenado más popular y de mayor uso en el mundo entero', 'img/insumo/insumo.jpg', 'ACTIVO', 1, 1);

-- ----------------------------
-- Table structure for lote
-- ----------------------------
DROP TABLE IF EXISTS `lote`;
CREATE TABLE `lote`  (
  `id_lote` int NOT NULL AUTO_INCREMENT,
  `nombre_l` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `logintud` char(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `latitud` char(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `hectarea` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_lote`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of lote
-- ----------------------------
INSERT INTO `lote` VALUES (6, 'NUEVA H', 'MILAGRO', '-2.675577', '-79.616512', 1, '2');
INSERT INTO `lote` VALUES (7, 'NUELO LOTE H', 'NARANJAL', '-2.675577', '-79.616512', 1, '4');
INSERT INTO `lote` VALUES (8, 'aaaaaaaaaaa', 'EN MI CASA', '-2.675577', '-79.616512', 1, '2');

-- ----------------------------
-- Table structure for material
-- ----------------------------
DROP TABLE IF EXISTS `material`;
CREATE TABLE `material`  (
  `id_material` int NOT NULL AUTO_INCREMENT,
  `codigo` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `marca` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `id_tipo` int NULL DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `precio` decimal(10, 2) NULL DEFAULT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` enum('ACTIVO','AGOTADO','NO STOCK') CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `eliminado` int NULL DEFAULT 1,
  `stock_m` int NULL DEFAULT 0,
  PRIMARY KEY (`id_material`) USING BTREE,
  INDEX `id_tipo`(`id_tipo`) USING BTREE,
  CONSTRAINT `material_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_material` (`id_tipo_material`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of material
-- ----------------------------
INSERT INTO `material` VALUES (1, '123450', 'pala', 'placa', 1, 'bancco', 123.12, 'asa', 'asa', 'img/material/IMG272202291327.png', 'ACTIVO', 1, 9);
INSERT INTO `material` VALUES (2, '123', 'asa', 'asas', 2, 'asas', 121.00, 'asa', 'asa', 'img/material/IMG27220229149.png', 'ACTIVO', 1, 96);
INSERT INTO `material` VALUES (3, '1234567', 'Nombre edit', 'Marca  edit', 2, 'Color edit', 1100.00, 'Observacion edit', 'Descripcion edit', 'img/material/IMG272202291246.png', 'ACTIVO', 1, 124);

-- ----------------------------
-- Table structure for medida
-- ----------------------------
DROP TABLE IF EXISTS `medida`;
CREATE TABLE `medida`  (
  `id_medida` int NOT NULL AUTO_INCREMENT,
  `nombre_m` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `simbolo_m` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado_m` int NULL DEFAULT 1,
  PRIMARY KEY (`id_medida`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of medida
-- ----------------------------
INSERT INTO `medida` VALUES (1, 'litros e', 'LT e', 1);
INSERT INTO `medida` VALUES (2, 'Kilogramos', 'kg', 1);

-- ----------------------------
-- Table structure for multas
-- ----------------------------
DROP TABLE IF EXISTS `multas`;
CREATE TABLE `multas`  (
  `id_multa` int NOT NULL AUTO_INCREMENT,
  `id_empleado` int NULL DEFAULT NULL,
  `fecha_infraccion` datetime(0) NULL DEFAULT NULL,
  `fecha_registro` date NULL DEFAULT NULL,
  `id_tipo_sancion` int NULL DEFAULT NULL,
  `motivo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `multa` decimal(10, 2) NULL DEFAULT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `estado_pago` int NULL DEFAULT 0,
  `eliminar` int NULL DEFAULT 1,
  `fecha_paga_multa` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_multa`) USING BTREE,
  INDEX `id_tipo_sancion`(`id_tipo_sancion`) USING BTREE,
  INDEX `id_empleado`(`id_empleado`) USING BTREE,
  CONSTRAINT `multas_ibfk_1` FOREIGN KEY (`id_tipo_sancion`) REFERENCES `tipo_sancion` (`id_tipo_sancion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `multas_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of multas
-- ----------------------------
INSERT INTO `multas` VALUES (1, 1, '2022-02-28 19:59:00', '2022-02-28', 2, 'salio tarde', 12.00, 'ass', 1, 1, '2022-03-14 11:43:32');
INSERT INTO `multas` VALUES (3, 1, '2022-03-02 09:08:00', '2022-03-01', 1, 'Motivo del empleado', 50.00, 'Observacion', 1, 1, '2022-03-14 11:43:31');
INSERT INTO `multas` VALUES (4, 1, '2022-03-13 13:28:00', '2022-03-13', 3, 'sas', 12.00, 'asasa', 1, 1, '2022-03-14 11:43:32');
INSERT INTO `multas` VALUES (5, 1, '2022-03-14 11:44:00', '2022-03-14', 3, 'aaaaaaa', 20.00, 'bbbbbbbbbbbbb', 1, 1, '2022-03-21 11:32:49');
INSERT INTO `multas` VALUES (6, 1, '2022-04-26 13:38:00', '2022-04-26', 2, 'PELEA ', 20.00, 'FALTA DE REPETO EN EL TRABAJO', 0, 1, NULL);

-- ----------------------------
-- Table structure for novedad
-- ----------------------------
DROP TABLE IF EXISTS `novedad`;
CREATE TABLE `novedad`  (
  `id_novedad` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `descipcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_novedad`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of novedad
-- ----------------------------
INSERT INTO `novedad` VALUES (1, 'retrasos editado', 'daños en las maquinas por fallos editadoaa12', 1);

-- ----------------------------
-- Table structure for novedad_produccion
-- ----------------------------
DROP TABLE IF EXISTS `novedad_produccion`;
CREATE TABLE `novedad_produccion`  (
  `id_novedad_produccion` int NOT NULL AUTO_INCREMENT,
  `id_produccion` int NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `id_novedad` int NULL DEFAULT NULL,
  `costo` decimal(10, 2) NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `detalle` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  PRIMARY KEY (`id_novedad_produccion`) USING BTREE,
  INDEX `id_produccion`(`id_produccion`) USING BTREE,
  INDEX `id_novedad`(`id_novedad`) USING BTREE,
  CONSTRAINT `novedad_produccion_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `novedad_produccion_ibfk_2` FOREIGN KEY (`id_novedad`) REFERENCES `novedad` (`id_novedad`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of novedad_produccion
-- ----------------------------
INSERT INTO `novedad_produccion` VALUES (6, 43, '2022-04-29', 1, 12.00, 1, '11111111');

-- ----------------------------
-- Table structure for permisos
-- ----------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos`  (
  `permiso_id` int NOT NULL AUTO_INCREMENT,
  `rol_id` int NULL DEFAULT NULL,
  `configuracion` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `respaldos` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `empleados` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `multas` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `asistecias` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `permisos` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `rol_pagos` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `bodega` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `compras` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `produccion` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `ventas` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `control_plagas` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `reportes` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`permiso_id`) USING BTREE,
  INDEX `rol_id`(`rol_id`) USING BTREE,
  CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of permisos
-- ----------------------------
INSERT INTO `permisos` VALUES (7, 1, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true');
INSERT INTO `permisos` VALUES (8, 2, 'true', 'false', 'true', 'false', 'false', 'true', 'false', 'false', 'true', 'false', 'false', 'true', 'true');
INSERT INTO `permisos` VALUES (10, 3, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true');
INSERT INTO `permisos` VALUES (11, 9, 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true', 'true');
INSERT INTO `permisos` VALUES (12, 10, 'true', 'false', 'true', 'false', 'false', 'true', 'false', 'false', 'true', 'false', 'false', 'true', 'true');

-- ----------------------------
-- Table structure for permisos_empleado
-- ----------------------------
DROP TABLE IF EXISTS `permisos_empleado`;
CREATE TABLE `permisos_empleado`  (
  `id_permisos` int NOT NULL AUTO_INCREMENT,
  `id_empleado` int NULL DEFAULT NULL,
  `fecha_inicio` date NULL DEFAULT NULL,
  `fecha_fin` date NULL DEFAULT NULL,
  `id_tipo_permiso` int NULL DEFAULT NULL,
  `obsservacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `fecha_registro` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_permisos`) USING BTREE,
  INDEX `id_empleado`(`id_empleado`) USING BTREE,
  INDEX `id_tipo_permiso`(`id_tipo_permiso`) USING BTREE,
  CONSTRAINT `permisos_empleado_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permisos_empleado_ibfk_2` FOREIGN KEY (`id_tipo_permiso`) REFERENCES `tipo_permiso` (`id_tipo_permiso`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of permisos_empleado
-- ----------------------------
INSERT INTO `permisos_empleado` VALUES (3, 1, '2022-02-28', '2022-03-01', 2, 'Observacion', '2022-03-01');
INSERT INTO `permisos_empleado` VALUES (4, 2, '2022-03-01', '2022-03-01', 1, 'Observacion', '2022-03-01');
INSERT INTO `permisos_empleado` VALUES (5, 2, '2022-03-13', '2022-03-15', 2, 'AAAAAAAAAAAAA', '2022-03-01');

-- ----------------------------
-- Table structure for produccion
-- ----------------------------
DROP TABLE IF EXISTS `produccion`;
CREATE TABLE `produccion`  (
  `id_produccion` int NOT NULL AUTO_INCREMENT,
  `id_lote` int NULL DEFAULT NULL,
  `fecha_inicio` date NULL DEFAULT NULL,
  `fecha_fin` date NULL DEFAULT NULL,
  `dias` int NULL DEFAULT NULL,
  `estado` enum('INICIADO','FINALIZADO','CANCELADO') CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `eliminar` int NULL DEFAULT 1,
  `nombre_prod` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `id_hectarea` int NULL DEFAULT NULL,
  `hectarea` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `porcentaje` int NULL DEFAULT 0,
  PRIMARY KEY (`id_produccion`) USING BTREE,
  INDEX `id_lote`(`id_lote`) USING BTREE,
  CONSTRAINT `produccion_ibfk_1` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id_lote`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of produccion
-- ----------------------------
INSERT INTO `produccion` VALUES (38, 6, '2022-04-28', '2022-05-08', 11, 'CANCELADO', 1, 'nuevo', 5, 'H1', 0);
INSERT INTO `produccion` VALUES (39, 6, '2022-04-28', '2022-06-09', 43, 'CANCELADO', 1, 'ESTE EN NUEVO', 6, 'H2', 0);
INSERT INTO `produccion` VALUES (40, 6, '2022-04-28', '2022-05-01', 4, 'CANCELADO', 1, 'PRODUCCION ABC', 5, 'H1', 0);
INSERT INTO `produccion` VALUES (41, 6, '2022-04-28', '2022-07-22', 86, 'FINALIZADO', 1, 'ABRIL', 5, 'H1', 100);
INSERT INTO `produccion` VALUES (42, 6, '2022-04-28', '2022-08-24', 119, 'FINALIZADO', 1, 'MAYO', 5, 'H1', 100);
INSERT INTO `produccion` VALUES (43, 6, '2022-04-28', '2022-09-08', 134, 'FINALIZADO', 1, 'ENERO', 5, 'H1', 100);
INSERT INTO `produccion` VALUES (44, 6, '2022-04-28', '2022-05-05', 8, 'FINALIZADO', 1, 'nueva podruccion', 5, 'H1', 0);
INSERT INTO `produccion` VALUES (45, 6, '2022-05-01', '2022-08-19', 111, 'FINALIZADO', 1, 'aaaaaaaaaaaaaaa', 6, 'H2', 0);
INSERT INTO `produccion` VALUES (46, 6, '2022-05-01', '2022-06-01', 32, 'INICIADO', 1, 'NUEVO BANANO', 5, 'H1', 0);

-- ----------------------------
-- Table structure for proveedor
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor`  (
  `id_proveedor` int NOT NULL AUTO_INCREMENT,
  `razon` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `rucs` char(13) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `telefono_p` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `correo_p` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `direccions` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `descripcions` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `encargados` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `sexo` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_proveedor`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of proveedor
-- ----------------------------
INSERT INTO `proveedor` VALUES (1, 'wqw12 edit', '1111', '12222111', 'edit@hotmail.com', 'casita edit', 'ventas edit', 'jorg edit', 'Masculino', 1);
INSERT INTO `proveedor` VALUES (2, 'Razon ', '0940321854', '0940321854', 'Correo@hotmail.com', 'Direccion', 'Descripcion', 'Jorge Moises Ramirez Zavala', 'Masculino', 1);

-- ----------------------------
-- Table structure for rasimos_produccion
-- ----------------------------
DROP TABLE IF EXISTS `rasimos_produccion`;
CREATE TABLE `rasimos_produccion`  (
  `id_detalle_produccion_racimos` int NOT NULL AUTO_INCREMENT,
  `id_produccion` int NULL DEFAULT NULL,
  `fecha_ra` date NULL DEFAULT NULL,
  `cantidad` int NULL DEFAULT NULL,
  `tipo` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `bandera` enum('INGRESADO','AGOTADO') CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cajas` int NULL DEFAULT NULL,
  `peso` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle_produccion_racimos`) USING BTREE,
  INDEX `id_produccion`(`id_produccion`) USING BTREE,
  CONSTRAINT `rasimos_produccion_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of rasimos_produccion
-- ----------------------------
INSERT INTO `rasimos_produccion` VALUES (12, 43, '2022-04-29', 123, 'Racimos', 1, 'INGRESADO', 50, '23');

-- ----------------------------
-- Table structure for rechasos_produccion
-- ----------------------------
DROP TABLE IF EXISTS `rechasos_produccion`;
CREATE TABLE `rechasos_produccion`  (
  `id_detalle_produccion_rechasos` int NOT NULL AUTO_INCREMENT,
  `id_produccion` int NULL DEFAULT NULL,
  `fecha_re` date NULL DEFAULT NULL,
  `cantidad_re` int NULL DEFAULT NULL,
  `tipo_re` char(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado_re` int NULL DEFAULT 1,
  `bandera_re` enum('INGRESADO','AGOTADO') CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_detalle_produccion_rechasos`) USING BTREE,
  INDEX `id_produccion`(`id_produccion`) USING BTREE,
  CONSTRAINT `rechasos_produccion_ibfk_1` FOREIGN KEY (`id_produccion`) REFERENCES `produccion` (`id_produccion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of rechasos_produccion
-- ----------------------------

-- ----------------------------
-- Table structure for respaldo
-- ----------------------------
DROP TABLE IF EXISTS `respaldo`;
CREATE TABLE `respaldo`  (
  `id_respaldo` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NULL DEFAULT NULL,
  `fecha_hora` datetime(0) NULL DEFAULT NULL,
  `ruta` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_respaldo`) USING BTREE,
  INDEX `id_usuario`(`id_usuario`) USING BTREE,
  CONSTRAINT `respaldo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of respaldo
-- ----------------------------
INSERT INTO `respaldo` VALUES (41, 1, '2022-03-08 20:13:00', 'img/backup/20220308201300_proyecto_ochoa.zip', 1);
INSERT INTO `respaldo` VALUES (42, 1, '2022-03-09 08:47:33', 'img/backup/20220309084733_proyecto_ochoa.zip', 1);
INSERT INTO `respaldo` VALUES (43, 1, '2022-04-18 18:27:30', 'img/backup/20220418182730_proyecto_ochoa.zip', 1);
INSERT INTO `respaldo` VALUES (44, 1, '2022-04-19 13:18:46', 'img/backup/20220419131846_proyecto_ochoa.zip', 1);

-- ----------------------------
-- Table structure for rol
-- ----------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol`  (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_rol`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of rol
-- ----------------------------
INSERT INTO `rol` VALUES (1, 'administra ', 0);
INSERT INTO `rol` VALUES (2, 'nuevo', 1);
INSERT INTO `rol` VALUES (3, 'bbbb', 1);
INSERT INTO `rol` VALUES (9, 'nuevo roll', 1);
INSERT INTO `rol` VALUES (10, 'rolles', 1);

-- ----------------------------
-- Table structure for rol_pagos
-- ----------------------------
DROP TABLE IF EXISTS `rol_pagos`;
CREATE TABLE `rol_pagos`  (
  `id_rol_pagos` int NOT NULL AUTO_INCREMENT,
  `id_empleado` int NULL DEFAULT NULL,
  `actividad` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `produccion_datos` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `fecha_pago` datetime(0) NULL DEFAULT NULL,
  `pagos_actividad` decimal(10, 2) NULL DEFAULT NULL,
  `dias` int NULL DEFAULT NULL,
  `total_ingreso` decimal(10, 2) NULL DEFAULT NULL,
  `total_egreso` decimal(10, 2) NULL DEFAULT NULL,
  `neto_pagar` decimal(10, 2) NULL DEFAULT NULL,
  `count_ingreso` int NULL DEFAULT NULL,
  `count_egreso` int NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_rol_pagos`) USING BTREE,
  INDEX `id_empleado`(`id_empleado`) USING BTREE,
  CONSTRAINT `rol_pagos_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of rol_pagos
-- ----------------------------
INSERT INTO `rol_pagos` VALUES (10, 3, 'sembradoo', 'Lote: [ LOTE edit  ] - Fecha inicioa: [ 2022-03-01 ] - Fecha fin: [ 2022-03-31 ] - Cod: [ 27 ]', '2022-03-14 11:30:00', 100.00, 31, 3472.00, 664.95, 2807.05, 2, 2, 1);
INSERT INTO `rol_pagos` VALUES (11, 1, 'arado', 'Lote: [ LOTE edit  ] - Fecha inicioa: [ 2022-03-01 ] - Fecha fin: [ 2022-03-31 ] - Cod: [ 27 ]', '2022-03-14 11:43:00', 123.12, 31, 4809.07, 1083.53, 3725.54, 3, 4, 1);
INSERT INTO `rol_pagos` VALUES (12, 1, 'arado', 'Lote: [ LOTE edit  ] - Fecha inicio: [ 2022-03-01 ] - Fecha fin: [ 2022-03-31 ] - Cod: [ 24 ]', '2022-03-21 11:32:00', 123.12, 31, 3816.72, 20.00, 3796.72, 1, 1, 1);
INSERT INTO `rol_pagos` VALUES (13, 3, 'sembradoo', 'Lote: [ LOTE edit  ] - Fecha inicio: [ 2022-03-08 ] - Fecha fin: [ 2022-03-25 ] - Cod: [ 25 ]', '2022-04-13 11:06:00', 100.00, 18, 1800.00, 0.00, 1800.00, 1, 1, 1);
INSERT INTO `rol_pagos` VALUES (14, 2, 'arado', 'Lote: [ LOTE edit  ] - Fecha inicio: [ 2022-03-09 ] - Fecha fin: [ 2022-03-24 ] - Cod: [ 28 ]', '2022-04-14 12:36:00', 20.00, 16, 320.00, 0.00, 320.00, 1, 1, 1);
INSERT INTO `rol_pagos` VALUES (15, 3, 'sembradoo', 'Lote: [ LOTE edit  ] - Fecha inicio: [ 2022-03-08 ] - Fecha fin: [ 2022-03-24 ] - Cod: [ 26 ]', '2022-04-19 13:27:00', 100.00, 17, 1700.00, 0.00, 1700.00, 1, 1, 1);
INSERT INTO `rol_pagos` VALUES (16, 3, 'sembradoo', 'Lote: [ LOTE edit  ] - Fecha inicio: [ 2022-04-03 ] - Fecha fin: [ 2022-04-17 ] - Cod: [ 29 ]', '2022-04-19 13:30:00', 100.00, 15, 1500.00, 0.00, 1500.00, 1, 1, 1);
INSERT INTO `rol_pagos` VALUES (17, 2, 'Apuntalamiento', 'Lote: [ LOTE B  ] - Fecha inicio: [ 2022-04-25 ] - Fecha fin: [ 2022-10-06 ] - Cod: [ 32 ]', '2022-04-25 18:12:00', 20.00, 165, 30.00, 0.00, 30.00, 1, 1, 1);
INSERT INTO `rol_pagos` VALUES (18, 4, 'Deshoja', 'Lote: [ LOTE B  ] - Fecha inicio: [ 2022-04-26 ] - Fecha fin: [ 2022-09-26 ] - Cod: [ 34 ]', '2022-04-26 11:30:00', 20.00, 154, 30.00, 0.00, 30.00, 1, 1, 1);
INSERT INTO `rol_pagos` VALUES (19, 4, 'Deshoja', 'Lote: [ LOTE edit  ] - Fecha inicio: [ 2022-04-26 ] - Fecha fin: [ 2022-09-26 ] - Cod: [ 36 ]', '2022-04-26 13:34:00', 20.00, 154, 80.00, 0.00, 80.00, 1, 1, 1);
INSERT INTO `rol_pagos` VALUES (20, 2, 'Apuntalamiento', 'Lote: [ NUEVA H  ] - Fecha inicio: [ 2022-05-01 ] - Fecha fin: [ 2022-08-19 ] - Cod: [ 45 ]', '2022-05-01 11:29:00', 20.00, 111, 17.50, 0.00, 17.50, 1, 1, 1);

-- ----------------------------
-- Table structure for tipo_actividad
-- ----------------------------
DROP TABLE IF EXISTS `tipo_actividad`;
CREATE TABLE `tipo_actividad`  (
  `id_tipo_actividad` int NOT NULL AUTO_INCREMENT,
  `tipo_actividad` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_actividad`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_actividad
-- ----------------------------
INSERT INTO `tipo_actividad` VALUES (1, 'Siembra ', 'Sembrar en terreno preparado.', 1);
INSERT INTO `tipo_actividad` VALUES (2, 'Apuntalamiento', 'evitar que las\nplantas de banano sufran caídas durante el desarrollo y el llenado de racimo que comprende desde\nla parición hasta la cosecha', 1);
INSERT INTO `tipo_actividad` VALUES (3, ' Deshija ', 'a se basa en la selección de un hijo lateral promisorio (los hijos primarios) que va a generar la proxima generación y la eliminación de los otros hijos conocidos como hijos de agua\n(plantas improductivas)', 1);
INSERT INTO `tipo_actividad` VALUES (4, 'Deshoja', ' consiste en realizar la limpieza y eliminación de las hojas secas, con daños\nmecanicos o con presencia de enfermedades que funcionen como inoculo de algun patogeno', 1);
INSERT INTO `tipo_actividad` VALUES (5, 'Fertilización ', 'La fertilización se puede realizar de forma granular, orgánica y foliar dependiendo de las\nnecesidades del cultivo en relación con los análisis foliares y de suelo.', 1);
INSERT INTO `tipo_actividad` VALUES (6, 'Drenajes', 'es la eliminación natural o asistida del exceso de agua que podría reducir el desarrollo de las plantas de banano.', 1);

-- ----------------------------
-- Table structure for tipo_cinta
-- ----------------------------
DROP TABLE IF EXISTS `tipo_cinta`;
CREATE TABLE `tipo_cinta`  (
  `id_tipo_cinta` int NOT NULL AUTO_INCREMENT,
  `semana` char(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `color` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_cinta`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipo_cinta
-- ----------------------------
INSERT INTO `tipo_cinta` VALUES (1, 'Semana 1', '#ffffff', 1);
INSERT INTO `tipo_cinta` VALUES (2, 'Semana 2', '#000000', 1);
INSERT INTO `tipo_cinta` VALUES (3, 'Semana 3', '#3511e8', 1);
INSERT INTO `tipo_cinta` VALUES (4, 'Semana 4', '#da10d3', 1);
INSERT INTO `tipo_cinta` VALUES (5, 'Semana 5', '#06d0f9', 1);
INSERT INTO `tipo_cinta` VALUES (6, 'Semana 6', '#14ff3b', 1);
INSERT INTO `tipo_cinta` VALUES (7, 'Semana 7', '#9dff0a', 1);
INSERT INTO `tipo_cinta` VALUES (8, 'Semana 8', '#ffa305', 1);
INSERT INTO `tipo_cinta` VALUES (9, 'Semana 9', '#e58f8f', 1);
INSERT INTO `tipo_cinta` VALUES (10, 'Semana 10', '#ff0000', 1);

-- ----------------------------
-- Table structure for tipo_insumo
-- ----------------------------
DROP TABLE IF EXISTS `tipo_insumo`;
CREATE TABLE `tipo_insumo`  (
  `id_tipo_insumo` int NOT NULL AUTO_INCREMENT,
  `tipo_insumo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado_tipo_i` int NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_insumo`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_insumo
-- ----------------------------
INSERT INTO `tipo_insumo` VALUES (1, 'FERTILIZANTES', 1);
INSERT INTO `tipo_insumo` VALUES (2, 'nuevo insumos', 1);

-- ----------------------------
-- Table structure for tipo_material
-- ----------------------------
DROP TABLE IF EXISTS `tipo_material`;
CREATE TABLE `tipo_material`  (
  `id_tipo_material` int NOT NULL AUTO_INCREMENT,
  `tipo_material` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado_tipo_m` int NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_material`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_material
-- ----------------------------
INSERT INTO `tipo_material` VALUES (1, 'LABORES EN EL CAMPO', 1);
INSERT INTO `tipo_material` VALUES (2, 'LABORES EN LA EMPACADORA', 1);
INSERT INTO `tipo_material` VALUES (3, 'nuevo tipo material', 1);

-- ----------------------------
-- Table structure for tipo_permiso
-- ----------------------------
DROP TABLE IF EXISTS `tipo_permiso`;
CREATE TABLE `tipo_permiso`  (
  `id_tipo_permiso` int NOT NULL AUTO_INCREMENT,
  `tipo_permiso` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_permiso`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_permiso
-- ----------------------------
INSERT INTO `tipo_permiso` VALUES (1, 'medico edit', 1);
INSERT INTO `tipo_permiso` VALUES (2, 'Calamidad', 1);
INSERT INTO `tipo_permiso` VALUES (3, 'dormir', 1);

-- ----------------------------
-- Table structure for tipo_plaga
-- ----------------------------
DROP TABLE IF EXISTS `tipo_plaga`;
CREATE TABLE `tipo_plaga`  (
  `id_tipo_plaga` int NOT NULL AUTO_INCREMENT,
  `tipo_plaga` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `foto` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_plaga`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_plaga
-- ----------------------------
INSERT INTO `tipo_plaga` VALUES (1, 'SIGATOKA', ' Es una destructiva enfermedad que ataca las hojas', 'img/plaga/plaga.jpg', 1);
INSERT INTO `tipo_plaga` VALUES (2, 'Cochinilla', 'Es una plaga que daña el fruto', 'img/plaga/plaga.jpg', 1);
INSERT INTO `tipo_plaga` VALUES (3, 'Otras', 'otras', 'img/plaga/plaga.jpg', 0);

-- ----------------------------
-- Table structure for tipo_quimico
-- ----------------------------
DROP TABLE IF EXISTS `tipo_quimico`;
CREATE TABLE `tipo_quimico`  (
  `id_tipo_quimico` int NOT NULL AUTO_INCREMENT,
  `tipo_quimico` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `estado_q` int NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_quimico`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_quimico
-- ----------------------------
INSERT INTO `tipo_quimico` VALUES (1, 'edit 1', 'eitdo 2', 1);
INSERT INTO `tipo_quimico` VALUES (2, 'bbb', 'bbb', 1);

-- ----------------------------
-- Table structure for tipo_sancion
-- ----------------------------
DROP TABLE IF EXISTS `tipo_sancion`;
CREATE TABLE `tipo_sancion`  (
  `id_tipo_sancion` int NOT NULL AUTO_INCREMENT,
  `tipo_sancion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_sancion`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_sancion
-- ----------------------------
INSERT INTO `tipo_sancion` VALUES (1, 'LEVE', 1);
INSERT INTO `tipo_sancion` VALUES (2, 'GRAVE', 1);
INSERT INTO `tipo_sancion` VALUES (3, 'MUY GRAVE', 1);

-- ----------------------------
-- Table structure for tipo_tratamiento
-- ----------------------------
DROP TABLE IF EXISTS `tipo_tratamiento`;
CREATE TABLE `tipo_tratamiento`  (
  `id_tipo_tratamiento` int NOT NULL AUTO_INCREMENT,
  `tipo_tratamiento` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `descripion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_tratamiento`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_tratamiento
-- ----------------------------
INSERT INTO `tipo_tratamiento` VALUES (1, 'labado', 'centrifugado de aguo', 1);

-- ----------------------------
-- Table structure for tratamiento_plagas
-- ----------------------------
DROP TABLE IF EXISTS `tratamiento_plagas`;
CREATE TABLE `tratamiento_plagas`  (
  `id_traamiento` int NOT NULL AUTO_INCREMENT,
  `id_plaga` int NULL DEFAULT NULL,
  `id_tipo_tratamiento` int NULL DEFAULT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL,
  `id_tipo_quimico` int NULL DEFAULT NULL,
  `fecha_ini` date NULL DEFAULT NULL,
  `fecha_fin` date NULL DEFAULT NULL,
  `dias_` int NULL DEFAULT NULL,
  `cantidad_litro` char(75) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado_trat` int NULL DEFAULT 1,
  `avance` int NULL DEFAULT 0,
  PRIMARY KEY (`id_traamiento`) USING BTREE,
  INDEX `id_plaga`(`id_plaga`) USING BTREE,
  INDEX `id_tipo_tratamiento`(`id_tipo_tratamiento`) USING BTREE,
  INDEX `id_tipo_quimico`(`id_tipo_quimico`) USING BTREE,
  CONSTRAINT `tratamiento_plagas_ibfk_1` FOREIGN KEY (`id_plaga`) REFERENCES `control_plagas` (`id_control_plagas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tratamiento_plagas_ibfk_2` FOREIGN KEY (`id_tipo_tratamiento`) REFERENCES `tipo_tratamiento` (`id_tipo_tratamiento`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tratamiento_plagas_ibfk_3` FOREIGN KEY (`id_tipo_quimico`) REFERENCES `tipo_quimico` (`id_tipo_quimico`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tratamiento_plagas
-- ----------------------------
INSERT INTO `tratamiento_plagas` VALUES (4, 10, 1, 'alala', 1, '2022-04-28', '2022-05-01', 4, '10', 0, 100);
INSERT INTO `tratamiento_plagas` VALUES (5, 11, 1, 'matar plaga ', 2, '2022-05-01', '2022-05-18', 18, '120', 1, 70);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `apellidos` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `usuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `pass` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `foto` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  `fecha` date NULL DEFAULT NULL,
  `id_rol` int NULL DEFAULT NULL,
  `numero_documento` char(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  INDEX `id_rol`(`id_rol`) USING BTREE,
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'Milton', 'Ochoa', 'admin', '123', 'img/usuarios/IMG252202221179.jpg', 1, '2022-02-25', 3, '0940321854');
INSERT INTO `usuario` VALUES (2, 'as', 'asas', 'asa', 'asas', 'img/usuarios/user.jpg', 1, '2022-02-25', 1, '123');
INSERT INTO `usuario` VALUES (3, 'jorge moises', 'ramirez zavla', 'yo mismo', '12345', 'img/usuarios/IMG252202220144.JPG', 1, '2022-02-25', 2, '0940321854');

-- ----------------------------
-- Table structure for venta_desechos
-- ----------------------------
DROP TABLE IF EXISTS `venta_desechos`;
CREATE TABLE `venta_desechos`  (
  `id_venta_desechos` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NULL DEFAULT NULL,
  `num_venta` char(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `tipo_comprobante` char(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `impuesto` decimal(10, 2) NULL DEFAULT NULL,
  `fecha_venta` date NULL DEFAULT NULL,
  `sub_total` decimal(10, 2) NULL DEFAULT NULL,
  `sub_iva` decimal(10, 2) NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `countt` int NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_venta_desechos`) USING BTREE,
  INDEX `id_cliente`(`id_cliente`) USING BTREE,
  CONSTRAINT `venta_desechos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of venta_desechos
-- ----------------------------
INSERT INTO `venta_desechos` VALUES (9, 1, '1222', 'Factura', 0.12, '2022-03-10', 144.00, 17.28, 161.28, 1, 1);
INSERT INTO `venta_desechos` VALUES (10, 2, '20220418190459', 'Factura', 0.12, '2022-04-18', 12.00, 1.44, 13.44, 1, 1);
INSERT INTO `venta_desechos` VALUES (11, 1, '20220418190421', 'Boleta', 0.00, '2022-04-18', 2.00, 0.00, 0.00, 1, 1);

-- ----------------------------
-- Table structure for venta_racimos
-- ----------------------------
DROP TABLE IF EXISTS `venta_racimos`;
CREATE TABLE `venta_racimos`  (
  `id_venta_racimos` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NULL DEFAULT NULL,
  `num_venta` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `tipo_comprobante` char(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `impuesto` decimal(10, 2) NULL DEFAULT NULL,
  `fecha_venta` date NULL DEFAULT NULL,
  `sub_total` decimal(10, 2) NULL DEFAULT NULL,
  `sub_iva` decimal(10, 2) NULL DEFAULT NULL,
  `total` decimal(10, 2) NULL DEFAULT NULL,
  `countt` int NULL DEFAULT NULL,
  `estado` int NULL DEFAULT 1,
  PRIMARY KEY (`id_venta_racimos`) USING BTREE,
  INDEX `id_cliente`(`id_cliente`) USING BTREE,
  CONSTRAINT `venta_racimos_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of venta_racimos
-- ----------------------------
INSERT INTO `venta_racimos` VALUES (8, 1, '123', 'Factura', 0.12, '2022-03-10', 144.00, 17.28, 161.28, 1, 1);
INSERT INTO `venta_racimos` VALUES (9, 1, '20220418180434', 'Boleta', 0.00, '2022-04-18', 10.00, 0.00, 0.00, 1, 1);
INSERT INTO `venta_racimos` VALUES (10, 1, '20220418180423', 'Boleta', 0.00, '2022-04-18', 12.00, 0.00, 0.00, 1, 1);
INSERT INTO `venta_racimos` VALUES (11, 1, '20220418180442', 'Factura', 0.12, '2022-04-18', 12.00, 1.44, 13.44, 1, 1);
INSERT INTO `venta_racimos` VALUES (12, 1, '20220418190457', 'Factura', 0.12, '2022-04-18', 12.00, 1.44, 13.44, 1, 1);
INSERT INTO `venta_racimos` VALUES (13, 2, '20220418190405', 'Boleta', 0.00, '2022-04-18', 110.00, 0.00, 0.00, 1, 1);
INSERT INTO `venta_racimos` VALUES (14, 1, '20220424200407', 'Factura', 0.12, '2022-04-24', 11000.00, 1320.00, 12320.00, 3, 1);
INSERT INTO `venta_racimos` VALUES (15, 1, '20220424200445', 'Factura', 0.12, '2022-04-24', 123.00, 14.76, 137.76, 1, 1);
INSERT INTO `venta_racimos` VALUES (16, 1, '20220424200442', 'Factura', 0.12, '2022-04-24', 123.00, 14.76, 137.76, 1, 1);
INSERT INTO `venta_racimos` VALUES (17, 2, '20220426110417', 'Factura', 0.12, '2022-04-26', 375.00, 45.00, 420.00, 1, 1);

SET FOREIGN_KEY_CHECKS = 1;
