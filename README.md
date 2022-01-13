
## Sobre el Sistema

Este sistema esta diseñado para poder funcionar como un sistema de ordenes locales para usuario con tablet y moviles

## Usuarios Master
* usuario adminrestaurante@restaurante-local.com
* clave ResT@uranteLocal

## Como instalar
* Debes descargar el codigo luego instalar las dependencias
* verifica que no este package-lock.json
* verifica que no este composer.lock
* si los lock se encuentran borrarlos
* crear una base de datos llamada restaurante_local
* cambiar el nombre de .env.example a .env
## Realizar estos Comando:
* npm install
* npm dev
* composer install
* php artisan migrate:refresh --seed
* php artisan serve

### Agregados Buscador y Tambien el dashboard

### OJO
Debes colocar en la base de datos manualmente un campo observaciones en ordenes esto solo si ya hiciste la carga de data