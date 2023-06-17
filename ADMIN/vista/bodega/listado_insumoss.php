<script type="text/javascript" src="../ADMIN/js/bodega.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado de insumos <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de insumos</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_insumos_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Disponible</th>
                                    <th>Estado</th>
                                    <th>Cantidad</th>
                                    <th>Foto</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Tipo insumo</th>
                                    <th>Medida</th>
                                    <th>Cantidad M.</th>
                                    <th>Precio compra</th>
                                    <th>Observacion</th>
                                    <th>Descripcion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Disponible</th>
                                    <th>Estado</th>
                                    <th>Cantidad</th>
                                    <th>Foto</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Marca</th>
                                    <th>Tipo insumo</th>
                                    <th>Medida</th>
                                    <th>Cantidad M.</th>
                                    <th>Precio compra</th>
                                    <th>Observacion</th>
                                    <th>Descripcion</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar_inumos" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar insumos</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_insumo_edit">

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

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_insumoos_b()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>


<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar_foto_insumoss" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #f39c12; color:white;">
                    <h4 class="modal-title"><i class="fa fa-image"></i> Editar foto de insumoss</h4>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <input type="number" id="id_foto_insumoss" hidden>

                        <div class="col-sm-12 form-group">
                            <div class="ibox-body text-center">

                                <img class="img-circle" id="foto_insumosso" white="100px" height="100px">
                                <h5 class="font-strong m-b-10 m-t-10"><span>Foto de insumoss</span></h5>
                                <div>
                                    <button class="btn btn-info btn-rounded m-b-5" onclick="editar_foto_insumoss();"><i class="fa fa-plus"></i> Cambiar foto</button>
                                    <input type="file" id="foto_new" class="form-control">
                                    <input type="text" id="foto_actu" hidden>
                                </div>
                            </div>
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
    listar_b_insumo();

    $(".tipo_insumo").select2();
    $(".tipo_medidda").select2();

    listar_tipo_insumo_combo();
    litar_medida();

    document.getElementById("foto_new").addEventListener("change", () => {
        var filename = document.getElementById("foto_new").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto_new").value = "";
        }
    });
</script>