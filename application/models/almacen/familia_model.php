<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Familia_model extends CI_Model{
    var $compania;
    var $table;

    public function __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table   = "familia"; 
    }
     
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset='')
    {
       if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor){
            $indice1   = $valor->FAMI_Codigo;
            $valor1    = $valor->FAMI_Descripcion;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not="",$number_items='',$offset=''){ 
        $where = array('CICLOP_Codigo'=>$this->compania);
        if(isset($filter->familia) && $filter->familia!='')   $where = array_merge($where,array("FAMI_Codigo"=>$filter->familia));
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($where);		
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

    public function obtener($id){
        $where = array("FAMI_Codigo"=>$id);
        $query = $this->db->order_by('FAMI_Descripcion')->where($where)->get($this->table,1);
        if($query->num_rows>0){
          return $query->row();
        }
    }    
    
    public function insertar(stdClass $filter = null)
    {
        $this->db->insert("cji_almacen",(array)$filter);
    }
    public function modificar($id,$filter)
    {
        $this->db->where("ALMAP_Codigo",$id);
        $this->db->update("cji_almacen",(array)$filter);
    }
    public function eliminar($id)
    {
        $this->db->delete('cji_almacen',array('ALMAP_Codigo' => $id));
    }
    public function buscar($filter,$number_items='',$offset='')
    {
        $this->db->select('*');
        $this->db->from('cji_almacen',$number_items='',$offset='');
        $this->db->join('cji_tipoalmacen','cji_tipoalmacen.TIPALMP_Codigo=cji_almacen.TIPALM_Codigo');
        $this->db->where('cji_almacen.CICLOP_Codigo',$this->somevar['compania']);
        if(isset($filter->ALMAC_Descripcion) && $filter->ALMAC_Descripcion!="")
            $this->db->like('cji_almacen.ALMAC_Descripcion',$filter->ALMAC_Descripcion);
        if(isset($filter->TIPALM_Codigo) && $filter->TIPALM_Codigo!="")
            $this->db->like('cji_almacen.TIPALM_Codigo',$filter->TIPALM_Codigo);
        $query = $this->db->get();
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                    $data[] = $fila;
            }
            return $data;
        }
    }
}
?>