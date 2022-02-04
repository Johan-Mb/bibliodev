# HELLO, BIENVENUE SUR TA BIBLIODEV

Ceci est une petite application permettant de  **trier, ranger et retrouver**  toutes les ressources nécessaires à ton apprentissage du développement web. L'outil idéal à associer avec la plateforme Odyssey (de la Wild Code School) ou Notion. Il a été conçu en PHP / Symfony.

La Bibliodev fonctionne comme un meuble à vinyles.  **Un thème**  contient de  **nombreux sous-thèmes**  (comme une case contient plein de disques et un disque, plein de morceaux). Et chaque sous-thème contient  **d'innombrables ressources**. Chaque ressource est catégorisée  **par type**  : cours, vidéo ou lien utile. Un niveau de difficulté est associé à chaque ressource pour un futur tri par level.

Maintenant tu sais tout.  
**Fais-en bon usage !**

# Initialisation

### Installer le projet

1.  Cloner le projet
2.  Run  `composer install`
3.  Run  `yarn install`
4.  Run  `yarn encore dev`
5.  Run  `php -S localhost:8000 -t public`
6.  Run  `yarn watch`

### Tester le projet

1.  Configurer son .env.local
2.  Run  `php /bin console doctrine:database:create`
3.  Run  `php /bin console doctrine:make:migration`
4.  Run  `php /bin console doctrine:fixtures:load`
5.  Go  `localhost:8000/login`
6.  Identifiants et mots de passe :
    -   Admin :  johan@wilder.com  / myadminpassword
    -   User :  michele@wilder.com  / mycontributorpassword
### Notes fixtures

Des fixtures sont disponibles pour les users et plusieurs premiers grands thèmes. Une fois le projet lancé, amusez-vous directement à ajouter des sous-thèmes et ressources.
## Fonctionnalités
- CRUD : thèmes
- CRUD : sous-thèmes + afficher les sous-thèmes liés à un thème choisi
- CRUD : ressources + afficher les ressources liées à un sous-thème choisi
- CRUD : profil
- Hashage de mot de passe
- Affichage de la date du jour
- Login / logout
- Register

## Features V2 

- Rendre l'application responsive
- ressource/new : filtrer les sous-thèmes en fonction du thème choisi
- Mode sombre
- homepage : vérification des users 
- Barres de recherche fonctionnelles
- Messages flash lors d'ajouts de thèmes, sous-thèmes ou ressources
- Mise en place d'une page d'erreur 404 / 500...
- Possibilité de réinitialiser son MDP
- Possibilité de trier les ressources par level
##
