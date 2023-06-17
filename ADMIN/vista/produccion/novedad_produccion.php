<script type="text/javascript" src="js/desechos_racimos.js"></script>
<script type="text/javascript" src="js/novedades.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Registro de novedades <i class="fa fa-times" style="color:red;"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevo novedad de producción</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <div class="col-sm-12 form-group">
                                <label>Seleccione produccion</label> &nbsp;&nbsp; <label style="color:red;" id="prodcuciion_id_oblig"></label>
                                <select class="prodcuciion_id form-control" id="prodcuciion_id"> </select>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Seleccione la fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_ras_des_oblig"></label>
                                <input type="date" class="calendario form-control" placeholder="Ingrese la fecha" id="fecha_ras_des">
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Costo novedad</label> &nbsp;&nbsp; <label style="color:red;" id="costo_oblig"></label>
                                <input type="text" maxlength="10" class="form-control" id="costo_novedad" placeholder="Ingrese costo" onkeypress="return filterfloat(event, this);">
                            </div>

                            <div class="col-sm-12 form-group">
                                <label>Seleccione novedad</label> &nbsp;&nbsp; <label style="color:red;" id="novedad_ses_oblig"></label>
                                <select class="novedad_ses form-control" id="novedad_ses"></select>
                            </div>

                            <div class="col-sm-12 form-group">
                                <label>Detalle novedad</label> &nbsp;&nbsp; <label style="color:red;" id="detalle_obligg"></label>
                               <textarea class="form-control" id="detalle_novedad"></textarea>
                            </div>

                            <div class="col-sm-12 form-group">
                                <button onclick="registrar_noveda_produccion();" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Guardar</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/produccion/novedad_produccion.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".novedad_ses").select2();
    $(".prodcuciion_id").select2();
    listas_lotes_cosechas();
    traer_novedades_tipo();

    $("#prodcuciion_id").change(function() {
        var id = $("#prodcuciion_id").val();
        traer_fechas(parseInt(id));
    });
</script>