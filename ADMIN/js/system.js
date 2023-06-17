var funcion;

function traer_datos_dasboard_admin() {
    funcion = "traer_datos_dasboard_admin"
    $.ajax({
        url: "../ADMIN/controlador/system/system.php",
        type: "POST",
        data: { funcion: funcion },
    }).done(function (response) {
        var data = JSON.parse(response);

        $("#numer_trabajadores").html(data[0]['total_empeados'][0][0]);
        $("#total_material").html(data[0]['total_material'][0][0]);
        $("#total_insumos").html(data[0]['total_insumos'][0][0]);
        $("#total_prod_iniciados").html(data[0]['total_prod_iniciados'][0][0]);

    });
}

function traer_permiso_usuario() {
    funcion = "traer_permiso_usuario"
    $.ajax({
        url: "../ADMIN/controlador/system/system.php",
        type: "POST",
        data: { funcion: funcion },
    }).done(function (response) {

        var data = JSON.parse(response);
        data[0]["configuracion"].toString() == "true" ? $("#config_in").css("display", "block") : $("#config_in").css("display", "none");
        data[0]["respaldos"].toString() == "true" ? $("#respaldos_in").css("display", "block") : $("#respaldos_in").css("display", "none");
        data[0]["empleados"].toString() == "true"  ? $("#empleados_in").css("display", "block") : $("#empleados_in").css("display", "none");
        data[0]["multas"].toString() == "true" ?  $("#multas_in").css("display", "block") : $("#multas_in").css("display", "none");
        data[0]["asistecias"].toString() == "true" ? $("#asistecias_in").css("display", "block") : $("#asistecias_in").css("display", "none");
        data[0]["permisos"].toString() == "true" ? $("#permisos_in").css("display", "block") : $("#permisos_in").css("display", "none");
        data[0]["rol_pagos"].toString() == "true" ? $("#rol_pagos_in").css("display", "block") : $("#rol_pagos_in").css("display", "none");
        data[0]["bodega"].toString() == "true" ? $("#bodega_in").css("display", "block") : $("#bodega_in").css("display", "none");
        data[0]["compras"].toString() == "true" ? $("#compras_in").css("display", "block") : $("#compras_in").css("display", "none");
        data[0]["produccion"].toString() == "true" ? $("#produccion_in").css("display", "block") : $("#produccion_in").css("display", "none");
        data[0]["ventas"].toString() == "true" ? $("#ventas_in").css("display", "block") : $("#ventas_in").css("display", "none");
        data[0]["control_plagas"].toString() == "true" ? $("#control_plagas_in").css("display", "block") : $("#control_plagas_in").css("display", "none");
        data[0]["reportes"].toString() == "true" ? $("#reportes_in").css("display", "block") : $("#reportes_in").css("display", "none");

    });
}