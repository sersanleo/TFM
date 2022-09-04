# Comparativa de frameworks fullstack
En este repositorio se encuentra una misma aplicación web (PetClinic) desarrollada con los siguiente sujetos a comparación:

- Django 4.0.3
- Laravel 9.8.1
- Spring 2.7.1

## Prerequisitos
Todas las apliacaciones han sido desarrolladas y probadas en Windows.
### Django
Para correr el servidor es necesario tener instalada la versión de Python 3.8 como mínimo (se ha comprobado que funciona al menos con la versión 3.9). Después, ejecutar el comando `pip install -r requirements.txt` para instalar todos los paquetes necesarios.
### Laravel
...
### Spring
...

## Bases de datos
Por defecto, las aplicaciones están configurados para conectarse a un servidor MySQL en el puerto 3306 de localhost, utilizando un usuario `root` sin contraseña y una base de datos con el siguiente nombre:
- Django: tfm_django
- Laravel: tfm_laravel
- Spring: tfm_spring

En la carpeta raíz del repositorio se encuentran tres archivos `.sql`, cada uno con el código SQL necesario para generar la estructura de las bases de datos con los datos de prueba utilizados durante el desarrollo.

Las credenciales de los usuarios ya creados son:
- vet1@petclinic.com: vet1 *(Veterinario)*
- customer1@petclinic.com: customer1 *(Cliente)*
- customer2@petclinic.com: customer2 *(Cliente)*

## Correr las aplicaciones
En windows, para correr las aplicaciones en paralelo, basta con ejecutar el archivo `start.bat`. La dirección para acceder a cada servidor es:
- Django: http://localhost:8000
- Laravel: http://localhost:8001
- Spring: http://localhost:8002

## API
Las colecciones de Postman listas para ser utilizadas están disponibles en la carpeta raíz del respositorio.
Para utilizar la API de Laravel, los token de autenticación son los siguientes:
- Laravel:
  - vet1: BcdQ1kIZ7U7leSO5nui7qEjG2Cf8cqUSrSfbqjIF
  - customer1: xgU7wYIuvW12GU3zBqB8T6tPUksXHy6HwG9z3elY
  - customer2: fzFCKME7sxVcpNn5jMrmqzV66lX18l6kYuEdePZD

En el caso de Spring, simplemente hay que indicar el correo eléctronico y la contraseña del usuario que se vaya a utilizar.

## Tests
En windows, para correr los tests de cada framework en paralelo, basta con ejecutar el archivo `test.bat`.