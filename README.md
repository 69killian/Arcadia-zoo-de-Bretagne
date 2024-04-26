# Arcadia-zoo-de-Bretagne
Zoo Website, using PHP, JS, and SQL

# Guide d'installation du projet en local avec XAMPP

Ce guide vous aidera à configurer un environnement de développement local pour exécuter votre site web à l'aide de XAMPP, PHP, MySQL et MongoDB.

## Installation de XAMPP

1. Téléchargez XAMPP depuis [le site officiel](https://www.apachefriends.org/index.html).
2. Suivez les instructions du programme d'installation pour installer XAMPP sur votre système d'exploitation.
3. Une fois l'installation terminée, lancez XAMPP depuis le panneau de contrôle et démarrez les services Apache et MySQL.

## Installation de PHP

1. XAMPP inclut déjà PHP, donc normalement, vous n'avez pas besoin d'installer PHP séparément.
2. Assurez-vous simplement que PHP est bien inclus dans le chemin d'accès système.

## Mise en place des variables d'environnement

1. Configurez les variables d'environnement pour PHP et MySQL si nécessaire.
2. Ajoutez le chemin d'accès aux exécutables PHP et MySQL à la variable d'environnement `PATH` de votre système.
3. N'hésitez pas à redémarrer votre système si nécéssaire.

## Installation de MongoDB et Mongosh

1. Téléchargez MongoDB Community Server depuis [le site officiel](https://www.mongodb.com/try/download/community).
2. Suivez les instructions du programme d'installation pour installer MongoDB sur votre système d'exploitation.
3. Téléchargez par la suite MongoDB Shell (Mongosh) depuis [le site officiel](https://www.mongodb.com/docs/mongodb-shell/).
4. Ajoutez le chemin d'accès à l'exécutable `mongosh` à la variable d'environnement `PATH` de votre système.

## Installation de Composer

1. Téléchargez et installez Composer depuis [le site officiel](https://getcomposer.org/download/).
2. Suivez les instructions d'installation spécifiques à votre système d'exploitation.
3. Ajoutez le chemin d'accès à l'exécutable `bin` à la variable d'environnement `PATH` de votre système.

## Installation de l'extension MongoDB pour PHP

1. Téléchargez l'extension MongoDB pour PHP depuis [le dépôt PECL](https://pecl.php.net/package/mongodb) ou depuis [GitHub](https://github.com/mongodb/mongo-php-driver/releases) si la version ne correspond pas.
2. Assurez-vous de télécharger la version compatible avec votre version de PHP et votre architecture (x86 ou x64).
3. Placez le fichier DLL dans le répertoire `ext` de votre installation PHP.
4. Ouvrez le fichier `php.ini` dans votre installation PHP et ajoutez la ligne suivante : `extension=php_mongodb.dll`.
5. Redémarrez le serveur Apache depuis le panneau de contrôle XAMPP.

## Téléchargement de la base de données MongoDB

1. Assurez-vous que MongoDB est en cours d'exécution en utilisant la commande `mongod` dans votre terminal.
2. Utilisez la commande `mongosh` pour accéder à l'interface de la ligne de commande MongoDB.
3. Utilisez les commandes MongoDB pour créer et peupler votre base de données selon les besoins de votre projet.


# Importation de bases de données MySQL et MongoDB

## Importation de la base de données MySQL d'Arcadia

1. Assurez-vous que le serveur MySQL est en cours d'exécution.
2. Utilisez l'outil en ligne de commande `mysql` ou une interface graphique comme phpMyAdmin.
3. Si vous utilisez l'outil en ligne de commande `mysql`, exécutez la commande suivante depuis le terminal :

```bash
mysql -u utilisateur -p espace_admin < Arcadia/BDD/SQL/espace_admin.sql
```
    
Si vous utilisez phpMyAdmin, connectez-vous à l'interface web, sélectionnez la base de données dans la barre latérale, puis cliquez sur l'onglet "Import" et suivez les instructions pour importer votre fichier SQL.

## Importation de la base de données MongoDB d'Arcadia

1. Assurez-vous que le serveur MongoDB est en cours d'exécution en exécutant la commande mongod.
2. Utilisez l'outil mongorestore pour restaurer la base de données à partir d'un fichier de sauvegarde BSON ou JSON.
3. Exécutez la commande suivante dans votre terminal :

```bash
mongorestore --db animaux.animal Arcadia/BDD/MongoDB/animaux.animal
```

Cela restaurera la base de données MongoDB à partir des fichiers de sauvegarde présents dans le dossier `BDD` du projet.

Assurez-vous de vérifier dans le code de l'application que les liens des bases de données soient les mêmes que celles que vous souhaitez connecter, ainsi que les paths du fichier vendor pour la connection MongoDB pour PHP, car dans le cas contraire, cela pourrait causer des erreurs de connections.
