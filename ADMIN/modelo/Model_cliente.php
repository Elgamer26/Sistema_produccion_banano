<?php
require_once 'modelo_conexion.php';
class Model_cliente extends modelo_conexion
{
    function registrar_clientes($nombress, $apellidoss, $numero_docu, $telefono_p, $correo_p, $direccions, $sexo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM cliente where cedula = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $numero_docu);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                $sql_b = "SELECT * FROM cliente where correo = ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $correo_p);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);
                if (empty($data_b)) {
                    $sql_a = "INSERT INTO cliente (nombres, apellidos, cedula, telefono, correo, direccion, sexo) VALUES (?,?,?,?,?,?,?)";
                    $querya = $c->prepare($sql_a);
                    $querya->bindParam(1, $nombress);
                    $querya->bindParam(2, $apellidoss);
                    $querya->bindParam(3, $numero_docu);
                    $querya->bindParam(4, $telefono_p);
                    $querya->bindParam(5, $correo_p);
                    $querya->bindParam(6, $direccions);
                    $querya->bindParam(7, $sexo);

                    if ($querya->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3; /// correo ya existe
                }
            } else {
                $res = 2; // cedula ya eistes
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

    function listar_clientes()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM cliente";
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

    function estado_cliente($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE cliente SET estado = ? WHERE id_cliente = ?";
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

    function editando_cliente_clientes($id, $nombress, $apellidoss, $numero_docu, $telefono_p, $correo_p, $direccions, $sexo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM cliente where cedula = ? AND id_cliente != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $numero_docu);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);
            if (empty($data)) {
                $sql_b = "SELECT * FROM cliente where correo = ? AND id_cliente != ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $correo_p);
                $query_b->bindParam(2, $id);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);
                if (empty($data_b)) {
                    $sql_a = "UPDATE cliente SET nombres = ?, apellidos = ?, cedula = ?, telefono = ?, correo = ?, direccion = ?, sexo = ? WHERE id_cliente = ?";
                    $querya = $c->prepare($sql_a);
                    $querya->bindParam(1, $nombress);
                    $querya->bindParam(2, $apellidoss);
                    $querya->bindParam(3, $numero_docu);
                    $querya->bindParam(4, $telefono_p);
                    $querya->bindParam(5, $correo_p);
                    $querya->bindParam(6, $direccions);
                    $querya->bindParam(7, $sexo);
                    $querya->bindParam(8, $id);

                    if ($querya->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3; /// correo ya existe
                }
            } else {
                $res = 2; // cedula ya eistes
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
