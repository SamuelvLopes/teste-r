<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Validacoes {
 
			/**
			 * Valida CPNJ
			 * @param string $document
			 * @return bool
			 */
			function is_cnpj(string $document): bool
			{
				// Extrai somente os números
				$cnpj = preg_replace('/[^0-9]/is', '', $document);

				// Verifica se foi informado todos os digitos corretamente
				if (strlen($cnpj) != 14) {
					return false;
				}
				// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
				if (preg_match('/(\d)\1{13}/', $cnpj)) {
					return false;
				}
				// Faz o calculo para validar o CNPJ
				for ($t = 12; $t < 14; $t++) {
					for ($d = 0, $m = ($t - 7), $i = 0; $i < $t; $i++) {
						$d += $cnpj[$i] * $m;
						$m = ($m == 2 ? 9 : --$m);
					}
					$d = ((10 * $d) % 11) % 10;
					if ($cnpj[$i] != $d) {
						return false;
					}
				}

				return true;
			}
			/**
			 * Valida CPF
			 * @param string $cpf
			 * @return bool
			 */
			function validaCPF($cpf) { 
				// Extrai somente os números
				$cpf = preg_replace( '/[^0-9]/is', '', $cpf );
				 
				// Verifica se foi informado todos os digitos corretamente
				if (strlen($cpf) != 11) {
					return false;
				}
			
				// Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
				if (preg_match('/(\d)\1{10}/', $cpf)) {
					return false;
				}
			
				// Faz o calculo para validar o CPF
				for ($t = 9; $t < 11; $t++) {
					for ($d = 0, $c = 0; $c < $t; $c++) {
						$d += $cpf[$c] * (($t + 1) - $c);
					}
					$d = ((10 * $d) % 11) % 10;
					if ($cpf[$c] != $d) {
						return false;
					}
				}
				return true;
			}

			/**
			 * Valida Email
			 * @param string $email
			 * @return bool
			 */
			function validaEmail($email){

				return filter_var($email, FILTER_VALIDATE_EMAIL);

			}

 		
}

 
