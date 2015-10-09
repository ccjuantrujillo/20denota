<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require_once "Spreadsheet/Excel/Writer.php";
class Tema extends CI_Controller {
    var $configuracion;
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");        
        $this->load->model(almacen.'curso_model');
        $this->load->model(almacen.'cursociclo_model');
        $this->load->model(almacen.'cursotipoestudio_model');
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
        $filter->order_by    = array("e.COMPC_Nombre"=>"desc","g.TIPC_Nombre"=>"asc","h.PROD_Nombre"=>"asc","i.PRODATRIB_Nombre"=>"asc");
        $registros = count($this->tema_model->listar($filter,$filter_not));
        $temas     = $this->tema_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($temas)>0){
            foreach($temas as $indice=>$valor){  
                $lista[$indice]                 = new stdClass();
                $lista[$indice]->codigo         = $valor->PRODATRIBDET_Codigo;
                $lista[$indice]->curso          = $valor->PROD_Nombre;
                $lista[$indice]->semana         = $valor->PRODATRIB_Nombre;
                $lista[$indice]->descripcion    = $valor->TEMAC_Descripcion;
                $lista[$indice]->ciclo          = $valor->COMPC_Nombre;
                $lista[$indice]->tipoestudio    = $valor->TIPC_Nombre;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/almacen/tema/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);        
        /*Datos para la vista*/
        $data['titulo_tabla'] = "Listado de preguntas";
        $data['lista']        = $lista;
        $data['menu']         = $menu;      
        $data['registros']    = $registros;
        $data['j']            = $j;        
        $data['paginacion']   = $this->pagination->create_links();        
        $this->load->view('almacen/tema_index',$data);
    }

    public function editar($accion,$codigo=""){
        $semana      = $this->input->get_post('semana');
        $cursociclo  = $this->input->get_post('cursociclo');
        $ciclo       = $this->input->get_post('ciclo');
        $tipoestudiociclo = $this->input->get_post('tipoestudiociclo');
        $descripcion = $this->input->get_post('descripcion');
        $lista       = new stdClass();
        if($accion == "e"){
            $titulo               = "Editar Tema";      
            $filter               = new stdClass();
            $filter->tema         = $codigo;
            $temas = $this->tema_model->obtener($filter);
            $lista->descripcion  = $descripcion!=""?$descripcion:$temas->TEMAC_Descripcion;
            $lista->nombre       = $temas->PROD_Nombre;
            $lista->semana       = $semana!=""?$semana:$temas->PRODATRIB_Codigo;
            $lista->cursociclo   = $cursociclo!=""?$cursociclo:$temas->CURSOCIP_Codigo;
            echo $lista->cursociclo;
            $lista->ciclo        = $ciclo!=""?$ciclo:$temas->CICLOP_Codigo;
            $lista->tipoestudiociclo  = $tipoestudiociclo!=""?$tipoestudiociclo:$temas->TIPCICLOP_Codigo;
        }
        elseif($accion == "n"){
            $titulo              = "Nuevo Tema";            
            $lista->descripcion  = $descripcion;
            $lista->nombre       = "";
            $lista->semana       = $semana;
            $lista->cursociclo   = $cursociclo;
            $lista->ciclo        = $ciclo;
            $lista->tipoestudiociclo  = $tipoestudiociclo;
            $filter              = new stdClass();
            $filter->tipoestudiociclo = $tipoestudiociclo;
        }  
        $data['titulo']      = $titulo;        
        $data['form_open']   = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"","method"=>"post","enctype"=>"multipart/form-data"));
        $data['form_close']  = form_close();
        $data['lista']	     = $lista;
        $data['selciclo']    = form_dropdown('ciclo',$this->ciclo_model->seleccionar('0'),$lista->ciclo,"id='ciclo' class='comboGrande'");
        $filter              = new stdClass();
        $filter->order_by    = array("d.PROD_Nombre"=>"asc");
        $filter->ciclo       = $lista->ciclo;
        $data['selcursociclo']    = form_dropdown('cursociclo',$this->cursociclo_model->seleccionar('0',$filter),$lista->cursociclo,"id='cursociclo' class='comboGrande''");
        $filter              = new stdClass();
        $filter->ciclo       = $lista->ciclo;
        $data['seltipoestudio'] = form_dropdown('tipoestudiociclo',$this->tipoestudiociclo_model->seleccionar('0',$filter),$lista->tipoestudiociclo,"id='tipoestudiociclo' class='comboGrande'");        
        $filter              = new stdClass();
        $filter->tipoestudiociclo = $lista->tipoestudiociclo;
        $filter->order_by    = array("c.PRODATRIB_Nombre"=>"asc");
        $data['selsemana']   = form_dropdown('semana',$this->semana_model->seleccionar('0',$filter),$lista->semana,"id='semana' class='comboGrande'");
        $data['oculto']      = form_hidden(array('accion'=>$accion,'codigo'=>$codigo));
        $this->load->view('almacen/tema_nuevo',$data);
    }  
    
    public function grabar(){
        $accion = $this->input->get_post('accion');
        $codigo = $this->input->get_post('codigo');
        $data   = array(
                        "TEMAC_Descripcion" => ($this->input->post('descripcion')),
                        "PRODATRIB_Codigo"  => $this->input->post('semana'),
                        "TIPCICLOP_Codigo"  => $this->input->post('tipoestudiociclo'),
                        "CURSOCIP_Codigo"   => $this->input->post('cursociclo')
                       );
        if($accion == "n"){
            $this->tema_model->insertar($data);
        }
        elseif($accion == "e"){
            $this->tema_model->modificar($codigo,$data);
        }
    }   
    
    public function eliminar(){
        $codigo = $this->input->post('codigo');
        $this->tema_model->eliminar($codigo);
    } 
    
    public function obtener(){
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);
        $profesores  = $this->tema_model->listar($filter);
        $resultado = json_encode($profesores);
        echo $resultado;
    }    
}
?>