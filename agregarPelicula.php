<?php
require_once 'clases/Usuario.php';
require_once 'clases/ControladorSesion.php';
session_start();

if (isset($_SESSION['usuario'])) {
  $usuario = unserialize($_SESSION['usuario']);
  $nomApe = $usuario->getNombreApellido();
  $id = $usuario->getId();
} else {
  header('Location: index.php');
}



if (isset($_POST['nombre_pelicula']) && isset($_POST['genero'])) {
    $cs = new ControladorSesion(); 
    $result = $cs->añadirPelicula($_POST['userID'], $_POST['nombre_pelicula'],  $_POST['genero']);
    if( $result[0] === true ) {
        $redirigir = 'agregarPelicula.php?mensaje='.$result[1];
    }
    else {
        $redirigir = 'agregarPelicula.php?mensaje='.$result[1];
    }
    header('Location: ' . $redirigir);
}
?>

<!DOCTYPE html> 
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Pelicula</title>
        <link href="site.css?v0.1" rel="stylesheet" type="text/css" />
    </head>
    <body class="content_login">
      <div class="content_title_login">
      Agregar Nueva Pelicula
      </div>    
      <div class="content_title_login">
        <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>

        <form action="agregarPelicula.php" method="post">

          <div class="content_input_login">
            <input name="userID" type="hidden" value=<?php echo $id ?>><br>
          </div>

          <div class="content_input_login">
            <input name="nombre_pelicula" placeholder="Pelicula" required><br>
          </div>

          <div class="content_input_login">
            <input name="genero" placeholder="Genero" required><br>
          </div>

            <input type="submit" value="Añadir" class="">

        </form>   
        <div class="content_login_form flex_basic">
          <a href="home.php" class="link">Volver al Homepage</a>
        </div>
      </div> 
    </body>
</html>