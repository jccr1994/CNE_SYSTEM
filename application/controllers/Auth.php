<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){
		/*Cargo los datos de la consulta de la BD*/
		parent::__construct();
		$this->load->model("Usuarios_model");
		$this->load->library('encryption');
		$this->load->helper('cookie');
		$this->load->library('session');
	}
	public function index()
	{
		/*se verifica que la session este iniciada*/
		if($this->session->userdata("login")){
			redirect(base_url()."dashboard");
		}else{
			$this->load->view('login');
		}
	}
	public function admin()
	{
		$this->load->view('login');
	}
	public function filter($str){
		/*remover caracteres especiales*/
		//convert case to lower
		$str = strtolower($str);
		//remove special characters
		$str = preg_replace('/[^a-zA-Z0-9_]/i',' ', $str);
		//remove white space characters from both side
		$str = trim($str);
		return $str;
	}
	
	public function login(){
		/*obtener los datos del formulario por post*/
		$username=$this->input->post("username");
		$password=$this->input->post("password");
		//echo $this->encryption->encrypt('hhhh');
		//echo $username;
		$res = $this->Usuarios_model->login($this->filter($username));
		
		//echo $password_db=$this->hashpass($password);
		
		if (isset($_SESSION["login_attempts"])) {
			if ($_SESSION["login_attempts"] > 2) {
				$_SESSION["locked"] = time();
				$_SESSION["login_maxinten"]=time();
				echo "<script type='text/javascript'>window.location.reload();</script>";
			}
		}
		if(!$res){
			echo "El usuario y/o contraseña son incorrestos";
			if (!isset($_SESSION["login_attempts"])) {
				$_SESSION["login_attempts"] = 1;
			} else {
				$_SESSION["login_attempts"] += 1;
			}
		}else{
			$password_db=$res->tbl_usuario_password;
			if (password_verify($password, $password_db)){
				$data=array(
					'idusuario' => $res->idtbl_usuario,
					'nombres' => $res->tbl_usuario_nombre,
					'apellidos' => $res->tbl_usuario_apellido,
					'tipouser' => $res->tbl_usuario_tipousuario,
					'idroles' => $res->tbl_usuario_rol,
					'directoriofiles' => $res->tbl_usuario_username,
					'login' => TRUE
				);
				$cookieuser=array(
					'name' => 'user',
					'value' => $res->tbl_usuario_username,
					'expire' => '7200',
					'secure' => TRUE
				);
				$cookietipouser=array(
					'name' => 'tipouser',
					'value' => $res->tbl_usuario_tipousuario,
					'expire' => '7200',
					'secure' => TRUE
				);
				$this->input->set_cookie($cookieuser);
				$this->input->set_cookie($cookietipouser);
				$this->session->set_userdata($data);
				echo 'yes';
			}else{
				echo "El usuario y/o contraseña son incorrestos";
				if (!isset($_SESSION["login_attempts"])) {
					$_SESSION["login_attempts"] = 1;
				} else {
					$_SESSION["login_attempts"]++;
				}
			}
		}
		/*if(!$res){
			//echo '
				//<br/>
				//<div class="callout callout-danger">
					//<p>El usuario y/o contraseña son incorrestos.</p>
				//</div>
			//';
			echo 'no';
			if(!isset($username) || !isset($password)){
				redirect(base_url());
			}
			//redirect(base_url());
		}else{
			$data=array(
				'idusuario' => $res->idtbl_usuario,
				'nombres' => $res->tbl_usuario_nombre,
				'apellidos' => $res->tbl_usuario_apellido,
				'tipouser' => $res->tbl_usuario_tipousuario,
				'idroles' => $res->tbl_usuario_rol,
				'directoriofiles' => $res->tbl_usuario_username,
				'login' => TRUE
			);
			$cookieuser=array(
				'name' => 'user',
				'value' => $res->tbl_usuario_username,
				'expire' => '7200',
				'secure' => TRUE
			);
			$cookietipouser=array(
				'name' => 'tipouser',
				'value' => $res->tbl_usuario_tipousuario,
				'expire' => '7200',
				'secure' => TRUE
			);
			$this->input->set_cookie($cookieuser);
			$this->input->set_cookie($cookietipouser);
			$this->session->set_userdata($data);
			//$url=base_url().'dashboard';
			echo 'yes';
			//echo "<script type='text/javascript'>window.location='".$url."'</script>";
			//echo redirect(base_url()."dashboard","refresh");
		}*/
	}
	public function remover ($valor,$arr)
	{
		foreach (array_keys($arr, $valor) as $key) 
		{
			unset($arr[$key]);
		}
		return $arr;
	}
	public function logout(){
		/*cerrar la session*/
		$this->session->sess_destroy();
		$cookieuser=array(
			'name' => 'user',
			'value' => '',
			'expire' => '7200',
			'secure' => TRUE
		);
		$cookietipouser=array(
			'name' => 'tipouser',
			'value' => '',
			'expire' => '7200',
			'secure' => TRUE
		);
		/*$cookiefolder=array(
			'name' => 'userfolder',
			'value' => '',
			'expire' => '7200',
			'secure' => TRUE
		);*/
		$cookiefolder=array(
			'name' => 'idfolderfile',
			'value' => '',
			'expire' => '7200',
			'secure' => TRUE
		);
		delete_cookie($cookiefolder);
		delete_cookie($cookieuser);
		delete_cookie($cookietipouser);
		redirect(base_url());
		
	}
	public function logoutinactivo(){
		/*cerrar la session*/
		$this->session->sess_destroy();
		$cookieuser=array(
			'name' => 'user',
			'value' => '',
			'expire' => '7200',
			'secure' => TRUE
		);
		$cookietipouser=array(
			'name' => 'tipouser',
			'value' => '',
			'expire' => '7200',
			'secure' => TRUE
		);
		/*$cookiefolder=array(
			'name' => 'userfolder',
			'value' => '',
			'expire' => '7200',
			'secure' => TRUE
		);*/
		$cookiefolder=array(
			'name' => 'idfolderfile',
			'value' => '',
			'expire' => '7200',
			'secure' => TRUE
		);
		delete_cookie($cookiefolder);
		delete_cookie($cookieuser);
		delete_cookie($cookietipouser);
		$url=base_url().'dasboard';
		echo redirect(base_url(),"refresh");
		//echo"<script type='text/javascript'>window.location='".$url."'</script>";
	}
	public function actboton(){
		if (isset($_SESSION["locked"])){
			echo"locked";
			$difference = time() - $_SESSION["locked"];
			if ($difference > 10){
				unset($_SESSION["locked"]);
				unset($_SESSION["login_attempts"]);
				unset($_SESSION["login_maxinten"]);
				redirect(base_url());
			}else{
				//echo "<script type='text/javascript'>window.location='https://www.google.com/'</script>";
			}
		}
		
		
	}
	public function sessionactiva(){
		/*if(!$this->session->userdata("login")){
			//redirect(base_url());
			$url=base_url().'Welcome';
			echo"<script type='text/javascript'>window.location='".$url."'</script>";
		}*/
		if (!isset($_SESSION['tipouser'])) {
			$url=base_url().'Welcome';
			echo"<script type='text/javascript'>window.location='".$url."'</script>";
		}
	}
	
	public function defaultfilemanager(){
		/*cerrar la session*/
		unset($_COOKIE['userfolder']);
		$cookiefolder=array(
			'name' => 'userfolder',
			'value' => '',
			'expire' => '7200',
			'secure' => TRUE
		);
		delete_cookie($cookiefolder);
		redirect(base_url().'dashboard/filemanager');
		//delete_cookie($cookieuser);
		//delete_cookie($cookietipouser);
		
		
	}
}