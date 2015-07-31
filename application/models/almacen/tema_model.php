<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tema_model extends CI_Model{
    var $compania;
    var $table;
    
    public function __construct(){
        parent::__construct();
        $this->compania   = $this->session->userdata('compania');
        $this->table      = "tema";
        $this->table_cab1 = "semana";
        $this->table_cab2 = "curso";
    }
	
    public function seleccionar($tipOt,$default=""){
        $nombre_defecto = $default==""?":: Seleccione ::":$default;
        $arreglo = array(''=>$nombre_defecto);
        foreach($this->listar($tipOt) as $indice=>$valor)
        {
            $indice1   = $valor->NroDoc;
            $valor1    = $valor->NroDoc;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not="",$number_items='',$offset=''){
        $where = array('c.CICLOP_Codigo'=>$this->compania);
        if(isset($filter->curso) && $filter->curso!='') $where = array_merge($where,array("d.PROD_Codigo"=>$filter->curso));
        if(isset($filter->productoatributo) && $filter->productoatributo!='') $where = array_merge($where,array("c.PRODATRIB_Codigo"=>$filter->productoatributo));
        if(isset($filter->productoatributodetalle) && $filter->productoatributodetalle!='') $where = array_merge($where,array("c.PRODATRIBDET_Codigo"=>$filter->productoatributodetalle));
        $this->db->select('*');
        $this->db->from($this->table.' as c');
        $this->db->join($this->table_cab1.' as d','d.PRODATRIB_Codigo=c.PRODATRIB_Codigo','inner');        
        $this->db->join($this->table_cab2.' as e','e.PROD_Codigo=d.PROD_Codigo','inner');  
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
        $this->db->where("PRODATRIBDET_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
	
    public function eliminar($codigo){
        $this->db->delete($this->table,array('PRODATRIBDET_Codigo' => $codigo));        
    }
}
?>