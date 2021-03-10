# Laravel8 Liveware Publications ![Status](https://img.shields.io/badge/status-in_process-yellow) ![Passing](https://img.shields.io/badge/build-passing-green) ![Docker build](https://img.shields.io/badge/docker_build-passing-green)

_App to make publications and comments._

### Project goal by martin-stepwolf :goal_net:

This was a part of a interview where I completed some challenges and questions, you can read about it in this [file](challenges.md).

In this interview they ask me to make a Laravel project with similar features that I have made in other personal projects, so I decided to challenge me by creating a project with Jetstream + Liveware - Blade, a way similar to Vue - Inertia, and Implement Tailwindcss instead of Bootstrap.

### Achievements :star2:

- Completed all the challenges.
- Implemented a CRUD with Livewire.
- Implemented an Event, Listener and Notification to sent an email.

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
## Advanced features

### Running Queues

There are some processes to send an email when a publication has a new comment, to run it execute:

```
sail artisan queue:listen
```

Note: Remember in production the better command is `queue:work`, [explanation](https://laravel-news.com/queuelisten).

You can look the emails with MailHog, it is on the port [8025](http://localhost:8025).

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

- [Livewire with Laravel Basic Course](https://www.youtube.com/playlist?list=PLhCiuvlix-rSRRmZAL2CNOMAUjgEiFoSl)
- [Laravel 8 Introduction Course](https://platzi.com/clases/intro-laravel/)
- [Test Driven Development with Laravel Course](https://platzi.com/clases/laravel-tdd/)
- [Testing with PHP and Laravel Basic Course](https://platzi.com/clases/laravel-testing/)
