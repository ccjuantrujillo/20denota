<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividad_model extends CI_Model{
    var $entidad;
    var $table;
    public function __construct()
    {
        parent::__construct();
        $this->compania  = $this->session->userdata('compania');
        $this->table     = "actividad";
    }

    public function listar($filter='',$filter_not='',$number_items='',$offset=''){
        if(isset($filter->orden) && $filter->orden!='')    $where = array("c.ORDENP_Codigo"=>$filter->orden);
        $this->db->select('*');
        $this->db->from($this->table." as c");
        $this->db->where($where);             
        if(isset($filter->order_by) && count($filter->order_by)>0){
            foreach($filter->order_by as $indice=>$value){
                $this->db->order_by($indice,$value);
            }
        }           
        $this->db->limit($number_items, $offset);         
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

    public function insertar($data){
       $this->db->insert($this->table,$data);
       return $this->db->insert_id();    
    }

    public function modificar($codigo,$data){
        $this->db->where("ACTP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }

    public function eliminar($codigo){
        $this->db->delete($this->table,array('ACTP_Codigo' => $codigo));     
    }
}
?>