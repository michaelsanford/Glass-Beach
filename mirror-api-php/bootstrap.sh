# Like 'use strict'; for bash
set -u

# Force apt & dpkg to behave in unattended mode.
export DEBIAN_FRONTEND=noninteractive

###
# Update the system (but DO NOT dist-upgrade !)
###
apt-get update
apt-get upgrade
#apt-get -y install build-essential

# Apache
#apt-get -y install apache2 apache2-mpm-prefork memcached
apt-get -y install apache2 php5 php5-cgi php5-cli php5-dev spawn-fcgi libapache2-mod-php5

# PHP extras 
#apt-get -y install php-apc php5-memcached php5-pgsql php5-sqlite php5-xsl php5-xdebug php5-mcrypt php5-intl php5-imap php5-imagick php5-geoip php5-xmlrpc php5-tidy php5-snmp php5-dbg php5-curl

# Apache rewrite
ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled

# Timezone
sed -i.bak -e 's/;date.timezone =/date.timezone = "America\/Montreal"/' /etc/php5/cli/php.ini
sed -i.bak -e 's/;date.timezone =/date.timezone = "America\/Montreal"/' /etc/php5/cgi/php.ini

rm -rf /var/www
ln -s /vagrant /var/www

service apache2 restart
apt-get -y autoremove
apt-get -y autoclean
updatedb
