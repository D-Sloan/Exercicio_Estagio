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
  <script>



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
        if(CadastForm.Nome.value == ''){
          alert("Insisa o Nome!");
          CadastForm.Nome.focus();
          return false;
        }else if(!validacaoEmail(CadastForm.Email.value)){
          alert("Email Inválido!");
          CadastForm.Email.focus();
          return false;
        }else if(!isNumber(CadastForm.CPF.value) || CadastForm.CPF.value.length != 11 || CadastForm.CPF.value == ''){
          alert("CPF Inválido!");
          CadastForm.CPF.focus();
          return false;
        }else{
          return true;
        }
      }

      function submeter(){
        if(verificarDados()){
          $.ajax({
            url : "cadastrarCliente.php",
            type : "POST",
            data : {
              nome: CadastForm.Nome.value,
              email: CadastForm.Email.value,
              cpf: CadastForm.CPF.value,
              descricao: CadastForm.Descricao.value
            }
          })
          .done(function(dado){
              var dados = JSON.parse(dado);
              if(dados['status']=='sucesso'){
                alert("Cadastrado com sucesso!");
                location = "index.php";
              }
              else{
                alert("CPF já cadastrado!");
              }
              
          })
          .fail(function(){
            alert("Erro");
          })
        }
      }

  </script>

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

 <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto"> 
        <div class="card card-signin my-5"> 
          <div class="card-body">
            <h4 class="card-title text-center">Cadastro de Clientes</h4>
            <br>
            <br>
            <form name="CadastForm" action ="Cadastro.php" onsubmit="submeterCliente();"  class="form-label-group" method="POST" >

              <div class="form-label-group">
                <input type="text" id="Nome" class="form-control" placeholder="Nome" name="Nome" required autofocus>
              </div>
              <br>
              <div class="form-label-group">
                <input type="Email" id="Email" class="form-control" placeholder="Email" name="Email" required autofocus>
              </div>
              <br>
              <div class="form-label-group">
                <input type="CPF" id="CPF" class="form-control" placeholder="CPF" name="CPF" required autofocus>
              </div>
              <br>
              <div class="form-label-group">
                <textarea placeholder="Descrição do cliente"  id="Descricao"></textarea>
              </div>
              <br>
              <br>
              <i class="btn btn-primary pull-right h2 form-control" id='botao' onclick = 'submeter()'>Cadastrar Cliente</i>
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

  <script src="vendor/jquery/jquery.min.js">
    $.('.bot_Env').click(function(){
      alert("Entrou");
    });
  </script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

