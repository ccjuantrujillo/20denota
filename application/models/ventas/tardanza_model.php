<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tardanza_model extends CI_Model{
    var $usuario;
    var $table;
    
    public function __construct(){
        parent::__construct();
        $this->usuario     = $this->session->userdata('codusu');
        $this->table       = "tareo";
        $this->table_profe = "profesor";
        $this->table_pers  = "persona";
        $this->table_tipoasis  = "tipoasistencia";
        $this->table_aula  = "aula";
        $this->table_curso  = "curso";
    }
	
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor){
            $indice1   = $valor->ACTAP_Codigo;
            $valor1    = $valor->ACTAC_Numero;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter,$filter_not="",$number_items='',$offset=''){
        $this->db->select('*');
        $this->db->from($this->table." as p");
        $this->db->join($this->table_profe.' as e','e.PROP_Codigo=p.PROP_Codigo','inner');
        $this->db->join($this->table_pers.' as f','f.PERSP_Codigo=e.PERSP_Codigo','inner');
        $this->db->join($this->table_curso.' as i','i.PROD_Codigo=e.PROD_Codigo','inner');
        $this->db->join($this->table_tipoasis.' as g','g.TIPOASISP_Codigo=p.TAREOC_Tipo','left');
        $this->db->join($this->table_aula.' as h','h.AULAP_Codigo=p.AULAP_Codigo');
        if(isset($filter->tareo) && $filter->tareo!='')       $this->db->where(array("p.TAREOP_Codigo"=>$filter->tareo));
        if(isset($filter->profesor) && $filter->profesor!='') $this->db->where(array("p.PROP_Codigo"=>$filter->profesor));
        if(isset($filter->curso) && $filter->curso!='')       $this->db->where(array("i.PROD_Codigo"=>$filter->curso));
        if(isset($filter->aula) && !is_null($filter->aula))   $this->db->where(array("p.AULAP_Codigo"=>$filter->aula));
        if(isset($filter->fecha) && !is_null($filter->fecha)) $this->db->where(array("p.TAREOC_Fecha"=>date_sql_ret($filter->fecha)));
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
    
    public function obtener($filter,$filter_not='',$number_items='',$offset=''){
        $listado = $this->listar($filter,$filter_not='',$number_items='',$offset='');
        if(count($listado)>1)
            $resultado = "Existe mas de un resultado";
        else
            $resultado = (object)$listado[0];
        return $resultado;
    }

    public function insertar($data){
       $data['USUA_Codigo'] = $this->usuario; 
       $this->db->insert($this->table,$data);
       return $this->db->insert_id();
    }    
    
    public function modificar($codigo,$data){
        $this->db->where("TAREOP_Codigo",$codigo);
        $this->db->update($this->table,$data);
    }
	
    public function eliminar($codigo){
        $this->db->delete($this->table,array('TAREOP_Codigo'=>$codigo));        
    }
}
?>