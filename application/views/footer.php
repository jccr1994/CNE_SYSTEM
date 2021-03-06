
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.12
    </div>
    <strong>Copyright &copy; 2022-<?php echo date("Y"); ?> <a href="<?php echo base_url(); ?>">CNE</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url();?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>dist/js/demo.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url();?>bower_components/select2/dist/js/i18n/es.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>bower_components/datatables.net-bs/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url();?>bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
<!--jquery confirm-->
<script src="<?php echo base_url();?>bower_components/jquery-confirm/jquery-confirm.min.js"></script>
<!--Autocomplete-->
<script src="<?php echo base_url();?>bower_components/autocomplete/jquery-ui.min.js"></script>

<!--Datepicker-->
<script src="<?php echo base_url();?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js"></script>
<!--alert-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="<?php echo base_url();?>bower_components/pdfObject/pdfobject.min.js"></script>
<style>
.user-panel>.info {
    padding: 5px 5px 5px 15px;
    line-height: 1;
    position: initial;
    left: 55px;
}
/*estilo datatable para que se adapte el contenido a las celdas*/
table.dataTable.nowrap th, table.dataTable.nowrap td {
    white-space: normal;
}
</style>
<script type="text/javascript">
	$(function () {
		$('.UpperCase').keyup(function() {
			$input=$(this);
			setTimeout(function () {
				$input.val($input.val().toUpperCase());
			},50);
		})
		function comprobarsession(){
			$.ajax({
				url: '<?=base_url()?>auth/sessionactiva',
				type: 'POST',
				/*data: {
					id:id_actualizar
				},*/
				success: function(data) {
					console.log(data);
					$(".rst_sessionact").html(data);
				},xhr: function(){ 
					  // get the native XmlHttpRequest object 
					var xhr = $.ajaxSettings.xhr() ; 
					// set the onload event handler 
					xhr.upload.onload = function(){ 
						console.log('DONE!');
					}; 
					return xhr; 
				}
			});
		}
		function logoutsession(){
			$.ajax({
				url: '<?=base_url()?>auth/logoutinactivo',
				type: 'POST',
				/*data: {
					id:id_actualizar
				},*/
				success: function(data) {
					console.log(data);
					$(".rst_sessionact").html(data);
				},xhr: function(){ 
					  // get the native XmlHttpRequest object 
					var xhr = $.ajaxSettings.xhr() ; 
					// set the onload event handler 
					xhr.upload.onload = function(){ 
						console.log('DONE!');
					}; 
					return xhr; 
				}
			});
		}
		$.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
		setInterval(function() {
			$('.skin-blue').one('mouseover', function() { 
				comprobarsession();
			});
		}, 120000);
		$.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
		setInterval(function() {
			comprobarsession();
		}, 300000);
		function e(q) {
			document.body.appendChild( document.createTextNode(q) );
			document.body.appendChild( document.createElement("BR") );
		}
		function inactividad() {
			e("Inactivo!!");
			logoutsession();
		}
		var t=null;
		function contadorInactividad() {
			t=setInterval(function() {inactividad();}, 900000);
		}
		window.onblur=window.onmousemove=function() {
			if(t) clearTimeout(t);
			contadorInactividad();
		}
	});
