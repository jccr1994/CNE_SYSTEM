<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
$CI->load->library('session');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>AdminLTE 2 | Log in</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		
		<!-- base_url() = http://localhost/ventas_ci/-->
		
		<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/template/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/template/font-awesome/css/font-awesome.min.css">
		
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/template/dist/css/AdminLTE.min.css">
		
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<h2></h2>
			</div>
			<!-- /.login-logo -->
			<div class="login-box-body">
				<p class="login-box-msg">Introduzca sus datos de ingreso</p>
				<p id="urlbase" style="display:none;"><?php echo base_url(); ?></p>
				<!--action="<?php //echo base_url(); ?>auth/login"-->
				<form  method="post" id="form_login" name="form_login">
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Usuario" name="username" id="username" value="">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="Password" name="password" id="password">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<?php
						if (isset($_SESSION["login_maxinten"])) {
							echo "<div class='callout callout-danger'>Please wait for <strong id='countdown'>10</strong> seconds</div>";
						} else {
					?>
					<div class="row">
						<div class="col-xs-12">
							<button type="button" id="btn-primary" class="btn btn-primary btn-block btn-flat">Sign In</button>
						</div>
						<!-- /.col -->
					</div>
					<?php } ?>
					<div id="rstbtn_login"></div>
				</form>
				
			</div>
			<!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->
		
		<!-- jQuery 3 -->
		<script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
		<script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
		<!--Encriptar-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>
		<?php
		if (isset($_SESSION["login_maxinten"])) {
		?>
		<script type="text/javascript">
			$(document).ready(function() {
				var seconds = 10; //n??mero de segundos a contar
				function secondPassed() {

				  //var minutes = Math.round((seconds - 30)/60); //calcula el n??mero de minutos
				  var remainingSeconds = seconds % 60; //calcula los segundos
				  //si los segundos usan s??lo un d??gito, a??adimos un cero a la izq
				  if (remainingSeconds < 10) { 
					remainingSeconds = remainingSeconds; 
				  } 
				  //document.getElementById('countdown').innerHTML = minutes + ":" +     remainingSeconds; 
				  document.getElementById('countdown').innerHTML = remainingSeconds; 
				  if (seconds == 0) { 
					clearInterval(countdownTimer); 
					$(location).attr('href','<?=base_url()?>auth/actboton');
					//document.getElementById('countdown').innerHTML = "Buzz Buzz"; 
				  } else { 
					seconds--; 
				  } 
				} 

				var countdownTimer = setInterval(secondPassed, 1000);
			});
		</script>
		<?php } ?>
		<script type="text/javascript">
			//var base_url = window.location.origin;

			//var host = window.location.host;

			//var pathArray = window.location.pathname.split( '/' );
			//var baseurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
			//var baseurl = window.location.origin + window.location.pathname + 'auth/login';
			//alert("<?php echo base_url(); ?>" + 'auth/login' + baseurl + 'auth/login');
			$(document).ready(function() {
				var baseurl = window.location.origin + window.location.pathname + 'auth/login';
				$('#username').on('input', function (e) {
					if (!/^[a-z0-9??????????????_@]*$/i.test(this.value)){
						this.value = this.value.replace(/[^a-z0-9??????????????]+/ig,"");
					}
				});
				$('#password').on('input', function (e) {
					if (!/^[a-z0-9??????????????_@]*$/i.test(this.value)){
						this.value = this.value.replace(/[^a-z0-9??????????????]+/ig,"");
					}
				});
				var base_urld = $("#urlbase").text();
				$('#btn-primary').click(function(){
					var input_pass = document.getElementById("password");
					var var_username = $("#username").val();
					var var_password = $("#password").val();
					//const encodedWord = CryptoJS.enc.Utf8.parse(var_password); // encodedWord Array object
					//const hashInBase64 = CryptoJS.enc.Base64.stringify(encodedWord);
					//input_pass.value = hashInBase64;
					if(var_username!="" && var_password!=""){
						$.ajax({
							method: 'POST',
							data: new FormData(form_login),
							//url: '<?php echo base_url(); ?>auth/login',
							url: '<?php echo base_url(); ?>auth/login',
							success: function(data) {
								$("#rstbtn_login").html(data);
								if (data == "yes"){
                           			window.location.href = base_urld + 'dashboard';
                        		}else if (data == "no"){
                            		$('#rstbtn_login').html('<br><div class="callout callout-danger text-center"><p>El usuario y/o contrase??a son incorrestos.</p></div>');
									document.getElementById("password").value = "";
								}else{
                           	 		$('#rstbtn_login').html('<br><div class="callout callout-danger">' + data + '</div>');
									document.getElementById("password").value = "";
								}
							},xhr: function(){ 
								// get the native XmlHttpRequest object 
								var xhr = $.ajaxSettings.xhr() ; 
								// set the onload event handler 
								xhr.upload.onload = function(){ 
									console.log('DONE!');
								}; 
								return xhr; 
							},
							cache: false,
							contentType: false,
							processData: false
						});
					}else{
						alert("No se permiten campos vacios");
					}
				});
			});
		</script>	
	</body>
</html>