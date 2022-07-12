-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 11 juil. 2022 à 09:02
-- Version du serveur : 5.7.36
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ordonnancement`
--

-- --------------------------------------------------------

--
-- Structure de la table `chefs_projets`
--

DROP TABLE IF EXISTS `chefs_projets`;
CREATE TABLE IF NOT EXISTS `chefs_projets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_379A476E7927C74` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chefs_projets`
--

INSERT INTO `chefs_projets` (`id`, `email`, `roles`, `password`, `nom`) VALUES
(40, 'tristanfio05@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$pNb2e51UVEgWB.ybYmbbVOFUT0fMLJAhcRfqjkmtbmLyEt/oBqJWO', 'Tristan'),
(41, 'olivier.audegond@sully-group.fr', '[]', '$2y$13$A0yBuBq8fDxHISenrrkGjO30OI.mqojOK0WFOpnburagMVZLT4hx6', 'Olivier');

-- --------------------------------------------------------

--
-- Structure de la table `collaborateurs`
--

DROP TABLE IF EXISTS `collaborateurs`;
CREATE TABLE IF NOT EXISTS `collaborateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `collaborateurs`
--

INSERT INTO `collaborateurs` (`id`, `prenom`, `nom`) VALUES
(54, 'Tristan', 'Fioroni'),
(55, 'Ilia', 'Ostrovsky'),
(56, 'Olivier', 'Audegond'),
(57, 'Romain', 'Wiart'),
(58, 'Sourignavong', 'Xouang'),
(59, 'Inès', 'Bouvier');

-- --------------------------------------------------------

--
-- Structure de la table `competences`
--

DROP TABLE IF EXISTS `competences`;
CREATE TABLE IF NOT EXISTS `competences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `technologie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `competences`
--

INSERT INTO `competences` (`id`, `technologie`) VALUES
(28, 'Symfony'),
(29, 'Flutter'),
(30, 'Swift'),
(31, 'Java'),
(32, 'Xamarin'),
(33, 'Javascript');

-- --------------------------------------------------------

--
-- Structure de la table `competences_collaborateurs`
--

DROP TABLE IF EXISTS `competences_collaborateurs`;
CREATE TABLE IF NOT EXISTS `competences_collaborateurs` (
  `competences_id` int(11) NOT NULL,
  `collaborateurs_id` int(11) NOT NULL,
  PRIMARY KEY (`competences_id`,`collaborateurs_id`),
  KEY `IDX_A0274D77A660B158` (`competences_id`),
  KEY `IDX_A0274D775BBF76DC` (`collaborateurs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `competences_collaborateurs`
--

INSERT INTO `competences_collaborateurs` (`competences_id`, `collaborateurs_id`) VALUES
(28, 54),
(28, 56),
(28, 59),
(29, 55),
(29, 56),
(30, 58),
(31, 59),
(32, 58),
(33, 56),
(33, 57);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220531090238', '2022-05-31 09:02:49', 76),
('DoctrineMigrations\\Version20220531100439', '2022-05-31 10:04:48', 121),
('DoctrineMigrations\\Version20220601115029', '2022-06-01 11:50:42', 47),
('DoctrineMigrations\\Version20220602122514', '2022-06-02 12:25:31', 58),
('DoctrineMigrations\\Version20220607101244', '2022-06-07 10:12:52', 168),
('DoctrineMigrations\\Version20220607115603', '2022-06-07 11:56:11', 165),
('DoctrineMigrations\\Version20220614122535', '2022-06-14 12:25:53', 178),
('DoctrineMigrations\\Version20220614123602', '2022-06-14 12:36:05', 161),
('DoctrineMigrations\\Version20220705082523', '2022-07-05 08:25:26', 147);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

DROP TABLE IF EXISTS `projets`;
CREATE TABLE IF NOT EXISTS `projets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_demarrage` datetime NOT NULL,
  `reste_a_faire` int(255) NOT NULL,
  `charge_vendu` int(255) NOT NULL,
  `chefs_projets_id` int(11) NOT NULL,
  `competences_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B454C1DBD58F61A4` (`chefs_projets_id`),
  KEY `IDX_B454C1DBA660B158` (`competences_id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id`, `titre`, `description`, `date_demarrage`, `reste_a_faire`, `charge_vendu`, `chefs_projets_id`, `competences_id`) VALUES
(95, 'SullyOrdo', 'azer', '2022-07-12 00:00:00', 500, 600, 41, 29);

-- --------------------------------------------------------

--
-- Structure de la table `projets_collaborateurs`
--

DROP TABLE IF EXISTS `projets_collaborateurs`;
CREATE TABLE IF NOT EXISTS `projets_collaborateurs` (
  `projets_id` int(11) NOT NULL,
  `collaborateurs_id` int(11) NOT NULL,
  PRIMARY KEY (`projets_id`,`collaborateurs_id`),
  KEY `IDX_272E6938597A6CB7` (`projets_id`),
  KEY `IDX_272E69385BBF76DC` (`collaborateurs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `competences_collaborateurs`
--
ALTER TABLE `competences_collaborateurs`
  ADD CONSTRAINT `FK_A0274D775BBF76DC` FOREIGN KEY (`collaborateurs_id`) REFERENCES `collaborateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_A0274D77A660B158` FOREIGN KEY (`competences_id`) REFERENCES `competences` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `FK_B454C1DBA660B158` FOREIGN KEY (`competences_id`) REFERENCES `competences` (`id`),
  ADD CONSTRAINT `FK_B454C1DBD58F61A4` FOREIGN KEY (`chefs_projets_id`) REFERENCES `chefs_projets` (`id`);

--
-- Contraintes pour la table `projets_collaborateurs`
--
ALTER TABLE `projets_collaborateurs`
  ADD CONSTRAINT `FK_272E6938597A6CB7` FOREIGN KEY (`projets_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_272E69385BBF76DC` FOREIGN KEY (`collaborateurs_id`) REFERENCES `collaborateurs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
