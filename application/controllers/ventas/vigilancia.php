<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vigilancia extends CI_Controller {
    public function __construct(){
        parent::__construct(); 
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");           
        $this->load->model(ventas.'vigilancia_model');
        $this->load->model(ventas.'vigilanciadetalle_model');
        $this->load->model(ventas.'profesor_model');
        $this->load->model(maestros.'ciclo_model');
        $this->load->model(maestros.'tipoestudiociclo_model');
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
        if(isset($_SESSION["codprofesor"]))  $filter->profesor = $_SESSION["codprofesor"];  
        $filter->order_by = array("p.VIGILAC_Fecha"=>"desc","p.VIGILAP_Codigo"=>"desc");
        $filter_not = new stdClass(); 
        $registros = count($this->vigilancia_model->listar($filter,$filter_not));
        $vigilancia = $this->vigilancia_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($vigilancia)>0){
            foreach($vigilancia as $indice => $value){
                $lista[$indice]           = new stdClass();
                $lista[$indice]->codigo   = $value->VIGILAP_Codigo;
                $lista[$indice]->fecha    = date_sql($value->VIGILAC_Fecha);
                $lista[$indice]->nombre   = $value->VIGILAC_Nombre;
                $lista[$indice]->numero   = $value->VIGILAC_Numero;
                $lista[$indice]->descripcion = $value->VIGILAC_Descripcion;
                $lista[$indice]->coordinador = $value->PERSC_ApellidoPaterno." ".$value->PERSC_ApellidoMaterno." ".$value->PERSC_Nombre;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/ventas/orden/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']        = $lista;
        $data['titulo']       = "Vigilancia de Examenes";
        $data['menu']         = $menu;       
        $data['header']       = get_header();  
        $data['j']            = $j;
        $data['registros']    = $registros;
        $data['paginacion']   = $this->pagination->create_links();
        $this->load->view("ventas/vigilancia_index",$data);
    }

    public function editar($accion,$codigo=""){
        $lista   = new stdClass();
        if($accion == "e"){
            $filter             = new stdClass();
            $filter->vigilancia = $codigo;
            $vigilancia         = $this->vigilancia_model->obtener($filter);
            $lista->vigilancia  = $vigilancia->VIGILAP_Codigo;  
            $lista->fecha       = date_sql($vigilancia->VIGILAC_Fecha);  
            $lista->nombre      = $vigilancia->VIGILAC_Nombre;
            $lista->descripcion = $vigilancia->VIGILAC_Descripcion;
            $lista->responsable = $vigilancia->PROP_Codigo;
            $lista->numero      = $vigilancia->VIGILAC_Numero;
            $lista->tipoestudiociclo = $vigilancia->TIPCICLOP_Codigo;
            $lista->ciclo       = $vigilancia->CICLOP_Codigo;
            $filter             = new stdClass();
            $filter->vigilancia = $codigo;
            $filter->order_by   = array("d.VIGILAP_Codigo"=>"asc");
            $lista->vigilanciadetalle = $this->vigilanciadetalle_model->listar($filter);      
        }
        elseif($accion == "n"){ 
            $lista->vigilancia  = "";  
            $lista->fecha       = date("d/m/Y",time());
            $lista->nombre      = ""; 
            $lista->descripcion = "";
            $lista->responsable = "";
            $lista->numero      = "";
            $lista->tipoestudiociclo = 0;
            $lista->ciclo       = 0;
            $lista->vigilanciadetalle = array();
        } 
        $data['titulo']        = $accion=="e"?"Editar Vigilancia":"Nueva Vigilancia"; 
        $data['form_open']     = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));     
        $data['form_close']    = form_close(); 
        $filter = new stdClass();
        $filter->flgcoordinador = 1;
        $data['selresponsable'] = form_dropdown('responsable',$this->profesor_model->seleccionar('0',$filter),$lista->responsable,"id='responsable' class='comboGrande' ".($accion=="e"?"disabled":"")."");      
        $data['selciclo']       = form_dropdown('ciclo',$this->ciclo_model->seleccionar('0',$filter),$lista->ciclo,"id='ciclo' class='comboMedio' ".($accion=="e"?"disabled":"")."");      
        $data['seltipoestudio'] = form_dropdown('tipoestudiociclo',$this->tipoestudiociclo_model->seleccionar('0',$filter),$lista->tipoestudiociclo,"id='tipoestudiociclo' class='comboGrande' ".($accion=="e"?"disabled":"")."");      
        $data['lista']	        = $lista;   
        $data['oculto']         = form_hidden(array("accion"=>$accion,"codigo"=>$codigo));
        $this->load->view("ventas/vigilancia_nuevo",$data);
    }

    public function grabar(){
        $accion = $this->input->get_post('accion');
        $codigo = $this->input->get_post('codigo');
        $codigodetalle = $this->input->get_post('codigodetalle');
        $data   = array(
                        "PROP_Codigo"         => $this->input->post('responsable'),          
                        "VIGILAC_Nombre"      => $this->input->post('nombre'),
                        "VIGILAC_Numero"      => $this->input->post('numero'),
                        "VIGILAC_Descripcion" => $this->input->post('descripcion'),
                        "TIPCICLOP_Codigo"    => $this->input->post('tipoestudiociclo'),
			"VIGILAC_Fecha"       => date_sql_ret($this->input->post('fecha'))
                       );
        $resultado = false;
        if($accion == "n"){
            $resultado = true;
            $codigo = $this->vigilancia_model->insertar($data);                      
        }
        elseif($accion == "e"){
            $resultado = true;
            $this->vigilancia_model->modificar($codigo,$data);                                
        }  
        /*GRABAR DETALLE*/
        $curso    = $this->input->get_post('curso');
        $profesor = $this->input->get_post('profesor');
        if(count($codigodetalle)>0 && is_array($codigodetalle)){
            foreach($codigodetalle as $item=>$value){
                $data = array(
                            "VIGILAP_Codigo" => $codigo,
                            "PROD_Codigo"    => $curso[$item],
                            "PROP_Codigo"    => $profesor[$item]          
                        );
                if(trim($codigodetalle[$item])==""){//Insertar
                   $this->vigilanciadetalle_model->insertar($data); 
                }
                else{//Editar
                   $this->vigilanciadetalle_model->modificar($codigodetalle[$item],$data); 
                }  
            }          
        }
        echo json_encode($resultado);
    }
	
    public function eliminar(){
        $codigo = $this->input->post('codigo');
        $resultado = false;
        $filter = new stdClass();
        $filter->vigilancia = $codigo;
        $this->vigilanciadetalle_model->eliminar($filter);
        $this->vigilancia_model->eliminar($codigo);
        $resultado = true;
        echo json_encode($resultado);
    }
    
    public function eliminardetalle(){
        $codigo = $this->input->post('codigo');
        $filter = new stdClass();
        $filter->vigilanciadetalle = $codigo;
        $resultado = false;
        $this->vigilanciadetalle_model->eliminar($filter);
        $resultado = true;
        echo json_encode($resultado);
    }    

    public function obtenerdetalle(){
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);
        $aulas  = $this->vigilanciadetalle_model->obtener($filter);
        $resultado = json_encode($aulas);       
        echo $resultado;        
    } 
    
    public function ver($codigo){
        $filter           = new stdClass();
        $filter->orden    = $codigo;
        $ordenes          = $this->acta_model->obtener($filter);
        $codproducto      = $ordenes->PROD_Codigo;
        $codcliente       = $ordenes->CLIP_Codigo;
        $filter           = new stdClass();
        $filter->cliente  = $codcliente; 
        $clientes         = $this->alumno_model->obtener($filter);
        $filter           = new stdClass();
        $filter->curso = $codproducto; 
        $productos        = $this->curso_model->obtener($filter);        
        $this->load->library("fpdf/pdf");
        $CI = & get_instance();
        $CI->pdf->FPDF('P');
        $CI->pdf->AliasNbPages();
        $CI->pdf->AddPage();
        $CI->pdf->SetTextColor(0,0,0);
        $CI->pdf->SetFillColor(216,216,216);
        $CI->pdf->SetFont('Arial','B',11);
        $CI->pdf->Image('img/puertosaber.jpg',10,8,10);
        $CI->pdf->Cell(0,13,"MATRICULA Nro ".$ordenes->ORDENC_Numero,0,1,"C",0);
         $CI->pdf->SetFont('Arial','B',7);
        $CI->pdf->Cell(120,10, "" ,0,1,"L",0);
        $CI->pdf->Cell(90,5, "CURSO : " ,1,0,"L",0);
        $CI->pdf->Cell(1,1, "" ,0,0,"L",0);
        $CI->pdf->Cell(90,5,$productos->PROD_Nombre,1,1,"L",0);
        $CI->pdf->Cell(90,1, "" ,0,1,"L",0);
        $CI->pdf->Cell(90,5, "APELLIDOS Y NOMBRES: " ,1,0,"L",0);
        $CI->pdf->Cell(1,1, "" ,0,0,"L",0);
        $CI->pdf->Cell(90,5,$clientes->PERSC_ApellidoPaterno." ".$clientes->PERSC_ApellidoMaterno.", ".$clientes->PERSC_Nombre,1,1,"L",0); 
        $CI->pdf->Cell(90,1, "" ,0,1,"L",0);
        $CI->pdf->Cell(90,5, "USUARIO: " ,1,0,"L",0);
        $CI->pdf->Cell(1,1, "" ,0,0,"L",0);
        $CI->pdf->Cell(90,5,$ordenes->ORDENC_Usuario ,1,1,"L",0);
         $CI->pdf->Cell(90,1, "" ,0,1,"L",0);
        $CI->pdf->Cell(90,5, "CLAVE: " ,1,0,"L",0);
        $CI->pdf->Cell(1,1,$ordenes->ORDENC_Password,0,0,"L",0);
        $CI->pdf->Cell(90,5, "" ,1,1,"L",0);
         $CI->pdf->Cell(90,1, "" ,0,1,"L",0);         
        $CI->pdf->Cell(90,5, "RESPONSABLE: " ,1,0,"L",0);
        $CI->pdf->Cell(1,1, "" ,0,0,"L",0);
        $CI->pdf->Cell(90,5, "" ,1,1,"L",0);   
         $CI->pdf->Cell(90,1, "" ,0,1,"L",0);
        $CI->pdf->SetTextColor(0,0,0);
        $CI->pdf->SetFillColor(255,255,255);
        $CI->pdf->Cell(181,5, "OBSERVACION : " ,0,1,"L",1);
        $CI->pdf->Cell(181,5,$ordenes->ORDENC_Observacion,1,1,"L",1);
        $CI->pdf->Output();
    }
    
     public function export_excel($type) {
        if($this->session->userdata('data_'.$type)){
            $result = $this->session->userdata('data_'.$type);
            $arr_columns = array();            
            switch ($type) {
                case 'listar_requisiciones_ot':
                    $this->reports_model->rpt_general('rpt_'.$type, 'REQUISICIONES POR OT', $result["columns"], $result["rows"],$result["group"]);
                    break;
                case 'listar_control_pesos1':
                case 'listar_control_pesos2':
                case 'listar_control_pesos3':
                case 'listar_control_pesos4':
                case 'listar_control_pesos5':
                case 'listar_control_pesos':
                    $arr_export_detalle = array();
                    $arr_columns[]['STRING']  = 'NRO.OT';
                    $arr_columns[]['STRING']  = 'NOMBRE';
                    $arr_columns[]['STRING']  = 'PROYECTO';
                    $arr_columns[]['STRING']  = 'TIPO PRODUCTO';
                    $arr_columns[]['DATE']    = 'F.INICIO';
                    $arr_columns[]['DATE']    = 'F.TERMINO';
                    $arr_columns[]['NUMERIC'] = 'W.REQUISICION';
                    $arr_columns[]['NUMERIC'] = 'W.PPTO.';
                    //$arr_columns[]['NUMERIC'] = 'W.METRADO';
                    $arr_columns[]['NUMERIC'] = 'W.O.TECNICA';
                    $arr_columns[]['NUMERIC'] = 'W.GALVANIZADO';
                    $arr_columns[]['NUMERIC'] = 'W.PRODUCCION';
                    $arr_columns[]['NUMERIC'] = 'W.ALMACEN';
                    $arr_group = array();
                    $this->reports_model->rpt_general('rpt_'.$type,'Control de pesos',$arr_columns,$result["rows"],$arr_group); 
                    break;
                case'productos_x_ot':
                    $arr_export_detalle = array();
                    $arr_columns[]['STRING']  = 'NRO.OT';
                    $arr_columns[]['STRING']  = 'T.TORRE';
                    $arr_columns[]['STRING']  = 'CODIGO';
                    $arr_columns[]['STRING']  = 'FAMILIA';
                    $arr_columns[]['STRING']  = 'DESCRIPCION';
                    $arr_columns[]['NUMERIC'] = 'INGRESO';
                    $arr_columns[]['NUMERIC'] = 'SALIDA';
                    $arr_columns[]['NUMERIC'] = 'SALDO';
                    $arr_columns[]['NUMERIC'] = 'INGRESO';
                    $arr_columns[]['NUMERIC'] = 'SALIDA';
                    $arr_columns[]['NUMERIC'] = 'SALDO';
                    $arr_group = array('E5:G5'=>'CANTIDAD','H5:K5'=>'MONTO');
                    $arr_group = array();
                    $this->reports_model->rpt_general('rpt_'.$type,'pRODUCTOS POR OT',$arr_columns,$result["rows"],$arr_group); 
                    break;
            }
        }else{
            echo "<div style='color:rgb(150,150,150);padding:10px;width:560px;height:160px;border:1px solid rgb(210,210,210);'>
                No hay datos para exportar
                </div>";
        }
    }
}