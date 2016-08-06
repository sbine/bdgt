#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive

echo '--- Update repositories with apt ---'
apt-get update
echo '...done'


echo '--- Installing gcc screen vim unzip curl wget man ---'
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
n 0.12.4
npm install -g grunt bower
echo '...done'


echo '--- Installing MariaDB and PHP5 ---'
debconf-set-selections <<< 'mariadb-server-10.0 mysql-server/root_password password '
debconf-set-selections <<< 'mariadb-server-10.0 mysql-server/root_password_again password '
apt-get install -y php5 php5-cli php5-mcrypt libapache2-mod-php5 php5-curl php5-mysqlnd php5-sqlite
apt-get install -y mariadb-server-5.5
mysql -uroot -e "CREATE DATABASE bdgt;"
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


echo '--- Activating mod_rewrite / mod_ssl / mcrypt ---'
a2enmod rewrite
a2enmod ssl
php5enmod mcrypt
echo '...done'


echo '--- Creating vHost ---'
VHOST=$(cat <<EOF
NameVirtualHost *:80

#bdgt
<VirtualHost *:80>
    ServerName bdgt.local
    DocumentRoot /var/www/bdgt/public
    RewriteOptions inherit

    ErrorLog /var/log/apache2/bdgt-error_log
    CustomLog /var/log/apache2/bdgt-access_log combined
</VirtualHost>
EOF
)
echo "${VHOST}" > /etc/apache2/sites-available/000-default.conf
echo '...done'

sed -i 's/AllowOverride None/AllowOverride all/' /etc/apache2/apache2.conf
sed -i 's/www-data/vagrant/' /etc/apache2/envvars
chown vagrant: /var/lock/apache2

echo '--- Restarting Apache ---'
service apache2 restart
echo '...done'

# mcrypt problem: http://askubuntu.com/questions/460837/mcrypt-extension-is-missing-in-14-04-server-for-mysql
# Apache conf problem: https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-ubuntu-14-04-lts
# index.php problem: http://stackoverflow.com/a/26852680/1684247