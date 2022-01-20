-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 20 jan. 2022 à 13:55
-- Version du serveur :  5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `article` text,
  `id_utilisateur` int(11) NOT NULL,
  `image` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `verif` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `article`, `id_utilisateur`, `image`, `date`, `verif`) VALUES
(5, 'CHAIMA ELLE A LE CORONA', 1, '1c9fe9bea24ea9ddcf7e1ac037596b48.jpg', '2022-01-07 13:05:16', 0),
(6, 'JASSIME  ELLEEEEE GIGAAAA DEUH', 1, '2556e915dfcc026625391a73c0cc3734.jpg', '2022-01-18 18:13:49', 0),
(7, 'MOHA IL EST TROPPP HLOUUUU', 1, '51701c18951d32244b6eceb55a72fdd9.jpg', '2022-01-18 18:15:25', 0),
(8, 'SAMI PINEAPPLE ', 1, 'dc39dc5c3c51d6b2ba07e43d4eab491b.jpg', '2022-01-18 18:16:36', 0),
(9, 'BADR ABONNEZ VOUS ', 1, '9d440bfb731d544d52fe1b2b7aced29f.jpg', '2022-01-18 18:17:37', 0),
(10, 'Mehdi chicha ', 1, 'fab51bf4668cab65fa14d35413ff96e4.jpg', '2022-01-18 18:19:20', 0),
(11, 'royan moula', 1, '3deb56366e62c4e60f406ea67c45331b.jpg', '2022-01-18 18:20:38', 0),
(12, 'LINA DROLE A - 20/20', 1, NULL, '2022-01-19 15:36:26', 0),
(13, 'LINA DRLE OU PAS ? REPONDEZ LA FAFA', 1, '7822bd5dc18ae3be5c792c8e486e056a.gif', '2022-01-19 15:41:29', 0),
(14, 'LINA DRLE OU PAS ? REPONDEZ LA FAFA', 1, '7822bd5dc18ae3be5c792c8e486e056a.gif', '2022-01-19 15:41:29', 0),
(15, 'que des n°10 dans ma team', 1, 'c5d71d77b16c287f98945e2cb3861614.jpg', '2022-01-19 15:43:48', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaire` varchar(1024) NOT NULL,
  `id_articles` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'modérateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` text,
  `id_droits` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `name`, `login`, `password`, `avatar`, `id_droits`) VALUES
(1, 'admin', 'admin', '$2y$12$hIrXxdXD8V654b.NdGte3.fwX4v5KxpglGLVWXkRdhSOAoJSeEBKG', '4bc576e13ea74d9155b6f2f1ffc9b993.jpg', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `droits`
--
ALTER TABLE `droits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `droits`
--
ALTER TABLE `droits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1338;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
