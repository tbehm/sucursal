-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2024 a las 02:13:37
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sucursal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `apertura` double NOT NULL,
  `actual` double NOT NULL,
  `cierre` double DEFAULT 0,
  `encargado` varchar(50) NOT NULL,
  `Cod_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`fecha`, `apertura`, `actual`, `cierre`, `encargado`, `Cod_sucursal`) VALUES
('2024-07-01 21:18:41', 4343434, 4343434, 0, 'ff', 1),
('2024-07-01 23:23:49', 32222, 32222, 0, 'etgs', 3),
('2024-07-02 00:08:13', 2332, 2332, 0, 'yrkj', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `DNI` varchar(10) NOT NULL,
  `Clave` varchar(15) NOT NULL,
  `Nombre` text NOT NULL,
  `Apellido` text NOT NULL,
  `Telefono` varchar(12) NOT NULL,
  `Direccion` text NOT NULL,
  `Ingreso` date NOT NULL,
  `Fnac` varchar(15) NOT NULL,
  `Puesto` varchar(30) NOT NULL,
  `Sueldo` varchar(20) NOT NULL,
  `Cod_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `DNI`, `Clave`, `Nombre`, `Apellido`, `Telefono`, `Direccion`, `Ingreso`, `Fnac`, `Puesto`, `Sueldo`, `Cod_sucursal`) VALUES
(1, '2024', '1234', 'ff', 'aaa', '54', 'sdf', '2024-07-01', '2031-12-01', '5', '686', 1),
(3, '123', '123', 'etgs', 'sfe', '567', 'sdrbg', '2024-07-01', '2022-03-05', 'cocina', '32000', 3),
(4, '123', '1234', 'yrkj', 'ftgj', '65756', 'fgjfg', '2024-07-01', '2025-02-02', '745', '768967', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id_caja` datetime NOT NULL,
  `hora` time NOT NULL,
  `descripcion` text NOT NULL,
  `monto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id_caja`, `hora`, `descripcion`, `monto`) VALUES
('2024-07-01 18:18:41', '18:40:28', '(canceled)papel', 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infosucursal`
--

CREATE TABLE `infosucursal` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `logo` text NOT NULL,
  `bg_color` varchar(10) NOT NULL,
  `header_color` varchar(10) NOT NULL,
  `table_color` varchar(10) NOT NULL,
  `font` varchar(10) NOT NULL,
  `btn` varchar(10) NOT NULL,
  `aside` varchar(10) NOT NULL,
  `aside_btn` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `infosucursal`
--

INSERT INTO `infosucursal` (`id`, `nombre`, `logo`, `bg_color`, `header_color`, `table_color`, `font`, `btn`, `aside`, `aside_btn`) VALUES
(1, 'Rapidash', 'iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAMAAACdt4HsAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAG7AAABuwE67OPiAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAWhQTFRF////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAz+t/MgAAAHd0Uk5TAAECAwQGCAkKCw4QEhQVFhgeICEiIyQmJykqMDE0Nzo9P0BBSElKS01QUVJTWFlbXl9gY2Vmb3Byd3h9f4CEhYiPkJGTlJWXmJygoqOorK2wtri5vsbIyszNz9fY2drd3uDi5ebn6eru7/Dx8vP09vf4+fv8/f6OzsdBAAACP0lEQVRYw+2WWVfTUBRGv4BY8ILiABWpiswF6ogWB0RBQFSwCFTUigQtgjK0QLv/vg9NWrqoNAlvLPZTVtb6dpJz7rm50hmnCKt1MOaDwVarPN+xik9WOw7n+3P4Jtdfyps0AUibomCAQAwUBaPATsT4ILIDjBYF40DKX9dSwPhpE+SzvsiXCWaCtXHGzbdkgwmyLY5gnoDMF/JRgOW4T5YBopJUbwMH7X7nv/0AsOsljQFM+d9BpgDGpPAeQOKdbxIAe2HNcSLmtHEywUbwHrqdbJxcSqaBTNLhJ5BNlvEd4EvZrQyQTi5NNh4dpleAXV7wKECz12msIBgBuB1cMLAP8LstqKB7r1CvXy3BBJ27bsXty1UENcbUHhXYpZ7NHi+4uAbr148Ibj0scu14QQSgp1IXvG6qXfF4r+UKzrWF/hduuuqhiGaR3Ujl/EtyI9UFQ8C3yjtJHraqCx4BhCsJXgC5uqqCMMATSQr1RB3u1EjSZ2DJw0L6AXyS1LVZWgd2s3QpDzz3IJgEMiEpcXj6n0n3AW56EPQB9EpvDwseSLPAuuVBUJ8B3kitC3k3nvkQUu0G8N7TMC0AdmzoghrMPYCwOa+22FOAu54E8cJjt7tLO5LzE841ehJEnRdfLAquOIfBTfkSJIqCpv3CnT++BF9vlD7h8XblN6ibBlbcE9xrYM2YQuVgyL0MG2M+AvDXGLMCTNcVjtkTW0H/KlsTlpwVE5Q+ScMnEQxLakgFz6caJMnqjAWk09IZp4N/uNoTspjbjScAAAAASUVORK5CYII=', '#87942e', '#a76c6c', '#422163', '#fffafa', '#150467', '#ba6969', '#f3b939');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `cod_mesa` int(20) NOT NULL,
  `Cod_sucursal` int(20) NOT NULL,
  `mesa` int(20) NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`cod_mesa`, `Cod_sucursal`, `mesa`, `estado`) VALUES
