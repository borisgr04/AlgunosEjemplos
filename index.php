<?php
// Activamos las sesiones para el funcionamiento de flash['']
@session_start();
 
require 'Slim/Slim.php';
// El framework Slim tiene definido un namespace llamado Slim
// Por eso aparece \Slim\ antes del nombre de la clase.
\Slim\Slim::registerAutoloader();

// Creamos la aplicación.
$app = new \Slim\Slim();

// Indicamos el tipo de contenido y condificación que devolvemos desde el framework Slim.
#$app->contentType('text/html; charset=utf-8');

// Definimos conexion de la base de datos.
// Lo haremos utilizando PDO con el driver mysql.
define('BD_SERVIDOR', 'localhost');
define('BD_NOMBRE', 'soporte_usuarios');
define('BD_USUARIO', 'root');
define('BD_PASSWORD', '');
 
// Hacemos la conexión a la base de datos con PDO.
// Para activar las collations en UTF8 podemos hacerlo al crear la conexión por PDO
// o bien una vez hecha la conexión con
// $db->exec("set names utf8");
$db = new PDO('mysql:host=' . BD_SERVIDOR . ';dbname=' . BD_NOMBRE . ';charset=utf8', BD_USUARIO, BD_PASSWORD);
//$db->exec("set names utf8");

$app->get('/', function() {
            echo "Pagina de gestión API REST de mi aplicación.";
        });

        // Cuando accedamos por get a la ruta /usuarios ejecutará lo siguiente:
$app->get('/usuarios', function() use($db) {
            // Si necesitamos acceder a alguna variable global en el framework
            // Tenemos que pasarla con use() en la cabecera de la función. Ejemplo: use($db)
            // Va a devolver un objeto JSON con los datos de usuarios.
            // Preparamos la consulta a la tabla.
            $consulta = $db->prepare("select * from usuarios");
            $consulta->execute();
            // Almacenamos los resultados en un array asociativo.
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // Devolvemos ese array asociativo como un string JSON.
            echo json_encode($resultados);
});

// Accedemos por get a /usuarios/ pasando un id de usuario. 
// Por ejemplo /usuarios/veiga
// Ruta /usuarios/id
// Los parámetros en la url se definen con :parametro
// El valor del parámetro :idusuario se pasará a la función de callback como argumento
$app->get('/usuarios/:idusuario', function($usuarioID) use($db) {
            // Va a devolver un objeto JSON con los datos de usuarios.
            // Preparamos la consulta a la tabla.
            // En PDO los parámetros para las consultas se pasan con :nombreparametro (casualmente 
			// coincide con el método usado por Slim).
			// No confundir con el parámetro :idusuario que si queremos usarlo tendríamos 
			// que hacerlo con la variable $usuarioID
            $consulta = $db->prepare("select * from usuarios where id=:param1");
 
            // En el execute es dónde asociamos el :param1 con el valor que le toque.
            $consulta->execute(array(':param1' => $usuarioID));
 
            // Almacenamos los resultados en un array asociativo.
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
 
            // Devolvemos ese array asociativo como un string JSON.
            echo json_encode($resultados);
        });

// Alta de usuarios en la API REST
$app->post('/usuarios',function() use($db,$app) {
    // Para acceder a los datos recibidos del formulario
    /*
    $r = \Slim\Slim::getInstance()->request(); //pedimos a Slim que nos mande el request
    $p = json_decode($r->getBody()); //como el request esta en json lo decodificamos

    
    echo json_encode("$p->id - $p->nombre - $p->apellidos - $p->telefono");
    */
    $p = json_decode($app->request->getBody());
    // Los datos serán accesibles de esta forma:
    
    // Preparamos la consulta de insert.
    $consulta=$db->prepare("insert into usuarios(id,nombre,apellidos,telefono) 
					values (:id,:nombre,:apellidos,:telefono)");
 
    $estado=$consulta->execute(
            array(
                ':id'=> $p->id,
                ':nombre'=> $p->nombre,
                ':apellidos'=> $p->apellidos,
                ':telefono'=> $p->telefono
                )
            );
    if ($estado)
        echo json_encode(array('estado'=>true,'mensaje'=>'Datos insertados correctamente.'));
    else
        echo json_encode(array('estado'=>false,'mensaje'=>"Error al insertar datos en la tabla."));
});

$app->run();        
?>
