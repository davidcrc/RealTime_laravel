# Aplicacion realTime 

## 1. Inicializando
    sudo apt install compose
    composer create-project --prefer-dist laravel/laravel realTime


    php artisan serve
    php artisan migrate:fresh

## 2. Agregando Laravel UI: Multiples componentes basicos (bootstrap, CRUD, , viewjs, react, etc)

    composer require laravel/ui
    php artisan                  // Aca nos da los comandos que tenemos utilizables
    php artisan ui bootstrap --auth
    npm install && npm run dev