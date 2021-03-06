<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		if(!$this->session->userdata("login")){
			redirect(base_url());
		}
	}
	
	public function index(){
		/*vista del dashboard*/
		//$this->load->view('layouts/header');
		//$this->load->view('layouts/aside');
		if (defined('REQUEST') && REQUEST === 'external') {
            return;
        }
		
		//if($this->session->userdata('idroles')=='1'){
		if(isset($_SESSION['tipouser'])){ 
			if($_SESSION['tipouser']=='admin'){
				echo redirect(base_url()."dashboard/usuario","refresh");
			}else{
				$this->load->view('header');
				$this->load->view('menu');
				$this->load->view('subir_fichero');
				$this->load->view('footer');
			}
		}
		//}
		//$this->load->view('layouts/footer');
		/**/
	}
	public function usuario()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_usuario');
		$this->load->view('footer');
	}
	public function directorio()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_directorio');
		$this->load->view('footer');
	}
	public function filemanager()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_filemanager');
		$this->load->view('footer');
	}
	public function folderuser()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_folderuser');
		$this->load->view('footer');
	}
	public function listfile()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_listfile');
		$this->load->view('footer');
	}
	/*opcion de importar la información*/
	public function importar()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_importar');
		$this->load->view('footer');
	}
	public function formtest()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_formtest');
		$this->load->view('footer');
	}
	/*opcion para validar la informacion*/
	public function formvalidar()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_formvalidar');
		$this->load->view('footer');
	}
	/*opcion para visualizar informacion correcta*/
	public function nomcorrecta()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_formcorrecto');
		$this->load->view('footer');
	}
	/*opcion de nomina incorrecta*/
	public function nomincorrecta()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('body_formincorrecto');
		$this->load->view('footer');
	}
}
