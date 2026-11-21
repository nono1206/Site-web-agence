# TP6 - Site Dynamique avec PHP & MySQL

## Description du projet
Ce projet consiste en la refactorisation d'un mini-site statique en une application web dynamique sous **PHP 8** et **MySQL**. Il intègre une architecture modulaire (`includes/`), une gestion dynamique des services, un formulaire de contact relié à la base de données et un espace d'administration sécurisé.

## Fonctionnalités principales
- **Architecture modulaire :** Utilisation de fichiers d'inclusion (`header.php`, `footer.php`, `functions.php`) pour factoriser le code.
- **Connexion Base de Données (PDO) :** Connexion centralisée et sécurisée via `db.php`.
- **Espace Public :** 
  - Affichage dynamique de la liste des services depuis la table `services`.
  - Formulaire de contact fonctionnel avec enregistrement des messages dans la table `messages`.
- **Espace Administrateur (`/admin`) :** 
  - Authentification sécurisée des administrateurs (`login.php` avec hachage des mots de passe).
  - Tableau de bord (`index.php`) affichant les compteurs de services et de messages.
  - Gestion (ajout/suppression) des services et consultation des messages reçus.

## Tableau des tests de validation
| N° | Action testée | Résultat attendu | Statut |
|----|----------------|------------------|--------|
| 1 | Connexion à la base de données (`db.php`) | Connexion établie sans erreur et compteur affiché | **OK** |
| 2 | Affichage dynamique des services | Liste des services récupérée et affichée depuis MySQL | **OK** |
| 3 | Soumission du formulaire de contact | Message enregistré en base et affichage d'un message de succès | **OK** |
| 4 | Authentification de l'administrateur | Accès sécurisé au dashboard avec initialisation des sessions | **OK** |
| 5 | Gestion des services (Admin) | Ajout d'un nouveau service et suppression fonctionnels | **OK** |
| 6 | Gestion des messages (Admin) | Affichage de la liste des messages et suppression opérationnelles | **OK** |

## Instructions d'installation (Docker)
1. Lancer les conteneurs Docker du projet.
2. Importer le script SQL de la base de données `mini_site` si ce n'est pas déjà fait.
3. Accéder au site via l'URL : `http://localhost:8080/USLA57_TP_ELJEBLI_Nosayba/TP6/`
4. Se connecter à l'administration via `admin/login.php` (Identifiants par défaut : `admin` / `admin123`).