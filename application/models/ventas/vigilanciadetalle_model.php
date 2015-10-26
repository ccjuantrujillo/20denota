<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vigilanciadetalle_model extends CI_Model{
    var $compania;
    var $table;
    
    public function __construct(){
        parent::__construct();
        $this->usuario     = $this->session->userdata('codusu');
        $this->table   = "vigilanciadetalle";
        $this->table_vigilancia = "vigilancia";        
        $this->table_profe = "profesor";
        $this->table_pers  = "persona";
        $this->table_curso = "curso";
    }
	
//    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
//        if($default!="") $arreglo = array($default=>':: Seleccione ::');
//        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor){
//            $indice1   = $valor->ACTAP_Codigo;
//            $valor1    = $valor->ACTAC_Numero;
//            $arreglo[$indice1] = $valor1;
//        }
//        return $arreglo;
//    }
    
    public function listar($filter,$filter_not="",$number_items='',$offset=''){
        $this->db->select();
        $this->db->from($this->table." as d");
        $this->db->join($this->table_vigilancia.' as e','e.VIGILAP_Codigo=d.VIGILAP_Codigo','inner');
        $this->db->join($this->table_profe.' as f','f.PROP_Codigo=d.PROP_Codigo','inner');
        $this->db->join($this->table_pers.' as g','g.PERSP_Codigo=f.PERSP_Codigo','inner');
        $this->db->join($this->table_curso.' as h','h.PROD_Codigo=d.PROD_Codigo','inner');
        if(isset($filter->vigilancia) && $filter->vigilancia!='')                $this->db->where(array("d.VIGILAP_Codigo"=>$filter->vigilancia));
        if(isset($filter->vigilanciadetalle) && $filter->vigilanciadetalle!='')  $this->db->where(array("d.VIGILADETP_Codigo"=>$filter->vigilanciadetalle));
        if(isset($filter->profesor) && $filter->profesor!='') $this->db->where(array("d.PROP_Codigo"=>$filter->profesor));
        if(isset($filter->curso) && $filter->curso!='')       $this->db->where(array("d.PROD_Codigo"=>$filter->curso));
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
            $resultado = isset($listado[0])?(object)$listado[0]:"";
        return $resultado;
    }

    public function insertar($data){
       $this->db->insert($this->table,$data);
       return $this->db->insert_id();
    }    
    
    public function modificar($codigo,$data){
        $this->db->where("VIGILADETP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
	
    public function eliminar($filter){
        if(isset($filter->vigilancia) && $filter->vigilancia!='')               $this->db->where(array("VIGILAP_Codigo"=>$filter->tarea));
        if(isset($filter->vigilanciadetalle) && $filter->vigilanciadetalle!='') $this->db->where(array("VIGILADETP_Codigo"=>$filter->tareadetalle));
        $this->db->delete($this->table);        
    }
}
?>