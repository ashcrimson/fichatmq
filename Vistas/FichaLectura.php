<?php
  require_once('../libs/nusoap/lib/nusoap.php');
  include("../funciones.global.inc.php");
  include("../funciones.inc.php");
  $db=genera_adodb();
  verifica_sesion(false);

?>
<script src="jquery/js/jquery.form.js"></script>
<script src="tinymce/js/tinymce/tinymce.min.js"></script>

 <style>
.ui-autocomplete-loading {
background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat;

}
.txt{
  width:200px;
    font-family: Arial;
   white-space: -moz-pre-wrap; /* Mozilla, supported since 1999 */
    white-space: -pre-wrap; /* Opera */
    white-space: -o-pre-wrap; /* Opera */
    white-space: pre-wrap; /* CSS3 - Text module (Candidate Recommendation) http://www.w3.org/TR/css3-text/#white-space */
    word-wrap: break-word;
}
pre {
   //display: inline-block;
   width:800px;
    font-family: Arial;
   white-space: -moz-pre-wrap; /* Mozilla, supported since 1999 */
    white-space: -pre-wrap; /* Opera */
    white-space: -o-pre-wrap; /* Opera */
    white-space: pre-wrap; /* CSS3 - Text module (Candidate Recommendation) http://www.w3.org/TR/css3-text/#white-space */
    word-wrap: break-word;
}
del{
  color:           hsl(180, 19%, 85%);
font-size:       15px;
text-decoration: line-through;
/*noinspection CssOverwrittenProperties*/
text-decoration: hsl(180, 19%, 85%)  line-through;
  
}
</style>
<script>
  function chequea_ges(id_ficha) {
		//  return;
        $.ajax({
            type: "POST",
            url: "Servicios/getCheckDiagGes.php",
	  data: { id_ficha: id_ficha},
            dataType: "json",
            async: false,
            success: function(data, textStatus) {
			  
                if (data.length > 0){
                   alert('Al menos uno de los diagnosticos ingresados debe ser notificado como GES');
                   for(j=0;j< data.length;j++){
                     
                       document.pdfges.pdf.value=data[j].pdf;
                       document.pdfges.target=data[j].coddiag;
                       document.pdfges.submit();
                   }
                   }
            }
        });
    }
  $(document).ready(function()
{
        var i = 0;
        $('#fichalectura').find('fieldset').each(function()
        {
            i++;
			if(this.id!="fd_datos_cierre"){
            $(this).replaceWith('<div id="convertedfieldset'+i+'">'+$(this).html()+'</div>');
            $('div#convertedfieldset'+i).css('display','inline').css('text-align','left');
			}
        });
});


$("#printficha").button({icons: {primary: "ui-icon-print"}});
$("#printalta").button({icons: {primary: "ui-icon-print"}});
function cambia_pin() {
    $("#sn_epi").val($("#tipo_cierre").val());
	$("#spin").html("");
	
    if($("#tipo_cierre").val() =="S"){
	$("#spin").html('PIN : <input type="password" name="pin" size="4" maxlength="4"> ');
	  
	}
}
function imprime_ficha(tipo_imp,tipo_ficha) {
    var content="";
	var css="";
    var pie=$("#fichapie").html();;
	
    if (tipo_imp=="F") {
        content=$("#fichalectura").html();
    }
	else{
	  content=$("#fichaalta").html();
	}
	if (tipo_ficha=="3") {
	  css="estiloshojainter.css";
	}
	else{
	  css="estiloshoja.css";
	  
	}
    var mywindow = window.open('', 'Hospital Naval Almirante Nef', 'fullscreen=yes');

    mywindow.document.write('<html><head><title>Hospital Naval Almirante Nef</title>');
	mywindow.document.write('<link rel="stylesheet" href="'+css+'" />');
    mywindow.document.write('</head><body ><div>');
    mywindow.document.write(content);
	if (tipo_imp=="F") {
    mywindow.document.write(pie);
	
	}
	mywindow.document.write('</div></body></html>');

    mywindow.document.close();
    mywindow.focus()
    mywindow.print();
    mywindow.close();
    return true;
}
  /*if(document.myForm_admu.tipo_ficha.value ==2){
    $('#d_fundamentos').hide();
    $('#d_sofa').hide();
    $('#d_motivo').hide();
    $('#d_procedencia').hide();
    
  }
*/
tinymce.init({
  selector: '.editor,.rtf',
  height: 300,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ',
 
});


function muestra_barmen(run,orden) {
     $("#vw_lab").remove();
  var tag = $("<div id='vw_lab'></div>"); //This tag will the hold the dialog content.
  $.ajax({
    url: 'Vistas/Resultados_Examenes.php?run='+run+'&nro_orden='+orden,
    type: 'GET',
    async:false,
    success: function(data, textStatus, jqXHR) {
      if(typeof data == "object" && data.html) { //response is assumed to be JSON
        tag.html(data.html).dialog({modal: true, title: 'Resultados Examen',height:500,width:1000,resizable:false,close: function(event, ui) {  $("#vw_lab").remove(); }}).dialog('open');
      } else { //response is assumed to be HTML
        tag.html(data).dialog({modal: true, title: 'Resultados Examen',height:500,width:1000,resizable:false,close: function(event, ui) {  $("#vw_lab").remove(); }}).dialog('open');
      }
     
    }
  });
}
function muestra_tendencia(run,codigo,p_id) {
     $("#vw_gralab").remove();
  var tag = $("<div id='vw_gralab'></div>"); //This tag will the hold the dialog content.
  $.ajax({
    url: 'Vistas/Grafico_Examenes.php?run='+run+'&codigo='+codigo+'&p_id='+p_id,
    type: 'GET',
    async:false,
    success: function(data, textStatus, jqXHR) {
      if(typeof data == "object" && data.html) { //response is assumed to be JSON
        tag.html(data.html).dialog({modal: true, title: 'Tendencia Examen',height:500,width:'100%',resizable:false,close: function(event, ui) {  $("#vw_gralab").remove(); }}).dialog('open');
      } else { //response is assumed to be HTML
        tag.html(data).dialog({modal: true, title: 'Tendencia Examen',height:500,width:'100%',resizable:false,close: function(event, ui) {  $("#vw_gralab").remove(); }}).dialog('open');
      }
     Muestra_Grafico();
    }
  });
}
 $(function() {

jQuery("#list-diag_pos").jqGrid({
        datatype: 'clientSide',
        multiselect: true,
        width:700,height:70,
        rownumbers: true, 
        colNames:['Codigo','Descripcion'],
        colModel :[ 
        {name:'cod',index:'cod', width:55}, 
        {name:'descr',index:'descr', width:300}],
        rowNum:10,
        viewrecords: true,
        caption: 'Diagn&oacute;sticos Al Alta'
   }); 
$("#btnDelDiagPos").button({icons: {primary: "ui-icon-del"}}); 
$("#btnDelDiagPos").click(function() {Eliminar('list-diag_pos')});

function Eliminar(id){ 
              var rowids = jQuery('#'+id).jqGrid('getGridParam', 'selarrrow');
              for (var i = rowids.length - 1; i >= 0; i--) {
                jQuery('#'+id).jqGrid('delRowData', rowids[i]);
              }
           }
function existe(id, cod ) {
var rowids = jQuery('#'+id).jqGrid('getRowData');
var encontrado =0;
              for (var i = 0; i < rowids.length; i++) {
                if(rowids[i].cod == cod)
                  encontrado =1;
              }
   return encontrado;
}

function log(id, message ) {
var data=message.split(" - ");
if (!existe(id,data[0]))
jQuery("#"+id).addRowData("1", {cod:data[0], descr:data[1]});
else
alert("El registro ya existe");
}
$( "#diag_pos_bus" ).autocomplete({
source: "Servicios/getDiagnosticos.php",
minLength: 3,
select: function( event, ui ) {
log("list-diag_pos", ui.item ?
 ui.item.value  :
"Nada seleccionado, valor buscado " + this.value );
$(this).val(''); return false;
}
});


});

        $( "#busaeu" ).button({icons: {primary: "ui-icon-search"}});
          $( "#guardaraeu" ).button({icons: {primary: "ui-icon-disk"}});
          $( "#cerraraeu" ).button({icons: {primary: "ui-icon-close"}});
          
