<?php
require '../../modelo/Modelo_beneficio.php';
$MBE = new Modelo_beneficio();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_beneficio") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $valor = htmlspecialchars($_POST["valor"], ENT_QUOTES, 'UTF-8');
        $tipo = htmlspecialchars($_POST["tipo"], ENT_QUOTES, 'UTF-8');

        $consulta = $MBE->registrar_beneficio($nombre, $valor, $tipo);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listra_beneficios") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MBE->listra_beneficios();
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

/////////////////////////////////////
if ($_POST["funcion"] === "estado_benedifico") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8'); 

        $consulta = $MBE->estado_benedifico($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editr_beneficio") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $valor = htmlspecialchars($_POST["valor"], ENT_QUOTES, 'UTF-8');
        $tipo = htmlspecialchars($_POST["tipo"], ENT_QUOTES, 'UTF-8');

        $consulta = $MBE->editr_beneficio($id, $nombre, $valor, $tipo);
        echo $consulta;
    }
    exit();
}
