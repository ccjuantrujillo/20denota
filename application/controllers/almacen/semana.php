<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require_once "Spreadsheet/Excel/Writer.php";
class Semana extends CI_Controller {
    var $configuracion;
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");        
        $this->load->model(almacen.'curso_model');
        $this->load->model(almacen.'semana_model');
        $this->load->model(almacen.'tema_model');
        $this->load->model(almacen.'unidadmedida_model');
        $this->load->model(seguridad.'permiso_model');  
        $this->load->model(maestros.'ciclo_model'); 
        $this->load->model(maestros.'tipoestudio_model'); 
        $this->load->model(maestros.'tipoestudiociclo_model'); 
        $this->load->helper('menu');
        $this->configuracion = $this->config->item('conf_pagina');
        $this->login   = $this->session->userdata('login');
    }

    public function index(){
        $this->load->view('seguridad/inicio');
    }
    
    public function listar($j=0){
        $filter           = new stdClass();
        $filter->rol      = $this->session->userdata('rolusu');	
        $filter->order_by = array("m.MENU_Orden"=>"asc");
        $menu       = get_menu($filter);     
        $filter     = new stdClass();
        $filter_not = new stdClass(); 
        $filter->order_by    = array("f.COMPC_Nombre"=>"desc","e.TIPC_Nombre"=>"asc","c.PRODATRIB_Nombre"=>"asc");
        $registros = count($this->semana_model->listar($filter,$filter_not));
        $productoatrib = $this->semana_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($productoatrib)>0){
            foreach($productoatrib as $indice=>$valor){  
                $lista[$indice]               = new stdClass();
                $lista[$indice]->codigo       = $valor->PRODATRIB_Codigo;
                $lista[$indice]->producto     = "";
                $lista[$indice]->nombre       = $valor->PRODATRIB_Nombre;
                $lista[$indice]->descripcion  = $valor->PRODATRIB_Descripcion;
                $lista[$indice]->ciclo        = $valor->COMPC_Nombre;
                $lista[$indice]->tipoestudio  = $valor->TIPC_Nombre;
                $lista[$indice]->finicio      = date_sql($valor->PRODATRIB_FechaInicio);
                $lista[$indice]->ffin         = date_sql($valor->PRODATRIB_FechaFin);   
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/almacen/semana/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);        
        /*Datos para la vista*/ 
        $data['lista']      = $lista;
        $data['menu']       = $menu;  
        $data['header']          = get_header();        
        $data['registros']  = $registros;
        $data['j']          = $j;
        $data['paginacion'] = $this->pagination->create_links();        
        $this->load->view('almacen/semana_index',$data);
    }

    public function editar($accion,$codigo=""){
        $ciclo       = $this->input->get_post('ciclo'); 
        $tipoestudiociclo = $this->input->get_post('tipoestudiociclo'); 
        $nombre      = $this->input->get_post('nombre'); 
        $descripcion = $this->input->get_post('descripcion'); 
        $finicio     = $this->input->get_post('finicio'); 
        $ffin        = $this->input->get_post('ffin'); 
        $lista = new stdClass();
        if($accion == "e"){   
            $filter             = new stdClass();
            $filter->semana     = $codigo;
            $semanas            = $this->semana_model->obtener($filter);
            $lista->nombre      = $nombre!=""?$nombre:$semanas->PRODATRIB_Nombre;
            $lista->descripcion = $descripcion!=""?$descripcion:$semanas->PRODATRIB_Descripcion;
            $lista->finicio     = $finicio!=""?$finicio:date_sql($semanas->PRODATRIB_FechaInicio);
            $lista->ffin        = $ffin!=""?$ffin:date_sql($semanas->PRODATRIB_FechaFin);
            $lista->ciclo       = $ciclo!=""?$ciclo:$semanas->CICLOP_Codigo; 
            $lista->tipoestudiociclo = $tipoestudiociclo!=""?$tipoestudiociclo:$semanas->TIPCICLOP_Codigo; 
        }
        elseif($accion == "n"){
            $lista->nombre       = $nombre;
            $lista->descripcion  = $descripcion;
            $lista->finicio      = $finicio;
            $lista->ffin         = $ffin;
            $lista->ciclo        = $ciclo;
            $lista->tipoestudiociclo  = $tipoestudiociclo;
        }
        $filter           = new stdClass();
        $filter->ciclo    = $lista->ciclo;
        $oTipoCiclo       = $this->ciclo_model->obtener($filter);
        $lista->tipociclo = isset($oTipoCiclo->TIPOCICLOP_Codigo)?$oTipoCiclo->TIPOCICLOP_Codigo:"";
        $data['titulo']      = $accion=="e"?"Modificar Semana":"Nuevo Semana"; ;        
        $data['form_open']   = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"","method"=>"post","enctype"=>"multipart/form-data"));
        $data['form_close']  = form_close();
        $data['lista']	     = $lista;
        $data['selciclo']    = form_dropdown('ciclo',$this->ciclo_model->seleccionar('0'),$lista->ciclo,"id='ciclo' class='comboGrande'");
        $filter              = new stdClass();
        $filter->ciclo       = $lista->ciclo;
        $data['seltipoestudio'] = form_dropdown('tipoestudiociclo',$this->tipoestudiociclo_model->seleccionar('0',$filter),$lista->tipoestudiociclo,"id='tipoestudiociclo' class='comboGrande'");
        $data['oculto']         = form_hidden(array('accion'=>$accion,'codigo'=>$codigo));
        $this->load->view('almacen/semana_nuevo',$data);
    }  
    
    public function grabar(){
        $accion = $this->input->get_post('accion');
        $codigo = $this->input->get_post('codigo');
        $data   = array(
                        "PRODATRIB_Nombre"      => $this->input->post('nombre'),
                        "PRODATRIB_Descripcion" => $this->input->post('descripcion'),
                        "CICLOP_Codigo"         => $this->input->post('ciclo'),
                        "TIPCICLOP_Codigo"      => $this->input->post('tipoestudiociclo'),
                        "PRODATRIB_FechaInicio" => date_sql_ret($this->input->post('finicio')),
                        "PRODATRIB_FechaFin"    => date_sql_ret($this->input->post('ffin'))
                       );
        if($accion == "n"){
            $this->semana_model->insertar($data);            
        }
        elseif($accion == "e"){
            $this->semana_model->modificar($codigo,$data);
        }
    }   
    
    public function eliminar(){
        $codigo = $this->input->post('codigo');
        $filter = new stdClass();
        $filter->semana = $codigo;
        $preguntas = $this->tema_model->listar($filter);
        $resultado = false;
        if(count($preguntas)==0){
            $resultado = true;
            $this->semana_model->eliminar($codigo);
        }
        echo json_encode($resultado);
    } 
}
?>