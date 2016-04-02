================================================== the project on apache2
sudo gedit /etc/apache2/apache2.conf
Add these:
<Directory /var/www/html/fas7ny >
DirectoryIndex index.php
AllowOverride All
</Directory>
sudo a2enmod rewrite #a2enmod: apache2 enable mode rewrite
sudo service apache2 restart # restart the server
=========================================================== the virual host
sudo gedit /etc/apache2/sites-available/fas7ny.conf
Add these:
<VirtualHost *:80>
ServerName fas7ny.iti.com
DocumentRoot /var/www/html/fas7ny/public
SetEnv APPLICATION_ENV "development"
<Directory /var/www/fas7ny>
DirectoryIndex index.php
AllowOverride All
</Directory>
</VirtualHost>


************************
Add your virtual host to hosts:
sudo gedit /etc/hosts
And add this line:
127.0.0.1     fas7ny.iti.com

● Enable the site on apache server
sudo a2ensite project_name.conf
● Reload the server
sudo service apache2 reload
===================================================================== connection the database
 zf configure db-adapter "adapter=PDO_MYSQL&dbname=fsa7ny&host=localhost&username=iti&password=iti" 
================================================================

