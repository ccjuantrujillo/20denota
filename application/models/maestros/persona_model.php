<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Persona_model extends CI_Model
{
    var $table;  
    public function __construct(){
        parent::__construct();
        $this->table   = "persona";
        $this->table_profe = "profesor";
        $this->table_alum  = "alumno";
        $this->table_usus  = "usuario";        
    }
    
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor)
        {
            $indice1   = $valor->PERSP_Codigo;
            $valor1    = $valor->PERSC_ApellidoPaterno." ".$valor->PERSC_ApellidoMaterno." ".$valor->PERSC_Nombre;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not='',$number_items='',$offset=''){
        $this->db->select('*');
        $this->db->from($this->table." as p",$number_items,$offset);
        if(isset($filter->persona) && $filter->persona!='')            $this->db->where(array("p.PERSP_Codigo"=>$filter->persona));
        $this->db->where($where);    
        if(isset($filter_not->persona) && $filter_not->persona!=''){
            if(is_array($filter_not->persona) && count($filter_not->persona)>0){
                $this->db->where_not_in('p.PERSP_Codigo',$filter_not->persona);
            }
            else{
                $this->db->where('p.PERSP_Codigo !=',$filter_not->persona);
            }            
        }            
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

   public function listar_profesor($filter,$filter_not='',$number_items='',$offset='')
    {
        $this->db->select('c.*,d.*');
        $this->db->from($this->table.' as c',$number_items,$offset);
        $this->db->join($this->table_profe.' as d','d.PERSP_Codigo=c.PERSP_Codigo','inner');
        if(isset($filter->fechanac) && $filter->fechanac!='')            $this->db->where(array("substring(replace(PERSC_FechaNacimiento,'-',''),5,4)"=>substr($filter->fechanac,2,2).substr($filter->fechanac,0,2)));
        if(isset($filter->order_by) && is_array($filter->order_by)){
            foreach($filter->order_by as $indice=>$value){
                $this->db->order_by($indice,$value);
            }
        }  
        $query = $this->db->get();
        $resultado = array();
        if($query->num_rows>1)   $resultado = $query->result();
        if($query->num_rows==1)  $resultado = $query->row();
        return $resultado;
    }       
    
   public function listar_usuario($filter,$filter_not='',$number_items='',$offset='')
    {
        $this->db->select('c.*,d.*');
        $this->db->from($this->table.' as c',$number_items,$offset);
        $this->db->join($this->table_usus.' as d','d.PERSP_Codigo=c.PERSP_Codigo','inner');
        if(isset($filter->fechanac) && $filter->fechanac!='')            $this->db->where(array("substring(replace(PERSC_FechaNacimiento,'-',''),5,4)"=>substr($filter->fechanac,2,2).substr($filter->fechanac,0,2)));
        if(isset($filter->order_by) && is_array($filter->order_by)){
            foreach($filter->order_by as $indice=>$value){
                $this->db->order_by($indice,$value);
            }
        }  
        $query = $this->db->get();
        $resultado = array();
        if($query->num_rows>0)   $resultado = $query->result();
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
        $this->db->where("PERSP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }

    public function eliminar($codigo){
        $this->db->delete($this->table,array('PERSP_Codigo' => $codigo));        
    }
}
?>