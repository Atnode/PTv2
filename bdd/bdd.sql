-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 15 avr. 2018 à 17:55
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pt`
--

-- --------------------------------------------------------

--
-- Structure de la table `astro_story`
--

DROP TABLE IF EXISTS `astro_story`;
CREATE TABLE IF NOT EXISTS `astro_story` (
  `id` int(11) NOT NULL,
  `story-1` text NOT NULL,
  `story-2` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `astuces`
--

DROP TABLE IF EXISTS `astuces`;
CREATE TABLE IF NOT EXISTS `astuces` (
  `id_astuce` int(11) NOT NULL AUTO_INCREMENT,
  `id_game` int(11) NOT NULL,
  `id_posteur` int(11) NOT NULL,
  `titre` varchar(300) NOT NULL,
  `astuce` text NOT NULL,
  `timestamp` int(11) NOT NULL,
  `valide` int(2) NOT NULL,
  PRIMARY KEY (`id_astuce`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int(11) NOT NULL AUTO_INCREMENT,
  `id_game` int(11) NOT NULL,
  `id_posteur` int(11) NOT NULL,
  `avis` text NOT NULL,
  `note` int(3) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `valide` int(2) NOT NULL,
  PRIMARY KEY (`id_avis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `awards2016`
--

DROP TABLE IF EXISTS `awards2016`;
CREATE TABLE IF NOT EXISTS `awards2016` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  `typeRecomp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bannis_chat`
--

