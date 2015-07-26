<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//function date_add($givendate,$day=0,$mth=0,$yr=0)
/* conocer la hora exacta de un determinado timezone */
function get_date($timezone = 'America/New_York', $full_date_time = false)
{
      date_default_timezone_set($timezone);
      $date = ($full_date_time) ? date('D,F j, Y, h:i:s A') : date('Y-m-d');
      date_default_timezone_set('UTC');
      return $date;
}

function date_sql($fecha){
    $array = explode("-",$fecha);
    return $array[2]."/".$array[1]."/".$array[0];
}

function date_sql_ret($fecha){
    $array = explode("/",$fecha);
    return $array[2]."-".$array[1]."-".$array[0];
}
?>
