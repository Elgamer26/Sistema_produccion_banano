<?php
require_once 'modelo_conexion.php';
class Model_empleado extends modelo_conexion
{
    function registra_empleado($nombre, $apellidos, $fecha, $numero_docu, $direccions, $telefono_empleado, $correo_empleado, $sexo, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empleado where nombres = ? and apellidos = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $apellidos);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_b = "SELECT * FROM empleado where cedula = ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $numero_docu);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

                if (empty($data_b)) {
                    $sql_c = "SELECT * FROM empleado where correo = ?";
                    $query_c = $c->prepare($sql_c);
                    $query_c->bindParam(1, $correo_empleado);
                    $query_c->execute();
                    $data_c = $query_c->fetch(PDO::FETCH_ASSOC);

                    if (empty($data_c)) {
                        $sql_a = "INSERT INTO empleado (nombres, apellidos, fecha, cedula, direccion, telefono, correo, sexo, foto) VALUES (?,?,?,?,?,?,?,?,?)";
                        $querya = $c->prepare($sql_a);
                        $querya->bindParam(1, $nombre);
                        $querya->bindParam(2, $apellidos);
                        $querya->bindParam(3, $fecha);
                        $querya->bindParam(4, $numero_docu);
                        $querya->bindParam(5, $direccions);
                        $querya->bindParam(6, $telefono_empleado);
                        $querya->bindParam(7, $correo_empleado);
                        $querya->bindParam(8, $sexo);
                        $querya->bindParam(9, $ruta);

                        if ($querya->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 4; // correo ya existe
                    }
                } else {
                    $res = 3; /// cedula ya existe
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

    function listra_empleado()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empleado ORDER BY id_empleado DESC";
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

    function traer_datos_empleado($valor)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empleado
            WHERE estado = 1 AND hoja_vida = 0 AND cedula = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $valor);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_BOTH);
            $arreglo = array();
            if (!empty($result)) {
                $arreglo[] = $result;
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

    function registra_hoja_vida($id, $primaria_estudio, $secundaria_estudio, $superior_estudio, $cursos_relizados, $licencia_conducir, $tipo_licencia, $ultimo_trabajo, $expe_laboral)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "INSERT INTO hoja_vida (id_empleado, primaria, secundaria, superior, cursos, licencia, tipo, ultimo_trabajo, experiencia) VALUES (?,?,?,?,?,?,?,?,?)";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $id);
            $querya->bindParam(2, $primaria_estudio);
            $querya->bindParam(3, $secundaria_estudio);
            $querya->bindParam(4, $superior_estudio);
            $querya->bindParam(5, $cursos_relizados);
            $querya->bindParam(6, $licencia_conducir);
            $querya->bindParam(7, $tipo_licencia);
            $querya->bindParam(8, $ultimo_trabajo);
            $querya->bindParam(9, $expe_laboral);

            if ($querya->execute()) {

                $sql_b = "UPDATE empleado SET hoja_vida = 1 WHERE id_empleado = ?";
                $queryb = $c->prepare($sql_b);
                $queryb->bindParam(1, $id);

                if ($queryb->execute()) {
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

    function estado_empleado($id, $dato)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE empleado set estado = ? WHERE id_empleado = ?";
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

    function editar_empleado($id, $nombre, $apellidos, $fecha, $numero_docu, $direccions, $telefono_empleado, $correo_empleado, $sexo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empleado where nombres = ? and apellidos = ? AND id_empleado != ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $nombre);
            $query->bindParam(2, $apellidos);
            $query->bindParam(3, $id);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (empty($data)) {
                $sql_b = "SELECT * FROM empleado where cedula = ? AND id_empleado != ?";
                $query_b = $c->prepare($sql_b);
                $query_b->bindParam(1, $numero_docu);
                $query_b->bindParam(2, $id);
                $query_b->execute();
                $data_b = $query_b->fetch(PDO::FETCH_ASSOC);

                if (empty($data_b)) {
                    $sql_c = "SELECT * FROM empleado where correo = ? AND id_empleado != ?";
                    $query_c = $c->prepare($sql_c);
                    $query_c->bindParam(1, $correo_empleado);
                    $query_c->bindParam(2, $id);
                    $query_c->execute();
                    $data_c = $query_c->fetch(PDO::FETCH_ASSOC);

                    if (empty($data_c)) {
                        $sql_a = "UPDATE empleado SET nombres = ?, apellidos = ?, fecha = ?, cedula = ?, direccion = ?, telefono = ?, correo = ?, sexo = ? WHERE id_empleado = ?";
                        $querya = $c->prepare($sql_a);
                        $querya->bindParam(1, $nombre);
                        $querya->bindParam(2, $apellidos);
                        $querya->bindParam(3, $fecha);
                        $querya->bindParam(4, $numero_docu);
                        $querya->bindParam(5, $direccions);
                        $querya->bindParam(6, $telefono_empleado);
                        $querya->bindParam(7, $correo_empleado);
                        $querya->bindParam(8, $sexo);
                        $querya->bindParam(9, $id);

                        if ($querya->execute()) {
                            $res = 1;
                        } else {
                            $res = 0;
                        }
                    } else {
                        $res = 4; // correo ya existe
                    }
                } else {
                    $res = 3; /// cedula ya existe
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

    function traer_datos_hoja_vida($id)
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM hoja_vida WHERE id_empleado = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_BOTH);
            $arreglo = array();
            if (!empty($result)) {
                $arreglo[] = $result;
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

    function editar_hoja_vida($id, $id_hoja, $primaria_estudio, $secundaria_estudio, $superior_estudio, $cursos_relizados, $licencia_conducir, $tipo_licencia, $ultimo_trabajo, $expe_laboral)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE hoja_vida SET primaria = ?, secundaria = ?, superior = ?, cursos = ?, licencia = ?, tipo = ?, ultimo_trabajo = ?, experiencia = ? WHERE id_hoja_vida = ? AND  id_empleado = ?";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $primaria_estudio);
            $querya->bindParam(2, $secundaria_estudio);
            $querya->bindParam(3, $superior_estudio);
            $querya->bindParam(4, $cursos_relizados);
            $querya->bindParam(5, $licencia_conducir);
            $querya->bindParam(6, $tipo_licencia);
            $querya->bindParam(7, $ultimo_trabajo);
            $querya->bindParam(8, $expe_laboral);
            $querya->bindParam(9, $id_hoja);
            $querya->bindParam(10, $id);

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

    function editar_foto_empleado($id, $ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE empleado SET foto = ?  WHERE id_empleado = ?";
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

    function listar_hoja_empleado()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            hoja_vida.id_hoja_vida,
            hoja_vida.id_empleado,
            CONCAT_WS( ' ', empleado.nombres, empleado.apellidos ) AS empleado,
            empleado.cedula,
            empleado.sexo 
            FROM
            hoja_vida
            INNER JOIN empleado ON hoja_vida.id_empleado = empleado.id_empleado 
            WHERE
            hoja_vida.contrato = 0";
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

    function listar_reporte_asistecias()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empleado WHERE estado = 1 AND hoja_vida = 1";
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
}
