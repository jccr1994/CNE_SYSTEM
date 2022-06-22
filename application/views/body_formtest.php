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
                  <h4 class="modal-title">Actualizar</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" role="form" id="form_act" name="form_act" method="post">
                    <input type="text" readonly id="text_id" name="text_id">
                    <div class="form-group">
                      <label class="col-lg-2 control-label">Nombres:</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control" id="text_name" name="text_name">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-lg-2 control-label">Apellidos:</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control" id="text_apellido" name="text_apellido">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-lg-2 control-label">Telefono:</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control" id="text_telefono" name="text_telefono">
                      </div>
                    </div>
					<div class="form-group">
                      <label class="col-lg-2 control-label">Cedula:</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control" id="text_cedula" name="text_cedula">
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
		<!--/.modal-->
		<!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Importar</h3>
		  <!--<button class="btn btn-xs btn-default" id="generar"><i class="fa fa-print"></i> Imprimir</button>
		  -->
		</div>
        <div class="box-body">
			<input readonly type="hidden" id="txtidreporte" name="txtidreporte">
			<div class="row">
				<form id="form_registro" method="post">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="form-group">
							<label>SELECCIONE EL CARGO*</label>
							<select class="selectpersonal form-control" id="selectpersonal" name="selectpersonal" style="width: 100%;" lang="es"></select>
						</div>
						<div class="form-group">
							<label>NOMBRES*</label>
							<input type="text" class="UpperCase form-control" id="txtnombres" name="txtnombres" placeholder="Datos" autocomplete="new-user">
						</div>
						<div class="form-group">
							<label>APELLIDOS*</label>
							<input type="text" class="UpperCase form-control" id="txtapellidos" name="txtapellidos" placeholder="Datos" autocomplete="new-user">
						</div>
						<div class="form-group">
							<label>CEDULA*</label>
							<input type="text" class="UpperCase form-control" id="txtcedula" name="txtcedula" placeholder="Datos" autocomplete="new-user">
						</div>
						<div class="form-group txtUsuario">
							<label>FCHA. NACIMIENTO*</label>
							<input type="text" class="UpperCase form-control" id="txtfnacimiento" name="txtfnacimiento" placeholder="Datos" autocomplete="new-user">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="form-group">
							<label>ESTADO*</label>
							<select class="form-control" name="selectgenero" id="selectgenero">
								<option value="0" selected="" disabled="">Seleccione....</option>
								<option value="ACTIVO">ACTIVO</option>
								<option value="INACTIVO">INACTIVO</option>
							</select>
						</div>
						<div class="form-group">
							<label>GENERO*</label>
							<br/>
							<select class="form-control" name="selectgenero" id="selectgenero">
								<option value="0" selected="" disabled="">Seleccione....</option>
								<option value="MASCULINO">MASCULINO</option>
								<option value="FEMENINO">FEMENINO</option>
							</select>
						</div>
						<div class="form-group">
							<label>CELULAR*</label>
							<input type="text" class="UpperCase form-control" id="txtcelular" name="txtcelular" placeholder="Datos" autocomplete="new-user">
						</div>
						<div class="form-group">
							<label>CORREO*</label>
							<input type="text" class="form-control" id="txtcorreo" name="txtcorreo" placeholder="Datos" autocomplete="new-user">
						</div>
						<div class="form-group">
							<label>DIRECCION*</label>
							<input type="text" class="UpperCase form-control" id="txtdireccion" name="txtdireccion" placeholder="Datos" autocomplete="new-user">
						</div>
					</div>
				</form>
			</div>
		</div>
        <!-- /.box-body -->
		<div class="box-footer">
				<button type="button" class="btn btn-primary pull-right" id="guardar_data">Guardar Datos</button>
				<button style="display:none;" type="button" id="btn_actualizar" class="btn btn-warning pull-right"><i class="fa fa-pencil-square-o"></i> Actualizar</button>
				<button style="display:none;" type="button" id="btn_reload" class="btn btn-info">Cancelar</button>
			</div>
	  </div>
      <!-- /.box -->
	  <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Listado</h3>
		  <!--<button class="btn btn-xs btn-default" id="generar"><i class="fa fa-print"></i> Imprimir</button>
		  -->
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