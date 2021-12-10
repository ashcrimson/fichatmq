<?php
include("../funciones.global.inc.php");
include("../funciones.inc.php");
include("../funciones.inc.firma.php");
$db=genera_adodb();
include ('../libs/phppdf/class.ezpdf.php');
verifica_sesion(false);
$id_ficha=$_REQUEST["id_ficha"];

	
	
$ficha=retorna_ficha($db,$id_ficha);

$ano = date('Y');
//$hoja = 'A3';
$hoja = 'LETTER';
$tipo = 'portrait';
$tam_font = 8; 
$pdf = new Cezpdf($hoja,$tipo);
set_time_limit(3000);
$pdf ->ezSetMargins(30,50,80,30);
//$pdf ->ezSetMargins(0,0,841.89,1190.55);
$pdf ->selectFont('../libs/phppdf/fonts/Helvetica.afm');
$pdf->ezStartPageNumbers(320,20,10,'','<b>Rut Paciente:</b>'.$ficha[0]["run"]."-".$ficha[0]["dv_run"].'      Pag. {PAGENUM} de {TOTALPAGENUM}',1);

$pdf->ezImage('../images/logo.jpg',3,120,90,'left');
//$pdf->line(puntos_cm(30),puntos_cm(45),puntos_cm(70),puntos_cm(3));
$pdf->ezSetDy(40);

$pdf->line(50,780,550,780);

$pdf->line(50,780,50,720);

$pdf->line(220,780,220,720);
$pdf->line(420,780,420,720);
$pdf->line(550,780,550,720);
$pdf->line(50,720,550,720);
//$pdf->ezText("<b> EPICRISIS MEDICA \n Nro : ".$id_epi."</b>",$tam_font,array('justification' => 'center','aleft'=>'50'));
$pdf->ezText("HOJA DE TRASLADO\n\n"."</b>",12,array('justification' => 'center','aleft'=>'50'));
$pdf->addText(450,752 ,12,"<b>Nro: ".$id_ficha."</b>");

//$pdf->line(puntos_cm(2),puntos_cm(25),puntos_cm(17),puntos_cm(25));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
//$pdf->line(puntos_cm(16),puntos_cm(25),puntos_cm(20),puntos_cm(25));
$pdf->line(50,695,550,695);

//$pdf->addJpegFromFile('../imagenes/linea1.jpg',50,550);

//$pdf->ezText("<b> Datos Personales</b>",10,array('justification' => 'center','aleft'=>'45'));
$pdf->addText(250,685 ,10,"<b> Datos Personales</b>");

$pdf->line(50,682,550,682);
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
/*$filas=array();
$filas_cabeza=array('colu1' => "",
			'colu2'  => "");
 $filas[] =  array('colu1' => "Rut : ".$ficha[0]["run"]."-".$ficha[0]["dv_run"],
                        'colu2' => "");
  
 $filas[] =  array('colu1' => "Nombre : ".$ficha[0]["nombre"],
                        'colu2' => "Apellidos : ".$ficha[0]["apellido"]);
 $filas[] =  array('colu1' => "Fecha Nacimiento : ".$ficha[0]["fec_nac"],
		   'colu2' => "Edad : ".$ficha[0]["edad"]." A".utf8_encode(chr(241)) ."os ".$ficha[0]["edad_m"]." Meses ".$ficha[0]["edad_d"]." Dias");
 $filas[] =  array('colu1' => "Direccion : ".$ficha[0]["direccion"],
                      'colu2' =>   "Telefono : ".$ficha[0]["telefono"]);
 $filas[] =  array('colu1' => "Sexo : ".$ficha[0]["ind_sexo"],
                      'colu2' =>   "");*/
 $pdf->line(50,600,550,600);
 $pdf->line(50,695,50,600);
 $pdf->line(550,695,550,600);
 
 		 $ver_dire = $ficha[0]["direccion"];
  		$calle = split("\n",$ver_dire);
  		$dir1 = $calle[0];
  		$dir2 = $calle[1];
  		$com = $calle[2];
  		$reg = $calle[3];
  		$direccion_completa = $dir1+" "+$dir2;
  		