</script>				
<!-- Page script -->
<?php if($this->uri->uri_string() == 'dashboard/nomincorrecta'){ ?>
<script type="text/javascript">
	var Table = $('#empTable').DataTable({
		'tabIndex': '',
		'responsive': true,
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		//'searching': false, // Remove default Search Control
		//'lengthChange': false,
		'ajax': {
		  'url':'<?=base_url()?>Data_Import/empListnomincorrecta'
		},
		'order': [[ 1, 'asc' ]],
		'columnDefs': [
		  {
			targets: 0,
			orderable: false
		  }
		],
		'columns': [
		   { data: null },
		   { data: 'tbl_usuario_nomape' },
		   { data: 'tbl_test_cedula' },
		   { data: 'tbl_test_celular' }
		],
		'createdRow': function( row, data, dataIndex ) {
		  $('td:eq(0)', row).html(
			'<div class="btn-group">'
			  +'<a type="button" id="btn_update" class="btn btn-warning btn-flat"><i class="fa fa-pencil-square-o"></i></a>'
			  +'</div>'
		  );
		},
		'language': {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":     "Dato no encontrado lo sentimos ;(",
			"sEmptyTable":      "Ning??n dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "??ltimo",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});
	var obtener_data_actualizar = function(tbody, table){
		$(tbody).on("click", "a#btn_update", function(){
			//alert();
			var data = table.row($(this).parents("tr")).data();
			var id_actualizar = data.tbl_test_cedula;
			var nomape = data.tbl_usuario_nomape;
			$('#text_id').val(id_actualizar);
			$('#text_nameid').val(nomape);
			$('#text_name_inc').val(nomape);
			$('#text_cedula_inc').val(id_actualizar);
			$.ajax({
				url: '<?=base_url()?>Data_Import/testnomape',
				dataType: 'json',
				type: 'POST',
				data: {
				  id:id_actualizar,
				  idnomape:nomape
				},
				success: function(data) {
				  //$('#text_cedula_cor').val(data.result.cedula);
				  //$('#text_name_cor').val(data.result.nomape);
				},xhr: function(){ 
				  // get the native XmlHttpRequest object 
				  var xhr = $.ajaxSettings.xhr() ; 
				  // set the onload event handler 
				  xhr.upload.onload = function(){ 
					console.log('DONE!');
					//Table.ajax.reload(function(){
					  //$(".paginate_button > a").on("focus",function(){
						//$(this).blur();
					  //});
					//}, false);
				  }; 
				  return xhr; 
				}
			});
			$("#myModal").modal("show");
			$("#text_name_sug").val("");
			$("#text_cedula_sug").val("");
			$.ajax({  
                url:"<?=base_url()?>Data_Import/lD",  
                method:"POST",
				data: {
				  id:id_actualizar,
				  idnomape:nomape
				},
                success:function(data){  
                    $('#live_data').html(data);  
                }  
			});
		});
	}
	obtener_data_actualizar('#empTable', Table);
	//$('.btn_sugerido').click(function(){
	$(document).on('click', '.btn_sugerido', function(){
		var nombres = $(this).data('id1');
		var cedula = $(this).data('id2');
		var nomind = $(this).data('id4');
		var apeind = $(this).data('id5');
		var idsug = $(this).data('id3');
		
		$("#text_name_sug").val(nombres);
		$("#text_cedula_sug").val(cedula);
		$("#text_nomind").val(nomind);
		$("#text_apeind").val(apeind);
		$("#text_idsug").val(idsug);
	});
	$(document).on('click', '#btn_actualizar', function(){
		var nombresSug=$("#text_name_sug").val();
		var cedulaSug=$("#text_cedula_sug").val();
		
		var nombind=$("#text_nomind").val();
		var apeind=$("#text_apeind").val();
		
		var idsug=$("#text_idsug").val();
		
		if(nombresSug.length != 0 || cedulaSug.length != 0){
			$.ajax({
				url: '<?=base_url()?>Data_Import/actSugerido',
				dataType: 'json',
				type: 'POST',
				data: {
				  idsug:idsug,
				  nomind:nombind,
				  apeind:apeind,
				  cedula:cedulaSug
				},
				success: function(data) {
				  //$('#text_cedula_cor').val(data.result.cedula);
				  //$('#text_name_cor').val(data.result.nomape);
				},xhr: function(){ 
				  // get the native XmlHttpRequest object 
				  var xhr = $.ajaxSettings.xhr() ; 
				  // set the onload event handler 
				  xhr.upload.onload = function(){ 
					console.log('DONE!');
					Table.ajax.reload(function(){
					  $(".paginate_button > a").on("focus",function(){
						$(this).blur();
					  });
					}, false);
					$('#myModal').modal('hide');
				  }; 
				  return xhr; 
				}
			});
		}else{
			Swal.fire('Mensaje De Advertencia',"<h4>Seleccione el dato sugerido, para poder actualizar.</h4>","warning");
		}
	});
</script>
<?php } ?>
<?php if($this->uri->uri_string() == 'dashboard/nomcorrecta'){ ?>
<script type="text/javascript">
	var Table = $('#empTable').DataTable({
		'tabIndex': '',
		'responsive': true,
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		//'searching': false, // Remove default Search Control
		//'lengthChange': false,
		'ajax': {
		  'url':'<?=base_url()?>Data_Import/empListnomcorrecta'
		},
		'order': [[ 1, 'asc' ]],
		'columnDefs': [
		  {
			targets: 0,
			orderable: false
		  }
		],
		'columns': [
		   { data: null },
		   { data: 'tbl_usuario_nomape' },
		   { data: 'tbl_test_cedula' },
		   { data: 'tbl_test_celular' }
		],
		/*'createdRow': function( row, data, dataIndex ) {
		  $('td:eq(0)', row).html(
			'<div class="btn-group">'
			  +'<a type="button" id="btn_update" class="btn btn-warning btn-flat"><i class="fa fa-pencil-square-o"></i></a>'
			  +'<a type="button" id="btn_delete" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a>'
			  +'</div>'
		  );
		},*/
		'language': {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":     "Dato no encontrado lo sentimos ;(",
			"sEmptyTable":      "Ning??n dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "??ltimo",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});
</script>
<?php } ?>
<?php if($this->uri->uri_string() == 'dashboard/formvalidar'){ ?>
<script type="text/javascript">
	$('#import_form').on('submit', function(event){
		event.preventDefault();
		//alert($("#selectgenero").val());
		$.ajax({
			url:'<?php echo base_url();?>Data_Import/importValidar',
			dataType: 'json',
			method:"POST",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			beforeSend:function(data){
				$('input#file').prop('disabled', true);
				$("#import").attr('disabled','disabled');
				//$(".thumb").show();
			},
			success:function(data){
				//enviarxls();
				$('#file').val('');
				$("#import").removeAttr('disabled');		
				$("input#file").removeAttr('disabled');
				
				var status=data.data.message;
				if(status == 'ok'){
					Swal.fire('Mensaje De Confirmacion',"Exito al importar.","success");
				}
				
				/*TableEstudiante.api().ajax.reload(function(){
					$(".paginate_button > a").on("focus",function(){
						$(this).blur();
					});
				},false);*/
				//alert(data);
			}
		});
	});
</script>
<?php } ?>
<?php if($this->uri->uri_string() == 'dashboard/importar'){ ?>
<script type="text/javascript">
	$('#text_telefono').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
	});  
	$('#text_telefono').keypress(function (event) {
		if (this.value.length === 10) {
		return false;
	  }
	});
	$('#text_cedula').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
	});  
	$('#text_cedula').keypress(function (event) {
		if (this.value.length === 10) {
		return false;
	  }
	});
	$('#import_form').on('submit', function(event){
		event.preventDefault();
		//alert($("#selectgenero").val());
		$.ajax({
			url:'<?php echo base_url();?>Data_Import/import',
			dataType: 'json',
			method:"POST",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			beforeSend:function(data){
				$('input#file').prop('disabled', true);
				$("#import").attr('disabled','disabled');
				//$(".thumb").show();
			},
			success:function(data){
				//enviarxls();
				$('#file').val('');
				$("#import").removeAttr('disabled');		
				$("input#file").removeAttr('disabled');
				
				var status=data.data.message;
				if(status == 'ok'){
					Swal.fire('Mensaje De Confirmacion',"Exito al importar.","success");
				}
				
				/*TableEstudiante.api().ajax.reload(function(){
					$(".paginate_button > a").on("focus",function(){
						$(this).blur();
					});
				},false);*/
				//alert(data);
			}
		});
	});
	var Table = $('#empTable').DataTable({
		'tabIndex': '',
		'responsive': true,
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		//'searching': false, // Remove default Search Control
		//'lengthChange': false,
		'ajax': {
		  'url':'<?=base_url()?>Data_Import/empListimport'
		},
		'order': [[ 1, 'asc' ]],
		'columnDefs': [
		  {
			targets: 0,
			orderable: false
		  }
		],
		'columns': [
		   { data: null },
		   { data: 'tbl_padron_nomape' },
		   { data: 'tbl_padron_cedula' },
		   { data: 'tbl_padron_celular' }
		],
		'createdRow': function( row, data, dataIndex ) {
		  $('td:eq(0)', row).html(
			'<div class="btn-group">'
			  +'<a type="button" id="btn_update" class="btn btn-warning btn-flat"><i class="fa fa-pencil-square-o"></i></a>'
			  +'<a type="button" id="btn_delete" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a>'
			  +'</div>'
		  );
		},
		'language': {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":     "Dato no encontrado lo sentimos ;(",
			"sEmptyTable":      "Ning??n dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "??ltimo",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});
	var obtener_data_actualizar = function(tbody, table){
		$(tbody).on("click", "a#btn_update", function(){
			//alert();
			var data = table.row($(this).parents("tr")).data();
			var id_actualizar = data.tbl_padron_id;
			//alert(id_actualizar);
			$.ajax({
				url: '<?=base_url()?>Data_Import/formUpdatedata',
				dataType: 'json',
				type: 'POST',
				data: {
				  id:id_actualizar
				},
				success: function(data) {
				  $('#text_id').val(data.result.id);
				  $('#text_name').val(data.result.nombres);
				  $('#text_apellido').val(data.result.apellidos);
				  $('#text_telefono').val(data.result.celular);
				  $('#text_cedula').val(data.result.cedula);
				},xhr: function(){ 
				  // get the native XmlHttpRequest object 
				  var xhr = $.ajaxSettings.xhr() ; 
				  // set the onload event handler 
				  xhr.upload.onload = function(){ 
					console.log('DONE!');
					/*Table.ajax.reload(function(){
					  $(".paginate_button > a").on("focus",function(){
						$(this).blur();
					  });
					}, false);*/
				  }; 
				  return xhr; 
				}
			});
			$("#myModal").modal("show");
		});
	}
	obtener_data_actualizar('#empTable', Table);
	var obtener_data_eliminar = function(tbody, table){
		$(tbody).on("click", "a#btn_delete", function(){
			//alert();
			var data = table.row($(this).parents("tr")).data();
			var id_actualizar = data.tbl_padron_id;
			alert(id_actualizar);
			/*$.ajax({
				url: '<?=base_url()?>Guardar_Data/delete_form',
				type: 'POST',
				data: {
					id:id_actualizar
				},
				success: function(data) {
					console.log(data);
				},xhr: function(){ 
					  // get the native XmlHttpRequest object 
					var xhr = $.ajaxSettings.xhr() ; 
					// set the onload event handler 
					xhr.upload.onload = function(){ 
					console.log('DONE!');
						Table.ajax.reload(function(){
							$(".paginate_button > a").on("focus",function(){
								$(this).blur();
							});
						}, false);
					}; 
					return xhr; 
				}
			});*/
		});
	}
	obtener_data_eliminar('#empTable', Table);
	$('#btn_actualizar').click(function(){
        $.ajax({
            method: 'POST',
            data: new FormData(form_act),
            url: '<?php echo base_url(); ?>Data_Import/postFormupdate',
            //url: base_urld+'auth/login',
            success: function(data) {
              //console.log(data);
              if(data=="updated"){
                $("#myModal").modal("hide");
              }
            },xhr: function(){ 
              // get the native XmlHttpRequest object 
              var xhr = $.ajaxSettings.xhr() ; 
              // set the onload event handler 
              xhr.upload.onload = function(){ 
                console.log('DONE!');
                Table.ajax.reload(function(){
                  $(".paginate_button > a").on("focus",function(){
                    $(this).blur();
                  });
                }, false);
              }; 
              return xhr; 
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
</script>
<?php } ?>
<?php if($this->uri->uri_string() == 'dashboard/formtest'){ ?>
<script type="text/javascript">
$('.selectpersonal').select2({
	//var cursoID = $("#selectcurso").val();
	placeholder: 'Seleccione Personal...',
						
	ajax: {
		url: '<?php echo base_url(); ?>Cargar_Archivo/leerJson',
		type: "post",
		dataType: 'json',
		delay: 250,
		data: function (params) {
			return {
				//searchTerm: params.term, // search term
				//tipopersonal_id: $("#selecttpopersonal").val()
			};
		},
		processResults: function (data) {
			return {
				results: data
			};
		},
		cache: true
	}
	
});
$('#guardar_data').click(function(){
	var select = $("#selectpersonal").val();
	var formData = new FormData(form_registro);    
	//formData.append( 'post_ip', variable_ip);
	$.ajax({
		url: '<?php echo base_url();?>Cargar_Archivo/insertarJson',
		dataType : 'json',
		type: 'POST',
		data: formData,
		success: function(data) {
			console.log(data);
			//$("#rstform_registro").html(data);
		},xhr: function(){ 
			// get the native XmlHttpRequest object 
			var xhr = $.ajaxSettings.xhr() ; 
			// set the onload event handler 
			xhr.upload.onload = function(){ 
				console.log('DONE!');
				//table_usuarios.ajax.reload();
			}; 
			return xhr; 
		},
		enctype: 'multipart/form-data',
		processData: false, // tell jQuery not to process the data
		contentType: false // tell jQuery not to set contentType
	});
});
					
var Table = $('#empTable').DataTable({
	dom: "Bfrtip",
	//'tabIndex': '',
	//'responsive': true,
	//'processing': true,
	//'serverSide': true,
	//'sPaginationType': "full_numbers",
	//'serverMethod': 'post',
	//'searching': false, // Remove default Search Control
	//'lengthChange': false,
	'ajax': {
	  'url':'https://reqres.in/api/users?page=2',
	  //"type": 'get',
		//"dataType": 'json'
	},
	'order': [[ 1, 'asc' ]],
	'columnDefs': [
	  {
		targets: 0,
		orderable: false
	  }
	],
	'columns': [
	   { data: null },
	   { data: 'email' }
	],
	'createdRow': function( row, data, dataIndex ) {
	  $('td:eq(0)', row).html(
		'<div class="btn-group">'
		  +'<a type="button" id="btn_update" class="btn btn-warning btn-flat"><i class="fa fa-pencil-square-o"></i></a>'
		  +'<a type="button" id="btn_delete" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a>'
		  +'</div>'
	  );
	},
	'language': {
		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":     "Dato no encontrado lo sentimos ;(",
		"sEmptyTable":      "Ning??n dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "??ltimo",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
	}
});
$('#txtfnacimiento').datepicker({
	dateFormat : 'yy-mm-dd',
	autoclose: true,
	language: 'es',
	firstDay: 1
	//format: " yyyy",
	//viewMode: "years", 
	//minViewMode: "years"
});
</script>
<?php } ?>
<?php if($this->uri->uri_string() == 'dashboard' || $this->uri->uri_string() == 'dashboard/listfile' || $this->uri->uri_string() == ''){ ?>
<style>
.container{
    margin-top:20px;
}
.image-preview-input {
    position: relative;
	overflow: hidden;
	margin: 0px;    
    color: #333;
    background-color: #fff;
    border-color: #ccc;    
}
.image-preview-input input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	margin: 0;
	padding: 0;
	font-size: 20px;
	cursor: pointer;
	opacity: 0;
	filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
}
.swal2-title {
    font-size: 1.999em!important;
}
.swal2-content {
    font-size: 1.600em!important;
}
.swal2-styled.swal2-confirm {
    font-size: 1.463em!important;
}
</style>
<script type="text/javascript">
	/*if($(this)[0].files[0].size > 1048576){
				console.log("El documento excede el tama??o m??ximo");
				$('#modal-title').text('??Precauci??n!');
				$('#modal-msg').html("Se solicita un archivo no mayor a 1MB. Por favor verifica.");
				$("#modal-gral").modal();           
				$(this).val('');
			  }else{
				$("#modal-gral").hide();
			  }*/
			  $('#selectgenero').select2({minimumResultsForSearch: -1});
		function form_datapersona(){
			var formData = new FormData();    
			formData.append('post_cedula', $("#txtcedula").val());
			formData.append('post_nombre', $("#txtnombres").val());
			formData.append('post_apellido', $("#txtapellidos").val());
			formData.append('post_direccion', $("#txtdireccion").val());
			formData.append('post_genero', $("#selectgenero").val());
			formData.append('post_celular', $("#txtcelular").val());
			$.ajax({
				url: '<?php echo base_url();?>Cargar_Archivo/guardar_persona',
				type: 'POST',
				data: formData,
				success: function(data) {
					$("#rstform_registro").html(data);
				},xhr: function(){ 
					// get the native XmlHttpRequest object 
					var xhr = $.ajaxSettings.xhr() ; 
					// set the onload event handler 
					xhr.upload.onload = function(){ 
						console.log('DONE!');
						/*Table.ajax.reload(function(){
							$(".paginate_button > a").on("focus",function(){
								$(this).blur();
							});
						}, false);*/
						//table_usuarios.ajax.reload();
					}; 
					return xhr; 
				},
				enctype: 'multipart/form-data',
				processData: false, // tell jQuery not to process the data
				cache: false,
				contentType: false // tell jQuery not to set contentType
			});
		}
		
		
		function Registrar(){
            var texttitulo=$('#txttitulofile').val();
			var textdescripcion=$('#txtdescfile').val();
			var textcedula=$('#txtcedula').val();
			var textnombre=$('#txtnombres').val();
			var textapellido=$('#txtapellidos').val();
			var textdireccion=$('#txtdireccion').val();
			var textgenero=$('#txtgenero').val();
			var textcelular=$('#txtcelular').val();
			
			if(texttitulo!="" || textcedula!=""){
				if(textdescripcion==""){
					var textdescripcion='NN';
				}else{
					var textdescripcion=$('#txtdescfile').val();
				}
				var archivo = $("#seleccionararchivo").val();
				if(archivo.length==0){
					return Swal.fire('Mensaje De Advertencia',"Debe Seleccionar un archivo","warning");
				}
				var ext = $("#seleccionararchivo").val().split('.').pop();
				if(ext == "pdf" || ext == "docx" || ext == "doc"){
					var Form = new FormData($('#form_envarchivo')[0]);
					Form.append('archivo', $('#seleccionararchivo')[0].files[0]); 
					Form.append('txttitulo', texttitulo); 
					Form.append('txtdescripcion', textdescripcion);
					Form.append('post_cedula', $("#txtcedula").val());
					$.ajax({
						url:'<?php echo base_url();?>Cargar_Archivo/guardar_archivo',
						dataType: 'json',
						type:'post',
						data:Form,
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
							$("#txttitulofile").val("");
							$("#txtdescfile").val("");
							$(".thumb").hide();
							var status=respuesta.data.message;
							if(status == 'ok'){
								Swal.fire('Mensaje De Confirmacion',"Se almaceno el archivo con exito","success");
							}
							form_datapersona();
							/*Table.ajax.reload(function(){
								$(".paginate_button > a").on("focus",function(){
									$(this).blur();
								});
							}, false);*/
						}
					});
					return false;
				}else{
					$("#seleccionararchivo").val("");
					Swal.fire('Mensaje De Advertencia',"Extensi??n no permitida: "+ext+"<br>Solo se permite archivos PDF, DOC, DOCX.","warning");
				}
			}else{
				Swal.fire('Mensaje De Advertencia',"Campos sin completar.<br>Los campos con asteriscos son obligatorios.","warning");
			}
			//var formData= new FormData();
            //var foto = $("#seleccionararchivo")[0].files[0];
            //console.log(foto);
			//formData.append('archivo',foto);
            //var size = parseFloat($("#seleccionararchivo")[0].files[0].size / 1024).toFixed(2);
            //alert(size + " KB.");
        }
		
		$('#import_form').on('submit', function(event){
					event.preventDefault();
			//alert($("#selectgenero").val());
			$.ajax({
						url:'<?php echo base_url();?>Guardar_Data/import',
						method:"POST",
						data:new FormData(this),
						contentType:false,
						cache:false,
						processData:false,
						success:function(data){
							//enviarxls();
							$('#file').val('');
							/*TableEstudiante.api().ajax.reload(function(){
								$(".paginate_button > a").on("focus",function(){
									$(this).blur();
								});
							},false);*/
							alert(data);
						}
					});
		});
</script>
<?php if($_SESSION['tipouser']=='admin'){ ?>
<script type="text/javascript">
var Table = $('#empTable').DataTable({
                'tabIndex': '',
                'responsive': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                //'searching': false, // Remove default Search Control
                //'lengthChange': false,
                'ajax': {
                  'url':'<?=base_url()?>Guardar_Data/empList'
                },
                'order': [[ 1, 'asc' ]],
                'columnDefs': [
                  {
                    targets: 0,
                    orderable: false
                  }
                ],
                'columns': [
                   { data: null },
                   { data: 'tbl_usuario_nomape' },
                   { data: 'tbl_archivo_nombre' },
                   { data: 'tbl_archivo_fecha' }
                ],
                'createdRow': function( row, data, dataIndex ) {
                  $('td:eq(0)', row).html(
                    '<div class="btn-group">'
                      +'<a type="button" id="btn_generarpdf" class="btn btn-warning btn-flat"><i class="fa fa-file-pdf-o"></i></a>'
                      +'<a type="button" id="btn_eliminar" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a>'
                      +'</div>'
                  );
                },
                'language': {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":     "Dato no encontrado lo sentimos ;(",
                    "sEmptyTable":      "Ning??n dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "??ltimo",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });

            var obtener_data_eliminar = function(tbody, table){
				$(tbody).on("click", "a#btn_eliminar", function(){
					//alert();
					var data = table.row($(this).parents("tr")).data();
					var id_actualizar = data.idtbl_archivo;
					//alert(id_actualizar);
					$.ajax({
						url: '<?=base_url()?>Guardar_Data/delete_form',
						type: 'POST',
						data: {
							id:id_actualizar
						},
						success: function(data) {
							console.log(data);
						},xhr: function(){ 
							  // get the native XmlHttpRequest object 
							var xhr = $.ajaxSettings.xhr() ; 
							// set the onload event handler 
							xhr.upload.onload = function(){ 
							console.log('DONE!');
								Table.ajax.reload(function(){
									$(".paginate_button > a").on("focus",function(){
										$(this).blur();
									});
								}, false);
							}; 
							return xhr; 
						}
					});
				});
			}
			obtener_data_eliminar('#empTable', Table);
			var hc_generarpdf = function(tbody, table){
				$(tbody).on("click", "a#btn_generarpdf", function(){
					var data = table.row($(this).parents("tr")).data();
					var url = data.tbl_archivo_url;
					var options = {
						height: "400px",
						width: "100%",
						/*page: '2',*/
						pdfOpenParams: {
							view: 'FitV'
							//pagemode: 'thumbs',
							//search: 'lorem ipsum'
						}
					};
					//alert(url);
					PDFObject.embed(url, "#idembed", options);
					$('#idurlpdf').attr('href', url);
					//window.open(url, 'Pdf');
					//$('embed#idembed').attr('src', url);
					$("#myModal").modal("show");
					//$('#idembed').atrr(src, url);
				});
			}
			hc_generarpdf('#empTable', Table);
</script>
<?php } ?>
<?php if($_SESSION['tipouser']=='usuario'){ ?>
<script type="text/javascript">
	$('#txtcedula').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
	});  
	$('#txtcedula').keypress(function (event) {
		if (this.value.length === 10) {
		return false;
	  }
	});
	$('#txtcelular').on('input', function () { 
		this.value = this.value.replace(/[^0-9]/g,'');
	});  
	$('#txtcelular').keypress(function (event) {
		if (this.value.length === 10) {
		return false;
	  }
	});

		
		$('#subir').click(function(){
			/*var var_d1 = $("#txtnombres").val();
			var var_d2 = $("#txtapellidos").val();
			var var_d3 = $("#txtusuario").val();
			var var_d4 = $("#txtcontra").val();
			if(var_d1!="" && var_d2!="" && var_d3!="" && var_d4!=""){
				form_registese();
			}else{
				$.alert("<h4>No se permiten campos vacios los campos con asteriscos son obligatorios</h4>");
			}*/
			//form_datapersona();
		});

var Table = $('#empTable').DataTable({
                'tabIndex': '',
                'responsive': true,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                //'searching': false, // Remove default Search Control
                //'lengthChange': false,
                'ajax': {
                  'url':'<?=base_url()?>Guardar_Data/empList'
                },
                'order': [[ 1, 'asc' ]],
                'columnDefs': [
                  {
                    targets: 0,
                    orderable: false
                  }
                ],
                'columns': [
                   { data: null },
                   { data: 'tbl_archivo_nombre' },
                   { data: 'tbl_archivo_fecha' }
                ],
                'createdRow': function( row, data, dataIndex ) {
                  var fileName = data.tbl_archivo_ext;
				  var ext = fileName.split('.').pop();
				  //alert(ext);
				  if(ext=="pdf"){
				  $('td:eq(0)', row).html(
                    '<div class="btn-group">'
					  +'<a type="button" id="btn_generarpdf" class="btn btn-success btn-flat"><i class="fa fa-file-pdf-o"></i></a>'
                      +'<!--<a type="button" id="btn_eliminar" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a>-->'
                      +'</div>'
                  );
				  }else{
				  $('td:eq(0)', row).html(
                    '<div class="btn-group">'
					  +'<a type="button" href="'+data.tbl_archivo_url+'" name="'+ext+'" class="btn btn-warning btn-flat"><i class="fa fa-download"></i></a>'
                      +'<!--<a type="button" id="btn_eliminar" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a>-->'
                      +'</div>'
                  );  
				  }
                },
                'language': {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":     "Dato no encontrado lo sentimos ;(",
                    "sEmptyTable":      "Ning??n dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "??ltimo",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });

            var obtener_data_eliminar = function(tbody, table){
				$(tbody).on("click", "a#btn_eliminar", function(){
					//alert();
					var data = table.row($(this).parents("tr")).data();
					var id_actualizar = data.idtbl_archivo;
					//alert(id_actualizar);
					$.ajax({
						url: '<?=base_url()?>Guardar_Data/delete_form',
						type: 'POST',
						data: {
							id:id_actualizar
						},
						success: function(data) {
							console.log(data);
						},xhr: function(){ 
							  // get the native XmlHttpRequest object 
							var xhr = $.ajaxSettings.xhr() ; 
							// set the onload event handler 
							xhr.upload.onload = function(){ 
							console.log('DONE!');
								Table.ajax.reload(function(){
									$(".paginate_button > a").on("focus",function(){
										$(this).blur();
									});
								}, false);
							}; 
							return xhr; 
						}
					});
				});
			}
			obtener_data_eliminar('#empTable', Table);
			var hc_generarpdf = function(tbody, table){
				$(tbody).on("click", "a#btn_generarpdf", function(){
					var data = table.row($(this).parents("tr")).data();
					var url = data.tbl_archivo_url;
					var options = {
						height: "400px",
						width: "100%",
						/*page: '2',*/
						pdfOpenParams: {
							view: 'FitV'
							//pagemode: 'thumbs',
							//search: 'lorem ipsum'
						}
					};
					//alert(url);
					PDFObject.embed(url, "#idembed", options);
					$('#idurlpdf').attr('href', url);
					//window.open(url, 'Pdf');
					//$('embed#idembed').attr('src', url);
					$("#myModal").modal("show");
					//$('#idembed').atrr(src, url);
				});
			}
			hc_generarpdf('#empTable', Table);
</script>
<?php } ?>
<?php } ?>
<?php if($this->uri->uri_string() == 'dashboard/usuario'){ ?>

<style>
.swal2-title {
    font-size: 1.999em!important;
}
.swal2-content {
    font-size: 1.600em!important;
}
.swal2-styled.swal2-confirm {
    font-size: 1.463em!important;
}
</style>

<script type="text/javascript">
	$(function () {
		function makeid(length) {
		   var result           = '';
		   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		   var charactersLength = characters.length;
		   for ( var i = 0; i < length; i++ ) {
			  result += characters.charAt(Math.floor(Math.random() * charactersLength));
		   }
		   return result;
		}
		
		function makeiduser(length) {
		   var result           = '';
		   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		   var charactersLength = characters.length;
		   for ( var i = 0; i < length; i++ ) {
			  result += characters.charAt(Math.floor(Math.random() * charactersLength));
		   }
		   return result;
		}

		var input_pass = document.getElementById("txtcontra");
		input_pass.value = makeid(10);
		
		$("#txtusuario").focus(function(){
    		var value_name = $("#txtnombres").val();
			let var_name=value_name.trim();
			if(var_name!=""){
				$(this).css("background-color", "#FFFFCC");
				let frase=var_name;
				frase=frase.replace(/,/g, "");
				let resultado=frase.split(" ");
				$("#txtusuario").val(resultado[0].toLowerCase()+makeiduser(2));
				//console.log(resultado);
			}
		});
		
		$('#txtcontra').on('input', function (e) {
			if (!/^[a-z0-9??????????????_@]*$/i.test(this.value)){
				this.value = this.value.replace(/[^a-z0-9??????????????]+/ig,"");
			}
		});
		
		$('#txtusuario').on('input', function (e) {
			if (!/^[a-z??????????????]*$/i.test(this.value)){
				this.value = this.value.replace(/[^a-z??????????????]+/ig,"");
			}
		});
		
		function form_registese(){
			var formData = new FormData(form_registro);    
			//formData.append( 'post_ip', variable_ip);
			$.ajax({
				url: '<?php echo base_url();?>Guardar_Data/usuario',
				type: 'POST',
				data: formData,
				success: function(data) {
					$("#rstform_registro").html(data);
				},xhr: function(){ 
					// get the native XmlHttpRequest object 
					var xhr = $.ajaxSettings.xhr() ; 
					// set the onload event handler 
				xhr.upload.onload = function(){ 
					console.log('DONE!');
					Table.ajax.reload(function(){
						$(".paginate_button > a").on("focus",function(){
							$(this).blur();
						});
					}, false);
					//table_usuarios.ajax.reload();
				}; 
				return xhr; 
				},
				enctype: 'multipart/form-data',
				processData: false, // tell jQuery not to process the data
				contentType: false // tell jQuery not to set contentType
			});
		}
		
		$('#btn_guardar').click(function(){
			var var_d1 = $("#txtnombres").val();
			var var_d2 = $("#txtapellidos").val();
			var var_d3 = $("#txtusuario").val();
			var var_d4 = $("#txtcontra").val();
			if(var_d1!="" && var_d2!="" && var_d3!="" && var_d4!=""){
				form_registese();
			}else{
				$.alert("<h4>No se permiten campos vacios los campos con asteriscos son obligatorios</h4>");
			}
		});
		
		var Table = $('#empTable').DataTable({
			'tabIndex': '',
			'responsive': true,
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			//'searching': false, // Remove default Search Control
			//'lengthChange': false,
			'ajax': {
			  'url':'<?=base_url()?>Guardar_Data/empListusers'
			},
			'order': [[ 1, 'asc' ]],
			'columnDefs': [
			  {
				targets: 0,
				orderable: false
			  }
			],
			'columns': [
			   { data: null },
			   { data: 'tbl_usuario_nomape' },
			   { data: 'tbl_usuario_username' }
			],
			'createdRow': function( row, data, dataIndex ) {
			  $('td:eq(0)', row).html(
				'<div class="btn-group">'
				  +'<a type="button" id="btn_generarpdf" class="btn btn-warning btn-flat"><i class="fa fa-key"></i></a>'
				  +'<a type="button" id="btn_eliminar" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a>'
				  +'</div>'
			  );
			},
			'language': {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":     "Dato no encontrado lo sentimos ;(",
				"sEmptyTable":      "Ning??n dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "??ltimo",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});
		
		var obtener_data_eliminar = function(tbody, table){
			$(tbody).on("click", "a#btn_eliminar", function(){
				//alert();
				var data = table.row($(this).parents("tr")).data();
				var id_actualizar = data.idtbl_usuario;
				//alert(id_actualizar);
				$.ajax({
					url: '<?=base_url()?>Guardar_Data/delete_user',
					type: 'POST',
					data: {
						id:id_actualizar
					},
					success: function(data) {
						console.log(data);
					},xhr: function(){ 
						  // get the native XmlHttpRequest object 
						var xhr = $.ajaxSettings.xhr() ; 
						// set the onload event handler 
						xhr.upload.onload = function(){ 
						console.log('DONE!');
							Table.ajax.reload(function(){
								$(".paginate_button > a").on("focus",function(){
									$(this).blur();
								});
							}, false);
						}; 
						return xhr; 
					}
				});
			});
		}
		obtener_data_eliminar('#empTable', Table);
		var hc_generarpdf = function(tbody, table){
			$(tbody).on("click", "a#btn_generarpdf", function(){
				var data = table.row($(this).parents("tr")).data();
				var id_actualizar = data.tbl_usuario_table;
				//alert(id_actualizar);
				Swal.fire('Contrase??a',id_actualizar,"success");
			});
		}
		hc_generarpdf('#empTable', Table);
	});
</script>
<?php } ?>
<?php if($this->uri->uri_string() == 'dashboard/directorio' ){ ?>
<script type="text/javascript">
	$(function (){
		$('#txtdirectorio').on('input', function (e) {
			if (!/^[a-z??_]*$/i.test(this.value)){
				this.value = this.value.replace(/[^a-z??]+/ig,"");
			}
		});
		
		var Table = $('#empTable').DataTable({
			'tabIndex': '',
			'pageLength' : 5,
			'lengthMenu': [5, 10, 20],
			'responsive': true,
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			//'searching': false, // Remove default Search Control
			//'lengthChange': false,
			'ajax': {
			  'url':'<?=base_url()?>Guardar_Data/empListdirectorio'
			},
			'order': [[ 1, 'desc' ]],
			'columnDefs': [
			  {
				targets: 0,
				orderable: false
			  }
			],
			'columns': [
			   { data: null },
			   { data: 'tbl_archivo_urlfilemanager' }
			],
			'createdRow': function( row, data, dataIndex ) {
			  $('td:eq(0)', row).html(
				'<div class="btn-group">'
				  +'<a type="button" id="btn_eliminar" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a>'
				  +'</div>'
			  );
			},
			'language': {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":     "Dato no encontrado lo sentimos ;(",
				"sEmptyTable":      "Ning??n dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "??ltimo",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});
		
		var obtener_data_eliminar = function(tbody, table){
			$(tbody).on("click", "a#btn_eliminar", function(){
				//alert();
				var data = table.row($(this).parents("tr")).data();
				var id_actualizar = data.tbl_archivo_urlfilemanager;
				alert(id_actualizar);
				$.ajax({
					url: '<?=base_url()?>Guardar_Data/cons_directorio',
					type: 'POST',
					data: {
						id:id_actualizar
					},
					success: function(data) {
						console.log(data);
					},xhr: function(){ 
						  // get the native XmlHttpRequest object 
						var xhr = $.ajaxSettings.xhr() ; 
						// set the onload event handler 
						xhr.upload.onload = function(){ 
						console.log('DONE!');
							window.location='<?=base_url()?>dashboard/folderuser';
						}; 
						return xhr; 
					}
				});
			});
		}
		obtener_data_eliminar('#empTable', Table);
		
		
		function form_registese(){
			var formData = new FormData(form_registro);    
			//formData.append( 'post_ip', variable_ip);
			$.ajax({
				url: '<?php echo base_url();?>Cargar_Archivo/directorio',
				type: 'POST',
				data: formData,
				success: function(data) {
					$("#rstform_registro").html(data);
				},xhr: function(){ 
					// get the native XmlHttpRequest object 
					var xhr = $.ajaxSettings.xhr() ; 
					// set the onload event handler 
				xhr.upload.onload = function(){ 
					console.log('DONE!');
					Table.ajax.reload(function(){
						$(".paginate_button > a").on("focus",function(){
							$(this).blur();
						});
					}, false);
					//table_usuarios.ajax.reload();
				}; 
				return xhr; 
				},
				enctype: 'multipart/form-data',
				processData: false, // tell jQuery not to process the data
				contentType: false // tell jQuery not to set contentType
			});
		}
		
		$('#btn_guardar').click(function(){
			var var_d1 = $("#txtdirectorio").val();
			if(var_d1!=""){
				form_registese();
			}else{
				$.alert("<h4>No se permiten campos vacios los campos con asteriscos son obligatorios</h4>");
			}
		});
	});
</script>
<?php } ?>
<?php if($this->uri->uri_string() == 'dashboard/filemanager' ){ ?>
<!-- kcfinder -->
<style media="screen" type="text/css">

</style>
<script src="<?php echo base_url();?>ckfinder/ckfinder.js"></script>

<script type="text/javascript">

	/*CKFinder.widget( 'ckfinder-widget', {
		width: '100%',
		height: 600
	} );*/
	
  $('#updatefile').click(function(){
			//$("#ckfinder-widget").load(" #ckfinder-widget");
			CKFinder.widget( 'ckfinder-widget', {
				width: '100%',
				height: 600
			});
		});
	
	var Table = $('#empTable').DataTable({
		'tabIndex': '',
		'pageLength' : 20,
		'lengthMenu': [20, 40],
		//'responsive': true,
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',
		//'searching': false, // Remove default Search Control
		//'lengthChange': false,
		'ajax': {
		  'url':'<?=base_url()?>Guardar_Data/empListfilemanager'
		},
		'order': [[ 1, 'desc' ]],
		'columnDefs': [
		  {
			width: '15%',
			targets: 0,
			orderable: false
		  },
		  {
			width: '43%',
			targets: 1
		  }
		],
		'columns': [
		   { data: null },
		   { data: 'tbl_descriparchivo_nombre' },
		   { data: 'tbl_descriparchivo_descrip' }
		   //{ data: 'tbl_descriparchivo_filename' }
		],
		'createdRow': function( row, data, dataIndex ) {
		  $('td:eq(0)', row).html(
			'<div class="btn-group">'
			  +'<a type="button" id="btn_listar" class="btn btn-primary btn-flat"><i class="fa fa-eye"></i></a>'
			  +'<a type="button" id="btn_eliminar" class="btn btn-danger btn-flat"><i class="fa fa-trash-o"></i></a>'
			  +'</div>'
		  );
		},
		'language': {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":     "Dato no encontrado lo sentimos ;(",
			"sEmptyTable":      "Ning??n dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "??ltimo",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});
	
	var obtener_data_listar = function(tbody, table){
		$(tbody).on("click", "a#btn_listar", function(){
			//alert();
			var data = table.row($(this).parents("tr")).data();
			var id_actualizar = data.tbl_archivo_idtbl_archivo;
			
			//alert(id_actualizar);
			$.ajax({
				url: '<?=base_url()?>Guardar_Data/cons_directorio',
				type: 'POST',
				data: {
					id:id_actualizar
				},
				success: function(data) {
					console.log(data);
				},xhr: function(){ 
					  // get the native XmlHttpRequest object 
					var xhr = $.ajaxSettings.xhr() ; 
					// set the onload event handler 
					xhr.upload.onload = function(){ 
					console.log('DONE!');
						window.location='<?=base_url()?>dashboard/listfile';
						/*CKFinder.widget( 'ckfinder-widget', {
							width: '100%',
							height: 600
						});*/
					}; 
					return xhr; 
				}
			});
		});
	}
	obtener_data_listar('#empTable', Table);
	
	var obtener_data_eliminar = function(tbody, table){
			$(tbody).on("click", "a#btn_eliminar", function(){
				//alert();
				var data = table.row($(this).parents("tr")).data();
				var id_actualizar = data.idtbl_descriparchivo;
				alert(id_actualizar);
				$.ajax({
					url: '<?=base_url()?>Guardar_Data/deletefilemanager',
					type: 'POST',
					data: {
						id:id_actualizar
					},
					success: function(data) {
						console.log(data);
					},xhr: function(){ 
						  // get the native XmlHttpRequest object 
						var xhr = $.ajaxSettings.xhr() ; 
						// set the onload event handler 
						xhr.upload.onload = function(){ 
						console.log('DONE!');
							window.location='<?=base_url()?>dashboard/filemanager';
						}; 
						return xhr; 
					}
				});
			});
		}
		obtener_data_eliminar('#empTable', Table);
	
</script>
<?php } ?>
<?php if($this->uri->uri_string() == 'Home/login' ){ ?>
<script type="text/javascript">
	$(function () {
		$.fn.select2.defaults.set('language', 'es');
		//Initialize Select2 Elements
		$('.select2').select2({
			minimumResultsForSearch: -1
		});
		
		$('.input-number').on('input', function () { 
			this.value = this.value.replace(/[^0-9]/g,'');
		});
		
		$('#fechacertificado').datepicker({
			dateFormat : 'yy-mm-dd',
			//autoclose: true,
			language: 'es',
			firstDay: 1
			//format: " yyyy",
			//viewMode: "years", 
			//minViewMode: "years"
		}).datepicker("setDate", new Date());
			
		function form_registese(){
			var formData = new FormData(form_registro);    
			//formData.append( 'post_ip', variable_ip);
			$.ajax({
				url: '<?php echo base_url();?>index.php/proveedor/postProveedor',
				type: 'POST',
				data: formData,
				success: function(data) {
					$("#rstform_registro").html(data);
				},xhr: function(){ 
					// get the native XmlHttpRequest object 
					var xhr = $.ajaxSettings.xhr() ; 
					// set the onload event handler 
				xhr.upload.onload = function(){ 
					console.log('DONE!');
					//table_usuarios.ajax.reload();
				}; 
				return xhr; 
				},
				enctype: 'multipart/form-data',
				processData: false, // tell jQuery not to process the data
				contentType: false // tell jQuery not to set contentType
			});
		}
		
		$('#btn_guardar').click(function(){
			var var_d1 = $("#txtnombres").val();
			var var_d2 = $("#txtapellidos").val();
			var var_d3 = $("#txtcedula").val();
			var var_d4 = $("#txtedad").val();
			if(var_d1!="" && var_d2!="" && var_d3!="" && var_d4!=""){
				form_registese();
			}else{
				$.alert("<h4>No se permiten campos vacios los campos con asteriscos son obligatorios</h4>");
			}
		});
		
		$('#generar').click(function(){
			var idreporte=$('select[id=select_datatable] option:selected').val();
			if(idreporte!=null){
				var ruta="<?php echo base_url(); ?>index.php/home/reportexls?id="+idreporte;
				window.location.href = ruta;
			}else{
				$.alert("<h4>Seleccione el proyecto.</h4>");
			}
		});
		
		var Table = $('#empTable').DataTable({
			'tabIndex': '',
			'responsive': true,
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			'lengthMenu': [15, 30],
			'ajax': {
				'url': '<?php echo base_url(); ?>index.php/proveedor/empList',
				'data': function(data) {
					// Read values
					var proyecto = $('#select_datatable option:selected').val();
							
					// Append to data
					data.searchByProyecto = proyecto;
				}
			},
			//'order': [[ 0, 'DESC' ]],
			'columnDefs': [
			  {
				targets: 2,
				orderable: false
			  }
			],
			'columns': [
				{ data: 'tbl_cermed_nombres' },
				{ data: 'tbl_cermed_cedula' },
				{
					sortable: false,
					"render": function ( data, type, full, meta ) {
						var buttonID = full.idtbl_cermed;
						return '<div class="btn-group"><a type="button" data-idpdf="'+buttonID+'" id="btn_generarpdf" class="btn btn-warning btn-flat"><i class="fa fa-file-pdf-o"></i></a><a type="button" data-idpdf="'+buttonID+'" id="btn_generarpdf" class="btn btn-warning btn-flat"><i class="fa fa-file-pdf-o"></i></a><a type="button" data-idenv="'+buttonID+'" id="btn_envwhatsapp" class="btn btn-success btn-flat"><i class="fa fa-whatsapp"></i></a></div>';
					}
				},
			],
			'language': {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":     "No se encontraron valores",
				"sEmptyTable":      "Ning??n dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "??ltimo",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});
		$('#select_datatable').change(function(){
			Table.draw();
		});
		var obtener_data_eliminar = function(tbody, table){
		$(tbody).on("click", "a#btn_eliminar", function(){
			//var data = table.row($(this).parents("tr")).data();
			var id_eliminar = $(this).data("idelim");
			//alert($(this).data("idelim"));
			function enviar_datos(var1){
				$.ajax({
					url: '<?php echo base_url(); ?>index.php/proveedor/deleteBnesMaterial',
					type: 'POST',
					data: {
						post_iddelete:var1
					},
					success: function(data) {
						console.log(data);
						//$("#rst_delete").html(data);
					},xhr: function(){ 
						// get the native XmlHttpRequest object 
						var xhr = $.ajaxSettings.xhr() ; 
						// set the onload event handler 
						xhr.upload.onload = function(){ 
							console.log('DONE!');
							Table.ajax.reload(function(){
								$(".paginate_button > a").on("focus",function(){
									$(this).blur();
								});
							}, false);
						}; 
						return xhr; 
					}
				});
			}
			$.alert({
				title: 'Advertencia!',
				icon: 'fa fa-trash-o',
				theme: 'modern',
				animation: 'scale',
				content: '<h4>Usted desea eliminar el registro.<br/>Recuerde si usted elimina el registro se eliminara los bienes.</h4>',
				type: 'blue',
				buttons: {
					btnAceptar: {
						text: '<i class="fa fa-check-circle-o"></i> Aceptar',
						btnClass: 'btn-success',
						action: function(){
							//alert(id_eliminar);
							enviar_datos(id_eliminar);
						}
					},
					btnCancelar: {
						text: '<i class="fa fa-ban"></i> Cancelar',
						btnClass: 'btn-primary',
						action: function(){	
						}
					},
				}
			});
		});
	}
	obtener_data_eliminar('#empTable', Table);
	var hc_generarpdf = function(tbody, table){
        $(tbody).on("click", "a#btn_generarpdf", function(){
			//alert();
			function utf8_to_b64( str ) {
				return window.btoa(unescape(encodeURIComponent( str )));
			}
			var id_actualizar = $(this).data("idpdf");
			//alert(id_actualizar);
			//var ruta=url_base+'certificado/pdf?idind='+utf8_to_b64(id_actualizar);
			var ruta='<?php echo base_url(); ?>index.php/certificado/pdf?idind='+id_actualizar;
			window.open(ruta, 'Certificado Medico');
		});
    }
    hc_generarpdf('#empTable', Table);
	var env_certificado = function(tbody, table){
        $(tbody).on("click", "a#btn_envwhatsapp", function(){
			alert();
			function utf8_to_b64( str ) {
				return window.btoa(unescape(encodeURIComponent( str )));
			}
			var id_actualizar = $(this).data("idenv");
			var mensaje = "Da clic en el enlace para ver el certificado. <?php echo base_url(); ?>index.php/certificado/pdf?idind="+id_actualizar;
			var enlace = "https://api.whatsapp.com/send?text="+mensaje;
			//alert(id_actualizar);
			//var ruta=url_base+'certificado/pdf?idind='+utf8_to_b64(id_actualizar);
			//var ruta='<?php echo base_url(); ?>index.php/certificado/pdf?idind='+id_actualizar;
			//window.open(enlace, 'Certificado Medico');
			window.open("https://api.whatsapp.com/send?text=" + encodeURIComponent(mensaje));
		});
    }
    env_certificado('#empTable', Table);
	});
</script>
<?php } ?>
</body>
</html>