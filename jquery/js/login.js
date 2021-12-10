	$(document).ready(function() {
            var optionslogin = { 
                success:       showResponseLogin
            };   
            function showResponseLogin(responseText, statusText, xhr, $form)  { 
                resp = JSON.parse(responseText);
                if (resp.estado==1){
                  window.location="index.php";
                }  
                else{ 
                  alert("Usuario y/o Password Invalida o Usuario Inhabilitado. Contactese con su administrador");
                } 
            }         
            $('#form_login').ajaxForm(optionslogin);
	    var loginDialog = $("#form_login");
	    $(loginDialog).dialog({
	        title: 'Iniciar Sesion',
	        autoOpen: true,    
                dialogbeforeclose: false,  
	        closeOnEscape: false,
	        draggable: false,
	        width: 220,
	        
                minHeight: 50,
	        modal: true,
	        resizable: false,
	        open: function(event, ui) {
	            // scrollbar fix for IE
	            $('body').css('overflow','hidden');
                    $(".ui-dialog-titlebar-close").hide(); 
	        },
	        close: function() {
	            // reset overflow
	            $('body').css('overflow','auto');
	        }
	    }); // end of dialog
$( "#button-login" ).button({icons: {primary: "ui-icon-person"}});
	});

      
            
