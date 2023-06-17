<script type="text/javascript" src="js/permiso.js"></script>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
?>

<br>
<section class="content-header">
    <h3>
        <b> Nueva permiso del empleado <i class="fa fa-exclamation-circle" style="color:green;"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-warning box-solid">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="ibox ibox-warning">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevo permiso del empleado</div>
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
                                        <input type="text" maxlength="10" class="form-control" id="numero_docu_p" placeholder="Ingrese numero de cedula" onkeypress="return soloNumeros(event)">
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
                        <div class="ibox ibox-danger">
                            <div class="ibox-head">
                                <div class="ibox-title">Permiso</div>
                            </div>
                            <div class="ibox-body">
                                <div class="row align-items-center">

                                    <div class="col-sm-4 form-group">
                                        <label>Fecha inicio</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_i_oblig"></label>
                                        <input type="date" value="<?php echo $fecha; ?>" class="form-control" id="Fecha_i">
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label>Fecha fin</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_f_oblig"></label>
                                        <input type="date" value="<?php echo $fecha; ?>" class="form-control" id="Fecha_f">
                                    </div>

                                    <div class="col-sm-4 form-group">
                                        <label>Tipo de permiso</label> &nbsp;&nbsp; <label style="color:red;" id="tipoo_obliga"></label>
                                        <select class="tipo_i form-control" id="tip_permiso" style="width:100%;">
                                        </select>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <label for="motivo">Observacion</label> &nbsp;&nbsp; <label style="color:red;" id="obsrvacion_obliga"></label>
                                        <textarea class="form-control" id="observacion" cols="3" rows="3" style="resize: none;"></textarea>
                                    </div>

                                    <div class="col-sm-12 form-group">
                                        <button id="btb_registrar" class="btn btn-success" onclick="registrar_permiso();"><i class="fa fa-save"></i> Guardar permiso</button> - <button class="btn btn-danger" onclick="cargar_contenido('contenido_principal','vista/permisos/mueva_permisos.php');"><i class="fa fa-times"></i> Limpiar</button>
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
    $(".tipo_i").select2();
    listar_tipo_permiso();

    $("#numero_docu_p").keyup(function() {
        var valor = this.value;
        var funcion = "traer_datos_empleado";

        $.ajax({
            url: "../ADMIN/controlador/permiso/permiso.php",
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
                    $("#btb_registrar").hide();
                } else {
                    $("#estado_empleado").html("");
                    $("#btb_registrar").show();
                }

            } else {
                $("#id_empleado").val("");
                $("#nombres").val("");
                $("#apellidos").val("");
                $("#sexo_e").val("");
                $("#telefono_empleado").val("");
                $("#foto_empleado").attr("src", "img/empleado/empleado.jpg");
                $("#btb_registrar").show();
            }
        });

    });
</script>