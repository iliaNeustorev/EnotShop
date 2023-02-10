<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

В тестовом проекте используется laravel version v.9, vueJS3 и docker compose

## установка Laravel

Перейти в контейнер app:

```
 docker exec -it enotshop_app bash
```

и ввести команду:

```
composer create-project laravel/laravel EnotShop
```

## Установка компонентов vue, vite plugins, bulma(CSS framework)

Перейти в контейнер node:

```
 docker exec -it enotshop_node bash
```

и ввести несколько команд по порядку:

```
a) npm install
b) npm i vue axios vuex vue-router bulma
c) npm i @vite/js plugin-vue -D
```

## Настройка соединения с базой данных

Редактировать файл `/.env`:

```
APP_NAME=EnotShop
APP_URL=http://localhost:8856

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=base345_base
DB_USERNAME=root
DB_PASSWORD=root
```

## Запуск проекта

В консоли linux WSL2:

```
docker compose build
docker compose up -d
```

## Остановка проекта

В консоли linux WSL2

```
docker compose down
```
