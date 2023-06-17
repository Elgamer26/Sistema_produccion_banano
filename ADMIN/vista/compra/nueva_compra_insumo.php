<script type="text/javascript" src="js/compra.js"></script>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
?>

<br>

<section class="content-header">
    <h3>
        <b> Nuevo compra insumo <i class="fa fa-shopping-cart"></i> </b>
    </h3>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Nuevo compra insumo</div>
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
                                <button class="btn btn-warning" onclick="modal_insumoms();"><i class="fa fa-search"></i></button>
                            </div>

                            <input type="hidden" id="id_insumo">

                            <div class="col-sm-3 form-group">
                                <label>Codigo insumo</label> &nbsp;&nbsp; <label style="color:red;" id="codigo_mate_obliga"></label>
                                <input type="text" maxlength="10" class="form-control" id="codigi_insumoo" placeholder="Ingrese codigo" onkeypress="return soloNumeros(event)">
                            </div>

                            <div class="col-sm-3 form-group">
                                <label>Nombre</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_ma_obliga"></label>
                                <input readonly type="text" class="form-control" id="nombre_ma">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Tipo insumo</label>
                                <input readonly type="text" class="form-control" id="tipo_m">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Medida</label>
                                <input readonly type="text" class="form-control" id="medida_i">
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
                                <input type="text" maxlength="10" value="0.00" class="form-control" id="descuento" placeholder="Ingrecio desuento" onkeypress="return filterfloat(event, this);">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Cantidad</label> &nbsp;&nbsp; <label style="color:red;" id="cantiddad_obliga"></label>
                                <input type="text" maxlength="10" class="form-control" id="cantiddad" value="0" onkeypress="return soloNumeros(event)">
                            </div>

                            <div class="col-sm-2 form-group">
                                <label>Ingresar</label>
                                <button onclick="ingresar_detalle_insumo();" class="btn btn-primary"><i class="fa fa-check"></i> Ingresar al detalle</button>
                            </div>

                            <br>

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
                                            <th>Accion</th>
                                        </tr>
                                    </thead>

                                    <tbody id="tbody_detalle_compr_insumo">

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
                                <button onclick="gardar_compra_insumo();" class="btn btn-primary" type="button"><i class="fa fa-check"></i> Guardar compra</button> -
                                <button onclick="cargar_contenido('contenido_principal','vista/compra/nueva_compra_insumo.php');" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Limpiar</button>
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
    listar_proveedor_insumos();
    listar_isumos_seelct();

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

    $("#codigi_insumoo").keyup(function() {
        var numero = $(this).val();
        funcion = "buscar_codi_insumo";
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
                $("#id_insumo").val(dato[0][0]);
                $("#nombre_ma").val(dato[0][2]);
                $("#tipo_m").val(dato[0][3]);
                $("#medida_i").val(dato[0][5] + " " + dato[0][4]);
                $("#stock_m").val(dato[0][7]);
                $("#precio_compra").val(dato[0][6]);
                $("#cantiddad").val("1");
            } else {
                $("#id_insumo").val("");
                $("#nombre_ma").val("");
                $("#tipo_m").val("");
                $("#medida_i").val("");
                $("#stock_m").val("");
                $("#precio_compra").val("");
                $("#cantiddad").val("0");
            }
        });
    });

    function modal_insumoms() {
        $("#modal_insumo_select").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#modal_insumo_select").modal("show");
    }

    var tabla_insumo_envio;

    function listar_isumos_seelct() {
        var funcion = "listar_isumos_seelct";
        tabla_insumo_envio = $("#detalle_inumos_seekct").DataTable({
            ordering: true,
            paging: true,
            aProcessing: true,
            aServerSide: true,
            searching: {
                regex: true
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"],
            ],
            pageLength: 10,
            destroy: true,
            async: false,
            processing: true,

            ajax: {
                url: "../ADMIN/controlador/compra/compra.php",
                type: "POST",
                data: {
                    funcion: funcion
                },
            },
            //hay que poner la misma cantidad de columnas y tambien en el html
            columns: [{
                    defaultContent: ""
                },
                {
                    render: function(data, type, row) {
                        return `<button style='font-size:13px;' type='button' class='enviar btn btn-danger' title='enviar'><i class='fa fa-send'></i></button>`;
                    },
                },
                {
                    data: "codigo_i"
                },
                {
                    data: "nombre_i"
                },
                {
                    data: "tipo_insumo"
                },
                {
                    data: "stock_m"
                },
                {
                    data: "precio_c"
                },
            ],

            language: {
                rows: "%d fila seleccionada",
                processing: "Tratamiento en curso...",
                search: "Buscar&nbsp;:",
                lengthMenu: "Agrupar en _MENU_ items",
                info: "Mostrando los item (_START_ al _END_) de un total _TOTAL_ items",
                infoEmpty: "No existe datos.",
                infoFiltered: "(filtrado de _MAX_ elementos en total)",
                infoPostFix: "",
                loadingRecords: "Cargando...",
                zeroRecords: "No se encontro resultados en tu busqueda",
                emptyTable: "No hay datos disponibles en la tabla",
                paginate: {
                    first: "Primero",
                    previous: "Anterior",
                    next: "Siguiente",
                    last: "Ultimo",
                },
                select: {
                    rows: "%d fila seleccionada",
                },
                aria: {
                    sortAscending: ": active para ordenar la columa en orden ascendente",
                    sortDescending: ": active para ordenar la columna en orden descendente",
                },
            },
            select: true,
            responsive: "true",
            order: [
                [0, "desc"]
            ],
        });

        //esto es para crearn un contador para la tabla este contador es automatico
        tabla_insumo_envio.on("draw.dt", function() {
            var pageinfo = $("#detalle_inumos_seekct").DataTable().page.info();
            tabla_insumo_envio
                .column(0, {
                    page: "current"
                })
                .nodes()
                .each(function(cell, i) {
                    cell.innerHTML = i + 1 + pageinfo.start;
                });
        });
    }

    $("#detalle_inumos_seekct").on("click", ".enviar", function() {
        //esto esta extrayendo los datos de la tabla el (data)
        var data = tabla_insumo_envio.row($(this).parents("tr")).data(); //a que fila deteta que doy click
        //esta condicion es importante para el responsibe porque salda un error si no lo pongo
        if (tabla_insumo_envio.row(this).child.isShown()) {
            //esto es cuando esta en tamaño responsibo
            var data = tabla_insumo_envio.row(this).data();
        }
        $("#id_insumo").val(data.id_insumo);
        $("#nombre_ma").val(data.nombre_i);
        $("#tipo_m").val(data.tipo_insumo);
        $("#medida_i").val(data.nombre_m);
        $("#stock_m").val(data.stock_m);
        $("#precio_compra").val(data.precio_c);
        $("#codigi_insumoo").val(data.codigo_i);
        $("#cantiddad").val("1");

        $("#modal_insumo_select").modal("hide");
    });
</script>

<div class="modal fade" id="modal_insumo_select" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <h4 class="modal-title"><i class="fa fa-cubes"></i> Listado de insumos</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 table-responsive">
                        &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                        <table id="detalle_inumos_seekct" class="table table-striped table-bordered">
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

                            <tbody id="tbody_detalle_inumos_seekct">

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