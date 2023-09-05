# compress
Projet PHP de site de réduction d'URL / upload de fichiers

- Réduction d'URL
- Upload de fichier
- Protection d'URL par mot de passe
- Choix d'URL personnalisée
- Administration de membres et gestion d'URLs
- Statistiques liées aux URLs : visites (date et adresse IP), dates de création et de modification 
- Panel utilisateur de gestion de ressources (liens et fichiers)

## Contexte
Projet de Programmation Web Serveur en 3ème année de Licence Informatique à l'Université de Tours

## Import le projet
- 1: git clone https://github.com/mathyyg/compress.git dans le dossier wamp/www ou xampp etc
- 2: cd compress
- 3: composer install
- 4: configurer son .env avec son service de bdd "DATABASE_URL='...'"
- 5: ajouter la variable suivante au .env :

##### MAILER_DSN=gmail://

- 6: si la bdd n'existe pas, la créer: symfony console doctrine:database:create
(ATTENTION: si vous utilisez wamp et mariadb, dans le my.ini changer le "innodb-default-row-format" de "compact" à "dynamic",
redémarrer le service mariadb et créer la bdd) 

- 7: créer les migrations et les exécuter (cela donnera une base de données vide mais fonctionnelle) 
- OU 7 bis : importer le fichier dans votre phpMyAdmin ./preconfig/compress.sql (base de données peuplée) PUIS copier le dossier ./preconfig/public dans la racine

- 8: npm install
- 9: npm run watch (peut fermer une fois le build terminé)
- 10: "symfony serve" pour lancer le serveur
- 11: ouvrir la page d'accueil "127.0.0.1:8000" puis se créer un compte avec register

- (12 : dans php.ini, enlever le ; de la ligne ;extension=intl)
- (13: si la base de données est vide (étape 7.) : accéder à la partie /admin crée un premier compte et lui ajouter le rôle “ROLE_ADMIN” avec les guillemet)
