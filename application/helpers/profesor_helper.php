<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once(APPPATH.'models/ventas/experiencia_model.php');
include_once(APPPATH.'models/ventas/estudios_model.php');
include_once(APPPATH.'models/ventas/estudiosidiomas_model.php');
include_once(APPPATH.'models/ventas/conferencia_model.php');
include_once(APPPATH.'models/ventas/profesorsociedad_model.php');
include_once(APPPATH.'models/ventas/trabajo_model.php');
function listar_experiencia($codigo)
{
    $CI =& get_instance();
    $experiencia = new Experiencia_model();
    $lista = new stdClass();
    $filter = new stdClass();
    $filter->profesor = $codigo;
    $lista->experiencia  = $experiencia->listar($filter); 
    $lista->profesor  = $codigo;
    $arrMes             = array("00"=>"Mes","01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Setiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
    $arrAno[0]="Año";
    for($i=1950;$i<=2020;$i++)  $arrAno[$i]=$i;
    $data['arrmes']     = $arrMes;         
    $data['lista']      = $lista;
    return $CI->load->view("ventas/experiencia_index",$data,true);    
}

function listar_estudios($codigo){    
    $CI =& get_instance();
    $estudios = new Estudios_model();
    $lista  = new stdClass();
    $filter = new stdClass();
    $filter->profesor = $codigo;
    $lista->estudios  = $estudios->listar($filter);    
    $lista->profesor  = $codigo;
    $data['lista']    = $lista;
    return $CI->load->view("ventas/estudios_index",$data,true);
} 

function listar_idiomas($codigo){
    $CI =& get_instance();
    $idiomas = new Estudiosidiomas_model();
    $filter = new stdClass();
    $lista = new stdClass();
    $filter->profesor = $codigo;
    $lista->estudiosidiomas = $idiomas->listar($filter);   
    $lista->profesor  = $codigo;
    $arrNivel           = array("0"=>"::Seleccione::","1"=>"Basico","2"=>"Intermedio","3"=>"Avanzado");
    $data['arrNivel']   = $arrNivel;
    $data['lista']          = $lista;
    return $CI->load->view("ventas/estudioidiomas_index",$data,true);
}  

function listar_conferencias($codigo){     
    $CI =& get_instance();
    $conferencias = new Conferencia_model();
    $lista = new stdClass();
    $filter = new stdClass();
    $filter->profesor = $codigo;
    $lista->conferencias = $conferencias->listar($filter); 
    $lista->profesor  = $codigo;
    $data['lista']          = $lista;
    return $CI->load->view("ventas/conferencias_index",$data,true);
}  

function listar_sociedades($codigo){   
    $CI =& get_instance();
    $sociedades = new Profesorsociedad_model();
    $lista = new stdClass();
    $filter = new stdClass();
    $filter->profesor = $codigo;
    $lista->sociedades = $sociedades->listar($filter);      
    $lista->profesor  = $codigo;
    $data['lista']          = $lista;
    return $CI->load->view("ventas/sociedad_index",$data,true);
}     

function listar_empresa($codigo){  
    $CI =& get_instance();
    $trabajos = new Trabajo_model();
    $lista = new stdClass();
    $filter = new stdClass();
    $filter->profesor = $codigo;
    $lista->trabajos = $trabajos->listar($filter); 
    $lista->profesor  = $codigo;
    $data['lista']          = $lista;
    return $CI->load->view("ventas/trabajo_index",$data,true);
}  
?>