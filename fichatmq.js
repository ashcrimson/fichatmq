$.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
 function isEmpty(value) {
  return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
}
function mostrar_embebido_referencia(id,tipo,us,run,dv_run){
  
 
  $("#vw_embebido_minsal").remove();
  var tag = $("<div id='vw_embebido_minsal'></div>"); //This tag will the hold the dialog content.
  $.ajax({
    url: 'Vistas/Embebido_Referencia.php?id_emb='+id+'&tipo_emb='+tipo+'&us_emb='+us+'&run_emb='+run+'&dv_run_emb='+dv_run,
    type: 'GET',
    async:false,
    success: function(data, textStatus, jqXHR) {
      if(typeof data == "object" && data.html) { //response is assumed to be JSON
        tag.html(data.html).dialog({modal: true,closeOnEscape: false, title: '',width:800,resizable:false,close: function(event, ui) {  $("#vw_embebido_minsal").remove(); }}).dialog('open');
      } else { //response is assumed to be HTML
        tag.html(data).dialog({modal: true,closeOnEscape: false, title: '',width:'100%',height:'600',resizable:false,close: function(event, ui) {  $("#vw_embebido_minsal").remove(); }}).dialog('open');
      }
    
      
     // $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
    }
  });
}
function mostrar_embebido_examrayos(id,tipo,us,run,dv_run){
  
 
  $("#vw_embebido_examrayos").remove();
  var tag = $("<div id='vw_embebido_examrayos'></div>"); //This tag will the hold the dialog content.
  $.ajax({
    url: 'Vistas/Embebido_ExamRayos.php?id_emb='+id+'&tipo_emb='+tipo+'&us_emb='+us+'&run_emb='+run+'&dv_run_emb='+dv_run,
    type: 'GET',
    async:false,
    success: function(data, textStatus, jqXHR) {
      if(typeof data == "object" && data.html) { //response is assumed to be JSON
        tag.html(data.html).dialog({modal: true,closeOnEscape: false, title: '',width:800,resizable:false,close: function(event, ui) {  $("#vw_embebido_examrayos").remove(); }}).dialog('open');
      } else { //response is assumed to be HTML
        tag.html(data).dialog({modal: true,closeOnEscape: false, title: '',width:'100%',height:'600',resizable:false,close: function(event, ui) {  $("#vw_embebido_examrayos").remove(); }}).dialog('open');
      }
    
      
     // $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
    }
  });
}
function mostrar_embebido(id,tipo,us,run,dv_run,imp_emb){
  
 
  $("#vw_embebido").remove();
  var tag = $("<div id='vw_embebido'></div>"); //This tag will the hold the dialog content.
  $.ajax({
    url: 'Vistas/Embebido.php?id_emb='+id+'&tipo_emb='+tipo+'&us_emb='+us+'&run_emb='+run+'&dv_run_emb='+dv_run+'&imp_emb='+imp_emb,
    type: 'GET',
    async:false,
    success: function(data, textStatus, jqXHR) {
      if(typeof data == "object" && data.html) { //response is assumed to be JSON
        tag.html(data.html).dialog({modal: true,closeOnEscape: false, title: '',width:800,resizable:false,close: function(event, ui) {  $("#vw_plantillas").remove(); }}).dialog('open');
      } else { //response is assumed to be HTML
        tag.html(data).dialog({modal: true,closeOnEscape: false, title: '',width:'100%',height:'600',resizable:false,close: function(event, ui) {  $("#vw_embebido").remove(); }}).dialog('open');
      }
    
      
     // $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
    }
  });
}
function toggletabenm(obj){
  var id=obj.id.substr(3);
  $( "#"+id ).toggle();
  if ($("#"+id).is(':visible')) {
    $("#"+obj.id).html('Ocultar Nueva Enmienda');
  }
  else{
	$("#"+obj.id).html('Mostrar Nueva Enmienda');
  }
  $("#"+obj.id).button({icons: {primary: "ui-icon-pencil"}});
}
function toggleingenm(obj){
  $( ".enmdatos" ).toggle();
  var id=obj.id;
  if ($(".enmdatos").is(':visible')) {
    $('#sn_enmienda').val('S');
    $( ".required" ).attr('required', true);
    $("#"+obj.id).html('Ocultar Nueva Enmienda Datos Ingreso');
  }
  else{
    $('#sn_enmienda').val('N');
    $( ".required" ).removeAttr('required');
    $("#"+obj.id).html('Mostrar Nueva Enmienda Datos Ingreso');
  }
  $("#"+obj.id).button({icons: {primary: "ui-icon-pencil"}});
}
function habilita_obs(cod){
  if ($('#'+cod+':checked').val()=='S') {
	$('#obs_'+cod).val('');
	$('#obs_'+cod).prop('disabled', false);
	
  }
  else{
	
	$('#obs_'+cod).val('');
	$('#obs_'+cod).prop('disabled', false);
  }
}
/*
function carga_slider() {
    $.getJSON("Servicios/getFichas.php?estado=D&tipo_ficha="+$('#tf').val(),
{
format: "json"
},
function(json) {
     
     if(json!= null){
	  var html="<ul>";
	   if (json.rows.length > 0)
     for(j=0;j< json.rows.length;j++){
	    if (json.rows[j].tipo_usuario ==1)
	    html=html+"<li><a href='#' onclick='ver_ficha(\""+json.rows[j].id_ficha+"\",\"\",\""+json.rows[j].tipo_ficha+"\",\"D\");$(\"#slider\").slideReveal(\"hide\");'>"+json.rows[j].nombre+" "+json.rows[j].apellido+"</a></li>";
		else if (json.rows[j].tipo_usuario ==2)
	    html=html+"<li><a href='#' onclick='ver_ficha(\""+json.rows[j].id_ficha+"\",\"\",\""+json.rows[j].tipo_ficha+"\",\"L\");$(\"#slider\").slideReveal(\"hide\");'>"+json.rows[j].nombre+" "+json.rows[j].apellido+"</a></li>";
		
     }
     html=html+"</ul>";
     $('#slider').html(html);
    
	 }
	 }
);
}*/
function onInit() {
  
  /*
  $(document).mousemove(function(event){
    
    if(event.pageX < 20){
       $('#slider').slideReveal("show");
    }

  });*/
  $("#firmardoc").button({icons: {primary: "ui-icon-pencil"}}); 
$("#firmardoc").click(function() {editNote('#list-fichas','C')});
$("#verdoc").button({icons: {primary: "ui-icon-print"}});
$("#verdoc").click(function() {editNote('#list-fichas','L')});
$("#printdoc").button({icons: {primary: "ui-icon-print"}}); 
$("#printdoc").click(function() {editNote('#list-fichas','E')});
$("#printhoja").button({icons: {primary: "ui-icon-print"}}); 
$("#printhoja").click(function() {editNote('#list-fichas','H')});
$("#btn-limpiar").button({icons: {primary: "ui-icon-trash"}});
$("#printrec").button({icons: {primary: "ui-icon-print"}}); 
$("#printrec").click(function() {editNote('#list-fichas','R')});


/*
$('#slider').slideReveal({

  push: false,
  overlay: true
});
*/
	if($('#conectado').attr("value") =="S"){
    
	  //carga_slider();
        
	         $("#list-fichas").jqGrid({
	    url:'Servicios/getFichas.php?serv='+$('#serv').val()+'&busq='+$('#busq').val(),
		height:400,
            width:1200,
	    datatype: 'json', loadonce: false,
	    colNames:['Run','','Nombres','Apellidos','Fecha Ingreso','Servicio Actual','Estado','','','','',''],
	    colModel :[
			 {name:'run', index:'run', width:30, align:'center',editable:false},	   
              {name:'id_ficha', index:'id_ficha', width:10, align:'center',editable:false,hidden:true}, 
	      {name:'nombre', index:'nombre', width:50, align:'center',editable:false},
              {name:'apellido', index:'apellido', width:50, align:'center',editable:false},
              {name:'fec_ing', index:'fec_ing', width:50, align:'center',editable:false},
              {name:'desc_serv', index:'desc_serv', width:150, align:'center',editable:true},
              {name:'estado', index:'estado', width:50, align:'center',editable:true},
              {name:'tipo_ficha', index:'tipo_ficha', width:10,hidden:true, align:'center',editable:false},
			  {name:'cod_estado', index:'tipo_ficha', width:10,hidden:true, align:'center',editable:false},
              {name:'tipo_usuario', index:'tipo_usuario', width:10,hidden:true, align:'center',editable:false},
              
              {name:'id_firma_doc', index:'tipo_ficha', width:10,hidden:true, align:'center',editable:false},
              {name:'sn_epi', index:'sn_epi', width:10,hidden:true, align:'center',editable:false}
              
	    ],jsonReader: { repeatitems : false, id: "1" }, 
	   rowNum:500, rowList:[100,200,300], sortname: 'fec_ing', viewrecords: true, sortorder: "desc", caption:"Fichas"
	  });
$("#verpro").button({icons: {primary: "ui-icon-pencil"}}); 
	
$("#ref-plantillas").button({icons: {primary: "ui-icon-pencil"}}); 
	$("#btnEditFicha").button({icons: {primary: "ui-icon-pencil"}});  
	$("#btnEditFicha").click(function() {editNote('#list-fichas','D')});
    $("#btnEditCierreFicha").button({icons: {primary: "ui-icon-pencil"}});
    $("#btnEditCierreFicha").click(function() {editNote('#list-fichas','RA')});
    
        $("#btnAddFicha").button({icons: {primary: "ui-icon-pencil"}});
        $("#btnAddFichaAbr").button({icons: {primary: "ui-icon-pencil"}});
        $("#btnCompletarIngreso").button({icons: {primary: "ui-icon-pencil"}});
	$("#btnAddFicha").click(function() {ver_ficha("","","N",'D',"","N")});
    $("#btnAddFichaAbr").click(function() {ver_ficha("","","N",'D',"","S")});
    
    $("#btnAddEvoEpi").button({icons: {primary: "ui-icon-pencil"}});  
	$("#btnAddEvoEpi").click(function() {editNote('#list-fichas','EV')});
    $("#btnCierreAdm").button({icons: {primary: "ui-icon-locked"}});  
	$("#btnCierreAdm").click(function() {editNote('#list-fichas','CA')});
    
          $("#btnRE").button({icons: {primary: "ui-icon-print"}});  
	$("#btnRE").click(function() {editNote('#list-fichas','RE')});
    $("#btnCompletarIngreso").click(function() {editNote('#list-fichas','CI')});
    
	}else{
          function showResponseLogin(responseText, statusText, xhr, $form)  { 
                resp = JSON.parse(responseText);
                if (resp.estado==1){
                  window.location="index.php";
                }  
                else{ 
                  alert(resp.mensaje);
                } 
            }  
	    var optionslogin = { 
                success:       showResponseLogin
            };   
                  
            $('#form_login').ajaxForm(optionslogin);
	    var loginDialog = $("#form_login");
	    $(loginDialog).dialog({
	        title: 'Iniciar Sesion',
	        autoOpen: true,    
                dialogbeforeclose: false,  
	        closeOnEscape: false,
	        draggable: false,
	        width: 300,
	        
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

	

        }
}
function VistaEsperar(texto) {

  $("#vw_esperar").remove();
  var tag = $("<div id='vw_esperar'></div>"); //This tag will the hold the dialog content.                                                                                         
  $.ajax({
    url: 'Vistas/Esperar.php?texto='+texto,
        type: 'GET',
        async:false,
        success: function(data, textStatus, jqXHR) {
        if(typeof data == "object" && data.html) { //response is assumed to be JSON                                                                                                
	  tag.html(data.html).dialog({modal: true, title: 'Esperando ',width:600,resizable:false,close: function(event, ui) {  $("#vw_esperar").remove(); }}).dialog('open');
        } else { //response is assumed to be HTML                                                                                                                                  
          tag.html(data).dialog({modal: true, title: 'Esperando ',width:600,resizable:false,close: function(event, ui) {  $("#vw_esperar").remove(); },open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); }}).dialog('open');
        }
        //,open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); }                                                                                                    
        //      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);                                                                                       
      }
    });
}
function chequea_hosp(id_ficha) {
  var resp;
		 VistaEsperar("Revisando Hospitalizacion. Por favor Espere");
        $.ajax({
            type: "POST",
            url: "Servicios/getSNHosp.php",
	  data: { id_ficha: id_ficha},
            dataType: "json",
            async: false,
            success: function(data, textStatus) {
			   
               resp=data.sn_hosp;
                $("#vw_esperar").dialog('close'); 
            }
        });
        return resp;
}
function reabre_ficha(id_ficha) {
   if (confirm('¿Está seguro que desea reabrir esta ficha?')) {
     $.ajax({
                                            url: 'Servicios/setFicha.php',
                                            type: 'POST',
                                            data: { id_ficha: id_ficha,trans:"reabre" },
                                            async: false,
                                            success: function (result) {


                                                data = JSON.parse(result);
                                                if (data.estado==6) {
                                                    alerta('Ficha Reabierta');
                                                     
      jQuery("#list-fichas").jqGrid('setGridParam',{datatype:'json'}).trigger('reloadGrid');
	 
                                                }
                                                else{
     alerta(data.error);
   
   }
                                            }
     });
   }  
}
function viewPdf(id) {
       window.open('http://172.25.16.18/DocumentSigner/DocumentManagerServlet?method=download&docId=' + id);
      
 } 
