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
	- on git clone https://github.com/mathyyg/compress.git
	- cd compress
	- composer install
	- on configure env ex "DATABASE_URL="mysql://root:root@127.0.0.1:3306/projet?serverVersion=10.4.24-MariaDB"
	- ajouter votre server smtp ex MAILER_DSN=gmail://User:pass@default
	- si la bdd n'existe pas sur votre serveur local : symfony console doctrine:database:create (verif d’avoir user si non ( symfony console doctrine:migrations:migrate ))
	- npm install
	- build le js/css : npm run watch (on peut fermer le terminal après le build)
	- lancer le projet : symfony serve
	- on peut cree un user avec /register se co avec /login et se déco /logout 
	- aller sur php.ini et enlever le ; de la ligne ;extension=intl
	- pour accéder à la partie /admin crée un premier compte et lui ajouter le rôle “ROLE_ADMIN” avec les guillemet par la suite vous pourrez le faire avec le panel