</script>
<script type="text/javascript">
function recorre(id, fld ) {
var datos="";
var rowids = jQuery('#'+id).jqGrid('getRowData');
              for (var i = 0; i < rowids.length; i++) {
                if (i==0) 
                datos=datos + rowids[i].cod
                else 
                datos=datos + "," +rowids[i].cod
              }
   fld.value =datos;
}

function habilita_diag(ind,o,o_obs,id){

  

  if(ind == 1){
    o.disabled=false;
    o.value="";
    o_obs.disabled=true;
    o_obs.value="";
  }
  else{
    var cfac=$('#'+id).getGridParam('records');
    for (var i =1; i <=cfac; i++) {
     
     jQuery('#'+id).jqGrid('delRowData', 1);
    }
    o.disabled=true;
    o.value="";
    o_obs.disabled=false;
    o_obs.value="";
  }
   
}
function copia_diag(ind){
  if(ind.checked){
    document.myForm_admu.diag_pos_bus.readOnly=true;
    document.myForm_admu.obs_diag_pos.readOnly=true;
    document.myForm_admu.ind_diag_pos.disabled=true;
    document.myForm_admu.obs_diag_pos.value=document.myForm_admu.obs_diag_pre.value;
    document.myForm_admu.ind_diag_pos.value=document.myForm_admu.ind_diag_pre.value;
    jQuery('#btnDelDiagPos').button('disable');
    jQuery('#list-diag_pos').jqGrid('clearGridData');
    var RowList;
    RowList = $('#list-diag_pre').getRowData();
    var Row;
    for( Row in RowList )
      {
	$('#list-diag_pos').addRowData(Row,RowList[Row]);
      }
  }
  else{
    document.myForm_admu.ind_diag_pos.readOnly=false;
    jQuery('#list-diag_pos').jqGrid('clearGridData');
    document.myForm_admu.diag_pos_bus.readOnly=false;
    document.myForm_admu.obs_diag_pos.readOnly=false;
    document.myForm_admu.obs_diag_pos.value="";
    document.myForm_admu.ind_diag_pos.value=1;
    document.myForm_admu.ind_diag_pos.disabled=false;
    jQuery('#btnDelDiagPos').button('enable');
  }
   
}
function habilita_cuadro(ind,o){
  if(ind == 1){
    o.disabled=false;
    o.value="";
  }
  else{
    o.disabled=true;
    o.value="";
  }
   
}
function valida_cierre(f){
   if((f.estado.value=="C")){
     if ((f.pin != null)&&(f.pin.value=="") ){
        alert('Debe ingresar su pin de firma electronica para cerrar esta ficha'); 
        return ;
     }
    
   }
   
 if(f.servicio_egreso.value ==""){
     alert('El servicio de egreso no puede ser nulo'); 
      return ;
   }
   
    if(f.destino_egreso.value ==""){
     alert('El destino de egreso no puede ser nulo'); 
      return ;
   }
  recorre("list-diag_pos",f.diag_pos);
   if((f.ind_diag_pos.value==1)&&(f.diag_pos.value =="")){
    alert('Debe ingresar al menos un diagnostico  de egreso'); 
    return ;
   }
   if((f.ind_diag_pos.value==2)&&(f.obs_diag_pos.value =="")){
    alert('Debe ingresar las observaciones de diagnostico de egreso'); 
    return ;
   }
   
    //code
   
   var fec1=$('#fec_ing').html().substr(6, 4)+$('#fec_ing').html().substr(3, 2)+$('#fec_ing').html().substr(0, 2)+$('#hora_ini').html()+$('#minuto_ini').html();
   if(f.fec_egr.value ==""){
     alert('La fecha de Egreso  no puede ser nula'); 
      return ;
   }
   var fec2=f.fec_egr.value.substr(6, 4)+f.fec_egr.value.substr(3, 2)+f.fec_egr.value.substr(0, 2)+f.hora_ter.value+f.minuto_ter.value;
   if (fec2 < fec1) {
      alert('El Egreso  no puede ser menor al Ingreso  del Paciente'); 
      return ;
   }
  

   if(f.resumen_alta.value ==""){
     alert('El Resumen no puede ser nulo'); 
      return ;
   }
   if(f.indicaciones_alta.value ==""){
     alert('Las Indicaciones al Alta no pueden ser nulas'); 
      return ;
   }
	if(f.sn_covid.value ==""){
     alert('Debe Indicar si el paciente es COVID 19 o no'); 
      return false;
   }
/*   if(f.estado.value=="C"){
  
   
   if (confirma(f)) {
      
      return ;
   }
   
   }
   else{
    $( "#dummy" ).click();
    return ;
   }
   if ((f.evolucion != null)&&(f.evolucion.value.trim() =="")&&(f.adjunto != null)&&(f.adjunto.value.trim() !="")) {
      alert('No puede subir un adjunto a una evolucion sin haber registrado algo en dicha evolucion'); 
      return false;
   }
   
   
   }*/
   

    $( "#dummy" ).click();
    return ;
}
function mostrar_plantilla(id_plantilla,id){


  $("#"+id).val("");
  if(id_plantilla != ""){
    $.ajax({
            type: "GET",
            url: "Servicios/getPlantilla.php",
	  data: { id_plantilla: id_plantilla},
            dataType: "json",
            async: false,
            success: function(data, textStatus) {
                $("#"+id).val(data.texto);
            }    
        });
     
  }
}
function valida_ficha(f){
 
      if(f.run.value ==""){
    alert('El rut no puede ser nulo'); 
    return false;
   }
   if(!isInteger(f.run.value)){
    alert('El rut debe ser un numero'); 
    return false;
   }
   if(f.dv_run.value ==""){
    alert('El digito verificador del rut no puede ser nulo'); 
    return false;
   } 
   if ( getRutDv(f.run.value) != f.dv_run.value){
      alert('El rut es incorrecto'); 
      return false;
   }
   if(f.nombre.value ==""){
     alert('El nombre no puede ser nulo'); 
      return false;
   }
   if((!f.ind_sexo[0].checked)&&(!f.ind_sexo[1].checked)){
     alert('Debe seleccionar el sexo'); 
      return false;
   }

   if(f.fec_nac.value ==""){
     alert('La fecha de nacimiento no puede ser nula'); 
      return false;
   }
   if(f.fec_ing.value ==""){
     alert('La fecha de Hospitalizacion no puede ser nula'); 
      return false;
   }
/*   var fec1=f.fec_ing.value.substr(6, 4)+f.fec_ing.value.substr(3, 2)+f.fec_ing.value.substr(0, 2)+f.hora_ini.value+f.minuto_ini.value;
   if(f.fec_ing_uci.value ==""){
     alert('La fecha de Ingreso UCI no puede ser nula'); 
      return false;
   }
   var fec2=f.fec_ing_uci.value.substr(6, 4)+f.fec_ing_uci.value.substr(3, 2)+f.fec_ing_uci.value.substr(0, 2)+f.hora_ini_uci.value+f.minuto_ini_uci.value;
   if (fec2 < fec1) {
      alert('El Ingreso UCI no puede ser menor a la Hospitalizacion del Paciente'); 
      return false;
   }
   if(f.anamnesis.value ==""){
     alert('La anamnesis no puede ser nula'); 
      return false;
   }
   if(f.diag_pre.value ==""){
     alert('El Diagnostico presuntivo no puede ser nulo'); 
      return false;
   }
   if(f.plan.value ==""){
     alert('El Plan A Seguir no puede ser nulo'); 
      return false;
   }*/
  /* if ((f.evolucion != null)&&(f.evolucion.value.trim() =="")&&(f.adjunto != null)&&(f.adjunto.value.trim() !="")) {
      alert('No puede subir un adjunto a una evolucion sin haber registrado algo en dicha evolucion'); 
      return false;
   }
   */
   /*  
   recorre("list-diag_pre",f.diag_pre);
   recorre("list-diag_pos",f.diag_pos);
   if((f.ind_diag_pre.value==1)&&(f.diag_pre.value =="")){
    alert('Debe ingresar al menos un diagnostico presuntivo de ingreso'); 
    return false;
   }
   if((f.ind_diag_pre.value==2)&&(f.obs_diag_pre.value =="")){
    alert('Debe ingresar las observaciones de diagnostico ingreso'); 
    return false;
   } 
   */

   return true;
}

