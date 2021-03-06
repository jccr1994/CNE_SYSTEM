<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Listar Archivos
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
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Listado</h3>
		  <!--<button class="btn btn-xs btn-default" id="generar"><i class="fa fa-print"></i> Imprimir</button>
		  -->
		</div>
        <div class="box-body">
		<input readonly type="hidden" id="txtidreporte" name="txtidreporte">
		  <?php 
			if($_SESSION['tipouser']=='admin'){
		  ?>	
		  <table id='empTable' class="table table-striped table-bordered nowrap dataTable" style="width:100%">
            <thead>
              <tr>
				<th>OPCIONES</th>
                <th>USUARIO</th>
                <th>ARCHIVO</th>
                <th>FECHA</th>
              </tr>
            </thead>
          </table>
		  <?php } ?>
		  <?php 
			if($_SESSION['tipouser']=='usuario'){
		  ?>	
		  <table id='empTable' class="table table-striped table-bordered nowrap dataTable" style="width:100%">
            <thead>
              <tr>
				<th>OPCIONES</th>
                <th>ARCHIVO</th>
                <th>FECHA</th>
              </tr>
            </thead>
          </table>
		  <?php } ?>
		</div>
        <!-- /.box-body -->
	  </div>
      <!-- /.box -->
	</section>
	<!-- /.content -->
</div>							
<!-- /.content-wrapper -->