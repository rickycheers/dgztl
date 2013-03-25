# Car Management Test

## Installation

### Install Composer

To install Composer run the folwing command in your Apache document root folder.

    curl -s https://getcomposer.org/installer | php

### Install the project

Create the project using the `composer.phar` file recently downloaded.

    php composer.phar create-project --stability="dev" montealegreluis/carmsys dgztl

This command will install the project in a folder named `dgztl`. Enter `Y` when prompted
to remove the VCS files.

### Create the database and load initial data

In order to use the configuration in the project as is, you will have to run the following
command in your MySQL server instance.

    GRANT ALL PRIVILEGES on car_mgmt_sys.* TO checo_perez@localhost IDENTIFIED BY 'Ch3c0_p3r3z';

You can use your own user by modifying the file `config/databases.yml` providing valid
credentials.

`cd` to your `dgztl` folder and run the following command to create the database

    ./symfony doctrine:build-db
    
Run the following command to create the database schema

    ./symfony doctrine:insert-sql
    
Run the following command to load the initial data

    ./symfony doctrine:data-load

### Configure a virtual host

Add this line to your `hosts` file (`/etc/hosts`)

    127.0.0.1 checoperez.dev
    
Add this to your Apache's `vhost.conf` file (`/etc/httpd/conf.d/vhosts.conf`)

    #
    # checoperez.dev
    #
    <VirtualHost *:80>
        ServerName checoperez.dev
        DocumentRoot /path/to/documentroot/dgztl/web
        <Directory "/path/to/documentroot/dgztl/web">
            Options Indexes MultiViews FollowSymLinks
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>
    
Create a symlink to the application assets

    cd web/
    ln -s ../lib/vendor/symfony/symfony1/data/web/sf/ sf

Restart Apache

    sudo service httpd restart

### Run the application

Open a browser and go to

    http://checoperez.dev