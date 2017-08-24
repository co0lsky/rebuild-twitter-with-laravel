# Rebuild Twitter with Laravel

Perhaps you have completed the courses like [PHP with Laravel for beginners — Become a Master in Laravel](https://www.udemy.com/php-with-laravel-for-beginners-become-a-master-in-laravel/) or [Laravel From Scratch](https://laracasts.com/series/laravel-5-from-scratch). You’ve learned the basics of Laravel.

Now what?

You want to build something bigger than a basic CRUD app.

Let’s say building a blog. You’ve learned how to create a post, update it, and delete it. Now you want to know how to build the user account, who can create a post that available to other users who want to view it. You want to know what’s the best practices with the naming conventions for routes.

I am going to cover those topics in this Rebuild Twitter with Laravel.

Follow along and together we’ll build an interesting app, at the same time, develop your skills and be ready to change the world.

Here is what we are going to do.

We’ll rebuild the famous social network, Twitter from scratch. Please bear in mind that this is a project for learning, the outcome is not exactly same as the actual Twitter website. We are learning by rebuilding the key features in our own way.

These are the key features of the Twitter that we are going to rebuild,
* User
* Follow/Unfollow
* Tweet/Retweet
* Timeline

For more, please visit to the [Rebuild Twitter with Laravel](https://medium.com/@just4sky/rebuild-twitter-with-laravel-user-and-authentication-9b0adb392dc6).


## Setup

### Clone the project

Project link: https://github.com/co0lsky/rebuild-twitter-with-laravel
Clone the project from Github

```
// Terminal
git clone -b '#4_PostTweet_LinkPreview_UrlShorten' https://github.com/co0lsky/rebuild-twitter-with-laravel.git laratweet
cd laratweet
composer install
```

If you hit an error. Don't worry, run an update to fix it.

```
// Terminal
composer update
```

### Configure application environment file

Duplicate the .env.example to be .env

Configure database access. I recommend you to create a new database for this application. The table name has no unique prefix or suffix, it might clash with your existing table which is having the same name, like users.

```
// .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laratweet
DB_USERNAME=homestead
DB_PASSWORD=secret
```

### Generate Application Key

Next, you should generate an application key. The application key helps to secure your application’s user sessions and other encrypted data.

```
// Terminal
php artisan key:generate
Application key [base64:uJwG9Kge1xwH7O0/sckwN96pENJJy8cr5i+WbwQ7dYw=] set successfully.
```

### Migration

Next, migrate your database.

```
// Terminal
php artisan migrate
Migration table created successfully.
Migrated: 2014_10_12_000000_create_users_table
Migrated: 2014_10_12_100000_create_password_resets_table
Migrated: 2017_02_11_083844_create_followers_table
Migrated: 2017_03_27_083148_create_tweets_table
```

### Test

Launch your application.

![Home page](http://iteachyouhowtocode.com/wp-content/uploads/2017/08/medium_1.png)

Register as a user.

![Register page](http://iteachyouhowtocode.com/wp-content/uploads/2017/08/medium_2.png)

![Home page](http://iteachyouhowtocode.com/wp-content/uploads/2017/08/medium_3.png)

Alright, the application is ready.