function editNote(listId,accion) {

	var selected = jQuery(listId).jqGrid('getGridParam','selrow');
	if (selected == null) alert('Debe seleccionar una fila.');
        if (selected != null){ 
        var id_ficha = jQuery(listId).jqGrid('getCell',selected,'id_ficha');
        var tipo_ficha = jQuery(listId).jqGrid('getCell',selected,'tipo_ficha');
        
        var cod_estado = jQuery(listId).jqGrid('getCell',selected,'cod_estado');
        var id_firma_doc=jQuery(listId).jqGrid('getCell',selected,'id_firma_doc');
        var tipo_usuario=jQuery(listId).jqGrid('getCell',selected,'tipo_usuario');
        
        var sn_epi=jQuery(listId).jqGrid('getCell',selected,'sn_epi');
                var sn_agregado='';

        if (cod_estado=="X") {
            sn_agregado='S';
        }
        else{
          sn_agregado='N';
        }
        
        if (((cod_estado=='C')||((cod_estado=='I')&&(tipo_usuario!="1")))&&(accion=='D')) {
            
            alert('Usted no puede editar esta ficha porque no se encuentra en edicion');
			return;
        }
	if (((cod_estado!='D')&&(cod_estado!='X'))&&(accion=='C')) {
            alert('Usted no puede cerrar esta ficha porque no se encuentra en edicion o en ingreso abreviado');
			return;
        }
        if ((sn_epi!="S")&&(accion=='E')) {
            alert('Este tipo de ficha no posee epicrisis');
			return;
        }
		if ((cod_estado!='C')&&(accion=='E')) {
            alert('Usted no puede ver la epicrisis de esta ficha porque no se encuentra cerrada');
			return;
        }
        if ((cod_estado!='C')&&(accion=='EV')) {
            alert('Usted no puede agregar la evolucion epidemiologica de esta ficha porque no se encuentra cerrada');
			return;
        }
        if ((cod_estado!='C')&&(accion=='RA')) {
            alert('Usted no puede realizar la reapertura de esta ficha porque no se encuentra cerrada');
			return;
        }
        if ((cod_estado!='X')&&(accion=='CI')) {
            alert('Usted no puede completar el Ingreso de esta ficha porque no se encuentra en modo abreviado');
			return;
        }
        
        if ((cod_estado=='C')&&(accion=='CA')) {
            alert('Usted no puede realizar el cierre administrativo de esta ficha porque se encuentra cerrada');
			return;
        }
        if ((sn_epi=="S")&&(accion=='H')) {
            alert('Este tipo de ficha no posee Hoja de Traslado');
			return;
        }
		if ((cod_estado!='C')&&(accion=='H')) {
            alert('Usted no puede ver la Hoja de Traslado de esta ficha porque no se encuentra cerrada');
			return;
        }
        if ((tipo_ficha !="N")&&(accion=='R')) {
            alert('Este tipo de ficha no posee receta');
			return;
        }
        if ((cod_estado!='C')&&(accion=='R')) {
            alert('Usted no puede ver la receta si esta ficha porque no se encuentra cerrada');
			return;
        }
        if ((cod_estado!='C')&&(accion=='RE')) {
            alert('Usted no puede ver la receta electronica  de esta ficha porque no se encuentra cerrada');
			return;
        }
        if (accion=='RA') {
            var resphosp=chequea_hosp(id_ficha);
            if(resphosp =="S"){
              reabre_ficha(id_ficha);
            }
            else{
              alert('No puede realizar la reapertura de esta ficha porque el paciente fue egresado del Hospital');
			return;
            }
        }
        if (accion=='RE') {
            mostrar_embebido(id_ficha,'Q',$('#us_aux').val(),$('#run').html(),$('#dv_run').html(),'S');
        }
		if (accion=='E') {
           /*
           document.verhoja.id_ficha.value=id_ficha;
		   document.verhoja.submit();
           */
           viewPdf(id_firma_doc);
        }
        else if (accion=='H') {
           
           document.verhoja.id_ficha.value=id_ficha;
		   document.verhoja.submit();
           
        
        }
        else if(accion=='R') {
           document.verreceta.id_ficha.value=id_ficha;
		   document.verreceta.submit();
        }
		else{
          if((accion=='C')&&(sn_epi =="")){
     
     $("#dialog-confirm").dialog({
    resizable: false,
    height: "auto",
    width: 400,
    modal: true,
    buttons: {
      "Con Epicrisis": function() {
         $(this).dialog("close");
        ver_ficha(id_ficha,"",tipo_ficha,accion,"S",sn_agregado);
      },
      "Sin Epicrisis": function() {
         $(this).dialog("close");
        ver_ficha(id_ficha,"",tipo_ficha,accion,"N",sn_agregado);
      }
    }
  });
  }
  else{
          ver_ficha(id_ficha,"",tipo_ficha,accion,sn_epi,sn_agregado);
  }
		}
        }        
}

