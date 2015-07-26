<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fabricante_Model extends CI_Model
{
    var $compania;
    var $table; 
    public function  __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table   = "fabricante";
    }
    public function seleccionar($default='',$filter="",$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        if(count($this->listar($filter="",$filter_not='',$number_items='',$offset=''))>0){
            foreach($this->listar($filter="",$filter_not='',$number_items='',$offset='') as $indice=>$valor)
            {
                $indice1   = $valor->FABRIP_Codigo;
                $valor1    = $valor->FABRIC_Descripcion;
                $arreglo[$indice1] = $valor1;
            }
        }
        return $arreglo;
    }
     public function listar($filter="",$filter_not='',$number_items='',$offset='')
     {
        $where = array("CICLOP_Codigo"=>$this->compania);
        $query = $this->db->order_by('FABRIC_Descripcion')->where($where)->get($this->table,$number_items,$offset);
        if($query->num_rows>0){
                return $query->result();
        }
     }	 
     public function obtener($id)
     {
        $where = array("FABRIP_Codigo"=>$id);
        $query = $this->db->order_by('FABRIC_Descripcion')->where($where)->get($this->table,1);
        if($query->num_rows>0){
          return $query->row();
        }
     }
    public function insertar(stdClass $filter = null)
    {
        $this->db->insert("cji_fabricante",(array)$filter);
    }
    public function modificar($id,$filter)
    {
        $this->db->where("FABRIP_Codigo",$id);
        $this->db->update("cji_fabricante",(array)$filter);
    }
    public function eliminar($id)
    {
        $this->db->delete('cji_fabricante', array('FABRIP_Codigo' => $id));
    }
    public function buscar($filter,$number_items='',$offset='')
    {
        $where = array("FABRIC_FlagEstado"=>1,'FABRIP_Codigo !='=>0);
        $this->db->where($where);
        if(isset($filter->FABRIC_Descripcion) && $filter->FABRIC_Descripcion!='')
            $this->db->like('FABRIC_Descripcion',$filter->FABRIC_Descripcion,'right');
        $query = $this->db->get('cji_fabricante',$number_items,$offset);
        if($query->num_rows>0){
            return $query->result();
        }
    }
}
?>