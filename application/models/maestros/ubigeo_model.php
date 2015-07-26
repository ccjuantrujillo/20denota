<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ubigeo_model extends CI_Model{
    var $compania;
    var $table; 
    public function __construct(){
       parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table   = "ubigeo";
    }
        
    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
       if($default!="") $arreglo = array($default=>':: Seleccione ::');
       foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor){
            $arreglo[$valor->UBIGP_Codigo] = $valor->UBIGC_Descripcion;
       }
       return $arreglo;
    }
    
    public function listar($filter,$filter_not='',$number_items='',$offset=''){
        $where  = array('CICLOP_Codigo'=>$this->compania);
        if(isset($filter->ubigeo) && $filter->ubigeo!='')             $where = array_merge($where,array("UBIGP_Codigo"=>$filter->ubigeo));
        if(isset($filter->departamento) && $filter->departamento!='') $where = array_merge($where,array("UBIGC_CodDpto"=>$filter->departamento));
        if(isset($filter->provincia) && $filter->provincia!='')       $where = array_merge($where,array("UBIGC_CodProv"=>$filter->provincia));
        if(isset($filter->distrito) && $filter->distrito!='')         $where = array_merge($where,array("UBIGC_CodDist"=>$filter->distrito));
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
    
    public function listar_departamentos(){
        $query = $this->db->order_by('UBIGC_Descripcion')->where_not_in('UBIGC_CodDpto','00')->where('UBIGC_FlagEstado','1')->where('UBIGC_CodProv','00')->where('UBIGC_CodDist','00')->get('cji_ubigeo');
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                $data[] = $fila;
            }
            return $data;
        }
    }
    
    public function listar_provincias($departamento){
        $where = array('UBIGC_FlagEstado'=>'1','UBIGC_CodDpto'=>$departamento,'UBIGC_CodDist'=>'00');
        $query = $this->db->order_by('UBIGC_Descripcion')->where_not_in('UBIGC_CodProv','00')->where($where)->get('cji_ubigeo');
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                $data[] = $fila;
            }
            return $data;		
        }
    }
    
    public function listar_distritos($departamento,$provincia){
        $where = array('UBIGC_FlagEstado'=>'1','UBIGC_CodDpto'=>$departamento,'UBIGC_CodProv'=>$provincia);
        $query = $this->db->order_by('UBIGC_Descripcion')->where_not_in('UBIGC_CodDist','00')->where($where)->get('cji_ubigeo');
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                $data[] = $fila;
            }
            return $data;		
        }	
    }
	
    public function obtener($filter,$filter_not){
        $this->db->select("*");
        $this->db->from($this->table); 
        if(isset($filter->coddpto) && $filter->coddpto!='')   $this->db->where('coddpto',$filter->coddpto);
        if(isset($filter->codprov) && $filter->codprov!='')   $this->db->where('codprov',$filter->codprov);
        if(isset($filter->coddist) && $filter->coddist!='')   $this->db->where('coddist',$filter->coddist);
        $query = $this->db->get();
        $resultado = array();
        if($query->num_rows>1) exit("Existe mas de 1 resultado en la tabla ".$this->table."");
        if($query->num_rows>0){
            $resultado = $query->row();
        }
        
        return $resultado;			
    }    
    
    public function obtener_dpto($ubigeo){
        $where = array("coddpto"=>substr($ubigeo,0,2),"codprov"=>"00","coddist"=>"00");
        $query = $this->db->where($where)->get($this->table);
        $resultado = new stdClass();
        if($query->num_rows>1) exit('Existe mas de 1 resultado');
        if($query->num_rows==1){
            $resultado = $query->row();
        }
        return $resultado;			
    }
        
    public function obtener_prov($ubigeo){
        $where = array("coddpto"=>substr($ubigeo,0,2),"codprov"=>substr($ubigeo,2,2),"coddist"=>"00");
        $query = $this->db->where($where)->get($this->table);
        $resultado = new stdClass();
        if($query->num_rows>1) exit('Existe mas de 1 resultado');
        if($query->num_rows==1){
            $resultado = $query->row();
        }
        return $resultado;
    }
	
    public function obtener_dist($ubigeo){
        $where = array("coddpto"=>substr($ubigeo,0,2),"codprov"=>substr($ubigeo,2,2),"coddist"=>substr($ubigeo,4,2));
        $query = $this->db->where($where)->get($this->table);
        $resultado = new stdClass();
        if($query->num_rows>1) exit('Existe mas de 1 resultado');
        if($query->num_rows==1){
            $resultado = $query->row();
        }
        return $resultado;			
    }
    

    

       public function obtener_ubicacion($filter,$filter_not){
        $cadena="SELECT Codigo, Descrip as desc FROM distritos as u WHERE u.Codigo='$filter->ubica'";
        $query = $this->dbase->query($cadena);
        $resultado = $query->row();
        return $resultado;
    }
    
       public function obtener_ubigeo1($filter,$filter_not){
        $cadena="SELECT u.union FROM ubi_ser as u WHERE u.codigo='$filter->ubica'";
        $query = $this->dbase->query($cadena);
        $resultado = $query->row();
        return $resultado;
    }
    
    

      public function obtener_ubicacion1($filter10,$filter_not10){
        $cadena="SELECT h.Codigo, h.Descrip as des FROM distritos as h WHERE h.Codigo='$filter10->ubicas'";
        $query = $this->dbase->query($cadena);
        $resultado = $query->row();
      
        return $resultado;
    }    
    
}
?>