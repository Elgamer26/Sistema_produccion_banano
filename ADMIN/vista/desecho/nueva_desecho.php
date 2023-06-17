<script type="text/javascript" src="js/desechos_racimos.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Registro de Cajas o Desechos <i class="fa fa-registered"></i> </b>
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

                            <div class="col-sm-12 form-group">
                                <label>Seleccione producción</label> &nbsp;&nbsp; <label style="color:red;" id="prodcuciion_id_oblig"></label>
                                <select class="prodcuciion_id form-control" id="prodcuciion_id"> </select>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Seleccione la fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_ras_des_oblig"></label>
                                <input type="date" class="calendario form-control" placeholder="Ingrese la fecha" id="fecha_ras_des">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Seleccione tipo</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_ses_oblig"></label>
                                <select class="form-control" id="tipo_ses">
                                    <option value="-----------">-----------</option>
                                    <option value="Racimos">Racimos</option>
                                    <option value="Desechos">Desechos</option>
                                </select>
                            </div>

                            <div class="col-sm-3 form-group">
                                <label>Cantidad</label> &nbsp;&nbsp; <label style="color:red;" id="cantidad_oblig"></label>
                                <input type="text" maxlength="10" class="form-control" id="numero_ra" placeholder="Ingrese cantidad" onkeypress="return soloNumeros(event)">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Cajas</label> &nbsp;&nbsp; <label style="color:red;" id="cjas_oblig"></label>
                                <input type="text" maxlength="7" class="form-control" id="cajas_n" placeholder="Ingrese cantidad cajas" onkeypress="return soloNumeros(event)">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Peso/caja Kg</label> &nbsp;&nbsp; <label style="color:red;" id="peso_cja_oblig"></label>
                                <input type="text" maxlength="6" class="form-control" id="peso_cajas" placeholder="Ingrese peso caja">
                            </div>

                            <div class="col-sm-12 form-group">
                                <button onclick="registrar_deschos_csechas();" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Guardar</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/desecho/nueva_desecho.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".prodcuciion_id").select2();
    listas_lotes_cosechas();

    $("#prodcuciion_id").change(function() {
        var id = $("#prodcuciion_id").val();
        traer_fechas(parseInt(id));
    });
</script>