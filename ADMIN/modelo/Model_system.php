<?php
require_once 'modelo_conexion.php';
class Model_system extends modelo_conexion
{

    function total_empeados_activos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            COUNT(*) 
            FROM
            empleado 
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

    function total_maerial()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            COUNT(*) 
            FROM
            material 
            WHERE
            eliminado = 1";
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

    function total_insumos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            COUNT(*) 
            FROM
            insumos 
            WHERE
            eliminado = 1";
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

    function total_prod_iniciados()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            COUNT(*) AS produccion 
            FROM
                produccion 
            WHERE
            estado = 'INICIADO'";
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

    //////////////////////////////
    function cinco_tratamintos_materiales()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            detalle_compra_material.id_material,
            CONCAT_WS(' ', material.nombre, material.marca, tipo_material.tipo_material ) AS material,
            SUM( detalle_compra_material.cantidad ) AS cantidad,
            SUM(detalle_compra_material.subtotal) as total 
            FROM
                detalle_compra_material
                INNER JOIN material ON detalle_compra_material.id_material = material.id_material
                INNER JOIN tipo_material ON material.id_tipo = tipo_material.id_tipo_material 
                WHERE detalle_compra_material.estado = 1
            GROUP BY
                detalle_compra_material.id_material 
            ORDER BY
            SUM( detalle_compra_material.cantidad ) DESC 
            LIMIT 5";

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

    //////////////////////////////
    function cinco_tratamintos_insumos()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
                detalle_compra_insumo.id_insumo,
                CONCAT_WS( ' ', insumos.nombre_i, tipo_insumo.tipo_insumo ) AS insumo,
                SUM( detalle_compra_insumo.cantidad ) AS suma,
                SUM( detalle_compra_insumo.subtotal ) AS total 
                FROM
                    insumos
                    INNER JOIN detalle_compra_insumo ON insumos.id_insumo = detalle_compra_insumo.id_insumo
                    INNER JOIN tipo_insumo ON insumos.id_tipo_insumo = tipo_insumo.id_tipo_insumo 
                WHERE
                    detalle_compra_insumo.estado = 1 
                GROUP BY
                    detalle_compra_insumo.id_insumo 
                ORDER BY
                SUM( detalle_compra_insumo.cantidad ) DESC 
                LIMIT 5";

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

