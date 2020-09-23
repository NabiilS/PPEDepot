# Description des tables

[TOC]

## 1. Base rallyeLecture

### 1.1. auteur

| Field | Type        | Null | Key | Default | Extra          |
|-------|-------------|------|-----|---------|----------------|
| id    | int(11)     | NO   | PRI | NULL    | auto_increment |
| nom   | varchar(60) | YES  |     | NULL    |                |
|       |             |      |     |         |                |

### 1.2. classe

| Field         | Type        | Null | Key | Default | Extra          |
|---------------|-------------|------|-----|---------|----------------|
| id            | int(11)     | NO   | PRI | NULL    | auto_increment |
| idEnseignant  | int(11)     | NO   | MUL | NULL    |                |
| anneeScolaire | varchar(45) | YES  |     | NULL    |                |
| idNiveau      | int(11)     | NO   | MUL | NULL    |                |
|               |             |      |     |         |                |

### 1.3. comporter

| Field    | Type    | Null | Key | Default | Extra          |
|----------|---------|------|-----|---------|----------------|
| idLivre  | int(11) | NO   | PRI | NULL    | auto_increment |
| idRallye | int(11) | NO   | PRI | NULL    |                |
|          |         |      |     |         |                |

### 1.4. editeur

| Field | Type        | Null | Key | Default | Extra          |
|-------|-------------|------|-----|---------|----------------|
| id    | int(11)     | NO   | PRI | NULL    | auto_increment |
| nom   | varchar(60) | YES  |     | NULL    |                |
|       |             |      |     |         |                |

### 1.5. eleve

| Field    | Type             | Null | Key | Default | Extra          |
|----------|------------------|------|-----|---------|----------------|
| id       | int(11)          | NO   | PRI | NULL    | auto_increment |
| idClasse | int(11)          | NO   | MUL | NULL    |                |
| nom      | varchar(45)      | NO   |     | NULL    |                |
| prenom   | varchar(45)      | NO   |     | NULL    |                |
| login    | varchar(100)     | NO   | UNI | NULL    |                |
| idAuth   | int(11) unsigned | NO   |     | NULL    |                |
|          |                  |      |     |         |                |

### 1.6. enseignant

| Field  | Type             | Null | Key | Default | Extra          |
|--------|------------------|------|-----|---------|----------------|
| id     | int(11)          | NO   | PRI | NULL    | auto_increment |
| nom    | varchar(45)      | NO   |     | NULL    |                |
| prenom | varchar(45)      | NO   |     | NULL    |                |
| login  | varchar(100)     | NO   | UNI | NULL    |                |
| idAuth | int(11) unsigned | NO   |     | NULL    |                |
|        |                  |      |     |         |                |

### 1.7. livre

| Field      | Type         | Null | Key | Default | Extra          |
|------------|--------------|------|-----|---------|----------------|
| id         | int(11)      | NO   | PRI | NULL    | auto_increment |
| titre      | varchar(45)  | NO   |     | NULL    |                |
| couverture | varchar(100) | YES  |     | NULL    |                |
| idAuteur   | int(11)      | NO   | MUL | NULL    |                |
| idEditeur  | int(11)      | NO   | MUL | NULL    |                |
| idQuizz    | int(11)      | YES  | UNI | NULL    |                |
|            |              |      |     |         |                |

### 1.8. niveau

| Field          | Type        | Null | Key | Default | Extra          |
|----------------|-------------|------|-----|---------|----------------|
| id             | int(11)     | NO   | PRI | NULL    | auto_increment |
| niveauScolaire | varchar(45) | YES  |     | NULL    |                |
|                |             |      |     |         |                |

### 1.9. participer

| Field    | Type    | Null | Key | Default | Extra          |
|----------|---------|------|-----|---------|----------------|
| idRallye | int(11) | NO   | PRI | NULL    | auto_increment |
| idEleve  | int(11) | NO   | PRI | NULL    |                |
|          |         |      |     |         |                |

### 1.10. proposition

| Field       | Type         | Null | Key | Default | Extra          |
|-------------|--------------|------|-----|---------|----------------|
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
| idQuestion  | int(11)      | NO   | MUL | NULL    |                |
| proposition | varchar(255) | NO   |     | NULL    |                |
| solution    | int(11)      | NO   |     | 0       |                |
|             |              |      |     |         |                |

### 1.11. question

| Field    | Type         | Null | Key | Default | Extra          |
|----------|--------------|------|-----|---------|----------------|
| id       | int(11)      | NO   | PRI | NULL    | auto_increment |
| question | varchar(255) | NO   |     | NULL    |                |
| points   | int(11)      | NO   |     | NULL    |                |
| idLivre  | int(11)      | NO   | MUL | NULL    |                |
|          |              |      |     |         |                |

### 1.12. rallye

| Field     | Type        | Null | Key | Default | Extra          |
|-----------|-------------|------|-----|---------|----------------|
| id        | int(11)     | NO   | PRI | NULL    | auto_increment |
| dateDebut | date        | YES  |     | NULL    |                |
| duree     | int(11)     | YES  |     | NULL    |                |
| theme     | varchar(45) | YES  |     | NULL    |                |
|           |             |      |     |        |              |

### 1.13. reponse

| Field              | Type    | Null | Key | Default | Extra |
|--------------------|---------|------|-----|---------|-------|
| idParticiperRallye | int(11) | NO   | PRI | NULL    |       |
| idParticiperEleve  | int(11) | NO   | PRI | NULL    |       |
| idQuestion         | int(11) | NO   | PRI | NULL    |       |
| idProposition      | int(11) | NO   | PRI | NULL    |       |
|                    |         |      |     |         |       |

## 2. tables aauth

### 2.1. aauth_users

| Field             | Type             | Null | Key | Default | Extra          |
|-------------------|------------------|------|-----|---------|----------------|
| id                | int(11) unsigned | NO   | PRI | NULL    | auto_increment |
| email             | varchar(100)     | NO   |     | NULL    |                |
| pass              | varchar(64)      | NO   |     | NULL    |                |
| username          | varchar(100)     | YES  |     | NULL    |                |
| banned            | tinyint(1)       | YES  |     | 0       |                |
| last_login        | datetime         | YES  |     | NULL    |                |
| last_activity     | datetime         | YES  |     | NULL    |                |
| date_created      | datetime         | YES  |     | NULL    |                |
| forgot_exp        | text             | YES  |     | NULL    |                |
| remember_time     | datetime         | YES  |     | NULL    |                |
| remember_exp      | text             | YES  |     | NULL    |                |
| verification_code | text             | YES  |     | NULL    |                |
| totp_secret       | varchar(16)      | YES  |     | NULL    |                |
| ip_address        | text             | YES  |     | NULL    |                |
|                   |                  |      |     |         |                |

### 2.2. aauth_groups

| Field      | Type             | Null | Key | Default | Extra          |
|------------|------------------|------|-----|---------|----------------|
| id         | int(11) unsigned | NO   | PRI | NULL    | auto_increment |
| name       | varchar(100)     | YES  |     | NULL    |                |
| definition | text             | YES  |     | NULL    |                |
|            |                  |      |     |         |                |

### 2.3. aauth_user_to_group

| Field    | Type             | Null | Key | Default | Extra |
|----------|------------------|------|-----|---------|-------|
| user_id  | int(11) unsigned | NO   | PRI | NULL    |       |
| group_id | int(11) unsigned | NO   | PRI | NULL    |       |
|          |                  |      |     |         |       |

[decribeTable.md au format pdf](./describeTable.pdf)