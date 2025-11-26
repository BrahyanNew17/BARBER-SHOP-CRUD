-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2025 a las 23:25:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `barber_shop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barbero`
--

CREATE TABLE `barbero` (
  `idBarbero` int(11) NOT NULL,
  `nomCompleto` varchar(50) DEFAULT NULL,
  `telefono` bigint(20) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `barbero`
--

INSERT INTO `barbero` (`idBarbero`, `nomCompleto`, `telefono`, `correo`, `foto`) VALUES
(1, 'Pepe Martinez', 3158719834, 'p.martinez@gmail.com', '1porciento.png'),
(2, 'Brahyan Leal', 3208673456, 'brahyanestivenleal07@gmail.com', '1porciento.png'),
(3, 'David Coy', 3138511911, 'coy.david@gmail.com', '1porciento.png'),
(4, 'Sebastian trujillo', 3203516932, 's.trujillo@gmail.com', '1porciento.png'),
(5, 'Duban hernandez', 3583567892, 'duban.hernandez@gmail.com', '1porciento.png'),
(8, 'andrea', 5756344636, 'andrea@gmail.com', '1porciento.png'),
(9, 'Santiago Ramírez', 3104560927, 'santiago.ramirez.barber@gmail.', 'barbero.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `categoria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `categoria`) VALUES
(1, 'Maquinas y herramientas electricas'),
(2, 'Tijeras y herramientas manuales'),
(3, 'Cuidado capilar y estilizado'),
(4, 'Cuidado de la barba y afeitado'),
(5, 'Higiene y desinfeccion'),
(9, 'Lavado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `idCita` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `numDocum` bigint(20) DEFAULT NULL,
  `idBarbero` int(11) DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`idCita`, `fecha`, `hora`, `numDocum`, `idBarbero`, `idEstado`) VALUES
(1, '2025-10-12', '15:00:00', 900123456, 1, 1),
(2, '2025-10-09', '10:00:00', 8765432, 2, 3),
(3, '2025-10-13', '14:30:00', 1012345678, 3, 2),
(4, '2025-05-14', '10:30:00', 1105305047, 4, 5),
(5, '2025-11-23', '16:30:00', 2210987654, 5, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `numDocum` bigint(20) NOT NULL,
  `nombreComplet` varchar(60) DEFAULT NULL,
  `Telefono` bigint(20) DEFAULT NULL,
  `direccion` varchar(60) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `idtipoDoc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`numDocum`, `nombreComplet`, `Telefono`, `direccion`, `correo`, `idtipoDoc`) VALUES
(8765432, 'John Michael Carter', 3205551010, 'Calle 10 #5-20, Cali, Valle del Cauca', 'mailto:john.carter@example.com', 4),
(900123456, 'Diego Alejandro Mu?oz', 3056667788, 'Carrera 15 #60-40, Barranquilla, Atlantico', 'mailto:diego.munoz@example.com', 3),
(1012345678, 'Andres Felipe Ram?rez', 3004123456, 'Calle 45 #12-34, Bogota, Cundinamarca', 'mailto:andres.ramirez@example.com', 1),
(1105305047, 'Diego Alejandro Munoz', 3056667788, 'Carrera 15 #60-40, Barranquilla, Atlantico', 'mailto:diego.munoz@example.com', 2),
(2210987654, 'Camilo Andres Torres', 3127703344, 'Avenida 30 #22-11, Pereira, Risaralda', 'mailto:camilo.torres@example.com', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventproducto`
--

CREATE TABLE `detalleventproducto` (
  `idDetalleVent` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precioUnitario` int(11) DEFAULT NULL,
  `subTotal` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `idVentaProducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalleventproducto`
--

INSERT INTO `detalleventproducto` (`idDetalleVent`, `cantidad`, `precioUnitario`, `subTotal`, `idProducto`, `idVentaProducto`) VALUES
(1, 1, 45000, 50000, 10, 3),
(2, 2, 45000, 50000, 1, 2),
(3, 3, 32000, 40000, 4, 1),
(4, 4, 45000, 60000, 6, 4),
(5, 5, 25000, 50000, 8, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventservicio`
--

CREATE TABLE `detalleventservicio` (
  `idDetalle` int(11) NOT NULL,
  `precioUnitario` int(11) DEFAULT NULL,
  `idServicio` int(11) DEFAULT NULL,
  `idVentaServi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalleventservicio`
--

INSERT INTO `detalleventservicio` (`idDetalle`, `precioUnitario`, `idServicio`, `idVentaServi`) VALUES
(1, 17000, 1, 1),
(2, 35000, 6, 2),
(3, 23000, 5, 3),
(4, 34000, 4, 4),
(5, 35000, 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idEstado` int(11) NOT NULL,
  `estado` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idEstado`, `estado`) VALUES
(1, 'Programada'),
(2, 'En Servicio'),
(3, 'Completada'),
(4, 'Cancelada por Barberia'),
(5, 'Cancelada por Usuario'),
(6, 'No Asistio'),
(7, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idMarca` int(11) NOT NULL,
  `marca` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idMarca`, `marca`) VALUES
(1, 'Wahl'),
(2, 'Andis'),
(3, 'Oster'),
(4, 'BabylissPRO'),
(5, 'Kemei'),
(6, 'Jaguar'),
(7, 'Kiepe'),
(8, 'Feather'),
(9, 'Reuzel'),
(10, 'Suavecito'),
(11, 'Layrite'),
(12, 'Proraso'),
(13, 'The Shaving Co'),
(14, 'Barbcide'),
(15, 'Andis Cool care'),
(16, 'Clorox'),
(17, 'Takara Belmont'),
(18, 'Pibbs'),
(19, 'Kiepe Professional'),
(20, 'Sibel'),
(21, 'Colanta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nomProduc` varchar(30) DEFAULT NULL,
  `precioUni` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `idMarca` int(11) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nomProduc`, `precioUni`, `cantidad`, `idMarca`, `idCategoria`) VALUES
(1, 'Cortodora Magic Clip', 45000, 4, 1, 1),
(2, 'Patillera T-Outliner', 65000, 3, 2, 1),
(3, 'Tijeras de corte Silver', 45000, 5, 6, 2),
(4, 'Navaja Plegable', 32000, 8, 8, 2),
(5, 'Pomada Strong Hold', 30000, 5, 9, 3),
(6, 'Cera Original', 45000, 6, 10, 3),
(7, 'Aceite para barba Wood & Spice', 32000, 4, 12, 4),
(8, 'Balsamo para barba Original', 25000, 5, 13, 4),
(9, 'Desinfectante concentrado', 25000, 4, 14, 5),
(10, 'Spray Cool Care', 45000, 5, 15, 5),
(11, 'Gel', 5000, 2, 2, 1),
(17, 'Maquina', 100000, 1, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `NITproveedor` varchar(20) NOT NULL,
  `nombreProveedor` varchar(40) DEFAULT NULL,
  `direcProveedor` varchar(40) DEFAULT NULL,
  `telefono` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`NITproveedor`, `nombreProveedor`, `direcProveedor`, `telefono`) VALUES
('2345729045', 'Andis Latinoamerica', 'Calle 127 #19A-45, Bogota D.C.', 3142908876),
('2354891247', 'Barber Shop Supply', 'Carrera 15 #93-60, Bogota D.C.', 3175112224),
('24546574875969', 'Systems', 'Calle 47A #18-29, Barrio Los Cedros, Bog', 21412523),
('3546789123', 'Cosmeticos y Belleza S.A.S.', 'Avenida 30 de Agosto #45-20, Pereira, Ri', 6063249080),
('46576913246', 'Distribuidora Wahl Colombia', 'Carrera 68 #70-11, Bogota D.C.', 17456543),
('9011687283', 'Barber Depot Colombia', 'Calle 53 #16-35, Bogota D.C.', 3204567890),
('9845614786', 'Beauty Supply Center', 'Calle 9 #42-35, Medellin, Antioquia', 6043225566);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedorproducto`
--

CREATE TABLE `proveedorproducto` (
  `idProveProduc` int(11) NOT NULL,
  `NITproveedor` varchar(20) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedorproducto`
--

INSERT INTO `proveedorproducto` (`idProveProduc`, `NITproveedor`, `idProducto`) VALUES
(1, '2345729045', 1),
(2, '2354891247', 2),
(3, '3546789123', 3),
(4, '46576913246', 4),
(5, '9011687283', 5),
(6, '9845614786', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idServicio` int(11) NOT NULL,
  `nombreServi` varchar(60) DEFAULT NULL,
  `precioUni` int(11) DEFAULT NULL,
  `duracion` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idServicio`, `nombreServi`, `precioUni`, `duracion`) VALUES
(1, 'Corte', 17000, '1 Hora'),
(2, 'Cejas', 8000, '30 Minutos'),
(3, 'Barba', 10000, '35 Minutos'),
(4, 'Corte + Barba', 27000, '1 Hora 35 Minutos'),
(5, 'Corte + Cejas', 25000, '1 Hora y 30 Minutos'),
(6, 'Corte + Barba + Cejas', 35000, '2 Horas'),
(7, 'Manicure', 50000, 'Media Hora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `idtipoDoc` int(11) NOT NULL,
  `tipoDocumento` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`idtipoDoc`, `tipoDocumento`) VALUES
(1, 'CC'),
(2, 'TI'),
(3, 'RC'),
(4, 'CE'),
(5, 'PA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventaproducto`
--

CREATE TABLE `ventaproducto` (
  `idVentaProducto` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `numDocum` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventaproducto`
--

INSERT INTO `ventaproducto` (`idVentaProducto`, `fecha`, `hora`, `total`, `numDocum`) VALUES
(1, '2025-10-12', '16:26:00', 23000, 8765432),
(2, '2025-10-11', '13:30:00', 45000, 900123456),
(3, '2025-10-23', '10:00:00', 50000, 1012345678),
(4, '2025-05-12', '11:30:00', 15000, 1105305047),
(5, '2025-11-18', '15:25:00', 14000, 2210987654);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventaservicio`
--

CREATE TABLE `ventaservicio` (
  `idVentaServi` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `numDocum` bigint(20) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventaservicio`
--

INSERT INTO `ventaservicio` (`idVentaServi`, `fecha`, `hora`, `numDocum`, `total`) VALUES
(1, '2025-10-23', '11:00:00', 8765432, 23000),
(2, '2025-05-12', '14:20:00', 900123456, 180000),
(3, '2025-01-23', '15:20:00', 1012345678, 500000),
(4, '2025-04-23', '09:30:00', 1105305047, 45000),
(5, '2025-07-12', '17:30:00', 2210987654, 67000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barbero`
--
ALTER TABLE `barbero`
  ADD PRIMARY KEY (`idBarbero`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`idCita`),
  ADD KEY `numDocum` (`numDocum`),
  ADD KEY `idBarbero` (`idBarbero`),
  ADD KEY `idEstado` (`idEstado`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`numDocum`),
  ADD KEY `idtipoDoc` (`idtipoDoc`);

--
-- Indices de la tabla `detalleventproducto`
--
ALTER TABLE `detalleventproducto`
  ADD PRIMARY KEY (`idDetalleVent`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idVentaProducto` (`idVentaProducto`);

--
-- Indices de la tabla `detalleventservicio`
--
ALTER TABLE `detalleventservicio`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `idServicio` (`idServicio`),
  ADD KEY `idVentaServi` (`idVentaServi`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idMarca`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD KEY `idMarca` (`idMarca`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`NITproveedor`);

--
-- Indices de la tabla `proveedorproducto`
--
ALTER TABLE `proveedorproducto`
  ADD PRIMARY KEY (`idProveProduc`),
  ADD KEY `NITproveedor` (`NITproveedor`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idServicio`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`idtipoDoc`);

--
-- Indices de la tabla `ventaproducto`
--
ALTER TABLE `ventaproducto`
  ADD PRIMARY KEY (`idVentaProducto`),
  ADD KEY `numDocum` (`numDocum`);

--
-- Indices de la tabla `ventaservicio`
--
ALTER TABLE `ventaservicio`
  ADD PRIMARY KEY (`idVentaServi`),
  ADD KEY `numDocum` (`numDocum`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barbero`
--
ALTER TABLE `barbero`
  MODIFY `idBarbero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalleventproducto`
--
ALTER TABLE `detalleventproducto`
  MODIFY `idDetalleVent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalleventservicio`
--
ALTER TABLE `detalleventservicio`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `proveedorproducto`
--
ALTER TABLE `proveedorproducto`
  MODIFY `idProveProduc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `idtipoDoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ventaproducto`
--
ALTER TABLE `ventaproducto`
  MODIFY `idVentaProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventaservicio`
--
ALTER TABLE `ventaservicio`
  MODIFY `idVentaServi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`numDocum`) REFERENCES `cliente` (`numDocum`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`idBarbero`) REFERENCES `barbero` (`idBarbero`),
  ADD CONSTRAINT `cita_ibfk_3` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idtipoDoc`) REFERENCES `tipodocumento` (`idtipoDoc`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleventproducto`
--
ALTER TABLE `detalleventproducto`
  ADD CONSTRAINT `detalleventproducto_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`),
  ADD CONSTRAINT `detalleventproducto_ibfk_2` FOREIGN KEY (`idVentaProducto`) REFERENCES `ventaproducto` (`idVentaProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalleventservicio`
--
ALTER TABLE `detalleventservicio`
  ADD CONSTRAINT `detalleventservicio_ibfk_1` FOREIGN KEY (`idServicio`) REFERENCES `servicio` (`idServicio`),
  ADD CONSTRAINT `detalleventservicio_ibfk_2` FOREIGN KEY (`idVentaServi`) REFERENCES `ventaservicio` (`idVentaServi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idMarca`) REFERENCES `marca` (`idMarca`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedorproducto`
--
ALTER TABLE `proveedorproducto`
  ADD CONSTRAINT `proveedorproducto_ibfk_1` FOREIGN KEY (`NITproveedor`) REFERENCES `proveedor` (`NITproveedor`),
  ADD CONSTRAINT `proveedorproducto_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventaproducto`
--
ALTER TABLE `ventaproducto`
  ADD CONSTRAINT `ventaproducto_ibfk_1` FOREIGN KEY (`numDocum`) REFERENCES `cliente` (`numDocum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventaservicio`
--
ALTER TABLE `ventaservicio`
  ADD CONSTRAINT `ventaservicio_ibfk_1` FOREIGN KEY (`numDocum`) REFERENCES `cliente` (`numDocum`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
