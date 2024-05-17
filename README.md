# FreeAds

# FreeAds

# Projet de Site de Petites Annonces avec Laravel

## Description
Ce projet consiste à créer un site de petites annonces en utilisant le framework Laravel. Les utilisateurs peuvent s'inscrire, se connecter, publier des annonces, consulter les annonces existantes, et interagir via un système de messagerie.

# Fonctionnalités

    Accueil : Page d'accueil accessible via le contrôleur IndexController.
    Utilisateur : Inscription, connexion, modification de profil, gestion des utilisateurs.
    Annonces : Création, modification, suppression et affichage des annonces avec titre, description, photo et prix.
    Recherche : Système de recherche et de filtrage des annonces.
    Messagerie : Système de messagerie entre utilisateurs.

## Prérequis
- PHP >= 7.3
- Composer
- MySQL ou autre base de données compatible
- Serveur web (Apache, Nginx, etc.)

## Installation
1. Cloner le dépôt :
   ```bash
   git clone https://github.com/votre-utilisateur/FreeAds.git
   cd FreeAds

2. Installer les dépendances :
 
    composer install

3. Configurer l'environnement :
   
   cp .env.example .env
   php artisan key:generate

4. Configurer la base de données dans .env :

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=freeads
    DB_USERNAME=votre_nom_utilisateur
    DB_PASSWORD=votre_mot_de_passe

5. Migrer la base de données :

    php artisan migrate

6. Lancer le serveur de développement :

   php artisant serve

   Accéder à http://localhost:8000

