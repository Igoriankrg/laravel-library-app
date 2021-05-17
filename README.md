## Getting Started

### Docker
This project store docker images. Download docker application to your machine if you don't have it. Open your terminal:

    cd /path/to/your_project_folder
    docker-compose up

### Composer
Make composer install:

    docker-compose exec app composer install

### Open api
Create:

    docker-compose exec app php artisan l5-swagger:generate

Documentation Url

    http://localhost/api/documentation


### DB
Migration:

    docker-compose exec app php artisan migrate

Seeding:

    docker-compose exec app php artisan db:seed

