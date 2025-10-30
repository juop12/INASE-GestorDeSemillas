# Bitácora

Voy a escribir lo que fui haciendo paso por paso para que quede un registro de como fue evolucionando el proyecto.

Me hubiera gustado comunicarme más con el cliente ya que creo que es importante trabajar a la par. Pero esta semana tuve muy poco tiempo para trabajar en este desarrollo, asi que decidí priorizar la implementación de una aplicación funcional que tenga las features pedidas sin llevar a cabo las mejores practicas del desarrollo de software.

Trabajé desde Windows usando XAMPP y Composer. En caso de trabajar en Linux, no hace falta descargar XAXMPP, pero si hay que tener descargado php y MySQL.

Algunas consideraciones acerca del ambiente de trabajo para un desarrollo comodo:

- Descargar extensiones de VSCode de php: "Cakephp goto view" y bundle de DEVSENSE de php.

- Luego de descargar XAMPP (https://www.apachefriends.org/es/download.html) en "C:\xampp" asegurarse de poner el path de php y mysql en los paths de windows. Para eso ir a "Propiedades" de "Mi PC" -> "Configuración Avanzada del Sistema" -> "Variables de Entorno" -> Agregar las siguientes direcciones al path de usuario o sistema: "C:xampp\php" y "C:xampp\mysql\bin" -> Ok a todas las pestañas. El path del composer se agrega solo cuando se descarga el composer usando el .exe oficial de su pagina web. 

- Luego de tener los paths configurados, desde la powershell se puede ejecutar el composer (para crear el skeleton del proyecto) correctamente y comandos para mysql. Para acceder a la shell de mysql, se utiliza la siguiente linea, ya que por defecto se tiene que entrar con ese usuario:

    `mysql -u root`

- Agregar contraseña al root y resto de users:

```SQL
    ALTER USER 'root'@'localhost' IDENTIFIED BY 'NEW_STRONG_PASSWORD_ROOT';
    ALTER USER 'root'@'127.0.0.1' IDENTIFIED BY 'NEW_STRONG_PASSWORD_ROOT';
    ALTER USER 'root'@'::1' IDENTIFIED BY 'NEW_STRONG_PASSWORD_ROOT';

    FLUSH PRIVILEGES;
```

- Cambiar la configuración del phpmyadmin config.inc.php en C:\xampp\phpmyadmin. Cambiar auth_type a cookie y password a la nueva password del root:
```Python
    $cfg['Servers'][$i]['auth_type'] = 'cookie';
    $cfg['Servers'][$i]['password'] = 'NEW_STRONG_PASSWORD_ROOT';
```

## Viernes 24/10:

- Empecé haciendo un relevamiento de las features. Dejé algunas preguntas para mandar, pero luego no tuve tiempo de mandarlas.

- Busque información acerca de CakePHP y me topé con la documentación oficial y varios videos explicando como desarrollar en este framework.

    - Tutorial oficial CakePHP: https://www.youtube.com/watch?v=RLdsCL4RDf8&list=PLsrmQF03GOwDfekGkrVuc4XF_RY7V6o5G&index=1
    - Como descargar CakePHP Window (XAMPP + Composer + Proyecto de CakePHP): https://www.youtube.com/watch?v=fzZr3WgQfGY
    - Deploy de aplicacion CakePHP CPanel: https://www.youtube.com/watch?v=elHvBWu75v0
    - Crear proyecto CakePHP desde 0: https://www.youtube.com/watch?v=d7ij0587LPE&list=PLF3hHlOVmQLR_YJyaaBNKWzZcZHHox0dh&index=1
    - Documentación CakePHP 5.x: https://book.cakephp.org/5/en/intro.html
    - Documentación Tutorial CMS: https://book.cakephp.org/5/en/tutorials-and-examples/cms/database.html
    - Como poner clave a mysql: https://www.youtube.com/watch?v=LltCLFxQ2Yk&t=146s
    - También busqué como dockerizarlo, pero no me dio el tiempo para implementar una infra que corra con docker.

## Sabado 25/10:

- Viendo que Github sacó una nueva feature donde copilot puede crearte paso a paso un repositorio con una aplicación practicamente andando. Le pedi a copilot que implementara la aplicación de la consigna para ver el resultado y así poder darme una mejor idea de lo que tenía que implementar. Analicé los resultados, tanto código, como proceso de creación y ya me sentía más preparado de empezar a impementar. Sin embargo, no tuve tiempo de probar si el Pull Request de Copilot andaba o no.

Prompt: 

    CakePHP 5.x + MySQL seed sample management system. Module 1: Samples with numero_precinto, empresa, especie, cantidad_semillas, auto-generated codigo_muestra. List view with detail/edit. Module 2: Results per sample - poder_germinativo %, pureza %, materiales_inertes (optional text). Module 3: Summary report filterable by especie/date range. Include README with setup/run instructions and SQL script for sample database.

## Lunes 27/10: 

- Empecé a jugar con la estructura base que provee el composer de php para entender un poco más el framework, lo corrí, lo conecté a la base de datos pero no desarrollé ninguna feature. Para conectar la Base De Datos hay que configurar:

    - Un archivo .sql para crear la DB con sus tablas. O un .template.sql que puedas usar para crear un .sql con el .env y un script.
    - Un .env con la información de la DB para poder conectar la aplicación a la DB corriendo local con XAMPP.

## Martes 28/10:

- Creé un nuevo proyecto desde 0 con composer.

- Agregué la configuración de la Base de Datos al .env.

- Creo un archivo .template.sql usado por un script para crear el .sql con los valores del .env y crear la Base de Datos. Dejo un script para bash (también git bash o wsl) y otro para windows powershell.

- Descomento las lineas del dotenv en el config/bootstrap.php para poder usar esos valores como constantes en mi código.

- Ya es una aplicacion PhP con MySQL funcionando correctamente.

- Actualizo las dependencias y lo subo a Github

- Hago bin/cake bake all Muestras

- Hago bin/cake bake model all

- Agregué el todo Muestras con bake All

- Agregué el modelo y el controller de Resultados con bake controller y bake model

## Miercoles 29/10:

- Cambie el layout default para que tenga el front que me parecio mas intuitivo. Tiene un search bar, una lista de muestras, un boton para agregar nuevas muestras y un boton de reporte.

- Agregué una accion reporte al MuestrasController para imprimir por pantalla la tabla con la información pedida. También, cree el template reporte asociado.

- Hice cambios en MuestrasTable y ResultadosTable para que tengan las relaciones correctas hasOne y belongsTo.

- Agregué el form para crear los resultados del analisis de una muestra en el template de edit de una muestra. Estos datos se actualizan correctamente  asociados a la muestra editada en la tabla resultados en la base de datos.  

## Jueves 30/10:

- Hice cambios en los controllers para que redirigen a las paginas correctas con la data correspondiente para poder hacerle display. De esta forma evite errores de redireccion a views inexistentes y pude poner la data existente tanto en el template de edit de Muestras (para la data de muestras y resultados) como en la tabla de reporte.

- Agrego archivo config/schema/seed_data.sql para llenar la base de datos con ejemplos 

- Agregue un "efecto" sobre la lista de muestras con la searchbar.

- Actualizo el README con las features desarrolladas.


### Preguntas:
    
- Seria necesario usar UUID para codigo unico o puedo mi propio formato de codigo unico?

- Una vez creada la muestra, se pueden editar los datos de origen?

- Con respecto a los filtros. Actualmente, se pide filtrar por rango de fechas, sin embargo, no se indica que debe haber una fecha en la tabla. Esa fecha puede ser la fecha de creacion del registro o debe ser un campo extra donde los usuarios ponen una fecha relacionada a la muestra?
