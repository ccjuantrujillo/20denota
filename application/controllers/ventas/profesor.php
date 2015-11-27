<?php header("Content-type: text/html; charset=utf-8");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'controllers/maestros/persona.php';
class Profesor extends Persona
{
    public function __construct(){
        parent::__construct();
        $this->load->model(ventas.'matricula_model');
        $this->load->model(ventas.'profesor_model');
        $this->load->model(ventas.'estudios_model');
        $this->load->model(ventas.'estudiosidiomas_model');
        $this->load->model(ventas.'experiencia_model');
        $this->load->model(ventas.'conferencia_model');
        $this->load->model(ventas.'trabajo_model');
        $this->load->model(ventas.'profesorsociedad_model');
        $this->load->model(seguridad.'rol_model');
        $this->load->model(almacen.'curso_model');
        $this->load->model(maestros.'tipodocumento_model');
        $this->load->model(maestros.'grado_model');
        $this->load->model(maestros.'universidad_model');
        $this->load->helper('menu');
        $this->load->helper('profesor');
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
        if(isset($_SESSION["codcurso"]) && $_SESSION["codcurso"]!=0)  $filter->curso = $_SESSION["codcurso"];
        $filter->borrado = 1;
        $filter_not = new stdClass();
        $filter_not->profesor = "0";
        $filter->order_by    = array("d.PERSC_ApellidoPaterno"=>"asc","d.PERSC_ApellidoMaterno"=>"asc","d.PERSC_Nombre"=>"asc");
        $registros = count($this->profesor_model->listar($filter,$filter_not));
        $profesores  = $this->profesor_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($profesores)>0){
            foreach($profesores as $indice => $value){
                $lista[$indice]             = new stdClass();
                $lista[$indice]->numero   = $value->PERSC_NumeroDocIdentidad;
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista[$indice]->telefono = $value->PERSC_Telefono;
                $lista[$indice]->movil    = $value->PERSC_Movil;
                $lista[$indice]->codigo   = $value->PROP_Codigo;
                $lista[$indice]->estado   = $value->PROC_FlagEstado;
                $lista[$indice]->curso    = $value->PROD_Nombre;
                $lista[$indice]->fechareg = $value->fechareg;
                $lista[$indice]->coordinador = $value->PROC_FlagCoordinador;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/ventas/profesor/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']           = $lista;
        $data['menu']            = $menu;
        $data['header']          = get_header();
        $data['j']               = $j;
        $data['registros']       = $registros;
        $data['paginacion']      = $this->pagination->create_links();
        $this->load->view("ventas/profesor_index",$data);
    }

    public function editar($accion,$codigo=""){
         $lista = new stdClass();
         if($accion == "e"){
             $filter            = new stdClass();
             $filter->profesor  = $codigo;
             $profesores        = $this->profesor_model->obtener($filter);
             $lista->numerodoc  = $profesores->PERSC_NumeroDocIdentidad;
             $lista->sexo       = $profesores->PERSC_Sexo;
             $lista->direccion  = $profesores->PERSC_Direccion;
             $lista->telefono   = $profesores->PERSC_Telefono;
             $lista->email      = $profesores->PERSC_Email;
             $lista->movil      = $profesores->PERSC_Movil;
             $lista->fax        = $profesores->PERSC_Fax;
             $lista->web        = $profesores->PERSC_Web;
             $lista->fnac       = date_sql($profesores->PERSC_FechaNacimiento);
             $lista->paterno    = $profesores->PERSC_ApellidoPaterno;
             $lista->materno    = $profesores->PERSC_ApellidoMaterno;
             $lista->nombres    = $profesores->PERSC_Nombre;
             $lista->codigo     = $codigo;
             $lista->codigo_padre = $profesores->PERSP_Codigo;
             $lista->estado     = $profesores->PROC_FlagEstado;
             $lista->curso      = $profesores->PROD_Codigo;
             $lista->tipodoc    = $profesores->TIPDOCP_Codigo; 
             $lista->coordinador = $profesores->PROC_FlagCoordinador;        
         }
         elseif($accion == "n"){
             $lista->numerodoc  = "";
             $lista->sexo       = "";
             $lista->direccion  = "";
             $lista->telefono   = "";
             $lista->email      = "";
             $lista->movil      = "";
             $lista->fax        = "";
             $lista->web        = "";
             $lista->ecivil     = 0;
             $lista->fnac       = "";
             $lista->paterno    = "";
             $lista->materno    = "";
             $lista->nombres    = "";
             $lista->sexo       = 0;
             $lista->codigo     = "";
             $lista->codigo_padre = "";
             $lista->estado     = 1;
             $lista->curso      = 1;
             $lista->tipodoc    = 1;  
             $lista->coordinador= 2;  
         }
         $arrSexo            = array("0"=>"::Seleccione::","1"=>"MASCULINO","2"=>"FEMENINO");
         $arrEstado          = array("0"=>"::Seleccione::","1"=>"ACTIVO","2"=>"INACTIVO");
         $arrCoord           = array("0"=>"::Seleccione::","1"=>"Coordinador de plana","2"=>"Profesor");
         $arrMes             = array("0"=>"Mes","1"=>"Enero","2"=>"Febrero","3"=>"Marzo","4"=>"Abril","5"=>"Mayo","6"=>"Junio","7"=>"Julio","8"=>"Agosto","9"=>"Setiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
         $arrAno[0]="Año";
         for($i=1950;$i<=2020;$i++)  $arrAno[$i]=$i;
         $data['titulo']     = $accion=="e"?"Editar Profesor":"Crear Profesor";
         $data['form_open']  = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));
         $data['form_close'] = form_close();
         $data['lista']	     = $lista;
         $data['selsexo']    = form_dropdown('sexo',$arrSexo,$lista->sexo,"id='sexo' class='comboMedio'");
         $data['selestado']  = form_dropdown('estado',$arrEstado,$lista->estado,"id='estado' class='comboMedio'");
         $data['selcurso']   = form_dropdown('curso',$this->curso_model->seleccionar("00"),$lista->curso,"id='curso' class='comboMedio'");
         $data['selcoord']   = form_dropdown('coordinador',$arrCoord,$lista->coordinador,"id='coordinador' class='comboMedio'");
         $data['seltipodoc'] = form_dropdown('tipodoc',$this->tipodocumento_model->seleccionar(),$lista->tipodoc,"id='tipodoc' class='comboMedio'"); ;
         $data['oculto']     = form_hidden(array("accion"=>$accion,"codigo"=>$lista->codigo,"codigo_padre"=>$lista->codigo_padre));
         $data['experiencia'] = listar_experiencia($codigo);
         $data['estudios']    = listar_estudios($codigo);
         $data['idiomas']     = listar_idiomas($codigo);
         $data['conferencias']= listar_conferencias($codigo);
         $data['sociedades']  = listar_sociedades($codigo);
         $data['empresa']     = listar_empresa($codigo);
         $data['principal']   = $this->load->view("ventas/profesor_nuevo_principal",$data,true);
         $this->load->view("ventas/profesor_nuevo",$data);
     }

