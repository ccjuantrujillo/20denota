<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tipocliente_model extends CI_Model
{
    var $compania;
    var $table;    
    public function __construct()
    {
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table   = "tipocliente";
    }
    
    public function listar()
    {   $compania=$this->somevar ['compania'];
        $this->db->where('CICLOP_Codigo ', $compania)->where('TIPCLIC_FlagEstado','1');
        $this->db->where_not_in('TIPCLIP_Codigo','0')->order_by('TIPCLIC_Descripcion');
        $query = $this->db->get('cji_tipocliente');
        if($query->num_rows>0){
           return $query->result();
        }
    }
    public function obtener($id){
        $where = array("TIPCLIP_Codigo"=>$id,"TIPCLIC_FlagEstado"=>"1");
        $query = $this->db->where($where)->get('cji_tipocliente');
        if($query->num_rows>0){
                foreach($query->result() as $fila){
                        $data[] = $fila;
                }
                return $data;
        }
    }
    public function insertar(stdClass $filter = null)
    {
        $this->db->insert("cji_tipocliente",(array)$filter);
    }
    public function modificar($id,$filter)
    {
        $this->db->where("TIPCLIP_Codigo",$id);
        $this->db->update("cji_tipocliente",(array)$filter);
    }
    public function eliminar($id)
    {
        $this->db->delete('cji_tipocliente',array('TIPCLIP_Codigo' => $id));
    }
    public function buscar($filter,$number_items='',$offset='')
    {
        $this->db->where('CICLOP_Codigo',$this->somevar['compania']);
        if(isset($filter->TIPCLIC_Descripcion) && $filter->TIPCLIC_Descripcion!="")
            $this->db->like('TIPCLIC_Descripcion',$filter->TIPCLIC_Descripcion);
        
        $query = $this->db->where_not_in('TIPCLIP_Codigo','0')->order_by('TIPCLIC_Descripcion');
        $query = $this->db->get('cji_tipocliente',$number_items,$offset);
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                    $data[] = $fila;
            }
            return $data;
        }
    }
 
}
?>