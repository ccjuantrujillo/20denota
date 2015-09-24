<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actaprofesor extends CI_Controller {
    public function __construct(){
        parent::__construct(); 
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");           
        $this->load->model(ventas.'acta_model');
        $this->load->model(ventas.'actadetalle_model');
        $this->load->model(ventas.'profesor_model');
        $this->load->model(ventas.'actaprofesor_model');
        $this->load->helper('menu');
        $this->configuracion = $this->config->item('conf_pagina');
        $this->login   = $this->session->userdata('login');
    }
    
    public function editartodos($curso=0,$acta=0){
        $filter     = new stdClass();
        $filter->curso = $curso;
        $filter->acta  = $acta;
        $filter->order_by    = array("f.PERSC_ApellidoPaterno"=>"asc","f.PERSC_ApellidoMaterno"=>"asc","f.PERSC_Nombre"=>"asc");
        $actaprofesores = $this->actaprofesor_model->listar($filter);
        $item       = 1;
        $lista      = array();
        if(count($actaprofesores)>0){
            foreach($actaprofesores as $indice => $value){
                $lista[$indice]             = new stdClass();
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista[$indice]->codigo   = $value->ACTAPROFP_Codigo;
                $lista[$indice]->profesor = $value->codprofesor;
                $lista[$indice]->hingreso = $value->ACTAPROFC_Hingreso;
                $lista[$indice]->hsalida  = $value->ACTAPROFC_Hsalida;
                $lista[$indice]->observacion = $value->ACTAPROFC_Observacion;
                $lista[$indice]->curso    = $value->PROD_Nombre;
            }
        }
        $data['titulo']       = "Asistencia de profesores"; 
        $data['form_open']    = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));     
        $data['form_close']   = form_close(); 
        $data['lista']        = $lista;
        $data['oculto']       = form_hidden(array("codigoreferencia"=>$acta));
        $this->load->view("ventas/actaprofesor_nuevo",$data);
    } 
    
    public function grabar(){
        $codigo    = $this->input->get_post('codigo');
        $codigoref = $this->input->get_post('codigoreferencia');
        $profesor  = $this->input->get_post('profesor');
        $hingreso  = $this->input->get_post('hingreso');
        $hsalida   = $this->input->get_post('hsalida');
        $observacion = $this->input->get_post('observacion');
        if(count($codigo)>0){
            $resultado = false;
            foreach ($codigo as $item=>$value){
                $data   = array(
                                "ACTAPROFP_Codigo"      => $codigo[$item],
                                "PROP_Codigo"           => $profesor[$item],
                                "ACTAP_Codigo"          => $codigoref,
                                "ACTAPROFC_Hingreso"    => $hingreso[$item],
                                "ACTAPROFC_Hsalida"     => $hsalida[$item],
                                "ACTAPROFC_Observacion" => $observacion[$item]
                               );
                if($codigo[$item]==""){//Nuevo
                    $this->actaprofesor_model->insertar($data);    
                    $resultado = true;
                }
                else{//Editar
                    unset($data['ACTAPROFP_Codigo']);
                    $this->actaprofesor_model->modificar($codigo[$item],$data);                                
                    $resultado = true; 
                }
            }
            echo json_encode($resultado);
        }
    }
}
?>