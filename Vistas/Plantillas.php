<html>
<head>
<style>
html,body, td {
 margin: 0;                      /* Remove body margin/padding */
 padding: 0;
 overflow: hidden;       /* Remove scroll bars on browser window */
   font-size: 85%;

       
}
</style>
<script src="Vistas/plantillas.js"></script>
</head>
<body>
<center>
<button id="ing-plant" class="boton" onclick="addPlantilla();">Ingresar Plantilla</button>
<button id="mod-plant" class="boton" onclick="editPlantilla();">Modificar Plantilla</button>
<button id="eli-plant" class="boton" onclick="delPlantilla();">Eliminar Plantilla</button>

</center>

<table id="list-plantillas"><tr><td/></tr></table> 
   <div id="pager-plantillas"></div>
  </td>
</body>
</html>
