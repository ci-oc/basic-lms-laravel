<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## About FCI-H-LMS

**FCI-H-LMS** is a web application that was developed to fill the gaps in modern LMS. This project was developed under supervision of:
- Professor/ [Ghada Ahmed.](http://www.fcih.net/ghada/resume) 
- Professor/ [Insaf Huessien](https://eg.linkedin.com/in/ensaf-hussein-7b257492) 
## APIs

We would like to extend our thanks to the following APIs and their developers.

- **[Zizcao/Entrust](https://github.com/Zizaco/entrust)**
- **[yusufsyaifudin/grader-library](https://github.com/yusufsyaifudin/grader-library)**
    - Forked and developed by andrewnagyeb [andrewnagyeb/grader-library](https://github.com/andrewnagyeb/grader-library) [Please check readme file.]
- **[Time and Date](https://www.timeanddate.com/)**

## Security Vulnerabilities

If you discover a security vulnerability within FCI-H-LMS, please send an e-mail to fcih-lms@fcih.com. All security vulnerabilities will be promptly addressed.
## Issues
In case of receiving this error
- BadMethodCallException, Please run this two commands
`php artisan config:cache`, `php artisan config:clear`
## License

MIT Creative Common License [MIT license](http://opensource.org/licenses/MIT).
## Database Demo Data
Please click the link below.
- [Database Data Demo](https://drive.google.com/open?id=0B7tstgwobtR9ZDZpQW9YMkw4SkU)

## Accounts
Please go to your DBMS and view users table. First two records are the superusers accounts, next 20 are instructors. the 20 after them are students. 
- Default password: "secret" (without quotes)