<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Exercicio</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<script type="text/javascript">
  
  function deleteCliente(cpfCliente){
    $.ajax({
      url : "deletarCliente.php",
      type : "DELETE",
      data : {
        cpf : cpfCliente
      }
    })
    .done(function(){
      alert ("Usuário Deletado Com Sucesso");
      location = "index.php";
    })
    .fail(function(){
      alert("Erro");
    })
  }

</script>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container"> 
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">

      <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Início
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="Cadastro.php">Cadastrar
              <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
      </div>

    </div>
  </nav>

<div id="main" class="container-fluid" style="margin-top: 50px">
 
  <div id="top" class="row">
    <div class="col-sm-3">
      <h2>Clientes</h2>

    </div>

    <div class="col-sm-4">
      <form action="index.php" method="GET">
      <div class="input-group h2">

        <input name="busca" class="form-control" id="busca" type="text" placeholder="Pesquisar por nome">
        <div class="col-sm-3">
          <button class="btn btn-primary pull-right h2" type="submite">Buscar</button>
        </div>

      </form>
      </div>
      

    </div>

  </div> 
 
  <hr/>

  <div id="list" class="row">
  
  <div class="table-responsive col-md-12">
    <table class="table table-striped" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th>Nome</th>
          <th>CPF</th>
          <th>Email</th>
          <th>Descrição</th>
        </tr>


        <?php
          include("control.php");
          $control = new control();
          $control->listarClientes();
        ?>

      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  
  </div>
  
 </div> 

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>




















 


