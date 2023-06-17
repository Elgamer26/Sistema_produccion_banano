<?php
require_once 'modelo_conexion.php';
class Modelo_produccion extends modelo_conexion
{

    function listar_lotes_select()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM lote WHERE estado = 1";
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

    function listar_hectarea($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM detalle_lote WHERE id_lote = ? AND ocupado = 1";
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
            // modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            // modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function listar_tipo_ctividad()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_actividad WHERE estado = 1";
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

    function listar_empleado($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            asignacion_actividad.id_asignacion_actividad,
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos, empleado.sexo ) AS empleado,
            asignacion_actividad.id_tipo_actividad,
            asignacion_actividad.estado,
            empleado.estado 
            FROM
                empleado
                INNER JOIN asignacion_actividad ON empleado.id_empleado = asignacion_actividad.id_empleado
                INNER JOIN tipo_actividad ON asignacion_actividad.id_tipo_actividad = tipo_actividad.id_tipo_actividad 
            WHERE
            asignacion_actividad.estado = 1 
            AND empleado.estado = 1 AND asignacion_actividad.actividad = 1
            AND asignacion_actividad.id_tipo_actividad = ?";
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

    function costro_actividad($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT costo_actividad  
            FROM
            asignacion_actividad 
            WHERE
            id_asignacion_actividad = ?";
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

    function listar_material()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            material.id_material,
            material.nombre,
            material.marca,
            tipo_material.tipo_material 
            FROM
                material
                INNER JOIN tipo_material ON material.id_tipo = tipo_material.id_tipo_material 
            WHERE
            eliminado = 1 
            AND estado = 'ACTIVO' ";
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

    function dato_material($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            material.stock_m, 
            material.precio
             FROM
            material WHERE material.id_material = ?";
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

    function listar_insumos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            insumos.id_insumo,
            insumos.nombre_i,
            insumos.marca_i,
            tipo_insumo.tipo_insumo 
            FROM
                tipo_insumo
                INNER JOIN insumos ON tipo_insumo.id_tipo_insumo = insumos.id_tipo_insumo 
            WHERE
            insumos.eliminado = 1 
            AND insumos.estado = 'ACTIVO'";
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

    function dato_insumos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            insumos.precio_c,
            insumos.cantidad,
            medida.nombre_m,
            medida.simbolo_m,
            insumos.stock_m 
            FROM
            insumos
            INNER JOIN medida ON insumos.id_medida = medida.id_medida 
            WHERE insumos.id_insumo = ?";
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

    function crear_produccion($fecha_inicio, $fecha_fin, $dias_dias, $lote_id, $nombre_produccion, $hectarea_id, $hectarea_no)
    {
        try {
            $res = "";
            $id = 0;
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO produccion (id_lote, fecha_inicio, fecha_fin, dias, nombre_prod, id_hectarea, hectarea, estado) VALUES (?,?,?,?,?,?,?,'INICIADO')";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $lote_id);
            $querya->bindParam(2, $fecha_inicio);
            $querya->bindParam(3, $fecha_fin);
            $querya->bindParam(4, $dias_dias);
            $querya->bindParam(5, $nombre_produccion);
            $querya->bindParam(6, $hectarea_id);
            $querya->bindParam(7, $hectarea_no);

            if ($querya->execute()) {
                $id = $c->lastInsertId();
                $sql_b = "UPDATE detalle_lote SET ocupado = 0, id_produccion = ? WHERE id_detalle_lote = ?";
                $querya_b = $c->prepare($sql_b);
                $querya_b->bindParam(1, $id);
                $querya_b->bindParam(2, $hectarea_id);

                if ($querya_b->execute()) {
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

    function registrar_detalle_actividad($id, $arraglo_id_act, $arraglo_actividad, $arraglo_costo, $arraglo_hora, $arraglo_costo_hora)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detalle_actividad_porduccion (id_produccion, id_actividad, actividad, costo, hora_trabajo, costo_hora) VALUES (?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_id_act);
            $querya->bindParam(3, $arraglo_actividad);
            $querya->bindParam(4, $arraglo_costo);

            $querya->bindParam(5, $arraglo_hora);
            $querya->bindParam(6, $arraglo_costo_hora);

            if ($querya->execute()) {

                $sql_i = "UPDATE asignacion_actividad SET actividad = 0 WHERE id_asignacion_actividad = ?";
                $query_i = $c->prepare($sql_i);
                $query_i->bindParam(1, $arraglo_id_act);

                if ($query_i->execute()) {
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

    function registrar_detalle_material($id, $arraglo_id_materila, $arraglo_costo, $arraglo_cantidad)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detalle_material_produccion (id_produccion, id_material, cantidad, costo) VALUES (?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_id_materila);
            $querya->bindParam(3, $arraglo_cantidad);
            $querya->bindParam(4, $arraglo_costo);

            if ($querya->execute()) {

                $sql_p = "SELECT stock_m FROM material where id_material = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_id_materila);
                $query_p->execute();
                $data = $query_p->fetch(PDO::FETCH_BOTH);
                $arreglo = array();
                foreach ($data as $respuesta) {
                    $arreglo[] = $respuesta;
                }

                $stock = $arreglo[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }
                $stock = $stock - $arraglo_cantidad;

                $sql_m = "UPDATE material SET stock_m = ? where id_material = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_id_materila);
                if ($query_m->execute()) {
                    $res = 1;
                } else {
                    $res = 0; // error de update
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

    function registrar_detalle_insumo($id, $arraglo_id_insumo, $arraglo_costo, $arraglo_medi_cant, $arraglo_medida, $arraglo_cantidad)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detalle_insumos_produccion (id_produccion, id_insumos, costo, medida_cantida, medida, cantidad) VALUES (?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_id_insumo);
            $querya->bindParam(3, $arraglo_costo);
            $querya->bindParam(4, $arraglo_medi_cant);
            $querya->bindParam(5, $arraglo_medida);
            $querya->bindParam(6, $arraglo_cantidad);

            if ($querya->execute()) {

                $sql_p = "SELECT stock_m FROM insumos where id_insumo = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_id_insumo);
                $query_p->execute();
                $data = $query_p->fetch(PDO::FETCH_BOTH);
                $arreglo = array();
                foreach ($data as $respuesta) {
                    $arreglo[] = $respuesta;
                }

                $stock = $arreglo[0];
                if ($stock == "" || $stock == 0) {
                    $stock = 0;
                }
                $stock = $stock - $arraglo_cantidad;

                $sql_m = "UPDATE insumos SET stock_m = ? where id_insumo = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_id_insumo);
                if ($query_m->execute()) {
                    $res = 1;
                } else {
                    $res = 0; // error de update
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

    function lisrado_produccion()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            produccion.id_produccion,
            produccion.nombre_prod,
            lote.nombre_l,
            lote.hectarea,
            produccion.fecha_inicio,
            produccion.fecha_fin,
            produccion.dias,
            produccion.estado,
            produccion.eliminar,
            produccion.hectarea,
            produccion.id_hectarea,
            produccion.porcentaje
            FROM
                produccion
                INNER JOIN lote ON produccion.id_lote = lote.id_lote 
            WHERE
            produccion.eliminar = 1 ORDER BY produccion.id_produccion DESC";
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

    function cargar_detalle_acntividades($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            detalle_actividad_porduccion.id_produccion,
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos, empleado.sexo ) AS empleado,
            detalle_actividad_porduccion.actividad,
            detalle_actividad_porduccion.costo 
            FROM
                asignacion_actividad
                INNER JOIN detalle_actividad_porduccion ON asignacion_actividad.id_asignacion_actividad = detalle_actividad_porduccion.id_actividad
                INNER JOIN empleado ON asignacion_actividad.id_empleado = empleado.id_empleado 
            WHERE
            detalle_actividad_porduccion.id_produccion = ?";
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

    function cargar_detalle_material($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            detalle_material_produccion.id_produccion,
            CONCAT_WS( ' ', material.nombre, material.marca, tipo_material.tipo_material ) AS material,
            detalle_material_produccion.cantidad,
            detalle_material_produccion.costo 
        FROM
            detalle_material_produccion
            INNER JOIN material ON detalle_material_produccion.id_material = material.id_material
            INNER JOIN tipo_material ON material.id_tipo = tipo_material.id_tipo_material WHERE detalle_material_produccion.id_produccion = ?";
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

    function cargar_detalle_insumoos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            detalle_insumos_produccion.id_produccion,
            CONCAT_WS( ' ', insumos.nombre_i, insumos.marca_i, tipo_insumo.tipo_insumo ) AS insumo,
            detalle_insumos_produccion.costo,
            detalle_insumos_produccion.medida_cantida,
            detalle_insumos_produccion.medida,
                detalle_insumos_produccion.cantidad 
            FROM
                detalle_insumos_produccion
                INNER JOIN insumos ON detalle_insumos_produccion.id_insumos = insumos.id_insumo
                INNER JOIN tipo_insumo ON insumos.id_tipo_insumo = tipo_insumo.id_tipo_insumo 
            WHERE
            detalle_insumos_produccion.id_produccion = ?";
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

    function cargar_detalle_racimos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT 
            rasimos_produccion.fecha_ra, 
            rasimos_produccion.cantidad, 
            rasimos_produccion.tipo, 
            rasimos_produccion.estado, 
            rasimos_produccion.bandera, 
            rasimos_produccion.id_produccion, 
            rasimos_produccion.id_detalle_produccion_racimos
            FROM
            rasimos_produccion WHERE rasimos_produccion.estado = 1 AND rasimos_produccion.id_produccion = ?";
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

    function cargar_detalle_rechasos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            rechasos_produccion.id_produccion, 
            rechasos_produccion.fecha_re, 
            rechasos_produccion.cantidad_re, 
            rechasos_produccion.tipo_re, 
            rechasos_produccion.estado_re, 
            rechasos_produccion.bandera_re
        FROM
            rechasos_produccion WHERE rechasos_produccion.estado_re = 1 AND rechasos_produccion.id_produccion = ?";
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

    function cargar_detalle_novedad($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            novedad_produccion.id_produccion, 
            novedad_produccion.fecha, 
            novedad.nombre, 
            novedad.descipcion, 
            novedad_produccion.costo
            FROM
            novedad_produccion
            INNER JOIN
            novedad
            ON 
                novedad_produccion.id_novedad = novedad.id_novedad WHERE novedad_produccion.id_produccion = ?";
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

    function cancelar_produccion($id, $id_hec)
    {
        try {
            $stock = "";
            $stock_i = "";
            $res = "";
            $c = modelo_conexion::conexionPDO();
            //////////////////////
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

                    $sql_aaa = "UPDATE detalle_actividad_porduccion SET estado_ac = 0 WHERE id_actividad = ?";
                    $query_aaa = $c->prepare($sql_aaa);
                    $query_aaa->bindParam(1, $respuesta_a[0]);
                    if ($query_aaa->execute()) {

                        $sql_h = "UPDATE detalle_lote SET id_produccion = 0, ocupado = 1 WHERE id_detalle_lote = {$id_hec}";
                        $query_h = $c->prepare($sql_h);
                        if ($query_h->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
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

                            $sql_me = "UPDATE detalle_material_produccion SET estado_ma = 0 where id_produccion = ?";
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

                            $sql_ie = "UPDATE detalle_insumos_produccion SET estado = 0 where id_produccion = ?";
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

                $sql_e = "UPDATE produccion SET estado = 'CANCELADO' where id_produccion = ?";
                $query_e = $c->prepare($sql_e);
                $query_e->bindParam(1, $id);
                if ($query_e->execute()) {
                    $res = 1;
                } else {
                    $res = 0; // error de update

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

    function finalizar_produccion_($id)
    {
        try {
            $stock = "";
            $stock_i = "";
            $res = "";
            $c = modelo_conexion::conexionPDO();
            //////////////////////
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

                    $res = 1;
                } else {
                    $res = 0; // error de update

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

    function listar_reporte_produccion()
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
            produccion.eliminar 
            FROM
                produccion
                INNER JOIN lote ON produccion.id_lote = lote.id_lote 
            WHERE
            produccion.eliminar = 1 
            AND produccion.estado != 'CANCELADO'";
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

    function guardar_pocetaje($id, $pocentaje_, $id_h_)
    {
        try {
            $stock = "";
            $stock_i = "";
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_p = "UPDATE produccion SET porcentaje = ? WHERE id_produccion = ?";
            $query_p = $c->prepare($sql_p);
            $query_p->bindParam(1, $pocentaje_);
            $query_p->bindParam(2, $id);

            if ($query_p->execute()) {

                $sql_act = "SELECT porcentaje FROM produccion where id_produccion = ?";
                $query_act = $c->prepare($sql_act);
                $query_act->bindParam(1, $id);
                $query_act->execute();
                $result_act = $query_act->fetch(PDO::FETCH_BOTH);

                if ($result_act[0] >= "100") {

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

                            $sql_h = "UPDATE detalle_lote SET id_produccion = 0, ocupado = 1 WHERE id_detalle_lote = {$id_h_}";
                            $query_h = $c->prepare($sql_h);
                            if ($query_h->execute()) {
                                $res = 1;
                            } else {
                                $res = 0;
                            }
                        } else {
                            $res = 0; // error de update

                        }
                    }
                } else {
                    $res = 1;
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
}
