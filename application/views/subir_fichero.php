<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Subir Archivos
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">General Elements</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div style="display:none;" id="myPrintArea" class="box box-info">
			<div class="box-header with-border">
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				
			</div>
			<!-- /.box-body -->
		</div>
		
		<!--<div class="callout callout-info">
			<h4>INFORMACIÓN!</h4>
			<h4>GENERE SU CODIGO DE PROVEEDOR DE CLIC EN EL BOTON DESPUES DE GENERARLO ANOTELO.
			<button id="btnactcod" type="button" class="btn btn-success btn-xl">Generar Codigo</button>
			
			</h4>
			<h4 id="codgprov"></h4>
		</div>-->
		<!-- SELECT2 EXAMPLE -->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Datos</h3>
				
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">    
					<form name="form_envarchivo" id="form_envarchivo" method="post" role="form" enctype="multipart/form-data" onsubmit="return false" autocomplete="off">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group txtUsuario">
								<label>Cedula*</label>
								<input autocomplete="off" type="text" class="form-control" id="txtcedula" name="txtcedula" placeholder="Datos" autocomplete="new-user">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group txtUsuario">
								<label>Nombres*</label>
								<input autocomplete="off" type="text" class="UpperCase form-control" id="txtnombres" name="txtnombres" placeholder="Datos" autocomplete="new-user">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group txtUsuario">
								<label>Apellidos*</label>
								<input autocomplete="off" type="text" class="UpperCase form-control" id="txtapellidos" name="txtapellidos" placeholder="Datos" autocomplete="new-user">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group txtUsuario">
								<label>Direccion*</label>
								<input autocomplete="off" type="text" class="UpperCase form-control" id="txtdireccion" name="txtdireccion" placeholder="Datos" autocomplete="new-user">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group txtUsuario">
								<label>Genero*</label>
								<!--<input autocomplete="off" type="text" class="form-control" id="txtgenero" name="txtgenero" placeholder="Datos" autocomplete="new-user">-->
								<br/>
								<select class="form-control" name="selectgenero" id="selectgenero">
									<option value="0" selected="" disabled="">Seleccione....</option>
									<option value="MASCULINO">MASCULINO</option>
									<option value="FEMENINO">FEMENINO</option>
								</select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group txtUsuario">
								<label>Celular*</label>
								<input autocomplete="off" type="text" class="form-control" id="txtcelular" name="txtcelular" placeholder="Datos" autocomplete="new-user">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group txtUsuario">
								<label>Título del Archivo*</label>
								<input type="text" class="UpperCase form-control" id="txttitulofile" name="txttitulofile" placeholder="Datos" autocomplete="new-user">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group">
							  <label>Descripción del Archivo:</label>
							  <textarea class="UpperCase form-control" name="txtdescfile" id="txtdescfile" rows="3" placeholder="Datos ..."></textarea>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12"><br>
							<input style="display:none;"type="file" class="form-control-file" name="file[]" id="seleccionararchivo" accept="" multiple>
							<div style="display:none;" class="thumb">
								<img style="display:block; margin:auto;" class="img-responsive" width="50%" src="<?php echo base_url();?>img/loading-animation.gif" alt="loading">
							</div>
						</div>
							<!--<div class="col-lg-12" style="text-align:center">
									<button class="btn btn-primary" id="subir" onclick="Registrar()">Guardar Datos</button>
							</div>-->
					</form>
					<form method="post" id="import_form" enctype="multipart/form-data" class="smart-form">											
						<input type="file" name="file" id="file" required accept=".xls, .xlsx" />
						<button type="submit" name="import" class="btn btn-primary">
													Importar
												</button>
					</form>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="button" class="btn btn-primary pull-right" id="subir" onclick="Registrar()">Guardar Datos</button>
				<button style="" type="button" id="btn_actualizar" class="btn btn-warning pull-right"><i class="fa fa-pencil-square-o"></i> Actualizar</button>
				<button style="display:none;" type="button" id="btn_reload" class="btn btn-info">Cancelar</button>
			</div>
		</div>
		<!-- /.row -->
		<!--modal-->
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-lg">
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
				  <h4 class="modal-title">PDF</h4>
				</div>
				<div class="modal-body">
					<div style="text-align: center;">
						<object id="idembed">
							<p>Este navegador no admite archivos PDF. Descargue el PDF para verlo:
								<a id="idurlpdf" href="">Download PDF</a>
							</p>
						</object>
					</div>
				</div>
			  </div>
			</div>
		</div>
		<!--/.modal-->
		<!-- Default box -->
      
      <!-- /.box -->
	</section>
	<!-- /.content -->
</div>							
<!-- /.content-wrapper -->