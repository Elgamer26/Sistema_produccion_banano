<style>
    .contennidor {
        background: gray;
        min-height: 90vh;
    }
</style>
<br>
<section class="content-header">
    <h3>
        <b> Reporte de materiles <i class="fa fa-cube"></i> </b>
    </h3>
</section>
<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <!-- /.box-header -->
            <div class="box-body">

                <div class="ibox ibox-success">
                    <div class="ibox-head">
                        <div class="ibox-title">Reporte de materiles </div>
                    </div>
                    <div class="ibox-body">
                        <div class="row">

                            <div class="col-lg-3">
                                <label>Tipo de material</label>
                                <select id="tipo_materil" class="cla_tipo_materil form-control">
                                </select>
                            </div>

                            <div class="col-lg-1">
                                <label>Buscar</label>
                                <button class="btn btn-primary" onclick="reporte_material_tipo();"><i class="fa fa-eye"></i></button>
                            </div>


                            <div class="col-lg-1">
                                <label>Buscar</label>
                                <button class="btn btn-danger" onclick="ver_todos_los_material();"> <i class="fa fa-eye"></i> Ver todos</button>
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
    $(".cla_tipo_materil").select2();

    $(document).ready(function() {
        listar_tipo_material();
    });

    function listar_tipo_material() {
        funcion = "listar_tipo_material_comobo";
        $.ajax({
            url: "../ADMIN/controlador/bodega/bodega.php",
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
                        "<option value='" + data[i][0] + "'> " + data[i][1] + "</option>";
                }
                //aqui concadenamos al id del select
                $("#tipo_materil").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos</option>";
                $("#tipo_materil").html(cadena);
            }
        });
    }

    function ver_todos_los_material() {
        var ifrm = document.getElementById("iframe_produc");
        ifrm.setAttribute("src", "../ADMIN/REPORTES/Pdf/Reportes/full_material.php");
    }

    function reporte_material_tipo() {
        var id = $("#tipo_materil").val();
        if (id.length == 0 || id == '') {
            return Swal.fire(
                "Mensaje de advertencia",
                "No hay tipo de material para buscar",
                "warning"
            );
        }
        var ifrm = document.getElementById("iframe_produc");
        ifrm.setAttribute("src", "../ADMIN/REPORTES/Pdf/Reportes/reporte_material_tipo.php?id='" + id + "'");
    }
</script>