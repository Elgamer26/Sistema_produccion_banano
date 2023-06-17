<?php
require_once 'modelo_conexion.php';
class Modelo_actividad extends modelo_conexion
{
    function listar_trabajador_ac()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            empleado.id_empleado,
            empleado.nombres,
            empleado.apellidos,
            empleado.cedula 
            FROM
                empleado 
            WHERE
            empleado.estado = 1 
            AND empleado.hoja_vida = 1 
            AND empleado.actividad = 0";

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

    function traer_datos_emplead($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            empleado.id_empleado, 
            empleado.nombres, 
            empleado.apellidos, 
            empleado.cedula, 
            empleado.foto, 
            empleado.sexo, 
            empleado.telefono
            FROM
                empleado
            WHERE
            empleado.id_empleado = ?";
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

    function listar_actividades()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tipo_actividad.id_tipo_actividad, 
            tipo_actividad.tipo_actividad
            FROM
            tipo_actividad WHERE tipo_actividad.estado = 1";

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

    function registrar_actividad($id_empleado, $tipo_actividad, $costo_acivdad, $fecha_asiga)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO asignacion_actividad (id_empleado, id_tipo_actividad, costo_actividad, fecha) VALUES (?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id_empleado);
            $querya->bindParam(2, $tipo_actividad);
            $querya->bindParam(3, $costo_acivdad);
            $querya->bindParam(4, $fecha_asiga);

            if ($querya->execute()) {

                $sql_a = "UPDATE empleado SET actividad = 1 WHERE id_empleado = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $id_empleado);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
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

    function listar_asignacion_actividad()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            asignacion_actividad.id_asignacion_actividad,
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos ) AS empeado,
            empleado.cedula,
            asignacion_actividad.id_tipo_actividad,
            tipo_actividad.tipo_actividad,
            asignacion_actividad.costo_actividad,
            asignacion_actividad.fecha,
            asignacion_actividad.estado as estado_ac,
            empleado.estado,
            asignacion_actividad.actividad
            FROM
                empleado
                INNER JOIN asignacion_actividad ON empleado.id_empleado = asignacion_actividad.id_empleado
                INNER JOIN tipo_actividad ON asignacion_actividad.id_tipo_actividad = tipo_actividad.id_tipo_actividad 
            ORDER BY
            asignacion_actividad.id_asignacion_actividad DESC";

            $query = $c->prepare($sql);
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

    function cambiar_estado_actividades($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE asignacion_actividad SET estado = ? WHERE id_asignacion_actividad = ?";
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

    function editar_actividad($id, $tipo_actividad, $costo_acivdad)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE asignacion_actividad SET id_tipo_actividad = ?, costo_actividad = ? WHERE id_asignacion_actividad = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $tipo_actividad);
            $querya->bindParam(2, $costo_acivdad);
            $querya->bindParam(3, $id);

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
}
