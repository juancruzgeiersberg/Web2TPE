-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2024 a las 00:43:44
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
-- Base de datos: `serie_manager`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `id_season` int(11) DEFAULT NULL,
  `id_series` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `episode_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `episodes`
--

INSERT INTO `episodes` (`id`, `id_season`, `id_series`, `title`, `episode_number`) VALUES
(1, 1, 1, 'qweasd', 1),
(2, 1, 1, 'asdzxc', 2),
(3, 1, 1, 'qwe', 3),
(4, 1, 1, 'zxc', 4),
(5, 1, 1, 'qweasdzxc', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seasons`
--

CREATE TABLE `seasons` (
  `id` int(11) NOT NULL,
  `id_series` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `season_number` int(11) NOT NULL,
  `episode_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seasons`
--

INSERT INTO `seasons` (`id`, `id_series`, `title`, `season_number`, `episode_count`) VALUES
(1, 1, 'asd', 1, 5),
(3, 2, 'zxc', 1, 3),
(4, 3, 'asd', 1, 4),
(8, 1, 'Temp2', 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`id`, `title`, `description`) VALUES
(1, 'Prision Break', 'Ta buena'),
(2, 'Lucifer', 'Ta buena'),
(3, 'Travelers', 'Ta buena'),
(4, 'Breaking Bad', 'Ta buena'),
(5, 'Black List', 'Ta Piola'),
(6, 'Swits', 'Ea');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `user` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `user`, `password`, `rol_id`) VALUES
(1, 'caruchis', '$2y$10$JM3AukhM1x.L3Q6d41DP2.veXxiPaLAAg5uum0jRkW4SCySiAbtr6', 2),
(2, 'juan', '$2y$10$JM3AukhM1x.L3Q6d41DP2.veXxiPaLAAg5uum0jRkW4SCySiAbtr6', 2),
(3, 'juan2', '$2y$10$JM3AukhM1x.L3Q6d41DP2.veXxiPaLAAg5uum0jRkW4SCySiAbtr6', 2),
(4, 'caruchis1', '$2y$10$nwcVOJ/N2hanbXF4vpm/iOokK8nflu5NN4UVWD039MArbtiEK83Da', 2),
(5, 'admin', '$2y$10$9QAjmfB64s/8JQkj7kN95ugpwf55Z8d4ErwZcSyvpE8ialFzCGySa', 1),
(6, 'caruchis2', '$2y$10$XxPys9BmMUsU7f.MJWvOQOpXYWhq1mAr5HyrsqPhqtQEj8FODwT5W', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_season` (`id_season`),
  ADD KEY `id_series` (`id_series`);

--
-- Indices de la tabla `seasons`
--
ALTER TABLE `seasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_series` (`id_series`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `seasons`
--
ALTER TABLE `seasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_ibfk_1` FOREIGN KEY (`id_season`) REFERENCES `seasons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `episodes_ibfk_2` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `seasons`
--
ALTER TABLE `seasons`
  ADD CONSTRAINT `seasons_ibfk_1` FOREIGN KEY (`id_series`) REFERENCES `series` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
