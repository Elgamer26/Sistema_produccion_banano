<?php
require '../../modelo/Modelo_deschos_rasimos.php';
$P_D_R = new Modelo_deschos_rasimos();
session_start();

///////////////////
if ($_POST["funcion"] === "listas_lotes_cosechas") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $P_D_R->listas_lotes_cosechas();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "traer_fechas") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $data = $P_D_R->traer_fechas($id);
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "registrar_deschos_csechas") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $prodcuciion_id = htmlspecialchars($_POST["prodcuciion_id"], ENT_QUOTES, 'UTF-8');
        $fecha_ras_des = htmlspecialchars($_POST["fecha_ras_des"], ENT_QUOTES, 'UTF-8');
        $numero_ra = htmlspecialchars($_POST["numero_ra"], ENT_QUOTES, 'UTF-8');
        $tipo_ses = htmlspecialchars($_POST["tipo_ses"], ENT_QUOTES, 'UTF-8');

        $cjas_oblig = htmlspecialchars($_POST["cjas_oblig"], ENT_QUOTES, 'UTF-8');
        $peso_cajas = htmlspecialchars($_POST["peso_cajas"], ENT_QUOTES, 'UTF-8');

        $data = $P_D_R->registrar_deschos_csechas($prodcuciion_id, $fecha_ras_des, $numero_ra, $tipo_ses, $cjas_oblig, $peso_cajas);
        echo $data;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_racimos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $P_D_R->listar_racimos();
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
if ($_POST["funcion"] === "cambiar_estado_racimos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $P_D_R->cambiar_estado_racimos($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_deschos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $P_D_R->listar_deschos();
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
if ($_POST["funcion"] === "cambiar_estado_desechos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $P_D_R->cambiar_estado_desechos($id, $dato);
        echo $consulta;
    }
    exit();
}
