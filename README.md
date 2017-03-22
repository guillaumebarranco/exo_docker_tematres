# Exercice Individuel Tematres

# Présentation

L'objectif est de fournir une infrastructure minimale pour exécuter le serveur de vocabulaire Tematres avec docker-compose.

Cette application permet de créer et de mettre à jour un Thesaurus pour les données liées (qui sera ainsi disponible en SKOS/RDF) Ce serveur est écrit en PHP et peut utiliser une base Mysql.

Créer une répertoire tematres dans lequel vous allez mettre tous vos fichiers

Au final Vous aurez les fichiers suivants à me retourner sous forme d'archive zip sans les éventuels dépôt .git ou autres fichiers de tests :

```
tematres
  |_ NOTES.md
  |_ image
  |   |_ db.tematres.php
  |   |_ Dockerfile
  |_ NOTES.md
  |_ README.md
  |_ test.env
```

## Rédaction

La rédaction sera dans le fichier markdown tematres/NOTES.md

#### Qualifier une image qui existe déjà

Trouver l'image de tematres sur https://hub.docker.com

- Fournir l'url résultat
- Cette image est difficilement utilisable: expliquer pourquoi (en une ligne)

#### Qualifier une image dont on dispose de la source

Aller sur github.com voir l'image ARV3054/docker-tematres

En lisant le Dockerfile et les autres scripts éventuellement, expliquer en quoi cette image s'écarte de la philosophie de Docker. (En deux ou trois lignes)

Les deux solutions ne peuvent être retenues pour la suite de l'exercice.

## Conception

#### Architecture

On va se baser une architecture apache - php - mysql (driver mysqli). La dernière image officielle de mysql sur docker hub sera utilisée.

Il va falloir produire:

- un fichier local tematres/image/Dockerfile pour produire l'image de Tematres
- un fichier de configuration tematres/image/db.tematres.php pour paramétrer l'application
- un fichier tematres/docker-compose.yml (version 3) pour orchestrer les services
- un fichier avec les variables d'environnement pour la base de données tematres/test.env
- un fichier tematres/REAMDE.md (en markdown) dans lequel vous expliquez comment utiliser ce projet.
Les noms de services seronts:

- web pour le service apache/php/tematres
- db pour le service mysql

#### Service db

Le container de base de donnée peut être produit directement à partir de la dernière image de Mysql sur docker hub

- Créer le fichier tematres/docker-compose.yml (syntaxe: version 3)
- Ajouter le service db pour qu'il utilise la dernière version officielle de mysql
  - tel qu'il utilise un volume db_data pour le répertoire /var/lib/mysql
  - tel qu'il initialise une base de donnée et un utilisateur pour le service web

A ce niveau vous devriez être capable de vérifier que le service db peut être lancé par docker-compose

#### Service web

Image à partir d'un Dockerfile

Le services web nécessite qu'on construise une image, à cette fin, il faut un Dockerfile. Tous les fichiers qui concernent la construction de l'image seront dans tematres/image

Pour vous aider, voici le début du fichier tematres/image/Dockerfile:

```
FROM php:5.6-apache

# Install unzip and mysqli drivers for php
RUN set -ex; \
  apt-get update; \
  apt-get install -y unzip; \
  rm -rf /var/lib/apt/lists/* ; \
  docker-php-ext-install mysqli

# Append your code after this line !
```

Commandes UNIX/Shell

Pour installer Tematres dans /var/www/html sur une machine linux, on exécute les commandes suivantes (on admet avoir les droits root):

```
$ a2enmod rewrite
$ curl -o /tmp/tematres.zip -L 'https://github.com/tematres/TemaTres-Vocabulary-Server/archive/master.zip'
$ unzip /tmp/tematres.zip -d /tmp
$ cd /var/www/html
$ ( cd /tmp/TemaTres-Vocabulary-Server-master && tar cf - . ) | tar xvf -
$ rm -rf /tmp/tematres.zip /tmp/TemaTres*
Ajoutez ces commandes au fichier Dockerfile en fournissant un commentaire pour chaque ligne pour expliquer ce que ces commandes font
```

A cette étape vous devriez être en mesure d'exécuter la commande docker-build sans erreurs

Pour tester ces commandes, vous pouvez utiliser l'image php:5.6-apache en exécutant:

```
docker run --rm -it php:5.6-apache /bin/bash
```

#### Configuration de l'image

Afin de pouvoir disposer d'une image qui soit configurable par des variables d'environnement, il faut produire un fichier de configuration pour l'application qui puisse tenir compte de ces variables.

La configuration de la base en PHP de Tematres est accessible sur github: TemaTres-Vocabulary-Server/vocab/db.tematres.php

recopier la configuration dans votre dossier
Identifier les variables dont vous allez avoir besoin pour vous connecter à votre base Mysql
Modifier la configuration
pour qu'elle utilise le driver adéquate ('mysqli')
pour qu'elle utilise des variables d'environnement pour connecter la base de données en utilisant la fonction getenv de PHP
Ce fichier doit être ajouté lors de la construction de l'image: ajouter la commande adéquate dans le Dockerfile pour copier ce fichier local dans l'image à la destination /var/www/html/vocab/db.tematres.php
Les variables d'environnement utilisées par le fichier de configuration vont être affectées dans le fichier tematres/test.env

#### Orchestration des services web et db

Ajouter au fichier tematres/docker-compose.yml le service web pour qu'il puisse se raccorder à la base de données.

en utilisant des variables d'environnement situées dans le fichier tematres/test.env
pour que le port par défaut du container (80) soit visible sur l'interface publique au port 8080
L'installation est accessible à l'adresse http://localhost:8080/vocab/install.php ou http://x.x.x.x:8080/vocab/install.php. Assurez vous que la base mysql soit disponible et initialisée avant d'atteindre l'URL (peu prendre quelques secondes).

#### Documentation

Concevoir le fichier tematres/README.md (en anglais et en markdown) qui documente l'utilisation de cette ressource, en oubliant pas de mettre votre nom et prénom.

#### Livraison

Créer une archive ZIP de votre résultat sans les éventuels dépôt .git ou autres fichiers de tests et me le retourner.
