<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cursociclo_model extends CI_Model{
    var $table;
    public function __construct(){
        parent::__construct();
        $this->table       = "cursociclo";
        $this->table_curso = "curso";
        $this->table_ciclo = "ciclo";
    }
	
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor){
            $indice1   = $valor->CURSOCIP_Codigo;
            $valor1    = $valor->PROD_Nombre;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not="",$number_items='',$offset=''){
        $this->db->select('*,DATE_FORMAT(c.CURSOCIC_FechaRegistro,"%d/%m/%Y") AS fechareg',FALSE);
        $this->db->from($this->table." as c");
        $this->db->join($this->table_curso.' as d','d.PROD_Codigo=c.PROD_Codigo','inner');
        $this->db->join($this->table_ciclo.' as e','e.CICLOP_Codigo=c.CICLOP_Codigo','inner');
        if(isset($filter->curso) && $filter->curso!='')           $this->db->where(array("c.PROD_Codigo"=>$filter->curso));
        if(isset($filter->ciclo))           $this->db->where(array("c.CICLOP_Codigo"=>$filter->ciclo));
        if(isset($filter->cursociclo) && $filter->cursociclo!='') $this->db->where(array("c.CURSOCIP_Codigo"=>$filter->cursociclo));
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
        $this->db->where("CURSOCIP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
	
    public function eliminar($filter){
        if(isset($filter->curso) && $filter->curso!='')           $this->db->where(array("PROD_Codigo"=>$filter->curso));
        if(isset($filter->cursociclo) && $filter->cursociclo!='') $this->db->where(array("CURSOCIP_Codigo"=>$filter->cursociclo));
        $this->db->delete($this->table);        
    }
}
?>