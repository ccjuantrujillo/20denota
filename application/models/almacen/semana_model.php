<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Semana_model extends CI_Model{
    var $table;    
    public function __construct(){
        parent::__construct();
        $this->table     = "semana";
        $this->table_tipoestudio = "tipoestudio";
        $this->table_tipoestudiociclo = "tipoestudiociclo";
        $this->table_ciclo   = "ciclo";
    }
	
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor)
        {
            $indice1   = $valor->PRODATRIB_Codigo;
            $valor1    = $valor->PRODATRIB_Nombre;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not="",$number_items='',$offset=''){
        $this->db->select('*,DATE_FORMAT(c.PRODATRIB_FechaRegistro,"%d/%m/%Y") AS fechareg',FALSE);
        $this->db->from($this->table.' as c');
        $this->db->join($this->table_tipoestudiociclo.' as d','d.TIPCICLOP_Codigo=c.TIPCICLOP_Codigo','inner');
        $this->db->join($this->table_tipoestudio.' as e','e.TIPP_Codigo=d.TIPP_Codigo','inner');
        $this->db->join($this->table_ciclo.' as f','f.CICLOP_Codigo=c.CICLOP_Codigo','inner');
        if(isset($filter->semana) && $filter->semana!='')           $this->db->where(array("c.PRODATRIB_Codigo"=>$filter->semana));		
        if(isset($filter->tipoestudiociclo) && $filter->tipoestudiociclo!='') $this->db->where(array("c.TIPCICLOP_Codigo"=>$filter->tipoestudiociclo));	
        if(isset($filter->ciclo) && $filter->ciclo!='')             $this->db->where(array("c.CICLOP_Codigo"=>$filter->ciclo));        
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
        $this->db->where("PRODATRIB_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
	
    public function eliminar($codigo){
        $this->db->delete($this->table,array('PRODATRIB_Codigo' => $codigo));        
    }
}
?>