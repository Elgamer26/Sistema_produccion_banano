<?php
require '../../modelo/Model_marcar.php';
$MA = new Model_marcar();
session_start();

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_datos_empleado_asistencia") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $valor = htmlspecialchars($_POST['valor'], ENT_QUOTES, 'UTF-8');

        $consulta = $MA->traer_datos_empleado_asistencia($valor);
        if (!empty($consulta)) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "marcar_entrada") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id_empleado"], ENT_QUOTES, 'UTF-8');
        $fe_ho = htmlspecialchars($_POST["fe_ho"], ENT_QUOTES, 'UTF-8');

        $consulta = $MA->marcar_entrada($id, $fe_ho);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_datos_empleado_asistencia_salida") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $valor = htmlspecialchars($_POST['valor'], ENT_QUOTES, 'UTF-8');

        $consulta = $MA->traer_datos_empleado_asistencia_salida($valor);
        if (!empty($consulta)) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "marcar_salida") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id_empleado"], ENT_QUOTES, 'UTF-8');
        $id_asi = htmlspecialchars($_POST["id_asistencia"], ENT_QUOTES, 'UTF-8');
        $fe_ho = htmlspecialchars($_POST["fe_ho"], ENT_QUOTES, 'UTF-8');

        $consulta = $MA->marcar_salida($id, $fe_ho, $id_asi);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_asistencias") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MA->listar_asistencias();
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
if ($_POST["funcion"] === "traer_datos_empleado_asistencias") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $valor = htmlspecialchars($_POST['valor'], ENT_QUOTES, 'UTF-8');

        $consulta = $MA->traer_datos_empleado_asistencias($valor);
        if (!empty($consulta)) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "traer_el_empleado_asistencias") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

        $consulta = $MA->traer_el_empleado_asistencias($id);

        if($consulta){
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        }else{
            echo 0;
        }
    }
    exit();
}