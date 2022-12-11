-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql309.epizy.com
-- Tiempo de generación: 11-12-2022 a las 01:36:32
-- Versión del servidor: 10.3.27-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `epiz_33171925_tinusbooks`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `UsuarioID_Usr` int(11) NOT NULL,
  `ProductoID_Prod` int(11) NOT NULL,
  `cant_Prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`UsuarioID_Usr`, `ProductoID_Prod`, `cant_Prod`) VALUES
(3, 2, 5),
(1, 3, 5),
(2, 3, 1),
(1, 4, 10),
(2, 4, 2),
(1, 5, 5),
(13, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID_Cat` int(11) NOT NULL,
  `Nom_Cat` varchar(30) NOT NULL,
  `Descripcion_Cat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID_Cat`, `Nom_Cat`, `Descripcion_Cat`) VALUES
(2, 'Aventura', 'Novelas de aventura'),
(3, 'Accion', 'Novelas de accion'),
(5, 'Ficcion', 'Mangas y novelas cortas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `Id_Compra` int(11) NOT NULL,
  `Fecha_Compra` date NOT NULL,
  `Costo_Envio` decimal(6,2) NOT NULL,
  `Impuesto_Pais` int(11) NOT NULL,
  `Desc_Cup` int(11) NOT NULL,
  `Estado_Compra` varchar(30) NOT NULL,
  `Num_Int_Dir` varchar(5) DEFAULT NULL,
  `Num_Ext_Dir` int(11) NOT NULL,
  `Calle_Dir` varchar(30) NOT NULL,
  `Mcpio_Dir` varchar(30) NOT NULL,
  `Edo_Dir` varchar(30) NOT NULL,
  `Num_Tel_Dir` varchar(14) NOT NULL,
  `UsuarioId_Usr` int(11) NOT NULL,
  `CuponId_Cupon` int(11) DEFAULT NULL,
  `Costo_EvioMonto_Compra` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`Id_Compra`, `Fecha_Compra`, `Costo_Envio`, `Impuesto_Pais`, `Desc_Cup`, `Estado_Compra`, `Num_Int_Dir`, `Num_Ext_Dir`, `Calle_Dir`, `Mcpio_Dir`, `Edo_Dir`, `Num_Tel_Dir`, `UsuarioId_Usr`, `CuponId_Cupon`, `Costo_EvioMonto_Compra`) VALUES
