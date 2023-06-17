<?php
require_once 'modelo_conexion.php';
class model_backup extends modelo_conexion
{

    function realizar_respaldo($id, $pass, $fecha_archivo)
    {
        try {
            $res = "";
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT * FROM usuario where id_usuario = ? AND pass = ?";
            $query = $c->prepare($sql);
            $query->bindParam(1, $id);
            $query->bindParam(2, $pass);
            $query->execute();
            $data = $query->fetch(PDO::FETCH_BOTH);

            if (!empty($data)) {

                date_default_timezone_set('America/Guayaquil');
                $fecha_hora_db = date("Y:m:d H:i:s");

                $dato = "{$fecha_archivo}_{$this->getdb()}";
                $ruta = "img/backup/" . $dato . ".zip";

                $sql_a = "INSERT INTO respaldo (id_usuario, fecha_hora, ruta) VALUES (?,?,?)";
                $querya = $c->prepare($sql_a);
                $querya->bindParam(1, $id);
                $querya->bindParam(2, $fecha_hora_db);
                $querya->bindParam(3, $ruta);

                if ($querya->execute()) {
                    /// eto me devleve los datos de la base de datos
                    $db_pass = $this->getContrasena();
                    $db_host = $this->gethost();
                    $db_name = $this->getdb();
                    $db_user = $this->getUsuario();
                    $res = array("pass" => $db_pass, "host" => $db_host, "name" => $db_name, "user" => $db_user);
                } else {
                    $res = 20;
                }
            } else {
                $res = 10;
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

    function listar_respaldo()
    {
        try {
            $c = modelo_conexion::conexionPDO();
            $sql = "SELECT
            respaldo.id_respaldo,
            CONCAT_WS( ' ', usuario.nombres, usuario.apellidos ) AS usuario,
            respaldo.fecha_hora,
            respaldo.ruta,
            respaldo.estado 
            FROM
            usuario
            INNER JOIN respaldo ON usuario.id_usuario = respaldo.id_usuario order by respaldo.id_respaldo desc";
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
