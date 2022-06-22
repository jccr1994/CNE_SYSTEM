<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Guayaquil');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use GuzzleHttp\Client;
class Cargar_Archivo extends CI_Controller {

	public function __construct(){
		/*Cargo los datos de la consulta de la BD*/
		parent::__construct();
		$this->load->model("Usuarios_model");
		//$this->load->library('encryption');
		//$this->guardar_archivo();
	}
	public function generateRandomString($length = 10) { 
		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
	} 
	
	public function generate_string($strength = 16) {
		$inirand=round($strength/2);
		$inilong=rand($inirand,$strength);
		$input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
		$input_length = strlen($input);
		$random_string = '';
		for($i = 0; $i < $strength; $i++) {
			$random_character = $input[mt_rand(0, $input_length - 1)];
			$random_string .= md5(uniqid($random_character, true));
		}
	 
		return substr($random_string,$inilong,$strength);
	}
	
	public function guardar_persona() {
		$txtcedula=$this->input->post("post_cedula");
		$txtnombre=$this->input->post("post_nombre");
		$txtapellido=$this->input->post("post_apellido");
		$txtdireccion=$this->input->post("post_direccion");
		$txtgenero=$this->input->post("post_genero");
		$txtcelular=$this->input->post("post_celular");
		$datafpersona=array(
			"tbl_persona_nombrel"=>$txtnombre,
			"tbl_persona_apellido"=>$txtapellido,
			"tbl_persona_cedula"=>$txtcedula,
			"tbl_persona_direccion"=>$txtdireccion,
			"tbl_persona_genero"=>$txtgenero,
			"tbl_persona_celular"=>$txtcelular
		);
		$this->Usuarios_model->guardar_datapersona($datafpersona);
	}
	
