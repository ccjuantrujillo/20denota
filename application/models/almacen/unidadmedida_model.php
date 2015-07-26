<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Unidadmedida_model extends CI_Model{
    var $compania;
    var $table;
    public function __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table    = "unidadmedida";
    }
    
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor)
        {
            $indice1   = $valor->UNDMED_Codigo;
            $valor1    = $valor->UNDMED_Descripcion;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter='',$filter_not='',$number_items='',$offset=''){
        $where = array('CICLOP_Codigo'=>$this->compania);
        if(isset($filter->unidad) && $filter->unidad!='')   $where = array_merge($where,array("UNDMED_Codigo"=>$filter->unidad));
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);		
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
            $resultado = (object)$listado[0];
        return $resultado;
    }
    
    public function insertar($data){
       $data['CICLOP_Codigo'] = $this->compania; 
       $this->db->insert($this->table,$data);
       return $this->db->insert_id();        
    }
    
    public function modificar($codigo,$data){
        $this->db->where("UNDMED_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
    
    public function eliminar($codigo){
        $this->db->delete($this->table,array('UNDMED_Codigo' => $codigo));     
    }
}
?>