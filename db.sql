-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para gestionemergencias
CREATE DATABASE IF NOT EXISTS `gestionemergencias` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `gestionemergencias`;

-- Volcando estructura para tabla gestionemergencias.ambulance
CREATE TABLE IF NOT EXISTS `ambulance` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `number_plate` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `conductor_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ambulance_conductor_id_foreign` (`conductor_id`),
  CONSTRAINT `ambulance_conductor_id_foreign` FOREIGN KEY (`conductor_id`) REFERENCES `conductor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.ambulance: ~6 rows (aproximadamente)
INSERT INTO `ambulance` (`id`, `number_plate`, `color`, `model`, `code`, `conductor_id`, `created_at`, `updated_at`) VALUES
	(1, '1234 ABC', 'Azul', 'Ford Fiesta', '#A123', 5, '2024-01-17 20:19:18', '2024-01-18 01:04:51'),
	(2, '4321', 'Rojo', 'Ford Fiesta', '#B123', 3, '2024-01-17 20:19:18', '2024-01-17 20:19:18'),
	(3, '3456', 'Rojo', 'Ford Fiesta', '#C123', 1, '2024-01-17 20:19:18', '2024-01-17 20:19:18'),
	(4, '6543', 'Rojo', 'Ford Fiesta', '#D12345', 1, '2024-01-17 20:19:18', '2024-01-17 20:19:18'),
	(5, '7890', 'Rojo', 'Ford Fiesta', '#E12345', 5, '2024-01-17 20:19:18', '2024-01-17 20:19:18'),
	(7, '5422 DHL', 'Verde', 'Ford Fiesta', '#9DA76', 5, '2024-01-18 01:08:29', '2024-01-18 01:08:29');

-- Volcando estructura para tabla gestionemergencias.calls
CREATE TABLE IF NOT EXISTS `calls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_call` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.calls: ~4 rows (aproximadamente)
INSERT INTO `calls` (`id`, `code`, `full_name`, `address`, `phone`, `type_of_call`, `description`, `institution`, `created_at`, `updated_at`) VALUES
	(2, '#A4213', 'Armando Barreda', 'Av. Los Alamos', '77867431', 'Emergencia', 'Emergencia', NULL, '2024-01-17 14:04:46', '2024-01-17 18:43:53'),
	(3, '#A4213', 'Armando Barreda', 'Av. Los Alamos', '77867431', 'Emergencia', 'Emergencia', NULL, '2024-01-17 14:04:46', '2024-01-17 18:43:53'),
	(4, '#A4213', 'Armando Barreda', 'Av. Los Alamos', '77867431', 'Emergencia', 'Emergencia', NULL, '2024-01-17 14:04:46', '2024-01-17 18:43:53'),
	(5, '#5EBD0', 'Carlos Sanchez', 'Av. Los Andes', '77867431', 'Emergencia', 'Ocurrio una emergencia!', NULL, '2024-01-17 18:59:30', '2024-01-17 18:59:30');

-- Volcando estructura para tabla gestionemergencias.conductor
CREATE TABLE IF NOT EXISTS `conductor` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ci` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `licen` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.conductor: ~4 rows (aproximadamente)
INSERT INTO `conductor` (`id`, `full_name`, `ci`, `licen`, `photo`, `created_at`, `updated_at`) VALUES
	(1, 'Armando', '1414141414', '1010101010', 'conductor_photos/CiS5ZYOkt2uywASmIPLVDsYc9ee2W2PM0WNKzdYr.png', '2023-12-17 16:00:27', '2024-01-17 16:00:28'),
	(2, 'Carlos', '1515151515', '1111111111', 'conductor_photos/CiS5ZYOkt2uywASmIPLVDsYc9ee2W2PM0WNKzdYr.png', '2024-01-17 16:00:27', '2024-01-17 16:00:28'),
	(3, 'Bernardo', '1616161616', '1212121212', 'conductor_photos/CiS5ZYOkt2uywASmIPLVDsYc9ee2W2PM0WNKzdYr.png', '2024-01-17 16:00:27', '2024-01-17 16:00:28'),
	(5, 'Juan Carlos Medina', '1717171717', '1313131313', 'conductor_photos/neqE6Voo5av7w4MCJdbV83S4MXqcqlPpYkdUYg7R.png', '2024-01-17 20:21:50', '2024-01-17 20:38:31');

