<?php
require '../../modelo/Model_rol.php';
$MR = new Model_rol();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_rol") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $estado = htmlspecialchars($_POST["estado"], ENT_QUOTES, 'UTF-8');

        $consulta = $MR->crear_rol($nombre, $estado);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_permiso_rol") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');

        $config = htmlspecialchars($_POST["config"], ENT_QUOTES, 'UTF-8');
        $respaldos = htmlspecialchars($_POST["respaldos"], ENT_QUOTES, 'UTF-8');
        $empleados = htmlspecialchars($_POST["empleados"], ENT_QUOTES, 'UTF-8');
        $multas = htmlspecialchars($_POST["multas"], ENT_QUOTES, 'UTF-8');
        $asistecias = htmlspecialchars($_POST["asistecias"], ENT_QUOTES, 'UTF-8');
        $permisos = htmlspecialchars($_POST["permisos"], ENT_QUOTES, 'UTF-8');
        $rol_pagos = htmlspecialchars($_POST["rol_pagos"], ENT_QUOTES, 'UTF-8');
        $bodega = htmlspecialchars($_POST["bodega"], ENT_QUOTES, 'UTF-8');
        $compras = htmlspecialchars($_POST["compras"], ENT_QUOTES, 'UTF-8');
        $produccion = htmlspecialchars($_POST["produccion"], ENT_QUOTES, 'UTF-8');
        $ventas = htmlspecialchars($_POST["ventas"], ENT_QUOTES, 'UTF-8');
        $control_plagas = htmlspecialchars($_POST["control_plagas"], ENT_QUOTES, 'UTF-8');
        $reportes = htmlspecialchars($_POST["reportes"], ENT_QUOTES, 'UTF-8');

        $consulta = $MR->crear_permiso($id, $config, $respaldos, $empleados, $multas, $asistecias, $permisos, $rol_pagos, $bodega, $compras, $produccion, $ventas, $control_plagas, $reportes);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_roles") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MR->listar_roles();
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

// /////////////////////////////////////
// if ($_POST["funcion"] === "registrar_permiso_rol") {

//     if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

//         $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
//         $config = htmlspecialchars($_POST["config"], ENT_QUOTES, 'UTF-8');

//         $consulta = $MR->crear_permiso($id, $config);
//         echo $consulta;
//     }
//     exit();
// }

/////////////////////////////////////
if ($_POST["funcion"] === "estado_rol") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MR->estado_rol($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_rol") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');

        $consulta = $MR->editar_rol($id, $nombre);
        echo $consulta;
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "obtener_permisos") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $consulta = $MR->obtener_pemisos($id);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_permisos") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id_rol = htmlspecialchars($_POST["id_rol"], ENT_QUOTES, 'UTF-8');
        $id_permiso = htmlspecialchars($_POST["id_permiso"], ENT_QUOTES, 'UTF-8');
        $conf = htmlspecialchars($_POST["conf"], ENT_QUOTES, 'UTF-8');

        $respaldos = htmlspecialchars($_POST["respaldos"], ENT_QUOTES, 'UTF-8');
        $empleados = htmlspecialchars($_POST["empleados"], ENT_QUOTES, 'UTF-8');
        $multas = htmlspecialchars($_POST["multas"], ENT_QUOTES, 'UTF-8');
        $asistecias = htmlspecialchars($_POST["asistecias"], ENT_QUOTES, 'UTF-8');
        $permisos = htmlspecialchars($_POST["permisos"], ENT_QUOTES, 'UTF-8');
        $rol_pagos = htmlspecialchars($_POST["rol_pagos"], ENT_QUOTES, 'UTF-8');
        $bodega = htmlspecialchars($_POST["bodega"], ENT_QUOTES, 'UTF-8');
        $compras = htmlspecialchars($_POST["compras"], ENT_QUOTES, 'UTF-8');
        $produccion = htmlspecialchars($_POST["produccion"], ENT_QUOTES, 'UTF-8');
        $ventas = htmlspecialchars($_POST["ventas"], ENT_QUOTES, 'UTF-8');
        $control_plagas = htmlspecialchars($_POST["control_plagas"], ENT_QUOTES, 'UTF-8');
        $reportes = htmlspecialchars($_POST["reportes"], ENT_QUOTES, 'UTF-8');

        $consulta = $MR->editar_permiso($id_rol, $id_permiso, $conf, $respaldos, $empleados, $multas, $asistecias, $permisos, $rol_pagos, $bodega, $compras, $produccion, $ventas, $control_plagas, $reportes);
        echo $consulta;
    }
    exit();
}
