-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-08-2022 a las 21:24:13
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
-- Base de datos: `tfm_django`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointments_appointment`
--

CREATE TABLE `appointments_appointment` (
  `id` bigint(20) NOT NULL,
  `date` datetime(6) NOT NULL,
  `annotations` longtext DEFAULT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  `pet_id` bigint(20) NOT NULL,
  `vet_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `appointments_appointment`
--

INSERT INTO `appointments_appointment` (`id`, `date`, `annotations`, `created_at`, `updated_at`, `pet_id`, `vet_id`) VALUES
(1, '2022-07-29 10:00:00.000000', 'Ha dejado de comer.', '2022-07-28 22:29:00.000000', '2022-07-28 22:29:00.000000', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_group`
--

CREATE TABLE `auth_group` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_group_permissions`
--

CREATE TABLE `auth_group_permissions` (
  `id` bigint(20) NOT NULL,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_permission`
--

CREATE TABLE `auth_permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content_type_id` int(11) NOT NULL,
  `codename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `auth_permission`
--

INSERT INTO `auth_permission` (`id`, `name`, `content_type_id`, `codename`) VALUES
(1, 'Can add log entry', 1, 'add_logentry'),
(2, 'Can change log entry', 1, 'change_logentry'),
(3, 'Can delete log entry', 1, 'delete_logentry'),
(4, 'Can view log entry', 1, 'view_logentry'),
(5, 'Can add permission', 2, 'add_permission'),
(6, 'Can change permission', 2, 'change_permission'),
(7, 'Can delete permission', 2, 'delete_permission'),
(8, 'Can view permission', 2, 'view_permission'),
(9, 'Can add group', 3, 'add_group'),
(10, 'Can change group', 3, 'change_group'),
(11, 'Can delete group', 3, 'delete_group'),
(12, 'Can view group', 3, 'view_group'),
(13, 'Can add content type', 4, 'add_contenttype'),
(14, 'Can change content type', 4, 'change_contenttype'),
(15, 'Can delete content type', 4, 'delete_contenttype'),
(16, 'Can view content type', 4, 'view_contenttype'),
(17, 'Can add session', 5, 'add_session'),
(18, 'Can change session', 5, 'change_session'),
(19, 'Can delete session', 5, 'delete_session'),
(20, 'Can view session', 5, 'view_session'),
(21, 'Can add user', 6, 'add_user'),
(22, 'Can change user', 6, 'change_user'),
(23, 'Can delete user', 6, 'delete_user'),
(24, 'Can view user', 6, 'view_user'),
(25, 'Can add Especie', 7, 'add_petspecies'),
(26, 'Can change Especie', 7, 'change_petspecies'),
(27, 'Can delete Especie', 7, 'delete_petspecies'),
(28, 'Can view Especie', 7, 'view_petspecies'),
(29, 'Can add Raza', 8, 'add_petrace'),
(30, 'Can change Raza', 8, 'change_petrace'),
(31, 'Can delete Raza', 8, 'delete_petrace'),
(32, 'Can view Raza', 8, 'view_petrace'),
(33, 'Can add Mascota', 9, 'add_pet'),
(34, 'Can change Mascota', 9, 'change_pet'),
(35, 'Can delete Mascota', 9, 'delete_pet'),
(36, 'Can view Mascota', 9, 'view_pet'),
(37, 'Can add Cita', 10, 'add_appointment'),
(38, 'Can change Cita', 10, 'change_appointment'),
(39, 'Can delete Cita', 10, 'delete_appointment'),
(40, 'Can view Cita', 10, 'view_appointment');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `django_admin_log`
--

CREATE TABLE `django_admin_log` (
  `id` int(11) NOT NULL,
  `action_time` datetime(6) NOT NULL,
  `object_id` longtext DEFAULT NULL,
  `object_repr` varchar(200) NOT NULL,
  `action_flag` smallint(5) UNSIGNED NOT NULL CHECK (`action_flag` >= 0),
  `change_message` longtext NOT NULL,
  `content_type_id` int(11) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `django_content_type`
--

CREATE TABLE `django_content_type` (
  `id` int(11) NOT NULL,
  `app_label` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `django_content_type`
--

INSERT INTO `django_content_type` (`id`, `app_label`, `model`) VALUES
(1, 'admin', 'logentry'),
(10, 'appointments', 'appointment'),
(3, 'auth', 'group'),
(2, 'auth', 'permission'),
(4, 'contenttypes', 'contenttype'),
(6, 'petclinic', 'user'),
(9, 'pets', 'pet'),
(8, 'pets', 'petrace'),
(7, 'pets', 'petspecies'),
(5, 'sessions', 'session');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `django_migrations`
--

CREATE TABLE `django_migrations` (
  `id` bigint(20) NOT NULL,
  `app` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `applied` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `django_migrations`
--

INSERT INTO `django_migrations` (`id`, `app`, `name`, `applied`) VALUES
(1, 'contenttypes', '0001_initial', '2022-08-24 19:20:25.807658'),
(2, 'contenttypes', '0002_remove_content_type_name', '2022-08-24 19:20:25.836659'),
(3, 'auth', '0001_initial', '2022-08-24 19:20:25.952891'),
(4, 'auth', '0002_alter_permission_name_max_length', '2022-08-24 19:20:25.978908'),
(5, 'auth', '0003_alter_user_email_max_length', '2022-08-24 19:20:25.985909'),
(6, 'auth', '0004_alter_user_username_opts', '2022-08-24 19:20:25.991910'),
(7, 'auth', '0005_alter_user_last_login_null', '2022-08-24 19:20:25.997913'),
(8, 'auth', '0006_require_contenttypes_0002', '2022-08-24 19:20:26.000914'),
(9, 'auth', '0007_alter_validators_add_error_messages', '2022-08-24 19:20:26.008912'),
(10, 'auth', '0008_alter_user_username_max_length', '2022-08-24 19:20:26.014909'),
(11, 'auth', '0009_alter_user_last_name_max_length', '2022-08-24 19:20:26.020920'),
(12, 'auth', '0010_alter_group_name_max_length', '2022-08-24 19:20:26.032908'),
(13, 'auth', '0011_update_proxy_permissions', '2022-08-24 19:20:26.041913'),
(14, 'auth', '0012_alter_user_first_name_max_length', '2022-08-24 19:20:26.053915'),
(15, 'petclinic', '0001_initial', '2022-08-24 19:20:26.236908'),
(16, 'admin', '0001_initial', '2022-08-24 19:20:26.295909'),
(17, 'admin', '0002_logentry_remove_auto_add', '2022-08-24 19:20:26.304938'),
(18, 'admin', '0003_logentry_add_action_flag_choices', '2022-08-24 19:20:26.311944'),
(19, 'pets', '0001_initial', '2022-08-24 19:20:26.415326'),
(20, 'appointments', '0001_initial', '2022-08-24 19:20:26.428318'),
(21, 'appointments', '0002_initial', '2022-08-24 19:20:26.510365'),
(22, 'sessions', '0001_initial', '2022-08-24 19:20:26.528367');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `django_session`
--

CREATE TABLE `django_session` (
  `session_key` varchar(40) NOT NULL,
  `session_data` longtext NOT NULL,
  `expire_date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `petclinic_user`
--

CREATE TABLE `petclinic_user` (
  `id` bigint(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `last_login` datetime(6) DEFAULT NULL,
  `is_superuser` tinyint(1) NOT NULL,
  `is_staff` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `date_joined` datetime(6) NOT NULL,
  `email` varchar(254) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `address` varchar(300) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `petclinic_user`
--

INSERT INTO `petclinic_user` (`id`, `password`, `last_login`, `is_superuser`, `is_staff`, `is_active`, `date_joined`, `email`, `first_name`, `last_name`, `address`, `birthday`) VALUES
(1, 'pbkdf2_sha256$260000$dLC6qvDWWCC09MfxSaTVnP$sggRzYE9sUuVMhqYwVBBVNnWVz8Dv0x0PfdYhl6ukEo=', '2022-07-29 15:41:38.631445', 1, 1, 1, '2022-07-28 22:00:51.000000', 'vet1@petclinic.com', 'Luis', 'González Carrasco', 'Plaza Naia, 135, 5º 4º', '1983-01-20'),
(2, 'pbkdf2_sha256$260000$C9GM2xbCATo6bGLCqjmMaT$nqmXECfSfLE+b+l5n/AFH8mKwjCZEU/U6yvUAeiGPEM=', NULL, 0, 0, 1, '2022-07-28 22:00:51.000000', 'customer1@petclinic.com', 'Pedro', 'Ramírez Díaz', 'Praza Ainara, 079, 81º B', '1984-02-24'),
(3, 'pbkdf2_sha256$260000$rRf46TBX5YdI4rwoeKDKkL$sc+mfrT1uSqB39vGrG9FV5wQwNW1VFFylSX7OmrhwwM=', NULL, 0, 0, 1, '2022-07-28 22:00:51.000000', 'customer2@petclinic.com', 'Jana', 'Nieves Tercero', 'Carrer Blázquez, 624, 2º D', '1990-05-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `petclinic_user_groups`
--

CREATE TABLE `petclinic_user_groups` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `petclinic_user_user_permissions`
--

CREATE TABLE `petclinic_user_user_permissions` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pets_pet`
--

CREATE TABLE `pets_pet` (
  `id` bigint(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `annotations` longtext DEFAULT NULL,
  `deceased` tinyint(1) NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  `owner_id` bigint(20) NOT NULL,
  `race_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pets_pet`
--

INSERT INTO `pets_pet` (`id`, `name`, `sex`, `birthday`, `annotations`, `deceased`, `created_at`, `updated_at`, `owner_id`, `race_id`) VALUES
(1, 'Firulais', 'M', '2019-09-26', 'Fue maltratado antes de su adopción.', 0, '2022-07-28 22:19:27.000000', '2022-07-28 22:19:27.000000', 2, 1),
(2, 'Aquiles', NULL, '2016-01-07', NULL, 0, '2022-07-28 22:19:54.000000', '2022-07-28 22:19:54.000000', 2, 11),
(3, 'Logan', 'M', '2020-10-14', NULL, 0, '2022-07-28 22:20:04.000000', '2022-07-28 22:20:04.000000', 3, 6),
(4, 'Manchas', 'F', '2021-06-09', NULL, 1, '2022-07-28 22:20:20.000000', '2022-07-28 22:20:20.000000', 3, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pets_petrace`
--

CREATE TABLE `pets_petrace` (
  `id` bigint(20) NOT NULL,
  `race` varchar(30) NOT NULL,
  `species_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pets_petrace`
--

INSERT INTO `pets_petrace` (`id`, `race`, `species_id`) VALUES
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
-- Estructura de tabla para la tabla `pets_petspecies`
--

CREATE TABLE `pets_petspecies` (
  `id` bigint(20) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pets_petspecies`
--

INSERT INTO `pets_petspecies` (`id`, `name`) VALUES
(3, 'Ave'),
(4, 'Conejo'),
(2, 'Gato'),
(1, 'Perro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `appointments_appointment`
--
ALTER TABLE `appointments_appointment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `appointments_appointment_vet_id_date_e0fb51ef_uniq` (`vet_id`,`date`),
  ADD KEY `appointments_appointment_pet_id_aee400a8_fk_pets_pet_id` (`pet_id`);

--
-- Indices de la tabla `auth_group`
--
ALTER TABLE `auth_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `auth_group_permissions_group_id_permission_id_0cd325b0_uniq` (`group_id`,`permission_id`),
  ADD KEY `auth_group_permissio_permission_id_84c5c92e_fk_auth_perm` (`permission_id`);

--
-- Indices de la tabla `auth_permission`
--
ALTER TABLE `auth_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `auth_permission_content_type_id_codename_01ab375a_uniq` (`content_type_id`,`codename`);

--
-- Indices de la tabla `django_admin_log`
--
ALTER TABLE `django_admin_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `django_admin_log_content_type_id_c4bce8eb_fk_django_co` (`content_type_id`),
  ADD KEY `django_admin_log_user_id_c564eba6_fk_petclinic_user_id` (`user_id`);

--
-- Indices de la tabla `django_content_type`
--
ALTER TABLE `django_content_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `django_content_type_app_label_model_76bd3d3b_uniq` (`app_label`,`model`);

--
-- Indices de la tabla `django_migrations`
--
ALTER TABLE `django_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `django_session`
--
ALTER TABLE `django_session`
  ADD PRIMARY KEY (`session_key`),
  ADD KEY `django_session_expire_date_a5c62663` (`expire_date`);

--
-- Indices de la tabla `petclinic_user`
--
ALTER TABLE `petclinic_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `petclinic_user_groups`
--
ALTER TABLE `petclinic_user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `petclinic_user_groups_user_id_group_id_5656d451_uniq` (`user_id`,`group_id`),
  ADD KEY `petclinic_user_groups_group_id_d48b7826_fk_auth_group_id` (`group_id`);

--
-- Indices de la tabla `petclinic_user_user_permissions`
--
ALTER TABLE `petclinic_user_user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `petclinic_user_user_perm_user_id_permission_id_1e8fbf60_uniq` (`user_id`,`permission_id`),
  ADD KEY `petclinic_user_user__permission_id_98588118_fk_auth_perm` (`permission_id`);

--
-- Indices de la tabla `pets_pet`
--
ALTER TABLE `pets_pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pets_pet_owner_id_ed468d8b_fk_petclinic_user_id` (`owner_id`),
  ADD KEY `pets_pet_race_id_e28d8389_fk_pets_petrace_id` (`race_id`);

--
-- Indices de la tabla `pets_petrace`
--
ALTER TABLE `pets_petrace`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pets_petrace_species_id_race_f37e003c_uniq` (`species_id`,`race`);

--
-- Indices de la tabla `pets_petspecies`
--
ALTER TABLE `pets_petspecies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `appointments_appointment`
--
ALTER TABLE `appointments_appointment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `auth_group`
--
ALTER TABLE `auth_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `auth_permission`
--
ALTER TABLE `auth_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `django_admin_log`
--
ALTER TABLE `django_admin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `django_content_type`
--
ALTER TABLE `django_content_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `django_migrations`
--
ALTER TABLE `django_migrations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `petclinic_user`
--
ALTER TABLE `petclinic_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `petclinic_user_groups`
--
ALTER TABLE `petclinic_user_groups`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `petclinic_user_user_permissions`
--
ALTER TABLE `petclinic_user_user_permissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pets_pet`
--
ALTER TABLE `pets_pet`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pets_petrace`
--
ALTER TABLE `pets_petrace`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pets_petspecies`
--
ALTER TABLE `pets_petspecies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appointments_appointment`
--
ALTER TABLE `appointments_appointment`
  ADD CONSTRAINT `appointments_appointment_pet_id_aee400a8_fk_pets_pet_id` FOREIGN KEY (`pet_id`) REFERENCES `pets_pet` (`id`),
  ADD CONSTRAINT `appointments_appointment_vet_id_edb5091c_fk_petclinic_user_id` FOREIGN KEY (`vet_id`) REFERENCES `petclinic_user` (`id`);

--
-- Filtros para la tabla `auth_group_permissions`
--
ALTER TABLE `auth_group_permissions`
  ADD CONSTRAINT `auth_group_permissio_permission_id_84c5c92e_fk_auth_perm` FOREIGN KEY (`permission_id`) REFERENCES `auth_permission` (`id`),
  ADD CONSTRAINT `auth_group_permissions_group_id_b120cbf9_fk_auth_group_id` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`);

--
-- Filtros para la tabla `auth_permission`
--
ALTER TABLE `auth_permission`
  ADD CONSTRAINT `auth_permission_content_type_id_2f476e4b_fk_django_co` FOREIGN KEY (`content_type_id`) REFERENCES `django_content_type` (`id`);

--
-- Filtros para la tabla `django_admin_log`
--
ALTER TABLE `django_admin_log`
  ADD CONSTRAINT `django_admin_log_content_type_id_c4bce8eb_fk_django_co` FOREIGN KEY (`content_type_id`) REFERENCES `django_content_type` (`id`),
  ADD CONSTRAINT `django_admin_log_user_id_c564eba6_fk_petclinic_user_id` FOREIGN KEY (`user_id`) REFERENCES `petclinic_user` (`id`);

--
-- Filtros para la tabla `petclinic_user_groups`
--
ALTER TABLE `petclinic_user_groups`
  ADD CONSTRAINT `petclinic_user_groups_group_id_d48b7826_fk_auth_group_id` FOREIGN KEY (`group_id`) REFERENCES `auth_group` (`id`),
  ADD CONSTRAINT `petclinic_user_groups_user_id_bea51154_fk_petclinic_user_id` FOREIGN KEY (`user_id`) REFERENCES `petclinic_user` (`id`);

--
-- Filtros para la tabla `petclinic_user_user_permissions`
--
ALTER TABLE `petclinic_user_user_permissions`
  ADD CONSTRAINT `petclinic_user_user__permission_id_98588118_fk_auth_perm` FOREIGN KEY (`permission_id`) REFERENCES `auth_permission` (`id`),
  ADD CONSTRAINT `petclinic_user_user__user_id_bd715561_fk_petclinic` FOREIGN KEY (`user_id`) REFERENCES `petclinic_user` (`id`);

--
-- Filtros para la tabla `pets_pet`
--
ALTER TABLE `pets_pet`
  ADD CONSTRAINT `pets_pet_owner_id_ed468d8b_fk_petclinic_user_id` FOREIGN KEY (`owner_id`) REFERENCES `petclinic_user` (`id`),
  ADD CONSTRAINT `pets_pet_race_id_e28d8389_fk_pets_petrace_id` FOREIGN KEY (`race_id`) REFERENCES `pets_petrace` (`id`);

--
-- Filtros para la tabla `pets_petrace`
--
ALTER TABLE `pets_petrace`
  ADD CONSTRAINT `pets_petrace_species_id_1224b153_fk_pets_petspecies_id` FOREIGN KEY (`species_id`) REFERENCES `pets_petspecies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
