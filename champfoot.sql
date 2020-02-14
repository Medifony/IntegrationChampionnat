-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 14 fév. 2020 à 15:38
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `champfoot`
--
CREATE DATABASE IF NOT EXISTS `champfoot` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `champfoot`;

-- --------------------------------------------------------

--
-- Structure de la table `calendrier`
--

DROP TABLE IF EXISTS `calendrier`;
CREATE TABLE IF NOT EXISTS `calendrier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rencontres_id` int(11) NOT NULL,
  `cal_date` datetime DEFAULT NULL,
  `journee` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B2753CB9F471D97B` (`rencontres_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `calendrier`
--

INSERT INTO `calendrier` (`id`, `rencontres_id`, `cal_date`, `journee`) VALUES
(2, 1, '2020-05-26 21:00:00', 1),
(3, 4, '2015-01-01 00:00:00', 1),
(4, 5, '2015-03-01 00:00:00', 1),
(5, 2, '2015-02-01 00:00:00', 1),
(6, 3, '2015-01-10 00:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `classement`
--

DROP TABLE IF EXISTS `classement`;
CREATE TABLE IF NOT EXISTS `classement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipes_id` int(11) NOT NULL,
  `victoires` int(11) NOT NULL,
  `nuls` int(11) NOT NULL,
  `defaites` int(11) NOT NULL,
  `dif` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `joues` int(11) DEFAULT NULL,
  `totbuts` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_55EE9D6D737800BA` (`equipes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `classement`
--

INSERT INTO `classement` (`id`, `equipes_id`, `victoires`, `nuls`, `defaites`, `dif`, `points`, `joues`, `totbuts`) VALUES
(4, 1, 0, 0, 0, 0, 0, 0, 0),
(5, 2, 0, 0, 0, 0, 0, 0, 0),
(6, 3, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `description`
--

DROP TABLE IF EXISTS `description`;
CREATE TABLE IF NOT EXISTS `description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nav` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `journee` int(11) NOT NULL,
  `saison` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entraineur`
--

DROP TABLE IF EXISTS `entraineur`;
CREATE TABLE IF NOT EXISTS `entraineur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entraineur`
--

INSERT INTO `entraineur` (`id`, `nom`, `photo`) VALUES
(4, 'Frank Lampard', '/images/chelseaE.jpg'),
(5, 'Pep Guardiola', '/images/mancityE.jpg'),
(6, 'Ole Gunnar Solskjær', '/images/manunitedE.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stades_id` int(11) NOT NULL,
  `entraineurs_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surnom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `president` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fondation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2449BA1546AFAA23` (`entraineurs_id`),
  KEY `IDX_2449BA158C195A4` (`stades_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`id`, `stades_id`, `entraineurs_id`, `nom`, `surnom`, `logo`, `description`, `president`, `fondation`, `site`, `slug`) VALUES
(1, 4, 4, 'Chelsea', 'Blues', '/images/chelsea.png', 'Chelsea Football Club (CFC) est un club de football professionnel anglais fondé le 10 mars 1905 à Londres. Son siège est situé dans le quartier de Fulham, au sein du borough de Hammersmith et Fulham. Il évolue actuellement en Premier League et a passé la majorité de son histoire dans la plus haute division du football anglais. Leur stade est Stamford Bridge, qui comprend 41 637 places3, et où le club évolue depuis sa fondation. César Azpilicueta est le capitaine du club depuis août 2018 et Frank Lampard est l\'entraîneur de l\'équipe première. Chelsea a fait partie du Big Four anglais des années 2000 aux côtés d\'Arsenal, de Liverpool et de Manchester United. Bien que possédant un palmarès moins impressionnant que celui des autres « grands » du championnat, les Blues disposent du quatrième palmarès d\'Angleterre avec 29 titres et sont classés dixièmes au classement mondial des clubs de l\'IFFHS entre 1991 et 2010.', 'Roman Abramovitch', '10 mars 1905', 'http://chelseafc.com', 'chelsea'),
(2, 5, 5, 'Manchester City', 'Sky blues', '/images/mancity.png', 'Le Manchester City Football Club est un club de football anglais basé à Manchester et fondé en 1880 sous le nom de St. Mark\'s (West Gorton). Le club devint le Ardwick Association Football Club en 1887 avant de prendre son nom actuel en 1894. Surnommée City, The Citizens, ou encore, The Sky Blues (Les Bleus Ciel), l\'équipe professionnelle évolue depuis 2003 à l\'Etihad Stadium. Le derby mancunien l’oppose à l’autre grand club de la ville, Manchester United. Depuis le 1er juillet 2016, le club est entraîné par Pep Guardiola.\r\n\r\nLe club connait sa période la plus faste de la fin des années 1960 jusqu\'au début des années 1970. City remporte alors le Championnat d\'Angleterre, la Coupe d\'Angleterre, la Coupe de la Ligue et la Coupe des coupes, avec Joe Mercer et Malcolm Allison à la tête de l\'équipe et des joueurs comme Colin Bell, Mike Summerbee ou Francis Lee.\r\n\r\nLe déclin du club l\'a conduit à deux relégations en trois ans au cours des années 1990, voyant ainsi City passer la saison 1998-1999 au troisième échelon du football anglais pour la seule et unique fois de son histoire. Le club a depuis regagné sa place au sein de l\'élite, division qui fut la sienne durant la majeure partie de son histoire. Depuis 2008 et l\'arrivée du président actuel Khaldoon Al Mubarak, le club dispose de moyens financiers considérables lui permettant un recrutement ambitieux.', 'Khaldoon Al Mubarak', '16 avril 1894', 'http://mancity.com/', 'manchester-city'),
(3, 6, 6, 'Manchester United', 'Red Devils', '/images/manunited.png', 'Le Manchester United Football Club est un club de football anglais basé dans le district de Trafford, à proximité de la ville de Manchester, dans son stade d\'Old Trafford dans le Grand Manchester. Il est fondé en 1878 sous le nom de Newton Heath.\r\n\r\nManchester United est l\'un des clubs les plus riches et comptant le plus de supporters au monde2. Avec des revenus les plus élevés de tout club de football d\'une valeur estimée à 1,4 milliard d\'euros3, sa valeur, en mai 2015, est estimée à 2,7 milliards de dollars4. Le club est aussi un des fondateurs de l\'Association européenne des clubs.\r\n\r\nManchester United possède le palmarès le plus fourni du football anglais, ayant remporté le championnat d\'Angleterre à vingt reprises. Le club a également remporté douze Coupes d\'Angleterre, cinq Coupes de la Ligue anglaise, vingt-et-un Community Shield, trois Ligues des Champions, une Coupe des Coupes, une Ligue Europa, une Supercoupe de l\'UEFA, une Coupe intercontinentale et une Coupe du monde des clubs.', 'Avram et Joel Glazer', '1878', 'https://www.manutd.com/', 'manchester-united');

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

DROP TABLE IF EXISTS `joueur`;
CREATE TABLE IF NOT EXISTS `joueur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipes_id` int(11) NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poste` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taille` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poids` int(11) NOT NULL,
  `nationalite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FD71A9C5737800BA` (`equipes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`id`, `equipes_id`, `prenom`, `nom`, `photo`, `age`, `poste`, `taille`, `poids`, `nationalite`, `description`, `slug`) VALUES
(1, 1, 'Eden', 'Hazard', '/images/hazard.jpg', '7 janvier 1991 (29 ans)', 'Ailier', '1m75', 75, 'Belge', 'Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard Eden Hazard', 'eden-hazard'),
(2, 1, 'N\'Golo', 'Kante', '/images/kante.jpg', '29 mars 1991 (28 ans)', 'Milieu défensif', '1m68', 68, 'Français', 'N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante N\'golo Kante', 'n-golo-kante'),
(3, 1, 'Borges da Silva', 'Willian', '/images/willian.jpg', '9 août 1988 (31 ans)', 'Attaquant', '1m81', 75, 'Brésilien', 'Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian Willian', 'borges-da-silva-willian'),
(4, 2, 'Kevin', 'De Bruyne', '/images/debruyne.jpg', '28 juin 1991 (28 ans)', 'Milieu central', '1m81', 70, 'Belge', 'De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne De Bruyne', 'kevin-de-bruyne'),
(5, 2, 'Bernardo', 'Silva', '/images/silva.jpg', '10 août 1994 (25 ans)', 'Milieu central', '1m70', 60, 'Portugais', 'Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva Silva', 'bernardo-silva'),
(6, 2, 'Raheem', 'Sterling', '/images/sterling.jpg', '8 décembre 1994 (25 ans)', 'Ailier', '1m73', 65, 'Anglais', 'Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling Sterling', 'raheem-sterling'),
(7, 3, 'Paul', 'Pogba', '/images/pogba.jpg', '15 mars 1993 (26 ans)', 'Milieu', '1,91', 84, 'Français', 'Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba Pogba', 'paul-pogba'),
(8, 3, 'David', 'De Gea', '/images/degea.jpg', '7 novembre 1990 (29 ans)', 'Gardien', '1m92', 80, 'Espagnol', 'Incorporé à l\'effectif de l\'Atlético Madrid à l\'aube de la saison 2009-2010 en tant que troisième gardien pour remplacer numériquement Grégory Coupet, David de Gea grimpe rapidement dans la hiérarchie établie. Il fait ses débuts professionnels le 30 septembre 2009 lors de la phase de groupes de la Ligue des champions face au FC Porto. De Gea remplace Roberto Jiménez Gago, blessé en milieu de première période, et encaisse deux buts (2-0).\r\n\r\nIl effectue d\'emblée de grosses prestations malgré son jeune âge et pousse sur le banc des remplaçants l\'autre grand espoir du club à ce poste et recrue phare du mercato, Sergio Asenjo, auteur de prestations peu convaincantes.\r\n\r\nLes Colchoneros n\'hésitent pas un instant et prolongent le contrat de leur jeune gardien1, notamment suivi par Manchester United2. Le 12 mai 2010, de Gea est titulaire lors de la finale de la première édition de la Ligue Europa remportée par le club madrilène aux dépens de Fulham (2-1 après prolongations). Il effectue une saison 2010-2011 pleine en participant à l\'intégralité des 38 rencontres de Liga.', 'david-de-gea');

-- --------------------------------------------------------

--
-- Structure de la table `joue_rencontre`
--

DROP TABLE IF EXISTS `joue_rencontre`;
CREATE TABLE IF NOT EXISTS `joue_rencontre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rencontres_id` int(11) NOT NULL,
  `joueurs_id` int(11) NOT NULL,
  `statsjoueurs_id` int(11) NOT NULL,
  `tit_rem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D3A21306E08E1839` (`statsjoueurs_id`),
  KEY `IDX_D3A21306F471D97B` (`rencontres_id`),
  KEY `IDX_D3A21306A3DC7281` (`joueurs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `joue_rencontre`
--

INSERT INTO `joue_rencontre` (`id`, `rencontres_id`, `joueurs_id`, `statsjoueurs_id`, `tit_rem`) VALUES
(14, 1, 1, 16, 'Titulaire'),
(15, 1, 2, 17, 'Titulaire'),
(16, 1, 3, 18, 'Titulaire'),
(17, 1, 4, 19, 'Titulaire'),
(18, 1, 5, 20, 'Titulaire'),
(19, 1, 6, 21, 'Titulaire');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200206172232', '2020-02-06 17:23:53');

-- --------------------------------------------------------

--
-- Structure de la table `rencontre`
--

DROP TABLE IF EXISTS `rencontre`;
CREATE TABLE IF NOT EXISTS `rencontre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stades_id` int(11) NOT NULL,
  `equipes_d_id` int(11) NOT NULL,
  `equipes_e_id` int(11) NOT NULL,
  `stats_eq_d_id` int(11) DEFAULT NULL,
  `stats_eq_e_id` int(11) DEFAULT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_460C35ED8A210769` (`stats_eq_d_id`),
  UNIQUE KEY `UNIQ_460C35ED329D600C` (`stats_eq_e_id`),
  KEY `IDX_460C35ED8C195A4` (`stades_id`),
  KEY `IDX_460C35ED7B4780B6` (`equipes_d_id`),
  KEY `IDX_460C35EDC3FBE7D3` (`equipes_e_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `rencontre`
--

INSERT INTO `rencontre` (`id`, `stades_id`, `equipes_d_id`, `equipes_e_id`, `stats_eq_d_id`, `stats_eq_e_id`, `statut`, `slug`) VALUES
(1, 4, 1, 2, 1, 2, 'En cours', 'chelsea-vs-manchester-city'),
(2, 5, 2, 1, NULL, NULL, 'En attente', 'manchester-city-vs-chelsea'),
(3, 6, 3, 2, NULL, NULL, 'En attente', 'manchester-united-vs-manchester-city'),
(4, 4, 1, 3, NULL, NULL, 'En attente', 'chelsea-vs-manchester-united'),
(5, 5, 2, 3, NULL, NULL, 'En attente', 'manchester-city-vs-manchester-united');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `title`) VALUES
(2, 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `IDX_332CA4DDD60322AC` (`role_id`),
  KEY `IDX_332CA4DDA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(2, 22);

-- --------------------------------------------------------

--
-- Structure de la table `stade`
--

DROP TABLE IF EXISTS `stade`;
CREATE TABLE IF NOT EXISTS `stade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stade`
--

INSERT INTO `stade` (`id`, `nom`, `ville`, `capacite`) VALUES
(4, 'Stamford Bridge', 'Londre', 40853),
(5, 'Etihad Stadium', 'Manchester', 55097),
(6, 'Old Trafford', 'Manchester', 75643);

-- --------------------------------------------------------

--
-- Structure de la table `stats_equipe`
--

DROP TABLE IF EXISTS `stats_equipe`;
CREATE TABLE IF NOT EXISTS `stats_equipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipes_id` int(11) NOT NULL,
  `rencontres_id` int(11) NOT NULL,
  `dispositif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buts` int(11) NOT NULL,
  `possession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tirs_c` int(11) NOT NULL,
  `tirs` int(11) NOT NULL,
  `corners` int(11) NOT NULL,
  `coups_francs` int(11) NOT NULL,
  `cartons_jaunes` int(11) NOT NULL,
  `cartons_rouges` int(11) NOT NULL,
  `fautes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_97595D16737800BA` (`equipes_id`),
  KEY `IDX_97595D16F471D97B` (`rencontres_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stats_equipe`
--

INSERT INTO `stats_equipe` (`id`, `equipes_id`, `rencontres_id`, `dispositif`, `buts`, `possession`, `tirs_c`, `tirs`, `corners`, `coups_francs`, `cartons_jaunes`, `cartons_rouges`, `fautes`) VALUES
(1, 1, 1, '4-3-3', 0, '0', 0, 0, 0, 0, 0, 0, 0),
(2, 2, 1, '3-4-3', 0, '0', 0, 0, 0, 0, 0, 0, 0),
(3, 1, 4, '4-3-3', 0, '0', 0, 0, 0, 0, 0, 0, 0),
(4, 3, 4, '4-4-2', 0, '0', 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `stats_joueur`
--

DROP TABLE IF EXISTS `stats_joueur`;
CREATE TABLE IF NOT EXISTS `stats_joueur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joueurs_id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `buts` int(11) NOT NULL,
  `pass_d` int(11) NOT NULL,
  `tirs_c` int(11) NOT NULL,
  `tirs` int(11) NOT NULL,
  `passes` int(11) NOT NULL,
  `tacles` int(11) NOT NULL,
  `fautes` int(11) NOT NULL,
  `cartons_jaunes` int(11) NOT NULL,
  `cartons_rouges` int(11) NOT NULL,
  `disponible` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4E614EC6A3DC7281` (`joueurs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stats_joueur`
--

INSERT INTO `stats_joueur` (`id`, `joueurs_id`, `num`, `min`, `buts`, `pass_d`, `tirs_c`, `tirs`, `passes`, `tacles`, `fautes`, `cartons_jaunes`, `cartons_rouges`, `disponible`) VALUES
(16, 1, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'non'),
(17, 2, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'non'),
(18, 3, 11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'non'),
(19, 4, 17, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'non'),
(20, 5, 8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'non'),
(21, 6, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'non');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `picture`, `hash`) VALUES
(22, 'Mehdi', 'Testeur', 'mehdi@gmail.com', NULL, '$2y$13$f2bem6wPdsFcxvxLw4ckkOplJa4lBi5ObXzPmed7mEil7l3zbjOmG'),
(23, 'Prince', 'Volkman', 'izaiah.schinner@yahoo.com', NULL, '$2y$13$Z9zw7BIg2P3FMjNiamOw.uQ6iBcDV/xnmpcoZEHtx2ZwnV0ihbHAC'),
(24, 'Elva', 'Klein', 'beulah21@gmail.com', NULL, '$2y$13$3OsmQgCC62Lh20O8oNUIX.TnPgKP6j4YCanL/iQTfwv0ffNOcmI8G'),
(25, 'Millie', 'Hessel', 'casper.osvaldo@hotmail.com', NULL, '$2y$13$QNSJNT/uEK..h0E8Rzh6b.nZVvQvRHUjw1CxuYElnAqwXv8FtWiOi'),
(26, 'Cooper', 'Fisher', 'considine.isaias@gmail.com', NULL, '$2y$13$5PTE3XYGdoLWxlA5yNzic.VDlN.hK9W8oOupYAhP8HPeskRZhKQ8C'),
(27, 'Idell', 'Lubowitz', 'ymann@dickinson.com', NULL, '$2y$13$NnlSzbmyZ1brc/MX6f6Vzemm9K6jsOOqf1Ng7fzM/mWo5LO3hiS0a'),
(28, 'Dora', 'Stokes', 'andreane.little@gmail.com', NULL, '$2y$13$E5feqG/jFXwTa4.rx0InL.4Z79EIvrS6G0lWATAL/ZlXoWBJrsEWi'),
(29, 'Quinn', 'Boyer', 'hahn.elmer@hotmail.com', NULL, '$2y$13$lprJpHcdFLDTuL5lec3D.OZq8BxH1BNc4DaEtVPXvrTilTbH6JSkq'),
(30, 'Hortense', 'Christiansen', 'trace54@gmail.com', NULL, '$2y$13$nTvxTVOOFZO7xuMzZNZSAemwWIpaOeIo4mqf9C2xIaqUrH7bTxfB6'),
(31, 'Rosemarie', 'Vandervort', 'jsimonis@gmail.com', NULL, '$2y$13$wPNWjYp.AYbSdIqtUn20PeE4U8yUu7TLaNmkyb7e/DGQvw25asTbe'),
(32, 'Desmond', 'Kutch', 'alexys35@rolfson.biz', NULL, '$2y$13$spN8lk0/aLEsJA/Kkc2CA.i0XNNHtGPsLuuDAPWiiYFFK//CkAC5u'),
(33, 'Oscar', 'Rogahn', 'ohara.greg@gmail.com', NULL, '$2y$13$qTy1AxKrklDh7IyyMPxXm.GiuQNF1zmnCIvUc5ATidK0P1FmwOjsG'),
(34, 'Orie', 'Homenick', 'ddaugherty@kshlerin.com', NULL, '$2y$13$E0Dz/gC4G8oANYF19xIphOMhAtjHkzog75evvEFwWLdsMz9AZdY8C'),
(35, 'Chadd', 'Kilback', 'dashawn.prohaska@yahoo.com', NULL, '$2y$13$tvozlmaYtaK0Opakhuvu8.YomYZugCLzzxQh/29etWOYkjRIFUS0O'),
(36, 'Cassandra', 'Baumbach', 'astrid98@hotmail.com', NULL, '$2y$13$HovwNuAOODtu9BPQRDkEjeDa8x6UNLyBd0gvTorJtO3ZT7HxF.7py'),
(37, 'Jakayla', 'Zemlak', 'eankunding@gmail.com', NULL, '$2y$13$YFOEmOpQrHQXpg/SQcGB2eXE0cR6IctoK.4IThYk/U93TjLi1OV4e'),
(38, 'Lavern', 'Spinka', 'lang.maryam@gmail.com', NULL, '$2y$13$zZIpeIH1qiKQZIj14XmiOeFVCz3pHSsnSUm9cKDbgITFyh2SURdei'),
(39, 'Mac', 'Schultz', 'kovacek.oswaldo@gmail.com', NULL, '$2y$13$Qc.Hymd7xiGtgLhDZIth7Om57JSlbKTr6.XN3IadkdzhxNYpOwsbK'),
(40, 'Sanford', 'Jast', 'israel.smith@kuphal.net', NULL, '$2y$13$r1oNsBleDltTd8X23AS4MOLjy.zPicVPnQtpSI/0xD.R5FfxJT/fa'),
(41, 'Hayley', 'Quigley', 'helmer.nolan@okon.com', NULL, '$2y$13$./VuKgn3VlpawgtSVzSGgOSH4Mvc5q7qjMaKH0JH4knRml5iabCIO'),
(42, 'Jadyn', 'Wintheiser', 'ubarrows@kling.com', NULL, '$2y$13$gW.Lavk4GT4S3ogPHyUJUePEbc4UxmSSUTWHbZTxboPUEO/SgtUYe');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `equipe`
--
ALTER TABLE `equipe`
  ADD CONSTRAINT `FK_2449BA1546AFAA23` FOREIGN KEY (`entraineurs_id`) REFERENCES `entraineur` (`id`),
  ADD CONSTRAINT `FK_2449BA158C195A4` FOREIGN KEY (`stades_id`) REFERENCES `stade` (`id`);

--
-- Contraintes pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD CONSTRAINT `FK_FD71A9C5737800BA` FOREIGN KEY (`equipes_id`) REFERENCES `equipe` (`id`);

--
-- Contraintes pour la table `rencontre`
--
ALTER TABLE `rencontre`
  ADD CONSTRAINT `FK_460C35ED329D600C` FOREIGN KEY (`stats_eq_e_id`) REFERENCES `stats_equipe` (`id`),
  ADD CONSTRAINT `FK_460C35ED7B4780B6` FOREIGN KEY (`equipes_d_id`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `FK_460C35ED8A210769` FOREIGN KEY (`stats_eq_d_id`) REFERENCES `stats_equipe` (`id`),
  ADD CONSTRAINT `FK_460C35ED8C195A4` FOREIGN KEY (`stades_id`) REFERENCES `stade` (`id`),
  ADD CONSTRAINT `FK_460C35EDC3FBE7D3` FOREIGN KEY (`equipes_e_id`) REFERENCES `equipe` (`id`);

--
-- Contraintes pour la table `stats_equipe`
--
ALTER TABLE `stats_equipe`
  ADD CONSTRAINT `FK_97595D16737800BA` FOREIGN KEY (`equipes_id`) REFERENCES `equipe` (`id`),
  ADD CONSTRAINT `FK_97595D16F471D97B` FOREIGN KEY (`rencontres_id`) REFERENCES `rencontre` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
