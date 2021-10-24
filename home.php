<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioPelicula.php';
require_once 'clases/PeliculaFavorita.php';

session_start();

if (isset($_SESSION['usuario'])) {
  $usuario = unserialize($_SESSION['usuario']);
  $nomApe = $usuario->getNombreApellido();
  $rc = new RepositorioPelicula();
  $peliculas = $rc->get_all($usuario);
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
        Bienvenido <?php echo $nomApe; ?>, aqui podra ver, modificar y eliminar sus Peliculas Favoritas <a href="agregarPelicula.php" class="link">ACA</a>
      </div>
      <a class="logout_user" href="logout.php">Cerrar sesión</a>
    </div>
    
      <table class='tabla' border='1' style="border-collapse: collapse" bordercolor="#111111">
          <tr>
              <th>NumeroPeli</th><th>Pelicula</th><th>Genero</th><th>Editar</th><th>Eliminar</th>
          </tr>
    <?php
      if (count($peliculas) == 0) {
          echo "<tr><td colspan='5'>No tiene peliculas creadas</td></tr>";
      } else {
          foreach ($peliculas as $unaPelicula) {
              $id = $unaPelicula->getId();
              echo '<tr>';
              echo "<td>$id</td>";
              echo "<td>".$unaPelicula->getNombrePelicula()."</td>";
              echo "<td>".$unaPelicula->getGenero()."</td>";
              echo "<td><button type='button' onclick='editar()'>Editar</button></td>";
              echo "<td><a href='eliminar.php?id=$id'>Eliminar</a></td>";
              echo '</tr>';
          }
      }
    ?>
      </table>
  </div>
</body>
</html>