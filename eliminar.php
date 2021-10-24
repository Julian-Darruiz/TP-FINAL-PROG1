<?php
require_once 'clases/Usuario.php';
require_once 'clases/RepositorioPelicula.php';
require_once 'clases/RepositorioUsuario.php';
require_once 'clases/PeliculaFavorita.php';

session_start();

if (isset($_SESSION['usuario']) && isset($_GET['id'])) {
  $usuario = unserialize($_SESSION['usuario']);
  $rp = new RepositorioPelicula();
  $pelicula = $rp->get_one($_GET['id']);
  if ($rp->delete($pelicula)){
      $mensaje = "Pelicula eliminada";
  } else {
      $mensaje = "Error al eliminar";
  }
  header("Location: home.php?$mensaje");

} else {
  header('Location: index.php');
}
?>