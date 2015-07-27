-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-07-2015 a las 11:34:27
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tfg_mapas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bando`
--

CREATE TABLE IF NOT EXISTS `bando` (
`ban_id` int(10) unsigned NOT NULL,
  `ban_des` varchar(255) DEFAULT NULL,
  `ban_color` varchar(6) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bando`
--

INSERT INTO `bando` (`ban_id`, `ban_des`, `ban_color`) VALUES
(1, 'Musulmanes', '#000'),
(2, 'Cristianos', '#000'),
(4, 'Judios', '#000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
`conf_id` int(10) unsigned NOT NULL,
  `conf_des` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`conf_id`, `conf_des`) VALUES
(1, 'JAEN'),
(4, 'Granada'),
(5, 'Cordoba'),
(7, 'Huelva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poi`
--

CREATE TABLE IF NOT EXISTS `poi` (
`poi_id` int(10) unsigned NOT NULL,
  `poi_lat` double NOT NULL,
  `poi_long` double NOT NULL,
  `poi_img` varchar(255) NOT NULL,
  `poi_ini` int(11) NOT NULL,
  `poi_fin` int(11) NOT NULL,
  `tipo_id` int(11) unsigned NOT NULL,
  `bando_id` int(11) unsigned NOT NULL,
  `conf_id` int(11) unsigned NOT NULL,
  `poi_izq_lat` double NOT NULL,
  `poi_izq_long` double NOT NULL,
  `poi_derch_lat` double NOT NULL,
  `poi_derch_long` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_poi`
--

CREATE TABLE IF NOT EXISTS `tipo_poi` (
`tipo_id` int(10) unsigned NOT NULL,
  `tipo_des` varchar(255) DEFAULT NULL,
  `tipo_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_poi`
--

INSERT INTO `tipo_poi` (`tipo_id`, `tipo_des`, `tipo_img`) VALUES
(1, 'Castillo', ''),
(2, 'Torre', ''),
(4, 'Torreta', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id_usuario` int(11) NOT NULL,
  `name_usuario` varchar(50) NOT NULL,
  `pass_usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bando`
--
ALTER TABLE `bando`
 ADD PRIMARY KEY (`ban_id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
 ADD PRIMARY KEY (`conf_id`);

--
-- Indices de la tabla `poi`
--
ALTER TABLE `poi`
 ADD PRIMARY KEY (`poi_id`), ADD KEY `conf_id` (`conf_id`), ADD KEY `poi_id` (`poi_id`), ADD KEY `conf_id_2` (`conf_id`);

--
-- Indices de la tabla `tipo_poi`
--
ALTER TABLE `tipo_poi`
 ADD PRIMARY KEY (`tipo_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id_usuario`), ADD UNIQUE KEY `name_usuario` (`name_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bando`
--
ALTER TABLE `bando`
MODIFY `ban_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
MODIFY `conf_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `poi`
--
ALTER TABLE `poi`
MODIFY `poi_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_poi`
--
ALTER TABLE `tipo_poi`
MODIFY `tipo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
