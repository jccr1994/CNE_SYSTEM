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
		<div>
		<?php 
			//echo $_COOKIE['userfolder'];
			//unset($_COOKIE['userfolder']);
			function decrypt($data){
				$key="fs%&/df87&/f";
				list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
				return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
			}
			if(isset($_COOKIE['userfolder'])){
				echo decrypt($_COOKIE['userfolder']);
			}
		?>
		</div>
	</section>
	
</div>							
<!-- /.content-wrapper -->