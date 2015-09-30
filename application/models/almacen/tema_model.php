<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tema_model extends CI_Model{
    var $table;
    
    public function __construct(){
        parent::__construct();
        $this->table        = "tema";
        $this->table_ciclo  = "ciclo";
        $this->table_curso  = "curso";
        $this->table_semana = "semana";
        $this->table_tipoestudio = "tipoestudio";
        $this->table_tipoestudiociclo = "tipoestudiociclo";
        $this->table_cursotipoestudio  = "cursotipoestudio";
        $this->table_cursociclo  = "cursociclo";
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
        $this->db->select('*');
        $this->db->from($this->table.' as c');      
        $this->db->join($this->table_cursociclo.' as d','d.CURSOCIP_Codigo=c.CURSOCIP_Codigo','inner'); 
        $this->db->join($this->table_ciclo.' as e','e.CICLOP_Codigo=d.CICLOP_Codigo','inner');        
        $this->db->join($this->table_tipoestudiociclo.' as f','f.TIPCICLOP_Codigo=c.TIPCICLOP_Codigo','inner');           
        $this->db->join($this->table_tipoestudio.' as g','g.TIPP_Codigo=f.TIPP_Codigo','inner');         
        $this->db->join($this->table_curso.' as h','h.PROD_Codigo=d.PROD_Codigo','inner'); 
        $this->db->join($this->table_semana.' as i','i.PRODATRIB_Codigo=c.PRODATRIB_Codigo','inner'); 
        if(isset($filter->curso) && $filter->curso!='')   $this->db->where(array("h.PROD_Codigo"=>$filter->curso));
        if(isset($filter->ciclo) && $filter->ciclo!='')   $this->db->where(array("e.CICLOP_Codigo"=>$filter->ciclo));
        if(isset($filter->semana) && $filter->semana!='') $this->db->where(array("i.PRODATRIB_Codigo"=>$filter->semana));	
        if(isset($filter->tema) && $filter->tema!='')     $this->db->where(array("c.PRODATRIBDET_Codigo"=>$filter->tema));
        if(isset($filter->tipoestudiociclo))              $this->db->where(array("f.TIPCICLOP_Codigo"=>$filter->tipoestudiociclo));
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
        $this->db->where("PRODATRIBDET_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
	
    public function eliminar($codigo){
        $this->db->delete($this->table,array('PRODATRIBDET_Codigo' => $codigo));        
    }
}
?>