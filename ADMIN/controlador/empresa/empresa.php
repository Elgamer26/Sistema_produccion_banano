<?php
require '../../modelo/Model_empresa.php';
$ME = new Model_empresa();
session_start();

/////////////////////////////////////
if ($_POST["funcion"] === "traer_datos_de_empresa") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {
        $consulta = $ME->traer_datos_optica();
        echo json_encode($consulta, JSON_UNESCAPED_UNICODE);
    }
    exit();
}

///////////////////////////////////// 
if ($_POST["funcion"] === "cambiar_foto_perfilempresa") {

    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nombrearchivo = htmlspecialchars($_POST["nombrearchivo"], ENT_QUOTES, 'UTF-8');
        $ruta_actual = htmlspecialchars($_POST["ruta_actual"], ENT_QUOTES, 'UTF-8');

        //esto es para saber si el file trae datos
        if (is_array($_FILES) && count($_FILES) > 0) {
            if ($ruta_actual != "img/empresa/banano.jpg") {
                $delete = $ruta_actual;
                unlink("../../" . $delete);
            }
            if (move_uploaded_file($_FILES['foto']["tmp_name"], "../../img/empresa/" . $nombrearchivo)) {
                $ruta = "img/empresa/$nombrearchivo";
                $consulta = $ME->editar_foto_perfil_empresa($ruta);
                echo $consulta;
            } else {
                echo 0;
            }
        } else {
            echo 0;
        }
    }
    exit();
}

/////////////////////////////////////
if ($_POST["funcion"] === "cambiar_datos_empresa") {
    if (isset($_SESSION["id_rol"]) && isset($_SESSION["id_usu"])) {

        $nomber = htmlspecialchars($_POST['nomber'], ENT_QUOTES, 'UTF-8');
        $ruc = htmlspecialchars($_POST['ruc'], ENT_QUOTES, 'UTF-8');
        $direcc = htmlspecialchars($_POST['direcc'], ENT_QUOTES, 'UTF-8');
        $telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
        $dueño = htmlspecialchars($_POST['dueño'], ENT_QUOTES, 'UTF-8');
        $descrp = htmlspecialchars($_POST['descrp'], ENT_QUOTES, 'UTF-8'); 

        $consulta = $ME->editar_empresa($nomber, $ruc, $direcc, $telefono, $correo, $dueño, $descrp);
        echo $consulta;
    }
    exit();
}
