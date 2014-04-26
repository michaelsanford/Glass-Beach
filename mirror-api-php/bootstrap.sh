# Like 'use strict'; for bash
set -u

# Force apt & dpkg to behave in unattended mode.
export DEBIAN_FRONTEND=noninteractive

###
# Update the system (but DO NOT dist-upgrade !)
###
apt-get update
apt-get upgrade
apt-get -y install build-essential

# Install all the things!
sudo apt-get install -y accountsservice adduser apache2 apache2-mpm-prefork apache2-utils apache2.2-bin apache2.2-common apparmor apt apt-transport-https apt-utils apt-xapian-index aptitude at autoconf automake autotools-dev base-files base-passwd bash bash-completion bind9-host binutils bsdmainutils bsdutils busybox-initramfs busybox-static bzip2 ca-certificates comerr-dev command-not-found command-not-found-data console-setup coreutils cpio cpp cpp-4.6 crda cron curl dash dbus debconf debconf-i18n debianutils diffutils dmidecode dmsetup dnsutils dosfstools dpkg dpkg-dev e2fslibs e2fsprogs ed eject fakeroot file findutils friendly-recovery ftp fuse gcc gcc-4.6 gcc-4.6-base geoip-database gettext-base gir1.2-glib-2.0 git gnupg gpgv grep groff-base grub-common grub-gfxpayload-lists grub-pc grub-pc-bin grub2-common gzip hdparm hostname ifupdown info initramfs-tools initramfs-tools-bin initscripts insserv install-info installation-report iproute iptables iputils-ping iputils-tracepath irqbalance isc-dhcp-client isc-dhcp-common iso-codes kbd keyboard-configuration klibc-utils krb5-locales krb5-multidev language-pack-en language-pack-en-base language-pack-gnome-en language-pack-gnome-en-base language-selector-common laptop-detect less libaccountsservice0 libacl1 libapache2-mod-php5 libapr1 libaprutil1 libaprutil1-dbd-sqlite3 libaprutil1-ldap libapt-inst1.4 libapt-pkg4.12 libasn1-8-heimdal libattr1 libbind9-80 libblkid1 libboost-iostreams1.46.1 libbsd0 libbz2-1.0 libc-bin libc-dev-bin libc6 libc6-dev libcap-ng0 libcap2 libclass-accessor-perl libclass-isa-perl libcomerr2 libcurl3 libcurl3-gnutls libcurl4-openssl-dev libcwidget3 libdb5.1 libdbus-1-3 libdbus-glib-1-2 libdevmapper-event1.02.1 libdevmapper1.02.1 libdns81 libdrm-intel1 libdrm-nouveau1a libdrm-radeon1 libdrm2 libedit2 libelf1 libept1.4.12 libevent-2.0-5 libexpat1 libffi6 libfreetype6 libfribidi0 libfuse2 libgcc1 libgcrypt11 libgcrypt11-dev libgdbm3 libgeoip1 libgirepository-1.0-1 libglib2.0-0 libgmp10 libgnutls-dev libgnutls-openssl27 libgnutls26 libgnutlsxx27 libgomp1 libgpg-error-dev libgpg-error0 libgssapi-krb5-2 libgssapi3-heimdal libgssglue1 libgssrpc4 libhcrypto4-heimdal libheimbase1-heimdal libheimntlm0-heimdal libhx509-5-heimdal libidn11 libidn11-dev libio-string-perl libisc83 libisccc80 libisccfg82 libk5crypto3 libkadm5clnt-mit8 libkadm5srv-mit8 libkdb5-6 libkeyutils1 libklibc libkrb5-26-heimdal libkrb5-3 libkrb5-dev libkrb5support0 libldap-2.4-2 libldap2-dev liblocale-gettext-perl liblockfile-bin liblockfile1 libltdl-dev libltdl7 liblwres80 liblzma5 libmagic1 libmount1 libmpc2 libmpfr4 libncurses5 libncursesw5 libnewt0.52 libnfnetlink0 libnfsidmap2 libnih-dbus1 libnih1 libnl-3-200 libnl-genl-3-200 libopts25 libp11-kit-dev libp11-kit0 libpam-modules libpam-modules-bin libpam-runtime libpam0g libparse-debianchangelog-perl libparted0debian1 libpcap0.8 libpci3 libpciaccess0 libpcre3 libpipeline1 libplymouth2 libpng12-0 libpolkit-gobject-1-0 libpopt0 libquadmath0 libreadline-dev libreadline6 libreadline6-dev libroken18-heimdal librtmp-dev librtmp0 libsasl2-2 libsasl2-modules libselinux1 libsigc++-2.0-0c2a libslang2 libsqlite3-0 libss2 libssl-dev libssl-doc libssl1.0.0 libstdc++6 libsub-name-perl libswitch-perl libtasn1-3 libtasn1-3-dev libtext-charwidth-perl libtext-iconv-perl libtext-wrapi18n-perl libtimedate-perl libtinfo-dev libtinfo5 libtirpc1 libtool libudev0 libusb-0.1-4 libusb-1.0-0 libuuid1 libwind0-heimdal libwrap0 libx11-6 libx11-data libxapian22 libxau6 libxcb1 libxdmcp6 libxext6 libxml2 libxmuu1 linux-firmware linux-generic-pae linux-image-3.2.0-23-generic-pae linux-image-generic-pae linux-libc-dev locales lockfile-progs login logrotate lsb-base lsb-release lshw lsof ltrace lvm2 m4 makedev man-db manpages manpages-dev mawk memtest86+ mime-support mlocate module-init-tools mount mountall mtr-tiny multiarch-support nano ncurses-base ncurses-bin net-tools netbase netcat-openbsd nfs-common ntfs-3g ntp ntpdate openssh-client openssh-server openssl os-prober parted passwd pciutils perl perl-base perl-modules php5 php5-cgi php5-cli php5-common php5-curl php5-dev php5-sqlite php5-xdebug pkg-config plymouth plymouth-theme-ubuntu-text popularity-contest powermgmt-base ppp pppconfig pppoeconf procps psmisc python python-apt python-apt-common python-chardet python-dbus python-dbus-dev python-debian python-gdbm python-gi python-gnupginterface python-minimal python-xapian python2.7 python2.7-minimal readline-common resolvconf rpcbind rsync rsyslog sed sensible-utils sgml-base shtool spawn-fcgi ssh-import-id ssl-cert strace sudo sysv-rc sysvinit-utils tar tasksel tasksel-data tcpd tcpdump telnet time tzdata ubuntu-keyring ubuntu-minimal ubuntu-standard ucf udev ufw update-manager-core upstart ureadahead usbutils util-linux uuid-runtime vim-common vim-tiny watershed wget whiptail wireless-regdb xauth xkb-data xml-core xz-lzma xz-utils zlib1g zlib1g-dev

