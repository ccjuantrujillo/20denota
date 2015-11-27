<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tarea extends CI_Controller {
    public function __construct(){
        parent::__construct(); 
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");           
        $this->load->model(ventas.'tarea_model');
        $this->load->model(ventas.'tareadetalle_model');
        $this->load->model(ventas.'profesor_model');
        $this->load->model(maestros.'persona_model');        
        $this->load->model(seguridad.'permiso_model');          
        $this->load->model(almacen.'curso_model');  
        $this->load->model(maestros.'ciclo_model');  
        $this->load->model(maestros.'aula_model'); 
        $this->load->model(maestros.'tipoestudio_model'); 
        $this->load->model(maestros.'tipoestudiociclo_model'); 
        $this->load->model(maestros.'local_model'); 
        $this->load->model(maestros.'tipotarea_model'); 
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
        $filter->order_by = array("p.TAREAC_Fecha"=>"desc","p.TAREAC_Numero"=>"desc");
        $filter_not = new stdClass(); 
        $registros = count($this->tarea_model->listar($filter,$filter_not));
        $matricula   = $this->tarea_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($matricula)>0){
            foreach($matricula as $indice => $value){
                $lista[$indice]           = new stdClass();
                $lista[$indice]->codigo   = $value->TAREAP_Codigo;
                $lista[$indice]->fecha    = date_sql($value->TAREAC_Fecha);
                $lista[$indice]->fechaentrega = date_sql($value->TAREAC_FechaEntrega);
                $lista[$indice]->numero   = $value->TAREAC_Numero;
                $lista[$indice]->nombre   = $value->TAREAC_Nombre;
                $lista[$indice]->tipo     = $value->TIPOTAREAC_Nombre;
                $lista[$indice]->ciclo    = $value->COMPC_Nombre;
                $filter        = new stdClass();
                $filter->curso = $value->PROD_Codigo;
                $curso = $this->curso_model->obtener($filter);
                $lista[$indice]->curso    = $curso->PROD_Nombre;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/ventas/orden/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']        = $lista;
        $data['titulo']       = "Tareas asignadas";
        $data['menu']         = $menu;  
        $data['header']       = get_header();
        $data['j']            = $j;
        $data['registros']    = $registros;
        $data['paginacion']   = $this->pagination->create_links();
        $this->load->view("ventas/tarea_index",$data);
    }

    public function editar($accion,$codigo="",$codigodetalle=""){
        $ciclo   = $this->input->get_post('ciclo'); 
        $tipoestudio = $this->input->get_post('tipoestudio'); 
        $curso   = $this->input->get_post('curso'); 
        $nombre  = $this->input->get_post('nombre'); 
        $descripcion = $this->input->get_post('descripcion'); 
        $fecha   = $this->input->get_post('fecha'); 
        $fechaentrega = $this->input->get_post('fechaentrega'); 
        $numero  = $this->input->get_post('numero');
        $lista   = new stdClass();
        if($accion == "e"){
            $filter             = new stdClass();
            $filter->tarea      = $codigo;
            $tarea              = $this->tarea_model->obtener($filter);
            $lista->profesor    = $tarea->PROP_Codigo;  
            $lista->numero      = $numero!=""?$numero:$tarea->TAREAC_Numero;  
            $lista->fecha       = $fecha!=""?$fecha:date_sql($tarea->TAREAC_Fecha);  
            $lista->fechaentrega = $fechaentrega!=""?$fechaentrega:date_sql($tarea->TAREAC_FechaEntrega); 
            $lista->tarea       = $tarea->TAREAP_Codigo;
            $lista->tipotarea   = $tarea->TIPOTAREAP_Codigo;
            $lista->nombre      = $nombre!=""?$nombre:$tarea->TAREAC_Nombre;
            $lista->descripcion = $descripcion!=""?$descripcion:$tarea->TAREAC_Descripcion;
            $lista->curso       = $curso!=""?$curso:$tarea->PROD_Codigo;
            $lista->ciclo       = $ciclo!=""?$ciclo:$tarea->CICLOP_Codigo;
            $filter             = new stdClass();
            $filter->tarea       = $codigo;
            $lista->tareadetalle = $this->tareadetalle_model->listar($filter);            
        }
        elseif($accion == "n"){ 
            $lista->profesor    = "";  
            $lista->fecha       = date("d/m/Y",time());
            $lista->fechaentrega = "__/__/__";
            $lista->numero      = $numero; 
            $lista->tarea       = "";
            $lista->tipotarea   = 1;
            $lista->nombre      = $nombre;
            $lista->descripcion = $descripcion;
            $lista->curso       = $curso;
            $lista->ciclo       = $ciclo;
            $lista->tareadetalle = array();
        } 
        $arrEstado             = array("0"=>"::Seleccione::","1"=>"ACTIVO","2"=>"INACTIVO");
        $data['titulo']        = $accion=="e"?"Editar Tarea":"Nueva Tarea"; 
        $data['form_open']     = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));     
        $data['form_close']    = form_close();         
        $data['lista']	       = $lista;   
        $data['accion']	       = $accion;               
        $data['codigodetalle'] = $codigodetalle;
        $filter = new stdClass();
        $filter->estado = 1;
        $data['selciclo']      = form_dropdown('ciclo',$this->ciclo_model->seleccionar('0',$filter),$lista->ciclo,"id='ciclo' class='comboMedio' ".($accion=="e"?"disabled":"")."");         
        $filter = new stdClass();
        //$filter->ciclo         = $lista->ciclo;
        if(isset($_SESSION["codcurso"]) && $_SESSION["codcurso"]!=0)  $filter->curso = $_SESSION["codcurso"];
        $data['selcurso']      = form_dropdown('curso',$this->curso_model->seleccionar('0',$filter),$lista->curso,"id='curso' class='comboMedio' ".($accion=="e"?"disabled":"").""); 
        $data['seltipotarea']  = form_dropdown('tipotarea',$this->tipotarea_model->seleccionar('0'),$lista->tipotarea,"id='tipotarea' class='comboMedio' ".($accion=="e"?"disabled":"").""); 
        $filter = new stdClass();
        $filter->curso = $lista->curso;
        $filter->flgcoordinador = 1;
        $filter->order_by = array("d.PERSC_ApellidoPaterno"=>"asc","d.PERSC_ApellidoMaterno"=>"asc");
//        $data['responsable']  = $this->profesor_model->seleccionar('0',$filter);
        $data['selprofesor']  = form_dropdown('profesor',$this->profesor_model->seleccionar('0',$filter),$lista->profesor,"id='profesor' class='comboGrande' ".($accion=="e"?"disabled":"").""); 
        $data['oculto']       = form_hidden(array("accion"=>$accion,"codigo"=>$codigo));
        $this->load->view("ventas/tarea_nuevo",$data);
    }

    public function grabar(){
        $accion = $this->input->get_post('accion');
        $codigo = $this->input->get_post('codigo');
        $codigodetalle = $this->input->get_post('codigodetalle');
        $data   = array(
                        "PROP_Codigo"         => $this->input->post('profesor'),
                        "CICLOP_Codigo"       => $this->input->post('ciclo'),
                        "TIPOTAREAP_Codigo"   => $this->input->post('tipotarea'),            
                        "TAREAC_Nombre"       => $this->input->post('nombre'),
                        "TAREAC_Descripcion"  => $this->input->post('descripcion'),
			"TAREAC_Fecha"        => date_sql_ret($this->input->post('fecha')),
                        "TAREAC_FechaEntrega" => date_sql_ret($this->input->post('fechaentrega')),            
                        "TAREAC_Numero"       => $this->input->post('numero')
                       );
        $resultado = false;
        if($accion == "n"){
            $resultado = true;
            $codigo = $this->tarea_model->insertar($data);                      
        }
        elseif($accion == "e"){
            $resultado = true;
            $this->tarea_model->modificar($codigo,$data);                                
        }  
        /*GRABAR DETALLE*/
        $cantidad    = $this->input->get_post('cantidad');
        $tema        = $this->input->get_post('tema');
        $responsable = $this->input->get_post('responsable');
        $tipoestudio = $this->input->get_post('tipoestudiociclo');
        if(count($codigodetalle)>0 && is_array($codigodetalle)){
            foreach($codigodetalle as $item=>$value){
                $data = array(
                            "TAREAP_Codigo"          => $codigo,
                            "PROP_Codigo"            => $responsable[$item],
                            "PRODATRIBDET_Codigo"    => $tema[$item],        
                            "TAREADETC_Cantidad"     => $cantidad[$item],
                            "TIPCICLOP_Codigo"       => $tipoestudio[$item]
                        );
                if(trim($codigodetalle[$item])==""){//Insertar
                   $this->tareadetalle_model->insertar($data); 
                }
                else{//Editar
                   $this->tareadetalle_model->modificar($codigodetalle[$item],$data); 
                }  
            }          
        }
        echo json_encode($resultado);
    }
	
    public function eliminar(){
        $codigo = $this->input->post('codigo');
        $resultado = false;
        $filter = new stdClass();
        $filter->tarea = $codigo;
        $this->tareadetalle_model->eliminar($filter);
        $this->tarea_model->eliminar($codigo);
        $resultado = true;
        echo json_encode($resultado);
    }
    
    public function eliminardetalle(){
        $codigo = $this->input->post('codigo');
        $filter = new stdClass();
        $filter->actadetalle = $codigo;
        $resultado = false;
        $this->actadetalle_model->eliminar($filter);
        $resultado = true;
        echo json_encode($resultado);
    }    

    public function obtenerdetalle(){
        $obj    = $this->input->post('objeto');
        $filter = json_decode($obj);
        $aulas  = $this->tareadetalle_model->obtener($filter);
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
    
    public function export_pdf($type){     
        switch ($type) {
            case 'rpt_seguimiento_tareas':
                $curso    = $this->input->get_post('curso');
                $profesor = $this->input->get_post('profesor');
                $desde    = $this->input->get_post('desde');
                $hasta    = $this->input->get_post('hasta');                
                $filter = new stdClass();
                if($curso!=0) $filter->curso = $curso;
                if($profesor!=0) $filter->profesor = $profesor;
                $filter->order_by= array("e.PROD_Codigo"=>"asc","d.PROP_Codigo"=>"asc");
                $tareas = $this->tareadetalle_model->listar($filter);
                $this->load->library("fpdf/pdf");
                $CI = & get_instance();
                $CI->pdf->FPDF('P');
                $CI->pdf->AliasNbPages();
                $CI->pdf->AddPage();
                $CI->pdf->SetTextColor(0,0,0);
                $CI->pdf->SetFillColor(216,216,216);
                $CI->pdf->SetFont('Arial','B',11);
                $CI->pdf->Image('img/uni.gif',10,8,10);
                $CI->pdf->Cell(0,13,"SEGUIMIENTO DE TAREAS",0,1,"C",0);
                $CI->pdf->SetFont('Arial','B',7);   
                $profe_ant = 0;
                $curso_ant = 0;
                foreach($tareas as $item=>$value){
                    if($value->PROD_Codigo!=$curso_ant) $CI->pdf->Cell(120,5,"Curso: ".$value->PROD_Nombre,0,1,"L",0);
                    //if($value->PROP_Codigo!=$profe_ant) $CI->pdf->Cell(120,5,"Profesor: ".$value->PERSC_ApellidoPaterno." ".$value->PERSC_ApellidoMaterno.", ".$value->PERSC_Nombre,0,1,"L",0);                    
                    $CI->pdf->Cell(90,5,$value->PERSC_ApellidoPaterno." ".$value->PERSC_ApellidoMaterno.", ".$value->PERSC_Nombre,1,0,"L",0);
                    $CI->pdf->Cell(1,1, "" ,0,0,"L",0);
                    $CI->pdf->Cell(90,5,$value->TAREAC_Nombre,1,1,"L",0);
                    $CI->pdf->Cell(90,1, "" ,0,1,"L",0);  
                    $profe_ant = $value->PROP_Codigo;
                    $curso_ant = $value->PROD_Codigo;
                }   
                $CI->pdf->Output();
                break;
        }
    }
    
    public function rpt_seguimiento_tareas(){
        $curso    = $this->input->get_post('curso');
        $profesor = $this->input->get_post('profesor');
        $desde    = $this->input->get_post('desde');
        $hasta    = $this->input->get_post('hasta');         
        $filter           = new stdClass();
        $filter->rol      = $this->session->userdata('rolusu');		
        $filter->order_by = array("m.MENU_Orden"=>"asc");
        $menu       = get_menu($filter);           
        $filter       = new stdClass();
        $data['selprofesor'] = form_dropdown('profesor',$this->profesor_model->seleccionar('0',$filter),0,"id='profesor' class='comboGrande'");      
        $data['selcurso']    = form_dropdown('curso',$this->curso_model->seleccionar('0',$filter),0,"id='curso' class='comboGrande'");      
        $data["desde"] = $desde;
        $data["hasta"] = $hasta;
        $data["menu"]  = $menu;
        $data["form_open"] = form_open("",array("name"=>"frmReporte","id"=>"frmReporte","method"=>"post"));
        $data["form_close"] = form_close();
        $data["fila"]  = "";
        $data['header']  = get_header();
        $data["titulo"]  = "Reporte de seguimiento de tareas por profesor";        
        $this->load->view(ventas."rpt_seguimiento_tareas",$data);
    }
}