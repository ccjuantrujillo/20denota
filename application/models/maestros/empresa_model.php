<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Empresa_model extends CI_Model
{
    var $compania;
    var $table;  
    public function __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table   = "empresa";
        $this->table_sector   = "sector";
    }
    
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor)
        {
            $indice1   = $valor->EMPRP_Codigo;
            $valor1    = $valor->EMPRC_RazonSocial;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }    
    
    public function listar($filter,$filter_not='',$number_items='',$offset=''){
        $this->db->select('*');
        $this->db->from($this->table." as p",$number_items,$offset);
        $this->db->join($this->table_sector.' as d','d.SECTORP_Codigo=p.SECTORP_Codigo','inner');
        if(isset($filter->empresa) && $filter->empresa!='')    $this->db->where(array("p.EMPRP_Codigo"=>$filter->empresa));        
        if(isset($filter->sector) && $filter->sector!='')      $this->db->where(array("p.SECTORP_Codigo"=>$filter->sector));  
        if(isset($filter->order_by) && count($filter->order_by)>0){
            foreach($filter->order_by as $indice=>$value){
                $this->db->order_by($indice,$value);
            }
        }           
        $this->db->limit($number_items, $offset);         
        $query = $this->db->get();
        $resultado = array();
        if($query->num_rows > 0){
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
    
    public function buscar($filter,$number_items='',$offset='')
    {       
        if(isset($filter->EMPRC_Ruc) && $filter->EMPRC_Ruc!="")
            $this->db->where('EMPRC_Ruc',$filter->EMPRC_Ruc);
        if(isset($filter->EMPRC_RazonSocial) && $filter->EMPRC_RazonSocial!="")
            $this->db->like('EMPRC_RazonSocial',$filter->EMPRC_RazonSocial);
        if(isset($filter->EMPRC_Telefono) && $filter->EMPRC_Telefono!="")
            $this->db->like('EMPRC_Telefono',$filter->EMPRC_Telefono)->or_like('EMPRC_Movil',$filter->EMPRC_Telefono);
        
        $query = $this->db->order_by('EMPRC_RazonSocial')
                          ->where('EMPRC_FlagEstado','1')
                          ->get('cji_empresa',$number_items='',$offset='');
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                    $data[] = $fila;
            }
            return $data;
        }
    }
     public function insertar($data){
       $this->db->insert($this->table,$data);
       return $this->db->insert_id();
    }
	
    public function modificar($id,$filter){
        $this->db->where("EMPRP_Codigo",$id);
        $this->db->update($this->table,(array)$filter);
    }
	
    public function eliminar($filter){
        if(isset($filter->empresa) && $filter->empresa!='')  $this->db->where(array("EMPRP_Codigo"=>$filter->empresa));        
        $this->db->delete($this->table); 
    }
}
?>