     public function listar_empresa($codigo){      
         $lista = new stdClass();
             $filter = new stdClass();
             $filter->profesor = $codigo;
             $lista->trabajos = $this->trabajo_model->listar($filter);       
          $data['lista']          = $lista;
         return $this->load->view("ventas/empresa_index",$data,true);
     }           
     
    public function grabar(){
        parent::grabar();
        $accion       = $this->input->get_post('accion');
        $codigo_padre = $this->input->get_post('codigo_padre');
        $codigo       = $this->input->get_post('codigo');
        $data         = array(
                        "PERSP_Codigo"           => $this->codigo,
                        "PROC_FechaModificacion" => date('Y-m-d H:i:s',time()),
                        "PROC_FlagEstado"        => $this->input->post('estado'),
                        "PROD_Codigo"            => $this->input->post('curso'),
                        "PROC_FlagCoordinador"   => $this->input->post('coordinador')
                       );
        if($accion == "n"){
            $persona = $this->profesor_model->insertar($data);
        }
        elseif($accion == "e"){
            $this->profesor_model->modificar($codigo,$data);
        }
    }

    public function eliminar(){
        $codigo  = $this->input->post('codigo');
        $resultado = true;
        $filter = new stdClass();
        $filter->profesor = $codigo;
        $profesor = $this->profesor_model->obtener($filter);
        $persona = $profesor->PERSP_Codigo;
        $this->profesor_model->eliminar($codigo);
        $this->persona_model->eliminar($persona);
        echo json_encode($resultado);
    }
    
