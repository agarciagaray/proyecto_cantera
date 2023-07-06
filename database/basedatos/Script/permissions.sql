-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2022 a las 19:45:13
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
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `guard_name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lista de permisos', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(2, 'Guardar permisos', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(3, 'Eliminar permisos', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(4, 'Lista de roles', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(5, 'Guardar roles', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(6, 'Eliminar roles', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(7, 'Lista de usuarios', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(8, 'Guardar usuarios', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(9, 'Eliminar usuarios', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(18, 'Formulario de usuarios', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(19, 'Formulario de permisos', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(20, 'Formulario de roles', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(21, 'Listado viaticos y otros', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(22, 'Formulario viaticos y otros', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(23, 'Guardar viaticos y otros', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(24, 'Eliminar viaticos y otros', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(25, 'Lista de Descarga de carrotanque', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(26, 'Formulario de Descarga de carrotanque', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(27, 'Guardar de Descarga de carrotanque', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(28, 'Eliminar de Descarga de carrotanque', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(29, 'Lista de carga de cubitanques', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(30, 'Formulario de carga de cubitanques', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(31, 'Guardar de carga de cubitanques', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(32, 'Eliminar de carga de cubitanques', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(33, 'Lista de máquinas de tanqueo', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(34, 'Formulario de máquinas de tanqueo', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(35, 'Guardar de máquinas de tanqueo', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(36, 'Eliminar de máquinas de tanqueo', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(37, 'Lista de movimiento de material', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(38, 'Formulario de movimiento de material', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(39, 'Guardar de movimiento de material', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(40, 'Eliminar de movimiento de material', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL),
(41, 'Cambio de estado', 'web', '2022-04-12 12:22:52', '2022-04-12 12:22:52', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
