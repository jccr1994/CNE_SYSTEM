<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Guayaquil');
//require FCPATH.'vendor/autoload.php';

//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Guardar_Data extends CI_Controller {
	public function __construct(){
		//Cargo los datos de la consulta de la BD
		parent::__construct();
		$this->load->model("Usuarios_model");
		$this->load->library('encryption');
		$this->load->helper('url');
		$this->load->helper('cookie');
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
	
	public function hashpass($pass){
		$opciones = [
			'cost' => 12,
		];
		return password_hash($pass, PASSWORD_BCRYPT, $opciones);
	}
	
	/*guardar datos del formulario*/
	public function usuario(){
		/*obtener los datos del formulario por post*/
		$id_directorio=$this->generate_string(rand(10,50));
		$res = $this->Usuarios_model->validar($this->input->post("txtusuario"));
		if($res==1){
			echo"<script>
				$.alert('<h4>Usuario existe.</h4>');
			</script>";
		}else{
			$datos=array(
				"tbl_usuario_nombre"=>trim($this->input->post("txtnombres")),
				"tbl_usuario_apellido"=>trim($this->input->post("txtapellidos")),
				"tbl_usuario_username"=>trim($this->input->post("txtusuario")),
				"tbl_usuario_password"=>trim($this->hashpass($this->input->post("txtcontra"))),
				"tbl_usuario_tipousuario"=>"usuario",
				"tbl_usuario_rol"=>"1",
				"tbl_usuario_table"=>$this->encryption->encrypt($this->input->post("txtcontra")),
				"tbl_usuario_iddirectorio"=>$id_directorio
			);
			if($this->Usuarios_model->guardar($datos)==true){
				echo"<script>
				$.alert('<h4>Datos agregados con exito.</h4>');
				</script>";
				$dirname=trim($this->input->post("txtusuario"));
				$path = 'uploads/files/'.$dirname;
				if (!file_exists($path)) {
					mkdir($path, 0777, true);
					if (!file_exists($path.'/index.html')){
						$contenido = "<html><body><p>No tienes permiso para acceder a este recurso.</p></body></html>";
						file_put_contents($path.'/index.html', $contenido);
						$contenidotxt = "Bienvenido ".trim($this->input->post("txtnombres"))." ".trim($this->input->post("txtapellidos"));
						file_put_contents($path.'/'.$dirname.'.txt', $contenidotxt);
					}
					$datos=array(
						"tbl_directorio_name"=>$dirname,
						"tbl_directorio_url"=>$path,
						"tbl_usuario_idtbl_usuario"=>$id_directorio
					);
					$this->Usuarios_model->guardar_directorio($datos);
				}
			}else{
				echo 'no';
			}
		}
	}
	
	public function empList(){
	    if($this->input->post('draw')!=""){
	    // POST data
	    $postData = $this->input->post();
	    // Get data
	    $data = $this->Usuarios_model->getEmployees($postData);
	    echo json_encode($data);
	    }else{
	      	$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('subir_fichero');
			$this->load->view('footer'); 
	    }
	}
	
	public function empListusers(){
	    if($this->input->post('draw')!=""){
	    // POST data
	    $postData = $this->input->post();
	    // Get data
	    $data = $this->Usuarios_model->getEmployeesusers($postData);
	    echo json_encode($data);
	    }else{
	      	$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('body_usuario');
			$this->load->view('footer'); 
	    }
	}
	
	/*listar los directorios*/
	public function empListdirectorio(){
	    if($this->input->post('draw')!=""){
			// POST data
			$postData = $this->input->post();
			// Get data
			$data = $this->Usuarios_model->getEmployeesdirectorio($postData);
			echo json_encode($data);
	    }else{
	      	$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('body_usuario');
			$this->load->view('footer'); 
	    }
	}
	/*/.*/
	/*listar filemanager*/
	public function empListfilemanager(){
	    if($this->input->post('draw')!=""){
			// POST data
			$postData = $this->input->post();
			// Get data
			$data = $this->Usuarios_model->getEmployeesfilemanager($postData);
			echo json_encode($data);
	    }else{
	      	$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('body_usuario');
			$this->load->view('footer'); 
	    }
	}
	/*/.*/
	/*delete directorio*/
	public function delete_directorio(){
		/*obtener los datos del formulario por post*/
		$id=$this->input->post("id");
		$data = $this->Usuarios_model->get_namedirectory($id);
		$path='./uploads/'.$data->tbl_directorio_name;
		if (is_dir($path)) {
			//Escaneamos el directorio
			$carpeta = @scandir($path);
			//Miramos si existen archivos
			if (count($carpeta) > 2){
				echo 'El directorio tiene archivos';
				//desactivamos en la lista para que no se muestre
				//Miramos si existe el archivo pasado como par??metro
				//if (file_exists('folder/index.php')) 
					//echo 'El archivo existe';
				//else
					//echo 'El archivo no existe';
			}else{
				rmdir($path);
				$datos=array(
					"idtbl_directorio"=>$id
				);
				if($this->Usuarios_model->directory_Delete($datos)==true){
					echo 'yes';
				}else{
					echo 'no';
				}
			}
		}else {
			echo 'El directorio no existe.';
		}
		/*if(file_exists($path)){
			unlink($path);
		}else{
			echo"error no existe el archivo";
		}*/
		/*$datos=array(
			"idtbl_archivo"=>$id
		);
		if($this->Usuarios_model->eliminar($datos)==true){
			echo 'yes';
		}else{
			echo 'no';
		}*/
	}
	/*/.*/
	
	public function contiene_palabra($texto, $palabra){
		if (preg_match('*\b' . preg_quote($palabra) . '\b*i', $texto, $matches, PREG_OFFSET_CAPTURE)){
			return $matches[0][1];
		}
		return -1;  // -1 cuando no se encuentra
	}
	
	public function removervalorarray ($valor,$arr){
		foreach (array_keys($arr, $valor) as $key) 
		{
			unset($arr[$key]);
		}
		//echo "Removiendo: ".$valor."\n\n";
		return $arr;
	}
	
	public function delete_form(){
		/*obtener los datos del formulario por post*/
		$id=$this->input->post("id");
		//$id=1;
		$data = $this->Usuarios_model->get_url($id);
						
		$urlfile=$data->tbl_archivo_url;
		$iddescriparchivo=$data->tbl_descriparchivo_idtbl_descriparchivo;
		$searchfilename=$data->tbl_archivo_nombre;
		
		if(!empty($iddescriparchivo)){
			$datos = $this->Usuarios_model->get_descriparchivo($iddescriparchivo);
			
			$arrayfilename=array();
			$cont=0;
			foreach ($datos as $row){   
				$arrayfilename[$cont] = $row['tbl_archivo_nombre'];
				$cont++;
			}
			$newarr=$this->removervalorarray($searchfilename,$arrayfilename);
			if(count($arrayfilename)>1){
				//aqui el update
				$newfilesearch=implode(",", $newarr);
				$datos=array(
					"tbl_descriparchivo_filename"=>$newfilesearch
				);	
				$this->Usuarios_model->updateDescripcionsearch($iddescriparchivo, $datos);	
			}
			if(count($arrayfilename)==1){
				//aqui se debe borrar la descripcion
				$dataDescrip=array(
					"tbl_archivo_idtbl_archivo"=>$iddescriparchivo
				);
				$this->Usuarios_model->deleteDescripcion($dataDescrip);
			}
		}
		
		$urlpos="";
		foreach (['uploads'] as $palabra) {
			if (($pos = $this->contiene_palabra($urlfile,$palabra)) >= 0) {
				$urlpos=$pos;
			} else {
				$urlpos="";
			}
		}
		if($urlpos!=""){
			$path="./".substr($urlfile, 37);
		}else{
			$path="";
		}
		if(file_exists($path)){
			unlink($path);
		}else{
			echo"error no existe el archivo";
		}
		$datos=array(
			"idtbl_archivo"=>$id
		);
		if($this->Usuarios_model->eliminar($datos)==true){
			echo 'yes';
		}else{
			echo 'no';
		}
	}
	
	
	
	public function delete_user(){
		/*obtener los datos del formulario por post*/
		$id=$this->input->post("id");
		$datos=array(
			"idtbl_usuario"=>$id
		);
		$data = $this->Usuarios_model->get_username($id);
		
		$directory_id=$data['id'];
		$array = explode("/", $data['directorio_url']);
		$directorio=$array[0].'/'.$array[1].'/';
		
		$directorioact=$directorio.$data['directorio_name'];
		$rename=$directorio.$this->generate_string(4).$data['directorio_name'];
		
		rename($directorioact, $rename);
		
		if($this->Usuarios_model->user_Delete($datos)==true){
			$datosd=array(
				"idtbl_directorio"=>$directory_id
			);
			$this->Usuarios_model->directory_Delete($datosd);
			
			echo 'yes';
		}else{
			echo 'no';
		}
	}
	public function encrypt($data){
		$key="fs%&/df87&/f";
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		$encrypted=openssl_encrypt($data, "aes-256-cbc", $key, 0, $iv);
		// return the encrypted string with $iv joined 
		return base64_encode($encrypted."::".$iv);
	}
	public function cons_directorio(){
		$id=$this->input->post("id");
		
			/*$cookiefolder=array(
				'name' => 'userfolder',
				'value' => '',
				'expire' => '7200',
				'secure' => TRUE
			);
			delete_cookie($cookiefolder);*/
			
			//echo $id;
			/*$cookiefolder=array(
				'name' => 'userfolder',
				'value' => $id,
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
			
			$cookiefolder=array(
				'name' => 'idfolderfile',
				'value' => $id,
				'expire' => '7200',
				'secure' => TRUE
			);
			
			$this->input->set_cookie($cookiefolder);
		
		$url=base_url().'dashboard/folderuser';
		//echo"<script type='text/javascript'>window.location='".$url."'</script>";
		//redirect($url, 'refresh');
	}
	public function d(){
		echo $this->encryption->decrypt('db0c2edc9f4b1f7d9461c8b28001f30dbff6cdebef7d235903c424ece18a87b116e607f903ca5e7f452fed434d8febd02c49ea2cf61b1d1d00fcac34c12dc323TTPvZtZ0gCNUkcnMzbTjShQ22q3F78Yz/HOFEkukpKY=');
		
		echo"<br/>";
		//echo $_COOKIE['idfolderfile'];
	}
	public function deletefilemanager(){
		$id=$this->input->post("id");
		$datos=array(
			"tbl_descriparchivo_delete"=>1
		);	
		$this->Usuarios_model->deleteDescripcion($id, $datos);	
	}
	
	function import(){
		//$this->load->library('myphpexel');
		//$CI =& get_instance();
		//$CI->load->library('myphpexel');
		//$anioLectivo=$this->input->post("txtidaniolectivo");
		//$anioLectivoFecha=$this->input->post("txtfechaaniolectivo");
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
					'test_nombre'=>$nombres,
					'test_apellido'=>$apellidos,
					'test_celular'=>$celular,
					'test_cedula'=>$cedula
				);
			}
			//print_r($data);
			$this->Usuarios_model->insertTest($data);
			//if($inserdata)
			//{
				//$this->session->set_flashdata('message','<div class="alert alert-success">Successfully Added.</div>');
				//redirect('home');
			//} else {
				//$this->session->set_flashdata('message','<div class="alert alert-danger">Data Not uploaded. Please Try Again.</div>');
				//redirect('home');
			//}
		}
		/*echo $path = "/repositorioarchivos/uploads/LISTADOZOI-24-01-2021.xlsx";
			
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					echo $cedula = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
				}
			}*/
		
		//if(isset($_FILES["file"]["name"]))
		//{
			/*$path = "./uploads";
			
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					echo $cedula = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
				}
			}*/
			/*foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				//$paralelo = $worksheet->getCellByColumnAndRow(6, 6)->getValue();
				$paralelo = $worksheet->getCell('F6')->getValue()." - ".$worksheet->getCell('F7')->getValue();
				//$jornada = $worksheet->getCellByColumnAndRow(6, 5)->getValue();
				$jornada = $worksheet->getCell('F5')->getValue();
				for($row=9; $row<=$highestRow; $row++)
				{
					$cedula = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$nombrescomp = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					
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
					if($this->Estudiante_model->validarDatos($nombrescomp,$anioLectivoFecha)==false){
						$data[] = array(
							'tbl_estudiante_nombres'=>$nombres,
							'tbl_estudiante_apellidos'=>$apellidos,
							'tbl_estudiante_nombrescomp'=>$nombrescomp,
							'tbl_estudiante_cedula'=>$cedula,
							'tbl_estudiante_estado'=>1,
							'tbl_estudiante_jornada'=>$jornada,
							'tbl_estudiante_paralelo'=>$paralelo,
							'tbl_estudiante_aniolectivo'=>$anioLectivo
						);
					}
				}
			}
			//echo $paralelo;
			if(isset($data)){
				$this->Estudiante_model->insertXls($data);
				echo 'Data Imported successfully';
			}else{
				echo 'Duplicados';
			}*/
		//}
	}
	
	/*mostrar data importada*/
	public function empListimport(){
	    if($this->input->post('draw')!=""){
	    // POST data
	    $postData = $this->input->post();
	    // Get data
	    $data = $this->Usuarios_model->getEmployeesimport($postData);
	    echo json_encode($data);
	    }else{
	      	$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('subir_fichero');
			$this->load->view('footer'); 
	    }
	}
	
	/*Editar data importada*/
	public function formUpdatedata(){
	    /*obtener los datos del formulario por post*/
	    if($this->input->post("id")!=""){
	      $id=$this->input->post("id");
	      $datos=array(
	        "id"=>$id
	      );
	      $data = $this->Usuarios_model->data_Update($datos);

	      echo json_encode($data);
	    }else{
	      $this->load->view('404');
	    }
	}
	/*Actualizar data*/
	public function postFormupdate(){
		/*obtener los datos del formulario por post*/
		$id=$this->input->post("text_id");
		$nombres=$this->input->post("text_name");
		$apellidos=$this->input->post("text_apellido");
		$cedula=$this->input->post("text_cedula");
		$celular=$this->input->post("text_telefono");
		$datos=array(
			"test_nombre"=>$nombres,
            "test_apellido"=>$apellidos,
            "test_celular"=>$celular,
            "test_cedula"=>$cedula
		);
		if($this->Usuarios_model->formUpdate($id, $datos)==true){
			echo 'yes';
		}else{
			echo 'no';
		}
		/*$this->Usuarios_model->formUpdate($id, $datos);
		*/
		/*if($id!=""){
			
		}else{
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('body_formtest');
			$this->load->view('footer');
		}*/
		
		/*$datos=array(
			"tbl_personal_nombres"=>$nombres,
			"tbl_personal_apellidos"=>$apellidos,
			"tbl_personal_cedula"=>$cedula,
			"tbl_personal_telefono"=>$telefono,
			"tbl_personal_ciudad"=>$ciudad,
			"tbl_personal_tipopersonal"=>$personal,
			"tbl_personal_jornada"=>$jornada
		);
		if($this->Personal_model->updatePersonal($id, $datos)==true){
			echo 'yes';
		}else{
			echo 'no';
		}*/
	}
}