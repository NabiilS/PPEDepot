# Rallye Lecture : ppe situation initiale

[TOC]

Il s'agit de la situation initiale du ppe. Comportant d'une part le site web rallyeLecture ainsi que la librairie de gestion des droits d'accès.

## 1. Clonez le dépot sur votre machine virtuelle

Clonez le dépot en local. Renommez le répertoire local en "rallyeLecture" (vous pouvez choisir un autre nom pour le répertoire mais il faudra en tenir compte dans le fichier de config de codeiniter paramètre : [$config['base_url']](/application/config/config.php)).

## 2. Mettez en place la base de données rallye lectures

Donnez les droits à un compte administrateur de la base de données, voici un script exemple : [/sql/rl/grant.sql](./sql/rl/grant.sql).

![schéma bd rallye](./sql/schemaDbRallyeLecture.PNG)

Tenez compte des contraintes de domaine non visibles sur le diagramme : [Description des tables](./sql/describeTable.md)

## 3. Tables liées à la gestion des autorisations

![schéma bd aauth](./sql/schemaDbAauth.PNG)

les scripts de création des tables liées aux autorisations se trouvent dans le répertoire : [/sql/aauth](./sql/aauth)
>> Ces tables sont à créer directement dans la base *rallyeLecture*. Vous pouvez consulter la documentation liée à l'utilisation de la classe Aauth ici : [dépôt Aauth](https://github.com/emreakay/CodeIgniter-Aauth) et [wiki Aauth](https://github.com/magefly/CodeIgniter-Aauth/wiki/_pages).
Le code de la bibliothèque Aauth est déjà présent dans le dépôt rallyeLecture, vous n'avez pas à l'installer.

## 4. Insérez les données exemples

On vous fournit le script d'insertion des données du jeu de test, disponible ici : [/sql/rl/insertTableRl.sql](./sql/rl/insertTableRl.sql).

```text
    - un compte administrateur : admin@sio.jjr.fr,
    - un compte de test enseignant : enseignant@sio.jjr.fr
    - les groupes "Enseignant" et "Elève"
    seront créés lors du premier lancement du site et de l'affichage de la page de login au site.
```

## 5. Paramétrez l'accès à la base de données dans Code Igniter

le fichier de configuration de l'accès à la base de données dans code igniter se trouve ici [/application/config/database.php](./application/config/database.php)
vérifiez que les paramètres d'accès à la base de données sont cohérents avec votre environnement :

```php
    'hostname' => 'localhost',
    'username' => 'adminRallyeLecture',
    'password' => 'siojjr',
    'database' => 'rallyeLecture',
    'dbdriver' => 'mysqli',
```

## 6. Accéder au site

Vous pouvez maintenant accéder au site web et consulter les différentes tables en utilisant le compte qui est créé automatiquement au lancement du site web :

- user : admin@sio.jjr
- pwd  : siojjr

![home visiteur](./doc/rlHomeVisiteur.png)
![login](./doc/rlLogin.png)
![home admin](./doc/rlHomeAdmin.png)

[readme.md au format pdf](./readme.pdf)