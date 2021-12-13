# Rapport étude de menaces

Auteurs: Besseau Léonard et Cerottini Alexandra

Date: 12.12.2021



## Introduction

Ce projet est une application Web permettant d'envoyer des messages électroniques entre des utilisateurs au sein d'une entreprise. Il permet en plus à des administrateurs de gérer les différents utilisateurs (ajout, modification ou suppression d'un utilisateur).

Les technologies utilisées sont Docker, PHP et SQLite.

L'objectif du projet est d'identifier les failles de sécurité au niveau applicatif, d'analyser les menaces et de sécuriser l'application développée par un des membres du groupe du projet 1. Le cahier des charges du projet 1 doit être respecté.

Nous allons seulement nous intéresser aux vulnérabilités introduites par le code PHP. La sécurisation du serveur web et de la machine sera ignorée.



## Le système

### Objectifs

Le système a pour objectif de permettre à des employés au sein d'une entreprise de s'envoyer des messages électroniques. Il doit pouvoir rester disponible et être sécurisé pour obtenir une bonne réputation.



### Hypothèses de sécurité

Seulement les employés actif de l'entreprise peuvent utiliser l'application web. Les administrateurs doivent être de confiance car c'est eux qui vont créer les différents utilisateurs. Une personne externe ne peut pas avoir un compte. Le réseau interne doit également être de confiance.



### Exigences de sécurité

- Il faut être authentifié pour utiliser l'application web
- L'utilisateur doit être actif

- Seulement les administrateurs peuvent ajouter, supprimer ou modifier un utilisateur

- Seulement les administrateurs peuvent voir les informations personnelles (mail, validité, rôle) des autres utilisateurs mais ils ne peuvent pas voir leur mot de passe

- Seulement les administrateurs et les collaborateurs peuvent consulter leur messagerie électronique

- Un administrateur ou un collaborateur ne peut lire et supprimer que les messages électroniques qui lui sont destinés.

- Un administrateur ou un collaborateur ne peut pas supprimer ou modifier un message de la base de données après l'avoir envoyé.

- Un administrateur ou un collaborateur ne peut envoyer un message électronique qu'en son nom.

- Le contenu des messages électroniques doit être protégé en intégrité

- Les informations des utilisateurs doivent être protégées

- L'application web doit être disponible à 99% du temps

  

### Constitution

#### Élements du système

- Base de données des utilisateurs

- Base de données des messages électroniques

- Application Web

  

#### Rôles des utilisateurs

- Collaborateur
- Administrateur

Les collaborateurs peuvent lire les messages électroniques qu'ils ont reçu, écrire un nouveau message à l'attention d'un autre utilisateur ou d'eux-même, répondre à un message, supprimer un message et changer leur propre mot de passe.

Les administrateurs ont accès aux mêmes fonctionnalités que les collaborateurs mais ils peuvent en plus ajouter, modifier (le rôle et la validité) ou supprimer un utilisateur.



### DFD



### Les biens

- Application Web

- La base de données
  - Table users (liste des utilisateurs)
  - Table messages (liste des messages)

L'application web doit empêcher la modification des messages et en garantir l'intégrité, la confidentialité ainsi que l'authenticité. Le système doit également rester disponible.

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

- Employés mécontents, utilisateurs malins
  - Motivation: vengeance, curiosité, espionnage industriel
  - Cible: lire des messages d'autres utilisateurs ou élévation de privilège
  - Potentialité: haute
- Hackers, script-kiddies
  - Motivation: s'amuser, gloire
  - Cible: n'importe quel élément / actif
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

Identifier les scénarios probables qui conduiront à un
dommage
• Pensez typiquement à
• Vols d'informations
• confidentialité, compétition, ...
• Destruction information
• Modification information or systems
• Arrêt de processus
• Infection des systèmes des utilisateurs
• Usurpations d'identités
• Accès aux services payants









### Éléments du système attaqué



### Motivation(s)



### Scénario(s) d'attaque



### STRIDE

• Spoofing
• Example: authenticating to the application using a stolen password
• Countermeasure: strong authentication, secure data transport
• Tampering
• Example: using SQL injection to modify or delete records of a data base
• Countermeasure: use of prepared statements, escaping user input
• Repudiation
• Example: Modify a user shipping address on an e-commerce
• Countermeasure: request address confirmation and additional authentication to confirm
• Information disclosure
• Example: intercept clear-text browser traffic in a public wifi
• Countermeasures: traffic encryption
• Denial of service
• Example: allocate session memory based on user provided values
• Countermeasures: validate size before allocating (input validation)
• Elevation of privileges
• Example: copy/paste an administrative URL within a normal user session
• Countermeasures: authorization mechanism



## Identifier les contre-mesures

Pour chaque scénario d'attaque
• Identifier les solutions et contremesures





### En fonction des scénarios d'attaques



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
