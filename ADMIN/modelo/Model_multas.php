<?php
require_once 'modelo_conexion.php';
class Model_multas extends modelo_conexion
{
    function traer_datos_empleado($valor)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empleado
            WHERE estado = 1 AND cedula = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $valor);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_BOTH);
            $arreglo = array();
            if (!empty($result)) {
                $arreglo[] = $result;
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

    function listar_tio_sancion()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_sancion WHERE estado = 1";
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

    function guadar_sancion($id_empleado, $fe_ho, $tipo_sancin, $motivo_i, $multa_dolra, $observacion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO multas (id_empleado, fecha_infraccion, id_tipo_sancion, motivo, multa, observacion, fecha_registro) VALUES (?,?,?,?,?,?,CURDATE())";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id_empleado);
            $querya->bindParam(2, $fe_ho);
            $querya->bindParam(3, $tipo_sancin);
            $querya->bindParam(4, $motivo_i);
            $querya->bindParam(5, $multa_dolra);
            $querya->bindParam(6, $observacion);

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

    function editar_sancion($id, $fe_ho, $tipo_sancin, $motivo_i, $multa_dolra, $observacion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE multas SET fecha_infraccion = ?, id_tipo_sancion = ?, motivo = ?, multa = ?, observacion = ? WHERE id_multa = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $fe_ho);
            $querya->bindParam(2, $tipo_sancin);
            $querya->bindParam(3, $motivo_i);
            $querya->bindParam(4, $multa_dolra);
            $querya->bindParam(5, $observacion);
            $querya->bindParam(6, $id);

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

    function eliminar_multa($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "DELETE FROM multas WHERE id_multa = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);

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

    function traer_datos_empleado_multa($valor)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            multas.id_empleado,
            empleado.nombres,
            empleado.apellidos,
            empleado.sexo,
            empleado.telefono,
            empleado.foto,
            empleado.cedula,
            empleado.estado
            FROM
            multas
            INNER JOIN empleado ON multas.id_empleado = empleado.id_empleado 
            WHERE
            empleado.cedula = ? 
            GROUP BY
            multas.id_empleado";
            $query = $c->prepare($sql);
            $query->bindParam(1, $valor);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_BOTH);
            $arreglo = array();
            if (!empty($result)) {
                $arreglo[] = $result;
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

    function traer_multas_del_empleado($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            multas.id_empleado, 
            multas.estado_pago, 
            tipo_sancion.tipo_sancion, 
            multas.multa, 
            multas.fecha_infraccion, 
            multas.motivo
            FROM
            multas
            INNER JOIN
            tipo_sancion
            ON 
            multas.id_tipo_sancion = tipo_sancion.id_tipo_sancion WHERE multas.id_empleado = ? ORDER BY multas.id_multa DESC";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
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
