<?php
require_once 'modelo_conexion.php';
class Model_marcar extends modelo_conexion
{
    function traer_datos_empleado_asistencia($valor)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empleado
            WHERE hoja_vida = 1 AND cedula = ?";
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

    function marcar_entrada($id, $fe_ho)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();


            $sql = "SELECT * FROM asistencia where id_empleado = ? AND estado_asistencia = 1";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {

                $sql_a = "INSERT INTO asistencia (id_empleado, fecha_hora_ingreso) VALUES (?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $id);
                $querya->bindParam(2, $fe_ho);

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

    function traer_datos_empleado_asistencia_salida($valor)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            asistencia.id_asistencia,
            asistencia.id_empleado,
            empleado.nombres,
            empleado.apellidos,
            empleado.sexo,
            empleado.telefono,
            empleado.foto,
            DATE( asistencia.fecha_hora_ingreso ) AS fecha,
            TIME( asistencia.fecha_hora_ingreso ) AS hota,
            asistencia.estado_asistencia 
            FROM
            asistencia
            INNER JOIN empleado ON asistencia.id_empleado = empleado.id_empleado 
            AND asistencia.estado_asistencia = 1 AND empleado.cedula = ?";
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

    function marcar_salida($id, $fe_ho, $id_asi)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE asistencia SET fecha_hora_salida = ?, estado_asistencia = 0 WHERE id_asistencia = ? AND id_empleado = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $fe_ho);
            $querya->bindParam(2, $id_asi);
            $querya->bindParam(3, $id);

            if ($querya->execute()) {
                $res = 1;
            } else {
                $res = 0;
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

    function listar_asistencias()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            asistencia.id_asistencia,          
            CONCAT_WS(' ',empleado.nombres,
            empleado.apellidos) AS empleado,
            empleado.foto,
            asistencia.fecha_hora_ingreso,
            asistencia.fecha_hora_salida,
            asistencia.estado_asistencia,
            empleado.estado 
            FROM
                empleado
                INNER JOIN asistencia ON empleado.id_empleado = asistencia.id_empleado 
            ORDER BY
            asistencia.id_asistencia DESC";
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

    function traer_datos_empleado_asistencias($valor)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            asistencia.id_asistencia,
            asistencia.id_empleado,
            empleado.nombres,
            empleado.apellidos,
            empleado.sexo,
            empleado.telefono,
            empleado.foto,
            empleado.estado 
            FROM
                empleado
                INNER JOIN asistencia ON empleado.id_empleado = asistencia.id_empleado 
                WHERE empleado.cedula = ?
            GROUP BY
            asistencia.id_empleado";
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

    function traer_el_empleado_asistencias($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            asistencia.id_asistencia, 
            asistencia.id_empleado, 
            asistencia.fecha_hora_ingreso, 
            asistencia.fecha_hora_salida, 
            asistencia.estado_asistencia
            FROM
                asistencia
            WHERE
                asistencia.id_empleado = ?
            ORDER BY
            asistencia.id_asistencia DESC";
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
