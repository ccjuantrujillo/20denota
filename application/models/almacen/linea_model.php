<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Linea_Model extends CI_Model
{
    var $compania;
    var $table;  
    public function __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table   = "linea";
    }
    
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        if(count($this->listar($filter,$filter_not=''))>0){
            foreach($this->listar($filter,$filter_not='') as $indice=>$valor){
                $indice1   = $valor->LINP_Codigo;
                $valor1    = $valor->LINC_Descripcion;
                $arreglo[$indice1] = $valor1;
            }
        }
        return $arreglo;
    }
    
     public function listar($filter='',$filter_not='',$number_items='',$offset='')
     {
        $where = array("CICLOP_Codigo"=>$this->compania);
        $query = $this->db->order_by('LINC_Descripcion')->where($where)->get($this->table,$number_items,$offset);
        if($query->num_rows>0){
                return $query->result();
        }
     }	 
     public function obtener($id)
     {
        $where = array("LINP_Codigo"=>$id);
        $query = $this->db->order_by('LINC_Descripcion')->where($where)->get($this->_name,1);
        if($query->num_rows>0){
          return $query->result();
        }
     }
    public function insertar(stdClass $filter = null)
    {
        $this->db->insert($this->_name,(array)$filter);
    }
    public function modificar($id,$filter)
    {
        $this->db->where("LINP_Codigo",$id);
        $this->db->update($this->_name,(array)$filter);
    }
    public function eliminar($id)
    {
        $this->db->delete($this->_name, array('LINP_Codigo' => $id));
    }
    public function buscar($filter,$number_items='',$offset='')
    {
        $where = array("LINC_FlagEstado"=>1,"LINP_Codigo !="=>0);
        $this->db->where($where);
        if(isset($filter->LINC_Descripcion) && $filter->LINC_Descripcion!='')
            $this->db->like('LINC_Descripcion',$filter->LINC_Descripcion,'right');
        $query = $this->db->get($this->_name,$number_items,$offset);
        if($query->num_rows>0){
                return $query->result();
        }
    }
}
?>