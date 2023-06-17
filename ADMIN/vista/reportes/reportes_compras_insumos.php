<style>
    .contennidor {
        background: gray;
        min-height: 100vh;
    }
</style>
<br>
<section class="content-header">
    <h3>
        <b> Reporte de commpras insumos <i class="fa fa-cubes"></i> </b>
    </h3>
</section>
<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Reporte de commpras insumos </div>
                    </div>
                    <div class="ibox-body">
                        <div class="row">

                            <div class="col-lg-4">
                                <label>Fecha inicio</label>
                                <input type="date" class="form-control" id="fecha_venta_ini"><br>
                            </div>

                            <div class="col-lg-4">
                                <label>Fecha fin</label>
                                <input type="date" class="form-control" id="fecha_venta_fin"><br>
                            </div>

                            <div class="col-lg-1">
                                <label>Buscar</label>
                                <button class="btn btn-primary" onclick="reprote_compras();"><i class="fa fa-eye"></i></button>
                            </div>

                            <div class="col-lg-12" style="padding: 15px;">
                                <center>
                                    <iframe width="100%" height="100%" class="contennidor" id="iframe_produc"></iframe>
                                </center>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        var n = new Date();
        var y = n.getFullYear();
        var m = n.getMonth() + 1;
        var d = n.getDate();
        if (d < 10) {
            d = '0' + d;
        }
        if (m < 10) {
            m = '0' + m;
        }

        document.getElementById("fecha_venta_ini").value = y + "-" + m + "-" + d;
        document.getElementById("fecha_venta_fin").value = y + "-" + m + "-" + d;

    });

    function reprote_compras() {

        var fecha_inicio = $("#fecha_venta_ini").val();
        var fecha_fin = $("#fecha_venta_fin").val();

        if (fecha_inicio > fecha_fin) {
            return Swal.fire(
                "Mensaje de advertencia",
                "La fecha inicio '" +
                fecha_inicio +
                "' es mayor a la fecha final '" +
                fecha_fin +
                "'",
                "warning"
            );
        }

        var ifrm = document.getElementById("iframe_produc");
        ifrm.setAttribute("src", "../ADMIN/REPORTES/Pdf/Reportes/reportes_compras_insumos.php?f_i='" + fecha_inicio + "'&f_f='" + fecha_fin + "'");

    }
</script>