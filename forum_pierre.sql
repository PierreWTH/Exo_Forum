-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum_pierre
CREATE DATABASE IF NOT EXISTS `forum_pierre` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `forum_pierre`;

-- Listage de la structure de la table forum_pierre. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(50) NOT NULL,
  PRIMARY KEY (`id_categorie`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Listage des données de la table forum_pierre.categorie : ~6 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id_categorie`, `nomCategorie`) VALUES
	(3, 'Jeux-Vidéos'),
	(4, 'Informatique'),
	(5, 'Voitures'),
	(6, 'Sports'),
	(7, 'Cinéma'),
	(8, 'Cuisine');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table forum_pierre. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `texte` text NOT NULL,
  `dateCreationPost` datetime DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `topic_id` (`topic_id`),
  KEY `membre_id` (`user_id`),
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `post_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;

-- Listage des données de la table forum_pierre.post : ~8 rows (environ)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id_post`, `texte`, `dateCreationPost`, `topic_id`, `user_id`) VALUES
	(10, 'Salut tout le monde, \r\n\r\nPour ma tarte au citron, je met 200g de sucre, une pate brisée, des citrons verts frais et un peu de canelle. Je fais cuire ça au four pendant 20min et après je laisse reposer 1h au frigo, puis je met du sucre glace dessus ! Qu’est ce que vous en pensez ? Partagez aussi vos recettes, j’aimerais tester des nouvelles choses ! ', '2023-03-24 18:34:45', 11, 11),
	(11, 'Salut ! La saison 2 de warzone arrive a grand pas quelles sont vos attentes pour cette nouvelle saison ? ', '2023-03-24 18:35:35', 7, 8),
	(13, 'comment hacker un site et récuperer les mots de passe de tout le monde svp ?', '2023-03-24 18:37:02', 12, 12),
	(15, 'Salut je suis bloqué sur un bout de code depuis 3 jours ça ne fonctionne pas help me please ! Voila le code : \r\n\r\nif(isset($fieldArray[1]) && $fieldArray[1] == "id"){\r\n                    $manName = ucfirst($fieldArray[0])."Manager";\r\n                    $FQCName = "Model\\Managers"."\\\\".$manName;\r\n\r\nMerci ', '2023-03-24 18:38:47', 9, 10),
	(16, 'j\'ouvre un petit débat vous preferez php ou javascript ? ', '2023-03-24 18:39:12', 8, 9),
	(93, 'test', '2023-03-29 14:23:57', 9, 20),
	(178, 'test', '2023-03-30 16:21:48', 7, 20),
	(180, 'gregergre', '2023-03-30 16:38:11', 7, 20);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Listage de la structure de la table forum_pierre. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `nomTopic` varchar(50) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `dateCreationTopic` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `id_membre` (`user_id`),
  KEY `categorie_id` (`categorie_id`),
  KEY `membre_id` (`user_id`),
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`),
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

-- Listage des données de la table forum_pierre.topic : ~5 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `nomTopic`, `locked`, `dateCreationTopic`, `user_id`, `categorie_id`) VALUES
	(7, 'Warzone 2 : nouvelle saison le 12 fevrier', 0, '2023-03-24 18:34:03', 8, 3),
	(8, 'Quel est le meilleur langage entre Php et JS ?', 0, '2023-03-24 18:34:03', 9, 4),
	(9, 'Bloqué sur un bout de code', 0, '2023-03-24 18:34:03', 10, 4),
	(11, 'Avis sur ma recette de tarte au citron', 0, '2023-03-24 18:34:03', 11, 8),
	(12, 'Comment hacker un site ?', 1, '2023-03-24 18:34:03', 12, 4);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table forum_pierre. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `banStatus` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Listage des données de la table forum_pierre.user : ~9 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `pseudo`, `dateInscription`, `password`, `role`, `email`, `banStatus`) VALUES
	(8, 'Xxx-Killerx-XX', '2023-03-24 18:27:52', 'KillerCod56', 'member', 'Xxx-Killerx-XX@forum.com', 1),
	(9, 'BillGates_', '2023-03-24 18:28:25', 'gatesbill12', 'member', 'BillGates_@forum.com', 1),
	(10, 'Nakamoto', '2023-03-24 18:28:53', 'pomme12x', 'member', 'Nakamato@forum.com', 1),
	(11, 'Etchebest-Phil', '2023-03-24 18:29:34', 'topchef21', 'member', 'Etchebest-Phil@forum.com', 1),
	(12, 'Techland_12', '2023-03-24 18:29:34', 'kingtech14', 'member', 'Techland_12@forum.com', 1),
	(13, 'Weasley_ron', '2023-03-24 18:30:01', 'harryleboss12', 'member', 'Weasley_ron@forum.com', 1),
	(19, 'Patrick', '2023-03-28 09:14:34', '$2y$10$DPathRLH.st9ORBrgpnh9etEZchjW1bdFcOFXZQ375rqaRmEXI8/2', 'member', 'patrick@gmail.com', 1),
	(20, 'pierre', '2023-03-28 14:35:18', '$2y$10$vU55OoouzZV81zh2r9.kFeZe1lzM7hJ53vHzauoZpqRo/iPACIzjW', 'admin', 'pierre@gmail.com', 3),
	(21, 'Elanformation', '2023-03-30 08:46:14', '$2y$10$w/T/eslfbgitZKnCXMMx6um/ozmVz5XDy2TEn.vOxWW3y7jN8Sz2q', 'admin', 'elan@forum.com', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
