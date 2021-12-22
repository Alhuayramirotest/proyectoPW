<?php
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db);
    if ($conexion->connect_error) die ("Fatal Error");

    if(isset($_POST['guardar']))
    {
        if(isset($_POST['id']) &&
        isset($_POST['Contenido'])&&
        isset($_POST['Fecha_registro'])&&
        isset($_POST['Fecha_vencimiento']))
        {
            $id = mysql_fix_string($conexion, $_POST['id']);
            $titulo = mysql_fix_string($conexion, $_POST['Titulo']);
            $contenido = mysql_fix_string($conexion, $_POST['Contenido']);
            $fecha_registro = mysql_fix_string($conexion, $_POST['Fecha_registro']);
            $fecha_vencimiento= mysql_fix_string($conexion, $_POST['Fecha_vencimiento']);
            $dni = mysql_fix_string($conexion, $_POST['dni']);

    
            $query = "UPDATE Reg_tareas SET Contenido = '$contenido', Fecha_registro='$fecha_registro', Fecha_vencimiento='$fecha_vencimiento'  WHERE id ='$id'";
            $result  = $conexion->query($query);
            
        }
        if(!$result) echo "Fallo en la actualizacion";
     
         header('Location: tareaspendientes.php');
    }

    if(isset($_POST['id']))
    {
        $id = get_post($conexion, 'id');
        $query = "SELECT * FROM Reg_tareas WHERE id='$id'";
        $result = $conexion->query($query);
        if(!$result) die("No se pudo obtener tarea");

        $row = $result->fetch_array(MYSQLI_ASSOC);

        $id = htmlspecialchars($row['id']);
        $titulo = htmlspecialchars($row['Titulo']);
        $contenido = htmlspecialchars($row['Contenido']);
        $fecha_registro = htmlspecialchars($row['Fecha_registro']);
        $fecha_vencimiento = htmlspecialchars($row['Fecha_vencimiento']);
        $dni = htmlspecialchars($row['dni']);

        echo <<<_END
            <form action="editar.php" method="post"><pre>
                        <input type="hidden" name="id" value=$id>
            titulo      <input type="text" name="Titulo" value=$titulo>
    
            Contenido   <textarea name="Contenido" rows ="4" cols = "100">$contenido</textarea>

        fecha registro  <input type="date" name="Fecha_registro" value="$fecha_registro">

        fecha vencimiento <input type="date" name="Fecha_vencimiento" value="$fecha_vencimiento">
                        <input type='hidden' name='guardar' value='yes'>
                        <input type="submit" value="guardar">
                
    
            </pre></form>    

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
 
    function get_post($con, $var)
    {
        return $con->real_escape_string($_POST[$var]);
    }
?>