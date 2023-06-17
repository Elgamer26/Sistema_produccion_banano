<?php
require_once 'modelo_conexion.php';
class Model_rol_pagos extends modelo_conexion
{
    function traer_datos_empleado_rol_pagos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            empleado.id_empleado,
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos ) AS empleado,
            empleado.sexo,
            empleado.cedula,
            empleado.telefono,
            detalle_actividad_porduccion.actividad,
            detalle_actividad_porduccion.costo,
            CONCAT_WS( ' ', lote.nombre_l, produccion.fecha_inicio, produccion.fecha_fin ) AS fechas_produccion,
            produccion.estado,
            produccion.id_produccion,
            detalle_actividad_porduccion.pago_ac,
            asignacion_actividad.actividad AS estad_ac_em,
            detalle_actividad_porduccion.id_actividad 
            FROM
                produccion
                INNER JOIN detalle_actividad_porduccion ON produccion.id_produccion = detalle_actividad_porduccion.id_produccion
                INNER JOIN asignacion_actividad ON detalle_actividad_porduccion.id_actividad = asignacion_actividad.id_asignacion_actividad
                INNER JOIN empleado ON asignacion_actividad.id_empleado = empleado.id_empleado
                INNER JOIN lote ON produccion.id_lote = lote.id_lote 
            WHERE produccion.estado = 'INICIADO' 
            ORDER BY
            empleado.id_empleado DESC";
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

    function listar_bebficios_rol()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM beneficios_rol WHERE estado = 1";
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

    function traer_data_rol_pagos($id_empleado, $id_producion)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            empleado.id_empleado,
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos ) AS empleado,
            empleado.sexo,
            empleado.cedula,
            empleado.telefono,
            detalle_actividad_porduccion.actividad,
            detalle_actividad_porduccion.costo,
            CONCAT_WS( ' ', 'Lote: [', lote.nombre_l, ' ] - Fecha inicio: [', produccion.fecha_inicio, '] - Fecha fin: [', produccion.fecha_fin, '] - Cod: [', produccion.id_produccion, ']' ) AS fechas_produccion,
            produccion.dias,
            produccion.estado,
            produccion.id_produccion,
            detalle_actividad_porduccion.id_produccion as id_produccion_detalle_act ,
            detalle_actividad_porduccion.pago_ac,
            asignacion_actividad.actividad AS estad_ac_em,
            detalle_actividad_porduccion.id_actividad,
            detalle_actividad_porduccion.costo_hora,
            detalle_actividad_porduccion.hora_trabajo
            FROM
                produccion
                INNER JOIN detalle_actividad_porduccion ON produccion.id_produccion = detalle_actividad_porduccion.id_produccion
                INNER JOIN asignacion_actividad ON detalle_actividad_porduccion.id_actividad = asignacion_actividad.id_asignacion_actividad
                INNER JOIN empleado ON asignacion_actividad.id_empleado = empleado.id_empleado
                INNER JOIN lote ON produccion.id_lote = lote.id_lote 
            WHERE
             produccion.estado = 'INICIADO' 
            AND empleado.id_empleado = ? 
            AND produccion.id_produccion = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id_empleado);
            $query->bindParam(2, $id_producion);
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

    function traer_multas_saciones($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            multas.id_multa,
            multas.fecha_infraccion,
            tipo_sancion.tipo_sancion,
            multas.motivo,
            multas.multa,
            multas.estado_pago 
            FROM
                multas
                INNER JOIN tipo_sancion ON multas.id_tipo_sancion = tipo_sancion.id_tipo_sancion 
            WHERE
            multas.estado_pago = 0 AND multas.id_empleado = ?";
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

    function registrar_rol_de_pagos($id_em, $id_producion, $actividad, $produccion_datos, $fecha_pago, $pago_ac, $dias_prod, $total_ingreso, $total_egreso, $txtneto_pagar, $count_ingreso, $count_egreso)
    {
        try {
            $res = "";
            $id = 0;
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO rol_pagos (id_empleado, actividad, produccion_datos, fecha_pago, pagos_actividad, dias, total_ingreso, total_egreso, neto_pagar, count_ingreso, count_egreso) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id_em);
            $querya->bindParam(2, $actividad);
            $querya->bindParam(3, $produccion_datos);
            $querya->bindParam(4, $fecha_pago);
            $querya->bindParam(5, $pago_ac);
            $querya->bindParam(6, $dias_prod);
            $querya->bindParam(7, $total_ingreso);
            $querya->bindParam(8, $total_egreso);
            $querya->bindParam(9, $txtneto_pagar);
            $querya->bindParam(10, $count_ingreso);
            $querya->bindParam(11, $count_egreso);

            if ($querya->execute()) {
                $id = $c->lastInsertId();

                $sql_p = "UPDATE produccion
                INNER JOIN detalle_actividad_porduccion ON produccion.id_produccion = detalle_actividad_porduccion.id_produccion
                INNER JOIN asignacion_actividad ON detalle_actividad_porduccion.id_actividad = asignacion_actividad.id_asignacion_actividad
                INNER JOIN empleado ON asignacion_actividad.id_empleado = empleado.id_empleado
                INNER JOIN lote ON produccion.id_lote = lote.id_lote 
                SET detalle_actividad_porduccion.pago_ac = 1 
                WHERE
                empleado.id_empleado = ?
                AND produccion.id_produccion = ?";
                $queryp = $c->prepare($sql_p);
                $queryp->bindParam(1, $id_em);
                $queryp->bindParam(2, $id_producion);

                if ($queryp->execute()) {
                    $res = $id;
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

    function registrar_detalle_ingreso($id, $arraglo_nombre, $arraglo_cantidad)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detalle_rol_pago_ingreso (id_rol_pagos, nombre, cantidad) VALUES (?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_nombre);
            $querya->bindParam(3, $arraglo_cantidad);

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

    function registrar_detalle_egreso($id, $arraglo_nombre, $arraglo_cantidad)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detalle_rol_pago_egreso (id_rol_pagos, nombre, cantidad) VALUES (?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_nombre);
            $querya->bindParam(3, $arraglo_cantidad);

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

    function pagar_multa_sancion($id, $arraglo_id_multa)
    {
        date_default_timezone_set('America/Guayaquil');
        $fecha = date("Y-m-d H:i:s");
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE multas SET estado_pago = 1, fecha_paga_multa = ? WHERE id_empleado = ? AND id_multa = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $fecha);
            $querya->bindParam(2, $id);
            $querya->bindParam(3, $arraglo_id_multa);

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

    function listar_rol_pagos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            rol_pagos.id_rol_pagos,
            CONCAT_WS( ' ', ' Nombres: [', empleado.nombres, empleado.apellidos, '] -  Cedula: [', empleado.cedula, ']- Sexo: [', empleado.sexo, ']' ) AS empleado,
            rol_pagos.actividad,
            rol_pagos.produccion_datos,
            rol_pagos.fecha_pago,
            rol_pagos.pagos_actividad,
            rol_pagos.dias,
            rol_pagos.total_ingreso,
            rol_pagos.total_egreso,
            rol_pagos.neto_pagar
            FROM
            rol_pagos
            INNER JOIN empleado ON rol_pagos.id_empleado = empleado.id_empleado";
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

    function listar_empleado_rol_pagos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            rol_pagos.id_empleado,
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos ) AS empleado,
            empleado.cedula,
                empleado.sexo 
            FROM
                rol_pagos
                INNER JOIN empleado ON rol_pagos.id_empleado = empleado.id_empleado 
            GROUP BY
                rol_pagos.id_empleado 
            ORDER BY
            rol_pagos.id_empleado DESC";
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

    function traer_asistecnis_empleado($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            asistencia.id_asistencia,
            asistencia.id_empleado,
            DATE(asistencia.fecha_hora_ingreso) AS fecha, 
            TIME(asistencia.fecha_hora_ingreso) as hor_ingreso,
            TIME(asistencia.fecha_hora_salida) as hor_salida,
            asistencia.estado_asistencia,
            asistencia.asitencia_pagado 
        FROM
            asistencia 
        WHERE
            asistencia.estado_asistencia = 0 
            AND asistencia.asitencia_pagado = 1 
            AND asistencia.id_empleado = ?";
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

    function sacra_asistencias($id, $arraglo_idasistencia)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE asistencia SET asitencia_pagado = 0 WHERE id_empleado = ? AND id_asistencia = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_idasistencia); 

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
