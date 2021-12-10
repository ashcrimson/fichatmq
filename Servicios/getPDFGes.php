<?php
header("Content-type:application/pdf");
echo base64_decode($_REQUEST["pdf"]);
?>