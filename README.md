# Test Gila software

Sistema de gestion y envio de notificaciones a usuarios.

## Cosas a consciderar

El proyecto esta bajo la ultima versión de Laravel (11.0), entonces, mientras iba realizando la prueba me tope con cosas que no estan funcionando del todo y tocó "ajustarse" a lo que si funcionaba en ese momento.

- Existen comentarios en español que menciona detalles a investigar, junto con el código comentado que no funciona correctamente
- Se usaron casos de prueba muy básicos, pido disculpas por ello.
- En caso de querer agregar un usuario, podras hacerlo via Tinker o desde la vista de "Register"
- Los datos por default son "test@example.com" - password

## Instalación y ejecución

- Ejecutar el comando "composer install" para descargar dependencias de Laravel.
- Ejecutar el comando "npm install" para descargar dependencias de Inertia.
- Crear y llenar el archivo de entorno con una bd vacia.
- Ejecutar comando "php artisan migrate" para correr migraciones.
- Ejecutar comando "php artisan db:seed" para correr seeders.
- Ejecutar comando "npm run build" para compilar vistas del proyecto.
- Abrir una terminal con el fin de ejecutar "php artisan serve"
