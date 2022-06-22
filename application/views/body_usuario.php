<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Usuario
			<small>Preview</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>dashboard/usuario"><i class="fa fa-dashboard"></i> Usuario</a></li>
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
					<form id="form_registro" method="post">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group txtUsuario">
								<label>NOMBRES*</label>
								<input type="text" class="UpperCase form-control" id="txtnombres" name="txtnombres" placeholder="Datos" autocomplete="new-user">
							</div>
							<div class="form-group txtUsuario">
								<label>APELLIDOS*</label>
								<input type="text" class="UpperCase form-control" id="txtapellidos" name="txtapellidos" placeholder="Datos" autocomplete="new-user">
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group txtUsuario">
								<label>USUARIO*</label>
								<input type="text" class="form-control input-number" id="txtusuario" name="txtusuario" placeholder="Datos" autocomplete="new-user">
							</div>
							<div class="form-group txtUsuario">
								<label>CONTRASEÑA*</label>
								<input type="text" class="form-control input-number" id="txtcontra" name="txtcontra" placeholder="Datos" autocomplete="new-user">
							</div>
						</div>
					</form>
					<div id="rstform_registro"></div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="button" id="btn_guardar" class="btn btn-info pull-right">Guardar</button>
				<button style="display:none;" type="button" id="btn_actualizar" class="btn btn-warning pull-right"><i class="fa fa-pencil-square-o"></i> Actualizar</button>
				<button style="display:none;" type="button" id="btn_reload" class="btn btn-info">Cancelar</button>
			</div>
		</div>
		<!-- /.row -->
		<!--formulario modal para agregar-->
		<div id="form_regresponsable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
				<div class="modal-content">		
					<div id="rst_btncategoryagrpro"></div>
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Agregar</h4>
					</div>
					<div class="modal-body">
						<form id="form_regproyecto" method="post">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group txtUsuario">
										<label>PROYECTO*</label>
										<textarea class="UpperCase form-control" id="txtproyecto" name="txtproyecto" rows="3" placeholder="Enter ..."></textarea>
									</div>
									<div class="form-group">
										<label>FECHA*</label>

										<div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" id="fechaproyecto" name="fechaproyecto">
										</div>
										<!-- /.input group -->
									</div>
									<div class="form-group txtUsuario">
										<label>ADMINISTRADOR DEL PROYECTO*</label>
										<input type="text" class="UpperCase form-control" id="txtadmproyecto" name="txtadmproyecto" placeholder="Datos" autocomplete="new-user">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group txtUsuario">
										<label>PROVEEDOR*</label>
										<input type="text" class="UpperCase form-control" id="txtproveedor" name="txtproveedor" placeholder="Datos" autocomplete="new-user">
									</div>
									<div class="form-group">
									  <label>FACTURAS</label>
									  <textarea class="UpperCase form-control" name="txtfacturas" rows="3" placeholder="Enter ..."></textarea>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> <strong>Cerrar</strong></button>
						<button id="btn_agrdtosproyecto" class="btn btn-primary"><i class="fa fa-floppy-o"></i> <strong>Guardar</strong></button>
					</div>
				</div>
			</div>	
		</div>
		<!--/.-->
		<!--formulario modal para actualizar/eliminar-->
		<div id="form_actelim" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"  data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
				<div class="modal-content">		
					<div id="rst_btncategoryagrpro"></div>
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Agregar</h4>
					</div>
					<div class="modal-body">
						<form id="form_actelimdatos" method="post">
							<input type="hidden" readonly id="idact" name="idact">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group txtUsuario">
										<label>PROYECTO*</label>
										<textarea class="UpperCase form-control" id="txtproyectoact" name="txtproyectoact" rows="3" placeholder="Enter ..."></textarea>
									</div>
									<div class="form-group">
										<label>FECHA*</label>

										<div class="input-group date">
										  <div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										  </div>
										  <input type="text" class="form-control pull-right" id="fechaproyectoact" name="fechaproyectoact">
										</div>
										<!-- /.input group -->
									</div>
									<div class="form-group txtUsuario">
										<label>ADMINISTRADOR DEL PROYECTO*</label>
										<input type="text" class="UpperCase form-control" id="txtadmproyectoact" name="txtadmproyectoact" placeholder="Datos" autocomplete="new-user">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6">
									<div class="form-group txtUsuario">
										<label>PROVEEDOR*</label>
										<input type="text" class="UpperCase form-control" id="txtproveedoract" name="txtproveedoract" placeholder="Datos" autocomplete="new-user">
									</div>
									<div class="form-group">
									  <label>FACTURAS</label>
									  <textarea class="UpperCase form-control" name="txtfacturasact" id="txtfacturasact" rows="3" placeholder="Enter ..."></textarea>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> <strong>Cerrar</strong></button>
						<button id="btn_actbienes" class="btn btn-warning"><i class="fa fa-floppy-o"></i> <strong>Actualizar</strong></button>
						<button id="btn_elibienes" class="btn btn-danger pull-left"><i class="fa fa-trash-o"></i> <strong>Eliminar</strong></button>
					</div>
				</div>
			</div>	
		</div>
		<!--/.-->
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
			  <h3 class="box-title">Listado</h3>
			  <!--<button class="btn btn-xs btn-default" id="generar"><i class="fa fa-print"></i> Imprimir</button>
			  -->
			</div>
			<div class="box-body">
			  <table id='empTable' class="table table-striped table-bordered nowrap dataTable" style="width:100%">
				<thead>
				  <tr>
					<th>OPCIONES</th>
					<th>NOMBRES</th>
					<th>USUARIO</th>
				  </tr>
				</thead>
			  </table>
			</div>
        <!-- /.box-body -->
		</div>
      <!-- /.box -->
	</section>
	<!-- /.content -->
</div>							
<!-- /.content-wrapper -->