DROP TABLE IF EXISTS `bannis_chat`;
CREATE TABLE IF NOT EXISTS `bannis_chat` (
  `id_bannissement` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(15) NOT NULL,
  `id_bannisseur` int(11) NOT NULL,
  PRIMARY KEY (`id_bannissement`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `card`
--

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membre_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chat_agario`
--

DROP TABLE IF EXISTS `chat_agario`;
CREATE TABLE IF NOT EXISTS `chat_agario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posteur_id` int(11) NOT NULL,
  `message` varchar(450) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `chat_online`
--

DROP TABLE IF EXISTS `chat_online`;
CREATE TABLE IF NOT EXISTS `chat_online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_online` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `absent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentairest`
--

DROP TABLE IF EXISTS `commentairest`;
CREATE TABLE IF NOT EXISTS `commentairest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_news` int(11) NOT NULL,
  `id_posteur` int(11) NOT NULL,
  `commentaire` text CHARACTER SET utf8 NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fics_chapitres`
--

DROP TABLE IF EXISTS `fics_chapitres`;
CREATE TABLE IF NOT EXISTS `fics_chapitres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_fic` int(11) NOT NULL,
  `id_chapitre` int(11) NOT NULL,
  `id_posteur` int(11) NOT NULL,
  `titre_chap` varchar(300) NOT NULL,
  `texte` text NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fics_index`
--

DROP TABLE IF EXISTS `fics_index`;
CREATE TABLE IF NOT EXISTS `fics_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_posteur` int(11) NOT NULL,
  `titre` varchar(350) NOT NULL,
  `image` varchar(750) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(350) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `forum_categorie`
--

DROP TABLE IF EXISTS `forum_categorie`;
CREATE TABLE IF NOT EXISTS `forum_categorie` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_nom` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `cat_ordre` int(11) NOT NULL,
  `color` varchar(12) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_ordre` (`cat_ordre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `forum_chat`
--

DROP TABLE IF EXISTS `forum_chat`;
CREATE TABLE IF NOT EXISTS `forum_chat` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `posteur_id` varchar(32) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `forum_forum`
--

DROP TABLE IF EXISTS `forum_forum`;
CREATE TABLE IF NOT EXISTS `forum_forum` (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_cat_id` mediumint(8) NOT NULL,
  `forum_name` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `forum_desc` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `forum_ordre` mediumint(8) NOT NULL,
  `forum_last_post_id` int(11) NOT NULL,
  `forum_topic` mediumint(8) NOT NULL,
  `forum_post` mediumint(8) NOT NULL,
  `auth_view` tinyint(4) NOT NULL,
  `auth_post` tinyint(4) NOT NULL,
  `auth_topic` tinyint(4) NOT NULL,
  `auth_annonce` tinyint(4) NOT NULL,
  `auth_modo` tinyint(4) NOT NULL,
  `url` varchar(50) NOT NULL,
  PRIMARY KEY (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `galerie`
--

DROP TABLE IF EXISTS `galerie`;
CREATE TABLE IF NOT EXISTS `galerie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(550) NOT NULL,
  `id_perso` int(11) NOT NULL,
  `id_objet` int(11) NOT NULL,
  `id_lieu` int(11) NOT NULL,
  `id_jeu` int(11) NOT NULL,
  `legende` varchar(550) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
CREATE TABLE IF NOT EXISTS `jeux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `jaquette` varchar(500) NOT NULL,
  `background` varchar(500) NOT NULL,
  `console` varchar(255) NOT NULL,
  `developpeur` varchar(255) NOT NULL,
  `editeur` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `classification` varchar(100) NOT NULL,
  `genre` varchar(200) NOT NULL,
  `public` varchar(255) NOT NULL,
  `multijoueurs` varchar(255) NOT NULL,
  `online` varchar(255) NOT NULL,
  `sortie_ue` date NOT NULL,
  `sortie_us` date NOT NULL,
  `sortie_jp` date NOT NULL,
  `nom_url` varchar(550) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `journalmodo`
--

DROP TABLE IF EXISTS `journalmodo`;
CREATE TABLE IF NOT EXISTS `journalmodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `note` varchar(800) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `lieux`
--

DROP TABLE IF EXISTS `lieux`;
CREATE TABLE IF NOT EXISTS `lieux` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_posteur` int(10) NOT NULL,
  `nom_lieu` varchar(300) NOT NULL,
  `alias` varchar(500) NOT NULL,
  `premiere_apparition` int(11) NOT NULL,
  `derniere_apparition` int(11) NOT NULL,
  `image` varchar(370) NOT NULL,
  `texte` text NOT NULL,
  `nom_url` varchar(370) NOT NULL,
  `valide` enum('0','1','','') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `like_publis`
--

DROP TABLE IF EXISTS `like_publis`;
CREATE TABLE IF NOT EXISTS `like_publis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `id_publi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `livreor`
--

DROP TABLE IF EXISTS `livreor`;
CREATE TABLE IF NOT EXISTS `livreor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_posteur` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `note` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `mp_conversations`
--

DROP TABLE IF EXISTS `mp_conversations`;
CREATE TABLE IF NOT EXISTS `mp_conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_createur` int(11) NOT NULL,
  `id_guest` int(11) NOT NULL,
  `last_timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `mp_deleted`
--

DROP TABLE IF EXISTS `mp_deleted`;
CREATE TABLE IF NOT EXISTS `mp_deleted` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `id_mp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `mp_texte`
--

DROP TABLE IF EXISTS `mp_texte`;
CREATE TABLE IF NOT EXISTS `mp_texte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_conversation` int(11) NOT NULL,
  `id_expediteur` int(11) NOT NULL,
  `id_receveur` int(11) NOT NULL,
  `texte` text NOT NULL,
  `time` int(11) NOT NULL,
  `lu` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `mutechat`
--

DROP TABLE IF EXISTS `mutechat`;
CREATE TABLE IF NOT EXISTS `mutechat` (
  `id` int(11) NOT NULL,
  `id_mute` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posteur_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `image` varchar(350) NOT NULL,
  `contenu` text NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `icon` varchar(49) NOT NULL,
  `valide` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notifs`
--

DROP TABLE IF EXISTS `notifs`;
CREATE TABLE IF NOT EXISTS `notifs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_receveur` int(11) NOT NULL,
  `image` varchar(980) NOT NULL,
  `text` text NOT NULL,
  `textBrut` text NOT NULL,
  `time` int(11) NOT NULL,
  `lu` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `objets`
--

DROP TABLE IF EXISTS `objets`;
CREATE TABLE IF NOT EXISTS `objets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_posteur` int(11) NOT NULL,
  `nom_objet` varchar(300) NOT NULL,
  `premiere_apparition` int(11) NOT NULL,
  `derniere_apparition` int(11) NOT NULL,
  `image` text NOT NULL,
  `fonction` text NOT NULL,
  `alias` text NOT NULL,
  `texte` text NOT NULL,
  `nom_url` text NOT NULL,
  `valide` enum('0','1','','') NOT NULL,
  `citation` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `online`
--

DROP TABLE IF EXISTS `online`;
CREATE TABLE IF NOT EXISTS `online` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(355) NOT NULL,
  `useragent` varchar(550) NOT NULL,
  `timestamp` int(12) NOT NULL,
  `url` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `personnages`
--

DROP TABLE IF EXISTS `personnages`;
CREATE TABLE IF NOT EXISTS `personnages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_posteur` int(10) NOT NULL,
  `nom_perso` varchar(255) NOT NULL,
  `premiere_apparition` int(11) NOT NULL,
  `derniere_apparition` int(11) NOT NULL,
  `alias` varchar(450) NOT NULL,
  `sexe` varchar(25) NOT NULL,
  `espece` varchar(100) NOT NULL,
  `image` varchar(350) NOT NULL,
  `texte` text NOT NULL,
  `citation` text NOT NULL,
  `nom_url` varchar(255) NOT NULL,
  `valide` enum('0','1','','') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

DROP TABLE IF EXISTS `publications`;
CREATE TABLE IF NOT EXISTS `publications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_posteur` int(11) NOT NULL,
  `id_receveur` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `officielle` varchar(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `publis_com`
--

DROP TABLE IF EXISTS `publis_com`;
CREATE TABLE IF NOT EXISTS `publis_com` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_publi` int(11) NOT NULL,
  `id_posteur` int(11) NOT NULL,
  `texte` varchar(500) NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `quiz_liste`
--

DROP TABLE IF EXISTS `quiz_liste`;
CREATE TABLE IF NOT EXISTS `quiz_liste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `reponse` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `quiz_membre`
--

DROP TABLE IF EXISTS `quiz_membre`;
CREATE TABLE IF NOT EXISTS `quiz_membre` (
  `id_membre` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `reponse` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `quiz_reply`
--

DROP TABLE IF EXISTS `quiz_reply`;
CREATE TABLE IF NOT EXISTS `quiz_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `reponse` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rangs`
--

DROP TABLE IF EXISTS `rangs`;
CREATE TABLE IF NOT EXISTS `rangs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tchampi_min` int(11) NOT NULL,
  `tchampi_max` int(11) NOT NULL,
  `name` varchar(310) NOT NULL,
  `nom` varchar(310) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `retrospectives`
--

DROP TABLE IF EXISTS `retrospectives`;
CREATE TABLE IF NOT EXISTS `retrospectives` (
  `id` int(11) NOT NULL,
  `id_posteur` int(11) NOT NULL,
  `personnage` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `nom_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sondage`
--

DROP TABLE IF EXISTS `sondage`;
CREATE TABLE IF NOT EXISTS `sondage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sondage` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `r1` varchar(255) NOT NULL,
  `r2` varchar(255) NOT NULL,
  `r3` varchar(255) NOT NULL,
  `r4` varchar(255) NOT NULL,
  `r5` varchar(255) NOT NULL,
  `r6` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sondage_vote`
--

DROP TABLE IF EXISTS `sondage_vote`;
CREATE TABLE IF NOT EXISTS `sondage_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `statut_publi`
--

DROP TABLE IF EXISTS `statut_publi`;
CREATE TABLE IF NOT EXISTS `statut_publi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_posteur` int(11) NOT NULL,
  `id_publi` int(11) NOT NULL,
  `type_statut` int(5) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tennindo`
--

DROP TABLE IF EXISTS `tennindo`;
CREATE TABLE IF NOT EXISTS `tennindo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `posteur_id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `timestamp` bigint(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `new` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tests`
--

DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_posteur` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  `test` text NOT NULL,
  `note` int(11) NOT NULL,
  `pointsforts` text NOT NULL,
  `pointsfaibles` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
