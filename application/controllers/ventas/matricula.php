<?php header("Content-type: text/html; charset=utf-8"); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matricula extends CI_Controller {
    public function __construct(){
        parent::__construct(); 
        if(!isset($_SESSION['login'])) die("Sesion terminada. <a href='".  base_url()."'>Registrarse e ingresar.</a> ");           
        $this->load->model(ventas.'matricula_model');
        $this->load->model(ventas.'alumno_model');
        $this->load->model(ventas.'actividad_model');
        $this->load->model(maestros.'persona_model');        
        $this->load->model(seguridad.'permiso_model');          
        $this->load->model(almacen.'curso_model');  
        $this->load->model(maestros.'ciclo_model');  
        $this->load->model(maestros.'aula_model'); 
        $this->load->model(maestros.'tipoestudio_model'); 
        $this->load->model(maestros.'local_model'); 
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
        $menu  = $this->permiso_model->listar($filter);            
        $filter     = new stdClass();
        $filter->order_by = array("c.CICLOP_Codigo"=>"desc","e.PERSC_ApellidoPaterno"=>"asc","e.PERSC_ApellidoMaterno"=>"asc");
        $filter_not = new stdClass(); 
        $registros = count($this->matricula_model->listar($filter,$filter_not));
        $matricula   = $this->matricula_model->listar($filter,$filter_not,$this->configuracion['per_page'],$j);
        $item      = 1;
        $lista     = array();
        if(count($matricula)>0){
            foreach($matricula as $indice => $value){
                $lista[$indice]           = new stdClass();
                $lista[$indice]->codigo   = $value->ORDENP_Codigo;
                $lista[$indice]->nombres  = $value->PERSC_Nombre;
                $lista[$indice]->paterno  = $value->PERSC_ApellidoPaterno;
                $lista[$indice]->materno  = $value->PERSC_ApellidoMaterno;
                $lista[$indice]->tipoestudio = $value->TIPC_Nombre;
				$lista[$indice]->ciclo    = $value->COMPC_Nombre;
                $lista[$indice]->estado   = $value->ORDENC_FlagEstado;
                $lista[$indice]->fechareg = $value->fechareg;
                $lista[$indice]->fecha    = $value->ORDENC_Fecot;
            }
        }
        $configuracion = $this->configuracion;
        $configuracion['base_url']    = base_url()."index.php/ventas/orden/listar";
        $configuracion['total_rows']  = $registros;
        $this->pagination->initialize($configuracion);
        /*Enviamos los datos a la vista*/
        $data['lista']        = $lista;
        $data['menu']         = $menu;
        $data['form_open']    = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));     
        $data['form_close']   = form_close();         
        $data['j']            = $j;
        $data['registros']    = $registros;
        $data['paginacion']   = $this->pagination->create_links();
        $this->load->view("ventas/matricula_index",$data);
    }

    public function editar($accion,$codigo=""){
        $ciclo = $this->input->get_post('ciclo'); 
        $tipoestudio = $this->input->get_post('tipoestudio'); 
        $local = $this->input->get_post('local'); 
        $aula  = $this->input->get_post('aula'); 
        $lista = new stdClass();
        if($accion == "e"){
            $filter             = new stdClass();
            $filter->orden      = $codigo;
            $orden              = $this->matricula_model->obtener($filter);
            $lista->paterno     = $orden->PERSC_ApellidoPaterno;  
            $lista->materno     = $orden->PERSC_ApellidoMaterno;  
            $lista->nombres     = $orden->PERSC_Nombre;  
            $lista->tipoestudio = $tipoestudio!=""?$tipoestudio:$orden->TIPP_Codigo; 
            $lista->fecha       = date_sql($orden->ORDENC_Fecot);  
            $lista->alumno      = $orden->CLIP_Codigo; 
            $lista->matricula   = $orden->ORDENP_Codigo;
            $lista->estado      = $orden->ORDENC_FlagEstado;
            $lista->ciclo       = $ciclo!=""?$ciclo:$orden->CICLOP_Codigo;
			$lista->local       = $local!=""?$local:$orden->LOCP_Codigo;
            $lista->aula        = $aula!=""?$aula:$orden->AULAP_Codigo;
        }
        elseif($accion == "n"){ 
            $lista->paterno     = "";  
            $lista->materno     = ""; 
            $lista->nombres     = "";  
            $lista->tipoestudio = $tipoestudio; 
            $lista->fecha       = date("d/m/Y",time());
            $lista->alumno      = ""; 
            $lista->matricula   = "";
            $lista->estado      = "1";
            $lista->ciclo       = $ciclo;
			$lista->local       = $local;
            $lista->aula        = $aula;
        } 
        $arrEstado          = array("0"=>"::Seleccione::","1"=>"ACTIVO","2"=>"INACTIVO");
        $data['titulo']     = $accion=="e"?"Editar Matricula":"Nueva Matricula"; 
        $data['form_open']  = form_open('',array("name"=>"frmPersona","id"=>"frmPersona","onsubmit"=>"return valida_guiain();"));     
        $data['form_close'] = form_close();         
        $data['lista']	    = $lista;  
        $data['accion']	    = $accion;  
		$filter = new stdClass();
		$filter->ciclo = $lista->ciclo;
		$filter2 = new stdClass();
		$filter2->local = $lista->local;		
        $data['selcurso']   = form_dropdown('tipoestudio',$this->tipoestudio_model->seleccionar('0',$filter),$lista->tipoestudio,"id='curso' class='comboMedio'");         
        $data['selciclo']   = form_dropdown('ciclo',$this->ciclo_model->seleccionar(),$lista->ciclo,"id='ciclo' class='comboMedio'");         
        $data['selaula']    = form_dropdown('aula',$this->aula_model->seleccionar('0',$filter2),$lista->aula,"id='aula' class='comboMedio'");         
        $data['sellocal']   = form_dropdown('local',$this->local_model->seleccionar('0'),$lista->local,"id='local' class='comboMedio'"); 
        $data['selestado']  = form_dropdown('estado',$arrEstado,$lista->estado,"id='estado' class='comboMedio'");
        $data['oculto']     = form_hidden(array("accion"=>$accion,"codigo"=>$codigo));
		$this->load->view("ventas/matricula_nuevo",$data);
    }

    public function grabar(){
        $accion = $this->input->get_post('accion');
        $codigo = $this->input->get_post('codigo');
        $data   = array(
                        "CICLOP_Codigo"       => $this->input->post('ciclo'),
			"CLIP_Codigo"        => $this->input->post('alumno'),
                        "AULAP_Codigo"       => $this->input->post('aula'),
                        "TIPP_Codigo"        => $this->input->post('tipoestudio'),
                        "ORDENC_Fecot"       => date_sql_ret($this->input->post('fecha')),
                        "ORDENC_FlagEstado"  => $this->input->post('estado'),
                        "ORDENC_FechaModificacion" => date("Y-m-d",time())
                       );
        $resultado = false;
        $filter = new stdClass();
        $filter->cliente  = $this->input->post('alumno');
        $filter->producto = $this->input->post('curso');
        $ordenes = $this->matricula_model->listar($filter);  
        if($accion == "n"){
            if(count($ordenes)==0){
                $resultado = true;
                $this->matricula_model->insertar($data);                      
            }
        }
        elseif($accion == "e"){ 
            if(count($ordenes)==0){
                $resultado = true;
                $this->matricula_model->modificar($codigo,$data);                                
            }
            else{
                $numero = $ordenes[0]->ORDENP_Codigo;
                if($numero==$this->input->post('matricula')){
                    $resultado = true;
                    $this->matricula_model->modificar($codigo,$data);                
                }  
            }
        }                                     
        echo json_encode($resultado);
    }
	
    public function eliminar(){
        $codigo = $this->input->post('codigo');
        $filter = new stdClass();
        $filter->orden = $codigo;
        $actividades = $this->actividad_model->listar($filter);
        $resultado = false;
        if(count($actividades)==0){
            $this->matricula_model->eliminar($codigo);
            $resultado = true;
        }
        echo json_encode($resultado);
    }

    public function ver($codigo){
        $filter           = new stdClass();
        $filter->orden    = $codigo;
        $ordenes          = $this->matricula_model->obtener($filter);
        $codproducto      = $ordenes->PROD_Codigo;
        $codcliente       = $ordenes->CLIP_Codigo;
        $filter           = new stdClass();
        $filter->cliente  = $codcliente; 
        $clientes         = $this->alumno_model->obtener($filter);
        $filter           = new stdClass();
        $filter->producto = $codproducto; 
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
      
    public function obtener_tipOt($tipoOt){
        $this->load->model(maestros.'tipoot_model');
        $tipoOt = $this->tipoot_model->obtener($tipoOt);
        echo json_encode($tipoOt);
    }
    
    public function rpt_por_facturar_x_intervalos(){
        
        $hoy         = date("d/m/Y",time());
        $fFin_ini    = date("d/m/Y",time());
        $fInicio_ini = date("d/m/Y",time());
        $fFin    = date("d/m/Y",time());
        $fInicio = date("d/m/Y",time());
        
        
        
        $tipOt       = $this->input->get_post('codperiodo');
        $tipo        = $this->input->get_post('tipo');
        $frecuencia  = $this->input->get_post('frecuencia');
        $nivel       = $this->input->get_post('nivel');     
       // $codcli      = $this->input->get_post('codcli');
            
        $arrFrecuencia = array(""=>"::Seleccione::","1"=>"Quincenal","2"=>"Mensual","3"=>"Semestral","4"=>"Anual");
        $periodoOt   = form_dropdown('codperiodo',$this->periodoot_model->seleccionar('',''),$tipOt,"id='codperiodo' class='comboMedio'");   
        $cboFrecuencia = form_dropdown('frecuencia',$arrFrecuencia,($frecuencia==""?1:$frecuencia),"id='frecuencia' class='comboMedio'");   
        $arrFila     = array();
        $arrayExcel  = array();
        $arrFecha    = array();
        $arrTipoC    = array();
        $arr_acumulado_saldosoles_ant    = array();
        $arr_acumulado_saldodolares_ant  = array();;
        $arr_acumuado_factSoles          = array();
        $arr_acumuado_factDolares        = array();
        $arr_acumuado_saldoSoles         = array();
        $arr_acumuado_saldoDolares       = array();
        $arr_acumuado_saldoSoles_total   = array();
        $arr_acumuado_saldoDolares_total = array();
        $arr_acumulado_valor_venta       = array();
        $arr_acumulado_ots_nuevasSoles   = array();
        $arr_acumulado_ots_nuevasDolares = array();
        $arr_acumulado_ots_factSoles_intervalo   = array();
        $arr_acumulado_ots_factDolares_intervalo = array();
        $arr_acumulado_ots_factSoles   = array();
        $arr_acumulado_ots_factDolares = array();   
        $this->form_validation->set_rules('codperiodo','Periodo','required');
        $this->form_validation->set_rules('tipo','Tipo','required');
        $this->form_validation->set_rules('fInicio','F.Inicio','required');
        $this->form_validation->set_rules('fFin','F.Fin','required');      
        $this->form_validation->set_rules('frecuencia','Frecuencia','required');     
        if($this->form_validation->run() == TRUE){
            $ver         = $this->input->get_post('ver');
            $fInicio     = $this->input->get_post('fInicio_ini');
            $fFin        = $this->input->get_post('fFin_ini');
            
            
            $fInicio_ini = $this->input->get_post('fInicio');
            $fFin_ini    = $this->input->get_post('fFin');
            $arrFecha1   = explode("/",$fInicio_ini);
            $arrFecha2   = explode("/",$fFin);
            $arrhoy      = explode("/",$hoy);
            $fFecha1 = mktime( 0, 0, 0,$arrFecha1[1]+1-1,$arrFecha1[0]+1-1,$arrFecha1[2]+1-1); 
            $fFecha2 = mktime( 0, 0, 0,$arrFecha2[1]+1-1,$arrFecha2[0]+1-1,$arrFecha2[2]+1-1); 
            $fHoy    = mktime( 0, 0, 0,$arrhoy[1]+1-1,$arrhoy[0]+1-1,$arrhoy[2]+1-1); 
            
            /*Armo mi matriz de intervalos*/
            $anio = $arrFecha1[2];
            $mes  = $arrFecha1[1];
            $dia  = "01";
            $arrFecha = array();
            $cmes = 0;
            
            
                for($i=0;$i<30;$i++){
                    switch($frecuencia){
                        case 1:
                            $f1 = mktime( 0, 0, 0,(int)$mes, ($i%2==0?"1":"17"),(int)$anio); 
                            $f2 = mktime( 0, 0, 0,(int)$mes, ($i%2==0?"16":date("t",$f1)),(int)$anio); 
                            if($mes=="12" && $cmes>=1){$cmes++;$anio++;$mes="0";} 
                            if($i%2!=0) $mes++;                        
                            break;
                        case 2:
                            $f1 = mktime( 0, 0, 0,(int)$mes,(int)1,(int)$anio); 
                            $f2 = mktime( 0, 0, 0,(int)$mes,(int)date("t",$f1),(int)$anio);  
                            if($mes=="12"){$anio++;$mes="0";} 
                            $mes++;
                            break;
                        case 3:
                            $f1 = mktime( 0, 0, 0,(int)$mes,(int)1,(int)$anio); 
                            $fx = mktime( 0, 0, 0,(int)$mes+5,(int)1,(int)$anio); 
                            $f2 = mktime( 0, 0, 0,(int)$mes+5,(int)date("t",$fx),(int)$anio); 
                            $mes = $mes + 5;
                            if($mes=="11"){$anio++;$mes="0";} 
                            $mes++;                        
                            break;
                        case 4:
                            $f1 = mktime( 0, 0, 0,(int)$mes,(int)1,(int)$anio); 
                            $fx = mktime( 0, 0, 0,(int)$mes+11,(int)1,(int)$anio); 
                            $f2 = mktime( 0, 0, 0,(int)$mes+11,(int)date("t",$fx),(int)$anio); 
                            $mes = $mes + 11;
                            if($mes=="11"){$anio++;$mes="0";} 
                            $mes++; 
                            break;
                    }
                    $arrFecha[$i] = array(date("d/m/Y",$f1),date("d/m/Y",$f2));
                    if($fFecha2<=$f2){
                        $arrFecha[$i] = array(date("d/m/Y",$f1),$fFin);
                        break;
                    }
                }
            
            
             if($tipo=="html" && $nivel=="1"){
                /*Construyo las tablas para los intervalos*/
                foreach($arrFecha as $indice=>$value){
                    $fInicio   = $value[0];
                    $fFin      = $value[1];
                    $resultado = $this->ot_model->rpt_por_facturar_x_intervalos($fInicio_ini,$tipOt,$fInicio,$fFin);
                    $fila="";
                    $codcli = "";
                    $cliente     = "";
                    $sumadolares = "";
                    $sumasoles   = "";
                    $factDolares = "";
                    $factSoles   = "";
                    $anio_ant    = "";
                    $item        = 1;
                    $acumuado_factDolares        = 0;
                    $acumuado_factSoles          = 0;
                    $acumuado_saldoSoles         = 0;
                    $acumuado_saldoDolares       = 0;
                    $acumuado_saldoDolares_total = 0;
                    $acumuado_saldoSoles_total   = 0;
                    $acumulado_saldosoles_ant    = 0;
                    $acumulado_saldodolares_ant  = 0;
                    $acumulado_valor_venta       = 0;
                    $acumulado_rend              = 0;
                    $acumulado_ots_nuevasSoles   = 0;
                    $acumulado_ots_nuevasDolares = 0;
                    $acumulado_ots_factSoles_intervalo   = 0;
                    $acumulado_ots_factDolares_intervalo = 0;
                    $acumulado_ots_factSoles     = 0;
                    $acumulado_ots_factDolares   = 0;
                    $arrTc    = $this->tc_model->obtener($fFin);
                    
              //      print_r($arrTc->Valor_2);
                    
                    $tc       = (count($arrTc)>0?$arrTc->Valor_2:1);
                 
                    if($tc==0 or $tc!='')
                    {
                        $tc=1;
                    }
                      
                    $codigo   = "";
                    $factDol  = 0;
                    $factSol  = 0;
                    
                    foreach($resultado as $indice2 => $value2){
                        $saldodolares_ant = 0;
                        $saldosoles_ant   = 0;	
                        $cliente          = $value2->cliente;
                        $inicialdolares   = $value2->inicialdolares;
                        $inicialsoles     = $value2->inicialsoles;
                        $sumadolares      = $value2->sumadolares;
                        $sumasoles        = $value2->sumasoles;
                        $factDolares      = $value2->factDolares;
                        $factSoles        = $value2->factSoles;
                        $codcli           = $value2->codcli;
                        
                    
                        $valor_venta = $sumadolares + ($sumasoles/$tc);
                        if($valor_venta!=0){
                            $rend = 100-((($inicialsoles-$factSoles)/$tc)+($inicialdolares-$factDolares))*100/$valor_venta;
                        }else{
                            $rend = 0;
                        }
                        
                        
                        
                        
                        /*Ots nuevas y ots facturadas*/
                        $ots_nuevas     = $this->ot_model->ots_nuevas($tipOt, $codcli, $fInicio, $fFin);
                        $ots_facturadas = $this->ot_model->ots_facturadas($tipOt, $codcli, $fInicio, $fFin);
                        if($inicialsoles!=0 || $inicialdolares!=0 || ($inicialsoles-$factSoles)!=0 || ($inicialdolares-$factDolares)!=0){
                            $ots_nuevas_soles       = (count($ots_nuevas)>0?$ots_nuevas[0]->soles:"");
                            $ots_nuevas_dolares     = (count($ots_nuevas)>0?$ots_nuevas[0]->dolares:"");
                            $ots_facturadas_soles   = (count($ots_facturadas)>0?$ots_facturadas[0]->soles:"");
                            $ots_facturadas_dolares = (count($ots_facturadas)>0?$ots_facturadas[0]->dolares:"");
                            
                            
                            $fila.="<tr onclick='rpt_intervalos_detalle(\"".trim($codcli)."\",\"".trim(str_replace('/','',$fInicio))."\",\"".trim(str_replace('/','',$fFin))."\",\"".trim(str_replace('/','',$fFin_ini))."\");'>";
                           
                            $fila.="<td align='center'>".$item."</td>";
                            $fila.="<td align='left'><a href='javascript:;'>".$cliente."</a></td>";
                            $fila.="<td align='right'>".number_format($inicialsoles,2,".",",")."</td>";
                            $fila.="<td align='right'>".number_format($inicialdolares,2,".",",")."</td>";
                            $fila.="<td align='right'>".number_format($factSoles,2,".",",")."</td>";
                            $fila.="<td align='right'>".number_format($factDolares,2,".",",")."</td>";
                            $fila.="<td align='right'>".number_format(($inicialsoles-$factSoles),2,".",",")."</td>";				
                            $fila.="<td align='right'>".number_format(($inicialdolares-$factDolares),2,".",",")."</td>";
                            //$fila.="<td align='right'>".number_format(($inicialsoles-$factSoles)+($inicialdolares-$factDolares)*$tc,2,".",",")."</td>";
                            $fila.="<td align='right'>".number_format((($inicialsoles-$factSoles)/$tc)+($inicialdolares-$factDolares),2,".",",")."</td>";
                            $fila.="<td align='right'>".number_format($valor_venta,2,".",",")."</td>";
                            $fila.="<td align='right' style='background-color: #CCFFCC; opacity:0.8'>".number_format($rend,2,".",",")."</td>";                          
                            $fila.="</tr>";
                            
                            
                            $codigo_ant = $codigo;
                            $factDol_ant = $factDol;
                            $factSol_ant = $factSol;
                            $anio_ant    = $anio;
                            $mes_ant     = $mes;
                            $acumulado_saldosoles_ant   = $acumulado_saldosoles_ant + $inicialsoles;
                            $acumulado_saldodolares_ant = $acumulado_saldodolares_ant + $inicialdolares; 
                            $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                            $acumuado_factSoles    = $acumuado_factSoles + $factSoles;
                            $acumuado_saldoDolares = $acumuado_saldoDolares + ($inicialdolares-$factDolares);
                            $acumuado_saldoSoles   = $acumuado_saldoSoles + ($inicialsoles-$factSoles);
                            $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($inicialsoles-$factSoles)/$tc)+($inicialdolares-$factDolares);
                            $acumuado_saldoSoles_total   = $acumuado_saldoSoles_total + ($inicialsoles-$factSoles)+($inicialdolares-$factDolares)*$tc;
                            $acumulado_valor_venta       = $acumulado_valor_venta + $valor_venta;
                            $acumulado_ots_nuevasSoles   = $acumulado_ots_nuevasSoles + $ots_nuevas_soles;
                            $acumulado_ots_nuevasDolares = $acumulado_ots_nuevasDolares + $ots_nuevas_dolares;
                            $acumulado_ots_factSoles_intervalo   = $acumulado_ots_factSoles_intervalo + ($ots_facturadas_soles-$factSoles);
                            $acumulado_ots_factDolares_intervalo = $acumulado_ots_factDolares_intervalo + ($ots_facturadas_dolares-$factDolares);
                            $acumulado_ots_factSoles     = $acumulado_ots_factSoles + $ots_facturadas_soles;
                            $acumulado_ots_factDolares   = $acumulado_ots_factDolares + $ots_facturadas_dolares;
                            $item++;
                        }
                    }
                    $arrCantidad[] = count($resultado);
                    $arrFila[]     = $fila;
                    $arrTipoC[]    = $tc;
                    $arr_acumulado_saldodolares_ant[]  = $acumulado_saldodolares_ant;
                    $arr_acumulado_saldosoles_ant[]    = $acumulado_saldosoles_ant;
                    $arr_acumuado_factDolares[]        = $acumuado_factDolares;
                    $arr_acumuado_factSoles[]          = $acumuado_factSoles;
                    $arr_acumuado_saldoDolares[]       = $acumuado_saldoDolares;
                    $arr_acumuado_saldoSoles[]         = $acumuado_saldoSoles;
                    $arr_acumuado_saldoDolares_total[]  = $acumuado_saldoDolares_total;
                    $arr_acumuado_saldoSoles_total[]   = $acumuado_saldoSoles_total;
                    $arr_acumulado_valor_venta[]       = $acumulado_valor_venta;
                    $arr_rend[]                        = $acumulado_rend;
                    $arr_acumulado_ots_nuevasSoles[]   = $acumulado_ots_nuevasSoles;
                    $arr_acumulado_ots_nuevasDolares[] = $acumulado_ots_nuevasDolares;
                    $arr_acumulado_ots_factSoles_intervalo[]   = $acumulado_ots_factSoles_intervalo;
                    $arr_acumulado_ots_factDolares_intervalo[] = $acumulado_ots_factDolares_intervalo;
                    $arr_acumulado_ots_factSoles[]     = $acumulado_ots_factSoles;
                    $arr_acumulado_ots_factDolares[]   = $acumulado_ots_factDolares;
                }
            }
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        
        if($tipo=="excel" && $nivel=="1"){   
        $hoy         = date("d/m/Y",time());

        $tipOt       = $this->input->get_post('codperiodo');
        $tipo        = $this->input->get_post('tipo');
                         
            $fInicio     = $this->input->get_post('fInicio_ini');
            $fFin        = $this->input->get_post('fFin_ini');
            
            $fInicio_ini = $this->input->get_post('fInicio');
            $fFin_ini    = $this->input->get_post('fFin');
                    
          // $fInicio_ini = $fInicio;
           // $fFin_ini    = $fFin;
            $arrFecha1   = explode("/",$fInicio_ini);
            $arrFecha2   = explode("/",$fFin);
            $arrhoy      = explode("/",$hoy);
            
            
            $fFecha1 = mktime( 0, 0, 0,$arrFecha1[1]+1-1,$arrFecha1[0]+1-1,$arrFecha1[2]+1-1); 
            $fFecha2 = mktime( 0, 0, 0,$arrFecha2[1]+1-1,$arrFecha2[0]+1-1,$arrFecha2[2]+1-1); 
            $fHoy    = mktime( 0, 0, 0,$arrhoy[1]+1-1,$arrhoy[0]+1-1,$arrhoy[2]+1-1); 
            


                    $resultado3 = $this->ot_model->rpt_por_facturar_x_intervalos($fInicio_ini,$tipOt,$fInicio,$fFin);
                    
                    $fila        ="2";
                    $codcli      = "";
                    $cliente     = "";
                    $sumadolares = "";
                    $sumasoles   = "";
                    $factDolares = "";
                    $factSoles   = "";
                    $anio_ant    = "";
                    $item        = 1;
                    $acumuado_factDolares        = 0;
                    $acumuado_factSoles          = 0;
                    $acumuado_saldoSoles         = 0;
                    $acumuado_saldoDolares       = 0;
                    $acumuado_saldoDolares_total = 0;
                    $acumuado_saldoSoles_total   = 0;
                    $acumulado_saldosoles_ant    = 0;
                    $acumulado_saldodolares_ant  = 0;
                    $acumulado_valor_venta       = 0;
                    $acumulado_rend              = 0;
            
                    $codigo   = "";
                    $factDol  = 0;
                    $factSol  = 0;
            
                    
                    
            $ver         = $this->input->get_post('ver');
            $arrTc    = $this->tc_model->obtener($fFin);
            $tc       = (count($arrTc)>0?$arrTc->Valor_2:1);
                    
                    
                $xls = new Spreadsheet_Excel_Writer();
                $xls->send("prueba.xls");

              $sheet = $xls->addWorksheet('Hoja2');    
         
              $sheet->setColumn(0,0,7); //COLUMNA A1
              $sheet->setColumn(1,1,40); //COLUMNA B2
              $sheet->setColumn(2,2,15); //COLUMNA C3
              $sheet->setColumn(3,3,15); //COLUMNA D4
              $sheet->setColumn(4,4,15); //COLUMNA E5
              $sheet->setColumn(5,5,15); //COLUMNA F6
              $sheet->setColumn(6,6,15); //COLUMNA G7
              $sheet->setColumn(7,7,15); //COLUMNA H8
              $sheet->setColumn(8,8,15); //COLUMNA I9
              $sheet->setColumn(9,9,15); //COLUMNA J10
              $sheet->setColumn(10,10,15); //COLUMNA K11
              
              $sheet->setColumn(11,11,15); //COLUMNA L12
              $sheet->setColumn(12,12,15); //COLUMNA M13
              $sheet->setColumn(13,13,15); //COLUMNA N14
              
              
              $sheet->setRow(0, 51);
              $sheet->setRow(1,62);
             
    
              
              $format_bold=$xls->addFormat();
              $format_bold->setBold();
              $format_bold->setvAlign('vcenter');
              $format_bold->sethAlign('center');
              $format_bold->setBorder(1);
              $format_bold->setTextWrap();
             
              
              $format_bold2=$xls->addFormat();
              $format_bold2->setvAlign('vcenter');
              $format_bold2->sethAlign('right');
              $format_bold2->setBorder(1);
              $format_bold2->setTextWrap();
              
              $format_titulo=$xls->addFormat();
              $format_titulo->setBold();
              $format_titulo->setSize(10);
              $format_titulo->setvAlign('vcenter');
              $format_titulo->sethAlign('center');
              $format_titulo->setBorder(1);
              $format_titulo->setTextWrap();

  
              $sheet->mergeCells(0,0,0,10);  
              

                    $sheet->write(0,3,"REPORTE",$format_titulo); $sheet->write(0,4,"POR",$format_titulo);  $sheet->write(0,5,"FACTURAR",$format_titulo);  $sheet->write(0,6,"POR RANGO",$format_titulo);  $sheet->write(0,7,"DE FECHAS",$format_titulo);  $sheet->write(0,8,"(NO VENTAS PERIODO)",$format_titulo);
                    $sheet->write(0,0,"T.C.: ".$tc." ",$format_bold);  $sheet->write(0,1," REPORTE DEL ".$fInicio." AL ".$fFin."",$format_bold); 
                    
                    $sheet->write(1,0,"No",$format_bold);  $sheet->write(1,1,"CLIENTE",$format_bold);  $sheet->write(1,2,"SALDO POR FACTURAR S/.",$format_bold);  $sheet->write(1,3,"SALDO POR FACTURAR $.",$format_bold);   $sheet->write(1,4,"MONTO FACTURADO S/.",$format_bold);      $sheet->write(1,5,"MONTO FACTURADO $.",$format_bold);   $sheet->write(1,6,"SALDO POR FACTURAR S/.",$format_bold);    $sheet->write(1,7,"SALDO POR FACTURAR $",$format_bold);      $sheet->write(1,8,"SALDO TOTAL POR FACTURAR EN $",$format_bold);      $sheet->write(1,9,"VALOR TOTAL VENTA OT $",$format_bold);     $sheet->write(1,10,"RENDIMIENTO FACTURACION (%)",$format_bold);     
                    
  
                
               
                  foreach($resultado3 as $indice2 => $value2)
                  {
                        $saldodolares_ant = 0;
                        $saldosoles_ant   = 0;	
                        $cliente          = $value2->cliente;
                        $inicialdolares   = $value2->inicialdolares;
                        $inicialsoles     = $value2->inicialsoles;
                        $sumadolares      = $value2->sumadolares;
                        $sumasoles        = $value2->sumasoles;
                        $factDolares      = $value2->factDolares;
                        $factSoles        = $value2->factSoles;
                        $codcli           = $value2->codcli;
                        
                        $valor_venta = ($sumadolares + ($sumasoles/$tc));
                        
                        if($valor_venta!=0){
                            $rend = 100-((($inicialsoles-$factSoles)/$tc)+($inicialdolares-$factDolares))*100/$valor_venta;
                        }else{
                            $rend = 0;
                        }
    
                        
                        $ots_nuevas     = $this->ot_model->ots_nuevas($tipOt, $codcli, $fInicio, $fFin);
                        $ots_facturadas = $this->ot_model->ots_facturadas($tipOt, $codcli, $fInicio, $fFin);
                        if($inicialsoles!=0 || $inicialdolares!=0 || ($inicialsoles-$factSoles)!=0 || ($inicialdolares-$factDolares)!=0){
                            $ots_nuevas_soles       = (count($ots_nuevas)>0?$ots_nuevas[0]->soles:"");
                            $ots_nuevas_dolares     = (count($ots_nuevas)>0?$ots_nuevas[0]->dolares:"");
                            $ots_facturadas_soles   = (count($ots_facturadas)>0?$ots_facturadas[0]->soles:"");
                            $ots_facturadas_dolares = (count($ots_facturadas)>0?$ots_facturadas[0]->dolares:"");
               
       
                            $sheet->write($fila,0,$item,$format_bold2);
                            $sheet->write($fila,1,$cliente,$format_bold2);
                            $sheet->write($fila,2,$inicialsoles,$format_bold2);
                            $sheet->write($fila,3,$inicialdolares,$format_bold2);
                            $sheet->write($fila,4,$factSoles,$format_bold2);
                            $sheet->write($fila,5,$factDolares,$format_bold2);
                            $sheet->write($fila,6,$inicialsoles-$factSoles,$format_bold2);
                            $sheet->write($fila,7,$inicialdolares-$factDolares,$format_bold2);
                            $sheet->write($fila,8,((($inicialsoles-$factSoles)/$tc)+($inicialdolares-$factDolares)),$format_bold2);
                            $sheet->write($fila,9,$valor_venta,$format_bold2);
                            $sheet->write($fila,10,$rend,$format_bold2);
                            
                            $codigo_ant  = $codigo;
                            $factDol_ant = $factDol;
                            $factSol_ant = $factSol;
                            $anio_ant    = $anio;
                            $mes_ant     = $mes;
                            
                            $acumulado_saldosoles_ant   = $acumulado_saldosoles_ant + $inicialsoles;
                            $acumulado_saldodolares_ant = $acumulado_saldodolares_ant + $inicialdolares; 
                            $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                            $acumuado_factSoles    = $acumuado_factSoles + $factSoles;
                            $acumuado_saldoDolares = $acumuado_saldoDolares + ($inicialdolares-$factDolares);
                            $acumuado_saldoSoles   = $acumuado_saldoSoles + ($inicialsoles-$factSoles);
                            $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($inicialsoles-$factSoles)/$tc)+($inicialdolares-$factDolares);
                            $acumuado_saldoSoles_total   = $acumuado_saldoSoles_total + ($inicialsoles-$factSoles)+($inicialdolares-$factDolares)*$tc;
                            $acumulado_valor_venta       = $acumulado_valor_venta + $valor_venta;
                            
                  
                            $acum_vta = $acumulado_valor_venta;
                        
          
                            $acumulado_rend     = (100-($acumuado_saldoDolares_total*100/$acum_vta));

                            
                            $item++;
                            $fila++;
                        
                        }

          }
                 
                               
                    $sheet->write($fila,2,$acumulado_saldosoles_ant,$format_bold2);
                    $sheet->write($fila,3,$acumulado_saldodolares_ant,$format_bold2);
                    $sheet->write($fila,4,$acumuado_factSoles,$format_bold2);
                    $sheet->write($fila,5,$acumuado_factDolares,$format_bold2);
                    $sheet->write($fila,6,$acumuado_saldoSoles,$format_bold2);
                    $sheet->write($fila,7,$acumuado_saldoDolares,$format_bold2);
                    $sheet->write($fila,8,$acumuado_saldoDolares_total,$format_bold2);
                    $sheet->write($fila,9,$acumulado_valor_venta,$format_bold2);
                    $sheet->write($fila,10,$acumulado_rend,$format_bold2);

                 $fila++;   
                    
                    
                $xls->close();               
            }
        }
        
        
        
        
        

        if($tipo=="excel" && $nivel=="2"){
         
        $fInicio_ini = date("d/m/Y",time());
        $tipOt       = $this->input->get_post('codperiodo');
        $fInicio_ini = $this->input->get_post('fInicio');
        
        $tipo        = $this->input->get_post('tipo');
        $codcli        = $this->input->get_post('codcli');
 
       // $fInicio_ini = "01/01/2011";
        $del_ini     = $this->input->get_post('del');
        $al_ini     = $this->input->get_post('al');
        
        $del_d = substr($del,0,2);
        $del_m = substr($del,2,2); 
        $del_a = substr($del,4,4); 
        $al_d = substr($al,0,2);
        $al_m = substr($al,2,2); 
        $al_a = substr($al,4,4); 
        $hasta_d   = substr($hasta,0,2);
        $hasta_m   = substr($hasta,2,2);
        $hasta_a   = substr($hasta,4,4);
        $del       = $del_d."/".$del_m."/".$del_a;
        $al        = $al_d."/".$al_m."/".$al_a;
        $hasta     = $hasta_d."/".$hasta_m."/".$hasta_a;
        $tipOt     = "'12'";
        $arrTc     = $this->tc_model->obtener($al);
        $tc2       = $arrTc->Valor_2;
        $tc2       = ($tc2=="")?"1":$tc2;  
            
              $xls = new Spreadsheet_Excel_Writer();
              $xls->send("detalle.xls");

              $sheet = $xls->addWorksheet('Hoja3');    
         
              $sheet->setColumn(0,0,7); //COLUMNA A1
              $sheet->setColumn(1,1,40); //COLUMNA B2
              $sheet->setColumn(2,2,15); //COLUMNA C3
              $sheet->setColumn(3,3,15); //COLUMNA D4
              $sheet->setColumn(4,4,15); //COLUMNA E5
              $sheet->setColumn(5,5,15); //COLUMNA F6
              $sheet->setColumn(6,6,15); //COLUMNA G7
              $sheet->setColumn(7,7,15); //COLUMNA H8
              $sheet->setColumn(8,8,15); //COLUMNA I9
              $sheet->setColumn(9,9,15); //COLUMNA J10
              $sheet->setColumn(10,10,15); //COLUMNA K11
              
              $sheet->setColumn(11,11,15); //COLUMNA L12
              $sheet->setColumn(12,12,15); //COLUMNA M13
              $sheet->setColumn(13,13,15); //COLUMNA N14
              
              
              $sheet->setRow(0, 51);
              $sheet->setRow(1,62);
             
    
              
              $format_bold=$xls->addFormat();
              $format_bold->setBold();
              $format_bold->setvAlign('vcenter');
              $format_bold->sethAlign('center');
              $format_bold->setBorder(1);
              $format_bold->setTextWrap();
             
              
              $format_bold2=$xls->addFormat();
              $format_bold2->setvAlign('vcenter');
              $format_bold2->sethAlign('right');
              $format_bold2->setBorder(1);
              $format_bold2->setTextWrap();
              
              $format_titulo=$xls->addFormat();
              $format_titulo->setBold();
              $format_titulo->setSize(10);
              $format_titulo->setvAlign('vcenter');
              $format_titulo->sethAlign('center');
              $format_titulo->setBorder(1);
              $format_titulo->setTextWrap();

  
              $sheet->mergeCells(0,0,0,10);  
              

    //                $sheet->write(0,3,"REPORTE",$format_titulo); $sheet->write(0,4,"POR",$format_titulo);  $sheet->write(0,5,"FACTURAR",$format_titulo);  $sheet->write(0,6,"POR RANGO",$format_titulo);  $sheet->write(0,7,"DE FECHAS",$format_titulo);  $sheet->write(0,8,"(NO VENTAS PERIODO)",$format_titulo);
    //                $sheet->write(0,0,"T.C.: ".$tc." ",$format_bold);  $sheet->write(0,1," REPORTE DEL ".$fInicio." AL ".$fFin."",$format_bold); 
      //              
     //               $sheet->write(1,0,"No",$format_bold);  $sheet->write(1,1,"CLIENTE",$format_bold);  $sheet->write(1,2,"SALDO POR FACTURAR S/.",$format_bold);  $sheet->write(1,3,"SALDO POR FACTURAR $.",$format_bold);   $sheet->write(1,4,"MONTO FACTURADO S/.",$format_bold);      $sheet->write(1,5,"MONTO FACTURADO $.",$format_bold);   $sheet->write(1,6,"SALDO POR FACTURAR S/.",$format_bold);    $sheet->write(1,7,"SALDO POR FACTURAR $",$format_bold);      $sheet->write(1,8,"SALDO TOTAL POR FACTURAR EN $",$format_bold);      $sheet->write(1,9,"VALOR TOTAL VENTA OT $",$format_bold);     $sheet->write(1,10,"RENDIMIENTO FACTURACION (%)",$format_bold);     
                    
  

      
        $resultado6 = $this->ot_model->rpt_por_facturar_x_intervalos_detalle($fInicio_ini,$tipOt, $del, $al, $codcli);
        print("<pre>");
        print_r($resultado6);
        print("</pre>");
        $item2                = 1;
	$inicialdolares_total = 0;
	$inicialsoles_total   = 0;
	$factDolares_total    = 0;
	$factSoles_total      = 0;
	$saldoDolares_total   = 0;
	$saldoSoles_total     = 0;	
	$ventasoles_total     = 0;
	$ventadolares_total   = 0;
	$x_facturar_total_dolares_total = 0;
	$venta_total_dolares_total      = 0;
        
                    
                    
         foreach($resultado6 as $indice=>$value){
             
            $cliente        = $value->cliente;
            $inicialdolares = $value->inicialdolares;
            $inicialsoles   = $value->inicialsoles;
            $sumadolares    = $value->sumadolares;
            $sumasoles      = $value->sumasoles;
            $factDolares    = $value->factDolares;
            $factSoles      = $value->factSoles;		
            $numero         = $value->numero;	
            $ventadolares   = $value->valor_ventadolares;	
            $ventasoles     = $value->valor_ventasoles;
      
      
                    $fila        ="2";
                    $item        = 1;
    
               
                            $sheet->write($fila,0,$item,$format_bold2);
                            $sheet->write($fila,1,$numero,$format_bold2);
                            $sheet->write($fila,2,$inicialsoles,$format_bold2);
                            $sheet->write($fila,3,$inicialdolares,$format_bold2);
                            $sheet->write($fila,4,$factSoles,$format_bold2);
                            $sheet->write($fila,5,$factDolares,$format_bold2);
                            $sheet->write($fila,6,$inicialsoles-$factSoles,$format_bold2);
                            $sheet->write($fila,7,$inicialdolares-$factDolares,$format_bold2);
                            $sheet->write($fila,8,((($inicialsoles-$factSoles)/$tc)+($inicialdolares-$factDolares)),$format_bold2);
                            $sheet->write($fila,9,($ventasoles/$tc2)+($ventadolares),$format_bold2);
                            
   
                
                                    $x_facturar_total_dolares = (($inicialsoles-$factSoles)/$tc2)+($inicialdolares-$factDolares);
                                    $venta_total_dolares      = ($ventasoles/$tc2)+($ventadolares);
                                    if($venta_total_dolares!=0){
                                        $rendimiento = 100-($x_facturar_total_dolares*100/$venta_total_dolares);
                                    }
                                    else{
                                        $rendimiento = 0;
                                    }

                            $sheet->write($fila,10,$rendimiento,$format_bold2);


                
                $item++;
                $fila++;
                $inicialdolares_total = $inicialdolares_total + $inicialdolares;
                $inicialsoles_total   = $inicialsoles_total + $inicialsoles;
                $factDolares_total    = $factDolares_total + $factDolares;
                $factSoles_total      = $factSoles_total + $factSoles;
                $saldoDolares_total   = $saldoDolares_total + ($inicialdolares-$factDolares);
                $saldoSoles_total     = $saldoSoles_total + ($inicialsoles-$factSoles);
                //$ventadolares_total   = $ventadolares_total + $ventadolares;
                //$ventasoles_total     = $ventasoles_total + $ventasoles;
                $x_facturar_total_dolares_total = $x_facturar_total_dolares_total + $x_facturar_total_dolares;
                $venta_total_dolares_total      = $venta_total_dolares_total + $venta_total_dolares;
                
                
                
         }
                        if($venta_total_dolares_total!=0){
                            $rendimiento_total = 100-(($x_facturar_total_dolares_total)*100/$venta_total_dolares_total);
                        }
                        else{
                            $rendimiento_total = 0;
                        }
                               
                    $sheet->write($fila,2,$inicialdolares_total,$format_bold2);
                    $sheet->write($fila,3,$inicialsoles_total,$format_bold2);
                    $sheet->write($fila,4,$factDolares_total,$format_bold2);
                    $sheet->write($fila,5,$factSoles_total,$format_bold2);
                    $sheet->write($fila,6,$saldoDolares_total,$format_bold2);
                    $sheet->write($fila,7,$saldoSoles_total,$format_bold2);
                    $sheet->write($fila,8,$x_facturar_total_dolares_total,$format_bold2);
                    $sheet->write($fila,9,$venta_total_dolares_total,$format_bold2);
                    $sheet->write($fila,10,$rendimiento_total,$format_bold2);

                 $fila++;   
                    
                    
                $xls->close();               
           
        }
        
        
        
        
        $data['hoy']      = $hoy;

        $data['fFin_ini'] = $fFin;
        $data['fInicio_ini'] = $fInicio;
        
        $data['fFin'] = $fFin_ini;
        $data['fInicio'] = $fInicio_ini;
        
        $data['arrFila']     = $arrFila;
        $data['arrFecha']    = $arrFecha;
        $data['arrTipoC']    = $arrTipoC;
        $data['periodoOt']   = $periodoOt;
        $data['frecuenciaOt'] = $cboFrecuencia;
        $data['arr_acumulado_saldosoles_ant']   = $arr_acumulado_saldosoles_ant;
        $data['arr_acumulado_saldodolares_ant'] = $arr_acumulado_saldodolares_ant;
        $data['arr_acumuado_factSoles']         = $arr_acumuado_factSoles;
        $data['arr_acumuado_factDolares']       = $arr_acumuado_factDolares;
        $data['arr_acumuado_saldoSoles']        = $arr_acumuado_saldoSoles;
        $data['arr_acumuado_saldoDolares']      = $arr_acumuado_saldoDolares;
        $data['arr_acumuado_saldoSoles_total']  = $arr_acumuado_saldoSoles_total;
        $data['arr_acumuado_saldoDolares_total']= $arr_acumuado_saldoDolares_total;
        $data['arr_acumulado_valor_venta']      = $arr_acumulado_valor_venta;
        $data['arr_acumulado_ots_nuevasSoles']           = $arr_acumulado_ots_nuevasSoles;
        $data['arr_acumulado_ots_nuevasDolares']         = $arr_acumulado_ots_nuevasDolares;
        $data['arr_acumulado_ots_factSoles_intervalo']   = $arr_acumulado_ots_factSoles_intervalo;
        $data['arr_acumulado_ots_factDolares_intervalo'] = $arr_acumulado_ots_factDolares_intervalo;
        $data['arr_acumulado_ots_factSoles']             = $arr_acumulado_ots_factSoles;
        $data['arr_acumulado_ots_factDolares']           = $arr_acumulado_ots_factDolares;
        $this->load->view(ventas."ots_x_facturar_x_intervalos",$data);
    }
    
    public function rpt_por_facturar_x_intervalos_detalle($codcli,$del,$al,$hasta){  
        $tipOt       = $this->input->get_post('codperiodo');
        $fInicio_ini = $this->input->get_post('fInicio');
        $tipo        = $this->input->get_post('tipo');
        $del_ini     = $this->input->get_post('del');
        $al_ini     = $this->input->get_post('al');
        $del_d = substr($del,0,2);
        $del_m = substr($del,2,2); 
        $del_a = substr($del,4,4); 
        $al_d = substr($al,0,2);
        $al_m = substr($al,2,2); 
        $al_a = substr($al,4,4); 
        $hasta_d   = substr($hasta,0,2);
        $hasta_m   = substr($hasta,2,2);
        $hasta_a   = substr($hasta,4,4);
        $del       = $del_d."/".$del_m."/".$del_a;
        $al        = $al_d."/".$al_m."/".$al_a;
        $hasta     = $hasta_d."/".$hasta_m."/".$hasta_a;
        $arrTc     = $this->tc_model->obtener($al);
        $tc2       = $arrTc->Valor_2;
        $tc2       = ($tc2=="")?"1":$tc2;  
        $resultado = $this->ot_model->rpt_por_facturar_x_intervalos_detalle($fInicio_ini,$tipOt, $del, $al, $codcli);
        $item2                = 1;
	$inicialdolares_total = 0;
	$inicialsoles_total   = 0;
	$factDolares_total    = 0;
	$factSoles_total      = 0;
	$saldoDolares_total   = 0;
	$saldoSoles_total     = 0;	
	$ventasoles_total     = 0;
	$ventadolares_total   = 0;
	$x_facturar_total_dolares_total = 0;
	$venta_total_dolares_total      = 0;
        $fila2       = "";
        $filter      = new stdClass();
        $filter_not  = new stdClass();
        $filter->codcliente = $codcli;
        $razclientes = $this->alumno_model->obtener($filter,$filter_not);
        if($tipo=="html"){
         foreach($resultado as $indice=>$value){
            $cliente        = $value->cliente;
            $inicialdolares = $value->inicialdolares;
            $inicialsoles   = $value->inicialsoles;
            $sumadolares    = $value->sumadolares;
            $sumasoles      = $value->sumasoles;
            $factDolares    = $value->factDolares;
            $factSoles      = $value->factSoles;		
            $numero         = $value->numero;	
            $ventadolares   = $value->valor_ventadolares;	
            $ventasoles     = $value->valor_ventasoles;
            //if($inicialsoles!=0 && $inicialdolares!=0 && ($inicialsoles-$factSoles)!=0 && ($inicialdolares-$factDolares)!=0){
            
                
                $fila2.="<tr>";
                $fila2.="<td align='center'>".$item2."</td>";
                $fila2.="<td align='center'>".$numero."</td>";
                $fila2.="<td align='right'>".number_format($inicialsoles,2,",",".")."</td>";
                $fila2.="<td align='right'>".number_format($inicialdolares,2,",",".")."</td>";
                $fila2.="<td align='right'>".number_format($factSoles,2,",",".")."</td>";
                $fila2.="<td align='right'>".number_format($factDolares,2,",",".")."</td>";
                $fila2.="<td align='right'>".number_format(($inicialsoles-$factSoles),2,",",".")."</td>";				
                $fila2.="<td align='right'>".number_format(($inicialdolares-$factDolares),2,",",".")."</td>";			
                $fila2.="<td align='right'>".number_format((($inicialsoles-$factSoles)/$tc2)+($inicialdolares-$factDolares),2,",",".")."</td>";		
                $fila2.="<td align='right'>".number_format(($ventasoles/$tc2)+($ventadolares),2,",",".")."</td>";
                $x_facturar_total_dolares = (($inicialsoles-$factSoles)/$tc2)+($inicialdolares-$factDolares);
                $venta_total_dolares      = ($ventasoles/$tc2)+($ventadolares);
                if($venta_total_dolares!=0){
                    $rendimiento = 100-($x_facturar_total_dolares*100/$venta_total_dolares);
                }
                else{
                    $rendimiento = 0;
                }
                $fila2.="<td align='right' style='background-color: #CCFFCC; opacity:0.8'>".number_format($rendimiento,2,",",".")."</td>";			
                $fila2.="</tr>";
                
                
                $item2++;
                $inicialdolares_total = $inicialdolares_total + $inicialdolares;
                $inicialsoles_total   = $inicialsoles_total + $inicialsoles;
                $factDolares_total    = $factDolares_total + $factDolares;
                $factSoles_total      = $factSoles_total + $factSoles;
                $saldoDolares_total   = $saldoDolares_total + ($inicialdolares-$factDolares);
                $saldoSoles_total     = $saldoSoles_total + ($inicialsoles-$factSoles);
                //$ventadolares_total   = $ventadolares_total + $ventadolares;
                //$ventasoles_total     = $ventasoles_total + $ventasoles;
                $x_facturar_total_dolares_total = $x_facturar_total_dolares_total + $x_facturar_total_dolares;
                $venta_total_dolares_total      = $venta_total_dolares_total + $venta_total_dolares;
            //} 
        }
	if($venta_total_dolares_total!=0){
            $rendimiento_total = 100-(($x_facturar_total_dolares_total)*100/$venta_total_dolares_total);
	}
	else{
            $rendimiento_total = 0;
	}
  }
        
  
  
  
  
  
  
  elseif($tipo=="excel"){ 
     
                
              $xls = new Spreadsheet_Excel_Writer();
              $xls->send("detalle.xls");

              $sheet = $xls->addWorksheet('Hoja3');    
         
              $sheet->setColumn(0,0,7); //COLUMNA A1
              $sheet->setColumn(1,1,40); //COLUMNA B2
              $sheet->setColumn(2,2,15); //COLUMNA C3
              $sheet->setColumn(3,3,15); //COLUMNA D4
              $sheet->setColumn(4,4,15); //COLUMNA E5
              $sheet->setColumn(5,5,15); //COLUMNA F6
              $sheet->setColumn(6,6,15); //COLUMNA G7
              $sheet->setColumn(7,7,15); //COLUMNA H8
              $sheet->setColumn(8,8,15); //COLUMNA I9
              $sheet->setColumn(9,9,15); //COLUMNA J10
              $sheet->setColumn(10,10,15); //COLUMNA K11
              
              $sheet->setColumn(11,11,15); //COLUMNA L12
              $sheet->setColumn(12,12,15); //COLUMNA M13
              $sheet->setColumn(13,13,15); //COLUMNA N14
              
              
              $sheet->setRow(0, 51);
              $sheet->setRow(1,62);
             
    
              
              $format_bold=$xls->addFormat();
              $format_bold->setBold();
              $format_bold->setvAlign('vcenter');
              $format_bold->sethAlign('center');
              $format_bold->setBorder(1);
              $format_bold->setTextWrap();
             
              
              $format_bold2=$xls->addFormat();
              $format_bold2->setvAlign('vcenter');
              $format_bold2->sethAlign('right');
              $format_bold2->setBorder(1);
              $format_bold2->setTextWrap();
              
              $format_titulo=$xls->addFormat();
              $format_titulo->setBold();
              $format_titulo->setSize(10);
              $format_titulo->setvAlign('vcenter');
              $format_titulo->sethAlign('center');
              $format_titulo->setBorder(1);
              $format_titulo->setTextWrap();

  
              $sheet->mergeCells(0,0,0,10);  
              
//
//                    $sheet->write(0,3,"REPORTE",$format_titulo); $sheet->write(0,4,"POR",$format_titulo);  $sheet->write(0,5,"FACTURAR",$format_titulo);  $sheet->write(0,6,"POR RANGO",$format_titulo);  $sheet->write(0,7,"DE FECHAS",$format_titulo);  $sheet->write(0,8,"(NO VENTAS PERIODO)",$format_titulo);
//                    $sheet->write(0,0,"T.C.: ".$tc." ",$format_bold);  $sheet->write(0,1," REPORTE DEL ".$fInicio." AL ".$fFin."",$format_bold); 
//                    
//                    $sheet->write(1,0,"No",$format_bold);  $sheet->write(1,1,"CLIENTE",$format_bold);  $sheet->write(1,2,"SALDO POR FACTURAR S/.",$format_bold);  $sheet->write(1,3,"SALDO POR FACTURAR $.",$format_bold);   $sheet->write(1,4,"MONTO FACTURADO S/.",$format_bold);      $sheet->write(1,5,"MONTO FACTURADO $.",$format_bold);   $sheet->write(1,6,"SALDO POR FACTURAR S/.",$format_bold);    $sheet->write(1,7,"SALDO POR FACTURAR $",$format_bold);      $sheet->write(1,8,"SALDO TOTAL POR FACTURAR EN $",$format_bold);      $sheet->write(1,9,"VALOR TOTAL VENTA OT $",$format_bold);     $sheet->write(1,10,"RENDIMIENTO FACTURACION (%)",$format_bold);     
//                    
//  

      
        $resultado6 = $this->ot_model->rpt_por_facturar_x_intervalos_detalle($fInicio_ini,$tipOt, $del, $al, $codcli);
        print("<pre>");
        print_r($resultado6);
        print("</pre>");
        $item2                = 1;
	$inicialdolares_total = 0;
	$inicialsoles_total   = 0;
	$factDolares_total    = 0;
	$factSoles_total      = 0;
	$saldoDolares_total   = 0;
	$saldoSoles_total     = 0;	
	$ventasoles_total     = 0;
	$ventadolares_total   = 0;
	$x_facturar_total_dolares_total = 0;
	$venta_total_dolares_total      = 0;
        
                    
                    
         foreach($resultado6 as $indice=>$value){
             
            $cliente        = $value->cliente;
            $inicialdolares = $value->inicialdolares;
            $inicialsoles   = $value->inicialsoles;
            $sumadolares    = $value->sumadolares;
            $sumasoles      = $value->sumasoles;
            $factDolares    = $value->factDolares;
            $factSoles      = $value->factSoles;		
            $numero         = $value->numero;	
            $ventadolares   = $value->valor_ventadolares;	
            $ventasoles     = $value->valor_ventasoles;
      
      
                    $fila        ="2";
                    $item        = 1;
    
               
                            $sheet->write($fila,0,$item,$format_bold2);
                            $sheet->write($fila,1,$numero,$format_bold2);
                            $sheet->write($fila,2,$inicialsoles,$format_bold2);
                            $sheet->write($fila,3,$inicialdolares,$format_bold2);
                            $sheet->write($fila,4,$factSoles,$format_bold2);
                            $sheet->write($fila,5,$factDolares,$format_bold2);
                            $sheet->write($fila,6,$inicialsoles-$factSoles,$format_bold2);
                            $sheet->write($fila,7,$inicialdolares-$factDolares,$format_bold2);
                            $sheet->write($fila,8,((($inicialsoles-$factSoles)/$tc)+($inicialdolares-$factDolares)),$format_bold2);
                            $sheet->write($fila,9,($ventasoles/$tc2)+($ventadolares),$format_bold2);
                            
   
                
                                    $x_facturar_total_dolares = (($inicialsoles-$factSoles)/$tc2)+($inicialdolares-$factDolares);
                                    $venta_total_dolares      = ($ventasoles/$tc2)+($ventadolares);
                                    if($venta_total_dolares!=0){
                                        $rendimiento = 100-($x_facturar_total_dolares*100/$venta_total_dolares);
                                    }
                                    else{
                                        $rendimiento = 0;
                                    }

                            $sheet->write($fila,10,$rendimiento,$format_bold2);


                
                $item++;
                $fila++;
                $inicialdolares_total = $inicialdolares_total + $inicialdolares;
                $inicialsoles_total   = $inicialsoles_total + $inicialsoles;
                $factDolares_total    = $factDolares_total + $factDolares;
                $factSoles_total      = $factSoles_total + $factSoles;
                $saldoDolares_total   = $saldoDolares_total + ($inicialdolares-$factDolares);
                $saldoSoles_total     = $saldoSoles_total + ($inicialsoles-$factSoles);
                //$ventadolares_total   = $ventadolares_total + $ventadolares;
                //$ventasoles_total     = $ventasoles_total + $ventasoles;
                $x_facturar_total_dolares_total = $x_facturar_total_dolares_total + $x_facturar_total_dolares;
                $venta_total_dolares_total      = $venta_total_dolares_total + $venta_total_dolares;
                
                
                
         }
                        if($venta_total_dolares_total!=0){
                            $rendimiento_total = 100-(($x_facturar_total_dolares_total)*100/$venta_total_dolares_total);
                        }
                        else{
                            $rendimiento_total = 0;
                        }
                               
                    $sheet->write($fila,2,$inicialdolares_total,$format_bold2);
                    $sheet->write($fila,3,$inicialsoles_total,$format_bold2);
                    $sheet->write($fila,4,$factDolares_total,$format_bold2);
                    $sheet->write($fila,5,$factSoles_total,$format_bold2);
                    $sheet->write($fila,6,$saldoDolares_total,$format_bold2);
                    $sheet->write($fila,7,$saldoSoles_total,$format_bold2);
                    $sheet->write($fila,8,$x_facturar_total_dolares_total,$format_bold2);
                    $sheet->write($fila,9,$venta_total_dolares_total,$format_bold2);
                    $sheet->write($fila,10,$rendimiento_total,$format_bold2);

                 $fila++;   
                    
                    
                $xls->close();               
            
  }     
  
  
  
  
        
        
        
        $data['razcli'] = $razclientes->RazCli;
        $data['tipo']    = $tipo;
        $data['fila2']  = $fila2;
        $data['del']    = $del;
        $data['al']     = $al;
        $data['hasta']  = $hasta;
        $data['codcli'] = $codcli;
        $data['tc2']    = $tc2;
        $data['inicialsoles_total']   = $inicialsoles_total;
        $data['inicialdolares_total'] = $inicialdolares_total;
        $data['factSoles_total']      = $factSoles_total;
        $data['factDolares_total']    = $factDolares_total;
        $data['saldoSoles_total']     = $saldoSoles_total;
        $data['saldoDolares_total']   = $saldoDolares_total;
        $data['x_facturar_total_dolares_total'] = $x_facturar_total_dolares_total;
        $data['venta_total_dolares_total'] = $venta_total_dolares_total;
        $data['rendimiento_total']    = $rendimiento_total;
        $this->load->view(ventas."ots_x_facturar_x_intervalos_detalle",$data);
    }
    
    
    
    
    
    
    
    public function rpt_por_facturar_x_intervalos_grafica(){
        $hoy = date("d/m/Y",time());
        $fInicio_ini = "01/08/2011";
        $fFin_ini    = date("d/m/Y",time());
        $tipOt       = "'07','08','10','12'";
        $arrFila     = array();
        $arrayExcel  = array();
        $ver = $_REQUEST['ver'];
        if($_REQUEST['fInicio']!="" && $_REQUEST['fFin']!=""){
           $entidad     = "01";
            $fInicio     = $_REQUEST['fInicio'];
            $fFin        = $_REQUEST['fFin'];
            $fInicio_ini = $_REQUEST['fInicio'];
            $fFin_ini    = $_REQUEST['fFin'];
            $tipo        = $_REQUEST['tipo'];
            $arrFecha1   = explode("/",$fInicio);
            $arrFecha2   = explode("/",$fFin);
            $arrhoy      = explode("/",$hoy);
            $fFecha1 = mktime( 0, 0, 0,$arrFecha1[1],$arrFecha1[0],$arrFecha1[2]); 
            $fFecha2 = mktime( 0, 0, 0,$arrFecha2[1],$arrFecha2[0],$arrFecha2[2]); 
            $fHoy    = mktime( 0, 0, 0,$arrhoy[1],$arrhoy[0],$arrhoy[2]); 
            /*Armo mi matriz de intervalos*/
            $anio = $arrFecha1[2];
            $mes  = $arrFecha1[1];
            $dia  = "01";
            $arrFecha = array();
            for($i=0;$i<30;$i++){
                $f1 = mktime( 0, 0, 0,$mes, ($i%2==0?"01":"17"),$anio ); 
                $f2 = mktime( 0, 0, 0,$mes, ($i%2==0?"16":date("t",$f1)), $anio ); 
                $arrFecha[$i] = array(date("d/m/Y",$f1),date("d/m/Y",$f2));
                if($mes=="12"){$anio++;$mes="0";} 
                if($i%2!=0) $mes++;
                if($fFecha2<=$f2){
                    $arrFecha[$i] = array(date("d/m/Y",$f1),$fFin);
                    break;
                }
            }
            $tipo="bar";
            if($tipo=="bar"){
               foreach($arrFecha as $indice=>$value){
                    $fInicio   = $value[0];
                    $fFin      = $value[1];
                    $resultado = $this->oOt->rpt_por_facturar_x_intervalos($entidad, $tipOt, $fInicio, $fFin);
                    $arrTc    = $this->oTipoCambio->obtener($entidad,$fFin);
                    $tc       = $arrTc[0][0];
                    $tc       = ($tc=="")?"1":$tc;
                    $acumuado_saldoDolares_total = 0;
                    $acumulado_valor_venta       = 0;
                    foreach($resultado as $indice2 => $value2){
                        $saldodolares_ant = 0;
                        $saldosoles_ant   = 0;	
                        $cliente          = $value2[0];
                        $inicialdolares   = $value2[1];
                        $inicialsoles     = $value2[2];
                        $sumadolares      = $value2[3];
                        $sumasoles        = $value2[4];
                        $factDolares      = $value2[5];
                        $factSoles        = $value2[6];
                        $codcli           = $value2[7];
                        $valor_venta      = $sumadolares + ($sumasoles/$tc);
                        $arrClientes[]    = $codcli;                        
                        if($valor_venta!=0)
                            $rend = 100-((($inicialsoles-$factSoles)/$tc)+($inicialdolares-$factDolares))*100/$valor_venta;
                        else
                            $rend = 0;
                        if($inicialsoles!=0 || $inicialdolares!=0 || ($inicialsoles-$factSoles)!=0 || ($inicialdolares-$factDolares)!=0){
                            $array_rendimiento_cliente[] = array($codcli,$cliente,$fInicio,$fFin,$rend);	
                        }
                        $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($inicialsoles-$factSoles)/$tc)+($inicialdolares-$factDolares);
                        $acumulado_valor_venta       = $acumulado_valor_venta + $valor_venta;                        
                    }
                    $rend_total = 100 - ($acumuado_saldoDolares_total*100/$acumulado_valor_venta);
                    $array_rendimiento[] = array($fInicio,$fFin,$rend_total);                    
               }
            }  
            /*Obtengo los rendimientos por cliente*/
            $fila2 = "<tr>";
            $fila2.= "<td>&nbsp;</td>";
            $fila2.= "<td>&nbsp;</td>";
            foreach(array_unique($arrClientes) as $i=>$val){
               $fila2.= "<td>".$val."</td>";   
            }
            $fila2.= "</tr>";
            $fila2.= "<tr>";       
            $fila2.= "<td>&nbsp;</td>";
            $fila2.= "<td>&nbsp;</td>";             
            foreach(array_unique($arrClientes) as $i=>$val){
               $cliente_ini = $val;                
               foreach($array_rendimiento_cliente as $j=>$value){
                   if($cliente_ini==$value[0]){
                       $rend_cliente[$cliente_ini][]=array($value[0],$value[1],$value[2],$value[3],$value[4]);
                       $fila2.= "<td>".$value[4]."</td>";
                   }
               }
            }
            $fila2.= "</tr>";
            
            //Obtengo el rendimiento total 
            $rend_total = array();
            $interval   = array();
            $fila       = "";
            foreach($array_rendimiento as $i=>$val){
                $rend_total[]  = $val[2];
                $interval[] = "del ".$val[1]." \n "."al ".$val[0];
                $fila.= "<tr>";
                $fila.= "<td align='center'>".($i==0?"PERIODOS":"")."</td>";
                $fila.= "<td align='center'>del ".$val[0]."</td>";
                $fila.= "<td align='center'>al ".$val[1]."</td>";
                $fila.= "<td align='right'>".number_format($val[2],2,".",",")."</td>";
                $fila.= "</tr>";
            }
            
            //Grafico el rendimiento total
            $DataSet = new pData();
            $DataSet->AddPoint($rend_total,"Serie1");
            $DataSet->AddPoint($interval,"Serie2");
            $DataSet->AddAllSeries();
            $DataSet->SetAbsciseLabelSerie("Serie2");
            $DataSet->SetSerieName("Periodo", "Serie1");
            $DataSet->SetYAxisName("%");
            $Test = new pChart(700,300);
            $Test->setFixedScale(0,100);
            $Test->setFontProperties("../libreria/pchart/Fonts/tahoma.ttf", 8);
            $Test->setGraphArea(50, 30, 680, 200);
            $Test->drawFilledRoundedRectangle(7, 7, 693, 240, 5, 240, 240, 240);
            $Test->drawRoundedRectangle(5, 5, 695, 240, 5, 230, 230, 230);
            $Test->drawGraphArea(255, 255, 255,TRUE);
            $Test->drawScale($DataSet->getData(), $DataSet->GetDataDescription(), SCALE_NORMAL, 150, 150, 150, TRUE, 0, 2, TRUE);
            $Test->drawGrid(4,TRUE,230,230,230,50);
            $Test->drawTreshold(0, 143, 55, 72,TRUE,TRUE);
            $Test->drawLineGraph($DataSet->GetData(), $DataSet->GetDataDescription());
            $Test->drawPlotGraph($DataSet->GetData(), $DataSet->GetDataDescription(),3,2,255,255,255);
            $Test->drawTitle(50, 22, "RENDIMIENTO FACTURACION", 50, 50, 50,585);
            $Test->Render("example12.png");
            
            //Grafico rendimiento por clientes
            $DataSet2 = new pData();
            foreach($rend_cliente as $indice=>$rendimientos){
                $cliente = $indice;
                $inter1  = array();
                $inter2  = array();
                $rend1   = array();
                foreach($rendimientos as $ndice2=>$value){
                    $inter1[] = "del ".$value[2]."\nal".$value[3];
                    $rend1[]  = $value[4];
                }
                $DataSet2->AddPoint($rend1, "Serie_".$indice);
                $DataSet2->SetSerieName(substr($value[1],0,15),"Serie_".$indice);
            }
            //$DataSet2->AddPoint($inter1,"Serie_abcisa_".$indice);                            
            $DataSet2->AddAllSeries();
            $DataSet2->SetAbsciseLabelSerie();
            $DataSet2->SetYAxisName("%");
            $Test2 = new pChart(700,300);
            $Test2->setFixedScale(0,100);
            $Test2->setFontProperties("../libreria/pchart/Fonts/tahoma.ttf", 8);
            $Test2->setGraphArea(50, 30, 680, 200);
            $Test2->drawFilledRoundedRectangle(7, 7, 693, 240, 5, 240, 240, 240);
            $Test2->drawRoundedRectangle(5, 5, 695, 240, 5, 230, 230, 230);
            $Test2->drawGraphArea(255, 255, 255,TRUE);
            $Test2->drawScale($DataSet2->getData(), $DataSet2->GetDataDescription(), SCALE_NORMAL, 150, 150, 150, TRUE, 0, 2, TRUE);
            $Test2->drawGrid(4,TRUE,230,230,230,50);
            $Test2->drawTreshold(0, 143, 55, 72,TRUE,TRUE);
            $Test2->drawLineGraph($DataSet2->GetData(), $DataSet2->GetDataDescription());
            $Test2->drawPlotGraph($DataSet2->GetData(), $DataSet2->GetDataDescription(),3,2,255,255,255);
            $Test2->drawLegend(600, 35, $DataSet2->GetDataDescription(), 255, 255, 255);
            $Test2->drawTitle(50, 22, "RENDIMIENTO FACTURACION POR CLIENTE", 50, 50, 50,585);
            $Test2->Render("example11.png");
            
            require_once view."ventas/ots_x_facturar_x_intervalos_grafica.php";
        }
    }  
    
    
    public function rpt_por_facturar_cliente($tipo="",$codcliente="000000"){
        $fFin       = date("d/m/Y",time());
        $fInicio    = "01/01/2012";
        $cantidad   = 0;
        $opcion     = 0;
        $tipOt      = $this->input->get_post('codperiodo');  
        $cboCli     = $this->alumno_model->seleccionar("Seleccionar todos","000000");
        $periodoOt  = form_dropdown('codperiodo',$this->periodoot_model->seleccionar('',''),$tipOt,"id='codperiodo' class='comboMedio'");   
        $codcliente = "000000";
        /*if($tipOt=="")        $tipOt  = 18;*/
        $fila       = "";     
        $chkAnio    = 0;
        $chkMes     = 0;
        $chkDia     = 0;
        $tc         = "";
        $codigo     = "";
        $tipo       = "";
        $nivel       = "";
        $acumulado_saldosoles_ant    = 0;
        $acumulado_saldodolares_ant  = 0;
        $acumulado_soles             = 0;
        $acumuado_factSoles          = 0;
        $acumulado_totalDolares      = 0;
        $acumuado_factDolares        = 0;
        $acumuado_saldoDolares       = 0;
        $acumuado_saldoSoles         = 0;
        $acumuado_saldoDolares_total = 0;
        $acumulado_dolares           = 0;
        $acumulado_soles             = 0;
        $acumuado_factDolares        = 0;
        $acumuado_factSoles          = 0;
        $acumuado_saldoSoles         = 0;
        $acumuado_saldoDolares       = 0;
        $acumuado_saldoDolares_total = 0;
        $acumulado_saldosoles_ant    = 0;
        $acumulado_saldodolares_ant  = 0;         
        $acumulado_dolares           = 0;
        $this->form_validation->set_rules('codcliente','Cliente','required');
        $this->form_validation->set_rules('codperiodo','Periodo tipoOt','required');
        $this->form_validation->set_rules('fInicio','Fecha incio','required'); 
        $this->form_validation->set_rules('fFin','Fecha','required');   
        $this->form_validation->set_rules('tipo','Tipo de reporte','required'); 
        if($this->form_validation->run() == TRUE)
        {
                $opcion     = 4;
                $tipo       = $this->input->get_post('tipo');
                $nivel       = $this->input->get_post('nivel');
                $codcliente = $this->input->get_post('codcliente');
                $fFin       = $this->input->get_post('fFin');
                $fInicio    = $this->input->get_post('fInicio');  
                $codot      = $this->input->get_post('codot'); 
                switch($opcion){
                    case '1'://Dia
                            $chkAnio = 1;$chkDia = 1;$chkMes = 1;break;
                    case '2'://Mensual
                            $chkAnio = 1;$chkMes = 1;$chkDia = 0;break;
                    case '3'://Anio
                            $chkAnio = 1;$chkDia = 0;$chkMes = 0;break;				
                    case '4'://Clientes
                            $chkAnio = 0;$chkMes = 0;$chkDia = 0;break;			
                }    
                $arrfInicio = explode("/",$fInicio);
                $arrfFin    = explode("/",$fFin);
                $f1         = mktime(0,0,0,($arrfInicio[1]+1-1),($arrfInicio[0]+1-1),($arrfInicio[2]+1-1)); 
                $f2         = mktime(0,0,0,($arrfFin[1]+1-1),($arrfFin[0]+1-1),($arrfFin[2]+1-1)); 
                if($f2 < $f1){
                    redirect(ventas."ot/rpt_por_facturar_cliente");
                }
                $arrTc      = $this->tc_model->obtener($fFin);
                $tc         = $arrTc->Valor_2;
                $resultado  = $this->ot_model->rpt_por_facturar_cliente($tipOt,$fInicio, $fFin, $chkAnio, $chkMes, $chkDia, $codcliente);
                if($tipo=="html" && $nivel=="1"){
                    $anio   = "";
                    $mes    = "";
                    $codcli = "";
                    $cliente     = "";
                    $sumadolares = "";
                    $sumasoles   = "";
                    $factDolares = ""; 
                    $factSoles   = "";
                    $factDol     = "";
                    $factSol     = "";                
                    $anio_ant    = "";
                    $item        = 1;
                    foreach($resultado as $indice => $value){
                        $saldodolares_ant      = 0;
                        $saldosoles_ant        = 0;	
                        $cliente        = $value->cliente;
                        $inicialdolares = $value->inicialdolares;
                        $inicialsoles   = $value->inicialsoles;
                        $sumadolares    = $value->sumadolares;
                        $sumasoles      = $value->sumasoles;
                        $factDolares    = $value->factDolares;
                        $factSoles      = $value->factSoles;
                        $mes            = ($chkMes=='1'?$value->mes:"");
                        $dia            = ($chkDia=='1'?$value->dia:"");
                        $anio           = ($chkAnio=='1'?$value->anio:"");
                        $numero         = ($chkAnio=='1'?$value->numero:"");
                        $codcli         = $value->codcli;
                        $fila.="<tr class='rpt_detalle' id='".$codcli."'>";
                        $fila.="<td align='center'>".$item."</td>";
                        $fila.="<td align='left'><a href='javascript:;'>".$cliente."</a></td>";
                        $fila.="<td align='right'>".number_format($sumasoles,2,",",".")."</td>";
                        $fila.="<td align='right'>".number_format($sumadolares,2,",",".")."</td>";
                        $fila.="<td align='right'>".number_format($factSoles,2,",",".")."</td>";
                        $fila.="<td align='right'>".number_format($factDolares,2,",",".")."</td>";
                        $fila.="<td align='right' style='background-color: #DDECFE; opacity:0.8' >".number_format(($sumasoles-$factSoles),2,",",".")."</td>";				
                        $fila.="<td align='right' style='background-color: #FFFFCC; opacity:0.8' >".number_format(($sumadolares-$factDolares),2,",",".")."</td>";
                        $fila.="<td align='right' style='background-color: #CCFFCC; opacity:0.8' >".number_format((($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares),2,",",".")."</td>";	
                        $fila.="</tr>";
                        $codigo_ant  = $codigo;
                        $factDol_ant = $factDol;
                        $factSol_ant = $factSol;
                        $anio_ant    = $anio;
                        $mes_ant     = $mes;
                        $acumulado_dolares     = $acumulado_dolares + $sumadolares;
                        $acumulado_soles       = $acumulado_soles + $sumasoles;
                        $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                        $acumuado_factSoles    = $acumuado_factSoles + $factSoles;
                        

                        
                        $acumulado_saldosoles_ant   = $acumulado_saldosoles_ant + $inicialsoles;
                        $acumulado_saldodolares_ant = $acumulado_saldodolares_ant + $inicialdolares; 
                        $acumuado_saldoDolares = $acumuado_saldoDolares + ($inicialdolares+$sumadolares-$factDolares);
                        $acumuado_saldoSoles   = $acumuado_saldoSoles + ($inicialsoles+$sumasoles-$factSoles);
                        $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($inicialsoles+$sumasoles-$factSoles)/$tc)+($inicialdolares+$sumadolares-$factDolares);
                        $item++;
                    }
                    $cantidad = count($resultado);              
                }
                
                
                
                
                
                
                
                
                
                
                
                elseif($tipo=="excel" && $nivel=="1"){
                  $xls = new Spreadsheet_Excel_Writer();
                  $xls->send("ReportexFacturarCliente.xls");
                  $sheet  =$xls->addWorksheet('xFacturarCli.');
                  $sheet->setInputEncoding('ISO-8859-7');
           
                  
                  $format =$xls->addFormat();
                  $format->setBold();
                  

              $sheet->setRow(0, 40);
              $sheet->setRow(1,10);
              $sheet->setRow(2,45);
              $sheet->setRow(3,15);
              $sheet->setRow(4,15);
              $sheet->setRow(5,15);
              $sheet->setRow(6,15);
              $sheet->setRow(7,15);
              $sheet->setRow(8,15);
              $sheet->setRow(9,15);
              $sheet->setRow(10,15);
              $sheet->setRow(11,15);
             
              
              $format_bold=$xls->addFormat();
              $format_bold->setBold();
              $format_bold->setSize(9);
              $format_bold->setvAlign('vcenter');
              $format_bold->sethAlign('center');
              $format_bold->setBorder(1);
              $format_bold->setTextWrap();
             
              $format_titulo=$xls->addFormat();
              $format_titulo->setBold();
              $format_titulo->setSize(9);
              $format_titulo->setvAlign('vcenter');
              $format_titulo->sethAlign('center');
              $format_titulo->setBorder(1);
              $format_titulo->setTextWrap();
              
              $format_bold2=$xls->addFormat();
              $format_bold2->setSize(9);
              $format_bold2->setvAlign('vcenter');
              $format_bold2->sethAlign('center');
              $format_bold2->setBorder(1);
              $format_bold2->setTextWrap();
 
              $sheet->setColumn(0,0,11); //COLUMNA A1
              $sheet->setColumn(1,1,61); //COLUMNA B2
              $sheet->setColumn(2,2,12); //COLUMNA C3
              $sheet->setColumn(3,3,12); //COLUMNA D4
              $sheet->setColumn(4,4,12); //COLUMNA E5
              $sheet->setColumn(5,5,12); //COLUMNA F6
              $sheet->setColumn(6,6,12); //COLUMNA G7
              $sheet->setColumn(7,7,12); //COLUMNA H8
              $sheet->setColumn(8,8,12); //COLUMNA I9

                  
              $sheet->mergeCells(0,0,0,8);  
              $sheet->write(0,1,"REPORTE POR FACTURAR POR CLIENTE (INCLUYE NUEVAS VENTAS)",$format_titulo); $sheet->write(0,2,"",$format_bold); $sheet->write(0,3,"",$format_bold); $sheet->write(0,4,"",$format_bold); $sheet->write(0,5,"",$format_bold); $sheet->write(0,6,"",$format_bold);   $sheet->write(0,7,"",$format_bold);   $sheet->write(0,8,"",$format_bold);  
              $sheet->write(0,0,"REPORTE DEL 2012",$format_bold);
              
              $sheet->write(2,0,"No",$format_bold);       $sheet->write(2,1,"CLIENTE",$format_bold);  $sheet->write(2,2,"VALOR DE VENTA S/.",$format_bold);  $sheet->write(2,3,"VALOR DE VENTA $",$format_bold);   $sheet->write(2,4,"MONTO FACTURADO S/.",$format_bold);      $sheet->write(2,5,"MONTO FACTURADO $",$format_bold);   $sheet->write(2,6,"SALDO POR FACTURAR S/.",$format_bold);    $sheet->write(2,7,"SALDO POR FACTURAR $",$format_bold);   $sheet->write(2,8,"SALDO TOTAL POR FACTURAR $",$format_bold);  
              
              
                  $anio   = "";
                  $mes    = "";
                  $codcli = "";
                  $cliente     = "";
                  $sumadolares = "";
                  $sumasoles   = "";
                  $factDolares = "";
                  $factSoles   = "";
                  $anio_ant    = "";
                  $item        = 1;
                  $acumulado_dolares     = 0;
                  $acumulado_soles       = 0;
                  $acumuado_factDolares  = 0;
                  $acumuado_factSoles    = 0;
                  $acumuado_saldoSoles   = 0;
                  $acumuado_saldoDolares = 0;
                  $acumuado_saldoDolares_total = 0;
                  $acumulado_saldosoles_ant   = 0;
                  $acumulado_saldodolares_ant = 0;   
                  $fila = 3;
                  $codigo  = "";
                  $factDol = 0;
                  $factSol = 0;
                  foreach($resultado as $indice => $value){
                    $saldodolares_ant      = 0;
                    $saldosoles_ant        = 0;	
                    $cliente        = $value->cliente;
                    $sumadolares    = $value->sumadolares;
                    $sumasoles      = $value->sumasoles;
                    $factDolares    = $value->factDolares;
                    $factSoles      = $value->factSoles;
                    $mes            = ($chkMes=='1'?$value->mes:"");
                    $dia            = ($chkDia=='1'?$value->dia:"");
                    $anio           = ($chkAnio=='1'?$value->anio:"");
                    $numero         = ($chkAnio=='1'?$value->numero:"");
                    $codcli         = $value->codcli;
                    
                    $sheet->write($fila,0,$item,$format_bold2);
                    if($chkAnio=="1") $sheet->write($fila,1,$anio,$format_bold2);
                    if($chkMes=="1")  $sheet->write($fila,2,$mes,$format_bold2);
                    if($chkDia=="1")  $sheet->write($fila,3,$dia,$format_bold2);
                    if($chkDia=="1")  $sheet->write($fila,4,(trim($numero)=='11-000000'?"SALDO INICIAL":$numero),$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1")  $sheet->write($fila,5,$cliente,$format_bold2);else $sheet->write($fila,1,$cliente,$format_bold2); 
                    if($opcion=='4' && isset($_REQUEST['fInicio'])){
                       
                    }
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,8,$sumasoles,$format_bold2);else $sheet->write($fila,2,$sumasoles,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,9,$sumadolares,$format_bold2);else $sheet->write($fila,3,$sumadolares,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,10,$factSoles,$format_bold2);else $sheet->write($fila,4,$factSoles,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,11,$factDolares,$format_bold2);else $sheet->write($fila,5,$factDolares,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,12,($sumasoles-$factSoles),$format_bold2);else $sheet->write($fila,6,($sumasoles-$factSoles),$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,13,($sumadolares-$factDolares),$format_bold2);else $sheet->write($fila,7,($sumadolares-$factDolares),$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,14,(($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares),$format_bold2);else $sheet->write($fila,8,(($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares),$format_bold2);         
                    $codigo_ant = $codigo;
                    $factDol_ant = $factDol;
                    $factSol_ant = $factSol;
                    $anio_ant    = $anio;
                    $mes_ant     = $mes;
                    $acumulado_dolares     = $acumulado_dolares + $sumadolares;
                    $acumulado_soles       = $acumulado_soles + $sumasoles;
                    $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                    $acumuado_factSoles    = $acumuado_factSoles + $factSoles;

                    $acumuado_saldoDolares = $acumuado_saldoDolares + ($sumadolares-$factDolares);
                    $acumuado_saldoSoles   = $acumuado_saldoSoles + ($sumasoles-$factSoles);
                    $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares);
                    $item++;
                    $fila++;
                  }

                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,8,$acumulado_soles,$format_bold2);else $sheet->write($fila,2,$acumulado_soles,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,9,$acumulado_dolares,$format_bold2);else $sheet->write($fila,3,$acumulado_dolares,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,10,$acumuado_factSoles,$format_bold2);else $sheet->write($fila,4,$acumuado_factSoles,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,11,$acumuado_factDolares,$format_bold2);else $sheet->write($fila,5,$acumuado_factDolares,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,12,$acumuado_saldoSoles,$format_bold2);else $sheet->write($fila,6,$acumuado_saldoSoles,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,13,$acumuado_saldoDolares,$format_bold2);else $sheet->write($fila,7,$acumuado_saldoDolares,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,14,$acumuado_saldoDolares_total,$format_bold2);else $sheet->write($fila,8,$acumuado_saldoDolares_total,$format_bold2);                       
                  $xls->close();
                }
                
                
                
                
                elseif($tipo=="pdf" && $nivel=="1"){
                $this->load->library("fpdf/pdf");
                $CI = & get_instance();
                $CI->pdf->FPDF('L','mm','A4');
                $CI->pdf->AliasNbPages();
                
                $CI->pdf->AddPage();
                $CI->pdf->SetTextColor(0,0,0);
                $CI->pdf->SetFillColor(255,255,255);


                $CI->pdf->SetFont('Arial','B',13);
                $CI->pdf->SetY(5);
                $CI->pdf->SetX(10); 
                $CI->pdf->Cell(284,20,"REPORTE POR FACTURAR POR CLIENTE - (INCLUYE NUEVAS VENTAS)",1,1,"C",0);
                $CI->pdf->SetX(10); 
                $CI->pdf->Cell(284,8,"Reporte durante el 2012",1,1,"L",0);

                $CI->pdf->SetFont('Arial','',7);
                $CI->pdf->SetY(35);
                $CI->pdf->SetX(10); 
                $CI->pdf->Cell(10,5,"No",1,0,"C",0);
                $CI->pdf->Cell(90,5,"CLIENTE",1,0,"C",0);
                $CI->pdf->Cell(25,5,"VALORdeVENTA(S/)",1,0,"C",0);
                $CI->pdf->Cell(25,5,"VALORdeVENTA $",1,0,"C",0);
                $CI->pdf->Cell(27,5,"FACTURADO(S/)",1,0,"C",0);
                $CI->pdf->Cell(27,5,"FACTURADO $",1,0,"C",0);
                $CI->pdf->Cell(26,5,"SALDOxFACTURAR(S/)",1,0,"C",0);
                $CI->pdf->Cell(26,5,"SALDOxFACTURAR $",1,0,"C",0); //
                $CI->pdf->Cell(28,5,"TOTALxFACTURAR $",1,0,"C",0);
         
                   $CI->pdf->SetFont('Arial','',8);
                   $CI->pdf->SetY(40);
                   $CI->pdf->SetX(10);
                   
                   
                    $anio   = "";
                    $mes    = "";
                    $codcli = "";
                    $cliente     = "";
                    $sumadolares = "";
                    $sumasoles   = "";
                    $factDolares = "";
                    $factSoles   = "";
                    $anio_ant    = "";
                    $item        = 1;
                    $acumulado_dolares     = 0;
                    $acumulado_soles       = 0;
                    $acumuado_factDolares  = 0;
                    $acumuado_factSoles    = 0;
                    $acumuado_saldoSoles   = 0;
                    $acumuado_saldoDolares = 0;
                    $acumuado_saldoDolares_total = 0;
                    $acumulado_saldosoles_ant   = 0;
                    $acumulado_saldodolares_ant = 0;  
                    

                    
                    
                    $fila = 1;
                    $codigo  = "";
                    $factDol = 0;
                    $factSol = 0;
                    

                    
                    foreach($resultado as $indice => $value){
                        $saldodolares_ant = 0;
                        $saldosoles_ant   = 0;	
                        $cliente        = $value->cliente;
                        $inicialdolares = $value->inicialdolares;
                        $inicialsoles   = $value->inicialsoles;
                        $sumadolares    = $value->sumadolares;
                        $sumasoles      = $value->sumasoles;
                        $factDolares    = $value->factDolares;
                        $factSoles      = $value->factSoles;
                        $mes            = ($chkMes=='1'?$value->mes:"");
                        $dia            = ($chkDia=='1'?$value->dia:"");
                        $anio           = ($chkAnio=='1'?$value->anio:"");
                        $numero         = ($chkAnio=='1'?$value->numero:"");
                        $codcli         = $value->codcli;
                     

                        
                        $CI->pdf->Cell(10,5,$item,1,0,"C",0);
                        
                        $CI->pdf->Cell(90,5,$cliente,1,0,"L",0);
                        
                        $CI->pdf->Cell(25,5,$sumasoles,1,0,"R",0);
                        
                        $CI->pdf->Cell(25,5,$sumadolares,1,0,"R",0);
                        
                        $CI->pdf->Cell(27,5,$factSoles,1,0,"R",0);
                        
                        $CI->pdf->Cell(27,5,$factDolares,1,0,"R",0);
                        
                        $CI->pdf->Cell(26,5,($sumasoles-$factSoles),1,0,"R",0);
                        
                        $CI->pdf->Cell(26,5,($sumadolares-$factDolares),1,0,"R",0);

                        $CI->pdf->Cell(28,5,(($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares),1,1,"R",0); 
                                    
                        
                    $codigo_ant = $codigo;
                    $factDol_ant = $factDol;
                    $factSol_ant = $factSol;
                    $anio_ant    = $anio;
                    $mes_ant     = $mes;
                    $acumulado_dolares     = $acumulado_dolares + $sumadolares;
                    $acumulado_soles       = $acumulado_soles + $sumasoles;
                    $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                    $acumuado_factSoles    = $acumuado_factSoles + $factSoles;

                    $acumuado_saldoDolares = $acumuado_saldoDolares + ($sumadolares-$factDolares);
                    $acumuado_saldoSoles   = $acumuado_saldoSoles + ($sumasoles-$factSoles);
                    $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares);
                        
                        
                        
                        
                        $item++;
                        $fila++; 
                    }
                    
                        $CI->pdf->Cell(10,5,"",1,0,"C",0);
                        
                        $CI->pdf->Cell(90,5,"",1,0,"L",0);
                        
                        $CI->pdf->Cell(25,5,$acumulado_soles,1,0,"R",0);
                        
                        $CI->pdf->Cell(25,5,$acumulado_dolares,1,0,"R",0);
                        
                        $CI->pdf->Cell(27,5,$acumuado_factSoles,1,0,"R",0);
                        
                        $CI->pdf->Cell(27,5,$acumuado_factDolares,1,0,"R",0);
                        
                        $CI->pdf->Cell(26,5,$acumuado_saldoSoles,1,0,"R",0);
                        
                        $CI->pdf->Cell(26,5,$acumuado_saldoDolares,1,0,"R",0);

                        $CI->pdf->Cell(28,5,$acumuado_saldoDolares_total,1,1,"R",0); 
                    
                    $CI->pdf->Output();
                }
                
                
                
                
                
                
                
                
                        
                        
           elseif($tipo=="excel" && $nivel=="2"){
              $xls = new Spreadsheet_Excel_Writer();
              $xls->send("ReportexFacturarCliente.xls");
              $sheet  =$xls->addWorksheet('xFacturarCli.');
              $sheet->setInputEncoding('ISO-8859-7');
              /////////////////////////////////////////////////////////////////////
              $format =$xls->addFormat();
              $format->setBold();
              /////////////////////////////////////////////////////////////////////
              $sheet->setRow(0, 40);
              $sheet->setRow(1,10);
              $sheet->setRow(2,45);
              $sheet->setRow(3,15);
              $sheet->setRow(4,15);
              $sheet->setRow(5,15);
              $sheet->setRow(6,15);
              $sheet->setRow(7,15);
              $sheet->setRow(8,15);
              $sheet->setRow(9,15);
              $sheet->setRow(10,15);
              $sheet->setRow(11,15);
              /////////////////////////////////////////////////////////////////////
              $format_bold=$xls->addFormat();
              $format_bold->setBold();
              $format_bold->setSize(9);
              $format_bold->setvAlign('vcenter');
              $format_bold->sethAlign('center');
              $format_bold->setBorder(1);
              $format_bold->setTextWrap();
              /////////////////////////////////////////////////////////////////////
              $format_titulo=$xls->addFormat();
              $format_titulo->setBold();
              $format_titulo->setSize(9);
              $format_titulo->setvAlign('vcenter');
              $format_titulo->sethAlign('center');
              $format_titulo->setBorder(1);
              $format_titulo->setTextWrap();
              /////////////////////////////////////////////////////////////////////
              $format_bold2=$xls->addFormat();
              $format_bold2->setSize(9);
              $format_bold2->setvAlign('vcenter');
              $format_bold2->sethAlign('center');
              $format_bold2->setBorder(1);
              $format_bold2->setTextWrap();
              /////////////////////////////////////////////////////////////////////
              $sheet->setColumn(0,0,11); //COLUMNA A1
              $sheet->setColumn(1,1,61); //COLUMNA B2
              $sheet->setColumn(2,2,12); //COLUMNA C3
              $sheet->setColumn(3,3,12); //COLUMNA D4
              $sheet->setColumn(4,4,12); //COLUMNA E5
              $sheet->setColumn(5,5,12); //COLUMNA F6
              $sheet->setColumn(6,6,12); //COLUMNA G7
              $sheet->setColumn(7,7,12); //COLUMNA H8
              $sheet->setColumn(8,8,12); //COLUMNA I9
              /////////////////////////////////////////////////////////////////////    
              $sheet->mergeCells(0,0,0,8);  
              $sheet->write(0,1,"REPORTE POR FACTURAR POR CLIENTE (DETALLE1)",$format_titulo); $sheet->write(0,2,"",$format_bold); $sheet->write(0,3,"",$format_bold); $sheet->write(0,4,"",$format_bold); $sheet->write(0,5,"",$format_bold); $sheet->write(0,6,"",$format_bold);   $sheet->write(0,7,"",$format_bold);   $sheet->write(0,8,"",$format_bold);  
              $sheet->write(0,0,"REPORTE DEL 2012",$format_bold);
              /////////////////////////////////////////// 
              $sheet->write(2,0,"No",$format_bold);       $sheet->write(2,1,"NUMERO",$format_bold);     $sheet->write(2,2,"VALOR DE VENTA S/.",$format_bold);  $sheet->write(2,3,"VALOR DE VENTA $",$format_bold);   $sheet->write(2,4,"MONTO FACTURADO S/.",$format_bold);      $sheet->write(2,5,"MONTO FACTURADO $",$format_bold);   $sheet->write(2,6,"SALDO POR FACTURAR S/.",$format_bold);    $sheet->write(2,7,"SALDO POR FACTURAR $",$format_bold);   $sheet->write(2,8,"SALDO TOTAL POR FACTURAR $",$format_bold);  
              /////////////////////////////////////////// 
                  $anio   = "";
                  $mes    = "";
                  $codcli = "";
                  $cliente     = "";
                  $sumadolares = "";
                  $sumasoles   = "";
                  $factDolares = "";
                  $factSoles   = "";
                  $anio_ant    = "";
                  $item        = 1;
                  $acumulado_dolares     = 0;
                  $acumulado_soles       = 0;
                  $acumuado_factDolares  = 0;
                  $acumuado_factSoles    = 0;
                  $acumuado_saldoSoles   = 0;
                  $acumuado_saldoDolares = 0;
                  $acumuado_saldoDolares_total = 0;
                  $acumulado_saldosoles_ant   = 0;
                  $acumulado_saldodolares_ant = 0;   
                  $fila = 3;
                  $codigo  = "";
                  $factDol = 0;
                  $factSol = 0;
                  /////////////////////////////////////////// 
                  $resultado3  = $this->ot_model->rpt_por_facturar_cliente_detalle($tipOt,$fInicio, $fFin, $codcliente);
                  /////////////////////////////////////////// 
                  foreach($resultado3 as $indice => $value){
                    $saldodolares_ant      = 0;
                    $saldosoles_ant        = 0;	
                    $numero        = $value->numero;
                    $sumadolares    = $value->sumadolares;
                    $sumasoles      = $value->sumasoles;
                    $factDolares    = $value->factDolares;
                    $factSoles      = $value->factSoles;
                    $mes            = ($chkMes=='1'?$value->mes:"");
                    $dia            = ($chkDia=='1'?$value->dia:"");
                    $anio           = ($chkAnio=='1'?$value->anio:"");
                    $codcli         = $value->codcli;
                    
                    
                    

                    
                    $sheet->write($fila,0,$item,$format_bold2);
                    if($chkAnio=="1") $sheet->write($fila,1,$anio,$format_bold2);
                    if($chkMes=="1")  $sheet->write($fila,2,$mes,$format_bold2);
                    if($chkDia=="1")  $sheet->write($fila,3,$dia,$format_bold2);
                    
                    
                    if($chkDia=="1")  $sheet->write($fila,4,$item,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1")  $sheet->write($fila,5,$cliente,$format_bold2);else $sheet->write($fila,1,$numero,$format_bold2); 
                    if($opcion=='4' && isset($_REQUEST['fInicio'])){
                          
                    }
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,8,$sumasoles,$format_bold2);else $sheet->write($fila,2,$sumasoles,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,9,$sumadolares,$format_bold2);else $sheet->write($fila,3,$sumadolares,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,10,$factSoles,$format_bold2);else $sheet->write($fila,4,$factSoles,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,11,$factDolares,$format_bold2);else $sheet->write($fila,5,$factDolares,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,12,($sumasoles-$factSoles),$format_bold2);else $sheet->write($fila,6,($sumasoles-$factSoles),$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,13,($sumadolares-$factDolares),$format_bold2);else $sheet->write($fila,7,($sumadolares-$factDolares),$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,14,(($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares),$format_bold2);else $sheet->write($fila,8,(($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares),$format_bold2);         
                    $codigo_ant = $codigo;
                    $factDol_ant = $factDol;
                    $factSol_ant = $factSol;
                    $anio_ant    = $anio;
                    $mes_ant     = $mes;
                    $acumulado_dolares     = $acumulado_dolares + $sumadolares;
                    $acumulado_soles       = $acumulado_soles + $sumasoles;
                    $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                    $acumuado_factSoles    = $acumuado_factSoles + $factSoles;

                    $acumuado_saldoDolares = $acumuado_saldoDolares + ($sumadolares-$factDolares);
                    $acumuado_saldoSoles   = $acumuado_saldoSoles + ($sumasoles-$factSoles);
                    $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares);
                    $item++;
                    $fila++;
                  }

                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,9,$acumulado_soles,$format_bold2);else $sheet->write($fila,2,$acumulado_soles,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,10,$acumulado_dolares,$format_bold2);else $sheet->write($fila,3,$acumulado_dolares,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,11,$acumuado_factSoles,$format_bold2);else $sheet->write($fila,4,$acumuado_factSoles,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,12,$acumuado_factDolares,$format_bold2);else $sheet->write($fila,5,$acumuado_factDolares,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,13,$acumuado_saldoSoles,$format_bold2);else $sheet->write($fila,6,$acumuado_saldoSoles,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,14,$acumuado_saldoDolares,$format_bold2);else $sheet->write($fila,7,$acumuado_saldoDolares,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,15,$acumuado_saldoDolares_total,$format_bold2);else $sheet->write($fila,8,$acumuado_saldoDolares_total,$format_bold2);                       
                  $xls->close();
                }
                
                
                
                
                
                
                
                elseif($tipo=="pdf" && $nivel=="2"){
                $this->load->library("fpdf/pdf");
                $CI = & get_instance();
                $CI->pdf->FPDF('L','mm','A4');
                $CI->pdf->AliasNbPages();
                ////////////////////////////////////////////////////////////////
                $CI->pdf->AddPage();
                $CI->pdf->SetTextColor(0,0,0);
                $CI->pdf->SetFillColor(255,255,255);
                ////////////////////////////////////////////////////////////////
                $CI->pdf->SetFont('Arial','B',13);
                $CI->pdf->SetY(5);
                $CI->pdf->SetX(10); 
                $CI->pdf->Cell(284,20,"REPORTE POR FACTURAR POR CLIENTE - (DETALLE1)",1,1,"C",0);
                $CI->pdf->SetX(10); 
                $CI->pdf->Cell(284,8,"Reporte durante el 2012",1,1,"L",0);
                ////////////////////////////////////////////////////////////////
                $CI->pdf->SetFont('Arial','',7);
                $CI->pdf->SetY(35);
                $CI->pdf->SetX(10); 
                $CI->pdf->Cell(10,5,"No",1,0,"C",0);
                $CI->pdf->Cell(90,5,"NUMERO",1,0,"C",0);
                $CI->pdf->Cell(25,5,"VALORdeVENTA(S/)",1,0,"C",0);
                $CI->pdf->Cell(25,5,"VALORdeVENTA $",1,0,"C",0);
                $CI->pdf->Cell(27,5,"FACTURADO(S/)",1,0,"C",0);
                $CI->pdf->Cell(27,5,"FACTURADO $",1,0,"C",0);
                $CI->pdf->Cell(26,5,"SALDOxFACTURAR(S/)",1,0,"C",0);
                $CI->pdf->Cell(26,5,"SALDOxFACTURAR $",1,0,"C",0); //
                $CI->pdf->Cell(28,5,"TOTALxFACTURAR $",1,0,"C",0);
                ////////////////////////////////////////////////////////////////
                   $CI->pdf->SetFont('Arial','',8);
                   $CI->pdf->SetY(40);
                   $CI->pdf->SetX(10);
                ////////////////////////////////////////////////////////////////
                    $anio   = "";
                    $mes    = "";
                    $numero    = "";
                    $sumadolares = "";
                    $sumasoles   = "";
                    $factDolares = "";
                    $factSoles   = "";
                    $anio_ant    = "";
                    $item        = 1;
                    $acumulado_dolares     = 0;
                    $acumulado_soles       = 0;
                    $acumuado_factDolares  = 0;
                    $acumuado_factSoles    = 0;
                    $acumuado_saldoSoles   = 0;
                    $acumuado_saldoDolares = 0;
                    $acumuado_saldoDolares_total = 0;
                    $acumulado_saldosoles_ant   = 0;
                    $acumulado_saldodolares_ant = 0;  
                    ////////////////////////////////////////////////////////////////
                    $fila = 1;
                    $codigo  = "";
                    $factDol = 0;
                    $factSol = 0;
                    ////////////////////////////////////////////////////////////////   
                    $resultado4  = $this->ot_model->rpt_por_facturar_cliente_detalle($tipOt,$fInicio, $fFin, $codcliente);
                    foreach($resultado4 as $indice => $value){
                        $saldodolares_ant = 0;
                        $saldosoles_ant   = 0;	
                        $inicialdolares = $value->inicialdolares;
                        $inicialsoles   = $value->inicialsoles;
                        $sumadolares    = $value->sumadolares;
                        $sumasoles      = $value->sumasoles;
                        $factDolares    = $value->factDolares;
                        $factSoles      = $value->factSoles;
                        $mes            = ($chkMes=='1'?$value->mes:"");
                        $dia            = ($chkDia=='1'?$value->dia:"");
                        $anio           = ($chkAnio=='1'?$value->anio:"");
                        $numero         = $value->numero;
                        $codcli         = $value->codcli;
                       
                
                        $CI->pdf->Cell(10,5,$item,1,0,"C",0);
                        
                        $CI->pdf->Cell(90,5,$numero,1,0,"C",0);
                        
                        $CI->pdf->Cell(25,5,$sumasoles,1,0,"R",0);
                        
                        $CI->pdf->Cell(25,5,$sumadolares,1,0,"R",0);
                        
                        $CI->pdf->Cell(27,5,$factSoles,1,0,"R",0);
                        
                        $CI->pdf->Cell(27,5,$factDolares,1,0,"R",0);
                        
                        $CI->pdf->Cell(26,5,($sumasoles-$factSoles),1,0,"R",0);
                        
                        $CI->pdf->Cell(26,5,($sumadolares-$factDolares),1,0,"R",0);

                        $CI->pdf->Cell(28,5,(($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares),1,1,"R",0); 
                                    
                    $codigo_ant = $codigo;
                    $factDol_ant = $factDol;
                    $factSol_ant = $factSol;
                    $anio_ant    = $anio;
                    $mes_ant     = $mes;
                    $acumulado_dolares     = $acumulado_dolares + $sumadolares;
                    $acumulado_soles       = $acumulado_soles + $sumasoles;
                    $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                    $acumuado_factSoles    = $acumuado_factSoles + $factSoles;
                    $acumuado_saldoDolares = $acumuado_saldoDolares + ($sumadolares-$factDolares);
                    $acumuado_saldoSoles   = $acumuado_saldoSoles + ($sumasoles-$factSoles);
                    $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares);
                        
                        $item++;
                        $fila++; 
                    }
                    
                        $CI->pdf->Cell(10,5,"",1,0,"C",0);
                        
                        $CI->pdf->Cell(90,5,"",1,0,"C",0);
                        
                        $CI->pdf->Cell(25,5,$acumulado_soles,1,0,"R",0);
                        
                        $CI->pdf->Cell(25,5,$acumulado_dolares,1,0,"R",0);
                        
                        $CI->pdf->Cell(27,5,$acumuado_factSoles,1,0,"R",0);
                        
                        $CI->pdf->Cell(27,5,$acumuado_factDolares,1,0,"R",0);
                        
                        $CI->pdf->Cell(26,5,$acumuado_saldoSoles,1,0,"R",0);
                        
                        $CI->pdf->Cell(26,5,$acumuado_saldoDolares,1,0,"R",0);

                        $CI->pdf->Cell(28,5,$acumuado_saldoDolares_total,1,1,"R",0); 
                    
                  $CI->pdf->Output();
               }

     
                
                
/////////////////////////////////               
/////////////////////////////               
////////////////////////////                
////////////////////////////////////////////////                        
                        
           elseif($tipo=="excel" && $nivel=="3"){
              $xls = new Spreadsheet_Excel_Writer();
              $xls->send("ReportexFacturarCliente.xls");
              $sheet  =$xls->addWorksheet('xFacturarCli.');
              $sheet->setInputEncoding('ISO-8859-7');
              /////////////////////////////////////////////////////////////////////
              $format =$xls->addFormat();
              $format->setBold();
              /////////////////////////////////////////////////////////////////////
              $sheet->setRow(0, 40);
              $sheet->setRow(1,10);
              $sheet->setRow(2,45);
              $sheet->setRow(3,15);
              $sheet->setRow(4,15);
              $sheet->setRow(5,15);
              $sheet->setRow(6,15);
              $sheet->setRow(7,15);
              $sheet->setRow(8,15);
              $sheet->setRow(9,15);
              $sheet->setRow(10,15);
              $sheet->setRow(11,15);
              /////////////////////////////////////////////////////////////////////
              $format_bold=$xls->addFormat();
              $format_bold->setBold();
              $format_bold->setSize(9);
              $format_bold->setvAlign('vcenter');
              $format_bold->sethAlign('center');
              $format_bold->setBorder(1);
              $format_bold->setTextWrap();
              /////////////////////////////////////////////////////////////////////
              $format_titulo=$xls->addFormat();
              $format_titulo->setBold();
              $format_titulo->setSize(9);
              $format_titulo->setvAlign('vcenter');
              $format_titulo->sethAlign('center');
              $format_titulo->setBorder(1);
              $format_titulo->setTextWrap();
              /////////////////////////////////////////////////////////////////////
              $format_bold2=$xls->addFormat();
              $format_bold2->setSize(9);
              $format_bold2->setvAlign('vcenter');
              $format_bold2->sethAlign('center');
              $format_bold2->setBorder(1);
              $format_bold2->setTextWrap();
              /////////////////////////////////////////////////////////////////////
              $sheet->setColumn(0,0,11); //COLUMNA A1
              $sheet->setColumn(1,1,29); //COLUMNA B2
              $sheet->setColumn(2,2,15); //COLUMNA C3
              $sheet->setColumn(3,3,14); //COLUMNA D4
              $sheet->setColumn(4,4,14); //COLUMNA E5
              $sheet->setColumn(5,5,14); //COLUMNA F6
              $sheet->setColumn(6,6,14); //COLUMNA G7
              $sheet->setColumn(7,7,14); //COLUMNA H8
              $sheet->setColumn(8,8,14); //COLUMNA I9
              $sheet->setColumn(9,9,17); //COLUMNA J10
              /////////////////////////////////////////////////////////////////////    
              $sheet->mergeCells(0,0,0,9);  
              $sheet->write(0,1,"REPORTE POR FACTURAR POR CLIENTE (DETALLE2)",$format_titulo); $sheet->write(0,2,"",$format_bold); $sheet->write(0,3,"",$format_bold); $sheet->write(0,4,"",$format_bold); $sheet->write(0,5,"",$format_bold); $sheet->write(0,6,"",$format_bold);   $sheet->write(0,7,"",$format_bold);   $sheet->write(0,8,"",$format_bold);   $sheet->write(0,9,"",$format_bold);
              $sheet->write(0,0,"REPORTE DEL 2012",$format_bold);
              /////////////////////////////////////////// 
              $sheet->write(2,0,"No",$format_bold);       $sheet->write(2,1,"NUMERO",$format_bold);  $sheet->write(2,2,"FECHA",$format_bold);    $sheet->write(2,3,"VALOR DE VENTA S/.",$format_bold);  $sheet->write(2,4,"VALOR DE VENTA $",$format_bold);   $sheet->write(2,5,"MONTO FACTURADO S/.",$format_bold);      $sheet->write(2,6,"MONTO FACTURADO $",$format_bold);   $sheet->write(2,7,"SALDO POR FACTURAR S/.",$format_bold);    $sheet->write(2,8,"SALDO POR FACTURAR $",$format_bold);   $sheet->write(2,9,"SALDO TOTAL POR FACTURAR $",$format_bold);  
              /////////////////////////////////////////// 
              

              
              
                  $anio   = "";
                  $mes    = "";
                  $codcli = "";
                  $cliente     = "";
                  $sumadolares = "";
                  $sumasoles   = "";
                  $factDolares = "";
                  $factSoles   = "";
                  $anio_ant    = "";
                  $item        = 1;
                  $acumulado_dolares     = 0;
                  $acumulado_soles       = 0;
                  $acumuado_factDolares  = 0;
                  $acumuado_factSoles    = 0;
                  $acumuado_saldoSoles   = 0;
                  $acumuado_saldoDolares = 0;
                  $acumuado_saldoDolares_total = 0;
                  $acumulado_saldosoles_ant   = 0;
                  $acumulado_saldodolares_ant = 0;   
                  $fila = 3;
                  $codigo  = "";
                  $factDol = 0;
                  $factSol = 0;
                  /////////////////////////////////////////// 
                  $resultado5  = $this->ot_model->rpt_por_facturar_cliente_detalle2($tipOt,$fInicio,$fFin,$codot);
                  /////////////////////////////////////////// 
                  foreach($resultado5 as $indice => $value){
                    $saldodolares_ant      = 0;
                    $saldosoles_ant        = 0;
                $cliente        = $value->cliente;
                $inicialdolares = $value->inicialdolares;
                $inicialsoles   = $value->inicialsoles;
                $sumadolares    = $value->sumadolares;
                $sumasoles      = $value->sumasoles;
                $factDolares    = $value->factDolares;
                $factSoles      = $value->factSoles;
                $mes            = $value->mes;
                $dia            = $value->dia;
                $anio           = $value->anio;
                $numero         = $value->numero;
                $codcli         = $value->codcli;
                
                
                    
                    $sheet->write($fila,0,$item,$format_bold2);
                    $sheet->write($fila,1,$numero,$format_bold2); 
                    $sheet->write($fila,2,"".$dia."/".$mes."/".$anio."",$format_bold2);
                    $sheet->write($fila,3,$sumasoles,$format_bold2);
                    $sheet->write($fila,4,$sumadolares,$format_bold2);
                    $sheet->write($fila,5,$factSoles,$format_bold2);
                    $sheet->write($fila,6,$factDolares,$format_bold2);
                    $sheet->write($fila,7,($sumasoles-$factSoles),$format_bold2);
                    $sheet->write($fila,8,($sumadolares-$factDolares),$format_bold2);
                    $sheet->write($fila,9,(($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares),$format_bold2);
                    
                    
                    $codigo_ant = $codigo;
                    $factDol_ant = $factDol;
                    $factSol_ant = $factSol;
                    $anio_ant    = $anio;
                    $mes_ant     = $mes;
                    $acumulado_dolares     = $acumulado_dolares + $sumadolares;
                    $acumulado_soles       = $acumulado_soles + $sumasoles;
                    $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                    $acumuado_factSoles    = $acumuado_factSoles + $factSoles;

                    $acumuado_saldoDolares = $acumuado_saldoDolares + ($sumadolares-$factDolares);
                    $acumuado_saldoSoles   = $acumuado_saldoSoles + ($sumasoles-$factSoles);
                    $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares);
                    $item++;
                    $fila++;
                    
                   
                  }

                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,8,$acumulado_soles,$format_bold2);else $sheet->write($fila,3,$acumulado_soles,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,9,$acumulado_dolares,$format_bold2);else $sheet->write($fila,4,$acumulado_dolares,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,10,$acumuado_factSoles,$format_bold2);else $sheet->write($fila,5,$acumuado_factSoles,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,11,$acumuado_factDolares,$format_bold2);else $sheet->write($fila,6,$acumuado_factDolares,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,12,$acumuado_saldoSoles,$format_bold2);else $sheet->write($fila,7,$acumuado_saldoSoles,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,13,$acumuado_saldoDolares,$format_bold2);else $sheet->write($fila,8,$acumuado_saldoDolares,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,14,$acumuado_saldoDolares_total,$format_bold2);else $sheet->write($fila,9,$acumuado_saldoDolares_total,$format_bold2);                       
                  $xls->close();
                }
                
                
                
                
                
                
                
                
                
                
                elseif($tipo=="pdf" && $nivel=="3"){
                $this->load->library("fpdf/pdf");
                $CI = & get_instance();
                $CI->pdf->FPDF('L','mm','A4');
                $CI->pdf->AliasNbPages();
                ////////////////////////////////////////////////////////////////
                $CI->pdf->AddPage();
                $CI->pdf->SetTextColor(0,0,0);
                $CI->pdf->SetFillColor(255,255,255);
                ////////////////////////////////////////////////////////////////
                $CI->pdf->SetFont('Arial','B',13);
                $CI->pdf->SetY(5);
                $CI->pdf->SetX(10); 
                $CI->pdf->Cell(284,20,"REPORTE POR FACTURAR POR CLIENTE - (DETALLE2)",1,1,"C",0);
                $CI->pdf->SetX(10); 
                $CI->pdf->Cell(284,8,"Reporte durante el 2012",1,1,"L",0);
                ////////////////////////////////////////////////////////////////
                $CI->pdf->SetFont('Arial','',7);
                $CI->pdf->SetY(35);
                $CI->pdf->SetX(10); 
                $CI->pdf->Cell(10,5,"No",1,0,"C",0);
                $CI->pdf->Cell(40,5,"NUMERO",1,0,"C",0);
                $CI->pdf->Cell(50,5,"FECHA",1,0,"C",0);
                $CI->pdf->Cell(25,5,"VALORdeVENTA(S/)",1,0,"C",0);
                $CI->pdf->Cell(25,5,"VALORdeVENTA $",1,0,"C",0);
                $CI->pdf->Cell(27,5,"FACTURADO(S/)",1,0,"C",0);
                $CI->pdf->Cell(27,5,"FACTURADO $",1,0,"C",0);
                $CI->pdf->Cell(26,5,"SALDOxFACTURAR(S/)",1,0,"C",0);
                $CI->pdf->Cell(26,5,"SALDOxFACTURAR $",1,0,"C",0); //
                $CI->pdf->Cell(28,5,"TOTALxFACTURAR $",1,0,"C",0);
                ////////////////////////////////////////////////////////////////
                   $CI->pdf->SetFont('Arial','',8);
                   $CI->pdf->SetY(40);
                   $CI->pdf->SetX(10);
                ////////////////////////////////////////////////////////////////
                    $anio   = "";
                    $mes    = "";
                    $numero    = "";
                    $sumadolares = "";
                    $sumasoles   = "";
                    $factDolares = "";
                    $factSoles   = "";
                    $anio_ant    = "";
                    $item        = 1;
                    $acumulado_dolares     = 0;
                    $acumulado_soles       = 0;
                    $acumuado_factDolares  = 0;
                    $acumuado_factSoles    = 0;
                    $acumuado_saldoSoles   = 0;
                    $acumuado_saldoDolares = 0;
                    $acumuado_saldoDolares_total = 0;
                    $acumulado_saldosoles_ant   = 0;
                    $acumulado_saldodolares_ant = 0;  
                    ////////////////////////////////////////////////////////////////
                    $fila = 1;
                    $codigo  = "";
                    $factDol = 0;
                    $factSol = 0;
                    ////////////////////////////////////////////////////////////////   
                    $resultado6  = $this->ot_model->rpt_por_facturar_cliente_detalle2($tipOt,$fInicio,$fFin,$codot);
                    foreach($resultado6 as $indice => $value){
                    $saldodolares_ant      = 0;
                    $saldosoles_ant        = 0;
                    $cliente        = $value->cliente;
                    $inicialdolares = $value->inicialdolares;
                    $inicialsoles   = $value->inicialsoles;
                    $sumadolares    = $value->sumadolares;
                    $sumasoles      = $value->sumasoles;
                    $factDolares    = $value->factDolares;
                    $factSoles      = $value->factSoles;
                    $mes            = $value->mes;
                    $dia            = $value->dia;
                    $anio           = $value->anio;
                    $numero         = $value->numero;
                    $codcli         = $value->codcli;

                
                        $CI->pdf->Cell(10,5,$item,1,0,"C",0);
                        
                        $CI->pdf->Cell(40,5,$numero,1,0,"C",0);
                        
                        $CI->pdf->Cell(50,5,"".$dia."/".$mes."/".$anio."",1,0,"C",0);
                        
                        $CI->pdf->Cell(25,5,$sumasoles,1,0,"R",0);
                        
                        $CI->pdf->Cell(25,5,$sumadolares,1,0,"R",0);
                        
                        $CI->pdf->Cell(27,5,$factSoles,1,0,"R",0);
                        
                        $CI->pdf->Cell(27,5,$factDolares,1,0,"R",0);
                        
                        $CI->pdf->Cell(26,5,($sumasoles-$factSoles),1,0,"R",0);
                        
                        $CI->pdf->Cell(26,5,($sumadolares-$factDolares),1,0,"R",0);

                        $CI->pdf->Cell(28,5,(($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares),1,1,"R",0); 
                                    
                    $codigo_ant = $codigo;
                    $factDol_ant = $factDol;
                    $factSol_ant = $factSol;
                    $anio_ant    = $anio;
                    $mes_ant     = $mes;
                    $acumulado_dolares     = $acumulado_dolares + $sumadolares;
                    $acumulado_soles       = $acumulado_soles + $sumasoles;
                    $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                    $acumuado_factSoles    = $acumuado_factSoles + $factSoles;
                    $acumuado_saldoDolares = $acumuado_saldoDolares + ($sumadolares-$factDolares);
                    $acumuado_saldoSoles   = $acumuado_saldoSoles + ($sumasoles-$factSoles);
                    $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares);
                        
                        $item++;
                        $fila++; 
                    }
                    
                        $CI->pdf->Cell(10,5,"",1,0,"C",0);
                        
                        $CI->pdf->Cell(40,5,"",1,0,"L",0);
                        
                        $CI->pdf->Cell(50,5,"",1,0,"L",0);
                        
                        $CI->pdf->Cell(25,5,$acumulado_soles,1,0,"R",0);
                        
                        $CI->pdf->Cell(25,5,$acumulado_dolares,1,0,"R",0);
                        
                        $CI->pdf->Cell(27,5,$acumuado_factSoles,1,0,"R",0);
                        
                        $CI->pdf->Cell(27,5,$acumuado_factDolares,1,0,"R",0);
                        
                        $CI->pdf->Cell(26,5,$acumuado_saldoSoles,1,0,"R",0);
                        
                        $CI->pdf->Cell(26,5,$acumuado_saldoDolares,1,0,"R",0);

                        $CI->pdf->Cell(28,5,$acumuado_saldoDolares_total,1,1,"R",0); 
                    
                  $CI->pdf->Output();
               }

                
        }   

        $data2['acumulado_soles']             = $acumulado_soles;
        $data2['acumulado_dolares']           = $acumulado_dolares;
        $data2['acumuado_factSoles']          = $acumuado_factSoles;
        $data2['acumuado_factDolares']        = $acumuado_factDolares;
        $data2['acumuado_saldoSoles']         = $acumuado_saldoSoles;
        $data2['acumuado_saldoDolares']       = $acumuado_saldoDolares;
        $data2['acumuado_saldoDolares_total'] = $acumuado_saldoDolares_total;  

        $data2['fFin']       = $fFin;
        $data2['fInicio']    = $fInicio;
        $data2['codcliente'] = $codcliente;    
        $data2['cboCli']     = $cboCli;        
        $data2['opcion']     = $opcion;   
        $data2['tc']         = $tc;  
        $data2['chkDia']     = $chkDia; 
        $data2['chkMes']     = $chkMes; 
        $data2['chkAnio']    = $chkAnio; 
        $data2['fila']       = $fila; 
        $data2['tipo']       = $tipo; 
        $data2['periodoOt']  = $periodoOt;    
        $this->load->view(ventas."ots_x_facturar",$data2);
    }

    
    
    
    
    
    public function rpt_por_facturar_cliente_detalle()
    {
        $opcion     = $this->input->get_post('opcion');   
        $tipo       = $this->input->get_post('tipo');   
        $fInicio    = $this->input->get_post('fInicio');   
        $fFin       = $this->input->get_post('fFin');   
        $tipOt      = $this->input->get_post('codperiodo');
        $codcliente = $this->input->get_post('codcliente2');
        $this->form_validation->set_rules('codcliente','Cliente','required');
        $this->form_validation->set_rules('codperiodo','Periodo','required');
        $this->form_validation->set_rules('fFin','Fecha','required');   
        $this->form_validation->set_rules('tipo','Tipo de reporte','required'); 
        $arrfInicio = explode("/",$fInicio);
        $arrfFin    = explode("/",$fFin);
        $f1         = mktime( 0, 0, 0,$arrfInicio[1]+1-1,$arrfInicio[0]+1-1,$arrfInicio[2]+1-1); 
        $f2         = mktime( 0, 0, 0,$arrfFin[1]+1-1,$arrfFin[0]+1-1,$arrfFin[2]+1-1); 
        $cboCli     = $this->alumno_model->seleccionar("Seleccionar todos","000000");
        $periodoOt  = form_dropdown('codperiodo',$this->periodoot_model->seleccionar('',''),$tipOt,"id='codperiodo' class='comboMedio'");   
        $filter     = new stdClass();
        $filter_not = new stdClass();
        $filter->codcliente = $codcliente;
        $arrCliente = $this->alumno_model->obtener($filter,$filter_not);
        if($f2 < $f1){
            redirect(ventas."ot/rpt_por_facturar_cliente_detalle");
        }
        $arrTc      = $this->tc_model->obtener($fFin);
        $tc         = $arrTc->Valor_2;
        $resultado  = $this->ot_model->rpt_por_facturar_cliente_detalle($tipOt,$fInicio, $fFin, $codcliente);
        if($tipo=="html"){
            $anio   = "";
            $mes    = "";
            $codcli = "";
            $cliente     = "";
            $sumadolares = "";
            $sumasoles   = "";
            $factDolares = ""; 
            $factSoles   = "";
            $factDol     = "";
            $factSol     = "";                
            $anio_ant    = "";
            $item        = 1;
            $fila        = "";
            $acumulado_dolares = 0;
            $acumulado_soles   = 0;
            $acumuado_factDolares = 0;
            $acumuado_factSoles   = 0;
            $acumulado_saldosoles_ant   = 0;
            $acumulado_saldodolares_ant = 0;
            $acumuado_saldoDolares = 0;
            $acumuado_saldoSoles   = 0;
            $acumuado_saldoDolares_total = 0;
            foreach($resultado as $indice => $value){
                $saldodolares_ant      = 0;
                $saldosoles_ant        = 0;	
                $inicialdolares = $value->inicialdolares;
                $inicialsoles   = $value->inicialsoles;
                $sumadolares    = $value->sumadolares;
                $sumasoles      = $value->sumasoles;
                $factDolares    = $value->factDolares;
                $totalDolares   = $value->totalDolares;
                $factSoles      = $value->factSoles;
                $numero         = $value->numero;
                $site           = $value->site;
                $codot          = $value->codot;
                $fila.="<tr ondblClick='rpt_detalle2(\"".$codot."\");' id='".$codot."'>";
                $fila.="<td align='center'>".$item."</td>";
                $chkDia = 1;
                $fila.=($chkDia=='1'?"<td><a href='javascript:;'>".(trim($numero)=='11-000000'?"SALDO INICIAL":$numero)." (".$site.")</a></td>":"");
                $fila.="<td align='right'>".number_format($sumasoles,2,",",".")."</td>";
                $fila.="<td align='right'>".number_format($sumadolares,2,",",".")."</td>";
                $fila.="<td align='right'>".number_format($factSoles,2,",",".")."</td>";
                $fila.="<td align='right'>".number_format($factDolares,2,",",".")."</td>";
                $fila.="<td align='right' style='background-color: #DDECFE; opacity:0.8' >".number_format(($inicialsoles+$sumasoles-$factSoles),2,",",".")."</td>";				
                $fila.="<td align='right' style='background-color: #FFFFCC; opacity:0.8' >".number_format(($inicialdolares+$sumadolares-$factDolares),2,",",".")."</td>";
                $fila.="<td align='right' style='background-color: #CCFFCC; opacity:0.8' >".number_format((($inicialsoles+$sumasoles-$factSoles)/$tc)+($inicialdolares+$sumadolares-$factDolares),2,",",".")."</td>";
                $fila.="</tr>";
                //$codigo_ant  = $codigo;
                $factDol_ant = $factDol;
                $factSol_ant = $factSol;
                $anio_ant    = $anio;
                $mes_ant     = $mes;
                $acumulado_dolares     = $acumulado_dolares + $sumadolares;
                $acumulado_soles       = $acumulado_soles + $sumasoles;
                $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                $acumuado_factSoles    = $acumuado_factSoles + $factSoles;
                $acumulado_saldosoles_ant   = $acumulado_saldosoles_ant + $inicialsoles;
                $acumulado_saldodolares_ant = $acumulado_saldodolares_ant + $inicialdolares; 
                $acumuado_saldoDolares = $acumuado_saldoDolares + ($inicialdolares+$sumadolares-$factDolares);
                $acumuado_saldoSoles   = $acumuado_saldoSoles + ($inicialsoles+$sumasoles-$factSoles);
                $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($inicialsoles+$sumasoles-$factSoles)/$tc)+($inicialdolares+$sumadolares-$factDolares);  
                $item++;
            }
            $cantidad = count($resultado);              
        } 
        elseif($tipo=="excel"){
            $xls = new Spreadsheet_Excel_Writer();
            $xls->send("ReportexFacturarCliente.xls");
            $sheet  =$xls->addWorksheet('xFacturarCli.');
            $sheet->setInputEncoding('ISO-8859-7');
            $format =$xls->addFormat();
            $format->setBold();
              $sheet->setRow(0, 40);
              $sheet->setRow(1,10);
              $sheet->setRow(2,45);
              $sheet->setRow(3,15);
              $sheet->setRow(4,15);
              $sheet->setRow(5,15);
              $sheet->setRow(6,15);
              $sheet->setRow(7,15);
              $sheet->setRow(8,15);
              $sheet->setRow(9,15);
              $sheet->setRow(10,15);
              $sheet->setRow(11,15);
             
              
              $format_bold=$xls->addFormat();
              $format_bold->setBold();
              $format_bold->setSize(9);
              $format_bold->setvAlign('vcenter');
              $format_bold->sethAlign('center');
              $format_bold->setBorder(1);
              $format_bold->setTextWrap();
             
              $format_titulo=$xls->addFormat();
              $format_titulo->setBold();
              $format_titulo->setSize(9);
              $format_titulo->setvAlign('vcenter');
              $format_titulo->sethAlign('center');
              $format_titulo->setBorder(1);
              $format_titulo->setTextWrap();
              
              $format_bold2=$xls->addFormat();
              $format_bold2->setSize(9);
              $format_bold2->setvAlign('vcenter');
              $format_bold2->sethAlign('center');
              $format_bold2->setBorder(1);
              $format_bold2->setTextWrap();
 
              $sheet->setColumn(0,0,11); //COLUMNA A1
              $sheet->setColumn(1,1,61); //COLUMNA B2
              $sheet->setColumn(2,2,12); //COLUMNA C3
              $sheet->setColumn(3,3,12); //COLUMNA D4
              $sheet->setColumn(4,4,12); //COLUMNA E5
              $sheet->setColumn(5,5,12); //COLUMNA F6
              $sheet->setColumn(6,6,12); //COLUMNA G7
              $sheet->setColumn(7,7,12); //COLUMNA H8
              $sheet->setColumn(8,8,12); //COLUMNA I9

                  
              $sheet->mergeCells(0,0,0,8);  
              $sheet->write(0,1,"REPORTE POR FACTURAR POR CLIENTE (INCLUYE NUEVAS VENTAS)",$format_titulo); $sheet->write(0,2,"",$format_bold); $sheet->write(0,3,"",$format_bold); $sheet->write(0,4,"",$format_bold); $sheet->write(0,5,"",$format_bold); $sheet->write(0,6,"",$format_bold);   $sheet->write(0,7,"",$format_bold);   $sheet->write(0,8,"",$format_bold);  
              $sheet->write(0,0,"REPORTE DEL 2012",$format_bold);
              
              $sheet->write(2,0,"No",$format_bold);       $sheet->write(2,1,"CLIENTE",$format_bold);  $sheet->write(2,2,"VALOR DE VENTA S/.",$format_bold);  $sheet->write(2,3,"VALOR DE VENTA $",$format_bold);   $sheet->write(2,4,"MONTO FACTURADO S/.",$format_bold);      $sheet->write(2,5,"MONTO FACTURADO $",$format_bold);   $sheet->write(2,6,"SALDO POR FACTURAR S/.",$format_bold);    $sheet->write(2,7,"SALDO POR FACTURAR $",$format_bold);   $sheet->write(2,8,"SALDO TOTAL POR FACTURAR $",$format_bold);  
              
              
                  $anio   = "";
                  $mes    = "";
                  $codcli = "";
                  $cliente     = "";
                  $sumadolares = "";
                  $sumasoles   = "";
                  $factDolares = "";
                  $factSoles   = "";
                  $anio_ant    = "";
                  $item        = 1;
                  $acumulado_dolares     = 0;
                  $acumulado_soles       = 0;
                  $acumuado_factDolares  = 0;
                  $acumuado_factSoles    = 0;
                  $acumuado_saldoSoles   = 0;
                  $acumuado_saldoDolares = 0;
                  $acumuado_saldoDolares_total = 0;
                  $acumulado_saldosoles_ant   = 0;
                  $acumulado_saldodolares_ant = 0;   
                  $fila = 3;
                  $codigo  = "";
                  $factDol = 0;
                  $factSol = 0;
                  foreach($resultado as $indice => $value){
                    $saldodolares_ant      = 0;
                    $saldosoles_ant        = 0;	
                    $cliente        = $value->cliente;
                    $sumadolares    = $value->sumadolares;
                    $sumasoles      = $value->sumasoles;
                    $factDolares    = $value->factDolares;
                    $factSoles      = $value->factSoles;
                    $mes            = ($chkMes=='1'?$value->mes:"");
                    $dia            = ($chkDia=='1'?$value->dia:"");
                    $anio           = ($chkAnio=='1'?$value->anio:"");
                    $numero         = ($chkAnio=='1'?$value->numero:"");
                    $site           = $value->site;
                    $codcli         = $value->codcli;
                    
                    $sheet->write($fila,0,$item,$format_bold2);
                    if($chkAnio=="1") $sheet->write($fila,1,$anio,$format_bold2);
                    if($chkMes=="1")  $sheet->write($fila,2,$mes,$format_bold2);
                    if($chkDia=="1")  $sheet->write($fila,3,$dia,$format_bold2);
                    if($chkDia=="1")  $sheet->write($fila,4,(trim($numero)=='11-000000'?"SALDO INICIAL":$numero),$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1")  $sheet->write($fila,5,$cliente,$format_bold2);else $sheet->write($fila,1,$cliente,$format_bold2); 
                    if($opcion=='4' && isset($_REQUEST['fInicio'])){
                       
                    }
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,8,$sumasoles,$format_bold2);else $sheet->write($fila,2,$sumasoles,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,9,$sumadolares,$format_bold2);else $sheet->write($fila,3,$sumadolares,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,10,$factSoles,$format_bold2);else $sheet->write($fila,4,$factSoles,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,11,$factDolares,$format_bold2);else $sheet->write($fila,5,$factDolares,$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,12,($sumasoles-$factSoles),$format_bold2);else $sheet->write($fila,6,($sumasoles-$factSoles),$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,13,($sumadolares-$factDolares),$format_bold2);else $sheet->write($fila,7,($sumadolares-$factDolares),$format_bold2);
                    if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,14,(($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares),$format_bold2);else $sheet->write($fila,8,(($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares),$format_bold2);         
                    $codigo_ant = $codigo;
                    $factDol_ant = $factDol;
                    $factSol_ant = $factSol;
                    $anio_ant    = $anio;
                    $mes_ant     = $mes;
                    $acumulado_dolares     = $acumulado_dolares + $sumadolares;
                    $acumulado_soles       = $acumulado_soles + $sumasoles;
                    $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                    $acumuado_factSoles    = $acumuado_factSoles + $factSoles;

                    $acumuado_saldoDolares = $acumuado_saldoDolares + ($sumadolares-$factDolares);
                    $acumuado_saldoSoles   = $acumuado_saldoSoles + ($sumasoles-$factSoles);
                    $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares);
                    $item++;
                    $fila++;
                  }

                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,8,$acumulado_soles,$format_bold2);else $sheet->write($fila,2,$acumulado_soles,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,9,$acumulado_dolares,$format_bold2);else $sheet->write($fila,3,$acumulado_dolares,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,10,$acumuado_factSoles,$format_bold2);else $sheet->write($fila,4,$acumuado_factSoles,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,11,$acumuado_factDolares,$format_bold2);else $sheet->write($fila,5,$acumuado_factDolares,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,12,$acumuado_saldoSoles,$format_bold2);else $sheet->write($fila,6,$acumuado_saldoSoles,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,13,$acumuado_saldoDolares,$format_bold2);else $sheet->write($fila,7,$acumuado_saldoDolares,$format_bold2);
                  if($chkAnio=="1" && $chkMes=="1" && $chkDia=="1") $sheet->write($fila,14,$acumuado_saldoDolares_total,$format_bold2);else $sheet->write($fila,8,$acumuado_saldoDolares_total,$format_bold2);                       
                  $xls->close();
                }
                elseif($tipo=="pdf"){
                    $this->load->library("fpdf/pdf");
                    $CI = & get_instance();
                    $CI->pdf->FPDF('L','mm','A4');
                    $CI->pdf->AliasNbPages();
                    $CI->pdf->AddPage();
                    $CI->pdf->SetTextColor(0,0,0);
                    $CI->pdf->SetFillColor(255,255,255);
                    $CI->pdf->SetFont('Arial','B',13);
                    $CI->pdf->SetY(5);
                    $CI->pdf->SetX(10); 
                    $CI->pdf->Cell(284,20,"REPORTE POR FACTURAR POR CLIENTE - (DETALLE1)",1,1,"C",0);
                    $CI->pdf->SetX(10); 
                    $CI->pdf->Cell(284,8,"Reporte durante el 2012",1,1,"L",0);
                    $CI->pdf->SetFont('Arial','',7);
                    $CI->pdf->SetY(35);
                    $CI->pdf->SetX(10); 
                    $CI->pdf->Cell(10,5,"No",1,0,"C",0);
                    $CI->pdf->Cell(90,5,"CLIENTE",1,0,"C",0);
                    $CI->pdf->Cell(25,5,"VALORdeVENTA(S/)",1,0,"C",0);
                    $CI->pdf->Cell(25,5,"VALORdeVENTA $",1,0,"C",0);
                    $CI->pdf->Cell(27,5,"FACTURADO(S/)",1,0,"C",0);
                    $CI->pdf->Cell(27,5,"FACTURADO $",1,0,"C",0);
                    $CI->pdf->Cell(26,5,"SALDOxFACTURAR(S/)",1,0,"C",0);
                    $CI->pdf->Cell(26,5,"SALDOxFACTURAR $",1,0,"C",0); //
                    $CI->pdf->Cell(28,5,"TOTALxFACTURAR $",1,0,"C",0);
                    $CI->pdf->SetFont('Arial','',8);
                    $CI->pdf->SetY(40);
                    $CI->pdf->SetX(10);
                    $anio   = "";
                    $mes    = "";
                    $codcli = "";
                    $cliente     = "";
                    $sumadolares = "";
                    $sumasoles   = "";
                    $factDolares = "";
                    $factSoles   = "";
                    $anio_ant    = "";
                    $item        = 1;
                    $acumulado_dolares     = 0;
                    $acumulado_soles       = 0;
                    $acumuado_factDolares  = 0;
                    $acumuado_factSoles    = 0;
                    $acumuado_saldoSoles   = 0;
                    $acumuado_saldoDolares = 0;
                    $acumuado_saldoDolares_total = 0;
                    $acumulado_saldosoles_ant   = 0;
                    $acumulado_saldodolares_ant = 0;  
                    $fila = 1;
                    $codigo  = "";
                    $factDol = 0;
                    $factSol = 0;
                    foreach($resultado as $indice => $value){
                        $saldodolares_ant = 0;
                        $saldosoles_ant   = 0;	
                        $cliente        = $value->cliente;
                        $inicialdolares = $value->inicialdolares;
                        $inicialsoles   = $value->inicialsoles;
                        $sumadolares    = $value->sumadolares;
                        $sumasoles      = $value->sumasoles;
                        $factDolares    = $value->factDolares;
                        $factSoles      = $value->factSoles;
                        $mes            = ($chkMes=='1'?$value->mes:"");
                        $dia            = ($chkDia=='1'?$value->dia:"");
                        $anio           = ($chkAnio=='1'?$value->anio:"");
                        $numero         = ($chkAnio=='1'?$value->numero:"");
                        $codcli         = $value->codcli;
                        $CI->pdf->Cell(10,5,$item,1,0,"C",0);
                        $CI->pdf->Cell(90,5,$cliente,1,0,"L",0);
                        $CI->pdf->Cell(25,5,$sumasoles,1,0,"R",0);
                        $CI->pdf->Cell(25,5,$sumadolares,1,0,"R",0);
                        $CI->pdf->Cell(27,5,$factSoles,1,0,"R",0);
                        $CI->pdf->Cell(27,5,$factDolares,1,0,"R",0);
                        $CI->pdf->Cell(26,5,($sumasoles-$factSoles),1,0,"R",0);
                        $CI->pdf->Cell(26,5,($sumadolares-$factDolares),1,0,"R",0);
                        $CI->pdf->Cell(28,5,(($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares),1,1,"R",0); 
                        $codigo_ant = $codigo;
                        $factDol_ant = $factDol;
                        $factSol_ant = $factSol;
                        $anio_ant    = $anio;
                        $mes_ant     = $mes;
                        $acumulado_dolares     = $acumulado_dolares + $sumadolares;
                        $acumulado_soles       = $acumulado_soles + $sumasoles;
                        $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                        $acumuado_factSoles    = $acumuado_factSoles + $factSoles;
                        $acumuado_saldoDolares = $acumuado_saldoDolares + ($sumadolares-$factDolares);
                        $acumuado_saldoSoles   = $acumuado_saldoSoles + ($sumasoles-$factSoles);
                        $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($sumasoles-$factSoles)/$tc)+($sumadolares-$factDolares);
                        $item++;
                        $fila++; 
                    }
                    $CI->pdf->Cell(10,5,"",1,0,"C",0);
                    $CI->pdf->Cell(90,5,"",1,0,"L",0);
                    $CI->pdf->Cell(25,5,$acumulado_soles,1,0,"R",0);
                    $CI->pdf->Cell(25,5,$acumulado_dolares,1,0,"R",0);
                    $CI->pdf->Cell(27,5,$acumuado_factSoles,1,0,"R",0);
                    $CI->pdf->Cell(27,5,$acumuado_factDolares,1,0,"R",0);
                    $CI->pdf->Cell(26,5,$acumuado_saldoSoles,1,0,"R",0);
                    $CI->pdf->Cell(26,5,$acumuado_saldoDolares,1,0,"R",0);
                    $CI->pdf->Cell(28,5,$acumuado_saldoDolares_total,1,1,"R",0); 
                    $CI->pdf->Output();
                }

        $data2['acumulado_soles']             = $acumulado_soles;
        $data2['acumulado_dolares']           = $acumulado_dolares;
        $data2['acumuado_factSoles']          = $acumuado_factSoles;
        $data2['acumuado_factDolares']        = $acumuado_factDolares;
        $data2['acumuado_saldoSoles']         = $acumuado_saldoSoles;
        $data2['acumuado_saldoDolares']       = $acumuado_saldoDolares;
        $data2['acumuado_saldoDolares_total'] = $acumuado_saldoDolares_total;  
        $data2['fFin']       = $fFin;
        $data2['fInicio']    = $fInicio;
        $data2['codcliente'] = $codcliente;    
        $data2['tc']         = $tc;  
        $data2['fila']       = $fila; 
        $data2['tipo']       = $tipo; 
        $data2['razon_social'] = $arrCliente->RazCli;
        $data2['periodoOt']  = $periodoOt;
       $this->load->view(ventas."ots_x_facturar_detalle",$data2);  
    }
    
    public function rpt_por_facturar_cliente_detalle2()
    {
        $opcion     = $this->input->get_post('opcion');   
        $tipo       = $this->input->get_post('tipo');   
        $fInicio    = $this->input->get_post('fInicio');   
        $fFin       = $this->input->get_post('fFin'); 
        $codot      = $this->input->get_post('codot'); 
        $tipOt      = $this->input->get_post('codperiodo');
        $arrfInicio = explode("/",$fInicio);
        $arrfFin    = explode("/",$fFin);
        $f1         = mktime( 0, 0, 0,$arrfInicio[1]+1-1,$arrfInicio[0]+1-1,$arrfInicio[2]+1-1); 
        $f2         = mktime( 0, 0, 0,$arrfFin[1]+1-1,$arrfFin[0]+1-1,$arrfFin[2]+1-1); 
        $cboCli     = $this->alumno_model->seleccionar("Seleccionar todos","000000");
        if($f2 < $f1){
            redirect(ventas."ot/rpt_por_facturar_cliente");
        }
        $arrTc      = $this->tc_model->obtener($fFin);
        $tc         = $arrTc->Valor_2;
        $resultado  = $this->ot_model->rpt_por_facturar_cliente_detalle2($tipOt,$fInicio,$fFin,$codot);
        if($tipo=="html"){
            $anio   = "";
            $mes    = "";
            $codcli = "";
            $cliente     = "";
            $sumadolares = "";
            $sumasoles   = "";
            $factDolares = ""; 
            $factSoles   = "";
            $factDol     = "";
            $factSol     = "";                
            $anio_ant    = "";
            $item        = 1;
            $fila        = "";
            $acumulado_dolares = 0;
            $acumulado_soles   = 0;
            $acumuado_factDolares = 0;
            $acumuado_factSoles   = 0;
            $acumulado_saldosoles_ant   = 0;
            $acumulado_saldodolares_ant = 0;
            $acumuado_saldoDolares = 0;
            $acumuado_saldoSoles   = 0;
            $acumuado_saldoDolares_total = 0;
            $saldo_ant_soles   = 0;
            $saldo_ant_dolares = 0;
            $saldo_ant_dolares_tot = 0;
            foreach($resultado as $indice => $value){
                $saldodolares_ant      = 0;
                $saldosoles_ant        = 0;	
                $cliente           = $value->cliente;
                $inicialdolares    = $value->inicialdolares;
                $inicialsoles      = $value->inicialsoles;
                $sumadolares       = $value->sumadolares;
                $sumasoles         = $value->sumasoles;
                $factDolares       = $value->factDolares;
                $factSoles         = $value->factSoles;
                $mes               = $value->mes;
                $dia               = $value->dia;
                $anio              = $value->anio;
                $numero            = $value->numero;
                $codcli            = $value->codcli;
                $tipo              = $value->tipo;
                $nrodoc            = $value->nrodoc;
                $saldo_soles       = $inicialsoles+$sumasoles-$factSoles+$saldo_ant_soles;
                $saldo_dolares     = $inicialdolares+$sumadolares-$factDolares+$saldo_ant_dolares;
                $saldo_dolares_tot = (($inicialsoles+$sumasoles-$factSoles)/$tc)+($inicialdolares+$sumadolares-$factDolares)+$saldo_ant_dolares_tot;
                $fila.="<tr>";
                $fila.="<td align='center'>".$item."</td>";
                $fila.="<td>".(trim($numero)=='11-000000'?"SALDO INICIAL":$numero)."</td>";
                $fila.="<td>". $dia."/".$mes."/".$anio."</td>";
                $fila.="<td align='center'>".$tipo."</td>";
                $fila.="<td align='center'>".$nrodoc."</td>";
                $fila.="<td align='right'>".number_format($sumasoles,2,",",".")."</td>";
                $fila.="<td align='right'>".number_format($sumadolares,2,",",".")."</td>";
                $fila.="<td align='right'>".number_format($factSoles,2,",",".")."</td>";
                $fila.="<td align='right'>".number_format($factDolares,2,",",".")."</td>";
                $fila.="<td align='right' style='background-color: #DDECFE; opacity:0.8' >".number_format($saldo_soles,2,",",".")."</td>";				
                $fila.="<td align='right' style='background-color: #FFFFCC; opacity:0.8' >".number_format($saldo_dolares,2,",",".")."</td>";
                $fila.="<td align='right' style='background-color: #CCFFCC; opacity:0.8' >".number_format($saldo_dolares_tot,2,",",".")."</td>";	
                $fila.="</tr>";
                //$codigo_ant  = $codigo;
                $factDol_ant           = $factDol;
                $factSol_ant           = $factSol;
                $anio_ant              = $anio;
                $mes_ant               = $mes;
                $saldo_ant_soles       = $saldo_soles;
                $saldo_ant_dolares     = $saldo_dolares; 
                $saldo_ant_dolares_tot = $saldo_dolares_tot;
                $acumulado_dolares     = $acumulado_dolares + $sumadolares;
                $acumulado_soles       = $acumulado_soles + $sumasoles;
                $acumuado_factDolares  = $acumuado_factDolares + $factDolares;
                $acumuado_factSoles    = $acumuado_factSoles + $factSoles;
                $acumulado_saldosoles_ant   = $acumulado_saldosoles_ant + $inicialsoles;
                $acumulado_saldodolares_ant = $acumulado_saldodolares_ant + $inicialdolares; 
                $acumuado_saldoDolares = $acumuado_saldoDolares + ($inicialdolares+$sumadolares-$factDolares);
                $acumuado_saldoSoles   = $acumuado_saldoSoles + ($inicialsoles+$sumasoles-$factSoles);
                $acumuado_saldoDolares_total = $acumuado_saldoDolares_total + (($inicialsoles+$sumasoles-$factSoles)/$tc)+($inicialdolares+$sumadolares-$factDolares);
                $item++;
            }
            $cantidad = count($resultado);              
        }
        $data2['fFin']       = $fFin;
        $data2['fInicio']    = $fInicio;
        $data2['numero']      = $numero;    
        $data2['cboCli']     = $cboCli;        
        $data2['opcion']     = $opcion;   
        $data2['tc']         = $tc;  
        $data2['numero']     = $numero;
        $data2['fila']       = $fila; 
        $data2['tipo']       = $tipo; 
        $data2['razon_social'] = $cliente;
        $data2['acumulado_dolares']    = $acumulado_dolares;
        $data2['acumulado_soles']      = $acumulado_soles;
        $data2['acumuado_factDolares'] = $acumuado_factDolares;
        $data2['acumuado_factSoles']   = $acumuado_factSoles;
        $data2['acumulado_saldosoles_ant']    = $acumulado_saldosoles_ant;
        $data2['acumulado_saldodolares_ant']  = $acumulado_saldodolares_ant;
        $data2['acumuado_saldoDolares']       = $acumuado_saldoDolares;
        $data2['acumuado_saldoSoles']         = $acumuado_saldoSoles;
        $data2['acumuado_saldoDolares_total'] = $acumuado_saldoDolares_total;
         
        $this->load->view(ventas."ots_x_facturar_detalle2",$data2);        
    }
    
    public function rpt_por_facturar_cliente_grafica(){
//        $this->load->library("pchart/pchart");
//        $CI = & get_instance();
//        $this->load->library("pchart/pdata");
//        $CI = & get_instance();
//        $CI->pData->AddPoint(array(10,2,3,5,3),"Serie1");
//        $CI->pData->AddPoint(array("Enero","Febrero","Marzo","Abril","Mayo"),"Serie2");
//        $CI->pData->AddAllSeries();
//        $CI->pData->SetAbsciseLabelSerie("Serie2");
//        $Test = new pChart(380,200);
//        $Test->drawFilledRoundedRectangle(7, 7, 373, 193, 5, 240, 240, 240);
//        $Test->drawRoundedRectangle(5, 5, 375, 195, 5, 230, 230, 230);
//        die();
//      
//                    $this->load->library("fpdf/pdf");
//                    $CI = & get_instance();
//                    $CI->pdf->AliasNbPages();
//                    $CI->pdf->AddPage();
//                    $CI->pdf->SetTextColor(0,0,0);
//                    $CI->pdf->SetFillColor(0,0,255);
//                    $CI->pdf->SetFont('Arial','B',13);
//                    $CI->pdf->Cell(180,15,"REPORTE POR FACTURAR POR CLIENTE - (INCLUYE NUEVAS VENTAS)",0,1,"C",0);
//                    $CI->pdf->SetFont('Arial','',8);
//                    $CI->pdf->Cell(10,3,"No",1,0,"C",0);
    }
    
    public function rpt_control_pesos(){
        $filacabecera   = "";
        $filafooter     = "";
        $filadetalle    = "";  
        $filadetalle2   = "";
        $filadetalle3   = "";
        $filadetalle4   = "";
        $filadetalle5   = "";
        $filadetalle6   = "";
        $filadetalle7   = "";
        $arrAtendido    = array();
        $arrSolicitado  = array();
        $arrAtendido2   = array();
        $arrSolicitado2 = array(); 
        $dataexcel      = array();
        $tipOt          = $this->input->get_post('codperiodo');     
        $codproyecto    = $this->input->get_post('codproyecto');  
        $codestado      = $this->input->get_post('codestado');  
        $tiproducto     = $this->input->get_post('tiproducto');  
        $fInicio        = $this->input->get_post('fecha_ini');
        $fFin           = $this->input->get_post('fecha_fin'); 
        $monedadoc      = $this->input->get_post('moneda'); 
        $tipo           = $this->input->get_post('tipo');        
        if($monedadoc=="")   $monedadoc = "S";
        if($tipOt=="")       $tipOt     = 18;
        if($codestado=="")   $codestado = 'T';
        if($fInicio=="")     $fInicio   = date("01/01/Y",time());
        if($fFin=="")        $fFin      = date("d/m/Y",time());       
        $cadenaot    = "";
        $registros   = "";
        $fila        = "";
        /*Son todas las familias de productos que no se considerarán en el reporte de control de pesos*/
        $exclusiones = $this->config->item('exclusiones');
        $arr_export_detalle = array();
        $arr_export_alerta1 = array();
        $arr_export_alerta2 = array();
        $arr_export_alerta3= array();
        $arr_export_alerta4= array();
        $arr_export_alerta5= array();
        $cboProy     = form_dropdown('codproyecto',$this->proyecto_model->seleccionar('::Seleccione:::','000'),$codproyecto,"id='codproyecto' class='comboGrande'");
        $cboEstado   = form_dropdown('codestado',$this->estadoot_model->seleccionar('','00'),$codestado,"id='codestado' class='comboMedio'");  
        $periodoOt   = form_dropdown('codperiodo',$this->periodoot_model->seleccionar('',''),$tipOt,"id='codperiodo' class='comboMedio'");     
        $selmoneda   = form_dropdown('moneda',array(""=>"::Seleccione:::","S"=>"SOLES","D"=>"DOLARES"),$monedadoc," size='1' id='moneda' class='comboMedio' onchange=\"$('#frmBusqueda').attr('target','_self');$('#frmBusqueda').attr('action','');$('#tipoexport').val('');$('#numero').val('');\" ");               
        $cboTipoprod = form_dropdown('tiproducto',$this->ttorre_model->seleccionar("::Seleccione:::","000"),$tiproducto," size='1' id='tiproducto' class='comboMedio'");               
        $opcion      = $this->input->get_post('opcion');
        $this->form_validation->set_rules('codperiodo','Tipo de Ot','required');   
        $codot_user  = $this->session->userdata('codot');
        $ver_precios = ($codot_user!="0003739" && $codot_user!="0003722" && $codot_user!="0003723")?true:false;        
        $mail = true;
        if($this->form_validation->run() == TRUE || $mail){
            $filter            = new stdClass();
            $filter_not        = new stdClass();            
            $filter->fechaproi = $fInicio;
            $filter->fechaprof = $fFin;
            $filter_not->linea = $exclusiones;
            $rs2_b             = $this->ot_model->peso_solicitado($filter,$filter_not);  
            unset($filter->fechaproi);
            unset($filter->fechaprof);
            $filter->fechai    = $fInicio;
            $filter->fechaf    = $fFin;
            $filter_not->linea = $exclusiones;
            $rs2_a      = $this->ot_model->peso_atendido($filter,$filter_not);
             /*Pesos de ingenieria*/
            $nomenclatura = $this->listamat_model->listar_totales(new stdclass());
            /*Peso comercial*/
            $comercial    = $this->proyectp_model->listar_totales(new stdclass());
            /*Peso atendido*/
            if(count($rs2_a)>0){
                foreach($rs2_a as $indice => $value){
                    $codot        = $value->codot;
                    $p_atendido   = $value->p_atendido;
                    $p_solicitado = $value->p_solicitado;
                    if(!isset($arrSolicitado[$codot])) 
                        $arrSolicitado[$codot] = $p_solicitado;
                    else
                        $arrSolicitado[$codot] = $arrSolicitado[$codot] + $p_solicitado;
                    if(!isset($arrAtendido[$codot])){
                        $arrAtendido[$codot]   = $p_atendido;
                    }
                    else{
                        $arrAtendido[$codot]   = $arrAtendido[$codot] + $p_atendido;                
                    }
                }
            }
            /*Peso solicitado*/
            if(count($rs2_b)>0){
                foreach($rs2_b as $indice => $value){
                    $codot        = $value->codot;
                    $p_atendido   = $value->p_atendido;
                    $p_solicitado = $value->p_solicitado;
                    if(!isset($arrSolicitado[$codot]))
                        $arrSolicitado[$codot] = $p_solicitado;
                    else
                        $arrSolicitado[$codot] = $arrSolicitado[$codot] + $p_solicitado;
                    if(!isset($arrAtendido[$codot]))
                        $arrAtendido[$codot]   = $p_atendido;
                    else
                        $arrAtendido[$codot]   = $arrAtendido[$codot] + $p_atendido;
                }
            }
            /*Listado de OTs*/
            $filter = new stdClass();
            if($codproyecto!='000' && $codproyecto!='')  $filter->codproyecto = $codproyecto;
            if($tiproducto!='000' && $tiproducto!='')    $filter->ttorre      = $tiproducto;
            $filter->estado   = $codestado;
            $filter->tipoot   = $tipOt;
            $filter->fechaf   = $fFin;
            $filter->letra    = "";   
            $rs   = $this->ot_model->listarg($filter,array('ot.nroOt'=>'desc'));
            $i    = 1;
            $diff_p_estimado_p_teorico_cp = 0;
            $diff_p_galva_p_teorico_cp    = 0; 
            $p_tot_ppto       = 0;
            $p_tot_comercial  = 0;
            $p_tot_otecnica   = 0;
            $p_tot_solicitado = 0;
            $p_tot_atendido   = 0;
            $p_tot_negro      = 0;
            $p_tot_galva      = 0;
            $registros        = count($rs);
            /*Cabecera*/
            $filacabecera .= "<table border='1' style='width:100%;'>"; 
            $filacabecera .= "<tr style='background:#8AA8F3;'>";
            $filacabecera .= "<td style='width:8%;'><div>NRO OT</div></td>";
            $filacabecera .= "<td style='width:10%;'><div>NOMBRE</div></td>";
            $filacabecera .= "<td style='width:10%;'><div>PROYECTO</div></td>";    
            $filacabecera .= "<td style='width:8%;'><div>TIPO<BR>PRODUCTO</div></td>";   
            $filacabecera .= "<td style='width:8%;'><div>FECHA<br>INICIO</div></td>";
            $filacabecera .= "<td style='width:8%;'><div>FECHA<br>TERMINO</div></td>";
            $filacabecera .= "<td style='width:8%;'><div>W.REQUERIDO<BR>(KG)</div></td>";
            $filacabecera .= "<td style='width:8%;'><div>W.PPTO.<BR>(KG)</div></td>";
            //$filacabecera .= "<td style='width:7%;'><div>W.METRADO.<BR>(KG)</div></td>";
            $filacabecera .= "<td style='width:8%;'><div>W.O.TECNICA<BR>(KG)</div></td>";
            $filacabecera .= "<td style='width:8%;'><div>W.GALVANIZADO<BR>(KG)</div></td>";
            $filacabecera .= "<td style='width:8%;'><div>W.PRODUCCION<BR>(KG)</div></td>";
            $filacabecera .= "<td style='width:8%;'><div>W.ALMACEN<BR>(KG)</div></td>";
            $filacabecera .= "</tr>";
            foreach($rs as $indice => $value){
                $fila          = "";
                $datafila      = array();
                $numero        = trim($value->NroOt);
                $numeroorden   = str_replace("-","",$numero);
                $cliente       = $value->razcli;
                $proy          = $value->Proyecto;
                $site          = $value->DirOt;
                $f_apertura    = $value->fecha;
                $f_fin         = $value->FteOt;
                //$p_estimado  = $value->peso;
                $p_ppto        = 0;
                $p_comercial   = 0;
                $p_estimado_sp = $value->peso_sp;
                $p_fabricac_oc = $value->peso_fabricacion;
                $codot         = $value->CodOt;
                $p_teorico_cp  = $value->peso_teorico;
                //$p_teorico_sp  = $value->peso_teorico_sp;
                $p_otecnica    = 0;
                $estOt         = $value->EstOt;	
                $tipoTorre     = $value->Torre;	
                $p_atendido    = 0;
                $p_solicitado  = 0;     
                $p_negro       = 0;
                $p_galva       = $value->peso_galvanizado;
                $proyecto      = $this->proyecto_model->obtener($proy);
                $torre         = $this->ttorre_model->obtener($tipoTorre);
                $ttorre        = isset($torre->Des_Larga)?$torre->Des_Larga:'';
                foreach($arrAtendido as $indice=>$value){
                    if($indice==$codot){
                        $p_atendido = $value;
                        break;
                    }
                }
                foreach($arrSolicitado as $indice2=>$value2){
                    if($indice2==$codot){
                        $p_solicitado = $value2;
                        break;
                    }
                }  
                $color = "";
                switch($estOt){
                    case "P":
                        $color = "#ffffff";//En proceso
                        break;
                    case "C":
                        $color = "#ffffff";//Cerardo
                        break;
                    case "A":
                        $color = "#FF0000";//Anulado
                        break;
                    case "T":
                        $color = "#00FF00";//Terminado
                        break;
                    case "F":
                        $color = "#00FF00";//Fabricado
                        break;
                    default:
                        $color = "#ffffff";
                        break;
                }
                /*Peso galvanizado*/
                $galvanizado     = "";
                $arrnumero       = explode("-",trim($numero));
                $filter2         = new stdClass();
                $filter2_not     = new stdClass();
                $filter2_not->estado = "A";
                $filter2->codot  = $codot;
                $filter2->nroot  = $arrnumero[0]."-".(strlen($arrnumero[1])==5?substr($arrnumero[1],0,4)."-".substr($arrnumero[1],4,1):substr($arrnumero[1],0,4)); 
                $filter2->fechai = $fInicio;
                $filter2->fechaf = $fFin;                
                $constancias     = $this->constancia_model->listar_totales($filter2,$filter2_not);
                $p_negro         = isset($constancias->p_galv)?$constancias->p_galv:0;  
                /*Peso ingenieria*/
                foreach($nomenclatura as $val){
                    if(trim($val->numeroorden) == $numeroorden){
                        $p_otecnica = is_null($val->peso)?0:$val->peso;
                        break;
                    }
                }
                /*Peso presupuesto y comercial*/
                foreach($comercial as $val){
                    if(trim($val->numeroorden) == $numeroorden){
                        $p_ppto      = is_null($val->peso)?0:$val->peso;
                        $p_comercial = is_null($val->peso_metrado)?0:$val->peso_metrado;
                        break;
                    }
                }  
                /*Construyo la cdena de OTs*/
                if($p_atendido!=0 || $p_solicitado!=0 || $p_negro!=0)  $cadenaot .= $codot.","; 
                $fila .= "<tr bgcolor='".$color."' id='".$codot."'>";
                $fila .= "<td align='center' width='8%'><div>".$numero."</div></td>";
                $datafila[] = $numero;
                $fila .= "<td align='left' class='ajustar'>".$site."</td>";
                $datafila[] = utf8_encode($site);
                $fila .= "<td align='left' width='10%'>".$proyecto->Des_Larga."</td>";
                $datafila[] = utf8_encode($proyecto->Des_Larga);
                $fila .= "<td align='left' width='8%'><div>".$ttorre."</div></td>";
                $datafila[] = utf8_encode($ttorre); 
                $fila .= "<td align='center' width='8%'><div>".$f_apertura."</div></td>";
                $datafila[] = $f_apertura;
                $fila .= "<td align='center' width='8%'><div>".$f_fin."</div></td>";
                $datafila[] = $f_fin;
                $fila .= "<td align='right' width='8%'><a href='#' onclick='rpt_requis(this)'><div>".number_format($p_solicitado,2,",",".")."</div></a></td>";
                $datafila[] = $p_solicitado;
                $fila .= "<td align='right' width='8%'>".number_format($p_ppto,2,",","")."</div></td>";
                $datafila[] = $p_ppto;
//                $fila .= "<td align='right' width='7%'>".number_format($p_comercial,2,",","")."</div></td>";
//                $datafila[] = $p_comercial;                
                $fila .= "<td align='right' width='8%'><a href='#' onclick='rpt_nomenclatura(this)'><div>".number_format($p_otecnica,2,",",".")."</div></a></td>";                
                $datafila[] = $p_otecnica;
                $fila .= "<td align='right' width='8%'><div>".number_format($p_galva,2,",",".")."</div></td>";                 
                $datafila[] = $p_galva;  
                $fila .= "<td align='right' width='8%'><a href='#' onclick='rpt_galva(this)'><div>".number_format($p_negro,2,",",".")."</div></a></td>";                 
                $datafila[] = $p_negro;
                $fila .= "<td align='right' width='8%'><a href='#' onclick='rpt_materiales(this)'><div>".number_format($p_atendido,2,",",".")."</div></a></td>";
                $datafila[] = $p_atendido;
                $fila .= "</tr>";  
                $p_tot_ppto       = $p_tot_ppto + $p_ppto;
                $p_tot_comercial  = $p_tot_comercial + $p_comercial;
                $p_tot_otecnica   = $p_tot_otecnica + $p_otecnica;                
                $p_tot_solicitado = $p_tot_solicitado + $p_solicitado;
                $p_tot_atendido   = $p_tot_atendido + $p_atendido;
                $p_tot_negro      = $p_tot_negro + $p_negro; 
                $p_tot_galva      = $p_tot_galva + $p_galva;
                array_push($arr_export_detalle, $datafila);
                $filadetalle .= $fila;                
                $i++;    
                $dato = str_replace("<a href='#' onclick='rpt_materiales(this)'>","",str_replace("<a href='#' onclick='rpt_requis(this)'>","",str_replace("<a href='#' onclick='rpt_galva(this)'>","",str_replace("<a href='#' onclick='rpt_nomenclatura(this)'>","",$fila))));
                if($p_solicitado > 1.15*$p_otecnica && $p_otecnica >= 500){      
                                  $filadetalle2 .= $dato;/*Alerta 1 ::: Wreq > 1.15 Wo.tecnica*/
                                  array_push($arr_export_alerta1, $datafila);
                }
                if($p_ppto < 1.05*$p_otecnica  && $p_otecnica >= 500){     
                                 $filadetalle4 .= $dato;/*Alerta 2 ::: Wppto < 1.05*Wo.tecnica */
                                 array_push($arr_export_alerta2, $datafila);
               }                
                if($p_negro > 1.02*$p_otecnica && $p_otecnica >= 500) {    
                                  $filadetalle5 .= $dato;/*Alerta 3 ::: Wproduccion > 1.02*Wo.tecnica*/
                                  array_push($arr_export_alerta3, $datafila);
                }
                if($p_galva > 1.04*$p_negro && $p_otecnica >= 500){
                                $filadetalle6 .= $dato;/*Alerta 4 ::: Wgalv > 1.04*Wproduccion */
                                array_push($arr_export_alerta4, $datafila);
                }
                if($p_atendido > 1.05*$p_otecnica && $p_otecnica >= 500) {
                                $filadetalle7 .= $dato;/*Alerta 5 ::: Walmacen > 1.05*Wo.tecnica */
                                array_push($arr_export_alerta5, $datafila);
                }
            }  
            $filafooter = "</table>";
            $cadenaot   = substr($cadenaot,0,strlen($cadenaot)-1);
            $fila .= "<tr>";
            $fila .= "<td align='center' colspan='5'>&nbsp;</td>";
            $fila .= "<td align='right' width='9%'><a href='#' onclick='rpt_requis(this)'><div>".number_format($p_tot_solicitado,2,",",".")."</div></a></td>";            
            $fila .= "<td align='right' width='9%'>".number_format($p_tot_ppto,2,",","")."</div></td>";            
            //$fila .= "<td align='right' width='9%'>".number_format($p_tot_comercial,2,",","")."</div></td>";
            $fila .= "<td align='right' width='9%'>".number_format($p_tot_otecnica,2,",","")."</div></td>";
            $fila .= "<td align='right' width='9%'><a href='#' onclick='rpt_galva(this)'><div>".number_format($p_tot_galva,2,",",".")."</div></a></td>";
            $fila .= "<td align='right' width='9%'><a href='#' onclick='rpt_galva(this)'><div>".number_format($p_tot_negro,2,",",".")."</div></a></td>";            
            $fila .= "<td align='right' width='9%'><a href='#' onclick='rpt_materiales(this)'><div>".number_format($p_tot_atendido,2,",",".")."</div></a></td>";            
            $fila .= "</tr>";
            $var_export = array('rows' => $arr_export_detalle,"fInicio" => $fInicio, "fFin" => $fFin);
            $this->session->set_userdata('data_listar_control_pesos', $var_export);
            /* sesion para exportar a excel alertas*/
            $var_export1 = array('rows' => $arr_export_alerta1);
            $this->session->set_userdata('data_listar_control_pesos1', $var_export1);
            $var_export2 = array('rows' => $arr_export_alerta2);
            $this->session->set_userdata('data_listar_control_pesos2', $var_export2);
            $var_export3 = array('rows' => $arr_export_alerta3);
            $this->session->set_userdata('data_listar_control_pesos3', $var_export3);
            $var_export4 = array('rows' => $arr_export_alerta4);
            $this->session->set_userdata('data_listar_control_pesos4', $var_export4);
            $var_export5 = array('rows' => $arr_export_alerta5);
            $this->session->set_userdata('data_listar_control_pesos5', $var_export5);
            /* ----------------------------------------*/
        }
        if($filadetalle2=="")  $filadetalle2="<tr bgcolor='#fff'><td colspan='11' align='center'>:::NO EXISTEN REGISTROS:::</td></tr>";
        //if($filadetalle3=="")  $filadetalle3="<tr bgcolor='#fff'><td colspan='11' align='center'>:::NO EXISTEN REGISTROS:::</td></tr>";
        if($filadetalle4=="")  $filadetalle4="<tr bgcolor='#fff'><td colspan='11' align='center'>:::NO EXISTEN REGISTROS:::</td></tr>";
        if($filadetalle5=="")  $filadetalle5="<tr bgcolor='#fff'><td colspan='11' align='center'>:::NO EXISTEN REGISTROS:::</td></tr>";
        if($filadetalle6=="")  $filadetalle6="<tr bgcolor='#fff'><td colspan='11' align='center'>:::NO EXISTEN REGISTROS:::</td></tr>";
        if($filadetalle7=="")  $filadetalle7="<tr bgcolor='#fff'><td colspan='11' align='center'>:::NO EXISTEN REGISTROS:::</td></tr>";
        $mensaje = "";
        /*Mensaje*/
        $mensaje .= "<h3>O.T. a revisar</h3>";
        $mensaje .= "<p align='left'><font size=2>";
        $mensaje .= "1. Alerta Comercial / Ingeniería: 'Wreq > 1.15 Wo.tecnica' para las siguientes OT: (".count($arr_export_alerta1)." registros)";
        $mensaje .= "<div> <button onclick=".'"javascript:ExcelAlertasDetalle(1)"'." >Ver Excel</button></div>";
        $mensaje .= $filacabecera.$filadetalle2.$filafooter;
        $mensaje .= "</font></p> ";
//        $mensaje .= "<p align='left'><font size=2>";
//        $mensaje .= "2. Alerta Comercial: 'Wcomercial > 1.05*Wppto' para las siguientes OT: (NO APLICA)";
//        $mensaje .= $filacabecera.$filadetalle3.$filafooter;
//        $mensaje .= "</font></p> ";
        $mensaje .= "<p align='left'><font size=2>";
        $mensaje .= "2. Alerta Comercial / Ingenieria: 'Wppto < 1.05*Wo.tecnica' para las siguientes OT:(".count($arr_export_alerta2)." registros)";
        $mensaje .= "<div> <button onclick=".'"javascript:ExcelAlertasDetalle(2)"'." >Ver Excel</button></div>";
        $mensaje .= $filacabecera.$filadetalle4.$filafooter;
        $mensaje .= "</font></p> ";
        $mensaje .= "<p align='left'><font size=2>";
        $mensaje .= "3. Alerta Comercial / Producción: 'Wproduccion > 1.02*Wo.tecnica' para las siguientes OT:(".count($arr_export_alerta3)." registros)";
        $mensaje .= "<div> <button onclick=".'"javascript:ExcelAlertasDetalle(3)"'." >Ver Excel</button></div>";
        $mensaje .= $filacabecera.$filadetalle5.$filafooter;
        $mensaje .= "</font></p> ";
        $mensaje .= "<p align='left'><font size=2>";
        $mensaje .= "4. Alerta Comercial / Galvanizado: 'Wgalv > 1.04*Wproduccion' para las siguientes OT:(".count($arr_export_alerta4)." registros)";
        $mensaje .= "<div> <button onclick=".'"javascript:ExcelAlertasDetalle(4)"'." >Ver Excel</button></div>";
        $mensaje .= $filacabecera.$filadetalle6.$filafooter;
        $mensaje .= "</font></p> ";        
        $mensaje .= "<p align='left'><font size=2>";
        $mensaje .= "5. Alerta Comercial / Logística / Produccion: 'Walmacen > 1.05*Wo.tecnica' para las siguients OT:(".count($arr_export_alerta5)." registros)";
        $mensaje .= "<div> <button onclick=".'"javascript:ExcelAlertasDetalle(5)"'." >Ver Excel</button></div>";
        $mensaje .= $filacabecera.$filadetalle7.$filafooter;
        $mensaje .= "</font></p>"; 
        $data['fInicio']      = $fInicio;
        $data['fFin']         = $fFin;
        $data['cboTipoprod']  = $cboTipoprod;
        $data['cboProyecto']  = $cboProy;
        $data['cboEstado']    = $cboEstado;
        $data['opcion']       = $opcion;
        $data['fila']         = $filadetalle;
        $data['mensaje']      = $mensaje;
        $data['periodoOt']    = $periodoOt;
        $data['selmoneda']    = $selmoneda;
        $data['codperiodo']   = $tipOt;  
        $data['ver_precios']  = $ver_precios;
        $data['registros']    = $registros;
        $data['oculto']       = form_hidden(array('serie'=>'','numero'=>'','codot'=>'','tipo'=>'','tipoexport'=>'','cadenaot'=>$cadenaot,'exclusiones'=>'S'));  
        $this->load->view(ventas."ots_control_pesos",$data);
    }
    
    public function rpt_control_pesos_detalle($codot){ 
        $tipoot      = 14;
        $ot          = $this->ot_model->obtener($codot,$tipoot);
        $numeroOt    = $ot->NroOt;
        $direccionOt = $ot->DirOt;
        $tipOt       = $ot->TipOt;
        $rs_a   = $this->ot_model->peso_atendido_det($codot,$tipOt);
        $rs_b   = $this->ot_model->peso_solicitado_det($codot,$tipOt);  
        $fila   = "";
        $arrP_Peso       = array();
        $arrK_Solicitado = array();
        $arrK_Atendido   = array();
        foreach($rs_a as $indice => $value){
            $p_peso       = $value->p_peso;
            $codpro       = $value->codpro;
            $k_atendida   = $value->k_atendida;
            $k_solicitada = $value->k_solicitada;
            $p_descri     = $value->p_descri;
            $arrP_Peso[$codpro]       = $p_peso;
            $arrP_Descri[$codpro]     = $p_descri;
            if(!isset($arrK_Solicitado[$codpro])) $arrK_Solicitado[$codpro] = 0;
            if(!isset($arrK_Atendido[$codpro]))   $arrK_Atendido[$codpro]   = 0;
            $arrK_Solicitado[$codpro] = $arrK_Solicitado[$codpro] + $k_solicitada;
            $arrK_Atendido[$codpro]   = $arrK_Atendido[$codpro] + $k_atendida; 
        }
        foreach($rs_b as $indice => $value){
            $p_peso       = $value->p_peso;
            $codpro       = $value->codpro;
            $k_atendida   = $value->k_atendida;
            $k_solicitada = $value->k_solicitada;	
            $p_descri     = $value->p_descri;
            $arrP_Peso[$codpro]       = $p_peso;
            $arrP_Descri[$codpro]     = $p_descri;
            if(!isset($arrK_Solicitado[$codpro])) $arrK_Solicitado[$codpro] = 0;
            if(!isset($arrK_Atendido[$codpro]))   $arrK_Atendido[$codpro]   = 0;                
            $arrK_Solicitado[$codpro] = $arrK_Solicitado[$codpro] + $k_solicitada;
            $arrK_Atendido[$codpro]   = $arrK_Atendido[$codpro] + $k_atendida;
        }
        $nueva = array();
        $elarray = array();
        foreach($arrP_Descri as $ind1=>$val1){
            $nueva['codpro'] = $ind1;
            $nueva['peso']   = $arrP_Peso[$ind1];
            $nueva['descri'] = $arrP_Descri[$ind1];
            $nueva['k_solicitado'] = $arrK_Solicitado[$ind1];
            $nueva['k_atendido']   = $arrK_Atendido[$ind1];
            array_push($elarray,$nueva);
        }
        function cmp($a, $b)
        {
            return strcmp($a["descri"], $b["descri"]);
        }
        usort($elarray, "cmp");
        $ii=1;
        $p_solicitado_total_total = 0;
        $p_atendido_total_total   = 0;
        foreach($elarray as $indice=>$value){
            $codpro       = $value['codpro'];
            $descripcion  = $value['descri'];
            $p_peso       = $value['peso'];
            $k_solicitada = $value['k_solicitado'];
            $k_atendida   = $value['k_atendido'];
            $p_solicitado_total = $p_peso*$k_solicitada;
            $p_atendido_total   = $p_peso*$k_atendida;
            $fila .= "<tr>";
            $fila .= "<td>".$ii."</td>";
            $fila .= "<td>".$codpro."</td>";
            $fila .= "<td align='left'>".$descripcion."</td>";
            $fila .= "<td align='right'>".number_format($p_peso,2,",",".")."</td>";
            $fila .= "<td align='right'>".$k_solicitada."</td>";
            $fila .= "<td align='right'><a href='javascript:;' onclick='rpt_control_pesos_detalle2(\"".$codpro."\",\"".$codot."\");'>".$k_atendida."</a></td>";
            $fila .= "<td align='right'>".number_format($p_solicitado_total,2,",",".")."</td>";
            $fila .= "<td align='right'>".number_format($p_atendido_total,2,",",".")."</td>";
            $fila .= "</tr>";	
            $ii++;
            $p_solicitado_total_total = $p_solicitado_total_total + $p_solicitado_total;
            $p_atendido_total_total   = $p_atendido_total_total + $p_atendido_total;
        }
        $data['p_solicitado_total_total'] = $p_solicitado_total_total;
        $data['p_atendido_total_total']   = $p_atendido_total_total;
        $data['numeroOt']    = $numeroOt;
        $data['direccionOt'] = $direccionOt;
        $data['fila']        = $fila;
        $this->load->view(ventas."ots_control_pesos_detalle",$data);
    }
    
    public function rpt_control_pesos_detalle2($codpro,$codot){
        $tipoot = 14;
        $ots    = $this->ot_model->obtener($codot,$tipoot);
        $ot     = $ots->NroOt;
        $tipOt  = $ots->TipOt;        
        $rs     = $this->ot_model->peso_atendido_det2($codpro,$codot);
        $fila   = "";
        $p_atendido_total_total = 0;
        foreach($rs as $indice => $value){
            $peso        = $value->p_peso;
            $cantidad    = $value->k_atendida;
            $descripcion = $value->p_descri;
            $fecha       = $value->fecha;
            $serie       = $value->serie;
            $numero      = $value->numero;
            $fila  .= "<tr>";
            $fila  .= "<td>".$fecha."</td>";
            $fila  .= "<td align='center'>".$serie."</td>";
            $fila  .= "<td align='center'>".$numero."</td>";
            $fila  .= "<td  align='right'>".$peso."</td>";
            $fila  .= "<td  align='right'>".$cantidad."</td>";
            $fila  .= "<td  align='right'>".$cantidad*$peso."</td>";
            $fila  .= "<tr>";    
            $p_atendido_total_total = $p_atendido_total_total + $cantidad*$peso;
        }
        $data['ot']       = $ot;
        $data['producto'] = $descripcion;
        $data['codpro']   = $codpro;
        $data['fila']     = $fila;
        $data['p_atendido_total_total'] = $p_atendido_total_total;
        $this->load->view(ventas."ots_control_pesos_detalle2",$data);
    }   
    
    public function rpt_gestion_ot(){
        $codperiodo  = $this->input->get_post('codperiodo');
        $codcliente  = $this->input->get_post('codcliente');
        $codestado   = $this->input->get_post('codestado');
        $codproyecto = $this->input->get_post('codproyecto');
        $fInicio     = $this->input->get_post('fInicio');//A partir de aqui es valido.
        $fFin        = $this->input->get_post('fFin');
        $monedadoc   = $this->input->get_post('monedadoc');
        if($fInicio=="")      $fInicio    = "31/07/2011";
        if($fFin=="")         $fFin       = date("d/m/Y",time()); 
        if($codperiodo == "") $codperiodo = "18";
        if($monedadoc == "")  $monedadoc  = "S";
        $cboCliente  = form_dropdown('codcliente',$this->alumno_model->seleccionar2('','000000'),$codcliente,"id='codcliente' class='comboMedio'");
        $cboProy     = form_dropdown('codproyecto',$this->proyecto_model->seleccionar('','000'),$codproyecto,"id='codproyecto' class='comboMedio'");
        $cboEstado   = form_dropdown('codestado',$this->estadoot_model->seleccionar('','00'),$codestado,"id='codestado' class='comboMedio'");    
        $periodoOt   = form_dropdown('codperiodo',$this->periodoot_model->seleccionar('','00'),$codperiodo,"id='codperiodo' class='comboMedio'");   
        $oculto      = form_hidden(array('codot'=> '',"moneda"=>$monedadoc));
        $estado      = 0;
        $proyecto    = 0;
        $fila        = "";        
        if(TRUE){
            /*Se extrae las Materias primas por OT y se ingresan en un array*/
            $filter = new stdClass();
            $filter->tipoot   = $codperiodo;
            $filter->fechai   = $fInicio;
            $filter->fechaf   = $fFin;
            $filter->moneda   = $monedadoc;
            $filter->group_by = array("k.Codot");            
            $oMateriales      = costomateriales($filter);
            /*Se extraen las requisiciones de servicio y se ingresan en un array*/
            $filter    = new stdClass();
            $filternot = new stdClass();
            $filter->fechai = $fInicio;
            $filter->fechaf = $fFin;     
            $filter->moneda = $monedadoc;
            $filternot->codservicio = array('000000000010','000000000002','000000000074','000000000057','000000000001','000000000086','000000000084','000000000048','000000000049','000000000047','000000000046','000000000071');
            $oService = costoservicios($filter,$filternot);
            /*Se extraen las requisiciones de servicio de TRASNPORTE y se ingresan en un array(DBF)*/
            $filter    = new stdClass();
            $filternot = new stdClass();
            $filter->fechai = $fInicio;
            $filter->fechaf = $fFin;     
            $filter->moneda = $monedadoc;
            $filter->codservicio = array('000000000010','000000000002','000000000074','000000000057','000000000001','000000000086','000000000084','000000000048','000000000049','000000000047','000000000046','000000000071');
            $oTransport = costoservicios($filter,$filternot);               
            /*Matriz mano de obra*/
            $filter         = new stdClass();
            $filter->fechai = $fInicio;
            $filter->fechaf = $fFin;
            $filter->moneda = $monedadoc;  
            $filter->group_by = (substr($fFin,6,4)<= 2013)?array("c.nroot"):array('p.numeroorden');
            $oManoObra        = costomanoobra($filter,new stdClass()); 
            /*Matriz caja chica*/
            $filter           = new stdClass();
            $filter->fechai   = $fInicio;
            $filter->fechaf   = $fFin;
            $filter->moneda   = $monedadoc;  
            $filter->group_by = array("det.codot");
            $oCaja            = costocaja($filter,new stdClass());    
            /*Matriz de Tesoreria*/
            $filter = new stdClass();
            $filter_not = new stdClass();
            $filter->fechai   = $fInicio;
            $filter->fechaf   = $fFin;
            $filter->moneda   = $monedadoc;
            $filter->group_by = array("det.codot");
            $filter_not->codtipomov = array('03','19','02','08');
            $oTesoreria        = costotesoreria($filter,$filter_not); 
            /*Listado de OTs*/
            $filter = new stdClass();
            if($codproyecto!='000')    $filter->codproyecto = $codproyecto;
            //$filter->estado      = $codestado;
            $filter->tipoot      = $codperiodo;
            $filter->fechai      = $fInicio;
            $filter->fechaf      = $fFin;
            $filter2 = new stdClass();
            $filter2->Valor_3    = '02';
            $producto_old = $this->tipoproducto_old_model->listar($filter2);
            foreach($producto_old as $idice=>$value){
                $arrTipo[] = $value->cod_argumento;
            }
            $filter->tipo   = $arrTipo;
            $ots = $this->ot_model->listarg($filter,array('ot.nroOt'=>'desc')); 
            foreach($ots as $indice=>$value){
                $razcli         = $value->razcli;
                $site           = $value->DirOt;
                $numero         = $value->NroOt;
                $fIni           = $value->FinOt;
                $fFinal         = $value->FteOt;
                $moneda         = $value->EstOt;
                $codot          = $value->CodOt;
                $fecha          = $value->fecha;
                $fFabricacion   = $value->FfabOt;
                $peso           = $value->peso_teorico_sp;
                $peso_fab       = $value->peso;
                $idproyecto     = $value->Proyecto;
                $avance         = $value->avance;
                $tipoTorre      = $value->Torre;
                $ubigeo         = $value->UbiOt;
                $proyectos      = $this->proyecto_model->obtener($idproyecto);
                $nomproyecto    = $proyectos->Des_Larga;
                $torres         = $this->ttorre_model->obtener($tipoTorre);
                $descripcion    = $torres->Des_Larga;  
                $departamento   = $this->ubigeo_model->obtener_dpto($ubigeo);
                $provincia      = $this->ubigeo_model->obtener_prov($ubigeo);
                $distrito       = $this->ubigeo_model->obtener_dist($ubigeo);
                $departamento   = isset($departamento->nombre)?$departamento->nombre:"";
                $provincia      = isset($provincia->nombre)?$provincia->nombre:"";
                $distrito       = isset($distrito->nombre)?$distrito->nombre:"";
                $costos         = @$oMateriales[$codot]->costo + @$oService[$codot]->costo + @$oTransport[$codot]->costo + @$oManoObra[$codot]->costo + @$oTesoreria[$codot]->costo + @$oCaja[$codot]->costo;
                $fila.="<tr class='selectot' id='".$codot."'>";
                $fila.="<td align='center'>".$numero."</td>";
                $fila.="<td align='center'>".$fecha."</td>";
                $fila.="<td align='center'>Si</td>";
                $fila.="<td align='left'>".$nomproyecto."</td>";
                $fila.="<td align='left'>".$razcli."</td>";
                $fila.="<td align='left'>".$site."</td>";
    //            $fila.="<td align='left'>".$departamento."-".$provincia."-".$distrito."</td>";
    //            $fila.="<td align='left'></td>";
                $fila.="<td align='left'>".$descripcion."</td>";
                $fila.="<td align='right'>".number_format($peso_fab,2)."</td>";
    //            $fila.="<td align='center'>".$avance."</td>";
                $fila.="<td align='center'>".$fIni."</td>";
                $fila.="<td align='center'>".$fFinal."</td>";            
                $fila.="<td align='center'>".(trim($fFabricacion)=='01/01/1900'?'':trim($fFabricacion))."</td>";
                $fila.="<td>11/05/2012</td>";
                $fila.="<td align='right'>".number_format($costos,2)."</td>";  
                $fila.="</tr>";
            }            
        }
        $data['tipOt']   = $codperiodo;
        $data['fInicio'] = $fInicio;
        $data['fFin']    = $fFin;
        $data['fila']    = $fila;
        $data['cboProyecto'] = $cboProy;
        $data['cboEstado']   = $cboEstado;
        $data['cboCliente']  = $cboCliente;
        $data['periodoOt']   = $periodoOt;
        $data['oculto']      = $oculto;
        $this->load->view(ventas."ot_gestion",$data);
    }
    
    public function rpt_productos_ot(){
        $fecha_ini  = $this->input->get_post('fecha_ini');
        $fecha_fin  = $this->input->get_post('fecha_fin'); 
        $tipoexport = $this->input->get_post('tipoexport');
        $cod_torre  = $this->input->get_post('cod_torre');
        $codot      = $this->input->get_post('codot');
        $ot         = $this->input->get_post('ot');
        $familia    = $this->input->get_post('familia');
        $opcion     = $this->input->get_post('opcion');          
        $opcion     = 'C'; 
        $arr_export_detalle = array();
        $hora_actual = date("H:i:s",time()-3600);
        if($fecha_ini=="")    $fecha_ini    = date("01/m/Y",time());
        if($fecha_fin=="")    $fecha_fin    = date("d/m/Y",time());
        if($cod_torre=="")     $cod_torre     = "000";
        /**/
        $filter = new stdClass();
        $filter->fechai = $fecha_ini;
        $filter->fechaf = $fecha_fin;
        $filter->group_by = array("r.codot","r.GCODPRO");

        /*Productos*/
        $filter = new stdClass();
        $filter->estado    = 2;
        $filter->situacion = 2;
        $filter3 = new stdClass();
        $productos      = $this->curso_model->listar(new stdClass(),new stdClass(),array("P_descri"));
        $arrproducto2   = array("000000000000"=>"::: TODOS :::");
        foreach($productos as $indice => $value){
            $codpro = trim($value->codpro);
            $arrproducto[$codpro]  = $value;
            $arrproducto2[$codpro] = $value->codpro." - ".$value->despro;
        } 
        /* Familia */
        $familias       = $this->familia_model->listar(new stdclass());
        $arrfamilias2   = array("0000"=>"::: TODOS :::");
        foreach($familias as $indice => $value){
            $codfamilia = trim($value->cod_argumento);
            $arrfamilias2[$codfamilia] = $codfamilia." - ".$value->des_larga;
            $arrfamilias[$codfamilia] = $value->des_larga;
        } 
       
        /* tipo de torre */
        $filtert = new stdClass();
        $torres      = $this->ttorre_model->listar();
        $arrtorres2   = array("000"=>"::: TODOS :::");       
        foreach($torres as $indice => $value){
            $codtorre = trim($value->cod_argumento);
            $arrtorres2[$codtorre] = $codtorre." - ".$value->des_larga;
            $arrtorres[$codtorre] = $value->des_larga;
        } 
        
        
        /* crear select*/
        $filtrotorre     = form_dropdown("codtorre",$arrtorres2,$cod_torre,"id='cod_torre' class='comboMedio' onClick='limpiarText();' ");
        $filtrofamilia         = form_dropdown("codfam",$arrfamilias2,$familia,"id='familia' class='comboMedio' onClick='limpiarText();' ");
       
        /*requisiciones */
        $filterr=new stdClass();
        $filterr->group_by   =array('r.codot','p.p_codigo');
        $requisiciones  = $this->requis_model->listar_totales($filterr);
        
        /* Cargar Datos */
        $ot_pro= array();
        $fila      = "";
        $registros = 0;
        
        if($opcion=='C'){
            /* ingresos */
            $filter      = new stdClass();
            $filter_not  = new stdClass();
            $filter->fechai     = $fecha_ini;   
            $filter->fechaf     = $fecha_fin; 
            $filter->codot      =$codot; 
            
            $filter->group_by   =array('k.codot','codigo');
            $ingresos  = $this->ningreso_model->listar_ingresos($filter,$filter_not);
            echo "ingresos :: ".count($ingresos)."<br>";
                foreach ($ingresos as $key =>$val){
                    $ot_pro[trim("".$val->codot).trim("".$val->codigo)]       ="1";
                   // echo "*".trim($val->codot).trim($val->codigo)."<br>";
                    $ot_ing[trim($val->codot).trim($val->codigo)]       =array($val->cantidad,$val->soles,$val->dolares);
                }
            
            /* salidas */
            $filter1      = new stdClass();
            $filter_not1  = new stdClass();
            $filter1->fechai     = $fecha_ini;   
            $filter1->fechaf     = $fecha_fin; 
            $filter1->codot      =$codot; 
            $filter1->group_by   =array('k.codot','codigo');
           
            $salidas   = $this->nsalida_model->listar_salidas($filter1,$filter_not1);
             echo "salidas :: ".count($salidas)."<br>";
                foreach ($salidas as $key1 =>$val1){
                    $ot_pro[trim($val1->codot).trim($val1->codigo)]      ="3";
                  //  echo "*".trim($val1->codot).trim($val1->codigo)."<br>";
                    $ot_sal[trim($val1->codot).trim($val1->codigo)]      =array($val1->cantidad,$val1->soles,$val1->dolares);
                }
            
            krsort($ot_pro);    
            count($ot_pro);
            
            foreach ($ot_pro as $indice =>$value){
                $_codot= substr($indice,0,7);
                $cod_pro=substr($indice,7,strlen($indice));
                //  echo "OT ->". substr($indice,0,7);
                $rsot         = $this->ot_model->obtener(substr($indice,0,7));
                // $rsot         = $this->ot_model->obtener($value->codot);
             
                $nroot        =isset($rsot->NroOt)?$rsot->NroOt:'-';
                
                $torre='';
                $familia=substr($cod_pro,0,4);
                $tipotorre    =isset($rsot->NroOt)?$rsot->Torre:''; 
                if(trim($tipotorre)!='') { if(isset($arrtorres[$tipotorre])) $torre=$arrtorres[$tipotorre];}
                if(trim($familia)!='') { if(isset($arrfamilias[substr($cod_pro,0,4)])) $familia=$arrfamilias[substr($cod_pro,0,4)];}

                $despro  = isset($arrproducto[$cod_pro]->despro)?$arrproducto[$cod_pro]->despro:'No encontrado';
                /*calculo ingresos*/
                if(isset($ot_ing[$indice])){
                    $ingreso= $ot_ing[$indice][0];
                    $s_ingreso= $ot_ing[$indice][1];
                    $d_ingreso= $ot_ing[$indice][2];
                }else{
                    $ingreso= 0;
                    $s_ingreso= 0;
                    $d_ingreso= 0;
                }
                /*calculo salidas*/
                if(isset($ot_sal[$indice])){
                    $salida= $ot_sal[$indice][0];
                    $s_salida= $ot_sal[$indice][1];
                    $d_salida= $ot_sal[$indice][2];
                }else{
                    $salida= 0;
                    $s_salida= 0;
                    $d_salida= 0;
                }
                
                $saldo=$ingreso-$salida;
                $s_monto=$s_ingreso-$s_salida;
                $d_monto=$d_ingreso-$d_salida;

                $arr_data = array();
                $fila   .= "<tr>";
                      $fila   .= "<td align='center' style='width:1.7%;'><div>".$nroot."</div></td>";
                      $arr_data[] = $nroot;
                      $fila   .= "<td align='center' style='width:1.7%;'><div>".utf8_encode($torre)."</div></td>";
                      $arr_data[] = utf8_encode($torre);
                      $fila   .= "<td align='center' style='width:1.7%;'><div>".$cod_pro."</div></td>";
                      $arr_data[] = $cod_pro;
                      $fila   .= "<td align='center' style='width:1.7%;'><div>".utf8_encode($familia)." </div></td>";
                      $arr_data[] = utf8_encode($familia);
                      $fila   .= "<td align='center' style='width:1.7%;'><div>".utf8_encode($despro)."</div></td>";
                      $arr_data[] = utf8_encode($despro);
                      
                      $fila   .= "<td align='center' style='width:1.7%;'><div></div></td>";
                      
                      $fila   .= "<td align='center' style='width:1.7%;'><div> ".$ingreso."</div></td>";
                      $arr_data[] = $ingreso;
                      $fila   .= "<td align='center' style='width:1.7%;'><div> ".$salida."</div></td>";
                      $arr_data[] = $salida;
                      $fila   .= "<td align='center' style='width:1.7%;'><div> ".$saldo."</div></td>";
                      $arr_data[] = $saldo;
                      
                      $fila   .= "<td align='center' style='width:1.7%;'><div></div></td>";
                      
                     $fila   .= "<td align='center' style='width:1.7%;'><div> ".$s_ingreso."</div></td>";
                      $arr_data[] = $s_ingreso;
                      $fila   .= "<td align='center' style='width:1.7%;'><div> ".$s_salida."</div></td>";
                      $arr_data[] = $s_salida;
                      $fila   .= "<td align='center' style='width:1.7%;'><div> ".$s_monto."</div></td>";
                      $arr_data[] = $s_monto;



                $fila   .= "</tr>";
                $registros++;
                array_push($arr_export_detalle,$arr_data);
              
            }
           $var_export = array('rows' => $arr_export_detalle);
           $this->session->set_userdata('data_productos_x_ot', $var_export);
        }
       
        
        $data['fila'] = $fila;
        $data['filtrotorre']    =  $filtrotorre;
        $data['filtrofamilia']    =  $filtrofamilia;
        $data['tipoexport']    = $tipoexport;
        $data['codot']         = $codot;
        $data['ot']            = $ot;
        $data['fecha_ini']     = $fecha_ini;
        $data['fecha_fin']     = $fecha_fin;
        $data['cod_torre'] =    $codtorre;
        $data['familia'] =    $familia;
        $data['registros']     = $registros;
        $this->load->view(ventas."ots_productos_ot",$data);
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