$valor_nac = split("/",$ficha[0]["fec_nac"]);
$dia_nac = $valor_nac[0];
$mes_nac = $valor_nac[1];
$ano_nac = $valor_nac[2];
if($mes_nac == 1){
	$nom_mes_nac = 'Enero';
	}
	if($mes_nac == 2){
	$nom_mes_nac = 'Febrero';
	}if($mes_nac == 3){
	$nom_mes_nac = 'Marzo';
	}if($mes_nac == 4){
	$nom_mes_nac = 'Abril';
	}if($mes_nac == 5){
	$nom_mes_nac = 'Mayo';
	}if($mes_nac == 6){
	$nom_mes_nac = 'Junio';
	}if($mes_nac == 7){
	$nom_mes_nac = 'Julio';
	}if($mes_nac == 8){
	$nom_mes_nac = 'Agosto';
	}if($mes_nac == 9){
	$nom_mes_nac = 'Septiembre';
	}if($mes_nac == 10){
	$nom_mes_nac = 'Octubre';
	}if($mes_nac == 11){
	$nom_mes_nac = 'Noviembre';
	}if($mes_nac == 12){
	$nom_mes_nac = 'Diciembre';
	}
 
/* $pdf->line(50,583,550,583);  
 $pdf->line(50,583,50,550);
 $pdf->line(550,583,550,550);
 
 $pdf->line(50,568,550,568);  

/*                      
$pdf->ezTable($filas,
	       $filas_cabeza,null,
		      array('fontSize' => $tam_font,
			     'titleFontSize' => $tam_font,
			     'showLines' => '1',
                             'showHeadings' => '1',
			     'shaded' => '0',
                             'xPos' => '355', 
			    'shadeCol2' => array(1,1,0),
			    'cols' => array('colu1' => array('justification'=>'left' ,'width' =>300),
					    'colu2' => array('justification'=>'left', 'width' =>250)
					      )
			     )
			     );
	*/		   
$pdf->addText(65,670 ,10,"<b>Nombre</b>");
$pdf->addText(110,670 ,9,"<b>:</b> ".$ficha[0]["nombre"]." ".$ficha[0]["apellido"]);

$pdf->addText(375,670 ,10,"<b>Rut</b>");
$pdf->addText(430,670 ,9,"<b>:</b> ".$ficha[0]["run"]."-".$ficha[0]["dv_run"]);

if($ficha[0]["ind_sexo"]=='M'){
	
	$sexo = 'Masculino';
}else{
	$sexo='Femenino';
	}

$pdf->addText(65,655 ,10,"<b>Sexo</b>");
$pdf->addText(110,655 ,9,"<b>:</b> ".$sexo);

$pdf->addText(375,655 ,10,"<b>Nacimiento</b>");
$pdf->addText(430,655 ,9,"<b>:</b>".$dia_nac." de ".$nom_mes_nac." de ".$ano_nac);



$pdf->addText(375,640 ,10,"<b>Edad</b>");
$pdf->addText(430,640 ,9,"<b>:</b>".$ficha[0]["edad"]." A".utf8_encode(chr(241)) ."os ");

//$pdf->addText(385,625 ,10,"Region:");


$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
//$pdf->ezText("\n",$tam_font,array('justification'=>'left'));

$pdf->line(50,590,550,590);//linea arriba
$pdf->line(50,578,550,578);//linea medio
$pdf->line(50,590,50,485);//linea lateral izquierda
$pdf->line(550,590,550,485);//linea lateral derecha
$pdf->line(50,485,550,485);//linea abajo


