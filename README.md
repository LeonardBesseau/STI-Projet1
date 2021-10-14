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

:warning: Il faut que le fichier `database.sqlite` qui se situe dans le dossier `site/databases` soit en *read and write* pour tous les utilisateurs. 



## Utilisation

### Login

Lorsqu'un utilisateur n'est pas connecté, il se retrouvera face à une page de login.

Pour se connecter, il suffit d'entrer un email et un mot de passe et de cliquer sur `Login`. Si les informations entrées ne sont pas valides, l'utilisateur se retrouvera à nouveau sur la page de login. Sinon, il se retrouvera dans sa boîte mail.

L'un des comptes suivant peut-être utilisé:

| email            | mot de passe | statut        |
| ---------------- | ------------ | ------------- |
| admin@sti.com    | 123          | admin         |
| ladygaga@sti.com | 911          | collaborateur |

![login](images/login.png)

### Barre de navigation

Cette barre permet de naviguer entre les différentes fonctionnalités proposées par l'application web. Un collaborateur pourra naviguer vers la boîte mail, changer son mot de passe ou se logout en cliquant dessus. Un admin pourra également gérer les différents utilisateurs.

![nav](images/nav.png)

### Boîte de réception

Après s'être connecté, l'utilisateur est redirigé vers sa boîte de réception.

![inbox](images/inbox.png)

Pour chaque message, l'utilisateur peut: 

- l'**ouvrir** pour avoir accès au corps du message:

![message](images/message.png)

Pour revenir à la boîte de réception, il suffit d'utiliser la barre de navigation.

- y **répondre**:

![response](images/response.png)

- le **supprimer**

L'utilisateur peut également envoyer un nouveau message en cliquant sur le bouton `New message` :

![new_message](images/new_message.png)

### Changer de mot de passe

Cette page permet à l'utilisateur actuel de changer son mot de passe. Il lui suffit d'entrer un nouveau mot de passe et de cliquer sur `Change` pour que celui-ci soit changé. Lorsque le changement a été effectué, l'utilisateur est dirigé sur sa boîte mail.

![pswd](images/pswd.png)

### Gestion utilisateurs (admin)

Cette page permet à un administrateur de gérer les comptes des utilisateurs de l'application web.

![user_management](images/user_management.png)

#### Ajouter

En cliquant sur `Add user` une nouvelle page s'ouvre et un nouvel utilisateur peut-être ajouté. Il suffit pour cela de remplir tous les champs et de cliquer sur `Add`.  Lorsque l'opération a été réalisée, l'utilisateur est redirigé sur la page de gestion des utilisateurs.

![add_user](images/add_user.png)

#### Modifier

En cliquant sur `Edit` une nouvelle page s'ouvre et le mot de passe, la validité ou le rôle de l'utilisateur peut-être modifié. Il suffit de modifier les champs souhaités puis de cliquer sur `Ok`. Lorsque l'opération a été réalisée, l'utilisateur est redirigé sur la page de gestion des utilisateurs.

![edit_user](images/edit_user.png)

#### Supprimer

En cliquant sur `Delete`, l'utilisateur sélectionné sera définitivement supprimé de la base de données. Lorsque l'opération a été réalisée, l'utilisateur est redirigé sur la page de gestion des utilisateurs.

### Logout

En cliquant sur `Logout` dans la barre de navigation, l'utilisateur sera déconnecté et redirigé sur la page de login.

