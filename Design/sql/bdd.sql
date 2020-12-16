-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 16 déc. 2020 à 11:11
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fredi`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

CREATE TABLE `adherent` (
  `email_util` varchar(50) NOT NULL,
  `lic_adh` varchar(50) NOT NULL,
  `sexe_adh` varchar(1) NOT NULL,
  `date_naissance_adh` date NOT NULL,
  `adr1_adh` varchar(50) NOT NULL,
  `adr2_adh` varchar(50) NOT NULL,
  `adr3_adh` varchar(50) NOT NULL,
  `id_club` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `adherent`
--

INSERT INTO `adherent` (`email_util`, `lic_adh`, `sexe_adh`, `date_naissance_adh`, `adr1_adh`, `adr2_adh`, `adr3_adh`, `id_club`) VALUES
('jeffadherent@jeff.com', '17 05 40 01', 'M', '2001-01-01', '', '', '', 5);

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE `club` (
  `id_club` int(11) NOT NULL,
  `lib_club` varchar(50) NOT NULL,
  `adr1_club` varchar(50) NOT NULL,
  `adr2_club` varchar(50) NOT NULL,
  `adr3_club` varchar(50) NOT NULL,
  `id_ligue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `club`
--

INSERT INTO `club` (`id_club`, `lib_club`, `adr1_club`, `adr2_club`, `adr3_club`, `id_ligue`) VALUES
(1, 'Dojo Burgien', '1 rue du Docteur DUBY', '1000', 'BOURG EN BRESSE', 6),
(2, 'Saint Denis Dojo', '239 Allées des sports', '1000', 'ST DENIS LES BOURG', 6),
(3, 'Judo Club Vallée Arbent', 'rue du Général ANDREA', '1100', 'ARBENT', 6),
(4, 'Belli Judo', '1 rue du Bac', '1100', 'BELLIGNAT', 6),
(5, 'Racing Club Montluel Judo', '170 rue des Chartinières', '1120', 'DAGNEUX', 6),
(6, 'Centre Arts Martiaux Pondinois', 'rue de l Oiselon', '1160', 'PONT D AIN', 6),
(7, 'Judo Club Ornex', '8 rue des Pralets', '1210', 'ORNEX', 6),
(8, 'Dojo Gessien Valserine', 'Avenue des Voirons', '1220', 'DIVONNE LES BAINS', 6),
(9, 'Dojo La Vallière', 'Complexe Sportif', '1250', '', 1),
(10, 'yyyy', '', '', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_de_frais`
--

CREATE TABLE `ligne_de_frais` (
  `id_ldf` int(11) NOT NULL,
  `date_ldf` date NOT NULL,
  `lib_trajet_ldf` varchar(50) NOT NULL,
  `cout_peage_ldf` decimal(10,0) NOT NULL,
  `cout_repas_ldf` decimal(10,0) NOT NULL,
  `cout_hebergement_ldf` decimal(10,0) NOT NULL,
  `nb_km_ldf` int(11) NOT NULL,
  `total_km_ldf` decimal(10,0) NOT NULL,
  `total_ldf` decimal(10,0) NOT NULL,
  `id_mdf` int(11) NOT NULL,
  `annee_per` int(11) NOT NULL,
  `email_util` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligne_de_frais`
--

INSERT INTO `ligne_de_frais` (`id_ldf`, `date_ldf`, `lib_trajet_ldf`, `cout_peage_ldf`, `cout_repas_ldf`, `cout_hebergement_ldf`, `nb_km_ldf`, `total_km_ldf`, `total_ldf`, `id_mdf`, `annee_per`, `email_util`) VALUES
(11, '2020-12-26', 'Trajet de test', '15', '10', '10', 100, '200', '35', 4, 2017, 'jeffadherent@jeff.com'),
(12, '2020-12-18', 'Trajet de test', '15', '10', '5', 20, '40', '70', 1, 2017, 'jeffadherent@jeff.com'),
(13, '0000-00-00', '0', '0', '0', '0', 1, '2', '2', 1, 2010, 'jeffadherent@jeff.com'),
(14, '2020-12-12', 'Trajet de test', '10', '10', '10', 10, '20', '1030', 1, 2010, 'jeffadherent@jeff.com'),
(15, '2020-12-17', 'Trajet de test', '10', '10', '10', 10, '20', '1030', 2, 2010, 'jeffadherent@jeff.com'),
(16, '2020-12-18', 'Trajet de test', '20', '25', '30', 50, '100', '5075', 1, 2010, 'jeffadherent@jeff.com'),
(17, '0000-00-00', '', '0', '0', '0', 0, '0', '0', 1, 2010, 'jeffadherent@jeff.com');

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

CREATE TABLE `ligue` (
  `id_ligue` int(11) NOT NULL,
  `lib_ligue` varchar(50) NOT NULL,
  `url_ligue` varchar(50) NOT NULL,
  `contact_ligue` varchar(50) NOT NULL,
  `telephone_ligue` varchar(50) NOT NULL,
  `email_util` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ligue`
--

INSERT INTO `ligue` (`id_ligue`, `lib_ligue`, `url_ligue`, `contact_ligue`, `telephone_ligue`, `email_util`) VALUES
(1, 'Natation', 'www.grandest.ffnatation.fr', 'www.grandest.ffnatation.fr', '03.83.18.87.32', 'jeffadmin@jeff.com'),
(2, 'Tennis', 'www.ligue-grandest-fft.fr', 'www.ligue-grandest-fft.fr', '03 83 67 60 10', 'jeffadmin@jeff.com'),
(3, 'Cyclisme', 'www.grandestcyclisme.fr', 'www.grandestcyclisme.fr', '09 61 06 27 79', 'jeffadmin@jeff.com'),
(4, 'Equitation', 'www.cregrandest.fr', 'www.cregrandest.fr', '03.83.15.87.30', 'jeffadmin@jeff.com'),
(5, 'Athlétisme', 'www.large.athle.fr', 'www.large.athle.fr', '03 26 06 75 83', 'jeffadmin@jeff.com'),
(6, 'Judo', 'www.judograndest.fr', 'www.judograndest.fr', '03 88 26 94 11', 'jeffadmin@jeff.com'),
(7, 'new1', 'ligur.com', 'contact', '06', 'b@b.com'),
(13, 'nouveautest', 'ligur.com', 'ééééé', '11111', 'a@a.com'),
(15, 'newddd', 'ligur.com', 'contact', '06', 'jeffcontroleur@jeff.com');

-- --------------------------------------------------------

--
-- Structure de la table `motif_de_frais`
--

CREATE TABLE `motif_de_frais` (
  `id_mdf` int(11) NOT NULL,
  `lib_mdf` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `motif_de_frais`
--

INSERT INTO `motif_de_frais` (`id_mdf`, `lib_mdf`) VALUES
(1, 'Réunion'),
(2, 'Compétition régionale'),
(3, 'Compétition nationale'),
(4, 'Compétition internationnale'),
(5, 'Stage');

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

CREATE TABLE `periode` (
  `annee_per` int(11) NOT NULL,
  `forfait_km_per` decimal(10,0) NOT NULL,
  `statut_per` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `periode`
--

INSERT INTO `periode` (`annee_per`, `forfait_km_per`, `statut_per`) VALUES
(2010, '50', 0),
(2017, '10', 1),
(2018, '15', 0),
(2020, '10', 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

CREATE TABLE `type_utilisateur` (
  `id_type_util` int(11) NOT NULL,
  `lib_type_util` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`id_type_util`, `lib_type_util`) VALUES
(1, 'administrateur'),
(2, 'contrôleur'),
(3, 'adhérent');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `email_util` varchar(50) NOT NULL,
  `password_util` varchar(255) NOT NULL,
  `nom_util` varchar(50) NOT NULL,
  `prenom_util` varchar(50) NOT NULL,
  `statut_util` varchar(1) NOT NULL,
  `matricule_cont` varchar(10) NOT NULL,
  `id_type_util` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email_util`, `password_util`, `nom_util`, `prenom_util`, `statut_util`, `matricule_cont`, `id_type_util`) VALUES
('a@a.com', '$2y$10$c93Gq8OaeZ9YOrMyRK.a5u7L4ouw8/1i6kaDJParxWiqqesBiOrKu', 'a', 'a', '0', '8946', 2),
('adhe@adhe.com', '$2y$10$WUjYWbL2mVa7RW8RfuabAOXHEk8MIIzwkEq8FBw5P0D6xizMt4BGW', 'adhe', 'adhe', '1', '', 3),
('admin@admin.com', '$2y$10$ZFKZk3VUF9EVD2UyN7LFu.aAQvx9RPEorJexYekeeWAKCEBTmVlZu', 'admin', 'admin9', '0', '', 1),
('b@b.com', '$2y$10$8OPygv9xbLVm354PB10deOLcGiHSRHohUJ2HX4fp2meMx4rT9rZze', 'b', 'b01', '0', '260', 2),
('cont@cont.com', '$2y$10$b6bEDS3b84OqyXDqL/c0/Ozd6ZomoOKagOUYnOnsxzlcI2/BENi5O', 'cont', 'cont', '0', '370', 2),
('cre@test.com', '$2y$10$Ho7G.P5sc8yOVcz6c712Pe91iHkVLpQM6Tv.Gel3YyzClhzhTSWC.', 'TestCré', 'TestCré', '1', '680', 2),
('jeffadherent@jeff.com', '$2y$10$WnlSaqHs4EUy3OdYewjCQ.xGl3qEPKtrMXttG/A7OVv1GvSJyXyvG', 'adherent', 'jeff', '0', '', 3),
('jeffadmin@jeff.com', '$2y$10$CfqzHirED8.zofAzoTA9Wu.njN2nOarXECtvzdAjhccbBVCeR9HTW', 'admin', 'jeff', '0', '', 1),
('jeffcontroleur@jeff.com', '$2y$10$Q5cEe548hY4boS.eTtP4mOrcokB026q21Xqc9SkkKwHtfUyV57eXe', 'controleur', 'jeff', '0', '1111', 2),
('oui@oui.fr', '$2y$10$RLbQ5TBLrrcRlj1TE9RxWOsemuUFAqUWd0/wFCtHOYwQ671A92Q4e', 'oui', 'oui', '0', '', 1),
('ree@po.com', '$2y$10$hPsL8wbxRtgBqH2Iv6GCg.xuxeBTOeexVorOGPayaNzYUff9se.Mm', 'aaa', 'aaa', '1', '816', 2),
('t@t.com', '$2y$10$lENynxofKIOMgSofgknKoeUZkxa12TNwGbwKuIdCnW8Fe5DbJ7Toe', 't', 't', '1', '', 1),
('test@test.com', '$2y$10$.LbVhBf/d1m2HnsPBwqZD.7lKlkIaglfsFnzyc2EQslyZVUsY7b4O', 'admin', 'test', '0', '', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`email_util`),
  ADD KEY `adherent_club0_FK` (`id_club`);

--
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id_club`),
  ADD KEY `club_ligue_FK` (`id_ligue`);

--
-- Index pour la table `ligne_de_frais`
--
ALTER TABLE `ligne_de_frais`
  ADD PRIMARY KEY (`id_ldf`),
  ADD KEY `ligne_de_frais_motif_de_frais_FK` (`id_mdf`),
  ADD KEY `ligne_de_frais_periode0_FK` (`annee_per`),
  ADD KEY `ligne_de_frais_adherent1_FK` (`email_util`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`id_ligue`),
  ADD KEY `ligue_utilisateur_FK` (`email_util`);

--
-- Index pour la table `motif_de_frais`
--
ALTER TABLE `motif_de_frais`
  ADD PRIMARY KEY (`id_mdf`);

--
-- Index pour la table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`annee_per`);

--
-- Index pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  ADD PRIMARY KEY (`id_type_util`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`email_util`),
  ADD KEY `utilisateur_type_utilisateur_FK` (`id_type_util`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `ligne_de_frais`
--
ALTER TABLE `ligne_de_frais`
  MODIFY `id_ldf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `ligue`
--
ALTER TABLE `ligue`
  MODIFY `id_ligue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `motif_de_frais`
--
ALTER TABLE `motif_de_frais`
  MODIFY `id_mdf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  MODIFY `id_type_util` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD CONSTRAINT `adherent_club0_FK` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`),
  ADD CONSTRAINT `adherent_utilisateur_FK` FOREIGN KEY (`email_util`) REFERENCES `utilisateur` (`email_util`);

--
-- Contraintes pour la table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_ligue_FK` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`);

--
-- Contraintes pour la table `ligne_de_frais`
--
ALTER TABLE `ligne_de_frais`
  ADD CONSTRAINT `ligne_de_frais_adherent1_FK` FOREIGN KEY (`email_util`) REFERENCES `adherent` (`email_util`),
  ADD CONSTRAINT `ligne_de_frais_motif_de_frais_FK` FOREIGN KEY (`id_mdf`) REFERENCES `motif_de_frais` (`id_mdf`),
  ADD CONSTRAINT `ligne_de_frais_periode0_FK` FOREIGN KEY (`annee_per`) REFERENCES `periode` (`annee_per`);

--
-- Contraintes pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD CONSTRAINT `ligue_utilisateur_FK` FOREIGN KEY (`email_util`) REFERENCES `utilisateur` (`email_util`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_type_utilisateur_FK` FOREIGN KEY (`id_type_util`) REFERENCES `type_utilisateur` (`id_type_util`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
