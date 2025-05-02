# Gestion des Dépenses

Une application web de gestion des dépenses et des salaires développée avec Laravel et AdminLTE.

## Fonctionnalités

- Gestion des utilisateurs avec authentification
- Gestion des salaires
- Gestion des dépenses
- Profil utilisateur avec photo
- Interface administrateur avec AdminLTE

## Prérequis

- PHP >= 8.1
- Composer
- MySQL
- Node.js et NPM

## Installation

1. Cloner le dépôt :
```bash
git clone [URL_DU_REPO]
cd [NOM_DU_PROJET]
```

2. Installer les dépendances PHP :
```bash
composer install
```

3. Installer les dépendances NPM :
```bash
npm install
```

4. Copier le fichier .env :
```bash
cp .env.example .env
```

5. Générer la clé d'application :
```bash
php artisan key:generate
```

6. Configurer la base de données dans le fichier .env :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_la_base
DB_USERNAME=nom_utilisateur
DB_PASSWORD=mot_de_passe
```

7. Exécuter les migrations :
```bash
php artisan migrate
```

8. Créer le lien symbolique pour le stockage :
```bash
php artisan storage:link
```

9. Compiler les assets :
```bash
npm run build
```

10. Démarrer le serveur de développement :
```bash
php artisan serve
```

## Structure du Projet

- `app/Http/Controllers` - Contrôleurs de l'application
- `app/Models` - Modèles Eloquent
- `resources/views` - Vues Blade
- `database/migrations` - Migrations de la base de données
- `public` - Fichiers publics et assets compilés
- `storage` - Fichiers stockés (images, etc.)

## Licence

Ce projet est sous licence MIT.
