<script type="text/javascript" src="../ADMIN/js/tipo_plagas.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado tipos de plagas <i class="fa fa-leaf"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista tipos de plagas</div> <button class="btn btn-danger" onclick="nuevo_tipo_plaga();">Nuevo tipo de plaga</button>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_tipo_plagas" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                    <th>Foto</th>
                                    <th>Descripcion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                    <th>Foto</th>
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

<form autocomplete="false">
    <div class="modal fade" id="modal_nuevo_tipo_plaga" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo tipo de plaga</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <label for="tipo_paga">Tipo plaga</label>
                            <input type="text" maxlength="50" class="form-control" id="tipo_paga" placeholder="Ingrese tipo plaga" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="descripcion">Descripcion</label> &nbsp;&nbsp; <label style="color:red;" id="obsrvacion_obliga"></label>
                            <textarea class="form-control" id="descripcion" cols="3" rows="3" style="resize: none;"></textarea>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label>Foto de plaga</label>&nbsp;&nbsp; <label style="color:orange;">La foto de la plaga noo es obligatorio</label>
                            <input type="file" class="form-control" id="foto">
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="mueva_tipo_plaga()"><i class="fa fa-save"></i> Nuevo</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form autocomplete="false">
    <div class="modal fade" id="modal_eitra_tipo_plaga" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar tipo plaga</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_edit_tipo_plaga">

                        <div class="col-lg-12">
                            <label for="tipo_paga_edit">Tipo plaga</label>
                            <input type="text" maxlength="50" class="form-control" id="tipo_paga_edit" placeholder="Ingrese tipo plaga" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="descripcion_edit">Descripcion</label> &nbsp;&nbsp; <label style="color:red;" id="obsrvacion_obliga"></label>
                            <textarea class="form-control" id="descripcion_edit" cols="3" rows="3" style="resize: none;"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_tipo_plaga()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listar_tipo_plagas();

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