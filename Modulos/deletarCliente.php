<?php
	
	include("control.php");
	$_DELETE = array();
	parse_str(file_get_contents('php://input'), $_DELETE);
    $control = new control();
    $control->apagarCliente($_DELETE['cpf']);


?>