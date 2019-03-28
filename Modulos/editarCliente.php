<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Exercicio</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>


  

<body>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript">



      function validacaoEmail(field) {
        usuario = field.substring(0, field.indexOf("@"));
        dominio = field.substring(field.indexOf("@")+ 1, field.length);
         
        if ((usuario.length >=1) &&
            (dominio.length >=3) && 
            (usuario.search("@")==-1) && 
            (dominio.search("@")==-1) &&
            (usuario.search(" ")==-1) && 
            (dominio.search(" ")==-1) &&
            (dominio.search(".")!=-1) &&      
            (dominio.indexOf(".") >=1)&& 
            (dominio.lastIndexOf(".") < dominio.length - 1)) {

          return true;
        }
        else{
          return false;
        }
      }
      function isNumber(n) {
          return !isNaN(parseFloat(n)) && isFinite(n);
      }

      function verificarDados(){
        if(EditForm.Nome.value == ''){
          alert("Nome não pode ser vazio!");
          EditForm.Nome.focus();
          return false;
        }else if(!validacaoEmail(EditForm.Email.value)){
          alert("Email Inválido!");
          EditForm.Email.focus();
          return false;
        }else{
          return true;
        }
      }

  function atualizarClientes(){

    if(verificarDados()){
      document.getElementById("textoB").value = "Atualizando...";
      $.ajax({
        url : "atualizarCliente.php",
        type : "PUT",
        data : {
          cpf : EditForm.CPF.value,
          nome : EditForm.Nome.value,
          email : EditForm.Email.value,
          descricao : EditForm.Descricao.value
        }
      })
      .done(function(dado){
        var dados = JSON.parse(dado);
        if(dados['status']=='sucesso'){
          alert ("Dados Atualizados Com Sucesso!");
          location = "index.php";
        }
        else{
          alert ("Falha ao atualizar os Dados!");
        }
        
      })
      .fail(function(){
        alert("Erro");
      })
    }
    
  }

</script>

  <?php

      if(!isset($_GET['cpf'])){

        ?>
        <script type="text/javascript">
          alert("Selecione o cliente que deseja editar");
          location = "index.php";
        </script>
        <?php
      }
      else{

        include("control.php");
        $control = new control();
        $dados = $control->dadosCliente($_GET['cpf']);
        $nome = $dados['nome'];
        $email = $dados['email'];
        $descricao = $dados['descricao'];
      }
  ?>

  

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
        </ul>
      </div>

    </div>
  </nav>

 <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto"> 
        <div class="card card-signin my-5"> 
          <div class="card-body">
            <h4 class="card-title text-center">Editar Cliente</h4>
            <br>
            <br>

            <form id="EditForm" name="EditForm" class="form-signin" method="POST">

              <div class="form-label-group">
                <input type="text" id="Nome" class="form-control" placeholder="Nome" name="Nome" value="<?php echo $nome; ?>" required autofocus>
              </div>
              <br>
              <div class="form-label-group">
                <input type="Email" id="Email" class="form-control" placeholder="Email" name="Email" value="<?php echo $email; ?>" required autofocus>
              </div>
              <br>
              <div class="form-label-group">
                <input type="text" id="CPF" class="form-control" placeholder="CPF" name="CPF" value="<?php echo $_GET['cpf']; ?>" autofocus disabled>
              </div>
              <br>
              <div class="form-label-group">
                <textarea placeholder="Descrição do cliente" name="Descricao" id="Descricao"><?php echo $descricao; ?></textarea>
              </div>
              <br>
              <br>
              <i class="btn btn-primary pull-right h2 form-control" id='botao' onclick = 'atualizarClientes()'><label id="textoB">Atualizar Dados</label></i>
              <div class="form-label-group">
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <hr/>

  

  
 </div> 

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

