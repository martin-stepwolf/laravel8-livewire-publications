# Laravel8 Liveware Job Interview

_Many challenges and questions about Laravel._

### Project goal by martin-stepwolf :goal_net:

Personal project to practice Liveware and get a job as Backend Developer.

---

## Challenges :star2:

### 1. We need a platform with Laravel, it uses MySQL/MariaDB, a SMTP server for emails and Redis server.  What are the steps you consider necessary to leave the application running in development mode?

- In a past way I would create the database in PHPMyAdmin with XAMPP or Heidi with Laragon, and then I update the file [.env](.env) with the credentials. For an SMTP server I would create an account in Mailtrap, copy the credentials and paste it in the sam file .env. About Redis, I have never used honestly, but it would be the same steps, create the service and paste the credentials in the file .env.

- Now I use docker, in this case Laravel Sail provide some containers for MySQL, MailHog(SMTP server for testing) and Redis server.

### 2. Imagine the next tables.

- Publication (id, title, content, user_id)
- Comment (id, publication_id, content, status)

How would you define the relationship a publication have many comments?

- Without Laravel, in the database When I create the table comments I would set the attribute publication_id in Comments as foreign key to reference the primary key id in Publication.
- With Laravel when I create the migration for the Comments I would set this relation with:
```
$table->foreign('publication_id')->references('id')->on('publication');
```

- Then in the Model with **Eloquent** I set this relation as function according how Eloquent works.
In this case for the Model Publication would be:
```
    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }
```
and for the Model Comment:
```
    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }
```

---

## Getting Started :rocket:

These instructions will get you a copy of the project up and running on your local machine.

### Prerequisites :clipboard:

The programs you need are:

-   [Docker](https://www.docker.com/get-started).
-   [Docker compose](https://docs.docker.com/compose/install/).

### Installing 🔧

First duplicate the file .env.example as .env.

```
cp .env.example .env
```

Note: You could change some values, anyway docker-compose create the database according to the defined values.

Then install the PHP dependencies:

```
 docker run --rm --interactive --tty \
 --volume $PWD:/app \
 composer install
```

Then create the next alias to run commands in the container with Laravel Sail.

```
alias sail='bash vendor/bin/sail'
```

Note: Setting this alias as permanent is recommended.  

Create the images and run the services (laravel app, mysql, redis and mailhog):

```
sail up
```

With Laravel Sail you can run commands as docker-compose (docker-compose up -d = sail up -d) and php(e.g php artisan migrate = sail artisan migrate). To run Composer, Artisan, and Node / NPM commands just add sail at the beginning (e.g sail npm install). More information [here](https://laravel.com/docs/8.x/sail).

Then generate the application key.

```
sail artisan key:generate
```

Finally generate the database with fake data:

```
sail artisan migrate --seed
```

Note: You could refresh the database any time with `migrate:refresh`.

And now you have all the environment in the port 80 (http://localhost/).

---

## Testing

### Backend testing

There are some unit testing in Models and Traits and some feature testings in controllers, all these test guarantee functionalities like table relationship, validations, authentication, authorization, actions as create, read, update and delete, etc. 

```
sail artisan test
```

---

### Built With 🛠️

-   [Laravel 8](https://laravel.com/docs/8.x/releases/) - PHP framework.
-   [Laravel Sail](https://laravel.com/docs/8.x/sail) - Docker development environment.
-   [Laravel Jetstream - Liveware + Blade](https://jetstream.laravel.com/2.x/introduction.html#livewire-blade) - Starter kit with Authentication, Tailwindcss and more.

### Authors

-   Martín Campos - [martin-stepwolf](https://github.com/martin-stepwolf)

### Contributing

You're free to contribute to this project by submitting [issues](https://github.com/martin-stepwolf/laravel8-api-quotes/issues) and/or [pull requests](https://github.com/martin-stepwolf/laravel8-api-quotes/pulls).

### License

This project is licensed under the [MIT License](https://choosealicense.com/licenses/mit/).

### References :books:

- [Laravel 8 Introduction Course](https://platzi.com/clases/intro-laravel/)
- [Test Driven Development with Laravel Course](https://platzi.com/clases/laravel-tdd/)
- [Testing with PHP and Laravel Basic Course](https://platzi.com/clases/laravel-testing/)
