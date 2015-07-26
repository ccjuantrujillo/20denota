<?php header("Content-type: text/html; charset=utf-8");
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'controllers/maestros/persona.php';
class Alumno extends Persona
{
    public function __construct(){
        parent::__construct();
        $this->load->model(ventas.'matricula_model');
        $this->load->model(maestros.'usuario_model');
        $this->configuracion = $this->config->item('conf_pagina');
    }

    public function index(){
        $this->load->view('seguridad/inicio');
    }

    public function listar($j=0){
        $filter           = new stdClass();
        $filter->rol      = 4;
        $filter->order_by = array("p.MENU_Codigo"=>"asc");
        $menu       = $this->permiso_model->listar($filter);
        $filter     = new stdClass();
        $filter_not = new stdClass();
        $filter_not->cliente = "0";
        $filter->order_by    = array("d.PERSC_ApellidoPaterno"=>"asc","d.PERSC_ApellidoMaterno"=>"asc","d.PERSC_Nombre"=>"asc");
        $registros = count($this->alumno_model->listar($filter,$filter_not));
        $clientes  = $this->alumno_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($clientes)>0){
            foreach($clientes as $indice => $value){
                $lista[$indice]             = new stdClass();
                $lista[$indice]->numero   = $value->PERSC_NumeroDocIdentidad;
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista[$indice]->telefono = $value->PERSC_Telefono;
                $lista[$indice]->movil    = $value->PERSC_Movil;
                $lista[$indice]->codigo   = $value->CLIP_Codigo;
                $lista[$indice]->estado   = $value->CLIC_FlagEstado;
                $lista[$indice]->fechareg = $value->fechareg;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/ventas/cliente/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']           = $lista;
        $data['menu']            = $menu;
        $data['j']               = $j;
        $data['registros']       = $registros;
        $data['paginacion']      = $this->pagination->create_links();
        $this->load->view("ventas/alumno_index",$data);
    }

    public function editar($accion,$codigo=""){
         $filter           = new stdClass();
         $filter->codigo   = 1;
         $filter->rol      = 4;
         $filter->order_by = array("p.MENU_Codigo"=>"asc");
         $menu_padre = $this->permiso_model->listar($filter);
         $lista = new stdClass();
         if($accion == "e"){
             $filter            = new stdClass();
             $filter->cliente   = $codigo;
             $clientes          = $this->alumno_model->obtener($filter);
             $lista->numerodoc  = $clientes->PERSC_NumeroDocIdentidad;
             $lista->sexo       = $clientes->PERSC_Sexo;
             $lista->direccion  = $clientes->PERSC_Direccion;
             $lista->telefono   = $clientes->PERSC_Telefono;
             $lista->email      = $clientes->PERSC_Email;
             $lista->movil      = $clientes->PERSC_Movil;
             $lista->fax        = $clientes->PERSC_Fax;
             $lista->web        = $clientes->PERSC_Web;
             $lista->fnac       = date_sql($clientes->PERSC_FechaNacimiento);
             $lista->paterno    = $clientes->PERSC_ApellidoPaterno;
             $lista->materno    = $clientes->PERSC_ApellidoMaterno;
             $lista->nombres    = $clientes->PERSC_Nombre;
             $lista->codigo     = $clientes->PERSP_Codigo;
             $lista->estado     = $clientes->CLIC_FlagEstado;
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
             $lista->estado     = 1;
         }
         $arrSexo            = array("0"=>"::Seleccione::","1"=>"MASCULINO","2"=>"FEMENINO");
         $arrEstado          = array("0"=>"::Seleccione::","1"=>"ACTIVO","2"=>"INACTIVO");
         $data['titulo']     = $accion=="e"?"Editar Alumno":"Crear Alumno";
         $data['menu']       = $menu_padre;
         $data['form_open']  = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));
         $data['form_close'] = form_close();
         $data['lista']	     = $lista;
         $data['selsexo']    = form_dropdown('sexo',$arrSexo,$lista->sexo,"id='sexo' class='comboMedio'");
         $data['selestado']  = form_dropdown('estado',$arrEstado,$lista->estado,"id='estado' class='comboMedio'");
         $data['oculto']     = form_hidden(array("accion"=>$accion,"codigo_padre"=>$codigo,"codigo"=>$lista->codigo));
         $this->load->view("ventas/cliente_nuevo",$data);
     }

    public function grabar(){
        parent::grabar();
        $accion       = $this->input->get_post('accion');
        $codigo_padre = $this->input->get_post('codigo_padre');
        $data         = array(
                        "PERSP_Codigo"           => $this->codigo,
                        "CLIC_FechaModificacion" => date('Y-m-d H:i:s',time()),
                        "CLIC_FlagEstado"        => $this->input->post('estado')
                       );
        if($accion == "n"){
            $this->alumno_model->insertar($data);
        }
        elseif($accion == "e"){
            $this->alumno_model->modificar($codigo_padre,$data);
        }
    }

    public function eliminar(){
        $codigo  = $this->input->post('codigo');
        /*Verifico si el cliente esta matriculado en algun curso*/
        $filter  = new stdClass();
        $filter->cliente = $codigo;
        $ordenes = $this->matricula_model->listar($filter);
        $resultado = false;
        if(count($ordenes) == 0){
            $resultado = true;
            $filter = new stdClass();
            $filter->cliente = $codigo;
            $cliente = $this->alumno_model->obtener($filter);
            $persona = $cliente->PERSP_Codigo;
            $this->alumno_model->eliminar($codigo);
            $this->persona_model->eliminar($persona);
        }
        echo json_encode($resultado);
    }

    public function buscar($j=0){
        $filter     = new stdClass();
        $filter_not = new stdClass();
        $filter_not->cliente = "0";
        $filter->order_by    = array("d.PERSC_ApellidoPaterno"=>"asc","d.PERSC_ApellidoMaterno"=>"asc","d.PERSC_Nombre"=>"asc");
        $registros = count($this->alumno_model->listar($filter,$filter_not));
        $clientes  = $this->alumno_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($clientes)>0){
            foreach($clientes as $indice => $value){
                $lista[$indice]             = new stdClass();
                $lista[$indice]->numero   = $value->PERSC_NumeroDocIdentidad;
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista[$indice]->telefono = $value->PERSC_Telefono;
                $lista[$indice]->movil    = $value->PERSC_Movil;
                $lista[$indice]->codigo   = $value->CLIP_Codigo;
                $lista[$indice]->estado   = $value->CLIC_FlagEstado;
                $lista[$indice]->fechareg = $value->fechareg;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/ventas/cliente/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']           = $lista;
        $data['j']               = $j;
        $data['registros']       = $registros;
        $data['paginacion']      = $this->pagination->create_links();
        $this->load->view("ventas/cliente_buscar",$data);
    }

    public function obtener($codigo){
        $filter    = new stdClass();
        $filter->cliente = $codigo;
        $clientes  = $this->alumno_model->obtener($filter);
        $resultado = json_encode($clientes);
        echo $resultado;
    }
}
?>