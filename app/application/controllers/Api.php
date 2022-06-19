<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index()
	{
		echo 'api is online';
	}
	public function Contato()
	{
		//possibilidades
		//$rota= " contato/cadastro";
		//$rota= "contato/1";
		//$rota= "contato/alterar/1";
		//$rota= "contato/exluir/1";
		//$rota= "contato/cliente/1";
		//$rota="contato"
		//$rota= "cliente/1(N PAGINA)/20(MAXIMO p/ PAGINAS)/"
		
		$rota=explode('/',$_SERVER["REQUEST_URI"]);
		$dados=json_decode(file_get_contents('php://input'),true);


		
		if(isset($dados['cpf'])){

			$dados['cpf'] = preg_replace('/[^0-9]/is', '', $dados['cpf']);

		}



		if(intval($rota[count($rota)-1])==0){
			//cadastro
			if(!isset($dados['cpf'])||!isset($dados['email'])||!isset($dados['nome'])||$dados['nome']==""||$dados['email']==""||$dados['cpf']==""){

				echo json_encode(['retorno'=>'erro','motivo'=>'esta faltando dados']);
				exit();
				
			}



			if(!$this->validacoes->validaCPF($dados['cpf'])){

				echo json_encode(['retorno'=>'erro','motivo'=>'CPF invalido']);
				exit();

			}



			if(!$this->validacoes->validaEmail($dados['email'])){
				echo json_encode(['retorno'=>'erro','motivo'=>'email invalido']);
				exit();
			}



			if(isset($dados['id_cliente'])){



				if(($this->cliente->FiltrarPorId($dados['id_cliente'])==null)){
					echo json_encode(['retorno'=>'erro','motivo'=>'o id_cliente se refere a um cliente que nao existe']);
					exit();
				}



			}



			if($this->contato->FiltrarPorCpf($dados['cpf'])!=null){



				echo json_encode(['retorno'=>'erro','motivo'=>'CPF PERTENCE A OUTRO CONTATO']);
				exit();



			}



			if($this->contato->FiltrarPorEmail($dados['email'])!=null){


				echo json_encode(['retorno'=>'erro','motivo'=>'Email PERTENCE A OUTRO CONTATO']);
				exit();


			}




			if($this->contato->CadastrarContato($dados)){
				echo json_encode(['retorno'=>'sucesso','motivo'=>'cliente cadastrado com sucesso']);
			}else{
				echo json_encode(['retorno'=>'erro','motivo'=>'Contato não foi cadastrado']);
			}



		}else{



			if(intval($rota[count($rota)-2])==0){
				


				switch($rota[count($rota)-2]){
				
					case'contato':
						
						if(!is_numeric($rota[count($rota)-1])){
							
							echo json_encode(['retorno'=>'erro','motivo'=>'parametro invalido']);
							exit();
						}
						echo json_encode($this->contato->LerContato($rota[count($rota)-1]));

					break;
					
					case 'excluir':
						
						
						
						if(!is_numeric($rota[count($rota)-1])){

							echo json_encode(['retorno'=>'erro','motivo'=>'parametro invalido']);
							exit();

						}



						if($this->contato->LerContato($rota[count($rota)-1])==null){
							echo json_encode(['retorno'=>'erro','motivo'=>'Contato nao existe']);
						}elseif($this->contato->ExcluirContato($rota[count($rota)-1])){
						
							echo json_encode(['retorno'=>'sucesso','motivo'=>'cliente excluido com sucesso']);

						}
						
				
					
					break;



					case'alterar':
						


						if(!isset($dados['cpf'])||!isset($dados['nome'])||!isset($dados['email'])||!isset($dados['id'])||$dados['nome']==""||$dados['cpf']==""||$dados['email']==""){

							echo json_encode(['retorno'=>'erro','motivo'=>'Faltam dados']);
							exit();

						}



						if($this->contato->LerContato($rota[count($rota)-1])==null){

							echo json_encode(['retorno'=>'erro','motivo'=>'Contato nao existe']);
							exit();
						}



						if(!$this->validacoes->validaCPF($dados['cpf'])){
							echo json_encode(['retorno'=>'erro','motivo'=>'cpf invalido']);
							exit();
						}



						if(!$this->validacoes->validaEmail($dados['email'])){
							echo json_encode(['retorno'=>'erro','motivo'=>'email invalido']);
							exit();
						}



						if(!($this->contato->FiltrarPorCpf($dados['cpf'],$dados['id'])==null)){
							echo json_encode(['retorno'=>'erro','motivo'=>'esse cpf pertence a outro contato']);
							exit();

						}



						if($this->contato->AlteraContato($dados)){

							echo json_encode(['retorno'=>'sucesso','motivo'=>'cliente alterado com sucesso']); 

						}else{

							echo json_encode(['retorno'=>'erro','motivo'=>'cliente nao foi alterado']); 

						}
					
					break;
					
					case 'cliente':
					
						if(!is_numeric($rota[count($rota)-1])){
							
							echo json_encode(['retorno'=>'erro','motivo'=>'parametro invalido']);
							exit();
						}
						if($this->contato->LerContato($rota[count($rota)-1])==null){

							
							echo json_encode(['retorno'=>'erro','motivo'=>'cliente nao existe']);
							exit();
						}
						echo json_encode($this->contato->ClienteContato($rota[count($rota)-1]));


					break;
					default:
						echo json_encode(['retorno'=>'erro','motivo'=>'rota invalida']);
					break;


				}

			
			
			
			}else{
				//listar contatos
				echo json_encode($this->contato->ListarContatos(limite:$rota[count($rota)-1],pag:$rota[count($rota)-2]));


			}

		}
		


	}
	public function cliente()
	{
		//possibilidades
		//$rota= "cliente/cadastro"; 
		//$rota= "cliente/1"; 
		//$rota= "cliente/alterar/1"; 
		//$rota= "cliente/excluir/1"; 
		//$rota= "cliente/1(N PAGINA)/20(MAXIMO DE PAGINAS)/2(ATIVO E INATIVO)" 
		//$rota= "cliente/contato/1" 
		

		$rota=explode('/',$_SERVER["REQUEST_URI"]);

		$dados=json_decode(file_get_contents('php://input'),true);
		


		if(isset($dados['cnpj'])){
			
			$dados['cnpj'] = preg_replace('/[^0-9]/is', '', $dados['cnpj']);
			
		}



		if(intval($rota[count($rota)-1])==0){

			
			//cadastro
			if(!isset($dados['nome'])||!isset($dados['cnpj'])||!isset($dados['status'])||$dados['nome']==''||!is_numeric($dados['status'])){



				echo json_encode(['retorno'=>'erro','motivo'=>'Faltam dados']);
				exit();



			}elseif(!$this->validacoes->is_cnpj($dados['cnpj'])){


				echo json_encode(['retorno'=>'erro','motivo'=>'cnpj invalido']);
				exit();



			}
			
			if($this->cliente->FiltrarPorCnpj($dados['cnpj'])==null){
				


				if($this->cliente->CadastrarCliente($dados)){

					echo json_encode(['retorno'=>'sucesso','motivo'=>'cliente cadastrado com sucesso']);
					
				}else{

					echo json_encode(['retorno'=>'erro','motivo'=>'esta faltando dados']);
					
				}




			}else{



				echo json_encode(['retorno'=>'erro','motivo'=>'esse cliente ja esta cadastrado']);
			


			}
					


		}else{
			
			if(intval($rota[count($rota)-2])==0){



				switch($rota[count($rota)-2]){

					case 'alterar':
						
						if(!isset($dados['nome'])||!isset($dados['id'])||!isset($dados['cnpj'])||!isset($dados['status'])||$dados['nome']==''||$dados['id']==""||!is_numeric($dados['status'])){

							echo json_encode(['retorno'=>'erro','motivo'=>'dados invalidos para alterar']);

						}else{



							if(!$this->validacoes->is_cnpj($dados['cnpj'])){

								echo json_encode(['retorno'=>'erro','motivo'=>'cnpj invalido']);
								exit();

							}




							if($this->cliente->FiltrarPorCnpj($dados['cnpj'],$dados['id'])==null){
								



								if($this->cliente->UpdateCliente($dados)){

									echo json_encode(['retorno'=>'sucesso','motivo'=>'cliente atualizado com sucesso']);
							
								}



							}else{

								echo json_encode(['retorno'=>'erro','motivo'=>'esse cnpj ja esta cadastrado']);

							}



						}
					
					break;

					case 'excluir':


						
						if(!is_numeric($rota[count($rota)-1])){
							echo json_encode(['retorno'=>'erro','motivo'=>'ID invalido']); 
							exit();
						}



						if($this->cliente->DeleteCliente($rota[count($rota)-1])){

							echo json_encode(['retorno'=>'sucesso','motivo'=>'cliente deletado com sucesso']); 

						}else{
						
							echo json_encode(['retorno'=>'erro','motivo'=>'nao foi possivel deletar o cliente']); 

						}



					break;

					case 'contato':

						echo json_encode($this->cliente->ListarContatos($rota[count($rota)-1]));


					break;

					case 'cliente':

						echo json_encode($this->cliente->FiltrarPorId($rota[count($rota)-1]));

					break;
					default:
						echo json_encode(['retorno'=>'erro','motivo'=>'rota invalida']);
					break;	
				
				}

		}else{
		
			echo json_encode($this->cliente->ListarClientes(ativo:$rota[count($rota)-1],limite:$rota[count($rota)-2],pag:$rota[count($rota)-3]));

		}
			

		}
		

	}

	
}
