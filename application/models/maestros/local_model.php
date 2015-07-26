<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Local_model extends CI_Model{
    var $compania;
    var $table;

    public function __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table   = "local";
    }
    
    public function seleccionar($default='',$filter="",$filter_not='',$number_items='',$offset=''){   
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not='',$number_items='',$offset='') as $indice=>$valor)
        {
            $indice1   = $valor->LOCP_Codigo;
            $valor1    = $valor->LOCC_Nombre;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter="",$filter_not='',$number_items='',$offset=''){
        $this->db->select('*');
        $this->db->from($this->table." as p",$number_items,$offset);
        if(isset($filter->local) && $filter->local!='')    $this->db->where(array("p.LOCP_Codigo"=>$filter->local));     
        if(isset($filter->order_by) && count($filter->order_by)>0){
            foreach($filter->order_by as $indice=>$value){
                $this->db->order_by($indice,$value);
            }
        }           
        //$this->db->limit($number_items, $offset);         
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

    public function obtener2($filter,$filter_not='',$number_items='',$offset=''){
        if(!is_object($filter)){
            echo "buu";die;
        }           
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

    public function modificar($id,$filter){
        $this->db->where("LOCP_Codigo",$id);
        $this->db->update($this->table,(array)$filter);
    }
    
    public function eliminar($codigo){
        $this->db->delete($this->table,array('LOCP_Codigo' => $codigo));
    }
    
    public function buscar($filter,$number_items='',$offset='')
    {

    }
}
?>