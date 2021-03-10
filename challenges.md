## Challenges :star2:

### 1. We need a platform with Laravel, it uses MySQL/MariaDB, a SMTP server for emails and Redis server. What are the steps you consider necessary to leave the application running in development mode?

-   In a past way I would create the database in PHPMyAdmin with XAMPP or Heidi with Laragon, and then I update the file [.env](.env) with the credentials. For an SMTP server I would create an account in Mailtrap, copy the credentials and paste it in the sam file .env. About Redis, I have never used honestly, but it would be the same steps, create the service and paste the credentials in the file .env.

-   Now I use docker, in this case Laravel Sail provide some containers for MySQL, MailHog(SMTP server for testing) and Redis server.

### 2. Imagine the next tables.

-   Publication (id, title, content, user_id)
-   Comment (id, publication_id, content, status)

How would you define the relationship a publication have many comments?

-   Without Laravel, in the database When I create the table comments I would set the attribute publication_id in Comments as foreign key to reference the primary key id in Publication.
-   With Laravel when I create the migration for the Comments I would set this relation with:

```
$table->foreign('publication_id')->references('id')->on('publication');
```

-   Then in the Model with **Eloquent** I set this relation as function according how Eloquent works.
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

### 3. With the last Models create a query with Eloquent that gets all the publications with commentaries that contains "Hola" and be approved.

```
<!-- TODO: Check in a real environment if it works -->
Publication::all()->commentaries
    ->where('status', 'approved')
    ->where('content', 'like', '%Hola%')
    ->get();
```

### 4. What are the advantages of migrations in a production server?

There are many advantages, even since development server like:

-   Having a better **version control** in the database structure, if any developer create a table there are not many problem to others.
-   If there are some mistake or error we can undo the last updates.
-   We can test better the database before to update the tables in the production server.

And then we just run `php artisan migrate` in the production server and we have the new updates in the database without affect the real data and avoid mistakes.

### 5 Create a project in Laravel.

#### Part 1. Create the tables users, publications and comments.

Ready, I added extra features like another table `comment_state` for the status in comments instead of the attribute `status`, and the table comments has the attribute `user_id`.

And I created all resources like seeders, factories, relation in the Models and some Test (some tests does not work, but to not overload me I create this commit to have less files in the stage).

#### Part 2. Create a CRUD for my publications.

With livewire I get the data with pagination, create, delete, update and look a publication. There are some validations about storing and updating data, and a basic policy to not allow delete and update publications by not owners.

#### Part 3. Create some views to look all the publications with comments.

This are static views, so I did not use livewire. All the users can look all the publications and each publication show just the approved comments.

#### Part 4. All the user can comment just one time any publication.

The resource to create the commentary and the validations were created. I also improve the seeders and factories with more data and a defined user with a publication with some commentaries.

#### Part 5. When a user comment a publication, an email is sent to the owner.

I use an Event and Listener to catch the action, then with a Notification I sent the email, and I can look it from MailHog.

To not to overload the server, these processes are executed in the background to give a fast response to the user. We can listen this processes with `sail artisan queue:listen`.
