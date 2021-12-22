<?php 
    session_start();

    if (isset($_SESSION['dni']))
    {
        $dni = htmlspecialchars($_SESSION['dni']);
        $nombre = htmlspecialchars($_SESSION['nombre']);
        $apellido = htmlspecialchars($_SESSION['apellido']);

        echo "Hola $nombre $apellido Bienvenido a tu plataforma <br>
               <a href=logout.php>Cerrar sesion</a>";
               //echo "<hr/>";
               //require_once 'tareaspendientes.php';
               echo "<br><hr/>";
               echo <<<_END
              <form action="regtarea.php" method="post"><pre>
              <input type="submit" value="REGISTRAR TAREAS ">
              </form>
              <form action="tareaspendientes.php" method="post"><pre>
              <input type="submit" value="tareas pendientes">
              </form>
              <form action="tareasvencidas.php" method="post"><pre>
              <input type="submit" value="tareas vencidas">
              </form>
              <form action="tareastodas.php" method="post"><pre>
              <input type="submit" value="tareas todas">
              </form>
              <form action="tareas.php" method="post"><pre>
              <input type="submit" value="tareas archivadas">
              </form>
              _END;
    } 
    else echo "Por favor <a href=index.php>Click aqui</a>
                para ingresar";
?>