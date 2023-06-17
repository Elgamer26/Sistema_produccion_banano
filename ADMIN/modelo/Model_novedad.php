<?php
require_once 'modelo_conexion.php';
class Model_novedad extends modelo_conexion
{
    function registrar_novedad($nombre, $descripcion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM novedad where nombre = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO novedad (nombre, descipcion) VALUES (?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $descripcion);

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

    function listar_novedad()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM novedad";
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

    function cambiar_estado_novedad($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE novedad set estado = ? WHERE id_novedad = ?";
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

    function editar_tipo_novedades($id, $nombre, $descripcion)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM novedad where nombre = ? AND id_novedad != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "UPDATE novedad SET nombre = ?, descipcion = ? WHERE id_novedad = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);
                $querya->bindParam(2, $descripcion);
                $querya->bindParam(3, $id);

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

    function traer_novedades_tipo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT *
            FROM
            novedad                
            WHERE estado = 1";
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

    function registrar_noveda_produccion($prodcuciion_id, $fecha_ras_des, $numero_ra, $tipo_ses, $detalle_novedad)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_r = "INSERT INTO novedad_produccion (id_produccion, fecha, id_novedad, costo, detalle) VALUES (?,?,?,?,?)";
            $queryr = $c->prepare($sql_r);
            $queryr->bindParam(1, $prodcuciion_id);
            $queryr->bindParam(2, $fecha_ras_des);
            $queryr->bindParam(3, $tipo_ses);
            $queryr->bindParam(4, $numero_ra);
            $queryr->bindParam(5, $detalle_novedad);
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

    function listar_novedad_produccion()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
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
            novedad_produccion.fecha,
            novedad.nombre,
            novedad_produccion.costo,
            novedad_produccion.id_novedad_produccion,
            novedad_produccion.detalle
            FROM
            produccion
            INNER JOIN lote ON produccion.id_lote = lote.id_lote
            INNER JOIN novedad_produccion ON produccion.id_produccion = novedad_produccion.id_produccion
            INNER JOIN novedad ON novedad_produccion.id_novedad = novedad.id_novedad WHERE novedad_produccion.estado = 1";
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

    function eliminar_la_novedad($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_r = "DELETE FROM novedad_produccion WHERE id_novedad_produccion = ?";
            $queryr = $c->prepare($sql_r);
            $queryr->bindParam(1, $id); 
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
