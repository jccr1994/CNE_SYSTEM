<?php 
	$url=$this->uri->uri_string();
?>
    <header class="main-header">
		<div class="rst_sessionact"></div>
		<!-- Logo -->
		<a href="../../index2.html" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>CNE</b></span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b></b> CNE</span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
				  
				  <!-- User Account: style can be found in dropdown.less -->
				  <li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					  <img src="<?php echo base_url();?>image/logomp.jpg" class="user-image" alt="User Image">
					  <span class="hidden-xs"><?php if(isset($_SESSION['idusuario'])){echo ucfirst(strtok($_SESSION['nombres'], ' '))." ".ucfirst(strtok($_SESSION['apellidos'], ' '));} ?></span>
					</a>
					<ul class="dropdown-menu">
					  <!-- User image -->
					  <li class="user-header">
						<img src="<?php echo base_url();?>image/logomp.jpg" class="img-circle" alt="User Image">

						<p>
						  <?php if(isset($_SESSION['idusuario'])){echo ucfirst(strtok($_SESSION['nombres'], ' '))." ".ucfirst(strtok($_SESSION['apellidos'], ' '));} ?>
						  <small>CNE</small>
						</p>
					  </li>
					  
					  <!-- Menu Footer-->
					  <li class="user-footer">
						<div class="pull-left">
						  <!--<a href="#" class="btn btn-default btn-flat">Profile</a>
							-->
						</div>
						<div class="pull-right">
						  <a href="<?php echo base_url(); ?>auth/logout" class="btn btn-default btn-flat">Salir</a>
						</div>
					  </li>
					</ul>
				  </li>
				  
				</ul>
			</div>
		</nav>
	</header>

  <!-- =============================================== -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo base_url();?>image/logomp.jpg" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p>CNE</p>
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu" data-widget="tree">
				<li class="header" style="color:#fff!important">MAIN NAVIGATION</li>
				<?php 
				if(isset($_SESSION['tipouser'])){ 
				if($_SESSION['tipouser']!='admin'){
				?>
				<li class="<?php if($url == 'dashboard' || $url == ''){echo "active";} ?>">
					<a href="<?php echo base_url();?>dashboard">
						<i class="fa fa-upload"></i> <span>Subir Archivos</span>
					</a>
				</li>
				<?php 
				}
				} 
				?>
				<?php 
				if(isset($_SESSION['tipouser'])){ 
				if($_SESSION['tipouser']=='admin'){
				?>
				<li class="<?php if($url == 'dashboard/usuario' || $url == 'dashboard'){echo "active";} ?>">
					<a href="<?php echo base_url();?>dashboard/usuario">
						<i class="fa fa-users"></i> <span>Agregar Usuarios</span>
					</a>
				</li>
				<?php 
				}
				} 
				?>
				<!--<li class="<?php //if($url == 'dashboard/directorio'){echo "active";} ?>">
					<a href="<?php //echo base_url();?>dashboard/directorio">
						<i class="fa fa-folder"></i> <span>Agregar Carpeta</span>
					</a>
				</li>-->
				<?php 
				if(isset($_SESSION['tipouser'])){ 
				if($_SESSION['tipouser']!='admin'){
				?>
				<li class="<?php if($url == 'dashboard/filemanager' || $url == 'dashboard/listfile'){echo "active";} ?>">
					<a href="<?php echo base_url();?>dashboard/filemanager">
						<i class="fa fa-files-o"></i> <span>Gestor de Archivos</span>
					</a>
				</li>
				<?php 
				}
				} 
				?>
				<li class="<?php if($url == 'dashboard/importar'){echo "active";} ?>">
					<a href="<?php echo base_url();?>dashboard/importar">
						<i class="fa fa-files-o"></i> <span>Importar</span>
					</a>
				</li>
				<li class="treeview <?php if($url == 'dashboard/formvalidar' || $url == 'dashboard/nomcorrecta' || $url == 'dashboard/nomincorrecta'){echo "active";} ?>">
				  <a href="#">
					<i class="fa fa-folder"></i> <span>Nómina</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-left pull-right"></i>
					</span>
				  </a>
				  <ul class="treeview-menu">
					<li class="<?php if($url == 'dashboard/formvalidar'){echo "active";} ?>">
						<a href="<?php echo base_url();?>dashboard/formvalidar">
							<i class="fa fa-files-o"></i> <span>Validar Información</span>
						</a>
					</li>
					<li class="<?php if($url == 'dashboard/nomcorrecta'){echo "active";} ?>">
						<a href="<?php echo base_url();?>dashboard/nomcorrecta">
							<i class="fa fa-files-o"></i> <span>Nómina Correcta</span>
						</a>
					</li>
					<li class="<?php if($url == 'dashboard/nomincorrecta'){echo "active";} ?>">
						<a href="<?php echo base_url();?>dashboard/nomincorrecta">
							<i class="fa fa-files-o"></i> <span>Nómina Incorrecta Cédula</span>
						</a>
					</li>
				  </ul>
				</li>
				
				<li class="<?php if($url == 'dashboard/formtest'){echo "active";} ?>">
					<a href="<?php echo base_url();?>dashboard/formtest">
						<i class="fa fa-files-o"></i> <span>Formulario Test</span>
					</a>
				</li>
				<!--<li class="<?php if($url == 'Home/cliente' || $url == 'Home/clienteprod'){echo "active";} ?>">
					<a href="<?php echo base_url();?>index.php/Home/cliente">
						<i class="fa fa-users"></i> <span>Cliente</span>
					</a>
				</li>-->
				<!--<li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
				<li class="header">LABELS</li>
				<li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
				<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
				<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>-->
			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>
  
  <!-- =============================================== -->

