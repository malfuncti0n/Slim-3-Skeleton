# Slim 3 Skeleton Base Project

This is a simple skeleton project for Slim 3 with base Bootstrap style that includes Twig, Flash messages, fully operational Signup/Signin with Mail Validation, base Users administration and track of users activity.

## Create your project:

    $ composer create-project --no-interaction --stability=dev loukovits/slim3-skeleton [my-app]

Where [my-app] the path you want to install it.

### Run it:

1. Go to [my-app]/app/config
2. Change the db.php and put your database information.
3. Change the mail.php and put your mail information.
4. `$cd [my-app]`
5. `vendor/bin/phinx init`
6. Change the [my-app]/phinx.yml as below:


    paths:
        migrations: %%PHINX_CONFIG_DIR%%/app/Services/db/migrations
        seeds: %%PHINX_CONFIG_DIR%%/app/Services/db/seeds
    
    environments:
        default_migration_table: phinxlog
        default_database: development
        production:
            adapter: mysql
            host: localhost
            name: production_db
            user: root
            pass: ''
            port: 3306
            charset: utf8
    
        development:
            adapter: mysql
            host: localhost
            name: your_db
            user: your_db_user
            pass: 'your_db_password'
            port: 3306
            charset: utf8
    
        testing:
            adapter: mysql
            host: localhost
            name: testing_db
            user: root
            pass: ''
            port: 3306
            charset: utf8

7. `vendor/bin/phinx migrate -e development`
8. Go into your database and at the users table add to user admin your email.
9. Login as Admin with your email and password `admin`.

## Key directories

* `app`: Application code
* `app/config`: The configuration files for your database and your mail
* `app/Services`: The PHPMailr and the Migrations files
* `app/Validation`: All Validators files
* `resources/views`: All Twig's template files
* `public`: Webserver root
* `vendor`: Composer dependencies

## Key Paths:

    auth/signup
    auth/signin
    auth/password/change
    auth/signout
    admin/users

## composer.json

    {
        "require": {
            "slim/slim": "^3.0",
            "slim/twig-view": "^2.1",
            "illuminate/database": "^5.3",
            "respect/validation": "^1.1",
            "slim/csrf": "^0.7.0",
            "slim/flash": "^0.1.0",
            "hassankhan/config": "^0.10.0",
            "phpmailer/phpmailer": "^5.2",
            "robmorgan/phinx": "^0.6.5"
        },
        "autoload": {
            "psr-4": {
                "App\\": "app"
            }
        }
    }
 
 