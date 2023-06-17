<?php
require '../../modelo/Model_multas.php';
$MM = new Model_multas();
session_start();

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_datos_empleado") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $valor = htmlspecialchars($_POST['valor'], ENT_QUOTES, 'UTF-8');

        $consulta = $MM->traer_datos_empleado($valor);
        if (!empty($consulta)) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_tio_sancion") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MM->listar_tio_sancion();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "guadar_sancion") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id_empleado = htmlspecialchars($_POST["id_empleado"], ENT_QUOTES, 'UTF-8');
        $fe_ho = htmlspecialchars($_POST["fe_ho"], ENT_QUOTES, 'UTF-8'); 
        $tipo_sancin = htmlspecialchars($_POST["tipo_sancin"], ENT_QUOTES, 'UTF-8');
        $motivo_i = htmlspecialchars($_POST["motivo_i"], ENT_QUOTES, 'UTF-8');
        $multa_dolra = htmlspecialchars($_POST["multa_dolra"], ENT_QUOTES, 'UTF-8');
        $observacion = htmlspecialchars($_POST["observacion"], ENT_QUOTES, 'UTF-8');

        $consulta = $MM->guadar_sancion($id_empleado, $fe_ho, $tipo_sancin, $motivo_i, $multa_dolra, $observacion);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_sancion") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $fe_ho = htmlspecialchars($_POST["fe_ho"], ENT_QUOTES, 'UTF-8'); 
        $tipo_sancin = htmlspecialchars($_POST["tipo_sancin"], ENT_QUOTES, 'UTF-8');
        $motivo_i = htmlspecialchars($_POST["motivo_i"], ENT_QUOTES, 'UTF-8');
        $multa_dolra = htmlspecialchars($_POST["multa_dolra"], ENT_QUOTES, 'UTF-8');
        $observacion = htmlspecialchars($_POST["observacion"], ENT_QUOTES, 'UTF-8');

        $consulta = $MM->editar_sancion($id, $fe_ho, $tipo_sancin, $motivo_i, $multa_dolra, $observacion);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "eliminar_multa") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8'); 

        $consulta = $MM->eliminar_multa($id);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_datos_empleado_multa") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $valor = htmlspecialchars($_POST['valor'], ENT_QUOTES, 'UTF-8');

        $consulta = $MM->traer_datos_empleado_multa($valor);
        if (!empty($consulta)) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "traer_multas_del_empleado") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

        $consulta = $MM->traer_multas_del_empleado($id);

        if($consulta){
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        }else{
            echo 0;
        }
    }
    exit();
}
