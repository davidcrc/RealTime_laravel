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

## 4. Laravel echo : Echo expone una API expresiva para suscribirse a canales y escuchar eventos que son transmitidos por Laravel. La transmisión de eco y eventos permite a su equipo crear fácilmente aplicaciones web sólidas en tiempo real.

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

## Game:

    - Ya se creo la interfaz de juego en views/game/show.blade.php

    - Crear los eventos : RemainingTimeChanged.php, WinnerNumberGenerated.php con sus variables

    - Crear un COMANDO (app/Console/Commands/GameExecuter.php): deje ejecutarse para que se envien el contador y demas usando pusher
        php artisan make:command GameExecuter


## Sala de chat:

    - Controlador: ChatController.php


## Sala de chat (global):

    - Controlador: ChatController.php
    - Canal: De presencia, utiliza mostrar a los usuario con sesion y en una vista en especifico
        Este se crea en routes/channels.php


    - Evento para el envio de mensajes: Events/MessageSend.php

    - Crear la ruta que tomara los mensajes : routes/web.php : /chat/message

    - Añadir en el controlador (MessageSend.php ) la funcion messageReceived(), que devolvera los mensajes a los demas usuarios conectados

    - Laravel Echo: La funcion listen() escuchara el evento y nos mostrara los mensajes enviados


## Sala de chat (private): Parecido a un toque

    - Creamos la ruta : /chat/greet/{user}
    - Añadimos a Controlador (ChatController.php): ChatController(request tiene el usuario origen(en session), id del usuario destino)

    - Evento (GreetingSend.php): Enviara por un canal privado y dirigido solo al usuario destino
    - Canal ('chat.greet.{receiver}'): Asegurara que solo el destinatario pueda ver el mensaje
    - Mod (ChatController): ChatController : para hacer el broadcast de (origen y destino)


## Utilizando ServWebSocket propio:

    - En .env (comentar o reeplazar):
        PUSHER_APP_ID=111
        PUSHER_APP_KEY=public-key-124555
        PUSHER_APP_SECRET=secret-key-12345
        PUSHER_APP_CLUSTER=

        MI_PUSHER_APP_HOST=127.0.0.1
        MI_PUSHER_APP_PORT=6001

        ...

        MIX_PUSHER_APP_HOST="${MI_PUSHER_APP_HOST}"
        MIX_PUSHER_APP_PORT="${MI_PUSHER_APP_PORT}"

    - En config/broadcasting.php modificar (comentar las demas dlineas de pusher en el .env):
        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'host' => env('MI_PUSHER_APP_HOST'),           // agregar
                'port' => env('MI_PUSHER_APP_PORT'),           // agregar
                'useTLS' => true,
            ],
        ],

    - En resources/js/bootstrap.js modificar:
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: process.env.MIX_PUSHER_APP_KEY,
            cluster: process.env.MIX_PUSHER_APP_CLUSTER,
            wsHost: process.env.MIX_PUSHER_APP_HOST,
            wsPort: process.env.MIX_PUSHER_APP_PORT,
            encrypted: false,
            disableStats: true,
            forceTLS: false
        });

    npm run dev

## Conectar a produccion:

    - Modificar en el .env
        MI_PUSHER_APP_HOST=midominio.com
        MI_PUSHER_APP_PORT=80

    - En bootstrap.js: Verificar si necesitamos encryptar o el TLS ...
        encrypted: True false,
        disableStats: Truw false,
        forceTLS: True false