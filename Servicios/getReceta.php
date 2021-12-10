<?php

$ind=array();
$ind["S"]="Si";
$ind["N"]="No";

include("../funciones.global.inc.php");
include("../funciones.inc.php");$db=genera_adodb();
include ('../libs/phppdf/class.ezpdf.php');
verifica_sesion(false);
$id_ficha=$_REQUEST["id_ficha"];

	
	
$ficha=retorna_ficha($db,$id_ficha);
$dbh=genera_adodb("portal");
  
  $datos_us=retorna_datos_portal($dbh,$ficha[0]["usuario_egr"]);

$dbh->disconnect();

$file = "Receta_". $_REQUEST["id_ficha"].".pdf";
$ano = date('Y');
$hoja = 'LETTER';
$tipo = 'portrait';
$tam_font = 8;  
$pdf = new Cezpdf($hoja,$tipo);
set_time_limit(3000);
$pdf ->ezSetMargins(30,50,80,30);
$pdf ->selectFont('../libs/phppdf/fonts/Helvetica.afm');
$pdf->ezStartPageNumbers(600,20,8,'','Subida Alessandri S/N Viña del Mar',1);
$pdf->ezStartPageNumbers(320,20,10,'','Pag. {PAGENUM} de {TOTALPAGENUM}',1);
$pdf->ezImage('../images/logo.jpg',5,120,90,'left');
$pdf->ezSetDy(40);
$pdf->ezText("<b> RECETA MEDICA</b>",12,array('justification' => 'center','aleft'=>'50'));
$pdf->ezText("\n",8,array('justification'=>'left'));
$pdf->ezText("Fecha : ".$ficha[0]["fec_alta"]."\n",8,array('justification'=>'left'));
$pdf->ezText("\n",8,array('justification'=>'left'));
$pdf->ezText("\n",8,array('justification'=>'left'));
$filas=array();
$filas_cabeza=array('colu1' => "",'colu2'  => "");
$filas[] =  array('colu1' => "RUT : ".$ficha[0]["run"]."-".$ficha[0]["dv_run"],'colu2' => "Nombre : ".$ficha[0]["nombre"]." ".$ficha[0]["apellido"]);
$filas[] =  array('colu1' => "Edad : ".$ficha[0]["edad"],'colu2' => "Sexo : ".$ficha[0]["ind_sexo"]);
$pdf->ezTable($filas,$filas_cabeza,null,array('fontSize' => $tam_font,'titleFontSize' => $tam_font,'showLines' => '0','showHeadings' => '0','shaded' => '0','xPos' => '305','shadeCol2' => array(1,1,0),'cols' => array('colu1' => array('justification'=>'left' ,'width' =>250),'colu2' => array('justification'=>'left', 'width' =>250))));
$pdf->ezText("\n",8,array('justification'=>'left'));
$pdf->ezText("\n",8,array('justification'=>'left'));
$filas=array();
$filas_cabeza=array('colu2'  => "Medicamento");
$filas[] =  array('colu2' => $ficha[0]["medicamentos_alta"]);
$pdf->ezTable($filas,$filas_cabeza,null,
		      array('fontSize' => $tam_font,
			     'titleFontSize' => $tam_font,
			     'showLines' => '2',
                             'showHeadings' => '0',
			     'shaded' => '0',
                             'xPos' => '305', 
			    'shadeCol2' => array(1,1,0),
			    'cols' => array(
					    'colu2' => array('justification'=>'left', 'width' =>400)
					      )
			     )
			     );
$pdf->ezText("\n",8,array('justification'=>'left'));
$pdf->ezText("\n",10,array('justification'=>'left'));
$pdf->ezText("\n",10,array('justification'=>'left'));
$pdf->ezText("\n",10,array('justification'=>'left'));
$pdf->ezText("\n",10,array('justification'=>'left'));
$pdf->ezText("\n",10,array('justification'=>'left'));
$pdf->ezText("<b>_____________________________</b>",10,array('justification' => 'center'));
$pdf->ezText("<b> ". $datos_us."\n</b>",10,array('justification' => 'center'));
//$pdf->ezText("\n\n<b> En caso de persistir o aumentar molestias o sintomas consultar en Policlinico o CAPS mas cercano</b>",$tam_font,array('justification' => 'center'));

$options=array();
$options['Content-Disposition']=$file;
$db->disconnect();
$pdf->ezStream($options);
?>
