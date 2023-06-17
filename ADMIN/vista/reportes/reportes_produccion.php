<style>
    .contennidor {
        background: gray;
        min-height: 100vh;
    }
</style>
<br>
<section class="content-header">
    <h3>
        <b> Reporte de produccion <i class="fa fa-cubes"></i> </b>
    </h3>
</section>
<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Reporte de produccion </div>
                    </div>
                    <div class="ibox-body">
                        <div class="row">

                            <div class="col-lg-11">
                                <label>Produccion</label>
                                <select id="tipo_produccion" class="cla_tipo_produccion form-control">
                                </select>
                            </div>

                            <div class="col-lg-1">
                                <label>Buscar</label>
                                <button class="btn btn-primary" onclick="reporte_produccion_tipo();"><i class="fa fa-eye"></i></button>
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
    var funcion;
    $(".cla_tipo_produccion").select2();

    $(document).ready(function() {
        listar_tipo_produccion();
    });

    function listar_tipo_produccion() {
        funcion = "listar_reporte_produccion";
        $.ajax({
            url: "../ADMIN/controlador/produccion/produccion.php",
            type: "POST",
            data: {
                funcion: funcion
            },
        }).done(function(response) {
            if (response != 0) {
                var data = JSON.parse(response);
                var cadena = "";
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {
                    cadena +=
                        "<option value='" + data[i][0] + "'>Lote: " + data[i][1] + " - Fecha inicio: [" + data[i][2] + "] - Fecha fin: [" + data[i][3] + "] - Dias: [" + data[i][4] + "] - Estado: " + data[i][5] + "</option>";
                }
                //aqui concadenamos al id del select
                $("#tipo_produccion").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos</option>";
                $("#tipo_produccion").html(cadena);
            }
        });
    }

    function reporte_produccion_tipo() {
        var id = $("#tipo_produccion").val();
        if (id.length == 0 || id == '') {
            return Swal.fire(
                "Mensaje de advertencia",
                "No hay tipo de produccion para buscar",
                "warning"
            );
        }
        var ifrm = document.getElementById("iframe_produc");
        ifrm.setAttribute("src", "../ADMIN/REPORTES/Pdf/Reportes/reporte_produccion.php?id='" + id + "'");
    }
</script>