    function traer_permiso_usuario($id_usu, $id_rol)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            usuario.id_usuario,
            permisos.rol_id,
            permisos.configuracion,
            permisos.respaldos,
            permisos.empleados,
            permisos.multas,
            permisos.asistecias,
            permisos.permisos,
            permisos.rol_pagos,
            permisos.bodega,
            permisos.compras,
            permisos.produccion,
            permisos.ventas,
            permisos.control_plagas,
            permisos.reportes 
          FROM
            rol
            INNER JOIN permisos ON rol.id_rol = permisos.rol_id
            INNER JOIN usuario ON rol.id_rol = usuario.id_rol 
            WHERE permisos.rol_id = ? AND usuario.id_usuario = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id_rol);
            $query->bindParam(2, $id_usu);
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

    //////////////////////////////
    function cargar_grafico_compra_material($fecha_inicio, $fecha_fin)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
                detalle_compra_material.id_material,
                material.nombre,
                tipo_material.tipo_material,
                sum( detalle_compra_material.cantidad ) AS CANTIDAD,
                CONCAT_WS(' ',compra_material.fecha, ' - ', material.nombre) as material
                FROM
                    detalle_compra_material
                    INNER JOIN compra_material ON detalle_compra_material.id_compra_material = compra_material.id_compra_material
                    INNER JOIN material ON detalle_compra_material.id_material = material.id_material
                    INNER JOIN tipo_material ON material.id_tipo = tipo_material.id_tipo_material 
                WHERE
                    compra_material.estado = 1 
                    AND compra_material.fecha BETWEEN ? AND ? 
                GROUP BY
                detalle_compra_material.id_material";

            $query = $c->prepare($sql);
            $query->bindParam(1, $fecha_inicio);
            $query->bindParam(2, $fecha_fin);
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

    //////////////////////////////
    function cargar_grafico_compra_insumo($fecha_inicio, $fecha_fin)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
                insumos.nombre_i,
                tipo_insumo.tipo_insumo,
                SUM(detalle_compra_insumo.cantidad) as cantidad,
                CONCAT_WS(' ',compra_insumo.fecha , ' - ', insumos.nombre_i) as insumo
            FROM
                detalle_compra_insumo
                INNER JOIN compra_insumo ON detalle_compra_insumo.id_compra_insumo = compra_insumo.id_compra_insumo
                INNER JOIN insumos ON detalle_compra_insumo.id_insumo = insumos.id_insumo
                INNER JOIN tipo_insumo ON insumos.id_tipo_insumo = tipo_insumo.id_tipo_insumo
                WHERE compra_insumo.estado = 1 AND compra_insumo.fecha BETWEEN ? AND ?
                GROUP BY detalle_compra_insumo.id_insumo ";

            $query = $c->prepare($sql);
            $query->bindParam(1, $fecha_inicio);
            $query->bindParam(2, $fecha_fin);
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

    //////////////////////////////
    function cargar_grafico_compra_racimos($fecha_inicio, $fecha_fin)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT 
            CONCAT_WS(' ',venta_racimos.fecha_venta , ' - Cajas') as racimo,
            SUM(detall_venta_racimos.subtotal) as suma
            FROM
                detall_venta_racimos
                INNER JOIN
                venta_racimos
                ON 
                    detall_venta_racimos.id_venta_racimos = venta_racimos.id_venta_racimos
            WHERE
                venta_racimos.estado = 1 AND venta_racimos.fecha_venta BETWEEN ? AND ?
                GROUP BY venta_racimos.fecha_venta";

            $query = $c->prepare($sql);
            $query->bindParam(1, $fecha_inicio);
            $query->bindParam(2, $fecha_fin);
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

    //////////////////////////////
    function cargar_grafico_compra_desechos($fecha_inicio, $fecha_fin)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT           
            CONCAT_WS(' ', venta_desechos.fecha_venta, ' - Rechasos') as Rechasos,
            SUM(detall_venta_desechos.subtotal) 
            FROM
                venta_desechos
                INNER JOIN detall_venta_desechos ON venta_desechos.id_venta_desechos = detall_venta_desechos.id_venta_desechos 
            WHERE
                venta_desechos.estado = 1 and venta_desechos.fecha_venta BETWEEN ? AND ?
            GROUP BY
            venta_desechos.fecha_venta";

            $query = $c->prepare($sql);
            $query->bindParam(1, $fecha_inicio);
            $query->bindParam(2, $fecha_fin);
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

    //////////////////////////////
    function cargar_grafico_produccion($fecha_inicio, $fecha_fin)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
                produccion.id_produccion,
                produccion.fecha_inicio,
                produccion.fecha_fin,
                CONCAT_WS( ' ', 'Fecha: [' , produccion.fecha_fin,'] - Lote: [', lote.nombre_l, ' - ', produccion.estado,']' ) AS lote,
                SUM(
                    ( detalle_insumos_produccion.costo * detalle_insumos_produccion.cantidad * produccion.dias ) + ( detalle_actividad_porduccion.costo * produccion.dias ) + ( detalle_material_produccion.costo * detalle_material_produccion.cantidad * produccion.dias ) 
                ) AS SUMA 
                FROM
                    produccion
                    INNER JOIN detalle_insumos_produccion ON produccion.id_produccion = detalle_insumos_produccion.id_produccion
                    INNER JOIN detalle_material_produccion ON produccion.id_produccion = detalle_material_produccion.id_produccion
                    INNER JOIN detalle_actividad_porduccion ON produccion.id_produccion = detalle_actividad_porduccion.id_produccion
                    INNER JOIN lote ON produccion.id_lote = lote.id_lote 
                WHERE
                    produccion.estado != 'CANCELADO' AND produccion.fecha_fin BETWEEN ? AND ?
                GROUP BY
                produccion.id_produccion";

            $query = $c->prepare($sql);
            $query->bindParam(1, $fecha_inicio);
            $query->bindParam(2, $fecha_fin);
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
}