-- Volcando estructura para tabla gestionemergencias.dispatch
CREATE TABLE IF NOT EXISTS `dispatch` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `ambulance_id` bigint unsigned NOT NULL,
  `latitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_autizacion` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dispatch_ambulance_id_foreign` (`ambulance_id`),
  CONSTRAINT `dispatch_ambulance_id_foreign` FOREIGN KEY (`ambulance_id`) REFERENCES `ambulance` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.dispatch: ~1 rows (aproximadamente)
INSERT INTO `dispatch` (`id`, `date`, `ambulance_id`, `latitude`, `longitude`, `code_autizacion`, `created_at`, `updated_at`) VALUES
	(2, '2024-01-24', 1, '-17.391453970384774', '-66.24881020531006', '#34C298AD', '2024-01-18 02:06:32', '2024-01-18 02:23:08');

-- Volcando estructura para tabla gestionemergencias.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gestionemergencias.hospital
CREATE TABLE IF NOT EXISTS `hospital` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `statu` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.hospital: ~7 rows (aproximadamente)
INSERT INTO `hospital` (`id`, `name`, `level`, `statu`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
	(2, 'Hospital General', '1er nivel', '0', '-123', '-123', '2024-01-22 15:42:00', '2024-01-22 15:42:01'),
	(3, 'Hospital de Clinicas', '3er nivel', '1', '-123', '-123', '2024-01-22 15:42:00', '2024-01-22 15:42:01'),
	(4, 'Hospital del Niño', '2do nivel', '0', '-123', '-123', '2024-01-22 15:42:00', '2024-01-22 15:42:01'),
	(5, 'Hospital de la Mujer', '3er nivel', '1', '-123', '-123', '2024-01-22 15:42:00', '2024-01-22 15:42:01'),
	(6, 'Hospital La Paz', '4to nivel', '1', '-20.314650032421834', '-64.4557371334754', '2024-01-22 15:42:00', '2024-01-24 00:23:29'),
	(7, 'tests', '1er nivel', '0', '-17.391003481704992', '-66.2485097979004', '2024-01-24 00:31:19', '2024-01-24 00:32:14'),
	(9, 'test', '1er nivel', '0', '-17.395831844499607', '-66.24868145927735', '2024-01-24 00:33:00', '2024-01-24 00:33:00');

-- Volcando estructura para tabla gestionemergencias.incidents
CREATE TABLE IF NOT EXISTS `incidents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nature` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` bigint unsigned NOT NULL,
  `evidence` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incidents_patient_id_foreign` (`patient_id`),
  CONSTRAINT `incidents_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.incidents: ~3 rows (aproximadamente)
INSERT INTO `incidents` (`id`, `nature`, `latitude`, `longitude`, `description`, `type`, `patient_id`, `evidence`, `details`, `created_at`, `updated_at`) VALUES
	(22, 'test1', '-17.390368700318692', '-66.2490676973755', 'test1', 'Incidente', 20, 'evidence/bwIY3iSiCNJEK4uwLw2OyjWNcQ6pERJRxQLn1ObX.png', 'test1', '2024-01-23 22:47:28', '2024-01-23 22:47:28'),
	(23, 'test3', '-17.388566728253505', '-66.24709359154053', 'test3', 'Incidente 1', 22, 'evidence/iIWzXGxRlqA4FZHBfesAYHLK7YkNYzrH5OVQk2r6.png', 'test3', '2024-01-23 22:51:03', '2024-01-23 22:51:03'),
	(24, 'test5', '-17.390942051344517', '-66.24469033226319', 'test5', 'Accidente', 24, 'evidence/Uh7yQhpEjWT91GCMS1B15NuenvkhrWLRSxC0W08o.png', 'test5', '2024-01-23 22:54:55', '2024-01-23 22:54:55');

