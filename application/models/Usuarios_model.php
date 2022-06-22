<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {
	public function login($username){
		$this->db->where("tbl_usuario_username", $username);
		//$this->db->where("tbl_usuario_password", $password);
		$resultados=$this->db->get("tbl_usuario");
		if($resultados->num_rows()>0){
			return $resultados->row();
		}else{
			return false;
		}
	}
	public function get_url($id){
		$this->db->where("idtbl_archivo", $id);
		$resultados=$this->db->get("tbl_archivo");
		if($resultados->num_rows()>0){
			return $resultados->row();
		}else{
			return false;
		}
	}
	public function validar($username){
		$this->db->where("tbl_usuario_username", $username);
		$resultados=$this->db->get("tbl_usuario");
		if($resultados->num_rows()>0){
			return 1;
		}else{
			return false;
		}
	}
	function guardar($data){
		$this->db->insert("tbl_usuario", $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	function guardar_datafile($data){
		$this->db->insert("tbl_archivo", $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	function getEmployees($postData=null){
     $response = array();

     ## Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value
	 $idusrio=$_SESSION['idusuario'];
	 $idfile=$_COOKIE['idfolderfile'];
	 
     ## Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (tbl_archivo_nombre like '%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering
	 $this->db->select('count(*) as allcount');
	 $this->db->from('tbl_usuario');
	 $this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 if($_SESSION['tipouser']=='usuario'){
		$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
		$this->db->where('tbl_descriparchivo_idtbl_descriparchivo=', $idfile);
     }
     $records = $this->db->get()->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
	 $this->db->from('tbl_usuario');
	 $this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 if($_SESSION['tipouser']=='usuario'){
		$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
		$this->db->where('tbl_descriparchivo_idtbl_descriparchivo=', $idfile);
	 }
	 
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get()->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*, CONCAT(tbl_usuario_nombre, " ", tbl_usuario_apellido) as tbl_usuario_nomape');
	 $this->db->from('tbl_usuario');
	 $this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 if($_SESSION['tipouser']=='usuario'){
		$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
		$this->db->where('tbl_descriparchivo_idtbl_descriparchivo=', $idfile);
	 }
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get()->result();

     $data = array();

     foreach($records as $record ){
		if($_SESSION['tipouser']=='admin'){
			$data[] = array(
			   "idtbl_archivo"=>$record->idtbl_archivo,
			   "tbl_usuario_nomape"=>$record->tbl_usuario_nomape,
			   "tbl_archivo_nombre"=>$record->tbl_archivo_filename,
			   "tbl_archivo_ext"=>$record->tbl_archivo_nombre,
			   "tbl_archivo_url"=>$record->tbl_archivo_url,
			   "tbl_archivo_fecha"=>$record->tbl_archivo_fecha
			);
		}else{
			$data[] = array(
			   "idtbl_archivo"=>$record->idtbl_archivo,
			   "tbl_archivo_nombre"=>$record->tbl_archivo_filename,
			   "tbl_archivo_ext"=>$record->tbl_archivo_nombre,
			   "tbl_archivo_url"=>$record->tbl_archivo_url,
			   "tbl_archivo_fecha"=>$record->tbl_archivo_fecha
			);
		}
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
   
   function getEmployeesusers($postData=null){
     $response = array();

     ## Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value
	 $idusrio=$_SESSION['idusuario'];
	 $this->load->library('encryption');
     ## Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (CONCAT(tbl_usuario_nombre, ' ', tbl_usuario_apellido) like '%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering
	 $this->db->select('count(*) as allcount');
	 $this->db->from('tbl_usuario');
	 $this->db->where('tbl_usuario_tipousuario', 'usuario');
	 //$this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 //if($_SESSION['tipouser']=='usuario'){
		//$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
     //}
     $records = $this->db->get()->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
	 $this->db->from('tbl_usuario');
	 $this->db->where('tbl_usuario_tipousuario', 'usuario');
	 //$this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 //if($_SESSION['tipouser']=='usuario'){
		//$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
	 //}
	 
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get()->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*, CONCAT(tbl_usuario_nombre, " ", tbl_usuario_apellido) as tbl_usuario_nomape');
	 $this->db->from('tbl_usuario');
	 $this->db->where('tbl_usuario_tipousuario', 'usuario');
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
		   "idtbl_usuario"=>$record->idtbl_usuario,
		   "tbl_usuario_nomape"=>$record->tbl_usuario_nomape,
		   "tbl_usuario_username"=>$record->tbl_usuario_username,
		   "tbl_usuario_table"=>$this->encryption->decrypt($record->tbl_usuario_table)
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
	
	/*listar directorio*/
	function getEmployeesdirectorio($postData=null){
     $response = array();

     ## Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value
	 ## Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (tbl_directorio_name like '%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering
	 $this->db->select('count(*) as allcount');
	 $this->db->from('tbl_archivo');
	 //$this->db->where('tbl_usuario_tipousuario', 'usuario');
	 
     $records = $this->db->get()->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
	 $this->db->from('tbl_archivo');
	 //$this->db->where('tbl_usuario_tipousuario', 'usuario');
	 	 
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get()->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
	 $this->db->from('tbl_archivo');
	 //$this->db->where('tbl_usuario_tipousuario', 'usuario');
	 
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get()->result();

     $data = array();

     foreach($records as $record ){
		$data[] = array(
		   "idtbl_archivo"=>$record->idtbl_archivo,
		   "tbl_archivo_urlfilemanager"=>$record->tbl_archivo_urlfilemanager
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
	/*/.*/
	
	/*listar filemager*/
	function getEmployeesfilemanager($postData=null){
     $response = array();

     ## Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     $searchValue = $postData['search']['value']; // Search value
	 $idusrio=$_SESSION['idusuario'];
	 ## Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (tbl_descriparchivo_nombre like '%".$searchValue."%' 
		or tbl_descriparchivo_descrip like '%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering
	 $this->db->select('count(DISTINCT tbl_descriparchivo_idtbl_descriparchivo) as allcount');
	 $this->db->from('tbl_descriparchivo');
	 $this->db->join('tbl_archivo', 'tbl_descriparchivo.tbl_archivo_idtbl_archivo = tbl_archivo.tbl_descriparchivo_idtbl_descriparchivo', 'inner');
	 //$this->db->where('tbl_usuario_tipousuario', 'usuario');
	 $this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
	 $this->db->where('tbl_descriparchivo_delete=', NULL);
	 //$this->db->group_by('tbl_descriparchivo_idtbl_descriparchivo');
	 
     $records = $this->db->get()->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(DISTINCT tbl_descriparchivo_idtbl_descriparchivo) as allcount');
	 $this->db->from('tbl_descriparchivo');
	 $this->db->join('tbl_archivo', 'tbl_descriparchivo.tbl_archivo_idtbl_archivo = tbl_archivo.tbl_descriparchivo_idtbl_descriparchivo', 'inner');
	 //$this->db->where('tbl_usuario_tipousuario', 'usuario');
	 $this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
	 $this->db->where('tbl_descriparchivo_delete=', NULL);
	 //$this->db->group_by('tbl_descriparchivo_idtbl_descriparchivo');
	 
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $records = $this->db->get()->result();
     $totalRecordwithFilter = $records[0]->allcount;

     ## Fetch records
     $this->db->select('*');
	 $this->db->from('tbl_descriparchivo');
	 $this->db->join('tbl_archivo', 'tbl_descriparchivo.tbl_archivo_idtbl_archivo = tbl_archivo.tbl_descriparchivo_idtbl_descriparchivo', 'inner');
	 //$this->db->where('tbl_usuario_tipousuario', 'usuario');
	 $this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
	 $this->db->where('tbl_descriparchivo_delete=', NULL);
	 $this->db->group_by('tbl_descriparchivo_idtbl_descriparchivo');
	 
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);
     $records = $this->db->get()->result();

     $data = array();

     foreach($records as $record ){
		$data[] = array(
		   "idtbl_descriparchivo"=>$record->idtbl_descriparchivo,
		   "tbl_descriparchivo_nombre"=>$record->tbl_descriparchivo_nombre,
		   "tbl_descriparchivo_descrip"=>$record->tbl_descriparchivo_descrip,
		   "tbl_descriparchivo_directoriofile"=>$record->tbl_descriparchivo_directoriofile,
		   "tbl_archivo_idtbl_archivo"=>$record->tbl_archivo_idtbl_archivo,
		   "tbl_descriparchivo_filename"=> str_replace(",", "<br>" ,$record->tbl_descriparchivo_filename)
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
	/*/.*/
	
	/*obener name de directorio*/
	public function get_namedirectory($id){
		$this->db->where("idtbl_directorio", $id);
		$resultados=$this->db->get("tbl_directorio");
		if($resultados->num_rows()>0){
			return $resultados->row();
		}else{
			return false;
		}
	}
	/*/.*/
	/*directory delete*/
	function directory_Delete($data){
		$this->db->delete('tbl_directorio', $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	/*/.*/
	function eliminar($data){
		$this->db->delete('tbl_archivo', $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	function user_Delete($data){
		$this->db->delete('tbl_usuario', $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	function guardar_directorio($data){
		$this->db->insert("tbl_directorio", $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	public function get_username($id){
		/*$this->db->select('idtbl_usuario, tbl_usuario_iddirectorio, idtbl_directorio, tbl_directorio_name, tbl_directorio_url, tbl_usuario_idtbl_usuario');
		$this->db->join('tbl_directorio', 'tbl_usuario.tbl_usuario_iddirectorio = tbl_directorio.tbl_usuario_idtbl_usuario', 'inner');
		//$this->db->where('tbl_aniolectivo_estado=1');
		 
		$this->db->where('idtbl_usuario', $id);
		$resultados=$this->db->get('tbl_usuario');
		if($resultados->num_rows()>0){
			return $resultados->result_array();
		}else{
			return false;
		}*/
		
		$this->db->select('idtbl_usuario, tbl_usuario_iddirectorio, idtbl_directorio, tbl_directorio_name, tbl_directorio_url, tbl_usuario_idtbl_usuario');
		$this->db->from('tbl_usuario');
		$this->db->join('tbl_directorio', 'tbl_usuario.tbl_usuario_iddirectorio = tbl_directorio.tbl_usuario_idtbl_usuario', 'inner');
		 
		$this->db->where('idtbl_usuario', $id);
		
	 
		$records = $this->db->get()->result();
		$data = array();

		foreach($records as $record ){
			$data = array(
			   "id"=>$record->idtbl_directorio,
			   "directorio_name"=>$record->tbl_directorio_name,
			   "directorio_url"=>$record->tbl_directorio_url
			);
		}
		return $data;
	}
	
	function guardar_datadescrip($data){
		$this->db->insert("tbl_descriparchivo", $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	public function get_descriparchivo($id){
		$this->db->select('tbl_archivo_nombre, tbl_descriparchivo_idtbl_descriparchivo');
		$this->db->from('tbl_archivo');
		 
		$this->db->where('tbl_descriparchivo_idtbl_descriparchivo', $id);
		
	 
		$records = $this->db->get();
		return $records->result_array();
	}
	
	function updateDescripcionsearch($id, $data){
        $this->db->where('tbl_archivo_idtbl_archivo', $id);
        $this->db->update('tbl_descriparchivo', $data);
        if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
    }
	
	function deleteDescripcion($id, $data){
		/*$this->db->delete('tbl_descriparchivo', $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}*/
		$this->db->where('idtbl_descriparchivo', $id);
        $this->db->update('tbl_descriparchivo', $data);
        if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	/*funcion para insertar datos de la persona*/
	function guardar_datapersona($data){
		$this->db->insert("tbl_persona", $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	/*validar persona*/
	function validarPersona($cedula){
		$this->db->select('*');
        $this->db->where('tbl_persona_cedula=',$cedula);
        $query = $this->db->get('tbl_persona');
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	/*insertar data importada excel*/
	function insertTest($data){
		$this->db->insert_batch('tbl_padron', $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	/*mostrar listado de lal personas*/
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
	 $idusrio=$_SESSION['idusuario'];
	 $this->load->library('encryption');
     ## Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (CONCAT(test_nombre, ' ', test_apellido) like '%".$searchValue."%' ) ";
     }

     ## Total number of records without filtering
	 $this->db->select('count(*) as allcount');
	 $this->db->from('test');
	 //$this->db->where('tbl_usuario_tipousuario', 'usuario');
	 //$this->db->join('tbl_archivo', 'tbl_usuario.idtbl_usuario = tbl_archivo.tbl_usuario_idtbl_usuario', 'inner');
	 //if($_SESSION['tipouser']=='usuario'){
		//$this->db->where('tbl_usuario_idtbl_usuario=', $idusrio);
     //}
     $records = $this->db->get()->result();
     $totalRecords = $records[0]->allcount;

     ## Total number of record with filtering
     $this->db->select('count(*) as allcount');
	 $this->db->from('test');
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
     $this->db->select('*, CONCAT(test_nombre, " ", test_apellido) as tbl_usuario_nomape');
	 $this->db->from('test');
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
		   "test_id"=>$record->test_id,
		   "tbl_usuario_nomape"=>$record->tbl_usuario_nomape,
		   "test_celular"=>$record->test_celular,
		   "test_cedula"=>$record->test_cedula
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
	/*update data persona*/
	
	function data_Update($postData=null){
        $id_update = $postData['id'];
        $this->db->select('test_id, test_nombre, test_apellido, test_celular, test_cedula');
        $this->db->where('test_id=',$id_update);
        $records = $this->db->get('test')->result();
        foreach($records as $record ){
            $id=$record->test_id;
            $nombres=$record->test_nombre;
            $apellidos=$record->test_apellido;
            $celular=$record->test_celular;
			$cedula=$record->test_cedula;
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
        $this->db->where('test_id', $id);
        $this->db->update('test', $data);
        if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
    }
	/*Insertar data a la tabla temp*/
	function insertTestvalidar($data){
		$this->db->insert_batch('tbl_test_tmp', $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	/*comparar cedula*/
	function compararCedula($cedula){
		$this->db->select('*, CONCAT(test_nombre, " ", test_apellido) as test_nomape');
        $this->db->where('test_cedula=',$cedula);
        $query = $this->db->get('test');
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
        $this->db->where('test_cedula=',$postData);
        $records = $this->db->get('test')->result();
        foreach($records as $record ){
            $id=$record->test_id;
            $nombres=$record->test_nombre;
            $apellidos=$record->test_apellido;
            $celular=$record->test_celular;
			$cedula=$record->test_cedula;
        }
        $data = array();
        $data['data']['id']=$id;
        $data['data']['nombres']=$nombres;
        $data['data']['apellidos']=$apellidos;
        $data['data']['cedula']=$cedula;
        $data['data']['celular']=$celular;
        return $data;
	}
	/*vaciar tmp*/
	public function emptytblTmp(){
		$this->db->truncate('tbl_test_tmp');
	}
	/*numero de filas*/
	public function numRows(){
		$query=$this->db->get('tbl_test_tmp');
		$numero_filas=$query->num_rows();
		return $numero_filas;
	}
}