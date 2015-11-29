<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Actaprofesor_model extends CI_Model{
    var $usuario;
    var $table;
    
    public function __construct(){
        parent::__construct();
        $this->usuario     = $this->session->userdata('codusu');
        $this->table_acta  = "acta";
        $this->table_actaprofe  = "actaprofesor";
        $this->table_profe = "profesor";
        $this->table_pers  = "persona";
        $this->table_curso = "curso";
    }
	
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor){
            $indice1   = $valor->ACTAP_Codigo;
            $valor1    = $valor->ACTAC_Numero;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not="",$number_items='',$offset=''){
        $this->db->select('*,c.PROP_Codigo as codprofesor');
        $this->db->from($this->table_profe." as c");
        if(isset($filter->acta) && $filter->acta!=''){
            $this->db->join($this->table_actaprofe.' as d','d.PROP_Codigo=c.PROP_Codigo and d.ACTAP_Codigo="'.$filter->acta.'"','left');    
        }
        else{
            $this->db->join($this->table_actaprofe.' as d','d.PROP_Codigo=c.PROP_Codigo','left');
        }
        if(isset($filter->acta) && $filter->acta!=''){
            $this->db->join($this->table_acta.' as e','e.ACTAP_Codigo=d.ACTAP_Codigo and d.ACTAP_Codigo="'.$filter->acta.'"','left');    
        }
        $this->db->join($this->table_pers.' as f','f.PERSP_Codigo=c.PERSP_Codigo','inner');
        $this->db->join($this->table_curso.' as g','g.PROD_Codigo=c.PROD_Codigo','inner');
        if(isset($filter->profesor) && $filter->profesor!='') $this->db->where(array("c.PROP_Codigo"=>$filter->profesor));
        if(isset($filter->curso))                             $this->db->where(array("g.PROD_Codigo"=>$filter->curso));
        if(isset($filter->acta))                              $this->db->where(array("e.ACTAP_Codigo"=>$filter->acta));        
        if(isset($filter->order_by) && count($filter->order_by)>0){
            foreach($filter->order_by as $indice=>$value){
                $this->db->order_by($indice,$value);
            }
        }           
        $this->db->limit($number_items, $offset); 
        $query = $this->db->get();
        //echo $this->db->last_query();
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
            $resultado = (object)$listado[0];
        return $resultado;
    }

    public function insertar($data){
       $this->db->insert($this->table_actaprofe,$data);
       return $this->db->insert_id();
    }    
    
    public function modificar($codigo,$data){
        $this->db->where("ACTAPROFP_Codigo",$codigo);
        $this->db->update($this->table_actaprofe,$data);
    }
	
    public function eliminar($codigo){
        $this->db->delete($this->table_actaprofe,array('ACTAPROFP_Codigo' => $codigo));        
    }
}
?>