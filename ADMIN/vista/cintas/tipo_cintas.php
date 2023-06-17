<script type="text/javascript" src="../ADMIN/js/tipos_cinas.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Tipos de cintas <i class="fa fa-leaf"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista tipos de cintas</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_tipo_cintas" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Opcion</th>
                                    <th>Semana</th>
                                    <th>Color</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Opcion</th>
                                    <th>Semana</th>
                                    <th>Color</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_color_cinta" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Editar color de cinta</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                    <input hidden id="id_cinta">

                        <div class="col-lg-12">
                            <label for="color_cinta">Color cinta</label>
                            <input type='color' class='form-control' id="color_cinta"><br>
                        </div>
 

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_color()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>

<script>
listado_tipos_cintas();
</script>