-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-08-2018 a las 14:58:30
-- Versión del servidor: 5.7.23-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sicar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `descripcion_categoria` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`, `date_added`) VALUES
(1, 'graficas', 'tarjetas de video', '2018-05-08 00:00:00'),
(2, 'almacenamiento', 'unidades internas de almacenamiento', '2018-06-03 03:32:01'),
(3, 'ram', 'memorias ram', '2018-06-04 09:34:48'),
(5, 'gabinetes', 'gabinetes para pc', '2018-06-13 05:35:24'),
(6, 'audio', 'perifÃ©ricos y dispositivos de audio', '2018-06-13 05:35:49'),
(7, 'ventilacion', 'enfriamiento interno para pc', '2018-06-13 05:36:22'),
(8, 'procesador', 'unidad de procesamiento interno', '2018-06-13 05:37:00'),
(9, 'tarjeta madre', 'tarjeta madre para pc desktop', '2018-06-13 05:37:43'),
(10, 'alimentacion', 'fuente de alimentacion', '2018-06-13 07:46:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `rfc` varchar(100) NOT NULL,
  `curp` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `rfc`, `curp`, `telefono`, `correo`) VALUES
(1, 'julian elias perez barbosa', 'PEBJ691015P38', 'PEBJ691015HNTRRL06', '8341442093', 'julian@correo.com'),
(2, 'juan alberto banda tinajero', 'BATJ771015FS8', 'BATJ771015HDFNIN02', '8341920934', 'juan@correo.com'),
(3, 'alejandro gutierrez rodriguez', 'GURA781209C39', 'GURA781209HHGTDL03', '8341439029', 'alejandro@correo.com'),
(4, 'jesus palomares fuentes', 'PAFJ800411J98', 'PAFJ800411HDGLNS03', '83413929032', 'jesus@correo.com'),
(5, 'martin hernandez rodriguez', 'HERM840906NI6', 'HERM840906HNLRDR03', '8341239029', 'martin@correo.com'),
(6, 'publico en general', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `producto` varchar(100) NOT NULL,
  `cantidad` int(20) NOT NULL,
  `total` int(20) NOT NULL,
  `proveedor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `fecha`, `producto`, `cantidad`, `total`, `proveedor`) VALUES
