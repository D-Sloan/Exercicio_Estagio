<?php

	include("control.php");
	$control = new control();
	$control->cadastrarCliente($_POST['nome'],$_POST['email'],$_POST['cpf'],$_POST['descricao']);

?>