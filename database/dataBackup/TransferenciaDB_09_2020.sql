-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.19-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para transferencia
CREATE DATABASE IF NOT EXISTS `transferencia` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `transferencia`;

-- Volcando estructura para tabla transferencia.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla transferencia.failed_jobs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Volcando estructura para tabla transferencia.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla transferencia.migrations: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2020_09_07_183032_create_transferencias_table', 1),
	(5, '2020_09_18_004801_add_admin_colum_to_users_table', 2),
	(6, '2020_09_19_175530_update_users_table_admin', 3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla transferencia.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla transferencia.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla transferencia.transferencias
CREATE TABLE IF NOT EXISTS `transferencias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transferencias_user_id_foreign` (`user_id`),
  CONSTRAINT `transferencias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla transferencia.transferencias: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `transferencias` DISABLE KEYS */;
INSERT INTO `transferencias` (`id`, `hash`, `created_at`, `updated_at`, `user_id`) VALUES
	(1, 'de859143beb6c69ebbd8610eb468739737663fb4c555200fa7157a76c45db58d', '2020-09-19 18:41:18', '2020-09-19 18:41:18', 2),
	(13, '66d398f799c9e35bddd8771886ef385879f267aa9925fb5c4f5285584a88b6fc', '2020-09-20 18:39:38', '2020-09-20 18:39:38', 2),
	(14, '08696fb744d6e897bac90fdac5d5965e426790c2bc6eb7f970a8a56545fe5abf', '2020-09-20 18:56:54', '2020-09-20 18:56:54', 2),
	(15, '372efa10ab906df339cececd8113ad426c2335cacf8dc109225a1aeb2eaef947', '2020-09-20 19:01:35', '2020-09-20 19:01:35', 2),
	(16, '149793605b8589b477ad60cb709493cd10d0f0a46fe50275e00f513538347a1c', '2020-09-20 19:03:05', '2020-09-20 19:03:05', 2),
	(17, 'eb6ca1a048459a93a55d414f45110eb9982402992df4cdc44c714de2fe1c2718', '2020-09-20 19:08:01', '2020-09-20 19:08:01', 2),
	(18, '805984d594ae29b59362e64a67cfd724128a1300e5e7dc4466d0a91880f0cbc7', '2020-09-20 19:11:31', '2020-09-20 19:11:31', 2),
	(19, 'c21c38c6af1eb809c421b76b6043b7e531cea672bade5562f91cd7e8ad75cddc', '2020-09-20 19:12:40', '2020-09-20 19:12:40', 2),
	(20, 'fcc2e5143069ee245646dbbe65f541be4dd2708bb78a7cb8bb9e4a8a7d61ea2e', '2020-09-20 19:19:51', '2020-09-20 19:19:51', 2),
	(21, 'b9f20267e4dea4489fabf408904dd673de3366fb99337c104e587be8473a268c', '2020-09-20 19:48:49', '2020-09-20 19:48:49', 2),
	(22, '66bfa41f390805b2b5a0fbfa603fb79c0139a07817d7088d73c406b5ab96a8d6', '2020-09-20 19:52:16', '2020-09-20 19:52:16', 2),
	(23, '4b0b9729d9da7197a63921b1d32fa5ff1980bdf9d37b62c3d5fe7440021f4943', '2020-09-20 19:55:20', '2020-09-20 19:55:20', 2),
	(24, '879117e85a1752b7ce5f7ca54e34b91d9c2197e6dc381fc42f47bd7c9be49c25', '2020-09-20 19:56:23', '2020-09-20 19:56:23', 2),
	(25, 'c5fda706a63e060631d1ac5a99faf030000e5a9232372a47f77ebc5eb844166b', '2020-09-20 19:58:37', '2020-09-20 19:58:37', 2),
	(26, 'e23cf5d1b51a8e9bf8da6c6841ea6e63d8e786a614169ec1443a9a1131ba26eb', '2020-09-20 20:03:34', '2020-09-20 20:03:34', 2),
	(27, '48fde83f4e4d13b7748149dd19a25d1d7fb19c910e13b6fdbffcef9ff4de477a', '2020-09-20 20:12:49', '2020-09-20 20:12:49', 1),
	(28, '5dc2191d5d9984bd84d2ec07f3399a3ecdb7ecc657136c62b8ef7544de0e7783', '2020-09-20 20:56:06', '2020-09-20 20:56:06', 1),
	(29, 'dc27e7c946821ca590a572d6de1db13516dc731e55622bf373a7e8ae82c3b6bd', '2020-09-22 00:56:29', '2020-09-22 00:56:29', 1),
	(30, '6a6063755ec006acd95bf22eeaa79d2d4acb8b536ea26f6cb72208fd6e685346', '2020-09-22 23:27:04', '2020-09-22 23:27:04', 1),
	(31, '65e302b1c95c28dc0269ca70f060543ddec7b3f12804ce9fd116859d6eef264a', '2020-09-26 23:09:02', '2020-09-26 23:09:02', 1),
	(32, '5c1f56f7dd881216fbba4d625f3b39ce41ba08dc1f211aae94f77d11d3ed4254', '2020-09-27 18:25:17', '2020-09-27 18:25:17', 10);
/*!40000 ALTER TABLE `transferencias` ENABLE KEYS */;

-- Volcando estructura para tabla transferencia.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla transferencia.users: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `address`, `created_at`, `updated_at`, `admin`) VALUES
	(1, 'Freddy Tandazo', 'freddy@gmail.com', NULL, '$2y$10$zsHdIsiUgj8KLveeRo.q8uVIcUCEJAzSwCCQlthw0LciofWK4vNeK', NULL, 'mgP6ca1ZXjhgsjzdFfmBH9jMVUMpWV8jYt', '2020-09-16 20:40:51', '2020-09-27 04:30:14', 1),
	(2, 'alex', 'alex@gmail.com', NULL, '$2y$10$o4xQXiAFeurOUCxQh0xqGe/l/tlDbewOulCTtOK7Wl2pr.fkTMMMW', NULL, 'n3AmuXTmVtPRZfm1zqZG5bVFR4QGxZM2RE', '2020-09-17 20:54:18', '2020-09-17 20:54:18', 0),
	(3, 'naza', 'naza@gmail.com', NULL, '$2y$10$Ocn95tqpStzbXSt9JvRkpe1DEC9QKdw/H3pxYY6QJdBcpBsY6VyP2', NULL, NULL, '2020-09-19 17:50:08', '2020-09-19 17:50:08', 0),
	(4, 'maria', 'maria@gmail.com', NULL, '$2y$10$Yo/YdnmA5/W7uZTYgVPFAeYLJR.86dqmm4ow0HrQ8Q0/xy/hoKNSC', NULL, NULL, '2020-09-19 17:50:52', '2020-09-19 17:50:52', 0),
	(5, 'javi', 'javi@gmail.com', NULL, '$2y$10$cFJM37zYdznIEviJTL18Y.zQGOzxJRvu9CASqVflfWfjYH96Uz4La', NULL, NULL, '2020-09-19 17:54:09', '2020-09-19 17:54:09', 0),
	(6, 'jona', 'jona@gmail.com', NULL, '$2y$10$RpnU.x9NEfYdWdLEaEh5CuF6M66w4Ct3.804GluwFLxqxuOufR7IC', NULL, NULL, '2020-09-19 18:02:00', '2020-09-19 18:02:00', NULL),
	(7, 'juana', 'juana@gmail.com', NULL, '$2y$10$RL1WBvsqYPHeE09z8MNAcO9JaZqDHdJ0Dk/LXDW75rikTtAyyNDqK', NULL, NULL, '2020-09-27 17:50:24', '2020-09-27 17:50:24', NULL),
	(8, 'user1', 'user1@gmail.com', NULL, '$2y$10$DXhu.qGyTqxt3lsqIre3X.Sg.cw4lwyMBXSJ0Fyr4R/Ih7r.wTWE.', NULL, 'n3KkhtCscpKCCss3W7barJBk4aCdiq8XPU', '2020-09-27 18:21:36', '2020-09-27 18:21:36', NULL),
	(9, 'Noa', 'noa@gmail.com', NULL, '$2y$10$2IoaoyvybNnRxETtgniJeufbxCoueBUwRlM7Jpw0/PI33r7HdlO4i', NULL, 'n2nA53aTQC4jKgV67GawNUVKCgBdR5VfgQ', '2020-09-27 18:22:31', '2020-09-27 18:22:31', NULL),
	(10, 'nuria', 'nuria@gmail.com', NULL, '$2y$10$mqqY1zglwgzRA7i1TvAgMuWSI0jGCX17B6UnmRRQXhZxHnqqjOx4.', NULL, 'mpmAiuJVzBS3e1RH9eCgVfikS9BfFH1MJ7', '2020-09-27 18:23:23', '2020-09-27 18:23:23', NULL),
	(11, 'lidia', 'lidia@gmail.com', NULL, '$2y$10$a3Bivn0aJ.P8rkZNPka7Sen0wcEfekVHMAfmhyUA9lR8N4ihaT2XW', NULL, 'miWNXPdVJcbKWUmCPgzZuvRag38h951H21', '2020-09-27 18:36:38', '2020-09-27 18:36:38', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
