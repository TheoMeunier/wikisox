# Isoxbook

Isoxbook is a wiki tool for creating documentation, simply with a markdown editor and th we can share these documentations with our team.

## Prerequisites

- PHP 8.2
- Composer 
- Maria DB
- Redis
- Yarn
- Docker & docker compose if using

## Installation

```
git clone https://github.com/TheoMeunier/Isoxbook.git
```
- `cd Isoxbook`
- Move .env.example or .env.prod.example to .env and edit it according to your project
- Run installation dependencies php `composer install`
- Run either `yarn dev` or `yarn prod`
- Generate application secret key with `php artisan key:generate`
- Generate migration and default user with `php artisan migrate --seed`
- Generate storage link with `php artisan storage:link`
- Enjoy :)

## Installation Docker
```
git clone https://github.com/TheoMeunier/Isoxbook.git
```
- `cd Isoxbook`
- Move .env.example or .env.prod.example to .env and edit it according to your project
- Move docker-compose.yml to docker-compose.prod.yml
- Start containers with `docker-compose up -d`
- Run into the php container with `docker-compose exec php bash`
- Install php libs with `composer install`
- Install javascript libs with `yarn install`
- Run either `yarn dev` or `yarn prod`
- Generate application secret key with `php artisan key:generate`
- Generate migration and default user with `php artisan migrate --seed`
- Generate storage link with `php artisan storage:link`
- Enjoy :)


