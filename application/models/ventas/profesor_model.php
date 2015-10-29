<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profesor_model extends CI_Model{
    var $table;
    public function __construct(){
        parent::__construct();
        $this->table_det2 = "curso";
        $this->table_det  = "persona";
        $this->table      = "profesor";
    }

    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor){
            $indice1   = $valor->PROP_Codigo;
            $valor1    = $valor->PERSC_ApellidoPaterno." ".$valor->PERSC_ApellidoMaterno." ".$valor->PERSC_Nombre;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }

    public function listar($filter,$filter_not='',$number_items='',$offset=''){
        $this->db->select('*,DATE_FORMAT(c.PROC_FechaRegistro,"%d/%m/%Y") AS fechareg',FALSE);
        $this->db->from($this->table." as c",$number_items,$offset);
        $this->db->join($this->table_det.' as d','d.PERSP_Codigo=c.PERSP_Codigo','inner');
        $this->db->join($this->table_det2.' as e','e.PROD_Codigo=c.PROD_Codigo','inner');
        if(isset($filter->profesor))        $this->db->where(array("c.PROP_Codigo"=>$filter->profesor));
        if(isset($filter->persona))         $this->db->where(array("c.PERSP_Codigo"=>$filter->persona));
        if(isset($filter->curso))           $this->db->where(array("c.PROD_Codigo"=>$filter->curso));
        if(isset($filter->flgcoordinador))  $this->db->where(array("c.PROC_FlagCoordinador"=>$filter->flgcoordinador));
        if(isset($filter_not->profesor) && $filter_not->profesor!=''){
            if(is_array($filter_not->profesor) && count($filter_not->profesor)>0){
                $this->db->where_not_in('c.PROP_Codigo',$filter_not->profesor);
            }
            else{
                $this->db->where('c.PROP_Codigo !=',$filter_not->profesor);
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
        $resultado = new stdClass();
        if(count($listado)>1)
            $resultado = "Existe mas de un resultado";
        elseif(count($listado)==1)
            $resultado = (object)$listado[0];
        return $resultado;
    }

    public function insertar($data){
       $this->db->insert($this->table,$data);
       return $this->db->insert_id();
    }

    public function modificar($codigo,$data){
        $this->db->where("PROP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }

    public function eliminar($codigo){
        $this->db->delete($this->table,array('PROP_Codigo' => $codigo));
    }
}
?>