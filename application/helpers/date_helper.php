<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//function date_add($givendate,$day=0,$mth=0,$yr=0)
//{
//    $cd = strtotime($givendate);
//    return date('Y-m-d', mktime(date('h',$cd), date('i',$cd), date('s',$cd), date('m',$cd)+$mth,  date('d',$cd)+$day, date('Y',$cd)+$yr));
//}
 
/* calcular la diferencia entre dos fechas */

 
//function date_diff($start_date,$end_date,$format = 'd')
//{
//    $start_date = strtotime($start_date);
//    $end_date = strtotime($end_date);
// 
//    switch ($format)
//    {
//       //seconds
//       case "s":
//           return floor(($end_date-$start_date));
//       //minutes
//       case "i":
//            return floor(($end_date-$start_date)/60);
//       //hours
//       case "h":
//            return floor(($end_date-$start_date)/3600);
//       //days
//       case "d":
//            return floor(($end_date-$start_date)/86400);
//       //months
//       case "m":
//            return floor(($end_date-$start_date)/2628000);
//       //years
//       case "y":
//            return floor(($end_date-$start_date)/31536000);
//       //days
//       default:
//            return floor(($end_date-$start_date)/86400);
//       }
//}
 
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
