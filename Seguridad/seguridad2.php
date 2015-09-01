<?php
   if (($_SERVER['PHP_AUTH_USER']!="boris") || ($_SERVER['PHP_AUTH_PW']!="123")) { 
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
Ha conseguido el acceso a la <B>zona restringida</B>. 
</body> 
</html>