<?php
require '../../modelo/Modelo_cintas.php';
$MC = new Modelo_cintas();

/////////////////////////////////////
if ($_POST["funcion"] === "listado_tipos_cintas") {


    $data = $MC->listado_tipos_cintas();
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

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_color") {


    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $color = htmlspecialchars($_POST["color"], ENT_QUOTES, 'UTF-8');

    $consulta = $MC->editar_color($id, $color);
    echo $consulta;

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "traer_cintas_semanas") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');

    $consulta = $MC->traer_cintas_semanas($id);
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "obtener_id_hectarea") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');

    $consulta = $MC->obtener_id_hectarea($id);
    echo json_encode($consulta, JSON_UNESCAPED_UNICODE);

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registra_cintass") {


    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $semana = htmlspecialchars($_POST["semana"], ENT_QUOTES, 'UTF-8');
    $fecha = htmlspecialchars($_POST["fecha"], ENT_QUOTES, 'UTF-8');
    $detalle = htmlspecialchars($_POST["detalle"], ENT_QUOTES, 'UTF-8');
    $id_h = htmlspecialchars($_POST["id_h"], ENT_QUOTES, 'UTF-8');

    $consulta = $MC->registra_cintass($id, $semana, $fecha, $detalle, $id_h);
    echo $consulta;

    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "traer_detalle_cintas") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $consulta = $MC->traer_detalle_cintas($id);
    if (!empty($consulta)) {
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    } else {
        echo 0;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "eliminar_detalle") {

    $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
    $idpro = htmlspecialchars($_POST["idpro"], ENT_QUOTES, 'UTF-8'); 

    $consulta = $MC->eliminar_detalle($id, $idpro);
    echo $consulta;

    exit();
}