-- Volcando estructura para tabla gestionemergencias.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.migrations: ~16 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2018_08_08_100000_create_telescope_entries_table', 1),
	(4, '2019_08_19_000000_create_failed_jobs_table', 1),
	(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(6, '2024_01_09_134832_create_permission_tables', 1),
	(7, '2024_01_09_141434_create_patient_table', 1),
	(8, '2024_01_09_141700_create_incidents_table', 1),
	(9, '2024_01_16_193402_create_calls_table', 2),
	(10, '2024_01_16_194408_create_conductor_table', 2),
	(11, '2024_01_17_185200_create_ambulance_table', 3),
	(12, '2024_01_17_185628_create_dispatch_table', 3),
	(13, '2024_01_22_092425_create_hospital_table', 4),
	(14, '2024_01_22_093918_create_pages_table', 4),
	(15, '2024_01_22_094155_create_response_table', 4),
	(16, '2024_01_22_174825_page_role', 5);

-- Volcando estructura para tabla gestionemergencias.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.model_has_permissions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gestionemergencias.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.model_has_roles: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gestionemergencias.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.pages: ~53 rows (aproximadamente)
INSERT INTO `pages` (`id`, `page`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(2, 'users.index', 'Listado de usuarios', 'Listado de usuarios', '2024-01-22 17:46:09', '2024-01-24 16:58:49'),
	(3, 'users.create', 'Registrar usuario', 'Registrar usuario', '2024-01-22 17:52:15', '2024-01-22 17:52:15'),
	(5, 'users.show', 'Ver usuario', 'Ver usuario', '2024-01-23 21:38:13', '2024-01-23 21:38:14'),
	(6, 'users.edit', 'Editar usuario', 'Editar usuario', '2024-01-23 21:43:28', '2024-01-23 21:43:29'),
	(8, 'users.destroy', 'Eliminar usuarios', 'Eliminar usuarios', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(9, 'patient.index', 'Listado de pacientes', 'Listado de pacientes', '2024-01-23 22:10:42', '2024-01-24 15:12:54'),
	(10, 'patient.create', 'Registrar paciente', 'Registrar paciente', '2024-01-23 22:10:42', '2024-01-24 15:13:07'),
	(11, 'patient.show', 'Ver paciente', 'Ver paciente', '2024-01-23 22:10:42', '2024-01-24 15:13:25'),
	(12, 'patient.edit', 'Editar paciente', 'Editar paciente', '2024-01-23 22:10:42', '2024-01-24 15:13:45'),
	(13, 'patient.destroy', 'Eliminar paciente', 'Eliminar paciente', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(14, 'incident.index', 'Listado de incidentes', 'Listado de incidentes', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(15, 'incident.create', 'Registro de incidentes', 'Registro de incidentes', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(16, 'incident.show', 'Ver incidente', 'Ver incidente', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(17, 'incident.edit', 'Editar incidente', 'Editar incidente', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(18, 'incident.destroy', 'Eliminar incidente', 'Eliminar incidente', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(19, 'calls.index', 'Listado de llamadas', 'Listado de llamadas', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(20, 'calls.create', 'Registro de llamadas', 'Registro de llamadas', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(21, 'calls.show', 'Ver llamada', 'Ver llamada', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(22, 'calls.edit', 'Editar llamada', 'Editar llamada', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(23, 'calls.destroy', 'Eliminar llamada', 'Eliminar llamada', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(24, 'conductor.index', 'Listado de conductores', 'Listado de conductores', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(25, 'conductor.create', 'Registro de conductores', 'Registro de conductores', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(26, 'conductor.show', 'Ver conductores', 'Ver conductores', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(27, 'conductor.edit', 'Editar conductores', 'Editar conductores', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(28, 'conductor.destroy', 'Eliminar conductores', 'Eliminar conductores', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(29, 'ambulance.index', 'Listado de ambulancias', 'Listado de ambulancias', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(30, 'ambulance.create', 'Registro de ambulancias', 'Registro de ambulancias', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(31, 'ambulance.show', 'Ver ambulancias', 'Ver ambulancias', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(32, 'ambulance.edit', 'Editar ambulancias', 'Editar ambulancias', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(33, 'ambulance.destroy', 'Eliminar ambulancias', 'Eliminar ambulancias', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(34, 'dispatch.index', 'Listado de despachos', 'Listado de despachos', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(35, 'dispatch.create', 'Registro de despachos', 'Registro de despachos', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(36, 'dispatch.show', 'Ver despachos', 'Ver despachos', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(37, 'dispatch.edit', 'Editar despachos', 'Editar despachos', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(38, 'dispatch.destroy', 'Eliminar despachos', 'Eliminar despachos', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(39, 'hospital.index', 'Listado de hospitales', 'Listado de hospitales', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(40, 'hospital.create', 'Registro de hospitales', 'Registro de hospitales', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(41, 'hospital.show', 'Ver hospitales', 'Ver hospitales', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(42, 'hospital.edit', 'Editar hospitales', 'Editar hospitales', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(43, 'hospital.destroy', 'Eliminar hospitales', 'Eliminar hospitales', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(44, 'pages.index', 'Listado de páginas', 'Listado de páginas', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(45, 'pages.create', 'Registro de páginas', 'Registro de páginas', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(46, 'pages.show', 'Ver páginas', 'Ver páginas', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(47, 'pages.edit', 'Editar páginas', 'Editar páginas', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(48, 'pages.destroy', 'Eliminar páginas', 'Eliminar páginas', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(50, 'roles.index', 'Listado de roles', 'Listado de roles', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(51, 'roles.create', 'Registro de roles', 'Registro de roles', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(52, 'roles.show', 'Ver roles', 'Ver roles', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(53, 'roles.edit', 'Editar roles', 'Editar roles', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(54, 'roles.destroy', 'Eliminar roles', 'Eliminar roles', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(55, 'response.index', 'Listado de respuestas', 'Listado de respuestas', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(56, 'response.show', 'Ver respuestas', 'Ver respuestas', '2024-01-23 22:10:42', '2024-01-23 22:10:43'),
	(57, 'root', 'Ver dashboard', 'Ver dashboard', '2024-01-24 00:57:13', '2024-01-24 00:57:14');

-- Volcando estructura para tabla gestionemergencias.page_rol
CREATE TABLE IF NOT EXISTS `page_rol` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rol_id` bigint unsigned NOT NULL,
  `page_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `page_roles_rol_id_foreign` (`rol_id`),
  KEY `page_roles_page_id_foreign` (`page_id`),
  CONSTRAINT `page_roles_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `page_roles_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.page_rol: ~69 rows (aproximadamente)
INSERT INTO `page_rol` (`id`, `rol_id`, `page_id`) VALUES
	(1, 1, 3),
	(4, 1, 5),
	(5, 1, 6),
	(6, 1, 2),
	(7, 1, 8),
	(8, 1, 9),
	(9, 1, 10),
	(10, 1, 11),
	(11, 1, 12),
	(12, 1, 13),
	(13, 1, 14),
	(14, 1, 15),
	(15, 1, 16),
	(16, 1, 17),
	(17, 1, 18),
	(18, 1, 19),
	(19, 1, 20),
	(20, 1, 21),
	(21, 1, 22),
	(22, 1, 23),
	(23, 1, 24),
	(24, 1, 25),
	(25, 1, 26),
	(26, 1, 27),
	(27, 1, 28),
	(28, 1, 29),
	(29, 1, 30),
	(30, 1, 31),
	(31, 1, 32),
	(32, 1, 33),
	(33, 1, 33),
	(34, 1, 34),
	(35, 1, 35),
	(36, 1, 36),
	(37, 1, 37),
	(38, 1, 38),
	(39, 1, 39),
	(40, 1, 40),
	(41, 1, 41),
	(42, 1, 42),
	(43, 1, 43),
	(44, 1, 44),
	(45, 1, 45),
	(46, 1, 46),
	(47, 1, 47),
	(48, 1, 48),
	(49, 1, 50),
	(50, 1, 51),
	(51, 1, 52),
	(52, 1, 53),
	(53, 1, 54),
	(54, 1, 55),
	(55, 1, 56),
	(56, 1, 57),
	(58, 6, 2),
	(59, 6, 9),
	(60, 6, 14),
	(61, 6, 19),
	(62, 6, 24),
	(63, 6, 29),
	(64, 6, 34),
	(65, 6, 39),
	(66, 6, 44),
	(67, 6, 50),
	(68, 6, 55),
	(69, 7, 2),
	(70, 7, 9),
	(71, 5, 2),
	(72, 5, 5);

-- Volcando estructura para tabla gestionemergencias.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.password_resets: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gestionemergencias.patient
CREATE TABLE IF NOT EXISTS `patient` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_family` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.patient: ~8 rows (aproximadamente)
INSERT INTO `patient` (`id`, `name`, `lastname`, `address`, `age`, `phone`, `phone_family`, `created_at`, `updated_at`) VALUES
	(20, 'test1', 'test1', 'test1', 1, '60000000', 60000000, '2024-01-23 22:47:28', '2024-01-23 22:47:28'),
	(21, 'test2', 'test2', 'test2', 1, '60000000', 60000000, '2024-01-23 22:50:29', '2024-01-23 22:50:29'),
	(22, 'test3', 'test3', 'test3', 2, '60000000', 60000000, '2024-01-23 22:51:03', '2024-01-23 22:51:03'),
	(23, 'test4', 'test4', 'test4', 1, '60000000', 60000000, '2024-01-23 22:54:32', '2024-01-23 22:54:32'),
	(24, 'test5', 'test5', 'test5', 1, '60000000', 60000000, '2024-01-23 22:54:55', '2024-01-23 22:54:55'),
	(25, 'test6', 'test6', 'test6', 1, '60000000', 60000000, '2024-01-23 22:56:03', '2024-01-23 22:56:03'),
	(26, 'test7', 'test7', 'test7', 1, '60000000', 60000000, '2024-01-23 22:56:52', '2024-01-23 22:56:52'),
	(27, 'test8', 'test8', 'test8', 1, '60000000', 60000000, '2024-01-23 22:57:14', '2024-01-23 22:57:14');

-- Volcando estructura para tabla gestionemergencias.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.permissions: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gestionemergencias.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.personal_access_tokens: ~0 rows (aproximadamente)

-- Volcando estructura para tabla gestionemergencias.response
CREATE TABLE IF NOT EXISTS `response` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `response` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `response_patient_id_foreign` (`patient_id`),
  CONSTRAINT `response_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.response: ~1 rows (aproximadamente)
INSERT INTO `response` (`id`, `response`, `type`, `level`, `patient_id`, `created_at`, `updated_at`) VALUES
	(6, 'test', 'test', 'test', 20, '2024-01-24 00:49:04', '2024-01-24 00:49:05');

-- Volcando estructura para tabla gestionemergencias.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.roles: ~5 rows (aproximadamente)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'web', '2024-01-16 13:36:28', '2024-01-16 13:36:29'),
	(4, 'test asd', 'web', '2024-01-23 15:31:27', '2024-01-24 16:55:49'),
	(5, 'Visor de usuarios', 'web', '2024-01-23 15:49:15', '2024-01-23 15:49:15'),
	(6, 'test1', 'web', '2024-01-24 16:04:18', '2024-01-24 16:04:18'),
	(7, 'test2', 'web', '2024-01-24 16:07:22', '2024-01-24 16:07:22');

-- Volcando estructura para tabla gestionemergencias.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rol_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `motherlast_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `FK_users_roles` (`rol_id`),
  CONSTRAINT `FK_users_roles` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla gestionemergencias.users: ~5 rows (aproximadamente)
INSERT INTO `users` (`id`, `rol_id`, `name`, `last_name`, `motherlast_name`, `latitude`, `longitude`, `address`, `city`, `type`, `phone`, `status`, `photo`, `email`, `email_verified_at`, `password`, `avatar`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Admin', '.', '.', '-17.3938784', '-66.2462782', 'Test', 'Cochabamba', 'Administrador', 67470820, '1', 'imagen.jpg', 'test@test.test', NULL, '$2y$10$mvOdzKlYpW2OSeTKr4uyEeZwdb5ySvExd6vWNTgrj7lhWL9T53iYK', 'avatars/avatar-3.jpg', NULL, NULL, '2024-01-16 17:35:31', '2024-08-13 03:21:50'),
	(7, 1, 'Luis', 'Sanchez', 'Lopez', '-17.398313547917443', '-66.2450336550171', 'Av. Los Andes', 'Cochabamba', 'Informante', 60000001, '1', 'campo nuevo!', 'asd@asd.asd', NULL, '$2y$10$npVdzM4w7mGbFWlCJeFlF.nZBigjouyyLRZ5de5e.lMPL57b32R6K', 'avatars/avatar-3.jpg', NULL, NULL, '2023-12-18 15:44:02', '2024-08-13 03:21:50'),
	(8, 5, 'asd', 'asd', 'asd', '-17.390737283327297', '-66.24700776085206', 'asd', 'Cochabamba', 'Informante', 60000000, '1', 'campo nuevo!', 'asdasd@asd.asd', NULL, '$2y$10$GIHq3hdy.KQ9QihwqsNYdOt71SopcSt.08o.KMQkLAZFaqRXpWO9.', 'avatar/z7UaCTzGjZQIQvZ5AQ3W0i5uGZzQNTZVYIcT7WuV.png', NULL, NULL, '2024-01-22 18:27:33', '2024-08-13 03:21:50'),
	(9, 5, 'Carlos', 'Medina', 'Iriarte', '-17.388689590549028', '-66.24653569206544', 'Av. Los Andes', 'Cochabamba', 'Informante', 60000000, '0', 'campo nuevo!', 'carlos@gmail.com', NULL, '$2y$10$Fp1cybPddk2iIHwesH.zEux4n1M2xKEEQJbERl/buXD4b9PbaDDZG', 'avatar/q1XIr344MFFUWcUzK6jKOYRmDiJhi78gCHvBP5wG.png', NULL, NULL, '2024-01-23 21:25:18', '2024-08-13 03:21:50'),
	(10, 1, 'Pablo', 'Ricaldy', 'Lopez', '-17.389181038906052', '-66.24541989311524', 'Av. Los Andes', 'Cochabamba', 'Informante', 60000000, '1', 'campo nuevo!', 'pablo@gmail.com', NULL, '$2y$10$DYkjqzN.hfqSB0DxfTFxgO4MhvVJj2entzPCIoumcb.Me86kDnWP2', 'avatar/GNQPK8pHFI21gsBOrCJk1VDLOvTbpP9tdBq2MIqL.png', NULL, NULL, '2024-01-23 22:05:20', '2024-08-13 03:21:50');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
