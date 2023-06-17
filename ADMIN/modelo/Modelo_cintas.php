<?php
require_once 'modelo_conexion.php';
class Modelo_cintas extends modelo_conexion
{

    function listado_tipos_cintas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT  * FROM tipo_cinta ORDER BY id_tipo_cinta DESC";
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

    function editar_color($id, $color)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE tipo_cinta SET color = ? WHERE id_tipo_cinta = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $color);
            $querya->bindParam(2, $id);

            if ($querya->execute()) {
                $res = 1;
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

    function traer_cintas_semanas($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT COUNT(*) FROM cintas WHERE id_produccion = ?";
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

    function obtener_id_hectarea($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT id_hectarea FROM produccion WHERE id_produccion = ?";
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

    function registra_cintass($id, $semana, $fecha, $detalle, $id_h)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            if ($semana == 11) {

                $sql_a = "SELECT id_actividad FROM detalle_actividad_porduccion where id_produccion = ?";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $id);
                $query_a->execute();
                $result_a = $query_a->fetchAll(PDO::FETCH_BOTH);
                foreach ($result_a as $respuesta_a) {

                    $sql_aa = "UPDATE asignacion_actividad SET actividad = 1 WHERE id_asignacion_actividad = ?";
                    $query_aa = $c->prepare($sql_aa);
                    $query_aa->bindParam(1, $respuesta_a[0]);
                    if ($query_aa->execute()) {

                        $sql_aaa = "UPDATE detalle_actividad_porduccion SET estado_ac = 1 WHERE id_actividad = ?";
                        $query_aaa = $c->prepare($sql_aaa);
                        $query_aaa->bindParam(1, $respuesta_a[0]);
                        if ($query_aaa->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 0;
                    }
                }

                if ($res == 1) {
                    $sql_md = "SELECT id_material, cantidad FROM detalle_material_produccion where id_produccion = ?";
                    $query_md = $c->prepare($sql_md);
                    $query_md->bindParam(1, $id);
                    $query_md->execute();
                    $result_md = $query_md->fetchAll(PDO::FETCH_BOTH);
                    foreach ($result_md as $respuesta_md) {

                        $sql_m = "SELECT stock_m FROM material where id_material = ?";
                        $query_m = $c->prepare($sql_m);
                        $query_m->bindParam(1, $respuesta_md[0]);
                        $query_m->execute();
                        $data_m = $query_m->fetch(PDO::FETCH_BOTH);
                        foreach ($data_m as $respuesta_m) {

                            $stock =  $respuesta_md[1] + $respuesta_m;

                            $sql_ms = "UPDATE material SET stock_m = ?, estado = 'ACTIVO' where id_material = ?";
                            $query_ms = $c->prepare($sql_ms);
                            $query_ms->bindParam(1, $stock);
                            $query_ms->bindParam(2, $respuesta_md[0]);
                            if ($query_ms->execute()) {

                                $sql_me = "UPDATE detalle_material_produccion SET estado_ma = 1 where id_produccion = ?";
                                $query_me = $c->prepare($sql_me);
                                $query_me->bindParam(1, $id);
                                if ($query_me->execute()) {
                                    $res = 1;
                                } else {
                                    $res = 0; // error de update
                                }
                            } else {
                                $res = 0; // error de update
                            }
                        }
                    }
                }

                if ($res == 1) {

                    $sql_id = "SELECT id_insumos, cantidad FROM detalle_insumos_produccion where id_produccion = ?";
                    $query_mid = $c->prepare($sql_id);
                    $query_mid->bindParam(1, $id);
                    $query_mid->execute();
                    $result_id = $query_mid->fetchAll(PDO::FETCH_BOTH);
                    foreach ($result_id as $respuesta_id) {

                        $sql_i = "SELECT stock_m FROM insumos where id_insumo = ?";
                        $query_i = $c->prepare($sql_i);
                        $query_i->bindParam(1, $respuesta_id[0]);
                        $query_i->execute();
                        $data_i = $query_i->fetch(PDO::FETCH_BOTH);
                        foreach ($data_i as $respuesta_i) {

                            $stock_i =  $respuesta_id[1] + $respuesta_i;

                            $sql_is = "UPDATE insumos SET stock_m = ?, estado = 'ACTIVO' where id_insumo = ?";
                            $query_is = $c->prepare($sql_is);
                            $query_is->bindParam(1, $stock_i);
                            $query_is->bindParam(2, $respuesta_id[0]);
                            if ($query_is->execute()) {

                                $sql_ie = "UPDATE detalle_insumos_produccion SET estado = 1 where id_produccion = ?";
                                $query_ie = $c->prepare($sql_ie);
                                $query_ie->bindParam(1, $id);
                                if ($query_ie->execute()) {
                                    $res = 1;
                                } else {
                                    $res = 0; // error de update
                                }
                            } else {
                                $res = 0; // error de update
                            }
                        }
                    }
                }

                if ($res == 1) {

                    $sql_e = "UPDATE produccion SET estado = 'FINALIZADO' where id_produccion = ?";
                    $query_e = $c->prepare($sql_e);
                    $query_e->bindParam(1, $id);
                    if ($query_e->execute()) {

                        $sql_h = "UPDATE detalle_lote SET id_produccion = 0, ocupado = 1 WHERE id_detalle_lote = {$id_h}";
                        $query_h = $c->prepare($sql_h);
                        if ($query_h->execute()) {
                            $res = 10;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 0; // error de update

                    }
                }

            } else {
                $sql_a = "INSERT INTO cintas (id_produccion, id_tipo_cinta, fecha, detalle) VALUES (?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $id);
                $querya->bindParam(2, $semana);
                $querya->bindParam(3, $fecha);
                $querya->bindParam(4, $detalle);

                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 2;
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

    function traer_detalle_cintas($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            cintas.id_cintas, 
            cintas.id_produccion, 
            cintas.id_tipo_cinta, 
            tipo_cinta.semana, 
            tipo_cinta.color, 
            cintas.fecha, 
            cintas.detalle, 
            cintas.estado
            FROM
            cintas
            INNER JOIN
            tipo_cinta
            ON 
                cintas.id_tipo_cinta = tipo_cinta.id_tipo_cinta where cintas.id_produccion = ?";
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

    function eliminar_detalle($id, $idpro)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "DELETE FROM cintas WHERE id_cintas = ? AND id_produccion = ? ";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $idpro);

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
