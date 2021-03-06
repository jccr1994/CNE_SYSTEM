<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Guayaquil');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Data_Import extends CI_Controller {
	public function __construct(){
		//Cargo los datos de la consulta de la BD
		parent::__construct();
		$this->load->model("DataImport_model");
		//$this->load->library('encryption');
		//$this->load->helper('url');
		//$this->load->helper('cookie');
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
			if($this->DataImport_model->insertData($data)==true){
				echo json_encode($datamessage, JSON_UNESCAPED_UNICODE);
			}			
		}
	}
	/*mostrar data importada*/
	public function empListimport(){
	    if($this->input->post('draw')!=""){
	    // POST data
	    $postData = $this->input->post();
	    // Get data
	    $data = $this->DataImport_model->getEmployeesimport($postData);
	    echo json_encode($data);
	    }else{
	      	$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('body_formvalidar');
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
	      $data = $this->DataImport_model->data_Update($datos);

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
			"tbl_padron_nombre"=>$nombres,
            "tbl_padron_apellido"=>$apellidos,
            "tbl_padron_celular"=>$celular,
            "tbl_padron_cedula"=>$cedula
		);
		if($this->DataImport_model->formUpdate($id, $datos)==true){
			echo 'yes';
		}else{
			echo 'no';
		}
	}
	/*importar data de excel*/
	function importValidar(){
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
		/*cuenta el numero de filas*/
		//$numrows=$this->DataImport_model->numRows();
		//if($numrows>1){
			/*vacia la tabla para poder comprobar la nueva data*/
			//$this->DataImport_model->emptytblTmp();
		//}
		$sheetcount=count($sheetdata);
		if($sheetcount>1){
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
				/*comparar si existe la cedula*///$dataObt=$this->DataImport_model->dataObtener($cedula);
				//$nom=$dataObt['data']['nombres'];
				//$ape=$dataObt['data']['apellidos'];
				if($this->DataImport_model->compararCedula($cedula)==true){
					$dataObt=$this->DataImport_model->dataObtener($cedula);
					$nom=$dataObt['data']['nombres'];
					$ape=$dataObt['data']['apellidos'];
					$idpadron=$dataObt['data']['id'];
					$estado='correcto';
				}else{
					$ape=$arrayData[0]." ".$arrayData[1];
					$nom=$arrayData[2]." ".$arrayData[3];
					$estado='incorrecto';
					$idpadron="";
				}
				//$apellidos=$arrayData[0]." ".$arrayData[1];
				//$nombres=$arrayData[2]." ".$arrayData[3];
				$data[]=array(
					'tbl_padron_nombre'=>$nom,
					'tbl_padron_apellido'=>$ape,
					'tbl_padron_celular'=>$celular,
					'tbl_padron_cedula'=>$cedula,
					'tbl_padron_estado'=>$estado,
					'tbl_padron_idtbl_padron'=>$idpadron
				);
			}
			//$this->Usuarios_model->insertTest($data);
			$datamessage["data"]=array(
				'message'=>'ok'
			);
			//$data['message'] = 'ok';
			//$inserdata=$this->Usuarios_model->insertTest($data);
			if($this->DataImport_model->insertTestvalidar($data)==true){
				echo json_encode($datamessage, JSON_UNESCAPED_UNICODE);
			}		
		}
	}
	/*listar nomina correcta*/
	public function empListnomcorrecta(){
	    if($this->input->post('draw')!=""){
	    // POST data
	    $postData = $this->input->post();
	    // Get data
	    $data = $this->DataImport_model->getEmployeesnomcorrecta($postData);
	    echo json_encode($data);
	    }else{
	      	$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('subir_fichero');
			$this->load->view('footer'); 
	    }
	}
	
	/*listar nomina incorrecta*/
	public function empListnomincorrecta(){
	    if($this->input->post('draw')!=""){
	    // POST data
	    $postData = $this->input->post();
	    // Get data
	    $data = $this->DataImport_model->getEmployeesnomincorrecta($postData);
	    echo json_encode($data);
	    }else{
	      	$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('subir_fichero');
			$this->load->view('footer'); 
	    }
	}
	
	/*export excel correcto*/
	public function spreadsheet_export()
	{
		//fetch my data
		$productlist=$this->DataImport_model->list_export();
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
			$sheet->setCellValue('A'.$sn,$prod->tbl_padron_cedula);
			$sheet->setCellValue('B'.$sn,$prod->tbl_test_nomape);
			$sheet->setCellValue('C'.$sn,$prod->tbl_padron_celular);
			$sheet->setCellValue('D'.$sn,$prod->tbl_padron_estado);
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
		$productlist=$this->DataImport_model->list_exportinc();
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
			$sheet->setCellValue('A'.$sn,$prod->tbl_padron_cedula);
			$sheet->getComment('A'.$sn)->getText()->createTextRun('Error de cedula');
			$sheet->getStyle('A'.$sn)->applyFromArray($styleArray);
			$sheet->setCellValue('B'.$sn,$prod->tbl_test_nomape);
			$sheet->setCellValue('C'.$sn,$prod->tbl_padron_celular);
			$sheet->setCellValue('D'.$sn,$prod->tbl_padron_estado);
			$sn++;
		}
		
		//TOTAL
		//$sheet->setCellValue('D8','Total');
		//$sheet->setCellValue('E8','=SUM(E2:E'.($sn-1).')');

		$writer = new Xlsx($spreadsheet);
		$writer->save("php://output");
	}
	public function testnomape(){
		//$cedula='09423723';
		//$dataObt=$this->DataImport_model->list_searchData($cedula);
		//var_dump(json_encode($dataObt));
		//echo $dataObt['data']['cedula'];
		//echo $dataObt['data']['nomape'];
		//print_r($dataObt);
		if($this->input->post("id")!=""){
			$id=$this->input->post("id");
			$nomape=$this->input->post("idnomape");
			$data = $this->DataImport_model->list_searchData($nomape, $id);

			echo json_encode($data);
	    }else{
			$this->load->view('404');
	    }
	}
	public function lD(){
		$id=$this->input->post("id");
		$name=$this->input->post("idnomape");
		$table=$this->DataImport_model->list_Datatable($id, $name);
		/*foreach ($table as $row){
			echo $row->idtbl_padron;
		}*/
		if($id!=""){
			$output = '';  
			$output .= '  
			<div class="table-responsive">  
				<table class="table table-bordered">  
					<tr>  
						<th width="10%">Obtener Dato</th>  
						<th width="45%">Nombres Sugeirdo</th>  
						<th width="45%">Cedula Sugerida</th>  
					</tr>';  
			foreach ($table as $row){
			$output .= '  
					<tr class="data-item" data-id="'.$row->idtbl_padron.'">
						<td><button type="button" name="delete_btn" data-id1="'.$row->tbl_padron_nomape.'" data-id3="'.$row->idtbl_padron.'" data-id2="'.$row->tbl_padron_cedula.'" data-id4="'.$row->tbl_padron_nombre.'" data-id5="'.$row->tbl_padron_apellido.'" class="btn btn-warning btn-flat btn_sugerido" id="btn_sugerido"><i class="fa fa-pencil-square-o"></i></button></td>  
						<td class="first_name" data-id1="'.$row->tbl_padron_nomape.'">'.$row->tbl_padron_nomape.'</td>  
						<td class="last_name" data-id2="'.$row->tbl_padron_cedula.'">'.$row->tbl_padron_cedula.'</td>    
					</tr>';
			}
			$output .= '</table> 
						</div>';  
			echo $output;
		}else{
			$this->load->view('404');
		}
	}
	public function actSugerido(){
		$id=$this->input->post("idsug");
		$nomind=$this->input->post("nomind");
		$apeind=$this->input->post("apeind");
		$cedula=$this->input->post("cedula");
		if(strlen($cedula)>1){
			$datos=array(
				"tbl_padron_nombre"=>$nomind,
				"tbl_padron_apellido"=>$apeind,
				"tbl_padron_cedula"=>$cedula,
				"tbl_padron_estado"=>'correcto',
				"tbl_padron_idtbl_padron"=>$id
			);
			if($this->DataImport_model->updateSug($id, $datos)==true){
				echo 'yes';
			}else{
				echo 'no';
			}
		}else{
			$this->load->view('404');
		}
	}
	public function dT(){
		// fecha 1
		$fecha_inicial= "2022/06/01";
		// fecha actual
		$fecha_final= date("Y/m/d");
		$dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
		$dias = abs($dias); $dias = floor($dias);
		//return $dias;
		echo $dias;
	}
	
	public function dTSD(){
		$date1='2022-06-01';
		$date2='2022-06-22'; 
		$workSat = FALSE; 
		$patron = NULL;
		/**
		 * Count the number of working days between two dates.
		 *
		 * This function calculate the number of working days between two given dates,
		 * taking account of the Public festivities, Easter and Easter Morning days,
		 * the day of the Patron Saint (if any) and the working Saturday.
		 *
		 * @param   string  $date1    Start date ('YYYY-MM-DD' format)
		 * @param   string  $date2    Ending date ('YYYY-MM-DD' format)
		 * @param   boolean $workSat  TRUE if Saturday is a working day
		 * @param   string  $patron   Day of the Patron Saint ('MM-DD' format)
		 * @return  integer           Number of working days ('zero' on error)
		 *
		 * @author Massimo Simonini <massiws@gmail.com>
		 */
		
		  if (!defined('SATURDAY')) define('SATURDAY', 6);
		  if (!defined('SUNDAY')) define('SUNDAY', 0);

		  // Array of all public festivities
		  $publicHolidays = array('01-01', '12-25', '12-26');
		  // The Patron day (if any) is added to public festivities
		  if ($patron) {
			$publicHolidays[] = $patron;
		  }

		  /*
		   * Array of all Easter Mondays in the given interval
		   */
		  $yearStart = date('Y', strtotime($date1));
		  $yearEnd   = date('Y', strtotime($date2));

		  for ($i = $yearStart; $i <= $yearEnd; $i++) {
			$easter = date('Y-m-d', easter_date($i));
			list($y, $m, $g) = explode("-", $easter);
			$monday = mktime(0,0,0, date($m), date($g)+1, date($y));
			$easterMondays[] = $monday;
		  }

		  $start = strtotime($date1);
		  $end   = strtotime($date2);
		  $workdays = 0;
		  for ($i = $start; $i <= $end; $i = strtotime("+1 day", $i)) {
			$day = date("w", $i);  // 0=sun, 1=mon, ..., 6=sat
			$mmgg = date('m-d', $i);
			if ($day != SUNDAY &&
			  !in_array($mmgg, $publicHolidays) &&
			  !in_array($i, $easterMondays) &&
			  !($day == SATURDAY && $workSat == FALSE)) {
				$workdays++;
			}
		  }

		  //return intval($workdays);
		  echo intval($workdays);
	}
}