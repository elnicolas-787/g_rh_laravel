-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 17 oct. 2023 à 04:21
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laravel-app`
--

-- --------------------------------------------------------

--
-- Structure de la table `absences`
--

DROP TABLE IF EXISTS `absences`;
CREATE TABLE IF NOT EXISTS `absences` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `users_id` bigint UNSIGNED NOT NULL,
  `employees_id` bigint UNSIGNED NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `heure_depart` time NOT NULL,
  `heure_arrive` time NOT NULL,
  `motif` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `decision` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `absences_employees_id_foreign` (`employees_id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_cat` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `classe_cat` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--

DROP TABLE IF EXISTS `conges`;
CREATE TABLE IF NOT EXISTS `conges` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `users_id` bigint UNSIGNED NOT NULL,
  `employees_id` bigint UNSIGNED NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `duree_conge` int NOT NULL,
  `type_conge` varchar(50) COLLATE utf8mb3_unicode_ci NOT NULL,
  `motif` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `decision` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conges_users_id_foreign` (`users_id`),
  KEY `conges_employees_id_foreign` (`employees_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

DROP TABLE IF EXISTS `contrats`;
CREATE TABLE IF NOT EXISTS `contrats` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employees_id` bigint UNSIGNED NOT NULL,
  `num_contrat` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type_contrat` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `salaire` double NOT NULL,
  `jour_sem` int NOT NULL,
  `heure_sem` int NOT NULL,
  `horaire` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contrats_employees_id_foreign` (`employees_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `contrats`
--

INSERT INTO `contrats` (`id`, `employees_id`, `num_contrat`, `type_contrat`, `date_debut`, `date_fin`, `salaire`, `jour_sem`, `heure_sem`, `horaire`, `created_at`, `updated_at`) VALUES
(5, 1, '132432432543', 'CDI', '2023-10-04', NULL, 300000, 5, 40, '07:30 à 05:30', '2023-10-04 05:23:10', '2023-10-04 05:23:10');

-- --------------------------------------------------------

--
-- Structure de la table `directions`
--

DROP TABLE IF EXISTS `directions`;
CREATE TABLE IF NOT EXISTS `directions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_dir` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nom_dir` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `directions`
--

INSERT INTO `directions` (`id`, `code_dir`, `nom_dir`, `created_at`, `updated_at`) VALUES
(1, 'aaaaa', 'bbbbbb', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `echelons`
--

DROP TABLE IF EXISTS `echelons`;
CREATE TABLE IF NOT EXISTS `echelons` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_echelon` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `categorie_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `echelons_categorie_id_foreign` (`categorie_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `immatriculation` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_naiss` date NOT NULL,
  `lieu_naiss` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `cin` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `situation_f` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `services_id` bigint UNSIGNED NOT NULL,
  `professions_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employees_services_id_foreign` (`services_id`),
  KEY `employees_professions_id_foreign` (`professions_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `employees`
--

INSERT INTO `employees` (`id`, `photo`, `immatriculation`, `nom`, `prenom`, `adresse`, `email`, `date_naiss`, `lieu_naiss`, `cin`, `sexe`, `situation_f`, `telephone`, `services_id`, `professions_id`, `created_at`, `updated_at`) VALUES
(1, '1697516388.jpg', '2344325', 'RAKOTO', 'Nicolas Ibrahim', 'Andamasiny', 'nicolas.ibrahim@gmail.com', '1999-03-21', 'Toliara', '501234567890', 'Masculin', 'Célibataire', '0345678905', 2, 1, '0000-00-00 00:00:00', '2023-10-17 01:19:48');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `theme_formation` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `lieu_formation` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `specialite` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `theme_formation`, `date_debut`, `date_fin`, `lieu_formation`, `specialite`, `created_at`, `updated_at`) VALUES
(1, 'treter', '2023-09-03', '2023-09-22', 'Tanambao', 'rtrytytyt', '2023-10-02 02:49:21', '2023-10-03 02:26:08'),
(2, 'AAAAAAAAAAAA', '2023-09-25', '2023-10-06', 'jlkjpoiopo', 'dsfdsfdsfdsfdfsdf', '2023-10-03 02:51:46', '2023-10-15 01:58:06'),
(3, 'tttrrtrrttrtr', '2023-10-04', '2023-10-16', 'ioio', 'hjhjhjh', '2023-10-16 04:13:47', '2023-10-17 00:55:06');

-- --------------------------------------------------------

--
-- Structure de la table `formation_employees`
--

DROP TABLE IF EXISTS `formation_employees`;
CREATE TABLE IF NOT EXISTS `formation_employees` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `formation_id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formation_employees_formation_id_foreign` (`formation_id`),
  KEY `formation_employees_employee_id_foreign` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `formation_employees`
--

INSERT INTO `formation_employees` (`id`, `formation_id`, `employee_id`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2023-10-03 02:43:08', '2023-10-03 02:43:08');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_09_08_031632_create_directions_table', 1),
(6, '2023_09_08_165401_create_services_table', 1),
(7, '2023_09_11_030849_create_echelons_table', 1),
(8, '2023_09_11_030859_create_categories_table', 1),
(9, '2023_09_12_031642_create_professions_table', 1),
(10, '2023_09_23_120111_create_employees_table', 1),
(11, '2023_09_23_120852_create_conges_table', 1),
(12, '2023_09_23_121251_create_absences_table', 1),
(13, '2023_09_24_083202_create_formations_table', 1),
(14, '2023_09_24_083927_create_formation_employees_table', 1),
(15, '2023_09_26_030806_create_contrats_table', 1),
(16, '2023_09_27_084203_create_missions_table', 1),
(17, '2023_09_27_120454_create_users_table', 1),
(18, '2023_09_28_084205_create_role_to_users_table', 1),
(19, '2023_09_27_000002_create_users_table', 2),
(20, '2023_09_23_115525_create_recrutements_table', 3),
(21, '2023_09_29_120143_create_role_to_users_table', 3),
(22, '2023_09_23_120853_create_conges_table', 4),
(23, '2023_09_23_121252_create_absences_table', 5);

-- --------------------------------------------------------

--
-- Structure de la table `missions`
--

DROP TABLE IF EXISTS `missions`;
CREATE TABLE IF NOT EXISTS `missions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `employees_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `missions_employees_id_foreign` (`employees_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb3_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `professions`
--

DROP TABLE IF EXISTS `professions`;
CREATE TABLE IF NOT EXISTS `professions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_prof` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nom_prof` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `professions`
--

INSERT INTO `professions` (`id`, `code_prof`, `nom_prof`, `created_at`, `updated_at`) VALUES
(1, 'opopop', 'ezrer', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `recrutements`
--

DROP TABLE IF EXISTS `recrutements`;
CREATE TABLE IF NOT EXISTS `recrutements` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `lieu_rec` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `employees_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recrutements_employees_id_foreign` (`employees_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_serv` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nom_serv` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `direction_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_direction_id_foreign` (`direction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `code_serv`, `nom_serv`, `direction_id`, `created_at`, `updated_at`) VALUES
(1, 'cccc', 'dddddd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'SI', 'Service Informatique', 1, '2023-10-03 13:33:58', '2023-10-03 13:33:58');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employees_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_employees_id_foreign` (`employees_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `employees_id`, `name`, `email`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 1, 'Nicolas', 'nicolas.ibrahim@gmail.com', '$2y$10$VoqMaCodaj1isBEMOr.FMunJeg6QqX8G4mg/DY9bWIozPV4Xi7Mie', NULL, NULL, '2023-09-29 08:44:16', '2023-09-29 08:44:16', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absences`
--
ALTER TABLE `absences`
  ADD CONSTRAINT `absences_employees_id_foreign` FOREIGN KEY (`employees_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `conges`
--
ALTER TABLE `conges`
  ADD CONSTRAINT `conges_employees_id_foreign` FOREIGN KEY (`employees_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conges_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD CONSTRAINT `contrats_employees_id_foreign` FOREIGN KEY (`employees_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `echelons`
--
ALTER TABLE `echelons`
  ADD CONSTRAINT `echelons_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_professions_id_foreign` FOREIGN KEY (`professions_id`) REFERENCES `professions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employees_services_id_foreign` FOREIGN KEY (`services_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `formation_employees`
--
ALTER TABLE `formation_employees`
  ADD CONSTRAINT `formation_employees_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `formation_employees_formation_id_foreign` FOREIGN KEY (`formation_id`) REFERENCES `formations` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `missions_employees_id_foreign` FOREIGN KEY (`employees_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `recrutements`
--
ALTER TABLE `recrutements`
  ADD CONSTRAINT `recrutements_employees_id_foreign` FOREIGN KEY (`employees_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_direction_id_foreign` FOREIGN KEY (`direction_id`) REFERENCES `directions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_employees_id_foreign` FOREIGN KEY (`employees_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
