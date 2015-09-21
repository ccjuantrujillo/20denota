<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipoestudiociclo_model extends CI_Model{
    var $table; 
    public function __construct(){
	parent::__construct();
        $this->table       = "tipoestudiociclo";
        $this->table_ciclo = "ciclo";
        $this->table_tipoestudio = "tipoestudio";
    }
    
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not='',$number_items='',$offset='') as $indice=>$valor)
        {
            $indice1   = $valor->TIPCICLOP_Codigo;
            $valor1    = $valor->TIPC_Nombre;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not='',$number_items='',$offset=''){
        $this->db->select('*');
        $this->db->from($this->table." as c",$number_items,$offset);
        $this->db->join($this->table_ciclo.' as d','d.CICLOP_Codigo=c.CICLOP_Codigo','inner');
        $this->db->join($this->table_tipoestudio.' as e','e.TIPP_Codigo=c.TIPP_Codigo','inner');
        if(isset($filter->ciclo) && $filter->ciclo!='')             $this->db->where(array("c.CICLOP_Codigo"=>$filter->ciclo));
        if(isset($filter->tipoestudiociclo) && $filter->tipoestudiociclo!='') $this->db->where(array("c.TIPCICLOP_Codigo"=>$filter->tipoestudiociclo));
        if(isset($filter->tipoestudio) && $filter->tipoestudio!='') $this->db->where(array("c.TIPP_Codigo"=>$filter->tipoestudio));
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
        $this->db->where("TIPCICLOP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }   
    
    public function eliminar($codigo){
        $this->db->delete($this->table,array('TIPCICLOP_Codigo' => $codigo));        
    }
    
    public function insertar($data){
       $this->db->insert($this->table,$data);
       return $this->db->insert_id();
    }    
}
?>