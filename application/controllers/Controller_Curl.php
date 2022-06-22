<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Guayaquil');

class Controller_Curl extends CI_Controller {

	public function __construct(){
		/*Cargo los datos de la consulta de la BD*/
		parent::__construct();
		//$this->load->model("Usuarios_model");
		//$this->load->library('encryption');
		//$this->guardar_archivo();
	}
	public function index(){
		$this->load->library('curl');
		$url = 'https://jsonplaceholder.typicode.com/posts';
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		$data = curl_exec($curl);
		curl_close($curl);
		echo json_decode(json_encode($curl),true);
		//print_r($data);
		
	}
	public function test(){

		//  Calling cURL Library
		$this->load->library('curl');

		//  Setting URL To Fetch Data From
		//$this->curl->create('https://reqres.in/api/users');

		$url = 'http://192.168.0.108:3001/usuarios/mostrarCargos';
		//$curl=$this->curl->create($url);
/*$curl = curl_init($url);

print($curl);
 
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
 
$data = curl_exec($curl);

$dataPer=json_decode($data, true);

echo($dataPer);
 
curl_close($curl);*/
/*$ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, 'http://192.168.0.108:3001/usuarios/mostrarCargos'); 
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
   curl_setopt($ch, CURLOPT_HEADER, 0); 
   $data = curl_exec($ch); 
   print_r($data);
   curl_close($ch);*/
/*$cURLConnection = curl_init();

curl_setopt($cURLConnection, CURLOPT_URL, 'https://reqres.in/api/users');
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$phoneList = curl_exec($cURLConnection);
print_r($phoneList);
curl_close($cURLConnection);

$jsonArrayResponse = json_decode($phoneList);   */
$url = "https://api.github.com/users/hadley/orgs";

//  Initiate curl
$ch = curl_init();

// Disable SSL verification
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Set the url
curl_setopt($ch, CURLOPT_URL,$url);

// Execute
$result=curl_exec($ch);

// Print the return data
$resultd=json_decode($result, true);


var_dump($resultd);
// Closing
curl_close($ch);


	}
}