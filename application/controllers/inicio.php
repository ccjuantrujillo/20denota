<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {
    var $entidad;
    public function __construct(){
        parent::__construct(); 
        $this->load->model(seguridad.'usuario_model');
        $this->load->model(personal.'persona_model');    
        $this->load->model(seguridad.'permiso_model');  
        $this->load->model(seguridad.'menu_model');
        $this->load->model(maestros.'ciclo_model');
    }

    public function index(){
        $data['form_open']  = form_open(base_url().'index.php/inicio/ingresar',array("name"=>"frmInicio","id"=>"frmInicio"));
        $data['form_close'] = form_close(); 
        $data['onload']     = "onload=\"$('#txtUsuario').focus();\"";   
        $this->load->view("inicio",$data);
    }
    
    public function ingresar(){
        $this->form_validation->set_rules('txtUsuario','Nombre Usuario','required|max_length[20]');
        $this->form_validation->set_rules('txtClave','Clave de Usuario','required|max_length[15]');
        $this->form_validation->set_rules('compania','Compania','required');  
        if($this->form_validation->run() == FALSE){
            redirect('inicio/index');
        }
        else{
            $txtUsuario = $this->input->post('txtUsuario');
            $txtClave   = $this->input->post('txtClave');
            $compania   = $this->input->post('compania');
            $usuarios   = $this->usuario_model->ingresar(trim($txtUsuario),md5(trim($txtClave)),$compania);
            if(count((array)$usuarios)>0){
                $data = array(
                            'nomper'   => $usuarios->PERSC_Nombre." ".$usuarios->PERSC_ApellidoPaterno,
                            'login'    => $usuarios->USUA_usuario,
                            'compania' => $usuarios->CICLOP_Codigo,
                            'codusu'   => $usuarios->USUA_Codigo,
                            'rolusu'   => $usuarios->ROL_Codigo,
							'codper'   => $usuarios->PERSP_Codigo
                             );
                $this->session->set_userdata($data);
                redirect("inicio/principal");                
            }
            else{
                $msgError = "<br><div align='center' class='error'>Usuario y/o contrasena no valido para esta empresa.</div>";
                echo $msgError;
                $this->index();
            }
        }
    }
    
    public function principal(){
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");                
        $arrmes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $mes    = date("m",time());
        $ano    = date("Y",time());
        $dia    = date("d",time());
        $ver    = "";
        $fecha  = $dia." DE ".strtoupper($arrmes[$mes-1])." DE ".$ano;
        $fecha_std = $dia."/".$mes."/".$ano;
        $fecha_red = $dia.$mes.$ano;
        $nombreusuario = $this->session->userdata('nomper');
        $codusu        = $this->session->userdata('codusu');
        $compania      = $this->session->userdata('compania');
        $rolusu        = $this->session->userdata('rolusu');
        //Menu
        $filamenu = "<ul class='glossymenu' id='menu'>";
        $filter           = new stdClass();
        //$filter->codigo   = 1; 
        $filter->rol      = $rolusu; 
        $filter->order_by = array("p.MENU_Codigo"=>"asc");
        $menu_padre = $this->permiso_model->listar($filter);
        foreach($menu_padre as $indice=>$value){
            $filamenu.="<li class='glossymenutitle'><a target=_blank href=".base_url().$value->MENU_Url.">" .$value->MENU_Descripcion. "</a>";
            $filamenu.="<ul>";
            $filter = new stdClass();
            $filter->codigo   = $value->MENU_Codigo;
            $filter->rol      = $rolusu; 
            $filter->order_by = array("p.MENU_Codigo"=>"asc");
            $menu_hijo = $this->permiso_model->listar($filter);
            if(count($menu_hijo)>0){
                foreach($menu_hijo as $indice2=>$value2){
                    $filamenu.="<li><a target=_blank href=" .base_url().$value2->MENU_Url. ">" .$value2->MENU_Descripcion. "</a></li>";
                } 
            }
            $filamenu.="</ul>";
            $filamenu.="</li>";
        }
        $filamenu.="<li class='glossymenutitle'><a href='".base_url()."index.php/inicio/salir'>Salir</a></li>";
        $filamenu.="</ul>";
        $rpta  = "";
        $total = 0;
        $data['fecha'] = $fecha;
        $data['filamenu']      = $filamenu;
        $data['menu']          = $menu_padre;
        $data['registros']     = count($menu_padre);
        $data['oculto']        = form_hidden(array("serie"=>"","numero"=>"","codot"=>""));
        $this->load->view("seguridad/principal",$data);
    }
    
    public function salir(){
        session_destroy();
        redirect('inicio/index');
    }
    
    public function contrasena_mensaje(){
        $data['form_open']  = form_open('',array("name"=>"frmContrasena","id"=>"frmContrasena"));
        $data['form_close'] = form_close();         
        $this->load->view("seguridad/contrasena_nuevo",$data);
    }
    
    public function contrasena_enviar(){
        $correo = $this->input->get_post('correo');
        return $correo;
    }    
}