<?php
require_once 'modelo_conexion.php';
class Model_sancion extends modelo_conexion
{
    function registrar_sancion($nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_sancion where tipo_sancion = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO tipo_sancion (tipo_sancion) VALUES (?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);

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

    function listar_sancion()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_sancion";
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

    function estado_sancion_tipo($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE tipo_sancion set estado = ? WHERE id_tipo_sancion = ?";
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

    function editar_sancion_tipo($nombre, $id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_sancion where tipo_sancion = ? AND id_tipo_sancion != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "UPDATE tipo_sancion SET tipo_sancion = ? WHERE id_tipo_sancion = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $id);

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

    function listar_multass()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            multas.id_multa,
            CONCAT_WS(' ',empleado.nombres,
            empleado.apellidos,
            empleado.cedula) AS empleado,            
            multas.fecha_infraccion,
            multas.fecha_registro,
            multas.id_tipo_sancion,
            tipo_sancion.tipo_sancion,
            multas.motivo,
            multas.multa,
            multas.observacion,
            multas.estado_pago,
            multas.eliminar,
            DATE( multas.fecha_infraccion) AS fecha_i,
            TIME( multas.fecha_infraccion) AS hora_i,
            multas.fecha_paga_multa
            FROM
                empleado
                INNER JOIN multas ON empleado.id_empleado = multas.id_empleado
                INNER JOIN tipo_sancion ON tipo_sancion.id_tipo_sancion = multas.id_tipo_sancion 
            ORDER BY
            multas.id_multa DESC";
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
}
