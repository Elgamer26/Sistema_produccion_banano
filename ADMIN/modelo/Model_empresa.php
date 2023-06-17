<?php
require_once 'modelo_conexion.php';
class Model_empresa extends modelo_conexion
{
    function traer_datos_optica()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM empresa WHERE id_empresa = 1";
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

    function editar_foto_perfil_empresa($ruta)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE empresa SET foto = ? WHERE id_empresa = 1";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $ruta);
            if ($querya->execute()) {
                $res = 1; // SE UPDATE CORRECTAMENTE
            } else {
                $res = 0; // FALLO EN LA MATRIX
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

    function editar_empresa($nomber, $ruc, $direcc, $telefono, $correo, $dueño, $descrp)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql_a = "UPDATE empresa SET nombre = ?, ruc = ?, direccion = ?, telefono = ?, correo = ?, propietario = ?, descripion = ? WHERE id_empresa = 1";
            $querya = $c->prepare($sql_a);
            $querya->bindParam(1, $nomber);
            $querya->bindParam(2, $ruc);
            $querya->bindParam(3, $direcc);
            $querya->bindParam(4, $telefono);
            $querya->bindParam(5, $correo);
            $querya->bindParam(6, $dueño);
            $querya->bindParam(7, $descrp);

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
