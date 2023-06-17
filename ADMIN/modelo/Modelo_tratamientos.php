<?php
require_once 'modelo_conexion.php';
class Modelo_tratamientos extends modelo_conexion
{

    function listar_produccion_plagada()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            control_plagas.id_control_plagas,
            CONCAT_WS( ' ', ' Nombre produccion: [',produccion.nombre_prod, '] -  Lote: [', lote.nombre_l, '] -  Hectarea: [', produccion.hectarea, '] - Fecha plaga: [', control_plagas.fecha, '] - Tipo plaga: [', tipo_plaga.tipo_plaga, ']' ) as plaga, control_plagas.estado,
            control_plagas.control_plaga 
            FROM
                control_plagas
                INNER JOIN produccion ON control_plagas.id_produccion = produccion.id_produccion
                INNER JOIN lote ON produccion.id_lote = lote.id_lote
                INNER JOIN tipo_plaga ON control_plagas.id_tipo_plaga = tipo_plaga.id_tipo_plaga 
            WHERE
            control_plagas.estado = 1 
            AND control_plagas.control_plaga = 0";
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

    function listar_tipo_tratamiento()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            * 
            FROM
                tipo_tratamiento 
            WHERE
            estado = 1";
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

    function listar_tipo_quimico()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            * 
            FROM
            tipo_quimico 
            WHERE
            estado_q = 1";
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

    function registrar_tratamiento($prodcuciion_id, $tipo_tratamiento, $obsrvacion, $fecha_inii, $fecha_fini, $dias, $tipo_quimico, $cantida_litros)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "INSERT INTO tratamiento_plagas (id_plaga, id_tipo_tratamiento, observacion, id_tipo_quimico, fecha_ini, fecha_fin, dias_, cantidad_litro) VALUES (?,?,?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $prodcuciion_id);
            $querya->bindParam(2, $tipo_tratamiento);
            $querya->bindParam(3, $obsrvacion);

            $querya->bindParam(4, $tipo_quimico);
            $querya->bindParam(5, $fecha_inii);
            $querya->bindParam(6, $fecha_fini);

            $querya->bindParam(7, $dias);
            $querya->bindParam(8, $cantida_litros);

            if ($querya->execute()) {

                $sql_U = "UPDATE control_plagas SET control_plaga = 1 WHERE id_control_plagas = ?";
                $queryU = $c->prepare($sql_U);
                $queryU->bindParam(1, $prodcuciion_id);

                if ($queryU->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
                }
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
}
