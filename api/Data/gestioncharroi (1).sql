-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 15 août 2024 à 15:08
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestioncharroi`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) NOT NULL,
  `matricule` varchar(20) NOT NULL,
  `noms` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `dateNaissance` date NOT NULL,
  `lieuNaissance` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id`, `matricule`, `noms`, `category`, `dateNaissance`, `lieuNaissance`, `email`, `tel`, `photo`) VALUES
(1, 'CHA0001', 'BWIRABUCIZA Blondy', 'Chauffeur', '0000-00-00', 'Bukavu', 'achilleblondy@gmail.com', '0999249863', '../images/95e95850-218c-4c77-8c8c-9dd8d7eefc34.jpg'),
(4, 'MEC0002', 'Kasereka Saambili Lievin', 'Mecanicien', '1999-09-20', 'Goma', 'saambililievin@gmail.com', '0993170074', '../images/favicon.png'),
(5, 'MEC0002', 'Kylian Mbappe', 'Mecanicien', '1999-09-20', 'Goma', 'kylyan@gmail.com', '0970488287', '../images/Blue Waves Surfing Club Logo.png');

-- --------------------------------------------------------

--
-- Structure de la table `all_log`
--

CREATE TABLE `all_log` (
  `id_psw` int(11) NOT NULL,
  `Id_adm` int(11) DEFAULT NULL,
  `psw` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `all_log`
--

INSERT INTO `all_log` (`id_psw`, `Id_adm`, `psw`) VALUES
(3, 16, 'f7c3bc1d808e04732adf679965ccc34ca7ae3441'),
(4, 17, 'f7c3bc1d808e04732adf679965ccc34ca7ae3441');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `designation`) VALUES
(1, 'Huile');

-- --------------------------------------------------------

--
-- Structure de la table `cat_user`
--

