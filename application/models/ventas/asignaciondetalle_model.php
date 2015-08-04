<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Asignaciondetalle_model extends CI_Model
{
    var $compania;
    var $table;  
    public function __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table      = "asignaciondetalle";
        $this->table_det  = "asignacion";
        $this->table_prof = "profesor";
        $this->table_per  = "persona";
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
        $this->db->select('*,DATE_FORMAT(c.ASIGDETC_FechaRegistro,"%d/%m/%Y") AS fechareg',FALSE);
        $this->db->from($this->table." as c",$number_items,$offset);
        $this->db->join($this->table_det.' as d','d.ASIGP_Codigo=c.ASIGP_Codigo','inner');
        if(isset($filter->asignacion) && $filter->asignacion!='')   $this->db->where(array("c.ASIGP_Codigo"=>$filter->asignacion));
        if(isset($filter->aula) && $filter->aula!='')               $this->db->where(array("c.AULAP_Codigo"=>$filter->aula));  
        if(isset($filter->tipoestudio) && $filter->tipoestudio!='') $this->db->where(array("c.TIPP_Codigo"=>$filter->tipoestudio));            
        if(isset($filter->order_by) && count($filter->order_by)>0){
            foreach($filter->order_by as $indice=>$value){
                $this->db->order_by($indice,$value);
            }
        }                 
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
            $resultado = (object)$listado[0];
        return $resultado;
    }

    public function insertar($data){
       $this->db->insert($this->table,$data);
       return $this->db->insert_id();
    }

    public function modificar($codigo,$data){
        $this->db->where("ASIGDETP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }

    public function eliminar($codigo){
        $this->db->delete($this->table,array('ASIGDETP_Codigo' => $codigo));        
    }
}
?>