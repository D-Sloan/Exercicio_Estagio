<?php
	
	class control{


		public function cadastrarCliente($nome,$email,$cpf,$descricao){

			if($this->verificarExistencia($cpf)){

				echo (json_encode(["status" => "falha"]));
			}
			else{
				$this->inserirCliente($nome,$email,$cpf,$descricao);

				echo (json_encode(["status" => "sucesso"]));
			}
		}

		protected function inserirCliente($nome,$email,$cpf,$descricao){
			mysqli_query($this->getConexao(),"INSERT INTO T_Clientes (cpf,nome,email,descricao) VALUES ('$cpf','$nome','$email','$descricao')");
		}

		protected function verificarExistencia($cpf){
			$busca = mysqli_query($this->getConexao(),"SELECT * FROM T_Clientes WHERE cpf = '$cpf'");
			if(mysqli_num_rows($busca)>0){
				return true;
			}
			else{
				return false;
			}
		}

		public function apagarCliente($cpf){
				$this->deleteCliente($cpf);
				echo (json_encode(["status"=>"sucesso"]));

		}

		protected function deleteCliente($cpf){
			mysqli_query($this->getConexao(),"DELETE FROM T_Clientes WHERE cpf = '".$cpf."'");
		}


		public function atualizarCliente($nome,$email,$cpf,$descricao){
				$this->updateCliente($nome,$email,$cpf,$descricao);
				echo (json_encode(["status"=>"sucesso"]));
		}

		protected function updateCliente($nome,$email,$cpf,$descricao){
			mysqli_query($this->getConexao(),"UPDATE T_Clientes SET nome = '$nome', email = '$email', descricao = '$descricao' WHERE cpf = '$cpf'");
		}


		public function listarClientes(){

			if(isset($_GET['busca'])){
				$busca = $this->buscarCliente($_GET['busca']);
				echo $busca;
			}
			else{
				$busca = $this->buscarTodosClientes();
				echo $busca;
			}

		}

		protected function buscarTodosClientes(){
			$listaCliente = mysqli_query($this->getConexao(),"SELECT * FROM T_Clientes");
			$strFinal = "";
			while($linha = mysqli_fetch_array($listaCliente)){
				$strFinal = $strFinal."<tr>
          					<th>".$linha['nome']."</th>
				          	<th>".$linha['cpf']."</th>
				          	<th>".$linha['email']."</th>
				          	<th>".$linha['descricao']."</th>
				          	<th><a href='editarCliente.php?cpf=".$linha['cpf']."'><i class='fas fa-user-edit'></i></a></th>
				          	<th><i class='fas fa-user-minus' onclick = 'deleteCliente(".$linha['cpf'].")' ></i></th>
				        	</tr>";
			}
			return $strFinal;
		}

		protected function buscarCliente($nome){
			$nomeBusca = str_replace("%", "", $nome);
			$nomeBusca = str_replace(" ", "%", $nome);
			$listaCliente = mysqli_query($this->getConexao(),"SELECT * FROM T_Clientes WHERE nome LIKE '%".$nomeBusca."%'");
			$strFinal = "";
			while($linha =  mysqli_fetch_array($listaCliente)){
				$strFinal = $strFinal."<tr>
          					<th>".$linha['nome']."</th>
				          	<th>".$linha['cpf']."</th>
				          	<th>".$linha['email']."</th>
				          	<th>".$linha['descricao']."</th>
				          	<th><a href='editarCliente.php?cpf=".$linha['cpf']."'><i class='fas fa-user-edit'></i></a></th>
				          	<th><i class='fas fa-user-minus' onclick = 'deleteCliente(".$linha['cpf'].")' ></i></th>
				        	</tr>";
			}
			return $strFinal;
		}


		protected function getConexao(){
			return mysqli_connect("localhost","root","","exercicio");
		}

		public function createTable(){
			mysqli_query($this->getConexao(),"CREATE TABLE T_Clientes(cpf VARCHAR(11) NOT NULL , nome VARCHAR(50) NOT NULL , email VARCHAR(30) NOT NULL , descricao TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL , PRIMARY KEY (cpf(11)))");
		}

		public function dadosCliente($cpf){
			$busca = mysqli_query($this->getConexao(),"SELECT * FROM T_Clientes WHERE cpf = '$cpf'");
			$dados = mysqli_fetch_array($busca);
			return $dados;
		}

	}
	
?>