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
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="form-group txtUsuario">
								<label>DIRECTORIO*</label>
								<input type="text" class="form-control" id="txtdirectorio" name="txtdirectorio" placeholder="Datos" autocomplete="new-user">
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