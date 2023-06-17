<?php
require '../../modelo/Model_cliente.php';
$MC = new Model_cliente();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "registrar_clientes") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombress = htmlspecialchars($_POST["nombress"], ENT_QUOTES, 'UTF-8');
        $apellidoss = htmlspecialchars($_POST["apellidoss"], ENT_QUOTES, 'UTF-8');
        $numero_docu = htmlspecialchars($_POST["numero_docu"], ENT_QUOTES, 'UTF-8');
        $telefono_p = htmlspecialchars($_POST["telefono_p"], ENT_QUOTES, 'UTF-8');
        $correo_p = htmlspecialchars($_POST["correo_p"], ENT_QUOTES, 'UTF-8');
        $direccions = htmlspecialchars($_POST["direccions"], ENT_QUOTES, 'UTF-8');
        $sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES, 'UTF-8');

        $consulta = $MC->registrar_clientes($nombress, $apellidoss, $numero_docu, $telefono_p, $correo_p, $direccions, $sexo);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_clientes") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MC->listar_clientes();
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
if ($_POST["funcion"] === "estado_cliente") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MC->estado_cliente($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editando_cliente_clientes") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombress = htmlspecialchars($_POST["nombress"], ENT_QUOTES, 'UTF-8');
        $apellidoss = htmlspecialchars($_POST["apellidoss"], ENT_QUOTES, 'UTF-8');
        $numero_docu = htmlspecialchars($_POST["numero_docu"], ENT_QUOTES, 'UTF-8');
        $telefono_p = htmlspecialchars($_POST["telefono_p"], ENT_QUOTES, 'UTF-8');
        $correo_p = htmlspecialchars($_POST["correo_p"], ENT_QUOTES, 'UTF-8');
        $direccions = htmlspecialchars($_POST["direccions"], ENT_QUOTES, 'UTF-8');
        $sexo = htmlspecialchars($_POST["sexo"], ENT_QUOTES, 'UTF-8');

        $consulta = $MC->editando_cliente_clientes($id, $nombress, $apellidoss, $numero_docu, $telefono_p, $correo_p, $direccions, $sexo);
        echo $consulta;
    }
    exit();
}
