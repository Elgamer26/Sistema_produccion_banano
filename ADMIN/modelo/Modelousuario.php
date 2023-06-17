<?php
require_once 'modelo_conexion.php';
class Modelousuario extends modelo_conexion
{
    function verifcar_usuario($usuario, $passs)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            usuario.id_usuario, 
            usuario.pass, 
            usuario.usuario, 
            usuario.estado, 
            usuario.id_rol
            FROM
            usuario WHERE binary  usuario.pass = ? AND binary usuario.usuario = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $passs);
            $query->bindParam(2, $usuario);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function traer_datos_usuario($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            usuario.id_usuario,
            usuario.nombres,
            usuario.apellidos,
            usuario.usuario,
            usuario.foto,
            rol.nombre,
            usuario.numero_documento,
            usuario.pass 
            FROM
            usuario
            INNER JOIN rol ON usuario.id_rol = rol.id_rol WHERE usuario.id_usuario = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_foto_perfil_usuario($id_empe, $ruta)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "UPDATE usuario SET foto = ? WHERE id_usuario = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $ruta);
            $query->bindParam(2, $id_empe);
            if ($query->execute()) {
                return 1;
            } else {
                return 0;
            }
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_password($id, $nueva)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "UPDATE usuario SET pass = ? WHERE id_usuario = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nueva);
            $query->bindParam(2, $id);
            if ($query->execute()) {
                return 1;
            } else {
                return 0;
            }
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_datos_usuario($id, $nomber, $apellido, $usurio)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM usuario where binary usuario = ? AND id_usuario != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $usuario);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "UPDATE usuario SET nombres = ?, apellidos = ?, usuario = ? WHERE id_usuario = ?";

                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nomber);
                $querya->bindParam(2, $apellido);
                $querya->bindParam(3, $usurio);
                $querya->bindParam(4, $id);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $res = 2;
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_tipo_rol()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM rol WHERE estado = 1";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo[] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function registra_usuario($nombre, $usuario, $password, $apellidos, $tipo_rol_usu, $numero_docu, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM usuario where binary usuario = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $usuario);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {

                $sql_b = "SELECT * FROM usuario where nombres = ? AND apellidos = ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $nombre);
                $query_b->bindParam(2, $apellidos);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

                if (empty($data_b)) {

                    $sql_a = "INSERT INTO usuario (nombres, apellidos, usuario, pass, foto, id_rol, numero_documento, fecha) VALUES (?,?,?,?,?,?,?,CURDATE())";
                    $querya = $c->prepare($sql_a);
                    $querya->bindParam(1, $nombre);
                    $querya->bindParam(2, $apellidos);
                    $querya->bindParam(3, $usuario);
                    $querya->bindParam(4, $password);
                    $querya->bindParam(5, $ruta);
                    $querya->bindParam(6, $tipo_rol_usu);
                    $querya->bindParam(7, $numero_docu);

                    if ($querya->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3;
                }
            } else {
                $res = 2;
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listra_usuario()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            usuario.id_usuario,
            usuario.nombres,
            usuario.apellidos,
            usuario.usuario,
            usuario.pass,
            usuario.foto,
            usuario.estado,
            usuario.fecha,
            rol.nombre,
            usuario.numero_documento,
            usuario.id_rol
            FROM
            usuario
            INNER JOIN rol ON usuario.id_rol = rol.id_rol";
            $query = $c->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $arreglo = array();
            foreach ($result as $respuesta) {
                $arreglo["data"][] = $respuesta;
            }
            return $arreglo;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function estado_usuario($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();


            $sql_a = "UPDATE usuario set estado = ? WHERE id_usuario = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $dato);
            $querya->bindParam(2, $id);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
            }

            return $res;
            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_usuario($id, $nombre, $usuario, $apellidos, $tipo_rol_usu, $numero_docu)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM usuario where binary usuario = ? AND id_usuario != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $usuario);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {

                $sql_b = "SELECT * FROM usuario where nombres = ? AND apellidos = ? AND id_usuario != ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $nombre);
                $query_b->bindParam(2, $apellidos);
                $query_b->bindParam(3, $id);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

                if (empty($data_b)) {

                    $sql_a = "UPDATE usuario SET nombres = ?, apellidos = ?, usuario = ?, id_rol = ?, numero_documento = ? WHERE id_usuario = ?";
                    $querya = $c->prepare($sql_a);
                    $querya->bindParam(1, $nombre);
                    $querya->bindParam(2, $apellidos);
                    $querya->bindParam(3, $usuario);
                    $querya->bindParam(4, $tipo_rol_usu);
                    $querya->bindParam(5, $numero_docu);
                    $querya->bindParam(6, $id);

                    if ($querya->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3;
                }
            } else {
                $res = 2;
            }
            return $res;

            //cerramos la conexion
            modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }
}
