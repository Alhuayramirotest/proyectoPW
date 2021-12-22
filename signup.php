<?php //signup.php
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db);
    if ($conexion->connect_error) die ("Fatal error");

    if(isset($_POST['Username']) && isset($_POST['Password']))
    {
        $dni = mysql_entities_fix_string($conexion, $_POST['dni']);
        $nombre = mysql_entities_fix_string($conexion, $_POST['Nombre']);
        $apellidos = mysql_entities_fix_string($conexion, $_POST['Apellidos']);
        $username = mysql_entities_fix_string($conexion, $_POST['Username']);
        $pw_temp = mysql_entities_fix_string($conexion, $_POST['Password']);

        $password = password_hash($pw_temp, PASSWORD_DEFAULT);

        $query = "INSERT INTO Usuarios 
            VALUES('$dni','$nombre','$apellidos','$username', '$password')";

        $result = $conexion->query($query);
        if (!$result) die ("Falló registro");

        echo "Registro exitoso <a href='index.php'>Ingresar</a>";
        
    }
    else
    {
        echo <<<_END
        <center>
        <h1>Regístrate</h1>
        <form action="signup.php" method="post"><pre>
                dni <input type="text" name="dni" maxlength="8" required>
             Nombre <input type="text" name="Nombre" required>
          Apellidos <input type="text" name="Apellidos" required>
            Usuario <input type="text" name="Username" required>
           Password <input type="password" name="Password" required>
                    <input type="hidden" name="reg" value="yes">
                    <input type="submit" value="REGISTRAR">
        </form>
        </center>
        
        _END;
    }
    function mysql_entities_fix_string($conexion, $string)
    {
        return htmlentities(mysql_fix_string($conexion, $string));
      }
    function mysql_fix_string($conexion, $string)
    {
        //if (get_magic_quotes_gpc()) $string = stripslashes($string);
        return $conexion->real_escape_string($string);
      }   
?>