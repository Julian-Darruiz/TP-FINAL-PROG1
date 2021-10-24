<?php
require_once '.env.php';
require_once 'clases/PeliculaFavorita.php';
require_once 'clases/Usuario.php';

class RepositorioPelicula {

    private static $conexion = null;

    public function __construct()
    {
        if (is_null(self::$conexion)) {
            $credenciales = credenciales();
            self::$conexion = new mysqli(   $credenciales['servidor'],
                                            $credenciales['usuario'],
                                            $credenciales['clave'],
                                            $credenciales['base_de_datos']);
            if(self::$conexion->connect_error) {
                $error = 'Error de conexión: '.self::$conexion->connect_error;
                self::$conexion = null;
                die($error);
            }
            self::$conexion->set_charset('utf8'); 
        }
    }


    public function save(PeliculaFavorita $u)
    {
        $q = "INSERT INTO peliculasfavoritas (id_usuario, nombre_pelicula, genero)";
        $q.= "VALUES (?, ?, ?)";
        $query = self::$conexion->prepare($q);

        $query->bind_param("sss", $u->getUser(), $u->getNombrePelicula(),
            $u->getGenero());
        echo $clave;

        if ( $query->execute() ) {
            return self::$conexion->insert_id;
        }
        else {
            return false;
        }


    }
    public function get_all(Usuario $usuario)
    {
        $idUsuario = $usuario->getId();
        $q = "SELECT id, nombre_pelicula, genero FROM peliculasfavoritas WHERE id_usuario = ?";
        try {
            $query = self::$conexion->prepare($q);
            $query->bind_param("i", $idUsuario);
            $query->bind_result($id, $nombrePelicula, $genero);

            if ($query->execute()) {
                $listaPeliculas = array();
                while ($query->fetch()) {
                    $listaPeliculas[] = new PeliculaFavorita($usuario, $nombrePelicula, $genero, $id);
                }
                return $listaPeliculas;
            }
            return false;
        } catch(Exception $e) {
            return false;
        }
    } 
    public function get_one($id)
    {
        $q = "SELECT nombre_pelicula, id_usuario FROM peliculasfavoritas WHERE id = ?";
        try {
            $query = self::$conexion->prepare($q);
            $query->bind_param("i", $id);
            $query->bind_result($nombrePelicula, $idUsuario);

            if ($query->execute()) {
                if ($query->fetch()) {
                    $ru = new RepositorioUsuario();
                    $usuario = $ru->get_one($idUsuario);
                    return new PeliculaFavorita($usuario, $nombrePelicula, $genero, $id);
                }
            }
            return false;
        } catch(Exception $e) {
            return false;
        }
    } 
    public function delete(PeliculaFavorita $pelicula)
    {
        $n = $pelicula->getId();
        $q = "DELETE FROM peliculasfavoritas WHERE id = ?";
        $query = self::$conexion->prepare($q);
        $query->bind_param("i", $n);
        return ($query->execute());
    }
}