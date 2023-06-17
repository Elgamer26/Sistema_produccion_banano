<script type="text/javascript" src="js/desechos_racimos.js"></script>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
?>

<br>
<section class="content-header">
    <h3>
        <b> Registro de cintas <i class="fa fa-registered"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevo registro</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <input hidden id="id_hectarea">

                            <div class="col-sm-8 form-group">
                                <label>Seleccione producción</label> &nbsp;&nbsp; <label style="color:red;" id="prodcuciion_id_oblig"></label>
                                <select class="prodcuciion_id form-control" id="prodcuciion_id"> </select>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Semana</label>
                                <input type="text" class="form-control" id="n_semana" disabled>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Seleccione la fecha</label>
                                <input type="date" class="form-control" id="fecha" value="<?php echo $fecha ?>">
                            </div>

                            <div class="col-sm-12 form-group">
                                <label>Semana</label>
                                <textarea type="text" class="form-control" id="detalle"></textarea>
                            </div>

                            <table id="tabala_semanas" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                <thead bgcolor="purple" style="color:#fff;">
                                    <tr>
                                        <th style="width: 35px;">#</th>
                                        <th>Semana</th>
                                        <th>Color</th>
                                        <th>Fecha registro</th>
                                        <th>Detalle</th>
                                        <th style="width: 45px;">Accion</th>
                                    </tr>
                                </thead>

                                <tbody id="tbody_tabala_semanas">

                                </tbody>

                                <tfoot bgcolor="purple" style="color:#fff;">
                                    <tr>
                                        <th style="width: 35px;">#</th>
                                        <th>Semana</th>
                                        <th>Color</th>
                                        <th>Fecha registro</th>
                                        <th>Detalle</th>
                                        <th style="width: 45px;">Accion</th>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="col-sm-12 form-group">
                                <button onclick="registra_cintas();" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Guardar</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/cintas/registro_cintas.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var funcion;

    $(".prodcuciion_id").select2();
    listaar_produccion();

    $("#prodcuciion_id").change(function() {
        var id = $("#prodcuciion_id").val();
        traer_cintas_semanas(parseInt(id));
        traer_detalle_cintas(parseInt(id));
        obtener_id_hectarea(parseInt(id));
    });

    function listaar_produccion() {
        funcion = "listas_lotes_cosechas";
        $.ajax({
            url: "../ADMIN/controlador/desechos_racimos/desechos_racimos.php",
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
                        "<option value='" +
                        data[i][0] +
                        "'>Nombre de produccion: " +
                        data[i][7] +
                        " - Lote: " +
                        data[i][1] +
                        " - Hectareas: " +
                        data[i][9] +
                        " - Estado: " +
                        data[i][5] +
                        "</option>";
                }
                //aqui concadenamos al id del select
                $("#prodcuciion_id").html(cadena);
                var id = $("#prodcuciion_id").val();
                traer_cintas_semanas(parseInt(id));
                traer_detalle_cintas(parseInt(id));
                obtener_id_hectarea(parseInt(id));
            } else {
                cadena += "<option value=''>No hay datos de lote</option>";
                $("#prodcuciion_id").html(cadena);
            }
        });
    }

    function traer_cintas_semanas(id) {
        funcion = "traer_cintas_semanas";
        $.ajax({
            url: "../ADMIN/controlador/tipo_cintas/tipo_cintas.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var dias = data[0][0] + 1;
            $("#n_semana").val(dias);
        });
    }

    function traer_detalle_cintas(id) {
        funcion = "traer_detalle_cintas";
        $.ajax({
            url: "../ADMIN/controlador/tipo_cintas/tipo_cintas.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id
            },
        }).done(function(response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var llenat = "";
                var count = 0;
                data.forEach((row) => {
                    count++;
                    llenat += `     <tr>
                            <td>${count}</td>
                            <td>${row["semana"]}</td>
                            <td style="text-align: center;"><input type='color' value='${row["color"]}' disabled></td>
                            <td>${row["fecha"]}</td>
                            <td>${row["detalle"]}</td>
                            <td style="text-align: center;"><a class='btn btn-danger' onclick='eliminar_detalle(${row["id_cintas"]}, ${row["id_produccion"]});'><i class='fa fa-trash'></i></a></td>   
                            </tr>`;

                    $("#tbody_tabala_semanas").html(llenat);
                });
            } else {
                $("#tbody_tabala_semanas").empty();
            }
        });
    }

    function obtener_id_hectarea(id) {
        funcion = "obtener_id_hectarea";
        $.ajax({
            url: "../ADMIN/controlador/tipo_cintas/tipo_cintas.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            $("#id_hectarea").val(data[0][0]);
        });
    }

    function registra_cintas() {
        var id = $("#prodcuciion_id").val();
        var semana = $("#n_semana").val();
        var fecha = $("#fecha").val();
        var detalle = $("#detalle").val();
        var id_h = $("#id_hectarea").val();

        if(detalle.length == 0 || id.length == 0){
            return Swal.fire({
            icon: "warning",
            title: "Ingrese datos completos para registrar",
            text: "No deje campos vacios sin llenar!!",
        });
        }

        funcion = "registra_cintass";
        alerta = ["datos", "Se esta registrando la cinta", "Registrando cinta"];
        mostar_loader_datos(alerta);

        $.ajax({
            url: "../ADMIN/controlador/tipo_cintas/tipo_cintas.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id,
                semana: semana,
                fecha: fecha,
                detalle: detalle,
                id_h: id_h
            },
        }).done(function(response) {           
            if (response > 0) {
                if (response == 1) {
                    traer_cintas_semanas(parseInt(id));
                    traer_detalle_cintas(parseInt(id));
                    alerta = ["exito", "success", "Detalle registrado con exito"];
                    cerrar_loader_datos(alerta);
                    $("#detalle").val("");
                } else if (response == 10) {
                    alerta = ["exito", "success", "La produccion a finalizado con exito"];
                    cerrar_loader_datos(alerta);
                    cargar_contenido('contenido_principal', 'vista/cintas/registro_cintas.php');
                }
            } else {
                alerta = ["error", "error", "No se pudo registrar el detalle "];
                cerrar_loader_datos(alerta);
            }
        });
    }

    function eliminar_detalle(id, idpro) {
        Swal.fire({
            title: "Eliminar detalle",
            text: "Desea eliminar detalle de cinta??",
            icon: "warning",
            showCancelButton: true,
            showConfirmButton: true,
            allowOutsideClick: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar!!",
        }).then((result) => {
            if (result.value) {
                funcion = "eliminar_detalle";
                $.ajax({
                    url: "../ADMIN/controlador/tipo_cintas/tipo_cintas.php",
                    type: "POST",
                    data: {
                        funcion: funcion,
                        id: id,
                        idpro: idpro
                    },
                }).done(function(response) {
                    if (response == 1) {
                        alerta = ["exito", "success", "Detalle eliminado con exito"];
                        cerrar_loader_datos(alerta);
                        traer_detalle_cintas(parseInt(idpro));
                        traer_cintas_semanas(parseInt(idpro));
                    } else {
                        alerta = ["error", "error", "No se pudo eliminado con el detalle"];
                        cerrar_loader_datos(alerta);
                    }
                });
            }
        });
    }
</script>