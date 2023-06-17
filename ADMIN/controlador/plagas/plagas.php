<?php
require '../../modelo/Modelo_plagas.php';
$MPG = new Modelo_plagas();
session_start();

///////////////////
if ($_POST["funcion"] === "listar_tipos_pgas") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $data = $MPG->listar_tipos_pgas();
        //jason encode para retornar los datos
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "nuevo_registro_plagas") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id_usu = $_SESSION["id_usu"];
        $prodcuciion_id = htmlspecialchars($_POST['prodcuciion_id'], ENT_QUOTES, 'UTF-8');
        $fecha = htmlspecialchars($_POST['fecha'], ENT_QUOTES, 'UTF-8');
        $tipo_plaga = htmlspecialchars($_POST['tipo_plaga'], ENT_QUOTES, 'UTF-8');
        $obsrvacion = htmlspecialchars($_POST['obsrvacion'], ENT_QUOTES, 'UTF-8');

        $nombrearchivo = htmlspecialchars($_POST['nombrearchivo'], ENT_QUOTES, 'UTF-8');
        //esto es para saber si el file trae datos

        if (is_array($_FILES) && count($_FILES) > 0) {
            $ruta = "img/plaga/$nombrearchivo";
            $consulta = $MPG->nuevo_registro_plagas($prodcuciion_id, $fecha, $tipo_plaga, $obsrvacion, $ruta, $id_usu);
            if ($consulta == 1) {
                if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/plaga/" . $nombrearchivo)) {
                    echo $consulta;
                } else {
                    echo 3;
                }
            } else {
                echo $consulta;
            }
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listr_plagas") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MPG->listr_plagas();
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
if ($_POST["funcion"] === "eliinar_el_registro") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $foto = htmlspecialchars($_POST['foto'], ENT_QUOTES, 'UTF-8');

        $consulta = $MPG->eliinar_el_registro($id);
        if ($consulta == 1) {
            unlink("../../" . $foto);
            echo $consulta;
        } else {
            echo $consulta;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "listar_tratamientos_plagas") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $data = $MPG->listar_tratamientos_plagas();
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

/////////////////////
if ($_POST["funcion"] === "trata_fin_plaga") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $fech_fin = htmlspecialchars($_POST['fech_fin'], ENT_QUOTES, 'UTF-8');
        $consulta = $MPG->trata_fin_plaga($fech_fin);
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

/////////////////////
if ($_POST["funcion"] === "guardar_avance") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
        $pocentaje_ = htmlspecialchars($_POST['pocentaje_'], ENT_QUOTES, 'UTF-8');

        $consulta = $MPG->guardar_avance($id, $pocentaje_);
        echo $consulta;
    }
    exit();
}
