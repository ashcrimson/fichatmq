<?php /* Smarty version 2.6.13, created on 2015-10-20 21:45:42
         compiled from Tablero.tmpl */ ?>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Vista asignación de Boxes</title>
	

       
	<script src="jquery/js/tablero.js"></script>
	<link rel="stylesheet" href="style.css" />
<?php echo '
<style type="text/css">
html, body {
    margin: 0;
    padding: 0;
    font-size: 75%;
}
</style>
<style>

.ui-tooltip {
background: #F5DA81;
max-width: 500px;
}
.cd-main-content {
  text-align: center;
}
.cd-main-content h1 {
  font-size: 20px;
  font-size: 1.25rem;
  color: #64788c;
  padding: 4em 0;
}
.cd-main-content .cd-btn {
  position: relative;
  display: inline-block;
  padding: 1em 2em;
  background-color: #89ba2c;
  color: #ffffff;
  font-weight: bold;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  border-radius: 50em;
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5), 0 0 5px rgba(0, 0, 0, 0.1);
  -webkit-transition: all 0.2s;
  -moz-transition: all 0.2s;
  transition: all 0.2s;
}
.no-touch .cd-main-content .cd-btn:hover {
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.5), 0 0 20px rgba(0, 0, 0, 0.3);
}
@media only screen and (min-width: 1170px) {
  .cd-main-content h1 {
    font-size: 32px;
    font-size: 2rem;
  }
}

.cd-panel {
  position: fixed;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  visibility: hidden;
  -webkit-transition: visibility 0s 0.6s;
  -moz-transition: visibility 0s 0.6s;
  transition: visibility 0s 0.6s;
}
.cd-panel::after {
  /* overlay layer */
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: transparent;
  cursor: pointer;
  -webkit-transition: background 0.3s 0.3s;
  -moz-transition: background 0.3s 0.3s;
  transition: background 0.3s 0.3s;
}
.cd-panel.is-visible {
  visibility: visible;
  -webkit-transition: visibility 0s 0s;
  -moz-transition: visibility 0s 0s;
  transition: visibility 0s 0s;
}
.cd-panel.is-visible::after {
  background: rgba(0, 0, 0, 0.6);
  -webkit-transition: background 0.3s 0s;
  -moz-transition: background 0.3s 0s;
  transition: background 0.3s 0s;
}
.cd-panel.is-visible .cd-panel-close::before {
  -webkit-animation: cd-close-1 0.6s 0.3s;
  -moz-animation: cd-close-1 0.6s 0.3s;
  animation: cd-close-1 0.6s 0.3s;
}
.cd-panel.is-visible .cd-panel-close::after {
  -webkit-animation: cd-close-2 0.6s 0.3s;
  -moz-animation: cd-close-2 0.6s 0.3s;
  animation: cd-close-2 0.6s 0.3s;
}

@-webkit-keyframes cd-close-1 {
  0%, 50% {
    -webkit-transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(45deg);
  }
}
@-moz-keyframes cd-close-1 {
  0%, 50% {
    -moz-transform: rotate(0);
  }
  100% {
    -moz-transform: rotate(45deg);
  }
}
@keyframes cd-close-1 {
  0%, 50% {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -ms-transform: rotate(0);
    -o-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
  }
}
@-webkit-keyframes cd-close-2 {
  0%, 50% {
    -webkit-transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(-45deg);
  }
}
@-moz-keyframes cd-close-2 {
  0%, 50% {
    -moz-transform: rotate(0);
  }
  100% {
    -moz-transform: rotate(-45deg);
  }
}
@keyframes cd-close-2 {
  0%, 50% {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -ms-transform: rotate(0);
    -o-transform: rotate(0);
    transform: rotate(0);
  }
  100% {
    -webkit-transform: rotate(-45deg);
    -moz-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    -o-transform: rotate(-45deg);
    transform: rotate(-45deg);
  }
}
.cd-panel-header {
  position: fixed;
  width: 90%;
  height: 50px;
  line-height: 50px;
  background: rgba(255, 255, 255, 0.96);
  z-index: 9998;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.08);
  -webkit-transition: top 0.3s 0s;
  -moz-transition: top 0.3s 0s;
  transition: top 0.3s 0s;
}
.cd-panel-header h1 {
  font-weight: bold;
  color: #89ba2c;
  padding-left: 5%;
}
.from-right .cd-panel-header, .from-left .cd-panel-header {
  top: -50px;
}
.from-right .cd-panel-header {
  right: 0;
}
.from-left .cd-panel-header {
  left: 0;
}
.is-visible .cd-panel-header {
  top: 0;
  -webkit-transition: top 0.3s 0.3s;
  -moz-transition: top 0.3s 0.3s;
  transition: top 0.3s 0.3s;
}
@media only screen and (min-width: 768px) {
  .cd-panel-header {
    width: 30%;
  }
}
@media only screen and (min-width: 1170px) {
  .cd-panel-header {
    width: 30%;
  }
}

