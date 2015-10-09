<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Actadetalle_model extends CI_Model{
    var $compania;
    var $table;
    
    public function __construct(){
        parent::__construct();
        $this->usuario     = $this->session->userdata('codusu');
        $this->table       = "actadetalle";
        $this->table_profe = "profesor";
        $this->table_pers  = "persona";
    }
	
//    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
//        if($default!="") $arreglo = array($default=>':: Seleccione ::');
//        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor){
//            $indice1   = $valor->ACTAP_Codigo;
//            $valor1    = $valor->ACTAC_Numero;
//            $arreglo[$indice1] = $valor1;
//        }
//        return $arreglo;
//    }
    
    public function listar($filter,$filter_not="",$number_items='',$offset=''){
        $this->db->select('*,DATE_FORMAT(d.ACTADETC_FechaRegistro,"%d/%m/%Y") AS fechareg',FALSE);
        $this->db->from($this->table." as d");
        if(isset($filter->acta) && $filter->acta!='')                $this->db->where(array("d.ACTAP_Codigo"=>$filter->acta));
        if(isset($filter->actadetalle) && $filter->actadetalle!='')  $this->db->where(array("d.ACTADETP_Codigo"=>$filter->actadetalle));
        if(isset($filter->order_by) && count($filter->order_by)>0){
            foreach($filter->order_by as $indice=>$value){
                $this->db->order_by($indice,$value);
            }
        }           
        $this->db->limit($number_items, $offset); 
        $query = $this->db->get();
        $resultado = array();
        if($query->num_rows>0){
            $resultado = $query->result();
        }
        return $resultado;
    }
    
    public function obtener($filter,$filter_not='',$number_items='',$offset=''){
        $listado = $this->listar($filter,$filter_not='',$number_items='',$offset='');
        if(count($listado)>1)
            $resultado = "Existe mas de un resultado";
        else
            $resultado = isset($listado[0])?(object)$listado[0]:"";
        return $resultado;
    }

    public function insertar($data){
       $this->db->insert($this->table,$data);
       return $this->db->insert_id();
    }    
    
    public function modificar($codigo,$data){
        $this->db->where("ACTADETP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
	
    public function eliminar($filter){
        if(isset($filter->acta) && $filter->acta!='')               $this->db->where(array("ACTAP_Codigo"=>$filter->acta));
        if(isset($filter->actadetalle) && $filter->actadetalle!='') $this->db->where(array("ACTADETP_Codigo"=>$filter->actadetalle));
        $this->db->delete($this->table);        
    }
}
?>