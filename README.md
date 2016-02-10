# uFrameworkPHP

Micro Framework réalisé en PHP, les fonctionnalités sont la gestion de status (Tweets) et un système d'authentification.


Fonctionalités réalisées :

- Système d'authentification utilisant un Firewall, l'utilisateur n'étant pas connecté,il est limité simplement à une consultation des status


Action possible en étant authentifié : 

- Ajout d'un statut avec son username et un message de 140 caractères le message prendra la date actuelle lors de la création

- Suppression d'un status en fonction d'un identifiant passé en GET



Action possible en n'étant pas authentifié : 

- Lister l'ensemble des statuts en fonction de filtre sur l'auteur et la date. Possibilité de limiter le nombre d'affichage sur la page à 5,10,15 ou 20

- Consulter un statut en fonction de son ID



Installation Framework : 

Vous devez tout d'abord posséder la dernière version de PHP qui est la 7, un script est disponible à la racine du GIT pour l'installer en utilisant les packets UBUNTU.

Composer est indispensable, vous devez aussi l'installer.

Une fois ces deux choses installées vous pouvez cloner le projet sur votre ordinateur, ensuite se placer dans le dossier /uframework et effectuer un composer install.

Celui-ci va inclure l'ensemble des librairies nécéssaire en fonctionnement. 


Installation BDD avec Docker : 

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

A partir de ce moment la vous avez une base de donnés de type MySQL hébergé sur un container Docker. Vous pouvez y accéder via une console : mysql uframework -uuframework -pp4sswOrd

Pour installer l'ensemble des tables nécéssaires au fonctionnement  : mysql uframework -uuframework -pp4sswOrd < app/config/schema.sql

L'ensemble des tables sera installées et par défaut il y a 3 status de prévu.



Votre ordinateur devra être relié à internet pour obtenir le meilleur rendu de design possible car j'utilise le framework css Bootstrap avec des liens externes je n'ai pas téléchargé la librairie,
de même pour jquery lien externe.


Une fois que vous avez installer les dépendances avec le composer install je vous invite à lançer le serveur web : php -S localhost:8080 -t /web ou autre solution plaçer le projet sur un serveur web.


Il ne vous reste plus qu'a accéder au site : http://localhost:8080, la page d'index redirige directement sur les status.
