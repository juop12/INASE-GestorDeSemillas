# Bitácora

Voy a escribir lo que fui haciendo paso por paso para que quede un registro de como fue evolucionando el proyecto.

Me hubiera gustado comunicarme más con el cliente ya que creo que es importante trabajar a la par. Pero esta semana tuve muy poco tiempo para trabajar en este desarrollo, asi que decidí priorizar la implementación de una aplicación funcional que tenga las features pedidas.

Trabajé desde Windows usando XAMPP y Composer.
Algunas consideraciones acerca del ambiente de trabajo para un desarrollo comodo:

- Descargar extensiones de VSCode de php: "Cakephp goto view" y bundle de DEVSENSE.

- Luego de descargar XAMPP en "C:\xampp" asegurarse de poner el path de php y mysql en los paths de windows. Para eso ir a "Propiedades" de "Mi PC" -> "Configuración Avanzada del Sistema" -> "Variables de Entorno" -> Agregar las siguientes direcciones al path de usuario o sistema: "C:xampp\php" y "C:xampp\mysql\bin" -> Ok a todas las pestañas. El path del composer se agrega solo cuando se descarga el composer usando el .exe oficial de su pagina web. 

- Luego de tener los paths configurados, desde la powershell se puede ejecutar el composer correctamente y comandos para mysql. Para acceder a la shell de mysql, se utiliza la siguiente linea, ya que por defecto se tiene que entrar con ese usuario:

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

Viernes 24/10:
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

Sabado 25/10:
    - Viendo que Github sacó una nueva feature donde copilot puede crearte paso a paso un repositorio con una aplicación practicamente andando. Le pedi a copilot que implementara la aplicación de la consigna para ver el resultado y así poder darme una mejor idea de lo que tenía que implementar. Analicé los resultados, tanto código, como proceso de creación y ya me sentía más preparado de empezar a impementar. Sin embargo, no tuve tiempo de probar si el Pull Request de Copilot andaba o no.
    Prompt: 
        CakePHP 5.x + MySQL seed sample management system. Module 1: Samples with numero_precinto, empresa, especie, cantidad_semillas, auto-generated codigo_muestra. List view with detail/edit. Module 2: Results per sample - poder_germinativo %, pureza %, materiales_inertes (optional text). Module 3: Summary report filterable by especie/date range. Include README with setup/run instructions and SQL script for sample database.

Lunes 27/10: 
    - Empecé a jugar con la estructura base que provee el composer de php para entender un poco más el framework, lo corrí, lo conecté a la base de datos pero no desarrollé ninguna feature.Para conectar la Base De Datos hay que configurar:
        - Un archivo .sql para crear la DB con sus tablas. O un .template.sql que puedas usar para crear un .sql con el .env y un script.
        - Un .env con la información de la DB para poder conectar la aplicación a la DB corriendo local con XAMPP.

Martes 28/10:
    - Creé un nuevo proyecto desde 0 con composer.
    - Agregué la configuración de la Base de Datos al .env.
    - Creo un archivo .template.sql usado por un script para crear el .sql con los valores del .env y crear la Base de Datos. Dejo un script para bash (también git bash o wsl) y otro para windows powershell.
    