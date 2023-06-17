<?php
require '../../modelo/Model_tipo_plaga.php';
$MTP = new Model_tipo_plaga();
session_start();


/////////////////////////////////////
if ($_POST["funcion"] === "mueva_tipo_plaga") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');

        $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
        //esto es para saber si el file trae datos

        if (is_array($_FILES) && count($_FILES) > 0) {
            $ruta = "img/plaga/$nombrearchivo";
            $consulta = $MTP->mueva_tipo_plaga($nombre, $descripcion, $ruta);
            if ($consulta == 1) {
                if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/plaga/" . $nombrearchivo)) {
                    echo $consulta;
                } else {
                    echo 0;
                }
            } else {
                echo $consulta;
            }
        } else {
            $ruta = "img/plaga/plaga.jpg";
            $consulta = $MTP->mueva_tipo_plaga($nombre, $descripcion, $ruta);
            echo $consulta;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_tipo_plagas") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MTP->listar_tipo_plagas();
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
if ($_POST["funcion"] === "estatottipopla") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTP->estatottipopla($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_tipo_plaga") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTP->editar_tipo_plaga($id, $nombre, $descripcion);
        echo $consulta;

    
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "creando_tipo_plaga_tra") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTP->creando_tipo_plaga_tra($nombre, $descripcion);
        echo $consulta;

    
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_tipo_tratamiento") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MTP->listar_tipo_tratamiento();
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
if ($_POST["funcion"] === "esta_tipo_tratamiento") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTP->esta_tipo_tratamiento($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editar_tipo_tratamiento") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTP->editar_tipo_tratamiento($id, $nombre, $descripcion);
        echo $consulta;

    
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "nuevoo_tipo_quimico") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTP->nuevoo_tipo_quimico($nombre, $descripcion);
        echo $consulta;

    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_tipo_quimico") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MTP->listar_tipo_quimico();
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
if ($_POST["funcion"] === "estado_tipo_quimico") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $dato = htmlspecialchars($_POST["dato"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTP->estado_tipo_quimico($id, $dato);
        echo $consulta;
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "editarr_tipo_quimico") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST["id"], ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST["descripcion"], ENT_QUOTES, 'UTF-8');

        $consulta = $MTP->editarr_tipo_quimico($id, $nombre, $descripcion);
        echo $consulta;

    
    }
    exit();
}
