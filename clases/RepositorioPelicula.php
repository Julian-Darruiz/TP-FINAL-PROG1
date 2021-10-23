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
        $q = "SELECT nombre_pelicula, genero FROM peliculasfavoritas WHERE id_usuario = ?";
        try {
            $query = self::$conexion->prepare($q);
            $query->bind_param("i", $idUsuario);
            $query->bind_result($nombrePelicula, $genero);

            if ($query->execute()) {
                $listaCuentas = array();
                while ($query->fetch()) {
                    $listaCuentas[] = new PeliculaFavorita($usuario, $nombrePelicula, $genero);
                }
                return $listaCuentas;
            }
            return false;
        } catch(Exception $e) {
            return false;
        }
    }
}