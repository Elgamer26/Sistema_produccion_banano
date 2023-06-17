<?php
require '../../modelo/Modelo_actividad.php';
$MA = new Modelo_actividad();
session_start();

///////////////////
if ($_POST["funcion"] === "listar_trabajador_ac") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MA->listar_trabajador_ac();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "traer_datos_emplead") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

        $consulta = $MA->traer_datos_emplead($id);
        if ($consulta) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_actividades") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MA->listar_actividades();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_actividad") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id_empleado = htmlspecialchars($_POST["id_empleado"], ENT_QUOTES, 'UTF-8');
        $tipo_actividad = htmlspecialchars($_POST["tipo_actividad"], ENT_QUOTES, 'UTF-8');
        $costo_acivdad = htmlspecialchars($_POST["costo_acivdad"], ENT_QUOTES, 'UTF-8');
        $fecha_asiga = htmlspecialchars($_POST["fecha_asiga"], ENT_QUOTES, 'UTF-8');

        $consulta = $MA->registrar_actividad($id_empleado, $tipo_actividad, $costo_acivdad, $fecha_asiga);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_asignacion_actividad") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MA->listar_asignacion_actividad();
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
if ($_POST["funcion"] === "cambiar_estado_actividades") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MA->cambiar_estado_actividades($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_actividad") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $tipo_actividad = htmlspecialchars($_POST["tipo_actividad"], ENT_QUOTES, 'UTF-8');
        $costo_acivdad = htmlspecialchars($_POST["costo_acivdad"], ENT_QUOTES, 'UTF-8'); 

        $consulta = $MA->editar_actividad($id, $tipo_actividad, $costo_acivdad);
        echo $consulta;
    }
    exit();
}