(1, '2022-11-21', '0.00', 0, 20, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincon de Romos', 'Aguascalientes', '524651063274', 1, 1, NULL),
(2, '2022-11-20', '80.00', 0, 20, 'Entregado', NULL, 226, 'Miguel de la Madrid ', 'Aguascalientes', 'Aguascalientes', '524497071209', 4, 1, NULL),
(3, '2022-11-19', '0.00', 0, 20, 'Entregado', NULL, 450, 'Dr. Francisco Guel Jimenez', 'Aguascalientes', 'Aguascalientes', '524491043587', 3, 1, '500.00'),
(4, '2022-11-23', '0.00', 0, 20, 'Pedido', NULL, 310, 'Paseos de la monta├▒a ', 'Aguascalientes', 'Aguascalientes', '524491043587', 2, 1, NULL),
(5, '2022-11-24', '0.00', 0, 20, 'Pedido', NULL, 310, 'Paseos de la monta├▒a ', 'Aguascalientes', 'Aguascalientes', '524491043587', 2, 1, NULL),
(6, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(7, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(8, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(9, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(10, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(11, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(12, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(13, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(14, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(15, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(16, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(17, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(18, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(19, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(20, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(21, '2022-12-10', '100.00', 12, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '100.00'),
(22, '2022-12-10', '0.00', 16, 0, 'Pedido', '601', 1409, 'Av. Las Américas', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(23, '2022-12-10', '100.00', 16, 0, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincón de Romos', 'Aguascalientes', '4651063274', 11, NULL, '100.00'),
(24, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincón de Romos', 'Aguascalientes', '4651063274', 11, NULL, '500.00'),
(25, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincón de Romos', 'Aguascalientes', '4651063274', 11, NULL, '500.00'),
(26, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(27, '2022-12-10', '50.00', 16, 25, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '200.00'),
(28, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '500.00'),
(29, '2022-12-10', '50.00', 16, 0, 'Pedido', '601', 1409, 'Av. Las Américas', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '200.00'),
(30, '2022-12-10', '50.00', 16, 0, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincón de Romos', 'Aguascalientes', '4651063274', 11, NULL, '200.00'),
(31, '2022-12-10', '100.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '100.00'),
(32, '2022-12-10', '50.00', 16, 0, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincón de Romos', 'Aguascalientes', '4651063274', 11, NULL, '200.00'),
(33, '2022-12-10', '50.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '200.00'),
(34, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '500.00'),
(35, '2022-12-10', '50.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '200.00'),
(36, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '500.00'),
(37, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '500.00'),
(38, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincón de Romos', 'Aguascalientes', '4651063274', 11, NULL, '500.00'),
(39, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '500.00'),
(40, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '500.00'),
(41, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(42, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '500.00'),
(43, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(44, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '500.00'),
(45, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '500.00'),
(46, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '500.00'),
(47, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(48, '2022-12-10', '0.00', 12, 0, 'Pedido', NULL, 382, 'nose', 'Aguascalientes', 'Aguascalientes', '4213412341', 6, NULL, '500.00'),
(49, '2022-12-10', '0.00', 16, 20, 'Pedido', NULL, 118, 'Valle de Santiago', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, 1, '500.00'),
(50, '2022-12-10', '0.00', 16, 0, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincón de Romos', 'Aguascalientes', '4651063274', 11, NULL, '500.00'),
(51, '2022-12-11', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago 118', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(52, '2022-12-11', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago 118', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(53, '2022-12-11', '0.00', 15, 0, 'Pedido', NULL, 200, '5 mayo', 'Rincon', 'Aguascalientes', '4658515679', 14, NULL, '500.00'),
(54, '2022-12-11', '0.00', 16, 0, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincón de Romos', 'Aguascalientes', '4651063274', 11, NULL, '500.00'),
(55, '2022-12-11', '0.00', 16, 0, 'Pedido', '1', 219, 'av 20 nov', 'Rincon de Romos', 'Aguascalientes', '4658515679', 12, NULL, '500.00'),
(56, '2022-12-11', '100.00', 16, 0, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincón de Romos', 'Aguascalientes', '4651063274', 11, NULL, '100.00'),
(57, '2022-12-11', '100.00', 15, 0, 'Pedido', NULL, 200, '5 mayo', 'Rincon', 'Aguascalientes', '4658515679', 14, NULL, '100.00'),
(58, '2022-12-11', '50.00', 16, 0, 'Pedido', '1', 219, 'av 20 nov', 'Rincon de Romos', 'Aguascalientes', '4658515679', 12, NULL, '200.00'),
(59, '2022-12-11', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago 118', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00'),
(60, '2022-12-11', '0.00', 15, 0, 'Pedido', NULL, 200, '5 mayo', 'Rincon', 'Aguascalientes', '4658515679', 14, NULL, '500.00'),
(61, '2022-12-11', '0.00', 16, 0, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincón de Romos', 'Aguascalientes', '4651063274', 11, NULL, '500.00'),
(62, '2022-12-11', '50.00', 16, 0, 'Pedido', '1', 219, 'av 20 nov', 'Rincon de Romos', 'Aguascalientes', '4658515679', 12, NULL, '200.00'),
(63, '2022-12-11', '0.00', 16, 10, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincón de Romos', 'Aguascalientes', '4651063274', 11, 8, '500.00'),
(64, '2022-12-11', '0.00', 16, 0, 'Pedido', NULL, 118, 'Valle de Santiago 118', 'Aguascalientes', 'Aguascalientes', '524494122838', 6, NULL, '500.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costo_envio`
--

CREATE TABLE `costo_envio` (
  `Monto_Compra` decimal(6,2) NOT NULL,
  `Costo_Envio` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `costo_envio`
--

INSERT INTO `costo_envio` (`Monto_Compra`, `Costo_Envio`) VALUES
('0.00', '250.00'),
('100.00', '100.00'),
('200.00', '50.00'),
('500.00', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupon`
--

CREATE TABLE `cupon` (
  `ID_Cupon` int(11) NOT NULL,
  `Nombre_Descuento` varchar(30) NOT NULL,
  `Porcentaje_Desc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cupon`
--

INSERT INTO `cupon` (`ID_Cupon`, `Nombre_Descuento`, `Porcentaje_Desc`) VALUES
(1, 'apertura20', 20),
(8, 'SUS10', 10),
(9, 'TINUS', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `idCompra_Compra` int(11) NOT NULL,
  `Nombre_Prod` varchar(30) NOT NULL,
  `Nom_Cat_Prod` varchar(30) NOT NULL,
  `Precio_Prod` decimal(6,2) NOT NULL,
  `Cant_Prod` int(11) NOT NULL,
  `Descuento_Prod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`idCompra_Compra`, `Nombre_Prod`, `Nom_Cat_Prod`, `Precio_Prod`, `Cant_Prod`, `Descuento_Prod`) VALUES
(1, 'IT', 'Terror', '899.00', 1, 0),
(2, 'Fire Force', 'Ficcion', '99.00', 1, 0),
(3, 'Sinsajo', 'Ficcion', '500.00', 1, 0),
(4, 'Maze Runner', 'Aventura', '600.00', 2, 0),
(5, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(19, 'Maze Runner', 'Aventura', '600.00', 3, 0),
(20, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(20, 'Maze Runner', 'Aventura', '600.00', 3, 0),
(20, 'Mob Psycho', 'Aventura', '119.99', 2, 5),
(21, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(22, 'Maze Runner', 'Aventura', '600.00', 2, 0),
(23, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(24, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(24, 'Mob Psycho', 'Aventura', '119.99', 2, 5),
(25, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(25, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(25, 'One Punch Man', 'Accion', '119.99', 1, 5),
(26, 'Maze Runner', 'Aventura', '600.00', 2, 0),
(27, 'Fire Force ', 'Ficcion', '120.00', 4, 10),
(28, 'Ctrl Alt Esc', 'Accion', '399.00', 1, 10),
(28, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(28, 'Maze Runner', 'Aventura', '600.00', 2, 0),
(29, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(29, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(30, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(30, 'One Punch Man', 'Accion', '119.99', 1, 5),
(31, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(32, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(32, 'One Punch Man', 'Accion', '119.99', 1, 5),
(33, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(33, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(33, 'One Punch Man', 'Accion', '119.99', 1, 5),
(34, 'Mob Psycho', 'Aventura', '119.99', 3, 5),
(34, 'One Punch Man', 'Accion', '119.99', 4, 5),
(35, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(35, 'One Punch Man', 'Accion', '119.99', 2, 5),
(36, 'Fire Force ', 'Ficcion', '120.00', 2, 10),
(36, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(36, 'Sinsajo', 'Ficcion', '550.00', 1, 0),
(37, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(37, 'Maze Runner', 'Aventura', '600.00', 2, 0),
(38, 'Fire Force ', 'Ficcion', '120.00', 10, 10),
(38, 'Mob Psycho', 'Aventura', '119.99', 2, 5),
(38, 'One Punch Man', 'Accion', '119.99', 1, 5),
(39, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(39, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(40, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(40, 'Sinsajo', 'Ficcion', '550.00', 1, 0),
(41, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(41, 'Sinsajo', 'Ficcion', '550.00', 1, 0),
(42, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(42, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(43, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(43, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(43, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(44, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(44, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(45, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(45, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(45, 'Sinsajo', 'Ficcion', '550.00', 1, 0),
(46, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(46, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(47, 'Ctrl Alt Esc', 'Accion', '399.00', 1, 10),
(47, 'Fire Force ', 'Ficcion', '120.00', 2, 10),
(47, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(47, 'One Punch Man', 'Accion', '119.99', 1, 5),
(48, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(48, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(48, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(49, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(49, 'Maze Runner', 'Aventura', '600.00', 4, 0),
(49, 'Mob Psycho', 'Aventura', '119.99', 2, 5),
(49, 'One Punch Man', 'Accion', '119.99', 2, 5),
(49, 'Sinsajo', 'Ficcion', '550.00', 1, 0),
(50, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(50, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(51, 'Ctrl Alt Esc', 'Accion', '399.00', 4, 10),
(52, 'Sinsajo', 'Ficcion', '550.00', 1, 0),
(53, 'El rastro', 'Aventura', '600.00', 1, 30),
(53, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(53, 'One Punch Man', 'Accion', '119.99', 1, 5),
(54, 'Ctrl Alt Esc', 'Accion', '399.00', 1, 10),
(54, 'Divergente', 'Accion', '500.00', 1, 5),
(55, 'Belle', 'Ficcion', '200.00', 1, 0),
(55, 'El ojo de vidrio', 'Aventura', '250.00', 1, 15),
(55, 'Maze Runner', 'Aventura', '600.00', 1, 0),
(55, 'Rebeca', 'Accion', '300.00', 1, 20),
(56, 'One Punch Man', 'Accion', '119.99', 1, 5),
(57, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(58, 'Belle', 'Ficcion', '200.00', 1, 0),
(59, 'El rastro', 'Aventura', '600.00', 3, 30),
(60, 'Divergente', 'Accion', '500.00', 1, 5),
(60, 'El rastro', 'Aventura', '600.00', 1, 30),
(60, 'One Punch Man', 'Accion', '119.99', 1, 5),
(61, 'Como los gatos hacen antes de ', 'Ficcion', '450.00', 1, 0),
(61, 'Mob Psycho', 'Aventura', '119.99', 1, 5),
(62, 'Ctrl Alt Esc', 'Accion', '399.00', 1, 10),
(63, 'Como los gatos hacen antes de ', 'Ficcion', '450.00', 1, 0),
(63, 'Fire Force ', 'Ficcion', '120.00', 1, 10),
(63, 'Rebeca', 'Accion', '300.00', 1, 20),
(64, 'Maze Runner', 'Aventura', '600.00', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_producto`
--

CREATE TABLE `img_producto` (
  `Direccion_Img` varchar(255) NOT NULL,
  `ProductoId_Prod` int(11) NOT NULL,
  `Num_Img` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `img_producto`
--

INSERT INTO `img_producto` (`Direccion_Img`, `ProductoId_Prod`, `Num_Img`) VALUES
('belle.jpg', 28, 1),
('ctrlaltscape.jpg', 5, 1),
('Divergente.jpg', 27, 1),
('fire10.jpg', 4, 2),
('fire5.jpg', 4, 1),
('gatosMorir.jpg', 29, 1),
('maze.jpg', 3, 1),
('maze2.jpg', 3, 2),
('maze3.jpg', 3, 4),
('maze4.jpg', 3, 3),
('mob2.jpg', 11, 2),
('MobNumUno.jpg', 11, 1),
('OjoVidrio.jpg', 32, 1),
('one.jpg', 10, 2),
('one1.jpg', 10, 3),
('one2.jpg', 10, 1),
('rastro.jpg', 31, 1),
('Rebeca.jpg', 30, 1),
('sinsajo.jpg', 2, 1),
('sinsajoBlanco.jpg', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `ID_Pais` int(11) NOT NULL,
  `Nombre_Pais` varchar(30) NOT NULL,
  `Impuesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`ID_Pais`, `Nombre_Pais`, `Impuesto`) VALUES
(1, 'Mexico', 16),
(2, 'Alemania', 10),
(4, 'Argentina', 15),
(5, 'Chile', 14),
(6, 'Estados Unidos', 8),
(7, 'Japon', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_Prod` int(11) NOT NULL,
  `Nombre_Prod` varchar(45) NOT NULL,
  `Descripcion_Prod` longtext NOT NULL,
  `Precio_Prod` decimal(6,2) NOT NULL,
  `Existencias_Prod` int(11) NOT NULL,
  `CategoriaId_Cat` int(11) NOT NULL,
  `Descuento_Prod` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_Prod`, `Nombre_Prod`, `Descripcion_Prod`, `Precio_Prod`, `Existencias_Prod`, `CategoriaId_Cat`, `Descuento_Prod`) VALUES
(2, 'Sinsajo', 'Ultimo tomo de la trilogia de los juegos del hambre', '550.00', 0, 5, 0),
(3, 'Maze Runner', 'Correr o morir, primer todo de esta saga', '600.00', 32, 2, 0),
(4, 'Fire Force ', 'Manga que contiene la historia de unos weyes que son demonios y la gente se quema de la nada, terrible :C', '120.00', 518, 5, 10),
(5, 'Ctrl Alt Esc', 'Una historia sobre dos chicos que salvan el futuro', '399.00', 38, 3, 10),
(10, 'One Punch Man', 'El wey de un vergazo, digo, de un putazo.', '119.99', 82, 3, 5),
(11, 'Mob Psycho', 'Mob es un muchachon', '119.99', 82, 2, 5),
(27, 'Divergente', 'Un mundo regulado de manera en que tu personalidad define lo que serás, una joven forjará su propio futuro', '500.00', 13, 3, 5),
(28, 'Belle', 'En una nueva realidad llamada U, una joven chica decide intentar ser ella misma siendo una cantante que afrontará este nuevo mundo y sus nuevas dificultades', '200.00', 1, 5, 0),
(29, 'Como los gatos hacen antes de morir', 'Dos amigos que afrontan las diferentes adversidades que les pone la vida en la cara', '450.00', 18, 5, 0),
(30, 'Rebeca', 'La historia vista desde una perspectiva diferente a lo que se afronta un fantasma hecho de los recuerdos de una primer esposa', '300.00', 48, 3, 20),
(31, 'El rastro', 'Estoy cambiando el dato del producto', '600.00', 7, 2, 30),
(32, 'El ojo de vidrio', 'Una aventura de un joven que viaja con sus parientes lejanos y ahora tiene que comenzar su vida allá iniciando una aventura que nunca olvidará', '250.00', 2, 2, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr_direccion`
--

CREATE TABLE `usr_direccion` (
  `UsuarioId_Usr` int(11) NOT NULL,
  `Alias_Dir` varchar(25) NOT NULL,
  `Num_Int_Dir` varchar(5) DEFAULT NULL,
  `Num_Ext_Dir` int(11) NOT NULL,
  `Calle_Dir` varchar(30) NOT NULL,
  `CP_Dir` varchar(5) NOT NULL,
  `Mcpio_Dir` varchar(30) NOT NULL,
  `Edo_Dir` varchar(30) NOT NULL,
  `Num_Tel_Dir` varchar(14) NOT NULL,
  `ID_Pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usr_direccion`
--

INSERT INTO `usr_direccion` (`UsuarioId_Usr`, `Alias_Dir`, `Num_Int_Dir`, `Num_Ext_Dir`, `Calle_Dir`, `CP_Dir`, `Mcpio_Dir`, `Edo_Dir`, `Num_Tel_Dir`, `ID_Pais`) VALUES
(1, 'Casa', NULL, 218, 'Av 20 de Noviembre', '20410', 'Rincon de Romos', 'Aguascalientes', '524651063274', 1),
(2, 'Casa', NULL, 310, 'Paseos de la monta├▒a ', '20411', 'Aguascalientes', 'Aguascalientes', '524491043587', 1),
(3, 'Casa', NULL, 450, 'Dr. Francisco Guel Jimenez', '20421', 'Aguascalientes', 'Aguascalientes', '524491043587', 1),
(4, 'Casa', NULL, 226, 'Miguel de la Madrid ', '20413', 'Aguascalientes', 'Aguascalientes', '524497071209', 1),
(5, 'Casa', NULL, 125, 'Las Americas ', '20426', 'Aguascalientes', 'Aguascalientes', '524491027864', 1),
(6, 'Oficina', NULL, 118, 'Valle de Santiago 118', '20164', 'Aguascalientes', 'Aguascalientes', '524494122838', 1),
(11, 'Casa Papás', NULL, 219, 'Av 20 de Noviembre', '20410', 'Rincón de Romos', 'Aguascalientes', '4651063274', 1),
(11, 'Casita', NULL, 219, 'Av 20 de Noviembre', '20410', 'Rincón de Romos', 'Aguascalientes', '4651063274', 1),
(12, 'casa', '1', 219, 'av 20 nov', '20410', 'Rincon de Romos', 'Aguascalientes', '4658515679', 1),
(14, 'oficina', NULL, 200, '5 mayo', '20410', 'Rincon', 'Aguascalientes', '4658515679', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usr` int(11) NOT NULL,
  `Cuenta_usr` varchar(20) NOT NULL,
  `Correo_usr` varchar(45) NOT NULL,
  `Contrasena_usr` varchar(65) NOT NULL,
  `Admin` bit(1) NOT NULL DEFAULT b'0',
  `Bloqueo` bit(1) NOT NULL DEFAULT b'0',
  `Nombre_Usr` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID_Usr`, `Cuenta_usr`, `Correo_usr`, `Contrasena_usr`, `Admin`, `Bloqueo`, `Nombre_Usr`) VALUES
(1, 'Pakko10', 'fcodmendez24@gmail.com', 'holi1234', b'0', b'0', 'Francisco Mendez'),
(2, 'Sandra', 'al292930@edu.uaa.mx', 'holas1234', b'0', b'0', 'Sandra Prieto'),
(3, 'Geras', 'ejemplo1@gmail.com', 'ole12345', b'0', b'0', 'Gerardo Femat'),
(4, 'Manny23', 'ejemplo2@gmail.com', 'wenas1234', b'0', b'0', 'Emmanuel Mu├▒oz'),
(5, 'Manuel987', 'ejemplo3@gmail.com', 'salu2345', b'0', b'0', 'Manuel Gonzalez'),
(6, 'Geras1', 'gerardifematdelgado@gmail.com', '9108ff57c2cfacddc01f7031d8852812', b'1', b'0', 'Gerardo Femat Delgado'),
(7, 'Geras2', 'al244371@edu.uaa.mx', '827ccb0eea8a706c4c34a16891f84e7b', b'0', b'0', 'Gerardo Femat Delgado'),
(9, 'Gerardo1', 'hola@gola.com', '81dc9bdb52d04dc20036dbd8313ed055', b'0', b'0', 'Gerardo Femat Delgado'),
(10, 'Geras3', 'hola@hola.com', '827ccb0eea8a706c4c34a16891f84e7b', b'1', b'0', 'Gerardo Femat Delgado'),
(11, 'Paco', 'fcodmendez24@gmail.com', 'f68cf877ec47008b2c5956ea60ddbb5a', b'1', b'0', 'Francisco Mendez'),
(12, 'Pacco', 'alex.jml.2007@gmail.com', 'f68cf877ec47008b2c5956ea60ddbb5a', b'1', b'0', 'Fco Mdz'),
(13, 'sandriux', 'sandyolimpia02@gmail.com', '9450476b384b32d8ad8b758e76c98a69', b'0', b'0', 'sandra prieto garcia'),
(14, 'pack', 'mendez.lara.ivan95@gmail.com', 'f68cf877ec47008b2c5956ea60ddbb5a', b'0', b'0', 'Paquito Mendez'),
(15, 'MannyManito123', 'manny@gmail.com', '25d55ad283aa400af464c76d713c07ad', b'0', b'0', 'Emmanuel Muñoz Cerda'),
(16, 'Admin1', 'correoparamodificar@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', b'1', b'0', 'Administrador'),
(17, 'Gina', 'correoparamodificar@gmail.com', '8868812bf922983040671145dc3ef91a', b'0', b'0', 'Georgina Salazar Partida');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`ProductoID_Prod`,`UsuarioID_Usr`),
  ADD KEY `ProductoId_Prod_idx` (`ProductoID_Prod`),
  ADD KEY `ProductoId_Prod_id` (`ProductoID_Prod`),
  ADD KEY `UsuarioId_Car_idx` (`UsuarioID_Usr`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_Cat`),
  ADD UNIQUE KEY `idcategoria_UNIQUE` (`ID_Cat`),
  ADD UNIQUE KEY `Nom_Cat_UNIQUE` (`Nom_Cat`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`Id_Compra`),
  ADD UNIQUE KEY `Id_Compra_UNIQUE` (`Id_Compra`),
  ADD KEY `UsuarioId_Usr_idx` (`UsuarioId_Usr`),
  ADD KEY `CuponId_cupon_idx` (`CuponId_Cupon`),
  ADD KEY `Costo_EnvioMonto_Compra_idx` (`Costo_EvioMonto_Compra`);

--
-- Indices de la tabla `costo_envio`
--
ALTER TABLE `costo_envio`
  ADD PRIMARY KEY (`Monto_Compra`),
  ADD UNIQUE KEY `Monto_Compra_UNIQUE` (`Monto_Compra`);

--
-- Indices de la tabla `cupon`
--
ALTER TABLE `cupon`
  ADD PRIMARY KEY (`ID_Cupon`),
  ADD UNIQUE KEY `ID_Cupon_UNIQUE` (`ID_Cupon`),
  ADD UNIQUE KEY `Nombre_Descuento_UNIQUE` (`Nombre_Descuento`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`idCompra_Compra`,`Nombre_Prod`);

--
-- Indices de la tabla `img_producto`
--
ALTER TABLE `img_producto`
  ADD PRIMARY KEY (`ProductoId_Prod`,`Num_Img`),
  ADD UNIQUE KEY `Direccion_Img_UNIQUE` (`Direccion_Img`),
  ADD KEY `ID_Prod_idx` (`ProductoId_Prod`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`ID_Pais`),
  ADD UNIQUE KEY `idpais_UNIQUE` (`ID_Pais`),
  ADD UNIQUE KEY `Nombre_Pais_UNIQUE` (`Nombre_Pais`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_Prod`),
  ADD UNIQUE KEY `ID_Prod_UNIQUE` (`ID_Prod`),
  ADD KEY `CategoriaId_prod_idx` (`CategoriaId_Cat`);

--
-- Indices de la tabla `usr_direccion`
--
ALTER TABLE `usr_direccion`
  ADD PRIMARY KEY (`UsuarioId_Usr`,`Alias_Dir`),
  ADD KEY `Direccion_ID_Pais_idx` (`ID_Pais`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usr`),
  ADD UNIQUE KEY `Id_Usr_UNIQUE` (`ID_Usr`),
  ADD UNIQUE KEY `Username_usr_UNIQUE` (`Cuenta_usr`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_Cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `Id_Compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `cupon`
--
ALTER TABLE `cupon`
  MODIFY `ID_Cupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `ID_Pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_Prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `ProductoId_Car` FOREIGN KEY (`ProductoID_Prod`) REFERENCES `producto` (`ID_Prod`),
  ADD CONSTRAINT `UsuarioId_Car` FOREIGN KEY (`UsuarioID_Usr`) REFERENCES `usuario` (`ID_Usr`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `Costo_EnvioMonto_Compra` FOREIGN KEY (`Costo_EvioMonto_Compra`) REFERENCES `costo_envio` (`Monto_Compra`),
  ADD CONSTRAINT `CuponId_cupon` FOREIGN KEY (`CuponId_Cupon`) REFERENCES `cupon` (`ID_Cupon`),
  ADD CONSTRAINT `UsuarioId_Usr` FOREIGN KEY (`UsuarioId_Usr`) REFERENCES `usuario` (`ID_Usr`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `CompraId_Compra` FOREIGN KEY (`idCompra_Compra`) REFERENCES `compra` (`Id_Compra`);

--
-- Filtros para la tabla `img_producto`
--
ALTER TABLE `img_producto`
  ADD CONSTRAINT `ProductoId_Img` FOREIGN KEY (`ProductoId_Prod`) REFERENCES `producto` (`ID_Prod`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `CategoriaId_prod` FOREIGN KEY (`CategoriaId_Cat`) REFERENCES `categoria` (`ID_Cat`);

--
-- Filtros para la tabla `usr_direccion`
--
ALTER TABLE `usr_direccion`
  ADD CONSTRAINT `PaisId_Dir` FOREIGN KEY (`ID_Pais`) REFERENCES `pais` (`ID_Pais`),
  ADD CONSTRAINT `UsuarioId_Dir` FOREIGN KEY (`UsuarioId_Usr`) REFERENCES `usuario` (`ID_Usr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
