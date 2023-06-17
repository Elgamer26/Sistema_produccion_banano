<script type="text/javascript" src="../ADMIN/js/plagas.js"></script>
<br>
<section class="content-header">
    <h3>
        <b> Listado de tratamiento <i class="fa fa-leaf"></i> </b>
    </h3>
</section>
<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de tratamiento</div> <span style="color: white;"><b>Cuando llege a la fecha fin de tratamiento, el tratamiento finalizara</b></span>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_tratamiento_plagas" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>                                 
                                    <th>Estado</th>
                                    <th>Produccion</th>
                                    <th>Tipo de plaga</th>
                                    <th>Tipo tratamiento</th>
                                    <th>Tipo quimico</th>
                                    <th>Cant./Litros</th>
                                    <th>fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th>Dia</th>
                                    <th>Observacion</th>
                                     <th>Avance</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>                                  
                                    <th>Estado</th>
                                    <th>Produccion</th>
                                    <th>Tipo de plaga</th>
                                    <th>Tipo tratamiento</th>
                                    <th>Tipo quimico</th>
                                    <th>Cant./Litros</th>
                                    <th>fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th>Dia</th>
                                    <th>Observacion</th>
                                     <th>Avance</th>
                                    <th>Accion</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_avance_tratmiento" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <h4 class="modal-title"><i class="fa fa-cubes"></i> Avance de tratamiento de plaga</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <input hidden type="number" id="id_tratamiento">

                    <div class="col-sm-12 form-group" style="text-align: center;">
                        <h1> <b>Ingrese porcentaje de avance de tratamiento de plaga</b> </h1>
                    </div>

                    <div class="col-sm-12 form-group" style="text-align: center;">
                        <select class="form-control" id="avance">
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
                <button type="button" class="btn btn-success" onclick="guardar_avance();"><i class="fa fa-save"></i> Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    listar_tratamientos_plagas();
</script>