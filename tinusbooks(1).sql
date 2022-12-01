-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-11-2022 a las 01:57:48
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tinusbooks`
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
(1, 1, 2),
(4, 1, 1),
(1, 2, 8),
(3, 2, 5),
(1, 3, 5),
(2, 3, 1),
(1, 4, 10),
(2, 4, 2),
(1, 5, 5);

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
(1, 'Terror', 'Novelas de terror'),
(2, 'Aventura', 'Novelas de aventura'),
(3, 'Accion', 'Novelas de accion'),
(4, 'Amor', 'Novelas cortas de amor'),
(5, 'Ficcion', 'Mangas y novelas cortas'),
(6, 'Romance', 'Encontraremos gratas historias de enamorados'),
(7, 'Prueba Modificacion', 'No se que descripcion poner');

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
(1, '2022-11-21', '0.00', 0, 20, 'Pedido', NULL, 219, 'Av 20 de Noviembre', 'Rincon de Romos', 'Aguascalientes', '524651063274', 1, 1, '899.00'),
(2, '2022-11-20', '80.00', 0, 20, 'Entregado', NULL, 226, 'Miguel de la Madrid ', 'Aguascalientes', 'Aguascalientes', '524497071209', 4, 1, '179.00'),
(3, '2022-11-19', '0.00', 0, 20, 'Entregado', NULL, 450, 'Dr. Francisco Guel Jimenez', 'Aguascalientes', 'Aguascalientes', '524491043587', 3, 1, '500.00'),
(4, '2022-11-23', '0.00', 0, 20, 'Pedido', NULL, 310, 'Paseos de la monta├▒a ', 'Aguascalientes', 'Aguascalientes', '524491043587', 2, 1, '1200.00'),
(5, '2022-11-24', '0.00', 0, 20, 'Pedido', NULL, 310, 'Paseos de la monta├▒a ', 'Aguascalientes', 'Aguascalientes', '524491043587', 2, 1, '600.00');

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
('179.00', '80.00'),
('200.00', '50.00'),
('500.00', '0.00'),
('600.00', '0.00'),
('899.00', '0.00'),
('1200.00', '0.00');

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
(1, 'BuenFin22', 20),
(2, 'BlackF22', 25),
(3, 'luvread', 10),
(4, 'newUser', 15),
(5, 'endBook', 12),
(6, 'DescuentoPrueba', 15),
(7, 'DescuentoPrueba2', 15);

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
(5, 'Maze Runner', 'Aventura', '600.00', 1, 0);

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
('ctrlaltscape.jpg', 5, 1),
('dragon.jpg', 25, 3),
('dragon2.jpg', 25, 2),
('DragonBallNum13.jpg', 25, 1),
('fire.jpg', 4, 3),
('fire2.jpg', 4, 2),
('fire3.jpg', 4, 1),
('IT.jpg', 1, 1),
('IT2.JPG', 1, 2),
('IT3.jpg', 1, 3),
('maze.jpg', 3, 1),
('maze2.jpg', 3, 2),
('maze3.jpg', 3, 4),
('maze4.jpg', 3, 3),
('mob.jpg', 11, 1),
('mob2.jpg', 11, 2),
('one.jpg', 10, 2),
('one1.jpg', 10, 3),
('one2.jpg', 10, 1),
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
(3, 'Japon', 12),
(4, 'Argentina', 15),
(5, 'Chile', 14),
(6, 'Estados Unidos', 8);

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
(1, 'IT', 'Best Seller escrito por Stephen King', '899.00', 12, 1, 0),
(2, 'Sinsajo', 'Ultimo tomo de la trilogia de los juegos del hambre', '550.00', 10, 5, 0),
(3, 'Maze Runner', 'Correr o morir, primer todo de esta saga', '600.00', 14, 2, 0),
(4, 'Fire Force ', 'Manga que contiene la historia de unos weyes que son demonios y la gente se quema de la nada', '130.00', 100, 3, 15),
(5, 'Ctrl Alt Esc', 'Una historia sobre dos chicos que salvan el futuro', '399.00', 1, 3, 10),
(10, 'One Punch Man', 'El wey de un vergazo, digo, de un putazo.', '119.99', 99, 3, 5),
(11, 'Mob Psycho', 'Mob es un muchachon', '119.99', 106, 2, 5),
(25, 'Dragon Ball', 'Mejor anime del mundo', '99.00', 9, 3, 0);

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
(6, 'Casa', NULL, 1409, 'Av. Las Américas', '20164', 'Aguascalientes', 'Aguascalientes', '524494122838', 1),
(6, 'Prueba', '601', 1409, 'Av. Las Américas', '20164', 'Aguascalientes', 'Aguascalientes', '524494122838', 1),
(6, 'Trabajo', NULL, 1409, 'Av. Las Américas', '20164', 'Aguascalientes', 'Aguascalientes', '524494122838', 1);

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
(6, 'Geras1', 'al244371@edu.uaa.mx', '827ccb0eea8a706c4c34a16891f84e7b', b'1', b'0', 'Gerardo Femat Delgado'),
(7, 'Geras2', 'al244371@edu.uaa.mx', '827ccb0eea8a706c4c34a16891f84e7b', b'0', b'0', 'Gerardo Femat Delgado'),
(9, 'Gerardo1', 'hola@gola.com', '81dc9bdb52d04dc20036dbd8313ed055', b'0', b'0', 'Gerardo Femat Delgado'),
(10, 'Geras3', 'hola@hola.com', '827ccb0eea8a706c4c34a16891f84e7b', b'1', b'0', 'Gerardo Femat Delgado'),
(11, 'Paco', 'Paco@gmail.com', 'f68cf877ec47008b2c5956ea60ddbb5a', b'0', b'0', 'Francisco Mendez');

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
  MODIFY `Id_Compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cupon`
--
ALTER TABLE `cupon`
  MODIFY `ID_Cupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `ID_Pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_Prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
