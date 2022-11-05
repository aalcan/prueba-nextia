<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Prueba nextia

Para correr el repositorio se deben seguir los siguientes pasos

- Instalar las dependencias con composer intall
- Ingresar los valores de entorno al archivo .env
- Ejecutar las migraciones con: php artisan migrate
- Ejecutar el script para insertar datos por default: php artisan db:seed
- Levantar el servidor: php artisan serve

El servidor estará disponible a través de la url http://localhost:8000/api.

## Notas
En endpoint /bienes/list la lista de id's va en los query params, ej:
http://localhost:8000/api/bienes/list?id=1,41594

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).