<?php
/*
   Funcion Script : Mata sesion de usuario
   Ultima Modificacion: 12/09/2011  
*/

include_once 'funciones.global.inc.php';
verifica_sesion(false);
session_destroy(); // Mata cualquier sesion anterior 
header('Location: index.php');
?>
