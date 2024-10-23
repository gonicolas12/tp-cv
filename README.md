# Projet TP-CV

Le TP-CV est un projet qui consiste à créer un portfolio en PHP !

## Fonctionnalitées

- **Ajouter un projet** et le **supprimer** est possible sur mon tp-cv.
- Vous pouvez **poster**, **modifier**, **télécharger** et **supprimer** votre CV sur ma plateforme.
- Vous pouvez **créer un compte**, vous **connecter**, et modifier votre **profil**
- Une page **contact** est disponible pour me contacter via mail.
- Un **pannel admin** est disponible pour ceux qui y ont accès.

## Structure du projet

- **admin/**  
  Ce dossier contient des fichiers liés à la gestion des utilisateurs, l'ajout, la suppression et la modification des comptes. Il inclut également un sous-dossier `includes` pour les en-têtes d'administration.

- **assets/**  
  Ce dossier regroupe les fichiers nécessaires à la mise en forme et à l'interaction du site.

  - **css/** : Styles pour les différentes pages du site.
  - **img/** : Images utilisées dans le projet.

- **includes/**  
  Ce dossier rassemble des fichiers d'inclusion utilisés dans le projet, tels que la connexion à la base de données et les en-têtes/pieds de page.

- **sql/**  
  Contient le fichier de création de la base de données et des tables nécessaires au bon fonctionnement de l'application.

- **uploads/**  
  Ce dossier est destiné aux fichiers téléchargés par les utilisateurs, tels que les CV en format PDF.

- **vendor/**  
  Ce dossier contient les dépendances du projet, gérées par Composer. On y trouve la bibliothèque PHPMailer pour l'envoi d'emails, ainsi que d'autres fichiers de configuration.

## Lancement du Projet

Pour démarrer le projet, suivez ces étapes pour installer et lancer le projet :

### Prérequis

- XAMPP installé sur votre machine

### Installation et Exécution

1. **Clonez le dépôt avec la commande suivante** :

   ```bash
   git clone https://github.com/gonicolas12/tp-cv.git
   ```

2. **Placez le projet** :

   - Copiez le dossier tp-cv dans le dossier htdocs de XAMPP. Par défaut, cela se trouve dans **C:\xampp\htdocs**.

3. **Démarrez XAMPP** :

   - Ouvrez le panneau de contrôle de **XAMPP**
   - Démarrez les services **Apache** et **MySQL**

4. **Copiez la base de donnée** :

   - Ouvrez http://localhost/phpmyadmin/
   - Créez une nouvelle base de données nommée "**tp-cv**"
   - Copiez le contenu du fichier **tp-cv.sql** qui se trouve dans le dossier **sql**
   - Collez ce contenu dans la catégorie "**SQL**" dans la base de donnée "**tp-cv**" que vous avez créé

5. **Accédez au projet** en ouvrant votre navigateur web sur ce lien -> http://localhost/tp-cv/index.php.


### Identifiants compte Admin :

   - Email : mm@ll.com
   - Mot de passe : 123

### Auteur :

   - [@nicolasgouy](https://www.github.com/gonicolas12)
