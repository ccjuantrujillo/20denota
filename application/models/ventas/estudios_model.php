<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudios_model extends CI_Model{
    var $table;
    
    public function __construct(){
        parent::__construct();
        $this->table   = "estudios";
        $this->table_uni   = "universidad";
        $this->table_grado   = "grado";
    }
	
    public function seleccionar($default="",$filter="",$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor)
        {
            $indice1   = $valor->ESTUDIOP_Codigo;
            $valor1    = $valor->ESTUDIOC_Descripcion;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
	
    public function listar($filter="",$filter_not='',$number_items='',$offset=''){
        $this->db->select('*');
        $this->db->from($this->table." as c",$number_items,$offset);  
        $this->db->join($this->table_uni.' as d','d.UNIVP_Codigo=c.UNIVP_Codigo','inner');
        $this->db->join($this->table_grado.' as e','e.GRADOP_Codigo=c.GRADOP_Codigo','inner');
        if(isset($filter->estudio))        $this->db->where(array("c.ESTUDIOP_Codigo"=>$filter->estudio));  
        if(isset($filter->profesor))       $this->db->where(array("c.PROP_Codigo"=>$filter->profesor));  
        if(isset($filter->grado) && $filter->grado!='')             $this->db->where(array("c.GRADOP_Codigo"=>$filter->grado));  
        if(isset($filter->universidad) && $filter->universidad!='') $this->db->where(array("c.UNIVP_Codigo"=>$filter->universidad));  
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
        $this->db->where("ESTUDIOP_Codigo",$id);
        $this->db->update($this->table,(array)$filter);
    }
	
    public function eliminar($filter){
        if(isset($filter->estudio) && $filter->estudio!='')  $this->db->where(array("ESTUDIOP_Codigo"=>$filter->estudio));
        $this->db->delete($this->table);         
    }
}
?>