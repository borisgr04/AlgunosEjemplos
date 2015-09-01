<?php 
    // http://php.net/manual/es/features.http-auth.php
    if (!isset($PHP_AUTH_USER)) { 
      header('WWW-Authenticate: Basic realm="Acceso restringido"'); 
      header('HTTP/1.0 401 Unauthorized'); 
      echo 'Authorization Required.'; 
      exit; 
   } 
    
   $fich = file("passwords.txt"); 
   $i=0; $validado=false; 
   while ($fich[$i] && !$validado) { 
      $campo = explode("|",$fich[$i]); 
      if (($PHP_AUTH_USER==$campo[0]) && ($PHP_AUTH_PW==chop($campo[1]))) $validado=true; 
      $i++; 
   } 

   if (!$validado) { 
      header('WWW-Authenticate: Basic realm="Acceso restringido"'); 
      header('HTTP/1.0 401 Unauthorized'); 
      echo 'Authorization Required.'; 
      exit; 
   } 
?> 
<html> 
<head> 
   <title>Ejemplo de PHP</title> 
</head> 
<body> 
Ha conseguido el acceso a la <B>zona restringida</B> con el usuario <?php echo $PHP_AUTH_USER?>. 
</body> 
</html>