-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2023 a las 21:12:12
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
-- Base de datos: `cerveza`
--
CREATE DATABASE IF NOT EXISTS `cerveza` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `cerveza`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cervezas_atrs`
--

CREATE TABLE `cervezas_atrs` (
  `Identificador` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Tipo` varchar(10) NOT NULL,
  `Graduacion` int(11) NOT NULL CHECK (`Graduacion` > 0),
  `Pais` varchar(60) NOT NULL,
  `Precio` int(11) NOT NULL CHECK (`Precio` > 0),
  `RutaImagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cervezas_atrs`
--

INSERT INTO `cervezas_atrs` (`Identificador`, `Nombre`, `Tipo`, `Graduacion`, `Pais`, `Precio`, `RutaImagen`) VALUES
(1, 'Erding Kristall', 'tostada', 4, 'Alemania', 3, '../beer-desc/Erding Kristall.jpg'),
(2, 'Irish Red Ale', 'tostada', 3, 'Inglaterra', 2, '../beer-desc/IrishRedAle.jpg'),
(3, 'Quilmes', 'tostada', 5, 'Argentina', 5, '../beer-desc/Quilmes.jpg'),
(4, 'Sour Ale', 'tostada', 6, 'Ecuador', 2, '../beer-desc/Sour-Ale.png'),
(5, 'Spaten Oktoberfest', 'tostada', 3, 'Alemania', 2, '../beer-desc/Spaten-Oktoberfest.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cervezas_atrs`
--
ALTER TABLE `cervezas_atrs`
  ADD PRIMARY KEY (`Identificador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cervezas_atrs`
--
ALTER TABLE `cervezas_atrs`
  MODIFY `Identificador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
