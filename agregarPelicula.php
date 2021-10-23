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
        <link rel="" href="">
    </head>
    <body class="">
      <div class="">
      <h1>Pelicula</h1>
      </div>    
      <div class="">
        <h3>Agregar Nueva Pelicula</h3>
        <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>

        <form action="agregarPelicula.php" method="post">
            <input name="userID" type="hidden" class="" value=<?php echo $id ?>><br>
            <input name="nombre_pelicula" class="" placeholder="Pelicula" required><br>
            <input name="genero" class="" placeholder="Genero" required><br>
            <input type="submit" value="Añadir" class="">
        </form>   
        
        <p><a href="home.php">Volver al Homepage</a></p>
      </div> 
    </body>
</html>