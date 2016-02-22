-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2016 a las 21:25:58
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prestamo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `codigo` varchar(6) NOT NULL,
  `nombre_articulo` varchar(50) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`codigo`, `nombre_articulo`, `descripcion`, `Estado`) VALUES
('ADP08', 'Adaptador 8 VGA MAC', 'Adaptador VGA para MAC', 1),
('ADP02', 'Adaptador 10" VGA MAC', 'Adaptador VGA para MAC', 1),
('ADP11', 'Adaptador Multiple MAC', 'Adaptador VGA, HDMI, DPI. para MAC', 1),
('ADP07', 'Adaptador 7 VGA MAC', 'Adaptador VGA para MAC', 1),
('ADP06', 'Adaptador 6 VGA MAC', 'Adaptador VGA para MAC', 1),
('ADP03', 'Adaptador 3 VGA MAC', 'Adaptador VGA para MAC', 1),
('ADP01', 'Adaptador 1 VGA MAC', 'Adaptador VGA para MAC', 1),
('TAB01', 'Surface', 'Tablet Microsoft Surface 1', 1),
('TAB02', 'Surface', 'Tablet Microsoft Surface 2', 1),
('BOC03', 'Bocinas', 'Bocinas Bluetooth Con Cables', 1),
('BOC02', 'Bocinas', 'Bocinas Bluetooth Con cables', 1),
('LAP01', 'Laptop', 'Computadora Laptop Dell Gris y cargador', 1),
('LAP02', 'Laptop', 'Computadora laptop lenovo negra y cargador\r\n', 1),
('LAP03', 'Laptop', 'Computadora laptop lenovo negra y cargador', 1),
('AUD01', 'Audifonos', 'Audifonos Acteck', 1),
('AUD02', 'Audifonos', 'Audifonos Acteck', 1),
('AUD03', 'Audifonos', 'Audifonos Acteck', 1),
('AUD04', 'Audifonos', 'Audifonos Acteck', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `num_prestamo` int(6) NOT NULL,
  `id_persona` varchar(8) NOT NULL,
  `codigo` varchar(6) NOT NULL,
  `hora_prestamo` timestamp NULL DEFAULT NULL,
  `hora_entrega` timestamp NULL DEFAULT NULL,
  `multa` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`num_prestamo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `num_prestamo` int(6) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
