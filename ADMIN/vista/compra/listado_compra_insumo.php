<script type="text/javascript" src="../ADMIN/js/compra.js"></script>

<br>
<section class="content-header">
    <h3>
        <b> Listado de compras insumo <i class="fa fa-list"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-primary">
                    <div class="ibox-head">
                        <div class="ibox-title">Lista de compras insumo</div>
                    </div>
                    <div class="ibox-body">

                        <table id="tabla_compras_insumo_" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Acci&oacute;n</th>
                                    <th>Estado</th>
                                    <th>Proveedor</th>
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
                                    <th>Proveedor</th>
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

<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_detalle_comppra_insumos" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <h4 class="modal-title"><i class="fa fa-cubes"></i> Detalle compra insumo</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12 table-responsive">
                            &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                            <table id="detalle_compra_insumo" class="table table-striped table-bordered">
                                <thead bgcolor="orange" style="color:#fff;">
                                    <tr>
                                        <th>Id</th>
                                        <th>insumo</th>
                                        <th>Medida</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Desc. moneda - dolar</th>
                                        <th>Subtotal</th> 
                                    </tr>
                                </thead>

                                <tbody id="tbody_detalle_compr_insumo">

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
    listar_compras_insumo();
</script>