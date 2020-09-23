/* --- Alter table livre --- */

Alter table livre
add constraint pk_livre PRIMARY KEY (idLivre);

Alter table livre
add constraint fk_livre_idEditeur 
foreign key (idEditeur) references editeur(idEditeur),
add constraint fk_livre_idAuteur
foreign key (idAuteur) references auteur(idAuteur);

/* --- Alter table editeur --- */
Alter table editeur
add constraint pk_Editeur PRIMARY KEY (idEditeur);

/*--- Alter table auteur --- */
Alter table auteur 
add constraint pk_auteur PRIMARY key (idAuteur);

/* --- Alter table question --- */
Alter table question
add constraint pk_Question PRIMARY KEY (idQuestion);
Alter table question
add constraint fk_question_idLivre foreign key (idLivre) references livre(idLivre);

/*--- Alter table proposition --- */
Alter table proposition
add constraint pk_Proposition primary key (idProposition);

/*--- Alter table rallye --- */
Alter table rallye
add constraint pk_rallye primary key (idRallye); 

/*--- Alter table comporter --- */
alter table comporter 
add constraint fk_comporter_idLivre foreign key (idLivre) references Livre (idLivre),
add constraint fk_comporter_idRallye foreign key (idRallye) references Rallye (idRallye);

/*--- Alter table classe --- */
alter table classe 
add constraint pk_classe primary key (idClasse),
add constraint fk_classe_idNiveau foreign key (idNiveau) references niveau (idNiveau),
add constraint fk_classe_idEnseignant foreign key (idEnseignant) references enseignant(idEnseignant);

/*--- Alter table niveau --- */
alter table niveau
add constraint pk_niveau primary key (idNiveau);


/*--- Alter table eleve --- */
alter table eleve
add constraint pk_Eleve primary key (idEleve),
add constraint fk_eleve_idClasse foreign key (idClasse) references classe (idClasse); 


/*--- Alter table participer --- */
alter table participer
add constraint fk_participer_idRallye foreign key (idRallye) references Rallye (idRallye),
add constraint fk_participer_idEleve foreign key (idEleve) references Eleve (idEleve);


/*--- Alter table reponse --- */

alter table reponse
add constraint pk_reponse primary key (idParticiperEleve, idParticiperRallye),
add constraint fk_reponse_IdProposition foreign key (idProposition) references proposition (idProposition);


/*--- Alter table enseignant --- */
alter table enseignant
add constraint pk_enseignant primary key (idEnseignant);



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

/* suppression puis création de la table propositon */
drop table if exists proposition;

create table proposition(
idProposition int not null auto_increment,
idQuestion int,
proposition varchar(255),
solution int,
index(idProposition))engine=innodb;

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

/* suppression puis création de la table classe */
drop table if exists classe;

create table classe(
idClasse int not null auto_increment,
idEnseignant int,
anneeScolaire varchar (45),
idNiveau int,
index (idClasse))engine=innodb;

/* suppression puis création de la table enseignant */
drop table if exists niveau;

create table niveau(
idNiveau int not null auto_increment,
niveauScolaire varchar(45),
index(idNiveau))engine=innodb;

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

/* suppression puis création de la table participer */
drop table if exists participer;

create table participer(
idRallye int,
idEleve int)engine=innodb;

/* suppression puis création de la table reponse */
drop table if exists reponse;

create table reponse(
idParticiperRallye int,
idParticiperEleve int,
idQuestion int,
idProposition int)engine=innodb;

drop table if exists enseignant;

create table enseignant(
idEnseignant int not null auto_increment,
nom varchar (30),
prenom varchar (45),
loginE varchar (100),
idAuth int,
index (idEnseignant))engine=innodb;




