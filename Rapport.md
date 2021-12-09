# Rapport étude de menaces

Auteurs: Besseau Léonard et Cerottini Alexandra

Date: 09.12.2021

## Introduction

Ce projet est une application Web permettant d'envoyer des messages électroniques entre des utilisateurs au sein d'une entreprise. Il permet en plus à des administrateurs de gérer les différents utilisateurs (ajout, modification ou suppression d'un utilisateur). 

Les technologies utilisées sont Docker, PHP et SQLite.

L'objectif du projet est d'identifier les failles de sécurité au niveau applicatif, d'analyser les menaces et de sécuriser l'application développée par un des membres du groupe du projet 1. Le cahier des charges du projet 1 doit être respecté. 



## Décrire le système



### DFD



### Identifier ses biens

- La base de données

### Définir le périmètre de sécurisation



## Identifier les sources de menaces

password trop faible

On est admin et on peut lire les messages d'autre utilisateurs car les ID sont seuqentiel et qu'il n'y a pas de controle d'accès. (on va garder les id séquentiel mais on doit verif que c'est la bonne personne qui accède. On va faire un fetch et vérifier qui y accède et on retournera un forbidden)

XSS

perte de confidentialité

## Identifier les scénarios d'attaques



### Éléments du système attaqué



### Motivation(s)



### Scénario(s) d'attaque



### STRIDE



## Identifier les contre-mesures



### En fonction des scénarios d'attaques



## Conclusion

