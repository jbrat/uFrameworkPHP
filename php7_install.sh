#!/bin/bash

sudo apt-get install -y python-software-properties;
sudo add-apt-repository ppa:ondrej/php-7.0 -y;
sudo apt-get update;
sudo apt-get install -y php7.0 php7.0-common php7.0-mysql php7.0-json;

echo -e "\n\n####################\nVersion php :\n";
php -v;

echo "<?php phpinfo();" > index.php;

echo -e "\n\n####################\nVisit http://localhost:8080 to check php7 is working.\n\n####################\n";
php -S localhost:8080;
