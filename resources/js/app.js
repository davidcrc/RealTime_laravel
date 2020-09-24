const { default: Echo } = require('laravel-echo');

require('./bootstrap');

// Esto mostrara o modificara la interfaz
window.Echo.channel('notifications')
    .listen('UserSessionChanged', (e) => {
        const notificationElement = document.getElementById('notification');

        notificationElement.innerText = e.message;

        notificationElement.classList.remove('invisible');
        notificationElement.classList.remove('alert-success');
        notificationElement.classList.remove('alert-danger');

        notificationElement.classList.add('alert-'+e.type);

    });