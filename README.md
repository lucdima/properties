Properties!

Un software web libre para la administración de propiedades de inmobiliarias y agentes de bienes raices.

Properties se encuentra bajo la licencia GNU/GPL v3.

Instrucciones de instalación
Requerimientos
- Servidor web Apache preferentemente basado en Linux.
- Servidor de base de datos MySQL.

Instrucciones
- Instale los archivos en su servidor web via FTP o via SSH. O directamente utilizando el comando git clone desde el repositorio de gitub

- Cambie el nombre del archivo config-sample.php a config.php
- Cree una base de datos en su servidor MySQL
- Cree un usuari y una contraseña para la base de datos recién creada.
- Coloque las claves correspondientes a su servidor de base de datos en el archivo config.php
- Para la creación de tablas debe ejecutar la script properties.sql en su servidor de base de datos. Esto generará las tablas con algunos datos de ejemplo para que le sea más sencillo operar el programa.
- Para visualizar, desde el servidor coloque la URL del servidor donde subió los archivos

Administración
- Para administración, la URL es la misma, con el agregado /login.php
- Coloque el usuario y contraseña especificado en el archivo config.php en la sección adnim

Listo!

Ejemplo funcionando en http://www.developia.com.ar/properties