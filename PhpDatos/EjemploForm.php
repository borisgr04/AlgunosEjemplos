<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.8/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.8/js/dataTables.bootstrap.min.js"></script>
        <?php
        include 'Conectar.php';
        //listar variables POST
        
        //Imprimir Listado de 
        //foreach($_POST as $campo => $valor)  
        //echo "$campo -> $valor <br>";  
        //
        
        //
        //Si todos estan inicializados
        if (isset($_POST['txtId']) && isset($_POST['txtNom']) && isset($_POST['txtApe']) )    
        {    
            $consulta=$db->prepare("insert into usuarios(id,nombre,apellidos) 
                                            values (:id,:nombre,:apellidos)");
            $estado=$consulta->execute(
                    array(
                        ':id'=> $_POST['txtId'],
                        ':nombre'=> $_POST['txtNom'],
                        ':apellidos'=> $_POST['txtApe']
                        )
                    );
            if ($estado)
                echo json_encode(array('estado'=>true,'mensaje'=>'Datos insertados correctamente.'));
            else
                echo json_encode(array('estado'=>false,'mensaje'=>"Error al insertar datos en la tabla."));
            }
        
        
        ?>
    </head>
    <body>
        <div class="container">
            <h2>Ejemplo Jquery - AJAX </h2>
            <a href="http://www.codeproject.com/Articles/424461/Implementing-Consuming-ASP-NET-WEB-API-from-JQuery">
                EjemploWebAPI .Net
            </a>
            <table id="table_id" class="table table-condensed table-striped table-hover">
                <thead><tr><th>
                            Id
                        </th>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Apellidos
                        </th>
                        <th>
                            Acciòn
                        </th>
                    </tr>
                </thead>
                <tbody id="bodyTable">
                    <?php
                    $consulta = $db->prepare("select * from usuarios");
                    $consulta->execute();
                    while ($user = $consulta->fetchObject()) {

                        echo "<tr><td>" .
                        $user->id .
                        "</td><td> " .
                        $user->nombre .
                        "</td><td>" .
                        $user->apellidos
                        . "</td>\n\<td></td></tr>";
                    }
                    ?>
                </tbody>
                <tfoot>
                <form method="POST" >
                    <tr>
                        <td>
                            <input type="text" name="txtId" id="txtId" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="txtNom" id="txtNom" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="txtApe" id="txtApe" class="form-control">
                        </td>
                        <td>
                            <button type="submit"  id="BtnAdd" class="btn btn-default">Add</button>
                        </td>
                    </tr>
                </form>
                </tfoot>
            </table>

        </div>
    </body>
</html>