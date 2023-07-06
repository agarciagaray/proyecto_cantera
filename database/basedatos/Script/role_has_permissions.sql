-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2022 a las 19:45:21
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_cantera_1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `id` bigint(12) UNSIGNED NOT NULL,
  `role_id` bigint(12) UNSIGNED NOT NULL,
  `permission_id` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 1, 2),
(2, 2, 2),
(3, 1, 3),
(4, 1, 4),
(4, 2, 4),
(5, 1, 5),
(5, 2, 5),
(6, 1, 6),
(6, 2, 6),
(7, 1, 7),
(7, 2, 7),
(8, 1, 8),
(8, 2, 8),
(9, 1, 9),
(9, 2, 9),
(10, 1, 18),
(10, 2, 18),
(11, 1, 19),
(11, 2, 19),
(12, 1, 20),
(12, 2, 20),
(13, 1, 21),
(13, 2, 21),
(14, 1, 22),
(14, 2, 22),
(15, 1, 23),
(15, 2, 23),
(16, 1, 24),
(16, 2, 24),
(17, 1, 25),
(17, 2, 25),
(18, 1, 26),
(18, 2, 26),
(19, 1, 27),
(19, 2, 27),
(20, 1, 28),
(20, 2, 28),
(21, 1, 29),
(21, 2, 29),
(22, 1, 30),
(22, 2, 30),
(23, 1, 31),
(23, 2, 31),
(24, 1, 32),
(24, 2, 32),
(25, 1, 33),
(25, 2, 33),
(26, 1, 34),
(26, 2, 34),
(27, 1, 35),
(27, 2, 35),
(28, 1, 36),
(28, 2, 36),
(29, 1, 37),
(29, 2, 37),
(30, 1, 38),
(30, 2, 38),
(31, 1, 39),
(31, 2, 39),
(32, 1, 40),
(32, 2, 40),
(33, 2, 3),
(34, 2, 41);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`id`,`role_id`,`permission_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`) USING BTREE,
  ADD KEY `fk_role_has_permissions_permissions1_idx` (`permission_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  MODIFY `id` bigint(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `fk_role_has_permissions_permissions1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `role_has_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
