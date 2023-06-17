<?php
require_once 'modelo_conexion.php';
class Model_rol extends modelo_conexion
{
    function crear_rol($nombre, $estado)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM rol where binary nombre = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO rol (nombre, estado) VALUES (?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $estado);

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

    function crear_permiso($id,  string $config, string $respaldos, string $empleados, string $multas, string $asistecias, string $permisos, string $rol_pagos, string $bodega, string $compras, string $produccion, string $ventas, string $control_plagas, string $reportes)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "INSERT INTO permisos (rol_id, configuracion, respaldos, empleados, multas, asistecias, permisos, rol_pagos, bodega, compras, produccion, ventas, control_plagas, reportes) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $config);
            $querya->bindParam(3, $respaldos);
            $querya->bindParam(4, $empleados);
            $querya->bindParam(5, $multas);
            $querya->bindParam(6, $asistecias);
            $querya->bindParam(7, $permisos);
            $querya->bindParam(8, $rol_pagos);
            $querya->bindParam(9, $bodega);
            $querya->bindParam(10, $compras);
            $querya->bindParam(11, $produccion);
            $querya->bindParam(12, $ventas);
            $querya->bindParam(13, $control_plagas);
            $querya->bindParam(14, $reportes);

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

    function listar_roles()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM rol";
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

    function estado_rol($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE rol set estado = ? WHERE id_rol = ?";
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

    function editar_rol($id, $nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM rol where nombre = ? AND id_rol != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "UPDATE rol SET nombre = ? WHERE id_rol = ?";
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

    function obtener_pemisos($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM permisos WHERE rol_id = ?";
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

    function editar_permiso($id_rol, $id_permiso, string $conf, string $respaldos, string $empleados, string $multas, string $asistecias, string $permisos, string $rol_pagos, string $bodega, string $compras, string $produccion, string $ventas, string $control_plagas, string $reportes)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE permisos SET configuracion = ?, respaldos = ?, empleados = ?, multas = ?, asistecias = ?, permisos = ?, rol_pagos = ?, bodega = ?, compras = ?, produccion = ?, ventas = ?, control_plagas = ?, reportes = ? WHERE permiso_id = ? AND rol_id = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $conf);

            $querya->bindParam(2, $respaldos);
            $querya->bindParam(3, $empleados);
            $querya->bindParam(4, $multas);
            $querya->bindParam(5, $asistecias);
            $querya->bindParam(6, $permisos);
            $querya->bindParam(7, $rol_pagos);
            $querya->bindParam(8, $bodega);
            $querya->bindParam(9, $compras);
            $querya->bindParam(10, $produccion);
            $querya->bindParam(11, $ventas);
            $querya->bindParam(12, $control_plagas);
            $querya->bindParam(13, $reportes);

            $querya->bindParam(14, $id_permiso);
            $querya->bindParam(15, $id_rol);



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
