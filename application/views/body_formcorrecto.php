<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Información Correcta
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
	  <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Listado</h3>
		  <a href="<?php echo base_url('Data_Import/spreadsheet_export');?>" class="btn btn-xs btn-default" id="generar"><i class="fa fa-print"></i> Download Excel Data</a>
		</div>
        <div class="box-body">
			<input readonly type="hidden" id="txtidreporte" name="txtidreporte">
			<div class="box-body">
			  <table id='empTable' class="table table-striped table-bordered nowrap dataTable" style="width:100%">
				<thead>
				  <tr>
					<th>OPCIONES</th>
					<th>NOMBRES</th>
					<th>CEDULA</th>
					<th>TELEFONO</th>
				  </tr>
				</thead>
			  </table>
			</div>
			<!-- /.box-body -->
		</div>
        <!-- /.box-body -->
	  </div>
	</section>
	<!-- /.content -->
</div>							
<!-- /.content-wrapper -->