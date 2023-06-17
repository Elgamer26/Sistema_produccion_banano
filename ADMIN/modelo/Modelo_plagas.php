<?php
require_once 'modelo_conexion.php';
class Modelo_plagas extends modelo_conexion
{
    function listar_tipos_pgas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_plaga WHERE estado = 1";
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

    function nuevo_registro_plagas($prodcuciion_id, $fecha, $tipo_plaga, $obsrvacion, $ruta, $id_usu)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "INSERT INTO control_plagas (id_produccion, fecha, id_tipo_plaga, observacion, foto, id_usuario) VALUES (?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $prodcuciion_id);
            $querya->bindParam(2, $fecha);
            $querya->bindParam(3, $tipo_plaga);
            $querya->bindParam(4, $obsrvacion);
            $querya->bindParam(5, $ruta);
            $querya->bindParam(6, $id_usu);

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

    function listr_plagas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            control_plagas.id_control_plagas,
            CONCAT_WS( ' ', ' Nombre produccion: [',produccion.nombre_prod,'] - Lote: [', lote.nombre_l, '] - Hectarea: [', produccion.hectarea, '] - Estado: [', produccion.estado, ']' ) AS produccion,
            tipo_plaga.tipo_plaga,
            CONCAT_WS( ' ', usuario.nombres, usuario.apellidos ) AS usuario,
            control_plagas.fecha,
            control_plagas.observacion,
            control_plagas.foto,
            control_plagas.estado,
            control_plagas.control_plaga 
            FROM
                control_plagas
                INNER JOIN usuario ON control_plagas.id_usuario = usuario.id_usuario
                INNER JOIN produccion ON control_plagas.id_produccion = produccion.id_produccion
                INNER JOIN lote ON produccion.id_lote = lote.id_lote
                INNER JOIN tipo_plaga ON control_plagas.id_tipo_plaga = tipo_plaga.id_tipo_plaga 
            WHERE
                control_plagas.estado = 1 
            ORDER BY
            control_plagas.id_control_plagas";
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

    function eliinar_el_registro($id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE control_plagas SET estado = 0 WHERE id_control_plagas = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);

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

    function listar_tratamientos_plagas()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tratamiento_plagas.id_traamiento,
            CONCAT_WS(
                ' ',
                ' Nombre produccion: [',
                produccion.nombre_prod,
                '] - Lote: [',
                lote.nombre_l,
                '] - Hectarea: [',
                produccion.hectarea,
                '] - Fecha inicio: [',
                produccion.fecha_inicio,
                '] - Fecha fin: [',
                produccion.fecha_fin,
                ']' 
            ) AS produccion,
            tipo_plaga.tipo_plaga,
            control_plagas.estado,
            control_plagas.control_plaga,
            tipo_tratamiento.tipo_tratamiento,
            tratamiento_plagas.observacion,
            tipo_quimico.tipo_quimico,
            tratamiento_plagas.fecha_ini,
            tratamiento_plagas.fecha_fin,
            tratamiento_plagas.dias_,
            tratamiento_plagas.cantidad_litro,
            tratamiento_plagas.estado_trat,
            tratamiento_plagas.avance
            FROM
                control_plagas
                INNER JOIN produccion ON control_plagas.id_produccion = produccion.id_produccion
                INNER JOIN lote ON produccion.id_lote = lote.id_lote
                INNER JOIN tipo_plaga ON control_plagas.id_tipo_plaga = tipo_plaga.id_tipo_plaga
                INNER JOIN tratamiento_plagas ON control_plagas.id_control_plagas = tratamiento_plagas.id_plaga
                INNER JOIN tipo_quimico ON tratamiento_plagas.id_tipo_quimico = tipo_quimico.id_tipo_quimico
                INNER JOIN tipo_tratamiento ON tratamiento_plagas.id_tipo_tratamiento = tipo_tratamiento.id_tipo_tratamiento 
            ORDER BY
            tratamiento_plagas.id_traamiento DESC";
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

    //////////////////
    function trata_fin_plaga($fech_fin)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            tratamiento_plagas.id_traamiento, 
            tratamiento_plagas.fecha_fin, 
            tratamiento_plagas.estado_trat
            FROM
            tratamiento_plagas WHERE tratamiento_plagas.fecha_fin = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $fech_fin);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_BOTH);
            foreach ($result as $respuesta) {
                $sql_a = "UPDATE tratamiento_plagas SET estado_trat = 0 WHERE id_traamiento = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $respuesta[0]);
                if ($querya->execute()) {
                    $res = 1;
                } else {
                    $res = 0;
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

    ///////////////
    function guardar_avance($id, $pocentaje_)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();

            $sql_a = "UPDATE tratamiento_plagas SET avance = ? WHERE id_traamiento = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $pocentaje_);
            $querya->bindParam(2, $id);

            if ($querya->execute()) {


                $sql_f = "SELECT
                tratamiento_plagas.avance
                FROM
                tratamiento_plagas WHERE tratamiento_plagas.id_traamiento = ?";
                $query_f = $c->prepare($sql_f);
                $query_f->bindParam(1, $id);
                $query_f->execute();
                $result_f = $query_f->fetch(PDO::FETCH_BOTH);

                if ($result_f[0] >= 100) {
                    
                    $sql_ff = "UPDATE tratamiento_plagas SET estado_trat = 0 WHERE id_traamiento = ?";
                    $query_ff = $c->prepare($sql_ff);
                    $query_ff->bindParam(1, $id);
                    if ($query_ff->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }

                } else {
                    $res = 1;
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
}
