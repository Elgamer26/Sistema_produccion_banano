<script type="text/javascript" src="../ADMIN/js/bodega.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado de materiales <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de materiales</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_materiales_" class="display responsive nowrap" style="width:100%">
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
                                    <th>Tipo</th>
                                    <th>Color</th>
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
                                    <th>Tipo</th>
                                    <th>Color</th>
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
    <div class="modal fade" id="modal_editar_mterial" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar mterial</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_mterial_edit">

                        <div class="col-sm-3 form-group">
                            <label>Codigo</label> &nbsp;&nbsp; <label style="color:red;" id="codigo_oblig"></label>
                            <input type="text" maxlength="20" class="form-control" id="codigos" placeholder="Ingrese codigo (20)" onkeypress="return soloNumeros(event)">
                        </div>

                        <div class="col-sm-5 form-group">
                            <label>Nombre material</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_obliga"></label>
                            <input type="text" maxlength="50" class="form-control" id="nombres" placeholder="Ingrese nombre (50)">
                        </div>

                        <div class="col-sm-4 form-group">
                            <label>Marca material</label> &nbsp;&nbsp; <label style="color:red;" id="marca_obliga"></label>
                            <input type="text" maxlength="50" class="form-control" id="marca" placeholder="Ingrese marca producto (50)">
                        </div>

                        <div class="col-sm-4 form-group">
                            <label>Tipo material</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_ma_obligggq"></label>
                            <select class="tipo_material_2 form-control" style="width: 100%" id="tipo_material_2"></select>
                        </div>

                        <div class="col-sm-4 form-group">
                            <label>Color(s)</label> &nbsp;&nbsp; <label style="color:red;" id="color_obliga"></label>
                            <input type="text" maxlength="50" class="form-control" id="color" placeholder="Ingrese color(s) (50)" onkeypress="return soloLetras(event)">
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
                    <button type="button" class="btn btn-primary" onclick="editar_material_b()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>


<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar_foto_mateial" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #f39c12; color:white;">
                    <h4 class="modal-title"><i class="fa fa-image"></i> Editar foto de material</h4>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <input type="number" id="id_foto_material" hidden>

                        <div class="col-sm-12 form-group">
                            <div class="ibox-body text-center">

                                <img class="img-circle" id="foto_materialo" white="100px" height="100px">
                                <h5 class="font-strong m-b-10 m-t-10"><span>Foto de material</span></h5>
                                <div>
                                    <button class="btn btn-info btn-rounded m-b-5" onclick="editar_foto_material();"><i class="fa fa-plus"></i> Cambiar foto</button>
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
    $(".tipo_material_2").select2();
    listar_tipo_material_comobo_2();

    listar_n_matrial();

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