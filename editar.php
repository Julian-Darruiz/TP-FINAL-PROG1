<?php
 require_once 'clases/Usuario.php';
 require_once 'clases/RepositorioPelicula.php';
 require_once 'clases/RepositorioUsuario.php';
 require_once 'clases/PeliculaFavorita.php';

 session_start();

 if (isset($_SESSION['usuario']) && isset($_POST['nombre_pelicula'])) {
     $usuario = unserialize($_SESSION['usuario']);
     $rp = new RepositorioPelicula();
     $pelicula = $rp->get_one($_POST['id']);
     if ($pelicula->getUser() != $usuario->getId()) {
         die("Error: La pelicula no pertenece al usuario");
     }
     if ($_POST['editar'] == 'e') {
         $r = $pelicula->editar($_POST['nombre_pelicula']);
     }
     if ($r) {
         $rp->actualizarDatos($pelicula);
         $respuesta['resultado'] = "OK";
     } else {
         $respuesta['resultado'] = "Error al realizar la operación";
     }

     $respuesta['id'] = $pelicula->getId();
     $respuesta['nombre_pelicula'] = $pelicula->getNombrePelicula();
     echo json_encode($respuesta);
 }