$.getJSON("Servicios/getFicha.php?id_ficha=<?php echo $_REQUEST['id_ficha']?>",
{
format: "json"
},
function(json) {
     
     $("#myForm_admu").reset(); 
     if(json[0]!= null){
     j=0;
      if (json[0].datos.length > 0)
     for(j=0;j< json[0].datos.length;j++){
        $("#datos_"+json[0].datos[j].cod).html("<pre>"+json[0].datos[j].valor+"</pre>");
        $("#obs_datos_"+json[0].datos[j].cod).html("<pre>"+json[0].datos[j].obs+"</pre>");
     }
     
      <?php
    
      if($_REQUEST["accion"]!="C"){
   
   ?>
        
     $('#fec_egr').html(json[0].fec_alta);
     $('#hora_ter').html(json[0].hora_alta);
     $('#minuto_ter').html(json[0].minuto_alta);
     $('#obs_diag_pos').html(json[0].obs_diag_pos);
      $('#sn_covid').html(((json[0].sn_covid == 'S') ? ' Si' : 'No'));
     $('#resumen_alta').html("<pre>"+(isEmpty(json[0].resumen_alta) ? '' : json[0].resumen_alta)+"</pre>");
     $('#indicaciones_alta').html("<pre>"+(isEmpty(json[0].indicaciones_alta) ? '' : json[0].indicaciones_alta)+"</pre>");
     $('#medicamentos_alta').html("<pre>"+(isEmpty(json[0].medicamentos_alta) ? '' : json[0].medicamentos_alta)+"</pre>");
     
       j=0;
      html="<ol>";
      
     if (json[0].diag_pos != null)
     for(j=0;j< json[0].diag_pos.length;j++){
        html=html+"<li>"+json[0].diag_pos[j].cod+" - "+json[0].diag_pos[j].descrip+"</li>";
     }
     html=html+"</ol>";
     $('#diag_pos').html(html);
    
    <?php
   }
   else{
    ?>
$('#sn_covid').val(json[0].sn_covid);
     $('#fec_egr').val(json[0].fec_alta);
     $('#hora_ter').val(json[0].hora_alta);
     $('#minuto_ter').val(json[0].minuto_alta);
     $('#obs_diag_pos').val(json[0].obs_diag_pos);
     $('#servicio_egreso').val(json[0].servicio_egreso);
     $('#destino_egreso').val(json[0].destino_egreso);
     $('#resumen_alta').val((isEmpty(json[0].resumen_alta) ? '' : json[0].resumen_alta));
     $('#indicaciones_alta').val((isEmpty(json[0].indicaciones_alta) ? '' : json[0].indicaciones_alta));
     $('#medicamentos_alta').val((isEmpty(json[0].medicamentos_alta) ? '' : json[0].medicamentos_alta));
     
       j=0;
      
     if (json[0].diag_pos != null)
     for(j=0;j< json[0].diag_pos.length;j++){
       
	    $('#list-diag_pos').addRowData(j,{cod:json[0].diag_pos[j].cod,descr:json[0].diag_pos[j].descrip});
      }
     
      
      
    <?php
   }
   


    ?>

     document.myForm_admu.id_ficha.value=json[0].id_ficha;
     $('#run').html(json[0].run);
     $('#dv_run').html(json[0].dv_run);
     $('#nombre').html(json[0].nombre);
     $('#apellido').html(json[0].apellido);
     $('#fec_nac').html(json[0].fec_nac);
     $('#edad').html(json[0].edad);
	 $('#edad_m').html(json[0].edad_m);
	 $('#edad_d').html(json[0].edad_d);
	 
     $('#ind_sexo').html(json[0].ind_sexo);
     $('#fec_ing').html(json[0].fec_ing_hosp);
     $('#hora_ini').html(json[0].hora_ini_hosp);
     $('#minuto_ini').html(json[0].minuto_ini_hosp);
    $('#desc_serv_ingreso').html(json[0].descserv);
    $('#desc_serv_actual').html(json[0].descservactual);
    
     document.myForm_admu.run.value=json[0].run;
     document.myForm_admu.dv_run.value=json[0].dv_run;
     document.myForm_admu.grado.value=json[0].grado;
     document.myForm_admu.sn_iden.value=json[0].sn_iden;
     $('#desc_servicio_egreso').html(json[0].desc_servicio_egreso);
     
     $('#desc_destino_egreso').html(json[0].desc_destino_egreso);
     
     
   
     document.myForm_admu.usuario.value=json[0].usuario;
       j=0;
      html="<ul>";
      
     if (json[0].lab != null)
     for(j=0;j< json[0].lab.length;j++){
     html=html+"<li><a href='#' onclick='muestra_barmen(\""+json[0].run+"-"+json[0].dv_run+"\",\""+json[0].lab[j].o_numero+"\")'>"+json[0].lab[j].o_numero+ " ('+json[0].lab[j].fecha_toma+')</a></li>";
     }
     html=html+"</ul>";
     $('#lab').html(html);
    
     
        
   
 //  if (document.myForm_admu.usuario.value !='<?php echo $_SESSION["fichatmq"]["usuario"]; ?>') {
    
   //}
   if(json[0].estado == 'F'){
     $('#guardaraeu').attr('disabled',true);
     document.myForm_admu.id_ficha.disabled=true;
     document.myForm_admu.nombre.disabled=true;
     document.myForm_admu.apellido.disabled=true;
     document.myForm_admu.fec_nac.disabled=true;
     document.myForm_admu.edad.disabled=true;
	 document.myForm_admu.edad_m.disabled=true;
	 document.myForm_admu.edad_d.disabled=true;
	 
     document.myForm_admu.run.disabled=true;
     document.myForm_admu.dv_run.disabled=true;
     document.myForm_admu.grado.disabled=true;
     document.myForm_admu.sn_iden.disabled=true;
     document.myForm_admu.ind_sexo.disabled=true;
     document.myForm_admu.hora_ini.disabled=true;
     document.myForm_admu.fec_op.disabled=true;
     document.myForm_admu.minuto_ini.disabled=true;
     document.myForm_admu.hora_ter.disabled=true;
     document.myForm_admu.minuto_ter.disabled=true;
     //document.myForm_admu.hora_ini_p.disabled=true;
     //document.myForm_admu.minuto_ini_p.disabled=true;
     //document.myForm_admu.hora_ter_p.disabled=true;
     //document.myForm_admu.minuto_ter_p.disabled=true;
     //document.myForm_admu.otros_prof.disabled=true;
     document.myForm_admu.nro_pabellon.disabled=true; 
     document.myForm_admu.ind_diag_pos.disabled=true;
     document.myForm_admu.cirujano.disabled=true;
     document.myForm_admu.anestesiologo.disabled=true;
     document.myForm_admu.ayudface_1.disabled=true;
     document.myForm_admu.ayudface_2.disabled=true;
     document.myForm_admu.enfermero_anest.disabled=true;
     document.myForm_admu.arsenalero.disabled=true;
     document.myForm_admu.pabellonero.disabled=true;
     document.myForm_admu.obs_diag_pos.disabled=true;
     document.myForm_admu.obs_oper.disabled=true;
     document.myForm_admu.recuento_1.disabled=true;
     document.myForm_admu.recuento_2.disabled=true;
     document.myForm_admu.recuento_3.disabled=true;
     document.myForm_admu.recuento_4.disabled=true;
     document.myForm_admu.recuento_ins.disabled=true;
     document.myForm_admu.anestesia_1.disabled=true;
     document.myForm_admu.anestesia_2.disabled=true;
     document.myForm_admu.biopsia.disabled=true;
     document.myForm_admu.classif_herida.disabled=true;
     document.myForm_admu.descrip_oper.disabled=true;
     document.myForm_admu.drenajes.disabled=true;
     document.myForm_admu.incidentes.disabled=true;
     document.myForm_admu.ind_drenajes.disabled=true;
     document.myForm_admu.ind_incidentes.disabled=true;
     document.myForm_admu.plantilla.disabled=true;
     document.myForm_admu.diag_pre_bus.disabled=true;
     document.myForm_admu.diag_pos_bus.disabled=true;
     document.myForm_admu.oper_bus.disabled=true;
     
     $("#btnDelDiagPre").attr('disabled',true);
     $("#btnDelDiagPos").attr('disabled',true);
     $("#btnDelOper").attr('disabled',true);  
   }
   }
    

});


