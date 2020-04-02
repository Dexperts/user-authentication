# Authentication package

Install the package by executing the following command:
```
composer require dexperts/dexperts/user-authentication
```

After installation execute the command to setup the database tables:
```
php artisan migrate
```

Optional after installation is the seeder
```
php artisan db:seed --class=Dexperts\\Authentication\\Database\\Seeds\\MinimalSetupSeeder
```
