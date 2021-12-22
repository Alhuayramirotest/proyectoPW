<?php 
    session_start();
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db);
    if ($conexion->connect_error) die ("Fatal error");

    if (isset($_POST['eliminar']) && isset($_POST['id']))
    {   
        $id = get_post($conexion, 'id');
        $query = "DELETE FROM Reg_tareas WHERE id='$id'";
        $result = $conexion->query($query);
        if (!$result) echo "BORRAR falló"; 
    }

    if (isset($_SESSION['dni']))
    {
        $dni = htmlspecialchars($_SESSION['dni']);
        echo "<b> TUS TARAES PENDIENTES SON:</b> ";
        echo "<br>";
               date_default_timezone_set("America/Lima");
               $fecha_actual=date("Y-m-d");
              // echo $fecha_actual;
              $query = "SELECT * from Reg_tareas where dni=$dni and Fecha_vencimiento >= '$fecha_actual'";
              $result = $conexion->query($query);
              if (!$result) die ("Falló el acceso a la base de datos");
          
              $rows = $result->num_rows;
              for ($j = 0; $j < $rows; $j++)
              {
                  $row = $result->fetch_array(MYSQLI_ASSOC);
          
                  $id = htmlspecialchars($row['id']);
                  $titulo = htmlspecialchars($row['Titulo']);
                  $contenido = htmlspecialchars($row['Contenido']);
                  $fecha_registro = htmlspecialchars($row['Fecha_registro']);
                  $fecha_vencimiento = htmlspecialchars($row['Fecha_vencimiento']);
          
                  echo <<<_END
                  <pre>
                  Titulo: $titulo
                  Contenido: $contenido
                  fecha registro: $fecha_registro
                  fecha vencimiento: $fecha_vencimiento
                  </pre>
                  <form action='tareaspendientes.php' method='post'>
                  <input type='hidden' name='eliminar' value='yes'>
                  <input type='hidden' name='id' value='$id'>
                  <input type='submit' value='BORRAR REGISTRO'></form>

                  <form action='editar.php' method='post'>
                  <input type='hidden' name='id' value='$id'>
                  <input type='submit' value='MODIFICAR REGISTRO'></form>
                  
                  _END;
              }
             
    }
    $result->close();
    $conexion->close();

    function get_post($con, $var){
        return $con->real_escape_string($_POST[$var]);
    }
           
?>