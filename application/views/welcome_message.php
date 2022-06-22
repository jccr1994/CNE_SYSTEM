<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$CI =& get_instance();
$CI->load->library('Formkey');
$CI->load->library('Encryption_form');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	
	.text {
	  /*background:red;*/
	  width: 100%;
	  /* Control de la altura con base en el texto del div*/
	  height: auto;
	  word-wrap: break-word;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<form id="form_registro" action="" method="post">
			<dl>
				<?php $CI->formkey->outputKey(); ?>
				<?php echo "<hr>".$_SESSION['form_key']; ?>
				<div class="text">
				<?php
				$readableString = 'juan cedeño';
				$nonceValue=$_SESSION['form_key'];
				echo $encrypted = $CI->encryption_form->encrypt($readableString, $nonceValue);
				echo "<hr>";
				//echo $decrypted = $CI->encryption_form->decrypt($encrypted, $nonceValue);
				?>
				</div>
				<dt><label for="username">Username:</label></dt>
				<dd><input type="text" name="username" id="username" /></dd>
				<dt><label for="username">Password:</label></dt>
				<dd><input type="password" name="password" id="password" /></dd>
				<dt></dt>
				<dd><input id="btn_enviar" type="button" value="Enviar" /></dd>
			<dl>
		</form>
		<div id="rstform_registro"></div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<!-- jQuery 3 -->
<script src="<?php echo base_url();?>bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
	$('#btn_enviar').click(function(){
		var formData = new FormData(form_registro);    
		//formData.append( 'post_ip', variable_ip);
		var key = $("#form_key").val();
		//alert(key);
		$.ajax({
			url: '<?php echo base_url();?>Test_Data/validar',
			type: 'POST',
			data: formData,
			success: function(data) {
				$("#rstform_registro").html(data);
			},xhr: function(){ 
				// get the native XmlHttpRequest object 
				var xhr = $.ajaxSettings.xhr() ; 
				// set the onload event handler 
			xhr.upload.onload = function(){ 
				console.log('DONE!');
			}; 
			return xhr; 
			},
			enctype: 'multipart/form-data',
			processData: false, // tell jQuery not to process the data
			contentType: false // tell jQuery not to set contentType
		});
	});
</script>
</body>
</html>