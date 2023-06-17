<script type="text/javascript" src="../ADMIN/js/lotes.js"></script>
<br>
<section class="content-header">
    <h3>
        <b> Listado de lotes <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de lotes</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_lotes_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                    <th>Direccion</th>
                                    <th>Hectárea</th>
                                    <th>Logintud</th>
                                    <th>Latitud</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                    <th>Direccion</th>
                                    <th>Hectárea</th>
                                    <th>Logintud</th>
                                    <th>Latitud</th>
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
    <div class="modal fade" id="modaleditar_lotes" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar lote</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input type="hidden" id="id_lotess">

                        <div class="col-sm-6 form-group">
                            <label>Nombre lote</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_oblig"></label>
                            <input type="text" maxlength="20" class="form-control" id="nombre_lote" placeholder="Ingrese nombre lote" onkeypress="return soloLetras(event)">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Direccion lote</label> &nbsp;&nbsp; <label style="color:red;" id="direccion_obliga"></label>
                            <input type="text" maxlength="80" class="form-control" id="direccion" placeholder="Ingrese direccion lote">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Hectárea</label> &nbsp;&nbsp; <label style="color:red;" id="hectárea_obliga"></label>
                            <input disabled type="number" maxlength="40" class="form-control" id="hectarea" placeholder="Ingrese hectáreas">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Longitud</label> &nbsp;&nbsp; <label style="color:red;" id="Longitud_obliga"></label>
                            <input type="text" maxlength="25" class="form-control" id="Longitud" placeholder="Ingrese Longitud">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Latitud</label> &nbsp;&nbsp; <label style="color:red;" id="Latituds_obliga"></label>
                            <input type="text" maxlength="25" class="form-control" id="Latitud" placeholder="Ingrese Latitud">
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_lotes()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="modal_detalle_lote" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <h4 class="modal-title"><i class="fa fa-edit"></i> Detalle de lote</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12 form-group">
                        <table id="taba_hectareas" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                            <thead bgcolor="purple" style="color:#fff;">
                                <tr>
                                    <th>#</th>
                                    <th>Hectarea</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody id="tbody_taba_hectareasl">

                            </tbody>

                            <tfoot bgcolor="purple" style="color:#fff;">
                                <tr>
                                    <th>#</th>
                                    <th>Hectarea</th>
                                    <th>Estado</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- ///////////////////////// -->
<div class="modal fade" id="modal_produccion" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #f39c12; color:white;">
                    <h4 class="modal-title"><i class="fa fa-cube"></i> Produccion</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-6 form-group">
                            <label>Nombre</label> 
                            <input disabled type="text" maxlength="20" class="form-control" id="nombre_producion">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Fecha inicio</label> 
                            <input disabled type="date" class="form-control" id="fecha_ini">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Fecha fin</label>
                            <input disabled type="date" class="form-control" id="fecha_fin">
                        </div>

                        <div class="col-sm-6 form-group">
                            <label>Dias</label>
                            <input disabled type="text" class="form-control" id="dias_pro">
                        </div>


                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<script>
    listar_lotes();
</script>