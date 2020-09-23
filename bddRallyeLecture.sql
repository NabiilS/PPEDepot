drop database if exists rallyeLecture;
create database rallyeLecture;
use rallyeLecture;

/* Mettre les tables d'authentifications avant! */

drop table if exists editeur;
create table editeur(
    id int not null auto_increment,
    nom varchar(60),
    primary key(id)
)engine=innodb;

drop table if exists auteur;
create table auteur(
    id int not null auto_increment,
    nom varchar(60),
    primary key(id)
)engine=innodb;

drop table if exists livre;
create table livre(
    id int not null auto_increment,
    titre varchar(45),
    couverture varchar(100),
    idAuteur int,
    idEditeur int,
    primary key(id)
)engine=innodb;

drop table if exists question;
create table question(
    id int not null auto_increment,
    question varchar(255),
    points int,
    idLivre int,
    primary key(id)
)engine=innodb;

drop table if exists rallye;
create table rallye(
    id int not null auto_increment,
    dateDebut Date,
    duree int,
    theme varchar(45),
    primary key(id)
)engine=innodb;

drop table if exists comporter;
create table comporter(
    idLivre int not null,
    idRallye int not null,
    primary key(idLivre, idRallye)
)engine=innodb;

drop table if exists proposition;
create table proposition(
    id int not null auto_increment,
    idQuestion int,
    proposition varchar(255),
    solution int,
    primary key(id)
)engine=innodb;

drop table if exists enseignant;
create table enseignant(
    id int auto_increment not null,
    nom varchar(45),
    prenom varchar(45),
    login varchar(100),
    idAuth int,
    primary key (id))engine=innodb;

drop table if exists niveau;
create table niveau(
    id int auto_increment not null,
    niveauScolaire varchar(45),
    primary key (id))engine=innodb;
    

drop table if exists classe;
create table classe(
    id int auto_increment not null,
    idEnseignant int,
    anneeScolaire varchar(45),
    idNiveau int,
    primary key (id))engine=innodb;

drop table if exists eleve;
create table eleve(
    id int auto_increment not null,
    idClasse int,
    nom varchar(45),
    prenom varchar(45),
    login varchar(45),
    idAuth int,
    primary key (id))engine=innodb;

drop table if exists participer;
create table participer(
     idRallye int not null,
     idEleve int not null,
     primary key (idRallye, idEleve))engine=innodb;


drop table if exists reponse;
create table reponse(
     idParticiperRallye int not null,
     idParticiperEleve int not null,
     idQuestion int not null,
     idProposition int not null,
     primary key (idParticiperRallye, idParticiperEleve, idQuestion, idProposition))engine=innodb;

alter table participer
add constraint fk_participer_idEleve
foreign key(idEleve) references eleve(id);

alter table participer
add constraint fk_participer_idRallye
foreign key(idRallye) references rallye(id);

alter table livre add constraint fk_livre_idAuteur foreign key(idAuteur) references auteur(id);
alter table livre add constraint fk_livre_idEditeur foreign key(idEditeur) references editeur(id);

alter table question add constraint fk_question_idLivre foreign key(idLivre) references livre(id);

alter table comporter add constraint fk_comporter_idLivre foreign key(idLivre) references livre(id);
alter table comporter add constraint fk_comporter_idRallye foreign key(idRallye) references rallye(id);

alter table classe add constraint fk_classe_idEnseignant foreign key(idEnseignant) references enseignant(id);
alter table classe add constraint fk_classe_idNiveau foreign key(idNiveau) references niveau(id);

alter table eleve add constraint fk_eleve_idClasse foreign key(idClasse) references classe(id);
alter table eleve add constraint fk_eleve_idAuth foreign key(idAuth) references aauth_users(id);

alter table proposition add constraint fk_proposition_idQuestion foreign key(idQuestion) references question(id);

alter table reponse add constraint fk_reponse_idParticiperRallye foreign key(idParticiperRallye) references participer(idRallye);
alter table reponse add constraint fk_reponse_idParticiperEleve foreign key(idParticiperEleve) references participer(idEleve);
alter table reponse add constraint fk_reponse_idQuestion foreign key(idQuestion) references proposition(idQuestion);
alter table reponse add constraint fk_reponse_idProposition foreign key(idProposition) references proposition(id);





