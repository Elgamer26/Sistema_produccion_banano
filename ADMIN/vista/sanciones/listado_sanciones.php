<script type="text/javascript" src="../ADMIN/js/multas.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado de sanciones/multas <i class="fa fa-exclamation-circle" style="color:red;"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de sanciones/multas</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_multas_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado multa</th>
                                    <th>Empleado</th>
                                    <th>Tipo sancion</th>
                                    <th>Multa $</th>
                                    <th>Fecha hora sancion</th>
                                    <th>Fecha registro</th>
                                    <th>Motivo empleado</th>
                                    <th>Observacion</th>
                                     <th>Fecha paga multa</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado multa</th>
                                    <th>Empleado</th>
                                    <th>Tipo sancion</th>
                                    <th>Multa $</th>
                                    <th>Fecha hora sancion</th>
                                    <th>Fecha registro</th>
                                    <th>Motivo empleado</th>
                                    <th>Observacion</th>
                                     <th>Fecha paga multa</th>
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
    <div class="modal fade" id="modal_editar_multa" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar multa</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="id_multa_edit">

                        <div class="col-sm-12 form-group">
                            <label>Datos del empleado</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_oblig"></label>
                            <input type="text" readonly class="form-control" id="nombres">
                        </div>


                        <div class="col-sm-4 form-group">
                            <label>Fecha infracción</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_oblig"></label>
                            <input type="date" class="form-control" id="Fecha_i">
                        </div>

                        <div class="col-sm-3 form-group">
                            <label>Hora infracción</label> &nbsp;&nbsp; <label style="color:red;" id="hora_obliga"></label>
                            <input type="time" class="form-control" id="hora_i">
                        </div>

                        <div class="col-sm-5 form-group">
                            <label>Tipo sancion/multa</label> &nbsp;&nbsp; <label style="color:red;" id="tipoo_obliga"></label>
                            <select class="tipo_i form-control" id="tipo_sancin" style="width:100%;">
                            </select>
                        </div>

                        <div class="col-sm-9 form-group">
                            <label>Motivo del empleado</label> &nbsp;&nbsp; <label style="color:red;" id="motivoo_obliga"></label>
                            <input type="text" maxlength="80" placeholder="Ingrese motivo de sancion/multa" class="form-control" id="motivo_i">
                        </div>

                        <div class="col-sm-3 form-group">
                            <label>Multa $</label> &nbsp;&nbsp; <label style="color:red;" id="multa_obliga"></label>
                            <input type="text" onkeypress="return filterfloat(event, this);" maxlength="6" placeholder="Ingrese multa" class="form-control" id="multa_dolra">
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="motivo">Observacion</label> &nbsp;&nbsp; <label style="color:red;" id="obsrvacion_obliga"></label>
                            <textarea class="form-control" id="observacion" cols="3" rows="3" style="resize: none;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_sancion()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(".tipo_i").select2();
    listar_tio_sancion_lis();

    listar_multass();
</script>