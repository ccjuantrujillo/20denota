<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Persona extends CI_Controller{
    public $configuracion;    
    public $codigo;
    public function __construct()
    {
        parent::__construct(); 
        $this->load->model(maestros.'persona_model');
        $this->load->model(maestros.'ubigeo_model');
        $this->load->model(maestros.'tipodocumento_model');
        $this->load->model(maestros.'estadocivil_model');
        $this->load->model(maestros.'nacionalidad_model');
        $this->load->model(seguridad.'permiso_model');          
        $this->configuracion = $this->config->item('conf_pagina');
    }
    
    public function index(){
        $this->load->view('seguridad/inicio');	
    }
    
    public function listar($j=0){
        $filter           = new stdClass();
        $filter->codigo   = 1; 
        $filter->rol      = 4; 
        $filter->order_by = array("p.MENU_Codigo"=>"asc");
        $menu       = $this->permiso_model->listar($filter);            
        $filter     = new stdClass();
        $filter_not = new stdClass(); 
        $filter_not->persona = "0";
        $filter->order_by    = array("p.PERSC_ApellidoPaterno"=>"asc","p.PERSC_ApellidoMaterno"=>"asc","p.PERSC_Nombre"=>"asc");
        $registros = count($this->persona_model->listar($filter,$filter_not));
        $personas  = $this->persona_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($personas)>0){
            foreach($personas as $indice => $value){
                $lista[$indice]             = new stdClass();
                $lista[$indice]->numero   = $value->PERSC_NumeroDocIdentidad;
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista[$indice]->telefono = $value->PERSC_Telefono;
                $lista[$indice]->movil    = $value->PERSC_Movil;
                $lista[$indice]->codigo   = $value->PERSP_Codigo;
                $lista[$indice]->estado   = $value->PERSC_FlagEstado;
                $lista[$indice]->fechareg = $value->PERSC_FechaRegistro;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/maestros/persona/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']           = $lista;
        $data['menu']            = $menu;
        $data['j']               = $j;
        $data['registros']       = $registros;
        $data['paginacion']      = $this->pagination->create_links();
        $this->load->view("maestros/persona_index",$data);
    }

   public function editar($accion,$codigo=""){  
        $filter           = new stdClass();
        $filter->codigo   = 1; 
        $filter->rol      = 4; 
        $filter->order_by = array("p.MENU_Codigo"=>"asc");
        $menu_padre = $this->permiso_model->listar($filter); 

        $departamento      = "";
        $provincia         = "";
        $distrito          = ""; 
            
        $lista = new stdClass();
        if($accion == "e"){
            $filter            = new stdClass();
            $filter->persona   = $codigo;
            $personas          = $this->persona_model->obtener($filter);
            $ubigeo_domicilio  = $personas->UBIGP_Domicilio;
            $departamento      = substr($ubigeo_domicilio,0,2);
            $provincia         = substr($ubigeo_domicilio,2,2);
            $distrito          = substr($ubigeo_domicilio,4,2); 
            $lista->numerodoc  = $personas->PERSC_NumeroDocIdentidad;
            $lista->ruc        = $personas->PERSC_Ruc;
            $lista->sexo       = $personas->PERSC_Sexo;  
            $lista->direccion  = $personas->PERSC_Direccion;    
            $lista->telefono   = $personas->PERSC_Telefono;    
            $lista->email      = $personas->PERSC_Email;    
            $lista->movil      = $personas->PERSC_Movil;    
            $lista->fax        = $personas->PERSC_Fax;    
            $lista->web        = $personas->PERSC_Web;    
            $lista->ecivil     = $personas->ESTCP_EstadoCivil;    
            $lista->nacion     = $personas->NACP_Nacionalidad;    
            $lista->ecivil     = $personas->ESTCP_EstadoCivil;    
            $lista->ubinac     = $personas->UBIGP_LugarNacimiento;    
            $lista->ubidom     = $personas->UBIGP_Domicilio;    
            $lista->fnac       = $personas->PERSC_FechaNacimiento;  
            $lista->paterno    = $personas->PERSC_ApellidoPaterno;  
            $lista->materno    = $personas->PERSC_ApellidoMaterno;  
            $lista->nombres    = $personas->PERSC_Nombre;  
            $lista->codigo     = $personas->PERSP_Codigo;  
            $lista->tipodoc    = $personas->PERSC_TipoDocIdentidad;  
        }
        elseif($accion == "n"){
            $lista->tipodoc    = 0;
            $lista->numerodoc  = "";
            $lista->ruc        = "";
            $lista->sexo       = "";  
            $lista->direccion  = "";    
            $lista->telefono   = "";    
            $lista->email      = "";    
            $lista->movil      = "";    
            $lista->fax        = "";    
            $lista->web        = "";    
            $lista->ecivil     = 0;    
            $lista->nacion     = 0;    
            $lista->ecivil     = 0;    
            $lista->ubinac     = "000000";    
            $lista->ubidom     = "000000"; 
            $lista->fnac       = "";  
            $lista->paterno    = "";  
            $lista->materno    = ""; 
            $lista->nombres    = "";  
            $lista->sexo       = 0;  
            $lista->codigo     = "";  
        } 
        $filter            = new stdClass();
        $filter->ubigeo    = $lista->ubinac;
        $selnacimieno      = form_dropdown('nacimiento',$this->ubigeo_model->seleccionar('',$filter),"","id='nacimiento' class='comboMedio'"); 
        $filter            = new stdClass();
        $filter->provincia = "00";
        $filter->distrito  = "00";
        $seldpto           = form_dropdown('departamento',$this->ubigeo_model->seleccionar('',$filter),$departamento."0000","id='departamento' class='comboMedio'"); 
        $filter            = new stdClass();
        $filter->departamento = $departamento;
        $filter->distrito  = "00";
        $selprov           = form_dropdown('provincia',$this->ubigeo_model->seleccionar('',$filter),$departamento.$provincia."00","id='provincia' class='comboMedio'"); 
        $filter            = new stdClass();
        $filter->departamento = $departamento;
        $filter->provincia = $provincia;
        $seldist              = form_dropdown('distrito',$this->ubigeo_model->seleccionar('',$filter),$departamento.$provincia.$distrito,"id='distrito' class='comboMedio'"); 
        $arrSexo              = array("0"=>"::Seleccione::","1"=>"MASCULINO","2"=>"FEMENINO");
        $data['titulo']       = "EDITAR PERSONA"; 
        $data['menu']         = $menu_padre;
        $data['form_open']    = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));     
        $data['form_close']   = form_close();         
        $data['lista']	      = $lista;  
        $data['seltipodoc']   = form_dropdown('tipodoc',$this->tipodocumento_model->seleccionar(),$lista->tipodoc,"id='tipodoc' class='comboMedio'"); ;
        $data['selestadoc']   = form_dropdown('estadocivil',$this->estadocivil_model->seleccionar(),$lista->ecivil,"id='estadocivil' class='comboMedio'");
        $data['selnacion']    = form_dropdown('nacionalidad',$this->nacionalidad_model->seleccionar(),$lista->fnac,"id='nacinalidad' class='comboMedio'");
        $data['selnacimieno'] = $selnacimieno;
        $data['seldpto']      = $seldpto;
        $data['selprov']      = $selprov;        
        $data['seldist']      = $seldist;      
        $data['selsexo']      = form_dropdown('sexo',$arrSexo,$lista->sexo,"id='sexo' class='comboMedio'");
        $data['oculto']       = form_hidden(array("accion"=>$accion,"codigo"=>$codigo));
	$this->load->view("maestros/persona_nuevo",$data);
    }
    
    public function grabar(){  
        $accion      = $this->input->get_post('accion');
        $codigo      = $this->input->get_post('codigo');
        $nacimiento  = $this->input->get_post('distrito');
        $domicilio   = $this->input->get_post('distrito');
        $nacion      = $this->input->get_post('nacionalidad');
        $tipodoc     = $this->input->get_post('tipodoc');
        $arrfnacimiento = explode("/",trim($this->input->post('fnacimiento')));
        $fnacimiento = $arrfnacimiento[2]."-".$arrfnacimiento[1]."-".$arrfnacimiento[0];
        $data   = array(
                        "PERSC_Nombre"             => strtoupper($this->input->post('nombres')),
                        "PERSC_ApellidoPaterno"    => strtoupper($this->input->post('paterno')),
                        "PERSC_ApellidoMaterno"    => strtoupper($this->input->post('materno')),
                        "PERSC_NumeroDocIdentidad" => $this->input->post('numero'),
                        "PERSC_Direccion"          => strtoupper($this->input->post('direccion')),
                        "PERSC_Telefono"           => $this->input->post('telefono'),
                        "PERSC_Movil"              => $this->input->post('movil'),
                        "PERSC_Email"              => strtolower($this->input->post('email')),
                        "PERSC_Domicilio"          => strtoupper($this->input->post('direccion')),
                        "PERSC_Sexo"               => $this->input->post('cboSexo'),
                        "PERSC_Fax"                => $this->input->post('fax'),
                        "PERSC_Web"                => $this->input->post('web'),
                        "PERSC_Sexo"               => $this->input->post('sexo'),
                        "PERSC_FechaNacimiento"    => ($fnacimiento!=""?$fnacimiento:"")
                       );
        if($accion == "n"){
            $this->codigo = $this->persona_model->insertar($data);            
        }
        elseif($accion == "e"){
            $this->persona_model->modificar($codigo,$data);     
            $this->codigo = $codigo;
        }
    }

    public function eliminar(){
        $codigo = $this->input->post('codigo');
        $this->persona_model->eliminar($codigo);
    }

    public function ver($codigo){
        $CI = & get_instance();
        $CI->pdf->AliasNbPages();
        $CI->pdf->AddPage();
        $CI->pdf->SetTextColor(0,0,0);
        $CI->pdf->SetFillColor(0,0,255);
        $CI->pdf->Image('img/mimco_ruc.jpg',10,8,55); 
        $CI->pdf->SetFont('Arial','B',16);
        $CI->pdf->Cell(180,12,"EDITAR PERSONA",0,1,"C",0);
        $CI->pdf->SetFont('Arial','',9);
        $CI->pdf->Cell(50,8,"Hora:08:00",0,1,"R",0);
        $CI->pdf->Cell(18,3,"MES",1,0,"L",0);
        $CI->pdf->Cell(18,3,"NRO OT",1,0,"R",0);
        $CI->pdf->Cell(18,3,"CLIENTE",1,0,"R",0);
        $CI->pdf->Cell(18,3,"SITE",1,0,"R",0);
        $CI->pdf->Cell(18,3,"F.APERTURA",1,0,"R",0);
        $CI->pdf->Cell(18,3,"F.FIN",1,0,"R",0);

        $CI->pdf->Output();        
    }
}
?>