<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profesorsociedad_model extends CI_Model{
    var $table;
    
    public function __construct(){
        parent::__construct();
        $this->table     = "profesorsociedad";
        $this->table_soc = "sociedad";
    }
	
    public function seleccionar($default="",$filter="",$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor)
        {
            $indice1   = $valor->PROFSOCP_Codigo;
            $valor1    = $valor->SOCIEDC_Nombre;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
	
    public function listar($filter="",$filter_not='',$number_items='',$offset=''){
        $this->db->select('*');
        $this->db->from($this->table." as c",$number_items,$offset);  
        $this->db->join($this->table_soc.' as d','d.SOCIEDP_Codigo=c.SOCIEDP_Codigo','inner');
        if(isset($filter->profesor))   $this->db->where(array("c.PROP_Codigo"=>$filter->profesor));  
        if(isset($filter->sociedad))   $this->db->where(array("c.SOCIEDP_Codigo"=>$filter->sociedad)); 
        if(isset($filter->profesorsociedad) && $filter->profesorsociedad!='') $this->db->where(array("c.PROFSOCP_Codigo"=>$filter->profesorsociedad)); 
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
	
    public function modificar($id,$filter){
        $this->db->where("PROFSOCP_Codigo",$id);
        $this->db->update($this->table,(array)$filter);
    }
	
    public function eliminar($filter){
        if(isset($filter->profesorsociedad) && $filter->profesorsociedad!='')  $this->db->where(array("PROFSOCP_Codigo"=>$filter->profesorsociedad));        
        $this->db->delete($this->table);        
    }
}
?>