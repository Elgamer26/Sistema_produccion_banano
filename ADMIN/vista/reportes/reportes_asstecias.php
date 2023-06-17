<style>
    .contennidor {
        background: gray;
        min-height: 100vh;
    }
</style>
<br>
<section class="content-header">
    <h3>
        <b> Reporte de asistecias <i class="fa fa-cubes"></i> </b>
    </h3>
</section>
<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Reporte de asistecias </div>
                    </div>
                    <div class="ibox-body">
                        <div class="row">

                            <div class="col-lg-11">
                                <label>Empledo</label>
                                <select id="empleado" class="cla_empleado form-control">
                                </select>
                            </div>

                            <div class="col-lg-1">
                                <label>Buscar</label>
                                <button class="btn btn-primary" onclick="reporte_asistecias_tipo();"><i class="fa fa-eye"></i></button>
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
    $(".cla_empleado").select2();

    $(document).ready(function() {
        listar_empleado();
    });

    function listar_empleado() {
        funcion = "listar_reporte_asistecias";
        $.ajax({
            url: "../ADMIN/controlador/empleado/empleado.php",
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
                        "<option value='" + data[i][0] + "'>Nombres: " + data[i][1] + " - Apellidos: " + data[i][2] + " - Cedula: " + data[i][4] + "</option>";
                }
                //aqui concadenamos al id del select
                $("#empleado").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos</option>";
                $("#empleado").html(cadena);
            }
        });
    }

    function reporte_asistecias_tipo() {
        var id = $("#empleado").val();
        if (id.length == 0 || id == '') {
            return Swal.fire(
                "Mensaje de advertencia",
                "No hay tipo de asistecias para buscar",
                "warning"
            );
        }
        var ifrm = document.getElementById("iframe_produc");
        ifrm.setAttribute("src", "../ADMIN/REPORTES/Pdf/Reportes/reporte_asistecias.php?id='" + id + "'");
    }
</script>