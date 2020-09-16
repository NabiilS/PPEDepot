/* création de la database */
drop DATABASE if exists RallyeLecture;
CREATE DATABASE RallyeLecture;

/* on se positionne sur la base Rallye */
use RallyeLecture;


/* suppression puis création de la table livre */
drop table if exists livre;

create table livre(
idLivre int not null auto_increment,
titre varchar (45),
couverture varchar (100),
idAuteur int,
idEditeur int,
index (idLivre))engine=innodb;

/* old code
primary key(idLivre),
foreign key (idEditeur) references editeur(idEditeur),
foreign key (idAuteur) references auteur(idAuteur))engine=innodb;
*/

/* suppression puis création de la table éditeur */
drop table if exists editeur;

create table editeur(
idEditeur int auto_increment not null,
nom varchar (60),
index (idEditeur))engine=innodb;

/* suppression puis création de la table auteur */
drop table if exists auteur;

create table auteur(
idAuteur int auto_increment not null,
nom varchar (60),
index (idAuteur))engine=innodb;

/* suppression puis création de la table question */
drop table if exists question;

create table question(
idQuestion int not null auto_increment,
question varchar (225),
points int,
idLivre int,
index(idQuestion))engine=innodb;
/*
foreign key (idLivre) references livre (idLivre)*/

/* suppression puis création de la table propositon */
drop table if exists proposition;

create table proposition(
idProposition int not null auto_increment,
idQuestion int,
proposition varchar(255),
solution int,
index(idProposition))engine=innodb;
/* foreign key (idQuestion) references question (idQuestion)*/



/* suppression puis création de la table rallye */
drop table if exists rallye;

create table rallye(
idRallye int,
dateDebut date,
duree int,
theme varchar (45))engine=innodb;

/* suppression puis création de la table comporter */
drop table if exists comporter;

create table comporter(
idLivre int,
idRallye int)engine=innodb;
/*foreign key (idLivre) references Livre (idLivre),
foreign key (idRallye) references Rallye (idRallye)*/

/* suppression puis création de la table classe */
drop table if exists classe;

create table classe(
idClasse int,
idEnseignant int,
anneeScolaire varchar (45),
idNiveau int)engine=innodb;

/*primary key(idClasse),
foreign key (idEnseignant) references enseignant(idEnseignant),
foreign key (idNiveau) references niveau(idEnseignant)*/


/* suppression puis création de la table enseignant */
drop table if exists niveau;

create table niveau(
idNiveau int,
niveauScolaire varchar(45))engine=innodb;

/*primary key(idNiveau)*/

/* suppression puis création de la table eleve */
drop table if exists eleve;

create table eleve(
    idEleve int not null auto_increment,
    idClasse int,
    nom varchar (30),
    prenom varchar (20),
    loginv varchar (100),
    idAuth int,
    index (idEleve))engine=innodb;

    /*primary key (idEleve),
    foreign key (idClasse) references classe (idClasse)*/



/* suppression puis création de la table participer */
drop table if exists participer;

create table participer(
idRallye int,
idEleve int)engine=innodb;

/*foreign key (idRallye) references Rallye (idRallye),
foreign key (idEleve) references Eleve (idEleve)*/

/* suppression puis création de la table reponse */
drop table if exists reponse;

create table reponse(
idParticiperRallye int,
idParticiperEleve int,
idQuestion int,
idProposition int)engine=innodb;
/*primary key (idParticiperEleve),
primary key (idParticiperRallye),
foreign key (idProposition) references proposition (idProposition)*/
/* suppression puis création de la table enseignant */

drop table if exists enseignant;

create table enseignant(
idEnseignant int,
nom varchar (30),
prenom varchar (45),
loginE varchar (100),
idAuth int)engine=innodb;
/*primary key(idEnseignant)*/


