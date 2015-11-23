var base_url  = "http://localhost/20denota/";
jQuery(document).ready(function(){
   $("#cerrar").click(function(){
       url = base_url+"index.php/inicio/salir";
       location.href = url;
   });   
    
    $("body").on("click","#logo",function(){
        url = base_url+"index.php/inicio/principal";
        location.href = url;
    });  
});

function numbersonly(myfield, e, dec){
    var key;
    var keychar;
    if (window.event)	
            key = window.event.keyCode;	
    else if (e)	
            key = e.which;
    else	
            return true;	
    keychar = String.fromCharCode(key);
    if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )	
            return true;
    // numbers  
    if (dec && (keychar == "." || keychar == ","))  
    { 
            var temp=""+myfield.value;	
            if(temp.indexOf(keychar) > -1) 
                    return false;  
    }  
    else if ((("0123456789").indexOf(keychar) > -1))  
            return true;
    // decimal point jump  
    else  
    return false;  
}
function ValidateEmail(obj,evento){
    email     = $(obj).val();
    if(email != ''){
        respuesta  = false;
        emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(email.match(emailRegEx)){
            respuesta = true;
        }
        else{
            alert('Debe introducir un coreo valido');
            $(obj).focus();
            respuesta = false;
        }
        return respuesta;
    }
}