var optionsbusu = { 
        
        success:       showResponseBusu
  };
  var optionsadmu = { 
        
        success:       showResponseAdmu
  };
  function showResponseBusu(responseText, statusText, xhr, $form)  { 
   resp = JSON.parse(responseText);
   //$('#guardaraeu').attr('disabled',false);
   
   document.myForm_admu.sn_iden.value="S";
   if (resp.estado == 1){
     /*if (resp.fichas_vig >0) {
        alert('Paciente ya tiene una ficha UPC en Edicion');
        document.myForm_busu.run.value="";
        document.myForm_busu.dv_run.value="";
    
        return;
     }*/
     if(resp.hosp[0] != null){
     document.myForm_admu.fec_ing.value=resp.hosp[0].ingreso.substr(6,2)+'/'+resp.hosp[0].ingreso.substr(4,2)+'/'+resp.hosp[0].ingreso.substr(0,4);
     document.myForm_admu.hora_ini.value=resp.hosp[0].ingreso.substr(8,2);
     document.myForm_admu.minuto_ini.value=resp.hosp[0].ingreso.substr(10,2);
     }
     else{
          alert('No se encontraron datos de Hospitalizacion');
                  document.myForm_busu.run.value="";
        document.myForm_busu.dv_run.value="";

          return;
     }
      $("#myForm_admu").find('input','button').attr('disabled',false);
    //  $("#myForm_admu").find('select').attr('disabled',false);
     //  $('#guardaraeu').button("enable");
     document.myForm_admu.nombre.value=resp.primer_nombre+ ' '+ resp.segundo_nombre;
     document.myForm_admu.apellido.value= resp.apellido_paterno+ ' '+ resp.apellido_materno;

     document.myForm_admu.fec_nac.value=resp.fecha_nac;
     document.myForm_admu.edad.value=resp.edad;
	 document.myForm_admu.edad_m.value=resp.edad_m;
	 document.myForm_admu.edad_d.value=resp.edad_d;
	 
     document.myForm_admu.run.value=resp.run;
     document.myForm_admu.dv_run.value=resp.dv_run;
     document.myForm_admu.grado.value=resp.sigla_grado;
     if (resp.sexo =='F')
     document.myForm_admu.ind_sexo[0].checked=true;
     else if (resp.sexo =='M')
     document.myForm_admu.ind_sexo[1].checked=true;
     if(resp.sexo ==null){

     document.myForm_admu.ind_sexo[0].readOnly=false;
     document.myForm_admu.ind_sexo[1].readOnly=false;
     document.myForm_admu.ind_sexo[0].disabled=false;
     document.myForm_admu.ind_sexo[1].disabled=false;
     
     }

     var j=0;
     var html="<ul>";
     if (resp.lab != null)
     for(j=0;j< resp.lab.length;j++){
        html=html+"<li><a href='#' onclick='muestra_barmen(\""+resp.run+"-"+resp.dv_run+"\",\""+resp.lab[j].o_numero+"\")'>"+resp.lab[j].o_numero+ ' ('+resp.lab[j].fecha_toma+')</a></li>';
     }
     html=html+"</ul>";
     $('#lab').html(html);
     
     document.myForm_admu.nombre.readOnly=true;
     document.myForm_admu.apellido.readOnly=true;
     document.myForm_admu.edad.readOnly=true;
	 document.myForm_admu.edad_m.readOnly=true;
	 document.myForm_admu.edad_d.readOnly=true;
	 
     document.myForm_admu.ind_sexo[0].readOnly=true;
     document.myForm_admu.ind_sexo[1].readOnly=true;
     document.myForm_admu.fec_nac.readOnly=true;
   }
   else{
     $("#myForm_admu").find('input','button').attr('disabled',false);
    // $("#myForm_admu").find('select').attr('disabled',false);
       $('#guardaraeu').button("enable");
     
     document.myForm_admu.run.value=document.myForm_busu.run.value;
     document.myForm_admu.dv_run.value=document.myForm_busu.dv_run.value;
     document.myForm_admu.grado.value="";
     document.myForm_admu.nombre.value="";
     document.myForm_admu.fec_nac.value="";
     document.myForm_admu.fec_nac.value="";
     document.myForm_admu.ind_sexo[0].checked=false;
     document.myForm_admu.ind_sexo[1].checked=false;
     document.myForm_admu.nombre.readOnly=false;
     document.myForm_admu.ind_sexo[0].readOnly=false;
     document.myForm_admu.ind_sexo[1].readOnly=false;
     document.myForm_admu.fec_nac.readOnly=false;
   }
   $('#resultreferencialu').html(resp.resbusq);
}
   function showResponseAdmu(responseText, statusText, xhr, $form)  { 
   resp = JSON.parse(responseText);
  if (resp.estado ==3){
     alert('Datos de Cierre Guardados');
      jQuery("#list-fichas").jqGrid('setGridParam',{datatype:'json'}).trigger('reloadGrid');
     //carga_slider(); 
     $('#vwficha').dialog('close'); 
    
   }
   else if (resp.estado ==4){
     alert('Ficha Cerrada');
	 document.verreceta.id_ficha.value='<?php echo $_REQUEST['id_ficha'];?>';
	 document.verreceta.submit();
	 if(resp.id_firma_doc !="")
	 viewPdf(resp.id_firma_doc);
	 chequea_ges('<?php echo $_REQUEST['id_ficha'];?>');

      jQuery("#list-fichas").jqGrid('setGridParam',{datatype:'json'}).trigger('reloadGrid');
     //carga_slider(); 
     $('#vwficha').dialog('close'); 
    
   }
   else{
     alert(resp.error);
   
   }
   
   
  }
  jQuery.fn.reset = function () {
  $(this).each (function() { this.reset(); });
  
}
$('.tabenm').hide();
$('.enmdatos').hide();