CREATE TABLE `cat_user` (
  `Id_cat` int(11) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cat_user`
--

INSERT INTO `cat_user` (`Id_cat`, `designation`, `date_add`) VALUES
(1, 'chef', '2024-06-15 14:25:50'),
(2, 'magasinier', '2024-06-15 14:25:50');

-- --------------------------------------------------------

--
-- Structure de la table `mouvement`
--

CREATE TABLE `mouvement` (
  `id` int(11) NOT NULL,
  `quantite` float DEFAULT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mouvement`
--

INSERT INTO `mouvement` (`id`, `quantite`, `type`) VALUES
(1, 20, 'Entree'),
(2, 2, 'Entree');

-- --------------------------------------------------------

--
-- Structure de la table `mouvement_vh`
--

CREATE TABLE `mouvement_vh` (
  `id` int(11) NOT NULL,
  `idVeh` int(11) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `trajet` decimal(10,2) DEFAULT NULL,
  `consommation` decimal(10,2) DEFAULT NULL,
  `type_carburant` varchar(50) DEFAULT NULL,
  `dateSortie` date DEFAULT NULL,
  `dateRetour` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mouvement_vh`
--

INSERT INTO `mouvement_vh` (`id`, `idVeh`, `destination`, `trajet`, `consommation`, `type_carburant`, `dateSortie`, `dateRetour`) VALUES
(1, 1, 'Rumangabo', '27.00', '1200.00', 'Mazout', '2024-08-15', '2024-08-15');

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

CREATE TABLE `piece` (
  `id` int(11) NOT NULL,
  `idCat` int(11) DEFAULT NULL,
  `designation` varchar(50) NOT NULL,
  `quantite` float DEFAULT NULL,
  `dateEntree` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `piece`
--

INSERT INTO `piece` (`id`, `idCat`, `designation`, `quantite`, `dateEntree`) VALUES
(1, 1, 'Huile de Frein', 20, '2024-08-14'),
(5, 1, 'Huile moteur', 30, '2024-09-15');

-- --------------------------------------------------------

--
-- Structure de la table `reparation`
--

CREATE TABLE `reparation` (
  `id` int(11) NOT NULL,
  `idAgent` int(11) DEFAULT NULL,
  `idVehicule` int(11) DEFAULT NULL,
  `panne` varchar(50) NOT NULL,
  `dateRep` date DEFAULT NULL,
  `duree` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `idPiece` int(11) DEFAULT NULL,
  `idMouv` int(11) DEFAULT NULL,
  `QteEntree` float DEFAULT NULL,
  `QteSortie` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `dateStock` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `idPiece`, `idMouv`, `QteEntree`, `QteSortie`, `total`, `dateStock`) VALUES
(1, 1, 1, 40, 0, 40, '2024-08-14'),
(2, 5, 2, 54, 4, 50, '2024-09-15');

-- --------------------------------------------------------

--
-- Structure de la table `user_admin`
--

CREATE TABLE `user_admin` (
  `id_adm` int(11) NOT NULL,
  `Id_cat` int(11) NOT NULL,
  `matricule` varchar(20) NOT NULL,
  `nom_a` varchar(50) NOT NULL,
  `prenom_a` varchar(50) NOT NULL,
  `email_a` varchar(100) DEFAULT NULL,
  `phone_a` varchar(15) DEFAULT NULL,
  `adresse` varchar(50) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user_admin`
--

INSERT INTO `user_admin` (`id_adm`, `Id_cat`, `matricule`, `nom_a`, `prenom_a`, `email_a`, `phone_a`, `adresse`, `date_add`) VALUES
(16, 1, 'CHE0001', 'Emmanuel', 'Kabanangi', 'emmanuel@gmail.com', '099933446654', 'Goma', '2024-08-14 14:43:45'),
(17, 2, 'MAG0001', 'Jeannette', 'Nikuzwe', 'jeannette@gmail.com', '099933446653', 'Goma', '2024-08-14 14:46:04');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `idAgent` int(11) DEFAULT NULL,
  `designation` varchar(50) NOT NULL,
  `marque` varchar(20) NOT NULL,
  `numP` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `type_carburant` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `idAgent`, `designation`, `marque`, `numP`, `category`, `type_carburant`) VALUES
(1, 1, 'Camion C++', 'Volvo', '2KI89TUVL-GOMA', 'Poids Lourd', '12cvh');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `tel` (`tel`);

--
-- Index pour la table `all_log`
--
ALTER TABLE `all_log`
  ADD PRIMARY KEY (`id_psw`),
  ADD KEY `Id_adm` (`Id_adm`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cat_user`
--
ALTER TABLE `cat_user`
  ADD PRIMARY KEY (`Id_cat`);

--
-- Index pour la table `mouvement`
--
ALTER TABLE `mouvement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mouvement_vh`
--
ALTER TABLE `mouvement_vh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idVeh` (`idVeh`);

--
-- Index pour la table `piece`
--
ALTER TABLE `piece`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pi` (`idCat`);

--
-- Index pour la table `reparation`
--
ALTER TABLE `reparation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gf_ui` (`idAgent`),
  ADD KEY `fg_ty` (`idVehicule`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `op_ui` (`idPiece`),
  ADD KEY `mn_lo` (`idMouv`);

--
-- Index pour la table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_adm`),
  ADD UNIQUE KEY `phone_a` (`phone_a`),
  ADD KEY `fk_descat` (`Id_cat`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ft_oi` (`idAgent`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `all_log`
--
ALTER TABLE `all_log`
  MODIFY `id_psw` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `cat_user`
--
ALTER TABLE `cat_user`
  MODIFY `Id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `mouvement`
--
ALTER TABLE `mouvement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `mouvement_vh`
--
ALTER TABLE `mouvement_vh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `piece`
--
ALTER TABLE `piece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `reparation`
--
ALTER TABLE `reparation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `all_log`
--
ALTER TABLE `all_log`
  ADD CONSTRAINT `all_log_ibfk_1` FOREIGN KEY (`Id_adm`) REFERENCES `user_admin` (`id_adm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mouvement_vh`
--
ALTER TABLE `mouvement_vh`
  ADD CONSTRAINT `mouvement_vh_ibfk_1` FOREIGN KEY (`idVeh`) REFERENCES `vehicule` (`id`);

--
-- Contraintes pour la table `piece`
--
ALTER TABLE `piece`
  ADD CONSTRAINT `fk_pi` FOREIGN KEY (`idCat`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reparation`
--
ALTER TABLE `reparation`
  ADD CONSTRAINT `fg_ty` FOREIGN KEY (`idVehicule`) REFERENCES `vehicule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gf_ui` FOREIGN KEY (`idAgent`) REFERENCES `agent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `mn_lo` FOREIGN KEY (`idMouv`) REFERENCES `mouvement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `op_ui` FOREIGN KEY (`idPiece`) REFERENCES `piece` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_admin`
--
ALTER TABLE `user_admin`
  ADD CONSTRAINT `fk_descat` FOREIGN KEY (`Id_cat`) REFERENCES `cat_user` (`Id_cat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `ft_oi` FOREIGN KEY (`idAgent`) REFERENCES `agent` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
