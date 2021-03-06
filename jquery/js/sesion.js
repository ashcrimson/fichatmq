function loadParametros() {
 var tiempo=0;
	// Aqui deberia ir la llamada Ajax que obtiene el JSON de medicos y se lo pasa a renderMedicos
    $.ajax({
    type: "POST",
    url: "Servicios/getParametros.php",
    dataType: "json",
    async:false,
    complete: function(data){
    var testData = JSON.parse(data.responseText);
    tiempo =testData[0].tiempo_sesion * 1000 * 60;
    }
});  
  return tiempo;
}
function Terminar_Turno(cod_u){
     $.ajax({
    type: "POST",
    url: "Servicios/setTerminarTurno.php?cod_u="+cod_u,
    dataType: "json",
    async:false,
    complete: function(data){
       alert('Turno Terminado');      	
       window.location='logout.php';
  }
});       
     
  
}
function Resetea_Sesion_r(){
     $.ajax({
    type: "POST",
    url: "Servicios/setReseteaSesionR.php",
    dataType: "json",
    async:false,
    complete: function(data){
       
  }
});       
     
  
}
function ver_terminar_turno(cod_u,options){

  options = options || {};
  $("#terminar_turno").remove();
  var tag = $("<div id='terminar_turno'></div>"); //This tag will the hold the dialog content.
  $.ajax({
    url: 'Vistas/Terminar_Turno.php?cod_u='+cod_u,
    type: 'GET',
    
    success: function(data, textStatus, jqXHR) {
      if(typeof data == "object" && data.html) { //response is assumed to be JSON
        tag.html(data.html).dialog({modal: options.modal, title: 'Terminar  Turno',width:'40%',resizable:false}).dialog('open');
      } else { //response is assumed to be HTML
        tag.html(data).dialog({modal: options.modal, title: 'Terminar  Turno',width:'40%',resizable:false}).dialog('open');
      }
      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
    }
  });
}
	var idleTime = 2000; // number of miliseconds until the user is considered idle
        idleTime=loadParametros(); 
	var initialSessionTimeoutMessage = 'Su sesion expirara en  <span id="sessionTimeoutCountdown"></span> segundos.<br />';
	var sessionTimeoutCountdownId = 'sessionTimeoutCountdown';
	var redirectAfter = 5; // number of seconds to wait before redirecting the user
	var redirectTo = 'logout.php'; // URL to relocate the user to once they have timed out
	var keepAliveURL = 'keepAlive.php'; // URL to call to keep the session alive
	var expiredMessage = 'Tu sesion ha expirado.  '; // message to show user when the countdown reaches 0
	var running = false; // var to check if the countdown is running
	var timer; // reference to the setInterval timer so it can be stopped

	$(document).ready(function() {
            
	    // create the warning window and set autoOpen to false
	    var sessionTimeoutWarningDialog = $("#sessionTimeoutWarning");
	    $(sessionTimeoutWarningDialog).html(initialSessionTimeoutMessage);
	    $(sessionTimeoutWarningDialog).dialog({
	        title: 'Advertencia de expiracion de sesion',
	        autoOpen: false,    // set this to false so we can manually open it
	        closeOnEscape: false,
	        draggable: false,
	        width: 460,
	        minHeight: 50,
	        modal: true,
	        beforeclose: function() { // bind to beforeclose so if the user clicks on the "X" or escape to close the dialog, it will work too
	            // stop the timer
	            clearInterval(timer);
	            clearInterval(timer_total);        
	            // stop countdown
	            running = false;
	 
	            // ajax call to keep the server-side session alive
	            $.ajax({
	              url: keepAliveURL,
	              async: false
	            });
	        },
	     
	        resizable: false,
	        open: function() {
	            // scrollbar fix for IE
	            $('body').css('overflow','hidden');
                    $(".ui-dialog-titlebar-close").hide();  
	        },
	        close: function() {
	            // reset overflow
	            $('body').css('overflow','auto');
	        }
	    }); // end of dialog
	 
	 //
/*                    var counter_total=0;
	            $('#sessionTimeoutTotal').html(0);
	            // create a timer that runs every second
	            timer_total = setInterval(function(){
	                counter_total++;
	                
	                    $('#sessionTimeoutTotal').html(counter_total);
	               
	            }, 1000);*/
         //
	    // start the idle timer
	    $.idleTimer(idleTime);
	 
	    // bind to idleTimer's idle.idleTimer event
	    $(document).bind("idle.idleTimer", function(){
	        // if the user is idle and a countdown isn't already running
	        if($.data(document,'idleTimer') === 'idle' && !running){
	            var counter = redirectAfter;
	            running = true;
	 
	            // intialisze timer
	            $('#'+sessionTimeoutCountdownId).html(redirectAfter);
	            // open dialog
	            $(sessionTimeoutWarningDialog).dialog('open');
	 
	            // create a timer that runs every second
	            timer = setInterval(function(){
	                counter -= 1;
	 
	                // if the counter is 0, redirect the user
	                if(counter === 0) {
	                    $(sessionTimeoutWarningDialog).html(expiredMessage);
	                    $(sessionTimeoutWarningDialog).dialog('disable');
	                    window.location = redirectTo;
	                } else {
	                    $('#'+sessionTimeoutCountdownId).html(counter);
	                };
	            }, 1000);
	        };
	    });
	 
	});
