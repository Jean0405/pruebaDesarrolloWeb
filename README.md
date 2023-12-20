# PRUEBA DESARROLLO WEB

## Prueba backend con Laravel

## TECNÓLOGIAS APLICADAS

-   Laravel framework 10.37.3
-   PHP PHP 8.1.10
-   Composer 2.4.1
-   MySQL / PhpMyAdmin

## HERRAMIENTAS IMPLEMENTADAS

-   **Laragon**: Este programa nos permite iniciar un servidor y tener incluidas las herramientas como **PHP**, **COMPOSER** y **MYSQL**.
-   **Postman**: Herramienta que nos permitira probar los endpoints y además podrás visualizar su documentación.

> [!IMPORTANT]
> Recuerda que debes tener instalado PHP, COMPOSER Y MYSQL -> **_Podrías también obtenerlas usando XAMPP_**

## USO DE LOS ENDPOINTS

[Documentación de POSTMAN](https://documenter.getpostman.com/view/29019205/2s9Ykq6foD)

## INSTALACIÓN

1. Clona este repositorio

```bash
gir clone https://github.com/Jean0405/pruebaDesarrolloWeb.git
```

2. Instalar dependencias

```bash
composer install
```

3. Configurar variables de entorno

-   Al archivo **.env.example** debes borrarle el _.example_.

4. Configura tus variables de la base de datos.

-   Busca la configuración para **MySQL**, se verá algo asi:

```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=tu_username_aqui
DB_PASSWORD=tu_password_aqui
```

> [!WARNING]
> Allí debes unicamente asignar tu nombre de usuario y contraseña, procura dejar el resto justo como está.

5. Realiza las migraciones, en la terminal ejecuta

```bash
php artisan migrate
```

6. Finalmente ejecuta el programa encenciendo el servidor, para ello en la terminal

```bash
php artisan serve
```

> [!NOTE]
> Puedes implementar este proyecto este proyecto en conjunto con el [proyecto Frontend](https://github.com/Jean0405/pruebaDesarrolloWebFront)