$pdf->addText(250,580 ,10,"<b> Datos Hospitalizacion</b>");
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
/*$filas=array();
$filas_cabeza=array('colu1' => "",
			'colu2'  => "",
			'colu3'  => ""
);
 $filas[] =  array('colu1' => "Fecha Ingreso : ".$ficha[0]["fec_ing"] ." Hora Ingreso : ".$ficha[0]["hora_ing"].":".$ficha[0]["minuto_ing"],
		   'colu2' => "Motivo : ".$ficha[0]["motivo"],
                   'colu3' => ""
);
 $filas[] =  array('colu1' => "Fecha Egreso : ".$ficha[0]["fec_egr"] ." Hora Egreso : ".$ficha[0]["hora_egr"].":".$ficha[0]["minuto_egr"],
		   'colu2' => "Dias Hosp : ".$ficha[0]["dias"] ." dias ".$ficha[0]["horas"] ." horas " ,
                   'colu3' => ""
);
 $otro_destino="";
 if(trim($ficha[0]["otro_destino"]) !="")
   $otro_destino="\n".$ficha[0]["otro_destino"];
 $filas[] =  array('colu1' => "Servicio Procedencia : ".$servicios[$ficha[0]["cod_serv_orig"]],
                        'colu2' => "Servicio Egreso : ".$servicios[$ficha[0]["cod_serv_dest"]],
 'colu3' => "Destino Egreso: ".$destinos[$ficha[0]["cod_destino"]] .$otro_destino,
);

*/
	$valor = split("/",$ficha[0]["fec_ing_hosp"]);
$dia = $valor[0];
$mes = $valor[1];
$ano = $valor[2];
if($mes == 1){
	$nom_mes = 'Enero';
	}
	if($mes == 2){
	$nom_mes = 'Febrero';
	}if($mes == 3){
	$nom_mes = 'Marzo';
	}if($mes == 4){
	$nom_mes = 'Abril';
	}if($mes == 5){
	$nom_mes = 'Mayo';
	}if($mes == 6){
	$nom_mes = 'Junio';
	}if($mes == 7){
	$nom_mes = 'Julio';
	}if($mes == 8){
	$nom_mes = 'Agosto';
	}if($mes == 9){
	$nom_mes = 'Septiembre';
	}if($mes == 10){
	$nom_mes = 'Octubre';
	}if($mes == 11){
	$nom_mes = 'Noviembre';
	}if($mes == 12){
	$nom_mes = 'Diciembre';
	}
	
	$valor2 = split("/",$ficha[0]["fec_alta"]);
$dia2 = $valor2[0];
$mes2 = $valor2[1];
$ano2 = $valor2[2];
if($mes2 == 1){
	$nom_mes2 = 'Enero';
	}
	if($mes2 == 2){
	$nom_mes2 = 'Febrero';
	}if($mes2 == 3){
	$nom_mes2 = 'Marzo';
	}if($mes2 == 4){
	$nom_mes2 = 'Abril';
	}if($mes2 == 5){
	$nom_mes2 = 'Mayo';
	}if($mes2 == 6){
	$nom_mes2 = 'Junio';
	}if($mes2 == 7){
	$nom_mes2 = 'Julio';
	}if($mes2 == 8){
	$nom_mes2 = 'Agosto';
	}if($mes2 == 9){
	$nom_mes2 = 'Septiembre';
	}if($mes2 == 10){
	$nom_mes2 = 'Octubre';
	}if($mes2 == 11){
	$nom_mes2 = 'Noviembre';
	}if($mes2 == 12){
	$nom_mes2 = 'Diciembre';
	}

$pdf->addText(65,550 ,10,"<b>Fecha Ingreso</b>");
$pdf->addText(165,550 ,9,"<b>:</b> ".$dia." de ".$nom_mes." de ".$ano);
$pdf->addText(65,535 ,10,"<b>Hora Ingreso</b>");
$pdf->addText(165,535 ,9,"<b>:</b> ".$ficha[0]["hora_ini_hosp"].":".$ficha[0]["minuto_ini_hosp"]);
//$pdf->addText(65,520 ,10,"<b>Servicio Procedencia</b>");
//$pdf->addText(165,520 ,9,"<b> :</b> ".$servicios[$ficha[0]["cod_serv_orig"]]);



