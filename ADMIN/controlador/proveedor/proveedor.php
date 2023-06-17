<?php
require '../../modelo/Model_proveedor.php';
$MP = new Model_proveedor();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "nuevo_proveedor") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $razons = htmlspecialchars($_POST["razons"], ENT_QUOTES, 'UTF-8');
        $rucs = htmlspecialchars($_POST["rucs"], ENT_QUOTES, 'UTF-8');
        $telefono_p = htmlspecialchars($_POST["telefono_p"], ENT_QUOTES, 'UTF-8');
        $correo_p = htmlspecialchars($_POST["correo_p"], ENT_QUOTES, 'UTF-8');
        $direccions = htmlspecialchars($_POST["direccions"], ENT_QUOTES, 'UTF-8');
        $descripcions = htmlspecialchars($_POST["descripcions"], ENT_QUOTES, 'UTF-8');
        $encargados = htmlspecialchars($_POST["encargados"], ENT_QUOTES, 'UTF-8');
        $sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES, 'UTF-8');

        $consulta = $MP->nuevo_proveedor($razons, $rucs, $telefono_p, $correo_p, $direccions, $descripcions, $encargados, $sexo);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listardo_proveedores") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MP->listardo_proveedores();
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
if ($_POST["funcion"] === "estado_proveedor") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MP->estado_proveedor($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_proveedor") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');

        $razons = htmlspecialchars($_POST["razons"], ENT_QUOTES, 'UTF-8');
        $rucs = htmlspecialchars($_POST["rucs"], ENT_QUOTES, 'UTF-8');
        $telefono_p = htmlspecialchars($_POST["telefono_p"], ENT_QUOTES, 'UTF-8');
        $correo_p = htmlspecialchars($_POST["correo_p"], ENT_QUOTES, 'UTF-8');
        $direccions = htmlspecialchars($_POST["direccions"], ENT_QUOTES, 'UTF-8');
        $descripcions = htmlspecialchars($_POST["descripcions"], ENT_QUOTES, 'UTF-8');
        $encargados = htmlspecialchars($_POST["encargados"], ENT_QUOTES, 'UTF-8');
        $sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES, 'UTF-8');

        $consulta = $MP->editar_proveedor($id, $razons, $rucs, $telefono_p, $correo_p, $direccions, $descripcions, $encargados, $sexo);
        echo $consulta;
    }
    exit();
}
