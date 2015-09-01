<?php
define('BD_SERVIDOR', 'localhost');
define('BD_NOMBRE', 'soporte_usuarios');
define('BD_USUARIO', 'root');
define('BD_PASSWORD', '');
// Hacemos la conexión a la base de datos con PDO.
// Para activar las collations en UTF8 podemos hacerlo al crear la conexión por PDO
// o bien una vez hecha la conexión con
// $db->exec("set names utf8");
$db = new PDO('mysql:host=' . BD_SERVIDOR . ';dbname=' . BD_NOMBRE . ';charset=utf8', BD_USUARIO, BD_PASSWORD);
