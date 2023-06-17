<script type="text/javascript" src="../ADMIN/js/produccion.js"></script>
<br>
<section class="content-header">
    <h3>
        <b> Listado de produccion <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de produccion</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_produccion_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre de produccion</th>
                                    <th>Lote</th>
                                    <th>Hectarea</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th>Dias</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Nombre de produccion</th>
                                    <th>Lote</th>
                                    <th>Hectarea</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th>Dias</th>
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
    <div class="modal fade" id="modal_detalle_produccion" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-cubes"></i> Detalle produccion</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-12 form-group">
                            <div class="ibox">
                                <div class="ibox-body">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#pill-1-1" data-toggle="tab">Actividades</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#pill-1-2" data-toggle="tab">Materiales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#pill-1-3" data-toggle="tab">Insumos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#pill-1-4" data-toggle="tab">Racimos/Desechos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#pill-1-5" data-toggle="tab">Novedades de produccion</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#pill-1-6" data-toggle="tab">Cintas</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="pill-1-1">
                                            <div class="row">
                                                <table id="tabla_detalle_atividad" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                    <thead bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 20px;">#</th>
                                                            <th>Empleado</th>
                                                            <th>Actividad</th>
                                                            <th>Costo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_detalle_atividad">
                                                    </tbody>
                                                    <tfoot bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 20px;">#</th>
                                                            <th>Empleado</th>
                                                            <th>Actividad</th>
                                                            <th>Costo</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="pill-1-2">
                                            <div class="row">
                                                <table id="tabla_detalle_material" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                    <thead bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 20px;">#</th>
                                                            <th>Material</th>
                                                            <th>Costo</th>
                                                            <th>Cantidad</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_detalle_material">
                                                    </tbody>
                                                    <tfoot bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 20px;">#</th>
                                                            <th>Material</th>
                                                            <th>Costo</th>
                                                            <th>Cantidad</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="pill-1-3">

                                            <div class="row">
                                                <table id="tabla_detalle_insumo" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                    <thead bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 20px;">#</th>
                                                            <th>Insumo</th>
                                                            <th>Costo</th>
                                                            <th>Cant. Medida</th>
                                                            <th>Medida</th>
                                                            <th>Cantidad</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_detalle_insumo">
                                                    </tbody>
                                                    <tfoot bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 20px;">#</th>
                                                            <th>Insumo</th>
                                                            <th>Costo</th>
                                                            <th>Cant. Medida</th>
                                                            <th>Medida</th>
                                                            <th>Cantidad</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="pill-1-4">
                                            <div class="row">

                                                <div class="col-sm-6 form-group">
                                                    <label><b>Racimos</b></label>
                                                    <table id="tabla_racimos" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                        <thead bgcolor="purple" style="color:#fff;">
                                                            <tr>
                                                                <th style="width: 20px;">#</th>
                                                                <th>Fecha</th>
                                                                <th>Cantidad</th>
                                                                <th>Tipo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody_detalle_racimos">
                                                        </tbody>
                                                        <tfoot bgcolor="purple" style="color:#fff;">
                                                            <tr>
                                                                <th style="width: 20px;">#</th>
                                                                <th>Fecha</th>
                                                                <th>Cantidad</th>
                                                                <th>Tipo</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>

                                                </div>

                                                <div class="col-sm-6 form-group">
                                                    <label><b>Desechos</b></label>
                                                    <table id="tabla_desechos" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                        <thead bgcolor="purple" style="color:#fff;">
                                                            <tr>
                                                                <th style="width: 20px;">#</th>
                                                                <th>Fecha</th>
                                                                <th>Cantidad</th>
                                                                <th>Tipo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tbody_detalle_desechos">
                                                        </tbody>
                                                        <tfoot bgcolor="purple" style="color:#fff;">
                                                            <tr>
                                                                <th style="width: 20px;">#</th>
                                                                <th>Fecha</th>
                                                                <th>Cantidad</th>
                                                                <th>Tipo</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="pill-1-5">

                                            <div class="row">
                                                <table id="tabla_detalle_novedad" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                    <thead bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 20px;">#</th>
                                                            <th>Fecha</th>
                                                            <th>Novedad</th>
                                                            <th>Descripcion</th>
                                                            <th>Costo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_detalle_novedad">
                                                    </tbody>
                                                    <tfoot bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 20px;">#</th>
                                                            <th>Fecha</th>
                                                            <th>Novedad</th>
                                                            <th>Descripcion</th>
                                                            <th>Costo</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="pill-1-6">

                                            <div class="row">
                                                <table id="tabala_semanas" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                                    <thead bgcolor="purple" style="color:#fff;">
                                                        <tr>
                                                            <th style="width: 35px;">#</th>
                                                            <th>Semana</th>
                                                            <th>Color</th>
                                                            <th>Fecha registro</th>
                                                            <th>Detalle</th>

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

                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
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

<div class="modal fade" id="modal_avance_produccion" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <h4 class="modal-title"><i class="fa fa-cubes"></i> Avance de producción</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <input hidden type="number" id="id_produccion_">
                    <input hidden type="number" id="id_h_">

                    <div class="col-sm-12 form-group" style="text-align: center;">
                        <h1> <b>Ingrese porcentaje de avance de producción</b> </h1>
                    </div>

                    <div class="col-sm-12 form-group" style="text-align: center;">
                        <select class="form-control" id="pocentaje_">
                            <option value="0">0 %</option>
                            <option value="5">5 %</option>
                            <option value="10">10 %</option>
                            <option value="15">15 %</option>
                            <option value="20">20 %</option>
                            <option value="25">25 %</option>
                            <option value="30">30 %</option>
                            <option value="35">35 %</option>
                            <option value="45">45 %</option>
                            <option value="50">50 %</option>
                            <option value="60">60 %</option>
                            <option value="70">70 %</option>
                            <option value="75">75 %</option>
                            <option value="80">80 %</option>
                            <option value="85">85 %</option>
                            <option value="90">90 %</option>
                            <option value="95">95 %</option>
                            <option value="100">100 %</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-success" onclick="guardar_pocetaje();"><i class="fa fa-save"></i> Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    lisrado_produccion();
</script>