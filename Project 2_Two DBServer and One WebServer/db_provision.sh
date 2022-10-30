#!/bin/bash
#provision DBBox Version 0.0.0
# Edited by Jessica Rankins 4/17/2017


rm -f postinstall.sh

apt-get update
# mysql username: root
# mysql password: rootpass
debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password rootpass'
debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password rootpass'
apt-get -y install mysql-server php5-mysql

sed -i "s/bind-address\s*=\s*127.0.0.1/bind-address = 0.0.0.0/" "/etc/mysql/my.cnf"

# Allow root access from any host
echo "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'rootpass' WITH GRANT OPTION; FLUSH PRIVILEGES;" | mysql -u root --password=rootpass
#echo "GRANT PROXY ON ''@'' TO 'root'@'%' WITH GRANT OPTION" | mysql -u root --password=rootpass
sudo service mysql restart

# Create database for form responses (WebExampleBox)
mysql -uroot -p'rootpass' -e "DROP DATABASE IF EXISTS formresponses; 
	CREATE DATABASE formresponses; 
	USE formresponses; 
	CREATE TABLE response (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, 
		firstname VARCHAR(20), lastname VARCHAR(20), 
		email VARCHAR(50), submitdate DATETIME);"
sudo service mysql restart

echo cd / >> /home/vagrant/.bashrc
echo "Hello World from DBBox!"