.cd-panel-close {
  position: absolute;
  top: 0;
  right: 0;
  height: 100%;
  width: 60px;
  /* image replacement */
  display: inline-block;
  overflow: hidden;
  text-indent: 100%;
  white-space: nowrap;
}
.cd-panel-close::before, .cd-panel-close::after {
  /* close icon created in CSS */
  position: absolute;
  top: 22px;
  left: 20px;
  height: 3px;
  width: 20px;
  background-color: #424f5c;
  /* this fixes a bug where pseudo elements are slighty off position */
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}
.cd-panel-close::before {
  -webkit-transform: rotate(45deg);
  -moz-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  -o-transform: rotate(45deg);
  transform: rotate(45deg);
}
.cd-panel-close::after {
  -webkit-transform: rotate(-45deg);
  -moz-transform: rotate(-45deg);
  -ms-transform: rotate(-45deg);
  -o-transform: rotate(-45deg);
  transform: rotate(-45deg);
}
.no-touch .cd-panel-close:hover {
  background-color: #424f5c;
}
.no-touch .cd-panel-close:hover::before, .no-touch .cd-panel-close:hover::after {
  background-color: #ffffff;
  -webkit-transition-property: -webkit-transform;
  -moz-transition-property: -moz-transform;
  transition-property: transform;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  transition-duration: 0.3s;
}
.no-touch .cd-panel-close:hover::before {
  -webkit-transform: rotate(220deg);
  -moz-transform: rotate(220deg);
  -ms-transform: rotate(220deg);
  -o-transform: rotate(220deg);
  transform: rotate(220deg);
}
.no-touch .cd-panel-close:hover::after {
  -webkit-transform: rotate(135deg);
  -moz-transform: rotate(135deg);
  -ms-transform: rotate(135deg);
  -o-transform: rotate(135deg);
  transform: rotate(135deg);
}

.cd-panel-container {
  position: fixed;
  width: 90%;
  height: 100%;
  top: 0;
  background: #dbe2e9;
  z-index: 9996;
  -webkit-transition-property: -webkit-transform;
  -moz-transition-property: -moz-transform;
  transition-property: transform;
  -webkit-transition-duration: 0.3s;
  -moz-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-delay: 0.3s;
  -moz-transition-delay: 0.3s;
  transition-delay: 0.3s;
}
.from-right .cd-panel-container {
  right: 0;
  -webkit-transform: translate3d(100%, 0, 0);
  -moz-transform: translate3d(100%, 0, 0);
  -ms-transform: translate3d(100%, 0, 0);
  -o-transform: translate3d(100%, 0, 0);
  transform: translate3d(100%, 0, 0);
}
.from-left .cd-panel-container {
  left: 0;
  -webkit-transform: translate3d(-100%, 0, 0);
  -moz-transform: translate3d(-100%, 0, 0);
  -ms-transform: translate3d(-100%, 0, 0);
  -o-transform: translate3d(-100%, 0, 0);
  transform: translate3d(-100%, 0, 0);
}
.is-visible .cd-panel-container {
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
  -webkit-transition-delay: 0s;
  -moz-transition-delay: 0s;
  transition-delay: 0s;
}
@media only screen and (min-width: 768px) {
  .cd-panel-container {
    width: 30%;
  }
}
@media only screen and (min-width: 1170px) {
  .cd-panel-container {
    width: 30%;
  }
}

