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


### 2.1 Un poco de laravel Mix

    Ubicando en webpack.mix.js desde ali genera los diferentes js y css necesarios


## 3. Configurando Pusher

    composer require pusher/pusher-php-server

    1. Modificar el .env
    BROADCAST_DRIVER=pusher

    2. Las credenciales ...
    PUSHER_APP_ID ...

    3. Descomentar en config/app.php
    App\Providers\BroadcastServiceProvider::class,