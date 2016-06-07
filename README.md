# uFrameworkPHP

Micro Framework réalisé en PHP7, les fonctionnalités sont la gestion de statuts (Tweets) et un système d'authentification.

Réalisé par : BRAT Julien


##Fonctionnalités réalisées :

- Système d'authentification utilisant un Firewall, l'utilisateur n'étant pas connecté, il est limité simplement à une consultation des statuts


Actions possibles en étant authentifié : 

- Ajout d'un statut avec son username et un message de 140 caractères le message prendra la date actuelle lors de la création

- Suppression de ses statuts en fonction d'un identifiant passé en paramètre GET



Action possible en n'étant pas authentifié : 

- Lister l'ensemble des statuts en fonction de filtres sur l'auteur et la date. Possibilité de limiter le nombre d'affichages sur la page à 5, 10, 15 ou 20

- Consulter un statut en fonction de son ID



##Installation du Framework : 

Vous devez tout d'abord posséder la dernière version de PHP qui est la 7, un script est disponible à la racine du GIT pour l'installer en utilisant les packets d'Ubuntu.

Composer est indispensable, vous devez aussi l'installer.

Une fois ces deux choses installées vous pouvez cloner le projet sur votre ordinateur, ensuite se placer dans le dossier /uframework et effectuer un composer install.

Celui-ci va inclure l'ensemble des librairies nécéssaires au fonctionnement. 


Installation de la base de données avec Docker : 

``` bash
$ docker run -d \
    --volume /var/lib/mysql \
    --name data_mysql \
    --entrypoint /bin/echo \
    busybox \
    "mysql data-only container"
```

Puis lançer l'image : 

``` bash
$ docker run -d -p 3306 \
    --name mysql \
    --volumes-from data_mysql \
    -e MYSQL_USER=uframework \
    -e MYSQL_PASS=p4ssw0rd \
    -e ON_CREATE_DB=uframework \
    tutum/mysql
```

A partir de ce moment la, vous avez une base de données de type MySQL hébergée sur un container Docker. Vous pouvez y accéder via une console : mysql uframework -uuframework -pp4sswOrd

Pour installer l'ensemble des tables nécéssaires au fonctionnement  : mysql uframework -uuframework -pp4sswOrd < app/config/schema.sql
L'ensemble des tables sera installé, par défaut il y a 3 statuts de pré-remplis.




Une fois que vous avez installé les dépendances avec le composer install je vous invite à lançer le serveur web : php -S localhost:8080 -t /web ou autre solution placer le projet sur un serveur web de type apache, nginx, etc.


Il ne vous reste plus qu'a accéder au site : http://localhost:8080, la page d'index redirige directement sur les statuts.


Des tests ont été réalisés dans le dossier /tests, vous trouverez différents types de tests unitaires, pour les lançer il vous suffira d'éffectuer un phpunit à la racine  du projet, phpunit étant installé avec Composer lorsque vous avez éffectue la commande "composer install". 
