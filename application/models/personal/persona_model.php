<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Persona_model extends CI_Model{
    var $table;
    public function __construct()
    {
        parent::__construct();
        $this->table   = "persona";
    }
    
    public function seleccionar($default="")
    {
        $nombre_defecto = $default==""?":: Seleccione ::":$default;
        $arreglo = array(''=>$nombre_defecto);
        foreach($this->listar() as $indice=>$valor)
        {
            $indice1   = $valor->CodOt;
            $valor1    = $valor->NroOt;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
	
    public function listar($filter,$filter_not='',$number_items='',$offset='')
    {
        $this->db->select('*');
        $this->db->from($this->table,$number_items,$offset);
        if(isset($filter->fechanac) && $filter->fechanac!='')            $this->db->where(array("substring(replace(PERSC_FechaNacimiento,'-',''),5,4)"=>substr($filter->fechanac,2,2).substr($filter->fechanac,0,2)));
        $this->db->where($where);
        if(isset($filter->order_by) && is_array($filter->order_by)){
            foreach($filter->order_by as $indice=>$value){
                $this->db->order_by($indice,$value);
            }
        }  
        $query = $this->db->get();
        $resultado = array();
        if($query->num_rows>1)   $resultado = $query->result();
        if($query->num_rows==1)  $resultado = $query->row();
        return $resultado;
    }
    
    public function insertar(stdClass $filter = null)
    {
        $this->db->insert($this->table,(array)$filter);
    }
	
    public function modificar($id,$filter)
    {
        $this->db->where("CodOt",$id);
        $this->db->update($this->table,(array)$filter);
    }
	
    public function eliminar($id)
    {
        $this->db->delete($this->table,array('codot' => $id));
    }
	
    public function buscar($filter,$number_items='',$offset='')
    {
        $this->db->select('*');
        $this->db->from($this->table,$number_items='',$offset='');
        $this->db->where('CodEnt',$this->entidad);
        $this->db->where_not_in('Estado','A');	
        if(isset($filter->CodEnt) && $filter->CodEnt!="")
            $this->db->like('CodEnt',$filter->CodEnt);
        if(isset($filter->Estado) && $filter->Estado!="")
            $this->db->like('Estado',$filter->Estado);
        $query = $this->db->get();
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                    $data[] = $fila;
            }
            return $data;
        }
    }
    
       public function obtener_sol($filter,$filter_not)
    {
        if($this->entidad=='01'){
            $filtrofecha   = "";
            $filtrofechai  = "";
            $filtrofechaf  = "";
            $filtrotipomov = ""; 
            
            /*COMPLETANDO CEROS*/
            $largo=6;        
            $entero=$filter->solicita;
            $entero = (int)$entero;
            $largo = (int)$largo;
            $relleno = '';
            if (strlen($entero) < $largo) {
            $relleno=str_repeat('0',$largo - strlen($entero));
            }
            $codi=$relleno.$entero;

        /**/
            if(isset($filter->solicita) && $filter->solicita!='')  $filtroper = " and Codres='".$codi."'";  
        //    if(isset($filter->fecha) && $filter->fecha!='')      $filtrofecha = "AND FecMov='".$filter->tipomov."'";  
            $cadena = "
                    select 
                    nomper as nombre
                    from responsable 
                    where codent='01'
                    ".$filtroper."
                  
                  
                    ";
            $query = $this->db->query($cadena);
            $resultado = $query->row();
        }
        //print_r($resultado);die;
        return $resultado;
    }
    
}
?>