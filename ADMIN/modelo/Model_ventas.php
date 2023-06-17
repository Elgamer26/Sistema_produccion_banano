<?php
require_once 'modelo_conexion.php';
class Model_ventas extends modelo_conexion
{
    function listar_clientes()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT *
            FROM
            cliente 
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

    function listar_racimos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            rasimos_produccion.id_detalle_produccion_racimos,
            lote.nombre_l,
            rasimos_produccion.fecha_ra,
            rasimos_produccion.cantidad,
            rasimos_produccion.tipo,
            rasimos_produccion.estado,
            rasimos_produccion.bandera,
            produccion.nombre_prod
            FROM
                rasimos_produccion
                INNER JOIN produccion ON rasimos_produccion.id_produccion = produccion.id_produccion
                INNER JOIN lote ON produccion.id_lote = lote.id_lote 
            WHERE
            rasimos_produccion.estado = 1 
            AND rasimos_produccion.bandera = 'INGRESADO'";
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

    function traer_datos_racimos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            rasimos_produccion.cantidad,
            rasimos_produccion.tipo,
            rasimos_produccion.cajas,
            rasimos_produccion.peso
            FROM
                rasimos_produccion
                INNER JOIN produccion ON rasimos_produccion.id_produccion = produccion.id_produccion
                INNER JOIN lote ON produccion.id_lote = lote.id_lote 
            WHERE
                 rasimos_produccion.id_detalle_produccion_racimos = ?";
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

