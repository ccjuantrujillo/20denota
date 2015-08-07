<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acta extends CI_Controller {
    public function __construct(){
        parent::__construct(); 
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");           
        $this->load->model(ventas.'acta_model');
        $this->load->model(ventas.'actadetalle_model');
        $this->load->model(ventas.'alumno_model');
        $this->load->model(ventas.'actividad_model');
        $this->load->model(ventas.'profesor_model');
        $this->load->model(maestros.'persona_model');        
        $this->load->model(seguridad.'permiso_model');          
        $this->load->model(almacen.'curso_model');  
        $this->load->model(maestros.'ciclo_model');  
        $this->load->model(maestros.'aula_model'); 
        $this->load->model(maestros.'tipoestudio_model'); 
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
        $filter->order_by = array("p.MENU_Codigo"=>"asc");
        $menu       = get_menu($filter);                
        $filter     = new stdClass();
        $filter->order_by = array("p.ACTAC_Numero"=>"desc");
        $filter_not = new stdClass(); 
        $registros = count($this->acta_model->listar($filter,$filter_not));
        $matricula   = $this->acta_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($matricula)>0){
            foreach($matricula as $indice => $value){
                $lista[$indice]           = new stdClass();
                $lista[$indice]->codigo   = $value->ACTAP_Codigo;
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista[$indice]->fechareg = $value->fechareg;
                $lista[$indice]->fecha    = date_sql($value->ACTAC_Fecha);
                $lista[$indice]->numero   = $value->ACTAC_Numero;
                $lista[$indice]->titulo   = $value->ACTAC_Titulo;
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
        $data['titulo']       = "Actas de reunion";
        $data['menu']         = $menu;
        $data['form_open']    = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));     
        $data['form_close']   = form_close();         
        $data['j']            = $j;
        $data['registros']    = $registros;
        $data['paginacion']   = $this->pagination->create_links();
        $this->load->view("ventas/acta_index",$data);
    }

    public function editar($accion,$codigo="",$codigodetalle=""){
        $curso   = $this->input->get_post('curso'); 
        $titulo  = $this->input->get_post('titulo'); 
        $hinicio = $this->input->get_post('hinicio'); 
        $hfin    = $this->input->get_post('hfin'); 
        $agenda  = $this->input->get_post('agenda'); 
        $fecha   = $this->input->get_post('fecha'); 
        $numero  = $this->input->get_post('numero');
        $lista   = new stdClass();
        if($accion == "e"){
            $filter             = new stdClass();
            $filter->acta       = $codigo;
            $acta               = $this->acta_model->obtener($filter);
            $lista->profesor    = $acta->PROP_Codigo;  
            $lista->numero      = $numero!=""?$numero:$acta->ACTAC_Numero;  
            $lista->fecha       = $fecha!=""?$fecha:date_sql($acta->ACTAC_Fecha);  
            $lista->acta        = $acta->ACTAP_Codigo;
            $lista->titulo      = $titulo!=""?$titulo:$acta->ACTAC_Titulo;
            $lista->agenda      = $agenda!=""?$agenda:$acta->ACTAC_Agenda;
            $lista->detalle     = $acta->ACTAC_Detalle;
            $lista->hinicio     = $hinicio!=""?$hinicio:substr($acta->ACTAC_Hinicio,0,5);
            $lista->hfin        = $hfin!=""?$hfin:substr($acta->ACTAC_Hfin,0,5);
            $lista->curso       = $curso!=""?$curso:$acta->PROD_Codigo;
            $filter             = new stdClass();
            $filter->acta       = $codigo;
            $lista->actadetalle = $this->actadetalle_model->listar($filter);            
        }
        elseif($accion == "n"){ 
            $lista->profesor    = "";  
            $lista->fecha       = date("d/m/Y",time());
            $lista->numero      = $numero; 
            $lista->acta        = "";
            $lista->titulo      = $titulo;
            $lista->agenda      = $agenda;
            $lista->detalle     = "";
            $lista->hinicio     = $hinicio;
            $lista->hfin        = $hfin;
            $lista->curso       = $curso;
            $lista->actadetalle = array();
        } 
        $arrEstado             = array("0"=>"::Seleccione::","1"=>"ACTIVO","2"=>"INACTIVO");
        $data['titulo']        = $accion=="e"?"Editar Acta":"Nueva Acta"; 
        $data['form_open']     = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));     
        $data['form_close']    = form_close();         
        $data['lista']	       = $lista;   
        $data['accion']	       = $accion;               
        $data['codigodetalle'] = $codigodetalle;   
        $data['selcurso']      = form_dropdown('curso',$this->curso_model->seleccionar('0'),$lista->curso,"id='curso' class='comboMedio'"); 
        $filter = new stdClass();
        $filter->curso = $lista->curso;
        $filter->order_by = array("d.PERSC_ApellidoPaterno"=>"asc","d.PERSC_ApellidoMaterno"=>"asc");
        $data['responsable']  = $this->profesor_model->seleccionar('0',$filter);
        $data['selprofesor']  = form_dropdown('profesor',$this->profesor_model->seleccionar('0',$filter),$lista->profesor,"id='profesor' class='comboGrande'"); 
        $data['selasistente'] = form_dropdown('asistente',$this->profesor_model->seleccionar('0',$filter),$lista->profesor,"id='combo1' multiple='1' size='3' class='comboMultipleMedio'"); 
        $data['oculto']       = form_hidden(array("accion"=>$accion,"codigo"=>$codigo,"codigodetalle"=>$codigodetalle));
        $this->load->view("ventas/acta_nuevo",$data);
    }

    public function grabar(){
        $accion = $this->input->get_post('accion');
        $codigo = $this->input->get_post('codigo');
        $codigodetalle = $this->input->get_post('codigodetalle');
        $data   = array(
                        "ACTAC_Numero"       => $this->input->post('numero'),
			"ACTAC_Fecha"        => date_sql_ret($this->input->post('fecha')),
                        "PROP_Codigo"        => $this->input->post('profesor'),
                        "ACTAC_Titulo"       => $this->input->post('titulo'),
                        "ACTAC_Hinicio"      => $this->input->post('hinicio'),
                        "ACTAC_Hfin"         => $this->input->post('hfin'),
                        "ACTAC_Agenda"       => $this->input->post('agenda')
                       );
        $resultado = false;
        if($accion == "n"){
            $resultado = true;
            $codigo = $this->acta_model->insertar($data);                      
        }
        elseif($accion == "e"){
            $resultado = true;
            $this->acta_model->modificar($codigo,$data);                                
        }  
        /*Grabar detalle*/
        $acuerdo     = $this->input->get_post('acuerdo');
        $responsable = $this->input->get_post('responsable');
        $fcompromiso = $this->input->get_post('fcompromiso');
        if(count($acuerdo)>0 && is_array($acuerdo)){
            if($codigodetalle!=""){
                foreach($acuerdo as $item=>$value){
                    $data = array(
                                "PROP_Codigo"              => $responsable[$item],
                                "ACTADETC_Observacion"     => $acuerdo[$item],
                                "ACTADETC_FechaCompromiso" => date_sql_ret($fcompromiso[$item])                    
                            );
                    $this->actadetalle_model->modificar($codigodetalle,$data); 
                } 
            }
            else{
                foreach($acuerdo as $item=>$value){
                    $data = array(
                                "PROP_Codigo"              => $responsable[$item],
                                "ACTAP_Codigo"             => $codigo,
                                "ACTADETC_Observacion"     => $acuerdo[$item],
                                "ACTADETC_FechaCompromiso" => date_sql_ret($fcompromiso[$item])                    
                            );
                    $this->actadetalle_model->insertar($data); 
                }        
            }            
        }
        echo json_encode($resultado);
    }
	
    public function eliminar(){
        $codigo = $this->input->post('codigo');
        $resultado = false;
        $filter = new stdClass();
        $filter->acta = $codigo;
        $this->actadetalle_model->eliminar($filter);
        $this->acta_model->eliminar($codigo);
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

    public function buscar($n=""){
        $tipo    = $this->input->get_post('tipo');
        $ot      = $this->input->get_post('ot');
        $rsocial = $this->input->get_post('rsocial');
        $filter  = new stdClass();
        $filter->anio = date('Y',time());
        $filter->tipo = "OT";
        $tipoots = $this->tipoot_model->listar($filter);
        if($tipo=='') $tipo = isset($tipoots->cod_argumento)?$tipoots->cod_argumento:"";
        $fila   = "";
        $filter = new stdClass();
        $filter->tipoot = $tipo;
        if($ot!='')      $filter->nroot      = $ot;
        if($rsocial!='') $filter->codcliente = $rsocial;
        if($tipo=="04")  $filter->estado     = "P";
        $ots = $this->ot_model->listarg($filter,array('ot.nroOt'=>'asc'));         
        $tipoOt     = form_dropdown('tipo',$this->tipoot_model->seleccionar('',''),$tipo,"id='tipo' class='comboMedio' onchange='busca_tipoOt();'");   
        if(count($ots)>0){
            foreach($ots as $indice=>$value){
                $nroot  = $value->NroOt;
                $site   = $value->DirOt;
                $codcli = $value->CodCli;
                $codot  = $value->CodOt; 
                $finot  = $value->FinOt;
                $ftermino  = $value->FteOt;
                $razon_social = $tipo=='04'?$site:$value->razcli;
              // quitar esto { 
                $finot_envia = $tipo=='04'?date("d/m/Y",time()):$value->FinOt;
              // } 
                $fila .= "<tr   title='Fecha Termino: ".$ftermino."'     id='".$codot."' id2='".$tipo."'  id3='".$finot."' onclick='listadoot(this);'>";
                $fila .= "<td style='width:10%;' align='center'><p class='listadoot'>".$nroot."</p></td>";
                $fila .= "<td style='width:35%;' align='left'><p class='listadoot'>".$site."</p></td>";
                $fila .= "<td style='width:12%;' align='left'><p class='listadoot'>".$finot."</p></td>";
                $fila .= "<td style='width:12%;' align='left'><p class='listadoot'>".$ftermino."</p></td>";
                $fila .= "<td style='width:31%;' align='left'><p class='listadoot'>".$razon_social."</p></td>";
                $fila .= "</tr>";
            }
        }  
        else{
            $fila.="<tr>";
            $fila.="<td colspan='3'>NO EXISTEN RESULTADOS</td>";
            $fila.="</tr>";
        }
        $data['ot']   = $ot;
        $data['n']    = $n;
        $data['fila'] = $fila;
        $data['tipoot']  = $tipoOt;
        $data['rsocial'] = $rsocial;
        $this->load->view(ventas."ot_buscar",$data);  
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