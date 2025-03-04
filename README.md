# Pasos para ejecutar el proyecto

## Paso 1
    - Abre el editor de código y asegurate de tener PHP instalado con el comando "php -v". También puedes instalar XAMPP que incluye Apache, MySQL, PHP y más.

## Paso 2
    - En caso de no tener instalado Composer (gestor de dependencias php). Puedes descargarlo en su sitio oficial. "https://getcomposer.org/"

## Paso 3
    -Instalar una Base de Datos, ya sea MySQL, Postgres, etc, y crear una base de datos la cual usarás en tu proyecto.

## Paso 4
    - Instalar Node.js y NPM (Opcional). Si ya tienes instalado Node.js, verifica su versión con el comando "node -v" y "npm -v" para la versión de npm.

## Paso 5
    - Asegurate de tener instalado "Git" para clonar el proyecto con el comando "git clone https://github.com/ErickAlejo/internal-frontend", o bien puedes descargarlo.

## Paso 6
    - Instalar las dependencias de Laravel con el comando "composer install".

## Paso 7
    - Configura el archivo ".env" para modificar los parametros de la conexión a la base de datos en los campos "DB_CONNECTION=", "DB_HOST=", "DB_PORT=", "DB_DATABASE=",  "DB_USERNAME=", "DB_PASSWORD=".

## Paso 8
    - Generar la clave de aplicación de Laravel para funcionar correctamente. Ejecuta el comando "php artisan ey:generate" para generarla.

## Paso 9
    - En caso de tener instalado XAMPP, dirigete a la ruta "c:\xampp\php\php.ini" y asegurate de quitarle el ";" a las siguientes extensiones "extension=pdo_pgsql" y "extension=pgsql", y guarda los cambios.

## Paso 10
    - Ejecuta el comando de migración "php artisan migrate" para crear las tablas en la base de datos. 

## Paso 11
    - Compila los activos del frontend (opcional) en caso que el proyecto use Laravel Mix para compilar recursos (CSS, JS), ejecuta "npm install" y "npm run dev"

## Paso 12
    - Inicia el servidor de desarrollo con el comando "php artisan serve".