<?php 
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db);
    if ($conexion->connect_error) die ("Fatal error");
 
    if (isset($_POST['id']) &&
        isset($_POST['Titulo']) &&
        isset($_POST['Contenido']) &&
        isset($_POST['Fecha_registro']) &&
        isset($_POST['Fecha_vencimiento']) &&
        isset($_POST['dni']) )
    {
        $id = get_post($conexion, 'id');
        $titulo = get_post($conexion, 'Titulo');
        $contenido = get_post($conexion, 'Contenido');
        $fecha_registro = get_post($conexion, 'Fecha_registro');
        $fecha_vencimiento = get_post($conexion, 'Fecha_vencimiento');
        $dni = get_post($conexion, 'dni');
        $query = "INSERT INTO Reg_tareas VALUE" .
            "('$id', '$titulo', '$contenido','$fecha_registro','$fecha_vencimiento','$dni')";
        $result = $conexion->query($query);
        if (!$result) echo "INSERT falló <br><br>";
        else echo "Registro exitosamente tu tarea <a href='panel.php'>atras</a>";
    }

    echo <<<_END
    <center>
    <h1>Registre su tarea</h1>
    <form action="regtarea.php" method="post"><pre>
                 id <input type="number" name="id" size="10" required>
             Titulo <input type="text" name="Titulo" required>
                  Contenido <textarea name="Contenido" cols="30" rows="5" maxlength="400" wrap="type" required></textarea>
     Fecha registro <input type="date" name="Fecha_registro" required>
     Fecha vencimiento <input type="date" name= "Fecha_vencimiento" required>
                dni <input type="text" maxlength="8" name= "dni" required>
        <input type="submit" value="Agregar">
             
    </pre></form>
    </center>
    _END;

    $conexion->close();

    function get_post($con, $var)
    {
        return $con->real_escape_string($_POST[$var]);
    }
?>