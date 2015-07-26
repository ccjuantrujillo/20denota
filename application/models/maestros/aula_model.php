<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aula_model extends CI_Model{
    var $compania;
    var $table;

    public function __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table   = "aula";
        $this->table_det   = "local";
    }
    
    public function seleccionar($default='',$filter="",$filter_not='',$number_items='',$offset=''){   
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not='',$number_items='',$offset='') as $indice=>$valor)
        {
            $indice1   = $valor->AULAP_Codigo;
            $valor1    = $valor->AULAC_Nombre;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter="",$filter_not='',$number_items='',$offset=''){
        $this->db->select('*');
        $this->db->from($this->table." as a",$number_items,$offset);
        $this->db->join($this->table_det.' as l','l.LOCP_Codigo=a.LOCP_Codigo','inner');
        if(isset($filter->aula) && $filter->aula!='')    $this->db->where(array("a.AULAP_Codigo"=>$filter->aula));
	if(isset($filter->local) && $filter->local!='')  $this->db->where(array("a.LOCP_Codigo"=>$filter->local));
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
    
    public function insertar(stdClass $filter = null){
        $this->db->insert("cji_moneda",(array)$filter);
    }
    
    public function modificar($codigo,$data){
        $this->db->where("AULAP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
    
    public function eliminar($id){
        $this->db->delete($this->table,array('MONED_Codigo' => $id));
    }
    
    public function buscar($filter,$number_items='',$offset='')
    {

    }
}
?>