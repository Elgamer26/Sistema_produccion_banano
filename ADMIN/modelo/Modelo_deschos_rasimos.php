<?php
require_once 'modelo_conexion.php';
class Modelo_deschos_rasimos extends modelo_conexion
{
    function listas_lotes_cosechas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            produccion.id_produccion, 
            lote.nombre_l, 
            produccion.fecha_inicio, 
            produccion.fecha_fin, 
            produccion.dias, 
            produccion.estado, 
            produccion.eliminar,
            produccion.nombre_prod,
            lote.hectarea,
            produccion.hectarea as hhh
            FROM
                produccion
                INNER JOIN
                lote
                ON 
                    produccion.id_lote = lote.id_lote
            WHERE
            produccion.eliminar = 1 AND
            produccion.estado = 'INICIADO'";
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

    function traer_fechas($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            produccion.fecha_inicio, 
            produccion.fecha_fin
            FROM
            produccion WHERE produccion.id_produccion  = ?";
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

    function registrar_deschos_csechas($prodcuciion_id, $fecha_ras_des, $numero_ra, $tipo_ses, $cjas_oblig, $peso_cajas)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            if ($tipo_ses == 'Racimos') {
                $sql_r = "INSERT INTO rasimos_produccion (id_produccion, fecha_ra, cantidad, tipo, cajas, peso, bandera) VALUES (?,?,?,?,?,?,'INGRESADO')";
                $queryr = $c->prepare($sql_r);
                $queryr->bindParam(1, $prodcuciion_id);
                $queryr->bindParam(2, $fecha_ras_des);
                $queryr->bindParam(3, $numero_ra);
                $queryr->bindParam(4, $tipo_ses);
                $queryr->bindParam(5, $cjas_oblig);
                $queryr->bindParam(6, $peso_cajas);

                if ($queryr->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            } else {
                $sql_d = "INSERT INTO rechasos_produccion (id_produccion, fecha_re, cantidad_re, tipo_re, bandera_re) VALUES (?,?,?,?,'INGRESADO')";
                $queryd = $c->prepare($sql_d);
                $queryd->bindParam(1, $prodcuciion_id);
                $queryd->bindParam(2, $fecha_ras_des);
                $queryd->bindParam(3, $numero_ra);
                $queryd->bindParam(4, $tipo_ses);
                if ($queryd->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
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

    ///
    function listar_racimos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            rasimos_produccion.id_detalle_produccion_racimos,
            CONCAT_WS(
                ' ',
                '[ Nombre produ.: ',
                produccion.nombre_prod,
                ']',
                '[ Nombre lote: ',
                lote.nombre_l,
                ']',
                '[ Fecha inicio: ',
                produccion.fecha_inicio,
                ']',
                '[ Fecha fin: ',
                produccion.fecha_fin,
                ']' 
            ) AS produccion,
            rasimos_produccion.fecha_ra,
            rasimos_produccion.cantidad,
            rasimos_produccion.tipo,
            rasimos_produccion.estado,
            rasimos_produccion.bandera,
            rasimos_produccion.cajas,
            rasimos_produccion.peso
            FROM
                produccion
                INNER JOIN rasimos_produccion ON produccion.id_produccion = rasimos_produccion.id_produccion
                INNER JOIN lote ON produccion.id_lote = lote.id_lote 
            WHERE
            rasimos_produccion.estado = 1";
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

    function cambiar_estado_racimos($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_r = "UPDATE rasimos_produccion SET estado = ? WHERE id_detalle_produccion_racimos = ?";
            $queryr = $c->prepare($sql_r);
            $queryr->bindParam(1, $dato);
            $queryr->bindParam(2, $id);
            if ($queryr->execute()) {
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

    ///
    function listar_deschos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            rechasos_produccion.id_detalle_produccion_rechasos,
            CONCAT_WS(
                ' ',
                '[ Nombre produ.: ',
                produccion.nombre_prod,
                ']',
                '[ Nombre lote: ',
                lote.nombre_l,
                ']',
                '[ Fecha inicio: ',
                produccion.fecha_inicio,
                ']',
                '[ Fecha fin: ',
                produccion.fecha_fin,
                ']' 
            ) AS produccion,
            rechasos_produccion.fecha_re,
            rechasos_produccion.cantidad_re,
            rechasos_produccion.tipo_re,
            rechasos_produccion.estado_re,
            rechasos_produccion.bandera_re 
            FROM
                produccion
                INNER JOIN rechasos_produccion ON produccion.id_produccion = rechasos_produccion.id_produccion
                INNER JOIN lote ON produccion.id_lote = lote.id_lote 
            WHERE
            rechasos_produccion.estado_re = 1";
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

    function cambiar_estado_desechos($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_r = "UPDATE rechasos_produccion SET estado_re = ? WHERE id_detalle_produccion_rechasos = ?";
            $queryr = $c->prepare($sql_r);
            $queryr->bindParam(1, $dato);
            $queryr->bindParam(2, $id);
            if ($queryr->execute()) {
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
