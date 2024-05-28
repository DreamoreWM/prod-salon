-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 28 mai 2024 à 08:02
-- Version du serveur : 10.11.7-MariaDB-cll-lve
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `u812676465_salon`
--

-- --------------------------------------------------------

--
-- Structure de la table `absences`
--

CREATE TABLE `absences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `absences`
--

INSERT INTO `absences` (`id`, `employee_id`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(29, 1, '2024-04-26 08:00:00', '2024-04-26 18:00:00', '2024-04-19 12:45:34', '2024-04-19 12:45:34'),
(30, 1, '2024-04-26 08:00:00', '2024-04-26 18:00:00', '2024-04-19 12:45:34', '2024-04-19 12:45:34');

-- --------------------------------------------------------

--
-- Structure de la table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bookable_type` varchar(255) DEFAULT NULL,
  `bookable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `review_invitation_sent` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appointments`
--

INSERT INTO `appointments` (`id`, `employee_id`, `start_time`, `end_time`, `created_at`, `updated_at`, `bookable_type`, `bookable_id`, `review_invitation_sent`) VALUES
(117, 2, '2024-04-25 08:00:00', '2024-04-25 09:10:00', '2024-04-21 07:35:38', '2024-04-21 07:35:38', 'App\\Models\\User', 3, 0),
(118, 2, '2024-04-25 10:00:00', '2024-04-25 11:10:00', '2024-04-21 07:35:52', '2024-04-21 07:35:52', 'App\\Models\\User', 3, 0),
(119, 2, '2024-04-25 14:00:00', '2024-04-25 14:40:00', '2024-04-21 07:36:14', '2024-04-21 07:36:14', 'App\\Models\\User', 3, 0),
(120, 2, '2024-04-24 10:00:00', '2024-04-24 10:40:00', '2024-04-21 07:37:02', '2024-04-21 07:37:02', 'App\\Models\\User', 3, 0),
(121, 2, '2024-04-24 08:00:00', '2024-04-24 08:40:00', '2024-04-21 07:38:31', '2024-04-21 07:38:31', 'App\\Models\\User', 3, 0),
(122, 2, '2024-05-02 08:00:00', '2024-05-02 09:10:00', '2024-04-22 10:10:08', '2024-04-22 10:10:08', 'App\\Models\\User', 3, 0),
(123, 2, '2024-04-26 08:00:00', '2024-04-26 09:00:00', '2024-04-26 09:25:08', '2024-04-26 09:25:08', 'App\\Models\\User', 3, 0),
(124, 1, '2024-05-22 08:00:00', '2024-05-22 09:00:00', '2024-05-21 07:47:43', '2024-05-21 07:47:43', 'App\\Models\\User', 3, 0),
(125, 1, '2024-05-23 08:00:00', '2024-05-23 09:00:00', '2024-05-21 11:08:34', '2024-05-21 11:08:34', 'App\\Models\\User', 3, 0),
(126, 1, '2024-05-27 08:00:00', '2024-05-27 09:00:00', '2024-05-21 11:11:47', '2024-05-21 11:11:47', 'App\\Models\\User', 3, 0),
(127, 1, '2024-05-27 10:00:00', '2024-05-27 11:00:00', '2024-05-21 11:13:05', '2024-05-21 11:13:05', 'App\\Models\\User', 3, 0),
(128, 1, '2024-06-03 08:00:00', '2024-06-03 09:00:00', '2024-05-21 22:20:01', '2024-05-21 22:20:01', 'App\\Models\\User', 3, 0),
(129, 1, '2024-05-30 08:00:00', '2024-05-30 09:00:00', '2024-05-22 17:11:17', '2024-05-22 17:11:17', 'App\\Models\\User', 3, 0),
(130, 1, '2024-05-28 08:00:00', '2024-05-28 08:45:00', '2024-05-27 13:13:15', '2024-05-27 13:13:15', 'App\\Models\\User', 3, 0),
(131, 1, '2024-05-29 08:00:00', '2024-05-29 12:00:00', '2024-05-27 13:13:54', '2024-05-27 13:13:54', 'App\\Models\\User', 5, 0),
(132, 1, '2024-05-29 17:00:00', '2024-05-29 18:00:00', '2024-05-27 23:18:09', '2024-05-27 23:18:09', 'App\\Models\\User', 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `appointment_prestation`
--

CREATE TABLE `appointment_prestation` (
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `prestation_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appointment_prestation`
--

INSERT INTO `appointment_prestation` (`appointment_id`, `prestation_id`) VALUES
(123, 27),
(124, 37),
(125, 27),
(126, 38),
(127, 38),
(128, 37),
(129, 37),
(130, 32),
(131, 34),
(131, 35),
(131, 38),
(131, 39),
(131, 40),
(132, 37);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(26, 'Prestations femme', '2024-04-26 07:50:59', '2024-04-26 07:50:59'),
(27, 'Prestations spécifiques', '2024-04-26 07:51:11', '2024-04-26 07:51:11'),
(28, 'Prestations hommes', '2024-04-26 07:51:17', '2024-04-26 07:51:17'),
(30, 'Soins', '2024-04-26 07:51:34', '2024-04-26 07:51:34');

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`id`, `name`, `created_at`, `updated_at`, `color`, `email`, `surname`) VALUES
(1, 'Alex', '2024-04-11 07:43:53', '2024-04-11 07:43:53', NULL, 'alexandre.idziak@gmail.com', 'idz'),
(2, 'ludo', '2024-04-13 08:49:44', '2024-04-13 08:49:44', NULL, 'ludo.test@test.com', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `employee_schedules`
--

CREATE TABLE `employee_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `day_of_week` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `employee_schedules`
--

INSERT INTO `employee_schedules` (`id`, `employee_id`, `day_of_week`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '08:00:00', '17:00:00', '2024-04-11 07:44:20', '2024-05-27 23:17:46'),
(2, 1, 2, '08:00:00', '15:00:00', '2024-04-11 07:44:20', '2024-05-27 23:17:46'),
(3, 1, 5, '08:00:00', '18:00:00', '2024-04-11 07:44:33', '2024-05-27 23:17:46'),
(4, 1, 3, '08:00:00', '18:00:00', '2024-04-16 18:40:10', '2024-05-27 23:17:46'),
(5, 1, 4, '08:00:00', '18:00:00', '2024-04-16 18:40:10', '2024-05-27 23:17:46'),
(6, 2, 5, '08:00:00', '18:00:00', '2024-04-19 12:25:41', '2024-05-27 23:15:19'),
(8, 2, 1, '07:14:00', '18:14:00', '2024-05-27 23:15:19', '2024-05-27 23:15:19'),
(9, 2, 2, '07:15:00', '18:14:00', '2024-05-27 23:15:19', '2024-05-27 23:15:19'),
(10, 2, 3, '08:15:00', '18:14:00', '2024-05-27 23:15:19', '2024-05-27 23:15:19'),
(11, 2, 4, '08:15:00', '18:14:00', '2024-05-27 23:15:19', '2024-05-27 23:15:19'),
(12, 2, 6, '09:15:00', '18:14:00', '2024-05-27 23:15:19', '2024-05-27 23:15:19'),
(13, 1, 6, '08:05:00', '18:15:00', '2024-05-27 23:15:42', '2024-05-27 23:17:46');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_02_28_113000_create_employees_table', 1),
(7, '2024_02_28_113000_create_slots_table', 1),
(8, '2024_02_28_113001_create_appointments_table', 1),
(9, '2024_02_28_143157_add_day_of_week_to_slots_table', 1),
(10, '2024_02_28_145750_change_type_of_time_to_slots_table', 1),
(11, '2024_03_04_120648_password_nullable_google_auth', 1),
(12, '2024_03_04_141939_create_prestations_table', 1),
(13, '2024_03_04_142533_add_prestation_id_to_slots_table', 1),
(14, '2024_03_04_143826_add_prestation_id_to_slots_table', 1),
(15, '2024_03_04_215912_add_google_tokens_to_users_table', 1),
(16, '2024_03_05_183456_add_is_admin_to_users_table', 1),
(17, '2024_03_06_095115_add_date_to_slots_table', 1),
(18, '2024_03_06_211810_add_token_expires_at_to_users_table', 1),
(19, '2024_03_15_122935_create_salon_settings_table', 1),
(20, '2024_03_15_122953_create_employee_schedules_table', 1),
(21, '2024_03_19_114043_add_color_to_employees_table', 1),
(22, '2024_03_25_104216_create_temporary_users_table', 1),
(23, '2024_03_25_104342_edit_appointments_table', 1),
(24, '2024_04_03_125233_add_email_to_employees_table', 1),
(30, '2024_04_04_142029_add_surname_to_employees_table', 2),
(31, '2024_04_16_071456_modify_appointments_table', 2),
(32, '2024_04_16_075149_create_appointment_prestation_table', 3),
(33, '2024_04_16_083533_drop_column_prestation_id_to_appointments_table', 4),
(34, '2024_04_19_122306_create_absences_table', 5),
(35, '2024_04_19_204536_create_reviews_table', 6),
(36, '2024_04_19_220007_add_review_invitation_sent_to_appointments_table', 7),
(37, '2024_04_21_121018_create_photos_table', 8),
(38, '2024_04_21_121128_add_photo_id_to_reviews_table', 9),
(39, '2024_04_25_134048_create_categories_table', 9),
(40, '2024_04_25_134509_add_category_id_to_prestations_table', 9),
(41, '2024_05_02_165404_add_facebook_page_url_to_settings', 10),
(42, '2024_05_05_080502_create_photos_table', 11),
(47, '2024_05_06_113942_create_permissions_table', 12),
(48, '2024_05_06_120118_create_roles_table', 13),
(49, '2024_05_06_120144_create_role_user_table', 13),
(50, '2024_05_06_120911_add_role_to_users_table', 14),
(51, '2024_05_27_141848_add_background_color_and_image_selector_to_salon_settings_table', 15),
(52, '2024_05_27_142321_add_background_image_to_salon_settings', 15),
(53, '2024_05_27_150220_add_slogan_to_salon_settings', 15),
(54, '2024_05_27_153839_add_logo_to_settings_table', 15);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('alexandre.idziak@gmail.com', '$2y$12$wDD79VIMCrJqwXJHYd5tke9vWh67ay0apotY2TT18Zel9Fkj0Nuaa', '2024-05-26 16:16:24');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `review_id` bigint(20) UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id`, `review_id`, `filename`, `created_at`, `updated_at`) VALUES
(11, 19, '1715263514_téléchargement (2).jpg', '2024-05-09 14:05:14', '2024-05-09 14:05:14'),
(12, 20, '1715263638_téléchargement (2).jpg', '2024-05-09 14:07:18', '2024-05-09 14:07:18'),
(13, 21, '1715263711_téléchargement (2).jpg', '2024-05-09 14:08:31', '2024-05-09 14:08:31'),
(14, 22, '1716378121_close.png', '2024-05-22 11:42:01', '2024-05-22 11:42:01');

-- --------------------------------------------------------

--
-- Structure de la table `photospres`
--

CREATE TABLE `photospres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `photospres`
--

INSERT INTO `photospres` (`id`, `path`, `created_at`, `updated_at`) VALUES
(1, 'photosPres/PCggyjJWWAx2bh7UTLyDJzeTsO9VGNR39nO7pNZp.jpg', '2024-05-05 06:20:08', '2024-05-05 06:20:08'),
(2, 'photosPres/Oczf0FBY3lkfQGsHJ6PrMaSLAWpo9rIIkU5QkJs7.jpg', '2024-05-05 06:27:50', '2024-05-05 06:27:50'),
(3, 'photosPres/p0tgfVHVem0VSIcsk5bu6icqxDaCGyEE98Au9PZh.jpg', '2024-05-05 07:11:56', '2024-05-05 07:11:56'),
(4, 'photosPres/QDHbY5qqodRRaMttEYdlA92o8007Go4c280wCqEm.jpg', '2024-05-05 07:12:15', '2024-05-05 07:12:15'),
(5, 'photosPres/QCuI0SrIITiazph9N61DnPQRgn2iESTLDCrzQJxt.jpg', '2024-05-05 07:12:27', '2024-05-05 07:12:27'),
(6, 'photosPres/wyYR7Y2zeqTnFqo4HXDwgfPehQhoOGhFWQoOSbZu.webp', '2024-05-22 11:13:45', '2024-05-22 11:13:45'),
(7, 'photosPres/7TJJw8RrlT9ZW1Uw7S8Rp6nBdDYI97wkEmOHUrmW.png', '2024-05-22 11:42:10', '2024-05-22 11:42:10');

-- --------------------------------------------------------

--
-- Structure de la table `prestations`
--

CREATE TABLE `prestations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(8,2) NOT NULL,
  `temps` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `prestations`
--

INSERT INTO `prestations` (`id`, `nom`, `description`, `prix`, `temps`, `created_at`, `updated_at`, `category_id`) VALUES
(27, 'Couleur sublime', 'Couleur sublime', 61.00, 60, '2024-04-26 07:53:41', '2024-04-26 07:53:41', 27),
(28, 'Expert Brillance', 'Expert Brillance', 18.00, 60, '2024-04-26 07:53:57', '2024-04-26 07:53:57', 27),
(29, 'Balayage Blond Éclat', 'Balayage Blond Éclat', 58.00, 60, '2024-04-26 07:54:12', '2024-04-26 07:54:12', 27),
(30, 'Balayage Étoilé', 'Balayage Étoilé', 50.00, 60, '2024-04-26 07:54:25', '2024-04-26 07:54:25', 27),
(31, 'Balayage Soleil', 'Balayage Soleil', 33.00, 60, '2024-04-26 07:54:39', '2024-04-26 07:54:39', 27),
(32, 'Shampooing - Coupe - Coiffage', 'Shampooing - Coupe - Coiffage', 28.00, 45, '2024-04-26 07:55:03', '2024-04-26 07:55:03', 28),
(34, 'Soins', 'Soins', 11.00, 30, '2024-04-26 07:55:36', '2024-04-26 07:55:36', 30),
(35, 'Rituel Kérastase', 'Rituel Kérastase', 24.00, 30, '2024-04-26 07:55:49', '2024-04-26 07:55:49', 30),
(37, 'Shampooing - Coupe - Coiffage', 'Shampooing - Coupe - Coiffage', 41.00, 60, '2024-04-26 07:58:06', '2024-04-26 07:58:06', 26),
(38, 'Shampooing - Coiffage', 'Shampooing - Coiffage', 25.00, 60, '2024-04-26 07:58:25', '2024-04-26 07:58:25', 26),
(39, 'Coloration', 'Coloration', 45.00, 60, '2024-04-26 07:58:41', '2024-04-26 07:58:41', 26),
(40, 'Coloration temporaire - Expert Reflet', 'Coloration temporaire - Expert Reflet', 33.00, 60, '2024-04-26 07:58:54', '2024-04-26 07:58:54', 26),
(41, 'Balayage / Mèches', 'Balayage / Mèches', 64.00, 60, '2024-04-26 07:59:06', '2024-04-26 07:59:06', 26);

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `photo_id`, `appointment_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(19, NULL, 117, 4, 'TOP Rien a dire ! Coiffeur au top !', '2024-05-09 14:05:14', '2024-05-09 14:05:14'),
(20, NULL, 117, 4, 'TOP Rien a dire ! Coiffeur au top !', '2024-05-09 14:07:18', '2024-05-09 14:07:18'),
(21, NULL, 117, 4, 'TOP Rien a dire ! Coiffeur au top !', '2024-05-09 14:08:31', '2024-05-09 14:08:31'),
(22, NULL, 117, 3, 'ghgh', '2024-05-22 11:42:01', '2024-05-22 11:42:01');

-- --------------------------------------------------------

--
-- Structure de la table `salon_settings`
--

CREATE TABLE `salon_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `open_days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`open_days`)),
  `slot_duration` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `facebook_page_url` varchar(255) DEFAULT NULL,
  `background_color` varchar(255) DEFAULT NULL,
  `image_selector` varchar(255) DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `salon_settings`
--

INSERT INTO `salon_settings` (`id`, `name`, `address`, `open_days`, `slot_duration`, `created_at`, `updated_at`, `facebook_page_url`, `background_color`, `image_selector`, `background_image`, `slogan`, `logo`) VALUES
(1, 'Salon demo', '4 Rue du Télégraphe 31500 Toulouse', '{\"monday\":{\"open\":\"08:00\",\"break_start\":\"12:00\",\"break_end\":\"14:00\",\"close\":\"18:00\"},\"tuesday\":{\"open\":\"08:00\",\"break_start\":\"12:00\",\"break_end\":\"14:00\",\"close\":\"18:00\"},\"wednesday\":{\"open\":\"08:00\",\"break_start\":\"12:00\",\"break_end\":\"14:00\",\"close\":\"18:00\"},\"thursday\":{\"open\":\"08:00\",\"break_start\":\"11:00\",\"break_end\":\"11:30\",\"close\":\"18:00\"},\"friday\":{\"open\":\"08:00\",\"break_start\":\"12:00\",\"break_end\":\"14:00\",\"close\":\"18:00\"},\"saturday\":{\"open\":\"08:00\",\"break_start\":\"12:00\",\"break_end\":\"14:00\",\"close\":\"18:00\"},\"sunday\":{\"open\":\"08:00\",\"break_start\":\"12:00\",\"break_end\":\"13:00\",\"close\":\"16:00\"}}', 60, '2024-04-11 07:48:04', '2024-05-28 07:21:01', 'Mon-rêve-espagnol-100063490666722', '#ffd6fc', NULL, 'pexels-shvets-production-9775025.jpg', 'Slogan personnalisable ! ✂️🧔💈💇‍♀️💇', 'logo.png');

-- --------------------------------------------------------

--
-- Structure de la table `slots`
--

CREATE TABLE `slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `day_of_week` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prestation_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `temporary_users`
--

CREATE TABLE `temporary_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `temporary_users`
--

INSERT INTO `temporary_users` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test@test.fr', '2024-04-18 05:18:07', '2024-04-18 05:18:07'),
(2, 'Mr test 2', 'test@test.test', '2024-04-18 05:20:07', '2024-04-18 05:20:07'),
(3, 'test 3', 'testtest@ttest.fr', '2024-04-18 05:32:47', '2024-04-18 05:32:47');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_token` text DEFAULT NULL,
  `google_refresh_token` text DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `token_expires_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `google_token`, `google_refresh_token`, `is_admin`, `token_expires_at`, `role`) VALUES
(3, 'Alexandre Idziak (Dreamore)', 'alexandre.idziak@gmail.com', NULL, NULL, '1joy7BqapntbWD3RYVG86rSKrJj981iB7vjSjIPcixH7SzvakmgkfbzM5wX0', '2024-05-08 16:34:33', '2024-05-27 23:18:10', 'ya29.a0AXooCgsAwSH6TXx0iYv5ywtt5f2ecGvGrW2ilxyrhrGVzNsz_3bkH8Z48UWznYV6YLAYHlYLfqzruvPHo9J0xRa1PC0bJpvVhiCjV14XT-IE_hXwJgj75wo7mbc6fPnogCt51VOT3Nq3iCcAzeT3utLrFB5Iol8o4UY-mQaCgYKAS4SARASFQHGX2MiX1JdiZgozBldN4wwl1C8Ew0173', '1//03xyXxnORj8aWCgYIARAAGAMSNwF-L9IrqqKwugt5hdInY53N6TXaac3QcYg5iHcw6H1c99_hMN5FpjtfUT5Vw-ikqwe-QixkTmU', 0, '2024-05-28 02:21:29', 'admin'),
(4, 'Alex Idz', 'idzalex9@gmail.com', NULL, NULL, 'VxrIqB6VX3627D9qXxRqUhnUI3MRTFmn1JvUxpZEIXePveytrph1w7IkPwxo', '2024-05-21 07:30:15', '2024-05-22 00:04:28', 'ya29.a0AXooCgtWHMumCZuYcK5Ft8rNRGCDsAmTqLPRkTwbBPTxcYZNYepUtE1OQ9smEVlsabLq3RQCWI8ZYOKSc1qShuYWA62BFVdUDeIrAW1q--6hguIlSfAu1u5WtECG2fqCTtuGvSnnOBlmC6Fkrc8IhdST2CrCveJvmllSaCgYKATQSARMSFQHGX2MiwdBunc7nAWgACZNOJhUdKw0171', '1//09LP_Cru7dXvGCgYIARAAGAkSNwF-L9Ir5I3n4BZgOX2ONGqnaXbdca_0UP6tADmCZN1WeUCeKNEMMo4boO0BeTGE5SRSur2RNTg', 0, NULL, 'user'),
(5, 'Lexa Lovoo', 'lexa.lovoo@gmail.com', NULL, NULL, 'HaCgwlBxbA2RvMh5efm2fqX5vQouOJUR6x3aPoKNsjl4cnK7UTqTfzb8pFqb', '2024-05-21 07:32:12', '2024-05-21 07:32:12', 'ya29.a0AXooCguWw3Knl16tTUqwssz5NVFyLx0UMqGzoCNQ0cDIU-hMwBIKow5ejz3XMwaB5SYt47CFWqJiC4M9n-_d_dWz70iZTp7gSxQbKQ4RSVHXVzQaFcAL48KKBvIA1rM7DJYgWHrh_EnYXFkukYIChMQJWoxVXwb197hcaCgYKAbYSARMSFQHGX2Misd7cmFXQ92EdqqF8-JTaAA0171', '1//09PQqU002MRASCgYIARAAGAkSNwF-L9IrGMSORDsBY3HUkj7Rb5bAyadYm5aJvhJHh_UvknLIbHAQKqCtqnTI39hVmJBMyeAFKDA', 0, NULL, 'user'),
(6, 'Brenda Liagre', 'brenda30alexandre@gmail.com', NULL, NULL, '8OW5xXepwLc8vIpE1EjaeCi0FPcNKMVPs6Q2Zfow58xyK3kMIuym3c1jZPUX', '2024-05-21 17:12:36', '2024-05-21 17:12:36', 'ya29.a0AXooCguImN3NF1Jtzswrlvzp-stQ2XnGl6gAbomfD36FtOjruPFoluVTXzkkG5a5m-XJx9RpVbZBHTcNQg6tfEeahs-3onqnQ1KLCQMHaKTKTrMHs8wQY-ILz003LLWaod0yFRxQfzu1wFYD1Lk0wFB0mSKD7-eH5kl0aCgYKAfUSARISFQHGX2MiV1poygQs2bE-D3WAq-Z-Fw0171', '1//090CSg5TDGuF_CgYIARAAGAkSNwF-L9IrULGsmMkolz0U4rnVKHWMJHZaGHJuh_j403-Dm2RaFkvdKCtnVESymhVGs1PIx6uhmc0', 0, NULL, 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absences`
--
ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absences_employee_id_foreign` (`employee_id`);

--
-- Index pour la table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_bookable_type_bookable_id_index` (`bookable_type`,`bookable_id`),
  ADD KEY `appointments_employee_id_foreign` (`employee_id`);

--
-- Index pour la table `appointment_prestation`
--
ALTER TABLE `appointment_prestation`
  ADD PRIMARY KEY (`appointment_id`,`prestation_id`),
  ADD KEY `appointment_prestation_prestation_id_foreign` (`prestation_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Index pour la table `employee_schedules`
--
ALTER TABLE `employee_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_schedules_employee_id_foreign` (`employee_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_review_id_foreign` (`review_id`);

--
-- Index pour la table `photospres`
--
ALTER TABLE `photospres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prestations`
--
ALTER TABLE `prestations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prestations_category_id_foreign` (`category_id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_appointment_id_foreign` (`appointment_id`),
  ADD KEY `reviews_photo_id_foreign` (`photo_id`);

--
-- Index pour la table `salon_settings`
--
ALTER TABLE `salon_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slots_employee_id_foreign` (`employee_id`),
  ADD KEY `slots_prestation_id_foreign` (`prestation_id`);

--
-- Index pour la table `temporary_users`
--
ALTER TABLE `temporary_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `temporary_users_email_unique` (`email`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absences`
--
ALTER TABLE `absences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `employee_schedules`
--
ALTER TABLE `employee_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `photospres`
--
ALTER TABLE `photospres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `prestations`
--
ALTER TABLE `prestations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `salon_settings`
--
ALTER TABLE `salon_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `temporary_users`
--
ALTER TABLE `temporary_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `absences_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Contraintes pour la table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`);

--
-- Contraintes pour la table `appointment_prestation`
--
ALTER TABLE `appointment_prestation`
  ADD CONSTRAINT `appointment_prestation_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointment_prestation_prestation_id_foreign` FOREIGN KEY (`prestation_id`) REFERENCES `prestations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `employee_schedules`
--
ALTER TABLE `employee_schedules`
  ADD CONSTRAINT `employee_schedules_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `prestations`
--
ALTER TABLE `prestations`
  ADD CONSTRAINT `prestations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`),
  ADD CONSTRAINT `reviews_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `slots`
--
ALTER TABLE `slots`
  ADD CONSTRAINT `slots_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `slots_prestation_id_foreign` FOREIGN KEY (`prestation_id`) REFERENCES `prestations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