$(".buttabenm").button({icons: {primary: "ui-icon-pencil"}});
  $('#myForm_busu').ajaxForm(optionsbusu); 
  $('#myForm_admu').ajaxForm(optionsadmu); 
  <?php
   if($_REQUEST["accion"]=="C"){
   ?>
  $('#fec_egr').datepicker({changeMonth:true,changeYear:true,yearRange:"-110:+1",maxDate: '+3d',dateFormat:"dd/mm/yy"});
    $('#fec_alta').datepicker({changeMonth:true,changeYear:true,yearRange:"-110:+0",maxDate: '+7d',dateFormat:"dd/mm/yy"});

  <?php
   }
   ?>
   
   
  
 
   
</script>
<fieldset id="fichalectura">
<form id="myForm_admu" name="myForm_admu" action="Servicios/setFicha.php" method="post"> 
<?php
if($_REQUEST["id_ficha"] != ""){
 $dbh=genera_adodb("portal");
 $creador="Creada por ";
 $ficha=retorna_ficha($db,$_REQUEST["id_ficha"] );
 $creador.=utf8_encode(retorna_datos_portal($dbh,$ficha[0]["usuario"]));
  $creador.=" con fecha : ".$ficha[0]["fec_creacion"];
 $dbh->disconnect();
}
?>
<legend><b id='lbl'>FICHA <?php echo  $creador ;?></b></legend>
<fieldset>
<legend><b id='lbl'>Identificacion</b></legend><table><tr><td><b id='lbl'>RUT: </b><span id="run" ></span>-<span id="dv_run"></span> </td></tr></table></fieldset>
<fieldset>
<legend><b id='lbl'>Datos Personales</b></legend>
<table>
<tr>
 <td><b id='lbl'>Nombre:</b></td>
 <td><span id="nombre" /></td>
 <td><b id='lbl'>Apellidos:</b></td>
 <td><span id="apellido" /></td>
</tr>
<tr>
 <td><b id='lbl'>Fecha Nacimiento:</b></td>
 <td><span id="fec_nac"/></td>
 <td><b id='lbl'>Edad:</b></td>
 <td><span id="edad" /> A&ntilde;os <span id="edad_m"/> Meses <span id="edad_d"/> Dias</td>
</tr>
<tr>
 <td><b id='lbl'>Sexo:</b></td>
 <td><span id="ind_sexo" /></span></td>
 <td colspan="2">&nbsp;</td>
</tr>
  <tr><td><b id='lbl'>Fecha y Hora Ingreso Hospitalizacion:</b>     </td><td colspan="3"><span id="fec_ing" /> <span id="hora_ini" />:<span id="minuto_ini" /> 
 
 </td>
</tr>
<tr><td><b id='lbl'>Servicio Ingreso :</b></td><td><span id="desc_serv_ingreso"></span></td></tr>
<tr><td><b id='lbl'>Servicio Actual :</b></td><td><span id="desc_serv_actual"></span></td></tr>


