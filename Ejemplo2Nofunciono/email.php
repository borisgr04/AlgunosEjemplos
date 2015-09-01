<html> 
<head> 
   <title>Ejemplo de PHP</title> 
</head> 
<body> 
<H1>Ejemplo de envio de email</H1> 
<?php 
   $direccion=$_GET['direccion']; 
   $tipo=$_GET['tip']; 
    
   if ($direccion!=""){ 
   if ($tipo=="plano"){ 
      // Envio en formato texto plano 
       
      mail($direccion,"Ejemplo de envio de email","Ejemplo de envio de email de texto plano\n\nTutorialPHP.\nhttp://www.tutorialphp.net/\n Manuales para desarrolladores web.\n","FROM: Pruebas <webmaster@hotmail.com>\n"); 
   } else { 
      // Envio en formato HTML 
      mail($direccion,"Ejemplo de envio de email","<html><head><title>TutorialPHP. Manual de PHP</title></head><body>Ejemplo de envio de email de HTML<br><br>TutorialPHP.<br>http://www.tutorialphp.net/<br> <u>Manuales</u> para <b>desarrolladores</b> web.</body></html>","Content-type: text/html\n", "FROM: Pruebas <webmaster@hotmail.com>\n"); 
   }       
echo "Se ha enviado un email a la direccion: ",$direccion," en formato <b>",$tipo,"</b>."; 
} 
?> 
<br> 
</FORM> 
</body> 
</html> 