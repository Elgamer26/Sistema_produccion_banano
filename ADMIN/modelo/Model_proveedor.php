<?php
require_once 'modelo_conexion.php';
class Model_proveedor extends modelo_conexion
{
    function nuevo_proveedor($razons, $rucs, $telefono_p, $correo_p, $direccions, $descripcions, $encargados, $sexo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM proveedor where razon = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $razons);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_b = "SELECT * FROM proveedor where rucs = ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $rucs);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

                if (empty($data_b)) {

                    $sql_b = "SELECT * FROM proveedor where correo_p = ?";
                    $query_z = $c->prepare($sql_b);
                    $query_z->bindParam(1, $correo_p);
                    $query_z->execute();
                    $data_z = $query_z->fetch(PDO::FETCH_ASSOC);

                    if (empty($data_z)) {
                        $sql_a = "INSERT INTO proveedor (razon, rucs, telefono_p, correo_p, direccions, descripcions, encargados, sexo) VALUES (?,?,?,?,?,?,?,?)";
                        $querya = $c->prepare($sql_a);
                        $querya->bindParam(1, $razons);
                        $querya->bindParam(2, $rucs);
                        $querya->bindParam(3, $telefono_p);
                        $querya->bindParam(4, $correo_p);
                        $querya->bindParam(5, $direccions);
                        $querya->bindParam(6, $descripcions);
                        $querya->bindParam(7, $encargados);
                        $querya->bindParam(8, $sexo);

                        if ($querya->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 4; /// correo ya existe
                    }
                } else {
                    $res = 3; /// ruc ya existe
                }
            } else {
                $res = 2; // nombres ya eistes
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

    function listardo_proveedores()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            proveedor
            ORDER BY id_proveedor DESC";
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

    function estado_proveedor($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "UPDATE proveedor SET estado = ? WHERE id_proveedor = ?";
            $querya = $c->prepare($sql);
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

    function editar_proveedor($id, $razons, $rucs, $telefono_p, $correo_p, $direccions, $descripcions, $encargados, $sexo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM proveedor where razon = ? AND id_proveedor != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $razons);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_b = "SELECT * FROM proveedor where rucs = ? AND id_proveedor != ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $rucs);
                $query_b->bindParam(2, $id);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

                if (empty($data_b)) {

                    $sql_b = "SELECT * FROM proveedor where correo_p = ? AND id_proveedor != ?";
                    $query_z = $c->prepare($sql_b);
                    $query_z->bindParam(1, $correo_p);
                    $query_z->bindParam(2, $id);
                    $query_z->execute();
                    $data_z = $query_z->fetch(PDO::FETCH_ASSOC);

                    if (empty($data_z)) {
                        $sql_a = "UPDATE proveedor SET razon = ?, rucs = ?, telefono_p = ?, correo_p = ?, direccions = ?, descripcions = ?, encargados = ?, sexo = ? WHERE id_proveedor = ?";
                        $querya = $c->prepare($sql_a);
                        $querya->bindParam(1, $razons);
                        $querya->bindParam(2, $rucs);
                        $querya->bindParam(3, $telefono_p);
                        $querya->bindParam(4, $correo_p);
                        $querya->bindParam(5, $direccions);
                        $querya->bindParam(6, $descripcions);
                        $querya->bindParam(7, $encargados);
                        $querya->bindParam(8, $sexo);
                        $querya->bindParam(9, $id);

                        if ($querya->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 4; /// correo ya existe
                    }
                } else {
                    $res = 3; /// ruc ya existe
                }
            } else {
                $res = 2; // nombres ya eistes
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