# Apache rewrite
ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled

# SSL
ln -s /vagrant/glass-beach.crt /etc/ssl/certs/glass-beach.crt
ln -s /vagrant/glass-beach.key /etc/ssl/certs/glass-beach.key

cat <<EOVHOST > /etc/apache2/sites-available/default
<VirtualHost *:80>
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www

        SSLEngine on
        SSLCertificateFile /etc/ssl/certs/glass-beach.crt
        SSLCertificateKeyFile /etc/ssl/certs/glass-beach.key

        <Directory />
                Options FollowSymLinks
                AllowOverride None
        </Directory>
        <Directory /var/www/>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride None
                Order allow,deny
                allow from all
        </Directory>

        ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
        <Directory "/usr/lib/cgi-bin">
                AllowOverride None
                Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
                Order allow,deny
                Allow from all
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log

        # Possible values include: debug, info, notice, warn, error, crit,
        # alert, emerg.
        LogLevel warn

        CustomLog ${APACHE_LOG_DIR}/access.log combined

    Alias /doc/ "/usr/share/doc/"
    <Directory "/usr/share/doc/">
        Options Indexes MultiViews FollowSymLinks
        AllowOverride None
        Order deny,allow
        Deny from all
        Allow from 127.0.0.0/255.0.0.0 ::1/128
    </Directory>

</VirtualHost>
EOVHOST

# Timezone
sed -i.bak -e 's/;date.timezone =/date.timezone = "America\/Montreal"/' /etc/php5/cli/php.ini
sed -i.bak -e 's/;date.timezone =/date.timezone = "America\/Montreal"/' /etc/php5/cgi/php.ini

rm -rf /var/www
ln -s /vagrant /var/www

service apache2 restart
apt-get -y autoremove
apt-get -y autoclean
updatedb
