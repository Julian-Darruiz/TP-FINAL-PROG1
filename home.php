<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioPelicula.php';
require_once 'clases/PeliculaFavorita.php';

session_start();

if (isset($_SESSION['usuario'])) {
  $usuario = unserialize($_SESSION['usuario']);
  $nomApe = $usuario->getNombreApellido();
  $rc = new RepositorioPelicula();
  $cuentas = $rc->get_all($usuario);
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
        Hola <?php echo $nomApe; ?>, agregue, modifique o elimine su pelicula favorita haciendo click <a href="peliculaUsuario.php" class="link">AQUI</a>
      </div>
      <h3>Listado de cuentas</h3>
        <table class="table table-striped">
            <tr>
                <th>NumeroPeli</th><th>Pelicula</th><th>Genero</th><th>Agregar</th><th>Eliminar</th>
            </tr>
            {

            }
        <?php
        if (count($cuentas) == 0) {
            echo "<tr><td colspan='5'>No tiene cuentas creadas</td></tr>";
        } else {
            foreach ($cuentas as $unaCuenta) {
                $id = $unaCuenta->getId();
                echo '<tr>';
                echo "<td>$id</td>";
                echo "<td>".$unaCuenta->getNombrePelicula()."</td>";
                echo "<td>".$unaCuenta->getGenero()."</td>";
                echo "<td><button type='button' onclick='extraer()'>Extraer</button></td>";
                echo "<td><a href='eliminar.php?n='>Eliminar</a></td>";
                echo '</tr>';
            }
        }
        ?>
        </table>
      <a class="logout_user" href="logout.php">Cerrar sesión</a>
    </div>
  </div>
</body>
</html>