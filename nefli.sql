-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-09-2024 a las 04:43:19
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
-- Base de datos: `nefli`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chapters`
--

CREATE TABLE `chapters` (
  `id_chapter` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `chapter_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_season` int(11) NOT NULL,
  `id_serie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `chapters`
--

INSERT INTO `chapters` (`id_chapter`, `number`, `chapter_name`, `description`, `id_season`, `id_serie`) VALUES
(1, 1, 'The beginning', 'Comienza la busqueda del problema', 1, 1),
(5, 1, 'u', 'p', 1, 2),
(6, 1, 'u', 'p', 1, 3),
(8, 2, 'u', 'p', 1, 1),
(9, 2, 'u', 'p', 1, 2),
(10, 2, 'u', 'p', 1, 3),
(12, 3, 'u', 'p', 1, 1),
(13, 3, 'u', 'p', 1, 2),
(14, 3, 'u', 'p', 1, 3),
(15, 4, 'u', 'p', 1, 1),
(16, 4, 'u', 'p', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seasons`
--

CREATE TABLE `seasons` (
  `id_season` int(11) NOT NULL,
  `season_number` int(11) NOT NULL,
  `season_name` varchar(255) NOT NULL,
  `id_serie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seasons`
--

INSERT INTO `seasons` (`id_season`, `season_number`, `season_name`, `id_serie`) VALUES
(1, 1, 'Start to the mission', 1),
(2, 2, 'a', 1),
(3, 1, 's', 2),
(4, 1, 'd', 3),
(5, 3, 'f', 1),
(6, 2, 'g', 3),
(9, 2, 'w', 2),
(11, 3, 'r', 2),
(12, 3, 't', 3),
(13, 4, 'z', 2),
(14, 5, 'x', 2),
(15, 4, 'c', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`id`, `name`) VALUES
(1, 'Travelers'),
(2, '123'),
(3, '456'),
(5, '147');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id_chapter`),
  ADD KEY `id_season` (`id_season`),
  ADD KEY `id_serie` (`id_serie`);

--
-- Indices de la tabla `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id_season`),
  ADD KEY `id_serie` (`id_serie`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id_chapter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id_season` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`id_season`) REFERENCES `seasons` (`id_season`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chapters_ibfk_2` FOREIGN KEY (`id_serie`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `seasons`
--
ALTER TABLE `seasons`
  ADD CONSTRAINT `seasons_ibfk_1` FOREIGN KEY (`id_serie`) REFERENCES `series` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
