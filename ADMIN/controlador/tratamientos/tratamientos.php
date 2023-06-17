<?php
require '../../modelo/Modelo_tratamientos.php';
$MTT = new Modelo_tratamientos();
session_start();

///////////////////
if ($_POST["funcion"] === "listar_produccion_plagada") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MTT->listar_produccion_plagada();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_tipo_tratamiento") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MTT->listar_tipo_tratamiento();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_tipo_quimico") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MTT->listar_tipo_quimico();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}


/////////////////////////////////////
if ($_POST["funcion"] === "registrar_tratamiento") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $prodcuciion_id = htmlspecialchars($_POST['prodcuciion_id'], ENT_QUOTES, 'UTF-8');
        $tipo_tratamiento = htmlspecialchars($_POST['tipo_tratamiento'], ENT_QUOTES, 'UTF-8');
        $obsrvacion = htmlspecialchars($_POST['obsrvacion'], ENT_QUOTES, 'UTF-8'); 

        $fecha_inii = htmlspecialchars($_POST['fecha_inii'], ENT_QUOTES, 'UTF-8');
        $fecha_fini = htmlspecialchars($_POST['fecha_fini'], ENT_QUOTES, 'UTF-8');
        $dias = htmlspecialchars($_POST['dias'], ENT_QUOTES, 'UTF-8'); 
        $tipo_quimico = htmlspecialchars($_POST['tipo_quimico'], ENT_QUOTES, 'UTF-8');
        $cantida_litros = htmlspecialchars($_POST['cantida_litros'], ENT_QUOTES, 'UTF-8'); 

        $consulta = $MTT->registrar_tratamiento($prodcuciion_id, $tipo_tratamiento, $obsrvacion, $fecha_inii, $fecha_fini, $dias, $tipo_quimico, $cantida_litros);
        echo $consulta;
    }
    exit();
}