<?php
require_once 'clases/Usuario.php';

session_start();

if (isset($_SESSION['usuario'])) {
  $usuario = unserialize($_SESSION['usuario']);
  $nomApe = $usuario->getNombreApellido();
} else {
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <link href="site.css?v0.1" rel="stylesheet" type="text/css" />
</head>

<body>
  <div class="content_login">
    <div class="content_title_login">
      Peliculas favoritas
    </div>
    <div class="content_login_form flex_basic">
      <div class="title_user_loged">
        Hola <?php echo $nomApe; ?>
      </div>
      <a class="logout_user" href="logout.php">Cerrar sesión</a>
    </div>
  </div>
</body>

</html>