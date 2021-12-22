<?php 
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db);
    if($conexion->connect_error) die("Error fatal");

    session_start();
    if(isset($_SESSION['dni'])){
      header('location: panel.php');
    }

    if (isset($_POST['Username'])&&
        isset($_POST['Password']))
    {
        $un_temp = mysql_entities_fix_string($conexion, $_POST['Username']);
        $pw_temp = mysql_entities_fix_string($conexion, $_POST['Password']);
        $query   = "SELECT * FROM Usuarios WHERE Username='$un_temp'";
        $result  = $conexion->query($query);
        
        if (!$result) die ("Usuario no encontrado");
        elseif ($result->num_rows)
        {
            $row = $result->fetch_array(MYSQLI_NUM);
            $result->close();

            if (password_verify($pw_temp, $row[4])) 
            {
                session_start();
                $_SESSION['dni']=$row[0]; 
                $_SESSION['nombre']=$row[1];
                $_SESSION['apellido']=$row[2];

                date_default_timezone_set("America/Lima");
                $fecha_actual=date("Y-m-d");
                setcookie("fecha",$fecha_actual,time()+84600 * 7);

                header('location: panel.php');

            }
            else {
              header('Location: index.php');
            }
        }
        else {
          header('Location: index.php');
      }   
    }
    else
    {
      echo <<<_END
      <center>
        <h2>Tareas pendientes en linea</h2>
      <h1>Iniciar sesion</h1>
      <form action="index.php" method="post"><pre>
      Usuario  <input type="text" name="Username">
      Password <input type="password" name="Password">
               <input type="submit" value="INGRESAR">
      </form>
            Si aun no tienes cuenta 
            lo primero que tienes que hacer es Registrarte
      <form action="signup.php" method="post"><pre>
               <input type="submit" value="REGISTRARTE">
      </form>
      </center>
      _END;
    }

    $conexion->close();

    function mysql_entities_fix_string($conexion, $string)
    {
        return htmlentities(mysql_fix_string($conexion, $string));
      }
    function mysql_fix_string($conexion, $string)
    {
        return $conexion->real_escape_string($string);
      }  
?>