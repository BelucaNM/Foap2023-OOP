-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2024 a las 13:40:50
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
-- Base de datos: `prova`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pisos`
--

CREATE TABLE `pisos` (
  `idPis` int(5) NOT NULL,
  `uidpis` varchar(30) NOT NULL,
  `tipus` tinyint(1) NOT NULL,
  `numHabitacions` int(2) NOT NULL,
  `numLavabos` int(2) NOT NULL,
  `users_users_uid` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pisos`
--

INSERT INTO `pisos` (`idPis`, `uidpis`, `tipus`, `numHabitacions`, `numLavabos`, `users_users_uid`) VALUES
(14, 'piso1', 1, 3, 2, 'admin'),
(15, 'piso2', 2, 4, 2, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idreservas` int(11) NOT NULL,
  `fechaSolicitud` datetime NOT NULL DEFAULT current_timestamp(),
  `pisos_idPis` int(5) NOT NULL,
  `users_users_uid` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idreservas`, `fechaSolicitud`, `pisos_idPis`, `users_users_uid`) VALUES
(2, '2024-07-19 12:50:04', 14, 'admin'),
(3, '2024-07-19 12:50:11', 14, 'admin'),
(4, '2024-07-19 12:50:14', 15, 'admin'),
(5, '2024-07-19 12:51:25', 14, 'admin'),
(6, '2024-07-19 12:51:27', 15, 'admin'),
(7, '2024-07-19 13:22:55', 14, 'admin'),
(8, '2024-07-19 13:22:56', 15, 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_uid` varchar(11) NOT NULL,
  `users_pwd` longtext NOT NULL,
  `users_email` tinytext NOT NULL,
  `cuentaActiva` tinyint(1) NOT NULL,
  `token` varchar(45) NOT NULL,
  `deadLine` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`users_id`, `users_uid`, `users_pwd`, `users_email`, `cuentaActiva`, `token`, `deadLine`) VALUES
(8, 'admin', '$2y$10$MdE.u62a3Zrrii9.TKSHNu52Xx/7M4ongZ6gtXifbVOsU4dpjJEqS', 'falso@gmail.com', 0, '', '2024-07-19 12:04:58'),
(7, 'profe', '$2y$10$PpHGP4rK.t.p3RY04/tzN.ScPrCIrwU3sPZyLErzdhz/N3k67QEVi', 'beluca.navarina@gmail.com', 0, '', '2024-07-19 12:04:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD PRIMARY KEY (`idPis`),
  ADD UNIQUE KEY `uidpis` (`uidpis`),
  ADD KEY `fk_pisos_users_idx1` (`users_users_uid`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idreservas`),
  ADD KEY `fk_reservas_pisos1_idx` (`pisos_idPis`),
  ADD KEY `fk_reservas_users1_idx` (`users_users_uid`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_uid`),
  ADD UNIQUE KEY `users_id_UNIQUE` (`users_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pisos`
--
ALTER TABLE `pisos`
  MODIFY `idPis` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idreservas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD CONSTRAINT `fk_pisos_users` FOREIGN KEY (`users_users_uid`) REFERENCES `users` (`users_uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_reservas_pisos1` FOREIGN KEY (`pisos_idPis`) REFERENCES `pisos` (`idPis`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservas_users1` FOREIGN KEY (`users_users_uid`) REFERENCES `users` (`users_uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
