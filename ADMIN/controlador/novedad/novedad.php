<?php
require '../../modelo/Model_novedad.php';
$MNO = new Model_novedad();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_novedad") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

        $consulta = $MNO->registrar_novedad($nombre, $descripcion);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_novedad") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MNO->listar_novedad();
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
if ($_POST["funcion"] === "cambiar_estado_novedad") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MNO->cambiar_estado_novedad($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_tipo_novedades") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

        $consulta = $MNO->editar_tipo_novedades($id, $nombre, $descripcion);
        echo $consulta;
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "traer_novedades_tipo") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MNO->traer_novedades_tipo();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "registrar_noveda_produccion") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $prodcuciion_id = htmlspecialchars($_POST["prodcuciion_id"], ENT_QUOTES, 'UTF-8');
        $fecha_ras_des = htmlspecialchars($_POST["fecha_ras_des"], ENT_QUOTES, 'UTF-8');
        $numero_ra = htmlspecialchars($_POST["numero_ra"], ENT_QUOTES, 'UTF-8');
        $tipo_ses = htmlspecialchars($_POST["tipo_ses"], ENT_QUOTES, 'UTF-8');

        $detalle_novedad = htmlspecialchars($_POST["detalle_novedad"], ENT_QUOTES, 'UTF-8');

        $data = $MNO->registrar_noveda_produccion($prodcuciion_id, $fecha_ras_des, $numero_ra, $tipo_ses, $detalle_novedad);
        echo $data;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_novedad_produccion") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MNO->listar_novedad_produccion();
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

///////////////////
if ($_POST["funcion"] === "eliminar_la_novedad") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8'); 
        $data = $MNO->eliminar_la_novedad($id);
        echo $data;
    }
    exit();
}
