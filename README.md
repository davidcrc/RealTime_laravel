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

## 4. Laravel echo : Definicion aqui

    npm install --save-dev laravel-echo pusher-js

    - Descomentar en resources/js/bootstrap.js , lo referente a laravel echo

    - Volver a compilar: npm run dev

## 5. Evento para la modificacion de sesiones

    php artisan make:event UserSessionChanged

    - Este evento debe ser transmitido en tiempo real
    - Esto lo indicamos a traves de un listener: 
        php artisan make:listener BroadcastUserLoginNotification
        php artisan make:listener BroadcastUserLogoutNotification

    - Añadimos los listener creados a , tambien importamos todas las clasess:
        app/Providers/EventServiceProvider.php

## 6. Mostrando la notificacion

    - Añadimos esto en resources/js/app.js:
    window.Echo.channel('notifications')
    .listen('UserSessionChanged', (e) => {
        const notificationElement = document.getElementById('notification');

        notificationElement.innerText = e.message;

        notificationElement.classList.remove('invisible');
        notificationElement.classList.remove('alert-success');
        notificationElement.classList.remove('alert-danger');

        notificationElement.classList.add('alert-'+e.type);

    });

    npm run dev

    -- Si deseamos un canal privado , solo para usuarios autenticados 
    debemos cambiar en el listener:
    broadcastOn() ... PrivateChannel

    --tambien en : routes/channels.php , crear el canal
    Broadcast::channel('notifications', function ($user) {
        return $user != null;
    });

    --luego modificar en : resources/js/app.js
    window.Echo.private('notifications') { ... }

    npm run dev 

## API : 

    - Controlador de recurso:
    -- Api/UserController : Archivo
    -- -r : Indica que es un recurso
    -- -m : Indicar el modelo
    php artisan make:controller Api/UserController -r -m User


    - Crear los eventos UserCreated, UserUpdated, UserDeleted: estos enviaran los datos(generado en el constructor) a traves del chanel publico
    - Para disparar los eventos relaciona a X modelo, definir esta variable en el modelo
    protected $dispatchesEvents = [
        'created' => UserCreated::class,
        'updated' => UserUpdated::class,
        'deleted' => UserDeleted::class
    ];