	public function guardar_archivo() {
        //nombre del input
		//$mi_archivo = 'archivo';
        //nombre del directorio
		$config['upload_path'] = "uploads/files/".$_COOKIE['user'];
        //$config['file_name'] = "nombre_archivo";
        //tipos de archivos
		//$config['allowed_types'] = "pdf|docx|doc";
        //$config['max_size'] = "50000";//kb
        //$config['max_width'] = "2000";
        //$config['max_height'] = "2000";

        //$this->load->library('upload', $config);
        /*$jsondata=array();
        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            //$data['uploadError'] = $this->upload->display_errors();
            //echo $this->upload->display_errors();
            //return;
			$jsondata["data"]=array(
				'message'=>'error'
			);
        }else{
			$file_info = $this->upload->data();
			$rutabd=base_url().'uploads/'.$file_info['file_name'];
            $nombrefile=$file_info['file_name'];
			$fecha=date("Y-m-d H:i:s");
			$idusuario=$_SESSION['idusuario'];
			//$this->crearMiniatura($file_info['file_name']);
			$datos=array(
				"tbl_archivo_nombre"=>$nombrefile,
				"tbl_archivo_url"=>$rutabd,
				"tbl_usuario_idtbl_usuario"=>$idusuario,
				"tbl_archivo_fecha"=>$fecha
			);
			$this->Usuarios_model->guardar_datafile($datos);
				
			$jsondata["data"]=array(
				'message'=>'ok',
				'valor'=>$rutabd
			);
			
		}
		echo json_encode($jsondata, JSON_UNESCAPED_UNICODE);
		*/

        //$data['uploadSuccess'] = $this->upload->data();
		$files_post = $_FILES['file'];
		$files = array();
		$file_count = count($files_post['name']);
		$file_keys = array_keys($files_post);
		$cedula=$this->input->post("post_cedula");
		if($this->Usuarios_model->validarPersona($cedula)==true){
			echo 'existe';
		}else{
			if($_FILES['file']['name'] == null){
				echo "Error";
			}else{
				for ($i=0; $i < $file_count; $i++) 
				{ 
					foreach ($file_keys as $key) 
					{
						$files[$i][$key] = $files_post[$key][$i];
					}
				}
				$jsondata=array();
				$listfilesearch = array();
				$cont = 0;
				
				$year = date("Y");
				$month = date("m");
				$day = date("d");
				$date = $year."/".$month."/".$day."/".$this->generate_string(6);
				$idtbl_descripfile=$this->generate_string(rand(10,50));
				foreach ($files as $fileID => $file)
				{
					$partes_ruta = pathinfo($file["name"]);
					$filename = pathinfo($file["name"], PATHINFO_FILENAME);
					$tipoArchivo = $partes_ruta['extension'];
					$idfilename=$this->generate_string(4);
					$namepdf=date("y.m.d")."-at-".date("H.i.s").$idfilename.".".$tipoArchivo;
					$nombrefile=$namepdf;
					$fecha=date("Y-m-d H:i:s");
					$idusuario=$_SESSION['idusuario'];
									
					$folder = "uploads/files/".$_COOKIE['user']."/".$date;
					$rutabd=base_url().$folder."/".$namepdf;
					
					$urlfilemanager="files/".$_COOKIE['user']."/".$date;
					$listfilesearch[$cont] = $namepdf;
					
					if (!file_exists($folder)) {
						mkdir($folder  , 0755, true); 
					}
					if (!file_exists($folder.'/index.html')){
						$folgeneral="uploads/files/".$_COOKIE['user'];
						$folder1=$folgeneral."/".$year;
						$folder2=$folgeneral."/".$year."/".$month;
						$folder3=$folgeneral."/".$year."/".$month."/".$day;
						$folder4=$folgeneral."/".$date;
						$array = array($folder1, $folder2, $folder3, $folder4);
						
						foreach ($array as $valor) {
							if (!file_exists($valor.'/index.html')){
								$contenido = "<html><body><script type='text/javascript'>window.location='https://www.google.com/';</script><p>No tienes permiso para acceder a este recurso.</p></body></html>";
								file_put_contents($valor.'/index.html', $contenido);
							}
						}
					}
					$datos=array(
						"tbl_archivo_nombre"=>$nombrefile,
						"tbl_archivo_url"=>$rutabd,
						"tbl_usuario_idtbl_usuario"=>$idusuario,
						"tbl_archivo_fecha"=>$fecha,
						"tbl_archivo_filename"=>$filename,
						"tbl_archivo_urlfilemanager"=>$urlfilemanager,
						"tbl_descriparchivo_idtbl_descriparchivo"=>$idtbl_descripfile
					);
					$this->Usuarios_model->guardar_datafile($datos);
					$jsondata["data"]=array(
						'message'=>'ok',
						'valor'=>$rutabd
					);
					$fileContent = file_get_contents($file['tmp_name']);
					file_put_contents($folder."/".$nombrefile, $fileContent);
					echo json_encode($jsondata, JSON_UNESCAPED_UNICODE);
					$cont++;
				}
				//guardar con la descripcion del archivo
				$filesearch=implode(",", $listfilesearch);
				$txttitulo=$this->input->post("txttitulo");
				$txtdescripcion=$this->input->post("txtdescripcion");
				$directoriofile="files/".$_COOKIE['user']."/".$date;
				$datafdescrip=array(
					"tbl_descriparchivo_nombre"=>$txttitulo,
					"tbl_descriparchivo_descrip"=>$txtdescripcion,
					"tbl_descriparchivo_directoriofile"=>$directoriofile,
					"tbl_descriparchivo_filename"=>implode(",", $listfilesearch),
					"tbl_archivo_idtbl_archivo"=>$idtbl_descripfile,					
					"tbl_persona_idtbl_persona"=>$cedula
				);
				$this->Usuarios_model->guardar_datadescrip($datafdescrip);
			}
		}
    }
	public function directorio() {
		$dirname=$this->input->post("txtdirectorio");
		$path = 'uploads/files/'.$dirname;
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
			//echo 'El archivo existe';
			if (!file_exists($path.'/index.html')){
				$contenido = "<html><body><p>No tienes permiso para acceder a este recurso.</p></body></html>";
				file_put_contents($path.'/index.html', $contenido);
			}
			$datos=array(
				"tbl_directorio_name"=>$dirname,
				"tbl_directorio_url"=>$path
			);
			$this->Usuarios_model->guardar_directorio($datos);
		}
	}
	/*Validar si se duplica la cedula*/
	public function ValidarCedula() {
		$cedula=$this->input->post("post_cedula");
		$data["data"]=array(
						'message'=>'ok'
					);
		//$data['message'] = 'ok';
		if($this->Usuarios_model->validarPersona($cedula)==true){
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
		}else{
			echo 'inserto';
		}			
	}
	
	/*importar data de excel*/
	function import(){
		$upload_file=$_FILES['file']['name'];
		$extension=pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension=='csv')
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else if($extension=='xls')
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet=$reader->load($_FILES['file']['tmp_name']);
		$sheetdata=$spreadsheet->getActiveSheet()->toArray();
		//echo '<pre>';
		//print_r($sheetdata);
		$sheetcount=count($sheetdata);
		if($sheetcount>1)
		{
			$data=array();
			for ($i=1; $i < $sheetcount; $i++) { 
				$cedula=$sheetdata[$i][0];
				$nombrescomp=$sheetdata[$i][1];
				$celular=$sheetdata[$i][5];
				if($nombrescomp!=""){
					$arrayData = explode(" ", $nombrescomp);
					if(!isset($arrayData[0])){
						$arrayData[0]="";
					}
					if(!isset($arrayData[1])){
						$arrayData[1]="";
					}
					if(!isset($arrayData[2])){
						$arrayData[2]="";
					}
					if(!isset($arrayData[3])){
						$arrayData[3]="";
					}
				}
				$apellidos=$arrayData[0]." ".$arrayData[1];
				$nombres=$arrayData[2]." ".$arrayData[3];
				$data[]=array(
					'tbl_padron_nombre'=>$nombres,
					'tbl_padron_apellido'=>$apellidos,
					'tbl_padron_celular'=>$celular,
					'tbl_padron_cedula'=>$cedula
				);
			}
			//$this->Usuarios_model->insertTest($data);
			$datamessage["data"]=array(
				'message'=>'ok'
			);
			//$data['message'] = 'ok';
			//$inserdata=$this->Usuarios_model->insertTest($data);
			if($this->Usuarios_model->insertTest($data)==true){
				echo json_encode($datamessage, JSON_UNESCAPED_UNICODE);
			}			
		}
	}
	
	
	/*export excel correcto*/
	public function spreadsheet_export()
	{
		//fetch my data
		$productlist=$this->Usuarios_model->list_export();
		$time = time();
		$filename='NominaCorrecta'.date("(H_i_s)", $time);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Cedula');
		$sheet->setCellValue('B1', 'Nombres/Apellidos');
		$sheet->setCellValue('C1', 'Celular');
		$sheet->setCellValue('D1', 'Estado');
		/*$sheet->getColumnDimension('A')->setWidth(16);
		$sheet->getColumnDimension('B')->setWidth(44);
		$sheet->getColumnDimension('C')->setWidth(20);
		$sheet->getColumnDimension('D')->setWidth(14);*/
		foreach (range('A', 'D') as $columnID) {
			$sheet->getColumnDimension($columnID)->setAutoSize(true);
			$sheet->getStyle($columnID)->getAlignment()->setHorizontal('left');
			$sheet->getStyle($columnID)->getAlignment()->setVertical('left');
		}
		$sn=2;
		foreach ($productlist as $prod) {
			//echo $prod->product_name;
			$sheet->setCellValue('A'.$sn,$prod->tbl_test_cedula);
			$sheet->setCellValue('B'.$sn,$prod->tbl_test_nomape);
			$sheet->setCellValue('C'.$sn,$prod->tbl_test_celular);
			$sheet->setCellValue('D'.$sn,$prod->tbl_test_estado);
			$sn++;
		}
		//TOTAL
		//$sheet->setCellValue('D8','Total');
		//$sheet->setCellValue('E8','=SUM(E2:E'.($sn-1).')');

		$writer = new Xlsx($spreadsheet);
		$writer->save("php://output");
	}
	/*exportar excel incorrecto*/
	public function spreadsheet_exportinc()
	{
		//fetch my data
		$productlist=$this->Usuarios_model->list_exportinc();
		$time = time();
		$filename='NominaIncorrecta'.date("(H_i_s)", $time);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Cedula');
		$sheet->setCellValue('B1', 'Nombres/Apellidos');
		$sheet->setCellValue('C1', 'Celular');
		$sheet->setCellValue('D1', 'Estado');
		/*$sheet->getColumnDimension('A')->setWidth(16);
		$sheet->getColumnDimension('B')->setWidth(44);
		$sheet->getColumnDimension('C')->setWidth(20);
		$sheet->getColumnDimension('D')->setWidth(14);*/
		foreach (range('A', 'D') as $columnID) {
			$sheet->getColumnDimension($columnID)->setAutoSize(true);
			$sheet->getStyle($columnID)->getAlignment()->setHorizontal('left');
			$sheet->getStyle($columnID)->getAlignment()->setVertical('left');
		}
		$sn=2;
		$styleArray = [
			'borders' => [
				'outline' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
					'color' => ['argb' => 'FFFF0000'],
				],
			],
		];

		
		foreach ($productlist as $prod) {
			//echo $prod->product_name;
			$sheet->setCellValue('A'.$sn,$prod->tbl_test_cedula);
			$sheet->getComment('A'.$sn)->getText()->createTextRun('Error de cedula');
			$sheet->getStyle('A'.$sn)->applyFromArray($styleArray);
			$sheet->setCellValue('B'.$sn,$prod->tbl_test_nomape);
			$sheet->setCellValue('C'.$sn,$prod->tbl_test_celular);
			$sheet->setCellValue('D'.$sn,$prod->tbl_test_estado);
			$sn++;
		}
		
		//TOTAL
		//$sheet->setCellValue('D8','Total');
		//$sheet->setCellValue('E8','=SUM(E2:E'.($sn-1).')');

		$writer = new Xlsx($spreadsheet);
		$writer->save("php://output");
	}
		
	/*mostrar desde url*/
	public function leerJson(){
		// ubicacion JSON online
		//define('JSON', 'http://192.168.0.108:3001/usuarios/mostrarCargos');
		//define('JSON', 'http://192.168.0.108:3001/usuarios/mostrarCargos');
	 
		// leemos JSON y convertimos
		//$data = file_get_contents(JSON);
		//$items = json_decode($data, true);
		//echo '<pre>' . print_r($data) . '</pre>';
		//echo json_encode($items);
		//return $items;
		
		//echo "hola";
		/*foreach ($items as $value) {
			//echo $value['idcargo'];
			$datamessage[] = array(
			   "id"=>$value['idcargo'],
			   "text"=>$value['cargo']
			); 
		}*/
		
		//echo json_encode($datamessage, JSON_UNESCAPED_UNICODE);
		/*$client = new \GuzzleHttp\Client();
		$request = $client->get('http://192.168.0.108:3001/usuarios/mostrarCargos');// Url of your choosing
		$response = $request->getBody();
		return $response;*/
		//echo $client->getBody();
		$client = new \GuzzleHttp\Client();
		$response = $client->get('http://192.168.0.108:3001/usuarios/mostrarCargos');
		$responseContents = $response->getBody();
	}
	
	/*pasar post*/
	public function insertarJson(){
		//$date1 = str_replace('/', '-', $this->input->post("txtfnacimiento"));
		//$newDateCert = date('Y-m-d', strtotime($date1));
		
		
		/*$txtcedula=$this->input->post("txtcedula");
		//echo $txtcedula;
		$newdata = array(
		'cedula' => $txtcedula
		);
		// Add Data
		$data[] = $newdata;
		echo json_encode($data, JSON_UNESCAPED_UNICODE);*/
		
		$client = new Client([
			// Base URI is used with relative requests
			'base_uri' => 'https://reqres.in',
		]);
		  
		$response = $client->request('POST', '/api/users', [
			'json' => [
				'name' => 'Sam',
				'job' => 'Developer'
			]
		]);
		  
		//get status code using $response->getStatusCode();
		  
		$body = $response->getBody();
		$arr_body = json_decode($body);
		print_r($arr_body);
	}
	
	public function testCons(){
		$cedula='0703779694';
		$data=$this->Usuarios_model->dataObtener($cedula);
		/*foreach ($data as $valor) {
			echo $valor['nombres'].'<br>';
			echo $valor['apellidos'].'<br>';
		}*/
		echo $data['data']['nombres'];
		//print_r($data);
		//echo json_encode($data);
	}
}