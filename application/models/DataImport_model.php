<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataImport_model extends CI_Model {
	/*insertar data importada excel*/
	function insertData($data){
		$this->db->insert_batch('tbl_padron', $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	/*mostrar listado de las personas*/
	function getEmployeesimport($postData=null){
     $response = array();

     ## Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value
	 //$idusrio=$_SESSION['idusuario'];
	 //$this->load->library('encryption');
     ## Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (CONCAT(tbl_padron_nombre, ' ', tbl_padron_apellido) like '%".$searchValue."%' or tbl_padron_cedula like '%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering
	 $this->db->select('count(*) as allcount');
	 $this->db->from('tbl_padron');
	 //$this->db->where('tbl_usuario_tipousuario', 'usuario');
	 //$this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 //if($_SESSION['tipouser']=='usuario'){
		//$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
     //}
     $records = $this->db->get()->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
	 $this->db->from('tbl_padron');
	 //$this->db->where('tbl_usuario_tipousuario', 'usuario');
	 //$this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 //if($_SESSION['tipouser']=='usuario'){
		//$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
	 //}
	 
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get()->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*, CONCAT(tbl_padron_nombre, " ", tbl_padron_apellido) as tbl_padron_nomape');
	 $this->db->from('tbl_padron');
	 //$this->db->where('tbl_usuario_tipousuario', 'usuario');
	 //$this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 //if($_SESSION['tipouser']=='usuario'){
		//$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
	 //}
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get()->result();

     $data = array();

     foreach($records as $record ){
		$data[] = array(
		   "tbl_padron_id"=>$record->idtbl_padron,
		   "tbl_padron_nomape"=>$record->tbl_padron_nomape,
		   "tbl_padron_celular"=>$record->tbl_padron_celular,
		   "tbl_padron_cedula"=>$record->tbl_padron_cedula
		);
     }

     ## Response
     $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
     );

     return $response; 
	}
	
	/*update data padron*/
	function data_Update($postData=null){
        $id_update = $postData['id'];
        $this->db->select('*');
        $this->db->where('idtbl_padron=',$id_update);
        $records = $this->db->get('tbl_padron')->result();
        foreach($records as $record ){
            $id=$record->idtbl_padron;
            $nombres=$record->tbl_padron_nombre;
            $apellidos=$record->tbl_padron_apellido;
            $celular=$record->tbl_padron_celular;
			$cedula=$record->tbl_padron_cedula;
        }
        $data = array();
        $data['result']['id']=$id;
        $data['result']['nombres']=$nombres;
        $data['result']['apellidos']=$apellidos;
        $data['result']['cedula']=$cedula;
        $data['result']['celular']=$celular;
        return $data;
	}
	/*form update*/
	function formUpdate($id, $data){
        $this->db->where('idtbl_padron', $id);
        $this->db->update('tbl_padron', $data);
        if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
    }
	/*formulario de comparar data del excel*/
	/*comparar cedula*/
	function compararCedula($cedula){
		$this->db->select('*, CONCAT(tbl_padron_nombre, " ", tbl_padron_apellido) as tbl_padron_nomape');
        $this->db->where('tbl_padron_cedula=',$cedula);
        $query = $this->db->get('tbl_padron');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	/*retornar data*/
	function dataObtener($postData){
        //$id_update = $postData['id'];
        $this->db->select('*');
        $this->db->where('tbl_padron_cedula=',$postData);
        $records = $this->db->get('tbl_padron')->result();
        foreach($records as $record ){
            $id=$record->idtbl_padron;
            $nombres=$record->tbl_padron_nombre;
            $apellidos=$record->tbl_padron_apellido;
            $celular=$record->tbl_padron_celular;
			$cedula=$record->tbl_padron_cedula;
        }
        $data = array();
        $data['data']['id']=$id;
        $data['data']['nombres']=$nombres;
        $data['data']['apellidos']=$apellidos;
        $data['data']['cedula']=$cedula;
        $data['data']['celular']=$celular;
        return $data;
	}
	/*Insertar data a la tabla temp*/
	function insertTestvalidar($data){
		$this->db->insert_batch('tbl_padron_tmp', $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	/*vaciar tmp*/
	public function emptytblTmp(){
		$this->db->truncate('tbl_padron_tmp');
	}
	/*numero de filas*/
	public function numRows(){
		$query=$this->db->get('tbl_padron_tmp');
		$numero_filas=$query->num_rows();
		return $numero_filas;
	}
	/*Fin formulario de comparar*/
	
	/*mostarar data correcta*/
	/*listar correctos*/
	function getEmployeesnomcorrecta($postData=null){
     $response = array();

     ## Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value
	 //$idusrio=$_SESSION['idusuario'];
	 //$this->load->library('encryption');
     ## Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (CONCAT(tbl_padron_nombre, ' ', tbl_padron_apellido) like '%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering
	 $this->db->select('count(*) as allcount');
	 $this->db->from('tbl_padron_tmp');
	 $this->db->where('tbl_padron_estado', 'correcto');
	 //$this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 //if($_SESSION['tipouser']=='usuario'){
		//$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
     //}
     $records = $this->db->get()->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
	 $this->db->from('tbl_padron_tmp');
	 $this->db->where('tbl_padron_estado', 'correcto');
	 //$this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 //if($_SESSION['tipouser']=='usuario'){
		//$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
	 //}
	 
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get()->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*, CONCAT(tbl_padron_nombre, " ", tbl_padron_apellido) as tbl_usuario_nomape');
	 $this->db->from('tbl_padron_tmp');
	 $this->db->where('tbl_padron_estado', 'correcto');
	 //$this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 //if($_SESSION['tipouser']=='usuario'){
		//$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
	 //}
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get()->result();

     $data = array();

     foreach($records as $record ){
		$data[] = array(
		   "idtbl_test_tmp"=>$record->idtbl_padron_tmp,
		   "tbl_usuario_nomape"=>$record->tbl_usuario_nomape,
		   "tbl_test_celular"=>$record->tbl_padron_celular,
		   "tbl_test_cedula"=>$record->tbl_padron_cedula
		);
     }

     ## Response
     $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
     );

     return $response; 
	}
	/*fn mostrar data correcta*/
	
	/*mostarar data incorrecta*/
	/*listar incorrectos*/
	/*listar incorrectos*/
	function getEmployeesnomincorrecta($postData=null){
     $response = array();

     ## Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value
	 //$idusrio=$_SESSION['idusuario'];
	 //$this->load->library('encryption');
     ## Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (CONCAT(tbl_padron_nombre, ' ', tbl_padron_apellido) like '%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering
	 $this->db->select('count(*) as allcount');
	 $this->db->from('tbl_padron_tmp');
	 $this->db->where('tbl_padron_estado', 'incorrecto');
	 //$this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 //if($_SESSION['tipouser']=='usuario'){
		//$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
     //}
     $records = $this->db->get()->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
	 $this->db->from('tbl_padron_tmp');
	 $this->db->where('tbl_padron_estado', 'incorrecto');
	 //$this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 //if($_SESSION['tipouser']=='usuario'){
		//$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
	 //}
	 
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get()->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*, CONCAT(tbl_padron_nombre, " ", tbl_padron_apellido) as tbl_usuario_nomape');
	 $this->db->from('tbl_padron_tmp');
	 $this->db->where('tbl_padron_estado', 'incorrecto');
	 //$this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 //if($_SESSION['tipouser']=='usuario'){
		//$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
	 //}
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get()->result();

     $data = array();

     foreach($records as $record ){
		$data[] = array(
		   "idtbl_test_tmp"=>$record->idtbl_padron_tmp,
		   "tbl_usuario_nomape"=>$record->tbl_usuario_nomape,
		   "tbl_test_celular"=>$record->tbl_padron_celular,
		   "tbl_test_cedula"=>$record->tbl_padron_cedula
		);
     }

     ## Response
     $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
     );

     return $response; 
	}
	/*fn mostrar data incorrecta*/
	
	/*exportar data correcta a excel*/
	public function list_export(){
		$this->db->select('*, CONCAT(tbl_padron_nombre, " ", tbl_padron_apellido) as tbl_test_nomape');
		$this->db->from('tbl_padron_tmp');
		$this->db->where('tbl_padron_estado', 'correcto');
		$query=$this->db->get();
		return $query->result();
	}
	
	/*exportar data incorrecta a excel*/
	public function list_exportinc(){
		$this->db->select('*, CONCAT(tbl_padron_nombre, " ", tbl_padron_apellido) as tbl_test_nomape');
		$this->db->from('tbl_padron_tmp');
		$this->db->where('tbl_padron_estado', 'incorrecto');
		$query=$this->db->get();
		return $query->result();
	}
	
	/*Search data*/
	public function list_searchData($nombres, $cedula){
		if($nombres!=""){
			$arrayData = explode(" ", $nombres);
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
		$nom=$arrayData[0]." ".$arrayData[1];
		$ape=$arrayData[2]." ".$arrayData[3];
		$this->db->select('*, CONCAT(tbl_padron_nombre, " ", tbl_padron_apellido) as tbl_padron_nomape');
		//$this->db->from('tbl_padron');
		//$this->db->where('tbl_padron_cedula', $cedula);
		//$this->db->like('tbl_padron_cedula', $cedula);
		$this->db->where("(CONCAT_WS(' ',tbl_padron_nombre,tbl_padron_apellido) LIKE '%".$nombres."%' or tbl_padron_cedula LIKE '%".$cedula."%')", NULL, FALSE);

		$records = $this->db->get('tbl_padron')->result();
				
		foreach($records as $record ){
            $id=$record->idtbl_padron;
            $nombres=$record->tbl_padron_nomape;
            $celular=$record->tbl_padron_celular;
			$cedula=$record->tbl_padron_cedula;
        }
		
        $data = array();
        $data['result']['id']=$id;
        $data['result']['nomape']=$nombres;
        $data['result']['cedula']=$cedula;
        $data['result']['celular']=$celular;
        return $data;
			
		/*$this->db->select('*');
		$this->db->like('columnname','both');
		$query=$this->db->get("tablesname");
		$result=$query->result_array();
		if(count($result)){
			return $result;
		}else{
			return FALSE;
		}*/
	}
	public function list_Datatable($ced, $name){
		$this->db->select('*, CONCAT(tbl_padron_nombre, " ", tbl_padron_apellido) as tbl_padron_nomape');
		$this->db->from('tbl_padron');
		$this->db->where("(CONCAT_WS(' ',tbl_padron_nombre,tbl_padron_apellido) LIKE '%".$name."%' or tbl_padron_cedula LIKE '%".$ced."%')", NULL, FALSE);
		//$this->db->limit(5);
		$query=$this->db->get();
		return $query->result();
	}
	/*form update sugerido*/
	function updateSug($id, $data){
        $this->db->where('idtbl_padron_tmp', $id);
        $this->db->update('tbl_padron_tmp', $data);
        if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
    }
}