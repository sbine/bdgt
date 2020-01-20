#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive

echo '--- Update repositories with apt ---'
apt-get update
echo '...done'


echo '--- Installing build-essential screen vim unzip curl wget man ---'
apt-get install -y build-essential screen vim unzip curl wget man
echo '...done'


echo '--- Installing git ---'
apt-get install -y git
echo '...done'


echo '--- Installing apache2 ---'
apt-get install -y apache2
echo '...done'


echo '--- Installing npm ---'
apt-get install -y npm
ln -s /usr/bin/nodejs /usr/bin/node
npm install -g n
n 6.10.3
echo '...done'


echo '--- Installing MariaDB and PHP7 ---'
debconf-set-selections <<< 'mariadb-server-10.0 mysql-server/root_password password '
debconf-set-selections <<< 'mariadb-server-10.0 mysql-server/root_password_again password '
apt-get install -y php7.0 php7.0-cli php7.0-mbstring php7.0-xml libapache2-mod-php7.0 php7.0-mysql php7.0-sqlite php-xdebug
apt-get install -y mariadb-server-10.0
mysql -uroot -e "CREATE DATABASE bdgt;"
mysql -uroot -e "CREATE USER 'bdgt'@'localhost' IDENTIFIED BY 'password';"
mysql -uroot -e "GRANT ALL ON bdgt.* TO 'bdgt'@'localhost';"
echo '...done'


echo '--- Installing composer ---'
if [[ ! -f /usr/local/bin/composer ]]; then
    curl -s https://getcomposer.org/installer | php
    # Make Composer available globally
    mv composer.phar /usr/local/bin/composer
else
    echo '[composer already installed]'
fi
echo '...done'


echo '--- Installing OpenSSL ---'
apt-get install -y openssl
echo '...done'


echo '--- Activating mod_rewrite / mod_ssl ---'
a2enmod rewrite
a2enmod ssl
echo '...done'


echo '--- Creating vHost ---'
VHOST=$(cat <<EOF
NameVirtualHost *:80

#bdgt
<VirtualHost *:80>
    ServerName bdgt.test
    DocumentRoot /var/www/bdgt/public
    RewriteOptions inherit

    ErrorLog /var/log/apache2/bdgt-error_log
    CustomLog /var/log/apache2/bdgt-access_log combined
</VirtualHost>
EOF
)
echo "${VHOST}" > /etc/apache2/sites-available/000-default.conf
echo '...done'

echo '--- Restarting Apache ---'
sed -i 's/AllowOverride None/AllowOverride all/' /etc/apache2/apache2.conf
sed -i 's/www-data/vagrant/' /etc/apache2/envvars
chown vagrant: /var/lock/apache2

service apache2 restart
echo '...done'

echo '--- Configuring bashrc ---'
echo 'cd /var/www/bdgt' >> /home/vagrant/.bashrc
echo '...done'
