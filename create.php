<?php
require_once 'clases/ControladorSesion.php';
if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    $cs = new ControladorSesion();
    $result = $cs->create($_POST['usuario'], $_POST['nombre'], 
                          $_POST['apellido'], $_POST['clave']);
    if( $result[0] === true ) {
        $redirigir = 'home.php?mensaje='.$result[1];
    }
    else {
        $redirigir = 'create.php?mensaje='.$result[1];
    }
    header('Location: ' . $redirigir);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Crear Usuario</title>
  <link href="site.css?v0.1" rel="stylesheet" type="text/css" />
</head>

<body>
  <div class="content_login">
    <div class="content_title_login">
      Peliculas favoritas
    </div>
    <div class="content_login_form">
      <div class="title_form_log">
        Crear Usuario
      </div>

      <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>

      <form action="create.php" method="post">
        <div class="content_input_login"><input name="usuario" placeholder="Usuario"></div>
        <div class="content_input_login"><input name="clave" type="password" placeholder="Contraseña"></div>
        <div class="content_input_login"><input name="nombre" placeholder="Nombre"></div>
        <div class="content_input_login"><input name="apellido" placeholder="Apellido"></div>
        <div class="content_btns_login"><input type="submit" value="Registrarse"></div>
      </form>
    </div>
  </div>
</body>

</html>