-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 29 mars 2023 à 20:48
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum_pierre`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `nomCategorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nomCategorie`) VALUES
(3, 'Jeux-Vidéos'),
(4, 'Informatique'),
(5, 'Voitures'),
(6, 'Sports'),
(7, 'Cinéma'),
(8, 'Cuisine');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `texte` text NOT NULL,
  `dateCreationPost` datetime DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `texte`, `dateCreationPost`, `topic_id`, `user_id`) VALUES
(10, 'Salut tout le monde, \r\n\r\nPour ma tarte au citron, je met 200g de sucre, une pate brisée, des citrons verts frais et un peu de canelle. Je fais cuire ça au four pendant 20min et après je laisse reposer 1h au frigo, puis je met du sucre glace dessus ! Qu’est ce que vous en pensez ? Partagez aussi vos recettes, j’aimerais tester des nouvelles choses ! ', '2023-03-24 18:34:45', 11, 11),
(11, 'Salut ! La saison 2 de warzone arrive a grand pas quelles sont vos attentes pour cette nouvelle saison ? ', '2023-03-24 18:35:35', 7, 8),
(13, 'comment hacker un site et récuperer les mots de passe de tout le monde svp ?', '2023-03-24 18:37:02', 12, 12),
(15, 'Salut je suis bloqué sur un bout de code depuis 3 jours ça ne fonctionne pas help me please ! Voila le code : \r\n\r\nif(isset($fieldArray[1]) && $fieldArray[1] == \"id\"){\r\n                    $manName = ucfirst($fieldArray[0]).\"Manager\";\r\n                    $FQCName = \"Model\\Managers\".\"\\\\\".$manName;\r\n\r\nMerci ', '2023-03-24 18:38:47', 9, 10),
(16, 'j\'ouvre un petit débat vous preferez php ou javascript ? ', '2023-03-24 18:39:12', 8, 9),
(93, 'test', '2023-03-29 14:23:57', 9, 20),
(111, 'post', '2023-03-29 15:25:49', 14, 20);

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE `topic` (
  `id_topic` int(11) NOT NULL,
  `nomTopic` varchar(50) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `dateCreationTopic` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id_topic`, `nomTopic`, `locked`, `dateCreationTopic`, `user_id`, `categorie_id`) VALUES
(7, 'Warzone 2 : nouvelle saison le 12 fevrier', 1, '2023-03-24 18:34:03', 8, 3),
(8, 'Quel est le meilleur langage entre Php et JS ?', 0, '2023-03-24 18:34:03', 9, 4),
(9, 'Bloqué sur un bout de code', 0, '2023-03-24 18:34:03', 10, 4),
(11, 'Avis sur ma recette de tarte au citron', 0, '2023-03-24 18:34:03', 11, 8),
(12, 'Comment hacker un site ?', 1, '2023-03-24 18:34:03', 12, 4),
(14, 'Golf 8 ou class A 2022 ? ', 0, '2023-03-24 18:47:00', 12, 5),
(85, 'rerzer', 0, '2023-03-29 22:46:39', 11, 8);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `dateInscription`, `password`, `role`, `email`) VALUES
(8, 'Xxx-Killerx-XX', '2023-03-24 18:27:52', 'KillerCod56', 'member', 'Xxx-Killerx-XX@forum.com'),
(9, 'BillGates_', '2023-03-24 18:28:25', 'gatesbill12', 'member', 'BillGates_@forum.com'),
(10, 'Nakamoto', '2023-03-24 18:28:53', 'pomme12x', 'member', 'Nakamato@forum.com'),
(11, 'Etchebest-Phil', '2023-03-24 18:29:34', 'topchef21', 'member', 'Etchebest-Phil@forum.com'),
(12, 'Techland_12', '2023-03-24 18:29:34', 'kingtech14', 'member', 'Techland_12@forum.com'),
(13, 'Weasley_ron', '2023-03-24 18:30:01', 'harryleboss12', 'member', 'Weasley_ron@forum.com'),
(19, 'Patrick', '2023-03-28 09:14:34', '$2y$10$DPathRLH.st9ORBrgpnh9etEZchjW1bdFcOFXZQ375rqaRmEXI8/2', 'member', 'patrick@gmail.com'),
(20, 'pierre', '2023-03-28 14:35:18', '$2y$10$vU55OoouzZV81zh2r9.kFeZe1lzM7hJ53vHzauoZpqRo/iPACIzjW', 'admin', 'pierre@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`) USING BTREE;

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `membre_id` (`user_id`);

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id_topic`),
  ADD KEY `id_membre` (`user_id`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `membre_id` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
