# STI - Projet 1

Auteurs: Alexandra Cerottini & Fiona Gamboni



## Introduction

Ce projet est une application Web très simple permettant d'envoyer des messages entre des collaborateurs.

Les technologies utilisées sont Docker, PHP et SQLite.



## Installation

Cloner l'archive Github avec la commande `git clone git@github.com:Insuline13/STI-Projet1.git`. 



## Lancement

Une image Docker contenant un serveur Nginx, PHP et SQLite est utilisée. Pour la lancer, il faut utiliser les commandes suivantes:

```shell
docker run -ti -v "$PWD/site":/usr/share/nginx/ -d -p 8080:80 --name sti_project --hostname sti arubinst/sti:project2018

docker exec -u root sti_project service nginx start

docker exec -u root sti_project service php5-fpm start 
```

Il suffit ensuite d'aller dans le navigateur et d'écrire `localhost:8080` pour accéder à l'application web.



## Utilisation





Se connecter avec tel compte.

Barre des tâches

Messages:

Changer mdp

Manage user si admin

ajouter

modifier

supprimer

logout