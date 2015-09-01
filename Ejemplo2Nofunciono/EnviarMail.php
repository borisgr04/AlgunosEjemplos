<html> 
    <head> 
        <title>Ejemplo de PHP</title> 
    </head> 
    <body> 
        <H1>Ejemplo de envio de email</H1> 
        Introduzca su direccion de email: 
        <FORM ACTION="email.php" METHOD="GET"> 
            <INPUT TYPE="text" NAME="direccion"><BR><BR> 
            Formato: <BR> 
            <INPUT TYPE="radio" NAME="tipo" VALUE="plano" CHECKED> Texto plano<BR> 
            <INPUT TYPE="radio" NAME="tipo" VALUE="html"> HTML<BR><BR> 
            <INPUT TYPE="submit" VALUE="Enviar"> 
        </FORM> 
    </body> 
</html>