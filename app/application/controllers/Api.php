<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index()
	{
		echo 'api mensagem';
	}
	public function cliente()
	{
		
		//$rota="cliente/cadastro"; -ok
		//$rota="cliente/1"; -ok
		//$rota="cliente/alterar/1"; -ok
		//$rota="cliente/excluir/1"; -ok
		//$rota="cliente/pag/1(N PAGINA)/20(MAXIMO DE PAGINAS)/2(ATIVO E INATIVO)" 

		$rota=explode('/',$_SERVER["REQUEST_URI"]);

		$dados=json_decode(file_get_contents('php://input'),true);
		
		if(intval($rota[count($rota)-1])==0){

			
			
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
						
							if($this->cliente->FiltrarPorCnpj($dados['cnpj'])==null){
								if($this->cliente->UpdateCliente($dados)){

									echo json_encode(['retorno'=>'sucesso','motivo'=>'cliente atualizado com sucesso']);
							
								}
							}else{

								echo json_encode(['retorno'=>'erro','motivo'=>'esse cnpj ja esta cadastrado']);

							}
						
					break;
					case 'excluir':
						
						if($this->cliente->DeleteCliente($rota[count($rota)-1])){

							echo json_encode(['retorno'=>'sucesso','motivo'=>'cliente deletado com sucesso']); 

						}else{
						
							echo json_encode(['retorno'=>'erro','motivo'=>'nao foi possivel deletar o cliente']); 

						}
					break;
					case 'cliente':
						echo json_encode($this->cliente->FiltrarPorId($rota[count($rota)-1]));
					break;		
				
				}

		}else{
		
			echo json_encode($this->cliente->ListarClientes(ativo:$rota[count($rota)-1],limite:$rota[count($rota)-2],pag:$rota[count($rota)-3]));

		}
			

		}
		

	}
}
