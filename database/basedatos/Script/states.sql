-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2022 a las 16:42:29
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE `states` (
  `id` int(12) UNSIGNED NOT NULL,
  `dpto_nombre` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `country_id` int(12) UNSIGNED NOT NULL,
  `dpto_estado` char(1) COLLATE latin1_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id`, `dpto_nombre`, `country_id`, `dpto_estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ANTIOQUIA', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(2, 'ATLANTICO', 1, 'A', '2022-02-08 06:31:36', NULL, NULL),
(3, 'BOGOTA D.C', 1, 'A', '2022-02-08 06:31:39', NULL, NULL),
(4, 'BOLIVAR', 1, 'A', '2022-02-08 06:31:45', NULL, NULL),
(5, 'BOYACA', 1, 'A', '2022-02-08 06:31:48', NULL, NULL),
(6, 'CALDAS', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(7, 'CAQUETA', 1, 'A', '2022-02-08 06:31:51', NULL, NULL),
(8, 'CAUCA', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(9, 'CESAR', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(10, 'CORDOBA', 1, 'A', '2022-02-08 06:31:56', NULL, NULL),
(11, 'CUNDINAMARCA', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(12, 'CHOCO', 1, 'A', '2022-02-08 06:31:59', NULL, NULL),
(13, 'HUILA', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(14, 'LA GUAJIRA', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(15, 'MAGDALENA', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(16, 'META', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(17, 'NARIÑO', 1, 'A', '2022-02-08 06:32:08', NULL, NULL),
(18, 'NORTE DE SANTANDER', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(19, 'QUINDIO', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(20, 'RISARALDA', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(21, 'SANTANDER', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(22, 'SUCRE', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(23, 'TOLIMA', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(24, 'VALLE DEL CAUCA', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(25, 'ARAUCA', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(26, 'CASANARE', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(27, 'PUTUMAYO', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(28, 'ARCHIPIELAGO DE SAN ANDRES, PROVIDENCIA Y S', 1, 'A', '2022-02-08 06:32:22', NULL, NULL),
(29, 'AMAZONAS', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(30, 'GUAINIA', 1, 'A', '2022-02-08 06:32:34', NULL, NULL),
(31, 'GUAVIARE', 1, 'A', '2021-12-12 00:39:25', NULL, NULL),
(32, 'VAUPES', 1, 'A', '2022-02-08 06:32:39', NULL, NULL),
(33, 'VICHADA', 1, 'A', '2021-12-12 00:39:25', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_states_countries1_idx` (`country_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `fk_states_countries1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
