<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model{
    var $compania;
    var $table;
    public function __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table    = "menu";
    }
    
    public function listar($filter,$filter_not='',$number_items='',$offset='')
    {
        $where  = array('MENU_FlagEstado'=>1);
        if(isset($filter->codigo) && $filter->codigo!='')    $where = array_merge($where,array("MENU_Codigo_Padre"=>$filter->codigo));
        if(isset($filter->menu) && $filter->menu!='')        $where = array_merge($where,array("MENU_Codigo"=>$filter->menu));
        $this->db->select('*');
        $this->db->from($this->table,$number_items,$offset);
        $this->db->where($where);
        if(isset($filter->order_by) && is_array($filter->order_by)){
            foreach($filter->order_by as $indice=>$value) $this->db->order_by($indice,$value);
        }  
        $query = $this->db->get();
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
            $resultado = (object)$listado;
        return $resultado;
    }
    
    public function menu_padre($codres)
    {
        $cadena = "SELECT MENU_Codigo,MENU_Codigo_Padre, MENU_Descripcion, MENU_Url FROM menu WHERE MENU_Codigo_Padre<=0 AND MENU_Codigo IN(select p.MENU_Codigo from permiso as p where p.ROL_Codigo='".$codres."' AND p.PERM_FlagEstado='Activo') order by MENU_Codigo_Padre";
        $query = $this->db->query($cadena);
        $resultado = array();
        if($query->num_rows>0){
                $resultado = $query->result();
        }
        return $resultado;   
    }
	
    public function menu_hijo($codPadre,$codres){
        $cadena = "SELECT CodSubmenu, SubmenuDesc, SubmenuURL FROM Menu2 WHERE CodPadre='".$codPadre."' AND CodSubmenu IN(select p.CodSubmenu from permiso2 as p where p.CodRes='".$codres."' AND p.Estado='Activo') order by orden";
        $query = $this->db->query($cadena);
        $resultado = array();
        if($query->num_rows>0){
                $resultado = $query->result();
        }
        return $resultado; 
    }
    
 
}