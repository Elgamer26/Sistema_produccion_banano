<script type="text/javascript" src="js/plagas.js"></script>
<br>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
?>

<section class="content-header">
    <h3>
        <b> Registro de tratamiento <i class="fa fa-check" style="color:green;"></i> </b>
    </h3>
</section>
<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nueva tratamiento</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <div class="col-sm-12 form-group">
                                <label>Seleccione produccion infectada</label> &nbsp;&nbsp; <label style="color:red;" id="prodcuciion_id_oblig"></label>
                                <select class="prodcuciion_id form-control" id="prodcuciion_id"> </select>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Seleccione tipo de tratamiento</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_tratamiento_oblig"></label>
                                <select class="tipo_tratamiento form-control" id="tipo_tratamiento"></select>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label for="fecha_inii">Fecha inicio</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_ini_obliga"></label>
                                <input type="date" class="form-control" value="<?php echo $fecha; ?>" id="fecha_inii">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label for="fecha_fini">Fecha fin</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_fini_obliga"></label>
                                <input type="date" class="form-control" value="<?php echo $fecha; ?>" id="fecha_fini">
                            </div>

                            <div class="col-sm-1 form-group">
                                <label for="dias">Dias</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_fini_obliga"></label>
                                <input type="text" readonly class="form-control" id="dias">
                            </div>

                            <div class="col-sm-4 form-group">
                                <label>Seleccione tipo de quimico</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_quimico_oblig"></label>
                                <select class="tipo_quimico form-control" id="tipo_quimico"></select>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label for="cantida_litros">Cantidad en Litros</label> &nbsp;&nbsp; <label style="color:red;" id="cant_litros_obliga"></label>
                                <input type="text" class="form-control" id="cantida_litros">
                            </div>

                            <div class="col-sm-12 form-group">
                                <label for="obsrvacion">Prescripcion</label> &nbsp;&nbsp; <label style="color:red;" id="obsrvacion_obliga"></label>
                                <textarea class="form-control" id="obsrvacion" cols="3" rows="3" style="resize: none;"></textarea>
                            </div>

                            <div class="col-sm-12 form-group">
                                <button onclick="nuevo_registro_tratamiento();" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Guardar</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/plagas/nuevo_tratamiento_pagas.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".tipo_tratamiento").select2();
    $(".prodcuciion_id").select2();
    $(".tipo_quimico").select2();
    listar_produccion_plagada();
    listar_tipo_tratamiento();
    listar_tipo_quimico();

    function listar_produccion_plagada() {
        funcion = "listar_produccion_plagada";
        $.ajax({
            url: "../ADMIN/controlador/tratamientos/tratamientos.php",
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
                        "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                }
                //aqui concadenamos al id del select
                $("#prodcuciion_id").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos de produccion plagados</option>";
                $("#prodcuciion_id").html(cadena);
            }
        });
    }

    function listar_tipo_quimico() {
        funcion = "listar_tipo_quimico";
        $.ajax({
            url: "../ADMIN/controlador/tratamientos/tratamientos.php",
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
                        "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                }
                //aqui concadenamos al id del select
                $("#tipo_quimico").html(cadena);
            } else {
                cadena += "<option value=''>No hay tipo quimico</option>";
                $("#tipo_quimico").html(cadena);
            }
        });
    }

    function listar_tipo_tratamiento() {
        funcion = "listar_tipo_tratamiento";
        $.ajax({
            url: "../ADMIN/controlador/tratamientos/tratamientos.php",
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
                        "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                }
                //aqui concadenamos al id del select
                $("#tipo_tratamiento").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos</option>";
                $("#tipo_tratamiento").html(cadena);
            }
        });
    }

    $("#fecha_inii").change(function() {
        var fecha_inicio = $("#fecha_inii").val();
        var fecha_fin = $("#fecha_fini").val();

        if (fecha_inicio > fecha_fin) {
            $("#dias_dias").val("");
            return Swal.fire(
                "Mensaje de advertencia",
                "La fecha inicio '" +
                fecha_inicio +
                "' es mayor a la fecha final '" +
                fecha_fin +
                "'",
                "warning"
            );
        }

        monent(fecha_inicio, fecha_fin);
    });

    $("#fecha_fini").change(function() {
        var fecha_inicio = $("#fecha_inii").val();
        var fecha_fin = $("#fecha_fini").val();

        if (fecha_inicio > fecha_fin) {
            $("#dias_dias").val("");
            return Swal.fire(
                "Mensaje de advertencia",
                "La fecha inicio '" +
                fecha_inicio +
                "' es mayor a la fecha final '" +
                fecha_fin +
                "'",
                "warning"
            );
        }

        monent(fecha_inicio, fecha_fin);
    });

    // Función para calcular los días transcurridos entre dos fechas
    function monent(fecha_inicio, fecha_fin) {
        var fecha1 = moment(fecha_inicio);
        var fecha2 = moment(fecha_fin);
        $("#dias").val(fecha2.diff(fecha1, 'days') + 1);
    }

    ///////////////
    function nuevo_registro_tratamiento() {
        var prodcuciion_id = $("#prodcuciion_id").val();
        var tipo_tratamiento = $("#tipo_tratamiento").val();
        var obsrvacion = $("#obsrvacion").val();

        var fecha_inii = $("#fecha_inii").val();
        var fecha_fini = $("#fecha_fini").val();
        var dias = $("#dias").val();

        var tipo_quimico = $("#tipo_quimico").val();
        var cantida_litros = $("#cantida_litros").val();

        if (prodcuciion_id.length == 0 || tipo_tratamiento.length == 0 || obsrvacion.length == 0 ||
            fecha_inii.length == 0 || fecha_fini.length == 0 || dias.length == 0 ||
            tipo_quimico.length == 0 || cantida_litros.length == 0) {
            return Swal.fire({
                icon: "warning",
                title: "No hay datos completos",
                text: "Ingrese un datos completos!!",
            });
        }

        funcion = "registrar_tratamiento";
        alerta = ["datos", "Se esta registrando el tratamiento", "Creando el tratamiento."];
        mostar_loader_datos(alerta);

        $.ajax({
            url: "../ADMIN/controlador/tratamientos/tratamientos.php",
            type: "POST",
            data: {
                funcion: funcion,
                prodcuciion_id: prodcuciion_id,
                tipo_tratamiento: tipo_tratamiento,
                obsrvacion: obsrvacion,

                fecha_inii: fecha_inii,
                fecha_fini: fecha_fini,
                dias: dias,

                tipo_quimico: tipo_quimico,
                cantida_litros: cantida_litros
            },
        }).done(function(response) {
            if (response > 0) {
                if (response == 1) {
                    alerta = [
                        "exito",
                        "success",
                        "Se creo el tratamiento con exito",
                    ];
                    cerrar_loader_datos(alerta);
                    cargar_contenido('contenido_principal', 'vista/plagas/nuevo_tratamiento_pagas.php');
                }
            } else {
                alerta = ["error", "error", "No se pudo crear el tratamiento"];
                cerrar_loader_datos(alerta);
            }
        });
    }
</script>