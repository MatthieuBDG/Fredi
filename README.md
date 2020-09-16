## Description

Sujet PROJET FREDI pour le BTS SIO deuxième année.

Ce sujet nous amène a construire une application avec PHP et MYSQL pour que les frais des adhérents de clubs seront remplis en ligne , sur notre site Web . Ce site web (appelé FREDI WEB) sera accessible par l’ensemble des clubs hébergés par la Maison des Ligues de Lorraine.

---

## Droit

Le site n'est accessible que par inscription et hachage du mot de passe.

On définit les droit de différents profils :    
utilisateur , administrateur , adhérent

Utilisateurs de test : 
- (admin) : pseudo = jeff, password = jeff;
- (Adhérent) : pseudo = jeff1, password = jeff1;
- (Utilisateur) : pseudo = jeff2, password = jeff2;
----
## Utilisation 
On s'inscrit puis les frais peuvent être saissis par les adhérents . Cette saisie peut commencer dès l'ouverture de la période annuelle début janvier

---

## Installation 
- Télécharger le dossier "FREDI" depuis GitHub. 
- Placer le dossier sur le serveur web.
- Intégrer la base de données, dans le serveur de base de données, à partir du fichier "bdd.sql" contenu dans le dossier "Design".

---


### Cas d'utilisation de FREDI

| Droit | Libelle|
| ------| ------ | 
| ADMINISTRATEUR | Importer les données des users ADHERENT |
| ADMINISTRATEUR | Importer les données des CLUBS |
| ADMINISTRATEUR | Importer les données des LIGUES |
| ADMINISTRATEUR | Importer les données MOTIF DE FRAIS |
| ADMINISTRATEUR | Créer une PERIODE |
| ADMINISTRATEUR | Modifier une PERIODE |
| ADMINISTRATEUR | Désactiver une PERIODE |
| ADMINISTRATEUR | Consulter une PERIODE |
| ADMINISTRATEUR | Se connecter à l'application |
| ADMINISTRATEUR | Se déconnecter à l'application |
| ADMINISTRATEUR | Demander le renvoi du mot de passe |
| CONTROLEUR | Changer le statut d'une LIGNE DE FRAIS |
| CONTROLEUR | Consulter de la LISTE DE FRAIS sur l'application WEB |
| CONTROLEUR | Générer le CERFA  |
| CONTROLEUR | Se connecter à l'application |
| CONTROLEUR | Se déconnecter à l'application |
| ADHERENT | Créer une LIGNE DE FRAIS |
| ADHERENT | Modifier une LIGNE DE FRAIS |
| ADHERENT | Supprimer une LIGNE DE FRAIS |
| ADHERENT | Changer le statut d'une LIGNE DE FRAIS |
| ADHERENT | Consulter les LIGNES DE FRAIS sur une application WEB|
| ADHERENT | Consulter les LIGNES DE FRAIS sur une application MOBILE |
| ADHERENT | Générer le bordereau d'un adhérent majeur avec responsable légal |
| ADHERENT | Demander le renvoi du mot de passe |
| ADHERENT | Se connecter à l'application |
| ADHERENT | Se déconnecter à l'application |


## Taches 


- [X] Lot 0. Conception de la base de données
- [x] Lot 1. Connexion (tous les rôles) 
- [X] Lot 1. Cas d'utilisation 
- [] Lot 2. Gestion des utilisateurs(CRUD / CSV)  
- [] Lot 3. Gestion des périodes et motifs(CRUD / CSV)  
- [] Lot 4. Gestion des clubs et ligues(CRUD/CSV)  
- [] Lot 5. Gestion des lignes de frais (CRUD)
- [] Lot 6. Edition bordereau et CERFA (PDF)
- [] Lot 7 : Web service (REST/JSON pourandroid)


--- 
## Versions


### V1.2 16/09/2020

Base de données , Connexion et déconnexion 
- 

### V1.*** 20/03/2020



---

### V1.*** 20/03/2020


---
## Team 

Lucas Dalla Costa

Matthieu Boubee de Gramont

Mathias Bourdim