</table>
</fieldset>
<?php
if($_REQUEST["id_ficha"] !=""){
     $valores=array();
  $valores[]=$_REQUEST["id_ficha"];

       $recordset = $db->Execute("select ingreso_abreviado,usuario_abreviado,to_char(fecha_creacion_abreviado,'DD/MM/YYYY HH24:MI:SS') as fecha_creacion_abreviado from ficha  where id_ficha=?  and trim(ingreso_abreviado) is not null order by 1",$valores);                                  
   if (!$recordset) die("hhh".$db->ErrorMsg());                                                                                    
                                                                                                                                   
   while ($arr = $recordset->FetchRow()) {                                                                                         
     $dbh=genera_adodb("portal");                                                                                                  
     $creador_abr="Creado por ";                                                                                                   
     $creador_abr.=utf8_encode(retorna_datos_portal($dbh,$arr["usuario_abreviado"]));                                              
     $creador_abr.=" con fecha : ".$arr["fecha_creacion_abreviado"];                                                               
                                                                                                                                   
     $dbh->disconnect();                                                                                                           
     print("<fieldset>");                                                                                                          
     print("<legend><b>Ingreso Abreviado ".$creador_abr."</b></legend>");                                                          
     print("<pre>".$arr["ingreso_abreviado"]."</pre>");                                                                            
     print("</fieldset>");                                                                                                         
                                                                                                                                   
   }            



  

 
     $valores=array();
     $valores[]=$_REQUEST["id_ficha"];
     $recordset = $db->Execute("select to_char(a.fecha,'DD/MM/YYYY HH24:mi:ss') as fecha_f,fecha,a.id_ficha,a.sec_evo,a.evolucion,a.usuario  from evolucion a where a.id_ficha=? and a.sn_abreviado='S' order by fecha",$valores);
  if (!$recordset) die("hhh".$db->ErrorMsg());  
  $dbh=genera_adodb("portal");
  $flag=0;
  while ($arr = $recordset->FetchRow()) {
   if($flag==0){
	print("<fieldset><legend><b>Evoluci&oacute;n Ingreso Abreviado</b></legend>");
      $flag++;
	
   }
   
   $nombre_us=retorna_datos_portal($dbh,$arr["usuario"]);
  
   $sec_evo=$arr["sec_evo"];
    print("<fieldset ><legend><b>".$nombre_us." - " .$arr["fecha_f"] ."</b> </legend>");
  	print(gzinflate($arr["evolucion"]));
    print("</fieldset>");
   
  
  
    }
    $dbh->disconnect();
	if($flag >0)
    print("</fieldset>");
  }
     $valores=array();

     $recordset = $db->Execute("select * from seccion order by 1",$valores);
  if (!$recordset) die("hhh".$db->ErrorMsg());

  while ($arr = $recordset->FetchRow()) {
    print("<fieldset>");
    print("<legend><b id='lbl'>".utf8_encode($arr["desc_seccion"])."</b></legend>");
   
   
	
 
     $valores=array();
  
     $valores[]=$arr["cod_seccion"];
     $recordset_d = $db->Execute("select * from datos where  cod_seccion=? order by 1",$valores);
     if (!$recordset_d) die("hhh".$db->ErrorMsg());
     print("<table border='0' width=\"80%\">");
     while ($arr_d = $recordset_d->FetchRow()) {
      $arr_d["descr"]=utf8_encode($arr_d["descr"]);
      $required=($arr_d["mand"]=='S')?'required':'';
      if($_REQUEST["id_ficha"] ==""){
      if($arr_d["tipo_entrada"] =="TA"){
       $rtf=($arr_d["rtf"]=='S')?'rtf':''; 
       print("<tr><td><textarea name='datos_".$arr_d["cod"]."' id='datos_".$arr_d["cod"]."'  cols='200' rows='4'  $required class='$rtf'>".$arr_d["prellenado"]."</textarea></td></tr>");
      }
      elseif($arr_d["tipo_entrada"] =="T"){
       print("<tr><td><input type='text' name='datos_".$arr_d["cod"]."' id='datos_".$arr_d["cod"]."'  size='".$arr_d["largo"]."' maxlength='".$arr_d["largo"]."'  $required value='".$arr_d["prellenado"]."'></td></tr>");
      }
      	  elseif($arr_d["tipo_entrada"] =="D"){
       print("<tr><td><b id='lbl'>".$arr_d["descr"]."</b></td><td><input type='text' name='datos_".$arr_d["cod"]."' id='datos_".$arr_d["cod"]."'  size='10' maxlength='10'  $required value='".$arr_d["prellenado"]."' readonly class='fecha'></td></tr>");
      }
	  elseif($arr_d["tipo_entrada"] =="R"){
      $rang=explode(",",$arr_d["rango"]);
      print("<tr><td width=\"250px\"><b id='lbl'>".$arr_d["descr"]."</b></td><td>");
      foreach($rang as $kk => $j)
      
        print("<input type='radio' name='datos_".$arr_d["cod"]."' id='datos_".$arr_d["cod"]."' value='".$j."'  $required > ".$j."");
		if($arr_d["sn_obs"] =="S")
		  print(" <input type='text' size='40' maxlength='40' name='obs_datos_".$arr_d["cod"]."' id='obs_datos_".$arr_d["cod"]."'>");
		
        print("</td></tr>");
      }
      elseif($arr_d["tipo_entrada"] =="S"){
      $rang=explode("-",$arr_d["rango"]);
      print("<tr><td><select name='datos_".$arr_d["cod"]."' id='datos_".$arr_d["cod"]."'  $required>");
      for($j=$rang[0];$j<=$rang[1];$j++)
        print("<option value='$j'>$j</option>");
      print("</select></td></tr>");
       
      }
      }
      else{
        $class=array();
        $clase="";
        if($required !="")
        $class[]=$required;
      if($arr_d["tipo_entrada"] =="TA"){
       $rtf=($arr_d["rtf"]=='S')?'rtf':'';
       if($rtf !="")
        $class[]=$rtf;
       $clase=implode(",",$class); 
       print("<tr><td colspan='2'><b id='lbl'>".$arr_d["descr"]."</b><br><div id='datos_".$arr_d["cod"]."'></div></td></tr><tr class=\"enmdatos\"><td><textarea name='enmdatos_".$arr_d["cod"]."' id='enmdatos_".$arr_d["cod"]."'  cols='200' rows='4'  class='$clase'>".$arr_d["prellenado"]."</textarea></td></tr>");
      }
      elseif($arr_d["tipo_entrada"] =="T"){
       $clase=implode(",",$class); 
       
       print("<tr><td><b id='lbl'>".$arr_d["descr"]."</b><br><span id='datos_".$arr_d["cod"]."'></span></td></tr><tr class=\"enmdatos\"><td><input type='text' name='enmdatos_".$arr_d["cod"]."' id='enmdatos_".$arr_d["cod"]."'  size='".$arr_d["largo"]."' maxlength='".$arr_d["largo"]."'  class='$clase' value='".$arr_d["prellenado"]."'></td></tr>");
      }
       elseif($arr_d["tipo_entrada"] =="D"){
		$class[]="fecha";
       $clase=implode(",",$class); 
       
       print("<tr><td><b id='lbl'>".$arr_d["descr"]."</b><br><span id='datos_".$arr_d["cod"]."'></span></td></tr><tr class=\"enmdatos\"><td><input type='text' name='enmdatos_".$arr_d["cod"]."' id='enmdatos_".$arr_d["cod"]."'  size='8' maxlength='8'  class='$clase' value='".$arr_d["prellenado"]."'></td></tr>");
      }
      	  elseif($arr_d["tipo_entrada"] =="R"){
      $clase=implode(",",$class); 
       
      $rang=explode(",",$arr_d["rango"]);
      print("<tr><td ><b id='lbl'>".$arr_d["descr"]."</b><br><span id='datos_".$arr_d["cod"]."'></span> <div id='obs_datos_".$arr_d["cod"]."'></div></td></tr><tr class=\"enmdatos\"><td>");
      foreach($rang as $kk => $j)
      
        print(" <input type='radio' name='enmdatos_".$arr_d["cod"]."' id='enmdatos_".$arr_d["cod"]."' value='".$j."' class='$clase'> ".$j."");
      if($arr_d["sn_obs"] =="S")
		  print("<input type='text' size='40' maxlength='40' name='obs_enmdatos_".$arr_d["cod"]."' id='obs_enmdatos_".$arr_d["cod"]."'>");

      print("</td></tr>");
       
      }
      elseif($arr_d["tipo_entrada"] =="S"){
      $clase=implode(",",$class); 
       
      $rang=explode("-",$arr_d["rango"]);
      print("<tr><td><b id='lbl'>".$arr_d["descr"]."</b><br><span id='datos_".$arr_d["cod"]."'></span></td></tr><tr class=\"enmdatos\"><td><select name='enmdatos_".$arr_d["cod"]."' id='enmdatos_".$arr_d["cod"]."' class='$clase'>");
      for($j=$rang[0];$j<=$rang[1];$j++)
        print("<option value='$j'>$j</option>");
      print("</select></td></tr>");
       
      }  
      }
     }
      print("</table>");
    
    print("</fieldset>");
    
  }

