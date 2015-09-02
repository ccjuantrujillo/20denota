<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//require_once "Spreadsheet/Excel/Writer.php";
class Tema extends CI_Controller {
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
        $filter->order_by    = array("e.PROD_Nombre"=>"asc");
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
                $lista[$indice]->descripcion    = $valor->PRODATRIBDET_Descripcion;
                $lista[$indice]->numero         = $valor->PRODATRIBDET_Numero;
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
        $semana   = $this->input->get_post('semana');
        $curso    = $this->input->get_post('curso');
        $ciclo    = $this->input->get_post('ciclo');
        $tipoestudio = $this->input->get_post('tipoestudio');
        $descripcion = $this->input->get_post('descripcion');
        $lista    = new stdClass();
        if($accion == "e"){
            $titulo               = "Editar Tema";      
            $filter               = new stdClass();
            $filter->tema         = $codigo;
            $temas = $this->tema_model->obtener($filter);
            $lista->numero       = $temas->PRODATRIBDET_Numero;
            $lista->descripcion  = $descripcion!=""?$descripcion:$temas->PRODATRIBDET_Descripcion;
            $lista->nombre       = $temas->PROD_Nombre;
            $lista->semana       = $temas->PRODATRIB_Codigo;
            $lista->curso        = $temas->PROD_Codigo;
            $lista->ciclo        = $ciclo!=""?$ciclo:$temas->CICLOP_Codigo;
            $lista->tipoestudio  = $tipoestudio!=""?$tipoestudio:$temas->TIPP_Codigo;
        }
        elseif($accion == "n"){
            $titulo              = "Nuevo Tema";            
            $lista->descripcion  = $descripcion;
            $lista->nombre       = "";
            $lista->semana       = $semana;
            $lista->curso        = $curso;
            $lista->numero       = "";
            $lista->ciclo        = $ciclo;
            $lista->tipoestudio  = $tipoestudio;
        }
        $filter              = new stdClass();
        $filter->ciclo       = $lista->ciclo;        
        $objCiclo            = $this->ciclo_model->obtener($filter);
        $lista->tipociclo    = isset($objCiclo->TIPOCICLOP_Codigo)?$objCiclo->TIPOCICLOP_Codigo:"";        
        $data['titulo']      = $titulo;        
        $data['form_open']   = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"","method"=>"post","enctype"=>"multipart/form-data"));
        $data['form_close']  = form_close();
        $data['lista']	     = $lista;
        $data['selciclo']    = form_dropdown('ciclo',$this->ciclo_model->seleccionar('0'),$lista->ciclo,"id='ciclo' class='comboGrande'");
        $filter              = new stdClass();
        $filter->tipociclo   = $lista->tipociclo;
        $data['seltipoestudio'] = form_dropdown('tipoestudio',$this->tipoestudio_model->seleccionar('0',$filter),$lista->tipoestudio,"id='tipoestudio' class='comboGrande'");
        $filter              = new stdClass();
        $filter->order_by    = array("p.PROD_Nombre"=>"asc");
        $data['selcurso']    = form_dropdown('curso',$this->curso_model->seleccionar('0',$filter),$lista->curso,"id='curso' class='comboGrande''");
        $filter              = new stdClass();
        $filter->ciclo       = $lista->ciclo;
        $filter->tipoestudio = $lista->tipoestudio;
        $filter->order_by    = array("c.PRODATRIB_Nombre"=>"asc");
        $data['selsemana']   = form_dropdown('semana',$this->semana_model->seleccionar('0',$filter),$lista->semana,"id='semana' class='comboGrande'");
        $data['oculto']      = form_hidden(array('accion'=>$accion,'codigo'=>$codigo));
        $this->load->view('almacen/tema_nuevo',$data);
    }  
    
    public function grabar(){
        $accion = $this->input->get_post('accion');
        $codigo = $this->input->get_post('codigo');
        $data   = array(
                        "PRODATRIBDET_Numero"      => ($this->input->post('numero')),
                        "PRODATRIBDET_Descripcion" => ($this->input->post('descripcion')),
                        "PRODATRIB_Codigo"         => $this->input->post('semana'),
                        "CICLOP_Codigo"            => $this->input->post('ciclo'),
                        "PROD_Codigo"              => $this->input->post('curso')
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
}
?>