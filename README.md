# Laravel Livewire Publications ![Status](https://img.shields.io/badge/status-in_refactoring-yellowgreen) ![Passing](https://img.shields.io/badge/build-passing-green) ![Docker build](https://img.shields.io/badge/docker_build-passing-green) ![Tests](https://img.shields.io/badge/tests-100%25-green)

_Job Interview for Full Stack PHP Developer. System to make publications and comments._

### Project goal by mascam97

This was a part of technical job interviews where I completed some [challenges and questions](.job-interview).

I decided to challenge me by working with **Jetstream + Livewire - Blade** (instead of Laravel UI and Vue.js) and **Tailwindcss** (instead of Bootstrap), because I have personal projects with these features.

### Achievements :star2:

- Completed all the challenges.
- Implemented a **CRUD and dynamic components with Livewire**.
- Implemented an Event, Listener and Notification to send an email as Queue.
- Implemented **design with Tailwindcss** according to Jetstream components and styles.
- Implemented professional features like pagination, searching, flash messages, etc.
- Implemented Testing with PHPUnit to Models, Controllers and **Livewire components**.
- Fixed some bugs with testing and investigation.

### TODOs

- Implement [Alpine.js](https://alpinejs.dev/)
- Implement [View Models pattern](https://github.com/spatie/laravel-view-models)
- Improve the quality code
- Improve the code coverage

---
## Getting Started :rocket:

These instructions will get you a copy of the project up and running on your local machine.

### Prerequisites :clipboard:

The programs you need are:

-   [Docker](https://www.docker.com/get-started) and [Docker compose](https://docs.docker.com/compose/install/).

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

With Laravel Sail you can run commands as docker-compose (e.g. docker-compose up -d = sail up -d) and php(e.g. php artisan migrate = sail artisan migrate). To run Composer, Artisan, and Node / NPM commands just add sail at the beginning (e.g. sail npm install). More information [here](https://laravel.com/docs/8.x/sail).

Then generate the application key.

```
sail artisan key:generate
```

Finally, generate the database with fake data:

```
sail artisan migrate --seed
```

Note: You could refresh the database any time with `migrate:refresh`.

And now you have all the environment in the port 80 (http://localhost/).

Note: JavaScript and CSS files are loaded in public/css and public/js, you do not need to generate it with `sail npm install` and `sail npm run watch` because there are not files that generate JavaScript and CSS like SASS or Vue files. 

---

## Testing

### Backend testing

There are some test for Models and Controller, Jetstream also has its tests about its features, for Livewire components there are some tests to validate its functions and placement in some view. You can run available tests with:

```
sail artisan test
```

---
## Advanced features

### Running Queues

There is a queue generated when a publication has a new comment and an email is sent to the publication owner, to run queues execute:

```
sail artisan queue:listen
```

Note: Remember in production the better command is `queue:work`, [explanation](https://laravel-news.com/queuelisten).

You can look the emails with MailHog, it is on the port [8025](http://localhost:8025).

---

### Built With 🛠️

-   [Laravel 8](https://laravel.com/docs/8.x/releases/) - PHP framework.
-   [Laravel Sail](https://laravel.com/docs/8.x/sail) - Docker development environment.
-   [Laravel Jetstream - Livewire + Blade](https://jetstream.laravel.com/2.x/introduction.html#livewire-blade) - Starter kit with Authentication, Tailwindcss and more.
-   [Tailwindcss](https://tailwindcss.com/) - CSS Framework.

### Authors

-   Martín S. Campos - [mascam97](https://github.com/mascam97)

### Contributing

You're free to contribute to this project by submitting [issues](https://github.com/mascam97/laravel-livewire-publications/issues) and/or [pull requests](https://github.com/mascam97/laravel-livewire-publications/pulls), there are many Bugs you can clean.

### License

This project is licensed under the [MIT License](https://choosealicense.com/licenses/mit/).

### References :books:

- [Tailwind CSS Course](https://platzi.com/clases/tailwind-css/)
- [Livewire with Laravel Basic Course](https://www.youtube.com/playlist?list=PLhCiuvlix-rSRRmZAL2CNOMAUjgEiFoSl)
- [Laravel 8 Introduction Course](https://platzi.com/clases/intro-laravel/)
- [Test Driven Development with Laravel Course](https://platzi.com/clases/laravel-tdd/)
- [Testing with PHP and Laravel Basic Course](https://platzi.com/clases/laravel-testing/)