.cd-panel-content {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding: 70px 5%;
  overflow: auto;
  /* smooth scrolling on touch devices */
  -webkit-overflow-scrolling: touch;
}
.cd-panel-content p {
  font-size: 14px;
  font-size: 0.875rem;
  color: #424f5c;
  line-height: 1.4;
  margin: 2em 0;
}
.cd-panel-content p:first-of-type {
  margin-top: 0;
}
.xpanel {
    position: fixed;
    bottom: 50%;
    right: 0;
    z-index: 9999;
}
@media only screen and (min-width: 768px) {
  .cd-panel-content p {
    font-size: 16px;
    font-size: 1rem;
    line-height: 1.6;
  }
}
</style>
<script>
function controlpanel(obj){
if($( \'.cd-panel\' ).hasClass( "is-visible" )){
		  $(\'.cd-panel\').removeClass(\'is-visible\');
		 // event.preventDefault();
		  obj.src="images/arrow_posts_left.png";	
		}
		else{
		//event.preventDefault();
		$(\'.cd-panel\').addClass(\'is-visible\');
		obj.src="images/arrow_posts_right.png";
		}

}
jQuery(document).ready(function($){
	//open the lateral panel
	$(\'#btnxpanel\').on(\'click\', function(event){
		controlpanel(this);
	});
	//clode the lateral panel
	/*$(\'.cd-panel\').on(\'click\', function(event){
		if( $(event.target).is(\'.cd-panel\') || $(event.target).is(\'.cd-panel-close\') ) { 
			$(\'.cd-panel\').removeClass(\'is-visible\');
			event.preventDefault();
		}
	});
	*/
});
</script>
'; ?>

</head>
<body  >

<img src="images/arrow_posts_left.png" class="xpanel" id="btnxpanel" title="Pacientes en Atencion">

  <main class="cd-main-content">
	<!-- your main content here -->
</main>
 
<div class="cd-panel from-right">
	<header class="cd-panel-header">
		<h1>Pacientes en Atencion</h1>
	
	</header>
 
	<div class="cd-panel-container">
		<div class="cd-panel-content">
			<table id="pacbox-mi">
			<thead>
			<tr>
				<th>Mis Pacientes en Atencion</th>
				
			</tr>
		</thead>

			 <tbody>
			    
			 </tbody>
			</table> 
                        <table id="pacbox">
			<thead>
			<tr>
				<th>Pacientes en Atencion</th>
				
			</tr>
		</thead>

			 <tbody>
			    
			 </tbody>
			</table> 
		</div> <!-- cd-panel-content -->
	</div> <!-- cd-panel-container -->
</div> <!-- cd-panel -->

	<div  >
<div id="listado_resp"></div>
	<h1>Resumen</h1>
<center><table width="75%"><tr><?php if (( $_SESSION['cod_tipo_serv'] == 1 )): ?><td id="cant_e"> 0 </td><td> EN ESPERA </td><td id="cant_r"> 0 </td><td> REANIMACION </td><td id="cant_t"> 0 </td><td> TRIAGE </td><td id="cant_a"> 0 </td><td> ATENCION </td><td id="cant_o"> 0 </td><td> OBSERVACION Y REPOSO </td><td id="cant_s"> 0 </td><td> SALA INTERNA </td><td id="cant_p"> 0 </td><td> POR EGRESAR </td><?php elseif (( $_SESSION['cod_tipo_serv'] == 2 )): ?><td id="cant_e"> 0 </td><td> EN ESPERA </td><td id="cant_ped"> 0 </td><td> PEDIATRIA </td><td id="cant_p"> 0 </td><td> POR EGRESAR </td>
<?php elseif (( $_SESSION['cod_tipo_serv'] == 3 )): ?><td id="cant_e"> 0 </td><td> EN ESPERA </td><td id="cant_odo"> 0 </td><td> ODONTOLOGIA </td><td id="cant_p"> 0 </td><td> POR EGRESAR </td><?php endif; ?><td><button type="button" id="btnpendientes"> Ver Pendientes </button></td></tr></table>
<?php if (( $_SESSION['Rol'] == "" )): ?>

  <b>FILTROS </b> Derivacion : <select id="p_derivacion"><option value="">TODAS</option> <option value="C">CIR</option><option value="M">MED</option><option value="T">TRA</option></select>  Estado : <select id="p_estado"><option value="">TODOS</option><option value="A">Admitido</option><option value="E">En Atencion</option><option value="X">Pendiente</option></select>
<?php endif; ?>
</center>
	<h1>Pacientes Admitidos</h1>
	<div id="panelPacientes" style="height:150px;overflow:auto;">
		<div class="tableHeader">
                        <div class="colheader c1">ID Atencion</div>
			                        <div class="colheader c3">Fec Admision</div>
			<div class="colheader c4">Nombre</div>
                        			<div class="colheader c6">Edad</div>
                        <div class="colheader c7">Sexo</div>
			<div class="colheader c8">Derivacion</div>
			<div class="colheader c9">Tiempo Total <br>Dias : Hrs. : Mins.</div>
			<div class="colheader c10">Motivo Consulta</div>
			<div class="colheader c11">Estado</div>
                        <div class="colheader c12">Ubicación</div>
			<div class="colheader c13">Dest</div>
                        <div class="colheader c14">Prioridad</div>
                        <div class="colheader c15">Acom</div>   
			<br clear="all" />

		</div>
		<div id="tblPacientes"></div>
		<br clear="all" />
	</div>
	<div id="panelBoxes">
<h1>Box y Camillas</h1>
                <table  width="100%">
                 
                  <?php $_from = $this->_tpl_vars['rf']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cod_sec'] => $this->_tpl_vars['seccion']):
?>
                  <tr> 
                    <td><center><b><u><?php echo $this->_tpl_vars['seccion']['descr']; ?>
</u></b></center></td><td valign="top" id="seccion<?php echo $this->_tpl_vars['cod_sec']; ?>
"></td>
                  </tr> 
                  <tr><td colspan="2">&nbsp;<br><br></td></tr>
                  <?php endforeach; endif; unset($_from); ?>
                 
                 
                
                </table> 
	</div>
	</div>
</body>
</html>