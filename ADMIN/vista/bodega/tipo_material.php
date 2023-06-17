<script type="text/javascript" src="js/bodega.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Nuevo tipo material <i class="fa fa-registered"></i> </b>
    </h3>
</section>

<div class="content">

    <div class="ibox-body text-center">
        <div class="col-md-6">
            <div class="box box-success box-solid">
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="ibox ibox-success">
                        <div class="ibox-head">
                            <div class="ibox-title">Nuevo tipo material</div>
                        </div>
                        <div class="ibox-body">

                            <div class="row">

                                <div class="col-sm-12 form-group">
                                    <label>Tipo de material</label>
                                    <input type="text" class="form-control" id="tipo_material" placeholder="Ingrese tipo de material">
                                </div>

                                <div class="col-sm-12 form-group">
                                    <button onclick="registrar_tipo_material();" class="btn btn-primary" type="button"><i class="fa fa-save"></i> Guardar</button> -
                                    <button onclick="cargar_contenido('contenido_principal','vista/bodega/tipo_material.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>