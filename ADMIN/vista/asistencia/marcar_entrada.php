<script type="text/javascript" src="js/asistencias.js"></script>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
$time = date('H:i', time());
?>

<br>
<section class="content-header">
    <h3>
        <b> Marcar entradas</b> <i class="fa fa-calendar" style="color:green;"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-warning box-solid">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="ibox ibox-warning">
                    <div class="ibox-head">
                        <div class="ibox-title">Entrada del empleado</div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-5">
                        <div class="ibox ibox-primary">
                            <div class="ibox-head">
                                <div class="ibox-title">Datos del empleado</div>
                            </div>
                            <div class="ibox-body">
                                <div class="row align-items-center">

                                    <input type="number" readonly hidden id="id_empleado">

                                    <div class="col-sm-12 form-group">
                                        <label>Cedula</label> &nbsp;&nbsp; <label style="color:red;" id="dcoumento_obliga"></label>
                                        <input type="text" maxlength="10" class="form-control" id="numero_doco_m" placeholder="Ingrese numero de cedula" onkeypress="return soloNumeros(event)">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Nombres</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_oblig"></label>
                                        <input type="text" readonly class="form-control" id="nombres">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Apellidos</label> &nbsp;&nbsp; <label style="color:red;" id="apellido_obliga"></label>
                                        <input type="text" readonly class="form-control" id="apellidos">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Sexo</label>
                                        <input type="text" readonly class="form-control" id="sexo_e">
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <label>Telefono</label>
                                        <input type="text" readonly class="form-control" id="telefono_empleado">
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <div class="ibox-body text-center">
                                            <img class="img-circle" id="foto_empleado" white="100px" height="100px">
                                            <h5 class="font-strong m-b-10 m-t-10"><span>Foto del empleado</span></h5>
                                            <h5 class="font-strong m-b-10 m-t-10"><span id="estado_empleado" style="color:red;"></span></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="col-lg-7">
                        <div class="ibox ibox-primary">
                            <div class="ibox-head">
                                <div class="ibox-title">Marcar entrada</div>
                            </div>
                            <div class="ibox-body">
                                <div class="row align-items-center">

                                    <div class="col-sm-4 form-group">
                                        <label>Fecha entrada</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_oblig"></label>
                                        <input type="date" value="<?php echo $fecha; ?>" class="form-control" id="Fecha_i">
                                    </div>

                                    <div class="col-sm-3 form-group">
                                        <label>Hora entrada</label> &nbsp;&nbsp; <label style="color:red;" id="hora_obliga"></label>
                                        <input type="time" value="<?php echo $time ?>" class="form-control" id="hora_i">
                                    </div>

                                    <div class="col-sm-2 form-group">
                                        &nbsp;&nbsp;
                                        <button id="btn_sabe" class="btn btn-success" onclick="marcar_entrada();"><i class="fa fa-save"></i> Marcar</button>
                                    </div>

                                    <div class="col-sm-1 form-group">
                                        &nbsp;&nbsp;
                                        <button class="btn btn-danger" onclick="cargar_contenido('contenido_principal','vista/asistencia/marcar_entrada.php');"><i class="fa fa-times"></i> Limpiar</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#numero_doco_m").keyup(function() {
        var valor = this.value;
        var funcion = "traer_datos_empleado_asistencia";

        $.ajax({
            url: "../ADMIN/controlador/asistencias/asistencias.php",
            type: "POST",
            data: {
                funcion: funcion,
                valor: valor
            },
        }).done(function(resp) {
            if (resp != 0) {
                var data = JSON.parse(resp);

                $("#id_empleado").val(data[0][0]);
                $("#nombres").val(data[0][1]);
                $("#apellidos").val(data[0][2]);
                $("#sexo_e").val(data[0][8]);
                $("#telefono_empleado").val(data[0][6]);
                $("#foto_empleado").attr("src", data[0][9]);

                if (data[0][10] == 0) {
                    $("#estado_empleado").html("Trabajador inactivo");
                    $("#btn_sabe").hide();
                } else {
                    $("#estado_empleado").html("");
                    $("#btn_sabe").show();
                }

            } else {
                $("#id_empleado").val("");
                $("#nombres").val("");
                $("#apellidos").val("");
                $("#sexo_e").val("");
                $("#telefono_empleado").val("");
                $("#foto_empleado").attr("src", "img/empleado/empleado.jpg");
                $("#estado_empleado").html("");
                $("#btn_sabe").show();
            }
        });

    });
</script>