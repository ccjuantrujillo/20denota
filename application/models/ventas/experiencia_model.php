<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Experiencia_model extends CI_Model{
    var $table;
    
    public function __construct(){
        parent::__construct();
        $this->table     = "experiencia";
        $this->table_uni = "universidad";
    }
	
    public function seleccionar($default="",$filter="",$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor)
        {
            $indice1   = $valor->EXPERP_Codigo;
            $valor1    = $valor->EXPERPC_Cargo;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
	
    public function listar($filter="",$filter_not='',$number_items='',$offset=''){
        $this->db->select('*');
        $this->db->from($this->table." as c",$number_items,$offset); 
        $this->db->join($this->table_uni.' as d','d.UNIVP_Codigo=c.UNIVP_Codigo','inner');
        if(isset($filter->experiencia)) $this->db->where(array("c.EXPERP_Codigo"=>$filter->experiencia));  
        if(isset($filter->profesor))    $this->db->where(array("c.PROP_Codigo"=>$filter->profesor));  
        if(isset($filter->universidad)) $this->db->where(array("c.UNIVP_Codigo"=>$filter->universidad));  
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
       echo $this->db->last_query();
       return $this->db->insert_id();
    }
	
    public function modificar($id,$filter){
        $this->db->where("EXPERP_Codigo",$id);
        $this->db->update($this->table,(array)$filter);
    }
	
    public function eliminar($filter){
        if(isset($filter->experiencia) && $filter->experiencia!='')  $this->db->where(array("EXPERP_Codigo"=>$filter->experiencia));
        $this->db->delete($this->table); 
    }
}
?>