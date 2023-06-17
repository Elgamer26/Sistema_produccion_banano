<?php
require_once 'modelo_conexion.php';
class Model_compra extends modelo_conexion
{
    function listar_proveedor()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT *
            FROM
            proveedor 
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

    function buscar_codi_materil($numero)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            material.id_material,
            material.codigo,
            material.nombre, 
            tipo_material.tipo_material,            
            material.precio,   
            material.stock_m
            FROM
            tipo_material
            INNER JOIN material ON tipo_material.id_tipo_material = material.id_tipo WHERE material.codigo = ? AND material.eliminado = 1";
            $query = $c->prepare($sql);
            $query->bindParam(1, $numero);
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

    function crear_nueva_compra($proveedor, $numero_compra, $comprobante_tipo, $impuesto, $fecha_compra, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $count)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM compra_material where numero_compra = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $numero_compra);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO compra_material (proveedor_id, numero_compra, tipo_comprobante, impuesto, fecha, sub_total, sub_iva, gran_total, cantidad) VALUES (?,?,?,?,?,?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $proveedor);
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

    function registrar_detalle_compra(
        $id,
        $arraglo_idpm,
        $arraglo_cantidad,
        $arraglo_precio,
        $arraglo_des,
        $arraglo_sutotal
    ) {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detalle_compra_material (id_compra_material, id_material, cantidad, precio, descuento, subtotal) VALUES (?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_idpm);
            $querya->bindParam(3, $arraglo_cantidad);
            $querya->bindParam(4, $arraglo_precio);
            $querya->bindParam(5, $arraglo_des);
            $querya->bindParam(6, $arraglo_sutotal);

            if ($querya->execute()) {

                $sql_p = "SELECT stock_m FROM material where id_material = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_idpm);
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
                $stock = $stock + $arraglo_cantidad;

                $sql_m = "UPDATE material SET stock_m = ?, estado = 'ACTIVO' where id_material = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_idpm);
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

    function listar_compras_material()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            compra_material.id_compra_material,
            proveedor.razon,
            compra_material.numero_compra,
            compra_material.tipo_comprobante,
            compra_material.impuesto,
            compra_material.fecha,
            compra_material.sub_total,
            compra_material.sub_iva,
            compra_material.gran_total,
            compra_material.cantidad,
            compra_material.estado 
            FROM
                compra_material
                INNER JOIN proveedor ON compra_material.proveedor_id = proveedor.id_proveedor 
            ORDER BY
            compra_material.id_compra_material";
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

    function detalle_de_compra($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            detalle_compra_material.id_detalle_compra_material,
            detalle_compra_material.id_compra_material,
            material.nombre,
            tipo_material.tipo_material,
            detalle_compra_material.cantidad,
            detalle_compra_material.precio,
            detalle_compra_material.descuento,
            detalle_compra_material.subtotal,
            detalle_compra_material.estado 
            FROM
                detalle_compra_material
                INNER JOIN material ON detalle_compra_material.id_material = material.id_material
                INNER JOIN tipo_material ON material.id_tipo = tipo_material.id_tipo_material 
            WHERE
            detalle_compra_material.id_compra_material = ?";
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

    function anular_copra_material($id)
    {
        try {
            $res = "";
            $stock = 0;
            $c = modelo_conexion::conexionPDO();

            $sql_c = "SELECT * FROM detalle_compra_material WHERE id_compra_material = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->execute();
            $data = $query_c->fetchAll(PDO::FETCH_BOTH);
            foreach ($data as $respuesta) {

                $sql_a = "SELECT * FROM material WHERE id_material = ?";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $respuesta[2]);
                $query_a->execute();
                $dato = $query_a->fetchAll(PDO::FETCH_BOTH);
                foreach ($dato as $respuesto) {

                    $stock =  $respuesto[12] - $respuesta[3];

                    $sql_p = "UPDATE material SET stock_m = ? where id_material = ?";
                    $query_p = $c->prepare($sql_p);
                    $query_p->bindParam(1, $stock);
                    $query_p->bindParam(2, $respuesta[2]);

                    if ($query_p->execute()) {
                        $sql_d = "UPDATE detalle_compra_material SET estado = 0 where id_compra_material = ?";
                        $query_d = $c->prepare($sql_d);
                        $query_d->bindParam(1, $id);
                        $query_d->execute();
                    }
                }
            }

            $sql_F = "UPDATE compra_material SET estado = 0 WHERE id_compra_material = ?";
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

    ////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////
    
    function buscar_codi_insumo($numero)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            insumos.id_insumo,
            insumos.codigo_i,
            insumos.nombre_i,
            tipo_insumo.tipo_insumo,
            medida.simbolo_m,
            insumos.cantidad,
            insumos.precio_c,
            insumos.stock_m 
            FROM
            insumos
            INNER JOIN tipo_insumo ON insumos.id_tipo_insumo = tipo_insumo.id_tipo_insumo
            INNER JOIN medida ON insumos.id_medida = medida.id_medida 
            WHERE
            insumos.codigo_i = ? 
            AND insumos.eliminado = 1";
            $query = $c->prepare($sql);
            $query->bindParam(1, $numero);
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

    function crear_nueva_compra_insumo($proveedor, $numero_compra, $comprobante_tipo, $impuesto, $fecha_compra, $txt_totalneto, $txt_impuesto, $txt_a_pagar, $count)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM compra_insumo where numero_compra = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $numero_compra);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO compra_insumo (proveedor_id, numero_compra, tipo_comprobante, impuesto, fecha, sub_total, sub_iva, gran_total, cantidad) VALUES (?,?,?,?,?,?,?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $proveedor);
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

    function registrar_detalle_compra_ingreso(
        $id,
        $arraglo_idpm,
        $arraglo_medida,
        $arraglo_cantidad,
        $arraglo_precio,
        $arraglo_des,
        $arraglo_sutotal
    ) {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO detalle_compra_insumo (id_compra_insumo, id_insumo, cantidad, medida, precio, descuento, subtotal) VALUES (?,?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $arraglo_idpm);
            $querya->bindParam(3, $arraglo_cantidad);
            $querya->bindParam(4, $arraglo_medida);
            $querya->bindParam(5, $arraglo_precio);
            $querya->bindParam(6, $arraglo_des);
            $querya->bindParam(7, $arraglo_sutotal);

            if ($querya->execute()) {

                $sql_p = "SELECT stock_m FROM insumos where id_insumo = ?";
                $query_p = $c->prepare($sql_p);
                $query_p->bindParam(1, $arraglo_idpm);
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
                $stock = $stock + $arraglo_cantidad;

                $sql_m = "UPDATE insumos SET stock_m = ?, estado = 'ACTIVO' where id_insumo = ?";
                $query_m = $c->prepare($sql_m);
                $query_m->bindParam(1, $stock);
                $query_m->bindParam(2, $arraglo_idpm);
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

    function listar_compras_insumo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            compra_insumo.id_compra_insumo,
            proveedor.razon,
            compra_insumo.numero_compra,
            compra_insumo.tipo_comprobante,
            compra_insumo.impuesto,
            compra_insumo.fecha,
            compra_insumo.sub_total,
            compra_insumo.sub_iva,
            compra_insumo.gran_total,
            compra_insumo.cantidad,
            compra_insumo.estado 
            FROM
            compra_insumo
            INNER JOIN proveedor ON compra_insumo.proveedor_id = proveedor.id_proveedor
            ORDER BY
            compra_insumo.id_compra_insumo";
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

    function detalle_de_compra_insumo($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            detalle_compra_insumo.id_compra_insumo,
            insumos.nombre_i,
            tipo_insumo.tipo_insumo,
            detalle_compra_insumo.cantidad,
            detalle_compra_insumo.medida,
            detalle_compra_insumo.precio,
            detalle_compra_insumo.descuento,
            detalle_compra_insumo.subtotal,
            detalle_compra_insumo.estado 
            FROM
            detalle_compra_insumo
            INNER JOIN insumos ON detalle_compra_insumo.id_insumo = insumos.id_insumo
            INNER JOIN tipo_insumo ON insumos.id_tipo_insumo = tipo_insumo.id_tipo_insumo
            WHERE
            detalle_compra_insumo.id_compra_insumo = ?";
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

    function anular_compra_isumo($id)
    {
        try {
            $res = "";
            $stock = 0;
            $c = modelo_conexion::conexionPDO();

            $sql_c = "SELECT * FROM detalle_compra_insumo WHERE id_compra_insumo = ?";
            $query_c = $c->prepare($sql_c);
            $query_c->bindParam(1, $id);
            $query_c->execute();
            $data = $query_c->fetchAll(PDO::FETCH_BOTH);
            foreach ($data as $respuesta) {

                $sql_a = "SELECT * FROM insumos WHERE id_insumo = ?";
                $query_a = $c->prepare($sql_a);
                $query_a->bindParam(1, $respuesta[2]);
                $query_a->execute();
                $dato = $query_a->fetchAll(PDO::FETCH_BOTH);
                foreach ($dato as $respuesto) {

                    $stock =  $respuesto[13] - $respuesta[3];

                    $sql_p = "UPDATE insumos SET stock_m = ? where id_insumo = ?";
                    $query_p = $c->prepare($sql_p);
                    $query_p->bindParam(1, $stock);
                    $query_p->bindParam(2, $respuesta[2]);

                    if ($query_p->execute()) {
                        $sql_d = "UPDATE detalle_compra_insumo SET estado = 0 where id_compra_insumo = ?";
                        $query_d = $c->prepare($sql_d);
                        $query_d->bindParam(1, $id);
                        $query_d->execute();
                    }
                }
            }

            $sql_F = "UPDATE compra_insumo SET estado = 0 WHERE id_compra_insumo = ?";
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


    ///////////////////
    function listra_material_select()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            material.id_material, 
            material.codigo, 
            material.nombre, 
            tipo_material.tipo_material, 
            material.stock_m, 
            material.precio
            FROM
            material
            INNER JOIN
            tipo_material
            ON 
                material.id_tipo = tipo_material.id_tipo_material WHERE material.eliminado = 1 order by material.id_material DESC";
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

    ////////////////////
    function listar_isumos_seelct()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            insumos.id_insumo,
            insumos.codigo_i,
            insumos.nombre_i,
            tipo_insumo.tipo_insumo,
            insumos.stock_m,
            insumos.precio_c,
            medida.nombre_m 
        FROM
            insumos
            INNER JOIN tipo_insumo ON insumos.id_tipo_insumo = tipo_insumo.id_tipo_insumo
            INNER JOIN medida ON insumos.id_medida = medida.id_medida 
        WHERE
            insumos.eliminado = 1 
        ORDER BY
            insumos.id_insumo DESC";
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

}
