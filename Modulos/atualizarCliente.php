<?php

	include("control.php");
	$_PUT = array();
	parse_str(file_get_contents('php://input'), $_PUT);
    $control = new control();
    $control->atualizarCliente($_PUT['nome'],$_PUT['email'],$_PUT['cpf'],$_PUT['descricao']);

?>