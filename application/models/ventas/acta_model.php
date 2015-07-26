<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Acta_model extends CI_Model{
    var $compania;
    var $table;
    
    public function __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table    = "acta";
    }
	
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor){
            $indice1   = $valor->ACTAP_Codigo;
            $valor1    = $valor->ACTAC_Numero;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not="",$number_items='',$offset=''){
        $where = array('p.CICLOP_Codigo'=>$this->compania);
        if(isset($filter->familia) && $filter->familia!='')   $where = array_merge($where,array("p.FAMI_Codigo"=>$filter->familia));
        if(isset($filter->tipo) && $filter->tipo!='')         $where = array_merge($where,array("p.TIPPROD_Codigo"=>$filter->tipo));
        if(isset($filter->estado) && $filter->estado!='')     $where = array_merge($where,array("p.PROD_FlagEstado"=>$filter->estado));
        if(isset($filter->producto) && $filter->producto!='') $where = array_merge($where,array("p.PROD_Codigo"=>$filter->producto));
        $this->db->select('*,DATE_FORMAT(p.PROD_FechaRegistro,"%d/%m/%Y") AS fechareg',FALSE);
        $this->db->from($this->table." as p");
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
        $this->db->where("PROD_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
	
    public function eliminar($codigo){
        $this->db->delete($this->table,array('PROD_Codigo' => $codigo));        
    }
}
?>