$pdf->addText(375,550 ,10,"<b>Fecha Egreso</b>");
$pdf->addText(440,550 ,9,"<b>:</b> ".$dia2." de ".$nom_mes2." de ".$ano2);
$pdf->addText(375,535 ,10,"<b>Hora Egreso</b>");
$pdf->addText(440,535 ,9,"<b>:</b> ".$ficha[0]["hora_alta"].":".$ficha[0]["minuto_alta"]);


 
/* 
$pdf->ezTable($filas,
	       $filas_cabeza,null,
		      array('fontSize' => $tam_font,
			     'titleFontSize' => $tam_font,
			     'showLines' => '1',
                             'showHeadings' => '1',
			     'shaded' => '0',
                             'xPos' => '370', 
			    'shadeCol2' => array(1,1,0),
			    'cols' => array('colu1' => array('justification'=>'left' ,'width' =>200),
					    'colu2' => array('justification'=>'left', 'width' =>200),
                                            'colu3' => array('justification'=>'left', 'width' =>200) 
					      )
			     )
			     );
	*/		     
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));

$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));

if(count($ficha[0]["diag_pos"])>0){


$pdf->line(50,464,550,464);//linea arriba
$pdf->line(50,464,50,448);//linea lateral izquierda
$pdf->line(550,464,550,448);//linea lateral derecha

$pdf->addText(250,453 ,10,"<b>Diagnosticos de Egreso</b>");	
//$pdf->ezText("<b> Diagnosticos de Egreso</b>",10,array('justification' => 'center'));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));

$filas_cabeza=array('cod' => "<b>Codigo</b>",
		    'descrip'  => "<b>Descripcion</b>");
$pdf->ezTable(
	       $ficha[0]["diag_pos"],$filas_cabeza,null,
		      array('fontSize' => $tam_font,
			     'titleFontSize' => $tam_font,
			     'showLines' => '2',
                             'showHeadings' => '1',
			     'shaded' => '0',
                             'xPos' => '305', 
			    'shadeCol2' => array(1,1,0),
			    'cols' => array('cod' => array('justification'=>'left' ,'width' =>50),
					    'descrip' => array('justification'=>'left', 'width' =>450) 
                                           )
                                         
					 
			     )
			    );
}
 if(trim($ficha[0]["obs_diag_pos"]) !=""){
//$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
//$pdf->ezText("<b>Otros Diagnosticos de Egreso2</b>",$tam_font,array('justification'=>'left'));
//$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$filas=array();
$filas_cabeza=array('colu1' => "                                                              <b>Otros Diagnosticos de Egreso</b>");
$filas[]=array('colu1' => $ficha[0]["obs_diag_pos"]);
$pdf->ezTable($filas,$filas_cabeza,null,
array('fontSize' => 10,'titleFontSize' => 10,'showLines' => '1',
'showHeadings' => '1','shaded' => '0','xPos' => '305',
'shadeCol2' => array(1,1,0),'cols' => array('colu1' => array('justification'=>'full' ,'width' =>500))));
}
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));

//$pdf->ezText("<b> Resumen Hospitalizacion</b>",10,array('justification' => 'center'));
//$pdf->ezText("\n",$tam_font,array('justification'=>'left'));

$filas=array();
$filas_cabeza=array();
$filas_cabeza=array('colu1' => "                                                                       <b> Resumen </b>");

$filas[]=array('colu1' => $ficha[0]["resumen_alta"]);
$pdf->ezTable($filas,$filas_cabeza,null,array('fontSize' => 10,
'titleFontSize' => 10,'showLines' => '1','showHeadings' => '1','shaded' => '0',
'xPos' => '305','shadeCol2' => array(1,1,0),
'cols' => array('colu1' => array('justification'=>'full' ,'width' =>500))));


$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$filas=array();
$filas_cabeza=array();
$filas_cabeza=array('colu1' => "                                                                       <b> Indicaciones</b>");

$filas[]=array('colu1' => $ficha[0]["indicaciones_alta"]);
$pdf->ezTable($filas,$filas_cabeza,null,array('fontSize' => 10,
'titleFontSize' => 10,'showLines' => '1','showHeadings' => '1','shaded' => '0',
'xPos' => '305','shadeCol2' => array(1,1,0),
'cols' => array('colu1' => array('justification'=>'full' ,'width' =>500))));




