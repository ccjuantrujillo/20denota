<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model{
    var $entidad;
    var $table;
    public function __construct()
    {
        parent::__construct();
        $this->compania  = $this->session->userdata('compania');
        $this->table     = "usuario";
        $this->table_cab = "persona";
    }

    public function ingresar($user,$clave,$compania)
    {
        $where = array("u.USUA_usuario"=>$user,"u.USUA_Password"=>$clave,"u.CICLOP_Codigo"=>$compania);
        $this->db->select('*');
        $this->db->from($this->table." as u");
        $this->db->join($this->table_cab.' as p','p.PERSP_Codigo=u.PERSP_Codigo','inner');  
        $this->db->where($where);
        $query = $this->db->get();
        $resultado = new stdClass();
        if($query->num_rows>1) exit('Existe . mas de 1 resultado');
        if($query->num_rows==1){
            $resultado = $query->row();
        }
        return $resultado; 
    }

    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor)
        {
            $indice1   = $valor->USUA_Codigo;
            $valor1    = $valor->PERSC_ApellidoPaterno." ".$valor->PERSC_ApellidoMaterno." ".$valor->PERSC_Nombre;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }

    public function listar($filter='',$filter_not='',$number_items='',$offset=''){
        $where = array("c.CICLOP_Codigo"=>$this->compania);
        if(isset($filter->usuario) && $filter->usuario!='')    $where = array_merge($where,array("c.USUA_Codigo"=>$filter->usuario));
        $this->db->select('*');
        $this->db->from($this->table." as c");
        $this->db->join($this->table_cab.' as d','d.PERSP_Codigo=c.PERSP_Codigo','inner');
        $this->db->where($where);    
        if(isset($filter_not->persona) && $filter_not->persona!=''){
            if(is_array($filter_not->persona) && count($filter_not->persona)>0){
                $this->db->where_not_in('c.PERSP_Codigo',$filter_not->persona);
            }
            else{
                $this->db->where('c.PERSP_Codigo !=',$filter_not->persona);
            }            
        }            
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
       $data['CICLOP_Codigo'] = $this->compania; 
       $this->db->insert($this->table,$data);
       return $this->db->insert_id();    
    }

    public function modificar($codigo,$data){
        $this->db->where("USUA_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }

    public function eliminar($codigo){
        $this->db->delete($this->table,array('UNDMED_Codigo' => $codigo));     
    }
}
?>