<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once(APPPATH.'models/seguridad/permiso_model.php');
include_once(APPPATH.'models/seguridad/menu_model.php');
function get_menu($filter)
{
    $permisos = new Permiso_model();
    $menu = $permisos->listar($filter);
    $filamenu = "";
    if(count($menu)>0){
        foreach($menu as $indice=>$value){
            if($value->MENU_Codigo_Padre == 1){
                $filamenu.="<li>";
                $filamenu.= "<a href='#'>".$value->MENU_Descripcion."</a>";
                $filamenu.="<ul>";
                foreach($menu as $indice2=>$value2){
                    if($value2->MENU_Codigo_Padre == $value->MENU_Codigo){
                      $filamenu.="<li>";
                      $filamenu.="<a href='".($value2->MENU_Url!="#"?base_url().$value2->MENU_Url:"#")."'>".$value2->MENU_Descripcion."</a>";
                      $submenu = "";
                      foreach ($menu as $item3 => $value3){
                          if($value3->MENU_Codigo_Padre == $value2->MENU_Codigo){
                              $submenu.="<li><a href='".($value3->MENU_Url!="#"?base_url().$value3->MENU_Url:"#")."'>".$value3->MENU_Descripcion."</a></li>";
                          }
                      }
                      if($submenu!=""){
                          $filamenu.= "<ul>".$submenu."</ul>";
                      }
                      $filamenu.="</li>";
                    }
                }
                $filamenu.="</ul>";
                $filamenu.="</li>";
            }
        }
    }
    else{
        $permisos = new Menu_model();
        $filter   = new stdClass();
        $filter->codigo = 1;
        $menu     = $permisos->listar($filter);
        foreach($menu as $indice=>$value){
            $filamenu.="<li>";
            $filamenu.= "<a href='#'>".$value->MENU_Descripcion."</a>";
            $filamenu.="</li>";
        }
    }
    return $filamenu;
}

function get_header(){
    $filaheader  = "";
    $filaheader .= "<a href='#' id='logo'><img src='".img."logopuertosaber.jpg' /></a>";
    $filaheader .= "<h2>Administrador del sistema de cursos online<br>Puerto Saber S.A.C.<br>2016</h2>";
    $filaheader .= "<span><img src='".img."unknown.jpg' id='icono'><a href='#'>".$_SESSION["nomper"]."</a>&#x25BC;&nbsp;&nbsp;<a href='#' id='cerrar'>Salir</a></span>";
    return $filaheader;        
}
?>
