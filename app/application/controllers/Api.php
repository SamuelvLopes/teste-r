<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index()
	{
		echo 'api is online';
	}
	public function Contato()
	{
		// contato/cadastro
		//contato/1
		//contato/alterar/1
		//contato/exluir/1
		//contato/cliente/1

		

		$rota=explode('/',$_SERVER["REQUEST_URI"]);
		$dados=json_decode(file_get_contents('php://input'),true);
		
		if(intval($rota[count($rota)-1])==0){
			
			//cadastro;
			

		}else{

			echo'else';

		}
		


	}
	public function cliente()
	{
		
		//$rota= "cliente/cadastro"; 
		//$rota= "cliente/1"; 
		//$rota= "cliente/alterar/1"; 
		//$rota= "cliente/excluir/1"; 
		//$rota= "cliente/pag/1(N PAGINA)/20(MAXIMO DE PAGINAS)/2(ATIVO E INATIVO)" 
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
