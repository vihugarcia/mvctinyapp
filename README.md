MVCTinyApp
==========

MVCTinyApp is an extremely simple PHP application, on top of a custom framework.

This framework is NOT production ready, and it's only published with educational purposes. It shows how to adopt the MVC pattern to structure applications.

DIRECTORY STRUCTURE
-------------------

```
app    
    Controllers/         contains Web controller classes
    Models/              contains model classes    
    Views/               contains view files for the Web application
config/                  contains backend configurations
public
    css/                 contains compiled stylesheets
    img/                 
    js/                  contains javascript files
    scss/                contains scss files to be compiled to css
    uploads/             contains guests profile images
tests                    contains PHPUnit tests
tinymvc
    core
        Controllers/     contains framework controller class
            Models/      contains framework model class    
            Views/       contains framework view class
    database/            contains database connection class
    helpers/             contains helper classes    
```

Installation
============

1. Copy the files to your web root

2. Create a new database and adjust `config/config.php` accordingly.

3. Import the file mvctinyapp.sql into the database.

4. Set document roots of your web server:

   For Apache it could be the following:

   ```apache
       <VirtualHost *:80>
           ServerName app.local
           DocumentRoot "/path/to/application/"
           
           <Directory "/path/to/application/">
           		AllowOverride All
           		Require all Granted
           	</Directory>
       </VirtualHost>
   ```
   
5. Change the hosts file to point the domain to your server.

   - Windows: `c:\Windows\System32\Drivers\etc\hosts`
   - Linux: `/etc/hosts`

   Add the following lines:

   ```
   127.0.0.1   app.local   
   ```
