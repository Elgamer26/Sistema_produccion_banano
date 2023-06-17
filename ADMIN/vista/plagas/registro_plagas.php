<script type="text/javascript" src="js/plagas.js"></script>
<br>
<section class="content-header">
    <h3>
        <b> Registro de plagas <i class="fa fa-times" style="color:red;"></i> </b>
    </h3>
</section>
<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nueva plagas</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <div class="col-sm-12 form-group">
                                <label>Seleccione producción</label> &nbsp;&nbsp; <label style="color:red;" id="prodcuciion_id_oblig"></label>
                                <select class="prodcuciion_id form-control" id="prodcuciion_id"> </select>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Seleccione la fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_ras_des_oblig"></label>
                                <input type="date" class="calendario form-control" placeholder="Ingrese la fecha" id="fecha_ras_des">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Seleccione tipo de plaga</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_plaga_oblig"></label>
                                <select class="tipo_plaga form-control" id="tipo_plaga"></select>
                            </div>

                            <div class="col-sm-12 form-group">
                                <label for="obsrvacion">Observacion</label> &nbsp;&nbsp; <label style="color:red;" id="obsrvacion_obliga"></label>
                                <textarea class="form-control" id="obsrvacion" cols="3" rows="3" style="resize: none;"></textarea>
                            </div>

                            <div class="col-sm-12 form-group">
                                <label>Foto</label>&nbsp;&nbsp; <label style="color:red;">La foto si es obligatorio</label> &nbsp;&nbsp; <label style="color:red;" id="foto_oglib"></label>
                                <input type="file" class="form-control" id="foto">
                            </div>

                            <div class="col-sm-12 form-group">
                                <button onclick="nuevo_registro_plagas();" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Guardar</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/plagas/registro_plagas.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".tipo_plaga").select2();
    $(".prodcuciion_id").select2();
    listas_lotes_cosechas();
    listar_tipos_pgas();

    $("#prodcuciion_id").change(function() {
        var id = $("#prodcuciion_id").val();
        traer_fechas(parseInt(id));
    });

    function listas_lotes_cosechas() {
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
                        "<option value='" + data[i][0] + "'>Nombre produccion: " + data[i][7] + " - Lote: " + data[i][1] + " - Hectarea: " + data[i][9] + " - Estado: " + data[i][5] + "</option>";
                }
                //aqui concadenamos al id del select
                $("#prodcuciion_id").html(cadena);
                var id = $("#prodcuciion_id").val();
                traer_fechas(parseInt(id));
            } else {
                cadena += "<option value=''>No hay datos de lote</option>";
                $("#prodcuciion_id").html(cadena);
            }
        });
    }

    function traer_fechas(id) {
        funcion = "traer_fechas";
        $.ajax({
            url: "../ADMIN/controlador/desechos_racimos/desechos_racimos.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            fecha_i = data[0][0];
            fecha_f = data[0][1];
            mostar_fecha(fecha_i, fecha_f);
        });
    }

    function mostar_fecha(fecha_i, fecha_f) {
        $(".calendario").flatpickr({
            minDate: fecha_i,
            maxDate: fecha_f,
            locale: {
                firstDayOfWeek: 1,
                weekdays: {
                    shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                },
                months: {
                    shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                    longhand: ['Enero', 'Febreo', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                },
            },
        });
    }

    document.getElementById("foto").addEventListener("change", () => {
        var filename = document.getElementById("foto").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto").value = "";
        }
    });
</script>