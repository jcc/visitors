# visitors

modify with https://github.com/weboAp/Visitor


#Step 1

Just add to composer.json file:
```json
{
    "require": {
        "cjjian/visitor": "dev-master"
    }
}
```
then run
```
composer update
```

#Step 2

Add
`Cjjian\Visitors\VisitorServiceProvider::class`
to the list of service providers in app/config/app.php

#Step 3

Migrate the Visitor Table Run
```
php artisan vendor:publish
```

then

```
php artisan migrate
```

to migrate visitor table

the config.php will be copied to /config at the same time

/config/visitor.php
costumize it accordinly

#Step 5 (Optional)

Visit http://dev.maxmind.com/geoip/geoip2/geolite2/

download GeoLite2-City.mmdb

place it in (create the geo directory)

storage/geo/
or where ever you want just adjust the package config to reflect the new location, it's used to geo locate visitors

#Usage

```php
Visitor::log();   //log in db visitor ip, geo location, hit counter
```