?>



<?php
   if (($_REQUEST["id_ficha"] != "")){


  ?>
<fieldset>
<legend><b id='lbl'>Evoluci&oacute;n</b></legend>
 
     <?php
     $valores=array();
     $valores[]=$_REQUEST["id_ficha"];
     $recordset = $db->Execute("select to_char(a.fecha,'DD/MM/YYYY HH24:mi:ss') as fecha_f,fecha,a.id_ficha,a.sec_evo,a.estado,a.evolucion,a.usuario,(nvl((select max(x.sec) from enmienda x where x.id_ficha=a.id_ficha and x.sec_evo=a.sec_evo),0)) as enm,a.sn_interconsulta,a.cod_especialidad  from evolucion a where a.id_ficha=?  and a.sn_abreviado='N' order by fecha",$valores);
  if (!$recordset) die("hhh".$db->ErrorMsg());  
  $dbh=genera_adodb("portal");
while ($arr = $recordset->FetchRow()) {
  
  $nombre_us=retorna_datos_portal($dbh,$arr["usuario"]);
  
  $sec_evo=$arr["sec_evo"];
  $style="";
  if($arr["estado"] =="I"){
  $style="style=\"background-color:yellow\"";
  }
  $interconsulta ="&nbsp;";
  if($arr["sn_interconsulta"] =="S")
      $interconsulta ="<span> Es Interconsulta</span>";

  print("<fieldset ".$style."><legend><b id='lbl'>".$nombre_us." - " .$arr["fecha_f"] ." ". $interconsulta ."</b></legend>");
  //if($_SESSION["fichatmq"]["usuario"]==$arr["usuario"])
  //print("<textarea class='editor' id='evolucion_".$arr["sec_evo"]."' name='evolucion_".$arr["sec_evo"]."' style=\"width:100%;height:300px;\">".gzinflate($arr["evolucion"])."</textarea>");
  //else
    if($arr["enm"] > 0)
  print("<del>");
  print(gzinflate($arr["evolucion"]));
  
  $valores=array();
  $valores[]=$_REQUEST["id_ficha"];
  $valores[]=$sec_evo;
  $recordset_img = $db->Execute("select id_ficha,sec_evo,sec,enmienda,fecha,to_char(fecha,'DD/MM/YYYY HH24:mi:ss') as fecha_f from enmienda where id_ficha=? and sec_evo=? order by fecha",$valores);
  if (!$recordset_img) die("hhh".$db->ErrorMsg());
  $cont=0;
  while ($arr_img = $recordset_img->FetchRow()) {
      if($arr["enm"] ==$arr_img["sec"])
       print("</del>");
    print("<b id='lbl'>".$arr_img["fecha_f"]."</b><br>".gzinflate($arr_img["enmienda"]));
    
  }
  if($_SESSION["fichatmq"]["usuario"]==$arr["usuario"]){
   
  }
  $valores=array();
  $valores[]=$_REQUEST["id_ficha"];
  $valores[]=$sec_evo;
  $recordset_img = $db->Execute("select id_ficha,sec_evo,sec from anexo where id_ficha=? and sec_evo=?",$valores);
  if (!$recordset_img) die("hhh".$db->ErrorMsg());
  $cont=0;
  while ($arr_img = $recordset_img->FetchRow()) {
    $cont++;
    if($cont ==1){
      print("<table border='1'><tr><th>Adjunto</th></tr>");
     
    }
      print("<tr><td><img src='Servicios/getAdjunto.php?id_ficha=".$_REQUEST["id_ficha"]."&sec_evo=".$sec_evo."&sec=".$arr_img["sec"]."' width='750px'  height='300px' ></td></tr>");
    
  }
  if($cont >0)
    print("</table>");
  print("</fieldset>");
  
    }
    $dbh->disconnect();
    ?>

</fieldset>
<?php
   }
   ?>
   
   <?php
  

    
   if($_REQUEST["accion"]=="C"){
   ?>
   <fieldset >
    <legend><b id='lbl'>Datos Cierre Ficha</b></legend>
   <table>
	<tr><td colspan="2">Paciente COVID 19:  <select id="sn_covid" name="sn_covid" ><option value="">Elegir</option><option value="S">Si</option><option value="N">No</option></select> </td></tr>

    <tr><td colspan="2">Servicio Egreso <select name="servicio_egreso" id="servicio_egreso"> <option value=''>Seleccionar</option>
    <?php
       
       $servicios = $serv=retorna_referencias("S");
    if(count($servicios)>0)
      foreach($servicios as $kk => $vv)
//         if(trim($vv["cod"])=="1806")
         print("<option value='".trim($kk)."'>".$vv."</option>\n");
    ?>
    </select>
    </td></tr>
    <tr><td colspan="2">Destino Egreso <select name="destino_egreso" id="destino_egreso">
	     <option value=''>Seleccionar</option>
         <option value='F'>Fallecido</option>
		 <option value='D'>Domicilio</option>
		 <option value='H'>Hospitalizaci??n</option>
		 <option value='O'>Otro destino</option>
    </select>
    </td></tr>
    
	<tr><td colspan="2">Diagn&oacute;stico Egreso CIE10 <input type="hidden" name="ind_diag_pos" value="1"> <input id="diag_pos_bus" name="diag_pos_bus"  size="100"></td></tr>
<tr><td colspan="2">Observaciones Diagn&oacute;stico Egreso<br><textarea id="obs_diag_pos" name="obs_diag_pos" cols="200" rows="4"></textarea></td></tr>
<tr><td colspan="2"><table id="list-diag_pos"><tr><td/></tr></table><br><button type="button" id="btnDelDiagPos">Eliminar Diagn&oacute;sticos Egreso</button></td></tr>

  <tr><td colspan="4"><center>Fecha Egreso :  <input type="text" id="fec_egr" name="fec_egr" size="10" maxlength="10" readonly>
 
 Hora : 
 <select name="hora_ter" id="hora_ter">
<?php
  for($i=0;$i<=23;$i++){
  if($i<=9)
  $hora ="0".$i;
  else
  $hora =$i;
   
  print("<option value=\"$hora\">$hora</option>");
  }
?>
 </select> : <select name="minuto_ter" id="minuto_ter">
<?php
  for($i=0;$i<=59;$i++){
  if($i<=9)
  $minuto ="0".$i;
  else
  $minuto =$i;
   
  print("<option value=\"$minuto\">$minuto</option>");
  }
?>
 </select> </center>
 </td>
</tr>
</table>
   

<fieldset>
<legend><b id='lbl'>Resumen Alta</b></legend>
<textarea id="resumen_alta" name="resumen_alta" cols="200" rows="4"></textarea>

</fieldset>
<fieldset>
<legend><b id='lbl'>Indicaciones al Alta</b></legend>
<textarea id="indicaciones_alta" name="indicaciones_alta" cols="200" rows="4"></textarea>

</fieldset>
<fieldset>
   <legend><b id='lbl'>Indicaciones Farmacol&oacute;gicas</b></legend>
<?php
 $plantillas=retorna_plantillas($db,"M");
print("<center>Plantilla de Medicamentos : <select name='plantilla_m' onchange='mostrar_plantilla(this.value,\"medicamentos_alta\");'>");
print("<option value=''>Seleccione Plantilla</option>");

foreach($plantillas as $k => $fila){
print("<option value='".$fila["id"]."'>".$fila["nombre"]."</option>");
}
print("</select>");
?>
<br>
<textarea id="medicamentos_alta" name="medicamentos_alta" cols="200" rows="4"></textarea>
<br><button type="button" onclick="mostrar_embebido('<?php echo $_REQUEST["id_ficha"]; ?>','Q','<?php echo $_SESSION["fichatmq"]["usuario"];?>',$('#run').html(),$('#dv_run').html(),'N');">Crear Receta</button>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="mostrar_embebido('<?php echo $_REQUEST["id_ficha"]; ?>','Q','<?php echo $_SESSION["fichatmq"]["usuario"];?>',$('#run').html(),$('#dv_run').html(),'M');">Ver Receta(s)</button>
<br><button type="button" onclick="mostrar_embebido_referencia('<?php echo $_REQUEST["id_ficha"]; ?>','FT','<?php echo $_SESSION["fichatmq"]["usuario"];?>',$('#run').html(),$('#dv_run').html());">Crear Interconsulta</button>

</fieldset>

  

</fieldset>
<table width="100%">
  <tr> 
	<td colspan="2"><center> Tipo de Cierre : <select name="tipo_cierre" id="tipo_cierre" onchange="cambia_pin()">
	  <option value="S" <?php if ($_REQUEST["sn_epi"] =="S") { ?>selected<?php }?>>CON EPICRISIS</option>
	  <option value="N" <?php if ($_REQUEST["sn_epi"] =="N") { ?>selected<?php }?>>SIN EPICRISIS</option>
	  
	</select></center></td>
  </tr>
  <tr>
   <td width="50%"> 
   <center><button type="button" onclick="document.myForm_admu.estado.value='D';valida_cierre(document.myForm_admu);" id="guardaraeu">Guardar Datos de Cierre</button>  </center>
   </td>
   <td width="50%"> 
   <center><span id="spin"><?php if ($_REQUEST["sn_epi"] =="S") { ?>PIN : <input type="password" name="pin" size="4" maxlength="4"> <?php } ?></span><button type="button" onclick="document.myForm_admu.estado.value='C';valida_cierre(document.myForm_admu);" id="cerraraeu">Cerrar Ficha</button>  </center>
   </td>
  </tr> 
</table>
<button type="submit" id="dummy" style="display: none">Dummy</button>
<?php
   }
   else{
   ?>
    <fieldset >
    <legend><b id='lbl'>Datos Cierre Ficha</b></legend>
    <table>
	  	  <tr><td>Paciente COVID 19: <span id="sn_covid" /> </td></tr>

         <tr><td>Servicio Egreso <span name="desc_servicio_egreso" id="desc_servicio_egreso"></span>
 </td>
</tr>
        <tr><td>Destino Egreso <span name="desc_destino_egreso" id="desc_destino_egreso"></span>
 </td>
</tr>
 
      <tr><td>Diagn&oacute;sticos de Egreso:     </td><td colspan="3"><span id="diag_pos" /> 
 
 </td>
      <tr><td>Observaciones Diagn&oacute;sticos de Egreso:     </td><td colspan="3"><span id="obs_diag_pos" /> 
 
 </td>
      
</tr>
       <tr><td>Fecha y Hora Egreso :     </td><td colspan="3"><span id="fec_egr" /> <span id="hora_ter" />:<span id="minuto_ter" /> 
 
 </td>
</tr>
    </table>


    <fieldset>
    <legend><b id='lbl'>Resumen Alta</b></legend>
<span id="resumen_alta"></span>

</fieldset>
<fieldset>
<legend><b id='lbl'>Indicaciones al Alta</b></legend>
<span id="indicaciones_alta"></span>

</fieldset>
<fieldset>
       <legend><b id='lbl'>Indicaciones Farmacol&oacute;gicas</b></legend>
<span id="medicamentos_alta"></span>

</fieldset>

  
    </fieldset>
<?php
   }
   

  
?> 

  
<?php
   

   ?>
<input type="hidden" name="trans" value="cierre">
<input type="hidden" id="sn_epi" name="sn_epi" value="<?php echo $_REQUEST["sn_epi"]; ?>">

<input type="hidden" name="run" >
<input type="hidden" name="dv_run" >
<input type="hidden" name="grado" >
<input type="hidden" name="sn_iden" >
<input type="hidden" name="sn_cierra_padre" value='N'>

<input type="hidden" name="sn_enmienda" id="sn_enmienda" value='N'>

<input type="hidden" name="id_ficha" >

<input type="hidden" name="diag_pos" >
<input type="hidden" name="oper" >
<input type="hidden" name="usuario" >
<input type="hidden" name="estado" value="D">



</form>
</fieldset>

	
<div id='fichaalta' style='display: none'>
 

</div>
<?php


 $db->disconnect();
?>
<form name="pdfges" method='post' action="Servicios/getPDFGes.php">
        <input type='hidden' name="pdf">
        
    </form>
