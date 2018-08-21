<h1 align="center">Basic Learning Management System (BasicLMS)</h1>

## About FCI-H-LMS

**FCI-H-LMS** is a web application that mainly consists of the following modules:

- [Courses](#courses)
- [Quiz (Online Judge, MCQ Questions)](#quiz-module)
- [Plagiarism](#plagiarism-module)
- [Assignment](#assignment-module)
- [Submission Tracking](#submission-track-module)
- [Registration](#registration)
- [Announcements](#announcements)
- [User Profile](#user-profile)


The BasicLMS currently supports only *English* and *Arabic* languages.

It was originally developed to fill the gaps in modern LMS. This project was developed under supervision of:
- Professor/ [Ghada Ahmed.](http://www.fcih.net/ghada/resume) 
- Professor/ [Insaf Huessien](https://eg.linkedin.com/in/ensaf-hussein-7b257492) 
## APIs

We would like to extend our thanks to the following APIs and their developers.

- **[Zizcao/Entrust](https://github.com/Zizaco/entrust)**
- **[yusufsyaifudin/grader-library](https://github.com/yusufsyaifudin/grader-library)**
    - Forked and developed by andrewnagyeb [andrewnagyeb/grader-library](https://github.com/andrewnagyeb/grader-library) [Please check readme file.]
- **[Time and Date](https://www.timeanddate.com/)**
- **[MOSS](https://github.com/Phhere/MOSS-PHP)**

# Modules Explanation

## Administration Panel

### Users' Actions Tracking

### News Updating

### Adding/Assigning Roles


## Courses 

## Quiz

## Plagiarism

## Assignment

## Submission Tracking

## Registration

## Announcements

## User Profile

## Installation ( Make sure you run it on *nix operating system)
### Requirements
- C/C++ Dependencies and Compilers
- Perl Dependencies
- Composer [Check Composer Official Website](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

### Guide  
- **`git clone https://github.com/andrewnagyeb/module`**
- **`cd module`**
- **`composer update`**
- **`composer dump-autoload`**
- **`php artisan key:generate`**
- **`php artisan config:cache`**
- **`php artisan config:clear`**

Database Configuration 
- **`cat .env.example >> .env`**
- **`gedit .env`**
Then please configure your database credentials in ths area
``` 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=DATABASE_NAME
DB_USERNAME=MYSQL_USERNAME ( default is root )
DB_PASSWORD=MYSQL_PASSWORD

```
Also make sure you have the following configuration in your **.env** file.
```
BROADCAST_DRIVER=log
CACHE_DRIVER=array
SESSION_DRIVER=file
QUEUE_DRIVER=database
```

### Sandbox

- Please refer to this [README](https://github.com/andrewnagyeb/grader-library/blob/master/README.md) 

### Run
In order to host it on local area network, run the following command:
- **`ifconfig | grep inet`**
then copy your IP. 
- **`php artisan serve --host=IP --port=8000`**

To host it on local machine:
- **`php artisan serve`**

And run the following command in order to run Online Judge Queue and Mails Queue (with priority to judge queue first)
- **`php artisan queue:listen --queue=remark,emails`** 

To activate plagiarism detection using *MOSS* run:
- **`php artisan remark`** 
## Security Vulnerabilities

If you discover a security vulnerability within FCI-H-LMS, please post an issue. All security vulnerabilities will be addressd.
## Issues
In case of receiving this error
- BadMethodCallException, Please run this two commands
`php artisan config:cache`, `php artisan config:clear`
## License

MIT Creative Common License [MIT license](http://opensource.org/licenses/MIT).
## Database Seeding
In order to seed database with accounts. Please run the following command:
- `php artisan migrate -- seed`

If you want to disable seeding for specific table. Please open the following file.
- `gedit PATH/TO/module/database/seeds/DatabaseSeeder.php`

And then you can comment by `#` any of the following seeders.

But note that you can only comment/uncomment instructors and/or student seeders, because superuser accounts are only created through seeding.

Example:


```php
$this->call(PermissionTableSeeder::class);
$this->call(JudgeOptionsSeeder::class);
$this->call(RoleTableSeeder::class);
$this->call(SuperUserTableSeeder::class);
$this->call(SecurityURLSeeder::class);
#$this->call(InstructorsTableSeeder::class);
#$this->call(StudentsTableSeeder::class);
$this->call(CodingLanguagesSeeder::class);  
```
## Database Demo
Link [Click here](https://drive.google.com/open?id=0B7tstgwobtR9eW9pNUluenpYcU0)
### Accounts
#### Default credentials
Please go to your DBMS and view users table. First two records are the superusers accounts, next 20 are instructors. the 20 after them are students. 
- Default password: "secret" (without quotes)   

