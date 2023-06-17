<script type="text/javascript" src="js/bodega.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Nuevo insumo <i class="fa fa-home"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevo insumo</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <div class="col-sm-3 form-group">
                                <label>Codigo</label> &nbsp;&nbsp; <label style="color:red;" id="codigo_oblig"></label>
                                <input type="text" maxlength="20" class="form-control" id="codigos" placeholder="Ingrese codigo (20)" onkeypress="return soloNumeros(event)">
                            </div>

                            <div class="col-sm-5 form-group">
                                <label>Nombre insumo</label> &nbsp;&nbsp; <label style="color:red;" id="nombrei_obliga"></label>
                                <input type="text" maxlength="50" class="form-control" id="nombre_insumo" placeholder="Ingrese nombre (50)">
                            </div>

                            <div class="col-sm-4 form-group">
                                <label>Marca insumo</label> &nbsp;&nbsp; <label style="color:red;" id="marca_obliga"></label>
                                <input type="text" maxlength="50" class="form-control" id="marca" placeholder="Ingrese marca producto (50)">
                            </div>

                            <div class="col-sm-4 form-group">
                                <label>Tipo insumo</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_ma_obligggq"></label>
                                <select class="tipo_insumo form-control" style="width: 100%" id="tipo_insumo"></select>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Cantidad</label> &nbsp;&nbsp; <label style="color:red;" id="cantidad_obliga"></label>
                                <input type="text" maxlength="20" class="form-control" id="Cantidad" placeholder="Ingrese cantidad (20)" onkeypress="return soloNumeros(event);">
                            </div>

                            <div class="col-sm-3 form-group">
                                <label>Medida</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_medidda_obb"></label>
                                <select class="tipo_medidda form-control" style="width: 100%" id="tipo_medidda"></select>
                            </div>

                            <div class="col-sm-3 form-group">
                                <label>Precio compra</label> &nbsp;&nbsp; <label style="color:red;" id="precio_compra_oblig"></label>
                                <input type="text" maxlength="12" class="form-control" id="precio_venta" placeholder="Ingrese precio compra" onkeypress="return filterfloat(event, this);">
                            </div>

                            <div class="col-sm-12 form-group">
                                <label>Observacion</label> &nbsp;&nbsp; <label style="color:red;" id="observacion_olbigg"></label>
                                <input type="text" maxlength="150" class="form-control" id="observacion" placeholder="Ingrese observacion (150)">
                            </div>

                            <div class="col-sm-12 form-group">
                                <label>Descripcion</label> &nbsp;&nbsp; <label style="color:red;" id="descripc_obliga"></label>
                                <textarea class="form-control" rows="3" id="decripcion_mterial"></textarea>
                            </div>

                            <div class="col-sm-12 form-group">
                                <label>Foto</label> &nbsp;&nbsp; <label style="color:orange;" id="descripc_obliga">La foto del insumo no es obligatorio</label>
                                <input type="file" class="form-control" id="foto">
                            </div>

                            <br>

                            <div class="col-sm-12 form-group">
                                <button onclick="guardar_insumo_nuevo();" class="btn btn-primary" type="button"><i class="fa fa-edit"></i> Guardar</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/bodega/registro_insumo.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(".tipo_insumo").select2();
    $(".tipo_medidda").select2();

    listar_tipo_insumo_combo();
    litar_medida();

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