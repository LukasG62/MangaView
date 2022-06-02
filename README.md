# MangaView


## Installation

**A noter :** Notre projet web a été developpé et testé sur un serveur apache2 et avec **PHP 7.4** et avec le SGBD **MariaDB 10.4** ainsi que le framework frontend **Bootstrap 4.1** installé via CDN

### 1 . Installer la base de données fourni

Le repos contient la base de données sql avec des exemples de données utilisés par notre site web. Pour l'installer, vous devez vous connecter à votre compte phpmyadmin créer une base de donnée et importer le fichier base.sql

### 2 . Configurer les identifiants de connexion à la base de donnée

Vous trouverez dans le repo, un fichier libs/config.php, ce dernier contient les variables concernant la connexion à la base de données vous devez les initialiser :

**$BDD_host**=<host de la base de donnée>; EX : localhost
**$BDD_user**=<utilisateur de la base de donnée>; EX : root
**$BDD_password**=<mot de passe>; EX : P3lEdIREx3nvMWud
**$BDD_base**=<nom de base>; EX : mangaviewdb

Nous vous conseillons de créer un utilisateur dédies avec un mot de passe fort

### 3 . Changer les répertoires pour les avatars, les couvertures de tome et les bannières des séries (OPTIONNEL)

Vous pouvez modifier l'emplacement des avatars, des couvertures de tome et la bannières des séries en modifiant la variable globale contenu dans le fichier libs/maLibBootstrap

```php 
$uploadInfo = [ "USERSPATH" => "CHEMIN DES AVATARS",
                "NEWSPATH" => "CHEMIN DES BANNIERE NEWS",
                "VOLUMESPATH" => "CHEMIN DES COUVERTURES DE TOME",
                "SERIESPATH" => "CHEMIN DES BANNIERE DE SERIES",
              ];
````

** A noter :** Il est indispensable de garder le repertoire **ressources/img** utilisé par la partie frontend du projet
