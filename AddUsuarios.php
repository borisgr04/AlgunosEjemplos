<?php
        //listar variables POST
        echo "VAriables ";
        foreach($_POST as $campo => $valor)  
        echo "$campo -> $valor <br>";  
        
        if (isset($_POST['txtId']))    
        {    
            // Instructions if $_POST['value'] exist    
            echo $_POST['txtId'];
        }
        ?>

