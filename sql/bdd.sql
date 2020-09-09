#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


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


#------------------------------------------------------------
# Table: type_utilisateur
#------------------------------------------------------------

CREATE TABLE type_utilisateur(
        id_type_util  Int  Auto_increment  NOT NULL ,
        lib_type_util Varchar (50) NOT NULL
	,CONSTRAINT type_utilisateur_PK PRIMARY KEY (id_type_util)
)ENGINE=InnoDB;


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