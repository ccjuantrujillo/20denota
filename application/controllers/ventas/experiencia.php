<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Experiencia extends CI_Controller {
    public function __construct(){
        parent::__construct(); 
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");           
        $this->load->model(ventas.'alumno_model');
        $this->load->model(ventas.'experiencia_model');
        $this->load->model(maestros.'persona_model');        
        $this->load->model(maestros.'universidad_model');        
        $this->load->model(maestros.'grado_model');        
        $this->load->model(seguridad.'permiso_model');          
        $this->load->model(maestros.'local_model'); 
        $this->load->helper('menu');
        $this->configuracion = $this->config->item('conf_pagina');
        $this->login   = $this->session->userdata('login');
    }
    
    public function index()
    {
        $this->load->view('seguridad/inicio');	
    }
    
   public function listar($codigo){
          $lista = new stdClass();
         $filter = new stdClass();
         $filter->profesor = $codigo;
         $lista->experiencia  = $this->experiencia_model->listar($filter);  
         $lista->profesor  = $codigo;
         $arrMes             = array("00"=>"Mes","01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Setiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
         $arrAno[0]="Año";
         for($i=1950;$i<=2020;$i++)  $arrAno[$i]=$i;
         $data['arrmes']     = $arrMes;         
         $data['lista']      = $lista;
         $this->load->view("ventas/experiencia_index",$data);
    }

    public function editar($accion,$codigo="",$codigodetalle=""){
         $lista = new stdClass();
         $data  = array();
         if($accion == "e"){
             $filter = new stdClass();
             $filter->experiencia = $codigo;
             $experienciaprofesor = $this->experiencia_model->obtener($filter); 
             $lista->universidad  = $experienciaprofesor->UNIVP_Codigo;
             $lista->cargo        = $experienciaprofesor->EXPERPC_Cargo;
             $lista->curso        = $experienciaprofesor->EXPERPC_Curso;
             $arrFechai           = explode("-",$experienciaprofesor->EXPERPC_FechaInicio);
             $arrFechaf           = explode("-",$experienciaprofesor->EXPERPC_FechaFin);
             $lista->mesi         = $arrFechai[1];
             $lista->anoi         = $arrFechai[0];
             $lista->mesf         = $arrFechaf[1];
             $lista->anof         = $arrFechaf[0];             
         }
         elseif($accion == "n"){
             $lista->universidad  = 0;  
             $lista->cargo        = ""; 
             $lista->curso        = ""; 
             $lista->mesi         = ""; 
             $lista->anoi         = ""; 
             $lista->mesf         = ""; 
             $lista->anof         = ""; 
         }
         $arrMes             = array("00"=>"Mes","01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Setiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
         $arrAno[0]="Año";
         for($i=1950;$i<=2020;$i++)  $arrAno[$i]=$i;
         $data['arrmes']     = $arrMes;
         $data['selmesi']    = form_dropdown('mesi',$arrMes,$lista->mesi,"id='mesi' class='comboMedio'");
         $data['selmesf']    = form_dropdown('mesf',$arrMes,$lista->mesf,"id='mesf' class='comboMedio'");
         $data['selanoi']    = form_dropdown('anoi',$arrAno,$lista->anoi,"id='anoi' class='comboMedio'");
         $data['selanof']    = form_dropdown('anof',$arrAno,$lista->anof,"id='anof' class='comboMedio'");         
         $data['lista']      = $lista;
         $data['oculto_det']     = form_hidden(array("accion_det"=>$accion,"codigo_det"=>$codigo));
         $data['seluniversidad'] = form_dropdown('universidad',$this->universidad_model->seleccionar('0'),$lista->universidad,"id='universidad' class='comboGrande'");
         $this->load->view("ventas/experiencia_nuevo",$data);
    }

    public function grabar(){
        $accion = $this->input->get_post('accion_det');
        $codigo = $this->input->get_post('codigo_det');
        $data   = array(
                        "PROP_Codigo"         => $this->input->post('profesor'),
                        "UNIVP_Codigo"        => $this->input->post('universidad'),
			"EXPERPC_Cargo"       => $this->input->post('cargo'),
                        "EXPERPC_Empresa"     => $this->input->post('empresa'),
                        "EXPERPC_Curso"       => $this->input->post('curso'),
                        "EXPERPC_FechaInicio" => $this->input->post('anoi')."-".$this->input->post('mesi')."-00",
                        "EXPERPC_FechaFin"    => $this->input->post('anof')."-".$this->input->post('mesf')."-00"
                       );
        $resultado = false;
        if($accion == "n"){
            $resultado = true;            
            $codigo = $this->experiencia_model->insertar($data); 
        }
        elseif($accion == "e"){
            $resultado = true;            
            $this->experiencia_model->modificar($codigo,$data);
        }                    
        echo json_encode($resultado);
    }
	
    public function eliminar(){
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);        
        $this->experiencia_model->eliminar($filter);
        $resultado = true;
        echo json_encode($resultado);
    }
}
?>