<?php
require '../../modelo/Model_tipo_actividad.php';
$MTA = new Model_tipo_actividad();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_tipo_actividad") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTA->registrar_tipo_actividad($nombre, $descripcion);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_tipo_actividads") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MTA->listar_tipo_actividads();
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
if ($_POST["funcion"] === "estado_tipo_actividad") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTA->estado_tipo_actividad($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_tipo_actividad") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTA->editar_tipo_actividad($id, $nombre, $descripcion);
        echo $consulta;
    }
    exit();
}