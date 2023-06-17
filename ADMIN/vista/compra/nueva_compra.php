<script type="text/javascript" src="js/compra.js"></script>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
?>

<br>
<section class="content-header">
    <h3>
        <b> Nuevo compra material <i class="fa fa-shopping-cart"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevo compra material</div>
                    </div>
                    <div class="ibox-body">

                        <div class="row">

                            <div class="col-sm-4 form-group">
                                <label>Proveedor</label> &nbsp;&nbsp; <label style="color:red;" id="razon_oblig"></label>
                                <select class="proveedor form-control" id="proveedor" style="width:100%;">
                                </select>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>N° compra</label> &nbsp;&nbsp; <label style="color:red;" id="numero_obliga"></label>
                                <input type="text" maxlength="20" class="form-control" id="numero_compra" placeholder="Ingrese numero" onkeypress="return soloNumeros(event)">
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
                                <input type="text" maxlength="4" class="form-control" id="impuesto" placeholder="0.00" value="0.12" onkeypress="return filterfloat(event, this);">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_obliga"></label>
                                <input type="date" class="form-control" id="fecha_compra" value="<?php echo $fecha; ?>">
                            </div>

                            <div class="col-sm-1 form-group">
                                <label>Buscar</label>
                                <button class="btn btn-warning" onclick="modal_poductos();"><i class="fa fa-search"></i></button>
                            </div>

                            <input type="hidden" id="id_marca">

                            <div class="col-sm-3 form-group">
                                <label>Codigo Material</label> &nbsp;&nbsp; <label style="color:red;" id="codigo_mate_obliga"></label>
                                <input type="text" maxlength="10" class="form-control" id="codigi_material" placeholder="Ingrese codigo" onkeypress="return soloNumeros(event)">
                            </div>

                            <div class="col-sm-3 form-group">
                                <label>Nombre</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_ma_obliga"></label>
                                <input readonly type="text" class="form-control" id="nombre_ma">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Tipo material</label>
                                <input readonly type="text" class="form-control" id="tipo_m">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Stock</label>
                                <input readonly type="text" class="form-control" id="stock_m">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Precion compra</label> &nbsp;&nbsp; <label style="color:red;" id="precio_compra_obliga"></label>
                                <input type="text" maxlength="10" class="form-control" id="precio_compra" placeholder="Ingrese precio" onkeypress="return filterfloat(event, this);">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Descuento</label> &nbsp;&nbsp; <label style="color:red;" id="descuento_obliga"></label>
                                <input type="text" maxlength="10" value="0.00" class="form-control" id="descuento" placeholder="Ingrese desuento" onkeypress="return filterfloat(event, this);">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Cantidad</label> &nbsp;&nbsp; <label style="color:red;" id="cantiddad_obliga"></label>
                                <input type="text" maxlength="10" class="form-control" id="cantiddad" value="0" onkeypress="return soloNumeros(event)">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Ingresar</label>
                                <button onclick="ingresar_detalle();" class="btn btn-primary"><i class="fa fa-check"></i> Ingresar al detalle</button>
                            </div>

                            <br>

                            <div class="col-lg-12 table-responsive">
                                &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                                <table id="detalle_compra_material" class="table table-striped table-bordered">
                                    <thead bgcolor="orange" style="color:#fff;">
                                        <tr>
                                            <th>Id</th>
                                            <th>Material</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Desc. moneda - dolar</th>
                                            <th>Subtotal</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>

                                    <tbody id="tbody_detalle_compr_material">

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
                                <button onclick="gardar_compra_material();" class="btn btn-primary" type="button"><i class="fa fa-check"></i> Guardar compra</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/compra/nueva_compra.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(".proveedor").select2();
    listar_proveedor();
    listra_material_select();

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

    $("#codigi_material").keyup(function() {
        var numero = $(this).val();
        funcion = "buscar_codi_materil";
        $.ajax({
            url: "../ADMIN/controlador/compra/compra.php",
            type: "POST",
            data: {
                funcion: funcion,
                numero: numero
            },
        }).done(function(response) {
            if (response != 0) {
                var dato = JSON.parse(response);
                $("#id_marca").val(dato[0][0]);
                $("#nombre_ma").val(dato[0][2]);
                $("#tipo_m").val(dato[0][3]);
                $("#stock_m").val(dato[0][5]);
                $("#precio_compra").val(dato[0][4]);
                $("#cantiddad").val("1");
            } else {
                $("#id_marca").val("");
                $("#nombre_ma").val("");
                $("#tipo_m").val("");
                $("#stock_m").val("");
                $("#precio_compra").val("");
                $("#cantiddad").val("0");
            }
        });
    });
</script>


<div class="modal fade" id="modal_materiales_select" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <h4 class="modal-title"><i class="fa fa-cubes"></i> Listado de materiales</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 table-responsive">
                        &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                        <table id="detalle_material_seekct" class="table table-striped table-bordered">
                            <thead bgcolor="black" style="color:#fff;">
                                <tr>
                                    <th>#</th>
                                    <th>Enviar</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Stock</th>
                                    <th>Precio</th> 
                                </tr>
                            </thead>

                            <tbody id="tbody_detalle_material_seekct">

                            </tbody>

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