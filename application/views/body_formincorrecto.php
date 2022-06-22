<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Información Incorrecta
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
		  <a href="<?php echo base_url('Data_Import/spreadsheet_exportinc');?>" class="btn btn-xs btn-default" id="generar"><i class="fa fa-print"></i> Download Excel Data</a>
		</div>
        <div class="box-body">
			<input readonly type="hidden" id="txtidreporte" name="txtidreporte">
			<div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Actualizar</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" role="form" id="form_act" name="form_act" method="post">
                    <input type="text" readonly style="display:none;" id="text_id" name="text_id">
                    <input type="text" readonly style="display:none;" id="text_nameid" name="text_nameid">
					<input type="text" readonly style="display:none;" id="text_nomind" name="text_nomind">
					<input type="text" readonly style="display:none;" id="text_apeind" name="text_apeind">
					<input type="text" readonly style="display:none;" id="text_idsug" name="text_idsug">
					
                    <div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group">
							  <label class="col-lg-2 control-label">Nombres Error:</label>
							  <div class="col-lg-10">
								<input type="text" readonly class="form-control UpperCase" id="text_name_inc" name="text_name_inc">
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-2 control-label">Nombres Sugerido:</label>
							  <div class="col-lg-10">
								<input type="text" readonly class="form-control UpperCase" id="text_name_sug" name="text_name_sug">
							  </div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="form-group">
							  <label class="col-lg-2 control-label">Cédula Error:</label>
							  <div class="col-lg-10">
								<input type="text" readonly class="form-control UpperCase" id="text_cedula_inc" name="text_cedula_inc">
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-2 control-label">Cédula Sugerida:</label>
							  <div class="col-lg-10">
								<input type="text" readonly class="form-control UpperCase" id="text_cedula_sug" name="text_cedula_sug">
							  </div>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div id="live_data"></div>
						</div>
					</div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" id="btn_actualizar" class="btn btn-default">Actualizar</button>
                </div>
              </div>
            </div>
        </div>
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
			
			<!-- /.box-body -->
		</div>
        <!-- /.box-body -->
	  </div>
	</section>
	<!-- /.content -->
</div>							
<!-- /.content-wrapper -->