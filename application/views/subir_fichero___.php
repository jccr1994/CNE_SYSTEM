<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>Subir archivo!</title>
</head>
<body>
	<div class="col-lg-12" style="padding-top:10px;">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <form name="form_envarchivo" id="form_envarchivo" method="post" role="form" enctype="multipart/form-data" onsubmit="return false">
                            <div class="row">
                                <div class="col-lg-12"><br>
                                        <input type="file" class="form-control-file" name="seleccionararchivo" id="seleccionararchivo" accept="">
                                    </div>
                                <div class="col-lg-12" style="text-align:center">
                                        <button class="btn btn-primary" id="subir" onclick="Registrar()">Guardar Datos</button>
                                </div>
                            </div>
                        </form>
						<div style="display:none;" class="thumb">
							<img class="img-responsive" width="100%" src="<?php echo base_url();?>img/loading-animation.gif" alt="loading">
						</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<script>
        function Registrar(){
            var archivo = $("#seleccionararchivo").val();
            if(archivo.length==0){
                return Swal.fire('Mensaje De Advertencia',"Debe Seleccionar un archivo","warning");
            }

            var formData= new FormData();
            var foto = $("#seleccionararchivo")[0].files[0];
            console.log(foto);
			formData.append('archivo',foto);
            //var size = parseFloat($("#seleccionararchivo")[0].files[0].size / 1024).toFixed(2);
            //alert(size + " KB.");
			$.ajax({
                url:'http://localhost/repositorioarchivos/Cargar_Archivo/guardar_archivo',
                type:'post',
                data:formData,
                contentType:false,
                processData:false,
				beforeSend:function(data){
					$('input#seleccionararchivo').prop('disabled', true);
					$("#subir").attr('disabled','disabled');
					$(".thumb").show();
				},
                success: function(respuesta){
					$("#subir").removeAttr('disabled');		
					$("input#seleccionararchivo").removeAttr('disabled');		
					$("#seleccionararchivo").val("");
					$(".thumb").hide();
                    if(respuesta !=0){
                        Swal.fire('<h1>Mensaje De Confirmacion</h1>',"<h1>Se subio el archivo con exito</h1>","success");
                    }
                }
            });
            return false;
        }
    </script>   
</html>