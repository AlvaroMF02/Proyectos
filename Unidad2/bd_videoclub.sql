-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-11-2023 a las 14:33:48
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_videoclub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `idPelicula` int(11) NOT NULL,
  `titulo` varchar(15) NOT NULL,
  `director` varchar(20) NOT NULL,
  `sinopsis` text NOT NULL,
  `tematica` varchar(15) NOT NULL,
  `caratula` varchar(30) NOT NULL DEFAULT 'no_imagen.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`idPelicula`, `titulo`, `director`, `sinopsis`, `tematica`, `caratula`) VALUES
(1, 'Lucy', 'Ronald McDonald', 'peliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapeliculapelicula', 'Ficción', 'imagen_1.jpg'),
(2, 'X-MEN', 'Pedro Sanchez', 'miaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiaumiau', 'Ficcion', 'imagen_2.jpg'),
(3, 'Los Warren', 'Ayuso', 'arrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarrarr', 'Terror', 'imagen_3.jpg'),
(4, 'Avatar', 'Nacho Salcedo', 'rururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururururu', 'Aventuras', 'imagen_4.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`idPelicula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `idPelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
