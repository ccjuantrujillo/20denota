<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vigilancia_model extends CI_Model{
    var $usuario;
    var $table;
    
    public function __construct(){
        parent::__construct();
        $this->usuario     = $this->session->userdata('codusu');
        $this->table       = "vigilancia";
        $this->table_profe = "profesor";
        $this->table_persona = "persona";
    }
	
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor){
            $indice1   = $valor->VIGILAP_Codigo;
            $valor1    = $valor->TAREAC_Nombre;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not="",$number_items='',$offset=''){
        $this->db->select('*');
        $this->db->from($this->table." as p");
        $this->db->join($this->table_profe.' as d','d.PROP_Codigo=p.PROP_Codigo','inner');
        $this->db->join($this->table_persona.' as e','e.PERSP_Codigo=d.PERSP_Codigo','inner');
        if(isset($filter->vigilancia) && $filter->vigilancia!='') $this->db->where(array("p.VIGILAP_Codigo"=>$filter->vigilancia));
        if(isset($filter->profesor) && $filter->profesor!='')     $this->db->where(array("p.PROP_Codigo"=>$filter->profesor));        
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
       $this->db->insert($this->table,$data);
       return $this->db->insert_id();
    }    
    
    public function modificar($codigo,$data){
        $this->db->where("VIGILAP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
	
    public function eliminar($codigo){
        $this->db->delete($this->table,array('VIGILAP_Codigo' => $codigo));        
    }
}
?>