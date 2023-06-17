<script type="text/javascript" src="js/rol_pagos.js"></script>

<?php
date_default_timezone_set('America/Guayaquil');
$time = date('H:i', time());
$fecha = date("Y-m-d");
?>

<br>
<section class="content-header">
    <h3>
        <b> Nuevo rol de pagos a empleados <i class="fa fa-money" style="color:green;"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Rol de pagos del empleado</div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-12">
                        <div class="ibox ibox-primary">
                            <div class="ibox-head">
                                <div class="ibox-title">Datos del empleado</div>
                            </div>
                            <div class="ibox-body">
                                <div class="row align-items-center">

                                    <div class="col-sm-6 form-group">
                                        <label>Empleado</label> &nbsp;&nbsp; <label style="color:red;" id="id_empleado_obliga"></label>
                                        <select id="id_empleado" class="id_empleado form-control" style="width: 100%"> </select>
                                    </div>

                                    <div class="col-sm-2 form-group">
                                        <label>Fecha pago</label>
                                        <input readonly type="date" value="<?php echo $fecha; ?>" class="form-control" id="fecha_pago">
                                    </div>

                                    <div class="col-lg-2">
                                        <label for="hora">Hora</label>
                                        <input readonly type="time" maxlength="5" class="form-control" id="hora" value="<?php echo $time ?>"><br>
                                    </div>

                                    <div class="col-sm-2 form-group">
                                        <label>Actividad</label> &nbsp;&nbsp; <label style="color:red;" id="aci_prpdoc_oblig"></label>
                                        <input type="text" readonly class="form-control" id="aci_prpdoc">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Datos de la produccion asignado al empleado</label>
                                        <input type="text" readonly class="form-control" id="produccion_datos">
                                    </div>

                                    <div class="col-sm-2 form-group">
                                        <label>Pago actividad</label> &nbsp;&nbsp; <label style="color:red;" id="apellido_obliga"></label>
                                        <input type="text" readonly class="form-control" id="pago_ac">
                                    </div>

                                    <div class="col-sm-1 form-group" style="display: none;">
                                        <label>Dias</label>
                                        <input type="text" readonly class="form-control" id="dias_prod">
                                    </div>

                                    <div class="col-sm-1 form-group">
                                        <label>Horas(*)</label>
                                        <input type="text" readonly class="form-control" id="horas_trabajoo">
                                    </div>

                                    <div class="col-sm-1 form-group">
                                        <label>Costo/hora</label>
                                        <input type="text" readonly class="form-control" id="costo_hora">
                                    </div>

                                    <div class="col-sm-1 form-group">
                                        <label style="color:green;"><b>Total</b></label>
                                        <input type="text" readonly class="form-control" id="monto_dra">
                                    </div>



                                    <div style="display: none;" id="benecios_rol" class="col-sm-1 form-group">
                                        <label>Beneficios</label>
                                        <button class="btn btn-primary" onclick="modal_beneficios();"> <i class="fa fa-plus"></i> </button>
                                    </div>


                                    <div style="display:none;" id="tabla_multas_em" class="col-lg-12 table-responsive">
                                        <label><b>Multas sanciones</b></label>
                                        <table id="tabla_sanciones" class="table table-striped table-bordered">
                                            <thead bgcolor="red" style="color:#fff;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fecha de infraccion</th>
                                                    <th>Tipo de sancion</th>
                                                    <th>Motivo</th>
                                                    <th>Multa</th>
                                                </tr>
                                            </thead>

                                            <tbody id="tbody_detalle_sanciones">

                                            </tbody>
                                        </table>

                                        <div class="col-lg-12" style="text-align: right;">
                                            <label id="lbl_total_sanciones"></label>
                                            <input type="hidden" id="txt_total_sanciones">
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="ibox ibox-warning">
                            <div class="ibox-head">
                                <div class="ibox-title">Asistencias</div>
                            </div>
                            <div class="ibox-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-12 table-responsive">
                                        &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_asistencia_obligg"></label>
                                        <table id="detalle_tabla_asistencia" class="table table-striped table-bordered">
                                            <thead bgcolor="black" style="color:#fff;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fecha</th>
                                                    <th>Hora ingreso</th>
                                                    <th>Hora salida</th>
                                                    <th>Horas</th>
                                                    <th>Costo por hora</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <tbody id="tbody_detalle_tabla_asistencia">

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="ibox ibox-success">
                            <div class="ibox-head">
                                <div class="ibox-title">Ingresos</div> <b><label id="total_ingreso" style="color:black;"></label></b> <input type="hidden" id="txt_total_ingreso">
                            </div>
                            <div class="ibox-body">
                                <div class="row align-items-center">
                                    <div class="col-lg-12 table-responsive">
                                        &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_ingreso_obligg"></label>
                                        <table id="detalle_tabla_ingreso" class="table table-striped table-bordered">
                                            <thead bgcolor="black" style="color:#fff;">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Cantidad</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>

                                            <tbody id="tbody_detalle_ingreso">

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="ibox ibox-danger">
                            <div class="ibox-head">
                                <div class="ibox-title">Egresos</div> <b><label id="total_egreso" style="color:black;"></label></b> <input type="hidden" id="txt_total_egreso">
                            </div>
                            <div class="ibox-body">
                                <div class="row align-items-center">

                                    <div class="col-lg-12 table-responsive">
                                        &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_eggreso_obligg"></label>
                                        <table id="detalle_tabla_egreso" class="table table-striped table-bordered">
                                            <thead bgcolor="black" style="color:#fff;">

                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th>Cantidad</th>
                                                    <th>Accion</th>
                                                </tr>
                                            </thead>

                                            <tbody id="tbody_detalle_egreso">

                                            </tbody>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="box-header with-border center" style="text-align: center; background: orange; color:black; padding: 0px;">
                            <b>
                                <h4 class="box-title"><b><i class="fa fa-dollar"></i> Neto a pagar : <span id="lbl_neto_pagar"></span> </b> </h4> <input type="hidden" id="txtneto_pagar">
                                <button class="btn btn-primary" onclick="Crear_rol_pagos();"> <i class="fa fa-money"></i> Crear rol de pagos</button> - <button class="btn btn-danger" onclick="cargar_contenido('contenido_principal','vista/rol_pagos/pagos_empleados.php');"> <i class="fa fa-times"></i> Limpiar</button>
                            </b>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<form autocomplete="false">
    <div class="modal fade" id="modal_benficios_rol_pagoss" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Beneficios</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12 table-responsive">
                            <table id="tabla_beneficios_rol" class="table table-striped table-bordered">
                                <thead bgcolor="black" style="color:#fff;">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Tipo</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>

                                <tbody id="tbody_beneficios_rol">

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(".id_empleado").select2();
    traer_datos_empleado_rol_pagos();
    listar_bebficios_rol();

    function traer_datos_empleado_rol_pagos() {
        funcion = "traer_datos_empleado_rol_pagos";
        $.ajax({
            url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
            type: "POST",
            data: {
                funcion: funcion
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var cadena = "";
            if (data.length > 0) {
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {
                    cadena +=
                        "<option value='" + data[i][0] + " - " + data[i][9] + "'>Nombres: " + data[i][1] + " - Cedula: " + data[i][3] + " </option>";
                }
                //aqui concadenamos al id del select
                $("#id_empleado").html(cadena);

                var funcion = "traer_data_rol_pagos";
        var id = $("#id_empleado").val();
        var idd = id.split("-");

        var id_empleado = parseInt(idd[0]);
        var id_producion = parseInt(idd[1]);

        $("#tbody_detalle_ingreso").empty();
        $("#tbody_detalle_egreso").empty();
        $("#total_egreso").html("");
        $("#total_ingreso").html("");
        $("#txt_total_ingreso").val("");
        $("#txt_total_egreso").val("");

        $.ajax({
            url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
            type: "POST",
            data: {
                funcion: funcion,
                id_empleado: id_empleado,
                id_producion: id_producion,
            },
        }).done(function(resp) {
            if (resp != 0) {
                traer_asistecnis_empleado(id_empleado);
                var data = JSON.parse(resp);
                $("#aci_prpdoc").val(data[0][5]);
                $("#pago_ac").val(data[0][6]);
                $("#produccion_datos").val(data[0][7]);
                $("#dias_prod").val(data[0][8]);
                $("#costo_hora").val(data[0][15]);
                $("#horas_trabajoo").val(data[0][16]);
                $("#benecios_rol").css("display", "block");
                // cargar_pago();
                calcular_egreso();
                traer_multas_saciones(id_empleado);
            } else {
                $("#aci_prpdoc").val("");
                $("#pago_ac").val("");
                $("#produccion_datos").val("");
                $("#dias_prod").val("");
                $("#benecios_rol").css("display", "none");
                $("#tbody_detalle_sanciones").empty();
                $("#tabla_multas_em").css("display", "none");
            }
        });

            } else {
                cadena += "<option value=''>No hay datos</option>";
                $("#id_empleado").html(cadena);
            }
        });
    }

    $("#id_empleado").change(function() {
        var funcion = "traer_data_rol_pagos";
        var id = $("#id_empleado").val();
        var idd = id.split("-");

        var id_empleado = parseInt(idd[0]);
        var id_producion = parseInt(idd[1]);

        $("#tbody_detalle_ingreso").empty();
        $("#tbody_detalle_egreso").empty();
        $("#total_egreso").html("");
        $("#total_ingreso").html("");
        $("#txt_total_ingreso").val("");
        $("#txt_total_egreso").val("");

        $.ajax({
            url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
            type: "POST",
            data: {
                funcion: funcion,
                id_empleado: id_empleado,
                id_producion: id_producion,
            },
        }).done(function(resp) {
            if (resp != 0) {
                traer_asistecnis_empleado(id_empleado);
                var data = JSON.parse(resp);
                $("#aci_prpdoc").val(data[0][5]);
                $("#pago_ac").val(data[0][6]);
                $("#produccion_datos").val(data[0][7]);
                $("#dias_prod").val(data[0][8]);
                $("#costo_hora").val(data[0][15]);
                $("#horas_trabajoo").val(data[0][16]);
                $("#benecios_rol").css("display", "block");
                // cargar_pago();
                calcular_egreso();
                traer_multas_saciones(id_empleado);
            } else {
                $("#aci_prpdoc").val("");
                $("#pago_ac").val("");
                $("#produccion_datos").val("");
                $("#dias_prod").val("");
                $("#benecios_rol").css("display", "none");
                $("#tbody_detalle_sanciones").empty();
                $("#tabla_multas_em").css("display", "none");
            }
        });

    });

    function traer_multas_saciones(id) {
        var funcion = "traer_multas_saciones";

        $.ajax({
            url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id,
            },
        }).done(function(resp) {
            if (resp != 0) {
                let arreglo_total = new Array();
                let total = 0;

                var data = JSON.parse(resp);
                var llenat = "";
                data["data"].forEach(row => {
                    llenat += `<tr>
                            <td >${row["id_multa"]}</td>
                            <td>${row["fecha_infraccion"]}</td>
                            <td>${row["tipo_sancion"]}</td>
                            <td>${row["motivo"]}</td>
                            <td>$ ${row["multa"]}</td>
                            </tr>`;

                    total = parseFloat(total) + parseFloat(row["multa"]);
                    $("#tbody_detalle_sanciones").html(llenat);
                });
                $("#lbl_total_sanciones").html("<b>Total sancion: </b> $/." + parseFloat(total).toFixed(2));
                $("#txt_total_sanciones").val(parseFloat(total).toFixed(2));
                $("#tabla_multas_em").css("display", "block");
                cargar_multas();
            } else {
                $("#tbody_detalle_sanciones").empty();
                $("#tabla_multas_em").css("display", "none");
                $("#lbl_total_sanciones").html("");
                $("#txt_total_sanciones").val("");
            }
        });
    }

    function traer_asistecnis_empleado(id) {
        var funcion = "traer_asistecnis_empleado";

        $.ajax({
            url: "../ADMIN/controlador/rol_pagos/rol_pagos.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id,
            },
        }).done(function(resp) {

            console.log(resp);

            if (resp != 0) {
                var hora1, hora2, t1 = new Date(),
                    t2 = new Date(),
                    horas, total_pago = 0,
                    pagar_dar = 0;

                let arreglo_total = new Array();
                let total = 0, subtotal = 0;
                var costoxhora = $("#costo_hora").val();

                var data = JSON.parse(resp);
                var llenat = "";
                data["data"].forEach(row => {

                    hora1 = (row["hor_salida"]).split(":");
                    hora2 = (row["hor_ingreso"]).split(":");

                    t1.setHours(hora1[0], hora1[1], hora1[2]);
                    t2.setHours(hora2[0], hora2[1], hora2[2]);

                    //Aquí hago la resta
                    t1.setHours(t1.getHours() - t2.getHours(), t1.getMinutes() - t2.getMinutes(), t1.getSeconds() - t2.getSeconds());
                    //Imprimo el resultado
                    horas = (t1.getHours());

                    total_pago = horas * costoxhora;

                    llenat += `<tr>
                    <td>${row["id_asistencia"]}</td>
                    <td>${row["fecha"]}</td>
                    <td>${row["hor_ingreso"]}</td>
                    <td>${row["hor_salida"]}</td>
                    <td>${horas}</td>
                    <td>${costoxhora}</td>
                    <td>${parseFloat(total_pago).toFixed(2)}</td>
                    </tr>`;

                    arreglo_total = total_pago;
                    subtotal = (parseFloat(subtotal) + parseFloat(arreglo_total)).toFixed(2);
                });

                $("#monto_dra").val(subtotal);
                $("#tbody_detalle_tabla_asistencia").html(llenat);
                $("#detalle_asistencia_obligg").html("");
                cargar_pago();
            } else {
                $("#detalle_asistencia_obligg").html("El empleado no tiene asistencias registradas");
                $("#tbody_detalle_tabla_asistencia").empty();
            }
        });
    }

    function cargar_multas() {
        var valor_multa = $("#txt_total_sanciones").val();
        var nombre = "Valor de las multas/sanciones";
        var count = 0;

        var datos_agg_multas = "<tr>";
        datos_agg_multas += "<td for='id'>" + count + "</td>";
        datos_agg_multas += "<td>" + nombre + "</td>";
        datos_agg_multas += "<td>" + valor_multa + "</td>";
        datos_agg_multas += "<td style='color:red;'>Multa/sancion</td>";
        datos_agg_multas += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_egreso").append(datos_agg_multas);
        calcular_egreso();
    }

    function cargar_pago() {
        var valor = $("#monto_dra").val();
        var datos = "Sueldo";
        var count = 0;

        var datos_agg_sueldo = "<tr>";
        datos_agg_sueldo += "<td for='id'>" + count + "</td>";
        datos_agg_sueldo += "<td>" + datos + "</td>";
        datos_agg_sueldo += "<td>" + valor + "</td>";
        datos_agg_sueldo += "<td style='color:green;'>Sueldo</td>";
        datos_agg_sueldo += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_ingreso").append(datos_agg_sueldo);

        calculat_ingreso();
    }
</script>