(1, 1, 1, 'ocupada'),
(2, 1, 2, 'ocupada'),
(3, 2, 1, 'libre'),
(4, 2, 2, 'libre'),
(5, 2, 3, 'libre'),
(6, 2, 4, 'libre'),
(7, 3, 1, 'ocupada'),
(8, 3, 2, 'ocupada'),
(9, 3, 3, 'ocupada'),
(10, 3, 4, 'en proceso'),
(11, 3, 5, 'libre'),
(12, 3, 6, 'libre'),
(13, 3, 7, 'en proceso'),
(14, 3, 8, 'libre'),
(15, 3, 9, 'libre'),
(16, 3, 10, 'libre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `Cod_pedido` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `producto` varchar(40) NOT NULL,
  `cantidad` varchar(5) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `cliente` varchar(30) NOT NULL,
  `mesa` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `Cod_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`Cod_pedido`, `idPedido`, `producto`, `cantidad`, `fecha`, `hora`, `cliente`, `mesa`, `estado`, `Cod_sucursal`) VALUES
(1, 1, 'Papas fritas', '11', '2024-07-01', '17:13:07', '4tgevf', '1', 'finalizado', 1),
(2, 2, 'Papas fritas', '1', '2024-07-01', '17:13:48', 'rt', '2', 'finalizado', 1),
(5, 4, 'Hamburguesa Simple', '1', '2024-07-01', '20:04:55', 'erfgd', '1', 'en preparacion', 1),
(6, 4, 'Hamburguesa doble', '1', '2024-07-01', '20:04:58', 'erfgd', '1', 'en preparacion', 1),
(7, 4, 'Helado vainilla', '1', '2024-07-01', '20:04:59', 'erfgd', '1', 'en preparacion', 1),
(9, 6, 'Helado vainilla', '3', '2024-07-01', '20:07:33', '6u', '2', 'finalizado', 1),
(10, 7, 'Papas fritas', '1', '2024-07-01', '20:13:47', 'sdaf', '2', 'finalizado', 1),
(11, 8, 'Papas fritas', '1', '2024-07-01', '20:15:21', 'rtgvf', '2', 'tomando..', 1),
(12, 9, 'Papas fritas', '2', '2024-07-01', '20:15:27', 'rtgvf', '2', 'tomando..', 1),
(13, 10, 'Papas fritas', '1', '2024-07-01', '20:17:31', 'rtgvf', '2', 'finalizado', 1),
(14, 11, 'Hamburguesa Simple', '1', '2024-07-01', '20:17:53', 'fv', '2', 'finalizado', 1),
(15, 12, 'Hamburguesa Simple', '1', '2024-07-01', '20:18:16', 'htr', '2', 'finalizado', 1),
(16, 13, 'Papas fritas', '1', '2024-07-01', '20:19:09', 'tyj', '2', 'finalizado', 1),
(17, 14, 'Papas fritas', '1', '2024-07-01', '20:20:16', 'yt', '2', 'finalizado', 1),
(18, 15, 'Papas fritas', '1', '2024-07-01', '20:20:51', 'fkff', '2', 'en preparacion', 1),
(19, 16, 'Hamburguesa Simple', '1', '2024-07-01', '20:21:18', 'kutnhymy', '1', 'en preparacion', 1),
(20, 16, 'Papas fritas', '1', '2024-07-01', '20:21:19', 'kutnhymy', '1', 'en preparacion', 1),
(21, 1, 'Hamburguesa Simple', '1', '2024-07-01', '20:25:42', '55gfrj', '1', 'finalizado', 3),
(22, 1, 'Hamburguesa doble', '0', '2024-07-01', '20:26:21', '55gfrj', '1', 'finalizado', 3),
(23, 2, 'Hamburguesa Simple', '1', '2024-07-01', '20:27:10', 'ryhj', '2', 'finalizado', 3),
(24, 17, 'Papas fritas', '1', '2024-07-01', '20:28:02', 'uyktj', '2', 'finalizado', 1),
(25, 18, 'Hamburguesa Simple', '1', '2024-07-01', '20:28:29', '67uyjhrgr', '1', 'finalizado', 1),
(30, 19, 'Papas fritas', '1', '2024-07-01', '20:31:39', '6ujty', '2', 'finalizado', 1),
(31, 3, 'Papas fritas', '1', '2024-07-01', '20:32:18', 'kj', '4', 'en preparacion', 3),
(32, 3, 'Hamburguesa Simple', '0', '2024-07-01', '20:32:21', 'kj', '4', 'en preparacion', 3),
(33, 4, 'Papas fritas', '1', '2024-07-01', '20:33:15', 'rydjkf', '3', 'en preparacion', 3),
(34, 20, 'Helado vainilla', '1', '2024-07-01', '20:35:17', 'srb', '1', 'finalizado', 1),
(35, 21, 'Hamburguesa Simple', '2', '2024-07-01', '20:37:10', 'yufj', '1', 'tomando..', 1),
(36, 22, 'Papas fritas', '3', '2024-07-01', '20:37:54', 'yufj', '1', 'tomando..', 1),
(37, 23, 'Papas fritas', '1', '2024-07-01', '20:39:08', 'yufj', '1', 'tomando..', 1),
(38, 24, 'Papas fritas', '3', '2024-07-01', '20:39:31', 'yufj', '1', 'tomando..', 1),
(39, 25, 'Hamburguesa Simple', '1', '2024-07-01', '20:39:54', 'yufj', '1', 'tomando..', 1),
(42, 28, 'Papas fritas', '1', '2024-07-01', '20:48:04', 'rtkj', '2', 'finalizado', 1),
(43, 28, 'Hamburguesa Simple', '1', '2024-07-01', '20:48:05', 'rtkj', '2', 'finalizado', 1),
(44, 29, 'Papas fritas', '3', '2024-07-01', '20:54:26', 'facu', '1', 'finalizado', 1),
(45, 30, 'Helado vainilla', '2', '2024-07-01', '20:54:49', 'ynb', '2', 'finalizado', 1),
(46, 31, 'Helado vainilla', '2', '2024-07-01', '20:56:22', 'rhr4', '1', 'finalizado', 1),
(47, 32, 'Helado vainilla', '3', '2024-07-01', '20:56:39', 't7kyf', '2', 'en preparacion', 1),
(48, 33, 'Helado vainilla', '2', '2024-07-01', '20:57:57', 'guylkgyk', '1', 'finalizado', 1),
(49, 34, 'Helado vainilla', '1', '2024-07-01', '20:59:47', 'tixy ', '1', 'en preparacion', 1),
(50, 34, 'Papas con Baicon', '1', '2024-07-01', '20:59:49', 'tixy ', '1', 'en preparacion', 1),
(51, 5, 'Papas fritas', '1', '2024-07-01', '21:07:23', 'tyoiytik', '4', 'tomando..', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id_producto` varchar(30) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Descripcion` text NOT NULL,
  `Costo` int(25) NOT NULL,
  `ingredientes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id_producto`, `Nombre`, `Descripcion`, `Costo`, `ingredientes`) VALUES
('1', 'Papas fritas', 'medianas', 1500, 'cono de papas'),
('2', 'Hamburguesa Simple', 'con cheddar y ketchup', 2000, 'medallon de carne'),
('3', 'Hamburguesa doble', 'doble carne, cheddar y ketchup', 500, 'medallon de carne,medallon de carne'),
('4', 'Helado vainilla', 'Sabor vainilla', 1500, 'conos de helado'),
('5', 'Helado Chocolate', 'sabor chocolate', 1500, 'conos de helado'),
('6', 'Helado Combinado', 'sabor Vainilla y Chocolate', 2000, 'conos de helado'),
('7', 'Papas con Baicon', 'papas fritas con bacon', 2500, 'cono de papas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id_promo` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `productos` text NOT NULL,
  `descuento` int(11) NOT NULL,
  `fechaDuracion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id_promo`, `nombre`, `productos`, `descuento`, `fechaDuracion`) VALUES
