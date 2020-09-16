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

Alter table question
add constraint fk_proposition_idQuestion foreign key (idQuestion) references question (idQuestion);

/*--- Alter table rallye --- */
Alter table rallye
add constraint pk_rallye primary key (idRallye); 

/*--- Alter table comporter --- */
alter table comporter 
add constraint pk_comporter_idLivre foreign key (idLivre) references Livre (idLivre),
add constraint pk_comporter_idRallye foreign key (idRallye) references Rallye (idRallye);

/*--- Alter table classe --- */
alter table classe 
add constraint pk_classe primary key (idClasse),
add constraint fk_classe_idEnseignant foreign key (idEnseignant) references enseignant(idEnseignant),
add constraint fk_classe_idNiveau foreign key (idNiveau) references niveau (idEnseignant);

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





