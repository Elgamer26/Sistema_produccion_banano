<?php
require '../../modelo/Model_lote.php';
$ML = new Model_lote();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_lotes") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre_lote = htmlspecialchars($_POST["nombre_lote"], ENT_QUOTES, 'UTF-8');
        $direccion = htmlspecialchars($_POST["direccion"], ENT_QUOTES, 'UTF-8');
        $Longitud = htmlspecialchars($_POST["Longitud"], ENT_QUOTES, 'UTF-8');
        $Latitud = htmlspecialchars($_POST["Latitud"], ENT_QUOTES, 'UTF-8');
        $hectarea = htmlspecialchars($_POST["hectarea"], ENT_QUOTES, 'UTF-8');

        $consulta = $ML->registrar_lotes($nombre_lote, $direccion, $Longitud, $Latitud, $hectarea);
        echo $consulta;
    }
    exit();
}

//////////////////////
if ($_POST["funcion"] === "registrar_detalle_hectarea") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $hectarea = htmlspecialchars($_POST['hectarea'], ENT_QUOTES, 'UTF-8');
        $arraglo_hectarea = explode(",", $hectarea); //aqui separo los datos
        //bucle para contar la cantidad de datos
        for ($i = 0; $i < count($arraglo_hectarea); $i++) {
            $consulta = $ML->registrar_detalle_hectarea($id, $arraglo_hectarea[$i]);
        }
        echo $consulta;
    }
    exit();
}

//////////////////////
if ($_POST["funcion"] === "cargra_detalle_lote") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $ML->cargra_detalle_lote($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

//////////////////////
if ($_POST["funcion"] === "ver_produccion") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $ML->ver_produccion($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_lotes") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $ML->listar_lotes();
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
if ($_POST["funcion"] === "estado_lote") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $ML->estado_lote($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_lotess") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombre_lote = htmlspecialchars($_POST["nombre_lote"], ENT_QUOTES, 'UTF-8');
        $direccion = htmlspecialchars($_POST["direccion"], ENT_QUOTES, 'UTF-8');
        $Longitud = htmlspecialchars($_POST["Longitud"], ENT_QUOTES, 'UTF-8');
        $Latitud = htmlspecialchars($_POST["Latitud"], ENT_QUOTES, 'UTF-8');
        $hectarea = htmlspecialchars($_POST["hectarea"], ENT_QUOTES, 'UTF-8');

        $consulta = $ML->editar_lotess($id, $nombre_lote, $direccion, $Longitud, $Latitud, $hectarea);
        echo $consulta;
    }
    exit();
}