//-----------
/*
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$filas=array();
 $filas_cabeza=array('colu1' => "",
			'colu2'  => ""
);
 $filas[] =  array('colu1' => "<b>Rangos de Curacion : </b>".$ficha[0]["rangos_curacion"] ,
		   'colu2' => "<b>Retiro de Puntos : </b>".$ficha[0]["retiro_puntos"] 
);
$pdf->ezTable($filas,
	       $filas_cabeza,null,
		      array('fontSize' => $tam_font,
			     'titleFontSize' => $tam_font,
			     'showLines' => '1',
                             'showHeadings' => '0',
			     'shaded' => '0',
                             'xPos' => '305', 
			    'shadeCol2' => array(1,1,0),
			    'cols' => array('colu1' => array('justification'=>'left' ,'width' =>250),
					    'colu2' => array('justification'=>'left', 'width' =>250)
					      )
			     )
			     );

$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$filas=array();
 $filas_cabeza=array('colu1' => "",
			'colu2'  => ""
);
 $filas[] =  array('colu1' => "<b>Interconsultas : </b>".$ficha[0]["interconsultas"] ,
		   'colu2' => "<b>Otras Indicaciones : </b>".$ficha[0]["otras_indicaciones"] 
);
$pdf->ezTable($filas,
	       $filas_cabeza,null,
		      array('fontSize' => $tam_font,
			     'titleFontSize' => $tam_font,
			     'showLines' => '1',
                             'showHeadings' => '0',
			     'shaded' => '0',
                             'xPos' => '305', 
			    'shadeCol2' => array(1,1,0),
			    'cols' => array('colu1' => array('justification'=>'left' ,'width' =>250),
					    'colu2' => array('justification'=>'left', 'width' =>250)
					      )
			     )
			     );
*/
//$pdf->ezNewPage();

 if(trim($ficha[0]["medicamentos_alta"]) != ""){
$filas=array();
$filas_temp=array();

$filas_cabeza=array('colu1' => "                                                                                     <b>Medicamentos</b>");

 
$filas_temp =  preg_split('/\r\n|[\r\n]/',$ficha[0]["medicamentos_alta"]);
 if(count($filas_temp)>0){
   foreach($filas_temp as $km =>$vm)
     $filas[] =  array('colu1' => $vm);

$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
//$pdf->ezText("<b> Medicamentos </b>",$tam_font,array('justification' => 'center'));
//$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezTable($filas,
	       $filas_cabeza,null,
		      array('fontSize' => 10,
			     'titleFontSize' => $tam_font,
			     'showLines' => '1',
                             'showHeadings' => '1',
			     'shaded' => '0',
                             'xPos' => '305', 
			    'shadeCol2' => array(1,1,0),
			     'cols' => array('colu1' => array('justification'=>'left' ,'width' =>500)
					     
					
					      )
			     )
			     );

 }
}
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
 $filas=array();
 $filas_cabeza=array(
		     'colu2'  => "",
                        'colu3'  => ""
		     );
 
 


$dbh=genera_adodb("portal");
$nombre_us=retorna_datos_portal($dbh,$ficha[0]["usuario_egr"]);
$dbh->disconnect();
 $filas[] =  array('colu2' => "______________________________",'colu3' => "");
 $filas[] =  array('colu2' =>"<b>".$nombre_us."</b>",'colu3' => "");
 $pdf->ezTable($filas,
               $filas_cabeza,null,
	       array('fontSize' => $tam_font,
		     'titleFontSize' => $tam_font,
		     'showLines' => '0',
		     'showHeadings' => '0',
		     'shaded' => '0',
		     'xPos' => '435',
		     'shadeCol2' => array(1,1,0),
		     'cols' => array(
				     'colu2' => array('justification'=>'center', 'width' =>250),
				     'colu3' => array('justification'=>'center', 'width' =>250)
				     )
		     )
	       );
 /*$pdf->ezText("\n",$tam_font,array('justification'=>'left'));
$pdf->ezText("<b> ". $retorno["line1"] ."</b>",$tam_font,array('justification' => 'center'));
$pdf->ezText("<b> ". $retorno["line2"] ."</b>",$tam_font,array('justification' => 'center'));
 */
$pdf->ezstream();
$db->disconnect();
?>
