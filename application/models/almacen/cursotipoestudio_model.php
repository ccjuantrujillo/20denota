<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cursotipoestudio_model extends CI_Model{
    var $table;
    public function __construct(){
        parent::__construct();
        $this->table = "cursotipoestudio";
        $this->table_cursociclo = "cursociclo";
        $this->table_curso = "curso";
        $this->table_ciclo = "ciclo";
        $this->table_tipoestudio = "tipoestudio";
    }
	
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor){
            $indice1   = $valor->PROD_Codigo;
            $valor1    = $valor->PROD_Nombre;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not="",$number_items='',$offset=''){
        $this->db->select('*,DATE_FORMAT(c.CURSOTIPOC_FechaRegistro,"%d/%m/%Y") AS fechareg',FALSE);
        $this->db->from($this->table." as c");
        $this->db->join($this->table_cursociclo.' as d','d.CURSOCIP_Codigo=c.CURSOCIP_Codigo','inner');
        $this->db->join($this->table_curso.' as e','e.PROD_Codigo=d.PROD_Codigo','inner');
        $this->db->join($this->table_ciclo.' as f','f.CICLOP_Codigo=d.CICLOP_Codigo','inner');
        $this->db->join($this->table_tipoestudio.' as g','g.TIPP_Codigo=c.TIPP_Codigo','inner');
        if(isset($filter->curso) && $filter->curso!='')           $this->db->where(array("d.PROD_Codigo"=>$filter->curso));
        if(isset($filter->cursociclo) && $filter->cursociclo!='') $this->db->where(array("c.CURSOCIP_Codigo"=>$filter->cursociclo));
        if(isset($filter->cursotipoestudio) && $filter->cursotipoestudio!='') $this->db->where(array("c.CURSOTIPOP_Codigo"=>$filter->cursotipoestudio));
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
        $this->db->where("CURSOTIPOP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
	
    public function eliminar($filter){
        if(isset($filter->cursotipoestudio) && $filter->cursotipoestudio!='')  $this->db->where(array("CURSOTIPOP_Codigo"=>$filter->cursotipoestudio));
        if(isset($filter->cursociclo) && $filter->cursociclo!='')              $this->db->where(array("CURSOCIP_Codigo"=>$filter->cursociclo));
        $this->db->delete($this->table);        
    }
}
?>