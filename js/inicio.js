jQuery(document).ready(function(){
//    $('ul li:has(ul)').hover(function(e) {
//         $(this).find('ul').css({display: "block"});
//     },
//     function(e) {
//         $(this).find('ul').css({display: "none"});
//     });   
     
    $("#ingresar").click(function(){
        $("#frmInicio").submit();
    });
    
//    $("#cerrar").click(function(){
//        url = base_url+"index.php/inicio/index";
//        location.href = url;
//    });    
//    
//    $("#logo").click(function(){
//        url = base_url+"index.php/inicio/principal";
//        location.href = url;
//    }); 
//    
    $("#contrasena_mensaje").click(function(){
        dataString = "";
        url = base_url+"index.php/inicio/contrasena_mensaje";
        $.post(url,dataString,function(data){
            $('#basic-modal-content').modal({closeHTML: "<a href='#' title='Close' class='modal-close'>x</a>"});
            $('#mensaje').html(data);
        });  
    });        
});

function submitenter(myfield,e)
{
var keycode;
if (window.event) keycode = window.event.keyCode;
else if (e) keycode = e.which;
else return true;

if (keycode == 13)
   {
   myfield.form.submit();
   return false;
   }
else
   return true;
}

function capLock(e){
 kc = e.keyCode?e.keyCode:e.which;
 sk = e.shiftKey?e.shiftKey:((kc == 16)?true:false);
 if(((kc >= 65 && kc <= 90) && !sk)||((kc >= 97 && kc <= 122) && sk))
  document.getElementById('divMayus').style.visibility = 'hidden';
 else
  document.getElementById('divMayus').style.visibility = 'visible';
}