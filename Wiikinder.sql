-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2021 at 09:03 AM
-- Server version: 8.0.27-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Wiikinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `amigos`
--

CREATE TABLE `amigos` (
  `correo1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amigos`
--

INSERT INTO `amigos` (`correo1`, `correo2`, `created_at`, `updated_at`) VALUES
('alvaro@gmail.com', 'lauramorenoramos97@gmail.com', '2021-12-15 16:19:47', '2021-12-15 16:19:47'),
('alvaro@gmail.com', 'malena@gmail.com', NULL, NULL),
('lauramorenoramos97@gmail.com', 'alvaro@gmail.com', '2021-12-15 16:19:47', '2021-12-15 16:19:47'),
('malena@gmail.com', 'alvaro@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conjuntos`
--

CREATE TABLE `conjuntos` (
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_rol` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conjuntos`
--

INSERT INTO `conjuntos` (`correo`, `id_rol`, `created_at`, `updated_at`) VALUES
('admin@gmail.com', 1, '2021-12-15 10:00:36', '2021-12-15 10:00:36'),
('alvaro@gmail.com', 2, '2021-12-15 08:14:55', '2021-12-15 08:14:55'),
('carlos@gmail.com', 2, '2021-12-15 08:26:19', '2021-12-15 08:26:19'),
('lauramorenoramos97@gmail.com', 2, '2021-12-15 08:06:09', '2021-12-15 08:06:09'),
('lorenzo@gmail.com', 2, '2021-12-15 08:11:43', '2021-12-15 08:11:43'),
('malena@gmail.com', 2, '2021-12-15 08:07:23', '2021-12-15 08:07:23'),
('nica@gmail.com', 2, '2021-12-15 08:09:28', '2021-12-15 08:09:28'),
('wqdw@gmail.com', 1, '2021-12-15 11:15:44', '2021-12-15 11:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `diferencias`
--

CREATE TABLE `diferencias` (
  `correo1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diferencia` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diferencias`
--

INSERT INTO `diferencias` (`correo1`, `correo2`, `diferencia`, `created_at`, `updated_at`) VALUES
('admin@gmail.com', 'alvaro@gmail.com', 321, '2021-12-15 10:01:03', '2021-12-15 10:01:03'),
('admin@gmail.com', 'carlos@gmail.com', 419, '2021-12-15 10:01:03', '2021-12-15 10:01:03'),
('admin@gmail.com', 'lorenzo@gmail.com', 704, '2021-12-15 10:01:03', '2021-12-15 10:01:03'),
('alvaro@gmail.com', 'lauramorenoramos97@gmail.com', 270, '2021-12-15 08:15:18', '2021-12-15 08:15:18'),
('alvaro@gmail.com', 'malena@gmail.com', 498, '2021-12-15 08:15:18', '2021-12-15 08:15:18'),
('carlos@gmail.com', 'lauramorenoramos97@gmail.com', 107, '2021-12-15 08:26:19', '2021-12-15 08:26:19'),
('carlos@gmail.com', 'malena@gmail.com', 204, '2021-12-15 08:26:19', '2021-12-15 08:26:19'),
('malena@gmail.com', 'lauramorenoramos97@gmail.com', -148, '2021-12-15 08:07:45', '2021-12-15 08:07:45'),
('nica@gmail.com', 'lauramorenoramos97@gmail.com', 41, '2021-12-15 08:10:43', '2021-12-15 08:10:43'),
('nica@gmail.com', 'malena@gmail.com', 74, '2021-12-15 08:10:43', '2021-12-15 08:10:43'),
('wqdw@gmail.com', 'alvaro@gmail.com', 261, '2021-12-15 11:15:44', '2021-12-15 11:15:44'),
('wqdw@gmail.com', 'carlos@gmail.com', 373, '2021-12-15 11:15:44', '2021-12-15 11:15:44'),
('wqdw@gmail.com', 'lorenzo@gmail.com', 598, '2021-12-15 11:15:44', '2021-12-15 11:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `generos`
--

CREATE TABLE `generos` (
  `id` bigint UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generos`
--

INSERT INTO `generos` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Hombre', '2021-11-30 12:26:19', '2021-11-30 12:26:19'),
(2, 'Mujer', '2021-11-30 12:26:37', '2021-11-30 12:26:37'),
(3, 'Ambos', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gusto_genero`
--

CREATE TABLE `gusto_genero` (
  `id` bigint UNSIGNED NOT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gusto_genero`
--

INSERT INTO `gusto_genero` (`id`, `correo`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '2021-12-15 10:01:03', '2021-12-15 10:01:03'),
(2, 'alvaro@gmail.com', '2021-12-15 08:15:18', '2021-12-15 08:15:18'),
(2, 'carlos@gmail.com', '2021-12-15 08:26:19', '2021-12-15 08:26:19'),
(1, 'lauramorenoramos97@gmail.com', '2021-12-15 08:06:44', '2021-12-15 08:06:44'),
(1, 'lorenzo@gmail.com', '2021-12-15 08:12:21', '2021-12-15 08:12:21'),
(2, 'malena@gmail.com', '2021-12-15 08:07:45', '2021-12-15 08:07:45'),
(3, 'nica@gmail.com', '2021-12-15 08:10:43', '2021-12-15 08:10:43'),
(1, 'wqdw@gmail.com', '2021-12-15 11:15:44', '2021-12-15 11:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_11_30_094805_persona', 1),
(2, '2021_11_30_100334_rol', 2),
(3, '2021_11_30_100342_conjunto', 3),
(4, '2021_11_30_114658_gusto_genero', 4),
(5, '2021_12_01_082939_preferencias', 5),
(6, '2021_12_01_082959_preferencias_persona', 6),
(7, '2021_12_01_083054_diferencias', 7),
(8, '2021_12_07_201703_amigo', 8),
(9, '2021_12_07_201722_peticion', 9),
(10, '2021_12_08_110056_amigo', 10);

-- --------------------------------------------------------

--
-- Table structure for table `personas`
--

CREATE TABLE `personas` (
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edad` int NOT NULL,
  `ciudad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conectado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_genero` bigint UNSIGNED NOT NULL,
  `tieneHijos` tinyint(1) NOT NULL,
  `tipoRelaccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hijosDeseados` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personas`
--

INSERT INTO `personas` (`correo`, `nombre`, `nick`, `password`, `edad`, `ciudad`, `descripcion`, `tema`, `foto`, `activo`, `conectado`, `id_genero`, `tieneHijos`, `tipoRelaccion`, `hijosDeseados`, `created_at`, `updated_at`) VALUES
('admin@gmail.com', 'Administrador', 'Admin', 'Admin888', 24, 'Puertollano', 'Soy la Administradora', 'claro', './public/ImagenesPerfil', 'si', 'si', 2, 0, 'Amistad', 0, '2021-12-15 10:00:36', '2021-12-15 11:04:54'),
('alvaro@gmail.com', 'Alvaro', 'Alvariño', 'Alvaro888', 21, 'Puertollano', 'Hola soy Alvaro', 'claro', './public/ImagenesPerfil', 'si', 'si', 1, 0, 'Seria', 2, '2021-12-15 08:14:55', '2021-12-16 06:48:26'),
('carlos@gmail.com', 'Carlos', 'Carl', 'Carlos888', 56, 'Albacete', '¿Donde estoy?', 'claro', './public/ImagenesPerfil', 'no', 'no', 1, 0, 'Amistad', 2, '2021-12-15 08:26:19', '2021-12-15 08:26:19'),
('lauramorenoramos97@gmail.com', 'Laura', 'Abril', 'Laura888', 24, 'Puertollano', 'Hola soy laura', 'oscuro', './public/ImagenesPerfil', 'si', 'si', 2, 0, 'Amistad', 0, '2021-12-15 08:06:09', '2021-12-15 16:19:37'),
('lorenzo@gmail.com', 'Lorenzo', 'Loren', 'Lorenzo888', 25, 'Tarragona', 'Hola soy LOrenzo', 'claro', './public/ImagenesPerfil', 'no', 'no', 1, 0, 'Seria', 5, '2021-12-15 08:11:43', '2021-12-15 08:12:21'),
('malena@gmail.com', 'Malena', 'Malena', 'Malena888', 21, 'Almodovar', 'Hola soy Malena', 'claro', './public/ImagenesPerfil', 'si', 'si', 2, 0, 'Amistad', 0, '2021-12-15 08:07:23', '2021-12-15 16:12:27'),
('nica@gmail.com', 'Nica', 'Nika', 'Nicaela888', 25, 'Valencia', 'Hola soy Nicaela', 'claro', './public/ImagenesPerfil', 'si', 'si', 3, 0, 'Amistad', 2, '2021-12-15 08:09:28', '2021-12-15 08:16:10'),
('wqdw@gmail.com', 'saf', 'sad', 'xEk9YrknDxYJcnr', 34, 'dfs', 'dsfd', 'claro', './public/ImagenesPerfil', 'no', 'no', 1, 0, 'Amistad', 3, '2021-12-15 11:15:44', '2021-12-15 11:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `peticiones`
--

CREATE TABLE `peticiones` (
  `correo_origen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_destino` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peticiones`
--

INSERT INTO `peticiones` (`correo_origen`, `correo_destino`, `created_at`, `updated_at`) VALUES
('nica@gmail.com', 'alvaro@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `preferencias`
--

CREATE TABLE `preferencias` (
  `id` bigint UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preferencias`
--

INSERT INTO `preferencias` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Deporte', '2021-12-01 08:29:19', '2021-12-01 08:29:19'),
(2, 'Arte', '2021-12-01 08:29:31', '2021-12-01 08:29:31'),
(3, 'Politica', '2021-12-01 08:29:36', '2021-12-01 08:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `preferencias_persona`
--

CREATE TABLE `preferencias_persona` (
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_preferencia` bigint UNSIGNED NOT NULL,
  `intensidad` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preferencias_persona`
--

INSERT INTO `preferencias_persona` (`correo`, `id_preferencia`, `intensidad`, `created_at`, `updated_at`) VALUES
('admin@gmail.com', 1, 56, '2021-12-15 10:01:03', '2021-12-15 10:01:03'),
('admin@gmail.com', 2, 25, '2021-12-15 10:01:03', '2021-12-15 10:01:03'),
('admin@gmail.com', 3, 10, '2021-12-15 10:01:03', '2021-12-15 10:01:03'),
('alvaro@gmail.com', 1, 25, '2021-12-15 08:15:18', '2021-12-15 08:15:18'),
('alvaro@gmail.com', 2, 48, '2021-12-15 08:15:18', '2021-12-15 08:15:18'),
('alvaro@gmail.com', 3, 77, '2021-12-15 08:15:18', '2021-12-15 08:15:18'),
('carlos@gmail.com', 1, 52, '2021-12-15 08:26:19', '2021-12-15 08:26:19'),
('carlos@gmail.com', 2, 10, '2021-12-15 08:26:19', '2021-12-15 08:26:19'),
('carlos@gmail.com', 3, 89, '2021-12-15 08:26:19', '2021-12-15 08:26:19'),
('lauramorenoramos97@gmail.com', 1, 45, '2021-12-15 08:06:44', '2021-12-15 08:06:44'),
('lauramorenoramos97@gmail.com', 2, 54, '2021-12-15 08:06:44', '2021-12-15 08:06:44'),
('lauramorenoramos97@gmail.com', 3, 33, '2021-12-15 08:06:44', '2021-12-15 08:06:44'),
('lorenzo@gmail.com', 1, 25, '2021-12-15 08:12:21', '2021-12-15 08:12:21'),
('lorenzo@gmail.com', 2, 45, '2021-12-15 08:12:21', '2021-12-15 08:12:21'),
('lorenzo@gmail.com', 3, 44, '2021-12-15 08:12:21', '2021-12-15 08:12:21'),
('malena@gmail.com', 1, 24, '2021-12-15 08:07:45', '2021-12-15 08:07:45'),
('malena@gmail.com', 2, 44, '2021-12-15 08:07:45', '2021-12-15 08:07:45'),
('malena@gmail.com', 3, 54, '2021-12-15 08:07:45', '2021-12-15 08:07:45'),
('nica@gmail.com', 1, 24, '2021-12-15 08:10:43', '2021-12-15 08:10:43'),
('nica@gmail.com', 2, 45, '2021-12-15 08:10:43', '2021-12-15 08:10:43'),
('nica@gmail.com', 3, 22, '2021-12-15 08:10:43', '2021-12-15 08:10:43'),
('wqdw@gmail.com', 1, 34, '2021-12-15 11:15:44', '2021-12-15 11:15:44'),
('wqdw@gmail.com', 2, 44, '2021-12-15 11:15:44', '2021-12-15 11:15:44'),
('wqdw@gmail.com', 3, 29, '2021-12-15 11:15:44', '2021-12-15 11:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id` bigint UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2021-11-30 12:25:57', '2021-11-30 12:25:57'),
(2, 'User', '2021-11-30 12:26:02', '2021-11-30 12:26:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`correo1`,`correo2`),
  ADD KEY `amigos_correo2_foreign` (`correo2`);

--
-- Indexes for table `conjuntos`
--
ALTER TABLE `conjuntos`
  ADD PRIMARY KEY (`correo`,`id_rol`),
  ADD KEY `conjuntos_id_rol_foreign` (`id_rol`);

--
-- Indexes for table `diferencias`
--
ALTER TABLE `diferencias`
  ADD PRIMARY KEY (`correo1`,`correo2`),
  ADD KEY `diferencia_correo2_foreign` (`correo2`);

--
-- Indexes for table `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gusto_genero`
--
ALTER TABLE `gusto_genero`
  ADD PRIMARY KEY (`correo`,`id`),
  ADD KEY `gusto_genero_id_foreign` (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`correo`),
  ADD KEY `personas_id_genero_index` (`id_genero`);

--
-- Indexes for table `peticiones`
--
ALTER TABLE `peticiones`
  ADD PRIMARY KEY (`correo_origen`,`correo_destino`),
  ADD KEY `peticiones_correo_destino_foreign` (`correo_destino`);

--
-- Indexes for table `preferencias`
--
ALTER TABLE `preferencias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferencias_persona`
--
ALTER TABLE `preferencias_persona`
  ADD PRIMARY KEY (`correo`,`id_preferencia`),
  ADD KEY `preferencias_persona_id_preferencia_foreign` (`id_preferencia`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `generos`
--
ALTER TABLE `generos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `preferencias`
--
ALTER TABLE `preferencias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `amigos_correo1_foreign` FOREIGN KEY (`correo1`) REFERENCES `personas` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `amigos_correo2_foreign` FOREIGN KEY (`correo2`) REFERENCES `personas` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conjuntos`
--
ALTER TABLE `conjuntos`
  ADD CONSTRAINT `conjuntos_correo_foreign` FOREIGN KEY (`correo`) REFERENCES `personas` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `conjuntos_id_rol_foreign` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diferencias`
--
ALTER TABLE `diferencias`
  ADD CONSTRAINT `diferencia_correo1_foreign` FOREIGN KEY (`correo1`) REFERENCES `personas` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `diferencia_correo2_foreign` FOREIGN KEY (`correo2`) REFERENCES `personas` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gusto_genero`
--
ALTER TABLE `gusto_genero`
  ADD CONSTRAINT `gusto_genero_correo_foreign` FOREIGN KEY (`correo`) REFERENCES `personas` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gusto_genero_id_foreign` FOREIGN KEY (`id`) REFERENCES `generos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_id_genero_foreign` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peticiones`
--
ALTER TABLE `peticiones`
  ADD CONSTRAINT `peticiones_correo_destino_foreign` FOREIGN KEY (`correo_destino`) REFERENCES `personas` (`correo`) ON DELETE CASCADE,
  ADD CONSTRAINT `peticiones_correo_origen_foreign` FOREIGN KEY (`correo_origen`) REFERENCES `personas` (`correo`) ON DELETE CASCADE;

--
-- Constraints for table `preferencias_persona`
--
ALTER TABLE `preferencias_persona`
  ADD CONSTRAINT `preferencias_persona_correo_foreign` FOREIGN KEY (`correo`) REFERENCES `personas` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preferencias_persona_id_preferencia_foreign` FOREIGN KEY (`id_preferencia`) REFERENCES `preferencias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
