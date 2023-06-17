<?php
require_once 'modelo_conexion.php';
class Model_tipo_permiso extends modelo_conexion
{
    function registrar_permiso($nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_permiso where tipo_permiso = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO tipo_permiso (tipo_permiso) VALUES (?)";
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

    function listar_tipo_permisos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_permiso";
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

    function estado_tipo_permiso($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE tipo_permiso set estado = ? WHERE id_tipo_permiso = ?";
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

    function editar_tipo_permiso($nombre, $id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_permiso where tipo_permiso = ? AND id_tipo_permiso != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "UPDATE tipo_permiso SET tipo_permiso = ? WHERE id_tipo_permiso = ?";
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

    function traer_datos_empleado($valor)
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

    function listar_tipo_permiso()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_permiso WHERE estado = 1";
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

    function registrr_permisos($id_empleado, $Fecha_i, $Fecha_f, $tip_permiso, $observacion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "INSERT INTO permisos_empleado (id_empleado, fecha_inicio, fecha_fin, id_tipo_permiso, obsservacion, fecha_registro) VALUES (?,?,?,?,?,CURDATE())";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id_empleado);
            $querya->bindParam(2, $Fecha_i);
            $querya->bindParam(3, $Fecha_f);
            $querya->bindParam(4, $tip_permiso);
            $querya->bindParam(5, $observacion);

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

    function listar_permisos_empleado()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            permisos_empleado.id_permisos,
            CONCAT_WS(' ',  empleado.nombres,
            empleado.apellidos) as empleado,          
            permisos_empleado.fecha_inicio,
            permisos_empleado.fecha_fin,
            tipo_permiso.tipo_permiso,
            permisos_empleado.obsservacion,
            permisos_empleado.fecha_registro 
            FROM
                permisos_empleado
                INNER JOIN empleado ON permisos_empleado.id_empleado = empleado.id_empleado
                INNER JOIN tipo_permiso ON permisos_empleado.id_tipo_permiso = tipo_permiso.id_tipo_permiso 
            ORDER BY
            permisos_empleado.id_permisos DESC";
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

    function elimianr_permiso($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "DELETE FROM permisos_empleado WHERE id_permisos = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id); 

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

    function traer_empleado_permisos($valor)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            permisos_empleado.id_permisos,
            permisos_empleado.id_empleado,
            empleado.nombres,
            empleado.apellidos,
            empleado.sexo,
            empleado.telefono,
            empleado.foto,
            empleado.estado 
            FROM
                permisos_empleado
                INNER JOIN empleado ON permisos_empleado.id_empleado = empleado.id_empleado 
                WHERE empleado.cedula = ?
            GROUP BY
            permisos_empleado.id_empleado";

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

    function traer_detalle_permios($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            permisos_empleado.id_empleado,
            permisos_empleado.fecha_inicio,
            permisos_empleado.fecha_fin,
            tipo_permiso.tipo_permiso,
            permisos_empleado.obsservacion 
            FROM
                tipo_permiso
                INNER JOIN permisos_empleado ON tipo_permiso.id_tipo_permiso = permisos_empleado.id_tipo_permiso 
            WHERE
            permisos_empleado.id_empleado = ? 
            ORDER BY permisos_empleado.id_permisos DESC";
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
