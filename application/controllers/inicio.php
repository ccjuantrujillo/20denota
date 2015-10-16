<?php header("Content-type: text/html; charset=utf-8"); 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Inicio extends CI_Controller {
    var $entidad;
    public function __construct(){
        parent::__construct(); 
        $this->load->model(seguridad.'usuario_model');
        $this->load->model(personal.'persona_model');    
        $this->load->model(seguridad.'permiso_model');  
        $this->load->model(seguridad.'menu_model');
        $this->load->model(maestros.'ciclo_model');
        $this->load->model(ventas.'profesor_model');
        $this->load->helper('menu');
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
        if($this->form_validation->run() == FALSE){
            redirect('inicio/index');
        }
        else{
            $txtUsuario = $this->input->post('txtUsuario');
            $txtClave   = $this->input->post('txtClave');
            $usuarios   = $this->usuario_model->ingresar(trim($txtUsuario),md5(trim($txtClave)));
            if(count((array)$usuarios)>0){
                $data = array(
                            'nomper'   => $usuarios->PERSC_Nombre." ".$usuarios->PERSC_ApellidoPaterno,
                            'login'    => $usuarios->USUA_usuario,
                            'codusu'   => $usuarios->USUA_Codigo,
                            'rolusu'   => $usuarios->ROL_Codigo,
                            'codper'   => $usuarios->PERSP_Codigo,
                            'estado'   => $usuarios->USUA_FlagEstado
                             );
                $filter = new stdClass();
                $filter->persona = $usuarios->PERSP_Codigo;
                $objProfesor = $this->profesor_model->obtener($filter);
                $data["codprofesor"] = 0;
                $data["codcurso"]    = 0;
                if(isset($objProfesor->PROP_Codigo)){
                    $data["codprofesor"] = $objProfesor->PROP_Codigo;
                    $data["codcurso"]    = $objProfesor->PROD_Codigo;
                }
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
        $rolusu        = $this->session->userdata('rolusu');
        $filter           = new stdClass();
        $filter->rol      = $rolusu; 
        $filter->order_by = array("m.MENU_Orden"=>"asc");
        $menu             = get_menu($filter);
        $total = 0;
        $data['fecha']  = $fecha;
        $data['menu']   = $menu;
        $data['header'] = get_header();
        $data['oculto'] = form_hidden(array("serie"=>"","numero"=>"","codot"=>""));
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