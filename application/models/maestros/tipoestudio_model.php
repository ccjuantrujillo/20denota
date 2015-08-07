<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipoestudio_model extends CI_Model{
    var $compania;
    var $table; 
    public function __construct(){
	parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table   = "tipoestudio";
    }
    
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not='',$number_items='',$offset='') as $indice=>$valor)
        {
            $indice1   = $valor->TIPP_Codigo;
            $valor1    = $valor->TIPC_Nombre;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not='',$number_items='',$offset=''){
        $this->db->select('*');
        $this->db->from($this->table,$number_items,$offset);
        if(isset($filter->estado) && $filter->estado!='')      $this->db->where(array("TIPC_FlagEstado"=>$filter->estado));
        if(isset($filter->ciclo) && $filter->ciclo!='')        $this->db->where(array("CICLOP_Codigo"=>$filter->ciclo));
        if(isset($filter->tipoestudio) && $filter->tipoestudio!='')  $this->db->where(array("TIPP_Codigo"=>$filter->tipoestudio));
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
}
?>