function mostrar_plantillas(options){
  
  options = options || {};
  $("#vw_plantillas").remove();
  var tag = $("<div id='vw_plantillas'></div>"); //This tag will the hold the dialog content.
  $.ajax({
    url: 'Vistas/Plantillas.php',
    type: 'GET',
    async:false,
    success: function(data, textStatus, jqXHR) {
      if(typeof data == "object" && data.html) { //response is assumed to be JSON
        tag.html(data.html).dialog({modal: options.modal,closeOnEscape: false, title: 'Mantencion de Plantillas ',width:800,resizable:false,close: function(event, ui) {  $("#vw_plantillas").remove(); }}).dialog('open');
      } else { //response is assumed to be HTML
        tag.html(data).dialog({modal: options.modal,closeOnEscape: false, title: ' Mantencion de Plantillas',width:800,resizable:false,close: function(event, ui) {  $("#vw_plantillas").remove(); }}).dialog('open');
      }
    
      
      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
    }
  });
}
function mostrar_protocolos(options){
  
  options = options || {};
  $("#vw_protocolos").remove();
  var tag = $("<div id='vw_protocolos'></div>"); //This tag will the hold the dialog content.
  $.ajax({
    url: 'Vistas/Protocolos.php',
    type: 'GET',
    async:false,
    success: function(data, textStatus, jqXHR) {
      if(typeof data == "object" && data.html) { //response is assumed to be JSON
        tag.html(data.html).dialog({modal: options.modal,closeOnEscape: false, title: 'Protocolos ',width:800,resizable:false,close: function(event, ui) {  $("#vw_protocolos").remove(); }}).dialog('open');
      } else { //response is assumed to be HTML
        tag.html(data).dialog({modal: options.modal,closeOnEscape: false, title: ' Protocolos',width:800,resizable:false,close: function(event, ui) {  $("#vw_protocolos").remove(); }}).dialog('open');
      }
    
      
      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
    }
  });
}
function ver_ficha(id_ficha,options,tipo_ficha,accion,sn_epi,sn_abr){
  if(id_ficha=="")
   titulo="Creacion de Ficha";
  else if(accion=='L')	
   titulo="Lectura de Ficha";
  else if(accion=='CI')	
   titulo="Completar Ingreso de Ficha";
  else if(accion=='C')	
   titulo="Cierre de Ficha";
  else if(accion=='D')	
   titulo="Edicion de Ficha";
  else if(accion=='EV')	
   titulo="Agregar Evolucion Epidemiologica";
  else if(accion=='CA')	
   titulo="Cierre Administrativo";
   
  
  options = options || {};
  $("#vwficha").remove();
  var url="";
  if (accion == "D") {
    if (tipo_ficha =="N") {
     url='Vistas/Ficha.php?id_ficha='+id_ficha+'&sn_abr='+sn_abr;
        
    }
   
    else{
     url='Vistas/FichaGeriatria.php?id_ficha='+id_ficha+'&sn_abr='+sn_abr;
    }
  }
  else if (accion == "CI") {
      url='Vistas/Ficha.php?id_ficha='+id_ficha+'&sn_abr='+sn_abr+'&sn_ci=S';
   
  }
  else if (accion =="EV") {
     url='Vistas/EvoEpi.php?id_ficha='+id_ficha+'&tipo_ficha='+tipo_ficha;
        
  }
  else if (accion =="CA") {
     url='Vistas/CierreAdm.php?id_ficha='+id_ficha+'&tipo_ficha='+tipo_ficha;
        
  }
  else if (accion == "L") {
    url='Vistas/FichaLectura.php?id_ficha='+id_ficha+'&tipo_ficha='+tipo_ficha;
  }
  else if (accion == "C") {
    url='Vistas/FichaLectura.php?id_ficha='+id_ficha+'&tipo_ficha='+tipo_ficha+'&accion='+accion+'&sn_epi='+sn_epi;
  }
  
  var tag = $("<div id='vwficha'></div>"); //This tag will the hold the dialog content.
  $.ajax({
    url: url,
    type: 'GET',
    async:false,
    success: function(data, textStatus, jqXHR) {
      if(typeof data == "object" && data.html) { //response is assumed to be JSON
        tag.html(data.html).dialog({modal: options.modal,closeOnEscape: false,position:[300,100], title: titulo,width:'100%',height:'600',resizable:false,close: function(event, ui) {  $("#vwficha").remove(); }}).dialog('open');
      } else { //response is assumed to be HTML
        tag.html(data).dialog({modal: options.modal,closeOnEscape: false,position:[300,100], title: titulo,width:'100%',height:'600',resizable:false,close: function(event, ui) {  $("#vwficha").remove(); }}).dialog('open');
      }
      $.isFunction(options.success) && (options.success)(data, textStatus, jqXHR);
    }
  });
}

function inhiberadio(o){
 /* if(o.readOnly){
    
    return false;
  }
  else
    return true;*/
   return true;
}
function getRutDv(T){var M=0,S=1;for(;T;T=Math.floor(T/10))
	S=(S+T%10*(9-M++%6))%11;return S?S-1:'K';}
function isInteger (n) {
	//return n===+n && n===(n|0);
	
	var er = /^[0-9]+$/;
	return ( er.test(n) ) ? true : false;
}
function valida_buscar(f){
   if(f.run.value ==""){
    alert('El rut a buscar no puede ser nulo'); 
    return false;
   }
   if(!isInteger(f.run.value)){
    alert('El rut a buscar debe ser un numero'); 
    return false;
   }

   if(f.dv_run.value ==""){
    alert('El digito verificador del run a buscar no puede ser nulo'); 
    return false;
   } 
   if ( getRutDv(f.run.value) != f.dv_run.value.toUpperCase()){
      alert('El run es incorrecto'); 
      return false;
   }
   return true;
}



$(document).ready(onInit);
