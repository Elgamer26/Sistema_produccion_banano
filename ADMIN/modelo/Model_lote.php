<?php
require_once 'modelo_conexion.php';
class Model_lote extends modelo_conexion
{
    function registrar_lotes($nombre_lote, $direccion, $Longitud, $Latitud, $hectarea)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO lote (nombre_l, direccion, logintud, latitud, hectarea) VALUES (?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $nombre_lote);
            $querya->bindParam(2, $direccion);
            $querya->bindParam(3, $Longitud);
            $querya->bindParam(4, $Latitud);
            $querya->bindParam(5, $hectarea);

            if ($querya->execute()) {
                $res = $c->lastInsertId();
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

    function registrar_detalle_hectarea($id, $arraglo_hectarea)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detalle_lote (id_lote, hectarea) VALUES (?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_hectarea); 

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

    function listar_lotes()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM lote";
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

    function estado_lote($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE lote set estado = ? WHERE id_lote = ?";
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

    function editar_lotess($id, $nombre_lote, $direccion, $Longitud, $Latitud, $hectarea)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM lote where nombre_l = ? AND id_lote != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre_lote);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "UPDATE lote SET nombre_l = ?, direccion = ?, logintud = ?, latitud = ?, hectarea = ? WHERE id_lote = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre_lote);
                $querya->bindParam(2, $direccion);
                $querya->bindParam(3, $Longitud);
                $querya->bindParam(4, $Latitud);
                $querya->bindParam(5, $hectarea);
                $querya->bindParam(6, $id);

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

    function cargra_detalle_lote($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM detalle_lote WHERE id_lote = ?";
            $query = $c->prepare($sql);            
            $query->bindParam(1, $id);
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

    function ver_produccion($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            produccion.id_produccion,
            produccion.fecha_inicio,
            produccion.fecha_fin,
            produccion.dias,
            produccion.nombre_prod,
            produccion.porcentaje,
            produccion.id_hectarea 
            FROM
                produccion 
            WHERE
            produccion.id_produccion = {$id}";
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
}
