/* création de la database */
drop DATABASE if exists  RallyeLecture;
CREATE DATABASE RallyeLecture;

/* on se positionne sur la base Rallye */
use RallyeLecture;

/* suppression puis création de la table éditeur */
drop table if exists editeur;

create table editeur(
id int auto_increment not null,
nom varchar (30)
primary key(id))engine=innodb;


/* suppression puis création de la table auteur */
drop table if exists auteur;

create table auteur(
id int auto_increment not null,
nom varchar (30)
primary key(id))engine=innodb;

/* suppression puis création de la table livre */
drop table if exists livre;

create table livre(
id int  not null,
titre varchar (45),
couverture varchar (100),
idAuteur int,
idEditeur int,
primary key(id),
foreign key (idEditeur) references editeur(id),
foreign key (idAuteur) references auteur(id))engine=innodb;

/* suppression puis création de la table question */
drop table if exists question;

create table question(
id int  not null,
question varchar (225),
points int,
idLivre int,
primary key (id),
foreign key (idLivre) references livre (id))engine=innodb;

/* suppression puis création de la table propositon */
drop table if exists proposition;

create table proposition(
id int  not null,
idQuestion int ,
proposition varchar(255),
solution int,
primary key (id),
foreign key (idQuestion) references question (id))engine=innodb;



/* suppression puis création de la table rallye */
drop table if exists rallye;

create table rallye(
id int,
dateDebut date,
duree int,
theme varchar (45),
primary key(id))engine=innodb;

/* suppression puis création de la table comporter */
drop table if exists comporter;

create table comporter(
idLivre int,
idRallye int,
foreign key (idLivre) references Livre (id),
foreign key (idRallye) references Rallye (id))engine=innodb;

/* suppression puis création de la table participer */
drop table if exists participer;

create table participer(
idRallye int,
idEleve int,
foreign key (idRallye) references Rallye (id),
foreign key (idEleve) references Eleve (id))engine=innodb;

/* suppression puis création de la table eleve */
drop table if exists eleve;

create table eleve(
    id int auto_increment not null,
    idClasse int,
    nom varchar (30),
    prenom varchar (20),
    loginv varchar (100),
    idAuth int,
    )engine=innodb;

/* suppression puis création de la table reponse */
drop table if exists reponse;

create table reponse(
idParticiperRallye int,
idParticiperEleve int,
idQuestion int,
idProposition int)engine=innodb;

/* suppression puis création de la table classe */
drop table if exists classe;

create table classe(
id int,
idEnseignant int,
anneeScolaire varchar (45),
idNiveau int)engine=innodb;

/* suppression puis création de la table enseignant */
drop table if exists enseignant ;

create table enseignant(
id int,
nom varchar (30),
prenom varchar (45),
loginE varchar (100),
idAuth int)engine=innodb;

/* suppression puis création de la table enseignant */
drop table if exists niveau(
id int,
niveauScolaire varchar(45))engine=innodb;














