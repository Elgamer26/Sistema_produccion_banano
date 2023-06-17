<?php
require_once 'modelo_conexion.php';
class Model_tipo_plaga extends modelo_conexion
{

    function mueva_tipo_plaga($nombre, $descripcion, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_b = "SELECT * FROM tipo_plaga where tipo_plaga = ?";
            $query_b = $c->prepare($sql_b);
            $query_b->bindParam(1, $nombre); 
            $query_b->execute();
            $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

            if (empty($data_b)) {

                $sql_a = "INSERT INTO tipo_plaga (tipo_plaga, descripcion, foto) VALUES (?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $descripcion);
                $querya->bindParam(3, $ruta); 

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

    function listar_tipo_plagas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_plaga";
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

    function estatottipopla($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
                $sql_a = "UPDATE tipo_plaga SET estado = ? WHERE id_tipo_plaga = ?";
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

    function editar_tipo_plaga($id, $nombre, $descripcion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_b = "SELECT * FROM tipo_plaga where tipo_plaga = ? AND id_tipo_plaga != ?";
            $query_b = $c->prepare($sql_b);
            $query_b->bindParam(1, $nombre); 
            $query_b->bindParam(2, $id); 
            $query_b->execute();
            $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

            if (empty($data_b)) {

                $sql_a = "UPDATE tipo_plaga SET tipo_plaga = ?, descripcion = ? WHERE id_tipo_plaga = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $descripcion);
                $querya->bindParam(3, $id); 

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

    function creando_tipo_plaga_tra($nombre, $descripcion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_b = "SELECT * FROM tipo_tratamiento where tipo_tratamiento = ?";
            $query_b = $c->prepare($sql_b);
            $query_b->bindParam(1, $nombre); 
            $query_b->execute();
            $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

            if (empty($data_b)) {

                $sql_a = "INSERT INTO tipo_tratamiento (tipo_tratamiento, descripion) VALUES (?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $descripcion); 

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

    function listar_tipo_tratamiento()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_tratamiento";
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

    function esta_tipo_tratamiento($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
                $sql_a = "UPDATE tipo_tratamiento SET estado = ? WHERE id_tipo_tratamiento = ?";
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

    function editar_tipo_tratamiento($id, $nombre, $descripcion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_b = "SELECT * FROM tipo_tratamiento where tipo_tratamiento = ? AND id_tipo_tratamiento != ?";
            $query_b = $c->prepare($sql_b);
            $query_b->bindParam(1, $nombre); 
            $query_b->bindParam(2, $id); 
            $query_b->execute();
            $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

            if (empty($data_b)) {

                $sql_a = "UPDATE tipo_tratamiento SET tipo_tratamiento = ?, descripion = ? WHERE id_tipo_tratamiento = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $descripcion);
                $querya->bindParam(3, $id); 

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
            // modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            // modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function nuevoo_tipo_quimico($nombre, $descripcion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_b = "SELECT * FROM tipo_quimico where tipo_quimico = ?";
            $query_b = $c->prepare($sql_b);
            $query_b->bindParam(1, $nombre); 
            $query_b->execute();
            $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

            if (empty($data_b)) {

                $sql_a = "INSERT INTO tipo_quimico (tipo_quimico, descripcion) VALUES (?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $descripcion);

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

    function listar_tipo_quimico()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_quimico";
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

    function estado_tipo_quimico($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
                $sql_a = "UPDATE tipo_quimico SET estado_q = ? WHERE id_tipo_quimico = ?";
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

    function editarr_tipo_quimico($id, $nombre, $descripcion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_b = "SELECT * FROM tipo_quimico where tipo_quimico = ? AND id_tipo_quimico != ?";
            $query_b = $c->prepare($sql_b);
            $query_b->bindParam(1, $nombre); 
            $query_b->bindParam(2, $id); 
            $query_b->execute();
            $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

            if (empty($data_b)) {

                $sql_a = "UPDATE tipo_quimico SET tipo_quimico = ?, descripcion = ? WHERE id_tipo_quimico = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $descripcion);
                $querya->bindParam(3, $id); 

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
}
