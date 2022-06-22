<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor_model extends CI_Model {
	function guardar($data){
		$this->db->insert("tbl_cermed", $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	function getEmployees($postData=null, $idSelect){
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
		 /*if($idSelect != ''){
			$searchQuery .= " and (tbl_regbodega_idtbl_regbodega='".$idSelect."') ";
		 }*/
		 if($searchValue != ''){
			//$searchQuery = " tbl_pacientetelefono=2633383 and (CONCAT(tbl_pacientenombres, ' ', tbl_pacienteapellidos) like '%".$searchValue."%' or tbl_pacientecedula like '%".$searchValue."%' or tbl_pacientegenero like'%".$searchValue."%' ) ";
			$searchQuery .= " and (tbl_cermed_nombres like '%".$searchValue."%' ) ";
		 }

		 ## Total number of records without filtering
		 $this->db->select('count(*) as allcount');
		 $this->db->from('tbl_cermed');
		 $this->db->where('tbl_establecimiento_idtbl_establecimiento=', NULL);
        
		 $records = $this->db->get()->result();
		 $totalRecords = $records[0]->allcount;

		 ## Total number of record with filtering
		 $this->db->select('count(*) as allcount');
		 $this->db->from('tbl_cermed');
		 
		 if($searchQuery != ''):
			$this->db->where('1'." ".$searchQuery);
		 else:
			$this->db->where('tbl_establecimiento_idtbl_establecimiento=', NULL);
		 endif;
		 $records = $this->db->get()->result();
		 $totalRecordwithFilter = $records[0]->allcount;

		 ## Fetch records
		 $this->db->select('*');
		 $this->db->from('tbl_cermed');
		 if($searchQuery != ''):
			$this->db->where('1'." ".$searchQuery);
		 else:
			$this->db->where('tbl_establecimiento_idtbl_establecimiento=', NULL);
		 endif;
		 $this->db->order_by($columnName, $columnSortOrder);
		 $this->db->limit($rowperpage, $start);
		 $records = $this->db->get()->result();

		 $data = array();

		 foreach($records as $record ){

			$data[] = array(
				"idtbl_cermed"=>$record->idtbl_cermed,
				"tbl_cermed_nombres"=>$record->tbl_cermed_nombres,
				"tbl_cermed_cedula"=>$record->tbl_cermed_cedula
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
	
	/*---------certificado multiple--------------*/
	/*llenar select certificado multiple*/
	function getEstablecimiento($postData=null){
		$response = array();
		$searchValue = $postData;
		$this->db->select('*');
		$this->db->order_by('idtbl_establecimiento', 'DESC');
		$records = $this->db->get('tbl_establecimiento')->result();
		$data = array();
		foreach($records as $record ){
			$data[] = array(
			   "id"=>$record->idtbl_establecimiento,
			   "text"=>$record->tbl_establecimiento_nombre
			); 
		}
		return $data; 
	}
	
	function guardarEstablecimiento($data){
		$this->db->insert("tbl_establecimiento", $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	function getEmployeesEst($postData=null, $idSelect){
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
		 if($idSelect != ''){
			$searchQuery .= " and (tbl_establecimiento_idtbl_establecimiento='".$idSelect."') ";
		 }
		 if($searchValue != ''){
			//$searchQuery = " tbl_pacientetelefono=2633383 and (CONCAT(tbl_pacientenombres, ' ', tbl_pacienteapellidos) like '%".$searchValue."%' or tbl_pacientecedula like '%".$searchValue."%' or tbl_pacientegenero like'%".$searchValue."%' ) ";
			$searchQuery .= " and (tbl_cermed_nombres like '%".$searchValue."%' ) ";
		 }

		 ## Total number of records without filtering
		 $this->db->select('count(*) as allcount');
		 $this->db->from('tbl_cermed');
		 $this->db->where('1'." ".$searchQuery);
         $records = $this->db->get()->result();
		 $totalRecords = $records[0]->allcount;

		 ## Total number of record with filtering
		 $this->db->select('count(*) as allcount');
		 $this->db->from('tbl_cermed');
		 if($searchQuery != ''):
			$this->db->where('1'." ".$searchQuery);
		 else:
			$this->db->where('1'." ".$searchQuery);
		 endif;
		 $records = $this->db->get()->result();
		 $totalRecordwithFilter = $records[0]->allcount;

		 ## Fetch records
		 $this->db->select('*');
		 $this->db->from('tbl_cermed');
		 if($searchQuery != ''):
			$this->db->where('1'." ".$searchQuery);
		 else:
			$this->db->where('1'." ".$searchQuery);
		 endif;
		 $this->db->order_by($columnName, $columnSortOrder);
		 $this->db->limit($rowperpage, $start);
		 $records = $this->db->get()->result();

		 $data = array();

		 foreach($records as $record ){

			$data[] = array(
				"idtbl_cermed"=>$record->idtbl_cermed,
				"tbl_cermed_nombres"=>$record->tbl_cermed_nombres,
				"tbl_cermed_cedula"=>$record->tbl_cermed_cedula
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
	
	function getSelectdelete($postData=null,$postId=null){
		$response = array();
		$searchValue = $postData;
		if($postId!=""){
			if($searchValue!=""){
				## Search 
				$searchQuery = "";
				//if($searchValue != ''){
				$searchQuery = " (tbl_cermed_nombres like '%".$searchValue."%' and tbl_establecimiento_idtbl_establecimiento='".$postId."' ) ";
				//}

				## Fetch records
				$this->db->select('*');
				if($searchQuery != '')
					$this->db->where($searchQuery);
				$records = $this->db->get('tbl_cermed')->result();
			}else{
				## Fetch records
				$this->db->select('*');
				$this->db->where('tbl_establecimiento_idtbl_establecimiento=',$postId);
				$this->db->order_by('idtbl_cermed', 'ASC');
				$this->db->limit(50);
				$records = $this->db->get('tbl_cermed')->result();
			}
		}else{
			$myObj = new stdClass;
			$myObj->idtbl_cermed = 'NN';
			$myObj->tbl_cermed_nombres = 'Seleccione establecimiento';
			$records[] = $myObj;
		}
		$data = array();
		foreach($records as $record ){
			$data[] = array(
			   "id"=>$record->idtbl_cermed,
			   "text"=>$record->tbl_cermed_nombres
			); 
		}

        return $data;
	}
	
	function deletecertMultiple($data){
		$this->db->where('idtbl_cermed', $data);
		$this->db->delete('tbl_cermed');
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	/*fin certificado*/
	
	function guardarBienesMat($data){
		$this->db->insert("tbl_regbienesmateriales", $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	function updateBienesMateriales($id, $data){
        $this->db->where('idtbl_regbodega', $id);
        $this->db->update('tbl_regbodega', $data);
        if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
    }
	
	function deleteBienes($data){
		$this->db->delete('tbl_regbodega', $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	function deleteBinesmate($data){
		$this->db->delete('tbl_regbienesmateriales', $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	function getdata_Bienes($postData=null){
        $id_data = $postData['id'];
        $records = $this->db->query('SELECT * FROM tbl_regbodega where idtbl_regbodega='.$id_data.'');
		$row = $records->row();
		
		$data = array();
		$data['result']['id']=$row->idtbl_regbodega;
        $data['result']['proyecto']=$row->tbl_regbodega_proyecto;
        $data['result']['fecha']=$row->tbl_regbodega_fecha;
        $data['result']['adminproyecto']=$row->tbl_regbodega_adminproyecto;
        $data['result']['proveedor']=$row->tbl_regbodega_proveedor;
        $data['result']['factura']=$row->tbl_regbodega_factura;
        return $data;
	}
	
	function ajustar_texto($texto,$maxcaracteres){
  
		if(!empty($texto)){
	  
			$texto = trim($texto);

			if(strlen($texto) > $maxcaracteres){

			$texto = substr($texto, 0, ($maxcaracteres - 3)) . '...';

			}

			return $texto;
	  
		}

	}
	
	
	function getRows($params = array()){
        $this->db->distinct();
		$this->db->select("idtbl_regbodega, tbl_regbodega_proyecto");
        $this->db->from("tbl_regbodega");

        if(!empty($params['searchTerm'])){
            $this->db->like('tbl_regbodega_proyecto', $params['searchTerm']);
        }
        $this->db->group_by('tbl_regbodega_proyecto'); 
        $this->db->order_by('tbl_regbodega_proyecto', 'asc');
        
        if(array_key_exists("idtbl_regbodega",$params)){
            $this->db->where('idtbl_regbodega',$params['idtbl_regbodega']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }

        //return fetched data
        return $result;
    }
	
	function getReporte($data){
        $this->db->select('*');
		$this->db->from('tbl_regbodega');
		$this->db->join('tbl_regbienesmateriales', 'tbl_regbodega.idtbl_regbodega = tbl_regbienesmateriales.tbl_regbodega_idtbl_regbodega', 'inner');
		$this->db->where('tbl_regbodega_idtbl_regbodega=', $data);
		
		$query = $this->db->get();
        //return fetched data
        return $query->result();
    }
	
	
	function grdResponsable($data){
		$this->db->insert("tbl_responsable", $data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	
	function getEntSal(){
        $this->db->select('*');
		$this->db->from('tbl_entsal');
		//$this->db->join('productos', 'productos.datos_establecimiento_iddatos_establecimiento = datos_establecimiento.iddatos_establecimiento', 'inner');
		$this->db->where('tbl_entsal_horaentrada!=', 'NN'); 
        
		$query = $this->db->get();
        //return fetched data
        return $query->result();
    }
	
	function getcamionSalida($data){
        $this->db->select('*');
		$this->db->from('tbl_entsal');
		$this->db->join('tbl_responsable', 'tbl_responsable.idtbl_responsable = tbl_entsal.tbl_responsable_idtbl_responsable', 'inner');
		$this->db->where('tbl_entsal_horasalaida!=', 'NN');
		$this->db->where('tbl_responsable_idtbl_responsable=', $data);
		
		$query = $this->db->get();
        //return fetched data
        return $query->result();
    }
	function getDataEntSal($data,$datad,$datat,$datac){
        if($datad=='sal'){
			$searchQuery = "(tbl_entsal_fecha >= '".$datat."' AND tbl_entsal_fecha <= '".$datac."') ";
			
			$this->db->select('*');
			$this->db->from('tbl_entsal');
			$this->db->join('tbl_responsable', 'tbl_responsable.idtbl_responsable = tbl_entsal.tbl_responsable_idtbl_responsable', 'inner');
			$this->db->where('tbl_entsal_horasalaida!=', 'NN');
			$this->db->where('tbl_responsable_idtbl_responsable=', $data);
			$this->db->where($searchQuery);
			
			$query = $this->db->get();
			//return fetched data
			return $query->result();
		}
		if($datad=='lle'){
			$searchQuery = "(tbl_entsal_fecha >= '".$datat."' AND tbl_entsal_fecha <= '".$datac."') ";
			/*SELECT * 
			FROM tbl_entsal 
			INNER JOIN tbl_responsable ON tbl_responsable.idtbl_responsable = tbl_entsal.tbl_responsable_idtbl_responsable
			WHERE tbl_responsable_idtbl_responsable = '1' and tbl_entsal_fecha >= '2020-04-16' AND tbl_entsal_fecha <= '2020-04-16'
			*/
			$this->db->select('*');
			$this->db->from('tbl_entsal');
			$this->db->join('tbl_responsable', 'tbl_responsable.idtbl_responsable = tbl_entsal.tbl_responsable_idtbl_responsable', 'inner');
			$this->db->where('tbl_entsal_horaentrada!=', 'NN');
			$this->db->where('tbl_responsable_idtbl_responsable=', $data);
			$this->db->where($searchQuery);
			
			$query = $this->db->get();
			//return fetched data
			return $query->result();
		}
    }
	
}