<?php
require '../../modelo/model_backup.php';
$MBK = new model_backup();
session_start();

/////////////////////////////////
if ($_POST["funcion"] === "realizar_respaldo") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        date_default_timezone_set('America/Guayaquil');
        $fecha_archivo = date("YmdHis");

        $id = $_SESSION["id_usu"];
        $pass =  htmlspecialchars($_POST['pass1'], ENT_QUOTES, 'UTF-8');

        $consulta = $MBK->realizar_respaldo($id, $pass, $fecha_archivo);
        if ($consulta != 10 || $consulta != 20) {

            $db_host = $consulta["host"]; //Host del Servidor MySQL
            $db_name = $consulta["name"]; //Nombre de la Base de datos
            $db_user = $consulta["user"]; //Usuario de MySQL
            $db_pass = $consulta["pass"]; //Password de Usuario MySQL

            $salida_sql = '../../img/backup/' . $fecha_archivo . '_' . $db_name . '.sql';
            $dump = "mysqldump --h$db_host -u$db_user -p$db_pass --opt $db_name > $salida_sql";
            system($dump, $output);

            $zip = new ZipArchive();
            $salida_zip = '../../img/backup/' . $fecha_archivo . '_' . $db_name . '.zip';

            if ($zip->open($salida_zip, ZIPARCHIVE::CREATE) === true) {
                $zip->addFile($salida_sql);
                $zip->close();
                unlink($salida_sql);
                echo 1;
            } else {
                echo 0;
            }
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_respaldo") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MBK->listar_respaldo();
        if ($data) {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo '{
                "sEcho": 1,
                "iTotalRecords": "0",
                "iTotalDisplayRecords": "0",
                "aaData": []
            }';
        }
    }
    exit();
}
