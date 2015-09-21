<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Asignaciondetalle_model extends CI_Model
{
    var $compania;
    var $table;  
    public function __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table       = "asignaciondetalle";
        $this->table_det   = "asignacion";
        $this->table_prof  = "profesor";
        $this->table_per   = "persona";
        $this->table_tipoestudio  = "tipoestudio";
        $this->table_tipoestudiociclo  = "tipoestudiociclo";
        $this->table_aula  = "aula";
        $this->table_local = "local";
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
        $this->db->join($this->table_tipoestudiociclo.' as e','e.TIPCICLOP_Codigo=c.TIPCICLOP_Codigo','inner');
        $this->db->join($this->table_tipoestudio.' as m','m.TIPP_Codigo=e.TIPP_Codigo','inner');
        $this->db->join($this->table_aula.' as f','f.AULAP_Codigo=c.AULAP_Codigo','inner');
        $this->db->join($this->table_local.' as g','g.LOCP_Codigo=f.LOCP_Codigo','inner');
        if(isset($filter->asignacion) && $filter->asignacion!='')   $this->db->where(array("c.ASIGP_Codigo"=>$filter->asignacion));
        if(isset($filter->asignaciondetalle) && $filter->asignaciondetalle!='')   $this->db->where(array("c.ASIGDETP_Codigo"=>$filter->asignaciondetalle));
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
            $resultado = isset($listado[0])?(object)$listado[0]:"";
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

    public function eliminar($filter){
        if(isset($filter->asignacion) && $filter->asignacion!='')               $this->db->where(array("ASIGP_Codigo"=>$filter->asignacion));
        if(isset($filter->asignaciondetalle) && $filter->asignaciondetalle!='') $this->db->where(array("ASIGDETP_Codigo"=>$filter->asignaciondetalle));
        $this->db->delete($this->table);           
    }
}
?>