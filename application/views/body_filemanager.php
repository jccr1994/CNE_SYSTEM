<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Administrador de Archivos
			<small>Preview<?php //echo $_SESSION["tipouser"];?></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url();?>dashboard/usuario"><i class="fa fa-dashboard"></i> Usuario</a></li>
			<li class="active">General Elements</li>
		</ol>
		<br/>
		<!--<a id="updatefile">Un Nombre</a>
		<a href="<?php //echo base_url();?>auth/defaultfilemanager">FolderDefault</a>-->
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Listado</h3>
				
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
				</div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<table id='empTable' class="table table-striped table-bordered nowrap dataTable" style="width:100%">
					<thead>
					  <tr>
						<th>Opcion</th>
						<th>Título</th>
						<th>Descripción</th>
						<!--<th>Archivos Adjuntos</th>-->
					  </tr>
					</thead>
				</table>
				<!-- /.row -->
			</div>
			<!-- /.box-body -->
		</div>
		<div id="ckfinder-widget"></div>
		<br/>
	</section>
	
</div>							
<!-- /.content-wrapper -->