    public function borrar(){
        $codigo    = $this->input->post('codigo');
        $resultado = true;
        $data      = array("PROC_FlagBorrado" => 0);
        $this->profesor_model->modificar($codigo,$data);   
         echo json_encode($resultado);
    }

    public function buscar($j=0){
        $flgcoordinador  = $this->input->post('flgcoordinador');
        $filter = new stdClass();
        if(isset($_SESSION["codcurso"]) && $_SESSION["codcurso"]!=0)  $filter->curso = $_SESSION["codcurso"];
        if($flgcoordinador!="") $filter->flgcoordinador = $flgcoordinador;
        $filter_not = new stdClass();
        $filter_not->profesor   = "0";
        $filter->order_by       = array("d.PERSC_ApellidoPaterno"=>"asc","d.PERSC_ApellidoMaterno"=>"asc","d.PERSC_Nombre"=>"asc");
        $registros = count($this->profesor_model->listar($filter,$filter_not));
        $profesores = $this->profesor_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item       = 1;
        $lista      = array();
        if(count($profesores)>0){
            foreach($profesores as $indice => $value){
                $lista[$indice]             = new stdClass();
                $lista[$indice]->numero   = $value->PERSC_NumeroDocIdentidad;
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista[$indice]->telefono = $value->PERSC_Telefono;
                $lista[$indice]->movil    = $value->PERSC_Movil;
                $lista[$indice]->codigo   = $value->PROP_Codigo;
                $lista[$indice]->profesor = $value->PROP_Codigo;
                $lista[$indice]->estado   = $value->PROC_FlagEstado;
                $lista[$indice]->fechareg = $value->fechareg;
                $lista[$indice]->curso    = $value->PROD_Nombre;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/ventas/profesor/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']           = $lista;
        $data['j']               = $j;
        $data['registros']       = $registros;
        $data['paginacion']      = $this->pagination->create_links();
        $this->load->view("ventas/profesor_buscar",$data);
    }

    public function buscar2($j=0){
        $filter     = new stdClass();
        if(isset($_SESSION["codcurso"]) && $_SESSION["codcurso"]!=0)  $filter->curso = $_SESSION["codcurso"];
        $filter_not = new stdClass();
        $filter_not->profesor = "0";
        $filter->order_by    = array("d.PERSC_ApellidoPaterno"=>"asc","d.PERSC_ApellidoMaterno"=>"asc","d.PERSC_Nombre"=>"asc");
        $registros = count($this->profesor_model->listar($filter,$filter_not));
        $profesores = $this->profesor_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item       = 1;
        $lista      = array();
        if(count($profesores)>0){
            foreach($profesores as $indice => $value){
                $lista[$indice]             = new stdClass();
                $lista[$indice]->numero   = $value->PERSC_NumeroDocIdentidad;
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista[$indice]->telefono = $value->PERSC_Telefono;
                $lista[$indice]->movil    = $value->PERSC_Movil;
                $lista[$indice]->codigo   = $value->PROP_Codigo;
                $lista[$indice]->profesor = $value->PROP_Codigo;
                $lista[$indice]->estado   = $value->PROC_FlagEstado;
                $lista[$indice]->fechareg = $value->fechareg;
                $lista[$indice]->curso    = $value->PROD_Nombre;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/ventas/profesor/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']           = $lista;
        $data['j']               = $j;
        $data['registros']       = $registros;
        $data['paginacion']      = $this->pagination->create_links();
        $this->load->view("ventas/profesor_buscar2",$data);
    }    
    
    public function obtener(){
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);
        $profesores  = $this->profesor_model->listar($filter);
        $resultado = json_encode($profesores);
        echo $resultado;
    }
}
?>