(1, '2018-08-19 11:25:43', 'intel core i5 7400', 52, 176800, 'pedro perales martinez'),
(2, '2018-08-19 11:31:19', 'tarjeta grafica gtx950', 10, 24000, 'juan gabriel perez guerrero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nota` varchar(150) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `fecha` datetime NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `id_producto`, `nota`, `usuario`, `fecha`, `cantidad`) VALUES
(1, 11, 'El usuario marco agrego 100', 'marco', '2018-06-11 00:00:00', 100),
(2, 11, 'El usuario marco ha agregado 2', 'marco', '2018-06-14 02:14:08', 2),
(3, 11, 'El usuario marco ha eliminado 3', 'marco', '2018-06-14 02:14:26', 3),
(4, 17, 'El usuario marco ha agregado 100', 'marco', '2018-06-14 02:14:35', 100),
(5, 1, 'El usuario mario ha agregado 100', 'mario', '2018-08-18 07:35:26', 100),
(6, 1, 'El usuario admin ha eliminado 1', 'admin', '2018-08-19 03:00:50', 1),
(7, 1, 'El usuario admin ha agregado 1', 'admin', '2018-08-19 10:49:13', 1),
(8, 1, 'El usuario admin ha eliminado 4', 'admin', '2018-08-21 01:32:35', 4),
(9, 1, 'El usuario admin ha agregado 1', 'admin', '2018-08-21 05:16:44', 1),
(10, 3, 'El usuario admin ha agregado 1', 'admin', '2018-08-21 05:50:41', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `producto` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `proveedor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `producto`, `cantidad`, `total`, `proveedor`) VALUES
(1, '2018-08-20 10:54:36', 'nvidia gtx950', 100, 240000, 'jose marco fuentes escamilla'),
(3, '2018-08-21 05:54:12', 'SSD Kingston', 100, 89900, 'Pedro perales martinez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `date_added` datetime NOT NULL,
  `precio_producto` int(11) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `utilidad` int(11) NOT NULL,
  `cantidad_stock` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo_producto`, `nombre`, `descripcion`, `date_added`, `precio_producto`, `precio_compra`, `utilidad`, `cantidad_stock`, `id_categoria`) VALUES
(1, 200, 'nvidia gtx950', 'tarjeta grafica nvidia 2gb video', '2018-06-01 00:00:00', 2400, 1700, 5, 230, 1),
(3, 202, 'WD blue 1tb', 'disco duro 1tb de capacidad @7200', '2018-05-15 00:00:00', 980, 700, 5, 167, 2),
(5, 203, 'SSD Kingston', '120GB 10Gb/s', '2018-06-06 08:09:29', 899, 700, 5, 42, 2),
(6, 204, 'SSD ADATA ', '512GB 10Gb/s', '2018-06-11 05:06:13', 1899, 1400, 5, 88, 2),
(7, 205, 'RAM Kingston Savage ', '16gb DDR4 2400GMHz', '2018-06-11 05:09:43', 3300, 2700, 5, 150, 3),
(9, 100, 'HDD Seagate Barracuda ', '2TB @7200', '2018-06-13 05:34:28', 1459, 1100, 5, 94, 2),
(10, 1, 'h110m-m2 Gigabyte ', 'tarjeta madre socket 1155 5gen+', '2018-06-13 05:57:04', 1100, 800, 5, 94, 9),
(11, 2, 'h100i corsair', 'enfriamiento liquido intel/amd', '2018-06-13 05:58:53', 1299, 1000, 5, 60, 7),
(12, 10, 'intel core i7 8700k', 'intel octava generacion 4.3GHz', '2018-06-13 07:39:53', 6700, 6000, 5, 190, 8),
(13, 11, 'amd ryzen 7 7200', 'amd ryzen 1gen 4.5GHz 8 nucleos', '2018-06-13 07:41:28', 6500, 5900, 5, 180, 8),
(14, 12, 'logitech z506 2.1 THX', 'bocinas para pc logitech', '2018-06-13 07:43:15', 2200, 1600, 5, 88, 6),
(15, 13, 'cooler master MASTERBOX LITE', 'gabinete para pc torre', '2018-06-13 07:44:20', 950, 600, 5, 70, 5),
(16, 14, 'corsair c450x', 'fuente de poder 450 watts 80+', '2018-06-13 07:48:43', 740, 500, 5, 39, 10),
(17, 1, 'intel core i5 7400', 'intel 7gen 3.4GHz', '2018-06-13 07:53:17', 3400, 2900, 5, 300, 8),
(18, 3, 'gtx 1080Ti  Asus', 'tarjeta grafica 12Gb video', '2018-06-13 07:56:13', 16790, 15000, 5, 79, 1),
(19, 2234, 'Evo 212 CoolerMaster', 'Disipador de calor para procesador amd/intel', '2018-08-20 09:34:32', 600, 400, 5, 100, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `date_added` datetime NOT NULL,
  `rfc` varchar(100) NOT NULL,
  `curp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `first_name`, `last_name`, `user_email`, `date_added`, `rfc`, `curp`) VALUES
(3, 'jose marco', 'fuentes escamilla', 'marco@correo.com', '2018-06-02 00:00:00', 'FUEJ920127R75', 'FUEJ920127HTSNSS04'),
(4, 'jessica', 'sanchez garcia', 'jessica@correo.com', '2018-06-02 00:00:00', 'SAGJ960723TK2', 'SAGJ960723MTSNRS02'),
(8, 'jorge alberto', 'banda pulido', 'alberto@correo.com', '2018-06-02 00:00:00', 'BAPJ900504Q50', 'BAPJ900504HTLNLR01'),
(9, 'juan gabriel', 'perez guerrero', 'juan@correo.com', '2018-06-02 00:00:00', 'PEGJ8405106S2', 'PEGJ840510HVZRRN09'),
(11, 'Pedro', 'perales martinez', 'pedro@correo.com', '2018-06-02 00:00:00', 'PEMP860805AG7', 'PEMP860805HVZRRD04'),
(28, 'jesus alejandro', 'jimenez garcia', 'jesale@correo.com', '2018-08-20 08:37:23', 'JIGJ840612DD9', 'JIGJ840612HZSIRS09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'mario', 'de2f15d014d40b93578d255e6221fd60');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `productos_vendidos` varchar(300) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` float NOT NULL,
  `cliente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `productos_vendidos`, `cantidad`, `total`, `cliente`) VALUES
(26, '2018-06-13 07:19:53', 'h110m-m2 Gigabyte s1155', 2, 2200, 'alejandro gutierrez rodriguez'),
(27, '2018-06-13 07:22:01', 'HDD Seagate Barracuda 2TB', 3, 4377, 'juan alberto banda tinajero'),
(28, '2018-06-13 07:22:17', 'HDD Seagate Barracuda 2TB', 3, 4377, 'julian elias perez barbosa'),
(29, '2018-06-13 07:53:35', 'intel core i5 7400', 1, 3400, 'alejandro gutierrez rodriguez'),
(36, '2018-08-19 11:30:28', 'intel core i5 7400', 2, 6800, 'julian elias perez barbosa'),
(37, '2018-08-21 05:17:25', 'WD blue 1tb', 1, 980, 'alejandro gutierrez rodriguez'),
(38, '2018-08-21 05:20:00', 'nvidia gtx950', 1, 2400, 'julian elias perez barbosa');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
