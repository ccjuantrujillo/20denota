<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tareadetalle_model extends CI_Model{
    var $compania;
    var $table;
    
    public function __construct(){
        parent::__construct();
        $this->usuario     = $this->session->userdata('codusu');
        $this->table       = "tareadetalle";
        $this->table_profe = "profesor";
        $this->table_pers  = "persona";
        $this->table_tema  = "tema";
        $this->table_semana = "semana";
        $this->table_tipoestudiociclo = "tipoestudiociclo";
        $this->table_tipoestudio = "tipoestudio";
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
        $this->db->select("*,DATE_FORMAT( d.TAREADETC_FechaEntrega,'%d/%m/%Y' ) AS fentrega",FALSE);
        $this->db->from($this->table." as d");
        $this->db->join($this->table_profe.' as e','e.PROP_Codigo=d.PROP_Codigo','inner');
        $this->db->join($this->table_pers.' as f','f.PERSP_Codigo=e.PERSP_Codigo','inner');
        $this->db->join($this->table_tema.' as g','g.PRODATRIBDET_Codigo=d.PRODATRIBDET_Codigo','left');
        $this->db->join($this->table_semana.' as h','h.PRODATRIB_Codigo=g.PRODATRIB_Codigo','inner');
        $this->db->join($this->table_tipoestudiociclo.' as i','i.TIPCICLOP_Codigo=h.TIPCICLOP_Codigo','inner');
        $this->db->join($this->table_tipoestudio.' as j','j.TIPP_Codigo=i.TIPP_Codigo','inner');
        if(isset($filter->tarea) && $filter->tarea!='')       $this->db->where(array("d.TAREAP_Codigo"=>$filter->tarea));
        if(isset($filter->tareadetalle) && $filter->tareadetalle!='')       $this->db->where(array("d.TAREADETP_Codigo"=>$filter->tareadetalle));
        if(isset($filter->profesor) && $filter->profesor!='') $this->db->where(array("d.PROP_Codigo"=>$filter->profesor));
        if(isset($filter->ciclo) && $filter->ciclo!='')       $this->db->where(array("h.CICLOP_Codigo"=>$filter->ciclo));
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
        $this->db->where("TAREADETP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
	
    public function eliminar($filter){
        if(isset($filter->tarea) && $filter->tarea!='')               $this->db->where(array("TAREAP_Codigo"=>$filter->tarea));
        if(isset($filter->tareadetalle) && $filter->tareadetalle!='') $this->db->where(array("TAREADETP_Codigo"=>$filter->tareadetalle));
        $this->db->delete($this->table);        
    }
}
?>