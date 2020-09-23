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

/*
	Aauth SQL Table Structure
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `aauth_groups`
-- ----------------------------
DROP TABLE IF EXISTS `aauth_groups`;
CREATE TABLE `aauth_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100),
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aauth_groups
-- ----------------------------
INSERT INTO `aauth_groups` VALUES ('1', 'Admin', 'Super Admin Group');
INSERT INTO `aauth_groups` VALUES ('2', 'Public', 'Public Access Group');
INSERT INTO `aauth_groups` VALUES ('3', 'Default', 'Default Access Group');

-- ----------------------------
-- Table structure for `aauth_perms`
-- ----------------------------
DROP TABLE IF EXISTS `aauth_perms`;
CREATE TABLE `aauth_perms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100),
  `definition` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aauth_perms
-- ----------------------------

-- ----------------------------
-- Table structure for `aauth_perm_to_group`
-- ----------------------------
DROP TABLE IF EXISTS `aauth_perm_to_group`;
CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`perm_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aauth_perm_to_group
-- ----------------------------

-- ----------------------------
-- Table structure for `aauth_perm_to_user`
-- ----------------------------
DROP TABLE IF EXISTS `aauth_perm_to_user`;
CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`perm_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aauth_perm_to_user
-- ----------------------------

-- ----------------------------
-- Table structure for `aauth_pms`
-- ----------------------------
DROP TABLE IF EXISTS `aauth_pms`;
CREATE TABLE `aauth_pms` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) unsigned NOT NULL,
  `receiver_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aauth_pms
-- ----------------------------

-- ----------------------------
-- Table structure for `aauth_users`
-- ----------------------------
DROP TABLE IF EXISTS `aauth_users`;
CREATE TABLE `aauth_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_general_ci NOT NULL,
  `pass` varchar(64) COLLATE utf8_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_general_ci,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text COLLATE utf8_general_ci,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text COLLATE utf8_general_ci,
  `verification_code` text COLLATE utf8_general_ci,
  `totp_secret` varchar(16) COLLATE utf8_general_ci DEFAULT NULL,
  `ip_address` text COLLATE utf8_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- ----------------------------
-- Records of aauth_users
-- ----------------------------
INSERT INTO `aauth_users` VALUES ('1', 'admin@example.com', 'dd5073c93fb477a167fd69072e95455834acd93df8fed41a2c468c45b394bfe3', 'Admin', '0', null, null, null, null, null, null, null, null, '0');

-- ----------------------------
-- Table structure for `aauth_user_to_group`
-- ----------------------------
DROP TABLE IF EXISTS `aauth_user_to_group`;
CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aauth_user_to_group
-- ----------------------------
INSERT INTO `aauth_user_to_group` VALUES ('1', '1');
INSERT INTO `aauth_user_to_group` VALUES ('1', '3');

-- ----------------------------
-- Table structure for `aauth_user_variables`
-- ----------------------------
DROP TABLE IF EXISTS `aauth_user_variables`;
CREATE TABLE `aauth_user_variables` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aauth_user_variables
-- ----------------------------

-- ----------------------------
-- Table structure for `aauth_group_to_group`
-- ----------------------------
DROP TABLE IF EXISTS `aauth_group_to_group`;
CREATE TABLE `aauth_group_to_group` (
  `group_id` int(11) unsigned NOT NULL,
  `subgroup_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`group_id`,`subgroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of aauth_group_to_group
-- ----------------------------

-- ----------------------------
-- Table structure for `aauth_login_attempts`
-- ----------------------------

CREATE TABLE IF NOT EXISTS `aauth_login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of aauth_login_attempts
-- ----------------------------



