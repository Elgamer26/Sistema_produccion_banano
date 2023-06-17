<script type="text/javascript" src="js/ventas.js"></script>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
$codigo = date("YmdHms");
?>

<br>
<section class="content-header">
    <h3>
        <b> Nuevo venta cajas <i class="fa fa-shopping-cart"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevo venta cajas</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <div class="col-sm-4 form-group">
                                <label>clientes</label> &nbsp;&nbsp; <label style="color:red;" id="cliente_oblig"></label>
                                <select class="clientes form-control" id="clientes" style="width:100%;">
                                </select>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>N° venta</label> &nbsp;&nbsp; <label style="color:red;" id="numero_obliga"></label>
                                <input type="text" maxlength="20" class="form-control" id="numero_compra" value="<?php echo $codigo; ?>" placeholder="Ingrese numero" onkeypress="return soloNumeros(event)">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Tipo comprobante</label>
                                <select class="form-control" id="comprobante_tipo">
                                    <option value="Factura">Factura</option>
                                    <option value="Boleta">Boleta</option>
                                </select>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Impuesto %</label> &nbsp;&nbsp; <label style="color:red;" id="Impuesto_obliga"></label>
                                <input type="text" maxlength="4" class="form-control" id="impuesto" value="0.12" placeholder="0.00" onkeypress="return filterfloat(event, this);">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_obliga"></label>
                                <input type="date" class="form-control" id="fecha_compra" value="<?php echo $fecha; ?>">
                            </div>



                            <div class="col-sm-6 form-group">
                                <label>Racimos de produccion</label> &nbsp;&nbsp; <label style="color:red;" id="racimos_oblig"></label>
                                <select class="racimos form-control" id="racimos" style="width:100%;">
                                </select>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Disponible</label> &nbsp;&nbsp; <label style="color:red;" id="disponible_obliga"></label>
                                <input readonly type="text" class="form-control" id="disponible">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Peso Kg</label>
                                <input readonly type="text" class="form-control" id="peso_kg">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Tipo</label>
                                <input type="text" readonly class="form-control" id="tipo" value="Cajas">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Cantidad</label> &nbsp;&nbsp; <label style="color:red;" id="cantiddad_obliga"></label>
                                <input type="text" maxlength="10" class="form-control" id="cantiddad" value="1" onkeypress="return soloNumeros(event)">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Precio</label> &nbsp;&nbsp; <label style="color:red;" id="precio_obliga"></label>
                                <input type="text" maxlength="10" value="0.00" class="form-control" id="precio" placeholder="Ingrecio" onkeypress="return filterfloat(event, this);">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Descuento</label> &nbsp;&nbsp; <label style="color:red;" id="descuento_obliga"></label>
                                <input type="text" maxlength="10" value="0.00" class="form-control" id="descuento" placeholder="Ingrecio desuento" onkeypress="return filterfloat(event, this);">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Ingresar</label>
                                <button onclick="ingresar_detalle_racimos();" class="btn btn-primary"><i class="fa fa-check"></i> Ingresar al detalle</button>
                            </div>

                            <br>

                            <div class="col-lg-12 table-responsive">
                                &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                                <table id="detalle_venta_racimos" class="table table-striped table-bordered">
                                    <thead bgcolor="orange" style="color:#fff;">
                                        <tr>
                                            <th>Id</th>
                                            <th>Racimos</th>
                                            <th>Tipo</th>
                                            <th>Cantidad</th>
                                            <th>Peso kg</th>
                                            <th>Precio</th>
                                            <th>Descuento</th>
                                            <th>Total</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>

                                    <tbody id="tbody_detalle_venta_racimos">

                                    </tbody>

                                </table>

                            </div>

                            <div class="col-lg-12" style="text-align: right;">
                                <label for="" id="lbl_totalneto"></label>
                                <input hidden type="text" id=txt_totalneto>
                            </div>


                            <div class="col-lg-12" style="text-align: right;">
                                <label for="" id="lbl_impuesto"></label>
                                <input hidden type="text" id=txt_impuesto>
                            </div>

                            <div class="col-lg-12" style="text-align: right;">
                                <label for="" id="lbl_a_pagar"></label>
                                <input hidden type="text" id=txt_a_pagar>
                            </div>

                            <div class="col-sm-12 form-group">
                                <button onclick="guardar_venta_racimos();" class="btn btn-primary" type="button"><i class="fa fa-check"></i> Guardar venta</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/ventas/ventas_racimos.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(".clientes").select2();
    $(".racimos").select2();
    listar_clientes();
    listar_racimos();

    $("#comprobante_tipo").on("change", function() {
        var valor = $(this).val();

        if (valor == "Boleta") {
            $("#impuesto").attr("disabled", true);
            $("#impuesto").val("0.00");
        } else {
            $("#impuesto").removeAttr("disabled");
            $("#impuesto").val("0.12");
        }
    });

    $("#racimos").change(function() {
        var id = $("#racimos").val();
        traer_datos_racimos(parseInt(id));
    });
</script>