<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Moneda_model extends CI_Model{
    var $compania;
    var $table;

    public function __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table   = "moneda";
    }
    
    public function seleccionar($default='',$filter="",$filter_not='',$number_items='',$offset=''){   
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not='',$number_items='',$offset='') as $indice=>$valor)
        {
            $indice1   = $valor->MONED_Codigo;
            $valor1    = $valor->MONED_Descripcion;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter="",$filter_not='',$number_items='',$offset=''){
        $where = array("CICLOP_Codigo"=>$this->compania);
        $query = $this->db->order_by('MONED_Orden')->where($where)->get($this->table);
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                $data[] = $fila;
            }
            return $data;
        }
    }
    
    public function obtener($moneda){
        $query = $this->db->where('MONED_Codigo',$moneda)->get($this->table);
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                $data[] = $fila;
            }
            return $data;
        }
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
    
    public function modificar($id,$filter){
        $this->db->where("MONED_Codigo",$id);
        $this->db->update("cji_moneda",(array)$filter);
    }
    
    public function eliminar($id){
        $this->db->delete('cji_moneda',array('MONED_Codigo' => $id));
    }
    
    public function buscar($filter,$number_items='',$offset='')
    {

    }
}
?>