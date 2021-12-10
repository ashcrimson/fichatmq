<?php
include "../libs/phpqrcode/qrlib.php";
$link=$_REQUEST["id_doc"]; 
// create a QR Code with this text and display it
QRcode::png($_REQUEST["id_doc"]);
?>
