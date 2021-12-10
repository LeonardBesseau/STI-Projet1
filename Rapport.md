# Rapport étude de menaces

Auteurs: Besseau Léonard et Cerottini Alexandra

Date: 09.12.2021

## Introduction

Ce projet est une application Web permettant d'envoyer des messages électroniques entre des utilisateurs au sein d'une entreprise. Il permet en plus à des administrateurs de gérer les différents utilisateurs (ajout, modification ou suppression d'un utilisateur).

Les technologies utilisées sont Docker, PHP et SQLite.

L'objectif du projet est d'identifier les failles de sécurité au niveau applicatif, d'analyser les menaces et de sécuriser l'application développée par un des membres du groupe du projet 1. Le cahier des charges du projet 1 doit être respecté.

Nous allons seulement nous intéresser aux vulnérabilités introduites par le code PHP. La sécurisation du serveur web et de la machine sera ignorée.



## Décrire le système

### Objectifs



### Hypothèses de sécurité





### Exigences



### Constitution

(utilisateurs, machines, flux)

(éléments du système et les rôles des utilisateurs)



### DFD



### Identifier ses biens

- Application Web

- La base de données
  - Table users (liste des utilisateurs)
  - Table messages (liste des messages)

L'application web doit empêcher la modification des messages et en garantir l'intégrité, la confidentialité ainsi que l'authenticité. Le système doit également rester disponible.

La base de données contient des données sensibles sur les utilisateurs comme leur mot de passe ainsi que les messages qu'ils ont échangé.



:warning: Parler des acteurs? (collaborateur et admin)



### Définir le périmètre de sécurisation

1. Page d'administration : Donne tout les droits sur tout les utilisateurs
2. Message des autres utilisateurs : Briserait la confidentialité du site
3. Modification ou suppression d'un message déjà envoyé : Problématique pour une bonne communication au sein de l'entreprise
4. Messages forgés : Il deviendrait trivial de nuire à une personne
5. Vol de login et mots de passe : Les mots de passes étant stockés en clair, une lecture de la DB dans ce but serait catastrophique

#### 

#### Données

Les données stockées sont les suivantes :

- Mots de passes et logins
- Messages

Il apparait évident que les aspects à protéger sont la **confidentialité** et l'**intégrité** ; un incident au niveau des données résulterait en une peine pécuniaire pour manquement à la protection des données, ainsi qu'une perte de crédibilité auprès des employés.

## Identifier les sources de menaces

Définir :
• les sources potentielles d'agression
• les cibles potentielles (le système ou rebonds)
• les motivations
• les compétences









password trop faible

On est admin et on peut lire les messages d'autre utilisateurs car les ID sont seuqentiel et qu'il n'y a pas de controle d'accès. (on va garder les id séquentiel mais on doit verif que c'est la bonne personne qui accède. On va faire un fetch et vérifier qui y accède et on retournera un forbidden)

XSS

perte de confidentialité

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





Utilisateur peut faire une XSS avec un nouveau message, on peut lire n'importe quel message même si il ne nous est pas adressé, 

à tester: 

- Est-ce qu'on peut supprimer les tables? 
- Est-ce qu'on est capable de changer nos droits?
- tester si y'a des vulnérabilités dans la version du PHP
- Utiliser du HTTPS pour sécuriser les connexions.

