# ConvertedIn Task

## Installation

First clone the repository.

```
git clone https://github.com/ibrahimmalii/convertedInTask.git
```

Then copy the .env.example file to .env file.

```
cp .env.example .env
```

Then install the dependencies.

```
composer install
```

Then create a database and add the database credentials to the .env file.

```
php artisan db:create
```

Then Run this command to start the application.

```
php artisan app:start
```

Then run this command to start the queue worker.

```
php artisan queue:work
```

Then run this command to run the tests.

```
php artisan test
```

Then go to

```
http://localhost/
```
