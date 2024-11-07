-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-09-2024 a las 06:45:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

--
-- Base de datos: `texelyc`
CREATE DATABASE `texelyc`;

USE `texelyc`;
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
    `ID_Admin` int(11) NOT NULL,
    `Admin_Nombre` varchar(255) NOT NULL,
    `Admin_Correo` varchar(255) NOT NULL,
    `Admin_Contraseña` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo_inventario`
--

CREATE TABLE `articulo_inventario` (
    `ID_Articulo` int(11) NOT NULL,
    `Articulo_Categ` text NOT NULL,
    `Articulo_Detalle` text NOT NULL,
    `Articulo_Cantidad` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
    `ID_Cliente` int(11) NOT NULL,
    `Cliente_Nombre` varchar(255) NOT NULL,
    `Cliente_Telefono` varchar(20) NOT NULL,
    `Cliente_Correo` varchar(255) NOT NULL,
    `ClientePassword` int(30) NOT NULL,
    `Cliente_Direccion` text NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
    `ID_Devolucion` int(11) NOT NULL,
    `ID_Factura` int(11) NOT NULL,
    `ID_Inventario` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas_inv`
--

CREATE TABLE `entradas_inv` (
    `ID_Entrada` int(11) NOT NULL,
    `ID_Tipo_entrada` int(11) NOT NULL,
    `ID_Articulo` int(11) NOT NULL,
    `Entrada_Cantidad` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
    `ID_Factura` int(11) NOT NULL,
    `Factura_Fecha` datetime NOT NULL,
    `ID_Pedido` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
    `ID_Pedido` int(11) NOT NULL,
    `ID_Cliente` int(11) NOT NULL,
    `ID_Articulo` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
    `ID_Proveedor` int(11) NOT NULL,
    `Proveedor_Nombre` varchar(255) NOT NULL,
    `Proveedor_Direccion` text NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas_inv`
--

CREATE TABLE `salidas_inv` (
    `ID_Salida` int(11) NOT NULL,
    `ID_Articulo` int(11) NOT NULL,
    `Salida_Cantidad` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_entradas`
--

CREATE TABLE `tipos_entradas` (
    `ID_Tipo_Entrada` int(11) NOT NULL,
    `ID_Proveedor` int(11) NOT NULL,
    `ID_Devolucion` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
ADD PRIMARY KEY (`ID_Admin`),
ADD UNIQUE KEY `Admin_Correo` (`Admin_Correo`);

--
-- Indices de la tabla `articulo_inventario`
--
ALTER TABLE `articulo_inventario` ADD PRIMARY KEY (`ID_Articulo`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
ADD PRIMARY KEY (`ID_Cliente`),
ADD UNIQUE KEY `Cliente_Correo` (`Cliente_Correo`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
ADD PRIMARY KEY (`ID_Devolucion`),
ADD KEY `ID_Factura` (`ID_Factura`),
ADD KEY `ID_Inventario` (`ID_Inventario`);

--
-- Indices de la tabla `entradas_inv`
--
ALTER TABLE `entradas_inv`
ADD PRIMARY KEY (`ID_Entrada`),
ADD KEY `ID_Tipo_entrada` (`ID_Tipo_entrada`),
ADD KEY `ID_Articulo` (`ID_Articulo`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
ADD PRIMARY KEY (`ID_Factura`),
ADD KEY `ID_Pedido` (`ID_Pedido`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
ADD PRIMARY KEY (`ID_Pedido`),
ADD KEY `ID_Cliente` (`ID_Cliente`),
ADD KEY `ID_Articulo` (`ID_Articulo`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor` ADD PRIMARY KEY (`ID_Proveedor`);

--
-- Indices de la tabla `salidas_inv`
--
ALTER TABLE `salidas_inv`
ADD PRIMARY KEY (`ID_Salida`),
ADD KEY `ID_Articulo` (`ID_Articulo`);

--
-- Indices de la tabla `tipos_entradas`
--
ALTER TABLE `tipos_entradas`
ADD PRIMARY KEY (`ID_Tipo_Entrada`),
ADD KEY `ID_Proveedor` (`ID_Proveedor`),
ADD KEY `ID_Devolucion` (`ID_Devolucion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
MODIFY `ID_Admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `articulo_inventario`
--
ALTER TABLE `articulo_inventario`
MODIFY `ID_Articulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
MODIFY `ID_Devolucion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entradas_inv`
--
ALTER TABLE `entradas_inv`
MODIFY `ID_Entrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
MODIFY `ID_Factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
MODIFY `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
MODIFY `ID_Proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salidas_inv`
--
ALTER TABLE `salidas_inv`
MODIFY `ID_Salida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_entradas`
--
ALTER TABLE `tipos_entradas`
MODIFY `ID_Tipo_Entrada` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
ADD CONSTRAINT `devoluciones_ibfk_1` FOREIGN KEY (`ID_Factura`) REFERENCES `factura` (`ID_Factura`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `devoluciones_ibfk_2` FOREIGN KEY (`ID_Inventario`) REFERENCES `articulo_inventario` (`ID_Articulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entradas_inv`
--
ALTER TABLE `entradas_inv`
ADD CONSTRAINT `entradas_inv_ibfk_1` FOREIGN KEY (`ID_Tipo_entrada`) REFERENCES `tipos_entradas` (`ID_Tipo_Entrada`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `entradas_inv_ibfk_2` FOREIGN KEY (`ID_Articulo`) REFERENCES `articulo_inventario` (`ID_Articulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido` (`ID_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`ID_Cliente`) REFERENCES `cliente` (`ID_Cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`ID_Articulo`) REFERENCES `articulo_inventario` (`ID_Articulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salidas_inv`
--
ALTER TABLE `salidas_inv`
ADD CONSTRAINT `salidas_inv_ibfk_1` FOREIGN KEY (`ID_Articulo`) REFERENCES `articulo_inventario` (`ID_Articulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipos_entradas`
--
ALTER TABLE `tipos_entradas`
ADD CONSTRAINT `tipos_entradas_ibfk_1` FOREIGN KEY (`ID_Proveedor`) REFERENCES `proveedor` (`ID_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `tipos_entradas_ibfk_2` FOREIGN KEY (`ID_Devolucion`) REFERENCES `devoluciones` (`ID_Devolucion`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;