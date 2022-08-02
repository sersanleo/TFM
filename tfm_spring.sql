-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-08-2022 a las 17:30:14
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tfm_spring`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointment`
--

CREATE TABLE `appointment` (
  `id` bigint(20) NOT NULL,
  `annotations` longtext DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `date` datetime(6) NOT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `pet_id` bigint(20) NOT NULL,
  `vet_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `appointment`
--

INSERT INTO `appointment` (`id`, `annotations`, `created_at`, `date`, `updated_at`, `pet_id`, `vet_id`) VALUES
(1, 'Ha dejado de comer.', '2022-07-28 22:29:00.000000', '2022-07-29 10:00:00.000000', '2022-07-28 22:29:00.000000', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flyway_schema_history`
--

CREATE TABLE `flyway_schema_history` (
  `installed_rank` int(11) NOT NULL,
  `version` varchar(50) DEFAULT NULL,
  `description` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  `script` varchar(1000) NOT NULL,
  `checksum` int(11) DEFAULT NULL,
  `installed_by` varchar(100) NOT NULL,
  `installed_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `execution_time` int(11) NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `flyway_schema_history`
--

INSERT INTO `flyway_schema_history` (`installed_rank`, `version`, `description`, `type`, `script`, `checksum`, `installed_by`, `installed_on`, `execution_time`, `success`) VALUES
(1, '1', 'Init', 'SQL', 'V1__Init.sql', 1498132239, 'root', '2022-07-28 19:19:51', 145, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet`
--

CREATE TABLE `pet` (
  `id` bigint(20) NOT NULL,
  `annotations` longtext DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `created_at` datetime(6) DEFAULT NULL,
  `deceased` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(30) NOT NULL,
  `sex` int(11) DEFAULT NULL,
  `updated_at` datetime(6) DEFAULT NULL,
  `owner_id` bigint(20) NOT NULL,
  `race_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pet`
--

INSERT INTO `pet` (`id`, `annotations`, `birthday`, `created_at`, `deceased`, `name`, `sex`, `updated_at`, `owner_id`, `race_id`) VALUES
(1, 'Fue maltratado antes de su adopción.', '2019-09-26', '2022-07-28 22:19:27.000000', 0, 'Firulais', 0, '2022-07-28 22:19:27.000000', 2, 1),
(2, NULL, '2016-01-07', '2022-07-28 22:19:54.000000', 0, 'Aquiles', NULL, '2022-07-28 22:19:54.000000', 2, 11),
(3, NULL, '2020-10-14', '2022-07-28 22:20:04.000000', 0, 'Logan', 0, '2022-07-28 22:20:04.000000', 3, 6),
(4, NULL, '2021-06-09', '2022-07-28 22:20:20.000000', 1, 'Manchas', 1, '2022-07-28 22:20:20.000000', 3, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet_race`
--

CREATE TABLE `pet_race` (
  `id` bigint(20) NOT NULL,
  `race` varchar(30) NOT NULL,
  `species_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pet_race`
--

INSERT INTO `pet_race` (`id`, `race`, `species_id`) VALUES
(1, 'Chihuahua', 1),
(2, 'Husky', 1),
(3, 'Labrador Retriever', 1),
(4, 'Yorkshire', 1),
(5, 'Persa', 2),
(6, 'Siamés', 2),
(7, 'Agaporni', 3),
(8, 'Cacatúa', 3),
(9, 'Loro', 3),
(10, 'Ninfa', 3),
(11, 'Periquito', 3),
(12, 'Belier', 4),
(13, 'Toy', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet_species`
--

CREATE TABLE `pet_species` (
  `id` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pet_species`
--

INSERT INTO `pet_species` (`id`, `name`) VALUES
(3, 'Ave'),
(4, 'Conejo'),
(2, 'Gato'),
(1, 'Perro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `address` varchar(300) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_staff` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `address`, `birthday`, `email`, `password`, `is_staff`) VALUES
(1, 'Luis', 'González Carrasco', 'Plaza Naia, 135, 5º 4º', '1983-01-20', 'vet1@petclinic.com', '$2a$10$m15q8.57ZcHsTSD0nZMXnelA4VUGlfOUJJSC5OETWb.13gYyL2OqW', 1),
(2, 'Pedro', 'Ramírez Díaz', 'Praza Ainara, 079, 81º B', '1984-02-24', 'customer1@petclinic.com', '$2a$10$wWXXxeSeyn.Yi3qTSamYVu/vhR5iUowmZMyhzheoE6wWHFa0AwNMm', 0),
(3, 'Jana', 'Nieves Tercero', 'Carrer Blázquez, 624, 2º D', '1990-05-14', 'customer2@petclinic.com', '$2a$10$wzk0KnPrGzYdx1jXbsBsh.46tRKoNMZd8V2XsLb.D3bVChL/oJnqy', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK9ttaa6se6wl6gehdooo6cqxr2` (`vet_id`,`date`),
  ADD KEY `FK8y0it8yrd322ps2jklm5f8e07` (`pet_id`),
  ADD KEY `FKbidbah9ubxvfd66a82hql55de` (`vet_id`);

--
-- Indices de la tabla `flyway_schema_history`
--
ALTER TABLE `flyway_schema_history`
  ADD PRIMARY KEY (`installed_rank`),
  ADD KEY `flyway_schema_history_s_idx` (`success`);

--
-- Indices de la tabla `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKmhl50mj70o9satgguimxjold1` (`owner_id`),
  ADD KEY `FKnsbnumvje8y87vp80n47ia058` (`race_id`);

--
-- Indices de la tabla `pet_race`
--
ALTER TABLE `pet_race`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UKgcne1pllj523oyn8nifjn8hc2` (`species_id`,`race`);

--
-- Indices de la tabla `pet_species`
--
ALTER TABLE `pet_species`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_513lv2t141tl0pieqov4vxlgf` (`name`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_ob8kqyqqgmefl0aco34akdtpe` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pet`
--
ALTER TABLE `pet`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pet_race`
--
ALTER TABLE `pet_race`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pet_species`
--
ALTER TABLE `pet_species`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `FK8y0it8yrd322ps2jklm5f8e07` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`id`),
  ADD CONSTRAINT `FKbidbah9ubxvfd66a82hql55de` FOREIGN KEY (`vet_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `FKmhl50mj70o9satgguimxjold1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FKnsbnumvje8y87vp80n47ia058` FOREIGN KEY (`race_id`) REFERENCES `pet_race` (`id`);

--
-- Filtros para la tabla `pet_race`
--
ALTER TABLE `pet_race`
  ADD CONSTRAINT `FKc5mhu0y2p8vbkdsbu3wxg6yfu` FOREIGN KEY (`species_id`) REFERENCES `pet_species` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
