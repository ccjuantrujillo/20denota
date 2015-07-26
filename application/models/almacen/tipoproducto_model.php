<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tipoproducto_model extends CI_Model{
    var $compania;
    var $table; 
    public function __construct(){
        parent::__construct();
        $this->compania = $this->session->userdata('compania');
        $this->table   = "tipoproducto";
    }

    public function seleccionar($default='',$filter='',$filter_not='',$number_items='',$offset=''){
        if($default!="") $arreglo = array($default=>':: Seleccione ::');
        foreach($this->listar($filter,$filter_not,$number_items,$offset) as $indice=>$valor){
            $indice1   = $valor->TIPPROD_Codigo;
            $valor1    = $valor->TIPPROD_Descripcion;
            $arreglo[$indice1] = $valor1;
        }
        return $arreglo;
    }
    
    public function listar($filter="",$filter_not="",$number_items='',$offset=''){
        $where = array('t.CICLOP_Codigo'=>$this->compania);
        if(isset($filter->tipo) && $filter->tipo!='')         $where = array_merge($where,array("t.TIPPROD_Codigo"=>$filter->tipo));
        $this->db->select('*');
        $this->db->from($this->table." as t");
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
    
    public function obtener($filter,$filter_not='',$number_items='',$offset=''){
        $listado = $this->listar($filter,$filter_not='',$number_items='',$offset='');
        if(count($listado)>1)
            $resultado = "Existe mas de un resultado";
        else
            $resultado = (object)$listado[0];
        return $resultado;
    }    
    
    function listar_tipos_producto(){
            $query = $this->db->order_by('TIPPROD_Descripcion')->where('TIPPROD_FlagEstado','1')->get('cji_tipoproducto');
            if($query->num_rows>0){
                    foreach($query->result() as $fila){
                            $data[] = $fila;
                    }
                    return $data;
            }		
    }
    
    function obtener_($tipoProducto){
            $query = $this->db->where("TIPPROD_Codigo",$tipoProducto)->get($this->table);
            if($query->num_rows>0){
                    foreach($query->result() as $fila){
                            $data[] = $fila;
                    }
                    return $data;		
            }			
    }
    function insertar_tipo_producto($descripcion, $atributo){
            $data = array("TIPPROD_Descripcion" => strtoupper($descripcion));
            $this->db->insert("cji_tipoproducto",$data);
            $tipo = $this->db->insert_id();

            //Inserta atributos
            if(count($atributo)>0){
                foreach($atributo as $indice=>$valor){
                    $attrib = $valor;
                    if($valor!='')   
                        $this->plantilla_model->insertar_plantilla($tipo, $attrib);
                }
            }
    }
    function modificar_tipo_producto($tipo,$descripcion, $atributo){
            $data = array("TIPPROD_Descripcion" => strtoupper($descripcion));
            $this->db->where('TIPPROD_Codigo',$tipo);
            $this->db->update("cji_tipoproducto",$data);

            $this->plantilla_model->eliminar_plantilla_por_tipo($tipo);
            //Inserta atributos
            if(count($atributo)>0){
                foreach($atributo as $indice=>$valor){
                    $attrib        = $valor;
                    if($valor!='')
                        $this->plantilla_model->insertar_plantilla($tipo, $attrib);
                }
            }
    }
    function eliminar_tipo_producto($tipo){
            $data  = array("TIPPROD_FlagEstado" => '0');
            $where = array("TIPPROD_Codigo"     => $tipo); 
            $this->db->where($where);
            $this->db->update('cji_tipoproducto',$data);	
    }

    public function buscar_tipo_producto($filter,$number_items='',$offset='')
    {
        if(isset($filter->nombre_tipoprod) && $filter->nombre_tipoprod!='')
            $this->db->like('TIPPROD_Descripcion',$filter->nombre_tipoprod,'both');
        $query = $this->db->where('TIPPROD_FlagEstado','1')->get('cji_tipoproducto',$number_items,$offset);
        if($query->num_rows>0){
            foreach($query->result() as $fila){
                    $data[] = $fila;
            }
            return $data;
        }
    }

}
?>