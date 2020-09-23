#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

#------------------------------------------------------------
# Create database
#------------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `fredi` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fredi`;

#------------------------------------------------------------
# Table: periode
#------------------------------------------------------------


CREATE TABLE periode(
        annee_per      Int NOT NULL ,
        forfait_km_per Decimal NOT NULL ,
        statut_per     Int NOT NULL
	,CONSTRAINT periode_PK PRIMARY KEY (annee_per)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: motif_de_frais
#------------------------------------------------------------

CREATE TABLE motif_de_frais(
        id_mdf  Int  Auto_increment  NOT NULL ,
        lib_mdf Varchar (50) NOT NULL
	,CONSTRAINT motif_de_frais_PK PRIMARY KEY (id_mdf)
)ENGINE=InnoDB;

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


#------------------------------------------------------------
# Table: type_utilisateur
#------------------------------------------------------------

CREATE TABLE type_utilisateur(
        id_type_util  Int  Auto_increment  NOT NULL ,
        lib_type_util Varchar (50) NOT NULL
	,CONSTRAINT type_utilisateur_PK PRIMARY KEY (id_type_util)
)ENGINE=InnoDB;

--
-- Déchargement des données de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`id_type_util`, `lib_type_util`) VALUES
(1, 'administrateur'),
(2, 'contrôleur'),
(3, 'adhérent');


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        email_util     Varchar (50) NOT NULL ,
        password_util  Varchar (255) NOT NULL ,
        nom_util       Varchar (50) NOT NULL ,
        prenom_util    Varchar (50) NOT NULL ,
        statut_util    Varchar (1) NOT NULL ,
        matricule_cont Varchar (10) NOT NULL ,
        id_type_util   Int NOT NULL
	,CONSTRAINT utilisateur_PK PRIMARY KEY (email_util)

	,CONSTRAINT utilisateur_type_utilisateur_FK FOREIGN KEY (id_type_util) REFERENCES type_utilisateur(id_type_util)
)ENGINE=InnoDB;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email_util`, `password_util`, `nom_util`, `prenom_util`, `statut_util`, `matricule_cont`, `id_type_util`) VALUES
('dclucas31@gmail.com', 'mdp115', 'DC', 'Lucas', '0', '123', 1),
('jeffadherent@jeff.com', 'adherent', 'adherent', 'jeff', '0', '0', 3),
('jeffcontroleur', 'controleur', 'controleur', 'jeff', '0', '0', 2),
('jeffadmin@jeff.com', 'admin', 'admin', 'jeff', '0', '0', 1);

#------------------------------------------------------------
# Table: ligue
#------------------------------------------------------------

CREATE TABLE ligue(
        id_ligue        Int  Auto_increment  NOT NULL ,
        lib_ligue       Varchar (50) NOT NULL ,
        URL_ligue       Varchar (50) NOT NULL ,
        contact_ligue   Varchar (50) NOT NULL ,
        telephone_ligue Varchar (50) NOT NULL ,
        email_util      Varchar (50) NOT NULL
	,CONSTRAINT ligue_PK PRIMARY KEY (id_ligue)

	,CONSTRAINT ligue_utilisateur_FK FOREIGN KEY (email_util) REFERENCES utilisateur(email_util)
)ENGINE=InnoDB;

--
-- Déchargement des données de la table `ligue`
--

INSERT INTO `ligue` (`id_ligue`, `lib_ligue`, `URL_ligue`, `contact_ligue`, `telephone_ligue`, `email_util`) VALUES
(1, 'Natation', 'www.grandest.ffnatation.fr', 'www.grandest.ffnatation.fr', '03.83.18.87.32', 'jeffadmin@jeff.com'),
(2, 'Tennis', 'www.ligue-grandest-fft.fr', 'www.ligue-grandest-fft.fr', '03 83 67 60 10', 'jeffadmin@jeff.com'),
(3, 'Cyclisme', 'www.grandestcyclisme.fr', 'www.grandestcyclisme.fr', '09 61 06 27 79', 'jeffadmin@jeff.com'),
(4, 'Equitation', 'www.cregrandest.fr', 'www.cregrandest.fr', '03.83.15.87.30', 'jeffadmin@jeff.com'),
(5, 'Athlétisme', 'www.large.athle.fr', 'www.large.athle.fr', '03 26 06 75 83', 'jeffadmin@jeff.com'),
(6, 'Judo', 'www.judograndest.fr', 'www.judograndest.fr', '03 88 26 94 11', 'jeffadmin@jeff.com');



-- --------------------------------------------------------


#------------------------------------------------------------
# Table: club
#------------------------------------------------------------
        
CREATE TABLE club(
        id_club   Int  Auto_increment  NOT NULL ,
        lib_club  Varchar (50) NOT NULL ,
        adr1_club Varchar (50) NOT NULL ,
        adr2_club Varchar (50) NOT NULL ,
        adr3_club Varchar (50) NOT NULL ,
        id_ligue  Int NOT NULL
	,CONSTRAINT club_PK PRIMARY KEY (id_club)

	,CONSTRAINT club_ligue_FK FOREIGN KEY (id_ligue) REFERENCES ligue(id_ligue)
)ENGINE=InnoDB;

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
(9, 'Dojo La Vallière', 'Complexe Sportif', '1250', 'MONTAGNAT', 6);

-- --------------------------------------------------------


#------------------------------------------------------------
# Table: adherent
#------------------------------------------------------------

CREATE TABLE adherent(
        email_util         Varchar (50) NOT NULL ,
        lic_adh            Varchar (50) NOT NULL ,
        sexe_adh           Varchar (1) NOT NULL ,
        date_naissance_adh Date NOT NULL ,
        adr1_adh           Varchar (50) NOT NULL ,
        adr2_adh           Varchar (50) NOT NULL ,
        adr3_adh           Varchar (50) NOT NULL ,
        id_club            Int NOT NULL
	,CONSTRAINT adherent_PK PRIMARY KEY (email_util)

	,CONSTRAINT adherent_utilisateur_FK FOREIGN KEY (email_util) REFERENCES utilisateur(email_util)
	,CONSTRAINT adherent_club0_FK FOREIGN KEY (id_club) REFERENCES club(id_club)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: ligne_de_frais
#------------------------------------------------------------

CREATE TABLE ligne_de_frais(
        id_ldf               Int NOT NULL ,
        date_ldf             Date NOT NULL ,
        lib_trajet_ldf       Varchar (50) NOT NULL ,
        cout_peage_ldf       Decimal NOT NULL ,
        cout_repas_ldf       Decimal NOT NULL ,
        cout_hebergement_ldf Decimal NOT NULL ,
        nb_km_ldf            Int NOT NULL ,
        total_km_ldf         Decimal NOT NULL ,
        total_ldf            Decimal NOT NULL ,
        id_mdf               Int NOT NULL ,
        annee_per            Int NOT NULL ,
        email_util           Varchar (50) NOT NULL
	,CONSTRAINT ligne_de_frais_PK PRIMARY KEY (id_ldf)

	,CONSTRAINT ligne_de_frais_motif_de_frais_FK FOREIGN KEY (id_mdf) REFERENCES motif_de_frais(id_mdf)
	,CONSTRAINT ligne_de_frais_periode0_FK FOREIGN KEY (annee_per) REFERENCES periode(annee_per)
	,CONSTRAINT ligne_de_frais_adherent1_FK FOREIGN KEY (email_util) REFERENCES adherent(email_util)
)ENGINE=InnoDB;