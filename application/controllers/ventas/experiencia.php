<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Experiencia extends CI_Controller {
    public function __construct(){
        parent::__construct(); 
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");           
        $this->load->model(ventas.'alumno_model');
        $this->load->model(ventas.'experiencia_model');
        $this->load->model(maestros.'persona_model');        
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
    
   public function listar($j=0){
        $filter           = new stdClass();
        $filter->rol      = $this->session->userdata('rolusu');		
        $filter->order_by = array("m.MENU_Orden"=>"asc");
        $menu       = get_menu($filter);             
        $filter     = new stdClass();
        if(isset($_SESSION["codcurso"]) && $_SESSION["codcurso"]!=0)  $filter->curso = $_SESSION["codcurso"]; 
        $filter->order_by = array("c.CICLOP_Codigo"=>"desc","e.PERSC_ApellidoPaterno"=>"asc","e.PERSC_ApellidoMaterno"=>"asc");
        $filter_not = new stdClass(); 
        $registros = count($this->asignacion_model->listar($filter,$filter_not));
        $matricula   = $this->asignacion_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($matricula)>0){
            foreach($matricula as $indice => $value){
                $lista[$indice]           = new stdClass();
                $lista[$indice]->codigo   = $value->ASIGP_Codigo;
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
		$lista[$indice]->ciclo    = $value->COMPC_Nombre;
                $lista[$indice]->estado   = $value->ASIGC_FlagEstado;
                $lista[$indice]->fecha    = $value->fecha;
                $lista[$indice]->curso    = $value->PROD_Nombre;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/ventas/orden/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']        = $lista;
        $data['menu']         = $menu;
        $data['header']       = get_header();
        $data['titulo']       = "Cargas de trabajo";
        $data['nuevo']        = "Crear una nueva carga de trabajo";
        $data['form_open']    = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));     
        $data['form_close']   = form_close();         
        $data['j']            = $j;
        $data['registros']    = $registros;
        $data['paginacion']   = $this->pagination->create_links();
        $this->load->view("ventas/asignacion_index",$data);
    }

    public function editar($accion,$codigo="",$codigodetalle=""){
        $ciclo = $this->input->get_post('ciclo'); 
        $lista = new stdClass();
        if($accion == "e"){
            $filter             = new stdClass();
            $filter->asignacion = $codigo;
            $asignacion         = $this->asignacion_model->obtener($filter);
            $lista->paterno     = $asignacion->PERSC_ApellidoPaterno;  
            $lista->materno     = $asignacion->PERSC_ApellidoMaterno;  
            $lista->nombres     = $asignacion->PERSC_Nombre;  
            $lista->fecha       = date_sql(substr($asignacion->ASIGC_Fecha,0,10));  
            $lista->profesor    = $asignacion->PROP_Codigo; 
	    $lista->curso       = $asignacion->PROD_Nombre; 
            $lista->asignacion  = $asignacion->ASIGP_Codigo;
            $lista->estado      = $asignacion->ASIGC_FlagEstado;
            $lista->ciclo       = $ciclo!=""?$ciclo:$asignacion->CICLOP_Codigo;
            $filter             = new stdClass();
            $filter->asignacion = $codigo;
            $lista->asignaciondetalle = $this->asignaciondetalle_model->listar($filter);             
        }
        elseif($accion == "n"){ 
            $lista->paterno     = "";  
            $lista->materno     = ""; 
            $lista->nombres     = "";  
            $lista->fecha       = date("d/m/Y",time());
            $lista->profesor    = ""; 
	    $lista->curso       = ""; 
            $lista->asignacion   = "";
            $lista->estado      = "1";
            $lista->ciclo       = $ciclo;
            $lista->asignaciondetalle = array();
        } 
        $arrEstado          = array("0"=>"::Seleccione::","1"=>"ACTIVO","2"=>"INACTIVO");
        $data['titulo']     = $accion=="e"?"Editar Carga de Trabajo":"Nueva Carga de Trabajo"; 
        $data['form_open']  = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));     
        $data['form_close'] = form_close();         
        $data['lista']	    = $lista;  
        $data['accion']	    = $accion;  
        $data['aula']       = array();
        $data['semana']	    = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");     
        $data['selciclo']    = form_dropdown('ciclo',$this->ciclo_model->seleccionar(),$lista->ciclo,"id='ciclo' class='comboMedio' ".($accion=="e"?"disabled":"")."");         
        $data['selestado']   = form_dropdown('estado',$arrEstado,$lista->estado,"id='estado' class='comboMedio' ".($accion=="e"?"disabled":"")."");
        $data['oculto']      = form_hidden(array("accion"=>$accion,"codigo"=>$codigo));
        $this->load->view("ventas/experiencia_nuevo",$data);
    }

    public function grabar(){
        $accion = $this->input->get_post('accion');
        $codigo = $this->input->get_post('codigo_exp');
        $data   = array(
                        "PROP_Codigo"         => $this->input->post('profesor'),
			"EXPERPC_Cargo"       => $this->input->post('cargo'),
                        "EXPERPC_Empresa"     => $this->input->post('empresa'),
                        "EXPERPC_Curso"       => $this->input->post('curso'),
                        "EXPERPC_FechaInicio" => $this->input->post('anoi')."-".$this->input->post('mesi')."-00",
                        "EXPERPC_FechaFin"    => $this->input->post('anoi')."-".$this->input->post('mesi')."-00"
                       );
        $resultado = false;
        print_r($data);
        echo $accion;
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
        $codigo = $this->input->post('codigo');
        $this->experiencia_model->eliminar($codigo);
        $resultado = true;
        echo json_encode($resultado);
    }
}
?>