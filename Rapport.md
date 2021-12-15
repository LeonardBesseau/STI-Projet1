# Rapport étude de menaces

Auteurs: Besseau Léonard et Cerottini Alexandra

Date: 12.12.2021



## Introduction

Ce projet est une application Web permettant d'envoyer des messages électroniques entre des utilisateurs au sein d'une entreprise. Il permet en plus à des administrateurs de gérer les différents utilisateurs (ajout, modification ou suppression d'un utilisateur).

Les technologies utilisées sont Docker, PHP et SQLite.

L'objectif du projet est d'identifier les failles de sécurité au niveau applicatif, d'analyser les menaces et de sécuriser l'application développée par un des membres du groupe du projet 1. Le cahier des charges du projet 1 doit être respecté.

Nous allons seulement nous intéresser aux vulnérabilités introduites par le code PHP. La sécurisation du serveur web et de la machine sera ignorée. Des recommandations pourront être émises mais ne seront pas corrigées.



## Le système

### Objectifs

Le système a pour objectif de permettre à des employés au sein d'une entreprise de s'envoyer des messages électroniques. Le contenu de l'application est donc dynamique et généré par les utilisateurs. L'application est importante pour la communication interne de l'entreprise.



### Hypothèses de sécurité

- Une personne externe ne peut pas avoir un compte. 
- Seulement les employés actif de l'entreprise peuvent utiliser l'application web
- Les administrateurs de la base de données et de l'application sont de confiance.
- Il est impossible d'usurper l'identité du serveur.



### Exigences de sécurité

- Il faut être authentifié pour utiliser l'application web

- Le compte de l'utilisateur doit être actif pour pouvoir se connecter 

- Seuls les administrateurs peuvent ajouter, supprimer ou modifier un utilisateur

- Seuls les administrateurs peuvent voir les informations personnelles (mail, validité, rôle) des autres utilisateurs mais ils ne peuvent pas voir leur mot de passe

- Personne ne peut lire et supprimer les messages électroniques qui destinés à d'autres personnes.

- Personne ne peut supprimer ou modifier un message  après l'avoir envoyé.

- Personne ne peut envoyer un message électronique au nom d'une autre personne.

  

### Constitution

#### Élements du système

- Base de données des utilisateurs

- Base de données des messages électroniques

- Application Web (Server applicatif php + server web NGINX)

  

#### Rôles des utilisateurs

- Collaborateur

Les collaborateurs peuvent lire les messages électroniques qu'ils ont reçu, écrire un nouveau message à l'attention d'un autre utilisateur ou d'eux-même, répondre à un message, supprimer un message et changer leur propre mot de passe.

- Administrateur

Les administrateurs ont accès aux mêmes fonctionnalités que les collaborateurs mais ils peuvent en plus ajouter, modifier ou supprimer un utilisateur.



### DFD

### Les biens

- Application Web

  - Disponibilité

  L'application se doit d'être disponible pour être utilisable. Son interruption pourrait perturber le fonctionnement de l'entreprise.

  - Authenticité + Confidentialité

  Seuls les membres de l’entreprise ont accès à l'application. Une personne externe à l'entreprise pourrait obtenir des informations confidentielles autrement.

- La base de données
  - Table users (liste des utilisateurs)

    - Confidentialité

    Les données personnelles ne doivent pas être accessibles aux autres utilisateurs. (Sphère privée)

    - Intégrité

    Une modification des données pourrait nuire à un utilisateur.

  - Table messages (liste des messages)

    - Confidentialité

    Les messages entre 2 utilisateurs sont censés être confidentiel pour tous les autres utilisateurs

    - Intégrité

    Un message ne doit pas être modifié après envoi ou supprimé par l'auteur (non-répudiation)

    - Authenticité

    L'auteur d'un message doit être le véritable auteur (réputation)

L'application web doit seulement être accessible aux collaborateurs et aux administrateurs (sauf la page de login). Les actions des administrateurs sur les utilisateurs sont confidentielles et seulement les administrateurs peuvent les réaliser.

La base de données contient des données sensibles sur les utilisateurs comme leur mot de passe ainsi que les messages qu'ils ont échangé. Il faut de la confidentialité.

Si un incident se produit, celui-ci nuirait la réputation de l'application Web et entraînerait un problème de communication au sein de l'entreprise. De plus, il y aurait une perte de confiance de la part des employés.



### Périmètre de sécurisation

:warning: je comprends pas trop ce que c'est....

- Personne sauf les administrateurs ne doit pouvoir accéder à la page de gestion des utilisateurs
- Personne ne doit avoir accès aux messages des autres utilisateurs
- Personne ne doit pouvoir envoyer un message en se faisant passer pour quelqu'un d'autre
- Personne ne doit pouvoir modifier ou supprimer un message après l'avoir envoyé
- Personne ne doit pouvoir récupérer le mail et le mot de passe d'un utilisateur











## Identifier les sources de menaces

- Employés mécontents
  - Motivation: vengeance, curiosité, espionnage industriel
  - Cible: lire des messages d'autres utilisateurs ou élévation de privilège
  - Potentialité: haute
- Cybercriminels
  - Motivation: financières
  - Cible: vol de credentials des utilisateurs, modification d'informations, phishing
  - Potentialité: moyenne
- Concurrents
  - Motivation: espionnage industriel
  - Cible: lire les messages des utilisateurs, déni de service
  - Potentialité: moyenne



## Identifier les scénarios d'attaques

#### Indisponibilité du service.

Impact: Élevé (financier)

Source de la menace: Hacker, concurrent

Motivation: Gêner l'activité. Rançon (crime organisés).

Cible: serveur web

Scénario d'attaque: 

- Injection. 
- Bug avec fuite de mémoire

Contrôles: Validation des entrées.

#### Récupération des données internes

Impact: Élevé (financier, réputation, données personelles)

Source de la menace: Concurrent

Motivation: Récupérer des information .

Cible: base de données

Scénario d'attaque: 

- Injection. 
- Authentification+ Autorisation bypass

Contrôles: 

- Validation des entrées.
- Contrôle des accès

#### Suppression des données

Impact: Élevé (financier, données)

Source de la menace: Employé mécontent

Motivation: Supprimer des informations

Cible: base de données

Scénario d'attaque: 

- Injection. 
- Autorisation bypass

Contrôles: 

- Validation des entrées.
- Contrôle des accès



## Identifier les contre-mesures

- Valider les inputs lors des requêtes.
- Utiliser des requêtes SQL préparées.
- Contrôle d'accès pour les messages et les données utilisateurs.
- Contrôle d'accès pour les fonctionnalités de l'administrateur.





### En fonction des scénarios d'attaques



### Menaces



### Scénarios

### Contre-mesures

- 



## Conclusion





Notes de Léonard:



password trop faible

On est admin et on peut lire les messages d'autre utilisateurs car les ID sont seuqentiel et qu'il n'y a pas de controle d'accès. (on va garder les id séquentiel mais on doit verif que c'est la bonne personne qui accède. On va faire un fetch et vérifier qui y accède et on retournera un forbidden)

XSS

perte de confidentialité





Utilisateur peut faire une XSS avec un nouveau message, on peut lire n'importe quel message même si il ne nous est pas adressé, 

à tester: 

- Est-ce qu'on peut supprimer les tables? 
- Est-ce qu'on est capable de changer nos droits?
- tester si y'a des vulnérabilités dans la version du PHP
- Utiliser du HTTPS pour sécuriser les connexions.



On peut faire une injection XSS sur le body mais également dans le subject. L'avantage de le faire dans le subject, c'est que l'utilisateur a juste besoin de se connecter et l'attaque aura lieu immédiatement alors que dans le body l'utilisateur doit ouvrir le message.

On peut supprimer tous les messages d'autres personnes. On peut injecter pour supprimer tous les messages
