<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'controllers/maestros/persona.php';
class Usuario extends Persona{
    var $configuracion;       
    public function __construct(){
        parent::__construct();
        $this->load->model(seguridad.'usuario_model');          
        $this->load->model(seguridad.'rol_model');   
        $this->load->model(maestros.'persona_model');     
        $this->load->helper('menu');
        $this->configuracion = $this->config->item('conf_pagina');
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
        $filter_not  = new stdClass();
        $filter->order_by    = array("d.PERSC_ApellidoPaterno"=>"asc","d.PERSC_ApellidoMaterno"=>"asc","d.PERSC_Nombre"=>"asc");
        $registros = count($this->usuario_model->listar($filter));
        $usuarios  = $this->usuario_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($usuarios)>0){
            foreach($usuarios as $indice => $value){
                $filter                   = new stdClass();
                $filter->rol              = $value->ROL_Codigo;
                $roles                    = $this->rol_model->obtener($filter);
                $lista[$indice]           = new stdClass();
                $lista[$indice]->codigo   = $value->USUA_Codigo;
                $lista[$indice]->login    = $value->USUA_usuario;
                $lista[$indice]->rol      = $roles->ROL_Descripcion;
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista[$indice]->estado   = $value->USUA_FlagEstado;
                $lista[$indice]->fechareg = $value->USUA_FechaRegistro;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/seguridad/usuario/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']     = $lista;
        $data['titulo_tabla']    = "RELACIÓN DE USUARIOS";      
        $data['titulo_busqueda'] = "BUSCAR USUARIO";
         $data['menu']            = $menu;
        $data['header']          = get_header();         
        $data['registros']       = $registros;
        $data['form_open']       = form_open('',array("name"=>"form1","id"=>"form1","onsubmit"=>"return valida_guiain();"));     
        $data['form_close']      = form_close();
        $data['paginacion']      = $this->pagination->create_links();
        $this->load->view("seguridad/usuario_index",$data);        
    }

    public function editar($accion,$codigo=""){
        $lista = new stdClass();
        if($accion == "e"){
            $filter             = new stdClass();
            $filter->usuario    = $codigo;
            $usuario            = $this->usuario_model->obtener($filter);
            $lista->login       = $usuario->USUA_usuario;
            $lista->clave       = $usuario->USUA_Password;
            $lista->rol         = $usuario->ROL_Codigo;
            $lista->persona     = $usuario->PERSP_Codigo;
            $lista->nombres     = $usuario->PERSC_Nombre;
            $lista->paterno     = $usuario->PERSC_ApellidoPaterno;
            $lista->materno     = $usuario->PERSC_ApellidoMaterno;
            $lista->numero      = $usuario->PERSC_NumeroDocIdentidad;
            $lista->estado      = $usuario->USUA_FlagEstado;
            $lista->usuario     = $usuario->USUA_Codigo;
        }    
        elseif($accion == "n"){
            $lista->login     = "";
            $lista->clave     = "";
            $lista->rol       = ""; 
            $lista->persona   = "";
            $lista->nombres   = ""; 
            $lista->paterno   = ""; 
            $lista->materno   = ""; 
            $lista->numero    = ""; 
            $lista->estado    = 1;
            $lista->usuario   = "";
        }
        $arrEstado          = array("0"=>"::Seleccione::","1"=>"ACTIVO","2"=>"INACTIVO");
        $data['titulo']     = "EDITAR USUARIO";        
        $data['form_open']  = form_open('',array("name"=>"form1","id"=>"form1"));
        $data['form_close'] = form_close();
        $data['lista']	    = $lista;
        $data['accion']	    = $accion;  
        $data['onload']     = "onload=\"$('#paterno').focus();\"";   
        $data['selestado']  = form_dropdown('estado',$arrEstado,$lista->estado,"id='estado' class='comboMedio'");
        $filter             = new stdClass();
        $filter->order_by   = array("p.PROD_Nombre"=>"asc");
        $data['selrol']     = form_dropdown('rol',$this->rol_model->seleccionar('0'),$lista->rol,"id='rol' class='comboMedio'");        
        $data['oculto']     = form_hidden(array('accion'=>$accion,'codigo_padre'=>$codigo,'codigo'=>$lista->persona,'flgcoordinador'=>1));
        $this->load->view('seguridad/usuario_nuevo',$data);
    }

    public function grabar(){
        parent::grabar();
        $accion = $this->input->get_post('accion');
        $codigo_padre  = $this->input->get_post('codigo_padre');
        $clave  = trim($this->input->post('clave'));
        $data   = array(
                        "PERSP_Codigo"    => $this->codigo,
                        "ROL_Codigo"      => $this->input->post('rol'),
                        "USUA_usuario"    => $this->input->post('login'),
                        "USUA_FlagEstado" => $this->input->post('estado'),
                        "USUA_Password"   => $clave!=""?md5($clave):""
                       );
        if($accion == "n")
            $this->usuario_model->insertar($data);            
        elseif($accion == "e")
            $this->usuario_model->modificar($codigo_padre,$data);            
        echo json_encode(true);
    }

    public function eliminar(){
        $codigo = $this->input->post('codigo');
        $filter = new stdClass();
        $filter->usuario = $codigo;
        $usuarios = $this->usuario_model->obtener($filter);
        $filter = new stdClass();
        $filter->rol = $usuarios->ROL_Codigo;
        $resultado   = true;
        $this->usuario_model->eliminar($codigo);
        echo json_encode($resultado);
    }

    public function ver(){

    }

    public function buscar(){

    }
}