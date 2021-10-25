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
              echo "<td id='nombre_pelicula-$id'>".$unaPelicula->getNombrePelicula()."</td>";
              echo "<td>".$unaPelicula->getGenero()."</td>";
              echo "<td><button type='button' onclick='edicionNombrePelicula($id)'>Editar</button></td>";
              echo "<td><a href='eliminar.php?id=$id'>Eliminar</a></td>";
              echo '</tr>';
          }
      }
    ?>
      </table>
      <div id="editar">
                <h3>Editar</h3> 
                <input type="hidden" id="editar">
                <input type="hidden" id="numeroPeli">
                <label for="pelicula">Pelicula: </label>
                <input type="text" id="pelicula"><br>
                <button type="button" onclick="editar();">Cambiar nombre</button>
            </div>
            <hr>
          </div>
    <script>
        function editar()  { // operacion();
                var editar = document.querySelector('#editar').value;
                var numeroPeli = 4 // document.querySelector('#numeroPeli').value;
                var pelicula/* monto*/  = document.querySelector('#pelicula').value;
                // var cadena = "editar="+editar+"&numeroPeli="+numeroPeli+"&pelicula="+pelicula;
    
                var solicitud = new XMLHttpRequest();
          
                // solicitud.onreadystatechange = function() {
                //     if (this.readyState == 4 && this.status == 200) {
                //         var respuesta = JSON.parse(this.responseText);
                //         var identificador = "#nombre_pelicula-" + respuesta.id;
                //         var celda = document.querySelector(identificador);
    
                //         if(respuesta.resultado == "OK") {
                //             celda.innerHTML = respuesta.nombre_pelicula;
                //           } else {
                //             alert(respuesta.resultado);
                //         }
                //         celda.scrollIntoView();
                //       }
                //     };
                    
                    solicitud.onload = function () {
                      console.log(this.responseText)
                    }
                    solicitud.open("GET", "editar.php?id="+numeroPeli);
                    solicitud.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        }
        function edicionNombrePelicula(nroPelicula)
            {
                document.querySelector('#editar').value = "e";
                document.querySelector('#numeroPeli').value = nroPelicula;
                document.querySelector('#pelicula').focus();
            }      
            
    
    </script>
  </div>
</body>
</html>