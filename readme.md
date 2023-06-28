## About SIMADA

SIMADA adalah Aplikasi Sistem Management Dokumen Aisin Indonesia yang menyimpan serta mengelolo dokumen SPTT

## Instalation with Docker Compose

1. git clone https://github.com/teguh2910/simada.git
2. cd simada
3. setting .env file
4. docker-compose build app
5. docker-compose up -d
6. docker-compose exec app rm -rf vendor composer.lock
7. docker-compose exec app composer install
8. docker-compose exec app php artisan key:generate
9. docker-compose exec app php artisan migrate
10. docker-compose exec app php artisan db:seed

## Contributing

Thank you for considering contributing to the SIMADA Project!.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at teguh.yuhono@student.unsia.ac.id. All security vulnerabilities will be promptly addressed.

## License

The SIMADA is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
