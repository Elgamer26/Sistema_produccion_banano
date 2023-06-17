<?php
require_once 'modelo_conexion.php';
class Modelo_beneficio extends modelo_conexion
{
    function registrar_beneficio($nombre, $valor, $tipo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM beneficios_rol where nombre = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO beneficios_rol (nombre, valor, tipo) VALUES (?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $valor);
                $querya->bindParam(3, $tipo);

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

    function listra_beneficios()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM beneficios_rol";
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

    function estado_benedifico($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE beneficios_rol SET estado = ? WHERE id_beneficios = ?";
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

    function editr_beneficio($id, $nombre, $valor, $tipo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM beneficios_rol where nombre = ? AND id_beneficios != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "UPDATE beneficios_rol SET nombre = ?, valor = ?, tipo = ? WHERE id_beneficios = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $valor);
                $querya->bindParam(3, $tipo);
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
}
