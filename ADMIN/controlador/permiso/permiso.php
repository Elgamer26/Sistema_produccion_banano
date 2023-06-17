<?php
require '../../modelo/Model_tipo_permiso.php';
$MP = new Model_tipo_permiso();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_permiso") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8'); 

        $consulta = $MP->registrar_permiso($nombre);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_tipo_permisos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MP->listar_tipo_permisos();
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
if ($_POST["funcion"] === "estado_tipo_permiso") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MP->estado_tipo_permiso($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_tipo_permiso") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8'); 
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8'); 

        $consulta = $MP->editar_tipo_permiso($nombre, $id);
        echo $consulta;
    }
    exit();
}


///////////////////////////////////// 
if ($_POST["funcion"] === "traer_datos_empleado") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $valor = htmlspecialchars($_POST['valor'], ENT_QUOTES, 'UTF-8');

        $consulta = $MP->traer_datos_empleado($valor);
        if (!empty($consulta)) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

///////////////////
if ($_POST["funcion"] === "listar_tipo_permiso") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MP->listar_tipo_permiso();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrr_permisos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id_empleado = htmlspecialchars($_POST["id_empleado"], ENT_QUOTES, 'UTF-8');
        $Fecha_i = htmlspecialchars($_POST["Fecha_i"], ENT_QUOTES, 'UTF-8'); 
        $Fecha_f = htmlspecialchars($_POST["Fecha_f"], ENT_QUOTES, 'UTF-8'); 
        $tip_permiso = htmlspecialchars($_POST["tip_permiso"], ENT_QUOTES, 'UTF-8');       
        $observacion = htmlspecialchars($_POST["observacion"], ENT_QUOTES, 'UTF-8');

        $consulta = $MP->registrr_permisos($id_empleado, $Fecha_i, $Fecha_f, $tip_permiso, $observacion);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_permisos_empleado") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MP->listar_permisos_empleado();
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
if ($_POST["funcion"] === "elimianr_permiso") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8'); 

        $consulta = $MP->elimianr_permiso($id);
        
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "traer_empleado_permisos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $valor = htmlspecialchars($_POST['valor'], ENT_QUOTES, 'UTF-8');

        $consulta = $MP->traer_empleado_permisos($valor);
        if (!empty($consulta)) {
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////
if ($_POST["funcion"] === "traer_detalle_permios") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $consulta = $MP->traer_detalle_permios($id);
        if($consulta){
            echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
        }else{
            echo 0;
        }
    }
    exit();
}