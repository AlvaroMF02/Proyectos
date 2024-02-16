-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-01-2024 a las 17:05:44
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
-- Base de datos: `bd_exam2223`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `foto` varchar(20) NOT NULL DEFAULT 'no_imagen.jpg',
  `tipo` enum('normal','admin') NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `usuario`, `clave`, `foto`, `tipo`) VALUES
(1, 'nerea', '2c3d27e49a23fb4bc49b515ae6e1548c', 'no_imagen.jpg', 'admin'),
(2, 'edu', '379ef4bd50c30e261ccfb18dfc626d9f', 'no_imagen.jpg', 'admin'),
(3, 'yumi', 'd9de1908c30cb3c073fd1ba610ce077d', 'no_imagen.jpg', 'normal'),
(4, 'varo', '81dc9bdb52d04dc20036dbd8313ed055', 'no_imagen.jpg', 'normal'),
(5, 'viki', '81dc9bdb52d04dc20036dbd8313ed055', 'img_5.png', 'admin'),
(6, 'jose', '662eaa47199461d01a623884080934ab', 'no_imagen.jpg', 'normal'),
(7, 'ISA', '64f288ef838ec6e8bd8a3a8833c54047', 'no_imagen.jpg', 'normal'),
(8, 'nuria', 'cc776813221a1ae893d844b9f1c794b6', 'no_imagen.jpg', 'normal'),
(9, 'merche', '55631f43d5ee80e3da325fb676104f85', 'no_imagen.jpg', 'normal'),
(10, 'pablo', '7e4b64eb65e34fdfad79e623c44abd94', 'no_imagen.jpg', 'normal'),
(11, 'luna', 'ba8a48b0e34226a2992d871c65600a7c', 'img11.png', 'normal');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
