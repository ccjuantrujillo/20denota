<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*Modelo Tipo de Producto por ejemplo:
 * Sin número                       OT de Fabricación
 * A                                OT de Montaje
 * B                                OT de Obras Civiles
 * C                                OT de Transporte
 * D                                OT de Servicios de Ingenieria.....
 */
class Tipoproducto_model extends CI_Model{
    var $table;
    var $entidad;
    public function __construct(){
        parent::__construct();
        $this->entidad = $this->session->userdata('entidad');
        $this->table   = "view_tipProducto";
    }
    
    public function getLetra($value=''){
        $where = array("codent"=>$this->entidad,"cod_argumento"=>$value);
        $this->db->select('valor_2');
        $this->db->from($this->table);
        $this->db->where($where);
        $this->db->where_not_in('cod_argumento','01');
        $query = $this->db->get();
        $resultado = '';
        if($query->num_rows>0){
            foreach ($query->result() as $key => $value) {
                $resultado = $query->row();
                $resultado = $resultado->valor_2;
            }
        }
        return $resultado;
    }
    
    /*Combo para hacer un select*/
    public function seleccionar($filter,$order_by="",$default="",$value=''){
        $nombre_defecto = $default==""?":: Seleccione ::":$default;
        $arreglo = array($value=>$nombre_defecto);
        foreach($this->listar($filter,$order_by) as $indice=>$valor)
        {
            $indice1   = trim($valor->cod_argumento);
            $valor1    = $valor->des_larga;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    } 
    
    public function seleccionar2($filter,$order_by="",$default="",$value=''){
        $nombre_defecto = $default==""?":: Seleccione ::":$default;
        $arreglo = array($value=>$nombre_defecto);
        foreach($this->listar($filter,$order_by) as $indice=>$valor)
        {
            $indice1   = $valor->cod_argumento;
            $valor1    = "(".trim($valor->valor_2).") ".utf8_encode($valor->des_larga);
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }     
    
    /*Listado general de tipos de producto.*/
    public function listar($filter,$order_by='',$number_items='',$offset='')
    {            
        $where = array("codent"=>$this->entidad);
        $this->db->select('cod_tabla,cod_argumento,valor_2,des_larga,Des_Corta');
        $this->db->from($this->table,$number_items,$offset);
        $this->db->where($where);
        $this->db->where_not_in('cod_argumento','01');
        if(isset($order_by)){
            if(is_array($order_by) && count($order_by)>0){
                $this->db->order_by($order_by);
            }
            else{
                if($order_by!="") $this->db->order_by($order_by);              
            }
        }   
        $query = $this->db->get();
        $resultado = array();
        if($query->num_rows>0){
            $resultado = $query->result();
        }
        return $resultado;
    }
    
    /*Obtiene un tipo de producto, el resultado es único*/
    public function obtener($codigo)
    {
        $where = array("cod_argumento"=>$codigo,"cod_tabla"=>'TORD',"CodEnt"=>$this->entidad);
        $query = $this->db->where($where)->get($this->table);
        $resultado = new stdClass();
        if($query->num_rows>1) exit('Existe mas de 1 resultado');
        if($query->num_rows==1){
            $resultado = $query->row();
        }
        return $resultado;
    }
	
    public function insertar(stdClass $filter = null){
        $this->db->insert($this->table,(array)$filter);
    }
	
    public function modificar($codigo,$filter)
    {
        $where = array("cod_argumento"=>$codigo,"cod_tabla"=>'TORD',"CodEnt"=>$this->entidad);
        $this->db->where($where);
        $this->db->update($this->table,(array)$filter);
    }
	
    public function eliminar($codigo)
    {
        $where = array("cod_argumento"=>$codigo,"cod_tabla"=>'TORD',"CodEnt"=>$this->entidad);        
        $this->db->delete($this->table,array('CodEnt' => $id));
    }
}
?>