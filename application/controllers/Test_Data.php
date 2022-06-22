<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Guayaquil');
class Test_Data extends CI_Controller {
	
	private $old_formKey;
	
	public function __construct(){
		//Cargo los datos de la consulta de la BD
		parent::__construct();
		$this->load->model("Usuarios_model");
		$this->load->library('encryption');
		$this->load->helper('url');
		$this->load->helper('cookie');
		if(isset($_SESSION['form_key'])){
            $this->old_formKey = $_SESSION['form_key'];
        }
	}
	
	public function generate_string($strength = 16) {
		$input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= $random_character;
		}
	 
		return $random_string;
	}
	
	public function validar() {
		if(!empty($this->input->post("form_key"))){
			if($this->input->post("form_key") == $this->old_formKey){
				echo'esta correcto';
			}
		}
	}
}