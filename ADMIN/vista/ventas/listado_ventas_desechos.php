<script type="text/javascript" src="../ADMIN/js/ventas.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado de ventas desechos <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-danger box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-danger">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de ventas desechos</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_ventas_desechos" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Cliente</th>
                                    <th>N° comprabante</th>
                                    <th>Tipo</th>
                                    <th>Impuesto</th>
                                    <th>Fecha</th>
                                    <th>Sub total</th>
                                    <th>Sub iva</th>
                                    <th>Total a pagar</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Cliente</th>
                                    <th>N° comprabante</th>
                                    <th>Tipo</th>
                                    <th>Impuesto</th>
                                    <th>Fecha</th>
                                    <th>Sub total</th>
                                    <th>Sub iva</th>
                                    <th>Total a pagar</th>
                                    <th>Cantidad</th>
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
    <div class="modal fade" id="modal_detalle_venta_rasimos" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-cubes"></i> Detalle venta desechos</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                            <table id="detalle_venta_desechos" class="table table-striped table-bordered">
                                <thead bgcolor="orange" style="color:#fff;">
                                    <tr>
                                        <th>Id</th>
                                        <th>Desechos</th>
                                        <th>Tipo</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Descuento</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_detalle_venta_desechos">
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12" style="text-align: right;">
                            <label for="" id="lbl_totalneto"></label>
                        </div>

                        <div class="col-lg-12" style="text-align: right;">
                            <label for="" id="lbl_impuesto"></label>
                        </div>

                        <div class="col-lg-12" style="text-align: right;">
                            <label for="" id="lbl_a_pagar"></label>
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
    listar_ventas_desechos();
</script>