<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipociclo_model extends CI_Model{
    var $table; 
    public function __construct(){
	parent::__construct();
        $this->table       = "tipociclo";
    }
    
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not='',$number_items='',$offset='') as $indice=>$valor)
        {
            $indice1   = $valor->TIPOCICLOP_Codigo;
            $valor1    = $valor->TIPOCICLOC_Descripcion;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not='',$number_items='',$offset=''){
        $this->db->select('*');
        $this->db->from($this->table." as c",$number_items,$offset);
        if(isset($filter->tipociclo) && $filter->tipociclo!='')     $this->db->where(array("c.TIPOCICLOP_Codigo"=>$filter->tipociclo));
        if(isset($filter->order_by) && count($filter->order_by)>0){
            foreach($filter->order_by as $indice=>$value){
                $this->db->order_by($indice,$value);
            }
        } 
        $query = $this->db->get();
        $resultado = array();
        if($query->num_rows>0){
            $resultado = $query->result();
        }
        return $resultado;
    }
    
    public function obtener($filter,$filter_not=''){
        $listado = $this->listar($filter,$filter_not='',$number_items='',$offset='');
        if(count($listado)>1)
            $resultado = "Existe mas de un resultado";
        else
            $resultado = isset($listado[0])?(object)$listado[0]:"";
        return $resultado;	
    }
    
    public function modificar($codigo,$data){
        $this->db->where("TIPOCICLOP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }    
}
?>