(1, 'Combo fin de mes', '[\"1\",\"2\"]', 20, '2024-07-06'),
(2, 'Combo', '[\"1\",\"2\"]', 20, '2024-07-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `Cod_producto` varchar(20) NOT NULL,
  `Nombre` text NOT NULL,
  `Cantidad` varchar(10) NOT NULL,
  `Cod_sucursal` int(11) NOT NULL,
  `unidad_medicion` text NOT NULL,
  `aviso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `stock`
--

INSERT INTO `stock` (`Cod_producto`, `Nombre`, `Cantidad`, `Cod_sucursal`, `unidad_medicion`, `aviso`) VALUES
('1', 'cono de papas', '187', 1, 'unidades', 150),
('1', 'cono de papas', '432', 3, 'unidades', 150),
('1', 'cono de papas', '--', 4, 'unidades', 150),
('10', 'mayonesa', '4', 1, 'cajas', 2),
('10', 'mayonesa', '5', 3, 'cajas', 2),
('10', 'mayonesa', '--', 4, 'cajas', 2),
('11', 'mostaza', '2', 1, 'cajas', 2),
('11', 'mostaza', '5', 3, 'cajas', 2),
('11', 'mostaza', '--', 4, 'cajas', 2),
('12', 'sal', '3', 1, 'cajas', 2),
('12', 'sal', '7', 3, 'cajas', 2),
('12', 'sal', '--', 4, 'cajas', 2),
('2', 'medallon de carne', '203', 1, 'unidades', 200),
('2', 'medallon de carne', '233', 3, 'unidades', 200),
('2', 'medallon de carne', '--', 4, 'unidades', 200),
('3', 'conos de helado', '231', 1, 'unidades', 100),
('3', 'conos de helado', '333', 3, 'unidades', 100),
('3', 'conos de helado', '--', 4, 'unidades', 100),
('4', 'papas', '54', 1, 'kilos', 10),
('4', 'papas', '34', 3, 'kilos', 10),
('4', 'papas', '--', 4, 'kilos', 10),
('5', 'Tomate', '76', 1, 'Kilos', 10),
('5', 'Tomate', '12', 3, 'Kilos', 10),
('5', 'Tomate', '--', 4, 'Kilos', 10),
('6', 'Helado chocolate', '67', 1, 'Kilos', 10),
('6', 'Helado chocolate', '23', 3, 'Kilos', 10),
('6', 'Helado chocolate', '--', 4, 'Kilos', 10),
('7', 'Helado vainilla', '45', 1, 'Kilos', 10),
('7', 'Helado vainilla', '43', 3, 'Kilos', 10),
('7', 'Helado vainilla', '--', 4, 'Kilos', 10),
('8', 'Bacon', '12', 1, 'Kilos', 10),
('8', 'Bacon', '12', 3, 'Kilos', 10),
('8', 'Bacon', '--', 4, 'Kilos', 10),
('9', 'ketchup', '34', 1, 'cajas', 2),
('9', 'ketchup', '5', 3, 'cajas', 2),
('9', 'ketchup', '--', 4, 'cajas', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `Cod_sucursal` int(11) NOT NULL,
  `Direccion` varchar(40) NOT NULL,
  `Capacidad` int(10) NOT NULL,
  `Cod_supervisor` varchar(28) NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`Cod_sucursal`, `Direccion`, `Capacidad`, `Cod_supervisor`, `Fecha`) VALUES
(1, 'Nigeria 9023(Wilson)', 2, '1', '2024-07-01'),
(3, 'bogota 3310(Jose C. Paz)', 10, '1', '2024-07-01'),
(4, 'nueva', 0, '1', '2024-07-01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`fecha`),
  ADD KEY `Cod_sucursal` (`Cod_sucursal`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `Cod_sucursal` (`Cod_sucursal`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`hora`),
  ADD KEY `id_caja` (`id_caja`);

--
-- Indices de la tabla `infosucursal`
--
ALTER TABLE `infosucursal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`cod_mesa`),
  ADD KEY `Cod_sucursal` (`Cod_sucursal`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`Cod_pedido`),
  ADD KEY `Cod_sucursal` (`Cod_sucursal`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id_producto`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`Cod_producto`,`Cod_sucursal`),
  ADD KEY `Cod_sucursal` (`Cod_sucursal`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`Cod_sucursal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `infosucursal`
--
ALTER TABLE `infosucursal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `Cod_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `Cod_sucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
