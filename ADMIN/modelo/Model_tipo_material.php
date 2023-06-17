<?php
require_once 'modelo_conexion.php';
class Model_tipo_material extends modelo_conexion
{
    function crear_tipo_material($nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_material where binary tipo_material = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO tipo_material (tipo_material) VALUES (?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);

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

    function crear_tipo_insumo($nombre)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_insumo where binary tipo_insumo = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO tipo_insumo (tipo_insumo) VALUES (?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre);

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

    function listar_tipo_material()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_material";
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

    function estado_tipo_material($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE tipo_material set estado_tipo_m = ? WHERE id_tipo_material = ?";
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

    function editar_tipo_material($nombre, $id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_material where tipo_material = ? AND id_tipo_material != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "UPDATE tipo_material SET tipo_material = ? WHERE id_tipo_material = ?";
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

    function listar_tipo_insumo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_insumo";
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

    function estado_tipo_insumo($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE tipo_insumo set estado_tipo_i = ? WHERE id_tipo_insumo = ?";
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

    function editar_tipo_insumo_($nombre, $id)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM tipo_insumo where tipo_insumo = ? AND id_tipo_insumo != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "UPDATE tipo_insumo SET tipo_insumo = ? WHERE id_tipo_insumo = ?";
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

    function listar_tipo_material_comobo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT *
            FROM
            tipo_material 
            WHERE
            estado_tipo_m = 1";
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

    function registra_material_insertar($codigos, $nombres, $marca, $tipo_material, $color, $precio_venta, $observacion, $decripcion_mterial, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM material where codigo = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $codigos);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_b = "SELECT * FROM material where nombre = ? AND id_tipo = ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $nombres);
                $query_b->bindParam(2, $tipo_material);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

                if (empty($data_b)) {
                    $sql_a = "INSERT INTO material (codigo, nombre, marca, id_tipo, color, precio, observacion, descripcion, foto, estado) VALUES (?,?,?,?,?,?,?,?,?,'NO STOCK')";
                    $querya = $c->prepare($sql_a);
                    $querya->bindParam(1, $codigos);
                    $querya->bindParam(2, $nombres);
                    $querya->bindParam(3, $marca);
                    $querya->bindParam(4, $tipo_material);
                    $querya->bindParam(5, $color);
                    $querya->bindParam(6, $precio_venta);
                    $querya->bindParam(7, $observacion);
                    $querya->bindParam(8, $decripcion_mterial);
                    $querya->bindParam(9, $ruta);

                    if ($querya->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3;
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

    function listar_n_matrial()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            material.id_material,
            material.codigo,
            material.nombre,
            material.marca,
            tipo_material.tipo_material,
            material.color,
            material.precio,
            material.observacion,
            material.descripcion,
            material.foto,
            material.estado,
            material.eliminado,
            material.stock_m,
            material.id_tipo
            FROM
            tipo_material
            INNER JOIN material ON tipo_material.id_tipo_material = material.id_tipo ORDER BY material.id_material DESC";
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

    function estado_material_b($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE material SET eliminado = ? WHERE id_material = ?";
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
            // modelo_conexion::cerrar_conexion();
        } catch (Exception $e) {
            // modelo_conexion::cerrar_conexion();
            echo "Error: " . $e->getMessage();
        }
        exit();
    }

    function editar_foto_material($id, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE material SET foto = ? WHERE id_material = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $ruta);
            $querya->bindParam(2, $id);

            if ($querya->execute()) {
                $res = 1;
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

    function editar_material_b($id, $codigos, $nombres, $marca, $tipo_material, $color, $precio_venta, $observacion, $decripcion_mterial)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM material where codigo = ? AND id_material != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $codigos);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_b = "SELECT * FROM material where nombre = ? AND id_tipo = ? AND id_material != ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $nombres);
                $query_b->bindParam(2, $tipo_material);
                $query_b->bindParam(3, $id);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

                if (empty($data_b)) {
                    $sql_a = "UPDATE material SET codigo = ?, nombre = ?, marca = ?, id_tipo = ?, color = ?, precio = ?, observacion = ?, descripcion = ? WHERE id_material = ? ";
                    $querya = $c->prepare($sql_a);
                    $querya->bindParam(1, $codigos);
                    $querya->bindParam(2, $nombres);
                    $querya->bindParam(3, $marca);
                    $querya->bindParam(4, $tipo_material);
                    $querya->bindParam(5, $color);
                    $querya->bindParam(6, $precio_venta);
                    $querya->bindParam(7, $observacion);
                    $querya->bindParam(8, $decripcion_mterial);
                    $querya->bindParam(9, $id);

                    if ($querya->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3;
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

    function nuevo_medida($nombre_medida, $simbolo_medida)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM medida where nombre_m = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre_medida);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "INSERT INTO medida (nombre_m, simbolo_m) VALUES (?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre_medida);
                $querya->bindParam(2, $simbolo_medida);

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

    function listar_medida_()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            *
            FROM
            medida";
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

    function estado_medida($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE medida SET estado_m = ? WHERE id_medida = ?";
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

    function editarr_medida($id, $nombre_medida, $simbolo_medida)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM medida where nombre_m = ? AND id_medida != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre_medida);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_a = "UPDATE medida SET nombre_m = ?, simbolo_m = ? WHERE id_medida = ?";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $nombre_medida);
                $querya->bindParam(2, $simbolo_medida);
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

    function listar_tipo_insumo_combo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT *
            FROM
            tipo_insumo 
            WHERE
            estado_tipo_i = 1";
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

    function litar_medida()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT *
            FROM
            medida 
            WHERE
            estado_m = 1";
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

    function registra_insumo_insertar($codigos, $nombres, $marca, $tipo_insumo, $Cantidad, $tipo_medidda, $precio_venta, $observacion, $decripcion_mterial, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM insumos where codigo_i = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $codigos);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_b = "SELECT * FROM insumos where nombre_i = ? AND id_tipo_insumo = ? AND id_medida = ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $nombres);
                $query_b->bindParam(2, $tipo_insumo);
                $query_b->bindParam(3, $tipo_medidda);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

                if (empty($data_b)) {
                    $sql_a = "INSERT INTO insumos (codigo_i, nombre_i, marca_i, id_tipo_insumo, id_medida, cantidad, precio_c, observacion_i, descrpcion_i, foto, estado) VALUES (?,?,?,?,?,?,?,?,?,?,'NO STOCK')";
                    $querya = $c->prepare($sql_a);
                    $querya->bindParam(1, $codigos);
                    $querya->bindParam(2, $nombres);
                    $querya->bindParam(3, $marca);
                    $querya->bindParam(4, $tipo_insumo);
                    $querya->bindParam(5, $tipo_medidda);
                    $querya->bindParam(6, $Cantidad);
                    $querya->bindParam(7, $precio_venta);
                    $querya->bindParam(8, $observacion);
                    $querya->bindParam(9, $decripcion_mterial);
                    $querya->bindParam(10, $ruta);

                    if ($querya->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3;
                }
            } else {
                $res = 2;
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

    function listar_b_insumo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            insumos.id_insumo,
            insumos.codigo_i,
            insumos.nombre_i,
            insumos.marca_i,
            tipo_insumo.tipo_insumo,
            CONCAT_WS(' ', medida.nombre_m, medida.simbolo_m ) AS medida,
            insumos.cantidad,
            insumos.precio_c,
            insumos.observacion_i,
            insumos.descrpcion_i,
            insumos.foto,
            insumos.estado,
            insumos.eliminado,
            insumos.stock_m,
            insumos.id_tipo_insumo,
            insumos.id_medida
                FROM
                    insumos
                    INNER JOIN medida ON insumos.id_medida = medida.id_medida
                    INNER JOIN tipo_insumo ON insumos.id_tipo_insumo = tipo_insumo.id_tipo_insumo 
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

    function estado_b_insumos($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE insumos SET eliminado = ? WHERE id_insumo = ?";
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

    function editar_foto_insumoss($id, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE insumos SET foto = ? WHERE id_insumo = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $ruta);
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

    function editar_insumo_bb($id, $codigos, $nombres, $marca, $tipo_insumo, $Cantidad, $tipo_medidda, $precio_venta, $observacion, $decripcion_mterial)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM insumos where codigo_i = ? AND id_insumo != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $codigos);
            $query->bindParam(2, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_b = "SELECT * FROM insumos where nombre_i = ? AND id_tipo_insumo = ? AND id_medida = ? AND id_insumo != ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $nombres);
                $query_b->bindParam(2, $tipo_insumo);
                $query_b->bindParam(3, $tipo_medidda);
                $query_b->bindParam(4, $id);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

                if (empty($data_b)) {
                    $sql_a = "UPDATE insumos SET codigo_i = ?, nombre_i = ?, marca_i = ?, id_tipo_insumo = ?, id_medida = ?, cantidad = ?, precio_c = ?, observacion_i = ?, descrpcion_i = ? WHERE id_insumo = ?";
                    $querya = $c->prepare($sql_a);
                    $querya->bindParam(1, $codigos);
                    $querya->bindParam(2, $nombres);
                    $querya->bindParam(3, $marca);
                    $querya->bindParam(4, $tipo_insumo);
                    $querya->bindParam(5, $tipo_medidda);
                    $querya->bindParam(6, $Cantidad);
                    $querya->bindParam(7, $precio_venta);
                    $querya->bindParam(8, $observacion);
                    $querya->bindParam(9, $decripcion_mterial);
                    $querya->bindParam(10, $id);

                    if ($querya->execute()) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 3;
                }
            } else {
                $res = 2;
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
}