    function registrar_venta($clientes, $numero_compra, $comprobante_tipo, $impuesto, $fecha_compra, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $count)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM venta_racimos where num_venta = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $numero_compra);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO venta_racimos (id_cliente, num_venta, tipo_comprobante, impuesto, fecha_venta, sub_total, sub_iva, total, countt) VALUES (?,?,?,?,?,?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $clientes);
                $querya->bindParam(2, $numero_compra);
                $querya->bindParam(3, $comprobante_tipo);
                $querya->bindParam(4, $impuesto);
                $querya->bindParam(5, $fecha_compra);
                $querya->bindParam(6, $txt_totalneto);
                $querya->bindParam(7, $txt_impuesto);
                $querya->bindParam(8, $txt_a_pagar);
                $querya->bindParam(9, $count);

                if ($querya->execute()) {
                    $res = $c->lastInsertId();
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

    function registrar_detalle_venta_racimos($id, $arraglo_idpr, $arraglo_tipo, $arraglo_cantidad, $arraglo_precio, $arraglo_des, $arraglo_sutotal,$arraglo_peso)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detall_venta_racimos (id_venta_racimos, id_detalle_racimos, tipo, cantidad, precio, descuento, subtotal, peso) VALUES (?,?,?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_idpr);
            $querya->bindParam(3, $arraglo_tipo);
            $querya->bindParam(4, $arraglo_cantidad);
            $querya->bindParam(5, $arraglo_precio);
            $querya->bindParam(6, $arraglo_des);
            $querya->bindParam(7, $arraglo_sutotal);
            $querya->bindParam(8, $arraglo_peso);

            if ($querya->execute()) {

                $sql_p = "SELECT cajas FROM rasimos_produccion where id_detalle_produccion_racimos = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_idpr);
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

                $sql_m = "UPDATE rasimos_produccion SET cajas = ? where id_detalle_produccion_racimos = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_idpr);
                if ($query_m->execute()) {

                    $sql_e = "SELECT cajas FROM rasimos_produccion where id_detalle_produccion_racimos = ?";
                    $query_e = $c->prepare($sql_e);
                    $query_e->bindParam(1, $arraglo_idpr);
                    $query_e->execute();
                    $data_e = $query_e->fetch(PDO::FETCH_BOTH);
                    $arreglo_e = array();
                    foreach ($data_e as $respuesta_e) {
                        $arreglo_e[] = $respuesta_e;
                    }

                    $stock_e = $arreglo_e[0];
                    if ($stock_e == 0 || $stock_e <= 0) {
                        $sql_a = "UPDATE rasimos_produccion SET bandera = 'AGOTADO' where id_detalle_produccion_racimos = ?";
                        $query_a = $c->prepare($sql_a);
                        $query_a->bindParam(1, $arraglo_idpr);
                        if ($query_a->execute()) {
                            $res = 1;
                        }
                    }
                    $res = 1;
                } else {
                    $res = 0; // error de update
                }

                // $res = 1;
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

    function listar_ventas_racimos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            venta_racimos.id_venta_racimos,
            CONCAT_WS(' ',cliente.nombres,
            cliente.apellidos,
            cliente.cedula) as cliente,            
            venta_racimos.num_venta,
            venta_racimos.tipo_comprobante,
            venta_racimos.impuesto,
            venta_racimos.fecha_venta,
            venta_racimos.sub_total,
            venta_racimos.sub_iva,
            venta_racimos.total,
            venta_racimos.countt,
            venta_racimos.estado 
            FROM
            venta_racimos
            INNER JOIN cliente ON venta_racimos.id_cliente = cliente.id_cliente ORDER BY venta_racimos.id_venta_racimos DESC";
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

    function detalle_de_venta_racimos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            detall_venta_racimos.id_detalle_venta_racimos,
            lote.nombre_l,
            rasimos_produccion.fecha_ra,
            detall_venta_racimos.tipo,
            detall_venta_racimos.cantidad,
            detall_venta_racimos.precio,
            detall_venta_racimos.descuento,
            detall_venta_racimos.subtotal,
            detall_venta_racimos.estado,
            produccion.nombre_prod
        FROM
            detall_venta_racimos
            INNER JOIN rasimos_produccion ON detall_venta_racimos.id_detalle_racimos = rasimos_produccion.id_detalle_produccion_racimos
            INNER JOIN produccion ON rasimos_produccion.id_produccion = produccion.id_produccion
            INNER JOIN lote ON produccion.id_lote = lote.id_lote WHERE detall_venta_racimos.id_venta_racimos = ?";
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

    function anular_venta_racimos($id)
    {
        try {
            $res = "";
            $stock = 0;
            $c = modelo_conexion::conexionPDO();

            $sql_c = "SELECT * FROM detall_venta_racimos WHERE id_venta_racimos = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->execute();
            $data = $query_c->fetchAll(PDO::FETCH_BOTH);
            foreach ($data as $respuesta) {

                $sql_a = "SELECT * FROM rasimos_produccion WHERE id_detalle_produccion_racimos = ?";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $respuesta[2]);
                $query_a->execute();
                $dato = $query_a->fetchAll(PDO::FETCH_BOTH);
                foreach ($dato as $respuesto) {

                    $stock =  $respuesto[3] + $respuesta[4];

                    $sql_p = "UPDATE rasimos_produccion SET cantidad = ?, bandera = 'INGRESADO' where id_detalle_produccion_racimos = ?";
                    $query_p = $c->prepare($sql_p);
                    $query_p->bindParam(1, $stock);
                    $query_p->bindParam(2, $respuesta[2]);

                    if ($query_p->execute()) {
                        $sql_d = "UPDATE detall_venta_racimos SET estado = 0 where id_venta_racimos = ?";
                        $query_d = $c->prepare($sql_d);
                        $query_d->bindParam(1, $id);
                        $query_d->execute();
                    }
                }
            }

            $sql_F = "UPDATE venta_racimos SET estado = 0 WHERE id_venta_racimos = ?";
            $query_F = $c->prepare($sql_F);
            $query_F->bindParam(1, $id);
            if ($query_F->execute()) {
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

    function listar_desechos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            rechasos_produccion.id_detalle_produccion_rechasos,
            lote.nombre_l,
            rechasos_produccion.fecha_re,
            rechasos_produccion.estado_re,
            rechasos_produccion.bandera_re,
            produccion.nombre_prod
            FROM
                rechasos_produccion
                INNER JOIN produccion ON rechasos_produccion.id_produccion = produccion.id_produccion
                INNER JOIN lote ON produccion.id_lote = lote.id_lote 
            WHERE
            rechasos_produccion.estado_re = 1 
            AND rechasos_produccion.bandera_re = 'INGRESADO'";
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

    function traer_datos_desechos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT 
            rechasos_produccion.cantidad_re, 
            rechasos_produccion.tipo_re
            FROM
                rechasos_produccion
            WHERE
            rechasos_produccion.id_detalle_produccion_rechasos = ?";
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

    function registrar_venta_desechos($clientes, $numero_compra, $comprobante_tipo, $impuesto, $fecha_compra, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $count)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM venta_desechos where num_venta = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $numero_compra);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO venta_desechos (id_cliente, num_venta, tipo_comprobante, impuesto, fecha_venta, sub_total, sub_iva, total, countt) VALUES (?,?,?,?,?,?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $clientes);
                $querya->bindParam(2, $numero_compra);
                $querya->bindParam(3, $comprobante_tipo);
                $querya->bindParam(4, $impuesto);
                $querya->bindParam(5, $fecha_compra);
                $querya->bindParam(6, $txt_totalneto);
                $querya->bindParam(7, $txt_impuesto);
                $querya->bindParam(8, $txt_a_pagar);
                $querya->bindParam(9, $count);

                if ($querya->execute()) {
                    $res = $c->lastInsertId();
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

    function registrar_detalle_venta_desechos($id, $arraglo_idde, $arraglo_tipo, $arraglo_cantidad, $arraglo_precio, $arraglo_des, $arraglo_sutotal)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detall_venta_desechos (id_venta_desechos, id_detalle_desechos, tipo, cantidad, precio, descuento, subtotal) VALUES (?,?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_idde);
            $querya->bindParam(3, $arraglo_tipo);
            $querya->bindParam(4, $arraglo_cantidad);
            $querya->bindParam(5, $arraglo_precio);
            $querya->bindParam(6, $arraglo_des);
            $querya->bindParam(7, $arraglo_sutotal);

            if ($querya->execute()) {

                $sql_p = "SELECT cantidad_re FROM rechasos_produccion where id_detalle_produccion_rechasos = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_idde);
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

                $sql_m = "UPDATE rechasos_produccion SET cantidad_re = ? where id_detalle_produccion_rechasos = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_idde);
                if ($query_m->execute()) {

                    $sql_e = "SELECT cantidad_re FROM rechasos_produccion where id_detalle_produccion_rechasos = ?";
                    $query_e = $c->prepare($sql_e);
                    $query_e->bindParam(1, $arraglo_idde);
                    $query_e->execute();
                    $data_e = $query_e->fetch(PDO::FETCH_BOTH);
                    $arreglo_e = array();
                    foreach ($data_e as $respuesta_e) {
                        $arreglo_e[] = $respuesta_e;
                    }

                    $stock_e = $arreglo_e[0];
                    if ($stock_e == 0 || $stock_e <= 0) {
                        $sql_a = "UPDATE rechasos_produccion SET bandera_re = 'AGOTADO' where id_detalle_produccion_rechasos = ?";
                        $query_a = $c->prepare($sql_a);
                        $query_a->bindParam(1, $arraglo_idde);
                        if ($query_a->execute()) {
                            $res = 1;
                        }
                    }
                    $res = 1;
                } else {
                    $res = 0; // error de update
                }

                // $res = 1;
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

    function listar_ventas_desechos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            venta_desechos.id_venta_desechos,
            CONCAT_WS( ' ', cliente.nombres, cliente.apellidos, cliente.cedula ) AS cliente,
            venta_desechos.num_venta,
            venta_desechos.tipo_comprobante,
            venta_desechos.impuesto,
            venta_desechos.fecha_venta,
            venta_desechos.sub_total,
            venta_desechos.sub_iva,
            venta_desechos.total,
            venta_desechos.countt,
            venta_desechos.estado 
             FROM
            venta_desechos
            INNER JOIN cliente ON venta_desechos.id_cliente = cliente.id_cliente ORDER BY venta_desechos.id_venta_desechos DESC";
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

    function cargar_detalle_venta_deschos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            detall_venta_desechos.id_detalle_venta_desechos,
            lote.nombre_l,
            rechasos_produccion.fecha_re,
            detall_venta_desechos.tipo,
            detall_venta_desechos.cantidad,
            detall_venta_desechos.precio,
            detall_venta_desechos.descuento,
            detall_venta_desechos.subtotal,
            detall_venta_desechos.estado,
            produccion.nombre_prod
            FROM
            detall_venta_desechos
            INNER JOIN rechasos_produccion ON detall_venta_desechos.id_detalle_desechos = rechasos_produccion.id_detalle_produccion_rechasos
            INNER JOIN produccion ON rechasos_produccion.id_produccion = produccion.id_produccion
            INNER JOIN lote ON produccion.id_lote = lote.id_lote WHERE detall_venta_desechos.id_venta_desechos = ?";
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

    function anular_venta_desechos($id)
    {
        try {
            $res = "";
            $stock = 0;
            $c = modelo_conexion::conexionPDO();

            $sql_c = "SELECT * FROM detall_venta_desechos WHERE id_venta_desechos = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->execute();
            $data = $query_c->fetchAll(PDO::FETCH_BOTH);
            foreach ($data as $respuesta) {

                $sql_a = "SELECT * FROM rechasos_produccion WHERE id_detalle_produccion_rechasos = ?";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $respuesta[2]);
                $query_a->execute();
                $dato = $query_a->fetchAll(PDO::FETCH_BOTH);
                foreach ($dato as $respuesto) {

                    $stock =  $respuesto[3] + $respuesta[4];

                    $sql_p = "UPDATE rechasos_produccion SET cantidad_re = ?, bandera_re = 'INGRESADO' where id_detalle_produccion_rechasos = ?";
                    $query_p = $c->prepare($sql_p);
                    $query_p->bindParam(1, $stock);
                    $query_p->bindParam(2, $respuesta[2]);

                    if ($query_p->execute()) {
                        $sql_d = "UPDATE detall_venta_desechos SET estado = 0 where id_venta_desechos = ?";
                        $query_d = $c->prepare($sql_d);
                        $query_d->bindParam(1, $id);
                        $query_d->execute();
                    }
                }
            }

            $sql_F = "UPDATE venta_desechos SET estado = 0 WHERE id_venta_desechos = ?";
            $query_F = $c->prepare($sql_F);
            $query_F->bindParam(1, $id);
            if ($query_F->execute()) {
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
