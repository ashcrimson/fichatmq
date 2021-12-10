var tipos="M:Medicamentos";

function onInit() {
$("#ing-plant").button({icons: {primary: "ui-icon-pencil"}}); 
$("#mod-plant").button({icons: {primary: "ui-icon-pencil"}}); 
$("#eli-plant").button({icons: {primary: "ui-icon-pencil"}}); 

	$("#list-plantillas").jqGrid({
	    url:'Servicios/getPlantillas.php', 
            editurl:'Servicios/setPlantillas.php',   
	    datatype: 'json', loadonce: false,height: 800,
            loadComplete: function (){ 
             $("#list-plantillas").jqGrid('setGridWidth',$("#vw_plantillas").width()-5,true);
         

            },
	    colNames:["ID","Nombre","Tipo","Texto"],
	    colModel :[ 
	      {name:'id_aux', index:'id_aux', width:50, align:'center',editable:false},
              {name:'nombre', index:'nombre', width:70, align:'center',editable:true},
              {name:'tipo', index:'tipo', width:50, align:'center',editable:true,edittype: "select",editoptions: { value: tipos},editrules:{}},  
              {name:'texto', index:'texto', width:140, align:'center',editable:true,edittype:'textarea',editoptions: {rows:"5",cols:"150"}},
               
	    ],jsonReader: { repeatitems : false, id: "0" }, 
	   rowNum:400, rowList:[100,200,300], sortname: 'fecha', viewrecords: true, sortorder: "desc", caption:"Mantencion de Plantillas",

	  });
	


}
$(document).ready(onInit);
function addPlantilla() {

	$("#list-plantillas").jqGrid('editGridRow',"new",{
		reloadAfterSubmit:true,
		closeAfterAdd:true,
		jqModal:false,
		width: 600,
afterSubmit: function (response) {
resp = JSON.parse(response.responseText);
if (resp.estado ==0){

 return [false, resp.error, response.responseText];

}
else{
 return [true, '', response.responseText];
}
}
		});  

}


function editPlantilla() {

	var selected = jQuery("#list-plantillas").jqGrid('getGridParam','selrow');
	if (selected == null) alert('Debe seleccionar una fila.');
        if (selected != null){ 
        $("#list-plantillas").jqGrid('editGridRow', selected,{viewPagerButtons: false,
		reloadAfterSubmit:true,
		closeAfterEdit:true,
		jqModal:false,
		width: 600,         
afterSubmit: function (response) {
resp = JSON.parse(response.responseText);
if (resp.estado ==0){

 return [false, resp.error, response.responseText];

}
else{
 return [true, '', response.responseText];
}
}
});	
}
}
function delPlantilla() {

	var selected = jQuery("#list-plantillas").jqGrid('getGridParam','selrow');
	if (selected == null) alert('Debe seleccionar una fila.');
        if (selected != null){ 
        $("#list-plantillas").jqGrid('delGridRow', selected,{viewPagerButtons: false,
		reloadAfterSubmit:true,
		closeAfterEdit:true,
		jqModal:false,
		width: 600,         
afterSubmit: function (response) {
resp = JSON.parse(response.responseText);
if (resp.estado ==0){

 return [false, resp.error, response.responseText];

}
else{
 return [true, '', response.responseText];
}
}
});	
}
}
